<?php

class Bootstrap 
{
    function enqueue_assets() 
    {
        
        wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css');
        wp_enqueue_style('custom-styles', plugin_dir_url(__FILE__) . 'Assets/style.css', [], '1.0.0', 'all');
        wp_enqueue_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js', ['jquery'], '2.11.6', true);
        wp_enqueue_script('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js', ['jquery', 'popper'], '5.1.3', true);
        wp_enqueue_script('custom-script', plugin_dir_url(__FILE__) . 'Assets/scripts.js', ['jquery'], '3.7.1', true);
    }
}