<?php

$args = array(
    'title' => 'Capacitaciones',
    'subtitle' => 'Certificate Project Control',
);
get_template_part('template-parts/section', 'title', $args);

$args = array(
    'all' => true,
);
get_template_part('template-parts/section', 'capacitacion-list', $args);
