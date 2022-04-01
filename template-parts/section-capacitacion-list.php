<?php

$modalidad_txt = "Sincrónicas";

if($args['is_sincronico'] == 'false') $modalidad_txt = "Asincrónicos";

?>

<section class="cpc_cursos_list">
    <div class="container">
        <div class="row cpc_title">
            <div class="col">
                <p class="cpc_title sm">Capacitaciones</p>
                <p class="cpc_title"><?php echo $modalidad_txt; ?></p>
                <hr class="cpc_hr">
            </div>
            <div class="col d-flex align-items-center justify-content-end">
                <p class="text text-end">
                    Estudia donde sea y cuando quieras, con nuestras clases en modalidad asincronica. Directo desde nuestra plataforma.
                </p>
            </div>
        </div>

        <div class="cpc_card_c mt-5">
            <?php
            $args_query = array(
                'post_type'      => 'product',
                'posts_per_page' => 10,
                'meta_key'       => '_cpc_capacitacion_field_modalidad',
                'meta_value'     => $args['is_sincronico'],
            );

            $loop = new WP_Query($args_query);

            if ($loop->have_posts()) {
                while ($loop->have_posts()) : $loop->the_post();
                    global $product;
            ?>
                    <div class="cpc_card">
                        <span class="info_pill">Curso</span>
                        <a href="<?php echo get_permalink(); ?>"  class="head">
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

        <a href="" class="btn cpc_btn d-block mt-3 link-primary">Ver Todo Ahora</a>
    </div>
</section>