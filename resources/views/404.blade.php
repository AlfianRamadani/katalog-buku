@extends('layout.app')

@section('content')
    <div class="container mx-auto px-4">
        <div class="flex flex-col items-center justify-center h-screen">
            <h1 class="text-6xl font-bold text-gray-900">404</h1>
            <p class="text-xl text-gray-600">Buku yang anda cari tidak ditemukan: {{ $slug }}.</p>
            <a href="/" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Kembali ke
                Beranda</a>
        </div>
    </div>
@endsection
