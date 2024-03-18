<?php

namespace App\HelperFunctions;

use Carbon\Carbon;

function assembleMovieInfoArray($movieData, $id)
{
    $baseTmdbUrl = "https://image.tmdb.org/t/p/original";

    $portugueseTitle = $movieData['title'] ?? "Sem-titulo-$id";
    $portugueseOverview = $movieData['overview'] ?? "";
    $runtime = empty($movieData['runtime']) ? 0 : $movieData['runtime'];
    $releaseDate =  !empty($movieData['release_date']) ? $movieData['release_date'] : "0001-01-01";
    $releaseYear = explode('-', $releaseDate)[0] ?? 0001;
    $gender1 = !isset($movieData['genres'][0]['id']) || empty($movieData['genres'][0]['id']) ? 0 : $movieData['genres'][0]['id'];
    $gender2 = !isset($movieData['genres'][1]['id']) || empty($movieData['genres'][1]['id']) ? 0 : $movieData['genres'][1]['id'];
    $gender3 = !isset($movieData['genres'][2]['id']) || empty($movieData['genres'][2]['id']) ? 0 : $movieData['genres'][2]['id'];
    $poster = empty($movieData['poster_path']) ? "assets/no-image.png" : $baseTmdbUrl . $movieData['poster_path'];
    $score = empty($movieData['vote_average']) ? 0 : round(floatval($movieData['vote_average']), 2);
    $imdbId = empty($movieData['imdb_id']) ? "nulo" . $movieData['id'] : $movieData['imdb_id'];
    $tmdbId = empty($movieData['id']) ? $id : $movieData['id'];
    $tagline = empty($movieData['tagline']) ? "" : substr($movieData['tagline'], 0, 80);
    $voteCount = empty($movieData['vote_count']) ? 0 : $movieData['vote_count'];
    $revenue = empty($movieData['revenue']) ? 0 : $movieData['revenue'];

    // se der merda, foi aqui
    $adult = empty($movieData['adult']) ? 0 : $movieData['adult'];

    $releaseDate = Carbon::parse($releaseDate);

    $movieDataArray = [
        "titulo_portugues" => $portugueseTitle,
        "resumo_portugues" => $portugueseOverview,
        "duracao" => $runtime,
        "ano_lancamento" => $releaseYear,
        "genero_1" => $gender1,
        "genero_2" => $gender2,
        "genero_3" => $gender3,
        "poster" => $poster,
        "nota" => $score,
        "imdb_id" => $imdbId,
        "tmdb_id" => $tmdbId,
        "tagline" => $tagline,
        "poster_mobile" => $poster,
        "poster_fallback" => $poster,
        "quantidade_de_votos" => $voteCount,
        "arrecadacao" => $revenue,
        "data_lancamento" => $releaseDate,
        "adult" => $adult
    ];

    return $movieDataArray;
}
