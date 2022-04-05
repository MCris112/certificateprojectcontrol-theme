<?php

/************************************
 * 
 * ADD POENNTES METABOX
 */

function cpc_capacitacion_product_ponentes_register_meta_box()
{
    add_meta_box('cpc_capacitacion_product_ponentes_meta_box_info', 'Ponentes', 'cpc_capacitacion_product_ponentes_meta_box_callback', 'product', 'side', 'low');
}

add_action('add_meta_boxes', 'cpc_capacitacion_product_ponentes_register_meta_box');


function cpc_capacitacion_product_ponentes_meta_box_callback()
{
    wp_nonce_field('cpc_capacitacion_product_ponentes_save_meta_box', 'cpc_capacitacion_meta_box_nonce_ponentes');
    $value = get_post_meta(get_the_ID(), '_cpc_capacitacion_field_ponentes', true);

    /*
    $ponentes_query = new WP_Query(array(
        'post_type' => 'ponentes',
    ));

    if ($ponentes_query->have_posts()) {
        while ( $ponentes_query->have_posts() ){
            $ponentes_query->the_post();

            echo the_title();
        }
    }

    */
}
