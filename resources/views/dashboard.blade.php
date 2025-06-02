<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      body {
        font-family: 'Inter', sans-serif;
      }
    </style>
</head>
<body class="bg-gradient-to-br from-purple-100 to-blue-100 min-h-screen flex items-center justify-center">
    <div class="bg-white/80 backdrop-blur-md rounded-xl shadow-lg p-8 w-full max-w-md">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Welcome to Your Dashboard</h1>
        <p class="text-gray-700 mb-4">You are now logged in.</p>
        <p class="text-gray-700 mb-6">This is a placeholder for your dashboard content.  You could display user-specific information or links to other parts of the application here.</p>
        <form method="POST" action="{{ route('logout') }}">
          @csrf {{-- CSRF protection token --}}

          {{-- You can style this button as needed --}}
          <button type="submit">Logout</button>
        </form>
        
    </div>
    </body>
</html>