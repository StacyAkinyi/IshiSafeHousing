<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IshiSafeHousing - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #94a3b8; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #64748b; }
        .sidebar-link.active {
            background-color: #4f46e5;
            color: white;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }
        .modal { transition: opacity 0.25s ease; }
    </style>
</head>
<body class="bg-slate-100">

    <div class="flex min-h-screen">
        <!-- Left Sidebar Menu -->
        <aside class="w-64 flex-shrink-0 bg-slate-800 text-slate-200 flex flex-col">
            <!-- Logo/Header -->
            <div class="h-20 flex items-center justify-center bg-slate-900 shadow-md">
                <h1 class="text-2xl font-bold text-white tracking-wider">IshiSafe<span class="text-indigo-400">Housing</span></h1>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="#" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition duration-200 hover:bg-slate-700 active" data-target="dashboard">
                    <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Dashboard
                </a>
                <a href="#" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition duration-200 hover:bg-slate-700" data-target="properties">
                    <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Properties
                </a>
                 <a href="#" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition duration-200 hover:bg-slate-700" data-target="bookings">
                    <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    Bookings
                </a>
                <a href="#" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition duration-200 hover:bg-slate-700" data-target="users">
                    <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Users
                </a>
                <a href="#" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition duration-200 hover:bg-slate-700" data-target="reviews">
                   <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.196-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                    Reviews
                </a>
            </nav>

            <!-- Logout -->
            <div class="px-4 py-6">
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
    <h2 class="text-3xl font-semibold text-slate-700 mb-6">Admin Dashboard</h2>

    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Users Card -->
        <div data-modal-target="usersChartModal" class="stat-card bg-white p-6 rounded-xl shadow-md cursor-pointer hover:shadow-lg hover:-translate-y-1 transition-all">
            <div class="flex items-center">
                <div class="bg-blue-100 text-blue-600 p-3 rounded-full mr-4"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg></div>
                <div>
                    <p class="text-sm text-slate-500">Total Users</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $userCount }}</p>
                </div>
            </div>
        </div>

        <!-- Properties Card -->
        <div data-modal-target="propertiesChartModal" class="stat-card bg-white p-6 rounded-xl shadow-md cursor-pointer hover:shadow-lg hover:-translate-y-1 transition-all">
            <div class="flex items-center">
                <div class="bg-purple-100 text-purple-600 p-3 rounded-full mr-4"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg></div>
                <div>
                    <p class="text-sm text-slate-500">Total Properties</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $propertyCount }}</p>
                </div>
            </div>
        </div>

        <!-- Rooms Card -->
        <div data-modal-target="roomsChartModal" class="stat-card bg-white p-6 rounded-xl shadow-md cursor-pointer hover:shadow-lg hover:-translate-y-1 transition-all">
            <div class="flex items-center">
                <div class="bg-green-100 text-green-600 p-3 rounded-full mr-4"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 012-2h3a2 2 0 012 2v14a2 2 0 01-2 2h-3a2 2 0 01-2-2V5z" /></svg></div>
                <div>
                    <p class="text-sm text-slate-500">Total Rooms</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $roomCount }}</p>
                </div>
            </div>
        </div>

        <!-- Reviews Card -->
        <div data-modal-target="reviewsChartModal" class="stat-card bg-white p-6 rounded-xl shadow-md cursor-pointer hover:shadow-lg hover:-translate-y-1 transition-all">
            <div class="flex items-center">
                <div class="bg-yellow-100 text-yellow-600 p-3 rounded-full mr-4"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.196-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg></div>
                <div>
                    <p class="text-sm text-slate-500">Total Reviews</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $reviewCount }}</p>
                </div>
            </div>
        </div>
    </div>
</div> 

<!-- Modals for Charts (Placed outside the main content section) -->

<!-- Users Chart Modal -->
<div id="usersChartModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden z-50">
    <div class="bg-white p-6 rounded-xl shadow-2xl w-full max-w-lg">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold">User Role Distribution</h3>
            <button data-modal-hide="usersChartModal" class="text-2xl font-bold">&times;</button>
        </div>
        <canvas id="userRoleChart"></canvas>
    </div>
</div>

<!-- Properties Chart Modal -->
<div id="propertiesChartModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden z-50">
    <div class="bg-white p-6 rounded-xl shadow-2xl w-full max-w-lg">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold">Rooms per Property</h3>
            <button data-modal-hide="propertiesChartModal" class="text-2xl font-bold">&times;</button>
        </div>
        <canvas id="propertiesChart"></canvas>
    </div>
</div>

