<?php

defined('ABSPATH') || exit;

?>

<div class="container my-5">

	<?php
	do_action('woocommerce_before_lost_password_form');
	?>

	<form method="post" class="text-center mx-auto woocommerce-ResetPassword lost_reset_password" style="width: 600px; max-width: 100%;">

		<p class="mb-4"><?php echo apply_filters('woocommerce_lost_password_message', esc_html__('Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce')); ?></p><?php // @codingStandardsIgnoreLine 
																																																												?>

		<p class="w-100 woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
			<label for="user_login"><?php esc_html_e('Username or email', 'woocommerce'); ?></label>
			<input class="mt-3 p-3 form-control form-control-lg woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login" id="user_login" autocomplete="username" />
		</p>

		<div class="clear"></div>

		<?php do_action('woocommerce_lostpassword_form'); ?>

		<p class="woocommerce-form-row form-row">
			<input type="hidden" name="wc_reset_password" value="true" />
			<button type="submit" class="btn btn-lg btn-primary d-block w-100 text-white mt-3 woocommerce-Button button" value="<?php esc_attr_e('Reset password', 'woocommerce'); ?>"><?php esc_html_e('Reset password', 'woocommerce'); ?></button>
		</p>

		<?php wp_nonce_field('lost_password', 'woocommerce-lost-password-nonce'); ?>

	</form>
	<?php
	do_action('woocommerce_after_lost_password_form');
	?>

</div>