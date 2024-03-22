<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Http\Requests\MovieVotingRequest;

use App\Models\Filme;
use App\Models\ListaDoUsuario;
use App\Models\Movie_vote;
use App\Models\RelacionamentoListaFilme;
use App\Models\TextoDoTop100;
use App\Models\ViewDetalheFilme;
use App\Models\ViewTop100;
use App\Models\ViewElenco;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

use Illuminate\Validation\ValidationException;

use function App\HelperFunctions\handleException;
use function App\HelperFunctions\fetchTmdbMovieData;
use function App\HelperFunctions\fetchMovieVideos;
use function App\HelperFunctions\fetchElenco;
use function App\HelperFunctions\getWhereToWatchData;
use function App\HelperFunctions\movieNeedsTmdbData;
use function App\HelperFunctions\isTmdbMovieDataOk;
use function App\HelperFunctions\assembleMovieInfoArray;

class FilmeController extends Controller
{

    public function showTop100(Request $request)
    {
        try {
            $this->logVisitor();

            $oQueAssistir = null;
            $filmesDaLista = null;
            $tokenApi = null;
            $top100 = $request->segment(1);
            $votes = [];
            $filmes = ViewTop100::query()
                ->from($top100)
                ->select(
                    'id',
                    'slug',
                    'rank',
                    'nota',
                    'titulo_portugues',
                    'ano_lancamento',
                    'duracao',
                    'tagline',
                    'poster_mobile',
                    'poster_fallback',
                    'poster'
                )
                ->orderBy('rank', 'desc')
                ->paginate(10);
            $textosArray = TextoDoTop100::query()->where('nome', $top100)
                ->get();
            $textos = $textosArray[0];
            $tokenApi = null;

            $userId = auth()->id();
            if ($userId) {

                $listasDoUsuario = ListaDoUsuario::where('id_usuario', $userId)
                    ->get();

                $oQueAssistir = $listasDoUsuario[0]->id;
                $filmesDaLista = RelacionamentoListaFilme::where(
                    'id_lista',
                    $oQueAssistir
                )
                    ->pluck('id_filme')
                    ->toArray();

                $votes = Movie_vote::join(
                    $top100,
                    'movie_votes.filme_id',
                    '=',
                    $top100 . '.id'
                )
                    ->where('user_id', $userId)
                    ->select('movie_votes.filme_id', 'movie_votes.nota')
                    ->get();

                $notasPorFilmeId = $votes->keyBy('filme_id');

                $filmes->each(function ($filme) use (
                    $notasPorFilmeId,
                    $filmesDaLista
                ) {
                    $filmeId = $filme->id;
                    $notaUsuario = $notasPorFilmeId->get($filmeId)['nota']
                        ?? null;

                    $filme->notaUsuario = $notaUsuario ?? null;
                    if (in_array($filme->id, $filmesDaLista)) {
                        $filme->botaoAdicionar = false;
                    } else {
                        $filme->botaoAdicionar = true;
                    }
                });

                $tokenApi = $request->cookie('tap');
            } else {
                $filmes->each(function ($filme) {
                    $filme->notaUsuario =  null;
                });
            }

            $metaDescription = substr($textos->p, 0, 130) . '...';
            $metaDescription = strip_tags($metaDescription);

            $dados = $this->getDadosVejaTambem(
                'sugestoes_top100',
                'sugestoes_artigos'
            );

            $sugestoes1 = $dados[0];
            $sugestoes2 = $dados[1];

            return view('top100.index')->with([
                'filmes' => $filmes,
                'textos' => $textos,
                'tap' => $tokenApi,
                'filmesDaLista' => $filmesDaLista,
                'oQueAssistir' => $oQueAssistir,
                'metaDescription' => $metaDescription,
                'sugestoes1' => $sugestoes1,
                'sugestoes2' => $sugestoes2,
            ]);
        } catch (Exception $e) {
            $resposta = handleException($e);
            return back()->withErrors($resposta);
        }
    }

