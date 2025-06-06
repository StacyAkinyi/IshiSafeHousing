<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IshiSafeHousing - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
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
            background-color: #4f46e5; /* Indigo 600 */
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
                 <a href="#" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition duration-200 hover:bg-slate-700" data-target="appointments">
                    <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    Appointments
                </a>
                <a href="{{route('users')}}" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition duration-200 hover:bg-slate-700" data-target="users">
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
                 <a href="#" class="flex items-center py-3 px-4 rounded-lg text-red-300 transition duration-200 hover:bg-red-500 hover:text-white">
                    <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                    Logout
                </a>
            </div>
        </aside>

        <!-- Right Content Area -->
        <main class="flex-1 p-6 lg:p-10 transition-all duration-300">
            <!-- Content sections will be swapped here by JavaScript -->
            <div id="dashboard" class="content-section">
                <h2 class="text-3xl font-semibold text-slate-700 mb-6">Admin Dashboard</h2>
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white p-6 rounded-xl shadow-md flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500">Total Properties</p>
                            <p class="text-3xl font-bold text-slate-800">125</p>
                        </div>
                        <div class="bg-indigo-100 text-indigo-500 p-3 rounded-full">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-md flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500">Active Tenants</p>
                            <p class="text-3xl font-bold text-slate-800">450</p>
                        </div>
                        <div class="bg-green-100 text-green-500 p-3 rounded-full">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-md flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500">Pending Appointments</p>
                            <p class="text-3xl font-bold text-slate-800">12</p>
                        </div>
                        <div class="bg-amber-100 text-amber-500 p-3 rounded-full">
                           <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                    </div>
                     <div class="bg-white p-6 rounded-xl shadow-md flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500">Avg. Rating</p>
                            <p class="text-3xl font-bold text-slate-800">4.7</p>
                        </div>
                        <div class="bg-sky-100 text-sky-500 p-3 rounded-full">
                           <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.196-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                        </div>
                    </div>
                </div>
            </div>

            <div id="properties" class="content-section hidden">
                <h2 class="text-3xl font-semibold text-slate-700 mb-6">Manage Properties</h2>
                <!-- Add Property Button -->
                <div class="mb-6 text-right">
                    <button class="bg-indigo-500 text-white font-semibold py-2 px-5 rounded-lg hover:bg-indigo-600 transition duration-200 shadow-sm">Add New Property</button>
                </div>
                <!-- Properties Table -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <table class="min-w-full text-left">
                        <thead class="bg-slate-50 border-b">
                            <tr>
                                <th class="p-4 text-sm font-semibold text-slate-600">Name</th>
                                <th class="p-4 text-sm font-semibold text-slate-600">Type</th>
                                <th class="p-4 text-sm font-semibold text-slate-600">City</th>
                                <th class="p-4 text-sm font-semibold text-slate-600">Status</th>
                                <th class="p-4 text-sm font-semibold text-slate-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Sample Row 1 -->
                            <tr class="border-b hover:bg-slate-50 transition">
                                <td class="p-4 text-slate-800">Greenwood Apartments</td>
                                <td class="p-4 text-slate-600">Apartment</td>
                                <td class="p-4 text-slate-600">Nairobi</td>
                                <td class="p-4"><span class="bg-green-100 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full">Available</span></td>
                                <td class="p-4 space-x-2">
                                    <button class="text-indigo-500 hover:text-indigo-700">Edit</button>
                                    <button class="text-red-500 hover:text-red-700">Delete</button>
                                </td>
                            </tr>
                            <!-- Sample Row 2 -->
                            <tr class="border-b hover:bg-slate-50 transition">
                                <td class="p-4 text-slate-800">Campus Point Hostel</td>
                                <td class="p-4 text-slate-600">Hostel</td>
                                <td class="p-4 text-slate-600">Mombasa</td>
                                <td class="p-4"><span class="bg-red-100 text-red-700 text-xs font-semibold px-2.5 py-1 rounded-full">Full</span></td>
                                <td class="p-4 space-x-2">
                                    <button class="text-indigo-500 hover:text-indigo-700">Edit</button>
                                    <button class="text-red-500 hover:text-red-700">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="appointments" class="content-section hidden">
                <h2 class="text-3xl font-semibold text-slate-700 mb-6">Appointments Schedule</h2>
                <!-- Appointments List -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <ul class="space-y-4">
                       <!-- Sample Item 1 -->
                       <li class="p-4 border rounded-lg flex items-center justify-between hover:bg-slate-50">
                           <div>
                               <p class="font-semibold text-slate-800">Aisha Stacy - Greenwood Apartments</p>
                               <p class="text-sm text-slate-500">June 10, 2025 at 2:00 PM</p>
                           </div>
                           <div>
                               <span class="bg-amber-100 text-amber-700 text-xs font-semibold px-2.5 py-1 rounded-full">Pending</span>
                               <button class="ml-4 text-indigo-500 hover:text-indigo-700">View</button>
                           </div>
                       </li>
                       <!-- Sample Item 2 -->
                       <li class="p-4 border rounded-lg flex items-center justify-between hover:bg-slate-50">
                           <div>
                               <p class="font-semibold text-slate-800">John Doe - Campus Point Hostel</p>
                               <p class="text-sm text-slate-500">June 9, 2025 at 11:00 AM</p>
                           </div>
                           <div>
                               <span class="bg-green-100 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full">Confirmed</span>
                               <button class="ml-4 text-indigo-500 hover:text-indigo-700">View</button>
                           </div>
                       </li>
                    </ul>
                </div>
            </div>

            <div id="users" class="content-section hidden">
                <h2 class="text-3xl font-semibold text-slate-700 mb-6">User Management</h2>
                <!-- Users Table -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <table class="min-w-full text-left">
                        <thead class="bg-slate-50 border-b">
                             <tr>
                                <th class="p-4 text-sm font-semibold text-slate-600">Name</th>
                                <th class="p-4 text-sm font-semibold text-slate-600">Email</th>
                                <th class="p-4 text-sm font-semibold text-slate-600">Role</th>
                                <th class="p-4 text-sm font-semibold text-slate-600">Actions</th>
                            </tr>
                        </thead>
                         <tbody>
                            <!-- Sample Row 1 -->
                            <tr class="border-b hover:bg-slate-50 transition">
                                <td class="p-4 text-slate-800">Aisha Stacy</td>
                                <td class="p-4 text-slate-600">aisha.s@example.com</td>
                                <td class="p-4"><span class="bg-indigo-100 text-indigo-700 text-xs font-semibold px-2.5 py-1 rounded-full">Admin</span></td>
                                <td class="p-4 space-x-2">
                                    <button class="text-indigo-500 hover:text-indigo-700">Edit</button>
                                </td>
                            </tr>
                            <!-- Sample Row 2 -->
                            <tr class="border-b hover:bg-slate-50 transition">
                                <td class="p-4 text-slate-800">John Doe</td>
                                <td class="p-4 text-slate-600">john.d@example.com</td>
                                <td class="p-4"><span class="bg-sky-100 text-sky-700 text-xs font-semibold px-2.5 py-1 rounded-full">Agent</span></td>
                                 <td class="p-4 space-x-2">
                                    <button class="text-indigo-500 hover:text-indigo-700">Edit</button>
                                </td>
                            </tr>
                         </tbody>
                    </table>
                </div>
            </div>
            
            <div id="reviews" class="content-section hidden">
                 <h2 class="text-3xl font-semibold text-slate-700 mb-6">Property & Room Reviews</h2>
                 <!-- Reviews List -->
                 <div class="bg-white rounded-xl shadow-md p-6">
                    <ul class="space-y-4">
                        <!-- Sample Review 1 -->
                        <li class="p-4 border rounded-lg hover:bg-slate-50">
                            <div class="flex items-center justify-between mb-2">
                                <p class="font-semibold text-slate-800">Greenwood Apartments</p>
                                <div class="flex items-center text-amber-500">
                                    <span>5.0</span>
                                    <svg class="h-5 w-5 fill-current ml-1" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                </div>
                            </div>
                             <p class="text-sm text-slate-600 italic">"Absolutely fantastic place, very clean and the management is responsive. Highly recommend!" - <span class="font-medium not-italic">Aisha Stacy</span></p>
                        </li>
                         <!-- Sample Review 2 -->
                        <li class="p-4 border rounded-lg hover:bg-slate-50">
                            <div class="flex items-center justify-between mb-2">
                                <p class="font-semibold text-slate-800">Campus Point Hostel - Room 2B</p>
                                <div class="flex items-center text-amber-500">
                                    <span>4.0</span>
                                    <svg class="h-5 w-5 fill-current ml-1" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                </div>
                            </div>
                             <p class="text-sm text-slate-600 italic">"Good value for the price, but the Wi-Fi can be a bit slow at times." - <span class="font-medium not-italic">John Doe</span></p>
                        </li>
                    </ul>
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
    </script>

</body>
</html>

