(function ($) {
    "use strict";

    $.notify.defaults({className: "success"});

    $(".btn-success").on("click", function () {
        $.notify("Access granted", "success");
    });

    $(".btn-info").on("click", function () {
        $.notify("Do not press this button", "info");
    });

    $(".btn-warning").on("click", function () {
        $.notify("Warning: Self-destruct in 3.. 2..", "warn");
    });

    $(".btn-danger").on("click", function () {
        $.notify("BOOM!", "error");
    });

    $(".left-top").on("click", function () {
        $.notify("Position : left top", {
            // default positions
            elementPosition: 'bottom left',
            globalPosition: 'top left',
            showAnimation: 'slideDown',
            // show animation duration
            showDuration: 400,
            // hide animation
            hideAnimation: 'slideUp',
            // hide animation duration
            hideDuration: 200,
            // padding between element and notification
            gap: 2
        });
    });

    $(".center-top").on("click", function () {
        $.notify("Position : top center", {
            // default positions
            elementPosition: 'bottom left',
            globalPosition: 'top center',
            showAnimation: 'slideDown',
            // show animation duration
            showDuration: 400,
            // hide animation
            hideAnimation: 'slideUp',
            // hide animation duration
            hideDuration: 200,
            // padding between element and notification
            gap: 2
        });
    });

    $(".right-top").on("click", function () {
        $.notify("Position : top right", {
            globalPosition: 'top right',
            showAnimation: 'slideDown',
            // show animation duration
            showDuration: 400,
            // hide animation
            hideAnimation: 'slideUp',
            // hide animation duration
            hideDuration: 200,
            // padding between element and notification
            gap: 2
        });
    });

    $(".left").on("click", function () {
        $.notify("Position : left middle", {
            globalPosition: 'left',
            showAnimation: 'slideDown',
            // show animation duration
            showDuration: 400,
            // hide animation
            hideAnimation: 'slideUp',
            // hide animation duration
            hideDuration: 200,
            // padding between element and notification
            gap: 2
        });
    });

    $(".right").on("click", function () {
        $.notify("Position : right middle", {
            globalPosition: 'right right',
            showAnimation: 'slideDown',
            // show animation duration
            showDuration: 400,
            // hide animation
            hideAnimation: 'slideUp',
            // hide animation duration
            hideDuration: 200,
            // padding between element and notification
            gap: 2
        });
    });

    $(".bottom-left").on("click", function () {
        $.notify("Position : bottom left", {
            globalPosition: 'bottom left',
            showAnimation: 'slideDown',
            // show animation duration
            showDuration: 400,
            // hide animation
            hideAnimation: 'slideUp',
            // hide animation duration
            hideDuration: 200,
            // padding between element and notification
            gap: 2
        });
    });

    $(".bottom-center").on("click", function () {
        $.notify("Position : bottom center", {
            globalPosition: 'bottom center',
            showAnimation: 'slideDown',
            // show animation duration
            showDuration: 400,
            // hide animation
            hideAnimation: 'slideUp',
            // hide animation duration
            hideDuration: 200,
            // padding between element and notification
            gap: 2
        });
    });

    $(".bottom-right").on("click", function () {
        $.notify("Position : bottom center", {
            globalPosition: 'bottom right',
            showAnimation: 'slideDown',
            // show animation duration
            showDuration: 400,
            // hide animation
            hideAnimation: 'slideUp',
            // hide animation duration
            hideDuration: 200,
            // padding between element and notification
            gap: 2
        });
    });

})(jQuery);