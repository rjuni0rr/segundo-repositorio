<?php

namespace App\Http\Controllers\RolesController;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Category;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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
            'monthUsers',
        ));
    }

    public function createUser()
    {
        return view('users.create');
    }

    public function createUserSubmit(CreateUserRequest $request)
    {
        $data = $request->validated();

        $data['cpf'] = preg_replace('/\D/', '', $data['cpf']);
        $data['phone'] = preg_replace('/\D/', '', $data['phone']);

        User::create($data);

        return redirect()
            ->route('user.home')
            ->with('success', 'Usuário cadastrado com sucesso.');
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
            'phone' => formatPhone($user->phone),
            'cpf'   => formatCpf($user->cpf),
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
            ->route('user.home')
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
            ->back()
            ->with('success', 'Usuário excluído com sucesso');
    }

    public function exportPdf()
    {
        $users = User::all();

        $pdf = Pdf::loadView('users.pdf', compact('users'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('relatorio_geral.pdf');
    }

    public function statistics()
    {
        $data = [
            'subtitle' => 'Estatísticas',
            'statsUsers' => $this->getUsersCount(),
        ];

        return view('users.statistics', $data);
    }

    private function getUsersCount()
    {
        // retorna globalmente (e cada um individual)
        $totalUsers = User::withTrashed()->count();
        $todayUsers = User::whereDate('created_at', Carbon::today())->count();
        $monthUsers = User::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // retorna se estão ativos/inativos
        $totalActive = User::where('status', 1)->whereNull('deleted_at')->count();
        $totalInactive = User::withTrashed()->where(function ($query){
            $query->where('status', 0)->orWhereNotNull('deleted_at');
        })->count();

        return [
            'total' => $totalUsers,
            'todayUsers' => $todayUsers,
            'monthUsers' => $monthUsers,
            'active' => $totalActive,
            'inactive' => $totalInactive,
        ];

    }
}
