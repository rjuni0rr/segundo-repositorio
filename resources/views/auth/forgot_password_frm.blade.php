<x-layouts.guest-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">

    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-4">
                <div class="card-body">
                    <form method="POST" action="{{ route('password.email') }}" class="card p-4">
                        @csrf

                        <h5 class="text-center mb-4">Esqueci minha senha</h5>

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

                        <input type="text" name="email" class="form-control mb-3" placeholder="Digite seu email">

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
