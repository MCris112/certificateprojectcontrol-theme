<?php

function cpc_register_my_cpts_scrollheader()
{

    /**
     * Post Type: Capacitaciones.
     */

    $labels = [
        "name" => 'Scroll Headers',
        "singular_name" => "Scroll Header",
        "menu_name" => 'Scroll Header',
        "all_items" => 'Todos los Scroll Headers',
        "add_new" => 'Añadir Nuevo Scroll Header',
        "add_new_item" => 'Añadir Nuevo Scroll Header',
        "edit_item" => 'Editar Scroll Header',
        "new_item" => 'Nuevo Scroll Header',
        "view_item" => 'Ver Scroll Header',
        "view_items" => 'Ver Scroll Headers',
        "search_items" => 'Buscar Scroll Headers',
        "not_found" => 'No se ha encontrado algún Scroll Header existente',
        "not_found_in_trash" => 'No se ha encontrado algún Scroll Header en la papelera',
        "parent" => 'Scroll Header Padre',
        "featured_image" => 'Foto del Ingeniero',
        "set_featured_image" => 'Selecionar Foto Ingeniero',
        "remove_featured_image" => 'Quitar Foto del Scroll Header',
        "use_featured_image" => 'Usar esta Foto para el Scroll Header',
        "archives" => 'Sliders',
        "insert_into_item" => 'Insertar Scroll Header',
        "uploaded_to_this_item" => 'Scroll Header subido a este Scroll Header',
        "filter_items_list" => 'Filtrar Scroll Header',
        "items_list_navigation" => 'Navegación de Scroll Headers',
        "items_list" => 'Lista de Scroll Header',
        "attributes" => 'Atributos del Scroll Header',
        "name_admin_bar" => 'Añadir nuevo Scroll Header',
        "item_published" => 'Scroll Header publicado',
        "item_published_privately" => 'Scroll Header publicado en privado',
        "item_reverted_to_draft" => 'Scroll Header volvió a borrador',
        "item_scheduled" => 'Scroll Header programado',
        "item_updated" => 'Scroll Header actualizado',
        "parent_item_colon" => 'Scroll Header Padre:',

    ];

    $args = [
        "label" => 'Scroll Headers',
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
        "supports" => ["title"],
        "show_in_graphql" => false,
    ];

    register_post_type("scroll-header", $args);
}

add_action('init', 'cpc_register_my_cpts_scrollheader');




/************************************
 * 
 * PONENTES META BOXES AND CUSTOM FIELDS
 */

function cpc_scrollheader_register_meta_boxes()
{
    add_meta_box('cpc_scrollheader_meta_box_content', 'Scroll Header - Contenido del scrollHeader', 'cpc_scrollheader_meta_box_callback', 'scroll-header', 'normal', 'high');
}

add_action('add_meta_boxes', 'cpc_scrollheader_register_meta_boxes');

function cpc_scrollheader_meta_box_callback($post)
{
    wp_nonce_field('cpc_scrollheader_save_meta_box_data', 'cpc_scrollheader_meta_box_nonce');

    $value = get_post_meta($post->ID, '_cpc_scrollheader_key', true);

    wp_editor( htmlspecialchars_decode($value), "cpc_scrollheader_content", [
        'textarea_name' => "cpc_scrollheader_content",
        'tinymce'       => [
            'toolbar1'      => 'bold,italic,underline,separator,separator,link,unlink,undo,redo',
            'toolbar2'      => '',
            'toolbar3'      => '',
        ],
    ] );
}


function cpc_scrollheader_save_meta_box_data($post_id)
{

    if (!isset($_POST['cpc_scrollheader_meta_box_nonce'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['cpc_scrollheader_meta_box_nonce'], 'cpc_scrollheader_save_meta_box_data')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (!isset($_POST['cpc_scrollheader_content'])) {
        return;
    }

    update_post_meta($post_id, '_cpc_scrollheader_key', htmlspecialchars( $_POST['cpc_scrollheader_content'] ) );
}

add_action('save_post', 'cpc_scrollheader_save_meta_box_data');
