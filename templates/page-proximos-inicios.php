<?php

/**
 * Template Name: Próximos Inicios
 *
 * @package WordPress
 * @subpackage CertificateProjectControl
 * @since CertificateProjectControl 1.0
 */

get_header();

$args = array(
    'title' => 'Próximos Inicios',
    'subtitle' => '¿Listos para comenzar?',
);
get_template_part('template-parts/section', 'title', $args);


$args = array(
    'all' => true,
    'near' => true,
    'modalidad' => 'sincronico'
);
get_template_part('template-parts/section', 'capacitacion-list', $args);
?>


<?php

get_template_part('template-parts/section', 'ponentes');

get_footer();
?>