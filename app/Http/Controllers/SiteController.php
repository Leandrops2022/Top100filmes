<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Artigo;
use App\Models\Filme;
use App\Models\Destaques;
use App\Models\ListaDoUsuario;
use App\Models\MiniLista;
use App\Models\Noticia;
use App\Models\RelacionamentoListaFilme;

use Carbon\Carbon;

use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function App\HelperFunctions\handleException;

class SiteController extends Controller
{
    public function notice()
    {
        try {
            return view('validation.notice');
        } catch (Exception $e) {
            $resposta = handleException($e);
            return back()->withErrors($resposta);
        }
    }

    public function index()
    {
        try {
            $this->logVisitor();

            // $destaques = Artigo::select('slug', 'titulo', 'created_at', 'imagem_capa', 'alt_capa', 'fonte_capa', 'tag')->orderBy('created_at', 'desc')->limit(12)->get();
            $minilistas = MiniLista::orderBy('created_at', 'desc')->limit(4)->get();
            // $ultimasNoticias = Noticia::orderBy('created_at', 'desc')->limit(8)->get();

            $destaques = Destaques::get();

            return view('home.index')->with(['destaques' => $destaques, 'minilistas' => $minilistas]);
        } catch (Exception $e) {
            $resposta = handleException($e);
            return back()->withErrors($resposta);
        }
    }

    public function showNoticias()
    {
        try {
            $this->logVisitor();

            $noticias = Noticia::orderBy('created_at', 'desc')->paginate(24);

            foreach ($noticias as $noticia) {
                $criado_em = Carbon::createFromFormat('Y-m-d H:i:s', $noticia->created_at, 'UTC');
                $criado_em->setTimezone('America/Sao_Paulo');
                $criado_em = $criado_em->format('d-m-Y H:i:s');
                $noticia->criado_em = $criado_em;
            }

            return view('noticias.index', compact('noticias'));
        } catch (Exception $e) {
            $resposta = handleException($e);
            return back()->withErrors($resposta);
        }
    }

    public function showArtigos()
    {
        try {
            $this->logVisitor();

            $destaques = Artigo::orderBy('created_at', 'desc')->paginate(10);


            // foreach ($destaques as $artigo) {
            //     $criado_em = Carbon::createFromFormat('Y-m-d H:i:s', $artigo->created_at, 'UTC');
            //     $criado_em->setTimezone('America/Sao_Paulo');
            //     $criado_em = $criado_em->format('d-m-Y H:i:s');
            //     $artigo->criado_em = $criado_em;
            // }

            return view('artigos.index')->with(['destaques' => $destaques]);
        } catch (Exception $e) {
            $resposta = handleException($e);
            return back()->withErrors($resposta);
        }
    }

    public function showListas()
    {
        try {
            $this->logVisitor();

            $destaques = MiniLista::orderBy('created_at', 'desc')->paginate(10);

            foreach ($destaques as $artigo) {
                $artigo->alt_capa = $artigo->alt_imagem_capa;
            }

            return view('artigos.index')->with(['destaques' => $destaques]);
        } catch (Exception $e) {
            $resposta = handleException($e);
            return back()->withErrors($resposta);
        }
    }


    public function showMiniLista($slug)
    {
        try {
            $this->logVisitor();

            $minilista = MiniLista::where('slug', $slug)->first();

            $dados = $this->getDadosVejaTambem('sugestoes_top100', 'sugestoes_minilistas');

            $sugestoes1 = $dados->splice(0, 3);
            $sugestoes2 = $dados;

            $ids = json_decode($minilista->filmes_ids, true);
            $idsReversas = array_reverse($ids);

            $filmes = Filme::whereIn('id', $idsReversas)
                ->orderByRaw("FIELD(id, " . implode(',', $idsReversas) . ")")
                ->get();

            $metaDescription = substr($minilista->texto, 0, 150) . '...';
            $minilista->metaDescription = strip_tags($metaDescription);

            return view('miniLista.index', compact(['minilista', 'filmes', 'sugestoes1', 'sugestoes2']));
        } catch (Exception $e) {
            $resposta = handleException($e);
            return back()->withErrors($resposta);
        }
    }

