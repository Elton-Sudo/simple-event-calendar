<?php


require_once plugin_dir_path(__FILE__) . "installation.php";
require_once plugin_dir_path(__FILE__) . "Src/Core/Controller.php";
require_once plugin_dir_path(__FILE__) . "Src/Entity/Event.php";
require_once plugin_dir_path(__FILE__) . "Src/Repo/EventRepository.php";
require_once plugin_dir_path(__FILE__) . "Src/Controllers/DefaultController.php";

// Admin
if (!class_exists('WP_List_Table')) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

require_once plugin_dir_path(__FILE__) . 'Src/Controllers/AdminController.php';