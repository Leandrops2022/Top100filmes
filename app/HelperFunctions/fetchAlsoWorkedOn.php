<?php

namespace App\HelperFunctions;

use Illuminate\Support\Facades\Http;

use App\Models\FilmeEmQueAtuou;


function fetchAlsoWorkedOn($actorId)
{
  $apiKey = env('API_KEY');

  // $paddedActorId = str_pad($actorId, 6, "0", STR_PAD_LEFT);

  $creditsUrl = "https://api.themoviedb.org/3/person/$actorId/movie_credits?language=pt-BR&api_key=$apiKey";

  $tmdbResponse = Http::get($creditsUrl);
  $creditsData = $tmdbResponse?->json()['cast'] ?? [];

  $baseUrl = "https://image.tmdb.org/t/p/w600_and_h900_bestv2";
  $workedOn = [];

  foreach ($creditsData as $movie) {
    if ($movie['poster_path'] == null || $movie['poster_path'] == "") {
      continue;
    }

    $backdropPath = $movie['backdrop_path'] ?? $movie['poster_path'];

    $posterMobile = $baseUrl . $movie['poster_path'];
    $posterFallback = $baseUrl . $backdropPath;

    $releaseDateOk = isset($movie['release_date']) && !empty($movie['release_date']);
    $anoLancamento = $releaseDateOk ? intval(explode('-', $movie['release_date'])[0]) : 0001;

    $cleanStr = preg_replace('/[^\p{L}\p{N}-]/u', '-', $movie['title']);

    $slug = $cleanStr . "-" . $anoLancamento;
    $voteAverage = $movie['vote_average'] ?? 0.00;
    $nota = number_format(round($voteAverage, 2), 2) ?? 0.00;

    $movieData = [
      "id_ator" => $actorId,
      "titulo_portugues" => $movie['title'],
      "poster_mobile" => $posterMobile,
      "poster_fallback" => $posterFallback,
      "id_filme" => $movie['id'],
      "slug" => $slug,
      "ano_lancamento" => $anoLancamento,
      "personagem" => $movie['character'] ?? '-',
      "nota" => $nota,
    ];


    $movieWorkedOn = new FilmeEmQueAtuou();
    $movieWorkedOn->fill($movieData);
    $workedOn[] = $movieWorkedOn;
  }
  usort($workedOn, function ($a, $b) {
    return $b->ano_lancamento - $a->ano_lancamento;
  });
  return $workedOn;
}
