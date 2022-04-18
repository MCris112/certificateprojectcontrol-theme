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

function cpc_ajax_remove_capacitacion_cart()
{
    global $woocommerce;
    $cart = $woocommerce->cart;

    $product_id = $_POST['product_id'];
    $response = array(); //
    $response['product_id'] = $product_id;

    foreach ($woocommerce->cart->get_cart() as $cart_item_key => $cart_item) {
        $response['items'][$cart_item_key] = $cart_item;

        if ($cart_item['product_id'] ==  $product_id) {
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

add_action('wp_ajax_cpc_remove_cpt_cart', 'cpc_ajax_remove_capacitacion_cart');
add_action('wp_ajax_nopriv_cpc_remove_cpt_cart', 'cpc_ajax_remove_capacitacion_cart');



function cpc_email_ajax_send()
{


    $response = array(); //
    $response['status'] = 'success';
    $response['message'] = 'Email enviado correctamente';

    if(!isset($_POST['content']['cpc_type'])){
        $response['status'] = 'error';
        $response['error'] = 'No se ha enviado el tipo de email';
        $response['code'] = 'no_type';
        $response['message'] = 'No se ha enviado el tipo de email';
        echo json_encode($response);
        wp_die();
    }

    if(!isset($_POST['content']['cpc_message'])){
        $response['status'] = 'error';
        $response['error'] = 'No se ha enviado el mensaje';
        $response['code'] = 'no_message';
        $response['message'] = 'No se ha enviado el mensaje';
        echo json_encode($response);
        wp_die();
    }

    //CONFIGURE OPTION TO SET WHOS IS GONNA BE SEND IT

    $subject = "Nuevo email";

    switch ($_POST['type']){
        case 'capacitacion-single':
            $subject = "Nueva capacitación";
        break;
    }

    $content = $_POST['content'];

    $message = "mensaje:";

    foreach( $content as $key => $value ){
        $message .= $key . ": " . $value . "\n";
    }

    $extra_info = $content['extra_info'];

    if( empty($extra_info) || !isset($extra_info) ) $extra_info = array();

    if( is_array($extra_info) ) $extra_info = json_encode($extra_info);

    $table_data = array(
        'cpc_email_subject' => $subject,
        'cpc_date' => date("Y-m-d"),
        'cpc_time' => date("H:i:s"),
        'cpc_status' => 'pending',
        'cpc_extra_info' => $extra_info,
    );

    foreach ($content as $key => $val) {
        if(empty($val)) {
            $response['error']['field'][] = $key;
            echo json_encode($response);
            wp_die();
        }
        if (is_array($val)) {
            $table_data[$key] = json_encode($val);
        } else {
            $table_data[$key] = $val;
        }
    }


    global $wpdb;
    $table_name = $wpdb->prefix . 'cpc_emails';
    $table_result = $wpdb->insert($table_name, $table_data);


    $response['data'] = $table_data;

    if ($table_result) {
        $response['wp']['status'] = 'success';
        $response['wp']['message'] = 'Email enviado correctamente';

        $to = get_option('cpc_settings_email_to');

        if(!empty($to)){
            $headers = array('Content-Type: text/html; charset=UTF-8');
            $result = wp_mail($to, $subject, $message, $headers);

            if (!$result) {
                $response['status'] = 'error';
                $response['message'] = 'Error al enviar el email';
            }
        }
        
    } else {
        $response['wp']['status'] = 'error';
        $response['wp']['message'] = 'Error al salvar el email';
        $response['wp']['error'] = $wpdb->last_error;
    }


    echo json_encode($response);
    wp_die();
}


add_action('wp_ajax_cpc_email_send', 'cpc_email_ajax_send');
add_action('wp_ajax_nopriv_cpc_email_send', 'cpc_email_ajax_send');


function cpc_shop_ajax_set_new_quantity(){
    $response = array();

    if(!isset($_POST['product_id'])){
        $response['status'] = 'error';
        $response['error'] = 'No se ha enviado la id del producto';
        $response['code'] = 'no_product_id';
        echo json_encode($response);
        wp_die();
    }

    if(!isset($_POST['new_quantity'])){
        $response['status'] = 'error';
        $response['error'] = 'No se ha enviado la nueva cantidad';
        $response['code'] = 'no_new_quantity';
        echo json_encode($response);
        wp_die();
    }
}

add_action('wp_ajax_cpc_shop_set_new_quantity', 'cpc_shop_ajax_set_new_quantity');
add_action('wp_ajax_nopriv_cpc_shop_set_new_quantity', 'cpc_shop_ajax_set_new_quantity');
