<?php


/**
 * Register Sliders menu page.
 */
function wpdocs_register_my_custom_menu_page() {
    add_menu_page(
        __( 'Sliders', 'textdomain' ),
        'custom menu',
        'manage_options',
        'cpc-sliders',
        'cpc_menu_front_page_add_menu',
        plugins_url( 'myplugin/images/icon.png' ),
        6
    );
}

function cpc_menu_front_page_add_menu() {
    echo "hola";
}
add_action( 'admin_menu', 'wpdocs_register_my_custom_menu_page' );