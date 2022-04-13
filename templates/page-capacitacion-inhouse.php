<?php

/**
 * Template Name: Capacitación inHouse
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
    <div class="row">
        <div class="col col-md-8 pe-md-5">
            <h2 class="cpc_title mb-5">¡Solicita tu cotización!</h2>
            <form id="cpc_email_form" cpc-data-form-type="email" class="row gap-3">
                <div class="row">
                    <div class="col">
                        <label for="cpc_form_input_name" class="form-label">Nombre de empresa</label>
                        <input type="text" class="form-control" id="cpc_form_input_name" placeholder="Su nombre" name="cpc_name">
                        <div class="invalid-feedback">
                            Por favor escriba su nombre.
                        </div>
                    </div>
                    <div class="col">
                        <label for="cpc_form_input_name" class="form-label">Nombre de contácto</label>
                        <input type="text" class="form-control" id="cpc_form_input_name" placeholder="Su nombre" name="cpc_name">
                        <div class="invalid-feedback">
                            Por favor escriba su nombre.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="cpc_form_input_email" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="cpc_form_input_email" placeholder="name@example.com" name="cpc_email">
                        <div class="invalid-feedback">
                            Por favor escriba su correo.
                        </div>
                    </div>
                    <div class="col">
                        <label for="cpc_form_input_phone" class="form-label">Celular</label>
                        <input type="tel" class="form-control" id="cpc_form_input_phone" placeholder="xxx xxx xxx" name="cpc_phone">
                        <div class="invalid-feedback">
                            Por favor escriba su número télefonico.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="cpc_form_input_phone" class="form-label">N° alumnos</label>
                        <input type="number" class="form-control" id="cpc_form_input_phone" placeholder="xxx xxx xxx" name="cpc_phone">
                        <div class="invalid-feedback">
                            Por favor escriba su número télefonico.
                        </div>
                    </div>

                    <div class="col">
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
                </div>

                <div class="col">
                    <label for="cpc_form_select_country" class="form-label">Capacitaciones</label>

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
                    <label for="cpc_form_textarea_msg" class="form-label">Observaciones o detalle la característica del curso que desea solicitar a nuestra empresa</label>
                    <textarea class="form-control" id="cpc_form_textarea_msg" rows="6" name="cpc_message"></textarea>
                    <div class="invalid-feedback">
                        Por favor escriba su consulta al respecto.
                    </div>
                </div>

                <button id="cpc_email_form_btn" type="submit" class="btn btn-primary d-block w-100">Solicitar proforma con precios corporativos</button>
                <a href="" class="btn btn-whatsapp d-block w-100" target="_blank">Enviar a whatsapp</a>
            </form>
        </div>
        <div class="col col-md-4">
            <div class="cpc_box_desc mb-3">
                <div class="cpc_head">
                    <h2 class="small">CURSOS Y TALLERES EN MODALIDAD INHOUSE</h2>
                    <hr>
                </div>
                <div class="cpc_body small">
                    <p class="desc">Nuestros especialistas imparten cursos en su empresa hechos a la medida en el horarios que usted convenga y con la misma calidad educativa que nuestra empresa otorga a todos sus clientes.</p>
                </div>
            </div>

            <div class="cpc_box_desc mb-3">
                <div class="cpc_head">
                    <h2 class="small">BENEFICIOS</h2>
                    <hr>
                </div>
                <div class="cpc_body small">
                    <ul>
                        <li>Flexibilidad de Horarios.</li>
                        <li>Ejemplos personalizados según el requerimiento de los colaboradores.</li>
                        <li>Archivos de Trabajo y Ejercicios.</li>
                        <li>Acceso al Aula Virtual con todo el contenido del curso.</li>
                        <li>Certificados.</li>
                    </ul>
                </div>
            </div>

            <div class="cpc_box_desc mb-3">
                <div class="cpc_head">
                    <h2 class="small">REQUERIMIENTOS</h2>
                    <hr>
                </div>
                <div class="cpc_body small">
                    <ul>
                        <li>Cada participante debe contar con una computadora con acceso a internet para el desarrollo de las clases.</li>
                        <li>Para el profesor una carpeta o podio.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>