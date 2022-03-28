<?php


function cpc_capactacion_func_woo_tab_info($settings, $current_section)
{
    if ($current_section == 'cpc_information') {
        woocommerce_wp_text_input(
            array(
                'id' => '_cpc_cpt_woo_logro',
                'label' => 'Logro de la capacitación',
                'description' => 'Logro de la capacitación que se mostrará en la página, en caso esté vacío no se mostrará este campo',
            ),
        );
    }
}

add_filter( 'woocommerce_get_settings_products', 'cpc_capactacion_func_woo_tab_info', 10, 2 );


function cpc_capactacion_func_woo_add_tab($sections)
{

    $sections['cpc_information'] = 'Información';
    return $sections;
}
add_filter('woocommerce_get_sections_products', 'function cpc_capactacion_func_woo_add_tab');

/**
 * Create the section beneath the products tab
 **/
add_filter( 'woocommerce_get_sections_products', 'wcslider_add_section' );
function wcslider_add_section( $sections ) {
	
	$sections['wcslider'] = __( 'WC Slider', 'text-domain' );
	return $sections;
	
}

/**
 * Add settings to the specific section we created before
 */
add_filter( 'woocommerce_get_settings_products', 'wcslider_all_settings', 10, 2 );
function wcslider_all_settings( $settings, $current_section ) {
	/**
	 * Check the current section is what we want
	 **/
	if ( $current_section == 'wcslider' ) {
		$settings_slider = array();
		// Add Title to the Settings
		$settings_slider[] = array( 'name' => __( 'WC Slider Settings', 'text-domain' ), 'type' => 'title', 'desc' => __( 'The following options are used to configure WC Slider', 'text-domain' ), 'id' => 'wcslider' );
		// Add first checkbox option
		$settings_slider[] = array(
			'name'     => __( 'Auto-insert into single product page', 'text-domain' ),
			'desc_tip' => __( 'This will automatically insert your slider into the single product page', 'text-domain' ),
			'id'       => 'wcslider_auto_insert',
			'type'     => 'checkbox',
			'css'      => 'min-width:300px;',
			'desc'     => __( 'Enable Auto-Insert', 'text-domain' ),
		);
		// Add second text field option
		$settings_slider[] = array(
			'name'     => __( 'Slider Title', 'text-domain' ),
			'desc_tip' => __( 'This will add a title to your slider', 'text-domain' ),
			'id'       => 'wcslider_title',
			'type'     => 'text',
			'desc'     => __( 'Any title you want can be added to your slider with this option!', 'text-domain' ),
		);
		
		$settings_slider[] = array( 'type' => 'sectionend', 'id' => 'wcslider' );
		return $settings_slider;
	
	/**
	 * If not, return the standard settings
	 **/
	} else {
		return $settings;
	}
}