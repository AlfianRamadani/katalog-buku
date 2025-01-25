@extends('layout.app')

@section('content')
    <div class="bg-gray-50 py-16">
        <div class="w-full h-full max-w-5xl bg-white shadow-md rounded-lg grid grid-cols-1 md:grid-cols-2 gap-8 p-8">

            <!-- Left Section -->
            <div>
                <h1 class="text-3xl font-bold text-center text-green-900 mb-4">CONTACT US</h1>
                <p class="text-center text-lg text-green-800 mb-8">
                    Tell us a bit about yourself, and we’ll tell you a lot more about us.
                </p>
                <div class="grid gap-6">
                    <div class="bg-gray-100 p-6 rounded-lg shadow-md flex flex-col items-center text-center">
                        <i class="fas fa-circle-info text-4xl text-green-900 mb-4"></i>
                        <h2 class="font-bold text-green-900 text-xl mb-2">Support</h2>
                        <p class="text-green-700 text-sm">
                            Need help? Find the answers to frequently asked questions here.
                        </p>
                    </div>
                    <div class="bg-gray-100 p-6 rounded-lg shadow-md flex flex-col items-center text-center">
                        <i class="fas fa-blog text-4xl text-green-900 mb-4"></i>
                        <h2 class="font-bold text-green-900 text-xl mb-2">Ruul Blog</h2>
                        <p class="text-green-700 text-sm">
                            Keep up with the latest news and trends in the global work landscape.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Section -->
            <div class="bg-green-900 p-8 rounded-lg shadow-md">
                <form action="#" method="POST" class="space-y-6">
                    <div>
                        <label for="name" class="block text-white font-bold mb-2">Your Name *</label>
                        <input type="text" id="name" name="name"
                            class="w-full p-3 rounded-lg bg-gray-100 text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-500"
                            placeholder="Enter Your Name" required>
                    </div>
                    <div>
                        <label for="email" class="block text-white font-bold mb-2">Email *</label>
                        <input type="email" id="email" name="email"
                            class="w-full p-3 rounded-lg bg-gray-100 text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-500"
                            placeholder="Enter Your Email" required>
                    </div>
                    <div>
                        <label for="message" class="block text-white font-bold mb-2">Your Message *</label>
                        <textarea id="message" name="message" rows="4"
                            class="w-full p-3 rounded-lg bg-gray-100 text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-500"
                            placeholder="Your message" required></textarea>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="not-robot" name="not_robot" class="mr-2">
                        <label for="not-robot" class="text-sm text-white">I'm not a robot</label>
                    </div>
                    <button type="submit"
                        class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 rounded-lg shadow-md transition">Send</button>
                </form>
            </div>

        </div>
    </div>

    </div>
@endsection
