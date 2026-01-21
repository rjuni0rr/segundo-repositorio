<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $users = User::query()

            ->when($request->filled('name'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->name . '%');
            })

            ->when($request->filled('cpf'), function ($query) use ($request) {
                $cpf = preg_replace('/\D/', '', $request->cpf);
                $query->where('cpf', 'like', '%' . $cpf . '%');
            })

            ->when($request->filled('email'), function ($query) use ($request) {
                $query->where('email', 'like', '%' . $request->email . '%');
            })

            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString(); // mantem os filtros na paginação(atenção: vai retornar um paginator)


        // retorna globalmente (e cada um individual)
        $totalUsers = User::count();
        $todayUsers = User::whereDate('created_at', Carbon::today())->count();
        $monthUsers = User::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        return view('users.home', compact(
            'users',
            'totalUsers',
            'todayUsers',
            'monthUsers'
        ));
    }

    public function createUser()
    {
        return view('users.create');
    }

    public function createUserSubmit(CreateUserRequest $request)
    {
        $user = User::create([
            'name'   => $request->name,
            'email'  => $request->email,
            'cpf'    => preg_replace('/\D/', '', $request->cpf),
            'phone'  => preg_replace('/\D/', '', $request->phone),
            'status' => $request->status,
            'password' => bcrypt($request->password),
            'address' => $request->address,
            'birth_date' => $request->birth_date,
        ]);

        $user->save();

        return redirect()->route('home');
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
        return view('users.edit', compact('user'));
    }

    public function editUserSubmit(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        // Remove máscara do telefone
        $data['phone'] = preg_replace('/\D/', '', $data['phone']);

        $user->update($data);

        return redirect()
            ->route('home')
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
            ->route('home')
            ->with('success', 'Usuário excluído com sucesso');
    }


    public function exportPdf()
    {
        $users = User::all();

        $pdf = Pdf::loadView('users.pdf', compact('users'));

        return $pdf->download('usuarios.pdf');
    }


}
