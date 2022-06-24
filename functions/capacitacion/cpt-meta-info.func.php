<?php



function cpc_capacitacion_func_meta_fields_add(){
 
	echo '<div class="options_group">';
    woocommerce_wp_text_input( 
        array( 
            'id'                => '_cpc_product_discount_percent',
            'label'             => 'Descuento de la promoción', 
            'placeholder'       => '', 
            'desc_tip'    => 'true',
            'description'       => 'Por favor insertar el número del porcentaje para el descuento.',
            'type'              => 'number', 
            'custom_attributes' => array(
                    'step' 	=> 'any',
                    'min'	=> '0'
                ) 
        )
    );

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

    woocommerce_wp_text_input( 
        array( 
            'id'                => '_cpc_product_sessions', 
            'label'             => 'N° de sesiones', 
            'placeholder'       => '', 
            'desc_tip'    => 'true',
            'description'       => 'Por favor insertar las sesiones que tiene esta capacitación.',
            'type'              => 'number', 
            'custom_attributes' => array(
                    'step' 	=> 'any',
                    'min'	=> '0'
                ) 
        )
    );

    woocommerce_wp_text_input( 
        array( 
            'id'                => '_cpc_product_brochure_link', 
            'label'             => 'Link del brochure', 
            'placeholder'       => 'https://pcertificate.com/brochure', 
            'desc_tip'    => 'true',
            'description'       => 'Si desea que aparezca un link a la brochura de la capacitación, por favor ingrese el link aquí.',
            'type'              => 'text',
        )
    );

    woocommerce_wp_text_input( 
        array( 
            'id'                => '_cpc_product_video_link', 
            'label'             => 'Link de video de presentación', 
            'placeholder'       => 'https://youtu.be/9Vpe-dqscyM', 
            'desc_tip'    => 'true',
            'description'       => 'Si la capacitación tiene video, puede colocarlo aqui.',
            'type'              => 'text',
        )
    );
 
	echo '</div>';
 
}
 
add_action( 'woocommerce_product_options_general_product_data', 'cpc_capacitacion_func_meta_fields_add');

function cpc_capacitacion_func_meta_fields_save( $post_id ){
 
    $woocommerce_number_field = $_POST['_cpc_product_duration'];
    $woo_sessions = $_POST['_cpc_product_sessions'];
    $woo_brochure_link = $_POST['_cpc_product_brochure_link'];
    $woo_video = $_POST['_cpc_product_video_link'];
    $woo_discount_percent = $_POST['_cpc_product_discount_percent'];

	if( !empty( $woocommerce_number_field ) )
		update_post_meta( $post_id, '_cpc_product_duration', esc_attr( $woocommerce_number_field ) );

    if( !empty( $woo_sessions ) )
        update_post_meta( $post_id, '_cpc_product_sessions', esc_attr( $woo_sessions ) );
    
    if( !empty( $woo_brochure_link ) )
        update_post_meta( $post_id, '_cpc_product_brochure_link', esc_attr( $woo_brochure_link ) );
    
    if( !empty( $woo_video ) )
        update_post_meta( $post_id, '_cpc_product_video_link', esc_attr( $woo_video ) );

    if( !empty( $woo_discount_percent ) )
        update_post_meta( $post_id, '_cpc_product_discount_percent', esc_attr($woo_discount_percent) );
	//if( !empty( $_POST['super_product'] ) ) {
		//update_post_meta( $id, 'super_product', $_POST['super_product'] );
	//} else {
	//	delete_post_meta( $id, 'super_product' );
	//}
 
}

add_action( 'woocommerce_process_product_meta', 'cpc_capacitacion_func_meta_fields_save', 10, 2 );

