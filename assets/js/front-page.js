// var swiper_front_page = new Swiper(".cpc_slider_front_page_hero", {
//   spaceBetween: 30,
//   effect: "fade",
//   loop: true,
//   autoplay: {
//     delay: 9000,
//     disableOnInteraction: false,
//   },

//   navigation: {
//     nextEl: ".swiper-button-next",
//     prevEl: ".swiper-button-prev",
//   },
//   pagination: {
//     el: ".swiper-pagination",
//     clickable: true,
//   },
// });

var swiper_front_page = new Swiper(".cpc_slider_front_page_hero", {
  grabCursor: false,
  effect: "creative",
  
  creativeEffect: {
    prev: {
      shadow: true,
      translate: [0, 0, -400],
    },
    next: {
      translate: ["100%", 0, 0],
    },
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

slidesAni = {};

function cpc_front_page_ani_slider(slide, index){

  if(slidesAni[index]){
    tl = slidesAni[index];
    tl.progress(0);
    return;
  }

  tl = gsap.timeline();

  person = $(slide).find(".slider_person");
  txt = $(slide).find(".slide_txt");
  console.log("person", person);

  tl.to(person, {y: 0, duration: 1, opacity: 1});
  tl.to(txt, {x: 0, duration: 1, opacity: 1});
  
  slidesAni[index] = tl;
}

swiper_front_page.on('activeIndexChange', function (swiper) {
  slide = swiper_front_page.slides[swiper_front_page.activeIndex];

  cpc_front_page_ani_slider(slide, swiper.activeIndex);
 
});

$(document).ready(function(){
  slide = swiper_front_page.slides[swiper_front_page.activeIndex];

  console.log("Current slide", slide)
  cpc_front_page_ani_slider(slide, swiper_front_page.activeIndex);
});