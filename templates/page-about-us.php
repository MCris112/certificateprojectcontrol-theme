<?php

/**
 * Template Name: Sobre Nosotros
 *
 * @package WordPress
 * @subpackage CertificateProjectControl
 * @since CertificateProjectControl 1.0
 */

get_header();

$args = array(
    'title' => 'Sobre Nosotros',
    'subtitle' => 'Certificate Project Control',
);
get_template_part('template-parts/section', 'title', $args);
?>



<div class="container">
    <div class="cpc_features">
        <div class="cpc_features_item">
            <i class="fa fa-laptop"></i>
            <div class="text">
                <h3 class="title">Cursos en vivo</h3>
                <p class="sub">Disfruta de una variedad de temas nuevos.</p>
            </div>
        </div>

        <div class="cpc_features_item">
            <i class="fa fa-certificate"></i>
            <div class="text">
                <h3 class="title">Certificados</h3>
                <p class="sub">Disfruta de una variedad de temas nuevos.</p>
            </div>
        </div>

        <div class="cpc_features_item">
            <i class="fa fa-address-card"></i>
            <div class="text">
                <h3 class="title">Interactivo</h3>
                <p class="sub">Disfruta de una variedad de temas nuevos.</p>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>