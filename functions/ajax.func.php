<?php

function cpc_ajax_get_post_meta()
{

	if (empty($_POST['post_id'])) {
		wp_send_json_error('No se han enviado la ID');
		wp_die();
	}

	if (empty($_POST['meta_keys'])) {
		wp_send_json_error('No se han enviado los datos');
		wp_die();
	}

	$ID = $_POST['post_id'];
	$meta_keys = $_POST['meta_keys'];

	$meta_values = [];

	foreach ($meta_keys as $meta_key) {
		$meta_values[$meta_key] = get_post_meta($ID, $meta_key, true);
	}

	wp_send_json($meta_values);
	wp_die();
}
add_action('wp_ajax_nopriv_cpc_post_meta', 'cpc_ajax_get_post_meta');
add_action('wp_ajax_cpc_post_meta', 'cpc_ajax_get_post_meta');

function cpc_ajax_remove_capacitacion_cart () {
    global $woocommerce;
    $cart = $woocommerce->cart;

    $product_id = $_POST['product_id'];
    $response = array(); //
    $response['product_id'] = $product_id;

    foreach ($woocommerce->cart->get_cart() as $cart_item_key => $cart_item){
        $response['items'][$cart_item_key] = $cart_item;

        if($cart_item['product_id'] ==  $product_id){
            // Remove product in the cart using  cart_item_key.
            $cart->remove_cart_item($cart_item_key);
            $response['status'] = 'success';
            echo json_encode($response);
            wp_die();
        }
    }
    $response['status'] = 'not_found';
    echo json_encode($response);
    wp_die();
}

add_action( 'wp_ajax_cpc_remove_cpt_cart', 'cpc_ajax_remove_capacitacion_cart' );
add_action( 'wp_ajax_nopriv_cpc_remove_cpt_cart', 'cpc_ajax_remove_capacitacion_cart' );