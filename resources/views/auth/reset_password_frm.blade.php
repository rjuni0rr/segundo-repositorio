<x-layouts.guest-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">

    <div class="container">
        <div class="min-vh-100 d-flex align-items-center justify-content-center bg-light">
            <div class="card shadow-sm border-0" style="width: 420px;">
                <div class="card-body p-4">

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="email" value="{{ $email }}">

                        <h5 class="text-center mb-3">Configurar nova senha</h5>

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

                        <div class="mb-3">
                            <input type="password" name="password" class="form-control mb-2" placeholder="Nova senha">
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password_confirmation" class="form-control mb-3" placeholder="Confirmar nova senha">
                        </div>

                        <button class="btn btn-success w-100 py-2 fw-semibold">
                            Redefinir senha
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
