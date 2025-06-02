<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Two-Factor Authentication</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gradient-to-br from-purple-100 to-blue-100 min-h-screen flex items-center justify-center">
  <div class="bg-white/80 backdrop-blur-md rounded-xl shadow-lg p-8 w-full max-w-md">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Two-Factor Challenge</h1>
    <p class="text-gray-600 mb-4 text-center">Please confirm access to your account by entering the authentication code provided by your authenticator application.</p>
    <form method="POST" action="/two-factor-challenge">
      @csrf

      <label class="block text-gray-700 text-sm font-bold mb-2" for="code">Authentication Code</label>
      <input id="code" type="text" name="code" required autofocus class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 mb-4">

      <div class="text-center text-sm text-gray-500 mb-4">Or enter your recovery code</div>

      <label class="block text-gray-700 text-sm font-bold mb-2" for="recovery_code">Recovery Code</label>
      <input id="recovery_code" type="text" name="recovery_code" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 mb-4">

      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-full w-full">Verify</button>
    </form>
  </div>
</body>
</html>
