<?php

get_header();

?>

<section class="cpc_section cpc_start_content">
    <div class="cpc_header">
        <div class="img">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/backgrounds/bg_hero_home.jpg" alt="">
            <div class="cover"></div>
        </div>
        <div class="text">
            <div class="container">
                <h2 class="title"><?php the_title(); ?></h2>
                <hr>
            </div>
        </div>
    </div>

    <div class="cpc_content">
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
            ?>

        </art>
    </div>
</section>

<?php
get_footer();
?>