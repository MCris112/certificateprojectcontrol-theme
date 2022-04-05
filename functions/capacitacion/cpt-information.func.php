<?php

/************************************
 * 
 * INFORMACIÓN META BOX AND CUSTOM FIELDS
 */

function cpc_capacitacion_product_information_register_meta_box()
{
    add_meta_box('cpc_capacitacion_product_information_meta_box_info', 'Información', 'cpc_capacitacion_product_information_meta_box_callback', 'product', 'normal', 'high');
}

add_action('add_meta_boxes', 'cpc_capacitacion_product_information_register_meta_box');

function cpc_capacitacion_product_information_meta_box_callback()
{

    wp_nonce_field('cpc_capacitacion_product_information_save_meta_box', 'cpc_capacitacion_meta_box_nonce_information');

?>

    <div class="d-flex align-items-start w-100">
        <div class="nav flex-column nav-pills me-3 border-end" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Logro</button>
            <button class="nav-link" id="v-pills-metodologia-tab" data-bs-toggle="pill" data-bs-target="#v-pills-metodologia" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Metodología</button>
            <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Beneficios</button>
            <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</button>
        </div>
        <div class="tab-content w-100 p-3" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <select id="_cpc_capacitacion_field_logro_select" name="_cpc_capacitacion_field_logro_select" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" onChange="cpc_informacion_field_select_is_default('_cpc_capacitacion_field_logro_select', 'cpc_info_container_logro', 'cpc_info_container_logro_default');">
                    <option value="true" >Mostrar valor por defecto</option>
                    <option value="false" selected>Valor Personalizado</option>
                </select>

                <div id="cpc_info_container_logro" class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Logro de la capacitación</label>
                    <?php wp_editor( htmlspecialchars_decode( get_post_meta(get_the_ID(), '_cpc_capacitacion_field_logro', true) ), '_cpc_capacitacion_field_logro', array('textarea_name' => '_cpc_capacitacion_field_logro', "media_buttons" => false)); ?>
                </div>

                <div id="cpc_info_container_logro_default" class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Logro de la capacitación</label>
                    <p>defauylt</p>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-metodologia" role="tabpanel" aria-labelledby="v-pills-metodologia-tab">
                <select id="_cpc_capacitacion_field_metodologia_select" name="_cpc_capacitacion_field_metodologia_select" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                    <option value="true" >Mostrar valor por defecto</option>
                    <option value="false" selected>Valor Personalizado</option>
                </select>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Metodología</label>
                    <?php wp_editor( htmlspecialchars_decode( get_post_meta(get_the_ID(), '_cpc_capacitacion_field_metodologia', true) ), '_cpc_capacitacion_field_metodologia', array('textarea_name' => '_cpc_capacitacion_field_metodologia', "media_buttons" => false)); ?>
                </div>
            </div>
            <div class="tab-pane fade w-100 p-3" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                <select id="_cpc_capacitacion_field_beneficios_select" name="_cpc_capacitacion_field_beneficios_select" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                    <option value="true" >Mostrar valor por defecto</option>
                    <option value="false" selected>Valor Personalizado</option>
                </select>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Beneficios</label>
                    <?php wp_editor( htmlspecialchars_decode( get_post_meta(get_the_ID(), '_cpc_capacitacion_field_beneficios', true) ), '_cpc_capacitacion_field_beneficios', array('textarea_name' => '_cpc_capacitacion_field_beneficios', "media_buttons" => false)); ?>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
        </div>
    </div>
<?php
}

function cpc_capacitacion_product_information_save_meta_box($post_id)
{
    if (!isset($_POST['cpc_capacitacion_meta_box_nonce_information'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['cpc_capacitacion_meta_box_nonce_information'], 'cpc_capacitacion_product_information_save_meta_box')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    update_post_meta($post_id, '_cpc_capacitacion_field_logro_select', $_POST['_cpc_capacitacion_field_logro_select']);
    update_post_meta($post_id, '_cpc_capacitacion_field_logro', htmlspecialchars( $_POST['_cpc_capacitacion_field_logro'] ) );

    update_post_meta($post_id, '_cpc_capacitacion_field_metodologia_select', $_POST['_cpc_capacitacion_field_metodologia_select']);
    update_post_meta($post_id, '_cpc_capacitacion_field_metodologia', htmlspecialchars( $_POST['_cpc_capacitacion_field_metodologia'] ) );

    update_post_meta($post_id, '_cpc_capacitacion_field_beneficios_select', $_POST['_cpc_capacitacion_field_beneficios_select']);
    update_post_meta($post_id, '_cpc_capacitacion_field_beneficios', htmlspecialchars( $_POST['_cpc_capacitacion_field_beneficios'] ) );
}

add_action('save_post', 'cpc_capacitacion_product_information_save_meta_box');
