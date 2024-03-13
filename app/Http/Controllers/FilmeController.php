<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Http\Requests\MovieVotingRequest;

use App\Models\Filme;
use App\Models\Ator;
use App\Models\ListaDoUsuario;
use App\Models\Movie_votes;
use App\Models\MovieVideo;
use App\Models\RelacionamentoListaFilme;
use App\Models\TextosDosTop100;
use App\Models\ViewDetalhesFilmes;
use App\Models\ViewsTop100;
use App\Models\ViewElenco;

use Exception;

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
            $filmes = ViewsTop100::query()
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
            $textosArray = TextosDosTop100::query()->where('nome', $top100)
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

                $votes = Movie_votes::join(
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

            $apiKey = env('API_KEY');

            $filme = ViewDetalhesFilmes::where('slug', $slug)->first();



            if (!$filme) {
                // this part of the code is due to a modification in the slug generation, that caused old registered 
                // movies in the database to have the previous slug pattern to return as not found

                $title = str_replace('-', ' ', $slug);
                $titleWithoutYear = preg_replace('/\s+\d{4}$/', '', $title);

                $filme = ViewDetalhesFilmes::where('titulo_portugues', 'like', '%' . $titleWithoutYear . '%')
                    ->first();

                if ($filme == [] || $filme == "") {
                    return view('404.index');
                }
            }

            if (movieNeedsTmdbData($filme)) {

                $filme = fetchTmdbMovieData($filme->tmdb_id, true);
            }

            $whereToWatch = getWhereToWatchData($filme) ?? [];

            $movieVideos = fetchMovieVideos($filme->tmdb_id, $filme->id);

            $elenco = ViewElenco::where('id_filme', $filme->id)
                ->orderBy('ordem_importancia', 'asc')->limit(15)->get();

            if (count($elenco) == 0) {

                $elenco = fetchElenco($filme);
            }

            $movieVote = 1;
            $idUsuario = auth()->id();

            $idUsuario
                ? $movieVote = DB::select('SELECT * FROM movie_votes WHERE 
                user_id = ? AND filme_id = ?', [$idUsuario, $filme->id])
                : $movieVote = 1;

            $idLista = null;
            $tap = null;
            if ($idUsuario) {
                $idLista = session('idListaUsuario');
                $tap = $request->cookie('tap');
            }

            $resultadosFilmes = RelacionamentoListaFilme::where(
                'id_lista',
                $idLista
            )
                ->pluck('id_filme')
                ->toArray();


            $filme->botaoAdicionar = true;
            if (in_array($filme->id, $resultadosFilmes)) {
                $filme->botaoAdicionar = false;
            }


            $data = Carbon::parse($filme->data_lancamento);
            $filme->data_lancamento = $data->format('d/m/Y');

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

    public function storeVote(
        $id,
        MovieVotingRequest $request,
        Movie_votes $vote
    ) {

        try {
            $idUsuario = auth()->id();

            $filme = Filme::find($id);
            if ($filme) {

                $idFilme = $id;
                $notaNova = $request->nota;

                $movieVote = Movie_votes::where([
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

    public function oldRouteRedirect($id)
    {
        try {
            $filme = Filme::where('tmdb_id', $id)->first();
            if (!$filme) {
                $filme = fetchTmdbMovieData($id);
                if (!$filme) {
                    return view('404.index');
                }
            }

            if (movieNeedsTmdbData($filme)) {
                $filme = fetchTmdbMovieData($id, true);
            }

            $data = Carbon::parse($filme->data_lancamento);
            $filme->data_lancamento = $data->format('d/m/Y');

            return redirect("/filme/$filme->slug", 301);
        } catch (Exception $e) {
            $resposta = handleException($e);
            return back()->withErrors($resposta);
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
            $filmes = ViewsTop100::query()
                ->from('melhoresfilmes2023')
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
                    'poster_fallback'
                )
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

                $votes = Movie_votes::join(
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
}
