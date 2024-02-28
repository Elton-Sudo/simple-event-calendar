<?php

/*
Plugin Name: Simple Event Calendar
Description: Simple event calendar plugin.
Version: 1.0
Author: Elton Brown
*/

require_once plugin_dir_path( __DIR__ ) . "Src/Core/Controller.php";
require_once plugin_dir_path( __DIR__ ) . "Src/Entity/Event.php";
require_once plugin_dir_path( __DIR__ ) . "Src/Repo/EventRepository.php";