//add prodcut in ajax

function cpc_add_capacitacion_to_cart(btn, add_to_cart_url) {
  $.ajax({
    url: add_to_cart_url,
    type: "POST",

    beforeSend: function () {
      btn.attr("disabled", true);
      btn.html("<i class='fa fa-spinner fa-pulse fa-fw pe-2'></i> Añadiedo...");
    },
    success: function (data) {
      menu = $(data).find("#cpc_menu_shop_content_items");
      subtotal = $(data).find("#cpc_menu_shop_content_subtotal");
      

      $("#cpc_menu_shop_content_items").html(menu);
      $("#cpc_menu_shop_content_subtotal").html(subtotal);

      btn.html("<i class='fa fa-check pe-2'></i> Añadido");
      cpc_shop_cart_update_badge();
    },
    fail: function (xhr, textStatus, errorThrown) {
      btn.html("<i class='fa fa-exclamation-triangle pe-2'></i> Falló");
    },
  });
}

function cpc_remove_capacitacion_to_cart(btn) {
  site_url = $("#cpc_url_site_url").val();
  url = site_url + "/wp-admin/admin-ajax.php";
  data = {
    product_id: btn.attr("cpc-data-cpt-id"),
    action: "cpc_remove_cpt_cart",
  };
  $.ajax({
    url: url,
    type: "POST",
    data: data,

    beforeSend: function () {
      btn.attr("disabled", true);
      btn.html("<i class='fa fa-spinner fa-pulse fa-fw pe-2'></i>");
    },
    success: function (data) {
        data = JSON.parse(data);
      cpc_id = btn.attr("cpc-data-cpt-id");

      if (data['status'] == "success") {
        btn.html("<i class='fa fa-check pe-2'></i>");
        btn.attr("disabled", false);
        item = $("#cpc_capacitacion_cart_item_"+cpc_id);
            btn.html("<i class='fa fa-check pe-2'></i>");
            item = $("#cpc_capacitacion_cart_item_"+cpc_id);
            gsap.to(item, {opacity: 0, duration: .4, ease: "power2.out", onComplete: function(){item.remove(); cpc_shop_cart_update_badge(); }});
      }

      if (data['status'] == "not_found") {
        btn.html("<i class='fa fa-exclamation-triangle pe-2'></i>");
      }
    },
    fail: function (xhr, textStatus, errorThrown) {
        console.log("fail");
        console.log(errorThrown);
      btn.html("<i class='fa fa-exclamation-triangle pe-2'></i>");
    },
    error: function (e) {
        console.log("error");
        console.log(e);
      btn.html("<i class='fa fa-exclamation-triangle pe-2'></i>");
    },
  });
}

function cpc_shop_cart_update_badge(){
    badge = $("#cpc_menu_shop_btn_badge");

    menu = $("#cpc_menu_shop_content_items");

    menu_items = menu.find(".cpc_menu_shop_content_item");

    product_totals = menu_items.length;

    if(product_totals == 0){
      badge.hide();
      return;
    }

    badge.show();
    badge.find(".text").html(product_totals);

}

cpc_shop_cart_update_badge();