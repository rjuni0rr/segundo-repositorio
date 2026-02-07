<x-layouts.auth-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}" apexcharts>

    <div class="container py-2">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1">
                    Estatísticas
                    <a href="{{ route('user.home') }}" class="btn btn-outline-dark"><i class="fas fa-arrow-left me-2"></i>Voltar</a>
                </h3>

            </div>
        </div>
        <hr class="my-4">
        <div class="row g-4 mb-4">

            <!-- Card 1 -->
            <div class="col-md-6">
                <div class="main-card p-4">
                    <p class="title-1">Clientes ativos e inativos</p>
                    <p class="title-3">
                        Total: <strong>{{ $statsUsers['total'] }}</strong>
                    </p>
                    <div id="chart_1"></div>
                </div>
            </div>

        </div>

    </div>
    <script>

        let chart_1 = new ApexCharts(document.querySelector("#chart_1"), {
            chart: {
                type: "donut",
                height: 300,
                toolbar: {
                    show: true,
                }
            },
            series: [
                {{ $statsUsers['active'] }},
                {{ $statsUsers['inactive'] }},
            ],
            labels: ['Ativos', 'Inativos'],
            colors: ["#00AA00", "#AA0000"]
        });
        chart_1.render();

    </script>
</x-layouts.auth-layout>
