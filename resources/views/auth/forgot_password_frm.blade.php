<x-layouts.guest-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">

    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-4">
                <div class="card-body">
                    <form method="POST" action="{{ route('password.email') }}" class="card p-4">
                        @csrf

                        <h5 class="mb-3">Esqueci minha senha</h5>
                        @if (session('status'))
                            <div class="alert alert-success mt-3">
                                {{ session('status') }}
                            </div>
                        @endif
                        <input type="email"
                               name="email"
                               class="form-control mb-3"
                               placeholder="Digite seu email"
                               required>

                        <button class="btn btn-primary w-100">
                            Enviar link
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
