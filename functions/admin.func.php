<?php

function cpc_edit_post_add_custom_styles()
{
	wp_enqueue_script( 'cpc_bootstrap_admin_load', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js' );
	wp_enqueue_style( 'cpc_prfx_meta_box_styles', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' );
	wp_enqueue_style('cpc_fontawesome_css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
	wp_enqueue_style('cpc_timepicker_css', 'https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css');

}

add_action( 'admin_print_styles', 'cpc_edit_post_add_custom_styles', 10, 1 );

function cpc_edit_post_add_custom_scripts()
{
	wp_enqueue_script( 'cpc_admin_mainr_script', get_template_directory_uri().'/js/admin-capacitacion.js', array( ), '1.0.0', true );
	wp_enqueue_script( 'cpc_admin_modaliad_script', get_template_directory_uri().'/js/admin-capacitacion-modalidad.js', array('jquery', 'jquery-ui-datepicker' ), '1.0.0', true );
	wp_enqueue_script( 'cpc_admin_ponentes_script', get_template_directory_uri().'/js/admin-capacitacion-ponentes.js', array('jquery', 'jquery-ui-datepicker' ), '1.0.0', true );
	wp_enqueue_script( 'cpc_time_picker_script', 'https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js', array(), '1.0.0', true );
}

add_action( 'admin_enqueue_scripts', 'cpc_edit_post_add_custom_scripts');