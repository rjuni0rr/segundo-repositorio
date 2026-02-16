<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Resultado da Busca</title>

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
              rel="stylesheet">

        <style>
            body {
                background: #f8f9fa;
            }

            .best-offer {
                border-radius: 20px;
                border: 2px solid #198754;
                background: #ffffff;
                padding: 25px;
                box-shadow: 0px 6px 20px rgba(0,0,0,0.08);
            }

            .offer-card {
                border-radius: 18px;
                transition: 0.2s;
            }

            .offer-card:hover {
                transform: translateY(-4px);
                box-shadow: 0px 10px 25px rgba(0,0,0,0.12);
            }

            .price {
                font-size: 1.3rem;
                font-weight: bold;
                color: #198754;
            }

            .store {
                font-size: 0.9rem;
                background: #eef2ff;
                padding: 6px 12px;
                border-radius: 12px;
                display: inline-block;
            }
        </style>
    </head>

    <body>

        {{--    Navbar    --}}
        @include('layouts.navbar')


        <div class="container py-5">

            <!-- Título -->
            <h2 class="fw-bold mb-4">
                Resultados para: <span class="text-primary">{{ $termo }}</span>
            </h2>


            <!-- Melhor Oferta -->
            <div class="best-offer mb-5">
                <h4 class="fw-bold">
                    🥇 Melhor Preço Encontrado
                </h4>

                <h5 class="mt-3">
                    {{ $melhor["title"] }}
                </h5>

                <p class="store mt-2">
                    🏪 {{ $melhor["source"] }}
                </p>

                <p class="price mt-3">
                    {{ $melhor["price"] }}
                </p>

                <a href="{{ $melhor["product_link"] }}"
                   target="_blank"
                   class="btn btn-success btn-lg">
                    🛒 Comprar na loja
                </a>

                <button class="btn btn-outline-primary btn-lg ms-2">
                    ⭐ Favoritar
                </button>
            </div>


            <!-- Filtro por Loja -->
            <div class="mb-4">
                <h5 class="fw-bold">Filtrar por loja:</h5>

                <form method="GET" action="">
                    <select class="form-select w-25">
                        <option>Todas</option>
                        <option>Amazon</option>
                        <option>Magalu</option>
                        <option>KaBuM</option>
                        <option>Americanas</option>
                    </select>
                </form>
            </div>


            <!-- Lista Top 10 -->
            <h4 class="fw-bold mb-3">
                🔥 Outras ofertas disponíveis
            </h4>

            <div class="row g-4">

                @foreach($top10 as $produto)
                    <div class="col-md-4">

                        <div class="card offer-card shadow-sm h-100">
                            <div class="card-body">

                                <h6 class="fw-bold">
                                    {{ $produto["title"] }}
                                </h6>

                                <p class="store">
                                    {{ $produto["source"] }}
                                </p>

                                <p class="price mt-2">
                                    {{ $produto["price"] }}
                                </p>

                                <a href="{{ $produto["product_link"] }}"
                                   target="_blank"
                                   class="btn btn-outline-success w-100">
                                    Comprar
                                </a>

                            </div>
                        </div>

                    </div>
                @endforeach

            </div>

        </div>

    </body>
</html>
