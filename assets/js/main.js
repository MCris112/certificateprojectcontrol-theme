var tl_menu_shop_items = new TimelineMax({paused: true});
tl_menu_shop_items.to("#cpc_menu_shop_btn_items_content", { display: "block" })
.to("#cpc_menu_shop_btn_items_content", {opacity: "1", duration: 0.3})

var tl_menu = new TimelineMax({paused: true});
tl_menu.to("#cpc_menu_nav_content", { display: "block" })
.to("#cpc_menu_nav_content", {opacity: "1", duration: 0.3})


function cpc_menu_shop_btn_items() {
  var content = $("#cpc_menu_shop_btn_items_content");

  content.toggleClass("active");

  if (content.hasClass("active")) {
    tl_menu_shop_items.play();
  } else {
    tl_menu_shop_items.reverse();
  }
}

function cpc_menu_toggle() {
  var content = $("#cpc_menu_nav_content");

  content.toggleClass("active");

  if (content.hasClass("active")) {
    tl_menu.play();
  } else {
    tl_menu.reverse();
  }
}

/*******
 *
 * ANIMATIONS
 *
 */

coupon_tl = new gsap.timeline();

coupon_content = $("#cpc_coupons_content");

coupon_duration = 0;

$.each( coupon_content.find(".cpc_coupons_item"), function(i, item) {
  coupon_duration = coupon_duration + 30;
});

console.log("durarion", coupon_duration);

coupon_move = screen.width;

coupon_move_base = screen.width;

if(screen.width < coupon_content.width()){
  coupon_move_base = coupon_content.width();
}
coupon_tl.set(coupon_content, {
  x: -coupon_move_base
})
coupon_tl.to(coupon_content, {
  duration: coupon_duration,
  x: coupon_move,
  ease: "none",
  repeat: -1
});


function cpc_manu_open_close() {
  bg = jQuery("#cpcp_menu_phone_bg");
  container = jQuery("#cpc_menu_phone_c");

  if (jQuery("#navbarSupportedContent").hasClass("cpc_menu_phone_c_active")) {
    jQuery("#navbarSupportedContent").removeClass("cpc_menu_phone_c_active");
    bg.css("opacity", "0");

    setTimeout(function () {
      container.hide();
    }, 900);
  } else {
    container.show();

    setTimeout(function () {
      bg.css("opacity", "1");
      jQuery("#navbarSupportedContent").addClass("cpc_menu_phone_c_active");
    }, 100);
  }
}

/**
 * SHOW MODAL OF LOGIN OR REGISTER
 */
$('*[data-bs-target="#cpc_modal_login"]').click(function () {
  var modal = $(this).attr("cpc-target");
  if (typeof attr !== "undefined" && attr !== fals) modal = "login";

  tab_select = null;

  switch (modal) {
    case "login":
      tab_select = $("#cpc-login-tab");
      login_init;
      break;

    case "register":
      tab_select = $("#cpc-register-tab");
      break;

    default:
      tab_select = $("#cpc-login-tab");
      break;
  }

  tabtrigger = new bootstrap.Tab(tab_select);
  tabtrigger.show();
});

function cpc_email_btn_send(from_id, btn) {
  var form = $("#" + from_id);
  if (!form.attr("cpc-data-form-type")) return;

  if (form.attr("cpc-data-form-type") != "email") return;

  event.preventDefault();

  data = cpc_form_get_values(form);
  capacitaicon_name = data.content.cpc_extra_info.cpc_cpt_name;

  was_validated = cpc_email_validate_data(form);

  if (was_validated) {
    form.addClass("was-validated");
  } else {
    return;
  }

  base_url = $("#cpc_url_site_url").val();
  url_ajax = base_url + "/wp-admin/admin-ajax.php";

  $.ajax({
    url: url_ajax,
    type: "POST",
    data: data,

    beforeSend: function () {
      cpc_form_btn_state(btn, "loading", "Enviando...");
    },
    success: function (data) {
      data = jQuery.parseJSON(data);

      if (data.error) {
        if (data.error.field) {
          //if its not null);
          if (data.error.field.length > 0) {
            form.removeClass("was-validated");

            $.each(data.error.field, function (key, value) {
              $('[name="' + value + '"]').addClass("is-invalid");
            });
          }

          cpc_form_btn_state(
            btn,
            "error",
            "Por favor inserte todos los datos requeridos"
          );
          return;
        }

        cpc_form_btn_state(btn, "error", "Hubo un error");
      } else {
        cpc_form_btn_state(btn, "success", "Se ha enviado correctamente");
      }
    },
    fail: function (xhr, textStatus, errorThrown) {
      btn.html("<i class='fa fa-exclamation-triangle pe-2'></i> Falló");
    },
  });

  text_content = data.content;
  $.each(text_content, function (key, value) {
    //value is array
    text_content[key] = encodeURIComponent(value);
  });

  whatsapp_text =
    "Nombre%3A%20" +
    text_content.cpc_name +
    "%0AApellido%3A%20" +
    text_content.cpc_last_name +
    "%20%0AEmial%3A%20" +
    text_content.cpc_email +
    "%20%0AN%C3%BAmber%3A%20972621508%0AP%C3%A1is%3A%20" +
    text_content.cpc_country +
    "%0ACapacitacion%3A%20" +
    encodeURIComponent(capacitaicon_name) +
    "%0A----------%0A%3A%20Mensaje:%0A%0A" +
    text_content.cpc_message;

  window.open("https://wa.me/51922936632/?text=" + whatsapp_text, "_blank");
}

function cpc_email_validate_data(form, data) {
  inputs = form.find("input");
  selects = form.find("select");
  textareas = form.find("textarea");
  was_validated = true;

  $.each(inputs, function (key, input) {
    if (input.value === "") {
      $(input).addClass("is-invalid");
      was_validated = false;
    } else {
      $(input).removeClass("is-invalid");
    }
  });

  $.each(selects, function (key, select) {
    if (select.value === "") {
      $(select).addClass("is-invalid");
      was_validated = false;
    } else {
      $(select).removeClass("is-invalid");
    }
  });

  $.each(textareas, function (key, textarea) {
    if (textarea.value === "") {
      $(textarea).addClass("is-invalid");
      was_validated = false;
    } else {
      $(textarea).removeClass("is-invalid");
    }
  });

  return was_validated;
}

function cpc_form_get_values(form) {
  content = {};

  form_data = form.serializeArray();

  $.each(form_data, function (key, information) {
    var key_sub_string = information.name.substring(
      information.name.indexOf("[") + 1,
      information.name.lastIndexOf("]")
    );

    if (key_sub_string == "") {
      content[information.name] = information.value;
    } else {
      key_name = information.name.split("[")[0];

      if (content[key_name]) {
        content[key_name][key_sub_string] = information.value;
      } else {
        content[key_name] = {};
        content[key_name][key_sub_string] = information.value;
      }
    }
  });

  return {
    action: "cpc_email_send",
    content: content,
  };
}

function cpc_form_btn_state(btn, status, text = null) {
  switch (status) {
    case "loading":
      btn.attr("disabled", true);
      btn.html("<i class='fa fa-spinner fa-pulse fa-fw pe-2'></i> " + text);
      break;
    case "success":
      btn.html("<i class='fa fa-check pe-2'></i> " + text);
      break;
    case "error":
      btn.attr("disabled", true);
      btn.html("<i class='fa fa-exclamation-triangle pe-2'></i> " + text);
      break;
  }
}
