<?php

/************************************
 * 
 * INFORMACIÓN META BOX AND CUSTOM FIELDS
 */

function cpc_capacitacion_product_temario_register_meta_box()
{
    add_meta_box('cpc_capacitacion_product_temario_meta_box_info', 'Temario de la capacitación', 'cpc_capacitacion_product_temario_meta_box_callback', 'product', 'normal', 'high');
}

add_action('add_meta_boxes', 'cpc_capacitacion_product_temario_register_meta_box');

function cpc_capacitacion_product_temario_meta_box_callback($post)
{

    wp_nonce_field('cpc_capacitacion_product_temario_save_meta_box', 'cpc_capacitacion_meta_box_nonce_information');

    $value = get_post_meta($post->ID, '_cpc_capacitacion_field_temario', true);

    if (empty($value)) {
        $value = '{}';
    }

?>
    <button class="btn btn-primary" type="button" onclick="cpc_field_temario_add_item();">Añadir Contenido</button>

    <input id="_cpc_capacitacion_field_temario" name="_cpc_capacitacion_field_temario" type="text" value='<?php echo $value; ?>'>
    <input id="site_url" name="site_url" type="hidden" value='<?php echo site_url(); ?>'>

    <div class="accordion" id="cpcTemarioContainer">
        
    </div>

    <div class="modal fade" id="cpcModalResetValue" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Desea formatear el temario para continuar y evitar errores?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    El valor del array que muestra es el incorrecto y no es array.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="cpc_field_temario_reset();" data-bs-dismiss="modal">Formatear</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
<?php
}

function cpc_capacitacion_product_temario_save_meta_box($post_id)
{

    if (!isset($_POST['cpc_capacitacion_meta_box_nonce_information'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['cpc_capacitacion_meta_box_nonce_information'], 'cpc_capacitacion_product_temario_save_meta_box')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (!isset($_POST['_cpc_capacitacion_field_temario'])) {
        return;
    }

    update_post_meta($post_id, '_cpc_capacitacion_field_temario', $_POST['_cpc_capacitacion_field_temario']);

    /*
    $temario_field = get_post_meta($post_id, '_cpc_capacitacion_field_temario', true);;

    try {
       echo $temario_field;

        $temario = json_decode($temario_field, true);
        update_post_meta($post_id, '_test', print_r( json_decode($temario_field, true) , true) );

        foreach ($temario as $item) {
            if( !isset($_POST[$item]) || !empty($_POST[$item]) ){
                update_post_meta($post_id, $item, $_POST[$item]);
            }

            if( !isset($_POST[$item . '_title']) || !empty($_POST[$item . '_title']) ){
                update_post_meta($post_id, $item . '_title', $_POST[$item . '_title']);
            }
        }
    } catch (Exception $e) {
        update_post_meta($post_id, '_test_error', $e->getMessage() );
    }
    */
}

add_action('save_post', 'cpc_capacitacion_product_temario_save_meta_box');
