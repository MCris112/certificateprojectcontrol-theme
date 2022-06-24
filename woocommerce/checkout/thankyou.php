<?php

/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined('ABSPATH') || exit;
?>

<div class="container mt-5 mb-5">

	<?php
	if ($order) :

		do_action('woocommerce_before_thankyou', $order->get_id());
	?>

		<?php if ($order->has_status('failed')) : ?>

			<div class="alert alert-danger" role="alert">
				Su pedido tiene problemas en ser procesado, por favor verifique que haya colocado correcto los datos en el checkout o bien puede comunicarse con nostoros al <a href="https://wa.me/51922936632" class="alert-link">+51 922 936 632</a>
			</div>

		<?php else : ?>

			<div class="alert alert-primary" role="alert">
				Su pedido ha sido procesado correctamente, nos estaremos comunicando con usted.
			</div>


		<?php endif; ?>

		<div class="row gap-4 gap-lg-0">

			<div class="col-12 col-lg-6 pe-md-5 mb-5 mb-lg-0">
				<div class="cpc_billing_summary">
					<div class="header">
						<h2 class="cpc_subtitle">Detalles de la facturación</h2>
						<hr class="cpc_hr">
					</div>

					<div class="body">
						<div class="info row">
							<div class="col desc">Nombre:</div>
							<div class="col price"><?php echo $order->get_billing_first_name(); ?></div>
						</div>

						<div class="info row">
							<div class="col desc">Apellido:</div>
							<div class="col price"><?php echo $order->get_billing_last_name(); ?></div>
						</div>

						<?php

						if (!empty($order->get_billing_company())) {
						?>
							<div class="info row">
								<div class="col desc">Empresa:</div>
								<div class="col price"><?php echo $order->get_billing_company(); ?></div>
							</div>

						<?php
						}
						?>



						<div class="info row">
							<div class="col desc">Dirrección:</div>
							<div class="col price"><?php echo $order->get_billing_address_1(); ?></div>
						</div>

						<div class="info row">
							<div class="col desc">País:</div>
							<div class="col price"><?php echo $order->get_billing_country(); ?></div>
						</div>

						<div class="info row">
							<div class="col desc">Localidad / Ciudad :</div>
							<div class="col price"><?php echo $order->get_billing_city(); ?></div>
						</div>

						<div class="info row">
							<div class="col desc">Región / Provincia:</div>
							<div class="col price"><?php echo $order->get_billing_state(); ?></div>
						</div>

						<div class="info row">
							<div class="col desc">Email:</div>
							<div class="col price"><?php echo $order->get_billing_email(); ?></div>
						</div>

						<div class="info row">
							<div class="col desc">Télefono:</div>
							<div class="col price"><?php echo $order->get_billing_phone(); ?></div>
						</div>

						<hr>
						<div class="info row">
							<div class="col desc">Método de pago:</div>
							<div class="col price"><?php echo $order->get_payment_method_title(); ?></div>
						</div>

						<div class="info row">
							<div class="col desc">Número de pedido:</div>
							<div class="col price"><?php echo $order->get_id(); ?></div>
						</div>

						<div class="info row">
							<div class="col desc">Fecha:</div>
							<?php
							
							$date_modified = $order->get_date_modified();
							$date_paid = $order->get_date_paid();

							$date =  empty( $date_paid ) ? $date_modified : $date_paid->date('d/m/Y');
							
							?>
							<div class="col price"><?php echo $date; ?></div>

						</div>

					</div>
				</div>
			</div>

			<div class="col-12 col-lg-6">
				<div class="cpc_billing_summary">
					<div class="header">
						<h2 class="cpc_subtitle">Detalles del pedido</h2>
						<hr class="cpc_hr">
					</div>

					<div class="body">
						<div class="info row">
							<div class="col desc"></div>
							<div class="col price"></div>
						</div>



						<?php

						$args = array(
							'is_order' => true,
							'order' => $order
						);

						get_template_part('template-parts/cart/content', 'orders', $args); ?>

						<div class="info row">
							<div class="col desc">Subtotal:</div>
							<div class="col price"><?php echo'US'.get_woocommerce_currency_symbol() . $order->get_subtotal(); ?></div>
						</div>
						<div class="info total row">
							<div class="col desc">Total</div>
							<div class="col price"><?php echo'US'.get_woocommerce_currency_symbol() . $order->get_total(); ?></div>
						</div>
					</div>
				</div>

			</div>
		</div>
	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Thank you. Your order has been received.', 'woocommerce'), null); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
																										?></p>

	<?php endif; ?>

</div>