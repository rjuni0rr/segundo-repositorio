<!DOCTYPE html>
<html>
    <head>
        <style>
            body { font-family: DejaVu Sans; font-size: 12px; }
            table { width: 100%; border-collapse: collapse; }
            th, td { border: 1px solid #ccc; padding: 6px; }
            th { background: #f5f5f5; }
        </style>
    </head>
    <body>

        <h3>Lista de Usuários</h3>

        <table>
            <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ formatCpf($user->cpf) }}</td>
                    <td>{{ formatPhone($user->phone) }}</td>
                    <td>{{ userStatus($user->status) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </body>
</html>
