<x-layouts.auth-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">

    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="card-title mb-4 text-center">
                    Cadastro de Usuário
                </h3>

                {{-- Mensagem de sucesso --}}
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Erros --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('manager.create.submit') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nome completo</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">CPF</label>
                        <input type="text" name="cpf" id="cpf" class="form-control" maxlength="14" placeholder="000.000.000-00" value="{{ old('cpf') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">E-mail</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label class="form-label">Senha</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="col-6">
                            <label class="form-label">Confirmar senha</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Endereço</label>
                        <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <label class="form-label">Telefone</label>
                            <input type="text" name="phone" id="phone" class="form-control" maxlength="15" placeholder="(00) 00000-0000" value="{{ old('phone') }}">
                        </div>

                        <div class="col-4">
                            <label class="form-label">Data de nascimento</label>
                            <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date') }}">
                        </div>

                        <div class="col-4 mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="1" {{ old('status', $user->status ?? 1) == 1 ? 'selected' : '' }}>
                                    Ativo
                                </option>
                                <option value="0" {{ old('status', $user->status ?? 1) == 0 ? 'selected' : '' }}>
                                    Inativo
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Categoria</label>
                        <select name="role" class="form-select">
                            <option value="">Selecione</option>
                            <option value="client-user" {{ old('role') === 'client-user' ? 'selected' : '' }}>Funcionário</option>
                            <option value="guest" {{ old('role') === 'client-user' ? 'selected' : '' }}>Visitante</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Salvar
                    </button>
                    <hr>
                    <a href="{{ route('manager.home') }}" class="btn btn-secondary w-100">
                        Voltar
                    </a>

                </form>

            </div>
        </div>
    </div>
    <script>
        document.getElementById('cpf').addEventListener('input', function (e) {
            let value = e.target.value;

            // Remove tudo que não for número
            value = value.replace(/\D/g, '');

            // Limita a 11 dígitos
            value = value.substring(0, 11);

            // Aplica a máscara
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

            e.target.value = value;
        });

        document.getElementById('phone').addEventListener('input', function (e) {
            let value = e.target.value;

            // Remove tudo que não for número
            value = value.replace(/\D/g, '');

            // Limita a 11 dígitos
            value = value.substring(0, 11);

            // Aplica DDD
            if (value.length > 2) {
                value = value.replace(/^(\d{2})(\d)/g, '($1) $2');
            }

            // Celular (9 dígitos) ou fixo (8 dígitos)
            if (value.length === 14) {
                value = value.replace(/(\d{5})(\d{4})$/, '$1-$2');
            } else {
                value = value.replace(/(\d{4})(\d{4})$/, '$1-$2');
            }

            e.target.value = value;
        });


    </script>
</x-layouts.auth-layout>
