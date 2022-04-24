<?php
get_header();

$product = wc_get_product(get_the_id());
$modalidad = cpc_get_meta_field('_cpc_capacitacion_field_modalidad');
$fechas = get_post_meta(get_the_ID(), '_cpc_capacitacion_field_modalidad_fechas', true);
if (!empty($fechas)) $fechas = json_decode($fechas, true);

function cpc_capacitacion_cpt_box_desc($title, $content, $content_extra = "")
{
?>

    <div class="cpc_box_desc">
        <div class="cpc_head">
            <h2><?php echo $title; ?></h2>
            <hr>
        </div>
        <div class="cpc_body">
            <p class="desc"><?php echo $content; ?></p>
            <?php echo $content_extra; ?>
        </div>
    </div>

<?php
}

?>

<section class="cpc_product_section cpc_near_menu_top">
    <div class="cpc_bg_section">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/backgrounds/bg_product.jpg" alt="">
        <div class="cover"></div>
    </div>
    <div class="container-fluid container-lg pt-5">
        <div class="row">
            <div class="col-12 col-lg-8 text-center text-lg-start">
                <h1 class="cpc_title"><?php the_title(); ?></h1>
                <p class="cpc_subtitle"><?php echo cpc_get_meta_field('_cpc_capacitacion_field_sub_title'); ?></p>
                <hr class="cpc_hr mx-auto mx-lg-0">
                <p class="short_desc mx-auto mx-lg-0"><?php echo $product->get_short_description(); ?></p>
                <div class="d-lg-none w-100 cpc_product_price_c align-items-center">
                    <p class="cpc_product_price">$<?php echo $product->get_price(); ?></p>
                    <div class="d-flex gap-4 cpc_product_price_btn">
                        <div class="btn btn-outline-primary">Contáctanos</div>
                        <button onclick="cpc_add_capacitacion_to_cart($(this), '<?php echo esc_url($product->add_to_cart_url()); ?>')" rel="nofollow" data-product_id="<?php echo esc_attr($product->get_id()); ?>" data-product_sku="<?php echo esc_attr($product->get_sku()); ?>" class="btn btn-primary">Comprar Ahora</button>
                    </div>
                </div>
                <div class="cpc_capacitacion_widget_info_3">
                    <div class="container content">
                        <div class="cpc_capacitacion_widget_info_3_item">
                            <div class="icon"><i class="fa fa-laptop"></i></div>
                            <div class="text">
                                <p class="title">Modalidad</p>
                                <div class="information">
                                    <?php

                                    if (empty($modalidad)) {
                                        echo "Sin definir";
                                    } else {
                                        if ($modalidad == 'sincronico') {
                                            echo 'Sincrónica';
                                        } else {
                                            echo 'Asincrónica';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="cpc_capacitacion_widget_info_3_item">
                            <?php

                            if ($modalidad == 'sincronico') {
                            ?>

                                <div class="icon"><i class="fa fa-calendar-o"></i></div>
                                <div class="text">
                                    <p class="title">Inicio de Clases</p>
                                    <div class="information">
                                        <?php

                                        if (empty($fechas)) {
                                            echo 'Sin definir';
                                        } else {
                                            global $locale;
                                            $date = date_i18n('d \d\e F', strtotime($fechas[0]));
                                            echo $date;
                                        }
                                        ?>
                                    </div>
                                </div>

                            <?php
                            }

                            ?>
                        </div>
                        <div class="cpc_capacitacion_widget_info_3_item">
                            <div class="icon"><i class="fa fa-clock-o"></i></div>
                            <div class="text">
                                <p class="title">Duración</p>
                                <div class="information">

                                    <?php

                                    $duracion = get_post_meta(get_the_ID(), '_cpc_product_duration', true);

                                    if (empty($duracion)) {
                                        echo 'Sin definir';
                                    } else {
                                        echo $duracion . ' horas';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-none d-lg-flex col-4 cpc_product_price_c">
                <p class="cpc_product_price">$<?php echo $product->get_price(); ?></p>
                <div class="d-flex gap-4 cpc_product_price_btn">
                    <div class="btn btn-outline-primary">Contáctanos</div>
                    <button onclick="cpc_add_capacitacion_to_cart($(this), '<?php echo esc_url($product->add_to_cart_url()); ?>')" rel="nofollow" data-product_id="<?php echo esc_attr($product->get_id()); ?>" data-product_sku="<?php echo esc_attr($product->get_sku()); ?>" class="btn btn-primary">Comprar Ahora</button>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cpc_section body" style="margin-top: 4rem;">
    <div class="container-fluid container-lg">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="cpc_section_content">
                    <div class="container-fluid container-lg">
                        <?php

                        $brochure_link = get_post_meta(get_the_ID(), '_cpc_product_brochure_link', true);
                        $brochure_link_a = '<a href="' . $brochure_link . '" class="btn btn-outline-primary d-block mt-3" target="_blank">Ver Brochure Online</a>';

                        if (empty($brochure_link)) $brochure_link_a = '';

                        cpc_capacitacion_cpt_box_desc('Descripción del curso', $product->get_description(), $brochure_link_a);

                        $has_logro = get_post_meta(get_the_ID(), '_cpc_capacitacion_field_logro_select', true);
                        $logro_content =  htmlspecialchars_decode(get_post_meta(get_the_ID(), '_cpc_capacitacion_field_logro', true));

                        if (!empty($logro_content) && $has_logro == true) {
                            cpc_capacitacion_cpt_box_desc('Logro del curso', $logro_content);
                        }

                        $has_metodologia = get_post_meta(get_the_ID(), '_cpc_capacitacion_field_metodologia_select', true);
                        $metodologia_content =  htmlspecialchars_decode(get_post_meta(get_the_ID(), '_cpc_capacitacion_field_metodologia', true));

                        if (!empty($metodologia_content) && $has_metodologia == true) {
                            cpc_capacitacion_cpt_box_desc('Metodología del curso', $metodologia_content);
                        }

                        $has_beneficios = get_post_meta(get_the_ID(), '_cpc_capacitacion_field_beneficios_select', true);
                        $beneficios_content =  htmlspecialchars_decode(get_post_meta(get_the_ID(), '_cpc_capacitacion_field_beneficios', true));

                        if (!empty($beneficios_content) && $has_beneficios == true) {
                            cpc_capacitacion_cpt_box_desc('Beneficios del curso', $beneficios_content);
                        }


                        ?>

                        <?php

                        $temario_val = get_post_meta(get_the_ID(), '_cpc_capacitacion_field_temario', true);

                        if (!empty($temario_val)) {

                            $temario = json_decode($temario_val, true);

                            if (!empty($temario) || count($temario) >= 1) {
                        ?>

                                <div class="cpc_box_desc">
                                    <div class="cpc_head">
                                        <h2>Temario</h2>
                                        <hr>
                                    </div>
                                    <div class="cpc_body">
                                        <div class="accordion accordion-flush" id="accordionCPTTemario">
                                            <?php

                                            foreach ($temario as $item => $value) {

                                                $accordion_id = $item . '_collapse';
                                            ?>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="flush-headingOne">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $accordion_id; ?>" aria-expanded="false" aria-controls="<?php echo $accordion_id; ?>">
                                                            <?php echo $value['title']; ?>
                                                        </button>
                                                    </h2>
                                                    <div id="<?php echo $accordion_id; ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo 'heading_' . $accordion_id; ?>" data-bs-parent="#accordionCPTTemario">
                                                        <div class="accordion-body">
                                                            <?php echo $value['content']; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }

                                            ?>
                                        </div>
                                    </div>
                                </div>

                        <?php
                            }
                        }

                        ?>


                        <!--div-- class="cpc_box_desc">
                            <div class="cpc_head">
                                <h2>Requisitos minimos</h2>
                                <hr>
                            </div>
                            <div class="cpc_body">
                                <p class="desc"><?php echo $product->get_description(); ?></p>
                            </div>
                        </!--div-->

                        <div class="cpc_box_desc">
                            <div class="cpc_head">
                                <h2>Requiero más información</h2>
                                <hr>
                            </div>
                            <div class="cpc_body">
                                <form id="cpc_email_form_single_cpt" cpc-data-form-type="email">
                                    <input type="hidden" name="cpc_type" value="capacitacion-single">
                                    <div class="mb-3">
                                        <label for="cpc_form_input_name" class="form-label">Nombres</label>
                                        <input type="text" class="form-control" id="cpc_form_input_name" placeholder="Su nombre" name="cpc_name">
                                        <div class="invalid-feedback">
                                            Por favor escriba su nombre.
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="cpc_form_input_lat_name" class="form-label">Apellidos</label>
                                        <input type="text" class="form-control" id="cpc_form_input_lat_name" placeholder="Su nombre" name="cpc_last_name">
                                        <div class="invalid-feedback">
                                            Por favor escriba su apellido.
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="cpc_form_input_email" class="form-label">Correo</label>
                                        <input type="email" class="form-control" id="cpc_form_input_email" placeholder="name@example.com" name="cpc_email">
                                        <div class="invalid-feedback">
                                            Por favor escriba su correo.
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="cpc_form_input_phone" class="form-label">Celular</label>
                                        <input type="tel" class="form-control" id="cpc_form_input_phone" placeholder="xxx xxx xxx" name="cpc_phone">
                                        <div class="invalid-feedback">
                                            Por favor escriba su número télefonico.
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="cpc_form_select_country" class="form-label">País</label>

                                        <?php

                                        cpc_cpt_html_select(array(
                                            'name' => 'cpc_country',
                                            'class' => 'form-select',
                                            'id' => 'cpc_form_select_country',
                                        ), cpc_var_get_latam_countries());


                                        ?>

                                        <div class="invalid-feedback">
                                            Por favor seleccione su país.
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="cpc_form_textarea_msg" class="form-label">¿Alguna consulta?</label>
                                        <textarea class="form-control" id="cpc_form_textarea_msg" rows="6" name="cpc_message"></textarea>
                                        <div class="invalid-feedback">
                                            Por favor escriba su consulta al respecto.
                                        </div>
                                    </div>

                                    <button id="cpc_email_form_btn" type="button" class="btn btn-primary d-block w-100 mb-3" onclick="cpc_email_btn_send('cpc_email_form_single_cpt', $(this));">Enviar mensaje</button>
                                    <a href="" class="btn btn-whatsapp d-block w-100" target="_blank">Enviar a whatsapp</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">

                <?php

                $video_link = get_post_meta(get_the_ID(), '_cpc_product_video_link', true);

                if (!empty($video_link)) {
                ?>
                    <div class="cpc_product_box_video_right mb-3">
                        <iframe width="560" height="315" src="<?php echo $video_link; ?>?showinfo=0&enablejsapi=1&origin=https://localhost:8848/" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                <?php
                }
                ?>

                <?php

                $ponentes = get_post_meta(get_the_ID(), '_cpc_capacitacion_field_ponentes', true);

                if (!empty($ponentes)) {

                    $ponentes = json_decode($ponentes, true) ? json_decode($ponentes, true) : array();

                    if (count($ponentes) > 0) {
                ?>

                        <div class="cpc_box_desc">
                            <div class="cpc_head">
                                <h2>Ponente<?php if (count($ponentes) >= 1) echo 's'; ?></h2>
                                <hr>
                            </div>

                            <div class="cpc_body">
                                <?php
                                foreach ($ponentes as $poenente => $value) {
                                ?>
                                    <div class="mb-2">
                                        <strong class="desc"><?php echo $value['name'] ?></strong>
                                        <p class="desc">CERTIFICADOS: <?php echo $value['certificados'] ?></p>
                                        <p class="desc"><?php echo $value['subtitle'] ?></p>
                                        <p class="desc"><?php echo $value['desc'] ?></p>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>

                        </div>
                <?php
                    }
                }

                ?>



                <?php

                $cross_sell_ids = $product->get_cross_sell_ids();;
                $args = array(
                    'post_type' => 'product',

                );

                if (empty($cross_sell_ids) || count($cross_sell_ids) == 0) {
                    $args['post__not_in'] = array($product->get_id());
                    $args['posts_per_page'] = 3;
                } else {
                    $args['post__in'] = $cross_sell_ids;
                }

                $loop = new WP_Query($args);

                if ($loop->have_posts()) {
                ?>

                    <div class="cpc_box_desc">
                        <div class="cpc_head">
                            <h2>Cursos Similares</h2>
                            <hr>
                        </div>
                        <div class="cpc_body">
                            <?php
                            $args['content'] = array();
                            $args['content']['cpc_card'] = array(
                                'class' => 'mb-5'
                            );

                            echo '<div class="cpc_card_c mt-5" style="gap: 6rem;">';

                            while ($loop->have_posts()) : $loop->the_post();
                                get_template_part('template-parts/cpt/block', 'cpt-item', $args);
                            endwhile;

                            echo '</div>';
                            ?>
                        </div>
                    </div>

                <?php
                }

                wp_reset_query();
                ?>
            </div>
        </div>
    </div>
</section>


<?php

get_footer();
?>