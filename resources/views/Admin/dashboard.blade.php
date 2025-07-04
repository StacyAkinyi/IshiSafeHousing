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
                <a href="#" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition duration-200 hover:bg-slate-700" data-target="users">
                    <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Users
                </a>
                <a href="#" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition duration-200 hover:bg-slate-700" data-target="properties">
                    <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Properties
                </a>
                 <a href="#" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition duration-200 hover:bg-slate-700" data-target="bookings">
                    <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    Bookings
                </a>
                <a href="#" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition duration-200 hover:bg-slate-700" data-target="reviews">
                   <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.196-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                    Reviews
                </a>
                <a href="#" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition duration-200 hover:bg-slate-700" data-target="next-of-kin">
                    <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Next of Kin
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

                     <div data-modal-target="bookingsAnalyticsModal" class="stat-card bg-white p-6 rounded-xl shadow-md cursor-pointer hover:shadow-lg hover:-translate-y-1 transition-all">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-slate-500">Total Bookings</p>
                                <p class="text-3xl font-bold text-slate-800 mt-1">{{ $bookingCount }}</p>
                            </div>
                            <div class="bg-green-100 text-green-600 p-3 rounded-full"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg></div>
                        </div>
                        <p class="text-xs text-slate-400 mt-4">View Status & Property Breakdown</p>
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

             <div id="bookingsAnalyticsModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden z-50 p-4">
                <div class="bg-white p-6 rounded-xl shadow-2xl w-full max-w-4xl">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold">Bookings Analytics</h3>
                        <button data-modal-hide="bookingsAnalyticsModal" class="text-2xl font-bold">&times;</button>
                        </div>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <div>
                                <h4 class="text-center font-semibold mb-2">By Status</h4>
                                <canvas id="bookingsByStatusChart"></canvas>
                                </div>
                               
                            </div>
                </div>
            </div>

            <!-- Properties Section -->
<div id="properties" class="content-section">
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

    <div class="bg-white rounded-xl shadow-md overflow-hidden ">
        <table class="min-w-full text-left">
            <thead class="bg-slate-50 border-b">
                <tr>
                    <th class="p-4 text-sm font-semibold text-slate-600">ID</th>
                    
                    <th class="p-4 text-sm font-semibold text-slate-600">Property Name</th>
                    <th class="p-4 text-sm font-semibold text-slate-600">Type</th>
                    <th class="p-4 text-sm font-semibold text-slate-600">City</th>
                    <th class="p-4 text-sm font-semibold text-slate-600">Status</th>
                    <th class="p-4 text-sm font-semibold text-slate-600 text-center">Rooms</th>
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
                                @if($property->status == 'available') bg-green-200 text-green-800
                                @elseif($property->status == 'full') bg-yellow-200 text-yellow-800
                                @else bg-red-200 text-red-800 @endif">
                                {{ ucfirst(str_replace('_', ' ', $property->status)) }}
                            </span>
                        </td>
                        <td class="p-4 text-center">
                            <button type="button" 
                                    data-property-id="{{ $property->id }}" 
                                    class="view-rooms-btn text-indigo-600 hover:text-indigo-800 text-sm font-semibold">
                                View ({{ $property->rooms_count }})
                            </button>
                        </td>
                        <td class="p-4 space-x-2">
                            {{-- Updated Edit Button with data-image attribute --}}
                            <button type="button" 
                                class="edit-property-btn text-blue-600 hover:text-blue-800 text-sm font-semibold"
                                data-id="{{ $property->id }}"
                                data-name="{{ $property->name }}"
                                data-type="{{ $property->type }}"
                                data-address="{{ $property->address }}"
                                data-city="{{ $property->city }}"
                                data-description="{{ $property->description }}"
                                data-status="{{ $property->status }}"
                                data-latitude="{{ $property->latitude }}"
                                data-longitude="{{ $property->longitude }}"
                                data-image="{{ $property->image ? asset('storage/' . $property->image) : '' }}"
                                data-action="{{ route('admin.properties.update', $property->id) }}">
                                Edit
                            </button>
                            <form action="{{ route('admin.properties.destroy', $property->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this property?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-semibold">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="p-4 text-center text-slate-500">No properties found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ======================================================= -->
