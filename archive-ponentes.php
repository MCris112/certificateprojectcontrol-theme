<?php
get_header();


$args = array(
    'title' => 'Nuestros Ponentes',
    'subtitle' => 'Certificate Project Control',
);
get_template_part('template-parts/section', 'title', $args);

$args = array('archive' => true);

get_template_part('template-parts/section', 'ponentes', $args);

get_footer();
?>