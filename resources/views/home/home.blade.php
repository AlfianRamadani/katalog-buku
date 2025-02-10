@extends('layout.app')

@section('title', 'Home Page')

@section('content')
    @include('home.partial.search', ['categories' => $categories])
    <div class="pb-40 ">
        <div class="grid md:grid-cols-4 grid-cols-2 pr-4 pb-10    gap-4   items-center" id="post-container">
            @foreach ($book as $item)
                <x-card :img="$item->cover" :category="$item->category" :title="$item->title" :description="$item->description" />
            @endforeach
        </div>
        @if ($book->lastPage() > 1)
            <div class="flex justify-center mt-4">
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

        const fetchPosts = async () => {
            if (nextPage) {
                loadMore.classList.add('hidden');
                console.log('Fetching posts...');
                try {
                    const response = await fetch(`/fetch-posts?page=${nextPage}`);
                    const data = await response.json();

                    if (data.posts.length > 0) {
                        data.posts.forEach(post => {
                            const card = `
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 min-h-full transform hover:scale-105">
                            <div class="w-full h-48">
                                <img src="${post.cover}" alt="Cover Buku" class="w-full h-full object-cover">
                            </div>
                            <div class="flex flex-col w-full p-4">
                                <div class="flex justify-between items-center mb-3">
                                    <h3 class="text-lg font-bold font-sans text-gray-800 truncate">${post.title}</h3>
                                    <span class="text-xs font-medium text-gray-500 bg-gray-100 rounded-full px-2 py-1">
                                        ${post.category}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 leading-relaxed line-clamp-3 mb-4">
                                    ${post.description}
                                </p>
                                <a href="#" class="text-sm font-medium text-blue-600 hover:underline transition-all duration-200 self-start">
                                    Detail Buku →
                                </a>
                            </div>
                        </div>`;
                            postContainer.insertAdjacentHTML('beforeend', card);
                        });

                        nextPage = data.nextPage;
                    } else {
                        nextPage = null;
                    }
                } catch (error) {
                    console.error('Error loading posts:', error);
                } finally {
                    loadMore.classList.remove('hidden');
                }
            }
        };
        loadMore.addEventListener('click', fetchPosts);


    });
</script>
