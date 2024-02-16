<?php

namespace App\HelperFunctions;

use App\Events\ExceptionEvent;

use Illuminate\Support\Facades\Log;

function handleException($e)
{
    $when = now()->toDateTimeString();
    $message = $e->getMessage();
    $error = $e;

    Log::channel('error')->error($when . ' - An error has ocurred: ' . $message);
    Log::error("Erro-> $e");

    ExceptionEvent::dispatch(
        $when,
        $error,
        $message
    );

    return 'Um erro ocorreu ao acessar a informação solicitada. Nosso time de desenvolvedores já foi informado do incidente, por favor, tente novamente mais tarde.';
}

function isObjectPropertyEmpty($object, $property)
{
    $dataArray = json_decode(json_encode($object), true);

    return empty($dataArray[$property]);
}
