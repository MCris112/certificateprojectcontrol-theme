<?php
global $wp;

$cpc_menu_user = array(
    'login' => '#',
    'register' => '#',
    'my-account' => get_permalink(get_option('woocommerce_myaccount_page_id')),
    'logout' => wp_logout_url(home_url()),
    'orders' => wc_get_account_endpoint_url('orders'),
    'edit-acount' => wc_get_account_endpoint_url('edit-acount'),
    'addresses' => wc_get_account_endpoint_url('addresses'),
    'payment-methods' => wc_get_account_endpoint_url('payment-methods'),
    'lost-password' => wc_get_account_endpoint_url('lost-password'),
);

$opt_register = get_option('woocommerce_enable_myaccount_registration');

$can_register = false;

if ($opt_register == 'yes') {
    $can_register = true;
}


?>

<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>

    <!--=== META TAGS ===-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="description" content="Keywords">
    <meta name="author" content="darkredgm">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!--=== LINK TAGS ===-->
    <?php wp_site_icon(); ?>
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS2 Feed" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <?php

    $web_title = wp_title('', false);
    if (empty($web_title)) {
        $web_title = get_bloginfo('name');
    }

    if (is_front_page()) {
        $web_title = "Inicio";
    }

    $web_title .= ' - ' . get_bloginfo('name');

    echo '<title>' . $web_title . '</title>';

    ?>

    <!--=== WP_HEAD() ===-->
    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
    <input type="hidden" value="<?php echo site_url(); ?>" id="cpc_url_site_url">
    <div class="wrapper">
        <?php

        $hierarchy = [];

        $menu_name = 'cpc_primary';
        $locations = get_nav_menu_locations();

        if (isset($locations[$menu_name])) {
            $menu = wp_get_nav_menu_object($locations[$menu_name]);
            $menuitems = wp_get_nav_menu_items($menu->term_id, array('order' => 'DESC'));

            $hierarchy = cpc_combineHierarchy($menuitems, $menuitems);
        }
        ?>

        <header class="cpc_header">
            <?php

            $wp_scrollheader = new WP_Query([
                'post_type' => 'scroll-header',
                'post_per_page' => -1
            ]);

            if ($wp_scrollheader->have_posts()) {
            ?>
                <div class="coupons">
                    <div id="cpc_coupons_content" class="content">
                        <?php

                        while ($wp_scrollheader->have_posts()) {
                            $wp_scrollheader->the_post();
                        ?>
                            <div class="cpc_coupons_item">
                                <?php echo htmlspecialchars_decode(get_post_meta(get_the_ID(), '_cpc_scrollheader_key', true)); ?>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            <?php
            }
            ?>

            <div class="cpc_menu">
                <div class="container cpc_menu_content">
                    <a href="<?php echo site_url(); ?>" class="cpc_menu_logo">
                        <div class="bg"></div>
                        <img src="<?php echo cpc_theme_get_white_logo(); ?>" alt="">
                    </a>
                    <div id="cpc_menu_nav_content" class="cpc_menu_nav">
                        <div class="container cpc_menu_header">
                            <span>Certificate Project Control</span>
                            <button id="cpc_menu_shop_btn" class="btn" onclick="cpc_menu_toggle();" cpc-data-menu-state="close">
                                <i class="fa fa-close"></i>
                            </button>
                        </div>
                        <div class="container">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100 justify-content-around" style="gap: 1rem;">
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <?php
                                foreach ($hierarchy as $menuitem) {
                                    cpc_menu_show_items($menuitem);
                                }


                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="cpc_menu_actions">

                        <?php get_search_form(); ?>

                        <div class="cpc_btn_pc btn-shop">
                            <?php

                            $cart = WC()->cart;
                            $cart_url = wc_get_cart_url();  // Set Cart URL

                            $items = $cart->get_cart();
                            ?>
                            <button id="cpc_menu_shop_btn" class="btn" onclick="cpc_menu_shop_btn_items();" cpc-data-menu-state="close">
                                <i class="fa fa-shopping-cart"></i>
                                <span id="cpc_menu_shop_btn_badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    <span class="text"><?php echo count($items); ?></span>
                                    <span class="visually-hidden">Productos en el carrito</span>
                                </span>
                            </button>
                            <ul id="cpc_menu_shop_btn_items_content" class="btn-shop_content">
                                <div class="container cpc_menu_header">
                                    <span>Tu carrito</span>
                                    <button id="cpc_menu_shop_btn" class="btn" onclick="cpc_menu_shop_btn_items();" cpc-data-menu-state="close">
                                        <i class="fa fa-close"></i>
                                    </button>
                                </div>

                                <div class="container">
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>

                                    <div id="cpc_menu_shop_content_items">

                                        <?php
                                        if (count($items) == 0) {
                                            echo "<li class='cpc_menu_shop_empty text-center p-1 mb-5 mt-5'>No hay productos en el carrito</li>";
                                        }

                                        foreach ($items as $item => $values) {
                                            $_product =  wc_get_product($values['data']->get_id());
                                            $price = get_post_meta($values['product_id'], '_price', true);
                                            $getProductDetail = wc_get_product($values['product_id']);
                                            $cart_delete_url = wc_get_cart_remove_url($values['data']->get_id());

                                        ?>

                                            <li id="cpc_capacitacion_cart_item_<?php echo $values['data']->get_id(); ?>" class="cpc_menu_shop_content_item">
                                                <div class="img">
                                                    <?php echo $getProductDetail->get_image('woocommerce_thumbnail', array('class' => 'img-fluid rounded-start', 'style' => "width: 100%;")); ?>
                                                    <button onclick="cpc_remove_capacitacion_to_cart($(this), '<?php echo $cart_delete_url; ?>');" class="btn btn-danger btn-sm mt-2" cpc-data-cpt-id="<?php echo $values['data']->get_id(); ?>"><i class="fa fa-trash-o"></i></button>
                                                </div>
                                                <div class="body">
                                                    <h5 class="title"><?php echo $_product->get_title(); ?></h5>
                                                    <p class="quantity text-muted">Cantidad: <?php echo $values['quantity']; ?></p>
                                                    <p class="price text-end"><?php echo'US'.get_woocommerce_currency_symbol() . $price; ?></p>
                                                </div>
                                            </li>


                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <div class="p-3 cpc_menu_shop_content_subtotal">
                                        <div class="row mb-3">
                                            <div class="col-3">
                                                <span class="text-nowrap">Subtotal</span>
                                                <input type="hidden" id="cri_woo_currency_symbol" value="<?php echo'US'.get_woocommerce_currency_symbol(); ?>">
                                            </div>
                                            <div id="cpc_menu_shop_content_subtotal" class="col-9 subtotal text-end">
                                                <?php echo $cart->get_cart_subtotal(); ?>
                                            </div>
                                        </div>
                                        <li class="d-flex justify-content-end"><a class="btn btn-primary" href="<?php echo $cart_url; ?>">Ver el carrito</a></li>
                                    </div>
                                </div>
                            </ul>
                        </div>

                        <?php

                        $user_link = get_permalink(get_theme_mod('cpc_section_shop_cuenta_link_login', 0));

                        if (is_user_logged_in()) {
                            $user_link = $cpc_menu_user['my-account'];
                        }

                        ?>

                        <a href="<?php echo $user_link; ?>" class="cpc_btn_pc btn btn-user">
                            <i class="fa fa-user"></i>
                        </a>




                        <?php

                        if (!is_user_logged_in()) {
                        ?>
                            <a href="<?php echo get_permalink(get_theme_mod('cpc_section_shop_cuenta_link_register', 0)); ?>" class="cpc_btn_pc btn btn-primary btn-account">
                                Crear cuenta
                            </a>
                        <?php
                        }

                        ?>
                        <button class="btn btn-menu" type="button" onclick="cpc_menu_toggle();">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                </div>

            </div>
        </header>

        <?php wp_reset_query(); ?>