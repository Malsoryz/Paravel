<!DOCTYPE html>
<html lang="en" class="bg-base-300">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="navbar bg-base-100">
        <a class="btn btn-ghost text-xl hover:bg-base-200">Data Barang</a>
    </div>
    <section class="p-4">
        @yield('content')
    </section>
    @yield('dialog')
    @yield('script')
</body>
</html>