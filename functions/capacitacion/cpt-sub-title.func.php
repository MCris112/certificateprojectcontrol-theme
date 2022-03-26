<?php

/************************************
 * 
 * SUB TITLE META BOX AND CUSTOM FIELDS
 */

function cpc_capacitacion_register_meta_box_sub_title()
{
    add_meta_box('cpc_capacitacion_meta_box_sub_title', 'Subtitulo o Definición', 'cpc_capacitacion_meta_box_sub_title_callback', 'product', 'normal', 'high');
}

add_action('add_meta_boxes', 'cpc_capacitacion_register_meta_box_sub_title', 1);

function cpc_capacitacion_meta_box_sub_title_callback($post)
{
    wp_nonce_field('cpc_capacitacion_save_meta_box_data_sub_title', 'cpc_capacitacion_meta_box_nonce_sub_title');

    $value = get_post_meta($post->ID, '_cpc_capacitacion_field_sub_title', true);
?>

    <label for="basic-url" class="form-label">Escriba su subtitulo o definición del mismo</label>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon3">Subtitulo/Explicación</span>
        <input name="cpc_capacitacion_field_sub_title" id="cpc_capacitacion_field_sub_title" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="<?php echo $value; ?>">
    </div>

<?php
}

/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function cpc_capacitacion_save_meta_box_data_sub_title($post_id)
{

    if (!isset($_POST['cpc_capacitacion_meta_box_nonce_sub_title'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['cpc_capacitacion_meta_box_nonce_sub_title'], 'cpc_capacitacion_save_meta_box_data_sub_title')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (!isset($_POST['cpc_capacitacion_field_sub_title'])) {
        return;
    }

    update_post_meta($post_id, '_cpc_capacitacion_field_sub_title', $_POST['cpc_capacitacion_field_sub_title']);
}

add_action('save_post', 'cpc_capacitacion_save_meta_box_data_sub_title');
