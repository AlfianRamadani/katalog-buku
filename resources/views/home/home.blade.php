@if (session('alert'))
    <script>
        alert('{{ session('alert') }}');
    </script>
@endif
@extends('layout.app')

@section('title', 'Halaman Utama')

@section('content')
    @include('home.partial.search', ['categories' => $categories])
    <div class="pb-40 ">
        <div class="grid md:grid-cols-4 grid-cols-2 pr-4 pb-10     gap-4   items-center" id="post-container">
            @foreach ($book as $item)
                <x-card :rate="$item->rate" :img="$item->cover" :category="$item->category" :title="$item->title" :description="$item->description" />
            @endforeach
        </div>
        @if ($book->lastPage() > 1)
            <div id="load-more-container" class="flex justify-center mt-4">
                <button id="load-more" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Muat Lebih Banyak..
                </button>
            </div>
        @endif
    </div>
    <div class="pb-20">
        <x-request-book />
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let nextPage = 2;
        const postContainer = document.getElementById('post-container');
        const loadMore = document.getElementById('load-more');

        // Fungsi untuk membuat rating stars
        const createRatingStars = (rate) => {
            let stars = '';
            for (let i = 1; i <= 5; i++) {
                stars += i > rate ?
                    '<span class="text-xl text-slate-200">★</span>' :
                    '<span class="text-xl text-yellow-400">★</span>';
            }
            return stars;
        };

        // Fungsi untuk membuat slug
        const createSlug = (text) => {
            return text.toLowerCase()
                .replace(/ /g, '-')
                .replace(/[^\w-]+/g, '');
        };

        const fetchPosts = async () => {
            if (!nextPage) return; // Jika nextPage null, hentikan eksekusi

            loadMore.classList.add('hidden');

            try {
                const response = await fetch(`/fetch-posts?page=${nextPage}`);
                const data = await response.json();

                if (data.posts.length > 0) {
                    data.posts.forEach(post => {
                        const card = `
                        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 group relative border border-gray-100 h-full w-full flex flex-col">
                            <div class="h-80 w-full relative overflow-hidden rounded-t-xl flex-shrink-0">
                                <img src="${post.cover}" alt="Cover Buku ${post.title}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                <div class="absolute top-2 right-2">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">
                                        ${post.category.name}
                                    </span>
                                </div>
                            </div>
                            <div class="p-4 flex flex-col flex-1 min-h-[260px]">
                                <h3 class="font-merriweather font-bold text-gray-800 mb-2 leading-tight line-clamp-2 h-14">
                                    ${post.title}
                                </h3>
                                <div class="flex items-center mb-3">
                                    <div class="flex">
                                        ${createRatingStars(post.rate)}
                                    </div>
                                    <span class="text-xs text-gray-500 ml-2">(${post.rate})</span>
                                </div>
                                <p class="text-sm text-gray-600 line-clamp-3 mb-4 font-roboto leading-relaxed flex-1">
                                    ${post.description}
                                </p>
                                <div class="pt-2 border-t border-gray-100">
                                    <a href="/post/${createSlug(post.title)}" class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center transition-all">
                                        Lihat Detail
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    `;
                        postContainer.insertAdjacentHTML('beforeend', card);
                    });

                    nextPage = data.nextPage;
                } else {
                    nextPage = null;
                }
            } catch (error) {
                console.error('Error loading posts:', error);
            } finally {
                if (!nextPage) {
                    loadMore.classList.add(
                        'hidden'); // Sembunyikan tombol jika tidak ada halaman berikutnya
                } else {
                    loadMore.classList.remove('hidden');
                }
            }
        };

        loadMore.addEventListener('click', fetchPosts);
    });
</script>
