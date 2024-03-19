<?php

namespace App\HelperFunctions;

use Carbon\Carbon;


function actorNeedsTmdbData($ator)
{
    $defaultThreshold  = 7;
    $lastUpdate = $ator->updated_at ? now()->diffInDays(Carbon::parse($ator->updated_at)) : $defaultThreshold;
    $actorNeedsUpdate =  (
        ($ator->imagem == "assets/no-photo.png"
            || $ator->biografia == ""
            || $ator->biografia == "Não há informações cadastradas para o ator"
            || $ator->biografia == null
            || $ator->local_nascimento == "Não há informações cadastradas para o ator")
        && $lastUpdate >= $defaultThreshold
    );

    return $actorNeedsUpdate;
}
