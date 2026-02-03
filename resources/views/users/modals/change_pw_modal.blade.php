<div class="modal fade" id="changePasswordModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form id="changePasswordForm" action="{{ route('password.update.submit') }}">

                <meta name="csrf-token" content="{{ csrf_token() }}">
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Alterar senha de usuário</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    {{-- Erros --}}
                    <div id="passwordAlert"></div>
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
                        <label>Senha atual</label>
                        <input
                            type="password"
                            name="current_password"
                            class="form-control"
                            required>
                    </div>

                    <div class="mb-3">
                        <label>Nova senha</label>
                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            required>
                    </div>

                    <div class="mb-3">
                        <label>Confirmar nova senha</label>
                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control"
                            required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button class="btn btn-primary">
                        Salvar senha
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>

    document.getElementById('changePasswordForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const form = this;
        const alertBox = document.getElementById('passwordAlert');

        alertBox.innerHTML = '';
        // Usando fetch
        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: new FormData(form)
        })
            .then(async response => {
                const data = await response.json();

                if (!response.ok) {
                    throw data;
                }

                alertBox.innerHTML = `
            <div class="alert alert-success">
                ${data.message}
            </div>
        `;

                // logout ocorrendo
                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 3000);
            })
            // Aqui estão todas as validações de erro, inclusive as que vem do meu controller
            .catch(error => {
                let messages = '';

                if (error.errors) {
                    Object.values(error.errors).forEach(fieldErrors => {
                        fieldErrors.forEach(msg => {
                            messages += `<li>${msg}</li>`;
                        });
                    });
                } else if (error.message) {
                    messages = `<li>${error.message}</li>`;
                } else {
                    messages = `<li>Erro inesperado. Tente novamente.</li>`;
                }

                alertBox.innerHTML = `
        <div class="alert alert-danger fst-italic">
            <ul class="mb-0">${messages}</ul>
        </div>
    `;
            });
    });

</script>

