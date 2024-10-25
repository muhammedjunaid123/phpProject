<?php
// Get the error message from the URL parameter if available
$errorMessage = isset($_GET['msg']) ? htmlspecialchars($_GET['msg']) : 'An unexpected error occurred. Please try again later.';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white shadow-lg rounded-lg max-w-md w-full p-6">
            <h1 class="text-2xl font-bold text-red-600 mb-4">Error!</h1>
            <p class="mb-4"><?php echo $errorMessage; ?></p>
            <a href="/home" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Go to Home
            </a>
        </div>
    </div>
</body>
</html>