    public function showArtigo($slug)
    {
        try {
            $this->logVisitor();

            $artigo = Artigo::where('slug', $slug)->firstOrFail();
            $criado_em =  $artigo->created_at->format('d/m/Y');
            $artigo->criado_em = $criado_em;

            $metaDescription = substr($artigo->texto, 0, 150) . '...';
            $artigo->metaDescription = strip_tags($metaDescription);

            $dados = $this->getDadosVejaTambem('sugestoes_minilistas', 'sugestoes_top100');

            $sugestoes1 = $dados->splice(0, 3);
            $sugestoes2 = $dados;

            return view('artigo.index', compact('artigo', 'sugestoes1', 'sugestoes2'));
        } catch (Exception $e) {
            $resposta = handleException($e);
            return back()->withErrors($resposta);
        }
    }

    public function showGeneros()
    {
        try {
            $this->logVisitor();

            $items = [
                ['tituloCard' => 'ACÃO', 'rota' => 'acao', 'nomeImagem' => 'acao1', 'posicao' => 1],
                ['tituloCard' => 'ROMANCE', 'rota' => 'romance', 'nomeImagem' => 'romance1', 'posicao' => 2],
                ['tituloCard' => 'COMÉDIA', 'rota' => 'comedia', 'nomeImagem' => 'comedia1', 'posicao' => 3],
                ['tituloCard' => 'FANTASIA', 'rota' => 'fantasia', 'nomeImagem' => 'fantasia1', 'posicao' => 4],
                ['tituloCard' => 'AVENTURA', 'rota' => 'aventura', 'nomeImagem' => 'aventura1', 'posicao' => 5],
                ['tituloCard' => 'ANIMAÇÃO', 'rota' => 'animacao', 'nomeImagem' => 'animacao1', 'posicao' => 6],
                ['tituloCard' => 'DRAMA', 'rota' => 'drama', 'nomeImagem' => 'drama1', 'posicao' => 7],
                ['tituloCard' => 'TERROR', 'rota' => 'terror', 'nomeImagem' => 'terror1', 'posicao' => 8],
                ['tituloCard' => 'SUSPENSE', 'rota' => 'suspense', 'nomeImagem' => 'suspense1', 'posicao' => 9],
                ['tituloCard' => 'FAROESTE', 'rota' => 'faroeste', 'nomeImagem' => 'faroeste1', 'posicao' => 10],
                ['tituloCard' => 'CRIME', 'rota' => 'crime', 'nomeImagem' => 'crime1', 'posicao' => 11],
                ['tituloCard' => 'FICÇÃO CIENTÍFICA', 'rota' => 'ficcaocientifica', 'nomeImagem' => 'ficcaocientifica1', 'posicao' => 12],
                ['tituloCard' => 'MISTÉRIO', 'rota' => 'misterio', 'nomeImagem' => 'misterio1', 'posicao' => 13],
                ['tituloCard' => 'MUSICAL', 'rota' => 'musical', 'nomeImagem' => 'musical1', 'posicao' => 14],
                ['tituloCard' => 'FAMÍLIA', 'rota' => 'familia', 'nomeImagem' => 'familia1', 'posicao' => 15],
                ['tituloCard' => 'GUERRA', 'rota' => 'guerra', 'nomeImagem' => 'guerra1', 'posicao' => 16],
                ['tituloCard' => 'CLÁSSICOS', 'rota' => 'filmesclassicos', 'nomeImagem' => 'filmesclassicos1', 'posicao' => 17],
            ];
            return view('generos.index')->with('items', $items);
        } catch (Exception $e) {
            $resposta = handleException($e);
            return back()->withErrors($resposta);
        }
    }

    public function showContato()
    {
        try {
            $this->logVisitor();

            return view('contato.index');
        } catch (Exception $e) {
            $resposta = handleException($e);
            return back()->withErrors($resposta);
        }
    }

    public function showSobre()
    {
        try {
            $this->logVisitor();

            return view('sobre.index');
        } catch (Exception $e) {
            $resposta = handleException($e);
            return back()->withErrors($resposta);
        }
    }

