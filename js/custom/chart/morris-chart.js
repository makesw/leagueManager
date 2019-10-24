(function ($) {
    "use strict";

    new Morris.Area({
        element: 'graph',
        data: [
            {x: '2010 Q4', y: 3, z: 7},
            {x: '2011 Q1', y: 3, z: 4},
            {x: '2011 Q2', y: null, z: 1},
            {x: '2011 Q3', y: 2, z: 5},
            {x: '2011 Q4', y: 8, z: 2},
            {x: '2012 Q1', y: 4, z: 4}
        ],
        xkey: 'x',
        ykeys: ['y', 'z'],
        labels: ['Y', 'Z']
    }).on('click', function(i, row){
        console.log(i, row);
    });

    // Use Morris.Bar
    Morris.Bar({
        element: 'morris-bar-chart',
        data: [
            {x: '2011 Q1', y: 3, z: 2, a: 3},
            {x: '2011 Q2', y: 2, z: null, a: 1},
            {x: '2011 Q3', y: 0, z: 2, a: 4},
            {x: '2011 Q4', y: 2, z: 4, a: 3}
        ],
        xkey: 'x',
        ykeys: ['y', 'z', 'a'],
        labels: ['Y', 'Z', 'A']
    }).on('click', function(i, row){
        console.log(i, row);
    });

    //morris-donut-chart
    Morris.Donut({
        element: 'morris-donut-chart',
        data: [
            {value: 70, label: 'foo'},
            {value: 15, label: 'bar'},
            {value: 10, label: 'baz'},
            {value: 5, label: 'A really really long label'}
        ],
        formatter: function (x) { return x + "%"}
    }).on('click', function(i, row){
        console.log(i, row);
    });

    //valueGols
    var decimal_data = [];
    for (var x = 0; x <= 360; x += 10) {
        decimal_data.push({
            x: x,
            y: Math.sin(Math.PI * x / 180).toFixed(4)
        });
    }
    window.m = Morris.Line({
        element: 'valueGols',
        data: decimal_data,
        xkey: 'x',
        ykeys: ['y'],
        labels: ['sin(x)'],
        parseTime: false,
        goals: [-1, 0, 1]
    });

    //time-events-chart
    var week_data = [
        {"period": "2011 W27", "licensed": 3407, "sorned": 660},
        {"period": "2011 W26", "licensed": 3351, "sorned": 629},
        {"period": "2011 W25", "licensed": 3269, "sorned": 618},
        {"period": "2011 W24", "licensed": 3246, "sorned": 661},
        {"period": "2011 W23", "licensed": 3257, "sorned": 667},
        {"period": "2011 W22", "licensed": 3248, "sorned": 627},
        {"period": "2011 W21", "licensed": 3171, "sorned": 660},
        {"period": "2011 W20", "licensed": 3171, "sorned": 676},
        {"period": "2011 W19", "licensed": 3201, "sorned": 656},
        {"period": "2011 W18", "licensed": 3215, "sorned": 622},
        {"period": "2011 W17", "licensed": 3148, "sorned": 632},
        {"period": "2011 W16", "licensed": 3155, "sorned": 681},
        {"period": "2011 W15", "licensed": 3190, "sorned": 667},
        {"period": "2011 W14", "licensed": 3226, "sorned": 620},
        {"period": "2011 W13", "licensed": 3245, "sorned": null},
        {"period": "2011 W12", "licensed": 3289, "sorned": null},
        {"period": "2011 W11", "licensed": 3263, "sorned": null},
        {"period": "2011 W10", "licensed": 3189, "sorned": null},
        {"period": "2011 W09", "licensed": 3079, "sorned": null},
        {"period": "2011 W08", "licensed": 3085, "sorned": null},
        {"period": "2011 W07", "licensed": 3055, "sorned": null},
        {"period": "2011 W06", "licensed": 3063, "sorned": null},
        {"period": "2011 W05", "licensed": 2943, "sorned": null},
        {"period": "2011 W04", "licensed": 2806, "sorned": null},
        {"period": "2011 W03", "licensed": 2674, "sorned": null},
        {"period": "2011 W02", "licensed": 1702, "sorned": null},
        {"period": "2011 W01", "licensed": 1732, "sorned": null}
    ];
    Morris.Line({
        element: 'time-events-chart',
        data: week_data,
        xkey: 'period',
        ykeys: ['licensed', 'sorned'],
        labels: ['Licensed', 'SORN'],
        events: [
            '2011-04',
            '2011-08'
        ]
    });
    
})(jQuery);