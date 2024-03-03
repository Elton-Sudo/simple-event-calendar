<?php

/*
Plugin Name: Simple Event Calendar
Description: Simple event calendar plugin.
Version: 1.0
Author: <a href='https://eltonbrown.co.za'>Elton Brown</a>
*/

require_once plugin_dir_path( __FILE__ ) . "init.php";

// Styles and Scripts
$enqueue_assets = new Bootstrap();
add_action('wp_enqueue_scripts', [$enqueue_assets, 'enqueue_assets']);

// Front-end
$default_controller = new DefaultController();
add_shortcode('upcoming_events', [$default_controller, 'index']);
add_shortcode('event_details', [$default_controller, 'showEvent']);

// Admin
add_action('admin_menu', ['AdminController', 'register_menu']);
register_activation_hook(__FILE__, ['Installation', 'simple_event_calendar_install']);