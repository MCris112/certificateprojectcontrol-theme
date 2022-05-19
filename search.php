<?php

get_header();

$args = array(
    'title' => "Busqueda: " . get_search_query(),
    'subtitle' => 'Estás buscando',
);
get_template_part('template-parts/section', 'title', $args);

?>
<div class="my-5"></div>

<main class="container">
    <div class="row">
        <?php
        $args = array(
            's'    => get_search_query(),
            'post_type' => ['post', 'product'],
            'posts_per_page' => -1,
        );

        get_template_part('template-parts/blog', 'posts', $args);
        ?>

        <?php get_template_part('template-parts/blog', 'side-bar'); ?>
    </div>


</main>

<div class="my-5"></div>

<?php
get_footer();
?>