<?php
get_header();

$product = wc_get_product(get_the_id());

?>

<section class="cpc_product_section top">
    <div class="cpc_bg_section">
        <img src="<?php echo get_template_directory_uri(); ?>/images/backgrounds/bg_product.jpg" alt="">
        <div class="cover"></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-8">
                <h1 class="cpc_title"><?php the_title(); ?></h1>
                <p class="cpc_subtitle"><?php echo cpc_get_meta_field('_cpc_capacitacion_field_sub_title'); ?></p>
                <hr class="cpc_hr">
                <p class="short_desc"><?php echo $product->get_short_description(); ?></p>
                <div class="cpc_capacitacion_widget_info_3">
                    <div class="container content">
                        <div class="cpc_capacitacion_widget_info_3_item">
                            <div class="icon"><i class="fa fa-laptop"></i></div>
                            <div class="text">
                                <p class="title">Modalidad</p>
                                <div class="information">
                                    <?php
                                    $modalidad = cpc_get_meta_field('_cpc_capacitacion_field_modalidad');

                                    if (empty($modalidad)) {
                                        echo "Sin definir";
                                    } else {
                                        if ($modalidad || $modalidad == '1') {
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
                            <div class="icon"><i class="fa fa-calendar-o"></i></div>
                            <div class="text">
                                <p class="title">Inicio de Clases</p>
                                <div class="information">
                                    <?php

                                    $inicio_clases = get_post_meta(get_the_ID(), '_cpc_capacitacion_field_fecha_inicio', true);

                                    if (empty($inicio_clases)) {
                                        echo 'Sin definir';
                                    } else {
                                        global $locale;
                                        $date= date_i18n( 'd \d\e F', strtotime ($inicio_clases) );
                                        echo $date;
                                    }
                                    ?>
                                </div>
                            </div>
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
            <div class="col-4 cpc_product_price_c">
                <p class="cpc_product_price">$<?php echo $product->get_price(); ?></p>
                <div class="d-flex gap-4 cpc_product_price_btn">
                    <div class="btn btn-outline-primary">Contáctanos</div>
                    <div class="btn btn-primary">Comprar Ahora</div>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="cpc_product_section body" style="margin-top: 4rem;">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="cpc_product_section_content">
                    <div class="container">
                        <div class="cpc_product_box_desc">
                            <div class="cpc_head">
                                <h2>Descripción del curso</h2>
                                <hr>
                            </div>
                            <div class="cpc_body">
                                <p class="desc"><?php echo $product->get_description(); ?></p>
                            </div>
                        </div>

                        <div class="cpc_product_box_desc">
                            <div class="cpc_head">
                                <h2>Logro del curso</h2>
                                <hr>
                            </div>
                            <div class="cpc_body">
                                <p class="desc"><?php echo $product->get_description(); ?></p>
                            </div>
                        </div>

                        <div class="cpc_product_box_desc">
                            <div class="cpc_head">
                                <h2>Metodología</h2>
                                <hr>
                            </div>
                            <div class="cpc_body">
                                <p class="desc"><?php echo $product->get_description(); ?></p>
                            </div>
                        </div>

                        <div class="cpc_product_box_desc">
                            <div class="cpc_head">
                                <h2>Temario</h2>
                                <hr>
                            </div>
                            <div class="cpc_body">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                Módulo 1
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                Módulo 2
                                            </button>
                                        </h2>
                                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingThree">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                                Módulo 3
                                            </button>
                                        </h2>
                                        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="cpc_product_box_desc">
                            <div class="cpc_head">
                                <h2>Requisitos minimos</h2>
                                <hr>
                            </div>
                            <div class="cpc_body">
                                <p class="desc"><?php echo $product->get_description(); ?></p>
                            </div>
                        </div>

                        <div class="cpc_product_box_desc">
                            <div class="cpc_head">
                                <h2>Requiero más información</h2>
                                <hr>
                            </div>
                            <div class="cpc_body">
                                <p class="desc"><?php echo $product->get_description(); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="cpc_product_box_video_right">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/9Vpe-dqscyM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="cpc_product_box_desc">
                    <div class="cpc_head">
                        <h2>Ponente</h2>
                        <hr>
                    </div>
                    <div class="cpc_body">
                        <strong class="desc">Frich Gonzalo Torres Vega</strong>
                        <p class="desc">CERTIFICADOS: MBA - CIP</p>
                        <p class="desc">Más de 15 años de experiencia en la gestión, gerenciamiento, control de proyecto, planificación y ejecución de proyectos civiles de infraestructura, movimiento de tierras, puentes, viales, mineros de mediana y gran envergadura. Líder en la gestión de oficinas de proyectos (PMI), en administración de contratos, control de proyectos, produccion y construccion. Senior de control de proyectos, costos y claims en empresas como SNC Lavalin, WOOD, ANDDES y APPLUS para clientes como MINSUR, CHINALCO; SOLGAS, MTC, Cerro Verde Y Antamina. – Docente Universitario para UPN y docente para CAPECO. – Magister en Administración de empresas MBA de CENTRUM. -Diplomado en gerencia de proyectos en UPC.</p>
                    </div>
                </div>

                <div class="cpc_product_box_desc">
                    <div class="cpc_head">
                        <h2>Cursos Similares</h2>
                        <hr>
                    </div>
                    <div class="cpc_body">
                        <?php

                        $args = array(
                            'modalidad' => 'asincronico',
                        );
                        ?>
                        <div class="cpc_card_c mt-5">
                            <?php
                            $args = array(
                                'post_type'      => 'product',
                                'posts_per_page' => 10,
                                'meta_key'       => 'modalidad',
                                'meta_value'     => $args['modalidad'],
                            );

                            $loop = new WP_Query($args);

                            if ($loop->have_posts()) {
                                while ($loop->have_posts()) : $loop->the_post();
                                    global $product;
                            ?>
                                    <div class="cpc_card">
                                        <span class="info_pill">Curso</span>
                                        <a href="<?php echo get_permalink(); ?>" class="head">
                                            <div class="img">
                                                <img src="<?php echo woocommerce_get_product_thumbnail(); ?>" alt="">
                                                <div class="cover"></div>
                                            </div>
                                            <div class="text">
                                                <h3 class="card_title"><?php echo get_the_title(); ?></h3>
                                            </div>
                                        </a>

                                        <div class="content">
                                            <div class="info">
                                                <span class="time"><i class="fa fa-clock-o"></i>12 horas</span>
                                                <span class="sessions"><i class="fa fa-archive"></i>10:00 a.m</span>
                                                <span class="price">$<?php echo $product->get_price(); ?></span>
                                            </div>

                                            <a href="<?php echo get_permalink(); ?>" class="btn btn-primary d-block">Ver Curso</a>
                                        </div>
                                    </div>

                            <?php
                                endwhile;
                            } else {
                                echo "none";
                            }

                            wp_reset_query();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php

get_footer();
?>