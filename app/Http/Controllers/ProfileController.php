<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('layouts.profile', [
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
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ],
            [
                'name.required' => 'O nome é obrigatório.',
                'name.max'      => 'O nome deve ter no máximo 255 caracteres.',

                'phone.required' => 'O Telefone é obrigatório.',

                'address.required' => 'O Endereço é obrigatório.',
                'address.max'      => 'O Endereço deve ter no máximo 255 caracteres.',

                'profile_photo.image' => 'O arquivo deve ser uma imagem.',
                'profile_photo.mimes' => 'A foto deve ser JPG ou PNG.',
                'profile_photo.max' => 'A foto deve ter no máximo 2MB.',
            ]);

        // Upload da foto
        if ($request->hasFile('profile_photo')) {

            // apagar foto antiga caso tenha
            if ($user->profile_photo && file_exists(public_path('storage/'.$user->profile_photo))) {
                unlink(public_path('storage/'.$user->profile_photo));
            }

            $path = $request->file('profile_photo')
                ->store('profile-photos', 'public');

            $user->profile_photo = $path;
        }

        $user->update([
            'name'    => $request->name,
            'phone'   => $request->phone,
            'address' => $request->address,
        ]);

        $user->save();

        return back()->with('success', 'Perfil atualizado com sucesso!');
    }
}
