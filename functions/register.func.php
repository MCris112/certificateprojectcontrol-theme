<?php
function cpc_register_panel($wp_customize){
    $wp_customize->add_panel('cpc_panel', array(
        'title' => 'Certificate Project Control',
        'description' => 'Panel de configuración de Certificate Project Control',
        'priority' => 1,
    ));

    $wp_customize->add_section('cpc_section_cpt', array(
        'title' => 'Componentes',
        'description' => 'Configuración del front page',
        'panel' => 'cpc_panel',
        'priority' => 1,
    ));

    $wp_customize->add_setting('cpc_cpt_newsletter_link_conditions_and_terms');

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'cpc_cpt_control_newsletter_link_conditions_and_terms',
            array(
                'label' => 'Link Términos y condiciones',
                'section' => 'cpc_section_cpt',
                'settings' => 'cpc_cpt_newsletter_link_conditions_and_terms',
                'type' => 'dropdown-pages',
            )
        )
    );

    $wp_customize->add_section('cpc_section_front_page', array(
        'title' => 'Front Page',
        'description' => 'Configuración del front page',
        'panel' => 'cpc_panel',
        'priority' => 1,
    ));

    $wp_customize->add_setting('cpc_front_page_link_proximos_inicios');

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'cpc_front_page_contrrol_proximos_inicios',
            array(
                'label' => 'Link Próximos Inicios',
                'section' => 'cpc_section_front_page',
                'settings' => 'cpc_front_page_link_proximos_inicios',
                'type' => 'dropdown-pages',
            )
        )
    );

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

    $wp_customize->add_section('cpc_section_shop', array(
        'title' => 'Tienda',
        'description' => 'Configuración de la tienda',
        'panel' => 'cpc_panel',
        'priority' => 1,
    ));

    $wp_customize->add_section('cpc_section_shop_cuenta', array(
        'title' => 'Cuenta',
        'description' => 'Configuración para las cuentas',
        'panel' => 'cpc_panel',
        'section' => 'cpc_section_shop',
        'priority' => 1,
    ));

    $wp_customize->add_setting('cpc_section_shop_cuenta_link_login');

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'cpc_section_shop_cuenta_link_login_control',
            array(
                'label' => 'Login Page Link',
                'section' => 'cpc_section_shop_cuenta',
                'settings' => 'cpc_section_shop_cuenta_link_login',
                'type' => 'dropdown-pages',
            )
        )
    );


    $wp_customize->add_setting('cpc_section_shop_cuenta_link_register');

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'cpc_section_shop_cuenta_link_register_control',
            array(
                'label' => 'Register Page Link',
                'section' => 'cpc_section_shop_cuenta',
                'settings' => 'cpc_section_shop_cuenta_link_register',
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