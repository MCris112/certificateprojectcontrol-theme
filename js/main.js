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

function cpc_menu_function_display_menu_items(tablet_screen, is_sticky = false) {
  if (tablet_screen.matches) {
    cpc_menu_function_display(".cpc_navbar_hide_on_sticky");
    cpc_menu_function_display(".cpc_navbar_show_on_sticky",true);
    return;
  }

  if(is_sticky) {
    cpc_menu_function_display(".cpc_navbar_hide_on_sticky");
    cpc_menu_function_display(".cpc_navbar_show_on_sticky", true);
    cpc_menu_function_display(".cpc_logo_sticky", true);
    return;
  }

  cpc_menu_function_display(".cpc_navbar_hide_on_sticky", true);
  cpc_menu_function_display(".cpc_navbar_show_on_sticky");
  cpc_menu_function_display(".cpc_logo_sticky");

}
function onToggleNavbar(tablet_screen) {
  if ($(window).scrollTop() > cpc_trigger_menu.offset().top) {
    $(".cpc_navbar").addClass("cpc_navbar_sticky");
    cpc_menu_function_display_menu_items(tablet_screen, true);
  } else {
    $(".cpc_navbar").removeClass("cpc_navbar_sticky");
    cpc_menu_function_display_menu_items(tablet_screen);
  }
}

tablet_screen = window.matchMedia("(min-width: 992px) and (max-width: 1200px)");

onToggleNavbar(tablet_screen);
cpc_menu_function_display_menu_items(tablet_screen);

$(window).scroll(function () {
  onToggleNavbar(tablet_screen);
});

$( window ).resize(function () {
  cpc_menu_function_display_menu_items(tablet_screen);
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
