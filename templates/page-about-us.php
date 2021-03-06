<?php

/**
 * Template Name: Sobre Nosotros
 *
 * @package WordPress
 * @subpackage CertificateProjectControl
 * @since CertificateProjectControl 1.0
 */

get_header();

$args = array(
    'title' => 'Sobre Nosotros',
    'subtitle' => 'Certificate Project Control',
);
get_template_part('template-parts/section', 'title', $args);
?>



<section>
    <div class="container">
        <div class="cpc_welcome row gap-4 gap-lg-0 mb-5 mb-lg-0">
            <div class="cpc_text col col-lg-6 mb-5 mb-lg-0">
                <span class="cpc_subtitle">Bienvenido a</span>
                <h1 class="cpc_title">Certificate Project Control</h1>
                <hr class="cpc_hr">
                <p class="desc">
                    Estamos firmemente convencidos que las buenas prácticas corporativas deben regular toda actividad en los negocios, y que actuar en todo momento y situación con integridad, transparencia y una cultura ética, representan el impulso necesario para generar confianza y vínculos laborales estratégicos con nuestros clientes, colaboradores, y entornoen general donde realizamos nuestras operaciones.
                </p>

                <p class="desc">Estos valores definen las políticas y regulan los principios organizacionales con los que cada miembro de CPC se desempeña. </p>
            </div>
            <div class="col col-lg-6 d-flex align-middle">
                <div class="cpc_presentation">
                    <div class="square_back"></div>
                    <iframe width="560" height="315" src="<?php echo cpc_get_video_link_about_us(); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>

        <div class="my-5"></div>

        <div class="row mb-5">
            <div class="col-12 col-lg-6 mb-5 mb-lg-0">
                <div class="cpc_text_mv text-center text-lg-start">
                    <h2 class="cpc_subtitle">Misión</h2>
                    <hr class="cpc_hr mx-auto mx-lg-0">
                    <p class="desc">
                        La misión de sostenibilidad de Certificate Project
                        Control está enfocada en contribuir con nuestros
                        clientes en la generación de valor para sus organizaciones, a través de la aplicación de metodologías
                        ágiles de resultados altamente comprobados,
                        haciendo que lleguemos en ocasiones más allá de los
                        limites respecto de las formas habituales de hacer las
                        cosas, manteniendo en todo momento estricta reserva
                        de la información que se nos confía, respetando
                        el entorno donde nos desempeñamos, y anteponiendo
                        el principio ético de nuestros profesionales y equipos
                        de trabajo.
                    </p>
                </div>
            </div>
            <div class="col-12 col-lg-6 mb-5 mb-lg-0">
                <div class="cpc_text_mv text-center text-lg-start">
                    <h2 class="cpc_subtitle">Visión</h2>
                    <hr class="cpc_hr mx-auto mx-lg-0">
                    <p class="desc">
                        La visión de Certificate Project Control es ser una
                        consultora con presencia en Perú y
                        Latinoamérica especialista en Claims de construcción
                        y Gestión de proyectos, programas y portafolios, que
                        tiene el compromiso de brindar las mejores
                        soluciones a nuestros clientes generando valor.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="cpc_features">
            <div class="cpc_features_item">
                <i class="fa fa-laptop"></i>
                <div class="text">
                    <h3 class="title">Cursos en vivo</h3>
                    <p class="sub">Clases online en cualquier parte ¡Y a tiempo!</p>
                </div>
            </div>

            <div class="cpc_features_item">
                <i class="fa fa-certificate"></i>
                <div class="text">
                    <h3 class="title">Certificados</h3>
                    <p class="sub">Certificados se emiten al final de cada curso de forma gratuita.</p>
                </div>
            </div>

            <div class="cpc_features_item">
                <i class="fa fa-address-card"></i>
                <div class="text">
                    <h3 class="title">Interactivo</h3>
                    <p class="sub">Clases didácticas téorico-práctico.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<?php

get_template_part('template-parts/section', 'ponentes');

get_footer();
?>