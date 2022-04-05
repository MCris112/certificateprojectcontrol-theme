
    <?php

get_header();

$args = array(
    'title' => get_the_title(),
    'subtitle' => 'Certificate Project Control',
);
get_template_part('template-parts/section', 'title', $args);

the_content();
?>


<?php
get_footer();
?>