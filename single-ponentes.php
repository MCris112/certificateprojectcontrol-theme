<?php
get_header();

$var = the_post();
?>

<section class="cpc_section cpc_start_content ponentes_view">
    <div class="cpc_header">
        <div class="img">
            <img src="<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg_hero_home.jpg" alt="">
            <div class="cover"></div>
        </div>
        <div class="text ">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="cpc_img">
                            <div class="square_back"></div>
                            <?php if (has_post_thumbnail()) {
                                the_post_thumbnail();
                            } else {
                                echo '<img src="' . get_template_directory_uri() . '/images/ponentes/ponente-unknow-img.jpg" alt="Certificate Project Control No ahay ponetnes">';
                            }
                            ?>
                        </div>

                    </div>
                    <div class="col">
                        <h2 class="title"><?php the_title(); ?></h2>
                        <hr>

                        <p><?php echo cpc_get_meta_field('_cpc_ponentes_meta_box_certificados_key'); ?></p>
                        <p><?php echo cpc_get_meta_field('_cpc_ponentes_meta_box_subtitle_key'); ?></p>
                        <p><?php echo cpc_get_meta_field('_cpc_ponentes_meta_box_desc_key'); ?></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<?php

get_footer();
?>