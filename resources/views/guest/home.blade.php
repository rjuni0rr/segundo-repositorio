<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Notícias</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .hero-news {
            height: 420px;
            background: url("https://images.unsplash.com/photo-1529070538774-1843cb3265df?auto=format&fit=crop&w=1400&q=80")
            center/cover no-repeat;
            border-radius: 15px;
            position: relative;
            overflow: hidden;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.55);
            display: flex;
            flex-direction: column;
            justify-content: end;
            padding: 30px;
            color: white;
        }

        .news-card img {
            height: 180px;
            object-fit: cover;
        }

        footer {
            background: #212529;
            color: white;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
            📰 Portal Notícias
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" href="#">Início</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Política</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Esportes</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Tecnologia</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Entretenimento</a></li>
            </ul>

            <!-- Search -->
            <form class="d-flex ms-lg-3">
                <input class="form-control me-2" type="search" placeholder="Buscar...">
                <button class="btn btn-light" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>
    </div>
</nav>

<!-- HERO SECTION -->
<section class="container my-5">
    <div class="hero-news shadow-lg">
        <div class="hero-overlay">
            <h1 class="fw-bold">Crise política abala o país</h1>
            <p class="lead">
                Tensões aumentam em meio a escândalos no governo e novas eleições podem ocorrer.
            </p>
            <a href="#" class="btn btn-warning fw-bold w-auto">
                Leia mais
            </a>
        </div>
    </div>
</section>

<!-- MAIN CONTENT -->
<section class="container">
    <div class="row g-4">

        <!-- NEWS GRID -->
        <div class="col-lg-8">

            <h3 class="fw-bold mb-4">Últimas Notícias</h3>

            <div class="row g-4">

                <!-- Card News -->
                <div class="col-md-6">
                    <div class="card news-card shadow-sm">
                        <img src="https://images.unsplash.com/photo-1551836022-4c4c79ecde51?auto=format&fit=crop&w=900&q=80"
                             class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Economia em queda</h5>
                            <p class="card-text">
                                Especialistas analisam os impactos da inflação e juros altos.
                            </p>
                            <a href="#" class="btn btn-primary btn-sm">Leia mais</a>
                        </div>
                    </div>
                </div>

                <!-- Card News -->
                <div class="col-md-6">
                    <div class="card news-card shadow-sm">
                        <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=900&q=80"
                             class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Nova tecnologia 2026</h5>
                            <p class="card-text">
                                Inteligência Artificial domina o mercado e muda empregos.
                            </p>
                            <a href="#" class="btn btn-primary btn-sm">Leia mais</a>
                        </div>
                    </div>
                </div>

                <!-- Card News -->
                <div class="col-md-6">
                    <div class="card news-card shadow-sm">
                        <img src="https://images.unsplash.com/photo-1508098682722-e99c43a406b2?auto=format&fit=crop&w=900&q=80"
                             class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Show lota estádio</h5>
                            <p class="card-text">
                                Evento histórico reúne milhares de fãs em noite inesquecível.
                            </p>
                            <a href="#" class="btn btn-primary btn-sm">Leia mais</a>
                        </div>
                    </div>
                </div>

                <!-- Card News -->
                <div class="col-md-6">
                    <div class="card news-card shadow-sm">
                        <img src="https://images.unsplash.com/photo-1521412644187-c49fa049e84d?auto=format&fit=crop&w=900&q=80"
                             class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Rodada do Brasileirão</h5>
                            <p class="card-text">
                                Confira os melhores jogos e destaques da rodada.
                            </p>
                            <a href="#" class="btn btn-primary btn-sm">Leia mais</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- SIDEBAR -->
        <div class="col-lg-4">
            <h4 class="fw-bold mb-4">🔥 Mais lidas</h4>

            <ul class="list-group shadow-sm">
                <li class="list-group-item">📌 Governo anuncia nova reforma</li>
                <li class="list-group-item">⚽ Final da Copa agita torcida</li>
                <li class="list-group-item">💻 Apple lança novo dispositivo</li>
                <li class="list-group-item">🎬 Filme recorde de bilheteria</li>
                <li class="list-group-item">🌍 Mudanças climáticas preocupam</li>
            </ul>
        </div>

    </div>
</section>

<!-- CATEGORIES -->
<section class="container my-5">
    <h3 class="fw-bold mb-4">Categorias</h3>

    <div class="row g-4">

        <div class="col-md-3">
            <div class="card shadow-sm text-center p-4">
                <h5 class="fw-bold">Política</h5>
                <a href="#" class="btn btn-outline-primary btn-sm mt-2">Ver mais</a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm text-center p-4">
                <h5 class="fw-bold">Esportes</h5>
                <a href="#" class="btn btn-outline-primary btn-sm mt-2">Ver mais</a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm text-center p-4">
                <h5 class="fw-bold">Tecnologia</h5>
                <a href="#" class="btn btn-outline-primary btn-sm mt-2">Ver mais</a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm text-center p-4">
                <h5 class="fw-bold">Entretenimento</h5>
                <a href="#" class="btn btn-outline-primary btn-sm mt-2">Ver mais</a>
            </div>
        </div>

    </div>
</section>

<!-- FOOTER -->
<footer class="py-4 mt-5">
    <div class="container text-center">
        <p class="mb-1 fw-bold">Portal Notícias © 2026</p>
        <small>
            rsj • Todos os direitos reservados.
        </small>

        <div class="mt-3">
            <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
            <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
            <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
        </div>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
