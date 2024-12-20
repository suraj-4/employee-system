<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://github.com/suraj-4
 * @since             1.0.0
 * @package           Employee_Management_System
 *
 * @wordpress-plugin
 * Plugin Name:       Employee Management System
 * Plugin URI:        https://github.com/suraj-4/employee-system
 * Description:       A simple CRUD operation of Employee Management System for learning purpose.
 * Version:           1.0.0
 * Author:            Surya Dev
 * Author URI:        https://github.com/suraj-4/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       employee-management-system
 * Domain Path:       /languages
 */

 // If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'EMPLOYEE_MANAGEMENT_SYSTEM_VERSION', '1.0.0' );

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
    $callback = 'list_employee';
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
function list_employee(){
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
    CREATE TABLE `{$table_prefix}emp_system` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `image` varchar(100) DEFAULT NULL,
    `name` varchar(120) DEFAULT NULL,
    `email` varchar(80) DEFAULT NULL,
    `phoneNo` varchar(50) DEFAULT NULL,
    `position` varchar(120) DEFAULT NULL,
    `gender` enum('male','female','other') DEFAULT NULL,
    `startDate` date DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
    ";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    //Create a WordPress page
    $pageData = [
        "post_title"    => "Employee Management System",
        "post_status"   => "publish",
        "post_type"     => "page",
        "post_name"     => "employee-management-system",
        "post_content" => "[employee_data]"
    ];
    wp_insert_post($pageData);
}

// Deactivation hook
register_deactivation_hook(__FILE__, 'ems_plugin_deactivation');

function ems_plugin_deactivation(){
    global $wpdb;
    $table_prefix = $wpdb->prefix;
    $sql = "DROP TABLE IF EXISTS {$table_prefix}emp_system";
    $wpdb->query($sql);

    //Delete a WordPress page
    $pageSlug = "employee-management-system";
    $pageInfo = get_page_by_path($pageSlug);
    if(!empty($pageInfo)){
        $pageID = $pageInfo->ID;
        wp_delete_post($pageID, true);
    }
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

include_once(EMS_PLUGIN_PATH . 'employee-card.php');



