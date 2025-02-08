<div class=" flex flex-col gap-6  items-center p-6">
    <h1 class="text-lg font-bold text-gray-800 text-center">
        Buku yang Anda inginkan belum tersedia? <br>
        <span class="text-blue-600">Klik di sini untuk mengirimkan permintaan Anda kepada kami!</span>
    </h1>

    <form method="POST" action="{{ route('request_book') }}"
        class="flex flex-col sm:flex-row gap-4 w-full max-w-2xl items-center">
        @csrf
        <input type="text" placeholder="Masukkan judul buku yang Anda inginkan" name="name"
            class="rounded-full border border-gray-300 px-4 py-2 w-full sm:flex-1 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
        <button type="submit"
            class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition-shadow duration-300 text-sm shadow-md">
            Request Book
        </button>
    </form>

</div>
