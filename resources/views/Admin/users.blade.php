
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .modal { transition: opacity 0.25s ease; }
    </style>
</head>
<body class="bg-slate-100 text-slate-800">

<div class="flex">
    <!-- You can include your sidebar component here -->
    <!-- For simplicity, I'll add a placeholder sidebar -->
    <aside class="w-64 bg-slate-800 text-white min-h-screen p-4">
        <h1 class="text-2xl font-bold mb-6">IshiSafeAdmin</h1>
        <nav class="space-y-2">
            <a href="#" class="block py-2.5 px-4 rounded hover:bg-slate-700">Dashboard</a>
            <a href="{{ route('admin.users') }}" class="block py-2.5 px-4 rounded bg-indigo-600">Users</a>
            <!-- Add other admin links here -->
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 lg:p-10">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-semibold">User Management</h1>
            <button onclick="openModal()" class="bg-indigo-500 text-white font-semibold py-2 px-5 rounded-lg hover:bg-indigo-600 transition duration-200 shadow-sm">
                + Add User
            </button>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif
        
        <!-- Users Table -->
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
                                    @if($user->role == 'admin') bg-indigo-100 text-indigo-700
                                    @elseif($user->role == 'agent') bg-sky-100 text-sky-700
                                    @else bg-green-100 text-green-700 @endif">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="p-4 space-x-2">
                                <button class="text-indigo-500 hover:text-indigo-700 text-sm font-semibold">Edit</button>
                                <button class="text-red-500 hover:text-red-700 text-sm font-semibold">Delete</button>
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
    </main>
</div>

<!-- Add User Modal -->
<div id="addUserModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md">
        <!-- Modal Header -->
        <div class="flex justify-between items-center p-6 border-b">
            <h2 class="text-2xl font-semibold">Add New User</h2>
            <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600">&times;</button>
        </div>
        
        <!-- Modal Body -->
        <form action="{{ route('admin.users.store') }}" method="POST" class="p-6">
            @csrf

            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Oops!</strong>
                    <span class="block sm:inline">There were some problems with your input.</span>
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
                    <input type="text" name="name" id="name" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500" value="{{ old('name') }}">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Email Address</label>
                    <input type="email" name="email" id="email" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500" value="{{ old('email') }}">
                </div>
                <div>
                    <label for="role" class="block text-sm font-medium text-slate-700">Role</label>
                    <select name="role" id="role" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                        <option value="student">Student</option>
                        <option value="agent">Agent</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                 <div>
                    <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                    <input type="password" name="password" id="password" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                </div>
                 <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                </div>
            </div>
            
            <!-- Modal Footer -->
            <div class="flex justify-end items-center pt-6 mt-4 border-t">
                <button type="button" onclick="closeModal()" class="bg-slate-200 text-slate-800 font-semibold py-2 px-5 rounded-lg hover:bg-slate-300 transition duration-200 mr-2">
                    Cancel
                </button>
                <button type="submit" class="bg-indigo-500 text-white font-semibold py-2 px-5 rounded-lg hover:bg-indigo-600 transition duration-200">
                    Create User
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const modal = document.getElementById('addUserModal');

    function openModal() {
        modal.classList.remove('hidden');
    }

    function closeModal() {
        modal.classList.add('hidden');
    }

    // If there were validation errors on the last submission, the page will reload.
    // This code checks if there are errors and automatically re-opens the modal.
    @if ($errors->any())
        openModal();
    @endif
</script>

</body>
</html>
