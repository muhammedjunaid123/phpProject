

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white shadow-lg rounded-lg max-w-4xl w-full p-6">
            <h1 class="text-3xl font-bold text-blue-600 mb-4 text-center">Student List</h1>
            
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4 border-b">Name</th>
                        <th class="py-2 px-4 border-b">Email</th>
                        <th class="py-2 px-4 border-b">Class</th>
                        <th class="py-2 px-4 border-b">Division</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($students) > 0): ?>
                        <?php foreach ($students as $student): ?>
                            <tr class="hover:bg-gray-100">
                                <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($student['name']); ?></td>
                                <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($student['email']); ?></td>
                                <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($student['class']); ?></td>
                                <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($student['division']); ?></td>
                                <td class="py-2 px-4 border-b">
                                    <button onclick="addMark('<?php echo htmlspecialchars($student['email']); ?>')" class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-2 rounded">
                                        Add Mark
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="py-2 px-4 text-center">No students found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function addMark(email) {
            window.location.href = `/markList?email=${email}`;
        }
    </script>
</body>
</html>
