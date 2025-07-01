<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IshiSafeHousing</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style>
      body {
        font-family: 'Inter', sans-serif;
      }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <header class="bg-white/80 backdrop-blur-md py-4 shadow-md sticky top-0 z-10">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <a href="/" class="text-xl font-bold text-indigo-600">ISHI SAFE HOUSING</a>
            <nav class="hidden md:block">
                <ul class="flex space-x-6">
                    <li><a href="/#features" class="hover:text-blue-600 transition duration-300">Features</a></li>
                    <li><a href="/#listings" class="hover:text-blue-600 transition duration-300">Listings</a></li>
                    <li><a href="/#about" class="hover:text-blue-600 transition duration-300">About Us</a></li>
                    <li><a href="/#contact" class="hover:text-blue-600 transition duration-300">Contact</a></li>
                </ul>
            </nav>
            <div class="flex space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-3 rounded-full transition duration-300">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-3 rounded-full transition duration-300">Login</a>
                    <a href="{{ route('register') }}" class="bg-purple-500 hover:bg-purple-600 text-white px-5 py-3 rounded-full transition duration-300">Register</a>
                @endauth
            </div>
        </div>
    </header>

    <main class="flex-grow">
        @yield('content') </main>
    
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto px-4 text-center">
            <p>© {{ date('Y') }} Ishi Safe Housing. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>