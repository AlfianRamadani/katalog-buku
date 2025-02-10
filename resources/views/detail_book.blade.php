@extends('layout.app')

@section('content')
    <div class=" mx-auto py-20 px-5">
        <!-- Wrapper for Book Details -->
        <div class="flex flex-col md:flex-row items-center md:items-start space-y-8 md:space-y-0 gap-4">

            <!-- Gambar Buku -->
            <div class="w-full md:w-1/3">
                <img src="{{ $book->cover }}" alt="{{ $book->title }}"
                    class="w-full h-auto object-cover rounded-lg shadow-lg transition-transform transform hover:scale-105">
            </div>

            <!-- Detail Buku -->
            <div class="w-full md:w-2/3 space-y-6 md:space-y-4">
                <!-- Title -->
                <h1 class="text-3xl font-semibold text-gray-800">{{ $book->title }}</h1>

                <!-- Category -->
                <p class="text-lg text-gray-500 italic">Kategori: <span
                        class="font-medium text-gray-700">{{ $book->category->name }}</span></p>

                <!-- Description -->
                <p class="text-base text-gray-700 leading-relaxed">
                    {{ $book->description }}
                </p>

                <!-- Rating -->
                <div class="flex items-center gap-2 text-yellow-500">
                    <x-lucide-star class="w-5 h-5" />
                    <span class="font-semibold">4.5</span> <!-- Gantilah dengan rating dinamis -->
                </div>

                <!-- Button Actions -->
                <div class="flex gap-4 items-center mt-4">
                    <a href="/buy/{{ $book->id }}"
                        class="bg-gradient-to-r from-green-400 to-green-600 text-white py-2 px-6 rounded-lg shadow-md hover:bg-green-700 transition duration-200">
                        Beli Buku
                    </a>

                    <!-- Link to other books -->
                    <a href="/book" class="text-blue-500 hover:underline">
                        Lihat Buku Lainnya
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
