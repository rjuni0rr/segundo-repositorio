<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email,' . $this->user->id,
            'phone'       => 'required|min:10|max:11',
            'address'     => 'nullable|string|max:255',
            'status'      => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            // Nome
            'name.required' => 'O nome é obrigatório.',
            'name.string'   => 'O nome deve ser um texto válido.',
            'name.max'      => 'O nome pode ter no máximo 255 caracteres.',

            // Email
            'email.required' => 'O e-mail é obrigatório.',
            'email.email'    => 'Informe um e-mail válido.',
            'email.unique'   => 'Este e-mail já está cadastrado.',

            // Telefone
            'phone.required'       => 'O telefone é obrigatório.',
            'phone.digits_between' => 'O telefone deve conter 10 ou 11 números.',

            // Endereço
            'address.required' => 'O endereço é obrigatório.',
            'address.string'   => 'O endereço deve ser um texto válido.',
            'address.max'      => 'O endereço pode ter no máximo 255 caracteres.',

            // Status
            'status.required' => 'O status é obrigatório.',
            'status.boolean'  => 'O status informado é inválido.',

            // Categorias
            'category_id.required' => 'A categoria é obrigatória.',
        ];
    }
}
