<?php

function cpc_email_wp_create()
{
    /* 
    Table columns:
    0: ID = Primary
    1: email_subject
    2: email_message
    3: name
    4: last_name
    5: phone
    6: email
    7: date
    8: time
    9: country
    10: type
    11: status
    12: extra_info
    */

    if (!get_option('tables_created', false)) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'cpc_emails';

        if ($wpdb->get_var("SHOW TABLES LIKE '" . $table_name . "'") != $table_name) {
            $charset_collate = $wpdb->get_charset_collate();
            $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            cpc_email_subject varchar(255) NOT NULL,
            cpc_message text NOT NULL,
            cpc_name varchar(255) NOT NULL,
            cpc_last_name varchar(255) NOT NULL,
            cpc_phone varchar(255) NOT NULL,
            cpc_email varchar(255) NOT NULL,
            cpc_date DATE NOT NULL,
            cpc_time TIME NOT NULL,
            cpc_country varchar(255) NOT NULL,
            cpc_type varchar(255) NOT NULL,
            cpc_status varchar(255) NOT NULL,
            cpc_extra_info text,
            PRIMARY KEY  (id)
        ) $charset_collate;";

            if (!function_exists('dbDelta')) {
                require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            }

            dbDelta($sql);
            update_option('tables_created', true);
        }
    }
}

add_action('init', 'cpc_email_wp_create');

function cpc_email_register_menu()
{
    add_menu_page('Emails', 'Email', 'manage_options', 'cpc-email', 'cpc_email_func_capacitacion_single', 'dashicons-welcome-widgets-menus', 4);
}

add_action('admin_menu', 'cpc_email_register_menu');

require __DIR__ . '/capacitacion-single.email.php';
