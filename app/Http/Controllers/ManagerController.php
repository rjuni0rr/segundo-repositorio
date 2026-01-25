<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;


class ManagerController extends Controller
{
    public function index()
    {
        $users = User::whereIn('role', ['client-user', 'guest'])
            ->orderBy('name')
            ->get();

        return view('manager.home', compact('users'));
    }

    public function createUser()
    {
        return view('manager.create');
    }

    public function createUserSubmit(CreateUserRequest $request)
    {
        $data = $request->validated();

        $data['cpf'] = preg_replace('/\D/', '', $data['cpf']);
        $data['phone'] = preg_replace('/\D/', '', $data['phone']);

        User::create($data);

        return redirect()
            ->route('manager.home')
            ->with('success', 'Usuário criado com sucesso.');
    }



    public function show(string $id)
    {
        try {
            $userId = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            abort(404);
        }

        $user = User::findOrFail($userId);

        return response()->json([
            'name'  => $user->name,
            'email' => $user->email,
            'phone' => $user->phone_formatted,
            'cpf'   => $user->cpf_formatted ?? null,
            'created_at' => $user->created_at->format('d/m/Y H:i'),
        ]);
    }


    public function editUser(User $user)
    {
        return view('manager.edit', compact('user'));
    }

    public function editUserSubmit(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        $data['phone'] = preg_replace('/\D/', '', $data['phone']);

        $user->update($data);

        return redirect()
            ->route('manager.home')
            ->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        try {
            $userId = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            abort(404);
        }

        $user = User::findOrFail($userId);
        $user->delete(); // ou soft delete

        return redirect()
            ->route('manager.home')
            ->with('success', 'Usuário excluído com sucesso');
    }

}
