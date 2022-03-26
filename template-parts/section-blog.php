<section class="cpc_blog">
    <div class="container">
        <div class="cpc_title">
            Nuestras Publicaciones
            <hr class="cpc_hr">
        </div>

        <div class="cpc_blog_c">
            <?php

            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 3,
            );

            $post_query = new WP_Query($args);

            if ($post_query->have_posts()) {
                while ($post_query->have_posts()) {
                    $post_query->the_post();
            ?>
                    <?php

                    ?>

                    <div class="cpc_blog_i">

                        <a href="<?php echo the_permalink(); ?>" class="cpc_blog_head">
                            <div class="img">
                                <?php the_post_thumbnail('post-thumbnail', array('class' => 'bg')); ?>
                                <?php the_post_thumbnail(); ?>
                            </div>
                            <div class="time">
                                <span class="day"><?php echo the_time('d'); ?></span>
                                <span class="month"><?php echo the_time('M'); ?></span>
                            </div>
                        </a>

                        <div class="cpc_blog_body">
                            <div class="cpc_blog_info">
                                <div class="cpc_blog_info_i">
                                    <i class="fa fa-user"></i>
                                    <span class="text">Frich Torres</span>
                                </div>
                                <div class="cpc_blog_info_i">
                                    <i class="fa fa-tag"></i>
                                    <span class="text"><?php echo the_Category(', '); ?></span>
                                </div>
                            </div>

                            <a href="<?php echo the_permalink(); ?>" class="btn btn-outline-primary d-block">Saber Más</a>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo 'No hay entradas';
            }

            ?>
        </div>
    </div>
</section>