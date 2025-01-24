<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Laravel App')</title>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}"> <!-- Tambahkan CSS -->
    <script src="{{ asset('js/navbar.js') }}"></script>

</head>

<body>
    <x-navbar /> <!-- Include Navbar -->

    <main>
        @yield('content')
    </main>
    <x-footer />
</body>

</html>
