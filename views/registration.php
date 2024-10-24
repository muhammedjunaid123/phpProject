<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-3xl bg-white shadow-lg rounded-lg p-8">
        <h2 class="text-2xl font-bold text-center mb-6">Register</h2>
        <form action="../index.php" method="POST">
            <input type="hidden" name="action" value="registration">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-semibold mb-2">Name</label>
                    <input type="text" id="name" name="name" required class="border border-gray-300 p-2 w-full rounded focus:outline-none focus:ring focus:ring-blue-500" placeholder="Enter your name">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email</label>
                    <input type="email" id="email" name="email" required class="border border-gray-300 p-2 w-full rounded focus:outline-none focus:ring focus:ring-blue-500" placeholder="Enter your email">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                    <input type="password" id="password" name="password" required class="border border-gray-300 p-2 w-full rounded focus:outline-none focus:ring focus:ring-blue-500" placeholder="Create a password">
                </div>
                <div class="mb-4">
                    <label for="class" class="block text-gray-700 text-sm font-semibold mb-2">Class</label>
                    <input type="number" id="class" name="class" required class="border border-gray-300 p-2 w-full rounded focus:outline-none focus:ring focus:ring-blue-500" placeholder="Enter your class">
                </div>
                <div class="mb-4">
                    <label for="division" class="block text-gray-700 text-sm font-semibold mb-2">Division</label>
                    <input type="text" id="division" name="division" required class="border border-gray-300 p-2 w-full rounded focus:outline-none focus:ring focus:ring-blue-500" placeholder="Enter your division">
                </div>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-2 rounded hover:bg-blue-600 transition duration-200 mt-6">Register</button>
        </form>
        <p class="mt-4 text-center text-gray-600">Already have an account? <a href="login.php" class="text-blue-500 hover:underline">Login here</a>.</p>
    </div>
</body>

</html>