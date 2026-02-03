<x-layouts.guest-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-4">
                <div class="card-body">
                    <form id="changePasswordForm" method="POST" action="{{ route('password.update') }}" class="card p-4">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="email" value="{{ $email }}">

                        <h5 class="text-center mb-3">Redefinir senha</h5>

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

                        <input type="password" name="password" class="form-control mb-2" placeholder="Nova senha">
                        <input type="password" name="password_confirmation" class="form-control mb-3" placeholder="Confirmar nova senha">

                        <button class="btn btn-success w-100">
                            Salvar nova senha
                        </button>
                        <hr>
                        <a href="{{ route('login') }}" class="btn btn-secondary">
                            Cancelar
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layouts.guest-layout>
