(function ($) {
    "use strict";

    $('.product-carousel').owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            400: {
                items: 2,
                nav: false
            },
            600: {
                items: 3,
                nav: false
            },
            800: {
                items: 4,
                nav: false
            },
            1200: {
                items: 5,
                nav: false,
                loop: false
            }
        }
    });

    $('.testimonial-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        items: 1
    });

    $('.carousel').carousel();

})(jQuery);