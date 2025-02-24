<div
    class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 group relative border border-gray-100">
    <!-- Image Section -->
    <div class="h-48 w-full relative overflow-hidden rounded-t-xl">
        <img src="{{ $img }}" alt="Cover Buku {{ $title }}"
            class="w-full h-full object-cover object-top transition-transform duration-300 group-hover:scale-105">
        <!-- Category Badge -->
        <div class="absolute top-2 right-2">
            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">
                {{ $category->name }}
            </span>
        </div>
    </div>

    <!-- Content Section -->
    <div class="p-4 flex flex-col h-[calc(100%-12rem)]">
        <!-- Title and Author -->
        <h3 class="font-merriweather font-bold text-gray-800 truncate-2-lines mb-2 leading-tight">
            {{ $title }}
        </h3>

        <!-- Rating -->
        <div class="flex items-center mb-2">
            <div class="flex">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i > $rate)
                        <span class="text-xl text-slate-200">
                            ★
                        </span>
                    @else
                        <span class="text-xl text-yellow-400">
                            ★
                        </span>
                    @endif
                @endfor

            </div>
            <span class="text-xs text-gray-500 ml-2">({{ $rate }})</span>
        </div>

        <!-- Description -->
        <p class="text-sm text-gray-600 line-clamp-3 mb-4 font-roboto leading-relaxed">
            {{ $description }}
        </p>

        <!-- Bottom Section -->
        <div class="mt-auto pt-2 border-t border-gray-100">
            <a href="{{ route('post', Str::slug($title)) }}"
                class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center transition-all">
                Lihat Detail
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</div>
