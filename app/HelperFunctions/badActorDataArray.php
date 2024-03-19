<?php

namespace App\HelperFunctions;

function badActorDataArray($actorDataArray)
{
    $isDataBad = (
        !isset($actorDataArray) ||
        $actorDataArray === [] ||
        !$actorDataArray['tmdb_id'] ||
        !is_numeric($actorDataArray['tmdb_id'])
    );

    return $isDataBad;
}
