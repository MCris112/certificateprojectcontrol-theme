<?php

/**
 * Template Name: Capacitación inHouse
 *
 * @package WordPress
 * @subpackage CertificateProjectControl
 * @since CertificateProjectControl 1.0
 */

get_header();

$args = array(
    'title' => get_the_title(),
    'subtitle' => 'Certificate Project Control',
);
get_template_part('template-parts/section', 'title', $args);
?>



<div class="container">
    <h2 class="cpc_title">¡Solicita tu cotización!</h2>
    <form action="">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
    </form>
</div>

<?php
get_footer();
?>