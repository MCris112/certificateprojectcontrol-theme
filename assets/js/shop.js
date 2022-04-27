function cpc_shop_controls_get_all_products() {
  products_ids = $("#cpc_shop_controls_all_products");

  try {
    cpc_products = JSON.parse(products_ids.val());
  } catch (e) {
    cpc_products = [];
  }

  return cpc_products;
}

function cpc_shop_controls_remove_product_array(product_id) {
  products_id = cpc_shop_controls_get_all_products();

  if (products_id.includes(product_id)) {
    products_id.splice(products_id.indexOf(product_id), 1);
  }

  $("#cpc_shop_controls_all_products").val(JSON.stringify(products_id));

  if(products_id.length == 0){
    location.reload();
  }
}

products_ids = cpc_shop_controls_get_all_products();
cpc_products = cpc_shop_controls_get_all_products();

try {
  cpc_products = JSON.parse(products_ids.val());
} catch (e) {
  cpc_products = [];
}

function cpc_shop_controls_quantity(product_id, do_add) {
  input_quantity = $("#cpc_shop_card_item_" + product_id + "_quantity");
  product_price_unit = $("#cpc_shop_card_item_" + product_id + "_price_unit");
  product_price_currency = $(
    "#cpc_shop_card_item_" + product_id + "_price_currency"
  );
  product_price_total = $(
    "#cpc_shop_card_item_" + product_id + "_price_totals"
  );

  price_unit = parseFloat(product_price_unit.text());
  price_quantity = parseFloat(input_quantity.val());

  if (do_add) {
    input_quantity.val(parseInt(input_quantity.val()) + 1);
  } else {
    if (parseInt(input_quantity.val()) > 1) {
      input_quantity.val(parseInt(input_quantity.val()) - 1);
    }
  }

  cpc_shop_controls_set_value(product_id);
  cpc_shop_controls_update_cart_btn_tate(true);
}

function cpc_shop_controls_remove(product_id, is_confirmed = false) {
  if (is_confirmed) {
    btn = $("#cpc_shop_cart_btn_update");
    cpc_shop_controls_update_cart_btn_tate(false);

    url = $("#cpc_url_site_url").val();

    ajax_url = url + "/wp-admin/admin-ajax.php";

    data = {
      action: "cpc_shop_delete_item",
      product_id: product_id,
    };

    $.ajax({
      url: ajax_url,
      type: "POST",
      data: data,
      success: function (response) {
        try {
          data = JSON.parse(response);

          if (!data["error"]) {
            $("#cpc_shop_modal_delete_item_" + product_id).remove();
            $("#cpc_shop_card_item_" + product_id).remove();
            cpc_shop_controls_remove_product_array(product_id);
          }
        } catch (e) {
          cpc_form_btn_state(btn, "error", "Hubo un error con el carrito");
        }

        cpc_shop_update_cart_totals();
      },

      error: function (response) {
        cpc_form_btn_state(btn, "error", "Hubo un error con el carrito");
      },
    });

    return;
  }

  cpc_shop_controls_remove_modal(product_id);
}

function cpc_shop_controls_remove_modal(product_id) {
  modal_html =
    `<div class="modal fade" id="cpc_shop_modal_delete_item_` +
    product_id +
    `" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">¿Está seguro de eliminar?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        Una vez eliminado el producto no podrá recuperarlo a menos que lo agregue nuevamente.
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-primary" style="opacity: 0.8;" data-bs-dismiss="modal">Cancelar</button>
                        <button onclick="cpc_shop_controls_remove(` +
    product_id +
    `, true);" type="button" class="btn btn-primary" data-bs-dismiss="modal"data-bs-dismiss="modal">Eliminar de todas formas</button>
                        </div>
                    </div>
                    </div>
                </div>`;
  $("body").append(modal_html);

  var myModal = new bootstrap.Modal(
    document.getElementById("cpc_shop_modal_delete_item_" + product_id)
  );
  myModal.show();
}

function cpc_shop_controls_set_value(product_id) {
  input_quantity = $("#cpc_shop_card_item_" + product_id + "_quantity");
  product_price_unit = $("#cpc_shop_card_item_" + product_id + "_price_unit");
  product_price_currency = $(
    "#cpc_shop_card_item_" + product_id + "_price_currency"
  );
  product_price_total = $(
    "#cpc_shop_card_item_" + product_id + "_price_totals"
  );

  price_unit = parseFloat(product_price_unit.text());
  price_quantity = parseFloat(input_quantity.val());

  total_price = (price_quantity * price_unit).toFixed(2);
  product_price_total.text(product_price_currency.text() + total_price);
}

function cpc_shop_controls_update_cart_btn_tate(is_active) {
  btn = $("#cpc_shop_cart_btn_update");

  if (is_active) {
    btn.removeAttr("disabled");
  } else {
    btn.attr("disabled", "disabled");
  }

  return btn;
}

cpc_shop_controls_update_cart_btn_tate(false);

$.each(cpc_products, function (index, product) {
  cpc_shop_controls_set_value(product);
});

function cpc_shop_ajax_update_cart() {
  btn = cpc_shop_controls_update_cart_btn_tate(false);
  cpc_form_btn_state(btn, "loading", "Actualizando carrito");

  url = $("#cpc_url_site_url").val();
  console.log(url);

  ajax_url = url + "/wp-admin/admin-ajax.php";

  data = {
    action: "cpc_shop_set_new_quantity",
    products: {},
  };

  $.each(cpc_products, function (index, product) {
    data["products"][index] = {
      id: product,
      quantity: $("#cpc_shop_card_item_" + product + "_quantity").val(),
    };
  });

  console.log(data);
  console.log(ajax_url);

  $.ajax({
    url: ajax_url,
    type: "POST",
    data: data,

    success: function (data) {
      try {
        data = JSON.parse(data);

        if (!data["error"]) {
          cpc_form_btn_state(btn, "success", "Se ha actualizado el carrito");
        } else {
          cpc_form_btn_state(btn, "error", "Ha ocurrido un error");
        }
      } catch (e) {
        cpc_form_btn_state(btn, "error", "Hubo un error con el carrito");
      }
      cpc_shop_update_cart_totals();
    },
    error: function (response) {
      console.log(response);
      cpc_form_btn_state(btn, "error", "Hubo un error con el carrito");
    },
  });
}

function cpc_shop_update_cart_totals() {
  product_price_currency = "";

  total_price = 0;

  $.each(cpc_products, function (index, product) {
    product_price_currency = $(
      "#cpc_shop_card_item_" + product + "_price_currency"
    ).text();

    input_quantity = $("#cpc_shop_card_item_" + product + "_quantity");
    product_price_unit = $("#cpc_shop_card_item_" + product + "_price_unit");
    price_unit = parseFloat(product_price_unit.text());
    price_quantity = parseFloat(input_quantity.val());

    total_price += price_quantity * price_unit;
  });

  base_html =
    '<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">' +
    product_price_currency +
    "</span>" +
    total_price +
    "</bdi></span>";
  $(".cpc_totals_set").each(function () {
    $(this).html(base_html);
  });
}
