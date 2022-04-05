<?php

$taxonomy = get_queried_object();

$args = array(
    'title' => 'Capacitaciones',
    'subtitle' => 'Modalidad: '. $taxonomy->name,
);
get_template_part('template-parts/section', 'title', $args);

$args = array(
    'all' => true,
    'add' => array(
        'tax_query' => array(
            array(
                'taxonomy' => 'modalidad',
                'field' => 'slug',
                'terms' => $taxonomy->slug,
            ),
        ),
    ),
    'modalidad'=> $taxonomy->slug,
);

get_template_part('template-parts/section', 'capacitacion-list', $args);
