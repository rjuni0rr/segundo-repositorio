<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidCpf;

class CreateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $allowedRoles = $this->allowedRoles();

        return [
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:users,email',
            'cpf'    => [
                'required',
                'unique:users,cpf',
                new ValidCpf,
            ],
            'phone'  => 'required',
            'status' => 'required|boolean',
            'password' => 'required|min:6',
            'role' => ['required', 'in:' . implode(',', $allowedRoles)],
            'birth_date' => 'required',
            'address' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            // Nome
            'name.required' => 'O seu nome é um campo obrigatório.',
            'name.string'   => 'O nome informado deve ser um texto válido.',
            'name.max'      => 'O nome pode ter no máximo 255 caracteres.',

            // Email
            'email.required' => 'O e-mail é obrigatório.',
            'email.email'    => 'Informe um e-mail válido.',
            'email.unique'   => 'Este e-mail já está cadastrado.',

            // CPF
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.digits'   => 'O CPF deve conter exatamente 11 números.',
            'cpf.unique'   => 'Este CPF já está cadastrado.',

            // Telefone
            'phone.required'       => 'O telefone é obrigatório.',
            'phone.digits_between' => 'O telefone deve conter 10 ou 11 números.',

            // Status
            'status.required' => 'O status do usuário é obrigatório.',
            'status.boolean'  => 'O status informado é inválido.',

            // Senha
            'password.required' => 'A senha é obrigatória.',
            'password.min'      => 'A senha deve ter no mínimo 6 caracteres.',

            'role.required' => 'O tipo de usuário é obrigatório.',

            // Resto faltando(incompleto)
            'birth_date.required' => 'A data de nascimento é obrigatória.',
            'address.required' => 'O Endereço é obrigatório.',
        ];
    }

    // permitir que o create seja diferente de cada usuário(admin pode criar diferentes tipos de usuários do client-admin)
    protected function allowedRoles(): array
    {
        return match (auth()->user()->role) {
            'sys-admin'    => ['sys-admin', 'client-admin', 'client-user', 'guest'],
            'client-admin' => ['client-user', 'guest'],
            default        => [],
        };
    }
}
