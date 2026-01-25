<x-layouts.auth-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">

    @include('manager.modals.show_modal')
    @include('manager.modals.delete_modal')

    @vite([
        'resources/js/users/show.js',
        'resources/js/users/delete.js'
    ])
    <nav class="navbar navbar-dark bg-primary mb-4">
        <div class="container-fluid">
            <span class="navbar-brand">Painel do Manager</span>
            <a href="{{ route('logout') }}" class="btn btn-secondary btn-sm">Sair</a>
        </div>
    </nav>
    <div class="container">
        <h4 class="mb-3">Usuários sob sua gestão</h4>
        <a href="{{ route('manager.create') }}" class="btn btn-dark btn-sm">+ Novo usuário</a>

        <table class="table table-bordered table-striped" id="usersTable">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Função</th>
                <th>Status</th>
                <th width="180">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ roleLabel($user->role) }}</td>
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
                            <a href="{{ route('manager.edit', $user) }}" class="btn btn-outline-primary" title="Editar"><i class="fa-regular fa-pen-to-square"></i></a>
                            <button class="btn btn-outline-danger" onclick="confirmDeleteUser('{{ Crypt::encryptString($user->id) }}')"><i class="fa-regular fa-trash-can"></i></button>
                            <a href="{{ route('users.export.pdf') }}" class="btn btn-outline-success"><i class="fa-solid fa-file"></i></a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#usersTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json'
                },
                pageLength: 10,
                lengthChange: false,
                ordering: true
            });
        });
    </script>
</x-layouts.auth-layout>