<!-- Rooms Chart Modal -->
<div id="roomsChartModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden z-50">
    <div class="bg-white p-6 rounded-xl shadow-2xl w-full max-w-lg">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold">Room Availability Status</h3>
            <button data-modal-hide="roomsChartModal" class="text-2xl font-bold">&times;</button>
        </div>
        <canvas id="roomStatusChart"></canvas>
    </div>
</div>

<!-- Reviews Chart Modal -->
<div id="reviewsChartModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden z-50">
    <div class="bg-white p-6 rounded-xl shadow-2xl w-full max-w-lg">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold">Reviews per Property (Top 10)</h3>
            <button data-modal-hide="reviewsChartModal" class="text-2xl font-bold">&times;</button>
        </div>
        <canvas id="reviewsChart"></canvas>
    </div>
</div>

            <!-- Properties Section -->
             <div id="properties" class="content-section hidden">
                 <div class="flex justify-between items-center mb-8">
                    <h1 class="text-3xl font-semibold text-slate-800">Manage Properties</h1>
                    <button onclick="openPropModal()" class="bg-indigo-500 text-white font-semibold py-2 px-5 rounded-lg hover:bg-indigo-600 transition duration-200 shadow-sm flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Add Property
                    </button>
                </div>
                @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md" role="alert">
                        <strong class="font-bold">Please fix the following errors:</strong>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

              <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <table class="min-w-full text-left">
                <thead class="bg-slate-50 border-b">
            <tr>
                <th class="p-4 text-sm font-semibold text-slate-600">ID</th>
                <th class="p-4 text-sm font-semibold text-slate-600">Property Name</th>
                <th class="p-4 text-sm font-semibold text-slate-600">Type</th>
                <th class="p-4 text-sm font-semibold text-slate-600">City</th>
                <th class="p-4 text-sm font-semibold text-slate-600">Status</th>
                <th class="p-4 text-sm font-semibold text-slate-600">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($properties as $property)
                <tr class="border-b hover:bg-slate-50 transition">
                    <td class="p-4 text-slate-800">{{ $property->id }}</td>
                    <td class="p-4 text-slate-800 font-medium">{{ $property->name }}</td>
                    <td class="p-4 text-slate-600">{{ $property->type }}</td>
                    <td class="p-4 text-slate-600">{{ $property->city }}</td>
                    <td class="p-4">
                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full 
                            @if($property->status == 'Available') bg-green-200 text-green-800
                            @elseif($property->status == 'Full') bg-yellow-200 text-yellow-800
                            @elseif($property->status == 'Under Maintenance') bg-red-200 text-red-800
                            @else bg-red-200 text-red-800 @endif">
                            {{ $property->status }}
                        </span>
                    </td>
                    <td class="p-4 space-x-2">
                        <button type="button" class="text-blue-600 hover:text-blue-800 text-sm font-semibold">Edit</button>
                        <button class="text-red-600 hover:text-red-800 text-sm font-semibold">Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-4 text-center text-slate-500">No properties found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
                <div id="addPropertyModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 hidden">
                <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl">
                    <div class="flex justify-between items-center p-6 border-b">
                        <h2 class="text-2xl font-semibold">Add New Property</h2>
                        <button onclick="closePropModal()" class="text-slate-400 hover:text-slate-600 text-3xl">&times;</button>
                    </div>

        <form action="{{ route('admin.properties.store') }}" method="POST" class="p-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                <div>
                    <label for="prop_name" class="block text-sm font-medium text-slate-700">Property Name</label>
                    <input type="text" name="name" id="prop_name" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md text-sm shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label for="prop_type" class="block text-sm font-medium text-slate-700">Type</label>
                    <select name="type" id="type" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md text-sm shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="" disabled selected>Select a property type...</option>
                        <option value="Apartment">Apartment</option>
                        <option value="House">House</option>
                        <option value="Hostel">Hostel</option>
                        <option value="Studio">Studio</option>
                    </select>
                </div>
                <div>
                    <label for="prop_address" class="block text-sm font-medium text-slate-700">Address</label>
                    <input type="text" name="address" id="prop_address" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md text-sm shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label for="prop_city" class="block text-sm font-medium text-slate-700">City</label>
                    <input type="text" name="city" id="prop_city" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md text-sm shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div class="md:col-span-2">
                    <label for="prop_description" class="block text-sm font-medium text-slate-700">Description</label>
                    <textarea name="description" id="prop_description" rows="3" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md text-sm shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                </div>
                <div>
                    <label for="prop_status" class="block text-sm font-medium text-slate-700">Status</label>
                    <select name="status" id="prop_status" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="available">available</option>
                        <option value="full">full</option>
                        <option value="under_maintenance">under maintenance</option>
                    </select>
                </div>
                <div>
                    <label for="prop_latitude" class="block text-sm font-medium text-slate-700">Latitude</label>
                    <input type="text" name="latitude" id="prop_latitude" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md text-sm shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label for="prop_longitude" class="block text-sm font-medium text-slate-700">Longitude</label>
                    <input type="text" name="longitude" id="prop_longitude" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md text-sm shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                 
            </div>
            
            <div class="flex justify-end items-center pt-6 mt-4 border-t">
                <button type="button" onclick="closePropModal()" class="bg-slate-100 text-slate-800 font-semibold py-2 px-5 rounded-lg hover:bg-slate-200 transition duration-200 mr-2 border border-slate-300">
                    Cancel
                </button>
                <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-5 rounded-lg hover:bg-indigo-700 transition duration-200">
                    Save Property
                </button>
            </div>
        </form>
    </div>
