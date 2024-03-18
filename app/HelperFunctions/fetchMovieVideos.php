<?php

namespace App\HelperFunctions;

use Illuminate\Support\Facades\Http;

use Carbon\Carbon;

use App\Models\MovieVideo;


function fetchMovieVideos($movieTmdbId, $movieId)
{

    $apiKey = env('API_KEY');

    $urlPtBr = "https://api.themoviedb.org/3/movie/$movieTmdbId/videos?api_key=$apiKey&language=pt-BR";
    $urlEnUS = "https://api.themoviedb.org/3/movie/$movieTmdbId/videos?api_key=$apiKey&language=en-US";

    $movieVideos = Http::get($urlPtBr)?->json();


    if ($movieVideos['results'] == "" || !$movieVideos['results']) {
        $movieVideos = Http::get($urlEnUS)?->json();
    }

    $allMovieVideos = [];

    foreach ($movieVideos['results'] as $video) {
        $movieVideo = new MovieVideo();
        $movieVideo->fill($video);
        $movieVideo->movie_id = $movieId;
        $movieVideo->embeded = "https://www.youtube.com/embed/" . $video['key'];

        $publishedAt = Carbon::parse($video['published_at'])->format('Y-m-d H:i:s');
        $movieVideo->published_at = $publishedAt;

        $allMovieVideos[] = $movieVideo;
    }



    $trailers = [];
    $otherVideos = [];

    $videoTypesArray = [
        "trailers" => $trailers,
        "otherVideos" => $otherVideos
    ];

    $uniqueVideos = [];

    foreach ($allMovieVideos as $video) {
        $youtubeApiKey = env('YOUTUBE_API_KEY');

        $response = Http::get("https://www.googleapis.com/youtube/v3/videos?id={$video->key}&key=$youtubeApiKey&part=status");
        $data = json_decode($response->getBody(), true);

        $videoPrivacyStatus = $data['items'][0]['status']['privacyStatus'] ?? 'private';

        $okToGo = isset($videoPrivacyStatus) && $videoPrivacyStatus == 'public';

        if (!$okToGo) continue;

        $type = $video['type'] === "Trailer" && $video['official'] === true ? "trailers" : "otherVideos";

        if (!in_array($video['key'], $uniqueVideos)) {
            $uniqueVideos[] = $video['key'];
            $videoTypesArray[$type][] = $video;
        }
    }

    return $videoTypesArray;
}
