(function ($) {
    "use strict";

    $(".chat-testimonial-carousel").owlCarousel({
        responsive: {
            0: {items: 1},
            767: {items: 2},
            1000: {items: 2}
        },
        items: 2,
        slideBy: 2,
        margin: 20
    });

    $(".basic-testimonial-carousel").owlCarousel({
        items: 1,
        margin: 20
    });

    $(".classic-testimonial-carousel").owlCarousel({
        items: 1,
        nav: true,
        dots: false,
        margin: 20,
        navText: ['', '']
    });

    $(".testimonial-carousel").owlCarousel({
        responsive: {
            0: {items: 1}, // from zero to 480 screen width 4 items
            1000: {items: 2} // from zero to 480 screen width 4 items
        },
        items: 2,
        slideBy: 2,
        margin: 20
    });

})(jQuery);