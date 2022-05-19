<?php

$modalidad_txt = "Online en vivo";
$is_list = false;
$show_title = true;

$args_query = array();

if (array_key_exists('modalidad', $args)) {
    if ($args['modalidad'] == 'asincronico') $modalidad_txt = "Asincrónicas";

    $args_query = array(
        'post_type'      => 'product',
        'posts_per_page' => 4,
        'meta_key'       => '_cpc_capacitacion_field_modalidad',
        'meta_value'     => $args['modalidad'],
    );
}

if (array_key_exists('all', $args) && $args['all']) {
    $is_list = true;

    $args_query = array(
        'post_type'      => 'product',
    );
}

if (array_key_exists('title', $args)) {
    $show_title = $args['title'];
}

if (array_key_exists('add', $args)) {
    $addons = $args['add'];

    foreach ($addons as $add => $value) {
        $args_query[$add] = $value;
    }
}

$loop_capacitaciones = new WP_Query($args_query);
$count = $loop_capacitaciones->post_count;

$args['count'] = $count;

?>

<section class="cpc_cursos_list <?php if (isset($args['class']['section'])) echo $args['class']['section']; ?>">
    <div class="container">
        <?php

        if ($is_list) {
        } else {

            if ($show_title) {
        ?>
                <div class="row cpc_cursos_header">
                    <div class="col col-lg-6">
                        <p class="cpc_title sm">Capacitaciones</p>
                        <p class="cpc_title"><?php echo $modalidad_txt; ?></p>
                        <hr class="cpc_hr mx-auto ms-lg-1">
                    </div>
                    <div class="col col-lg-6 d-flex align-items-center justify-content-end">
                        <p class="text text-center text-lg-end mx-auto ms-md-auto me-md-0">
                            <?php


                            if (array_key_exists('modalidad', $args)) {
                                if ($args['modalidad'] == 'asincronico') {
                                    echo 'Estudia donde sea y cuando quieras, con nuestras clases en modalidad asincronica. Directo desde nuestra plataforma.';
                                }else{
                                    echo 'Estudia donde sea y cuando quieras, con nuestras clases en modalidad online en vivo. Directo desde nuestra plataforma.';
                                }
                            }

                            ?>
                        </p>
                    </div>
                </div>

        <?php
            }
        }


        ?>

        <div class="cpc_card_c <?php if ($count == 1) echo 'cpc_card_c_one '; ?>mt-5">
            <?php

            $post_in_id = array();
            $position_post = 0;
            if ($loop_capacitaciones->have_posts()) {
                while ($loop_capacitaciones->have_posts()) : $loop_capacitaciones->the_post();
                    $position_post += 1;
                    $args['position_post'] = $position_post;

                    if (array_key_exists('near', $args) && $args['near']) {

                        $fechas = get_post_meta(get_the_ID(), '_cpc_capacitacion_field_modalidad_fechas', true);
                        $fechas_conditional = !empty($fechas);

                        if ($fechas_conditional) {
                            $fechas = json_decode($fechas, true);

                            $date_now = date('Y-m-d');
                            $date_compare = date('Y-m-d', strtotime($fechas[0]));

                            if ($date_now > $date_compare) {
                                //the date it past
                                $args['count'] = $args['count'] - 1;
                                $count = $args['count'];
                                cpc_capacitacion_change_asincronico(get_the_ID());
                            } else {
                                //Has to show
                                $post_in_id[] = get_the_ID();
                            }
                        } else {
                            // Fechas its empty
                            $args['count'] = $args['count'] - 1;
                            $count = $args['count'];
                        }
                    } else {
                        get_template_part('template-parts/cpt/block', 'cpt-item', $args);
                    }
                endwhile;
            }

            if (count($post_in_id) > 0) {
                $args_query['post__in'] = $post_in_id;

                $loop_capacitaciones = new WP_Query($args_query);
                $count = $loop_capacitaciones->found_posts;

                $args['count'] = $count;

                if ($loop_capacitaciones->have_posts()) {
                    while ($loop_capacitaciones->have_posts()) : $loop_capacitaciones->the_post();
                        get_template_part('template-parts/cpt/block', 'cpt-item', $args);
                    endwhile;
                }
            }

            if ($count == 0) {
            ?>

                <div class="container">
                    <?php
                    
                    get_template_part('template-parts/block', 'empty-search', ['no_found_text' => 'No se han encontrado capacitaciones']);

                    ?>
                </div>

            <?php
            }

            wp_reset_query();
            ?>
        </div>

        <?php

        if ($count >= 1) {
            if (!$is_list) {
                $modalidad = $args['modalidad'];

        ?>
                <a href="<?php echo esc_url(get_term_link($modalidad, 'modalidad')); ?>" class="btn cpc_btn d-block mt-3 link-primary">Ver Todo Ahora</a>
        <?php
            }
        }
        ?>

    </div>
</section>

<?php wp_reset_query();  ?>