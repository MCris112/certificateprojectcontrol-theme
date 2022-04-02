<?php

$modalidad_txt = "Sincrónicas";
$is_list = false;

$args_query = array();

if (array_key_exists('is_sincronico', $args)) {
    if (!$args['is_sincronico']) $modalidad_txt = "Asincrónicos";

    $args_query = array(
        'post_type'      => 'product',
        'posts_per_page' => 10,
        'meta_key'       => '_cpc_capacitacion_field_modalidad',
        'meta_value'     => $args['is_sincronico'],
    );
}

if (array_key_exists('all', $args) && $args['all'] == true) {
    $is_list = true;

    $args_query = array(
        'post_type'      => 'product',
        'posts_per_page' => 10,
    );
}

$loop = new WP_Query($args_query);
$count = $loop->post_count;

?>

<section class="cpc_cursos_list">
    <div class="container">
        <?php

        if ($is_list) {
        } else {
        ?>

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

        <?php
        }


        ?>

        <div class="cpc_card_c <?php if ($count == 1) echo 'cpc_card_c_one '; ?>mt-5">
            <?php

            if ($loop->have_posts() && $count >= 2) {
                $args['count'] = $count;
                
                while ($loop->have_posts()) : $loop->the_post();
                    get_template_part('template-parts/cpt/block', 'cpt-item', $args);
                endwhile;
            }

            if ($count == 1) {
                while ($loop->have_posts()) : $loop->the_post();
                    get_template_part('template-parts/cpt/block', 'cpt-item', $args);
                ?>

            <?php
                endwhile;
            }

            if ($count == 0) {
                echo "none";
            }

            wp_reset_query();
            ?>
        </div>

        <?php

        if (!$is_list) {
        ?>
            <a href="" class="btn cpc_btn d-block mt-3 link-primary">Ver Todo Ahora</a>
        <?php
        }
        ?>

    </div>
</section>