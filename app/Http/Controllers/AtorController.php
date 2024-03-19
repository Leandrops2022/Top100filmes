<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ator;
use Exception;
use Illuminate\Support\Carbon;

use function App\HelperFunctions\actorNeedsTmdbData;
use function App\HelperFunctions\handleException;
use function App\HelperFunctions\fetchActorData;
use function App\HelperFunctions\fetchAlsoWorkedOn;
use function App\HelperFunctions\badActorDataArray;

class AtorController extends Controller
{



    public function showDetalhesAtor($slug)
    {
        try {
            $this->logVisitor();

            $parts = explode("-", $slug);
            $tmdb_id = end($parts);

            $data = $this->getActorData($tmdb_id);
            $ator = $data['ator'];
            $filmesEmQueAtuou = $data['filmesEmQueAtuou'];

            return view('ator.index')->with(['ator' => $ator, 'filmesEmQueAtuou' => $filmesEmQueAtuou]);
        } catch (Exception $e) {
            $resposta = handleException($e);
            return back()->withErrors($resposta);
        }
    }

    public function detalhesAtorRotaAntiga($id)
    {
        try {

            $tmdb_id = $id;

            $data = $this->getActorData($tmdb_id);
            $ator = $data['ator'];
            $filmesEmQueAtuou = $data['filmesEmQueAtuou'];

            return view('ator.index')->with(['ator' => $ator, 'filmesEmQueAtuou' => $filmesEmQueAtuou]);
        } catch (Exception $e) {
            $resposta = handleException($e);
            return back()->withErrors($resposta);
        }
    }

    private function updateActorData($ator, $tmdb_id)
    {
        $actorDataArray = fetchActorData($tmdb_id);

        if (!badActorDataArray($actorDataArray)) {
            $ator->fill($actorDataArray);
            $ator->save();
        }
    }

    private function createNewActor($ator, $tmdb_id)
    {
        $actorDataArray = fetchActorData($tmdb_id);

        if (badActorDataArray($actorDataArray)) {
            throw new Exception("Error Processing Request - Actor $ator is null", 1);
        } else {
            $ator = new Ator();
            $ator->fill($actorDataArray);
            $ator->id = $tmdb_id;
            $ator->save();
        }
        return $ator;
    }

    private function formatDates($ator)
    {
        foreach (['nascimento', 'morte'] as $dateField) {
            if ($ator->$dateField && Carbon::hasFormat($ator->$dateField, 'Y-m-d')) {
                $date = Carbon::createFromFormat('Y-m-d', $ator->$dateField);
                $ator->$dateField = $date->format('d/m/Y');
            }
        }
    }

    private function setFallbackPosters($filmesEmQueAtuou)
    {
        foreach ($filmesEmQueAtuou as $filme) {
            $filme->poster_mobile = $filme->poster_mobile ?? 'assets/no-image.png';
            $filme->poster_fallback = $filme->poster_fallback ?? 'assets/no-image.png';
        }
    }

    private function getActorData($tmdb_id)
    {
        $ator = Ator::where('tmdb_id', '=', $tmdb_id)->first();

        if ($ator && actorNeedsTmdbData($ator)) {
            $this->updateActorData($ator, $tmdb_id);
        } elseif (!$ator) {
            $ator = $this->createNewActor($ator, $tmdb_id);
        }

        $this->formatDates($ator);

        //the actor id has to be padded with 0 because the api can't find actors if id has few digits;
        $paddedActorId = str_pad($ator->id, 6, "0", STR_PAD_LEFT);
        $filmesEmQueAtuou = fetchAlsoWorkedOn($paddedActorId);

        $this->setFallbackPosters($filmesEmQueAtuou);

        $results = [
            "ator" => $ator,
            "filmesEmQueAtuou" => $filmesEmQueAtuou
        ];

        return $results;
    }
}
