<?php

get_header();

$args = array(
    'title' => get_the_title(),
);
get_template_part('template-parts/section', 'title', $args);

?>

<div class="container my-5">
    <article class="blog-post container mb-6">

        <?php

        the_content();

        /*
// If comments are open or we have at least one comment, load up the comment template.
if (comments_open() || get_comments_number()) :
    comments_template();
endif;
*/

        /*
// Previous/next post navigation.
the_post_navigation(array(
    'next_text' => '<span class="meta-nav" aria-hidden="true">' . __('Next', 'twentyfifteen') . '</span> ' .
        '<span class="screen-reader-text">' . __('Next post:', 'twentyfifteen') . '</span> ' .
        '<span class="post-title">%title</span>',
    'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __('Previous', 'twentyfifteen') . '</span> ' .
        '<span class="screen-reader-text">' . __('Previous post:', 'twentyfifteen') . '</span> ' .
        '<span class="post-title">%title</span>',
));


*/

$ponentes = get_post_meta(get_the_ID(), '_cpc_capacitacion_field_ponentes', true);
if (!empty($ponentes)) {

    ?>

        <div class="cpc_blog_info_i">
            <i class="fa fa-user"></i>

            <?php
            $ponentes = json_decode($ponentes, true);

            $ponentes_args_query = array(
                'post_type' => 'ponentes',
                'post__in' => $ponentes,
                'posts_per_page' => -1,
                'orderby' => 'post__in',
            );

            $ponentes_query = new WP_Query($ponentes_args_query);

            if ($ponentes_query->have_posts()) {
                while ($ponentes_query->have_posts()) {
                    $ponentes_query->the_post();
            ?>
                    <span class="text">Por: <a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></span>
            <?php
                }

                wp_reset_postdata();
            }
            ?>
        </div>
    <?php
    }

    ?>

    </article>
</div>

<?php
get_footer();
?>