<?php

// Styles and Scripts
require_once plugin_dir_path(__FILE__) . "bootstrap.php";

$enqueue_assets = new Bootstrap();
add_action('wp_enqueue_scripts', [$enqueue_assets, 'enqueue_assets']);

if (!class_exists('WP_List_Table')) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

require_once plugin_dir_path(__FILE__) . "installation.php";
require_once plugin_dir_path(__FILE__) . "Src/Core/Controller.php";
require_once plugin_dir_path(__FILE__) . "Src/Entity/Event.php";
require_once plugin_dir_path(__FILE__) . "Src/Repo/EventRepository.php";
require_once plugin_dir_path(__FILE__) . "Src/Controllers/DefaultController.php";
require_once plugin_dir_path(__FILE__) . 'Src/Controllers/AdminController.php';

// Install
$install = new Installation();
register_activation_hook(__FILE__, [$install, 'simple_event_calendar_install']);

// Front-end
$default_controller = new DefaultController();
add_shortcode('upcoming_events', [$default_controller, 'index']);

// Admin
$adminController = new AdminController();
add_action('admin_menu', [$adminController, 'register_menu']);
add_action('admin_dashboard', [$adminController, 'settings_page']);