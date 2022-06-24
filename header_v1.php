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

    <?php

    $menu_name = 'cpc_primary';
    $locations = get_nav_menu_locations();
    $menu = wp_get_nav_menu_object($locations[$menu_name]);
    $menuitems = wp_get_nav_menu_items($menu->term_id, array('order' => 'DESC'));

    $hierarchy = cpc_combineHierarchy($menuitems, $menuitems);


    ?>

    <header class="cpc_header">
        <div class="container-fluid cpc_menu_container">
            <div class="cpc_head_logo row">
                <a href="<?php echo site_url(); ?>" class="col cpc_logo d-flex justify-content-start">
                    <img src="<?php echo cpc_theme_get_white_logo(); ?>" alt="">
                </a>

                <?php cpc_menu_get_social_links(
                    array(
                        'div' => 'col d-flex justify-content-end align-items-center',
                        'ul' => 'header_icons',
                    ),

                    array('order' => 'ASC'),

                    true
                ); ?>
            </div>

            <div class="cpc_trigger_menu"></div>

            <div class="cpc_navbar">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-3 cpc_logo_sticky">
                            <img src="<?php echo cpc_theme_get_white_logo(); ?>" alt="">
                        </div>

                        <div class="col cpc_navbar_col">
                            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                                <div class="container-fluid">

                                    <div class="row justify-content-start w-100">
                                        <div id="cpc_menu_phone_c" class="col-auto cpc_menu_phone_c">
                                            <div id="cpcp_menu_phone_bg" class="cpcp_menu_phone_bg" onClick="cpc_manu_open_close();"></div>
                                            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                                                <div class="cpc_menu_phone_content">
                                                    <div class="cpc_menu_phone_div cpc_menu_phone_logo">
                                                        <img src="<?php echo cpc_theme_get_white_logo(); ?>" alt="">
                                                        <div class="cpc_menu_phone_btn">
                                                            <button class="navbar-toggler" type="button" onClick="cpc_manu_open_close();">
                                                                <span class="fa fa-close"></span>
                                                                x </button>
                                                        </div>
                                                    </div>

                                                    <div class="cpc_menu_phone_menu">
                                                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100 justify-content-around" style="gap: 1rem;">
                                                            <?php
                                                            foreach ($hierarchy as $menuitem) {
                                                                cpc_menu_show_items($menuitem);
                                                            }


                                                            ?>
                                                        </ul>
                                                    </div>

                                                    <div class="cpc_menu_phone_div">
                                                        <?php cpc_menu_get_social_links(
                                                            array(
                                                                'div' => 'col d-flex justify-content-around align-items-center w-100',
                                                                'ul' => 'header_icons justify-content-around w-100',
                                                            )
                                                        ); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-9 col-md-auto">
                                        <ul class="navbar-nav flex-row me-auto mb-2 mb-lg-0 justify-content-around align-items-center justify-content-lg-end gap-5 gap-lg-1">
                                            <?php get_search_form(); ?>

                                            <li class="nav-item dropdown menu_card_item">
                                                <?php

                                                $cart = WC()->cart;
                                                $cart_url = wc_get_cart_url();  // Set Cart URL

                                                $items = $cart->get_cart();
                                                ?>
                                                <button id="cpc_menu_shop_btn" class="nav-link dropdown-toggle btn position-relative" onclick="cpc_menu_shop_open();" cpc-data-menu-state="close">
                                                    <i class="fa fa-shopping-cart"></i>
                                                    <span id="cpc_menu_shop_btn_badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                        <span class="text"><?php echo count($items); ?></span>
                                                        <span class="visually-hidden">Productos en el carrito</span>
                                                    </span>
                                                </button>
                                                <ul id="cpc_menu_shop_content" class="dropdown-menu">

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
                                                                <div class="d-flex">
                                                                    <div class="img">
                                                                        <?php echo $getProductDetail->get_image('woocommerce_thumbnail', array('class' => 'img-fluid rounded-start', 'style' => "width: 100%;")); ?>
                                                                        <button onclick="cpc_remove_capacitacion_to_cart($(this), '<?php echo $cart_delete_url; ?>');" class="btn btn-danger btn-sm mt-2" cpc-data-cpt-id="<?php echo $values['data']->get_id(); ?>"><i class="fa fa-trash-o"></i></button>
                                                                    </div>
                                                                    <div class="body">
                                                                        <h5 class="title"><?php echo $_product->get_title(); ?></h5>
                                                                        <p class="quantity text-muted">Cantidad: <?php echo $values['quantity']; ?></p>
                                                                        <p class="price text-end"><?php echo'US'.get_woocommerce_currency_symbol() . $price; ?></p>
                                                                    </div>
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
                                                </ul>
                                            </li>


                                            <div class="cpc_navbar_hide_on_sticky">
                                                <li class="nav-item d-flex align-items-center gap-2">
                                                    <?php

                                                    if (is_user_logged_in()) {
                                                    ?>
                                                        <a class="nav-link <?php cpc_compare_string_and_print($cpc_menu_user['my-account'], home_url($wp->request) . '/', 'active'); ?>" aria-current="page" href="<?php echo $cpc_menu_user['my-account']; ?>">Mi cuenta</a>
                                                        <span class="text-white"> / </span>
                                                        <a class="nav-link <?php cpc_compare_string_and_print($cpc_menu_user['logout'], home_url($wp->request) . '/', 'active'); ?>" aria-current="page" href="<?php echo $cpc_menu_user['logout']; ?>"><i class="fa fa-sign-out"></i> Cerrar Sesión</a>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <a class="nav-link" aria-current="page" href="<?php echo $cpc_menu_user['login']; ?>" data-bs-toggle="modal" data-bs-target="#cpc_modal_login">Entrar</a>
                                                        <?php

                                                        if ($can_register) {
                                                        ?>
                                                            <a class="nav-link bg-accent rounded" aria-current="page" href="<?php echo $cpc_menu_user['register']; ?>" data-bs-toggle="modal" data-bs-target="#cpc_modal_login" cpc-target="register">Crear cuenta</a>
                                                        <?php
                                                        }
                                                        ?>
                                                    <?php
                                                    }

                                                    ?>
                                                </li>
                                            </div>

                                            <li class="cpc_navbar_show_on_sticky nav-item dropdown">
                                                <a class="nav-link dropdown-toggle menu_user_item" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-user-circle-o"></i>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    <?php

                                                    if (is_user_logged_in()) {

                                                    ?>
                                                        <li><a class="dropdown-item <?php cpc_compare_string_and_print($cpc_menu_user['my-account'], home_url($wp->request) . '/', 'active'); ?>" href="<?php echo $cpc_menu_user['my-account']; ?>">Mi cuenta</a></li>
                                                        <li><a class="dropdown-item" href="<?php echo $cpc_menu_user['logout']; ?>">Cerrar Sesión</a></li>
                                                        <li><a class="dropdown-item" href="<?php echo $cpc_menu_user['orders']; ?>">Mis Cursos</a></li>
                                                        <?php
                                                        if (current_user_can('administrator')) {
                                                        ?>

                                                            <hr>
                                                            <li><a class="dropdown-item" href="<?php echo get_admin_url(); ?>">Admin panel</a></li>

                                                        <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <li><a class="dropdown-item" href="<?php echo $cpc_menu_user['login']; ?>" data-bs-toggle="modal" data-bs-target="#cpc_modal_login">Iniciar Sesión</a></li>
                                                        <?php


                                                        if ($can_register) {
                                                        ?>
                                                            <li><a class="dropdown-item" href="<?php echo $cpc_menu_user['register']; ?>" data-bs-toggle="modal" data-bs-target="#cpc_modal_login" cpc-target="register">Regístrate</a></li>
                                                        <?php
                                                        }
                                                        ?>
                                                    <?php
                                                    }

                                                    ?>

                                                </ul>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-3 pe-1 col-md-auto d-flex justify-content-end">
                                        <button class="navbar-toggler" type="button" onClick="cpc_manu_open_close();">
                                            <span class="navbar-toggler-icon"></span>
                                        </button>
                                    </div>
                                </div>
                        </div>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </header>