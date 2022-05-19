<?php

add_theme_support('post-thumbnails');
add_theme_support('custom-logo', array('header-text' => array('site-title', 'site-description')));
add_theme_support('woocommerce');

function pcertificate_register_styles()
{
	wp_enqueue_style('pcertificate-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css', array(), '1.4.0', 'all');
	wp_enqueue_style('pcertificate-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), '1.4.0', 'all');
	wp_enqueue_script('pcertificate-gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.8.0/gsap.min.js', array(), '1.4.0');
	wp_enqueue_script('bootstrap_popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js', array(), '1.4.0', true);
	wp_enqueue_script('bootstrap_jsr', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js', array(), '1.4.0', true);
	wp_enqueue_script('pcertificate-gsap_scroll_tigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.8.0/ScrollTrigger.min.js', array(), '1.4.0', true);
	wp_enqueue_script('pcertificate-jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), '1.4.0', true);



	wp_enqueue_style('pcertificate-style', get_template_directory_uri() . '/style.css', array(), '1.4.0', 'all');
	wp_enqueue_script('pcertificate-js', get_template_directory_uri() . '/assets/js/main.js', array(), '1.4.0', true);

	wp_enqueue_style('pcertificate-swiper-css', 'https://unpkg.com/swiper@8/swiper-bundle.min.css', array(), '1.4.0', 'all');
	wp_enqueue_script('pcertificate-swiper-js', 'https://unpkg.com/swiper@8/swiper-bundle.min.js', array(), '1.4.0', true);


	if (is_front_page()) {
		wp_enqueue_style('pcertificate-front-page-css', get_template_directory_uri() . '/assets/css/front-page.css', array(), '1.4.0', 'all');
		wp_enqueue_script('pcertificate-front-page-js', get_template_directory_uri() . '/assets/js/front-page.js', array(), '1.4.0', true);
	}

	if (is_product()) {
		wp_enqueue_style('pcertificate-product-css', get_template_directory_uri() . '/assets/css/product.css', array('pcertificate-style'), '1.4.0', 'all');
	}

	if ('ponentes' == get_post_type()) {
		wp_enqueue_style('pcertificate-ponentes-css', get_template_directory_uri() . '/assets/css/ponentes.css', array(), '1.4.0', 'all');
	}

	if (is_checkout() || is_cart() || is_account_page()) {
		wp_enqueue_style('pcertificate-checkout-css', get_template_directory_uri() . '/assets/css/shop.css', array('pcertificate-style'), '1.4.0', 'all');
		wp_enqueue_script('pcertificate-shop-js', get_template_directory_uri() . '/assets/js/shop.js', array(), '1.4.0', true);
	}

	//function to cart need to be initialized
	wp_enqueue_script('pcertificate-product-js', get_template_directory_uri() . '/assets/js/product.js', array(), '1.4.0', true);


	if (is_page_template('templates/page-about-us.php')) {
		wp_enqueue_style('pcertificate-about-css', get_template_directory_uri() . '/assets/css/about-us.css', array(), '1.4.0', 'all');
	}
}

add_action('wp_enqueue_scripts', 'pcertificate_register_styles');

function cpc_theme_menus()
{

	$locations = array(
		'cpc_primary'  => "Menu Principal",
		'cpc_social_media_header' => "Redes Sociales Header",
		'cpc_social_media' => "Redes Sociales",
		'cpc_footer' => "Footer"
	);

	register_nav_menus($locations);
}

add_action('init', 'cpc_theme_menus');

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

function cpc_get_meta_field($meta_key, $single = true)
{
	return get_post_meta(get_queried_object_id(), $meta_key, $single);
}


function cpc_capacitaciones_change_post_object_label()
{
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

add_action('init', 'cpc_capacitaciones_change_post_object_label');



function cpc_menu_get_social_links($classes = array(), $args = array('order' => 'ASC'), $is_header = false)
{

	$menu_name = 'cpc_social_media';

	if($is_header){
		$menu_name = 'cpc_social_media_header';
	}
	$locations = get_nav_menu_locations();
	$menu = wp_get_nav_menu_object(array_key_exists($menu_name, $locations) ? $locations[$menu_name] : false);

	if (empty($menu)) {
		echo array_key_exists('div', $classes) ? '<div class="' . $classes['div'] . '">' : '';
		return;
	};

	$menuitems = wp_get_nav_menu_items($menu->term_id, array('order' => array_key_exists('order', $args) ? $args['order'] : 'ASC'));

?>
	<div <?php echo array_key_exists('div', $classes) ? 'class="' . $classes['div'] . '"' : ''; ?>>
		<ul <?php echo array_key_exists('ul', $classes) ? 'class="' . $classes['ul'] . '"' : ''; ?>>
			<?php foreach ($menuitems as $item) : ?>
				<li <?php echo array_key_exists('li', $classes) ? 'class="' . $classes['li'] . '"' : ''; ?>>
					<a <?php echo array_key_exists('a', $classes) ? 'class="' . $classes['a'] . '"' : ''; ?> href="<?php echo $item->url; ?>" target="_blank">
						<i class="<?php echo implode(' ', $item->classes); ?>"></i>

						<?php

						if (array_key_exists('label', $args) && $args['label']) {
							echo $item->title;
						}
						?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<?php
}


/**************************
 * 
 * WHEN LOGIN/REGISTER ON WOOCOMMERCE
 */

function cpc_woo_wp_login_php()
{
	if (is_user_logged_in()) {
		wp_redirect(home_url());
		return;
	}
}

add_action('login_init', 'cpc_woo_wp_login_php');

function cpc_var_get_latam_countries()
{
	return array(
		'AR' => 'Argentina',
		'BO' => 'Bolivia',
		'BR' => 'Brasil',
		'CL' => 'Chile',
		'CO' => 'Colombia',
		'CR' => 'Costa Rica',
		'CU' => 'Cuba',
		'EC' => 'Ecuador',
		'SV' => 'El Salvador',
		'GW' => 'Guayana Francesa',
		'GD' => 'Grenada',
		'GT' => 'Guatemala',
		'GY' => 'Guyana',
		'HT' => 'Haiti',
		'HN' => 'Honduras',
		'MX' => 'México',
		'NI' => 'Nicaragua',
		'PA' => 'Panamá',
		'PY' => 'Paraguay',
		'PE' => 'Perú',
		'PR' => 'Puerto Rico',
		'DO' => 'República Dominicana',
		'UY' => 'Uruguay',
		'VE' => 'Venezuela',
	);
}

function cpc_cpt_html_select($data, $args)
{
	$name = isset($data['name']) ? 'name="' . $data['name'] . '"' : '';
	$id = isset($data['id']) ? 'id="' . $data['id'] . '"' : '';
	$class = isset($data['class']) ? 'class="' . $data['class'] . '"' : '';
	$select = isset($data['select']) ? $data['select'] : '';

	$selected_default = empty($value) ? 'selected' : '';

	echo '<select ' . $name . ' ' . $id . ' ' . $class . '>';
	echo '<option value="" ' . $selected_default . '>Seleccione una opción</option>';
	foreach ($args as $key => $value) {
		$selected = "";

		if ($value == $select) {
			$selected = "selected";
		}

		echo '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
	}
	echo '</select>';
}

/********************
 * FUNCTIONS TO USE ON HEADER
 */

/*
foreach ($items as $item) {
	var_dump($item);
	$class_menu = $item->classes;
	$item_classes = "";

	for ($i = 0; $i < count($class_menu); $i++) {
		$item_classes = $class_menu[$i];
	}
	echo '<li class="nav-item">
			<a class="nav-link ' . $item_classes . '" aria-current="page" href="' . $item->url . '">' . $item->title . '</a>
		</li>';
}
*/

function cpc_theme_get_white_logo()
{
	$logo_white = get_theme_mod('cpc_logo_white');

	if (empty($logo_white)) {
		$logo_white = get_template_directory_uri() . '/assets/images/temp_logo.png';
	}
	return $logo_white;
}

function cpc_get_site_icon_url(){
	$site_icon_url = get_site_icon_url();

	if (empty($site_icon_url)) {
		$site_icon_url = get_template_directory_uri() . '/assets/images/temp_logo.png';
	}

	return $site_icon_url;
}

function cpc_compare_string_and_print($string, $compare, $print)
{
	if ($string == $compare) {
		echo $print;
	}
}


function cpc_menu_show_items($menuitem, $level = 0)
{
	if (empty($menuitem)) return;
	if (!isset($menuitem)) return;

	if (isset($menuitem->cpc_sunmenu) && !empty(count($menuitem->cpc_sunmenu))) {
		$classes = $menuitem->classes;
	?>
		<li class="<?php if ($level >= 1) {
						echo 'dropdown-item';
					} ?> nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
				<?php
				if(count($classes) > 1 && $classes[0] == 'cri_icon'){
					echo '<i class="' . implode(' ', $classes) . '"></i>';
				}else{
					echo $menuitem->title; 
				}
				 ?>
			</a>
			<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
				<?php
				foreach ($menuitem->cpc_sunmenu as $item) {
					cpc_menu_show_items($item, $level .= 1);
				}

				?>
			</ul>
		</li>
	<?php

		return;
	}

	?>
	<li class="nav-item">
		<a class="<?php if ($level >= 1) {
						echo 'dropdown-item ';
					} else {
						echo 'nav-link ';
					}
					global $wp;
					cpc_compare_string_and_print($menuitem->url, home_url($wp->request) . '/', 'active'); ?>" aria-current="page" href="<?php echo $menuitem->url; ?>"><?php echo $menuitem->title; ?>
		</a>
	</li>

<?php
}

function cpc_combineHierarchy($groups, $categories)
{

	if (empty($groups) || count($groups) == 0 || $groups == null) return array();

	$hierarchy = array();
	$menuitems = array();

	foreach ($groups as $group) {
		if ($group->menu_item_parent == 0) {
			$menuitems[] = $group;
		}
	}

	foreach ($menuitems as $menuitem) {
		$menuitem->cpc_sunmenu = array();

		foreach ($categories as $category) {
			if ($category->menu_item_parent == $menuitem->ID) {
				$menuitem->cpc_sunmenu[] = $category;
			}
		}

		$hierarchy[] = $menuitem;
	}

	return $hierarchy;
}

function cpc_get_video_link_about_us(){
	$video_link = get_theme_mod('cpc_video_link_about_us');

	if (empty($video_link)) {
		$video_link = 'https://www.youtube.com/embed/w9dI-WG3dFU';
	}

	return $video_link;
}


/************************************************************************************************
 * 
 * PRODUCTS
 */

function cpc_show_block_item_price($product)
{
	echo '<span class="price position-relative">';
    echo get_woocommerce_currency_symbol() . $product->get_price();

    if ($product->is_on_sale()) {
?>
        <span class="badge bg-danger cpc-text-small" style="transform: scale(.6);">
            ON SALE
            <span class="visually-hidden">Producto ON SALE</span>
        </span>
    <?php
    }

	echo '</span>';
}
require __DIR__ . '/functions/register.func.php';