<!-- ================= ADD PROPERTY MODAL ================== -->
<!-- ======================================================= -->
<div id="addPropertyModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 hidden z-50">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl flex flex-col max-h-[90vh]">
        <div class="flex justify-between items-center p-6 border-b">
            <h2 class="text-2xl font-semibold">Add New Property</h2>
            <button onclick="closePropModal()" class="text-slate-400 hover:text-slate-600 text-3xl">&times;</button>
        </div>
        {{-- Added enctype for file uploads --}}
        <form action="{{ route('admin.properties.store') }}" method="POST" class="p-6 flex-1 overflow-y-auto" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                <div>
                    <label for="prop_name" class="block text-sm font-medium text-slate-700">Property Name</label>
                    <input type="text" name="name" id="prop_name" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="prop_type" class="block text-sm font-medium text-slate-700">Type</label>
                    <select name="type" id="type" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm">
                        <option value="" disabled selected>Select a property type...</option>
                        <option value="Apartment">Apartment</option>
                        <option value="House">House</option>
                        <option value="Hostel">Hostel</option>
                        <option value="Studio">Studio</option>
                    </select>
                </div>
                <div>
                    <label for="prop_address" class="block text-sm font-medium text-slate-700">Address</label>
                    <input type="text" name="address" id="prop_address" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="prop_city" class="block text-sm font-medium text-slate-700">City</label>
                    <input type="text" name="city" id="prop_city" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm">
                </div>
                <div class="md:col-span-2">
                    <label for="prop_description" class="block text-sm font-medium text-slate-700">Description</label>
                    <textarea name="description" id="prop_description" rows="3" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm"></textarea>
                </div>
                {{-- Added Image Input Field --}}
                <div class="md:col-span-2">
                    <label for="prop_image" class="block text-sm font-medium text-slate-700">Featured Image</label>
                    <input type="file" name="image" id="prop_image" class="mt-1 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                </div>
                <div>
                    <label for="prop_status" class="block text-sm font-medium text-slate-700">Status</label>
                    <select name="status" id="prop_status" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md shadow-sm">
                        <option value="available">Available</option>
                        <option value="full">Full</option>
                        <option value="under_maintenance">Under Maintenance</option>
                    </select>
                </div>
                <div>
                    <label for="prop_latitude" class="block text-sm font-medium text-slate-700">Latitude</label>
                    <input type="text" name="latitude" id="prop_latitude" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="prop_longitude" class="block text-sm font-medium text-slate-700">Longitude</label>
                    <input type="text" name="longitude" id="prop_longitude" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm">
                </div>
            </div>
            <div class="flex justify-end items-center pt-6 mt-4 border-t">
                <button type="button" onclick="closePropModal()" class="bg-slate-100 text-slate-800 font-semibold py-2 px-5 rounded-lg hover:bg-slate-200 mr-2 border">Cancel</button>
                <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-5 rounded-lg hover:bg-indigo-700">Save Property</button>
            </div>
        </form>
    </div>
</div>

