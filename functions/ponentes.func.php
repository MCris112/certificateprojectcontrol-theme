<?php




/************************************
 * 
 * PONENTES CUSTOM POST TYPE
 */

function cpc_register_my_cpts_ponentes()
{

    /**
     * Post Type: Capacitaciones.
     */

    $labels = [
        "name" => 'Ponentes',
        "singular_name" => "Ponente",
        "name" => 'Ponentes',
        "singular_name" => 'Ponente',
        "menu_name" => 'Ponentes',
        "all_items" => 'Todos los Ponentes',
        "add_new" => 'Añadir Nuevo Ponente',
        "add_new_item" => 'Añadir Nuevo Ponente',
        "edit_item" => 'Editar Ponente',
        "new_item" => 'Nuevo Ponente',
        "view_item" => __("A", "hello-elementor"),
        "view_items" => __("A", "hello-elementor"),
        "search_items" => __("A", "hello-elementor"),
        "not_found" => 'No se ha encontrado algún ponente existente',
        "not_found_in_trash" => __("A", "hello-elementor"),
        "parent" => __("A", "hello-elementor"),
        "featured_image" => 'Foto del Ponente',
        "set_featured_image" => 'Selecionar Foto para el Ponente',
        "remove_featured_image" => 'Quitar Foto del Ponente',
        "use_featured_image" => 'Usar esta Foto para el Ponente',
        "archives" => 'Nuestros Ponentes',
        "insert_into_item" => __("A", "hello-elementor"),
        "uploaded_to_this_item" => __("A", "hello-elementor"),
        "filter_items_list" => __("A", "hello-elementor"),
        "items_list_navigation" => __("A", "hello-elementor"),
        "items_list" => __("A", "hello-elementor"),
        "attributes" => 'Atributos del Ponente',
        "name_admin_bar" => 'Añadir nuevo Ponente',
        "item_published" => __("A", "hello-elementor"),
        "item_published_privately" => __("A", "hello-elementor"),
        "item_reverted_to_draft" => __("A", "hello-elementor"),
        "item_scheduled" => __("A", "hello-elementor"),
        "item_updated" => __("A", "hello-elementor"),
        "parent_item_colon" => __("A", "hello-elementor"),

    ];

    $args = [
        "label" => 'ponentes',
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
        "menu_position" => 2,
        "menu_icon" => "dashicons-admin-users",
        "supports" => ["title", "thumbnail"],
        "show_in_graphql" => false,
    ];

    register_post_type("ponentes", $args);
}

add_action('init', 'cpc_register_my_cpts_ponentes');




/************************************
 * 
 * PONENTES META BOXES AND CUSTOM FIELDS
 */

function cpc_ponentes_register_meta_boxes()
{
    add_meta_box('cpc_ponente_meta_box_basic_info', 'Información Básica del Ponente', 'cpc_ponentes_meta_box_callback', 'ponentes', 'normal', 'high');
}

add_action('add_meta_boxes', 'cpc_ponentes_register_meta_boxes');

function cpc_ponentes_meta_box_callback($post)
{
    wp_nonce_field('cpc_ponentes_save_meta_box_data_certificados', 'cpc_ponentes_meta_box_nonce_certificados');

    $value_certificados = get_post_meta($post->ID, '_cpc_ponentes_meta_box_certificados_key', true);
    $value_subtitle = get_post_meta($post->ID, '_cpc_ponentes_meta_box_subtitle_key', true);
    $value_desc = get_post_meta($post->ID, '_cpc_ponentes_meta_box_desc_key', true);
?>

    <label for="cpc_ponententes_field_certificados" class="form-label">Los Certificados del Ponente</label>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon3">Certificados</span>
        <input type="text" class="form-control" id="cpc_ponententes_field_certificados" aria-describedby="basic-addon3" name="cpc_ponententes_field_certificados" value="<?php echo esc_attr($value_certificados); ?>">
    </div>

    <label for="cpc_ponententes_field_subtitle" class="form-label">Frase o subtitulodel ponente</label>
    <div class="input-group mb-3">
        <span class="input-group-text" id="cpc_ponententes_field_subtitle_label">Subtiulo o Frase</span>
        <input type="text" class="form-control" id="cpc_ponententes_field_subtitle" aria-describedby="cpc_ponententes_field_subtitle_label" name="cpc_ponententes_field_subtitle" value="<?php echo esc_attr($value_subtitle); ?>">
    </div>

    <label for="cpc_ponententes_field_subtitle" class="form-label">Descripción del Ponente</label>
    <div class="form-floating">
        <textarea class="form-control" placeholder="Por favor escriba la descripción aquí." id="floatingTextarea2" style="height: 400px" rows="6" name="cpc_ponententes_field_desc"><?php echo esc_attr($value_desc); ?></textarea>
        <label for="floatingTextarea2">Comments</label>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<?php
}

/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function cpc_ponentes_save_meta_box_data_certificados($post_id)
{

    if (!isset($_POST['cpc_ponentes_meta_box_nonce_certificados'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['cpc_ponentes_meta_box_nonce_certificados'], 'cpc_ponentes_save_meta_box_data_certificados')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if ( !isset($_POST['cpc_ponententes_field_certificados']) && !isset($_POST['cpc_ponententes_field_desc'])) {
        return;
    }

    $data_certificados = sanitize_text_field($_POST['cpc_ponententes_field_certificados']);
    $data_subtitle = sanitize_text_field($_POST['cpc_ponententes_field_subtitle']);
    $data_desc = sanitize_textarea_field($_POST['cpc_ponententes_field_desc']);

    update_post_meta($post_id, '_cpc_ponentes_meta_box_certificados_key', $data_certificados);
    update_post_meta($post_id, '_cpc_ponentes_meta_box_subtitle_key', $data_subtitle);
    update_post_meta($post_id, '_cpc_ponentes_meta_box_desc_key', $data_desc);
}

add_action('save_post', 'cpc_ponentes_save_meta_box_data_certificados');



