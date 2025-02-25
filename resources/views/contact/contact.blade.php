@if (session('alert'))
    <script>
        alert('{{ session('alert') }}');
    </script>
@endif
@extends('layout.app')
@section('title', 'Hubungi Kami')
@section('content')
    <div class="py-20">
        <h1 class="font-semibold text-4xl text-center mb-12">Pertanyaan Yang Sering Ditanyakan</h1>
        <!-- Item 1 -->
        <div class="border-b border-slate-200">
            <button onclick="toggleAccordion(1)" class="w-full flex justify-between items-center py-5 text-slate-800">
                <span>Bagaimana cara meminjam buku di perpustakaan?</span>
                <span id="icon-1" class="text-slate-800 transition-transform duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                        <path
                            d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
                    </svg>
                </span>
            </button>
            <div id="content-1" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                <div class="pb-5 text-sm text-slate-500">
                    1. Bawa kartu anggota perpustakaan yang masih aktif<br>
                    2. Cari buku yang ingin dipinjam di katalog atau rak buku<br>
                    3. Bawa buku ke petugas peminjaman<br>
                    4. Serahkan kartu anggota untuk proses scanning<br>
                    5. Tandatangani bukti peminjaman<br>
                    6. Kembalikan buku sebelum tanggal jatuh tempo
                </div>
            </div>
        </div>

        <!-- Item 2 -->
        <div class="border-b border-slate-200">
            <button onclick="toggleAccordion(2)" class="w-full flex justify-between items-center py-5 text-slate-800">
                <span>Bagaimana cara mendapatkan kartu anggota perpustakaan?</span>
                <span id="icon-2" class="text-slate-800 transition-transform duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                        <path
                            d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
                    </svg>
                </span>
            </button>
            <div id="content-2" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                <div class="pb-5 text-sm text-slate-500">
                    1. Datang langsung ke bagian registrasi perpustakaan<br>
                    2. Isi formulir pendaftaran<br>
                    3. Lampirkan fotokopi KTP dan pas foto 3x4<br>
                    4. Bayar biaya administrasi pendaftaran<br>
                    5. Kartu anggota akan dicetak dan bisa langsung digunakan
                </div>
            </div>
        </div>


        <!-- Item 4 -->
        <div class="border-b border-slate-200">
            <button onclick="toggleAccordion(4)" class="w-full flex justify-between items-center py-5 text-slate-800">
                <span>Berapa lama maksimal waktu peminjaman buku?</span>
                <span id="icon-4" class="text-slate-800 transition-transform duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                        <path
                            d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
                    </svg>
                </span>
            </button>
            <div id="content-4" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                <div class="pb-5 text-sm text-slate-500">
                    Masa pinjam standar adalah 7 hari kerja. Bisa diperpanjang maksimal 2 kali (total 21 hari) jika tidak
                    ada
                    waiting list. Keterlambatan pengembalian dikenakan denda Rp2.000/hari/buku.
                </div>
            </div>
        </div>

        <!-- Item 5 -->
        <div class="border-b border-slate-200">
            <button onclick="toggleAccordion(5)" class="w-full flex justify-between items-center py-5 text-slate-800">
                <span>Bagaimana cara memperpanjang masa pinjam buku?</span>
                <span id="icon-5" class="text-slate-800 transition-transform duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                        <path
                            d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
                    </svg>
                </span>
            </button>
            <div id="content-5" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                <div class="pb-5 text-sm text-slate-500">
                    Perpanjangan bisa dilakukan melalui:<br>
                    1. Aplikasi perpustakaan: Pilih buku yang dipinjam > klik perpanjangan<br>
                    2. Datang langsung ke perpustakaan dengan membuku buku dan kartu anggota<br>
                    3. Telepon ke bagian sirkulasi (minimal 1 hari sebelum jatuh tempo)<br>
                    *Syarat: Buku tidak dalam status dipesan oleh anggota lain
                </div>
            </div>
        </div>
    </div>

    <div class=" py-16 flex w-full">
        <div class="w-full h-full  bg-white shadow-md rounded-lg grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
            <!-- Bagian Kiri -->
            <div>
                <h1 class="text-3xl font-bold text-center text-green-900 mb-4">HUBUNGI KAMI</h1>
                <p class="text-center text-lg text-green-800 mb-8">
                    Ceritakan sedikit tentang diri Anda, dan kami akan memberi tahu Anda lebih banyak tentang kami.
                </p>
                <div class="grid gap-6">
                    <div class="bg-gray-100 p-6 rounded-lg shadow-md flex flex-col items-center text-center">
                        <i class="fas fa-circle-info text-4xl text-green-900 mb-4"></i>
                        <h2 class="font-bold text-green-900 text-xl mb-2">Dukungan</h2>
                        <p class="text-green-700 text-sm">
                            Butuh bantuan? Temukan jawaban atas pertanyaan yang sering diajukan di sini.
                        </p>
                    </div>
                    <div class="bg-gray-100 p-6 rounded-lg shadow-md flex flex-col items-center text-center">
                        <i class="fas fa-blog text-4xl text-green-900 mb-4"></i>
                        <h2 class="font-bold text-green-900 text-xl mb-2">Blog Buku</h2>
                        <p class="text-green-700 text-sm">
                            Ikuti berita dan tren terbaru dalam dunia buku.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Bagian Kanan -->
            <div class="bg-green-900 p-8 rounded-lg shadow-md">
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="name" class="block text-white font-bold mb-2">Nama Anda *</label>
                        <input type="text" id="name" name="name"
                            class="w-full p-3 rounded-lg bg-gray-100 text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-500"
                            placeholder="Masukkan Nama Anda" required>
                    </div>
                    <div>
                        <label for="email" class="block text-white font-bold mb-2">Email *</label>
                        <input type="email" id="email" name="email"
                            class="w-full p-3 rounded-lg bg-gray-100 text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-500"
                            placeholder="Masukkan Email Anda" required>
                    </div>
                    <div>
                        <label for="message" class="block text-white font-bold mb-2">Pesan Anda *</label>
                        <textarea id="message" name="message" rows="4"
                            class="w-full p-3 rounded-lg bg-gray-100 text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-500"
                            placeholder="Pesan Anda" required></textarea>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="not-robot" name="not_robot" class="mr-2">
                        <label for="not-robot" class="text-sm text-white">Saya bukan robot</label>
                    </div>
                    <button type="submit"
                        class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 rounded-lg shadow-md transition">Kirim</button>
                </form>
            </div>

        </div>
    </div>

    </div>

    <script>
        function toggleAccordion(index) {
            const content = document.getElementById(`content-${index}`);
            const icon = document.getElementById(`icon-${index}`);

            // SVG for Minus icon
            const minusSVG = `
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
          <path d="M3.75 7.25a.75.75 0 0 0 0 1.5h8.5a.75.75 0 0 0 0-1.5h-8.5Z" />
        </svg>
      `;

            // SVG for Plus icon
            const plusSVG = `
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
          <path d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
        </svg>
      `;

            // Toggle the content's max-height for smooth opening and closing
            if (content.style.maxHeight && content.style.maxHeight !== '0px') {
                content.style.maxHeight = '0';
                icon.innerHTML = plusSVG;
            } else {
                content.style.maxHeight = content.scrollHeight + 'px';
                icon.innerHTML = minusSVG;
            }
        }
    </script>
@endsection
