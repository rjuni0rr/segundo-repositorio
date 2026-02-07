<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gestão de Usuários</title>

    {{--  FontAwesome  --}}
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{--  DataTables  --}}
    <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.min.css') }}">
    <script src="{{ asset('assets/datatables/datatables.min.js') }}"></script>

    {{--  ApexCharts -- conditional loading --}}
    @if(!empty($apexcharts))
        <script src="{{ asset('assets/apexcharts/apexcharts.js') }}"></script>
    @endif

    {{--  flatpickr -- conditional loading --}}
    @if(!empty($flatpickr))
        <link rel="stylesheet" href="{{ asset('assets/flatpickr/flatpickr.min.css') }}">
        <script src="{{ asset('assets/flatpickr/flatpickr.min.js') }}"></script>
        <script src="{{ asset('assets/flatpickr/pt.js') }}"></script>
    @endif
</head>

<body class="bg-light">
    @include('layouts.navbar')

    <div class="p-8">
        {{ $slot }}
    </div>


    {{-- JS --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

</body>
</html>
