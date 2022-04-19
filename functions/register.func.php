<?php
function cpc_register_panel($wp_customize){
    $wp_customize->add_panel('cpc_panel', array(
        'title' => 'Certificate Project Control',
        'description' => 'Panel de configuración de Certificate Project Control',
        'priority' => 1,
    ));

    $wp_customize->add_section('cpc_section_front_page', array(
        'title' => 'Front Page',
        'description' => 'Configuración del front page',
        'panel' => 'cpc_panel',
        'priority' => 1,
    ));

    $wp_customize->add_setting('cpc_front_page_link_about_us');

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'cpc_front_page_contrrol_link_about_us',
            array(
                'label' => 'Link Sobre Nosotros',
                'section' => 'cpc_section_front_page',
                'settings' => 'cpc_front_page_link_about_us',
                'type' => 'dropdown-pages',
            )
        )
    );
}

add_action('customize_register', 'cpc_register_panel');




require __DIR__ . '/ponentes.func.php';
require __DIR__ . '/admin.func.php';
require __DIR__ . '/ajax.func.php';
//require __DIR__ . '/functions/front-page.func.php';
require __DIR__ . '/config.func.php';


//require __DIR__ . '/widgets/register_widgets.php';
require __DIR__ . '/capacitacion/cpt.func.php';

require __DIR__ . '/emails/email.func.php';
require __DIR__ . '/shop.func.php';