    public function showQuemSomos()
    {
        try {
            $this->logVisitor();

            return view('quemSomos.index');
        } catch (Exception $e) {
            $resposta = handleException($e);
            return back()->withErrors($resposta);
        }
    }

    public function showPerguntasFrequentes()
    {
        try {
            $this->logVisitor();

            return view('FAQ.index');
        } catch (Exception $e) {
            $resposta = handleException($e);
            return back()->withErrors($resposta);
        }
    }

    public function showSearchResults(Request $request)
    {
        try {
            $this->logVisitor();

            $searchQuery = $request->input('busca');


            $tiposDeBusca = [
                'filme' => 'informacoes_basicas_filmes',
                'ator' => 'informacoes_basicas_atores',
                'artigo' => 'informacoes_basicas_artigos',
                'lista' => 'informacoes_basicas_minilistas',
                'noticia' => 'informacoes_basicas_noticias',
            ];

            $charactersToReplace = [' ', '!', '@', '#', '$', '-', ':'];

            $replacement = '%';

            $likeQuery = str_replace($charactersToReplace, $replacement, $searchQuery);

            $resultados = (DB::table($tiposDeBusca[$request->input('tipo_busca')])
                ->where('nome', '=', $searchQuery)
                ->orWhere('nome', 'LIKE', "%$likeQuery%")
                ->orderByRaw("CASE WHEN nome LIKE ? THEN 0 ELSE 1 END, data, nome", [$searchQuery])
                ->limit(100)
                ->paginate(10));

            $idLista = session('idListaUsuario');

            $resultadosFilmes = RelacionamentoListaFilme::where('id_lista', $idLista)
                ->pluck('id_filme')
                ->toArray();

            foreach ($resultados as $elemento) {

                if ($elemento->tag == 'Filme') {
                    in_array($elemento->id, $resultadosFilmes) ? $elemento->botaoAdicionar = false :  $elemento->botaoAdicionar = true;
                }
            }
            $tokenApi = $request->cookie('tap');

            return view("resultados-busca.index")->with([
                'resultados' => $resultados,
                'tap' => $tokenApi,
                'idLista' =>  $idLista,
            ]);
        } catch (Exception $e) {
            $resposta = handleException($e);
            return back()->withErrors($resposta);
        }
    }

    public function showListasUsuario(Request $request)
    {
        try {
            $this->logVisitor();

            $user = $request->user();

            $listasDoUsuario = ListaDoUsuario::where('id_usuario', $user->id)->get();

            $relacionamentosDaLista = null;
            $idsFilmesDaLista = null;
            $filmesDaLista = null;

            if ($listasDoUsuario->count() > 0) {
                $relacionamentosDaLista = RelacionamentoListaFilme::where('id_lista', $listasDoUsuario[0]->id)->get();

                $idsFilmesDaLista = $relacionamentosDaLista->map(function ($id) {
                    return  $id->id_filme;
                });

                $filmesDaLista = Filme::whereIn('id', $idsFilmesDaLista)->get();
            }

            $token = $request->cookie('tap');

            return view('listasUsuario.index')->with([
                'listasDoUsuario' => $listasDoUsuario,
                'filmesDaLista' => $filmesDaLista,
                'apiToken' => $token
            ]);
        } catch (Exception $e) {
            $resposta = handleException($e);
            return back()->withErrors($resposta);
        }
    }

    public function showNoticia($slug)
    {
        try {
            $this->logVisitor();

            $noticia = Noticia::where('slug', $slug)->firstOrFail();
            $criado_em = $noticia->created_at->format('d/m/Y');
            $noticia->criado_em = $criado_em;

            $metaDescription = substr($noticia->texto, 0, 150) . '...';
            $noticia->metaDescription = strip_tags($metaDescription);


            return view('noticia.index', compact('noticia'));
        } catch (Exception $e) {
            $resposta = handleException($e);
            return back()->withErrors($resposta);
        }
    }

    public function showIndicadosOscar2024()
    {
        try {
            $this->logVisitor();

            return view('oscar-2024.index');
        } catch (Exception $e) {
            $resposta = handleException($e);
            return back()->withErrors($resposta);
        }
    }
}
