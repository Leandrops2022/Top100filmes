<?php

namespace App\HelperFunctions;

function movieNeedsTmdbData($filme)
{
    $explodedUrl = explode('/', $filme->poster);
    $partialPosterPath = $explodedUrl[2] ?? 'not set';

    return (
        $filme->adulto == null ||
        $filme->adulto == "" ||
        $filme->poster_mobile == "assets/no-image.png" ||
        $partialPosterPath != 'image.tmdb.org' ||
        $filme->resumo_portugues == "" ||
        $filme->nota == 0.00 ||
        $filme->ano_lancamento == 0 ||
        $filme->resumo_portugues == null ||
        $filme->data_lancamento == null);
}
