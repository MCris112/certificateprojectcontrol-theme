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

				<div class="cpc_cpt_shop_card_container mb-5">
					<?php

					$products_ids = array();

					foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
						$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
						$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
						$cart_delete_url = wc_get_cart_remove_url($cart_item['product_id']);

						if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
							$products_ids[] = $product_id;
							$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
					?>
							<div id="cpc_shop_card_item_<?php echo $product_id; ?>" class="cpc_cpt_shop_card_item">
								<div class="img"><img src="<?php echo get_template_directory_uri() . "/assets/images/product/cart-img-item.jpg" ?>" alt=""></div>
								<div class="text">
									<h3 class="title"><?php echo $_product->get_name(); ?></h3>
									<?php do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key); ?>
									<p class="sub">
										<?php

										$modalidad = get_post_meta($product_id, '_cpc_capacitacion_field_modalidad', true);

										if ($modalidad != "asincronico") {
											$fechas = get_post_meta($product_id, '_cpc_capacitacion_field_modalidad_fechas', true);
										?>
											Inicio de clases:

										<?php

											if (empty($fechas)) {
												echo 'Sin definir';
											} else {
												$fechas = json_decode($fechas, true);
												global $locale;
												$date = date_i18n('d \d\e F', strtotime($fechas[0]));
												echo $date;
											}
										} else {
											echo "Modalidad: Asincrónica";
										}

										?>


									</p>
									<div class="controls">
										<div class="quantity">
											<div class="quantity_control input-group">
												<button onclick="cpc_shop_controls_quantity(<?php echo $product_id; ?>, false);" type="button" class="btn border border-3"><i class="fa fa-minus"></i></button>
												<input id="cpc_shop_card_item_<?php echo $product_id; ?>_quantity" type="number" class="form-control border border-0 text-center" value="<?php echo $cart_item['quantity']; ?>">
												<button onclick="cpc_shop_controls_quantity(<?php echo $product_id; ?>, true);" type="button" class="btn border border-3"><i class="fa fa-plus"></i></button>
											</div>
										</div>

										<div class="price">
											<span class="price_unit" id="cpc_shop_card_item_<?php echo $product_id; ?>_price_currency"><?php echo get_woocommerce_currency_symbol(); ?></span>
											<span class="price_unit" id="cpc_shop_card_item_<?php echo $product_id; ?>_price_unit"><?php echo  $_product->get_price(); ?></span>
											<p id="cpc_shop_card_item_<?php echo $product_id; ?>_price_totals" class="price_total"><?php echo  get_woocommerce_currency_symbol() . $_product->get_price(); ?></p>
										</div>

										<div class="remove">
											<button type="button" class="btn" aria-label="Remove this item" onclick="cpc_shop_controls_remove(<?php echo $product_id; ?>);">
												<i class="fa fa-close"></i>
											</button>
										</div>
									</div>
								</div>
							</div>

					<?php
						}
					}
					?>

					<input id="cpc_shop_controls_all_products" type="hidden" value="<?php echo json_encode($products_ids); ?>">
				</div>



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

<?php


function prefix_update_existing_cart_item_meta()
{
	foreach( WC()->cart->get_cart() as $cart_item_key => $cart_item ) { 
		$product = $cart_item['data']; // Get an instance of the WC_Product object
		echo "<b>".$product->get_title().'</b>  <br> Quantity: '.$cart_item['quantity'].'<br>'; 
		echo "  Price: ".$product->get_price()."<br>";
		WC()->cart->set_quantity( $cart_item_key, 2 );
	} 
}

prefix_update_existing_cart_item_meta();
