<div class="cpc_mewsletter">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-7 mb-4 mb-lg-0">
                <div class="cpc_mewsletter_text">
                    <h3 class="cpc_title mb-4">Envianós tu email para acceder a nuestras promociones</h3>
                    <span class="info">Al enviar su correo está aceptando <a href="<?php echo get_permalink(get_theme_mod('cpc_cpt_newsletter_link_conditions_and_terms')); ?>">nuestros términos y cóndiciones</a></span>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="cpc_mewsletter_form">
                    <form id="cpc_email_form_newsletter" cpc-data-form-type="email">
                        <input type="hidden" name="cpc_type" value="newsletter">
                        <input type="hidden" name="cpc_message" value="acceder a nuestras promociones">
                        <div class="mb-3 w-100">
                            <label for="cpc_form_input_name" class="form-label">Nombres</label>
                            <input type="text" class="form-control" id="cpc_form_footer_input_name" placeholder="Ingrese su nombre" name="cpc_name">
                            <div class="invalid-feedback">
                                Por favor escriba su nombre.
                            </div>
                        </div>
                        <div class="mb-3 w-100">
                            <label for="cpc_form_input_email" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="cpc_form_footer_input_email" placeholder="Ingrese su correo ejemplo@correo.com" name="cpc_email">
                            <div class="invalid-feedback">
                                Por favor escriba su correo.
                            </div>
                        </div>
                        <button id="cpc_email_form_btn_newsletter" type="button" class="btn btn-lg btn-primary d-block w-100 mb-3" onclick="cpc_email_btn_send('cpc_email_form_newsletter', $(this));">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<section id="clientes" style="margin: 6rem 0;">
    <div class="container">

        <div class="cpc_title text-center mb-5">
            Nuestros clientes nos respaldan
            <hr class="cpc_hr mx-auto">
        </div>

        <div class="my-4" style="padding-bottom: 1rem;"></div>
        <!-- Slider main container -->
        <div class="swiper mySwiper mt-5">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <div class="swiper-slide"><img src="<?php echo get_template_directory_uri() . "/assets/images/clients/ohla-peru.jpg" ?>" class="w-100" alt="" style="object-fit: contain; height: 15vh;"></div>
                <div class="swiper-slide"><img src="<?php echo get_template_directory_uri() . "/assets/images/clients/monta-egil.jpg" ?>" class="w-100" alt="" style="object-fit: contain; height: 15vh;"></div>
                <div class="swiper-slide"><img src="<?php echo get_template_directory_uri() . "/assets/images/clients/sacyr.jpg" ?>" class="w-100" alt="" style="object-fit: contain; height: 15vh;"></div>
                <div class="swiper-slide"><img src="<?php echo get_template_directory_uri() . "/assets/images/clients/Inti-punku.jpg" ?>" class="w-100" alt="" style="object-fit: contain; height: 15vh;"></div>
                <div class="swiper-slide"><img src="<?php echo get_template_directory_uri() . "/assets/images/clients/anglo-american.jpg" ?>" class="w-100" alt="" style="object-fit: contain; height: 15vh;"></div>
                <div class="swiper-slide"><img src="<?php echo get_template_directory_uri() . "/assets/images/clients/cumbra.jpg" ?>" class="w-100" alt="" style="object-fit: contain; height: 15vh;"></div>
            </div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>

    </div>
</section>

<footer>
    <div class="container">
        <div class="cpc_footer_i img">
            <a href="<?php echo site_url(); ?>" class="col cpc_logo d-flex justify-content-start mb-3">
                <img src="<?php echo cpc_theme_get_white_logo(); ?>" alt="">
            </a>

            <p class="desc text-white">
                Consultoría especializada en:
                Bussiness intelligence (Power BI)
                Forensic Schedule Analylis
                Preparación certificaciones AACE
                Preparación certificaciones PMI
                Gestión de proyectos.</p>
        </div>

        <?php

        $menu_name = 'cpc_footer';
        $locations = get_nav_menu_locations();
        $menu = wp_get_nav_menu_object($locations[$menu_name]);
        $menuitems = wp_get_nav_menu_items($menu->term_id, array('order' => 'DESC'));

        $hierarchy = cpc_combineHierarchy($menuitems, $menuitems);

        foreach ($hierarchy as $menuitem) {
            if (isset($menuitem->cpc_sunmenu) && !empty(count($menuitem->cpc_sunmenu))) {
                $class_main = $menuitem->classes;
        ?>

                <div class="cpc_footer_i down">
                    <span class="text-muted mb-3 fw"> <?php echo $menuitem->title; ?></span>
                    <?php

                    foreach ($menuitem->cpc_sunmenu as $item) {
                        $classes = $item->classes;
                    ?>
                        <span>
                            <?php

                            if (count($classes) > 0) {
                                $classes = implode(" ", $classes);
                                echo '<i class="' . $classes . '"></i>';
                            }
                            ?>
                            <a class="ms-2" href="<?php echo $item->url; ?>"><?php echo $item->title; ?></a>
                        </span>
                    <?php
                    }

                    if (in_array('display_menu_social', $class_main)) {
                        cpc_menu_get_social_links(
                            array(
                                'div' => 'w-100 mt-4',
                                'ul' => 'header_icons justify-content-start w-100 align-items-start',
                                'a' => 'd-flex align-items-center gap-1 text-decoration-none rounded p-2 bg-secondary',
                            ),
                        );
                    }

                    ?>
                </div>

        <?php
            }
        }
        ?>
    </div>

    <div class="container copy">
        <span class="text-muted">&copy;2022 Certificate Project Control</s>
    </div>
</footer>

<?php cpc_menu_get_social_links(
    array(
        'div' => 'cpc_social_media',
        'ul' => 'header_icons justify-content-around w-100 text-white',
    )
); ?>

<?php

get_template_part('template-parts/modal', 'login-register');


wp_footer();

?>


<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        slidesPerGroup: 3,
        loop: true,
        autoplay: {
            delay: 5000,
        },
        loopFillGroupWithBlank: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
</script>

</body>

</html>