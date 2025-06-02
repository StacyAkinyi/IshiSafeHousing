<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gradient-to-br from-purple-100 to-blue-100 min-h-screen flex items-center justify-center">
  <div class="bg-white/80 backdrop-blur-md rounded-xl shadow-lg p-8 w-full max-w-md">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Edit Profile</h1>
    <form method="POST" action="{{ route('user-profile-information.update') }}">
      @csrf
      @method('PUT')

      <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Name</label>
      <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 mb-4" required>

      <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
      <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 mb-4" required>

      <label class="block text-gray-700 text-sm font-bold mb-2" for="role">Role</label>
       <select name="role" id="role" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 mb-4" required>
        <option value="student" {{ old('role', $user->role) == 'student' ? 'selected' : '' }}>Student</option>
        <option value="landlord" {{ old('role', $user->role) == 'landlord' ? 'selected' : '' }}>Landlord</option>
        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
      </select>

      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-full w-full">Save Changes</button>
    </form>
  </div>
</body>
</html>