<?php
/*
 * Plugin Name: Employee Management System
 * Description: A simple CRUD operation of Employee Management System for learning purpose.
 * Version: 1.0
 * Author: Surya Dev
 * Author URI:  https://github.com/suraj-4
 * Text Domain: employee-system
*/

define("EMS_PLUGIN_PATH", plugin_dir_path(__FILE__));
define("EMS_PLUGIN_URL", plugin_dir_url(__FILE__));

//calling action hook
add_action('admin_menu', 'custom_plugin_menu');

//function for creating menu
function custom_plugin_menu(){

    $page_title = 'Employee System | Employee Management System';
    $menu_title = 'Employee System';
    $capability = 'manage_options';
    $menu_slug = 'employee-system';
    $callback = 'ems_crud_operation';
    $icon_url = 'dashicons-admin-users';
    $position = 23;

    add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $callback, $icon_url, $position );

    //sub menu page
    // List Employee
    add_submenu_page( $menu_slug, 'List Employee', 'List Employee', 'manage_options', $menu_slug, $callback );
    

    // Add Employee
    add_submenu_page( $menu_slug, 'Add Employee', 'Add Employee', 'manage_options', 'add-employee', 'add_employee' );

}

//function for listing employee
function ems_crud_operation(){
    include_once(EMS_PLUGIN_PATH . 'pages/list-employee.php');
}


//function for adding employee
function add_employee(){
    include_once(EMS_PLUGIN_PATH . 'pages/add-employee.php');
}


// Activation hook
register_activation_hook(__FILE__, 'ems_plugin_activation');

function ems_plugin_activation(){

    global $wpdb;   
    $table_prefix = $wpdb->prefix;
    $sql = "
    CREATE TABLE {$table_prefix}emp_system (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(120) DEFAULT NULL,
    `email` varchar(80) DEFAULT NULL,
    `phoneNo` varchar(50) DEFAULT NULL,
    `position` varchar(120) DEFAULT NULL,
    `gender` enum('male','female','other') DEFAULT NULL,
    `startDate` date DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

// Deactivation hook
register_deactivation_hook(__FILE__, 'ems_plugin_deactivation');

function ems_plugin_deactivation(){
    global $wpdb;
    $table_prefix = $wpdb->prefix;
    $sql = "DROP TABLE IF EXISTS {$table_prefix}emp_system";
    $wpdb->query($sql);
} 


// Add css and js file
add_action('admin_enqueue_scripts', 'ems_plugin_enqueue_scripts');

function ems_plugin_enqueue_scripts(){
    // css file
    wp_enqueue_style('ems-tailwind-min', EMS_PLUGIN_URL . 'assets/css/tailwind.min.css', array(), '1.0', 'all');
    wp_enqueue_style('ems-style', EMS_PLUGIN_URL . 'assets/css/style.css', array(), '1.0', 'all');

    // js file
    wp_enqueue_script('ems-jquery-validate', EMS_PLUGIN_URL . 'assets/js/jquery.validate.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('ems-custom-js', EMS_PLUGIN_URL . 'assets/js/custom.js', array('jquery'), '1.0.0', true);
}

