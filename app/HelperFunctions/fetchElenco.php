<?php

namespace App\HelperFunctions;

use Illuminate\Support\Facades\Http;
use Illuminate\Database\QueryException;


use App\Models\Elenco;
use App\Models\Ator;


function fetchElenco($filme)
{
    $apiKey = env('API_KEY');

    $elencoUrl = "https://api.themoviedb.org/3/movie/$filme->tmdb_id/credits?language=pt-BR&api_key=$apiKey";

    $dadosElenco = Http::get($elencoUrl)?->json()['cast'];
    $arrayElenco = [];

    foreach ($dadosElenco ?? [] as $atorElenco) {
        try {
            if (!isset($atorElenco['profile_path'], $atorElenco['name'], $atorElenco['id'], $atorElenco['character'])) {
                continue;
            }

            $path = $atorElenco['profile_path'];
            $imagem = "https://media.themoviedb.org/t/p/w300_and_h450_bestv2/$path";

            $ator = new Ator();

            $cleanStr = preg_replace('/[^\p{L}\p{N} -]/u', '-', $atorElenco['name']);


            $slug = $cleanStr . '-' . $atorElenco['id'];

            // $ator->slug = $atorElenco['name'] . "-" . $atorElenco['id'];
            $ator->foto = $imagem;
            $ator->foto_fallback = $imagem;
            $ator->nome = $atorElenco['name'];
            $ator->id_ator = $atorElenco['id'];
            $ator->personagem = $atorElenco['character'];
            $ator->ordem_importancia = $atorElenco['order'];
            $ator->slug =  $slug;
            $ator->rota = "detalhesAtor";
            $ator->tag = "Ator/Atriz";

            $arrayElenco[] = $ator;
            $dados = $ator->toArray();

            $elenco = new Elenco();
            $elenco = $elenco->fill($dados);
            $elenco->id_filme = $filme->id;

            $elenco->save();
        } catch (QueryException $e) {
            continue;
        }
    }

    return $arrayElenco;
}
