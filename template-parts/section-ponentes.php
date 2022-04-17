<?php

$is_archive = false;

if (array_key_exists('archive', $args)) {
    $is_archive = $args['archive'];
}

$args_query = array(
    'post_type' => 'ponentes',
    'posts_per_page' => 2,
    'orderby'        => 'rand',
);

if ($is_archive) {
    $args_query['posts_per_page'] = -1;
    $args_query['orderby'] = 'id';
}

$post_query = new WP_Query($args_query);

if ($post_query->have_posts()) {

?>
    <section class="cpc_section_ponentes">
        <div class="container">
            <?php

            if (!$is_archive) {
            ?>

                <div class="cpc_title">
                    Nuestros Ponentes
                    <hr class="cpc_hr">
                </div>

            <?php
            }

            ?>

            <div class="cpc_ponente_container mb-3">
                <?php
                while ($post_query->have_posts()) {
                    $post_query->the_post();
                ?>
                    <div class="cpc_ponente_item">
                        <a href="<?php echo the_permalink(); ?>" class="cpc_ponente_ball">
                            <div class="img">
                                <?php if (has_post_thumbnail()) {
                                    echo '<img src="' . get_the_post_thumbnail_url() . '" alt="">';
                                } else {
                                    echo '<img src="' . get_template_directory_uri() . '/assets/images/ponentes/ponente-unknow-img.jpg" alt="Certificate Project Control No ahay ponetnes">';
                                }
                                ?>
                            </div>
                        </a>

                        <div class="cpc_txt">
                            <p class="name"><?php echo the_title(); ?></p>
                            <p class="certificados"><?php echo get_post_meta(get_the_ID(), '_cpc_ponentes_meta_box_certificados_key', true) ?></p>
                            <a href="<?php echo the_permalink(); ?>" class="link">Saber más acerca del Ponente</a>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

            <?php

            if (!$is_archive) {
            ?>
                <a href="<?php echo get_post_type_archive_link('ponentes'); ?>" class="btn cpc_btn d-block mt-3 link-primary mt-6">Ver Todos Los Ponentes</a>

            <?php
            }

            ?>

        </div>
    </section>
<?php

}
