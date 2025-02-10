<div
    class="group relative bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out">
    <div class="relative overflow-hidden rounded-full w-32 h-32 mx-auto mb-6">
        <img src="{{ asset($path) }}" alt="{{ $name }}"
            class="w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-110">
    </div>

    <div class="text-center">
        <h3 class="text-xl font-semibold text-gray-900 mb-2">
            {{ $name }}
        </h3>

        <div class="flex justify-center space-x-4">
            <a href="{{ $ig }}" target="_blank"
                class="text-gray-400 hover:text-blue-600 transition-colors duration-200" aria-label="Instagram Profile">
                <i class="fab fa-instagram text-lg"></i>
            </a>
        </div>
    </div>
</div>
