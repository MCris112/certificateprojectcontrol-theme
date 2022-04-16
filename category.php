<?php

get_header();

$args = array(
    'title' => get_queried_object()->name,
    'subtitle' => 'Eventos basado en la categoria',
);
get_template_part('template-parts/section', 'title', $args);
?>

<?php get_template_part('template-parts/blog', 'categories'); ?>

<main class="container">

  <div class="row g-5">
  <?php 
  $args = array(
    'post_type' => 'post',
    'posts_per_page' => -1,
    'category__in' => get_queried_object()->term_id,
);

  get_template_part('template-parts/blog', 'posts', $args); ?>

    <?php  get_template_part('template-parts/blog', 'side-bar'); ?>
  </div>

</main>


<?php
get_footer();
?>