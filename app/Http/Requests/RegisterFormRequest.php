<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class RegisterFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $maxBirthDate = Carbon::now()->subYears(16);
        $minBirthDate = Carbon::now()->subYears(100);

        return [
            'name' => 'string|required|between:5,70',
            'birth_date' => "date|between:$minBirthDate,$maxBirthDate",
            'sex' => 'string',
            'email' => 'required|email|max:70',
            'password' => 'required|between:4,255|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'name.alpha' => 'O nome deve conter apenas letras',
            'name.required' => 'Você deve informar o seu nome',
            'name.between' => 'O nome deve conter no mínimo 5 e no máximo 100 letras',
            'birth_date.required' => 'Você deve informar sua data de nascimento',
            'birth_date.date' => 'Você deve informar uma data válida',
            'birth_date.between' => 'Você deve no mínimo 16 anos para se cadastrar',
            'sex.alpha' => 'Apenas letras são permitidas no campo sexo',
            'sex.required' => 'é necessário informar o sexo',
            'email.required' => 'Você deve informar um e-mail válido',
            'email.email' => 'Formato de e-mail inválido',
            'email.max' => 'O email deve ter no máximo 70 caracteres',
            'password.required' => 'Informe sua senha',
            'password.between' => 'A senha deve conter no mínimo 4 e no máximo 255 caracteres(letras, símbolos ou numeros)',
            'password.confirmed' => 'As senhas informadas não são iguais'
        ];
    }
}
