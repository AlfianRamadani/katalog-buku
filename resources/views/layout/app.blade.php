<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Laravel App')</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("css/app.css") }}">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <meta name="theme-color" content="#4285f4">
</head>

<body>

    <x-navbar />

    <main class="min-h-[67vh] px-10  md:px-20 lg:px-30 xl:px-40">
        @yield('content')
    </main>
    <x-footer />
</body>

</html>
