(function ($) {
    "use strict";

    var initialLocaleCode = 'en';

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listMonth'
        },
        defaultDate: '2018-02-12',
        locale: initialLocaleCode,
        buttonIcons: false, // show the prev/next text
        weekNumbers: true,
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: [
            {
                title: 'All Day Event',
                start: '2018-02-01'
            },
            {
                title: 'Long Event',
                start: '2018-02-07',
                end: '2018-02-10'
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: '2018-02-09T16:00:00'
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: '2018-02-16T16:00:00'
            },
            {
                title: 'Conference',
                start: '2018-02-11',
                end: '2018-02-13'
            },
            {
                title: 'Meeting',
                start: '2018-02-12T10:30:00',
                end: '2018-02-12T12:30:00'
            },
            {
                title: 'Lunch',
                start: '2018-02-12T12:00:00'
            },
            {
                title: 'Meeting',
                start: '2018-02-12T14:30:00'
            },
            {
                title: 'Happy Hour',
                start: '2018-02-12T17:30:00'
            },
            {
                title: 'Dinner',
                start: '2018-02-12T20:00:00'
            },
            {
                title: 'Birthday Party',
                start: '2018-02-13T07:00:00'
            },
            {
                title: 'Click for Google',
                url: 'http://google.com/',
                start: '2018-02-28'
            }
        ]
    });

    // build the locale selector's options
    $.each($.fullCalendar.locales, function (localeCode) {
        $('#locale-selector').append(
                $('<option/>')
                .attr('value', localeCode)
                .prop('selected', localeCode == initialLocaleCode)
                .text(localeCode)
                );
    });

    // when the selected option changes, dynamically change the calendar option
    $('#locale-selector').on('change', function () {
        if (this.value) {
            $('#calendar').fullCalendar('option', 'locale', this.value);
        }
    });

})(jQuery);