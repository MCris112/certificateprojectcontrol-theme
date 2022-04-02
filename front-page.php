<?php
get_header();

?>

<div class="swiper cpc_slider_front_page_hero swiper-fade swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden">
    <div class="swiper-wrapper" id="swiper-wrapper-7c7323f1067206ecc" aria-live="polite" style="transition-duration: 0ms;">
        <div class="swiper-slide swiper-slide-prev" style="width: 1920px; opacity: 1; transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;" role="group" aria-label="1 / 4">
            <div class="cpc_slider_item cpc_hero">
                <div class="img">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg_hero_home.jpg" alt="">
                    <div class="cover"></div>
                </div>

                <div class="text">
                    <div class="container content">
                        <h1 class="cpc_title cpc_hero_title">PROPONEMOS SOLUCIONES GENERANDO VALOR</h1>
                        <span class="cpc_subtitle cpc_hero_subtitle">¿Listos para comenzar?</span>

                        <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="cpc_btn icon_side side_down cpc_hero_btn">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="none" viewBox="0 0 27 27">
                                    <path fill="#fff" d="M21.129 18.953a37.98 37.98 0 01-1.484-1.501c-.403-.41-.646-.709-.646-.709l-3.038-1.45a7.554 7.554 0 001.888-4.995c0-4.187-3.407-7.595-7.595-7.595s-7.595 3.408-7.595 7.595c0 4.187 3.407 7.595 7.595 7.595a7.559 7.559 0 004.994-1.887l1.45 3.038s.299.243.71.647c.419.394.971.927 1.5 1.483l1.474 1.51.655.701 2.302-2.3-.701-.656c-.411-.404-.96-.94-1.51-1.476zm-10.875-3.23a5.431 5.431 0 01-5.425-5.425 5.431 5.431 0 015.425-5.425 5.431 5.431 0 015.425 5.425 5.431 5.431 0 01-5.425 5.425z" />
                                </svg>

                            </div>

                            <div class="btn_text">Vea nuestros cursos</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-slide swiper-slide-visible swiper-slide-active" style="width: 1920px; opacity: 1; transform: translate3d(-1920px, 0px, 0px); transition-duration: 0ms;" role="group" aria-label="2 / 4">
            <div class="cpc_slider_item cpc_hero">
                <div class="img">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg_hero_home_2.jpg" alt="">
                    <div class="cover"></div>
                </div>

                <div class="text">
                    <div class="container content">
                        <h1 class="cpc_title cpc_hero_title">Nuestros Proximos Inicios</h1>
                        <span class="cpc_subtitle cpc_hero_subtitle">¿Listos para comenzar?</span>

                        <a href="" class="cpc_btn icon_side cpc_hero_btn">
                            <div class="icon">
                                <i class="fa fa-book"></i>
                            </div>

                            <div class="btn_text">Ver Ahora</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-7c7323f1067206ecc" aria-disabled="false"></div>
    <div class="swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-7c7323f1067206ecc" aria-disabled="false"></div>
    <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal"><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 1"></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button" aria-label="Go to slide 2" aria-current="true"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 3"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 4"></span></div>
    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
</div>

<section>
    <div class="container">
        <div class="cpc_welcome row">
            <div class="cpc_text col">
                <span class="cpc_subtitle">Bienvenido a</span>
                <h1 class="cpc_title">Certificate Project Control</h1>
                <hr>
                <p class="desc">
                    Estamos firmemente convencidos que las buenas prácticas corporativas deben regular toda actividad en los negocios, y que actuar en todo momento y situación con integridad, transparencia y una cultura ética, representan el impulso necesario para generar confianza y vínculos laborales estratégicos con nuestros clientes, colaboradores, y entornoen general donde realizamos nuestras operaciones.
                </p>

                <a href="" class="btn btn-primary btn-lg">Saber Más</a>
            </div>
            <div class="col-5 d-flex align-middle">
                <div class="cpc_presentation">
                    <div class="square_back"></div>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/9Vpe-dqscyM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<?php

$args = array(
    'is_sincronico' => true,
);
get_template_part('template-parts/section', 'capacitacion-list', $args);


$args = array(
    'is_sincronico' => false,
);
get_template_part('template-parts/section', 'capacitacion-list', $args); ?>


?>


<?php get_template_part('template-parts/section', 'blog'); ?>

<?php
get_footer();
?>