<?php

/************************************
 * 
 * MODALIDAD META BOXES AND CUSTOM FIELDS
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
    $inicio_clases = get_post_meta($post->ID, '_cpc_capacitacion_field_fecha_inicio', true);
?>

    <select name="cpc_capacitacion_field_modalidad" id="cpc_capacitacion_field_modalidad" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
        <option value="true" <?php if ($value) echo "selected"; ?>>Sincrónica</option>
        <option value="false" <?php if (!$value) echo "selected"; ?>>Asincrónica</option>
    </select>

    <div id="cpc_field_datepicker_container" class="input-group mb-3" style="display: none;">
        <span class="input-group-text" id="basic-addon1">Inicio</span>
        <input type="text" class="form-control cpc_field_datepicker" name="cpc_capacitacion_field_modalidad_fecha" id="cpc_capacitacion_field_modalidad_fecha" value="<?php echo $inicio_clases; ?>">
    </div>
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

    if ( !isset($_POST['cpc_capacitacion_field_modalidad'])) {
        return;
    }

    $is_sincronico = filter_var(  $_POST['cpc_capacitacion_field_modalidad'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

    update_post_meta($post_id, '_cpc_capacitacion_field_modalidad', $is_sincronico);
    update_post_meta($post_id, '_cpc_capacitacion_field_fecha_inicio', $_POST['cpc_capacitacion_field_modalidad_fecha']);
}

add_action('save_post', 'cpc_capacitacion_save_meta_box_data_modalidad');
