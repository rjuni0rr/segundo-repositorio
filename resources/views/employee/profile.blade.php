<x-layouts.auth-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">
    <div class="container py-4">

        <!-- Header -->
        <div class="mb-4">
            <h3 class="fw-bold">👤 Meu Perfil</h3>
            <p class="text-muted">
                Aqui você pode atualizar suas informações pessoais.
            </p>
        </div>

        <!-- Alert sucesso -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Alert erros -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Card -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">

                <form method="POST" action="{{ route('employee.profile.update') }}">
                    @csrf

                    <!-- Nome -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nome</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ old('name', $user->name) }}"
                               required>
                    </div>

                    <!-- Email (somente leitura) -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email"
                               class="form-control bg-light"
                               value="{{ $user->email }}"
                               disabled>
                        <small class="text-muted">
                            O email não pode ser alterado.
                        </small>
                    </div>

                    <!-- Telefone -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Telefone</label>
                        <input type="text"
                               name="phone"
                               class="form-control"
                               value="{{ old('phone', $user->phone) }}"
                               placeholder="(00) 00000-0000">
                    </div>

                    <!-- Endereço -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Endereço</label>
                        <input type="text"
                               name="address"
                               class="form-control"
                               value="{{ old('address', $user->address) }}"
                               placeholder="Rua, número, bairro...">
                    </div>

                    <!-- Botões -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('employee.home') }}"
                           class="btn btn-outline-secondary">
                            Voltar
                        </a>

                        <button type="submit" class="btn btn-primary px-4">
                            Salvar alterações
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</x-layouts.auth-layout>
