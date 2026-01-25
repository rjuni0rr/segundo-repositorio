<x-layouts.auth-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">
    <div class="container">
        <h3 class="mb-4">Editar Usuário</h3>

        <form action="{{ route('manager.edit.submit', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nome</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ old('name', $user->name) }}">
                    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Telefone</label>
                    <input type="text" name="phone" class="form-control"
                           value="{{ old('phone', $user->phone) }}">
                    @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-9 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email', $user->email) }}">
                    @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="1" {{ old('status', $user->status) == 1 ? 'selected' : '' }}>Ativo</option>
                        <option value="0" {{ old('status', $user->status) == 0 ? 'selected' : '' }}>Inativo</option>
                    </select>
                    @error('status') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Endereço</label>
                    <input type="text" name="address" class="form-control"
                           value="{{ old('address', $user->address) }}">
                    @error('address') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex justify-content-end gap-2 mt-3">
                    <a href="{{ route('manager.home') }}" class="btn btn-secondary">
                        Cancelar
                    </a>
                    <button class="btn btn-primary">
                        Salvar alterações
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-layouts.auth-layout>
