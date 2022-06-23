<?php

function cpc_register_my_cpts_home_sliders()
{

    /**
     * Post Type: Capacitaciones.
     */

    $labels = [
        "name" => 'Home Sliders',
        "singular_name" => "Home Slider",
        "menu_name" => 'Home Slider',
        "all_items" => 'Todos los Sliders',
        "add_new" => 'Añadir Nuevo Slider',
        "add_new_item" => 'Añadir Nuevo Slider',
        "edit_item" => 'Editar Slider',
        "new_item" => 'Nuevo Slider',
        "view_item" => 'Ver Slider',
        "view_items" => 'Ver Sliders',
        "search_items" => 'Buscar Sliders',
        "not_found" => 'No se ha encontrado algún Slider existente',
        "not_found_in_trash" => 'No se ha encontrado algún Slider en la papelera',
        "parent" => 'Home Slider Padre',
        "featured_image" => 'Foto del Ingeniero',
        "set_featured_image" => 'Selecionar Foto Ingeniero',
        "remove_featured_image" => 'Quitar Foto del Slider',
        "use_featured_image" => 'Usar esta Foto para el Slider',
        "archives" => 'Sliders',
        "insert_into_item" => 'Insertar Slider',
        "uploaded_to_this_item" => 'Slider subido a este Slider',
        "filter_items_list" => 'Filtrar Slider',
        "items_list_navigation" => 'Navegación de Sliders',
        "items_list" => 'Lista de Slider',
        "attributes" => 'Atributos del Slider',
        "name_admin_bar" => 'Añadir nuevo Slider',
        "item_published" => 'Slider publicado',
        "item_published_privately" => 'Slider publicado en privado',
        "item_reverted_to_draft" => 'Slider volvió a borrador',
        "item_scheduled" => 'Slider programado',
        "item_updated" => 'Slider actualizado',
        "parent_item_colon" => 'Slider Padre:',

    ];

    $args = [
        "label" => 'Home Sliders',
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "show_in_menu" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "query_var" => true,
        "menu_position" => 3,
        "menu_icon" => "dashicons-welcome-learn-more",
        "supports" => ["title", "thumbnail"],
        "show_in_graphql" => false,
    ];

    register_post_type("home-sliders", $args);
}

add_action('init', 'cpc_register_my_cpts_home_sliders');




/************************************
 * 
 * PONENTES META BOXES AND CUSTOM FIELDS
 */

function cpc_homeslider_register_meta_boxes()
{
    add_meta_box('cpc_homeslider_meta_box_phone', 'Home Slider - Vista de celular', 'cpc_homeslider_meta_box_callback_phone', 'home-sliders', 'normal', 'high');
    add_meta_box('cpc_homeslider_meta_box_pc', 'Home Slider - Vista de pc', 'cpc_homeslider_meta_box_callback_pc', 'home-sliders', 'normal', 'high');
}

add_action('add_meta_boxes', 'cpc_homeslider_register_meta_boxes');

function cpc_homeslider_meta_box_callback_phone($post)
{
    wp_nonce_field('cpc_homeslider_save_meta_box_data_phone', 'cpc_homeslider_meta_box_nonce_phone');
    $content_phone = json_decode(get_post_meta($post->ID, '_cpc_homeslider_phone_key', true), true );
?>

    <div class="row">
        <div class="col">
            <p class="text-muted">Imagén de fondo</p>
            <button class="btn btn-outline-primary" type="button" id="cpc_slider_phone_input_btn_bg">Seleccionar imagen</button>
            <input type="hidden" value="<?php echo $content_phone['bg'] ?? ""; ?>" id="cpc_slider_phone_input_img_bg" name="cpc_slider_phone_input_img_bg">
            <img src="<?php echo $content_phone['bg'] ?? ""; ?>" alt="" class="w-100 mt-3" id="cpc_slider_bg_img_phone">
        </div>
        <div class="col">
            <p class="text-muted">Imagén de Texto</p>
            <button class="btn btn-outline-primary" type="button" id="cpc_slider_phone_input_btn_txt">Seleccionar imagen</button>
            <input type="hidden" value="<?php echo $content_phone['txt'] ?? ""; ?>" id="cpc_slider_phone_input_img_txt" name="cpc_slider_phone_input_img_txt">
            <img src="<?php echo $content_phone['txt'] ?? ""; ?>" alt="" class="w-100 mt-3" id="cpc_slider_txt_img_phone">
        </div>
    </div>

<?php
}

function cpc_homeslider_meta_box_callback_pc($post)
{
    wp_nonce_field('cpc_homeslider_save_meta_box_data_pc', 'cpc_homeslider_meta_box_nonce_pc');
    $content_pc = json_encode(get_post_meta(get_the_ID(), '_cpc_homeslider_pc_key', true), true);

?>
<div class="row">
        <div class="col">
            <p class="text-muted">Imagén de fondo</p>
            <button class="btn btn-outline-primary" type="button" id="cpc_slider_pc_input_btn_bg">Seleccionar imagen</button>
            <input type="hidden" value="<?php echo $content_pc['bg'] ?? ""; ?>" id="cpc_slider_pc_input_img_bg" name="cpc_slider_pc_input_img_bg">
            <img src="<?php echo $content_pc['bg'] ?? ""; ?>" alt="" class="w-100 mt-3" id="cpc_slider_txt_img_pc">
        </div>
        <div class="col">
            <p class="text-muted">Imagén de Texto</p>
            <button class="btn btn-outline-primary" type="button" id="cpc_slider_pc_input_btn_txt">Seleccionar imagen</button>
            <input type="hidden" value="<?php echo $content_pc['txt'] ?? ""; ?>" id="cpc_slider_pc_input_img_txt" name="cpc_slider_pc_input_img_txt">
            <img src="<?php echo $content_pc['txt'] ?? ""; ?>" alt="" class="w-100 mt-3" id="cpc_slider_bg_img_pc">
        </div>
    </div>

<?php
}


function cpc_homeslider_save_meta_box_data_phone($post_id)
{

    if (!isset($_POST['cpc_homeslider_meta_box_nonce_phone'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['cpc_homeslider_meta_box_nonce_phone'], 'cpc_homeslider_save_meta_box_data_phone')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $data_phone = [
        'bg' => esc_url($_POST['cpc_slider_phone_input_img_bg']),
        'txt' => esc_url($_POST['cpc_slider_phone_input_img_txt'])
    ];

    update_post_meta($post_id, '_cpc_homeslider_phone_key', json_encode($data_phone));
}

function cpc_homeslider_save_meta_box_data_pc($post_id)
{

    if (!isset($_POST['cpc_homeslider_meta_box_nonce_phone'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['cpc_homeslider_meta_box_nonce_pc'], 'cpc_homeslider_save_meta_box_data_pc')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (!isset($_POST['cpc_slider_pc_input_img_bg']) && !isset($_POST['cpc_slider_pc_input_img_txt'])) {
        return;
    }



    $data_phone = [
        'bg' => esc_url($_POST['cpc_slider_pc_input_img_bg']),
        'txt' => esc_url($_POST['cpc_slider_pc_input_img_txt'])
    ];

    update_post_meta($post_id, '_cpc_homeslider_pc_key', json_encode($data_phone));
}

add_action('save_post', 'cpc_homeslider_save_meta_box_data_phone');
add_action('save_post', 'cpc_homeslider_save_meta_box_data_pc');
