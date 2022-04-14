navbar_hide_items = document.querySelectorAll(".cpc_navbar_hide_on_sticky");

var cpc_menu = $(".cpc_navbar").offset().top;

cpc_trigger_menu = $(".cpc_trigger_menu");
/**
 * Function to show or hide the menu
 * @param  {} cpt_display the class that will show
 * @param  {} is_display Hide or Sho
 */
function cpc_menu_function_display(cpt_display, is_display = false) {
  var text_display = is_display === true ? "block" : "none";
  $(cpt_display).attr("style", "display: " + text_display + " !important");
}

function cpc_menu_function_display_menu_items(
  tablet_screen,
  phone_screen_down,
  is_sticky = false
) {
  if (tablet_screen.matches) {
    cpc_menu_function_display(".cpc_navbar_hide_on_sticky");
    cpc_menu_function_display(".cpc_navbar_show_on_sticky", true);
    return;
  }

  if (phone_screen_down.matches) {
    cpc_menu_function_display(".cpc_navbar_hide_on_sticky");
    cpc_menu_function_display(".cpc_navbar_show_on_sticky", true);
    return;
  }

  if (is_sticky) {
    cpc_menu_function_display(".cpc_navbar_hide_on_sticky");
    cpc_menu_function_display(".cpc_navbar_show_on_sticky", true);
    cpc_menu_function_display(".cpc_logo_sticky", true);
    return;
  }

  cpc_menu_function_display(".cpc_navbar_hide_on_sticky", true);
  cpc_menu_function_display(".cpc_navbar_show_on_sticky");
  cpc_menu_function_display(".cpc_logo_sticky");
}
function onToggleNavbar(tablet_screen, phone_screen_down) {
  if ($(window).scrollTop() > cpc_trigger_menu.offset().top) {
    $(".cpc_navbar").addClass("cpc_navbar_sticky");
    cpc_menu_function_display_menu_items(
      tablet_screen,
      phone_screen_down,
      true
    );
  } else {
    $(".cpc_navbar").removeClass("cpc_navbar_sticky");
    cpc_menu_function_display_menu_items(tablet_screen, phone_screen_down);
  }
}

tablet_screen = window.matchMedia("(min-width: 992px) and (max-width: 1200px)");
phone_screen = window.matchMedia("(min-width: 992px)");
phone_screen_down = window.matchMedia("(max-width: 600px)");

onToggleNavbar(tablet_screen, phone_screen_down);
cpc_menu_function_display_menu_items(tablet_screen, phone_screen_down);

$(window).scroll(function () {
  onToggleNavbar(tablet_screen, phone_screen_down);
});

$(window).resize(function () {
  cpc_menu_function_display_menu_items(tablet_screen, phone_screen_down);

  if (phone_screen.matches) {
    $("#cpc_menu_phone_c").show();
  }
});

/*

ScrollTrigger.create({
    trigger: ".cpc_trigger_menu",
    start: "top top",
    end: 99999,
    onToggle: self => onToggleNavbar(),
    onUpdate: self => onToggleNavbar()
  });

/*

ScrollTrigger.create({
  start: "top -" + cpc_trigger_menu.offset().top + "px",
  end: 99999,
  toggleClass: {
    className: "cpc_navbar_sticky",
    targets: ".cpc_navbar",
  },
  
  onEnter: function() {
      console.log("hello");
  }
});

*/

$(document).ready(function () {
  header = $(".cpc_header");
  $(".cpc_near_menu_top").css("padding-top", header.outerHeight() + 30 + "px");
});

/*******
 *
 * ANIMATIONS
 *
 */

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

var cpc_menu_shop_open_ani = new TimelineLite({ paused: true });
cpc_menu_shop_btn = $("#cpc_menu_shop_btn");
cpc_menu_shop_content = $("#cpc_menu_shop_content");

cpc_menu_shop_open_ani.to(cpc_menu_shop_btn, { display: "block" });
cpc_menu_shop_open_ani.to(cpc_menu_shop_content, { display: "block" });
cpc_menu_shop_open_ani.from(cpc_menu_shop_content, {
  opacity: 0,
  duration: 0.4,
  ease: "power2.out",
});

function cpc_menu_shop_open() {
  switch (cpc_menu_shop_btn.attr("cpc-data-menu-state")) {
    case "open":
      cpc_menu_shop_open_ani.reverse();
      cpc_menu_shop_btn.attr("cpc-data-menu-state", "close");
      break;

    case "close":
      cpc_menu_shop_open_ani.play();
      cpc_menu_shop_btn.attr("cpc-data-menu-state", "open");
      break;

    default:
      cpc_menu_shop_open_ani.play();
      cpc_menu_shop_btn.attr("cpc-data-menu-state", "open");
      break;
  }
}

