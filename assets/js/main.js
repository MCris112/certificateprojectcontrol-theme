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
      tab_select = $("#cpc-login-tab");login_init
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

var cpc_menu_shop_open_ani =  new TimelineLite({paused:true});
cpc_menu_shop_btn = $("#cpc_menu_shop_btn");
cpc_menu_shop_content = $("#cpc_menu_shop_content");

cpc_menu_shop_open_ani.to(cpc_menu_shop_btn, {display: 'block'});
cpc_menu_shop_open_ani.to(cpc_menu_shop_content, {display: 'block'});
cpc_menu_shop_open_ani.from(cpc_menu_shop_content, {opacity: 0, duration: .4, ease: "power2.out"});

function cpc_menu_shop_open(){
  switch( cpc_menu_shop_btn.attr("cpc-data-menu-state") ){
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