    public function showDetalhesFilme($slug, Request $request)
    {
        try {
            $this->logVisitor();

            $filme = ViewDetalheFilme::where('slug', $slug)->first();

            if (!$filme) {
                // this part of the code is due to a modification in the slug generation, that caused old registered 
                // movies in the database to have the previous slug pattern to return as not found
                $title = str_replace('-', ' ', $slug);
                $titleWithoutYear = preg_replace('/\s+\d{4}$/', '', $title);

                $filme = ViewDetalheFilme::where('titulo_portugues', 'like', '%' . $titleWithoutYear . '%')
                    ->first();

                if ($filme == [] || $filme == "") {
                    return view('404.index');
                }
            }

            $allMovieRelatedData = $this->getTmdbMovieData($filme->tmdb_id);

            $filme->fill($allMovieRelatedData['movieArray']);
            $this->checkIfMovieNeedsUpdate($filme);

            $dataLancamento = Carbon::parse($filme->data_lancamento);
            $filme->data_lancamento = $dataLancamento->format('d/m/Y');

            $whereToWatch = $allMovieRelatedData['whereToWatch'];

            $movieVideos = fetchMovieVideos(
                $allMovieRelatedData['videos'],
                $filme->tmdb_id,
                $filme->id
            );

            $elenco = $this->getCastData($filme, $allMovieRelatedData);

            $finalData = $this->getUserListAndVoteData($request, $filme);

            $movieVote = $finalData['movieVote'];
            $tap = $finalData['tap'];
            $idLista = $finalData['idLista'];
            $filme = $finalData['filme'];


            $metaDescription = substr($filme->texto, 0, 150) . '...';
            $filme->metaDescription = strip_tags($metaDescription);

            return view('filme.index', compact(
                'movieVote',
                'filme',
                'elenco',
                'tap',
                'idLista',
                'movieVideos',
                'whereToWatch'
            ));
        } catch (Exception $e) {
            $resposta = handleException($e);
            return back()->withErrors($resposta);
        }
    }

    public function oldRouteRedirect($id)
    {
        try {

            $filme = Filme::where('tmdb_id', $id)->first();

            if (!$filme) {

                $newMovie = $this->tryToCreateFromTmdbApi($id);
                if ($newMovie) {
                    return redirect("/filme/$newMovie->slug", 301);
                }
                return view('404.index');
            }

            return redirect("/filme/$filme->slug", 301);
        } catch (Exception $e) {
            $resposta = handleException($e);
            return back()->withErrors($resposta);
        }
    }

    public function storeVote(
        $id,
        MovieVotingRequest $request,
        Movie_vote $vote
    ) {

        try {
            $idUsuario = auth()->id();

            $filme = Filme::find($id);
            if ($filme) {

                $idFilme = $id;
                $notaNova = $request->nota;

                $movieVote = Movie_vote::where([
                    'user_id' => $idUsuario,
                    'filme_id' => $idFilme
                ])->first();

                $now = Carbon::now();
                $lastUpdate = $movieVote?->updated_at;
                $canUpdateVote = true;

                if ($lastUpdate) {
                    $canUpdateVote = !($now->diffInWeeks($lastUpdate) < 1);
                }

                if (!$canUpdateVote) {
                    return back()->withErrors('Você já atualizou seu voto neste filme essa semana');
                }

                DB::table('movie_votes')->updateOrInsert(
                    ['user_id' => $idUsuario, 'filme_id' => $idFilme],
                    ['nota' => $notaNova, 'updated_at' => $now,]
                );

                return redirect()->back()->with('mensagemSucesso', 'Voto registrado com sucesso');
            } else {
                throw ValidationException::withMessages(['Ocorreu erro ao registrar seu voto, tente novamente mais tarde']);
            }
        } catch (Exception $e) {
            $resposta = handleException($e);
            return response()->json('Ocorreu um erro: ' . $resposta, 500);
        }
    }



    public function showMelhoresDoAno2023(Request $request)
    {
        try {
            $this->logVisitor();

            $oQueAssistir = null;
            $filmesDaLista = null;
            $tokenApi = null;
            $votes = [];
            $filmes = ViewTop100::query()
                ->from('melhoresfilmes2023')
                ->select('*')
                ->orderBy('rank', 'desc')
                ->paginate(10);
            $tokenApi = null;

            $userId = auth()->id();
            if ($userId) {

                $listasDoUsuario = ListaDoUsuario::where('id_usuario', $userId)
                    ->get();
                $oQueAssistir = $listasDoUsuario[0]->id;
                $filmesDaLista = RelacionamentoListaFilme::where(
                    'id_lista',
                    $oQueAssistir
                )
                    ->pluck('id_filme')
                    ->toArray();

                $votes = Movie_vote::join(
                    'melhoresfilmes2023',
                    'movie_votes.filme_id',
                    '=',
                    'melhoresfilmes2023' . '.id'
                )
                    ->where('user_id', $userId)
                    ->select('movie_votes.filme_id', 'movie_votes.nota')
                    ->get();

                $notasPorFilmeId = $votes->keyBy('filme_id');
                $filmes->each(function ($filme) use (
                    $notasPorFilmeId,
                    $filmesDaLista
                ) {
                    $filmeId = $filme->id;
                    $notaUsuario = $notasPorFilmeId->get($filmeId)['nota']
                        ?? null;

                    $filme->notaUsuario = $notaUsuario ?? null;
                    if (in_array($filme->id, $filmesDaLista)) {
                        $filme->botaoAdicionar = false;
                    } else {
                        $filme->botaoAdicionar = true;
                    }
                });

                $tokenApi = $request->cookie('tap');
            } else {
                $filmes->each(function ($filme) {
                    $filme->notaUsuario =  null;
                });
            }

            return view('melhoresFilmesDoAno.index')->with([
                'filmes' => $filmes,
                'tap' => $tokenApi,
                'filmesDaLista' => $filmesDaLista,
                'oQueAssistir' => $oQueAssistir,
            ]);
        } catch (Exception $e) {
            $resposta = handleException($e);
            return back()->withErrors($resposta);
        }
    }

