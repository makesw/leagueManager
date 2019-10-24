(function ($) {
    "use strict";

    var data = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug'],
        series: [
            [34, 40, 70, 50, 44, 68, 78, 50]
        ]
    };

    var options = {
        seriesBarDistance: 5,
        chartPadding: {
            right: 0,
            left: 0,
            bottom: 5
        },
        axisX: {
            showLabel: false,
            showGrid: false,
            offset: 0
        },
        axisY: {
            showLabel: false,
            showGrid: false,
            offset: 0
        }
    };
    var responsiveOptions = [
        ['screen and (max-width: 640px)', {
                seriesBarDistance: 8,
                axisX: {
                    labelInterpolationFnc: function (value) {
                        return value[0];
                    }
                }
            }]
    ];

    new Chartist.Bar('#news-ch-chart', data, options, responsiveOptions);

    //ct chart
    var lineChart = new c3.generate({
        bindto: '#ct-news-chart',
        data: {
            columns: [
                ['data1', 60, 20, 80, 30, 70]
            ],
            colors: {
                data1: '#3f51b5'
            }
        }, padding: {
            right: 0,
            left: 0,
            bottom: 0
        }, axis: {
            x: {
                show: false
            },
            y: {
                show: false
            }
        }, legend: {
            show: false
        }, tooltip: {
            show: false
        }
    });

    //js doughnut-chart
    new Chart(document.getElementById("doughnut-chart-2"), {
        type: 'doughnut',
        data: {
            labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
            datasets: [
                {
                    label: "Population (millions)",
                    backgroundColor: ["#FFBB28", "#00C49F", "#0088FE", "#FFBB28", "#00C49F", "#0088FE", "#FF8042"],
                    data: [10, 15, 10, 15, 10, 15, 15],
                    borderColor: [
                        "#F44336",
                        "#F44336",
                        "#F44336",
                        "#F44336",
                        "#F44336",
                        "#F44336",
                        "#F44336"
                    ],
                }
            ]
        },
        options: {
            title: {
                display: false,
                text: 'Predicted world population (millions) in 2050'
            }, legend: {
                display: false
            },
            tooltips: {
                enabled: true
            },
            segmentShowStroke: true,
            segmentStrokeWidth: 3,
            percentageInnerCutout: 20,
            animationSteps: 100,
            animationEasing: "easeOutBounce",
            animateRotate: true,
            responsive: true,
            maintainAspectRatio: false,
            showScale: true,
            animateScale: true,
            cutoutPercentage: 60

        }
    });



    //js-chart
    new Chart(document.getElementById("doughnut-chart"), {
        type: 'doughnut',
        data: {
            labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
            datasets: [
                {
                    label: "Population (millions)",
                    backgroundColor: ["#FFC658", "#FFC658", "#FFC658", "#FFC658", "#FFC658", "#FFC658", "#FFFC658"],
                    data: [10, 15, 10, 15, 10, 15, 15]
                }
            ]
        },
        options: {
            title: {
                display: false,
                text: 'Predicted world population (millions) in 2050'
            }, legend: {
                display: false
            },
            tooltips: {
                enabled: true
            },
            segmentShowStroke: true,
            segmentStrokeColor: "#fff",
            segmentStrokeWidth: 3,
            percentageInnerCutout: 20,
            animationSteps: 100,
            animationEasing: "easeOutBounce",
            animateRotate: true,
            responsive: true,
            maintainAspectRatio: false,
            showScale: true,
            animateScale: true,
            cutoutPercentage: 70

        }
    });

    //c3-chart
    var chart = c3.generate({
        bindto: '#c3-chart',
        data: {
            columns: [
                ['data1', 4064, 2045, 3045, 2000, 1750, 2393, 3490],
                ['data2', 1800, 4398, 2845, 3908, 4834, 5875, 3334],
                ['data3', 2423, 900, 4990, 600, 1800, 2553, 2104],
                ['data5', 5578, 1145, 956, 1800, 1246, 1083, 1683]
            ],
            types: {
                data1: 'spline',
                data2: 'spline',
                data3: 'spline',
                data5: 'spline',
                // 'line', 'spline', 'step', 'area', 'area-step' are also available to stack
            },
        }
    });


    //////// c3 Line chart
    var lineChart = new c3.generate({
        bindto: '#ct-chart',
        data: {
            columns: [
                ['data1', 60, 10, 50, 20, 70]
            ],
            colors: {
                data1: '#FFFFFF'
            }
        }, padding: {
            right: 10,
            left: 10,
            bottom: 0
        }, axis: {
            x: {
                show: false
            },
            y: {
                show: false
            }
        }, legend: {
            show: false
        }, tooltip: {
            show: false
        }
    });

})(jQuery);