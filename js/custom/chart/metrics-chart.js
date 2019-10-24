(function ($) {
    "use strict";

    //js chart/radar chart
    var radarData = {
        labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
        datasets: [
            {
                label: "My First dataset",
                backgroundColor: "rgba(200,0,0,0.6)",
                data: [65, 59, 90, 81, 56, 55, 40]
            },
            {
                label: "My Second dataset",
                backgroundColor: "rgba(0,0,200,0.6)",
                data: [28, 48, 40, 19, 96, 27, 100]
            }
        ]
    };

    var radarOptions = {
        scaleShowLine: false,
        angleShowLineOut: false,
        scaleShowLabels: false,
        scaleBeginAtZero: false,
        angleLineColor: "rgba(0,0,0,.1)",
        angleLineWidth: 1,
        pointLabelFontFamily: "'Arial'",
        pointLabelFontStyle: "normal",
        pointLabelFontSize: 10,
        pointLabelFontColor: "#666",
        pointDot: false,
        pointDotRadius: 1,
        pointDotStrokeWidth: 0.5,
        pointHitDetectionRadius: 20,
        datasetStroke: false,
        datasetStrokeWidth: 2,
        datasetFill: true,
        responsive: true,
        legend: {
            display: false,
        },
        tooltips: {
            enabled: false,
        }
    };

    var ctx = document.getElementById("radarChart").getContext("2d");
    var radarChart = new Chart(ctx, {
        type: 'radar',
        data: radarData,
        options: radarOptions
    });
    //RadarChart Finish

    ///multipal
    var chart = c3.generate({
        bindto: '#c3-chart2',
        data: {
            columns: [
                ['c3Data1', 15, 22, 13, 25, 14, 28, 18, 30, 16],
                ['c3Data2', 12, 25, 22, 30, 15, 22, 10, 18, 12],
                ['c3Data3', 10, 22, 30, 24, 26, 32, 44, 30, 16],
            ],
            types: {
                c3Data1: 'spline',
                c3Data2: 'spline',
                c3Data3: 'spline'
            },
            colors: {
                c3Data1: "#26a69a",
                c3Data2: "#26a69a",
                c3Data3: "#26a69a"
            }
        },
        axis: {
            x: {
                show: false
            },
            y: {
                show: false
            }
        },
        padding: {
            right: 0,
            left: 0,
            bottom: -10
        }, legend: {
            show: false
        }, tooltip: {
            show: false
        }

    });


    //js-chart/Pie Chart
    var pieChartData = {
        datasets: [{
                data: [700, 500, 400, 600, 300, 100],
                backgroundColor: ["#3F51B5", "#00a65a", "#f39c12", "#00c0ef", "#3c8dbc", "#d2d6de"]
            }],
        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: [
            'Chrome',
            'IE',
            'FireFox',
            'Safari',
            'Opera',
            'Navigator'
        ]
    };

    var pieChartOptions = {
        segmentShowStroke: true,
        segmentStrokeColor: "#fff",
        segmentStrokeWidth: 2,
        percentageInnerCutout: 45, // This is 0 for Pie charts
        animationSteps: 100,
        animationEasing: "easeOutBounce",
        animateRotate: true,
        animateScale: false,
        responsive: true,
        legend: {
            display: false,
        },
        tooltips: {
            enabled: false,
        }
    };

    var ctx = document.getElementById("pieChart").getContext("2d");
    var pieChart = new Chart(ctx, {
        type: 'doughnut',
        data: pieChartData,
        options: pieChartOptions
    });

    ////js-chart/line-chart
    var speedCanvas = document.getElementById("speedChart");

    Chart.defaults.global.defaultFontFamily = "Lato";
    Chart.defaults.global.defaultFontSize = 10;

    var dataFirst = {
        label: "Car A - Speed (mph)",
        data: [40, 30, 60, 27, 78, 23, 56],
        lineTension: 0.3,
        fill: false,
        borderColor: 'red',
        backgroundColor: 'transparent',
        pointBorderColor: 'red',
        pointBackgroundColor: 'white',
        pointRadius: 4,
        pointHoverRadius: 6,
        pointHitRadius: 6,
        borderWidth: 1.5,
        pointBorderWidth: 1,
    };

    var dataSecond = {
        label: "Car B - Speed (mph)",
        data: [24, 13, 98, 39, 48, 38, 43],
        lineTension: 0.3,
        fill: false,
        borderColor: 'purple',
        backgroundColor: 'transparent',
        pointBorderColor: 'purple',
        pointBackgroundColor: 'white',
        pointRadius: 4,
        borderWidth: 1.5,
        pointHoverRadius: 6,
        pointHitRadius: 6,
        pointBorderWidth: 1
    };

    var speedData = {
        labels: ["0s", "10s", "20s", "30s", "40s", "50s", "60s"],
        datasets: [dataFirst, dataSecond]
    };

    var chartOptions = {
        legend: {
            display: false,
        },
        tooltips: {
            enabled: false,
        },
        scales: {
            xAxes: [{
                    display: false
                }],
            yAxes: [{
                    display: false
                }]
        }, layout: {
            padding: {
                left: 10,
                right: 10,
                top: 10,
                bottom: 10
            }
        }
    };

    var lineChart = new Chart(speedCanvas, {
        type: 'line',
        data: speedData,
        options: chartOptions
    });

    //gauge chart
    var chart = c3.generate({
        bindto: '#gauge',
        data: {
            columns: [
                ['data', 91.4]
            ],
            type: 'gauge',
            onclick: function (d, i) {
                console.log("onclick", d, i);
            },
            onmouseover: function (d, i) {
                console.log("onmouseover", d, i);
            },
            onmouseout: function (d, i) {
                console.log("onmouseout", d, i);
            }
        },
        gauge: {
//        label: {
//            format: function(value, ratio) {
//                return value;
//            },
//            show: false // to turn off the min/max labels.
//        },
//    min: 0, // 0 is default, //can handle negative min e.g. vacuum / voltage / current flow / rate of change
//    max: 100, // 100 is default
//    units: ' %',
//    width: 39 // for adjusting arc thickness
        },
        color: {
            pattern: ['#FF0000', '#F97600', '#F6C600', '#60B044'], // the three color levels for the percentage values.
            threshold: {
//            unit: 'value', // percentage is default
//            max: 200, // 100 is default
                values: [30, 60, 90, 100]
            }
        },
        size: {
            height: 100
        }, legend: {
            show: false
        }
    });

    setTimeout(function () {
        chart.load({
            columns: [['data', 10]]
        });
    }, 1000);

    setTimeout(function () {
        chart.load({
            columns: [['data', 50]]
        });
    }, 2000);

    setTimeout(function () {
        chart.load({
            columns: [['data', 70]]
        });
    }, 3000);

    setTimeout(function () {
        chart.load({
            columns: [['data', 0]]
        });
    }, 4000);

    setTimeout(function () {
        chart.load({
            columns: [['data', 100]]
        });
    }, 5000);

//metrics-Chartist
    var data = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        series: [
            [34, 40, 70, 50, 44, 68, 88]
        ]
    };

    var options = {
        seriesBarDistance: 50,
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

    var chart = c3.generate({
        bindto: '#c4-chart',
        data: {
            columns: [
                ['data1', 24, 13, 98, 39, 48, 38, 43]
            ],
            types: {
                data1: 'area-spline'
            },
            colors: {
                data1: '#E91E63'
            }
        },
        axis: {
            x: {
                show: false
            },
            y: {
                show: false
            }
        },
        padding: {
            right: -10,
            left: -10,
            bottom: -10
        }, point: {
            show: false
        }, legend: {
            show: false
        }, tooltip: {
            show: false
        }

    });

    ///// Bar chart Data
    var barData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        series: [
            [90, 80, 85, 45, 25, 22, 65, 55, 45, 30, 50, 75, 81, 28, 80, 70, 90, ]
        ]
    };

    var barOptions = {
        seriesBarDistance: 5,
        color: '#FFFFFF',
        fullWidth: true,
        chartPadding: {
            right: 0,
            left: 0,
            bottom: 0
        },
        axisX: {
            showLabel: false,
            showGrid: false,
            offset: 0
        }, axisY: {
            showLabel: false,
            showGrid: false,
            offset: 0
        }
    };

    var barResponsiveOptions = [
        ['screen and (max-width: 640px)', {
                seriesBarDistance: 10,
                axisX: {
                    labelInterpolationFnc: function (value) {
                        return value[0];
                    }
                }
            }]
    ];

    new Chartist.Bar('#bar-chart', barData, barOptions, barResponsiveOptions);



    // line chart
    var lineChart = new c3.generate({
        bindto: '#ct-chart',
        data: {
            columns: [
                ['data1', 10, 50, 20, 60, 20, 80, 30, 70, 30]
            ],
            colors: {
                data1: '#2196F3'
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


    /// Chartist bar
    var data1 = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        series: [
            [5, 4, 6, 4, 7, 3, 5, 6, 7, 6]
        ]
    };

    var options1 = {
        seriesBarDistance: 10,
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
        ['screen and (max-width: 800px)', {
                seriesBarDistance: 5,
                axisX: {
                    labelInterpolationFnc: function (value) {
                        return value[0];
                    }
                }
            }]
    ];

    new Chartist.Bar('#ch-chart6', data1, options1, responsiveOptions);

})(jQuery);