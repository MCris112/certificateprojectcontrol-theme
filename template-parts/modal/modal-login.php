<form class="woocommerce-form woocommerce-form-login login" method="post">
	<?php do_action('woocommerce_login_form_start'); ?>

	<img class="mb-4" src="<?php echo get_site_icon_url() ?>" alt="" width="72" height="72">

	<h1 class="h3 mb-3 fw-normal">¡Bienvenido!</h1>

	<div class="form-floating">
		<input type="text" class="form-control required" id="floatingInput" placeholder="Certificate | name@ejemplo.com" name="username" id="username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>">
		<label for="floatingInput">Email address</label>
	</div>
	<div class="form-floating">
		<input type="password" class="form-control required" id="floatingPassword" placeholder="Password" type="password" name="password" id="password" autocomplete="current-password">
		<label for="floatingPassword">Password</label>
	</div>

	<?php do_action('woocommerce_login_form'); ?>

	<div class="checkbox mb-3">
		<label  class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
			<input  class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox"  id="rememberme" value="forever"> Recuerdame
		</label>
	</div>
	<?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
	<button class="w-100 btn btn-lg btn-primary woocommerce-button button woocommerce-form-login__submit" type="submit" name="login" value="<?php esc_attr_e('Log in', 'woocommerce'); ?>">Iniciar sessión</button>
	<p class="woocommerce-LostPassword lost_password mt-3">
		<a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Lost your password?', 'woocommerce'); ?></a>
	</p>
	<?php do_action('woocommerce_login_form_end'); ?>

</form>