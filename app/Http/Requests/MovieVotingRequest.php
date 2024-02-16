<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class MovieVotingRequest extends FormRequest
{
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

        return [
            'nota' => 'int|required|between:1,10',
        ];
    }

    public function messages()
    {
        return [
            'nota.int' => 'A nota deve ser um valor inteiro',
            'nota.required' => 'Você deve informar uma nota para votar',
            'nota.between' => 'A nota deve ser um numero inteiro entre 1 e 10'
        ];
    }
}
