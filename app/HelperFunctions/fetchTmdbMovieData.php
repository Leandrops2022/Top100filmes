<?php

namespace App\HelperFunctions;

use Illuminate\Support\Facades\Http;


use App\Models\Filme;

use function App\HelperFunctions\isTmdbMovieDataOk;
use function App\HelperFunctions\assembleMovieInfoArray;

function fetchTmdbMovieData($id, $update = false)
{

    $apiKey = env('API_KEY');

    $urlPtBr = "https://api.themoviedb.org/3/movie/$id?language=pt-BR&api_key=$apiKey&append_to_response=videos";
    $urlEnUS = "https://api.themoviedb.org/3/movie/$id?language=en-US&api_key=$apiKey&append_to_response=videos";

    $movieData = Http::get($urlPtBr)?->json();



    $movieData = isTmdbMovieDataOk($movieData) ? $movieData : Http::get($urlEnUS)?->json();

    // if (!$movieData ||  empty($movieData['overview'])) {

    //     $movieData = Http::get($urlEnUS)?->json();
    // }

    if (!isTmdbMovieDataOk($movieData)) {
        return null;
    }

    $movieDataArray = assembleMovieInfoArray($movieData, $id);

    $filmeNovo = new Filme();
    $filmeNovo->fill($movieDataArray);
    $cleanStr = preg_replace('/[^\p{L}\p{N}-]/u', '-', $filmeNovo->titulo_portugues);

    $filmeNovo->slug = $cleanStr . '-' . $filmeNovo->ano_lancamento;

    if ($update) {
        $filme = Filme::where('tmdb_id', $id)->first();

        $filme->fill($movieDataArray);
        $filme->genero_1 = $filme->genero_1 == "" ? 0 :  $filme->genero_1;
        $filme->genero_2 = $filme->genero_2 == "" ? 0 :  $filme->genero_2;
        $filme->genero_3 = $filme->genero_3 == "" ? 0 :  $filme->genero_3;

        $filme->adulto = $movieDataArray['adult'];
        $filme->slug = $cleanStr . '-' . $filme->ano_lancamento;
        $filme->save();

        return $filme;
    }

    if ($filmeNovo->save()) {

        return $filmeNovo;
    }

    return null;
}
