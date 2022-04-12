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

    //CONFIGURE OPTION TO SET WHOS IS GONNA BE SEND IT
    $to = "quinonesvillanueva@gmail.com";
    $subject = "NUEVO MENSAJE TIPO: " . $_POST['type'];;
    $content = $_POST['content'];

    $message = "";

    if (is_array($content)) {
        $message = implode('<br>', $content);
    }

    $table_data = array(
        'cpc_email_subject' => $subject,
        'cpc_date' => date("Y-m-d"),
        'cpc_time' => date("H:i:s"),
        'cpc_status' => 'pending',
    );

    foreach ($content as $key => $val) {
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

        $headers = array('Content-Type: text/html; charset=UTF-8');

        $result = wp_mail($to, $subject, $message, $headers);

        if (!$result) {
            $response['status'] = 'error';
            $response['message'] = 'Error al enviar el email';
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
