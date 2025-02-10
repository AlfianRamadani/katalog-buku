@extends('layout.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Streamlined Custody Solution</title>
        <!-- Include Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>

    <body class="bg-gray-50">
        <section class="py-16 text-center bg-gradient-to-b from-blue-50 to-white">
            <div class="container mx-auto px-4">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                    Tim MyCabook
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Kami adalah tim yang bersemangat dalam membaca dan berbagi pemikiran tentang buku, serta berusaha
                    mengembangkan komunitas literasi yang inspiratif.
                </p>
            </div>
        </section>

        <!-- Team Section -->
        <section class="py-8">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">
                    Tim Kami
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Team Member Card -->
                    <x-profile name="Alfian Ramadani" ig="https://instagram.com/alboyonnn" path="profile/alfian.jpg" />
                    <x-profile name="Ayudya Aisyah Mutiaradinna" ig="https://instagram.com/asterlaverne"
                        path="profile/ayudya.jpg" />
                    <x-profile name="Taufiq Erik Herliansyah" ig="https://instagram.com/erikterl"
                        path="profile/taufiq.jpg" />
                    <x-profile name="Syera Salsabilla Mecha" ig="https://instagram.com/syeraslsblla"
                        path="profile/meka.jpg" />
                    <x-profile name="Naufal Zaki Ramadhan" ig="https://instagram.com/naufalrmdhan._"
                        path="profile/naufal.jpg" />
                    <x-profile name="Maelinda Sa Firaaidah" ig="https://instagram.com/saexisnt" path="profile/mae.jpeg" />
                    <!-- Add more team members here -->
                </div>
            </div>
        </section>
    </body>

    </html>
@endsection
