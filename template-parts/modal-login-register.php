<!-- Modal -->

<?php

$can_register = 'yes' === get_option('woocommerce_enable_myaccount_registration');


?>
<div class="modal fade" id="cpc_modal_login" tabindex="-1" aria-labelledby="cpc_modal_login" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php do_action('woocommerce_before_customer_login_form'); ?>
            <div class="modal-header" id="customer_login">
                <?php

                if ($can_register) {
                ?>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="cpc-login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-controls="login" aria-selected="true">Iniciar sesión</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="cpc-register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab" aria-controls="register" aria-selected="false">Registrarse</button>
                        </li>

                    </ul>
                <?php
                }

                ?>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active text-center" id="login" role="tabpanel" aria-labelledby="login-tab">
                        <?php get_template_part('template-parts/modal/modal', 'login'); ?>
                    </div>
                    <?php

                    if ($can_register) {
                    ?>

                        <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                            <?php get_template_part('template-parts/modal/modal', 'register'); ?>
                        </div>

                    <?php
                    }

                    ?>
                </div>

                <p class="mt-2 mb-3 text-muted text-center">© 2017-2022</p>

            </div>
            <?php do_action('woocommerce_after_customer_login_form'); ?>
        </div>
    </div>
</div>