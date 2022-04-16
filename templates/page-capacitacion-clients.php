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
    <div class="row gap-3">
        <div class="col row">
            <div class="col-12">
                <img src="<?php echo get_template_directory_uri() . "/assets/images/clients/cumbra.jpg" ?>" class="w-100" alt="" style="object-fit: contain;">
            </div>
            <div class="col-12">
                <img src="<?php echo get_template_directory_uri() . "/assets/images/clients/ohla-peru.jpg" ?>" class="w-100" alt="" style="object-fit: contain;">
            </div>
        </div>
        <div class="col">
            <img src="<?php echo get_template_directory_uri() . "/assets/images/clients/monta-egil.jpg" ?>" class="w-100" alt="" style="object-fit: contain;">
        </div>

        <div class="col row">
            <div class="col-12">
                <img src="<?php echo get_template_directory_uri() . "/assets/images/clients/sacyr.jpg" ?>" class="w-100" alt="" style="object-fit: contain;">
            </div>
            <div class="col-12">
                <img src="<?php echo get_template_directory_uri() . "/assets/images/clients/Inti-punku.jpg" ?>" class="w-100" alt="" style="object-fit: contain;">
            </div>
        </div>
        <div class="col-12">
            <img src="<?php echo get_template_directory_uri() . "/assets/images/clients/anglo-american.jpg" ?>" class="w-100" alt="" style="object-fit: contain;">
        </div>
    </div>
</div>

<?php
get_footer();
?>