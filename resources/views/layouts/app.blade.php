<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
    body {
        background: url('{{ asset('images/bg-dashboard.png') }}') no-repeat center center fixed;
        background-size: cover;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.8);
        }
    </style>
</head>
<body>
    @yield('navbar')
    <div class="container-fluid">
        
        @yield('content')
    </div>
    @vite('resources/js/app.js')
</body>
</html>