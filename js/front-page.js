var swiper_front_page = new Swiper(".cpc_slider_front_page_hero", {
  spaceBetween: 30,
  effect: "fade",
  loop: true,
  autoplay: {
    delay: 9000,
    disableOnInteraction: false,
  },

  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
});

/*

      autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
*/
        
/*******
 * 
 * ANIMATIONS
 * 
 */

function cpc_front_page_ani_slider(ani_front_page, restart = false){
 
  if(restart){
    ani_front_page.progress(0);
    return;
  }

  ani_front_page.from(".cpc_hero_title", {y:100, duration: 1, opacity: 0});
  ani_front_page.from(".cpc_hero_subtitle", {y:100, duration: 1, opacity: 0, delay:1});
  ani_front_page.from(".cpc_hero_btn", {y:100, duration: 1, opacity: 0, delay:.3});
}
var ani_front_page = gsap.timeline();


swiper_front_page.on('slideChange', function () {
  cpc_front_page_ani_slider(ani_front_page, true);
});

$(document).ready(function(){
  cpc_front_page_ani_slider(ani_front_page);
});