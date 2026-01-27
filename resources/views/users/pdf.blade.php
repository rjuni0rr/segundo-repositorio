<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Usuários</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #000;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        table th,
        table td {
            border: 1px solid #333;
            padding: 6px;
            vertical-align: top;
        }

        table th {
            background-color: #f0f0f0;
            text-align: left;
            font-weight: bold;
        }

        .footer {
            position: fixed;
            bottom: 0;
            text-align: center;
            font-size: 10px;
            width: 100%;
        }
    </style>
</head>
<body>

    <h1>Relatório de Usuários</h1>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Status</th>
            <th>Último Login</th>
            <th>Data Nascimento</th>
            <th>Telefone</th>
            <th>CPF</th>
            <th>Endereço</th>
            <th>Função</th>
            <th>Criado em</th>
            <th>Atualizado em</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>

                <td>{{ $user->name }}</td>

                <td>{{ $user->email }}</td>

                <td>{{ $user->status }}</td>

                <td>
                    {{ $user->last_login
                        ? $user->last_login->format('d/m/Y H:i')
                        : '-' }}
                </td>

                <td>
                    {{ $user->birth_date
                        ? \Carbon\Carbon::parse($user->birth_date)->format('d/m/Y')
                        : '-' }}
                </td>

                <td>
                    {{ formatPhone($user->phone) ?? '-' }}
                </td>

                <td>
                    {{ formatCpf($user->cpf) ?? '-' }}
                </td>

                <td>
                    {{ $user->address ?? '-' }}
                </td>

                <td>
                    {{ roleLabel($user->role) }}
                </td>

                <td>
                    {{ $user->created_at->format('d/m/Y H:i') }}
                </td>

                <td>
                    {{ $user->updated_at->format('d/m/Y H:i') }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="footer">
        Gerado em {{ now()->format('d/m/Y H:i') }}
    </div>

</body>
</html>