</div>
            <!-- Bookings Section -->
            <div id="bookings" class="content-section hidden">
                <h2 class="text-3xl font-semibold text-slate-700 mb-6">Bookings Schedule</h2>
                <!-- Bookings content goes here -->
            </div>

            <!-- Users Section -->
             <div id="users" class="content-section hidden">
                <!-- Section Header -->
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-3xl font-semibold text-slate-800">User Management</h1>
                    <button onclick="openUserModal()" class="bg-blue-500 text-white font-semibold py-2 px-5 rounded-lg hover:bg-blue-600 transition duration-200 shadow-sm flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Add User
                    </button>
                </div>

                <!-- Success Message -->
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
    
    <!-- Users Table (This is the "GET" part - displaying data) -->
             <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <table class="min-w-full text-left">
                    <thead class="bg-slate-50 border-b">
                <tr>
                    <th class="p-4 text-sm font-semibold text-slate-600">ID</th>
                    <th class="p-4 text-sm font-semibold text-slate-600">Name</th>
                    <th class="p-4 text-sm font-semibold text-slate-600">Email</th>
                    <th class="p-4 text-sm font-semibold text-slate-600">Role</th>
                    <th class="p-4 text-sm font-semibold text-slate-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                
                @forelse ($users as $user)
                    <tr class="border-b hover:bg-slate-50 transition">
                        <td class="p-4 text-slate-800">{{ $user->id }}</td>
                        <td class="p-4 text-slate-800">{{ $user->name }}</td>
                        <td class="p-4 text-slate-600">{{ $user->email }}</td>
                        <td class="p-4">
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full 
                                @if($user->role == 'admin') bg-purple-200 text-purple-800
                                @elseif($user->role == 'agent') bg-blue-200 text-blue-800
                                @else bg-green-200 text-green-800 @endif">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="p-4 space-x-2">
                            <button type="button" class="text-blue-600 hover:text-blue-800 text-sm font-semibold edit-user-btn" data-user="@json($user)">Edit</button>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-semibold">
                                    Delete
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-slate-500">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


<div id="addUserModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md">
        <!-- Modal Header -->
        <div class="flex justify-between items-center p-6 border-b">
            <h2 class="text-2xl font-semibold">Add New User</h2>
            <button onclick="closeUserModal()" class="text-slate-400 hover:text-slate-600 text-3xl">&times;</button>
        </div>
        
        <!-- Modal Body (This is the "POST" part - sending data) -->
        <form action="{{ route('admin.users.store') }}" method="POST" class="p-6">
            @csrf

            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Oops!</strong>
                    <ul class="mt-3 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700">Name</label>
                    <input type="text" name="name" id="name" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm" value="{{ old('name') }}">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Email Address</label>
                    <input type="email" name="email" id="email" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm" value="{{ old('email') }}">
                </div>
                <div>
                    <label for="role" class="block text-sm font-medium text-slate-700">Role</label>
                    <select name="role" id="role" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm">
                        <option value="student">Student</option>
                        <option value="agent">Agent</option>
                    </select>
                </div>
                 <div id="licenseNumberField" class="hidden">
                    <label for="license_number" class="block text-sm font-medium text-slate-700">Agent License Number</label>
                    <input type="text" name="license_number" id="license_number" class="mt-1 block w-full ..." value="{{ old('license_number') }}">
                </div>
                 <div>
                    <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                    <input type="password" name="password" id="password" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm">
                </div>
                 <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm">
                </div>
            </div>
            
            <!-- Modal Footer -->
            <div class="flex justify-end items-center pt-6 mt-4 border-t">
                <button type="button" onclick="closeUserModal()" class="bg-slate-100 text-slate-800 font-semibold py-2 px-5 rounded-lg hover:bg-slate-200 transition duration-200 mr-2 border border-slate-300">
                    Cancel
                </button>
                <button type="submit" class="bg-purple-600 text-white font-semibold py-2 px-5 rounded-lg hover:bg-purple-700 transition duration-200">
                    Create User
                </button>
            </div>
        </form>
    </div>
