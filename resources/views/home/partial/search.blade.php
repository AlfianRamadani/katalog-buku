<div class="search-container min-h-[50vh] flex gap-4 flex-col">
    <div class="search-header flex gap-4">
        <h1>Temukan informasi menarik tentang buku hanya di MyCabook!</h1>
        <div class="relative w-1/3 divide-x-2 divide-black">
            <input name="search" type="text"
                class="w-full border-2 border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Cari buku...">
            <div class="absolute top-1/2 transform -translate-y-1/2 right-3 ">
                <x-lucide-search class="w-6 h-6 text-gray-500" />
            </div>
        </div>
    </div>
    <div class="flex gap-4 mt-4 justify-center text-center items-center">
        <a class="min-w-20 h-6  bg-green-500 text-white rounded-lg hover:bg-green-600 transition" href="">Novel</a>
        <a class="min-w-20 h-6 bg-green-500 text-white rounded-lg hover:bg-green-600 transition" href="">Cerpen</a>
        <a class="min-w-20 h-6 bg-green-500 text-white rounded-lg hover:bg-green-600 transition" href="">Sejarah</a>
        <a class="min-w-20 h-6 bg-green-500 text-white rounded-lg hover:bg-green-600 transition" href="">Komik</a>
        <a class="min-w-20 h-6 bg-green-500 text-white rounded-lg hover:bg-green-600 transition" href="">Manga</a>
    </div>
</div>
