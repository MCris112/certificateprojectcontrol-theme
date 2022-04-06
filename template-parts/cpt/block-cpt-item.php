<?php
global $product;

$duracion = get_post_meta(get_the_ID(), '_cpc_product_duration', true);

$duracion_txt = empty($duracion) ? '' : $duracion . ' horas';

$fechas = get_post_meta(get_the_ID(), '_cpc_capacitacion_field_modalidad_fechas', true);
$subtitle = get_post_meta(get_the_ID(), '_cpc_capacitacion_field_sub_title', true);
$sessiones = 'Sin definir';
$sessiones_txt = get_post_meta(get_the_ID(), '_cpc_product_sessions', true);

if(!empty($sessiones_txt)){
    $sessiones = $sessiones_txt.' sesiones';
}

if( !empty($fechas) ) $fechas = json_decode($fechas, true);


if($args['count'] == 1){
?>

<div class="cpc_card cpc_card_one">
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

        if ($args['modalidad'] == 'sincronico') {

        ?>
            <span class="info_pill">
                Inicio de clases:
                <?php
                if (empty($fechas)) {
                    echo ' Sin definir';
                } else {
                    global $locale;
                    $date = date_i18n('d \d\e F', strtotime($fechas[0]));
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
            <span class="price">$<?php echo $product->get_price(); ?></span>
        </div>

        <a href="<?php echo get_permalink(); ?>" class="btn btn-primary d-block">Ver Curso</a>
    </div>
</div>

<?php
}else{
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
            <span class="time"><i class="fa fa-clock-o"></i><?php echo $duracion_txt;?></span>
            <span class="sessions"><i class="fa fa-archive"></i><?php echo $sessiones; ?></span>
            <span class="price">$<?php echo $product->get_price(); ?></span>
        </div>

        <a href="<?php echo get_permalink(); ?>" class="btn btn-primary d-block">Ver Curso</a>
    </div>
</div>

<?php
}
?>
