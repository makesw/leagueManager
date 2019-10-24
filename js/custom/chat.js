(function ($) {
    "use strict";

    $('.chat-user-item').on('click', function () {
        window.location = "chat.html";
    });

    if ($.isFunction(PerfectScrollbar)) {
        var scOptions = {
            wheelSpeed: 2
        };

        if ($('.chat-list-scroll').length > 0) {
            new PerfectScrollbar('.chat-list-scroll', scOptions);
        }
    }

})(jQuery);