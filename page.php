
    <?php

get_header();

function cpc_shop_account_link_subtitle_breadcump($endpoints){

    if(is_array($endpoints)){

    }else{
        return '<a class="" href="'.get_permalink(get_option('woocommerce_myaccount_page_id')).'">Mi cuenta</a> / <span class="">'.$endpoints.'</span>';
    }

}


$title = get_the_title();
$subtitle = 'Certificate Project Control';

if( is_checkout() && !empty( is_wc_endpoint_url('order-received')) ) {
    $title = '¡Muchas Gracias!';
    $subtitle = '¡Su pedido ha sido recibido!';
}

if(is_account_page()){
    $subtitle = 'Certificate Project Control';

    if(is_wc_endpoint_url('orders')){
        $title = 'Mis pedidos';
        $subtitle = cpc_shop_account_link_subtitle_breadcump('Pedidos');
    }

    if( is_wc_endpoint_url('edit-address')){
        $title = 'Dirección de facturación';
        $subtitle = cpc_shop_account_link_subtitle_breadcump('Editar dirección');
    }

    if( is_wc_endpoint_url('edit-account')){
        $title = 'Editar cuenta';
        $subtitle = cpc_shop_account_link_subtitle_breadcump('Editar cuenta');
    }

    if( is_wc_endpoint_url('lost-password')){
        $title = '¿Olvido su contraseña?';
        $subtitle ="";
    }
}

$args = array(
    'title' => $title,
    'subtitle' => $subtitle,
);
get_template_part('template-parts/section', 'title', $args);

the_content();
?>

<?php
get_footer();
?>