var swiper = new Swiper(".cpc_slider_front_page_hero", {
  spaceBetween: 30,
  effect: "fade",
  loop: true,
  autoplay: {
    delay: 2500,
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
