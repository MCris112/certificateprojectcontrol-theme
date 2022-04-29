<?php

get_header();

$args = array(
    'title' => "404",
    'subtitle' => "Lo sentimos, no encontramos lo que estás buscando.",
);
get_template_part('template-parts/section', 'title', $args);

the_content();

get_footer();
?>