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
        <div class="cpc_menu">

            <div class="cpc_menu_up">
                <div class="container cpc_menu_content">
                    <div class="space"></div>
                    <div class="row">
                        <div class="col cpc_up_content_1 ps-1">
                            <a href="" class="">Whatsapp y atención al cliente 9</a>
                        </div>
                        <?php cpc_menu_get_social_links(
                            array(
                                'div' => 'col d-flex justify-content-end align-items-center',
                                'ul' => 'header_icons',
                            ),

                            array('order' => 'ASC'),

                            true
                        ); ?>
                    </div>
                </div>
            </div>
            <div class="container cpc_menu_content">


                <div class="cpc_menu_nav">
                    <div class="cpc_menu_logo">
                        <a href="<?php echo site_url(); ?>" class="col cpc_logo d-flex justify-content-start">
                            <img src="<?php echo cpc_theme_get_white_logo(); ?>" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>