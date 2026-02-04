<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class editProfileController extends Controller
{
    public function profile()
    {
        return view('employee.profile', [
            'user' => auth()->user(),
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ], [
            'name.required' => 'O nome é obrigatório.',
            'phone.required' => 'O Telefone é obrigatório.',
            'address.required' => 'O Endereço é obrigatório.',

            'name.max'      => 'O nome deve ter no máximo 255 caracteres.',
            'address.max'      => 'O Endereço deve ter no máximo 255 caracteres.',
        ]);

        $user->update([
            'name'    => $request->name,
            'phone'   => $request->phone,
            'address' => $request->address,
        ]);

        return back()->with('success', 'Perfil atualizado com sucesso!');
    }
}
