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
        ?>

    </article>
</div>

<?php
get_footer();
?>