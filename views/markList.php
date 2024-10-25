<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Marks</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white shadow-lg rounded-lg max-w-lg w-full p-6">
            <h1 class="text-2xl font-bold text-blue-600 mb-4 text-center">Student Details</h1>

            <!-- Student Details Section -->
            <div class="mb-6">
                <p class="text-gray-700"><strong>Name:</strong> <?php echo ($data['name']) ?></p>
                <p class="text-gray-700"><strong>Email:</strong> <?php echo ($data['email']) ?></p>
                <p class="text-gray-700"><strong>Class:</strong> <?php echo ($data['class']) ?></p>
                <p class="text-gray-700"><strong>Division:</strong> <?php echo ($data['division']) ?></p>
            </div>

            <h2 class="text-xl font-bold text-blue-600 mb-4 text-center">Add Marks</h2>
            <form method="POST" action="../index.php">

                <input type="hidden" name="action" value="markList">
                <input type="hidden" name="std_id" value="<?php echo $data['id'] ?>">
                <input type="hidden" name="id" value="<?php echo $mark['id']??null ?>">
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label for="maths" class="block text-gray-700 mb-2">Maths</label>
                        <input type="number" id="maths" name="mathematics" value="<?php echo $mark['mathematics']??"not updated" ?>" required class="p-2 border border-gray-300 rounded-lg w-full" placeholder="Enter Maths marks..." min="0" max="100">
                    </div>

                    <div class="mb-4">
                        <label for="english" class="block text-gray-700 mb-2">English</label>
                        <input type="number" id="english" name="english" value="<?php echo $mark['english']??"not updated" ?>" required class="p-2 border border-gray-300 rounded-lg w-full" placeholder="Enter English marks..." min="0" max="100">
                    </div>

                    <div class="mb-4">
                        <label for="science" class="block text-gray-700 mb-2">Science</label>
                        <input type="number" id="science" name="science" value="<?php echo $mark['science']??"not updated" ?>" required class="p-2 border border-gray-300 rounded-lg w-full" placeholder="Enter Science marks..." min="0" max="100">
                    </div>

                    <div class="mb-4">
                        <label for="hindi" class="block text-gray-700 mb-2">history</label>
                        <input type="number" id="hindi" name="history" value="<?php echo $mark['history']??"not updated" ?>" required class="p-2 border border-gray-300 rounded-lg w-full" placeholder="Enter history marks..." min="0" max="100">
                    </div>
                </div>

                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded w-full mt-4">
                    Save Marks
                </button>
            </form>
        </div>
    </div>
</body>

</html>