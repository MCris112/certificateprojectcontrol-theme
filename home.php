<?php

get_header();

$args = array(
    'title' => 'Eventos',
);
get_template_part('template-parts/section', 'title', $args);
?>


<?php get_template_part('template-parts/blog', 'categories'); ?>

<main class="container">

    <?php

    $args = array(
        'category__and' => array('destacado', 'featured'),
        'posts_per_page' => 1,
        'type' => 'post',
    );

    $featured_post = new WP_Query($args);

    if ($featured_post->have_posts()) {
        while ($featured_post->have_posts()) {
            $featured_post->the_post();

    ?>
            <div class="p-4 p-md-5 mb-4 text-white rounded position-relative "> <?php

                                                                                if (has_post_thumbnail()) {

                                                                                ?>

                    <div class="cover position-absolute top-0 start-0 w-100 h-100" style="z-index: -1;">
                        <?php the_post_thumbnail('large', array(
                                                                                        'class' => 'w-100 h-100',
                                                                                        'style' => 'height: 100%; object-fit: cover;'
                                                                                    )); ?>
                        <div class="w-100 h-100 position-absolute bg-dark top-0 start-0" style="opacity: .9;"></div>
                    </div>

                <?php

                                                                                } else {
                                                                                    echo 'bg-dark';
                                                                                }

                ?>
                <div class="col-md-6 px-0">
                    <h1 class="display-4 fst-italic"><?php the_title(); ?></h1>
                    <?php
                    if (has_excerpt()) {
                    ?>
                        <p class="lead my-3"><?php echo get_the_excerpt(); ?></p>
                    <?php
                    }
                    ?>
                    <p class="lead mb-0"><a href="<?php the_permalink(); ?>" class="text-white fw-bold">Saber más...</a></p>
                </div>
            </div>
    <?PHP
        }
    }

    ?>

    <div class="row g-5">

        <?php
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 10,
        );

        get_template_part('template-parts/blog', 'posts', $args); ?>

        <?php get_template_part('template-parts/blog', 'side-bar'); ?>
    </div>

</main>


<?php
get_footer();
?>