<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gradient-to-br from-purple-100 to-blue-100 min-h-screen flex items-center justify-center">
<div class="bg-white/80 backdrop-blur-md rounded-xl shadow-lg p-8 w-full max-w-md">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Reset Password</h1>
    <form method="POST" action="/reset-password">
        @csrf
        <input type="hidden" name="token" value="{{ request('token') }}">

        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 mb-4">

        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">New Password</label>
        <input id="password" type="password" name="password" required class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 mb-4">

        <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">Confirm New Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 mb-4">

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-full w-full">Reset Password</button>
    </form>
</div>
</body>
</html>