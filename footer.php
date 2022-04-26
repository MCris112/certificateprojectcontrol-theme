<div class="cpc_mewsletter">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-7 mb-4 mb-lg-0">
                <div class="cpc_mewsletter_text">
                    <h3 class="cpc_title">Envianós tu email para acceder a nuestras promociones</h3>
                    <p class="sub">Recibe nuestras promociones y noticias</p>
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
                            <input type="text" class="form-control" id="cpc_form_input_name" placeholder="Ingrese su nombre" name="cpc_name">
                            <div class="invalid-feedback">
                                Por favor escriba su nombre.
                            </div>
                        </div>
                        <div class="mb-3 w-100">
                            <label for="cpc_form_input_email" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="cpc_form_input_email" placeholder="Ingrese su correo ejemplo@correo.com" name="cpc_email">
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


<footer>
    <div class="container">
        <div class="cpc_footer_i img">
            <img src="<?php echo cpc_get_site_icon_url() ?>" alt="">
        </div>

        <?php

        $menu_name = 'cpc_footer';
        $locations = get_nav_menu_locations();
        $menu = wp_get_nav_menu_object($locations[$menu_name]);
        $menuitems = wp_get_nav_menu_items($menu->term_id, array('order' => 'DESC'));

        $hierarchy = cpc_combineHierarchy($menuitems, $menuitems);

        foreach ($hierarchy as $menuitem) {
            if (isset($menuitem->cpc_sunmenu) && !empty(count($menuitem->cpc_sunmenu))) {
                ?>

                <div class="cpc_footer_i">
                    <?php
                    
                    foreach ($menuitem->cpc_sunmenu as $item) {
                        ?>
                        <a href="<?php echo $item->url; ?>"><?php echo $item->title; ?> <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                        <?php
                    }
                    
                    ?>
                </div>
    
            <?php
            }
        }
        ?>
    </div>
</footer>


<?php

get_template_part('template-parts/modal', 'login-register');


wp_footer();

?>

<script>

</script>


</body>

</html>