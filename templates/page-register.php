<?php

/**
 * Template Name: Register Page
 *
 * @package WordPress
 * @subpackage CertificateProjectControl
 * @since CertificateProjectControl 1.0
 */

$can_register = 'yes' === get_option('woocommerce_enable_myaccount_registration');

if(!$can_register) {
    wp_redirect( get_permalink(get_theme_mod('cpc_section_shop_cuenta_link_login', 0)) );
    exit;
}

get_header();

$args = array(
    'title' => get_the_title(),
    'subtitle' => '¿Listos para comenzar?',
);
get_template_part('template-parts/section', 'title', $args);


?>

<div class="container my-5">
    <div class="mx-auto" style="width: 600px; max-width: 100%;">
        <?php
        
get_template_part('template-parts/modal/modal', 'register'); 

        ?>
    </div>
</div>

<?php



get_footer();
?>