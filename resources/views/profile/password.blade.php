<x-layouts.auth-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">

    <div class="container mt-4" style="max-width: 500px">

        <h4 class="mb-3">Trocar Senha</h4>

        {{-- mensagens --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger fst-italic">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Senha atual</label>
                <input type="password" name="current_password" class="form-control">
            </div>

            <div class="mb-3">
                <label>Nova senha</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="mb-3">
                <label>Confirmar nova senha</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <button class="btn btn-primary">Salvar</button>
        </form>

    </div>
</x-layouts.auth-layout>
