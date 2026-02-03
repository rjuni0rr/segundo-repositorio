<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class PasswordController extends Controller
{
    public function forgetPassword()
    {
        return view('auth.forgot_password_frm');
    }

    public function forgetPasswordSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'Informe um email válido.',
            'email.exists' => 'O Email que foi inserido não foi encontrado.',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return back()->with(
            'status',
            'Um link foi enviado para a sua caixa de mensagens.'
        );
    }


    public function resetPassword(Request $request, string $token)
    {
        return view('auth.reset_password_frm', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function resetPasswordSubmit(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
            ],
        ], [
            'password.required' => 'A nova senha é obrigatória.',
            'password.confirmed' => 'A confirmação da senha não confere.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'password.regex' => 'A senha deve conter ao menos uma letra maiúscula e um número.',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'Senha redefinida com sucesso.')
            : back()->withErrors(['email' => 'Token inválido ou expirado.']);
    }

}
