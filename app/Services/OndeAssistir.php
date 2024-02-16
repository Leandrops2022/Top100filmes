<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

use function App\HelperFunctions\isObjectPropertyEmpty;

class OndeAssistir
{
    public function buscarOndeAssistir($filme)
    {
        $filteredProvedores = [];
        $sitesDosProvedores = [];

        $apiKey = env('API_KEY');

        $dados = Http::get(
            "https://api.themoviedb.org/3/movie/$filme->tmdb_id/watch/providers?api_key=$apiKey"
        );

        $dadosProntos = json_decode($dados);

        if (
            !isObjectPropertyEmpty($dadosProntos, 'results')
            && !isObjectPropertyEmpty($dadosProntos->results, 'BR')
            && !isObjectPropertyEmpty($dadosProntos->results->BR, 'flatrate')
        ) {
            $provedores = $dadosProntos->results->BR->flatrate;

            $sitesDosProvedores = DB::table('provedores_br')->pluck('site', 'id')->toArray();
            foreach ($provedores as $provedor) {
                if (isset($sitesDosProvedores[$provedor->provider_id])) {
                    $filteredProvedores[] = $provedor;
                }
            }

            $ondeAssistir = [
                'provedores' => $filteredProvedores,
                'sitesDosProvedores' => $sitesDosProvedores
            ];

            return $ondeAssistir;
        } else return null;
    }
}
