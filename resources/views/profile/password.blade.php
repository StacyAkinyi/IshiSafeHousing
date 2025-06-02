<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Change Password</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gradient-to-br from-purple-100 to-blue-100 min-h-screen flex items-center justify-center">
  <div class="bg-white/80 backdrop-blur-md rounded-xl shadow-lg p-8 w-full max-w-md">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Change Password</h1>
    <form method="POST" action="{{ route('user-password.update') }}">
      @csrf
      @method('PUT')
        @if (session('status') == "password-updated")
             <div class="alert alert-success">Password updated successfully.</div>
        @endif


      <label class="block text-gray-700 text-sm font-bold mb-2" for="current_password">Current Password</label>
      <input type="password" name="current_password" id="current_password" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 mb-4" required>

      @error('current_password', 'updatePassword') 
        <span class="invalid-feedback text-red-500 text-xs italic" role="alert">{{ $message }}</span>
        @enderror
      <label class="block text-gray-700 text-sm font-bold mb-2" for="new_password">New Password</label>
      <input type="password" name="new_password" id="new_password" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 mb-4" required>
      @error('new_password', 'updatePassword') 
        <span class="invalid-feedback text-red-500 text-xs italic" role="alert">{{ $message }}</span>
        @enderror

      <label class="block text-gray-700 text-sm font-bold mb-2" for="new_password_confirmation">Confirm New Password</label>
      <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 mb-4" required>

      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-full w-full">Update Password</button>
    </form>
  </div>
</body>
</html>