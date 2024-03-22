<?php

namespace App\HelperFunctions;

use Illuminate\Database\QueryException;

use App\Models\Elenco;
use App\Models\Ator;

function fetchElenco($castData, $movieId)
{

    $castArray = [];

    foreach ($castData ?? [] as $castActor) {
        try {
            if (!isset($castActor['profile_path'], $castActor['name'], $castActor['id'], $castActor['character'])) {
                continue;
            }

            $path = $castActor['profile_path'];
            $image = "https://media.themoviedb.org/t/p/w300_and_h450_bestv2/$path";

            $actor = new Ator();

            $cleanStr = preg_replace('/[^\p{L}\p{N} -]/u', '-', $castActor['name']);


            $slug = $cleanStr . '-' . $castActor['id'];

            $actor->foto = $image;
            $actor->foto_fallback = $image;
            $actor->nome = $castActor['name'];
            $actor->id_ator = $castActor['id'];
            $actor->personagem = $castActor['character'];
            $actor->ordem_importancia = $castActor['order'];
            $actor->slug =  $slug;
            $actor->rota = "detalhesAtor";
            $actor->tag = "Ator/Atriz";

            $castArray[] = $actor;
            $dados = $actor->toArray();

            $cast = new Elenco();
            $cast = $cast->fill($dados);
            $cast->id_filme = $movieId;

            $cast->save();
        } catch (QueryException $e) {
            continue;
        }
    }

    return $castArray;
}
