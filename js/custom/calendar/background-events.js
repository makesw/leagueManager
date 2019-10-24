(function ($) {
    "use strict";

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listMonth'
        },
        defaultDate: '2018-02-12',
        navLinks: true, // can click day/week names to navigate views
        businessHours: true, // display business hours
        editable: true,
        events: [
            {
                title: 'Business Lunch',
                start: '2018-02-03T13:00:00',
                constraint: 'businessHours'
            },
            {
                title: 'Meeting',
                start: '2018-02-13T11:00:00',
                constraint: 'availableForMeeting', // defined below
                color: '#257e4a'
            },
            {
                title: 'Conference',
                start: '2018-02-18',
                end: '2018-02-20'
            },
            {
                title: 'Party',
                start: '2018-02-29T20:00:00'
            },
            // areas where "Meeting" must be dropped
            {
                id: 'availableForMeeting',
                start: '2018-02-11T10:00:00',
                end: '2018-02-11T16:00:00',
                rendering: 'background'
            },
            {
                id: 'availableForMeeting',
                start: '2018-02-13T10:00:00',
                end: '2018-02-13T16:00:00',
                rendering: 'background'
            },
            // red areas where no events can be dropped
            {
                start: '2018-02-24',
                end: '2018-02-28',
                overlap: false,
                rendering: 'background',
                color: '#ff9f89'
            },
            {
                start: '2018-02-06',
                end: '2018-02-08',
                overlap: false,
                rendering: 'background',
                color: '#ff9f89'
            }
        ]
    });

})(jQuery);