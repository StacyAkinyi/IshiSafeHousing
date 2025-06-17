<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IshiSafeHousing - Agent Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                 <form method="POST" action="{{ route('logout') }}">
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
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Stats Cards for an Agent -->
                     <div class="bg-white p-6 rounded-xl shadow-md">
                        <p class="text-sm font-medium text-slate-500">Bookings</p>
                        <p class="text-3xl font-bold text-slate-800">4</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-md">
                        <p class="text-sm font-medium text-slate-500">My Assigned Rooms</p>
                        <p class="text-3xl font-bold text-slate-800">15</p>
                    </div>
                     <div class="bg-white p-6 rounded-xl shadow-md">
                        <p class="text-sm font-medium text-slate-500">Unread Reviews</p>
                        <p class="text-3xl font-bold text-slate-800">8</p>
                    </div>
                </div>
            </div>

            <!-- Bookings Section -->
            <div id="bookings" class="content-section hidden">
                <h2 class="text-3xl font-semibold text-slate-700 mb-6">My Bookings</h2>
                <div class="bg-white rounded-xl shadow-md p-4">
                    
                    <p class="text-slate-600">This area will list the bookings you have made. You will be able to edit details, update status, and manage rooms for each booking.</p>
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
                            <button class="text-blue-600 hover:text-blue-800 text-sm font-semibold">Edit</button>
                        </td>
                    </tr>
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
                    <input type="number" name="rent" id="rent" value="{{ old('rent') }}" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md text-sm shadow-sm">
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
                 <h2 class="text-3xl font-semibold text-slate-700 mb-6">Recent Reviews</h2>
                 <div class="bg-white rounded-xl shadow-md p-4">
                    <!-- Placeholder for reviews on agent's properties -->
                    <p class="text-slate-600">This section will show recent reviews and ratings submitted by students for the properties and rooms you manage.</p>
                 </div>
            </div>

           

        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarLinks = document.querySelectorAll('.sidebar-link');
            const contentSections = document.querySelectorAll('.content-section');

            sidebarLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const targetId = this.dataset.target;

                    // Hide all content sections
                    contentSections.forEach(section => {
                        section.classList.add('hidden');
                    });

                    // Show the target content section
                    const targetSection = document.getElementById(targetId);
                    if (targetSection) {
                        targetSection.classList.remove('hidden');
                    }

                    // Update active class on sidebar links
                    sidebarLinks.forEach(s_link => {
                        s_link.classList.remove('active');
                    });
                    this.classList.add('active');
                });
            });
        });

        function openRoomModal() {
        document.getElementById('addRoomModal').classList.remove('hidden');
        }

        function closeRoomModal() {
            document.getElementById('addRoomModal').classList.add('hidden');
        }
    </script>

</body>
</html>