<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Utama</title>

    <!-- Tambahkan link CSS di sini -->
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}"> <!-- CSS lokal -->
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}"> <!-- CSS lokal -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> <!-- Contoh CSS eksternal -->
</head>

<body>
    <x-navbar />
    <x-footer /> 
    @include('home.partial.search')
    <x-card :img={{ $cardData['img'] }} />
</body>

</html>

