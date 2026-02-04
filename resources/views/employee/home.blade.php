@include('users.modals.change_pw_modal')

<x-layouts.auth-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">
    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1">
                    👋 Bem-vindo, {{ auth()->user()->name }}
                </h3>
                <p class="text-muted mb-0">
                    Aqui está o seu painel de acesso como funcionário.
                </p>
            </div>

            <span class="badge bg-primary px-3 py-2">
            {{ roleLabel(auth()->user()->role) }}
        </span>
        </div>

        <div class="row g-3 mb-4">

            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h6 class="text-muted">Status da Conta</h6>
                        <h4 class="fw-bold">
                            {!! statusLabel(auth()->user()->status) !!}
                        </h4>
                        <small class="text-muted">
                            Seu acesso está sendo monitorado pelo sistema.
                        </small>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h6 class="text-muted">Último acesso</h6>

                        <h4 class="fw-bold">
                            {{ auth()->user()->last_login
                                ? auth()->user()->last_login->format('d/m/Y H:i')
                                : 'Primeiro acesso'
                            }}
                        </h4>

                        <small class="text-muted">
                            Mantenha sua conta segura.
                        </small>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h6 class="text-muted">Ações rápidas</h6>

                        <button class="btn btn-outline-primary w-100 mb-2" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                            Alterar senha
                        </button>

                        <a href="{{ route('employee.profile') }}"
                           class="btn btn-outline-dark w-100">
                            👤 Meu Perfil
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0">
                <h5 class="fw-bold mb-0">
                    Informações da sua conta
                </h5>
            </div>

            <div class="card-body">

                <table class="table table-hover align-middle">
                    <tbody>
                    <tr>
                        <th>Email</th>
                        <td>{{ auth()->user()->email }}</td>
                    </tr>

                    <tr>
                        <th>Telefone</th>
                        <td>{{ auth()->user()->phone ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>CPF</th>
                        <td>{{ auth()->user()->cpf ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>Endereço</th>
                        <td>{{ auth()->user()->address ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>Cadastrado em</th>
                        <td>{{ auth()->user()->created_at->format('d/m/Y') }}</td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</x-layouts.auth-layout>
