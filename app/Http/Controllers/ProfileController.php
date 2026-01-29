<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function updatePassword()
    {
        return view('profile.password');
    }

    public function updatePasswordSubmit(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
            ],
        ], [
            'current_password.required' => 'A senha atual é obrigatória.',
            'password.required' => 'A nova senha é obrigatória.',
            'password.confirmed' => 'A confirmação da senha não confere.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'password.regex' => 'A senha deve conter ao menos uma letra maiúscula e um número.',
        ]);

        $user = auth()->user();

        if (! Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'A senha atual está incorreta.',
            ]);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('user.home')
            ->with('success', 'Senha atualizada com sucesso!');

    }
}
