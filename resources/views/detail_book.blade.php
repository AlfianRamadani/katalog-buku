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
            <div class="w-full md:w-2/3 space-y-4 md:space-y-2">
                <!-- Title -->
                <div class="flex items-center gap-2 text-yellow-500">
                    <h1 class="text-3xl font-semibold text-gray-800">{{ $book->title }}</h1>
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($book->rate < $i)
                            <span class="text-xl text-slate-200">
                                ★
                            </span>
                        @else
                            <span class="text-xl text-yellow-400">
                                ★
                            </span>
                        @endif
                    @endfor <span class="text-xl font-semibold">({{ $book->rate }})</span>
                </div>

                <p class="text-base text-gray-700 leading-relaxed">
                    {{ $book->description }}
                </p>
                <h2 class="text-xl font-medium">Informasi Detail</h2>
                <table class="table-auto w-96">
                    <tr>
                        <td class="font-semibold  py-2">Kategori</td>
                        <td class="  py-2">{{ $book->category->name }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold  py-2">Penerbit</td>
                        <td class="  py-2">{{ $book->publisher }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold  py-2">Tahun Terbit</td>
                        <td class="  py-2">{{ $book->publication_year }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold  py-2">Nomor ISBN</td>
                        <td class="  py-2">{{ $book->isbn_number }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold  py-2">Bahasa</td>
                        <td class="  py-2">{{ $book->language }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold      py-2">Stok</td>
                        <td class="  py-2">{{ $book->stock ?? '-' }}</td>
                    </tr>
                </table>
                <!-- Button Actions -->
                <div class="flex flex-col gap-4  mt-4">
                    {{-- <a href="/contact"
                                        class="bg-gradient-to-r from-green-400 to-green-600 text-white py-2 px-6 rounded-lg shadow-md hover:bg-green-700 transition duration-200">
                                        Pinjam Buku
                                    </a> --}}
                    <p>Ingin meminjam buku? Baca tata cara peminjaman buku <a class="text-blue-500 underline"
                            href="/contact">disini</a></p>

                    <!-- Link to other books -->
                    <a href="/book" class="text-blue-500 hover:underline">
                        Lihat Buku Lainnya
                    </a>
                </div>
                <h2 class="text-xl font-medium">Ulasan Buku ({{ $reviews->count() > 9 ? '9+' : $reviews->count() }})</h2>

                @if ($reviews->count() > 0)
                    <div class="space-y-4">
                        @foreach ($reviews as $review)
                            <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                                <p class="font-semibold text-gray-800">{{ $review->HistoryLoanBook->name }} -
                                    {{ $review->HistoryLoanBook->member_id }}
                                </p>
                                <p class="text-gray-700">{{ $review->descriptions }}</p>
                                <p class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
                @if ($reviews->count() > 0)
                    {{ $reviews->links() }}
                @endif


                {{-- <!-- Category -->
                <p class="text-lg text-gray-500 italic">Kategori: <span
                        class="font-medium text-gray-700">{{ $book->category->name }}</span></p> --}}

                <!-- Description -->

                <!-- Rating -->



            </div>
        </div>
    </div>
@endsection
