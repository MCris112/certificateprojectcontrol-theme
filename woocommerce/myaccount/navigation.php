<?php
do_action('woocommerce_before_account_navigation');
?>

<nav class="navbar navbar-dark bg-primary">
	<div class="container">
		<ul class="nav justify-content-around w-100">
			<?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
				<?php
					
					if($endpoint == 'downloads'){
						continue;
					}
					
					?>
				<li class="nav-item <?php echo wc_get_account_menu_item_classes($endpoint); ?>">
					<a class="nav-link text-white" aria-current="page" href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>"><?php echo esc_html($label); ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</nav>


<?php do_action('woocommerce_after_account_navigation'); ?>