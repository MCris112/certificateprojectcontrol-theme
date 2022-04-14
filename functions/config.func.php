<?php


/**
 * Register Sliders menu page.
 */
function cpc_config_menu_register()
{
    add_menu_page(
        'Certificate Project Control',
        'CPC',
        'manage_options',
        'certificate-project-control',
        'cpc_config_menu_panel_main',
        'dashicons-admin-generic',
        2
    );
}

function cpc_config_menu_panel_main()
{
?>

    <div class="container-fluid mt-5">
        <h1 class="mb-3">Certificate Project Control</h1>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab" aria-controls="general" aria-selected="true">General</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                <?php

                echo '<form method="post" action="options.php">';

                settings_fields('cpc_settings_main'); // settings group name
                do_settings_sections('certificate-project-control'); // just a page slug
                submit_button();

                echo '</form>';

                ?>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
        </div>
    </div>

<?php
}

add_action('admin_menu', 'cpc_config_menu_register');


function cpc_config_menu_register_setting(){

	register_setting(
		'cpc_settings_main', // settings group name
		'cpc_settings_email_to', // option name
		'sanitize_text_field' // sanitization function
	);

	add_settings_section(
		'cpc_settings_main_section_main', // section ID
		'', // title (if needed)
		'', // callback function (if needed)
		'certificate-project-control' // page slug
	);

	add_settings_field(
		'cpc_settings_email_to',
		'Enviar email a:',
		'cpc_settings_field_email_to', // function which prints the field
		'certificate-project-control', // page slug
		'cpc_settings_main_section_main', // section ID
		array( 
			'label_for' => 'cpc_settings_email_to',
			'class' => 'misha-class', // for <tr> element
		)
	);

}

function cpc_settings_field_email_to(){

	$text = get_option( 'cpc_settings_email_to' );

	printf(
		'<input type="text" id="cpc_settings_email_to" name="cpc_settings_email_to" value="%s" />',
		esc_attr( $text )
	);

}

add_action( 'admin_init',  'cpc_config_menu_register_setting' );