</div>
            <!-- EDIT USER MODAL -->
<div id="editUserModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 hidden">
  <div class="bg-white rounded-xl shadow-2xl w-full max-w-md">
    <div class="flex justify-between items-center p-6 border-b">
      <h2 class="text-2xl font-semibold">Edit User</h2>
      <button onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600 text-3xl">&times;</button>
    </div>

    <form id="editUserForm" method="POST" class="p-6">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="_method" value="PUT">

      <div class="space-y-4">
        <div>
          <label for="edit_name" class="block text-sm font-medium text-slate-700">Name</label>
          <input type="text" name="name" id="edit_name" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md text-sm">
        </div>
        <div>
          <label for="edit_email" class="block text-sm font-medium text-slate-700">Email</label>
          <input type="email" name="email" id="edit_email" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md text-sm">
        </div>
        <div>
          <label for="edit_role" class="block text-sm font-medium text-slate-700">Role</label>
          <select name="role" id="edit_role" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md text-sm">
            <option value="student">Student</option>
            <option value="agent">Agent</option>
            <option value="admin">Admin</option>
          </select>
        </div>
      </div>

      <div class="flex justify-end items-center pt-6 mt-4 border-t">
        <button type="button" class="bg-slate-100 text-slate-800 font-semibold py-2 px-5 rounded-lg hover:bg-slate-200 border mr-2">Cancel</button>
        <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-5 rounded-lg hover:bg-blue-700">Update User</button>
      </div>
    </form>
  </div>
