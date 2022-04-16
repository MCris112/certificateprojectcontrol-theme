<div class="container">
    <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-around">
            <a class="p-2 link-secondary" href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">Todos</a>
            <?php

            $args = array(
                'type' => 'post',
            );

            $categories = get_categories($args);

            foreach ($categories as $category) {
            ?>
                <a class="p-2 link-secondary" href="<?php echo get_category_link($category->term_id); ?>"><?php echo $category->name; ?></a>
            <?php
            }

            ?>
        </nav>
    </div>
</div>