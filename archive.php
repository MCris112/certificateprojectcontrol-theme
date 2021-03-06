<?php

get_header();

$args = array(
    'title' => get_the_archive_title(),
    'subtitle' => 'Eventos basado en la fecha',
);
get_template_part('template-parts/section', 'title', $args);
?>

<?php get_template_part('template-parts/blog', 'categories'); ?>

<main class="container">

  <div class="row g-5">
  <?php 

  $args = array(
    'archive' => true,
);

  get_template_part('template-parts/blog', 'posts', $args); ?>

    <?php  get_template_part('template-parts/blog', 'side-bar'); ?>
  </div>

</main>


<?php
get_footer();
?>