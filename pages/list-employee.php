    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Employee List</h1>
        <div class="mb-4">
            <input type="text" id="searchInput" placeholder="Search employees..." class="shadow-lg appearance-none border border-gray-300 rounded-lg w-1/3 h-12 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out hover:border-blue-400" style="background-image: url('data:image/svg+xml;charset=utf-8,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'%23a0aec0\'><path d=\'M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z\'/></svg>'); background-repeat: no-repeat; background-position: 10px center; background-size: 20px 20px; padding-left: 40px;">
        </div>
        <table id="employeeTable" class="w-full bg-white shadow-md rounded mb-4">
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
                // Sample data for 10 employees
                $employees = [
                    ['name' => 'John Doe', 'email' => 'john.doe@example.com', 'phone' => '123-456-7890', 'position' => 'Manager', 'gender' => 'Male', 'start_date' => '2022-01-15'],
                    ['name' => 'Jane Smith', 'email' => 'jane.smith@example.com', 'phone' => '234-567-8901', 'position' => 'Developer', 'gender' => 'Female', 'start_date' => '2022-02-01'],
                    ['name' => 'Mike Johnson', 'email' => 'mike.johnson@example.com', 'phone' => '345-678-9012', 'position' => 'Designer', 'gender' => 'Male', 'start_date' => '2022-03-10'],
                    ['name' => 'Emily Brown', 'email' => 'emily.brown@example.com', 'phone' => '456-789-0123', 'position' => 'HR Specialist', 'gender' => 'Female', 'start_date' => '2022-04-05'],
                    ['name' => 'David Lee', 'email' => 'david.lee@example.com', 'phone' => '567-890-1234', 'position' => 'Accountant', 'gender' => 'Male', 'start_date' => '2022-05-20'],
                    ['name' => 'Sarah Wilson', 'email' => 'sarah.wilson@example.com', 'phone' => '678-901-2345', 'position' => 'Marketing Specialist', 'gender' => 'Female', 'start_date' => '2022-06-15'],
                    ['name' => 'Tom Anderson', 'email' => 'tom.anderson@example.com', 'phone' => '789-012-3456', 'position' => 'Sales Representative', 'gender' => 'Male', 'start_date' => '2022-07-01'],
                    ['name' => 'Lisa Taylor', 'email' => 'lisa.taylor@example.com', 'phone' => '890-123-4567', 'position' => 'Customer Support', 'gender' => 'Female', 'start_date' => '2022-08-12'],
                    ['name' => 'Robert White', 'email' => 'robert.white@example.com', 'phone' => '901-234-5678', 'position' => 'IT Specialist', 'gender' => 'Male', 'start_date' => '2022-09-03'],
                    ['name' => 'Emma Harris', 'email' => 'emma.harris@example.com', 'phone' => '012-345-6789', 'position' => 'Project Manager', 'gender' => 'Female', 'start_date' => '2022-10-22']
                ];

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
        <div id="pagination" class="flex justify-center mt-4">
            <!-- Pagination buttons will be dynamically inserted here -->
        </div>
    </div>


  
