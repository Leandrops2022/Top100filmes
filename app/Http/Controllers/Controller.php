<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;



class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function logVisitor()
    {
        $ip = request()->ip();

        $logMessage = "Visitor IP: $ip - Date: " . now()->toDateTimeString();

        $logFile = 'visitors';

        Log::channel($logFile)->info($logMessage);
    }

    protected function getTmdbData($url)
    {
        $tmdbResponse = Http::get($url);
        $decodedData = $tmdbResponse?->json();

        return $decodedData;
    }

    protected function getDadosVejaTambem($tabelaSugestao1, $tabelaSugestao2)
    {
        $suggestionLimit = 4;

        $data = DB::table($tabelaSugestao1)
            ->select('*')
            ->inRandomOrder()
            ->limit($suggestionLimit)
            ->unionAll(
                DB::table($tabelaSugestao2)
                    ->select('*')
                    ->inRandomOrder()
                    ->limit($suggestionLimit)
            )
            ->get();


        $data1 = $data->splice(0, $suggestionLimit);

        $maxLength = 80;
        for ($i = 0; $i < $suggestionLimit; $i++) {
            $data[$i]->titulo =  strlen($data[$i]->titulo) > $maxLength ? substr($data[$i]->titulo, 0, $maxLength) . "..."
                : $data[$i]->titulo;
            $data1[$i]->titulo =  strlen($data1[$i]->titulo) > $maxLength ? substr($data1[$i]->titulo, 0, $maxLength) . "..."
                : $data1[$i]->titulo;
        }

        $youMayAlsoLikeArray = [$data, $data1];
        return $youMayAlsoLikeArray;
    }
}
