<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Employee List</h1>
        <table class="w-full bg-white shadow-md rounded mb-4">
            <thead>
                <tr class="bg-gradient-to-r from-blue-500 to-purple-600 text-white uppercase text-sm leading-normal">
                    <th class="py-4 px-6 text-left font-semibold">Name</th>
                    <th class="py-4 px-6 text-left font-semibold">Email</th>
                    <th class="py-4 px-6 text-left font-semibold">Phone</th>
                    <th class="py-4 px-6 text-left font-semibold">Position</th>
                    <th class="py-4 px-6 text-left font-semibold">Gender</th>
                    <th class="py-4 px-6 text-left font-semibold">Start Date</th>
                    <th class="py-4 px-6 text-center font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                <?php
                // TODO: Fetch employees from database and loop through them
                $employees = []; // Replace with actual data fetching
                foreach ($employees as $employee) {
                    echo "<tr class='border-b border-gray-200 hover:bg-gray-100'>";
                    echo "<td class='py-3 px-6 text-left whitespace-nowrap'>{$employee['name']}</td>";
                    echo "<td class='py-3 px-6 text-left'>{$employee['email']}</td>";
                    echo "<td class='py-3 px-6 text-left'>{$employee['phone']}</td>";
                    echo "<td class='py-3 px-6 text-left'>{$employee['position']}</td>";
                    echo "<td class='py-3 px-6 text-left'>{$employee['gender']}</td>";
                    echo "<td class='py-3 px-6 text-left'>{$employee['start_date']}</td>";
                    echo "<td class='py-3 px-6 text-center'>";
                    echo "<div class='flex item-center justify-center'>";
                    echo "<button class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded mr-2'>Edit</button>";
                    echo "<button class='bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded'>Delete</button>";
                    echo "</div>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>


</body>
</html>