<div
    class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 min-h-full transform hover:scale-105">
    <div class="w-full h-72  ">
        <img src="{{ $img }}" alt="Cover Buku" class="w-full h-full object-cover">
    </div>
    <div class="flex flex-col w-full p-4">
        <div class="flex justify-between items-center mb-3">
            <h3 class="text-lg font-bold font-sans text-gray-800 truncate">{{ $title }}</h3>
            <a href='book?category={{ $category->name }}'
                class="text-xs font-medium text-gray-500 bg-gray-100 rounded-full px-2 py-1">
                {{ $category->name }}
            </a>
        </div>
        <p class="text-sm text-gray-600 leading-relaxed line-clamp-4 mb-4">
            {{ $description }}
        </p>
        <a href="{{ route('post', Str::slug($title)) }}"
            class="text-sm font-medium text-blue-600 hover:underline transition-all duration-200 self-start">
            Detail Buku →
        </a>
    </div>
</div>
