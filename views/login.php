<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Login Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">

  <div class="w-full max-w-sm md:max-w-md lg:max-w-lg bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h2>
    
    <form action="../controllers/studentController.php" method="POST" class="space-y-4">
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="email" name="email" required 
          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700" />
      </div>
      
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" id="password" name="password" required 
          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700" />
      </div>
      
      <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        Sign in
      </button>
    </form>

    <p class="text-sm text-center text-gray-600 mt-6">
      Don't have an account? <a href="registration.php" class="text-blue-600 hover:underline">Sign up</a>
    </p>
  </div>

</body>
</html>
