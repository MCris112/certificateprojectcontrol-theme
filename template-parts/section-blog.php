<section class="cpc_blog">
    <div class="container">
        <div class="cpc_title">
            <?php
            
            if(array_key_exists('title', $args)){
                echo $args['title'];
            }else{
                echo "Nuestras Publicaciones";
            }
            
            ?>
            <hr class="cpc_hr">
        </div>

        <div class="cpc_blog_c">
            <?php

            $args_query = array(
                'post_type' => 'post',
                'posts_per_page' => 4,
                'ignore_sticky_posts' => 1,
            );

            if (array_key_exists('add', $args)) {
                $addons = $args['add'];

                foreach ($addons as $add => $value) {
                    $args_query[$add] = $value;
                }
            }


            $post_query = new WP_Query($args_query);
            $count = $post_query->post_count;
            $post_postion = 0;

            if ($post_query->have_posts()) {
                while ($post_query->have_posts()) {
                    $post_query->the_post();
                    $post_postion = $post_postion + 1;

                    $permalink = get_permalink();
            ?>

                    <div class="cpc_blog_i <?php if ($post_postion == $count) {
                                                if ($count > 3) {
                                                    echo " cpc_hide_last_item";
                                                }
                                            } ?>">

                        <a href="<?php echo the_permalink(); ?>" class="cpc_blog_head">
                            <div class="img">


                                <?php

                                if (has_post_thumbnail()) {
                                    the_post_thumbnail('post-thumbnail', array('class' => 'bg'));
                                    the_post_thumbnail();
                                } else {
                                    echo '<img src="' . get_template_directory_uri() . '/assets/images/default.jpg" alt="" class="bg">';
                                    echo '<img src="' . get_template_directory_uri() . '/assets/images/default.jpg" alt="">';
                                }
                                ?>
                            </div>
                            <div class="time">
                                <span class="day"><?php echo the_time('d'); ?></span>
                                <span class="month"><?php echo the_time('M'); ?></span>
                            </div>
                        </a>

                        <div class="cpc_blog_body">
                            <div class="cpc_blog_info">
                                <div class="cpc_blog_info_i">
                                    <i class="fa fa-tag"></i>
                                    <span class="text"><?php echo the_category(', '); ?></span>
                                </div>

                                <?php

                                $ponentes = get_post_meta(get_the_ID(), '_cpc_capacitacion_field_ponentes', true);

                                if (!empty($ponentes)) {


                                    $ponentes = json_decode($ponentes, true);

                                    if (count($ponentes) > 0) {
                                ?>

                                        <div class="cpc_blog_info_i">
                                            <i class="fa fa-user"></i>

                                            <?php
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
                                                    <span class="text"><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></span>
                                            <?php
                                                }

                                                wp_reset_postdata();
                                            }


                                            ?>
                                        </div>
                                <?php
                                    }
                                }

                                ?>

                            </div>

                            <a href="<?php echo $permalink; ?>" class="btn btn-outline-primary d-block">Saber Más</a>
                        </div>
                    </div>
            <?php
                }
            } else {
                get_template_part('template-parts/block', 'empty-search', ['no_found_text' => 'No se han encontrado eventos relacionados']);
            }

            ?>
        </div>
    </div>
</section>