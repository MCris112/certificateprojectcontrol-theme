<?php

function cpc_register_my_cpts_certificates()
{

    /**
     * Post Type: Capacitaciones.
     */

    $labels = [
        "name" => 'Certificados',
        "singular_name" => "Certificado",
        "menu_name" => 'Certificados',
        "all_items" => 'Todos los certificados',
        "add_new" => 'Añadir Nuevo Certificado',
        "add_new_item" => 'Añadir Nuevo Certificado',
        "edit_item" => 'Editar Certificado',
        "new_item" => 'Nuevo Certificado',
        "view_item" => 'Ver Certificado',
        "view_items" => 'Ver Certificados',
        "search_items" => 'Buscar Certificados',
        "not_found" => 'No se ha encontrado algún Certificado existente',
        "not_found_in_trash" => 'No se ha encontrado algún Certificado en la papelera',
        "parent" => 'Certificado Padre',
        "featured_image" => 'Foto del Certificado',
        "set_featured_image" => 'Selecionar Foto para el Certificado',
        "remove_featured_image" => 'Quitar Foto del Certificado',
        "use_featured_image" => 'Usar esta Foto para el Certificado',
        "archives" => 'Certificados',
        "insert_into_item" => 'Insertar Certificado',
        "uploaded_to_this_item" => 'Certificado subido a este Certificado',
        "filter_items_list" => 'Filtrar Certificados',
        "items_list_navigation" => 'Navegación de Certificados',
        "items_list" => 'Lista de Certificados',
        "attributes" => 'Atributos del Certificado',
        "name_admin_bar" => 'Añadir nuevo Certificado',
        "item_published" => 'Certificado publicado',
        "item_published_privately" => 'Certificado publicado en privado',
        "item_reverted_to_draft" => 'Certificado volvió a borrador',
        "item_scheduled" => 'Certificado programado',
        "item_updated" => 'Certificado actualizado',
        "parent_item_colon" => 'Certificado Padre:',

    ];

    $args = [
        "label" => 'Certificados',
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

    register_post_type("certificates", $args);
}

add_action('init', 'cpc_register_my_cpts_certificates');