    private function tryToCreateFromTmdbApi($tmdbId): Filme
    {
        $movieData = $this->getTmdbMovieData($tmdbId)['movieArray'];

        $filme = new Filme();
        $filme->fill($movieData);
        $filme->save();
        $filme->refresh();

        return $filme;
    }

    private function getTmdbMovieData($tmdbMovieId): array
    {
        $apiKey = env('API_KEY');

        $ptBrData = "https://api.themoviedb.org/3/movie/$tmdbMovieId?language=pt-BR&" .
            "api_key=$apiKey&append_to_response=credits," .
            "videos,watch/providers";

        $enUSData = "https://api.themoviedb.org/3/movie/$tmdbMovieId?" .
            "api_key=$apiKey&append_to_response=credits," .
            "videos,watch/providers";

        $data = Http::get($ptBrData)->json();

        $data = isTmdbMovieDataOk($data) ? $data : Http::get($enUSData)?->json();

        $movieDataArray = assembleMovieInfoArray($data, $tmdbMovieId);
        $cast = $data['credits']['cast'] ?? [];
        $videos = $data['videos']['results'] ?? [];
        $watchProviders = $data['watch/providers']['results']['BR']['flatrate'] ?? [];

        $allMovieRelatedData = [
            "movieArray" => $movieDataArray,
            "cast" => $cast,
            "videos" => $videos,
            "whereToWatch" => $watchProviders
        ];

        return $allMovieRelatedData;
    }

    private function checkIfMovieNeedsUpdate(ViewDetalheFilme $movie): void
    {
        $defaultThreshold = 7;
        $lastUpdated = $movie->updated_at ? now()->diffInDays(Carbon::parse($movie->updated_at)) : $defaultThreshold;
        if ($lastUpdated >= 7) {

            $movieArray = $movie->toArray();
            $movieArray['updated_at'] = now();
            unset($movieArray['genero']);
            unset($movieArray['elenco']);

            Filme::where('id', $movie->id)->update($movieArray);
        }
    }

    private function getCastData(
        ViewDetalheFilme $filme,
        array $allMovieRelatedData
    ): Collection|array {
        $elenco = ViewElenco::where('id_filme', $filme->id)
            ->orderBy('ordem_importancia', 'asc')->limit(15)->get();

        if (count($elenco) < 10) {
            //will use cast data from api, saving data in the database aswell
            $elenco = fetchElenco($allMovieRelatedData['cast'], $filme->id);
        }

        return $elenco;
    }

    private function getUserListAndVoteData(
        Request $request,
        ViewDetalheFilme $filme
    ): array {
        $movieVote = 1;
        $idUsuario = auth()->id();

        $idUsuario
            ? $movieVote = DB::select('SELECT * FROM movie_votes WHERE 
            user_id = ? AND filme_id = ?', [$idUsuario, $filme->id])
            : $movieVote = 1;

        //this part of the code fetches user api token to manage watchlist
        $idLista = null;
        $tap = null;
        if ($idUsuario) {
            $idLista = session('idListaUsuario');
            $tap = $request->cookie('tap');
        }

        //lista de filmes que o usuario adicionou
        $resultadosFilmes = RelacionamentoListaFilme::where(
            'id_lista',
            $idLista
        )
            ->pluck('id_filme')
            ->toArray();


        //faz o botao de adicionar novo filme desaparecer se já tiver adicionado
        //na lista do usuario
        $filme->botaoAdicionar = true;
        if (in_array($filme->id, $resultadosFilmes)) {
            $filme->botaoAdicionar = false;
        }

        return [
            "movieVote" => $movieVote,
            "tap" => $tap,
            "idLista" => $idLista,
            "filme" => $filme
        ];
    }
}
