<?php



function cpc_capacitacion_func_meta_fields_add(){
 
	echo '<div class="options_group">';

    woocommerce_wp_text_input( 
        array( 
            'id'                => '_cpc_product_duration', 
            'label'             => 'Duración de la capacitacion', 
            'placeholder'       => '', 
            'desc_tip'    => 'true',
            'description'       => 'Por favor insertar la duración del curso',
            'type'              => 'number', 
            'custom_attributes' => array(
                    'step' 	=> 'any',
                    'min'	=> '0'
                ) 
        )
    );

    woocommerce_wp_select( 
        array( 
            'id'      => '_product_type', 
            'label'   => __( 'Select Field', 'woocommerce' ), 
            'options' => array(
                'one'   => __( 'Option 1', 'woocommerce' ),
                'two'   => __( 'Option 2', 'woocommerce' ),
                'three' => __( 'Option 3', 'woocommerce' )
                )
            )
        );
 
	woocommerce_wp_checkbox( array(
		'id'      => 'super_product',
		'value'   => get_post_meta( get_the_ID(), 'super_product', true ),
		'label'   => 'This is a super product',
		'desc_tip' => true,
		'description' => 'If it is not a regular WooCommerce product',
	) );
 
	echo '</div>';
 
}
 
add_action( 'woocommerce_product_options_general_product_data', 'cpc_capacitacion_func_meta_fields_add');

function cpc_capacitacion_func_meta_fields_save( $post_id ){
 
    $woocommerce_number_field = $_POST['_cpc_product_duration'];
	if( !empty( $woocommerce_number_field ) )
		update_post_meta( $post_id, '_cpc_product_duration', esc_attr( $woocommerce_number_field ) );

	//if( !empty( $_POST['super_product'] ) ) {
		//update_post_meta( $id, 'super_product', $_POST['super_product'] );
	//} else {
	//	delete_post_meta( $id, 'super_product' );
	//}
 
}

add_action( 'woocommerce_process_product_meta', 'cpc_capacitacion_func_meta_fields_save', 10, 2 );

