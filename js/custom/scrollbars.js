(function ($) {
    "use strict";

    if($.isFunction(PerfectScrollbar)) {
        var scOptions = {
            wheelSpeed: 2
        };

        if($('.module-list-scroll').length > 0) {
            new PerfectScrollbar('.module-list-scroll', scOptions);
        }

        if($('.module-side-scroll').length > 0) {
            new PerfectScrollbar('.module-side-scroll', scOptions);
        }
    }

})(jQuery);