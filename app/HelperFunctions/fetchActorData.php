<?php

namespace App\HelperFunctions;

use Illuminate\Support\Facades\Http;

use function App\HelperFunctions\createActorDataArray;


function fetchActorData($tmdb_id)
{

    $apiKey = env('API_KEY');

    $actorUrl = "https://api.themoviedb.org/3/person/$tmdb_id?language=pt-br&api_key=$apiKey";
    $actorEnUsUrl = "https://api.themoviedb.org/3/person/$tmdb_id?api_key=$apiKey";


    $tmdbResponse = Http::get($actorUrl);

    $actorData = $tmdbResponse?->json();

    if (empty($actorData['biography'])) {

        $tmdbResponse = Http::get($actorEnUsUrl);

        $actorData = $tmdbResponse?->json();
    }

    if (!$actorData) {
        return;
    }

    $actorArray = createActorDataArray($actorData, $tmdb_id);

    return $actorArray;
}
