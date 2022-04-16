<div class="col-md-8">

    <?php

    if (array_key_exists('archive', $args) && $args['archive']) {
        global $wp_query;
        if ($wp_query->have_posts()) {
            while ($wp_query->have_posts()) {
                $wp_query->the_post();
                get_template_part('template-parts/block', 'post-item');
            }
        }
    }else {
        $query = new WP_Query($args);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                get_template_part('template-parts/block', 'post-item');
            }
        }
    }




    ?>
</div>