<?php

global $wp;

$cpc_menu_user = array(
    'login' => site_url() . '/wp-login.php',
    'register' => site_url() . '/wp-login.php?action=register',
    'my-account' => get_permalink(get_option('woocommerce_myaccount_page_id')),
    'logout' => wp_logout_url(home_url()),
    'orders' => wc_get_account_endpoint_url('orders'),
    'edit-acount' => wc_get_account_endpoint_url('edit-acount'),
    'addresses' => wc_get_account_endpoint_url('addresses'),
    'payment-methods' => wc_get_account_endpoint_url('payment-methods'),
    'lost-password' => wc_get_account_endpoint_url('lost-password'),
);


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

    <?php
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


    $menu_name = 'cpc_primary';
    $locations = get_nav_menu_locations();
    $menu = wp_get_nav_menu_object($locations[$menu_name]);
    $menuitems = wp_get_nav_menu_items($menu->term_id, array('order' => 'DESC'));

    function combineHierarchy($groups, $categories)
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

    function cpc_compare_string_and_print($string, $compare, $print)
    {
        if ($string == $compare) {
            echo $print;
        }
    }

    $hierarchy = combineHierarchy($menuitems, $menuitems);

    function show_menu_items($menuitem, $level = 0)
    {
        if (empty($menuitem)) return;
        if (!isset($menuitem)) return;

        if (isset($menuitem->cpc_sunmenu) && !empty(count($menuitem->cpc_sunmenu))) {
    ?>
            <li class="<?php if ($level >= 1) {
                            echo 'dropdown-item';
                        } ?> nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo $menuitem->title; ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php
                    foreach ($menuitem->cpc_sunmenu as $item) {
                        show_menu_items($item, $level .= 1);
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
                        cpc_compare_string_and_print($menuitem->url, home_url($wp->request) . '/', 'active'); ?>" aria-current="page" href="<?php echo $menuitem->url; ?>"><?php echo $menuitem->title; ?></a>
        </li>

    <?php
    }
    ?>

    <header class="cpc_header <?php if (is_front_page()) {
                                    echo 'front_page';
                                } ?>">
        <div class="container-fluid cpc_menu_container">
            <div class="cpc_head_logo row">
                <div class="col cpc_logo d-flex justify-content-start">
                    <?php
                    $white = get_theme_mod('cpc_logo_white');
                    $blue = get_theme_mod('cpc_logo_blue');
                    $logo_url = (is_front_page() == true) ? $white : $blue;  ?>
                    <img src="<?php echo $logo_url ?>" alt="">
                </div>
                <div class="col d-flex justify-content-end align-items-center">
                    <ul class="header_icons">
                        <li><a href=""><i class="fa fa-facebook-square"></i></a></li>
                        <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                        <li><a href=""><i class="fa fa-youtube"></i></a></li>
                        <li><a href=""><i class="fa fa-whatsapp"></i></a></li>
                        <li><a href=""><i class="fa fa-envelope"></i></a></li>
                    </ul>
                </div>
            </div>

            <div class="cpc_trigger_menu"></div>

            <div class="cpc_navbar">
                <div class="container">
                    <div class="row">
                        <div class="col-3 cpc_logo_sticky">
                            <img src="<?php echo get_theme_mod('cpc_logo_white') ?>" alt="">
                        </div>

                        <div class="col cpc_navbar_col">
                            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                                <div class="container-fluid">

                                    <div class="row justify-content-around w-100">
                                        <div class="col-auto cpc_menu_phone_c">
                                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                                <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100 justify-content-around ">
                                                    <?php
                                                    foreach ($hierarchy as $menuitem) {
                                                        show_menu_items($menuitem);
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <ul class="navbar-nav flex-row me-auto mb-2 mb-lg-0 justify-content-around justify-content-lg-end gap-5 gap-lg-1">
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
                                                            <a class="nav-link" aria-current="page" href="<?php echo $cpc_menu_user['login']; ?>">Iniciar Sesión</a>
                                                            <span class="text-white"> / </span>
                                                            <a class="nav-link" aria-current="page" href="<?php echo $cpc_menu_user['register']; ?>">Regístrate</a>
                                                        <?php
                                                        }

                                                        ?>
                                                    </li>
                                                </div>
                                                <li class="cpc_navbar_show_on_sticky nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                                                        } else {
                                                        ?>
                                                            <li><a class="dropdown-item" href="<?php echo $cpc_menu_user['login']; ?>">Iniciar Sesión</a></li>
                                                            <li><a class="dropdown-item" href="<?php echo $cpc_menu_user['register']; ?>">Regístrate</a></li>
                                                        <?php
                                                        }

                                                        ?>

                                                    </ul>
                                                </li>

                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-shopping-cart"></i>
                                                    </a>
                                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                                        <li>
                                                            <hr class="dropdown-divider">
                                                        </li>
                                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="col-auto">
                                            <button class="navbar-toggler" type="button">
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