<?php

namespace App\HelperFunctions;

use Illuminate\Support\Carbon;

function movieNeedsTmdbData($filme)
{
    //in this part I check if the poster url path is present in the data
    $explodedUrl = explode('/', $filme->poster);
    $partialPosterPath = $explodedUrl[2] ?? 'not set';

    $defaultThreshold  = 7;

    $lastUpdate = $filme->updated_at ? now()
        ->diffInDays(Carbon::parse($filme->updated_at))
        : $defaultThreshold;

    $movieNeedsUpdate =  (
        $filme->adulto === null ||
        $filme->adulto === "" ||
        $filme->poster_mobile == "assets/no-image.png" ||
        $partialPosterPath != 'image.tmdb.org' ||
        $filme->resumo_portugues == "" ||
        $filme->resumo_portugues == null ||
        $filme->nota == 0.00 ||
        $filme->ano_lancamento == 0001 ||
        $filme->data_lancamento == "0001-01-01" ||
        $filme->data_lancamento == null
    ) && $lastUpdate >= 7;

    return $movieNeedsUpdate;
}
