<?php

add_theme_support('post-thumbnails');
add_theme_support('custom-logo', array('header-text' => array('site-title', 'site-description')));


function pcertificate_register_styles()
{
	wp_enqueue_style('pcertificate-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css', array(), '1.0.0', 'all');
	wp_enqueue_style('pcertificate-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), '1.0.0', 'all');
	wp_enqueue_script('pcertificate-gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.8.0/gsap.min.js', array(), '1.0.0');
	wp_enqueue_script('bootstrap_popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js', array(), '1.0.0', true);
	wp_enqueue_script('bootstrap_jsr', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js', array(), '1.0.0', true);
	wp_enqueue_script('pcertificate-gsap_scroll_tigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.8.0/ScrollTrigger.min.js', array(), '1.0.0', true);
	wp_enqueue_script('pcertificate-jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), '1.0.0', true);

	wp_enqueue_style('pcertificate-swiper-css', 'https://unpkg.com/swiper@8/swiper-bundle.min.css', array(), '1.0.0', 'all');
	wp_enqueue_script('pcertificate-swiper-js', 'https://unpkg.com/swiper@8/swiper-bundle.min.js', array(), '1.0.0', true);

	wp_enqueue_style('pcertificate-style', get_template_directory_uri() . '/style.css', array(), '1.0.0', 'all');
	wp_enqueue_script('pcertificate-js', get_template_directory_uri() . '/js/main.js', array(), '1.0.0', true);

	if (is_front_page()) {
		wp_enqueue_style('pcertificate-front-page-css', get_template_directory_uri() . '/css/front-page.css', array(), '1.0.0', 'all');
		wp_enqueue_script('pcertificate-front-page-js', get_template_directory_uri() . '/js/front-page.js', array(), '1.0.0', true);
	}

	if(! is_admin() && is_product() ){
		wp_enqueue_style('pcertificate-product-css', get_template_directory_uri() . '/css/product.css', array(), '1.0.0', 'all');
	}
}

add_action('wp_enqueue_scripts', 'pcertificate_register_styles');

function twentytwenty_menus()
{

	$locations = array(
		'cpc_primary'  => "Menu Principal",
	);

	register_nav_menus($locations);
}

add_action('init', 'twentytwenty_menus');

function cpc_customize_logo_white($wp_customize)
{
	//All our sections, settings, and controls will be added here

	$wp_customize->add_setting('cpc_logo_white');

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'logo_white',
			array(
				'label'      => 'Logotipo White',
				'section'    => 'title_tagline',
				'settings'   => 'cpc_logo_white',
			)
		)
	);
}
add_action('customize_register', 'cpc_customize_logo_white');

function cpc_customize_logo_blue($wp_customize)
{
	//All our sections, settings, and controls will be added here

	$wp_customize->add_setting('cpc_logo_blue');

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'logo_blue',
			array(
				'label'      => 'Logotipo Blue',
				'section'    => 'title_tagline',
				'settings'   => 'cpc_logo_blue',
			)
		)
	);
}
add_action('customize_register', 'cpc_customize_logo_blue');



require __DIR__ . '/functions/ponentes.func.php';
require __DIR__ . '/functions/admin.func.php';
require __DIR__ . '/functions/front-page.func.php';

function cpc_get_meta_field($meta_key, $single = true)
{
	return get_post_meta(get_queried_object_id(), $meta_key, $single);
}


function cpc_capacitaciones_change_post_object_label() {
    global $wp_post_types;
    $labels = &$wp_post_types['product']->labels;
    $labels->name = 'Capacitación';
    $labels->singular_name = 'Capacitación';
	$labels->menu_name = 'Capacitaciones';
	$labels->all_items = 'Todas las capacitaciones';
    $labels->add_new = 'Añadir nueva Capacitación';
	$labels->add_new_item = 'Añadir nueva Capacitación';
	$labels->edit_item = 'Editar Capacitación';
	$labels->new_item = 'Nueva Capacitación';
	$labels->view_item = 'Ver Capacitación';
	$labels->view_items = 'Ver Capacitaciones';
	$labels->search_items = 'Buscar Capacitaciones';
	$labels->not_found = 'No se encontraron Capacitaciones';
	$labels->not_found_in_trash = 'No se encontraron Capacitaciones en la papelera';
	$labels->parent = 'Capacitación padre';
	$labels->feature_image = 'Imagen de la Capacitación';
	$labels->set_featured_image = 'Añadir imagen de la Capacitación';
	$labels->remove_featured_image = 'Eliminar imagen de la Capacitación';
	$labels->use_featured_image = 'Usar como imagen de la Capacitación';
	$labels->archives = 'Archivo de Capacitaciones';
	$labels->insert_into_item = 'Insertar en la Capacitación';
	$labels->uploaded_to_this_item = 'Subir a la Capacitación';
	$labels->filter_items_list = 'Filtrar lista de Capacitaciones';
	$labels->items_list_navigation = 'Navegación de lista de Capacitaciones';
	$labels->items_list = 'Lista de Capacitaciones';
	$labels->attributes = 'Atributos de Capacitación';
	$labels->name_admin_bar = 'Capacitación';
	$labels->item_publshed = 'Capacitación publicada';
	$labels->item_published_privately = 'Capacitación publicada de forma privada';
	$labels->item_reverted_to_draft = 'Capacitación revertida a borrador';
	$labels->item_scheduled = 'Capacitación programada';
	$labels->item_updated = 'Capacitación actualizada';
	$labels->parent_item_colon = 'Capacitación padre:';
	$labels->not_found = 'No se encontraron Capacitaciones';
}

add_action( 'init', 'cpc_capacitaciones_change_post_object_label' );

//require __DIR__ . '/widgets/register_widgets.php';
require __DIR__ . '/functions/capacitacion/cpt.func.php';