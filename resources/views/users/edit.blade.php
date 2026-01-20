<x-layouts.auth-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">
    <div class="container mt-4">

        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Editar Usuário</h5>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('users.edit.submit', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nome</label>
                            <input type="text"
                                   name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $user->name) }}">

                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-md-6 mb-3">
                            <label class="form-label">E-mail</label>
                            <input type="email"
                                   name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', $user->email) }}">

                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-md-6 mb-3">
                            <label class="form-label">Telefone</label>
                            <input type="text"
                                   name="phone"
                                   id="phone"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   value="{{ old('phone', $user->phone) }}">

                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-md-6 mb-3">
                            <label class="form-label">Endereço</label>
                            <input type="text"
                                   name="address"
                                   class="form-control @error('address') is-invalid @enderror"
                                   value="{{ old('address', $user->address) }}">

                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-md-4 mb-3">
                            <label class="form-label">Status</label>
                            <select name="status"
                                    class="form-select @error('status') is-invalid @enderror">
                                <option value="1" {{ old('status', $user->status) == 1 ? 'selected' : '' }}>
                                    Ativo
                                </option>
                                <option value="0" {{ old('status', $user->status) == 0 ? 'selected' : '' }}>
                                    Inativo
                                </option>
                            </select>

                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('home') }}" class="btn btn-secondary">
                            Cancelar
                        </a>
                        <button class="btn btn-primary">
                            Salvar alterações
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const phone = document.getElementById('phone');
            if (!phone) return;

            function applyMask(value) {
                value = value.replace(/\D/g, '');

                if (value.length <= 10) {
                    return value.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3');
                }

                return value.replace(/(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3');
            }

            // Aplica máscara ao carregar
            phone.value = applyMask(phone.value);

            // Aplica máscara ao digitar
            phone.addEventListener('input', () => {
                phone.value = applyMask(phone.value);
            });

            // Remove máscara antes do submit
            phone.form.addEventListener('submit', () => {
                phone.value = phone.value.replace(/\D/g, '');
            });
        });
    </script>

</x-layouts.auth-layout>
