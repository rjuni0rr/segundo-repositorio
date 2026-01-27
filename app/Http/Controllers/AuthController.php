<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login_frm');
    }

    public function loginSubmit(Request $request)
    {
        // form validation
        $request->validate(
        // rules for validation
            [
                'email' => 'required|email',
                'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{6,16}$/'
            ],
            // error messages
            [
                'email.required' => 'O usuário é obrigatório.',
                'email.email' => 'O usuário deve ser um e-mail válido.',
                'password.required' => 'A senha é obrigatória.',
                'password.regex' => 'A senha deve conter entre 6 e 16 caracteres, ter uma maiúscula, uma minúscula e um algarismo.'
            ]
        );

        // user authentication
        $user = User::where('email', trim($request->email))
            ->whereNull('deleted_at')
            ->first();

        // check if user exists and password matches
        if ($user && Hash::check(trim($request->password), $user->password)){
            // check if user belongs to an active company (except admin)
            if ($user->role !== 'sys-admin' && ($user->status != 1)){
                return redirect()->back()->withInput()->with('server_error', 'Login inválido.');
            }
            // login user
            $this->loginUser($user);

            // redirect
            return $this->redirectByRole();
        } else {
            // login failed
            return redirect()
                ->back()
                ->withInput()
                ->with('server_error', 'Login inválido.');
        }

    }

    private function loginUser($user)
    {
        // update last login and resets other fields
        $user->last_login = now();
        $user->save();

        // place user in session
        auth()->login($user);
    }

    public function logout()
    {
        // logout
        auth()->logout();

        // invalidate session - clear all session data
        session()->invalidate();

        // regenerate session token
        session()->regenerateToken();

        return redirect()->route('login');
    }

    protected function redirectByRole()
    {
        $role = auth()->user()->role;

        return match ($role) {
            'sys-admin'     => redirect()->route('user.home'),
            'client-admin'  => redirect()->route('manager.home'),
            'client-user'   => redirect()->route('employee.home'),
            'guest'         => redirect()->route('guest.home'),
            default         => redirect()->route('login'),
        };
    }

}
