
    <?php

    get_header();

    ?>

    <section class="cpc_section cpc_start_content">
        <div class="cpc_header">
            <div class="img">
                <img src="<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg_hero_home.jpg" alt="">
                <div class="cover"></div>
            </div>
            <div class="text">
                <div class="container">
                    <h2 class="title">Nuestras Publicaciones</h2>
                    <hr>
                </div>
            </div>
        </div>

        <div class="cpc_content">
            <div class="container">
                <section class="cpc_blog m-0">
                    <div class="cpc_blog_c">
                        <?php

                        $args = array(
                            'post_type' => 'post',
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
                                            <img src="<?php echo the_post_thumbnail(); ?>" alt="">
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

                                        <a href="<?php echo the_permalink(); ?>" class="cpc_blog_title">
                                            <?php echo the_title(); ?>
                                        </a>

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
                </section>
            </div>
        </div>
    </section>


    <?php
    get_footer();
    ?>
