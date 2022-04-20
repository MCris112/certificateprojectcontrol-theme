<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

$login_page = get_theme_mod('cpc_section_shop_cuenta_link_login');

if(empty($login_page) || $login_page == '') {
	$login_page = site_url();
}

header('Location: '.$login_page);

?>
