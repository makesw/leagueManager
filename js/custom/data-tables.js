(function ($) {
    "use strict";

    $('.dataTables-example').DataTable({
        dom: '<"html5buttons" B>lTfgitp',
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            },
            'colvis'
        ]
    });

})(jQuery);