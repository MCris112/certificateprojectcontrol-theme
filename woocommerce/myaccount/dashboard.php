<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);
?>

<p class="fs-1 mt-5">Bienvenid@ <?php echo $current_user->display_name; ?>
<p>
<p class="fs-4 text-muted mb-3">¿No eres <?php echo $current_user->display_name; ?>? <a href="<?php echo wc_logout_url(); ?>" class="btn link">Cerrar Sesión</a></p>

<p class="fs-5">Desde el aquí de tu cuenta puedes:</p>
<hr>
</p>

<div class="d-grid" style="grid-template-columns: repeat(3, minmax(300px, 1fr)); gap: 1rem;">
	<a href="<?php echo wc_get_endpoint_url('orders'); ?>" class="btn btn-lg border border-3 d-flex justify-content-center align-items-center gap-2"><i class="fa fa-download" aria-hidden="true"></i> Ver tus pedidos Recientes</a>
	<a href="<?php echo wc_get_endpoint_url('edit-address'); ?>" class="btn btn-lg border border-3 d-flex justify-content-center align-items-center gap-2"><i class="fa fa-address-book" aria-hidden="true"></i> Gestionar tus direcciones de facturación</a>
	<a href="<?php echo wc_get_endpoint_url('edit-account'); ?>" class="btn btn-lg border border-3 d-flex justify-content-center align-items-center gap-2"><i class="fa fa-user" aria-hidden="true"></i> Editar tu cuenta</a>
</div>

<div class="cpc_title mt-5">
	Nuestros próximos inicios
	<hr class="cpc_hr">
</div>

<?php
$args = array(
	'all' => true,
	'near' => true,
	'modalidad' => 'sincronico',
	'class' => array(
		'section' => "mt-0 mb-5"
	)
);
get_template_part('template-parts/section', 'capacitacion-list', $args);