<!-- ======================================================= -->
<!-- ================ EDIT PROPERTY MODAL ================== -->
<!-- ======================================================= -->
<div id="editPropertyModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 hidden z-50">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl flex flex-col max-h-[90vh]">
        <div class="flex justify-between items-center p-6 border-b">
            <h2 class="text-2xl font-semibold">Edit Property</h2>
            <button onclick="closeEditPropModal()" class="text-slate-400 hover:text-slate-600 text-3xl">&times;</button>
        </div>
        {{-- Added enctype for file uploads --}}
        <form id="editPropertyForm" method="POST" class="p-6 flex-1 overflow-y-auto" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                <div>
                    <label for="edit_prop_name" class="block text-sm font-medium text-slate-700">Property Name</label>
                    <input type="text" name="name" id="edit_prop_name" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="edit_prop_type" class="block text-sm font-medium text-slate-700">Type</label>
                    <select name="type" id="edit_prop_type" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm">
                        <option value="Apartment">Apartment</option>
                        <option value="House">House</option>
                        <option value="Hostel">Hostel</option>
                        <option value="Studio">Studio</option>
                    </select>
                </div>
                <div>
                    <label for="edit_prop_address" class="block text-sm font-medium text-slate-700">Address</label>
                    <input type="text" name="address" id="edit_prop_address" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="edit_prop_city" class="block text-sm font-medium text-slate-700">City</label>
                    <input type="text" name="city" id="edit_prop_city" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm">
                </div>
                <div class="md:col-span-2">
                    <label for="edit_prop_description" class="block text-sm font-medium text-slate-700">Description</label>
                    <textarea name="description" id="edit_prop_description" rows="3" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm"></textarea>
                </div>

                {{-- Added Image Input Field with Preview --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-700">Featured Image</label>
                    <div class="mt-2 flex items-center space-x-6">
                        <img id="edit_image_preview" src="" alt="Current Image" class="h-20 w-20 object-cover rounded-md bg-slate-100">
                        <div class="flex-1">
                            <input type="file" name="image" id="edit_prop_image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            <p class="mt-1 text-xs text-slate-500">Upload a new image to replace the current one.</p>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="edit_prop_status" class="block text-sm font-medium text-slate-700">Status</label>
                    <select name="status" id="edit_prop_status" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md shadow-sm">
                        <option value="available">Available</option>
                        <option value="full">Full</option>
                        <option value="under_maintenance">Under Maintenance</option>
                    </select>
                </div>
                <div>
                    <label for="edit_prop_latitude" class="block text-sm font-medium text-slate-700">Latitude</label>
                    <input type="text" name="latitude" id="edit_prop_latitude" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="edit_prop_longitude" class="block text-sm font-medium text-slate-700">Longitude</label>
                    <input type="text" name="longitude" id="edit_prop_longitude" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm">
                </div>
            </div>
            <div class="flex justify-end items-center pt-6 mt-4 border-t">
                <button type="button" onclick="closeEditPropModal()" class="bg-slate-100 text-slate-800 font-semibold py-2 px-5 rounded-lg hover:bg-slate-200 mr-2 border">Cancel</button>
                <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-5 rounded-lg hover:bg-indigo-700">Save Changes</button>
            </div>
        </form>
    </div>
</div>




                <div id="roomsListModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden z-50 p-4">
                    <div class="bg-white p-6 md:p-8 rounded-xl shadow-2xl w-full max-w-2xl flex flex-col max-h-[90vh]">
                        <div class="flex justify-between items-center mb-4 border-b pb-4">
                            <h3 id="modalPropertyName" class="text-2xl font-semibold text-slate-800">Rooms</h3>
                            <button data-modal-hide="roomsListModal" class="text-3xl font-bold leading-none hover:text-red-600">&times;</button>
                        </div>
                        <div id="modalRoomListContainer" class="flex-1 overflow-y-auto">
                            </div>
                    </div>
                </div>

                
            <!-- Bookings Section -->
            <div id="bookings" class="content-section hidden">
                <h2 class="text-3xl font-semibold text-slate-700 mb-6">Bookings Schedule</h2>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="bg-white rounded-xl shadow-md overflow-x-auto">
                    <table class="min-w-full text-left text-sm whitespace-nowrap">
                        <thead class="bg-slate-50 border-b">
                            <tr>
                                <th class="p-4 font-semibold">Room #</th>
                                <th class="p-4 font-semibold">Student Name</th>
                                <th class="p-4 font-semibold">Student Phone</th>
                                <th class="p-4 font-semibold">Start Date</th>
                                <th class="p-4 font-semibold">End Date</th>
                                <th class="p-4 font-semibold">Status</th>
                                <th class="p-4 font-semibold text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bookings as $booking)
                                <tr class="border-b hover:bg-slate-50">
                                    <td class="p-4 font-medium text-slate-800">{{ $booking->room->room_number ?? 'N/A' }}</td>
                                    <td class="p-4">{{ $booking->student->user->name ?? 'N/A' }}</td>
                                    <td class="p-4 text-slate-600">{{ $booking->student->phone_number ?? 'N/A' }}</td>
                                    <td class="p-4 text-slate-600">{{ $booking->start_date->format('M d, Y') }}</td>
                                    <td class="p-4 text-slate-600">{{ $booking->end_date->format('M d, Y') }}</td>
                                    <td class="p-4">
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full 
                                            @if($booking->status == 'pending') bg-yellow-200 text-yellow-800
                                            @elseif($booking->status == 'confirmed') bg-green-200 text-green-800
                                            @elseif($booking->status == 'completed') bg-blue-200 text-blue-800
                                            @else bg-red-200 text-red-800 @endif">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-center">
                                        <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this booking? This action cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-6 text-center text-slate-500">There are no bookings in the system yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
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
                            <button onclick='openEditModal(@json($user))' type="button" class="text-blue-600 hover:text-blue-800 text-sm font-semibold edit-user-btn" >Edit</button>
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


<div id="addUserModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden z-50 p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg flex flex-col max-h-[90vh]">
        <!-- Modal Header -->
         <div class="flex-shrink-0 p-6 border-b border-slate-200 flex justify-between items-center">
            <h2 class="text-2xl font-semibold">Add New User</h2>
            <button onclick="closeUserModal()" class="text-slate-400 hover:text-slate-600 text-3xl">&times;</button>
        </div>
        <div class="flex-1 p-6 overflow-y-auto">
        
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
                <div id="phoneNumberField" class="hidden">
                    <label for="phone_number" class="block text-sm font-medium text-slate-700">Phone Number</label>
                    <input type="tel" name="phone_number" id="phone_number" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm" placeholder="e.g., 0712345678" value="{{ old('phone_number') }}">
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
        @csrf
        @method('PATCH') 
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
                
                <div class="bg-white rounded-xl shadow-md overflow-x-auto">
                    <table class="min-w-full text-left text-sm whitespace-nowrap">
                        <thead class="bg-slate-50 border-b">
                            <tr>
                                <th class="p-4 font-semibold">Property</th>
                                <th class="p-4 font-semibold">Room #</th>
                                <th class="p-4 font-semibold">Student</th>
                                <th class="p-4 font-semibold text-center">Rating</th>
                                <th class="p-4 font-semibold">Comment</th>
                                <th class="p-4 font-semibold">Date</th>
                                <th class="p-4 font-semibold text-center">Action</th> </tr>
                        </thead>
                        <tbody>
                            @forelse ($reviews as $review)
                                <tr class="border-b hover:bg-slate-50">
                                    <td class="p-4 align-top">{{ $review->booking->room->property->name ?? 'N/A' }}</td>
                                    <td class="p-4 align-top">{{ $review->booking->room->room_number ?? 'N/A' }}</td>
                                    <td class="p-4 align-top">{{ $review->booking->student->user->name ?? 'N/A' }}</td>
                                    <td class="p-4 align-top text-center">
                                        <div class="flex items-center justify-center">
                                            <span class="font-bold text-base mr-1">{{ $review->rating }}</span>
                                            <svg class="h-4 w-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        </div>
                                    </td>
                                    <td class="p-4 align-top text-slate-600 whitespace-normal">
                                    "{{ $review->description }}"
                                    </td>
                                    <td class="p-4 align-top text-slate-500">{{ $review->created_at->format('M d, Y') }}</td>

                                    <td class="p-4 align-top text-center">
                                        <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this review?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-6 text-center text-slate-500">There are no reviews in the system yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Next of Kin Section-->
            <div id="next-of-kin" class="content-section hidden">
                <h2 class="text-3xl font-semibold text-slate-700 mb-6">Next of Kin Records</h2>

                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-sm whitespace-nowrap">
                            <thead class="bg-slate-50 border-b">
                                <tr>
                                    <th class="p-4 font-semibold text-slate-600">Student Name</th>
                                    <th class="p-4 font-semibold text-slate-600">Next of Kin Name</th>
                                    <th class="p-4 font-semibold text-slate-600">Relationship</th>
                                    <th class="p-4 font-semibold text-slate-600">NOK Phone</th>
                                    <th class="p-4 font-semibold text-slate-600">NOK Email</th>
                                    <th class="p-4 font-semibold text-slate-600">NOK National ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($nextOfKinDetails as $kin)
                                    <tr class="border-b hover:bg-slate-50 transition">
                                        <td class="p-4 font-medium text-slate-900">{{ $kin->student->user->name ?? 'N/A' }}</td>
                                        <td class="p-4 text-slate-800">{{ $kin->name ?? 'N/A' }}</td>
                                        <td class="p-4 text-slate-600">{{ $kin->relationship ?? 'N/A' }}</td>
                                        <td class="p-4 text-slate-600">{{ $kin->phone_number ?? 'N/A' }}</td>
                                        <td class="p-4 text-slate-600">{{ $kin->email ?? 'N/A' }}</td>
                                        <td class="p-4 text-slate-600">{{ $kin->id_number ?? 'N/A' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="p-8 text-center text-slate-500">
                                            There are no next of kin records in the system yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                    


        </main>
    </div>

<script>
        document.addEventListener('DOMContentLoaded', function () {
        const links = document.querySelectorAll('.sidebar-link');
        const sections = document.querySelectorAll('.content-section');

        const roomsModal = document.getElementById('roomsListModal');
        const modalPropertyNameEl = roomsModal.querySelector('#modalPropertyName');
        const modalRoomListContainer = roomsModal.querySelector('#modalRoomListContainer');

        const modalTriggers = document.querySelectorAll('[data-modal-target]');
        const modalHides = document.querySelectorAll('[data-modal-hide]');
        
        // --- Event Listeners ---
        // General listener for buttons that OPEN modals
        modalTriggers.forEach(button => {
            button.addEventListener('click', () => {
                const modal = document.getElementById(button.dataset.modalTarget);
                if(modal) modal.classList.remove('hidden');
            });
        });

        // General listener for buttons that CLOSE modals
        modalHides.forEach(button => {
            button.addEventListener('click', () => {
                const modal = document.getElementById(button.dataset.modalHide);
                if(modal) modal.classList.add('hidden');
            });
        });
    

            // Listen for clicks on ANY 'View Rooms' button
            document.querySelectorAll('.view-rooms-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const propertyId = this.dataset.propertyId;
                    
                    // Show modal in loading state
                    modalPropertyNameEl.textContent = 'Loading...';
                    modalRoomListContainer.innerHTML = '<p class="text-center text-slate-500 py-8">Fetching rooms...</p>';
                    roomsModal.classList.remove('hidden');

                    // Fetch the room data from the API
                    fetch(`/admin/properties/${propertyId}/rooms`)
                        .then(response => response.json())
                        .then(data => {
                            // Update modal title
                            modalPropertyNameEl.textContent = `Rooms in ${data.property_name}`;
                            
                            // Clear loading message
                            modalRoomListContainer.innerHTML = '';
                            
                            if (data.rooms && data.rooms.length > 0) {
                                const table = document.createElement('table');
                                table.className = 'min-w-full text-left text-sm';
                                table.innerHTML = `
                                    <thead class="bg-slate-50 border-b">
                                        <tr>
                                            <th class="p-3 font-semibold">Room #</th>
                                            <th class="p-3 font-semibold">Agent</th>
                                            <th class="p-3 font-semibold">PhoneNumber</th>
                                            <th class="p-3 font-semibold">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                `;
                                const tbody = table.querySelector('tbody');
                                data.rooms.forEach(room => {
                                    const statusClass = room.is_available ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800';
                                    const statusText = room.is_available ? 'Available' : 'Occupied';
                                    tbody.innerHTML += `
                                        <tr class="border-b">
                                            <td class="p-3 font-medium">${room.room_number}</td>
                                            <td class="p-3">${room.agent?.user?.name || 'N/A'}</td>
                                            <td class="p-3">${room.agent?.phone_number || 'N/A'}</td>
                                            <td class="p-3"><span class="px-2 py-1 text-xs font-semibold rounded-full ${statusClass}">${statusText}</span></td>
                                        </tr>
                                    `;
                                });
                                modalRoomListContainer.appendChild(table);
                            } else {
                                modalRoomListContainer.innerHTML = '<p class="text-center text-slate-500 py-8">This property has no rooms.</p>';
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching rooms:', error);
                            modalRoomListContainer.innerHTML = '<p class="text-center text-red-500 py-8">Could not load rooms.</p>';
                        });
                });
            });

            // General listener for all close buttons
            document.querySelectorAll('[data-modal-hide]').forEach(button => {
                button.addEventListener('click', function() {
                    const modalId = this.dataset.modalHide;
                    document.getElementById(modalId).classList.add('hidden');
                });
            });



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
    const phoneField = document.getElementById('phoneNumberField');

    // Function to check the dropdown value
    const toggleLicenseField = () => {
        if (roleDropdown.value === 'agent') {
            licenseField.classList.remove('hidden'); // Show the field
            phoneField.classList.remove('hidden');
            licenseInput.required = true;
            phoneInput.required = true;
        } else {
            licenseField.classList.add('hidden'); // Hide the field
            phoneField.classList.add('hidden');
            licenseInput.required = false;
            phoneInput.required = false;
        }
    };

    // === 1. PASS LARAVEL DATA TO JAVASCRIPT ===
    // This safely transfers the data from your controller to the script
    const userRoleData = @json($userRoleData);
    const propertiesWithRoomCount = @json($propertiesWithRoomCount);
    const roomStatusData = @json($roomStatusData);
    const propertiesWithReviewCount = @json($propertiesWithReviewCount);
    const bookingsByStatusData = @json($bookingsByStatus ?? []);
    

    // === 2. CHART RENDERING FUNCTIONS ===

    const renderBookingStatusChart = () => {
        new Chart(document.getElementById('bookingsByStatusChart'), {
            type: 'doughnut',
            data: {
                labels: bookingsByStatusData.map(row => row.status.charAt(0).toUpperCase() + row.status.slice(1)),
                datasets: [{
                    label: 'Booking Statuses',
                    data: bookingsByStatusData.map(row => row.count),
                    backgroundColor: ['#FBBF24', '#10B981', '#EF4444', '#3B82F6'], // Yellow, Green, Red, Blue
                    hoverOffset: 4
                }]
            }
        });
    };

       


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

                    if (modalId === 'bookingsAnalyticsModal') {
                            renderBookingStatusChart();
                           
                        }
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
    const editModal = document.getElementById('editPropertyModal');
    const imagePreview = document.getElementById('edit_image_preview');
    const editForm = document.getElementById('editPropertyForm');
    const editButtons = document.querySelectorAll('.edit-property-btn');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const property = this.dataset;

            // Set the form's action to the correct update route
            editForm.action = property.action;

            // Fill all the form fields with the property's data
            document.getElementById('edit_prop_name').value = property.name;
            document.getElementById('edit_prop_type').value = property.type;
            document.getElementById('edit_prop_address').value = property.address;
            document.getElementById('edit_prop_city').value = property.city;
            document.getElementById('edit_prop_description').value = property.description;
            document.getElementById('edit_prop_status').value = property.status;

            if (property.image) {
                imagePreview.src = property.image;
                imagePreview.classList.remove('hidden');
            } else {
                imagePreview.src = '';
                imagePreview.classList.add('hidden');
            }
            // Show the modal
            editModal.classList.remove('hidden');
        });
    });

    // Function to close the modal
    function closeEditPropModal() {
        editModal.classList.add('hidden');
    }

    </script>
</body>
</html>