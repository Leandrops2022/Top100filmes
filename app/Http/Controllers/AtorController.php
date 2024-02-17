<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ator;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

use function App\HelperFunctions\handleException;

class AtorController extends Controller
{
    public function showDetalhesAtor($slug)
    {
        try {
            $this->logVisitor();
            $ator = Ator::where('slug', '=', $slug)->firstOrFail();

            if ($ator->biografia == 'Não há informações cadastradas para o ator') {
                $paddedActorId = str_pad($ator->id, 6, "0", STR_PAD_LEFT);

                $tmdbAPIKey = env('TMDB_API_KEY');
                $tmdbActorUrlPtBr = "https://api.themoviedb.org/3/person/$paddedActorId?language=pt-br&api_key=$tmdbAPIKey";
                $tmdbActorUrlEnUs = "https://api.themoviedb.org/3/person/$paddedActorId?api_key=$tmdbAPIKey";

                $actorData = $this->getTmdbData($tmdbActorUrlPtBr);

                $biography = $actorData['biography'] == "" ? $this->getTmdbData($tmdbActorUrlEnUs)['biography']
                    : $actorData['biography'];

                $ator->biografia = $biography;
            }

            $ator->nascimento = $ator->nascimento ?? 'sem informações cadastradas';
            $ator->morte = $ator->morte ?? '';


            if ($ator->nascimento && Carbon::hasFormat($ator->nascimento, 'Y-m-d')) {
                $nascimento = Carbon::createFromFormat('Y-m-d', $ator->nascimento);
                $ator->nascimento = $nascimento->format('d/m/Y');
            }

            if ($ator->morte && Carbon::hasFormat($ator->morte, 'Y-m-d')) {
                $dataMorte = Carbon::createFromFormat('Y-m-d', $ator->morte);
                $ator->morte = $dataMorte->format('d/m/Y');
            }

            $ator->imagem = $ator->imagem ?? 'assets/no-photo.png';
            $ator->imagem_fallback = $ator->imagem_fallback ?? 'assets/no-photo.png';

            $filmesEmQueAtuou = DB::table('filmes_em_que_atuou')->where('id_ator', $ator->id)->orderBy('ano_lancamento', 'desc')->get();

            foreach ($filmesEmQueAtuou as $filme) {
                $filme->poster_mobile = $filme->poster_mobile ?? 'assets/no-image.png';
                $filme->poster_fallback = $filme->poster_fallback ?? 'assets/no-image.png';
            }

            return view('ator.index')->with(['ator' => $ator, 'filmesEmQueAtuou' => $filmesEmQueAtuou]);
        } catch (Exception $e) {
            $resposta = handleException($e);
            return back()->withErrors($resposta);
        }
    }

    public function detalhesAtorRotaAntiga($id)
    {
        try {
            $ator = Ator::where('id', $id)->first();

            return redirect("/ator/$ator->slug", 301);
        } catch (Exception $e) {
            $resposta = handleException($e);
            return back()->withErrors($resposta);
        }
    }
}
