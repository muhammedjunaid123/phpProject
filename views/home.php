<?php
// Hardcoded student data
$student = [
    'name' => 'John Doe',
    'email' => 'john.doe@example.com',
    'class' => '10th Grade',
    'division' => 'A',
    'subjects' => [
        'Mathematics' => 85,
        'Science' => 90,
        'English' => 88,
        'History' => 75,
    ]
];

// Check if form is submitted and update student data (for demonstration)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student['name'] = $_POST['name'];
    $student['email'] = $_POST['email'];
    $student['class'] = $_POST['class'];
    $student['division'] = $_POST['division'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <script>
        // Function to toggle edit mode
        function toggleEditMode() {
            document.getElementById('view-mode').classList.toggle('hidden');
            document.getElementById('edit-mode').classList.toggle('hidden');
        }
    </script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white shadow-lg rounded-lg max-w-sm w-full p-6">
            <!-- View Mode -->
            <div id="view-mode">
                <div class="text-center">
                    <h1 class="text-3xl font-bold text-blue-600 mb-4">Student Profile</h1>
                    <div class="mb-6">
                        <p class="text-gray-700 font-semibold text-xl">
                            <?php echo $student['name']; ?>
                        </p>
                        <p class="text-gray-500 text-sm mt-2">
                            Email: <?php echo $student['email']; ?>
                        </p>
                    </div>

                    <div class="bg-gray-100 p-4 rounded-lg shadow-inner mb-6">
                        <p class="text-gray-700">
                            <span class="font-semibold">Class:</span> <?php echo $student['class']; ?>
                        </p>
                        <p class="text-gray-700 mt-2">
                            <span class="font-semibold">Division:</span> <?php echo $student['division']; ?>
                        </p>
                    </div>

                    <!-- Subjects and Marks -->
                    <div class="bg-gray-100 p-4 rounded-lg shadow-inner mb-6">
                        <h2 class="text-lg font-semibold">Subjects and Marks</h2>
                        <ul class="mt-2">
                            <?php foreach ($student['subjects'] as $subject => $mark): ?>
                                <li class="text-gray-700">
                                    <span class="font-semibold"><?php echo $subject; ?>:</span> <?php echo $mark; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <!-- Edit Button -->
                    <button onclick="toggleEditMode()" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full transition duration-300">
                        Edit Profile
                    </button>
                </div>
            </div>

            <!-- Edit Mode -->
            <div id="edit-mode" class="hidden">
                <form method="POST">
                    <div class="text-center">
                        <h1 class="text-3xl font-bold text-green-600 mb-4">Edit Profile</h1>
                        
                        <div class="mb-6">
                            <label for="name" class="block text-gray-700 font-semibold">Name</label>
                            <input type="text" id="name" name="name" value="<?php echo $student['name']; ?>" class="mt-1 p-2 w-full bg-gray-100 rounded-lg border border-gray-300">
                        </div>

                        <div class="mb-6">
                            <label for="email" class="block text-gray-700 font-semibold">Email</label>
                            <input type="email" id="email" name="email" value="<?php echo $student['email']; ?>" class="mt-1 p-2 w-full bg-gray-100 rounded-lg border border-gray-300">
                        </div>

                        <div class="mb-6">
                            <label for="class" class="block text-gray-700 font-semibold">Class</label>
                            <input type="text" id="class" name="class" value="<?php echo $student['class']; ?>" class="mt-1 p-2 w-full bg-gray-100 rounded-lg border border-gray-300">
                        </div>

                        <div class="mb-6">
                            <label for="division" class="block text-gray-700 font-semibold">Division</label>
                            <input type="text" id="division" name="division" value="<?php echo $student['division']; ?>" class="mt-1 p-2 w-full bg-gray-100 rounded-lg border border-gray-300">
                        </div>

                        <!-- Save Button -->
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full transition duration-300">
                            Save
                        </button>
                        <button type="button" onclick="toggleEditMode()" class="ml-4 bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-full transition duration-300">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
