<?php
get_header();

$wp_certificates = new WP_Query([
    'post_type' => 'certificates',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'rand',
]);

$certificates_url = [];


if ($wp_certificates->have_posts()) {
    while ($wp_certificates->have_posts()) {
        $wp_certificates->the_post();
        $certificates_url[] = get_the_post_thumbnail_url();
    }
}

$wp_homesliders = new WP_Query([
    'post_type' => 'home-sliders',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'rand',
]);

?>

<div class="swiper cpc_slider_front_page_hero">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <div class="bg">
                <picture>
                    <source media="(min-width: 800px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/sliders/home_slider_pc_bg.png">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/sliders/home_slider_phone_bg.png" alt="Chris standing up holding his daughter Elva">
                </picture>
            </div>
            <img src="<?php echo get_template_directory_uri() . '/assets/images/sliders/home_slider_ingeniero.png'; ?>" class="slider_person">

            <div class="slider_content">
                <picture>
                    <source media="(min-width: 800px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/sliders/home_slider_pc_txt.png">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/sliders/home_slider_phone_txt.png" class="slide_txt">
                </picture>
                <div class="certificates">
                    <?php foreach ($certificates_url as $certificate) {
                        echo '<img src="' . $certificate . '" alt="">';
                    } ?>
                </div>
            </div>
        </div>

        <?php

        if ($wp_homesliders->have_posts()) {
            while ($wp_homesliders->have_posts()) {
                $wp_homesliders->the_post();

                $content_phone = [];
                $content_pc = [];

                try{
                    $content_phone = json_decode(get_post_meta(get_the_ID(), '_cpc_homeslider_phone_key', true), true);
                    $content_pc = json_decode(get_post_meta(get_the_ID(), '_cpc_homeslider_pc_key', true), true);
                }catch(Exception $e){
                    continue;
                }

                if(!isset($content_pc['bg'])) continue;
        ?>
                <div class="swiper-slide">
                    <div class="bg">
                        <picture>
                            <source media="(min-width: 800px)" srcset="<?php echo $content_pc['bg'] ?? ""; ?>">
                            <img src="<?php echo $content_phone['bg'] ?? ""; ?>" alt="Chris standing up holding his daughter Elva">
                        </picture>
                    </div>
                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="slider_person">

                    <div class="slider_content">
                        <picture>
                            <source media="(min-width: 800px)" srcset="<?php echo $content_pc['txt'] ?? ""; ?>">
                            <img src="<?php echo $content_phone['txt'] ?? ""; ?>" class="slide_txt">
                        </picture>
                        <div class="certificates">
                            <?php foreach ($certificates_url as $certificate) {
                                echo '<img src="' . $certificate . '" alt="">';
                            } ?>
                        </div>
                    </div>
                </div>

        <?php
            }
        }

        ?>
    </div>
</div>



<section>
    <div class="container">
        <div class="cpc_welcome row gap-4 gap-lg-0">
            <div class="cpc_text col col-lg-5 mb-5 mb-lg-0">
                <span class="cpc_subtitle">Bienvenido a</span>
                <h1 class="cpc_title">Certificate Project Control</h1>
                <hr class="cpc_hr">
                <p class="desc">
                    Estamos firmemente convencidos que las buenas prácticas corporativas deben regular toda actividad en los negocios, y que actuar en todo momento y situación, con integridad, transparencia y una cultura ética, representan el impulso necesario para generar confianza y vínculos laborales estratégicos con nuestros clientes, colaboradores, y entorno en general donde realizamos nuestras operaciones.
                </p>

                <a href="<?php echo get_permalink(get_theme_mod('cpc_front_page_link_about_us')); ?>" class="btn btn-primary">Saber Más</a>
            </div>
            <div class="col col-lg-7 d-flex align-middle">
                <div class="cpc_presentation">
                    <div class="square_back"></div>
                    <iframe width="560" height="315" src="<?php echo cpc_get_video_link_about_us(); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
<?php

$terms = get_terms([
    'taxonomy' => 'modalidad',
    'hide_empty' => false,
    'order' => 'desc',
]);;

foreach ($terms as $term) {

    $args = array(
        'modalidad' => $term->slug,
        'post_per_page' => 4,
    );
    get_template_part('template-parts/section', 'capacitacion-list', $args);
}

get_template_part('template-parts/section', 'payment-methods');

?>


<?php get_template_part('template-parts/section', 'blog'); ?>

<?php

get_template_part('template-parts/section', 'ponentes');

get_footer();
?>