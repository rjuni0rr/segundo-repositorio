<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
</head>
<body>
    <form action="{{ route('user.create.submit') }}" method="POST" novalidate>

        @csrf

        <input type="hidden" name="hidden_hash_code" value="">

        <div class="mb-4">
            <label for="name" class="label">Nome da fila</label>
            <input type="text" name="name" placeholder="Nome completo" class="w-full p-2 border rounded" value="{{ old('name') }}">
        </div>

        <div class="mb-4">
            <label for="email" class="label">Email</label>
            <input type="email" name="email" placeholder="E-mail" class="w-full p-2 border rounded" value="{{ old('email') }}">
        </div>

        <div class="flex gap-4 mb-4">
            <div class="w-1/2">
                <label for="password" class="label">Senha</label>
                <input type="password" name="password" placeholder="Senha" class="w-full p-2 border rounded">
            </div>

            <div class="w-1/2">
                <label for="password_confirmation" class="label">Confirmar senha</label>
                <input type="password" name="password_confirmation" placeholder="Confirmar senha" class="w-full p-2 border rounded">
            </div>
        </div>

        <div class="flex gap-4 mb-4">
            <div class="w-1/2">
                <label for="phone" class="label">Teleone</label>
                <input type="text" name="phone" placeholder="Telefone" class="w-full p-2 border rounded" value="{{ old('phone') }}">
            </div>
            <div class="w-1/2">
                <label for="birth_date" class="label">Data de nascimento</label>
                <input type="date" name="birth_date" class="w-full p-2 border rounded" value="{{ old('birth_date') }}">
            </div>
        </div>

        <div class="flex gap-4 mb-4">
            <div class="w-1/2">
                <label for="cpf" class="label">CPF</label>
                <input type="text" name="cpf" placeholder="CPF" class="w-full p-2 border rounded" value="{{ old('cpf') }}">
            </div>
            <div class="w-1/2">
                <label for="address" class="label">Endereço</label>
                <input type="text" name="address" placeholder="Endereço" class="w-full p-2 border rounded" value="{{ old('address') }}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check me-2"></i>Criar nova fila</button>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
