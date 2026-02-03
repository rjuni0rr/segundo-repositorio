<x-layouts.guest-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">

    <div class="container">
        <div class="min-vh-100 d-flex align-items-center justify-content-center bg-light">

            <div class="card shadow-sm border-0" style="width: 420px;">
                <div class="card-body p-4">

                    <div class="text-center mb-4">
                        <div class="mb-2">
                            <i class="bi bi-shield-lock fs-1 text-primary"></i>
                        </div>
                        <h4 class="fw-bold">Acesso ao Sistema</h4>
                        <small class="text-muted">
                            Informe suas credenciais para continuar
                        </small>
                    </div>
                    {{--  Senha resetada  --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    {!! showServerError() !!}
                    <form method="POST" action="{{ route('login.submit') }}" novalidate>

                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <div class="input-group">
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"  placeholder="seu@email.com" required>
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Senha</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="********" required>
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <button class="btn btn-primary w-100 py-2 fw-semibold">
                            Entrar
                        </button>
                        <div class="text-center mt-3">
                            <a href="{{ route('password.request') }}" class="small text-decoration-none">
                                Esqueci minha senha
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</x-layouts.guest-layout>
