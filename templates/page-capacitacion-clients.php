<?php

/**
 * Template Name: Capacitación Clientes
 *
 * @package WordPress
 * @subpackage CertificateProjectControl
 * @since CertificateProjectControl 1.0
 */

get_header();

$args = array(
    'title' => get_the_title(),
);
get_template_part('template-parts/section', 'title', $args);
?>



<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-center gap-3">
        <img src="<?php echo get_template_directory_uri() . "/assets/images/clients/cumbra.jpg" ?>" alt="" style="object-fit: contain;">
        <img src="<?php echo get_template_directory_uri() . "/assets/images/clients/ohla-peru.jpg" ?>" alt="" style="object-fit: contain;">
    </div>
</div>

<?php
get_footer();
?>