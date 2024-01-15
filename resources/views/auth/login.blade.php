<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SPK Kinerja Karyawan</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    .login-bg {
      background-image: url(/asset/idaqu5.jpg);
      background-size: cover;
      background-position: center;
    }
  </style>
</head>
<body class="login-bg">
  <div class="min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full mx-auto px-6 bg-white rounded-lg shadow-lg">
      <div class="flex justify-center items-center my-8">
        <img class="h-16" src="\asset\dbn.jpg" alt="Logo">
      </div>
      <span></span>
      <div class="py-8">
        <form method="POST" action="/login">
          @csrf
          <div class="mb-4">
            <label for="username" class="block text-gray-700 text-sm font-bold mb-2" for="username">Username</label>
            <input type="text" id="username" name="username" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:border-blue-500" placeholder="Enter your username" required>
          </div>
          <div class="mb-10">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
            <input type="password" name="password" id="password" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:border-blue-500" type="password" id="password" name="password" placeholder="Enter your password" required>
            @error('username')
            <p id="filled_error_help" class="mt-4 text-xs text-red-600 dark:text-green-400">Username dan Password salah !</p>
            @enderror
          </div>
          <div class="flex items-center justify-between">
            <button class="w-full px-4 py-2 rounded-lg bg-blue-500 text-white font-semibold hover:bg-blue-600 focus:outline-none" type="submit">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>