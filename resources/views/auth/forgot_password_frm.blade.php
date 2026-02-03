<x-layouts.guest-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">

    <div class="container">
        <div class="min-vh-100 d-flex align-items-center justify-content-center bg-light">
            <div class="card shadow-sm border-0" style="width: 420px;">
                <div class="card-body p-4">

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="text-center mb-4">
                            <div class="mb-2">
                                <i class="bi bi-shield-lock fs-1 text-primary"></i>
                            </div>
                            <h4 class="fw-bold">Esqueceu a senha?</h4>
                            <small class="text-muted">
                                Informe seu e-mail para continuar
                            </small>
                        </div>

                        {{-- Caso ocorra erros --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Caso esteja tudo ok --}}
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" name="email" class="form-control mb-3" placeholder="Digite seu email">
                        </div>

                        <button class="btn btn-primary w-100 py-2 fw-semibold">
                            Enviar link
                        </button>
                        <hr>
                        <a href="{{ route('login') }}" class="btn btn-secondary w-100 py-2 fw-semibold">
                            Cancelar
                        </a>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layouts.guest-layout>
