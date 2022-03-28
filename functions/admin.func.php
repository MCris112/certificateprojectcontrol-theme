<?php

function cpc_edit_post_add_custom_styles()
{
	wp_enqueue_script( 'cpc_bootstrap_admin_load', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js' );
	wp_enqueue_style( 'cpc_prfx_meta_box_styles', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' );
}

add_action( 'admin_print_styles', 'cpc_edit_post_add_custom_styles', 10, 1 );

function cpc_edit_post_add_custom_scripts()
{
	wp_enqueue_script( 'cpc_date_picker_script', get_template_directory_uri().'/js/admin-capacitacion.js', array('jquery', 'jquery-ui-datepicker'), '1.0.0', true );
}

add_action( 'admin_enqueue_scripts', 'cpc_edit_post_add_custom_scripts');