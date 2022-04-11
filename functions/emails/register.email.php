<?php


function cpc_email_register_menu(){
    add_menu_page( 'Emails', 'Email', 'manage_options', 'cpc-email', 'cpc_email_func_capacitacion_single', 'dashicons-welcome-widgets-menus', 4 );
}

add_action( 'admin_menu', 'cpc_email_register_menu' );

require __DIR__ . '/capacitacion-single.email.php';