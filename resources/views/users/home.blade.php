<x-layouts.auth-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">

    @include('users.modals.show_modal')
    @include('users.modals.delete_modal')

    @vite([
        'resources/js/users/show.js',
        'resources/js/users/delete.js'
    ])

    <div class="container-fluid mt-4">

        {{--   Dashboard     --}}
        @include('layouts.dashboard')

        <div class="row justify-content-center g-4 my-4">
            <div class="col-md-3">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <small class="text-muted">Total de usuários</small>
                        <h4 class="fw-bold">{{ $totalUsers  }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <small class="text-muted">Cadastrados hoje</small>
                        <h4 class="fw-bold">{{ $todayUsers }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <small class="text-muted">Cadastrados no mês</small>
                        <h4 class="fw-bold">{{ $monthUsers }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table id="usersTable" class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Função</th>
                        <th>Último acesso</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ roleLabel($user->role) }}</td>
                            <td>{{ formatLastLogin($user->last_login) }}</td>
                            <td>
                                @if ($user->status)
                                    <span class="badge bg-success">Ativo</span>
                                @else
                                    <span class="badge bg-secondary">Inativo</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-outline-secondary"
                                            onclick="showUser('{{ Crypt::encryptString($user->id) }}')"><i
                                            class="fa-solid fa-bars"></i></button>
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-primary"
                                       title="Editar"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <button class="btn btn-outline-danger"
                                            onclick="confirmDeleteUser('{{ Crypt::encryptString($user->id) }}')"><i
                                            class="fa-regular fa-trash-can"></i></button>
                                    <a href="{{ route('users.export.pdf') }}" class="btn btn-outline-success"><i
                                            class="fa-solid fa-file"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>

    </div>

    {{--  Datatables  --}}
    <script>
        $(document).ready(function () {
            $('#usersTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.8/i18n/pt-BR.json'
                },
                pageLength: 10,
                lengthChange: false,
                ordering: true,
                searching: false,
                paging: false,
                info: false
            });
        });

    </script>
</x-layouts.auth-layout>
