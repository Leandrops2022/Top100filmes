<?php

namespace App\Http\Controllers;

use App\Events\SendUserContactEMail;

use App\Http\Controllers\Controller;

use App\Http\Requests\MailFormRequest;

use Exception;

use Illuminate\Support\Carbon;

use function App\HelperFunctions\handleException;


class MailController extends Controller
{
    public function contatoUsuario(MailFormRequest $request)
    {
        try {
            $now = now();
            $birthDate = Carbon::createFromDate($request->birthdate);
            $age = $birthDate->diffInYears($now);

            SendUserContactEMail::dispatch(
                $request->name,
                $age,
                $request->contactType,
                $request->message
            );

            return to_route('contato')->with('mensagemSucesso', 'E-mail enviado com sucesso');
        } catch (Exception $e) {
            $resposta = handleException($e);
            return back()->withErrors($resposta);
        }
    }
}