function cpc_email_btn_send() {
  form_data = $("#cpc_email_form").serialize();
  console.log(form_data);

  /*******************************
   $.ajax({
    url: url_ajax,
    type: "POST",
    data: form_data,

    beforeSend: function () {
      btn.attr("disabled", true);
      btn.html("<i class='fa fa-spinner fa-pulse fa-fw pe-2'></i> Añadiedo...");
    },
    success: function (data) {
      menu = $(data).find("#cpc_menu_shop_content_items");
      console.log(menu);

      $("#cpc_menu_shop_content_items").html(menu);

      btn.html("<i class='fa fa-check pe-2'></i> Añadido");
    },
    fail: function (xhr, textStatus, errorThrown) {
      btn.html("<i class='fa fa-exclamation-triangle pe-2'></i> Falló");
    },
  });
   */
}

$("form").on("submit", function (event) {
  if (!$(this).attr("cpc-data-form-type")) return;

  if (!$(this).attr("cpc-data-form-type") == "email") return;

  event.preventDefault();
  was_validated = true;
  var form = $(this);

  inputs = form.find("input");
  selects = form.find("select");
  textareas = form.find("textarea");

  data = {
    action: "cpc_email_send",
    content: {},
  };

  form_data = $(this).serializeArray();
  
  $.each(form_data, function (key, value) {
    console.log("Key: " + key + " Value: " + value);
    data["content"][value.name] = value.value;
    console.log(data);
  });

  console.log(form_data);
  console.log(data);
  console.log("before!-----------");

  $.each(inputs, function(key, input){

    data['content'] = cpc_form_extra_info(input, data['content']);

    if(input.value ===""){
      $(input).addClass("is-invalid");
      was_validated = false;
    }else{
      $(input).removeClass("is-invalid");
    }
  });

  $.each(selects, function(key, select){
    data['content'] = cpc_form_extra_info(select, data['content']);

    if(select.value ===""){
      $(select).addClass("is-invalid");
      was_validated = false;
    }else{
      $(select).removeClass("is-invalid");
    }
  });

  $.each(textareas, function(key, textarea){
    data['content'] = cpc_form_extra_info(textarea, data['content']);

    if(textarea.value ===""){
      $(textarea).addClass("is-invalid");
      was_validated = false;
    }else{
      $(textarea).removeClass("is-invalid");
    }
  });


  if(was_validated){
    $(this) .addClass('was-validated')
  }else{
    return;
  }

  base_url = $("#cpc_url_site_url").val();
  url_ajax = base_url + "/wp-admin/admin-ajax.php";

  btn = $("#cpc_email_form_btn");

  console.log(data);

  $.ajax({
    url: url_ajax,
    type: "POST",
    data: data,

    beforeSend: function () {
      cpc_form_btn_state(btn, "loading", "Enviando...");
    },
    success: function (data) {
      data = jQuery.parseJSON(data);
      console.log(data);

      if(data.error) {
        if(data.error.field) {
          //if its not null);
          if(data.error.field.length > 0) {
            form.removeClass('was-validated')

            $.each(data.error.field, function (key, value) {
              $('[name="'+value+'"]').addClass("is-invalid");
            });
          }

          cpc_form_btn_state(btn, "error", "Por favor inserte todos los datos requeridos");
          return;
        }

        cpc_form_btn_state(btn, "error", "Hubo un error");
      }else{
        cpc_form_btn_state(btn, "success", "Se ha enviado correctamente");
      }
    },
    fail: function (xhr, textStatus, errorThrown) {
      btn.html("<i class='fa fa-exclamation-triangle pe-2'></i> Falló");
    },
  });
});

function cpc_form_btn_state(btn, status, text = null){

  switch(status) {
    case "loading":
      btn.attr("disabled", true);
      btn.html("<i class='fa fa-spinner fa-pulse fa-fw pe-2'></i> "+ text);
      break;
    case "success":
      btn.html("<i class='fa fa-check pe-2'></i> "+ text);
      break;
    case "error":
      btn.attr("disabled", true);
      btn.html("<i class='fa fa-exclamation-triangle pe-2'></i> " + text);
      break;
  }
}

function cpc_form_extra_info(input, content){
  console.log("---------------------");
  console.log(input);
  console.log(content);

  var array = new Array();

  if( $(input).hasClass("cpc_extra_info") ){
    input_name = $(input).attr("name");

    $.each(content, function(key, value){
      if(key != input_name){
        array[key] = value;
      }
    });
  }else{
    array = content;
  }

  return array;
}