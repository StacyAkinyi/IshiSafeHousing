<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IshiSafeHousing - Agent Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Custom scrollbar for better aesthetics */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #94a3b8;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #64748b;
        }
        /* Style for the active menu item */
        .sidebar-link.active {
            background-color: #0d9488; /* Teal-600 for a different feel */
            color: white;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }
    </style>
</head>
<body class="bg-slate-100">

    <div class="flex min-h-screen">
        <!-- Left Sidebar Menu -->
        <aside class="w-64 flex-shrink-0 bg-slate-800 text-slate-200 flex flex-col">
            <!-- Logo/Header -->
            <div class="h-20 flex items-center justify-center bg-slate-900 shadow-md">
                <h1 class="text-2xl font-bold text-white tracking-wider">IshiSafe<span class="text-teal-400">Agent</span></h1>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="#" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition duration-200 hover:bg-slate-700 active" data-target="dashboard">
                    <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Dashboard
                </a>
                <a href="#" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition duration-200 hover:bg-slate-700" data-target="account">
                    <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    Account
                </a>
                <a href="#" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition duration-200 hover:bg-slate-700" data-target="bookings">
                    <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Bookings
                </a>
                <a href="#" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition duration-200 hover:bg-slate-700" data-target="rooms">
                     <svg class="h-6 w-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" /></svg>
                    Rooms
                </a>
                <a href="#" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition duration-200 hover:bg-slate-700" data-target="reviews">
                   <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.196-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                    Reviews
                </a>
            </nav>

            <!-- Logout -->
            <div class="px-4 py-6 mt-auto">
                 <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="w-full text-left flex items-center py-3 px-4 rounded-lg text-red-300 transition duration-200 hover:bg-red-500 hover:text-white">
                        <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Right Content Area -->
        <main class="flex-1 p-6 lg:p-10 transition-all duration-300">
            
            <!-- Dashboard Section -->
            <div id="dashboard" class="content-section">
                <h2 class="text-3xl font-semibold text-slate-700 mb-6">Agent Dashboard</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <div data-modal-target="roomsChartModal" class="stat-card bg-white p-6 rounded-xl shadow-md cursor-pointer hover:shadow-lg hover:-translate-y-1 transition-all">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-slate-500">My Assigned Rooms</p>
                                <p class="text-3xl font-bold text-slate-800 mt-1">{{ $roomCount }}</p>
                            </div>
                            <div class="bg-blue-100 text-blue-600 p-3 rounded-full"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 012-2h3a2 2 0 012 2v14a2 2 0 01-2 2h-3a2 2 0 01-2-2V5z" /></svg></div>
                        </div>
                        <p class="text-xs text-slate-400 mt-4">View by Property</p>
                    </div>

                    <div data-modal-target="bookingsChartModal" class="stat-card bg-white p-6 rounded-xl shadow-md cursor-pointer hover:shadow-lg hover:-translate-y-1 transition-all">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-slate-500">Total Bookings</p>
                                <p class="text-3xl font-bold text-slate-800 mt-1">{{ $bookingCount }}</p>
                            </div>
                            <div class="bg-green-100 text-green-600 p-3 rounded-full"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg></div>
                        </div>
                        <p class="text-xs text-slate-400 mt-4">View by Property</p>
                    </div>

                    <div data-modal-target="reviewsChartModal" class="stat-card bg-white p-6 rounded-xl shadow-md cursor-pointer hover:shadow-lg hover:-translate-y-1 transition-all">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-slate-500">Total Reviews</p>
                                <p class="text-3xl font-bold text-slate-800 mt-1">{{ $reviewCount }}</p>
                            </div>
                            <div class="bg-yellow-100 text-yellow-600 p-3 rounded-full"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.196-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg></div>
                        </div>
                        <p class="text-xs text-slate-400 mt-4">View by Property</p>
                    </div>
                </div>
            </div>

            <div id="roomsChartModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden z-50 p-4">
                <div class="bg-white p-6 rounded-xl shadow-2xl w-full max-w-2xl">
                    <div class="flex justify-between items-center mb-4"><h3 class="text-xl font-semibold">My Rooms by Property</h3><button data-modal-hide="roomsChartModal" class="text-2xl font-bold">&times;</button></div>
                    <canvas id="roomsByPropertyChart"></canvas>
                </div>
            </div>
            <div id="bookingsChartModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden z-50 p-4">
                <div class="bg-white p-6 rounded-xl shadow-2xl w-full max-w-2xl">
                    <div class="flex justify-between items-center mb-4"><h3 class="text-xl font-semibold">Bookings by Property</h3><button data-modal-hide="bookingsChartModal" class="text-2xl font-bold">&times;</button></div>
                    <canvas id="bookingsByPropertyChart"></canvas>
                </div>
            </div>
            <div id="reviewsChartModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden z-50 p-4">
                <div class="bg-white p-6 rounded-xl shadow-2xl w-full max-w-2xl">
                    <div class="flex justify-between items-center mb-4"><h3 class="text-xl font-semibold">Reviews by Property</h3><button data-modal-hide="reviewsChartModal" class="text-2xl font-bold">&times;</button></div>
                    <canvas id="reviewsByPropertyChart"></canvas>
                </div>
            </div>

            <!-- Account Section -->
             <div id="account" class="content-section hidden">
                <h2 class="text-3xl font-semibold text-slate-700 mb-6">My Account</h2>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="bg-white p-6 rounded-xl shadow-md">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-2xl font-semibold text-slate-700">My Details</h3>
                        <button data-modal-target="agentAccountModal" class="text-sm bg-indigo-100 text-indigo-700 font-semibold py-2 px-4 rounded-lg hover:bg-indigo-200 transition">
                            Edit Details
                        </button>
                    </div>
                    <div class="space-y-3 text-slate-600 border-t pt-4">
                        <div class="flex"><p class="w-1/3 font-medium text-slate-500">Full Name</p><p class="w-2/3">{{ $agent->user->name }}</p></div>
                        <div class="flex"><p class="w-1/3 font-medium text-slate-500">Email Address</p><p class="w-2/3">{{ $agent->user->email }}</p></div>
                        <div class="flex"><p class="w-1/3 font-medium text-slate-500">Phone Number</p><p class="w-2/3">{{ $agent->phone_number ?? 'Not provided' }}</p></div>
                        <div class="flex"><p class="w-1/3 font-medium text-slate-500">License Number</p><p class="w-2/3">{{ $agent->license_number ?? 'Not provided' }}</p></div>
                    </div>
                </div>
            </div>


            <div id="agentAccountModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden z-50 p-4">
                <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-lg flex flex-col max-h-[90vh]">
                    <div class="flex justify-between items-center mb-6 border-b pb-4">
                        <h3 class="text-xl font-semibold">Edit My Details</h3>
                        <button data-modal-hide="agentAccountModal" class="text-2xl font-bold">&times;</button>
                    </div>
                    <div class="flex-1 overflow-y-auto pr-2">
                        <form id="agentAccountForm" action="{{ route('agent.account.update') }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="space-y-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium">Full Name</label>
                                    <input type="text" name="name" value="{{ old('name', $agent->user->name) }}" required class="mt-1 block w-full px-3 py-2 border rounded-md">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium">Email Address</label>
                                    <input type="email" name="email" value="{{ old('email', $agent->user->email) }}" required class="mt-1 block w-full px-3 py-2 border rounded-md">
                                </div>
                                <div>
                                    <label for="phone_number" class="block text-sm font-medium">Phone Number</label>
                                    <input type="tel" name="phone_number" value="{{ old('phone_number', $agent->phone_number) }}" required class="mt-1 block w-full px-3 py-2 border rounded-md">
                                </div>
                                <div>
                                    <label for="license_number" class="block text-sm font-medium">License Number</label>
                                    <input type="text" name="license_number" value="{{ old('license_number', $agent->license_number) }}" required class="mt-1 block w-full px-3 py-2 border rounded-md">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="flex-shrink-0 flex justify-end items-center p-6 border-t mt-6">
                        <button type="button" data-modal-hide="agentAccountModal" class="bg-slate-200 text-slate-800 font-semibold py-2 px-5 rounded-lg hover:bg-slate-300">Cancel</button>
                        <button type="submit" form="agentAccountForm" class="ml-3 bg-indigo-600 text-white font-semibold py-2 px-5 rounded-lg hover:bg-indigo-700">Save Changes</button>
                    </div>
                </div>
            </div>


            <!-- Bookings Section -->
             <div id="bookings" class="content-section hidden">
                <h2 class="text-3xl font-semibold text-slate-700 mb-6">Room Bookings</h2>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="bg-white rounded-xl shadow-md overflow-x-auto">
                    <table class="min-w-full text-left text-sm">
                        <thead class="bg-slate-50 border-b">
                            <tr>
                                <th class="p-4 font-semibold">Property</th>
                                <th class="p-4 font-semibold">Room #</th>
                                <th class="p-4 font-semibold">Student</th>
                                <th class="p-4 font-semibold">Dates</th>
                                <th class="p-4 font-semibold">Status</th>
                                <th class="p-4 font-semibold text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bookings as $booking)
                                <tr class="border-b hover:bg-slate-50">
                                    <td class="p-4">{{ $booking->room->property->name ?? 'N/A' }}</td>
                                    <td class="p-4">{{ $booking->room->room_number ?? 'N/A' }}</td>
                                    <td class="p-4">{{ $booking->student->user->name ?? 'N/A' }}</td>
                                    <td class="p-4">{{ $booking->start_date->format('M d, Y') }} - {{ $booking->end_date->format('M d, Y') }}</td>
                                    <td class="p-4">
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full 
                                            @if($booking->status == 'pending') bg-yellow-200 text-yellow-800
                                            @elseif($booking->status == 'confirmed') bg-green-200 text-green-800
                                            @elseif($booking->status == 'completed') bg-blue-200 text-blue-800
                                            @else bg-red-200 text-red-800 @endif">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                    <td class="p-4">
                                        <form action="{{ route('agent.bookings.updateStatus', $booking) }}" method="POST" class="flex items-center justify-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="py-1 px-2 border border-slate-300 rounded-md shadow-sm text-xs">
                                                <option value="confirmed" @if($booking->status == 'confirmed') selected @endif>Confirmed</option>
                                                <option value="completed" @if($booking->status == 'completed') selected @endif>Completed</option>
                                                <option value="cancelled" @if($booking->status == 'cancelled') selected @endif>Cancelled</option>
                                            </select>
                                            <button type="submit" class="bg-indigo-600 text-white font-semibold text-xs py-1.5 px-3 rounded-md hover:bg-indigo-700">Update</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-6 text-center text-slate-500">You have no bookings for your rooms yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Rooms Section -->
            <div id="rooms" class="content-section hidden">
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-3xl font-semibold text-slate-800">Manage Rooms</h1>
                    <button onclick="openRoomModal()" class="bg-blue-500 text-white font-semibold py-2 px-5 rounded-lg hover:bg-blue-600 transition shadow-sm flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Add Room
                    </button>
                </div>
                @if (session('success_room'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
            <p>{{ session('success_room') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <table class="min-w-full text-left">
            <thead class="bg-slate-50 border-b">
                <tr>
                    <th class="p-4 text-sm font-semibold text-slate-600">Room Number</th>
                    <th class="p-4 text-sm font-semibold text-slate-600">Property</th>
                    <th class="p-4 text-sm font-semibold text-slate-600">Rent</th>
                    <th class="p-4 text-sm font-semibold text-slate-600">Capacity</th>
                    <th class="p-4 text-sm font-semibold text-slate-600">Status</th>
                    <th class="p-4 text-sm font-semibold text-slate-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rooms as $room)
                    <tr class="border-b hover:bg-slate-50 transition">
                        <td class="p-4 text-slate-800 font-medium">{{ $room->room_number }}</td>
                        <td class="p-4 text-slate-600">{{ $room->property->name ?? 'N/A' }}</td>
                        <td class="p-4 text-slate-600">{{ number_format($room->rent, 2) }}</td>
                        <td class="p-4 text-slate-600">{{ $room->capacity }} person(s)</td>
                        <td class="p-4">
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full 
                                @if($room->is_available) bg-green-200 text-green-800
                                @else bg-red-200 text-red-800 @endif">
                                {{ $room->is_available ? 'Available' : 'Occupied' }}
                            </span>
                        </td>
                        <td class="p-4 space-x-2">
                            <button type="button" data-modal-target="editRoomModal-{{ $room->id }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold">Edit</button>
                        </td>
                    </tr>
                    <div id="editRoomModal-{{ $room->id }}" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 hidden">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl">
                <div class="flex justify-between items-center p-6 border-b">
                    <h2 class="text-2xl font-semibold text-slate-800">Edit Room: {{ $room->room_number }}</h2>
                    <button data-modal-hide="editRoomModal-{{ $room->id }}" class="text-slate-400 hover:text-slate-600 text-3xl">&times;</button>
                </div>
                
                <form action="{{ route('agent.rooms.update', $room) }}" method="POST" class="p-6">
                    @csrf
                    @method('PATCH')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-1">
                            <label for="room_number-{{$room->id}}" class="block text-sm font-medium text-slate-700">Room Number / Name</label>
                            <input type="text" name="room_number" id="room_number-{{$room->id}}" value="{{ old('room_number', $room->room_number) }}" required class="mt-1 block w-full ...">
                        </div>
                        <div class="md:col-span-1">
                            <label for="rent-{{$room->id}}" class="block text-sm font-medium text-slate-700">Monthly Rent: Kshs</label>
                            <input type="number" name="rent" id="rent-{{$room->id}}" value="{{ old('rent', $room->rent) }}" step="0.01" class="mt-1 block w-full ...">
                        </div>
                        <div class="md:col-span-1">
                            <label for="capacity-{{$room->id}}" class="block text-sm font-medium text-slate-700">Capacity (Persons)</label>
                            <input type="number" name="capacity" id="capacity-{{$room->id}}" value="{{ old('capacity', $room->capacity) }}" required min="1" class="mt-1 block w-full ...">
                        </div>
                         <div class="md:col-span-2">
                            <label for="description-{{$room->id}}" class="block text-sm font-medium text-slate-700">Description</label>
                            <textarea name="description" id="description-{{$room->id}}" rows="3" class="mt-1 block w-full ...">{{ old('description', $room->description) }}</textarea>
                        </div>
                        <div class="md:col-span-2">
                            <label for="is_available-{{$room->id}}" class="inline-flex items-center">
                                <input id="is_available-{{$room->id}}" type="checkbox" name="is_available" value="1" @if($room->is_available) checked @endif class="rounded ...">
                                <span class="ml-2 text-sm text-gray-600">Mark as Available</span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="flex justify-end items-center pt-6 mt-4 border-t">
                        <button type="button" data-modal-hide="editRoomModal-{{ $room->id }}" class="bg-slate-100 ...">Cancel</button>
                        <button type="submit" class="bg-blue-600 text-white ...">Save Changes</button>
                    </div>
                </form>
            </div>
        </div> 



                @empty
                    <tr>
                        <td colspan="6" class="p-4 text-center text-slate-500">No rooms found. Add one to get started.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="addRoomModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl">
        <div class="flex justify-between items-center p-6 border-b">
            <h2 class="text-2xl font-semibold text-slate-800">Add New Room</h2>
            <button onclick="closeRoomModal()" class="text-slate-400 hover:text-slate-600 text-3xl">&times;</button>
        </div>
        
        <form action="{{ route('agent.rooms.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Oops! Something went wrong.</strong>
                    <ul class="mt-3 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="property_id" class="block text-sm font-medium text-slate-700">Property</label>
                    <select name="property_id" id="property_id" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm">
                        <option value="" disabled selected>Select a property...</option>
                        @foreach ($properties as $property)
                            <option value="{{ $property->id }}" {{ old('property_id') == $property->id ? 'selected' : '' }}>{{ $property->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="rent" class="block text-sm font-medium text-slate-700">Monthly Rent: Kshs</label>
                    <input type="number" name="rent" id="rent" value="{{ old('rent') }}" step="0.01" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md text-sm shadow-sm">
                </div>

                <div>
                    <label for="capacity" class="block text-sm font-medium text-slate-700">Capacity (Persons)</label>
                    <input type="number" name="capacity" id="capacity" value="{{ old('capacity', 1) }}" required min="1" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md text-sm shadow-sm">
                </div>

                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-slate-700">Description</label>
                    <textarea name="description" id="description" rows="3" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md text-sm shadow-sm">{{ old('description') }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label for="is_available" class="inline-flex items-center">
                        <input id="is_available" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm" name="is_available" value="1" checked>
                        <span class="ml-2 text-sm text-gray-600">Mark as Available upon creation</span>
                    </label>
                </div>
                <div class="md:col-span-2">
        <label for="images" class="block text-sm font-medium text-slate-700">Room Images</label>
        <input type="file" name="images[]" id="images" multiple class="mt-1 block w-full text-sm text-slate-500
            file:mr-4 file:py-2 file:px-4
            file:rounded-full file:border-0
            file:text-sm file:font-semibold
            file:bg-indigo-50 file:text-indigo-700
            hover:file:bg-indigo-100
        "/>
        <p class="mt-1 text-xs text-gray-500">You can select multiple images.</p>
        @error('images.*')
            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
        @enderror
    </div>

            </div>
            
            <div class="flex justify-end items-center pt-6 mt-4 border-t">
                <button type="button" onclick="closeRoomModal()" class="bg-slate-100 text-slate-800 font-semibold py-2 px-5 rounded-lg hover:bg-slate-200 mr-2 border border-slate-300">Cancel</button>
                <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-5 rounded-lg hover:bg-blue-700">Save Room</button>
            </div>
        </form>
    </div>
</div>


            <!-- Reviews Section -->
            <div id="reviews" class="content-section hidden">
    <h2 class="text-3xl font-semibold text-slate-700 mb-6">Room Reviews</h2>

    <div class="space-y-8">
        {{-- Outer loop: Iterate through each ROOM that has reviews --}}
        @forelse ($roomsWithReviews as $room)
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="border-b pb-3 mb-4">
                    <h3 class="text-xl font-bold text-slate-800">Room #{{ $room->room_number }}</h3>
                    <p class="text-sm text-slate-500">In Property: {{ $room->property->name }}</p>
                </div>
                
                <div class="space-y-4">
                    {{-- Inner loop: Iterate through each REVIEW for the current room --}}
                    @foreach ($room->reviews as $review)
                        <div class="p-4 bg-slate-50 rounded-lg">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-semibold text-slate-700">{{ $review->booking->student->user->name ?? 'A Student' }}</p>
                                    <p class="text-xs text-slate-500">{{ $review->created_at->format('M d, Y') }}</p>
                                </div>
                                <div class="flex items-center">
                                    <span class="font-bold text-slate-800 mr-1">{{ $review->rating }}</span>
                                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                </div>
                            </div>
                            <p class="text-slate-600 italic mt-2">"{{ $review->description }}"</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="bg-white rounded-xl shadow-md p-6 text-center">
                <p class="text-slate-500">You have no reviews for any of your rooms yet.</p>
            </div>
        @endforelse
    </div>
</div>

           

        </main>
    </div>
<footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto px-4 text-center">
            <p>© {{ date('Y') }} Ishi Safe Housing. All rights reserved.</p>
        </div>
    </footer>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ===================================================================
    // 1. SETUP - Get all necessary data and elements from the page once.
    // ===================================================================
    const sidebarLinks = document.querySelectorAll('.sidebar-link');
    const contentSections = document.querySelectorAll('.content-section');
    const modalTriggers = document.querySelectorAll('[data-modal-target]');
    const modalHides = document.querySelectorAll('[data-modal-hide]');

    // Data from Laravel for the charts
    const roomsByPropertyData = @json($roomsByProperty);
    const bookingsByPropertyData = @json($bookingsByProperty);
    const reviewsByPropertyData = @json($reviewsByProperty);

    // To keep track of charts that have already been created
    let initializedCharts = {};

    // ===================================================================
    // 2. FUNCTIONS - Reusable logic for the page.
    // ===================================================================

    function showSection(targetId) {
        contentSections.forEach(section => section.classList.add('hidden'));
        const targetSection = document.getElementById(targetId);
        if (targetSection) targetSection.classList.remove('hidden');
    }

    function setActiveLink(targetId) {
        sidebarLinks.forEach(link => link.classList.remove('active'));
        const newActiveLink = document.querySelector(`.sidebar-link[data-target="${targetId}"]`);
        if (newActiveLink) newActiveLink.classList.add('active');
    }

    // This function now correctly handles the different data structures for the charts
    function renderBarChart(canvasId, chartData, label, color) {
        let chartLabels;
        let chartValues;

        // The 'roomsByProperty' data has a different structure, so we handle it specifically
        if (canvasId === 'roomsByPropertyChart') {
            chartLabels = chartData.map(item => item.property_name);
            chartValues = chartData.map(item => item.count);
        } else {
            // All other charts use the simple key-value structure
            chartLabels = Object.keys(chartData);
            chartValues = Object.values(chartData);
        }
        
        const ctx = document.getElementById(canvasId);
        if(!ctx) return; // Don't try to render if canvas isn't there

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: label,
                    data: chartValues,
                    backgroundColor: color,
                    borderColor: color,
                    borderWidth: 1
                }]
            },
            options: { 
                scales: { 
                    y: { 
                        beginAtZero: true, 
                        ticks: { stepSize: 1 } 
                    } 
                } 
            }
        });
    }

    // ===================================================================
    // 3. EVENT LISTENERS - Making the page interactive.
    // ===================================================================

    // --- Sidebar Navigation ---
    sidebarLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('data-target');
            setActiveLink(targetId);
            showSection(targetId);
        });
    });

    // --- All Modal "Open" Buttons ---
    modalTriggers.forEach(button => {
        button.addEventListener('click', () => {
            const modalId = button.dataset.modalTarget;
            const modal = document.getElementById(modalId);
            
            if (modal) {
                modal.classList.remove('hidden');

                // If the button was a stat card, render the chart (only once)
                if (button.classList.contains('stat-card') && !initializedCharts[modalId]) {
                    if (modalId === 'roomsChartModal') renderBarChart('roomsByPropertyChart', roomsByPropertyData, '# of Rooms', '#3b82f6');
                    if (modalId === 'bookingsChartModal') renderBarChart('bookingsByPropertyChart', bookingsByPropertyData, '# of Bookings', '#10b981');
                    if (modalId === 'reviewsChartModal') renderBarChart('reviewsByPropertyChart', reviewsByPropertyData, '# of Reviews', '#f59e0b');
                    initializedCharts[modalId] = true;
                }
            } else {
                console.error(`Error: Modal with ID '${modalId}' not found.`);
            }
        });
    });

    // --- All Modal "Close" Buttons ---
    modalHides.forEach(button => {
        button.addEventListener('click', () => {
            const modalToHide = button.closest('.fixed.inset-0');
            if (modalToHide) {
                modalToHide.classList.add('hidden');
            }
        });
    });

    // ===================================================================
    // 4. INITIAL PAGE LOAD LOGIC - Show the correct tab.
    // ===================================================================
    const activeSectionFromSession = @json(session('active_section'));
    if (activeSectionFromSession) {
        setActiveLink(activeSectionFromSession);
        showSection(activeSectionFromSession);
    } else {
        const defaultActiveLink = document.querySelector('.sidebar-link.active');
        if (defaultActiveLink) {
            showSection(defaultActiveLink.getAttribute('data-target'));
        }
    }
});
</script>

</body>
</html>