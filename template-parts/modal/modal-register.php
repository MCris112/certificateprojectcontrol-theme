<form method="post" class="woocommerce-form woocommerce-form-register register text-center" <?php do_action('woocommerce_register_form_tag'); ?>>

    <?php do_action('woocommerce_register_form_start'); ?>

    <img class="mb-4" src="<?php echo cpc_get_site_icon_url() ?>" alt="" width="72" height="72">

    <h1 class="h3 mb-3 fw-normal">¿Nuevo?</h1>

    <?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>
        <div class="form-floating">
            <input type="text" class="form-control" placeholder="Nombre de usuario" name="username" id="reg_username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>">
            <label for="reg_username">Nombre de usuario <span class="required">*</span></label></label>
        </div>
    <?php endif; ?>

    <div class="form-floating">
        <input type="email" class="form-control" id="reg_email" placeholder="name@example.com" name="email" autocomplete="email" value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>">
        <label for="reg_email">Correo electrónico <span class="required">*</span></label></label>
    </div>

    <?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>

        <div class="form-floating">
            <input type="password" class="form-control" id="reg_password" placeholder="Contraseña" name="password" name="password" autocomplete="new-password">
            <label for="reg_password">Contraseña <span class="required">*</span></label></label>
        </div>

    <?php else : ?>

        <p class="mt-2 mb-2"><?php esc_html_e('A link to set a new password will be sent to your email address.', 'woocommerce'); ?></p>

    <?php endif; ?>

    <div class="fs-5 mt-2 mb-2">
        <?php do_action('woocommerce_register_form'); ?>
    </div>

    <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
        
    <button class="w-100 btn btn-lg btn-primary" type="submit" name="register" value="<?php esc_attr_e('Register', 'woocommerce'); ?>"><?php esc_html_e('Register', 'woocommerce'); ?></button>

    <?php do_action('woocommerce_register_form_end'); ?>

</form>