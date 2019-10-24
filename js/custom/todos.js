(function ($) {
    "use strict";

    $('.module-list-info').on('click', function () {
        window.location = "todo-inner.html";
    });

    if (typeof sortable !== 'undefined') {
        $("#sortable").sortable();
        $("#sortable1").sortable();
        $("#sortable2").sortable();
        $("#sortable3").sortable();
    }
})(jQuery);