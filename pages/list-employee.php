    <?php 
    global $wpdb;
    $message = '';

    //Delete Employee
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['emp_del_id']) && !empty($_POST['emp_del_id'])) {
            $emp_del_id = $_POST['emp_del_id'];
            $wpdb->delete($wpdb->prefix . 'emp_system', array(
                'id' => intval($emp_del_id)
            ));
            $message = 'Employee deleted successfully';
        }
    }

    //Get Employees
    $table_name = $wpdb->prefix . 'emp_system';
    $employees = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
    

    ?>
    
    <div class="container py-8">
        <?php if (!empty($message)): ?>
            <div class=" bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Employee List</h1>
        <div class="flex justify-between items-center mb-4">
            <div class="w-1/2">
                <input type="text" id="searchInput" placeholder="Search employees..." class="shadow-lg appearance-none border border-gray-300 rounded-lg w-2/3 h-12 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out hover:border-blue-400" style="background-image: url('data:image/svg+xml;charset=utf-8,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'%23a0aec0\'><path d=\'M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z\'/></svg>'); background-repeat: no-repeat; background-position: 10px center; background-size: 20px 20px; padding-left: 40px;">
            </div>
            <div class="w-1/2 text-right">
                <a href="admin.php?page=add-employee" class="bg-blue-500 hover:bg-blue-600 hover:text-white text-white font-bold py-2 px-4 rounded inline-flex items-center transition duration-300 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add New
                </a>
            </div>
        </div>
        <table id="employeeTable" class="w-full bg-white shadow-md rounded mb-4">
            <thead>
                <tr class="bg-gradient-to-r from-blue-500 to-purple-600 text-white uppercase text-sm leading-normal">
                    <th class="py-4 px-6 text-left font-semibold">Image</th>
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
                <?php foreach ($employees as $employee): ?>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <?php if ($employee['image'] != ''): ?>
                                <img src="<?php echo $employee['image']; ?>" alt="Employee Image" class="w-10 h-10 rounded-full">
                            <?php else: ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/default-avatar.png" alt="Default Avatar" class="w-10 h-10 rounded-full">
                            <?php endif; ?>
                        </td>
                        <td class="py-3 px-6 text-left whitespace-nowrap"><?php echo $employee['name']; ?></td>
                        <td class="py-3 px-6 text-left"><?php echo strtolower($employee['email']); ?></td>
                        <td class="py-3 px-6 text-left"><?php echo $employee['phoneNo']; ?></td>
                        <td class="py-3 px-6 text-left"><?php echo $employee['position']; ?></td>
                        <td class="py-3 px-6 text-left"><?php echo ucfirst($employee['gender']); ?></td>
                        <td class="py-3 px-6 text-left"><?php echo $employee['startDate']; ?></td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center">
                                <a href="admin.php?page=add-employee&action=view&id=<?php echo $employee['id']; ?>" class="bg-green-500 hover:bg-green-700 hover:text-white text-white font-bold py-1 px-3 rounded mr-2 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                                <a href="admin.php?page=add-employee&action=edit&id=<?php echo $employee['id']; ?>" class="bg-blue-500 hover:bg-blue-700 hover:text-white text-white font-bold py-1 px-3 rounded mr-2 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form action="<?php echo $_SERVER['PHP_SELF'];?>?page=employee-system" method="post" id="emp_del_form_<?php echo $employee['id']; ?>">
                                    <input type="hidden" name="emp_del_id" value="<?php echo $employee['id']; ?>">
                                </form>
                                <button onclick="if (confirm('Are you sure you want to delete this employee? <?php echo $employee['id']; ?>')){jQuery('#emp_del_form_<?php echo $employee['id']; ?>').submit();}" class="bg-red-500 hover:bg-red-700 hover:text-white text-white font-bold py-1 px-3 rounded flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div id="pagination" class="flex justify-center mt-4">
            <!-- Pagination buttons will be dynamically inserted here -->
        </div>
    </div>

<script>
    jQuery(document).ready(function($){        
        // Handle success/error message fade out
        if ($(".message").length) {
            setTimeout(function() {
                $(".message").fadeOut('slow');
            }, 2000);
        }
    });
</script>
