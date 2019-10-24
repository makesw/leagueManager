(function ($) {
    "use strict";

    //c3-chart
    var chart = c3.generate({
        bindto: '#c3-widget',
        data: {
            columns: [
                ['data1', 4064, 2045, 3045, 2000, 1750, 2393, 3490],
                ['data2', 1800, 4398, 2845, 3908, 4834, 5875, 3334],
                ['data3', 2423, 400, 4990, 600, 6500, 2553, 2104],
                ['data5', 5578, 1145, 956, 1800, 1246, 1083, 1683]
            ],
            types: {
                data1: 'spline',
                data2: 'spline',
                data3: 'spline',
                data5: 'spline',
                // 'line', 'spline', 'step', 'area', 'area-step' are also available to stack
            }
        }, legend: {
            show: false
        }, axis: {
            x: {show: false},
            y: {show: false}
        }, tooltip: {
            show: false
        }
    });

    ///Customer Around The World --c3 chart
    var chart = c3.generate({
        bindto: '#around-the-world',
        data: {
            columns: [
                ['Income', 22, 16, 35, 22, 38, 29, 32, 35],
                ['Expenses', 10, 25, 15, 13, 35, 25, 20, 25]

            ],
            types: {
                Expenses: 'area-spline',
                Income: 'area-spline'
            },
            colors: {
                Expenses: '#D47FFF',
                Income: '#00BCD4'
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

    var chart = c3.generate({
        bindto: '#c3-chart',
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
            position: 'inset',
            inset: {
                anchor: 'top-left',
                x: 20,
                y: 0,
                step: 1
            }
        }
    });

    var chart = c3.generate({
        bindto: '#c8-chart',
        data: {
            columns: [
                ['data1', 15, 22, 13, 25, 14, 28, 18]
            ],
            types: {
                data1: 'spline'
            },
            colors: {
                data1: "#3f51b5"
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
            right: 10,
            left: 10,
            bottom: 10
        }, legend: {
            show: false
        }, tooltip: {
            show: false
        }

    });

})(jQuery);