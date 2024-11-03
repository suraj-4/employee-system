<?php 

    $success_message = '';
    $error_message = '';
    $status = '';
    $action = '';
    $employee_id = '';


    if (isset($_GET['action']) && $_GET['id']) {
        global $wpdb;
        $employee_id = $_GET['id'];

        //Action : edit employee
        if ($_GET['action'] == 'edit') {
            $action = 'edit';
        }
        //Action : view employee
        if ($_GET['action'] == 'view') {
            $action = 'view';
        }

        //Single employee data
        $employee = $wpdb->get_row(
            $wpdb->prepare("SELECT * FROM {$wpdb->prefix}emp_system WHERE id = %d", $employee_id), ARRAY_A
        );
    }

    //Action : add employee
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
            $upload_path = basename($image['name']);
            move_uploaded_file($image['tmp_name'], $upload_path);
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

        if ($action == 'edit') {

            $wpdb->update($wpdb->prefix . 'emp_system', $data, array('id' => $employee_id));

            $last__inserted_id = $wpdb->insert_id;

            if ($last__inserted_id > 0) {
                $success_message = 'Employee Updated successfully';
                $status = 'success';
            } else {
                $error_message = 'Failed to Updated employee';
                $status = 'error';
            }
        } else {
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
    }
?>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">
        <?php if ($action == 'edit' || $action == 'view') : ?>
            <?php if ($action == 'edit') : ?> 
                Edit Employee 
            <?php endif; ?>
            <?php if ($action == 'view') : ?> 
                View Employee
            <?php endif; ?>
        <?php else: ?>
            Add Employee
        <?php endif; ?>
    </h1>
    <?php if ($status == 'success') : ?>
        <div class="message bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Success!</strong> <?php echo $success_message; ?>
        </div>
    <?php endif; ?>
    <form method="post" 
    action="<?php if ($action == 'edit') : ?>admin.php?page=add-employee&action=edit&id=<?php echo $employee_id; ?>
    <?php else : ?>admin.php?page=add-employee<?php endif; ?>"
     id="ems_add_Employee_Form" class="bg-gradient-to-r from-blue-100 to-purple-100 shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4" enctype="multipart/form-data">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="employee_name">
                    Employee Name
                </label>
                <input class="shadow-md appearance-none border border-gray-300 rounded-lg w-full h-12 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out hover:border-blue-400" id="employee_name" name="employee_name" type="text" 
                <?php if ($action == 'view' || $action == 'edit') : ?> value="<?php echo $employee['name']; ?>" <?php endif; ?> <?php if ($action == 'view') : ?> readonly='readonly' <?php endif; ?> placeholder="Enter employee name" required>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="employee_email">
                    Email
                </label>
                <input class="shadow-md appearance-none border border-gray-300 rounded-lg w-full h-12 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out hover:border-blue-400" id="employee_email" name="employee_email" type="email" 
                <?php if ($action == 'view' || $action == 'edit') : ?> value="<?php echo $employee['email']; ?>" <?php endif; ?> <?php if ($action == 'view') : ?> readonly='readonly' <?php endif; ?> placeholder="Enter email address" required>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="employee_phone">
                    Phone
                </label>
                <input class="shadow-md appearance-none border border-gray-300 rounded-lg w-full h-12 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out hover:border-blue-400" id="employee_phone" name="employee_phone" type="tel" 
                <?php if ($action == 'view' || $action == 'edit') : ?> value="<?php echo $employee['phoneNo']; ?>" <?php endif; ?> <?php if ($action == 'view') : ?> readonly='readonly' <?php endif; ?> placeholder="Enter phone number">
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="employee_position">
                    Position
                </label>
                <input class="shadow-md appearance-none border border-gray-300 rounded-lg w-full h-12 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out hover:border-blue-400" id="employee_position" name="employee_position" type="text"
                <?php if ($action == 'view' || $action == 'edit') : ?> value="<?php echo $employee['position']; ?>" <?php endif; ?> <?php if ($action == 'view') : ?> readonly='readonly' <?php endif; ?> placeholder="Enter employee position">
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="employee_gender">
                    Gender
                </label>
                <select class="shadow-md appearance-none border border-gray-300 rounded-lg w-full h-12 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out hover:border-blue-400" id="employee_gender" name="employee_gender" 
                <?php if ($action == 'view') : ?> disabled <?php endif; ?> required>
                    <option value="">Select gender</option>
                    <option value="male" <?php if (($action == 'view' || $action == 'edit') && $employee['gender'] == "male"){echo "selected";}?>>Male</option>
                    <option value="female" <?php if (($action == 'view' || $action == 'edit') && $employee['gender'] == "female"){echo "selected";}?>>Female</option>
                    <option value="other" <?php if (($action == 'view' || $action == 'edit') && $employee['gender'] == "other"){echo "selected";}?>>Other</option>
                </select>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="employee_start_date">
                    Start Date
                </label>
                <input class="shadow-md appearance-none border border-gray-300 rounded-lg w-full h-12 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out hover:border-blue-400" id="employee_start_date" name="employee_start_date" type="date"
                <?php if ($action == 'view' || $action == 'edit') : ?> value="<?php echo $employee['startDate']; ?>" <?php endif; ?> <?php if ($action == 'view') : ?> readonly='readonly' <?php endif; ?>>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="employee_image">Profile Image</label>
                <div class="relative group">
                    <input class="hidden" id="employee_image" name="employee_image" type="file" accept="image/jpeg,image/png,image/gif" onchange="previewImage(this)">
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-1/2 px-3">
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
                        </div>
                        <div class="w-1/2 px-3">
                            <div id="imagePreview" class="hidden imagePreview">
                                <img id="preview" src="#" alt="Preview" class="rounded-lg shadow-lg object-cover"/>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="flex items-center justify-center">
        <?php if ($action == 'edit' || $action == 'view') : ?>
            <?php if ($action == 'edit') : ?> 
                <button class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-bold py-4 px-10 text-xl rounded-full focus:outline-none focus:shadow-outline transform transition duration-300 hover:scale-105 w-full md:w-auto" type="submit" name="add_employee">
                Update Employee
            </button>
            <?php endif; ?>
            <?php if ($action == 'view') : ?> 
                <!-- no button -->
            <?php endif; ?>
        <?php else: ?>
            <button class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-bold py-4 px-10 text-xl rounded-full focus:outline-none focus:shadow-outline transform transition duration-300 hover:scale-105 w-full md:w-auto" type="submit" name="add_employee">
                Add Employee
            </button>
        <?php endif; ?>
           
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