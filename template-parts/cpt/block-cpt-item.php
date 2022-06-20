<?php
global $product;

$is_near = array_key_exists('near', $args) ? $args['near'] : false;

$fechas = get_post_meta(get_the_ID(), '_cpc_capacitacion_field_modalidad_fechas', true);
$fechas_conditional = !empty($fechas);

if ($fechas_conditional && !is_array($fechas)) {
    $fechas = json_decode($fechas, true);
}

$duracion = get_post_meta(get_the_ID(), '_cpc_product_duration', true);

$duracion_txt = empty($duracion) ? 'Sin definir' : $duracion . ' horas Acad.';

$subtitle = get_post_meta(get_the_ID(), '_cpc_capacitacion_field_sub_title', true);
$sessiones = 'Sin definir';
$sessiones_txt = get_post_meta(get_the_ID(), '_cpc_product_sessions', true);


if (!isset($args['count'])) $args['count'] = 2;

if (!empty($sessiones_txt)) {
    $sessiones = $sessiones_txt . ' sesiones';
}

$class_content = array_key_exists('content', $args) ? $args['content'] : array();
$card_class = array_key_exists('class', $class_content) ? $class_content['cpc_card'] : array();

$modalidad_post = array_key_exists('modalidad', $args) ? $args['modalidad'] : get_post_meta(get_the_ID(), '_cpc_capacitacion_field_modalidad', true);

if ($args['count'] == 1) {
?>

    <div class="cpc_card cpc_card_one <?php echo array_key_exists('class', $card_class) ?>">
        <a href="<?php echo get_permalink(); ?>" class="head">
            <div class="img">
                <?php echo woocommerce_get_product_thumbnail(); ?>
                <div class="cover"></div>
            </div>
            <div class="text">
                <h3 class="card_title"><?php echo get_the_title(); ?></h3>
                <?php

                if (!empty($subtitle)) {
                ?>
                    <p class="sub"><?php echo $subtitle; ?></p>
                <?php
                }
                ?>
            </div>
        </a>

        <div class="content">
            <?php


            if ($modalidad_post == 'sincronico') {

            ?>
                <span class="info_pill">
                    Inicio de clases:
                    <?php
                    if (!$fechas_conditional) {
                        echo ' Sin definir';
                    } else {
                        global $locale;
                        $date = wp_date('d \d\e F', strtotime($fechas[0]));
                        //$date = date_i18n('d \d\e F', strtotime($fechas[0]));
                        echo $date;
                    }

                    ?>
                </span>
            <?php
            }

            ?>
            <p class="desc"><?php echo $product->get_description(); ?></p>
            <div class="info">
                <span class="time"><i class="fa fa-clock-o"></i>

                    <?php
                    echo $duracion_txt;
                    ?>
                </span>
                <span class="sessions"><i class="fa fa-archive"></i><?php echo $sessiones; ?></span>

                <?php
                cpc_show_block_item_price($product);
                ?>
            </div>

            <a href="<?php echo get_permalink(); ?>" class="btn btn-primary d-block">Lo Quiero</a>
        </div>
    </div>

<?php
} else {
?>
    <div class="cpc_card <?php echo array_key_exists('class', $card_class) ?> <?php if (array_key_exists('modalidad', $args) && $args['position_post'] == $args['count'] - 1) {
                                                                                    if (array_key_exists('all', $args) && $args['all']) {
                                                                                    } else {
                                                                                        if ($args['count'] > 3) {
                                                                                            echo " cpc_hide_last_item";
                                                                                        }
                                                                                    }
                                                                                } ?>">
        <?php

        if ($fechas_conditional && $modalidad_post == 'sincronico') {
        ?>

            <span class="info_pill">
                <?php
                global $locale;
                echo date_i18n('d \d\e F', strtotime($fechas[0]));
                ?>
            </span>

        <?php
        }

        ?>
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
                <span class="time"><i class="fa fa-clock-o"></i><?php echo $duracion_txt; ?></span>
                <span class="sessions"><i class="fa fa-archive"></i><?php echo $sessiones; ?></span>
                <?php
                cpc_show_block_item_price($product);
                ?>
            </div>

            <a href="<?php echo get_permalink(); ?>" class="btn btn-primary d-block">Lo Quiero</a>
        </div>
    </div>

<?php
}
?>