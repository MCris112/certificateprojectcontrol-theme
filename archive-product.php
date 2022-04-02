<?php

get_header();

$args = array(
    'all' => true,
);
get_template_part('template-parts/section', 'capacitacion-list', $args);

?>


<?php
get_footer();
?>