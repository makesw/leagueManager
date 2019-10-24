(function ($) {
    "use strict";

    $('#bottom-navigation-label > li').on("click", function () {
        $('#bottom-navigation-label > li').removeClass("active");
        $(this).addClass("active");
    });

    $('#bottom-navigation-active-label > li').on("click", function () {
        $('#bottom-navigation-active-label > li').removeClass("active");
        $(this).addClass("active");
    });

    $('#bottom-navigation-no-label > li').on("click", function () {
        $('#bottom-navigation-no-label > li').removeClass("active");
        $(this).addClass("active");
    });
})(jQuery);