<div class="flex flex-col items-center gap-4 py-20 pb-6">
    <div class="grid gap-4 text-2xl">
        <h1 class="text-3xl font-semibold text-center">
            Temukan informasi menarik tentang buku hanya di <span class="text-blue-500">MyCabook!</span>
        </h1>

        <!-- Input Pencarian -->
        <div class="relative w-full">
            <input name="search" type="text" id="search"
                class="w-full border-2 border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Cari buku..." onkeyup="searchBook(event)">
            <div class="absolute top-1/2 transform -translate-y-1/2 right-3">
                <x-lucide-search class="w-6 h-6 text-gray-500" />
            </div>
        </div>

        <!-- Tombol Cari -->
        <button type="button" id="submit-search"
            class="bg-black text-white px-4 py-2 rounded-lg hover:bg-gray-800 transition">
            🔍 Cari Buku
        </button>
    </div>

    <div class="flex gap-3 mt-6 flex-wrap justify-center">
        @foreach ($categories as $category)
            <a href="/book?category={{ strtolower($category->name) }}"
                class="flex items-center gap-2 px-4 py-2 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 text-white shadow-md hover:shadow-lg hover:from-indigo-600 hover:to-purple-600 transition-all duration-300 ease-in-out transform hover:-translate-y-1">
                {{ $category->name }}
            </a>
        @endforeach
    </div>


</div>

<script>
    const inputSearch = document.getElementById('search');
    const submitSearch = document.getElementById('submit-search');

    function searchBook(event) {
        if (event.key === "Enter") { // Jalankan saat Enter ditekan
            redirectToSearch();
        }
    }

    submitSearch.addEventListener('click', redirectToSearch);

    function redirectToSearch() {
        if (!inputSearch.value.trim()) return;
        const search = encodeURIComponent(inputSearch.value.trim());
        window.location.href = `/book?search=${search}`;
    }
</script>
