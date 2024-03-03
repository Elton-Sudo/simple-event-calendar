<?php

class Installation {

    public static function simple_event_calendar_install() {
        global $wpdb;
    
        $table_name = $wpdb->prefix . 'events';
        $charset_collate = $wpdb->get_charset_collate();
    
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            title varchar(255) NOT NULL,
            description text NOT NULL,
            date date NOT NULL,
            time time NOT NULL,
            location varchar(255) NOT NULL,
            image varchar(255),
            type varchar(255) NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";
        
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);
    
        $keywords_table = $wpdb->prefix . 'event_keywords';
    
        $sql_keywords = "CREATE TABLE IF NOT EXISTS $keywords_table (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            event_id mediumint(9) NOT NULL,
            keyword varchar(255) NOT NULL,
            PRIMARY KEY  (id),
            FOREIGN KEY  (event_id) REFERENCES $table_name(id) ON DELETE CASCADE
        ) $charset_collate;";
    
        dbDelta($sql_keywords);
    }
}