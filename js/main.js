(function ($) {

    "use strict";




        // Parallax Js
        function initParallax() {
          $('#home').parallax("100%", 0.3);
          $('#about').parallax("20%", 0.3);
          $('#courses').parallax("40%", 0.3);
          $('#work').parallax("60%", 0.3);
          $('#count').parallax("80%", 0.3);
          }
        initParallax(); 


        // WOW Animation js
        new WOW({ mobile: false }).init();

})(jQuery);
var swiperc = new Swiper(".coursesSwiper", {
        effect: "cube",
        grabCursor: true,
        autoplay: true,
        loop: true,
        cubeEffect: {
          shadow: true,
          slideShadows: true,
          shadowOffset: 20,
          shadowScale: 0.94,
        },
    }
);
var swipert = new Swiper(".testimonialSwiper", {
        slidesPerView: 1,
        centeredSlides: false,
        slidesPerGroupSkip: 1,
        grabCursor: true,
        loop: true,
        autoplay: true,
        keyboard: {
          enabled: true,
        },
        breakpoints: {
          769: {
            slidesPerView: 2,
            slidesPerGroup: 2,
          },
        },
    }
);
