<?php

/************************************
 * 
 * PONENTES META BOXES AND CUSTOM FIELDS
 */

function cpc_capacitacion_register_meta_boxes()
{
    add_meta_box('cpc_capacitacion_meta_box_modalidad', 'Modalidad', 'cpc_capacitacion_meta_box_callback', 'product', 'side', 'high');
}

add_action('add_meta_boxes', 'cpc_capacitacion_register_meta_boxes');

function cpc_capacitacion_meta_box_callback($post)
{
    wp_nonce_field('cpc_capacitacion_save_meta_box_data_modalidad', 'cpc_capacitacion_meta_box_nonce_modalidad');

    $value = get_post_meta($post->ID, '_cpc_capacitacion_field_modalidad', true);
?>

    <select name="cpc_capacitacion_field_modalidad" id="cpc_capacitacion_field_modalidad" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
        <option value="true" selected>Sincrónica</option>
        <option value="false">Asincrónica</option>
    </select>

<?php
}

/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function cpc_capacitacion_save_meta_box_data_modalidad($post_id)
{

    if (!isset($_POST['cpc_capacitacion_meta_box_nonce_modalidad'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['cpc_capacitacion_meta_box_nonce_modalidad'], 'cpc_capacitacion_save_meta_box_data_modalidad')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if ( !isset($_POST['cpc_capacitacion_field_modalidad']) ) {
        return;
    }

    update_post_meta($post_id, '_cpc_capacitacion_field_modalidad', $_POST['cpc_capacitacion_field_modalidad'] );
}

add_action('save_post', 'cpc_capacitacion_save_meta_box_data_modalidad');
