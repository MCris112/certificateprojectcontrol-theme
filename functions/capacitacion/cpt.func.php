<?php

function cpc_capacitacion_change_asincronico($post_id){
    update_post_meta($post_id, "_cpc_capacitacion_field_modalidad", "asincronico");
}

require __DIR__ . '/cpt-ponentes.func.php';
require __DIR__ . '/cpt-modalidad.func.php';
require __DIR__ . '/cpt-meta-info.func.php';
require __DIR__ . '/cpt-sub-title.func.php';
//require __DIR__ . '/cpt-tab-info.func.php';
require __DIR__ . '/cpt-information.func.php';
require __DIR__ . '/cpt-temario.func.php';