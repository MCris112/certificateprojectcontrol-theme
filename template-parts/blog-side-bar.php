<div class="col-md-4">
    <div class="position-sticky" style="top: 2rem;">
        <div class="p-4 mb-3 bg-light rounded">
            <h4 class="fst-italic">Sobre Nosotros</h4>
            <p class="mb-0">Estamos firmemente convencidos que las buenas prácticas corporativas deben regular toda actividad en los negocios, y que actuar en todo momento y situación con integridad, transparencia y una cultura ética, representan el impulso necesario para generar confianza y vínculos laborales estratégicos con nuestros clientes, colaboradores, y entornoen general donde realizamos nuestras operaciones.</p>
        </div>

        <div class="p-4">
            <h4 class="fst-italic">Archives</h4>
            <ol class="list-unstyled mb-0">
                <?php

                $archives = wp_get_archives();
                ?>
            </ol>
        </div>

        <div class="p-4">
            <h4 class="fst-italic">Nuestras Redes</h4>
            <ol class="list-unstyled">
                <?php
                cpc_menu_get_social_links(
                    array(
                        'div' => 'w-100 mt-2',
                        'ul' => 'header_icons flex-column justify-content-around w-100 align-items-start',
                        'a' => 'd-flex align-items-center gap-1 text-decoration-none',
                    ),

                    array(
                        'label' => true
                    )
                );
                ?>
            </ol>
        </div>
    </div>
</div>