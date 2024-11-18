<?php 
// Add shortcode
function show_employee_data(){
    global $wpdb;
    $table_name = $wpdb->prefix . 'emp_system';
    $employees = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);

    echo '<div class="row">';
    foreach ($employees as $employee):
        echo '<div class="col-lg-3 col-md-3 col-sm-12 mb-4">
            <div class="card">
                <img class="card-img-top" src="'. ABSPATH . $employee['image'].'" alt="Profile Image">
                <div class="card-body">
                    <h2 class="card-title">'.$employee['name'].'</h2>
                    <p class="card-subtitle mb-2 text-muted">'.$employee['position'].'</p>
                    <p class="card-subtitle mb-2 text-muted mt-2">
                        <a href="tel:'.$employee['phoneNo'].'">'.$employee['phoneNo'].'</a>
                    </p>
                    <p class="card-subtitle mb-2 text-muted mt-2">
                        <a href="mailto:'.$employee['email'].'">'.$employee['email'].'</a>
                    </p>
                </div>
            </div>
        </div>'; 
    endforeach;
    echo "</div>";
}

add_shortcode( "employee_data","show_employee_data" );