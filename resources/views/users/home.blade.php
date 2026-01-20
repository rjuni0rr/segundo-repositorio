<x-layouts.auth-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">

    @include('users.modals.show_modal')
    @include('users.modals.delete_modal')

    @vite([
        'resources/js/users/show.js',
        'resources/js/users/delete.js'
    ])

    <div class="container-fluid mt-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>Gestão de usuários</h4>
            <a href="{{ route('user.create') }}" class="btn btn-dark btn-sm">+ Novo usuário</a>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <small class="text-muted">Total de usuários</small>
                        <h4 class="fw-bold">{{ $data['total_users'] }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <small class="text-muted">Cadastrados hoje</small>
                        <h4 class="fw-bold">{{ $data['total_users_day'] }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <small class="text-muted">Cadastrados no mês</small>
                        <h4 class="fw-bold">{{ $data['total_users_month'] }}</h4>
                    </div>
                </div>
            </div>
        </div>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table id="usersTable" class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Data de cadastro</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone_formatted ?? '-' }}</td>
                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                            <td>
                                @if ($user->status)
                                    <span class="badge bg-success">Ativo</span>
                                @else
                                    <span class="badge bg-secondary">Inativo</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-secondary" onclick="showUser('{{ Crypt::encryptString($user->id) }}')"><i class="fa-solid fa-bars"></i></button>
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-primary" title="Editar"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <button class="btn btn-outline-danger" onclick="confirmDeleteUser('{{ Crypt::encryptString($user->id) }}')"><i class="fa-regular fa-trash-can"></i></button>
                                    <a href="{{ route('users.export.pdf') }}" class="btn btn-outline-success"><i class="fa-solid fa-file"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function () {
            $('#usersTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.8/i18n/pt-BR.json'
                }
            });
        });

    </script>
</x-layouts.auth-layout>
