<?php

$is_checkout = is_checkout();

$order_conditional = isset($args) && array_key_exists('is_order', $args) && $args['is_order'];

?>


<div class="cpc_cpt_shop_card_container <?php if (is_checkout() || $order_conditional) {
                                            echo 'in_checkout';
                                        } ?> mb-5">
    <?php

    $products_ids = array();

    if ($order_conditional) {
        $order = $args['order'];

        foreach ($order->get_items() as $item_id => $item) {
            $product_id = $item->get_product_id();

            $products_ids[] = $product_id;

            $variation_id = $item->get_variation_id();
            $product = $item->get_product();
            $product_name = $item->get_name();
            $quantity = $item->get_quantity();
            $subtotal = $item->get_subtotal();
            $total = $item->get_total();
            $tax = $item->get_subtotal_tax();
            $taxclass = $item->get_tax_class();
            $taxstat = $item->get_tax_status();
            $allmeta = $item->get_meta_data();
            $somemeta = $item->get_meta('_whatever', true);
            $product_type = $item->get_type();

            $product = wc_get_product( $product_id );

    ?>

            <div id="cpc_thank_card_item_<?php echo $product_id; ?>" class="cpc_cpt_shop_card_item">
                <div class="img"><img src="<?php echo get_template_directory_uri() . "/assets/images/product/cart-img-item.jpg" ?>" alt=""></div>
                <div class="text">
                    <h3 class="title"><?php echo $product_name; ?></h3>
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
                            echo "Modalidad: Asincr??nica";
                        }

                        ?>
                    </p>
                    <div class="controls">

                        <div class="price">
                            <span>
                                <span class="price_unit" id="cpc_shop_card_item_<?php echo $product_id; ?>_quantity"><?php echo $quantity; ?>x -</span>
                                <span class="price_unit" id="cpc_shop_card_item_<?php echo $product_id; ?>_price_currency"><?php echo'US'.get_woocommerce_currency_symbol(); ?></span>
                                <span class="price_unit" id="cpc_shop_card_item_<?php echo $product_id; ?>_price_unit"><?php echo $product->get_price(); ?></span>
                            </span>
                            <p id="cpc_shop_card_item_<?php echo $product_id; ?>_price_total" class="price_totals">$<?php echo $total; ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }
    } else {

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
                                echo "Modalidad: Asincr??nica";
                            }

                            ?>


                        </p>
                        <div class="controls">


                            <?php


                            if (!$is_checkout) {
                            ?>

                                <div class="quantity">
                                    <div class="quantity_control input-group">
                                        <button onclick="cpc_shop_controls_quantity(<?php echo $product_id; ?>, false);" type="button" class="btn border border-3"><i class="fa fa-minus"></i></button>
                                        <input id="cpc_shop_card_item_<?php echo $product_id; ?>_quantity" type="number" class="form-control border border-0 text-center" value="<?php echo $cart_item['quantity']; ?>">
                                        <button onclick="cpc_shop_controls_quantity(<?php echo $product_id; ?>, true);" type="button" class="btn border border-3"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            <?php
                            }else{
                                ?>
                                <div class="quantity">
                                    <div class="quantity_control input-group">
                                        <input id="cpc_shop_card_item_<?php echo $product_id; ?>_quantity" type="number" class="form-control border border-0 text-center" value="<?php echo $cart_item['quantity']; ?>" disabled>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>

                            <div class="price">
                                <span>
                                    <span class="price_unit" id="cpc_shop_card_item_<?php echo $product_id; ?>_price_currency"><?php echo'US'.get_woocommerce_currency_symbol(); ?></span>
                                    <span class="price_unit" id="cpc_shop_card_item_<?php echo $product_id; ?>_price_unit"><?php echo  $_product->get_price(); ?></span>
                                </span>
                                <p <?php
                                    echo 'id="cpc_shop_card_item_' . $product_id . '_price_totals"';
                                    ?> class="price_total"><?php echo 'US'.get_woocommerce_currency_symbol() . $_product->get_price(); ?></p>
                            </div>

                            <?php

                            if (!$is_checkout) {
                            ?>

                                <div class="remove">
                                    <button type="button" class="btn" aria-label="Remove this item" onclick="cpc_shop_controls_remove(<?php echo $product_id; ?>);">
                                        <i class="fa fa-close"></i>
                                    </button>
                                </div>

                            <?php
                            }

                            ?>
                        </div>
                    </div>
                </div>

    <?php
            }
        }
    }

    ?>


    <input id="cpc_shop_controls_all_products" type="hidden" value="<?php echo json_encode($products_ids); ?>">
</div>