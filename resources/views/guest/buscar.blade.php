<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Busca de Produtos</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">

    <h1 class="text-center mb-4">
        🔎 Comparador de Preços
    </h1>

    <!-- Form -->
    <form action="{{ route('produto.buscar') }}" method="POST" class="d-flex gap-2">
        @csrf
        <input type="text"
               name="produto"
               class="form-control"
               placeholder="Digite um produto... Ex: ps5, iphone 15"
               required>

        <button class="btn btn-primary">
            Buscar
        </button>
    </form>
    <a href="{{ route('guest.home') }}" class="btn btn-dark">Voltar</a>

    <!-- Mensagem erro -->
    @if(session("erro"))
        <div class="alert alert-danger mt-4">
            {{ session("erro") }}
        </div>
    @endif

    <!-- Resultado -->
    @isset($melhor)

        <div class="card shadow mt-5">
            <div class="card-body">

                <h4>🥇 Melhor oferta encontrada:</h4>

                <p class="mt-3">
                    <strong>Produto:</strong> {{ $melhor["title"] }}
                </p>

                <p>
                    <strong>Loja:</strong> {{ $melhor["source"] }}
                </p>

                <p>
                    <strong>Preço:</strong>
                    <span class="text-success fw-bold">
                        {{ $melhor["price"] }}
                    </span>
                </p>

                <a href="{{ $melhor["product_link"] }}"
                   target="_blank"
                   class="btn btn-success">
                    🛒 Comprar agora
                </a>

            </div>
        </div>

    @endisset

</div>

</body>
</html>
