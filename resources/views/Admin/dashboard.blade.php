<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IshiSafeHousing - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                 <a href="#" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition duration-200 hover:bg-slate-700" data-target="appointments">
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
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Stats cards go here -->
                </div>
            </div>

            <!-- Properties Section -->
             <div id="properties" class="content-section hidden">
                 <div class="flex justify-between items-center mb-8">
                    <h1 class="text-3xl font-semibold text-slate-800">Manage Properties</h1>
                    <button id="open-property-modal-btn" class="bg-indigo-500 text-white font-semibold py-2 px-5 rounded-lg hover:bg-indigo-600 transition duration-200 shadow-sm flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Add Property
                    </button>
                </div>

                <div id="properties-table-container" class="bg-white rounded-xl shadow-md overflow-x-auto">
                    </div>
                </div>
                <div id="addPropertyModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 hidden">
                <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl">
                    <div class="flex justify-between items-center p-6 border-b">
                        <h2 class="text-2xl font-semibold">Add New Property</h2>
                        <button id="close-property-modal-btn" class="text-slate-400 hover:text-slate-600 text-3xl">&times;</button>
                    </div>
        
        <form id="add-property-form" class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                <div>
                    <label for="prop_name" class="block text-sm font-medium text-slate-700">Property Name</label>
                    <input type="text" name="name" id="prop_name" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md text-sm shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label for="prop_type" class="block text-sm font-medium text-slate-700">Type (e.g., House, Apartment)</label>
                    <input type="text" name="type" id="prop_type" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md text-sm shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
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
                    <label for="prop_latitude" class="block text-sm font-medium text-slate-700">Latitude</label>
                    <input type="text" name="latitude" id="prop_latitude" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md text-sm shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label for="prop_longitude" class="block text-sm font-medium text-slate-700">Longitude</label>
                    <input type="text" name="longitude" id="prop_longitude" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md text-sm shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                 <div>
                    <label for="prop_status" class="block text-sm font-medium text-slate-700">Status</label>
                    <select name="status" id="prop_status" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="available">Available</option>
                        <option value="sold">Sold</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
            </div>
            
            <div class="flex justify-end items-center pt-6 mt-4 border-t">
                <button type="button" id="cancel-property-modal-btn" class="bg-slate-100 text-slate-800 font-semibold py-2 px-5 rounded-lg hover:bg-slate-200 transition duration-200 mr-2 border border-slate-300">
                    Cancel
                </button>
                <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-5 rounded-lg hover:bg-indigo-700 transition duration-200">
                    Save Property
                </button>
            </div>
        </form>
    </div>
</div>
            <!-- Appointments Section -->
            <div id="appointments" class="content-section hidden">
                <h2 class="text-3xl font-semibold text-slate-700 mb-6">Appointments Schedule</h2>
                <!-- Appointments content goes here -->
            </div>

            <!-- Users Section -->
             <div id="users" class="content-section hidden">
                <!-- Section Header -->
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-3xl font-semibold text-slate-800">User Management</h1>
                    <button onclick="openModal()" class="bg-blue-500 text-white font-semibold py-2 px-5 rounded-lg hover:bg-blue-600 transition duration-200 shadow-sm flex items-center">
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
                            <button type="button" class="text-blue-600 hover:text-blue-800 text-sm font-semibold">Edit</button>
                            <button class="text-red-600 hover:text-red-800 text-sm font-semibold">Delete</button>
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
            <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600 text-3xl">&times;</button>
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
                        <option value="admin">Admin</option>
                    </select>
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
                <button type="button" onclick="closeModal()" class="bg-slate-100 text-slate-800 font-semibold py-2 px-5 rounded-lg hover:bg-slate-200 transition duration-200 mr-2 border border-slate-300">
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
        <button type="button" onclick="closeEditModal()" class="bg-slate-100 text-slate-800 font-semibold py-2 px-5 rounded-lg hover:bg-slate-200 border mr-2">Cancel</button>
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

    <!-- Add User Modal (Keep this part as is) -->
    <div id="addUserModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 hidden">
        <!-- ... modal content ... -->
    </div>

   
    <script>

        document.addEventListener('DOMContentLoaded', function () {
        const links = document.querySelectorAll('.sidebar-link');
        const sections = document.querySelectorAll('.content-section');

        links.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();

                // Remove "active" class from all links
                links.forEach(l => l.classList.remove('active'));

                // Add "active" class to current link
                this.classList.add('active');

                const targetId = this.getAttribute('data-target');

                // Hide all content sections
                sections.forEach(section => {
                    section.classList.add('hidden');
                });

                // Show the selected section
                const targetSection = document.getElementById(targetId);
                if (targetSection) {
                    targetSection.classList.remove('hidden');
                }
            });
        });
    });
      window.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.edit-user-btn').forEach(button => {
            button.addEventListener('click', () => {
            const user = JSON.parse(button.dataset.user);
            openEditModal(user);
            });
        });
    });
      function openEditModal(user) {
        const modal = document.getElementById('editUserModal');
        document.getElementById('edit_name').value = user.name;
        document.getElementById('edit_email').value = user.email;
        document.getElementById('edit_role').value = user.role;
        document.getElementById('editUserForm').action = `/admin/users/${user.id}`;
        modal.classList.remove('hidden');
        modal.classList.add('opacity-100');
        }

        function closeEditModal() {
        const modal = document.getElementById('editUserModal');
        modal.classList.add('hidden');
        modal.classList.remove('opacity-100');
        }

    
    function openModal() {
        document.getElementById('addUserModal').classList.remove('hidden');
        document.getElementById('addUserModal').classList.add('opacity-100');
    }

    function closeModal() {
        document.getElementById('addUserModal').classList.add('hidden');
        document.getElementById('addUserModal').classList.remove('opacity-100');
    }
    </script>
</body>
</html>