</div>


            <!-- Reviews Section -->
            <div id="reviews" class="content-section hidden">
                <h2 class="text-3xl font-semibold text-slate-700 mb-6">Property & Room Reviews</h2>
                <!-- Reviews content goes here -->
            </div>
        </main>
    </div>



   
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const links = document.querySelectorAll('.sidebar-link');
        const sections = document.querySelectorAll('.content-section');

        // This is the function that shows one section and hides the others
        const showSection = (targetId) => {
            console.log(`Attempting to show section: #${targetId}`);

            // Hide all content sections
            sections.forEach(section => {
                section.classList.add('hidden');
            });

            // Find the specific section to show
            const targetSection = document.getElementById(targetId);

            if (targetSection) {
                // If found, remove the 'hidden' class to make it visible
                targetSection.classList.remove('hidden');
                console.log(`Successfully displayed #${targetId}`);
            } else {
                console.error(`Error: Could not find a section with the ID "${targetId}"`);
            }
        };

        // --- Handle Initial Page Load ---
        const initiallyActiveLink = document.querySelector('.sidebar-link.active');
        if (initiallyActiveLink) {
            const initialTarget = initiallyActiveLink.getAttribute('data-target');
            showSection(initialTarget);
        }

        // --- Handle Clicks on Sidebar Links ---
        links.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();

                // Remove 'active' class from all links
                links.forEach(l => l.classList.remove('active'));
                
                // Add 'active' class to the one that was clicked
                this.classList.add('active');

                const targetId = this.getAttribute('data-target');
                
                // Call the function to show the correct section
                showSection(targetId);
            });
        });
        const roleDropdown = document.getElementById('role');
    const licenseField = document.getElementById('licenseNumberField');

    // Function to check the dropdown value
    const toggleLicenseField = () => {
        if (roleDropdown.value === 'agent') {
            licenseField.classList.remove('hidden'); // Show the field
        } else {
            licenseField.classList.add('hidden'); // Hide the field
        }
    };

    // === 1. PASS LARAVEL DATA TO JAVASCRIPT ===
    // This safely transfers the data from your controller to the script
    const userRoleData = @json($userRoleData);
    const propertiesWithRoomCount = @json($propertiesWithRoomCount);
    const roomStatusData = @json($roomStatusData);
    const propertiesWithReviewCount = @json($propertiesWithReviewCount);

    // === 2. CHART RENDERING FUNCTIONS ===

    // Chart for User Roles (Doughnut Chart)
    const renderUserChart = () => {
        new Chart(document.getElementById('userRoleChart'), {
            type: 'doughnut',
            data: {
                labels: userRoleData.map(row => row.role.charAt(0).toUpperCase() + row.role.slice(1)),
                datasets: [{
                    label: 'User Roles',
                    data: userRoleData.map(row => row.count),
                    backgroundColor: ['#60A5FA', '#818CF8'], // Blue, Indigo
                    hoverOffset: 4
                }]
            }
        });
    };

    // Chart for Rooms per Property (Horizontal Bar Chart)
    const renderPropertiesChart = () => {
        new Chart(document.getElementById('propertiesChart'), {
            type: 'bar',
            data: {
                labels: propertiesWithRoomCount.map(p => p.name),
                datasets: [{
                    label: '# of Rooms',
                    data: propertiesWithRoomCount.map(p => p.rooms_count),
                    backgroundColor: '#A78BFA', // Purple
                }]
            },
            options: { 
                indexAxis: 'y', // This makes the bar chart horizontal
                scales: {
                    x: { ticks: { stepSize: 1 } } // Ensure Y-axis shows whole numbers
                }
            } 
        });
    };
    
    // Chart for Room Status (Pie Chart)
    const renderRoomStatusChart = () => {
         new Chart(document.getElementById('roomStatusChart'), {
            type: 'pie',
            data: {
                labels: roomStatusData.map(row => row.label),
                datasets: [{
                    label: 'Room Status',
                    data: roomStatusData.map(row => row.count),
                    backgroundColor: ['#34D399', '#F87171'], // Green, Red
                    hoverOffset: 4
                }]
            }
        });
    };

    // Chart for Reviews per Property (Horizontal Bar Chart)
    const renderReviewsChart = () => {
        new Chart(document.getElementById('reviewsChart'), {
            type: 'bar',
            data: {
                labels: propertiesWithReviewCount.map(p => p.name),
                datasets: [{
                    label: '# of Reviews',
                    data: propertiesWithReviewCount.map(p => p.reviews_count),
                    backgroundColor: '#FBBF24', // Amber
                }]
            },
            options: { 
                indexAxis: 'y', // This makes the bar chart horizontal
                scales: {
                    x: { ticks: { stepSize: 1 } } // Ensure Y-axis shows whole numbers
                }
            }
        });
    };
    
    // === 3. MODAL AND EVENT LISTENER LOGIC ===
    const statCards = document.querySelectorAll('.stat-card');
    let initializedCharts = {}; // To prevent re-drawing a chart every time a modal opens

    statCards.forEach(card => {
        // This listens for a click on each statistics card
        card.addEventListener('click', () => {
            const modalId = card.dataset.modalTarget;
            const modal = document.getElementById(modalId);
            
            if (modal) {
                // Show the modal
                modal.classList.remove('hidden');

                // IMPORTANT: Render the chart only the first time the modal is opened
                if (!initializedCharts[modalId]) {
                    if (modalId === 'usersChartModal') renderUserChart();
                    if (modalId === 'propertiesChartModal') renderPropertiesChart();
                    if (modalId === 'roomsChartModal') renderRoomStatusChart();
                    if (modalId === 'reviewsChartModal') renderReviewsChart();
                    initializedCharts[modalId] = true; // Mark chart as initialized
                }
            }
        });
    });

    // This adds functionality to all the 'close' buttons in the modals
    document.querySelectorAll('[data-modal-hide]').forEach(button => {
        button.addEventListener('click', () => {
             const modalId = button.closest('.fixed.inset-0').id;
             document.getElementById(modalId).classList.add('hidden');
        });
    });


    

    // Add an event listener to the dropdown
    roleDropdown.addEventListener('change', toggleLicenseField);

    // Run it once on page load in case of validation errors
    toggleLicenseField();
    });
     // --- User Modals ---
    function openUserModal() {
        document.getElementById('addUserModal').classList.remove('hidden');
    }
    function closeUserModal() {
        document.getElementById('addUserModal').classList.add('hidden');
    }

    // --- Edit User Modal ---
    function openEditModal(user) {
        const modal = document.getElementById('editUserModal');
        // Populate the form fields
        document.getElementById('edit_name').value = user.name;
        document.getElementById('edit_email').value = user.email;
        document.getElementById('edit_role').value = user.role;
        // Set the form action dynamically for the update
        document.getElementById('editUserForm').action = `/admin/users/${user.id}`;
        
        modal.classList.remove('hidden');
    }
    function closeEditModal() {
        document.getElementById('editUserModal').classList.add('hidden');
    }

    // --- Property Modals ---
    function openPropModal() {
        document.getElementById('addPropertyModal').classList.remove('hidden');
    }
    function closePropModal() {
        document.getElementById('addPropertyModal').classList.add('hidden');
    }

    </script>
</body>
</html>