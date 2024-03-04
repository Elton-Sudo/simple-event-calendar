<?php

class Installation 
{

    public static function simple_event_calendar_install() 
    {
        
        global $wpdb;

        $table_name = $wpdb->prefix . 'events';
        $charset_collate = $wpdb->get_charset_collate();

        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            
            $sql = "CREATE TABLE $table_name (
                id mediumint(9) NOT NULL AUTO_INCREMENT,
                title varchar(255) NOT NULL,
                description text NOT NULL,
                date date NOT NULL,
                time time NOT NULL,
                location varchar(255) NOT NULL,
                image varchar(255),
                type varchar(255) NOT NULL,
                created datetime DEFAULT CURRENT_TIMESTAMP,
                updated timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY  (id)
            ) $charset_collate;";
            
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
            dbDelta($sql);
        }

        $keywords_table = $wpdb->prefix . 'event_keywords';
        if ($wpdb->get_var("SHOW TABLES LIKE '$keywords_table'") != $keywords_table) {

            $sql_keywords = "CREATE TABLE $keywords_table (
                id mediumint(9) NOT NULL AUTO_INCREMENT,
                event_id mediumint(9) NOT NULL,
                keyword varchar(255) NOT NULL,
                created datetime DEFAULT CURRENT_TIMESTAMP,
                updated timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY  (id),
                FOREIGN KEY  (event_id) REFERENCES $table_name(id) ON DELETE CASCADE
            ) $charset_collate;";

            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
            dbDelta($sql_keywords);
        }
    }
}