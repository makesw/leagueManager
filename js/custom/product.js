(function ($) {
    "use strict";

    $('#product-gallery').lightSlider({
        gallery: true,
        item: 1,
        thumbItem: 4,
        slideMargin: 0,
        speed: 500,
        auto: false,
        loop: true,
        onSliderLoad: function () {
            $('#product-gallery').removeClass('cS-hidden');
        }
    });

})(jQuery);