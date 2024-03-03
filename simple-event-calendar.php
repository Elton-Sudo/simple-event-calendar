<?php

/*
Plugin Name: Simple Event Calendar
Description: Simple event calendar plugin.
Version: 1.0
Author: <a href='https://eltonbrown.co.za'>Elton Brown</a>
*/

require_once plugin_dir_path( __FILE__ ) . "init.php";

add_action('admin_menu', ['AdminController', 'register_menu']);
register_activation_hook(__FILE__, ['Installation', 'simple_event_calendar_install']);