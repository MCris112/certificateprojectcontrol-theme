<?php

/**
 * Template Name: Login Page
 *
 * @package WordPress
 * @subpackage CertificateProjectControl
 * @since CertificateProjectControl 1.0
 */

get_header();

$args = array(
    'title' => get_the_title(),
    'subtitle' => '¿Listos para comenzar?',
);
get_template_part('template-parts/section', 'title', $args);

$can_register = 'yes' === get_option('woocommerce_enable_myaccount_registration');

?>

<div class="container my-5">
    <div class="mx-auto" style="width: 600px; max-width: 100%;">
        <?php

        get_template_part('template-parts/modal/modal', 'login');

        if ($can_register) {
        ?>
            <a href="<?php echo get_permalink(get_theme_mod('cpc_section_shop_cuenta_link_register')); ?>" class="d-block w-100 link text-center">¿Eres nuevo? - Registrate aquí</a>
        <?php
        }
        ?>
    </div>
</div>

<?php

get_footer();
?>