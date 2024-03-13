<?php

namespace App\HelperFunctions;

use Illuminate\Support\Facades\Http;

use App\Models\Ator;


function fetchActorData($slug)
{
  $parts = explode("-", $slug);
  $tmdb_id = end($parts);
  $apiKey = env('API_KEY');

  $actorUrl = "https://api.themoviedb.org/3/person/$tmdb_id?language=pt-br&api_key=$apiKey";

  $tmdbResponse = Http::get($actorUrl);

  $actorData = $tmdbResponse?->json();

  if (!$actorData) {
    return;
  }

  $profilePath = $actorData['profile_path'] ?? "";

  $urlFoto = empty($profilePath) ? "assets/no-photo.png" : "https://image.tmdb.org/t/p/w300$profilePath";

  $arrayAtor = [
    'tmdb_id' => $tmdb_id,
    'biografia' => $actorData['biography'] ?? "Não há informações cadastradas para o ator",
    'imdb_id'  => $actorData['imdb_id'] ?? "nulo$tmdb_id",
    'nome'  => $actorData['name'] ?? "",
    'nascimento'  => $actorData['birthday'] ?? "0001-01-01",
    'morte'  => $actorData['deathday'] ?? "0001-01-01",
    'genero_sexo'  => $actorData['gender'] ?? "M",
    'local_nascimento'  => $actorData['place_of_birth'] ?? "Não há informações cadastradas para o ator",
    'popularidade'  => $actorData['popularity'] ?? 0.0,
    'poster'  => $urlFoto,
    'imagem'  => $urlFoto,
    'imagem_fallback'  => $urlFoto,
  ];
  $ator = new Ator();

  $ator->fill($arrayAtor);
  Ator::updateOrCreate(
    ['tmdb_id' => $ator->tmdb_id],
    $arrayAtor
  );

  return $arrayAtor;
}
