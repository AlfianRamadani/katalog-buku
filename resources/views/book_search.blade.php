@extends('layout.app')

@section('content')
    <div class="pb-40 py-20 px-6 md:px-12">
        <button onclick="history.back()"
            class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg mb-6 flex items-center">
            ⬅ Kembali
        </button>
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-5xl font-bold text-gray-900 ">
                Temukan Buku Favoritmu 📚
            </h1>
            <p class="text-lg text-gray-600  mt-3">
                Jelajahi berbagai koleksi buku terbaik dari berbagai kategori dan genre.
            </p>
        </div>

        @isset($search)
            <p class="bg-blue-100 text-blue-700 py-2 px-4 rounded-lg inline-block mb-4">
                🔍 Hasil pencarian untuk: <strong>{{ $search }}</strong>
            </p>
        @endisset

        @isset($category)
            <p class="bg-green-100 text-green-700 py-2 px-4 rounded-lg inline-block mb-4">
                📂 Hasil pencarian dalam kategori: <strong>{{ $category }}</strong>
            </p>
        @endisset

        <div class="grid md:grid-cols-4 sm:grid-cols-2 gap-6 items-center" id="post-container">
            @forelse ($book as $item)
                <x-card :img="$item->cover" :category="$item->category" :title="$item->title" :description="$item->description"
                    class="transition-transform transform hover:scale-105 duration-300 shadow-lg rounded-xl" />
            @empty
                <p class="text-gray-500 text-lg col-span-4 text-center">
                    😔 Oops! Tidak ada buku yang ditemukan.
                </p>
            @endforelse
        </div>
    </div>
@endsection
