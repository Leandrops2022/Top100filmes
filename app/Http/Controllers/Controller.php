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
        $decodedData = $tmdbResponse->json();

        return $decodedData;
    }

    protected function getDadosVejaTambem($tabelaSugestao1, $tabelaSugestao2)
    {
        $dados = DB::table($tabelaSugestao1)
            ->select('*')
            ->inRandomOrder()
            ->limit(3)
            ->unionAll(
                DB::table($tabelaSugestao2)
                    ->select('*')
                    ->inRandomOrder()
                    ->limit(3)
            )
            ->get();


        return $dados;
    }
}
