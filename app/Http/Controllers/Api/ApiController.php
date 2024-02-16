<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Ator;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use function App\HelperFunctions\handleException;

class ApiController extends Controller
{
    public function teste($id)
    {
        try {
            $ator = Ator::find($id);

            if ($ator->nascimento && Carbon::hasFormat($ator->nascimento, 'Y-m-d')) {
                $nascimento = Carbon::createFromFormat('Y-m-d', $ator->nascimento);
                $ator->nascimento = $nascimento->format('d/m/y');
            }

            if ($ator->morte && Carbon::hasFormat($ator->morte, 'Y-m-d')) {
                $dataMorte = Carbon::createFromFormat('Y-m-d', $ator->morte);
                $ator->morte = $dataMorte->format('d/m/y');
            }

            $ator->imagem = $ator->imagem ?? 'assets/no-photo.png';
            $ator->imagem_fallback = $ator->imagem_fallback ?? 'assets/no-photo.png';

            $filmesEmQueAtuou = DB::table('filmes_em_que_atuou')->where('id_ator', $ator->id)->orderBy('nota', 'desc')->get();

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
