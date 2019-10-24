$(document).ready(function () {
    "use strict";

    $(".aboutUs-carousel-3").owlCarousel({
        responsive: {
            0: {items: 1},
            400: {items: 2},
            600: {items: 3},
            800: {items: 4},
            1200: {items: 5}
        },
        items: 2,
        slideBy: 2,
        margin: 20
    });

    $(".aboutUs-carousel-2").owlCarousel({
        responsive: {
            0: {items: 1},
            600: {items: 2},
            1200: {items: 3}
        },
        items: 1,
        slideBy: 2,
        margin: 20
    });

    $(".testimonial-carousel").owlCarousel({
        responsive: {
            0: {items: 1},
            1000: {items: 1}
        },
        items: 1,
        slideBy: 2,
        margin: 20
    });
});