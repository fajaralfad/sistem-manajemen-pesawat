<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <style>
    body {
        background: url('{{ asset('images/bg-dashboard.png') }}') no-repeat center center fixed;
        background-size: cover;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.8);
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.min.css') }}">

</head>
<body>
    @yield('navbar')
    <div class="container-fluid">
        
        @yield('content')
    </div>
    @vite('resources/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+ntuv1+0Pv8+O60pH5sVVJChd7wHx" crossorigin="anonymous"></script>

</body>
</html>