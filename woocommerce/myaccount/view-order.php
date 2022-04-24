<?php

defined('ABSPATH') || exit;

$notes = $order->get_customer_order_notes();
?>
<div class="my-5">

	<div class="alert alert-primary mb-5" role="alert">
		<?php
		printf(
			/* translators: 1: order number 2: order date 3: order status */
			esc_html__('Order #%1$s was placed on %2$s and is currently %3$s.', 'woocommerce'),
			'<mark class="order-number">' . $order->get_order_number() . '</mark>', // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			'<mark class="order-date">' . wc_format_datetime($order->get_date_created()) . '</mark>', // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			'<mark class="order-status">' . wc_get_order_status_name($order->get_status()) . '</mark>' // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		);
		?>
	</div>

	<div class="row gap-4 gap-lg-0">

		<div class="col-12 col-lg-6 pe-md-5">
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
						<div class="col price"><?php echo $order->get_date_paid()->date('d/m/Y'); ?></div>

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
						<div class="col price"><?php echo get_woocommerce_currency_symbol() . $order->get_subtotal(); ?></div>
					</div>
					<div class="info total row">
						<div class="col desc">Total</div>
						<div class="col price"><?php echo get_woocommerce_currency_symbol() . $order->get_total(); ?></div>
					</div>
				</div>
			</div>

		</div>
	</div>

</div>