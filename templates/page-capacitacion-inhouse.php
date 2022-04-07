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
    'subtitle' => 'Certificate Project Control',
);
get_template_part('template-parts/section', 'title', $args);
?>



<div class="container mt-5">
    <div class="row">
        <div class="col col-md-8">
            <h2 class="cpc_title">¡Solicita tu cotización!</h2>
            <form action="">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
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