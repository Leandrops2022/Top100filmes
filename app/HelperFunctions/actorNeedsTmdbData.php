<?php

namespace App\HelperFunctions;

function actorNeedsTmdbData($ator)
{
    return (
        $ator->imagem == "assets/no-photo.png"
        || $ator->biografia == ""
        || $ator->biografia == null
    );
}
