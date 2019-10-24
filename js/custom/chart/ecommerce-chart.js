(function ($) {
    "use strict";

    ///Animastion chart
    var ctx = document.getElementById('myChart').getContext("2d");

    var gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
    gradientStroke.addColorStop(0, '#E91E63');
    gradientStroke.addColorStop(1, '#3F51B5');


    var gradientFill = ctx.createLinearGradient(500, 0, 100, 0);
    gradientFill.addColorStop(0, "rgba(63, 81, 181, 0.6)");
    gradientFill.addColorStop(1, "rgba(233, 30, 99, 0.5)");

    var myChart = new Chart(ctx, {
        responsive: true,
        type: 'line',
        data: {
            labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL"],
            datasets: [{
                    label: "Data",
                    borderColor: gradientStroke,
                    pointBorderColor: gradientStroke,
                    pointBackgroundColor: gradientStroke,
                    pointHoverBackgroundColor: gradientStroke,
                    pointHoverBorderColor: gradientStroke,
                    pointBorderWidth: 3,
                    pointHoverRadius: 3,
                    pointHoverBorderWidth: 1,
                    pointRadius: 3,
                    fill: true,
                    backgroundColor: gradientFill,
                    borderWidth: 2,
                    data: [100, 120, 150, 170, 180, 170, 160]
                }]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                        ticks: {
                            fontColor: "rgba(0,0,0,0.5)",
                            fontStyle: "bold",
                            beginAtZero: true,
                            maxTicksLimit: 5,
                            padding: 20
                        },
                        gridLines: {
                            drawTicks: false,
                            display: false
                        }

                    }],
                xAxes: [{
                        gridLines: {
                            zeroLineColor: "transparent"
                        },
                        ticks: {
                            padding: 20,
                            fontColor: "rgba(0,0,0,0.5)",
                            fontStyle: "bold"
                        }
                    }]
            }
        }
    });

    ///polar-chart

    var polarData = {
        datasets: [{
                data: [300, 140, 200],
                backgroundColor: ['#3F51B5', '#00A8D2', '#EB9100']
            }],
        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: [
            'App',
            'Software',
            'Laptop'
        ]
    };


    var polarOptions = {
        scaleShowLabelBackdrop: true,
        scaleBackdropColor: "rgba(255,255,255,0.75)",
        scaleBeginAtZero: true,
        scaleBackdropPaddingY: 1,
        scaleBackdropPaddingX: 1,
        scaleShowLine: true,
        segmentShowStroke: true,
        segmentStrokeColor: "#fff",
        segmentStrokeWidth: 2,
        animationSteps: 100,
        animationEasing: "easeOutBounce",
        animateRotate: true,
        animateScale: false,
        responsive: true,
    };

    var ctx = document.getElementById("polarChart").getContext("2d");
    var polarChart = new Chart(ctx, {
        type: 'polarArea',
        data: polarData,
        options: polarOptions
    });

    ///Customer Around The World --c3 chart
    var chart = c3.generate({
        bindto: '#around-the-world',
        data: {
            columns: [
                ['Expenses', 10, 30, 15, 43, 26, 36, 25, 48],
                ['Income', 22, 10, 46, 22, 26, 20, 42, 25]
            ],
            types: {
                Expenses: 'area-spline',
                Income: 'area-spline'
            },
            colors: {
                Expenses: '#F5C361',
                Income: '#5C85DE'
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
            show: false,
            position: 'inset',
            inset: {
                anchor: 'top-left',
                x: 20,
                y: 0,
                step: 1
            }
        }, tooltip: {
            show: false
        }
    });

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
            bottom: -5
        },
        axisX: {
            showLabel: false,
            showGrid: false,
            offset: 5
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
                data1: '#FFFFFF'
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
                data1: '#FFF'
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
                c3Data1: "#FFF",
                c3Data2: "#FFF",
                c3Data3: "#FFF"
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
            bottom: -20
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
        seriesBarDistance: 15,
        chartPadding: {
            right: 0,
            left: 0,
            bottom: 0,
            top: 0
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


//gauge chart
    var chart = c3.generate({
        bindto: '#gauge',
        data: {
            columns: [
                ['data', 91.4]
            ],
            type: 'gauge',
            onclick: function (d, i) {
                //console.log("onclick", d, i);
            },
            onmouseover: function (d, i) {
                //console.log("onmouseover", d, i);
            },
            onmouseout: function (d, i) {
                //console.log("onmouseout", d, i);
            }
        },
        gauge: {
        },
        color: {
            pattern: ['#FF0000', '#F97600', '#F6C600', '#60B044'], // the three color levels for the percentage values.
            threshold: {
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
            columns: [['data', 91.4]]
        });
    }, 5000);

})(jQuery);