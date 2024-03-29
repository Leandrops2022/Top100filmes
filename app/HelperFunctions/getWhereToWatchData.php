<?php

namespace App\HelperFunctions;

use Illuminate\Support\Facades\Http;

function getWhereToWatchData($data)
{
    // $apiKey = env('API_KEY');

    // if (!isset($filme->tmdb_id) || $filme->tmdb_id == null || $filme->tmdb_id == "") {
    //     $whereToWatch = [];
    //     return $whereToWatch;
    // }

    // $response = Http::get("https://api.themoviedb.org/3/movie/$filme->tmdb_id/watch/providers?api_key=$apiKey");
    // $data = $response->json();
    $whereToWatch = $data['watch/providers\n']['results']['BR']['flatrate'] ?? [];

    foreach ($whereToWatch as $key => $value) {

        // here I removed id 384 because it is of HBO Max, that doesn't exist anymore
        if ($value['provider_id'] == 384) {
            unset($whereToWatch[$key]);
        }
    }

    return $whereToWatch;
}
