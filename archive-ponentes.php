<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php

    wp_head();

    ?>

</head>

<body>
    <?php

    get_header();

    $args = array(
        'post_type' => 'ponentes',
    );

    $post_query = new WP_Query($args);

    if ($post_query->have_posts()) {

    ?>
        <section class="cpc_section">
            <div class="cpc_header">
                <div class="img">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg_hero_home.jpg" alt="">
                    <div class="cover"></div>
                </div>
                <div class="text">
                    <div class="container">
                        <h2 class="title">Nuestros Ponentes</h2>
                        <hr>
                    </div>
                </div>
            </div>

            <div class="cpc_content">
                <div class="container">
                    <div class="cpc_teachers_balls">
                        <?php
                        while ($post_query->have_posts()) {
                            $post_query->the_post();
                        ?>
                            <a href="<?php echo the_permalink(); ?>" class="cpc_teacher_ball">
                                <div class="img">
                                    <?php if (has_post_thumbnail()) {
                                        the_post_thumbnail();
                                    } else {
                                        echo '<img src="' . get_template_directory_uri() . '/images/ponentes/ponente-unknow-img.jpg" alt="Certificate Project Control No ahay ponetnes">';
                                    }
                                    ?>
                                </div>

                                <div class="cover">
                                    <span class="name"><?php echo the_title(); ?></span>
                                </div>
                            </a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    <?php

    }


    get_footer();
    ?>

</body>

</html>