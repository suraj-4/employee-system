<?php 

    $success_message = '';
    $error_message = '';
    $status = '';

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["add_employee"])) {

        global $wpdb;

        $name = sanitize_text_field($_POST['employee_name']);
        $email = sanitize_email($_POST['employee_email']);
        $phone = sanitize_text_field($_POST['employee_phone']);
        $position = sanitize_text_field($_POST['employee_position']);
        $gender = sanitize_text_field($_POST['employee_gender']);
        $start_date = sanitize_text_field($_POST['employee_start_date']);
        $image = $_FILES['employee_image'];

        // Validate the file type (optional)
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($image['type'], $allowed_types)) {
            // Set up the upload directory
            $upload_dir = wp_upload_dir();
            $upload_path = $upload_dir['path'] . '/' . basename($image['name']);            
        } 

        $data = array(
            "name" => $name,
            "email" => $email,
            "phoneNo" => $phone,
            "position" => $position,
            "gender" => $gender,
            "startDate" => $start_date,
            "image" => $upload_path
        );


        $wpdb->insert($wpdb->prefix . 'emp_system', $data);

        $last__inserted_id = $wpdb->insert_id;

        if ($last__inserted_id > 0) {
            $success_message = 'Employee added successfully';
            $status = 'success';
        } else {
            $error_message = 'Failed to add employee';
            $status = 'error';
        }
    }

?>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Employee List</h1>
    <?php if ($status == 'success') : ?>
        <div class="message bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 max-w-4xl mx-auto"" role="alert">
            <strong class="font-bold">Success!</strong> <?php echo $success_message; ?>
        </div>
    <?php endif; ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?page=add-employee" id="ems_add_Employee_Form" class="bg-gradient-to-r from-blue-100 to-purple-100 shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4 max-w-4xl mx-auto" enctype="multipart/form-data">
   
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="employee_name">
                    Employee Name
                </label>
                <input class="shadow-md appearance-none border border-gray-300 rounded-lg w-full h-12 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out hover:border-blue-400" id="employee_name" name="employee_name" type="text" placeholder="Enter employee name" required>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="employee_email">
                    Email
                </label>
                <input class="shadow-md appearance-none border border-gray-300 rounded-lg w-full h-12 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out hover:border-blue-400" id="employee_email" name="employee_email" type="email" placeholder="Enter email address" required>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="employee_phone">
                    Phone
                </label>
                <input class="shadow-md appearance-none border border-gray-300 rounded-lg w-full h-12 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out hover:border-blue-400" id="employee_phone" name="employee_phone" type="tel" placeholder="Enter phone number">
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="employee_position">
                    Position
                </label>
                <input class="shadow-md appearance-none border border-gray-300 rounded-lg w-full h-12 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out hover:border-blue-400" id="employee_position" name="employee_position" type="text" placeholder="Enter employee position">
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="employee_gender">
                    Gender
                </label>
                <select class="shadow-md appearance-none border border-gray-300 rounded-lg w-full h-12 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out hover:border-blue-400" id="employee_gender" name="employee_gender" required>
                    <option value="">Select gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="employee_start_date">
                    Start Date
                </label>
                <input class="shadow-md appearance-none border border-gray-300 rounded-lg w-full h-12 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out hover:border-blue-400" id="employee_start_date" name="employee_start_date" type="date">
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="employee_image">Profile Image</label>

                <div class="relative group">
                    <input class="hidden" id="employee_image" name="employee_image" type="file" accept="image/jpeg,image/png,image/gif" onchange="previewImage(this)">
                    <label for="employee_image" class="flex flex-col items-center justify-center w-full h-40 px-4 transition-all duration-300 bg-gradient-to-br from-white to-gray-50 border-3 border-gray-200 border-dashed rounded-xl appearance-none cursor-pointer hover:border-blue-400 hover:bg-blue-50/30 hover:shadow-lg focus:outline-none group-hover:scale-[1.02]">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-blue-500 mb-3 transition-transform group-hover:scale-110 group-hover:rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                            <p class="mb-2 text-lg text-gray-700 font-medium">
                                <span class="text-blue-600">Click to upload</span> or drag and drop
                            </p>
                            <p class="text-sm text-gray-500">
                                JPG, PNG or GIF (Max. 2MB)
                            </p>
                        </div>
                    </label>
                    <div id="imagePreview" class="mt-4 hidden">
                        <img id="preview" src="#" alt="Preview" class="w-[200px] h-[200px] rounded-lg shadow-lg object-cover"/>
                    </div>
                </div>

            </div>
        </div>
        <div class="flex items-center justify-center">
            <button class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-bold py-4 px-10 text-xl rounded-full focus:outline-none focus:shadow-outline transform transition duration-300 hover:scale-105 w-full md:w-auto" type="submit" name="add_employee">
                Add Employee
            </button>
        </div>
    </form>
</div>

<script>
    // image preview
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
                document.getElementById('imagePreview').classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Form Validation
    jQuery(document).ready(function($){
        $("#ems_add_Employee_Form").validate();
        $("#employee_phone").rules("add", {
            number: true,
            minlength: 10,
            maxlength: 10
        });
        
        // Handle success/error message fade out
        if ($(".message").length) {
            setTimeout(function() {
                $(".message").fadeOut('slow');
            }, 2000);
        }
    });
</script>