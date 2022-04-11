<?php

/************************************
 * 
 * ADD POENNTES METABOX
 */

function cpc_capacitacion_product_ponentes_register_meta_box()
{
    add_meta_box('cpc_capacitacion_product_ponentes_meta_box_info', 'Ponentes', 'cpc_capacitacion_product_ponentes_meta_box_callback', 'product', 'normal', 'low');
}

add_action('add_meta_boxes', 'cpc_capacitacion_product_ponentes_register_meta_box');


function cpc_capacitacion_product_ponentes_meta_box_callback()
{
    wp_nonce_field('cpc_capacitacion_product_ponentes_save_meta_box', 'cpc_capacitacion_meta_box_nonce_ponentes');
    $value = get_post_meta(get_the_ID(), '_cpc_capacitacion_field_ponentes', true);

    if(empty($value)) $value = '{}';

    $args = array(
        'post_type' => 'ponentes',
        'post_status' => 'publish',
    );

    $loop = new WP_Query($args);

    ?>

    <input type="text" id="cpc_capacitacion_field_ponentes" name="cpc_capacitacion_field_ponentes" value='<?php echo $value; ?>'>

    <?php
    echo '<div class="card-group">';
    while ($loop->have_posts()) : $loop->the_post();

    $certificados = get_post_meta(get_the_ID(), '_cpc_ponentes_meta_box_certificados_key', true);
    $desc = sanitize_text_field(htmlspecialchars_decode(get_post_meta(get_the_ID(), '_cpc_ponentes_meta_box_desc_key', true)));
    $subtitle = get_post_meta(get_the_ID(), '_cpc_ponentes_meta_box_subtitle_key', true);
    $id = get_the_ID();
    $data_ponente = '{"'.get_the_ID().'": { "name": "'.get_the_title().'", "desc": "'.$desc.'", "certificados": "'.$certificados.'", "subtitle": "'.$subtitle.'", "permalink": "'.get_the_permalink().'"}}';
?>

        <div class="card" style="width: 18rem;">

            <?php
            
            if(has_post_thumbnail()){
                the_post_thumbnail('post-thumbnail', ['class' => 'card-img-top', 'height' => '18rem', 'style' => 'height: 18rem;min-height: 18rem; background: black; object-fit:cover;']);
            }else{
                echo '<img src="' . get_template_directory_uri() . '/assets/images/ponentes/ponente-unknow-img.jpg" alt="Certificate Project Control No ahay ponetnes" class="card-img-top" style="height: 18rem;">';
            }
            
            ?>
            <div class="card-body">
                <h5 class="card-title"><?php the_title(); ?></h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <button id="cpc_ponente_btn_add_<?php echo $id; ?>" type="button" data-ponente-id="<?php echo $id; ?>" data-ponente='<?php echo $data_ponente;?>' class="btn btn-primary cpc_cpt_btn_add_ponente">Añadir</button>
                <button id="cpc_ponente_btn_delete_<?php echo $id; ?>" type="button" class="btn btn-danger" style="display: none;">
                    <i class="fa fa-trash fa-lg" aria-hidden="true"></i>
                </button>
            </div>
        </div>

<?php
    endwhile;
    echo '</div>';

    wp_reset_postdata();
    /*
    $ponentes_query = new WP_Query(array(
        'post_type' => 'ponentes',
    ));

    if ($ponentes_query->have_posts()) {
        while ( $ponentes_query->have_posts() ){
            $ponentes_query->the_post();

            echo the_title();
        }
    }

    */
}



function cpc_capacitacion_product_ponentes_save_meta_box($post_id)
{
    if (!isset($_POST['cpc_capacitacion_meta_box_nonce_information'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['cpc_capacitacion_meta_box_nonce_ponentes'], 'cpc_capacitacion_product_ponentes_save_meta_box')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    update_post_meta($post_id, '_cpc_capacitacion_field_ponentes', $_POST['cpc_capacitacion_field_ponentes']);
}

add_action('save_post', 'cpc_capacitacion_product_ponentes_save_meta_box');
