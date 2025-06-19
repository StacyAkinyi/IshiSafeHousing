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
            <a href="#" class="sidebar-link flex items-center py-3 px-4 rounded-lg" data-target="account">My Account</a>
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
        <div id="account" class="content-section">
            <h2 class="text-3xl font-semibold text-slate-700 mb-6">My Account</h2>
            @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="space-y-8">

        <div class="bg-white p-6 rounded-xl shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-2xl font-semibold text-slate-700">Personal Details</h3>
                <button data-modal-target="personalDetailsModal" class="text-sm bg-indigo-100 text-indigo-700 font-semibold py-2 px-4 rounded-lg hover:bg-indigo-200 transition">
                    Edit Details
                </button>
            </div>
            <div class="space-y-3 text-slate-600">
                <div class="flex">
                    <p class="w-1/3 font-medium text-slate-500">Full Name</p>
                    <p class="w-2/3">{{ $student->name }}</p>
                </div>
                <div class="flex">
                    <p class="w-1/3 font-medium text-slate-500">Email Address</p>
                    <p class="w-2/3">{{ $student->email }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md">
            @if ($student->nextOfKin)
                {{-- This shows if a Next of Kin EXISTS --}}
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-2xl font-semibold text-slate-700">Next of Kin Details</h3>
                    <button data-modal-target="nextOfKinModal" class="text-sm bg-indigo-100 text-indigo-700 font-semibold py-2 px-4 rounded-lg hover:bg-indigo-200 transition">
                        Update Details
                    </button>
                </div>
                <div class="space-y-3 text-slate-600">
                    <div class="flex">
                        <p class="w-1/3 font-medium text-slate-500">Full Name</p>
                        <p class="w-2/3">{{ $student->nextOfKin->name }}</p>
                    </div>
                    <div class="flex">
                        <p class="w-1/3 font-medium text-slate-500">Relationship</p>
                        <p class="w-2/3">{{ $student->nextOfKin->relationship }}</p>
                    </div>
                    <div class="flex">
                        <p class="w-1/3 font-medium text-slate-500">Phone Number</p>
                        <p class="w-2/3">{{ $student->nextOfKin->phone_number }}</p>
                    </div>
                     <div class="flex">
                        <p class="w-1/3 font-medium text-slate-500">Email Address</p>
                        <p class="w-2/3">{{ $student->nextOfKin->email ?? 'N/A' }}</p>
                    </div>
                </div>
            @else
                {{-- This shows if a Next of Kin DOES NOT exist --}}
                <div class="text-center">
                    <h3 class="text-2xl font-semibold text-slate-700 mb-2">Next of Kin</h3>
                    <p class="text-slate-500 mb-4">You have not added a next of kin yet.</p>
                    <button data-modal-target="nextOfKinModal" class="bg-indigo-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-indigo-700 transition">
                        Add Next of Kin
                    </button>
                </div>
            @endif
        </div>

    </div>
</div>

<div id="personalDetailsModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-md">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-semibold text-slate-700">Edit Personal Details</h3>
            <button data-modal-hide="personalDetailsModal" class="text-slate-500 hover:text-slate-800">&times;</button>
        </div>
        <form action="{{ route('student.account.updateDetails') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-600">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $student->name) }}" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-600">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $student->email) }}" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<div id="nextOfKinModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-md">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-semibold text-slate-700">Next of Kin Details</h3>
            <button data-modal-hide="nextOfKinModal" class="text-slate-500 hover:text-slate-800">&times;</button>
        </div>
        <form action="{{ route('student.account.updateNextOfKin') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="kin_name" class="block text-sm font-medium text-slate-600">Full Name</label>
                    <input type="text" name="kin_name" value="{{ old('kin_name', $student->nextOfKin->name ?? '') }}" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500">
                </div>
                <div>
                    <label for="kin_relationship" class="block text-sm font-medium text-slate-600">Relationship</label>
                    <input type="text" name="kin_relationship" value="{{ old('kin_relationship', $student->nextOfKin->relationship ?? '') }}" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500">
                </div>
                <div>
                    <label for="kin_phone_number" class="block text-sm font-medium text-slate-600">Phone Number</label>
                    <input type="tel" name="kin_phone_number" value="{{ old('kin_phone_number', $student->nextOfKin->phone_number ?? '') }}" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500">
                </div>
                <div>
                    <label for="kin_email" class="block text-sm font-medium text-slate-600">Email Address (Optional)</label>
                    <input type="email" name="kin_email" value="{{ old('kin_email', $student->nextOfKin->email ?? '') }}" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500">
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">Save Next of Kin</button>
            </div>
        </form>
    </div>


        </div>

        <div id="properties" class="content-section hidden">
            <h2 class="text-3xl font-semibold text-slate-700 mb-6">Available Properties</h2>
             <div class="mb-6">
        <input 
            type="text" 
            id="propertySearch" 
            placeholder="Search by city..." 
            class="w-full md:w-1/2 px-4 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
    </div>
            <div  id="propertyGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($availableProperties as $property)
                    <div class="property-card bg-white rounded-xl shadow-md overflow-hidden" data-city="{{ strtolower($property->city) }}">
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

    // ===================================================================
    // 1. Sidebar and Content Section Logic
    // ===================================================================
    const links = document.querySelectorAll('.sidebar-link');
    const sections = document.querySelectorAll('.content-section');

    const showSection = (targetId) => {
        // First, hide all sections
        sections.forEach(section => {
            if (!section.classList.contains('hidden')) {
                section.classList.add('hidden');
            }
        });
        
        // Then, show the target section
        const targetSection = document.getElementById(targetId);
        if (targetSection) {
            targetSection.classList.remove('hidden');
        }
    };

    const setActiveLink = (targetId) => {
        links.forEach(l => l.classList.remove('active'));
        const newActiveLink = document.querySelector(`.sidebar-link[data-target="${targetId}"]`);
        if (newActiveLink) {
            newActiveLink.classList.add('active');
        }
    };

    // Handle clicks on sidebar links
    links.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('data-target');
            setActiveLink(targetId);
            showSection(targetId);
        });
    });

    // ===================================================================
    // 2. Initial Page Load Logic
    // ===================================================================
    // Check if the server redirected with a specific section to show (e.g., after form submission)
    const activeSectionFromSession = @json(session('active_section'));

    if (activeSectionFromSession) {
        // If the session has a target, show it
        setActiveLink(activeSectionFromSession);
        showSection(activeSectionFromSession);
    } else {
        // Otherwise, show the default section that has the 'active' class in the HTML
        const defaultActiveLink = document.querySelector('.sidebar-link.active');
        if (defaultActiveLink) {
            showSection(defaultActiveLink.getAttribute('data-target'));
        }
    }
    
    // ===================================================================
    // 3. Modal (Pop-up) Logic
    // ===================================================================
    const modalTriggers = document.querySelectorAll('[data-modal-target]');
    const modalHides = document.querySelectorAll('[data-modal-hide]');

    modalTriggers.forEach(trigger => {
        trigger.addEventListener('click', () => {
            const modalId = trigger.getAttribute('data-modal-target');
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove('hidden');
            }
        });
    });

    modalHides.forEach(hide => {
        hide.addEventListener('click', () => {
            const modalId = hide.getAttribute('data-modal-hide');
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('hidden');
            }
        });
    });

    document.querySelectorAll('.fixed.inset-0').forEach(modal => {
        modal.addEventListener('click', function (e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });
    });

    // ===================================================================
    // 4. Property Search Logic
    // ===================================================================
    const searchInput = document.getElementById('propertySearch');
    const propertyCards = document.querySelectorAll('.property-card');

    if(searchInput) {
        searchInput.addEventListener('input', function () {
            const query = this.value.trim().toLowerCase();
            propertyCards.forEach(card => {
                const city = card.getAttribute('data-city');
                if (city.includes(query)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }

});

</script>

</body>
</html>