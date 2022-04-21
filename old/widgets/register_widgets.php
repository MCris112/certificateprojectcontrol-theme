<?php

function epaossac_register_widgets($widgets_manager)
{

	require_once(__DIR__ . '/capacitacion/capacitacion-description-widget.php');
	require_once(__DIR__ . '/capacitacion/capacitacion-info-3-widget.php');

	$widgets_manager->register(new \cpc_addon_elementor_widget_capacitacion_description());
	$widgets_manager->register(new \cpc_addon_elementor_widget_capacitacion_info_3());
}
add_action('elementor/widgets/register', 'epaossac_register_widgets');

function cpc_add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'cpc-capacitaciones',
		[
			'title' => 'Capacitaciones Widgets',
			'icon' => 'fa fa-plug',
		]
	);
	$elements_manager->add_category(
		'second-category',
		[
			'title' => esc_html__( 'Second Category', 'plugin-name' ),
			'icon' => 'fa fa-plug',
		]
	);

}
add_action( 'elementor/elements/categories_registered', 'cpc_add_elementor_widget_categories' );
