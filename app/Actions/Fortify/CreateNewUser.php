<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use App\Models\ListaDoUsuario;
use Illuminate\Cookie\CookieJar;


class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;


    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {

        $maxBirthDate = Carbon::now()->subYears(16)->toDateString();
        $minBirthDate = Carbon::now()->subYears(100)->toDateString();

        Validator::make($input, [
            'name' => ['required', 'string', 'regex:/^[A-Za-z\s\'\-]+$/', 'between:5,70'],
            'email' => ['required', 'string', 'email', 'max:70', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $newUser = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'sex' => $input['sex'],
            'birth_date' => $input['birth_date'],
            'password' => Hash::make($input['password']),
        ]);

        $novaLista = ListaDoUsuario::create([
            'id_usuario' => $newUser->id,
            'nome_da_lista' => 'O que assistir'
        ]);

        $idListaUsuario = $novaLista->id;
        session(['idListaUsuario' => $idListaUsuario]);


        return $newUser;
    }
}
