<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard - IshiSafeHousing</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-link.active { background-color: #4f46e5; color: white; }
    </style>
</head>
<body class="bg-slate-100">

<div class="flex min-h-screen">
    <aside class="w-64 flex-shrink-0 bg-slate-800 text-slate-200 flex flex-col">
        <div class="h-20 flex items-center justify-center bg-slate-900 shadow-md">
            <h1 class="text-2xl font-bold text-white tracking-wider">IshiSafe<span class="text-indigo-400">Housing</span></h1>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="#" class="sidebar-link flex items-center py-3 px-4 rounded-lg active" data-target="dashboard">Dashboard</a>
            <a href="#" class="sidebar-link flex items-center py-3 px-4 rounded-lg" data-target="properties">Available Properties</a>
            <a href="#" class="sidebar-link flex items-center py-3 px-4 rounded-lg" data-target="bookings">My Bookings</a>
            <a href="#" class="sidebar-link flex items-center py-3 px-4 rounded-lg" data-target="reviews">My Reviews</a>
        </nav>
        <div class="px-4 py-6">
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="w-full text-left flex items-center py-3 px-4 rounded-lg text-red-300 hover:bg-red-500 hover:text-white">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 p-6 lg:p-10">
        <div id="dashboard" class="content-section">
            <h2 class="text-3xl font-semibold text-slate-700 mb-6">Welcome, {{ Auth::user()->name }}!</h2>
            <div class="bg-white p-6 rounded-xl shadow-md">
                <p class="text-slate-600">Welcome to your student dashboard. Here you can browse available rooms, manage your bookings, and see your reviews. Use the menu on the left to navigate.</p>
            </div>
        </div>

        <div id="properties" class="content-section hidden">
            <h2 class="text-3xl font-semibold text-slate-700 mb-6">Available Properties</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($availableProperties as $property)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="h-40 bg-gray-200"></div>
                        <div class="p-4">
                            <h3 class="font-semibold text-lg">{{ $property->name }}</h3>
                            <p class="text-sm text-slate-600">{{ $property->city }}</p>
                            <p class="text-sm text-slate-800 mt-2 font-bold">{{ $property->rooms_count }} available room(s)</p>
                            <a href="#" class="text-indigo-600 hover:underline mt-4 inline-block">View Details</a>
                        </div>
                    </div>
                @empty
                    <p class="text-slate-600 md:col-span-3">No available properties at the moment. Please check back later.</p>
                @endforelse
            </div>
        </div>

        <div id="bookings" class="content-section hidden">
            <h2 class="text-3xl font-semibold text-slate-700 mb-6">My Bookings</h2>
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <table class="min-w-full text-left">
                    <thead class="bg-slate-50 border-b">
                        <tr>
                            <th class="p-4 text-sm font-semibold text-slate-600">Property</th>
                            <th class="p-4 text-sm font-semibold text-slate-600">Room #</th>
                            <th class="p-4 text-sm font-semibold text-slate-600">Status</th>
                            <th class="p-4 text-sm font-semibold text-slate-600">Booking Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($myBookings as $booking)
                            <tr class="border-b hover:bg-slate-50">
                                <td class="p-4 text-slate-800">{{ $booking->property->name ?? 'N/A' }}</td>
                                <td class="p-4 text-slate-600">{{ $booking->room->room_number ?? 'N/A' }}</td>
                                <td class="p-4 text-slate-600">{{ ucfirst($booking->status) }}</td>
                                <td class="p-4 text-slate-600">{{ $booking->created_at->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="p-4 text-center text-slate-500">You have not made any bookings yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div id="reviews" class="content-section hidden">
            <h2 class="text-3xl font-semibold text-slate-700 mb-6">My Reviews</h2>
             <div class="space-y-4">
                @forelse ($myReviews as $review)
                    <div class="bg-white p-4 rounded-xl shadow-md">
                        <p class="font-semibold">{{ $review->property->name ?? 'N/A' }}</p>
                        <p class="text-slate-600 mt-1">"{{ $review->comment }}"</p>
                        <p class="text-sm text-yellow-500 mt-2">Rating: {{ $review->rating }} / 5</p>
                    </div>
                @empty
                    <p class="text-slate-600">You have not written any reviews.</p>
                @endforelse
            </div>
        </div>
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const links = document.querySelectorAll('.sidebar-link');
        const sections = document.querySelectorAll('.content-section');
        
        const showSection = (targetId) => {
            sections.forEach(section => section.classList.add('hidden'));
            const targetSection = document.getElementById(targetId);
            if (targetSection) {
                targetSection.classList.remove('hidden');
            }
        };

        const activeLink = document.querySelector('.sidebar-link.active');
        if (activeLink) {
            showSection(activeLink.getAttribute('data-target'));
        }

        links.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                links.forEach(l => l.classList.remove('active'));
                this.classList.add('active');
                showSection(this.getAttribute('data-target'));
            });
        });
    });
</script>

</body>
</html>