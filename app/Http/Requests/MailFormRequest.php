<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailFormRequest extends FormRequest
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
        return [
            'name' => 'string|required|between:5,100',
            'birthdate' => 'required|date',
            'email' => 'required|email',
            'contactType' => 'required|string',
            'message' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'contactType.required' => 'Você deve informar o motivo do contato',
            'message.required' => 'Você deve digitar algo no campo "mensagem"',
        ];
    }
}
