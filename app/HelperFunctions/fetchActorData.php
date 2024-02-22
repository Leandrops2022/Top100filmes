<?php

namespace App\HelperFunctions;

use Illuminate\Support\Facades\Http;

function fetchActorData($slug)
{
  $parts = explode("-", $slug);
  $tmdb_id = end($parts);
  $apiKey = env('API_KEY');

  $actorUrl = "https://api.themoviedb.org/3/person/$tmdb_id?language=pt-br&api_key=$apiKey";

  $tmdbResponse = Http::get($actorUrl);

  $actorData = $tmdbResponse?->json();

  $profilePath = $actorData['profile_path'] ?? "";

  $urlFoto = "https://media.themoviedb.org/t/p/w300_and_h450_bestv2$profilePath";

  $arrayAtor = [
    'id' => $tmdb_id,
    'biografia' => $actorData['biography'] ?? "Não há informações cadastradas para o ator",
    'imdb_id'  => $actorData['imdb_id'] ?? "",
    'nome'  => $actorData['name'] ?? "",
    'nascimento'  => $actorData['birthday'] ?? "Não há informações cadastradas para o ator",
    'morte'  => $actorData['deathday'] ?? "",
    'genero_sexo'  => $actorData['gender'] ?? "",
    'local_nascimento'  => $actorData['place_of_birth'] ?? "Não há informações cadastradas para o ator",
    'popularidade'  => $actorData['popularity'] ?? "",
    'poster'  => $urlFoto ?? "",
    'imagem'  => $urlFoto ?? "",
    'imagem_fallback'  => $urlFoto ?? "",
  ];

  return $arrayAtor;
}
