<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>ComparadorPro - Melhor Preço Garantido</title>

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
              rel="stylesheet">

        <style>
            body {
                background: #f8f9fa;
            }

            .hero {
                background: linear-gradient(90deg, #0052cc, #2a7fff);
                color: white;
                padding: 80px 20px;
                border-radius: 0 0 40px 40px;
            }

            .search-box {
                background: white;
                border-radius: 18px;
                padding: 25px;
                box-shadow: 0px 8px 25px rgba(0,0,0,0.15);
                margin-top: -40px;
            }

            .category-card {
                border-radius: 18px;
                transition: 0.2s;
                cursor: pointer;
            }

            .category-card:hover {
                transform: translateY(-4px);
                box-shadow: 0px 10px 25px rgba(0,0,0,0.12);
            }

            .offer-card {
                border-radius: 18px;
                transition: 0.2s;
            }

            .offer-card:hover {
                transform: scale(1.02);
                box-shadow: 0px 10px 25px rgba(0,0,0,0.10);
            }

            .price {
                font-size: 1.3rem;
                font-weight: bold;
                color: #198754;
            }
        </style>
    </head>

    <body>

        {{--    Navbar    --}}
        @include('layouts.navbar')

        <!-- HERO -->
        <section class="hero text-center">
            <div class="container">
                <h1 class="fw-bold display-5">
                    Compare preços e economize em segundos 💰
                </h1>

                <p class="lead mt-3">
                    Busque produtos nas principais lojas do Brasil e encontre o menor preço.
                </p>
            </div>
        </section>


        <!-- SEARCH BOX -->
        <div class="container">
            <div class="search-box">

                <form action="{{ route('produto.buscar') }}" method="POST" class="row g-2">
                    @csrf

                    <div class="col-md-9">
                        <input type="text"
                               name="produto"
                               class="form-control form-control-lg"
                               placeholder="Ex: iPhone 15, PS5, Notebook Gamer..."
                               required>
                    </div>

                    <div class="col-md-3 d-grid">
                        <button class="btn btn-primary btn-lg">
                            Buscar Melhor Preço
                        </button>
                    </div>
                </form>

            </div>
        </div>


        <!-- CATEGORIAS -->
        <div class="container mt-5">

            <h3 class="fw-bold mb-4">
                📌 Categorias Populares
            </h3>

            <div class="row g-4">

                <div class="col-md-3">
                    <div class="card category-card p-3 text-center shadow-sm">
                        📱 <h6 class="mt-2 fw-bold">Celulares</h6>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card category-card p-3 text-center shadow-sm">
                        🎮 <h6 class="mt-2 fw-bold">Consoles</h6>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card category-card p-3 text-center shadow-sm">
                        💻 <h6 class="mt-2 fw-bold">Notebooks</h6>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card category-card p-3 text-center shadow-sm">
                        🖥 <h6 class="mt-2 fw-bold">Monitores</h6>
                    </div>
                </div>

            </div>
        </div>


        <!-- OFERTAS EM ALTA -->
        <div class="container mt-5">

            <h3 class="fw-bold mb-4">
                🔥 Ofertas em Alta Hoje
            </h3>

            <div class="row g-4">

                <!-- Card exemplo -->
                <div class="col-md-4">
                    <div class="card offer-card shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="fw-bold">
                                Playstation 5 Slim 1TB
                            </h6>

                            <p class="text-muted">
                                Amazon
                            </p>

                            <p class="price">
                                R$ 3.499,00
                            </p>

                            <a href="#" class="btn btn-outline-success w-100">
                                Ver oferta
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card offer-card shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="fw-bold">
                                iPhone 15 Pro Max 256GB
                            </h6>

                            <p class="text-muted">
                                Magalu
                            </p>

                            <p class="price">
                                R$ 7.899,00
                            </p>

                            <a href="#" class="btn btn-outline-success w-100">
                                Ver oferta
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card offer-card shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="fw-bold">
                                Notebook Gamer Acer Nitro 5
                            </h6>

                            <p class="text-muted">
                                KaBuM
                            </p>

                            <p class="price">
                                R$ 4.299,00
                            </p>

                            <a href="#" class="btn btn-outline-success w-100">
                                Ver oferta
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <!-- FOOTER -->
        <footer class="mt-5 py-4 bg-white border-top">
            <div class="container text-center text-muted">
                © {{ date("Y") }} ComparadorPro - Todos os direitos reservados.
            </div>
        </footer>
    </body>
</html>
