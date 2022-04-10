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
		<div class="col-8">
			<form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
				<?php do_action('woocommerce_before_cart_table'); ?>


				<?php
				foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
					$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
					$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
					$cart_delete_url = wc_get_cart_remove_url($cart_item['product_id']);

					if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
						$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
						$fechas = get_post_meta($cart_item['product_id'], '_cpc_capacitacion_field_modalidad_fechas', true);

				?>
						<div class="cpc_cpt_shop_card card mb-3">
							<div class="row g-0">
								<div class="col-md-4">
									<img src="<?php echo get_template_directory_uri()."/assets/images/product/cart-img-item.jpg"?>" class="img-fluid rounded-start" alt="...">
								</div>
								<div class="col-md-8">
									<div class="card-body">
										<?php
										if (!$product_permalink) {
											echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
										} else {
											echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a class="card-title fs-4" href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
										}

										do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);
										?>

										<p class="card-text mb-3"><small class="text-muted">
												Inicio de clases:

												<?php

												if (empty($fechas)) {
													echo 'Sin definir';
												} else {
													global $locale;
													$date = date_i18n('d \d\e F', strtotime($fechas[0]));
													echo $date;
												}
												?>
											</small></p>
										<div class="row">
											<div class="col">
												<div class="d-flex align-items-center">
													<button type="button" onclick="cpc_remove_capacitacion_to_cart($(this), '<?php echo $cart_delete_url; ?>');" class="btn btn-danger" cpc-data-cpt-id="<?php echo $cart_item['product_id']; ?>"><i class="fa fa-trash-o fa-lg"></i></button>
													<?php
													if ($_product->is_sold_individually()) {
														$product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
													} else {
														$product_quantity = woocommerce_quantity_input(
															array(
																'input_name'   => "cart[{$cart_item_key}][qty]",
																'input_value'  => $cart_item['quantity'],
																'max_value'    => $_product->get_max_purchase_quantity(),
																'min_value'    => '0',
																'product_name' => $_product->get_name(),
															),
															$_product,
															false
														);
													}

													echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
													?>

													<p class="ps-2 text-muted">
														<?php
														echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
														?>
													</p>
												</div>
											</div>
											<div class="col d-flex justify-content-end">
												<?php
												echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
				<?php
					}
				}
				?>


				<?php do_action('woocommerce_after_cart_table'); ?>

				<?php do_action('woocommerce_cart_contents'); ?>
				<div class="actions d-flex justify-content-end">
					

					<button type="submit" class="button" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>"><?php esc_html_e('Update cart', 'woocommerce'); ?></button>

					<?php do_action('woocommerce_cart_actions'); ?>

					<?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
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