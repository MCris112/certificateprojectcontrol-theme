<?php

/**
 * Template Name: Capacitación Contactanos
 *
 * @package WordPress
 * @subpackage CertificateProjectControl
 * @since CertificateProjectControl 1.0
 */

get_header();

$args = array(
    'title' => get_the_title(),
);
get_template_part('template-parts/section', 'title', $args);
?>



<div class="container mt-5 mb-5">
    <div class="row gap-4 pb-5">
        <div class="col-12 col-md-6">
            <h2 class="cpc_subtitle mb-5">INFORMACIÓN DEL CONTACTO:</h2>

            <hr>

            <div class="cpc_contactanos_icon_text">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <div class="txt">
                    <p class="title">Dirección:</p>
                    <p class="desc">Jr. Puquina 115, San Miguel, Peru</p>
                </div>
            </div>

            <hr>
            <div class="row mb-2">
                <div class="col cpc_contactanos_icon_text">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <div class="txt">
                        <p class="title">Teléfono:</p>
                        <p class="desc">+51 922 936 632</p>
                    </div>
                </div>

                <div class="col cpc_contactanos_icon_text">
                    <i class="fa fa-whatsapp" aria-hidden="true"></i>
                    <div class="txt">
                        <p class="title">Whatsapp:</p>
                        <p class="desc">+51 922 936 632</p>
                    </div>
                </div>
            </div>

            <div class="row gap-3">
                <div class="col cpc_contactanos_icon_text">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    <div class="txt">
                        <p class="title">Email:</p>
                        <p class="desc">jose.reyes@pcertificate.com</p>
                    </div>
                </div>

                <div class="col cpc_contactanos_icon_text">
                    <i class="fa fa-globe" aria-hidden="true"></i>
                    <div class="txt">
                        <p class="title">Web:</p>
                        <p class="desc">pcertificate.com</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5">
            <h2 class="cpc_subtitle mb-5">Ubicanos</h2>
            <iframe class="cpc_contactanos_iframe" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1950.7175553846969!2d-77.094234!3d-12.082337!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x888fa27ecb5b89f7!2zMTLCsDA0JzU2LjQiUyA3N8KwMDUnMzkuMiJX!5e0!3m2!1sen!2sus!4v1649862654719!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    <div class="row gap-4 pt-5">
        <div class="col-12 col-lg-8">
            <h2 class="cpc_subtitle mb-5">REALIZA TU CONSULTA</h2>

            <form id="cpc_email_form_contactanos" cpc-data-form-type="email" method="post">
                <input type="hidden" name="cpc_type" value="contactanos">
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

                <button id="cpc_email_form_btn" type="submit" class="btn btn-primary d-block w-100 mb-3" onclick="cpc_email_btn_send('cpc_email_form_contactanos', $(this));">Enviar mensaje</button>
                <a href="" class="btn btn-whatsapp d-block w-100" target="_blank">Enviar a whatsapp</a>
            </form>
        </div>
    </div>
</div>

<?php
get_footer();
?>