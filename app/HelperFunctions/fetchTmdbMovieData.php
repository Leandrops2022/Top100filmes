<?php

namespace App\HelperFunctions;

use Illuminate\Support\Facades\Http;

use Carbon\Carbon;

use App\Models\Filme;


function fetchTmdbMovieData($id, $update = false)
{
  $apiKey = env('API_KEY');

  $urlPtBr = "https://api.themoviedb.org/3/movie/$id?language=pt-BR&api_key=$apiKey&append_to_response=videos";
  $urlEnUS = "https://api.themoviedb.org/3/movie/$id?language=en-US&api_key=$apiKey&append_to_response=videos";

  $movieData = Http::get($urlPtBr)?->json();

  if (!$movieData ||  empty($movieData['overview'])) {

    $movieData = Http::get($urlEnUS)?->json();
  }

  if (!$movieData || !isset($movieData['id'])) {
    return null;
  }


  $baseTmdbUrl = "https://image.tmdb.org/t/p/original";

  $tituloPortugues = $movieData['title'] ?? "Sem-titulo-$id";
  $resumoPortugues = $movieData['overview'] ?? "";
  $duracao = empty($movieData['runtime']) ? 0 : $movieData['runtime'];
  $dataLancamento =  !empty($movieData['release_date']) ? $movieData['release_date'] : "0001-01-01";
  $anoLancamento = explode('-', $dataLancamento)[0] ?? 0001;
  $genero1 = !isset($movieData['genres'][0]['id']) || empty($movieData['genres'][0]['id']) ? 0 : $movieData['genres'][0]['id'];
  $genero2 = !isset($movieData['genres'][1]['id']) || empty($movieData['genres'][1]['id']) ? 0 : $movieData['genres'][1]['id'];
  $genero3 = !isset($movieData['genres'][2]['id']) || empty($movieData['genres'][2]['id']) ? 0 : $movieData['genres'][2]['id'];
  $poster = empty($movieData['poster_path']) ? "assets/no-image.png" : $baseTmdbUrl . $movieData['poster_path'];
  $nota = empty($movieData['vote_average']) ? 0 : round(floatval($movieData['vote_average']), 2);
  $imdbId = empty($movieData['imdb_id']) ? "nulo" . $movieData['id'] : $movieData['imdb_id'];
  $tmdbId = empty($movieData['id']) ? $id : $movieData['id'];
  $tagline = empty($movieData['tagline']) ? "" : substr($movieData['tagline'], 0, 80);
  $quantidadeDeVotos = empty($movieData['vote_count']) ? 0 : $movieData['vote_count'];
  $arrecadacao = empty($movieData['revenue']) ? 0 : $movieData['revenue'];

  $dataLancamento = Carbon::parse($dataLancamento);

  $dadosFilme = [
    "titulo_portugues" => $tituloPortugues,
    "resumo_portugues" => $resumoPortugues,
    "duracao" => $duracao,
    "ano_lancamento" => $anoLancamento,
    "genero_1" => $genero1,
    "genero_2" => $genero2,
    "genero_3" => $genero3,
    "poster" => $poster,
    "nota" => $nota,
    "imdb_id" => $imdbId,
    "tmdb_id" => $tmdbId,
    "tagline" => $tagline,
    "poster_mobile" => $poster,
    "poster_fallback" => $poster,
    "quantidade_de_votos" => $quantidadeDeVotos,
    "arrecadacao" => $arrecadacao,
    "data_lancamento" => $dataLancamento
  ];


  $filmeNovo = new Filme();
  $filmeNovo->fill($dadosFilme);
  $cleanStr = preg_replace('/[^\p{L}\p{N}-]/u', '-', $filmeNovo->titulo_portugues);

  $filmeNovo->slug = $cleanStr . '-' . $filmeNovo->ano_lancamento;

  if ($update) {

    $filme = Filme::where('tmdb_id', $id)->first();

    $filme->fill($dadosFilme);
    $filme->genero_1 = $filme->genero_1 == "" ? 0 :  $filme->genero_1;
    $filme->genero_2 = $filme->genero_2 == "" ? 0 :  $filme->genero_2;
    $filme->genero_3 = $filme->genero_3 == "" ? 0 :  $filme->genero_3;

    $filme->slug = $cleanStr . '-' . $filme->ano_lancamento;

    $filme->save();

    return $filme;
  }

  if ($filmeNovo->save()) {

    return $filmeNovo;
  }

  return null;
}
