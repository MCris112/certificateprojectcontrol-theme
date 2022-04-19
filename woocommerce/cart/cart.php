<?php

/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_cart'); ?>

<div class="container mt-5 mb-5">
	<div class="row">
		<div class="col-8 pe-md-5">
			<form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
				<?php do_action('woocommerce_before_cart_table'); ?>

				<?php get_template_part('template-parts/cart/content','orders')?>


				<?php do_action('woocommerce_after_cart_table'); ?>

				<?php do_action('woocommerce_cart_contents'); ?>
				<div class="row">
					<div class="col"></div>
					<div class="col d-flex justify-content-end">
						<?php do_action('woocommerce_cart_actions'); ?>

						<?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>

						<button id="cpc_shop_cart_btn_update" type="button" class="btn btn-primary btn-lg" onclick="cpc_shop_ajax_update_cart();">Actualizar carrito</button>
					</div>
				</div>
				<?php do_action('woocommerce_after_cart_contents'); ?>

				<?php do_action('woocommerce_after_cart_table'); ?>

			</form>
		</div>
		<div class="col-4">
			<?php do_action('woocommerce_before_cart_collaterals'); ?>

			<?php
			/**
			 * Cart collaterals hook.
			 *
			 * @hooked woocommerce_cross_sell_display
			 * @hooked woocommerce_cart_totals - 10
			 */
			do_action('woocommerce_cart_collaterals');
			?>
		</div>
	</div>
</div>
<?php do_action('woocommerce_after_cart'); ?>