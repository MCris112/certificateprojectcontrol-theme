<?php




function cpc_capacitacion_modalidad_register_taxonomy()
{
    $args = array(
        'hierarchical'                      => true,
        'labels' => array(
            'name'                          => 'Modalidad',
            'singular_name'                 => 'Modadlidad',
            'search_items'                  => 'Buscar modadlidad',
            'popular_items'                 => __('Popular Test Tax'),
            'all_items'                     => __('All Test Tax'),
            'edit_item'                     => __('Edit Test Tax'),
            'edit_item'                     => __('Edit Test Tax'),
            'update_item'                   => __('Update Test Tax'),
            'add_new_item'                  => __('Add New Test Tax'),
            'new_item_name'                 => __('New Test Tax Name'),
            'separate_items_with_commas'    => __('Seperate Test Tax with Commas'),
            'add_or_remove_items'           => __('Add or Remove Test Tax'),
            'choose_from_most_used'         => __('Choose from Most Used Test Tax')
        ),
        'query_var'                         => true,
        'rewrite'                           => array('slug' => 'modalidad'),
        'hierarchical' => false,
        'show_ui' => true,
        'show_menu' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'has_archive' => true,
    );
    register_taxonomy('modalidad', array('product'), $args);

    //CODE TO REGISTER TAXONOMY

    if (!term_exists('sincronico', 'modalidad')) {
        wp_insert_term(
            'Sincrónico',
            'modalidad',
            array(
                'description' => 'Capacitaciones en vivo.',
                'slug'        => 'sincronico'
            )
        );
    }

    if (!term_exists('asincronico', 'modalidad')) {
        wp_insert_term(
            'Asincrónico',
            'modalidad',
            array(
                'description' => 'Capacitaciones con clases pre-grabadas.',
                'slug'        => 'asincronico'
            )
        );
    }
}


add_action('init', 'cpc_capacitacion_modalidad_register_taxonomy', 0);

/************************************
 * 
 * MODALIDAD META BOXES AND CUSTOM FIELDS
 */

function cpc_capacitacion_register_meta_boxes()
{
    add_meta_box('cpc_capacitacion_meta_box_modalidad', 'Modalidad', 'cpc_capacitacion_meta_box_callback', 'product', 'side', 'high');
    remove_meta_box('tagsdiv-modalidad', 'product', 'side');
}

add_action('add_meta_boxes', 'cpc_capacitacion_register_meta_boxes');

function cpc_capacitacion_meta_box_callback($post)
{
    wp_nonce_field('cpc_capacitacion_save_meta_box_data_modalidad', 'cpc_capacitacion_meta_box_nonce_modalidad');

    $value = get_post_meta($post->ID, '_cpc_capacitacion_field_modalidad', true);
    $inicio_clases = get_post_meta($post->ID, '_cpc_capacitacion_field_fecha_inicio', true);
    $time_desde = get_post_meta($post->ID, '_cpc_capacitacion_field_modalidad_time_desde', true);
    $time_hasta = get_post_meta($post->ID, '_cpc_capacitacion_field_modalidad_time_hasta', true);

    $terms = get_terms([
        'taxonomy' => 'modalidad',
        'hide_empty' => false,
    ]);
?>

    <select name="cpc_capacitacion_field_modalidad" id="cpc_capacitacion_field_modalidad" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
        <?php

        foreach ($terms as $term) {
            $checked = '';
            if ($value == $term->slug) {
                $checked = 'selected';
            }
            echo '<option value="' . $term->slug . '" ' . $checked . '>' . $term->name . '</option>';
        }

        ?>
    </select>

    <div id="cpc_field_datepicker_container" style="display: none;">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Inicio</span>
            <input type="text" class="form-control cpc_field_datepicker" name="cpc_capacitacion_field_modalidad_fecha" id="cpc_capacitacion_field_modalidad_fecha" value="<?php echo $inicio_clases; ?>">
        </div>
        <div id="cpc_field_timepicker_container" class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Desde</span>
            <input type="text" class="form-control cpc_field_timepicker" name="cpc_capacitacion_field_modalidad_time_desde" id="cpc_capacitacion_field_modalidad_time_desde" value="<?php echo '' ?>">
        </div>

        <div id="cpc_field_timepicker_container" class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Hasta</span>
            <input type="text" class="form-control cpc_field_timepicker" name="cpc_capacitacion_field_modalidad_time_hasta" id="cpc_capacitacion_field_modalidad_time_hasta" value="<?php echo '' ?>">
        </div>

        <div id="cpc_field_multidays_container">
            Días de clases:
            <hr>
            <input type="text" id="cpc_field_fechas_array">

            <div id="cpc_field_multidays_container_items">

            </div>

            <input type="text" id="datepicker_fechas"  class="form-control">
        </div>
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

    if (!isset($_POST['cpc_capacitacion_field_modalidad'])) {
        return;
    }

    wp_set_object_terms($post_id, $_POST['cpc_capacitacion_field_modalidad'], 'modalidad');

    update_post_meta($post_id, '_cpc_capacitacion_field_modalidad', $_POST['cpc_capacitacion_field_modalidad']);
    update_post_meta($post_id, '_cpc_capacitacion_field_fecha_inicio', $_POST['cpc_capacitacion_field_modalidad_fecha']);
    update_post_meta($post_id, '_cpc_capacitacion_field_modalidad_time_desde', $_POST['cpc_capacitacion_field_modalidad_time_desde']);
    update_post_meta($post_id, '_cpc_capacitacion_field_modalidad_time_hasta', $_POST['cpc_capacitacion_field_modalidad_time_hasta']);
}

add_action('save_post', 'cpc_capacitacion_save_meta_box_data_modalidad');
