<div class="alert alert-primary" role="alert">
		<?php echo apply_filters('woocommerce_my_account_my_address_description', esc_html__('The following addresses will be used on the checkout page by default.', 'woocommerce')); ?>

	</div>
	
<div class="my-5 mx-auto" style="width: 600px; max-width: 100%;">
	<?php

	defined('ABSPATH') || exit;

	$customer_id = get_current_user_id();
	$customer = new WC_Customer($customer_id);

	?>

	
	<div class="cpc_billing_summary">
		<div class="header">
			<?php

			$get_addresses = apply_filters(
				'woocommerce_my_account_get_addresses',
				array(
					'billing' => __('Billing address', 'woocommerce'),
				),
				$customer_id
			);

			$address_name = "";
			$address_title = "";
			$address_content = null;

			foreach ($get_addresses as $name => $title) {
				$address_name = $name;
				$address_title = $title;
				$address = wc_get_account_formatted_address($name);
			}


			?>

			<a href="<?php echo esc_url(wc_get_endpoint_url('edit-address', $address_name)); ?>" class="edit"><?php echo $address_content ? esc_html__('Edit', 'woocommerce') : 'Editar '.$address_title; ?></a>
			<hr class="cpc_hr">
		</div>

		<div class="body">
			<div class="info row">
				<div class="col desc">Nombre:</div>
				<div class="col price"><?php echo $customer->get_billing_first_name(); ?></div>
			</div>

			<div class="info row">
				<div class="col desc">Apellido:</div>
				<div class="col price"><?php echo $customer->get_billing_last_name(); ?></div>
			</div>

			<?php

			if (!empty($customer->get_billing_company())) {
			?>
				<div class="info row">
					<div class="col desc">Empresa:</div>
					<div class="col price"><?php echo $customer->get_billing_company(); ?></div>
				</div>

			<?php
			}
			?>



			<div class="info row">
				<div class="col desc">Dirrección:</div>
				<div class="col price"><?php echo $customer->get_billing_address_1(); ?></div>
			</div>

			<div class="info row">
				<div class="col desc">País:</div>
				<div class="col price"><?php echo $customer->get_billing_country(); ?></div>
			</div>

			<div class="info row">
				<div class="col desc">Localidad / Ciudad :</div>
				<div class="col price"><?php echo $customer->get_billing_city(); ?></div>
			</div>

			<div class="info row">
				<div class="col desc">Región / Provincia:</div>
				<div class="col price"><?php echo $customer->get_billing_state(); ?></div>
			</div>

			<div class="info row">
				<div class="col desc">Email:</div>
				<div class="col price"><?php echo $customer->get_billing_email(); ?></div>
			</div>

			<div class="info row">
				<div class="col desc">Télefono:</div>
				<div class="col price"><?php echo $customer->get_billing_phone(); ?></div>
			</div>

		</div>

		<div class="col col-md-6">
		</div>
	</div>
</div>