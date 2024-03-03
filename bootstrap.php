<?php

class Bootstrap 
{

    function enqueue_assets() 
    {

        wp_enqueue_style('secp-styles', plugin_dir_url(__FILE__) . 'Assets/style.css', [], '1.0.0', 'all');
        wp_enqueue_script('secp-scripts', plugin_dir_url(__FILE__) . 'Assets/scripts.js', ['jquery'], '3.7.1', true);
    }
}