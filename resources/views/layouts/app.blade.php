<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    @yield('navbar')
    <div class="container-fluid">
        @yield('content')
    </div>
    @vite('resources/js/app.js')
</body>
</html>