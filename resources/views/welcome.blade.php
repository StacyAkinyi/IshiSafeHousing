<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IshiSafeWelcome</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style>
      body {
        font-family: 'Inter', sans-serif;
      }
    </style>
</head>
<body class="bg-gradient-to-br from-purple-100 to-blue-100 min-h-screen flex flex-col">
    <header class="bg-white/80 backdrop-blur-md py-4 shadow-md sticky top-0 z-10">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <a href="#" class="text-xl font-bold text-indigo-600">ISHI SAFE HOUSING</a>
            <nav class="hidden md:block">
                <ul class="flex space-x-6">
                    <li><a href="#features" class="hover:text-blue-600 transition duration-300">Features</a></li>
                    <li><a href="#listings" class="hover:text-blue-600 transition duration-300">Listings</a></li>
                    <li><a href="#about" class="hover:text-blue-600 transition duration-300">About Us</a></li>
                    <li><a href="#contact" class="hover:text-blue-600 transition duration-300">Contact</a></li>
                </ul>
            </nav>
            <div class="flex space-x-4">
                <a href="{{route('login')}}" class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-3 rounded-full transition duration-300">Login</a>
                <a href="{{route('register')}}" class="bg-purple-500 hover:bg-purple-600 text-white px-5 py-3 rounded-full transition duration-300">Register</a>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-2 py-10 flex-grow flex flex-col md:flex-row items-center justify-center gap-8">
        <div class="text-center md:text-left">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Find Your Ideal Student Housing</h1>
            <p class="text-lg text-gray-700 mb-8">A safe, reliable, and convenient platform to connect students with verified housing options.</p>
            <a href="#listings" class="bg-indigo-500 hover:bg-indigo-600 text-white px-8 py-3 rounded-full transition duration-300 text-lg">Get Started</a>
        </div>
        <div class="md:w-3/4">
            <img src="{{ asset('images/prop4.jpeg') }}" alt="Student Housing" class="rounded-xl shadow-lg">
        </div>
    </main>

    <section id="features" class="bg-gray-50 py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-semibold text-gray-800 mb-8">Key Features</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl shadow-md p-6 flex flex-col justify-between">
                    <h3 class="text-xl font-semibold text-blue-600 mb-4">Verified Listings</h3>
                    <p class="text-gray-700 mb-4">Only list properties that have been verified for safety and legitimacy.</p>
                    <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                </div>
                <div class="bg-white rounded-xl shadow-md p-6 flex flex-col justify-between">
                    <h3 class="text-xl font-semibold text-blue-600 mb-4">User Reviews & Ratings</h3>
                    <p class="text-gray-700 mb-4">Make informed decisions with feedback from other students.</p>
                    <i class="fas fa-star text-yellow-500 text-2xl"></i>
                </div>
                <div class="bg-white rounded-xl shadow-md p-6 flex flex-col justify-between">
                    <h3 class="text-xl font-semibold text-blue-600 mb-4">Advanced Search</h3>
                    <p class="text-gray-700 mb-4">Find housing based on your specific criteria, such as price, location, and amenities.</p>
                    <i class="fas fa-filter text-purple-500 text-2xl"></i>
                </div>
            </div>
        </div>
    </section>

    <section id="listings" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-2xl mx-auto">
                <h2 class="text-3xl font-semibold text-gray-800 mb-4">Find Your Next Room</h2>
                <p class="text-gray-600 mb-8">Start by searching for a city to find available properties and rooms.</p>
            </div>

            <form id="propertySearchForm" action="{{ route('properties.search') }}" method="GET" class="max-w-2xl mx-auto">
                <div class="relative">
                    <input type="search" name="city" required placeholder="Enter a city name, e.g., Nairobi" class="w-full pl-4 pr-12 py-4 text-lg border border-slate-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <button type="submit" class="absolute inset-y-0 right-0 flex items-center justify-center w-16 h-full text-white bg-indigo-500 rounded-full hover:bg-indigo-600">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </button>
                </div>
            </form>
        </div>
    </section>

    <section id="map-view" class="py-16">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-2xl mx-auto">
                <h2 class="text-3xl font-semibold text-gray-800 mb-4">Explore Our Locations</h2>
                <p class="text-gray-600 mb-8">Get a bird's-eye view of all available properties.</p>
            </div>

            <div id="map" class="w-full h-[500px] rounded-xl shadow-lg border"></div>
        </div>
    </section>

    <section id="about" class="bg-gray-100 py-16">
        <div class="container mx-auto px-4 md:px-8 flex flex-col md:flex-row items-center gap-8">
            <div class="md:w-1/2">
                <img src="{{ asset('images/prop5.jpeg') }}">
            </div>
            <div class="md:w-1/2">
                <h2 class="text-3xl font-semibold text-gray-800 mb-6">About Student Housing Hub</h2>
                <p class="text-gray-700 text-lg">
                    Student Housing Hub is dedicated to providing students with a safe, reliable, and efficient platform to find suitable accommodation near their universities. We understand the challenges students face when searching for housing, and we strive to make the process as smooth and stress-free as possible. Our platform features verified listings, user reviews, and advanced search options to help students make informed decisions.
                </p>
            </div>
        </div>
    </section>

    <section id="contact" class="py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-semibold text-gray-800 mb-8">Contact Us</h2>
            <p class="text-gray-700 text-lg mb-4">Have any questions or need assistance?  Reach out to us using the information below.</p>
            <p class="text-blue-600 text-lg">Email: supportishi@gmail.com</p>
            <p class="text-blue-600 text-lg">Phone: +254-742-315-488</p>
        </div>
    </section>

    <footer class="bg-gray-800 text-white py-6 mt-10">
        <div class="container mx-auto px-4 text-center">
            <p>© 2025 Ishi Safe Housing. All rights reserved.</p>
        </div>
    </footer>

    <script>
        
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
    </script>
    <script>
        const propertiesForMap = @json($propertiesForMap);
    </script>

    <script>
        function initMap() {
            // Default map center (e.g., Nairobi)
            const mapCenter = { lat: -1.2921, lng: 36.8219 };

            // Create the map instance
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 12,
                center: mapCenter,
                mapId: 'ISHI_SAFE_HOUSING_MAP' // Optional: for custom styling in Google Cloud
            });

            // Create one info window to be reused for all markers
            const infoWindow = new google.maps.InfoWindow();

            // Loop through the properties and create a marker for each one
            propertiesForMap.forEach(property => {
                const position = {
                    lat: parseFloat(property.latitude),
                    lng: parseFloat(property.longitude)
                };

                const marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    title: property.name,
                    // Optional: Add a simple animation
                    animation: google.maps.Animation.DROP,
                });

                // Add a click listener to each marker
                marker.addListener('click', () => {
                    // Set the content and open the info window
                    infoWindow.setContent(`
                        <div class="p-2 font-sans">
                            <p class="font-bold">${property.name}</p>
                            <a href="/properties/${property.id}" class="text-indigo-600 hover:underline text-sm">View Rooms</a>
                        </div>
                    `);
                    infoWindow.open(map, marker);
                });
            });
        }
    </script>

    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChY6UgjP5yMfhA4te6N2N_OWsY4yssR-Q&callback=initMap&libraries=maps,marker&v=beta">
    </script>
</body>
</html>
