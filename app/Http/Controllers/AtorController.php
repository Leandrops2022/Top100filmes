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


class AtorController extends Controller
{
    public function showDetalhesAtor($slug)
    {
        try {
            $this->logVisitor();

            $ator = Ator::where('slug', '=', $slug)->first();

            $parts = explode("-", $slug);
            $tmdb_id = end($parts);

            if (!$ator) {
                // if actor is not found in the database, but came as new data from
                // tmdb api in the now playing section, it fetches data and creates
                // a new actor record
                $actorDataArray = fetchActorData($tmdb_id);

                if (!$actorDataArray || $actorDataArray == '') {
                    return view('404.index');
                }

                $ator = new Ator();
                $ator->fill($actorDataArray);
                $ator->id = $tmdb_id;

                $ator->save();
            }
            if (actorNeedsTmdbData($ator)) {
                // in this case actor lacks some data and need some updating
                $actorDataArray =  fetchActorData($tmdb_id);
                $ator->fill($actorDataArray);
                $ator->update();
            }

            // formating date for exhibition in the brazillian pattern
            if ($ator->nascimento && Carbon::hasFormat($ator->nascimento, 'Y-m-d')) {
                $nascimento = Carbon::createFromFormat('Y-m-d', $ator->nascimento);
                $ator->nascimento = $nascimento->format('d/m/Y');
            }

            // formating date for exhibition in the brazillian pattern
            if ($ator->morte && Carbon::hasFormat($ator->morte, 'Y-m-d')) {
                $dataMorte = Carbon::createFromFormat('Y-m-d', $ator->morte);
                $ator->morte = $dataMorte->format('d/m/Y');
            }

            //the actor id has to be padded with 0 because the api can't find actors if id has few digits;
            $paddedActorId = str_pad($ator->id, 6, "0", STR_PAD_LEFT);

            $filmesEmQueAtuou = fetchAlsoWorkedOn($paddedActorId);

            foreach ($filmesEmQueAtuou as $filme) {
                $filme->poster_mobile = $filme->poster_mobile ?? 'assets/no-image.png';
                $filme->poster_fallback = $filme->poster_fallback ?? 'assets/no-image.png';
            }

            return view('ator.index')->with(['ator' => $ator, 'filmesEmQueAtuou' => $filmesEmQueAtuou]);
        } catch (Exception $e) {
            $resposta = handleException($e);
            return back()->withErrors($resposta);
        }
    }

    public function detalhesAtorRotaAntiga($id)
    {
        try {
            $ator = Ator::where('id', $id)->first();

            $tmdb_id = $id;

            if (!$ator) {
                // if actor is not found in the database, but came as new data from
                // tmdb api in the now playing section, it fetches data and creates
                // a new actor record
                $actorDataArray = fetchActorData($tmdb_id);

                if (!$actorDataArray || $actorDataArray == '') {
                    return view('404.index');
                }

                $ator = new Ator();
                $ator->fill($actorDataArray);
                $ator->id = $tmdb_id;

                $ator->save();
            }
            if (actorNeedsTmdbData($ator)) {

                // in this case actor lacks some data and need some updating
                $actorDataArray =  fetchActorData($tmdb_id);
                $ator->fill($actorDataArray);
                $ator->update();
            }


            if ($ator->nascimento && Carbon::hasFormat($ator->nascimento, 'Y-m-d')) {
                $nascimento = Carbon::createFromFormat('Y-m-d', $ator->nascimento);
                $ator->nascimento = $nascimento->format('d/m/Y');
            }

            if ($ator->morte && Carbon::hasFormat($ator->morte, 'Y-m-d')) {
                $dataMorte = Carbon::createFromFormat('Y-m-d', $ator->morte);
                $ator->morte = $dataMorte->format('d/m/Y');
            }

            //the actor id has to be padded with 0 because the api can't find actors if id has few digits;
            $paddedActorId = str_pad($ator->id, 6, "0", STR_PAD_LEFT);
            $filmesEmQueAtuou = fetchAlsoWorkedOn($paddedActorId);

            foreach ($filmesEmQueAtuou as $filme) {
                $filme->poster_mobile = $filme->poster_mobile ?? 'assets/no-image.png';
                $filme->poster_fallback = $filme->poster_fallback ?? 'assets/no-image.png';
            }

            return view('ator.index')->with(['ator' => $ator, 'filmesEmQueAtuou' => $filmesEmQueAtuou]);
        } catch (Exception $e) {
            $resposta = handleException($e);
            return back()->withErrors($resposta);
        }
    }
}
