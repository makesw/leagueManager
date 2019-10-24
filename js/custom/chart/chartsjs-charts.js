(function ($) {
    "use strict";

    var lineData = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [
            {
                label: "Income",
                fillColor: "#7CB5EC",
                strokeColor: "#7CB5EC",
                pointColor: "#3C8DBC",
                pointStrokeColor: "#fff",
                borderColor: "#3C8DBC",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "#3C8DBC",
                data: [65, 59, 80, 81, 56, 55, 40]
            },
            {
                label: "Expanse",
                fillColor: "#93E399",
                strokeColor: "rgba(26,179,148,0.7)",
                pointColor: "#93E399",
                borderColor: "#93E399",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(26,179,148,1)",
                data: [28, 48, 40, 19, 86, 27, 90]

            }
        ]
    };


    var lineOptions = {
        scaleShowGridLines: true,
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleGridLineWidth: 1,
        bezierCurve: true,
        bezierCurveTension: 0.4,
        pointDot: true,
        pointDotRadius: 4,
        pointDotStrokeWidth: 1,
        pointHitDetectionRadius: 20,
        datasetStroke: true,
        datasetStrokeWidth: 2,
        datasetFill: false,
        responsive: true
    };

    var ctx = document.getElementById("lineChart").getContext("2d");

    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: lineData,
        options: lineOptions
    });

    var barData = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [
            {
                label: "Electronics",
                fillColor: "rgba(210, 214, 222, 1)",
                strokeColor: "rgba(210, 214, 222, 1)",
                pointColor: "rgba(210, 214, 222, 1)",
                pointStrokeColor: "#c1c7d1",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [65, 59, 80, 81, 56, 55, 40]
            },
            {
                label: "Digital Goods",
                fillColor: "rgba(60,141,188,0.9)",
                strokeColor: "rgba(60,141,188,0.8)",
                pointColor: "#3b8bba",
                pointStrokeColor: "rgba(60,141,188,1)",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(60,141,188,1)",
                data: [28, 48, 40, 19, 86, 27, 90]
            }
        ]
    };

    var barChartOptions = {
        //Boolean - If we should show the scale at all
        showScale: true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines: false,
        //String - Colour of the grid lines
        scaleGridLineColor: "rgba(0,0,0,.05)",
        //Number - Width of the grid lines
        scaleGridLineWidth: 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines: true,
        //Boolean - Whether the line is curved between points
        bezierCurve: true,
        //Number - Tension of the bezier curve between points
        bezierCurveTension: 0.3,
        //Boolean - Whether to show a dot for each point
        pointDot: false,
        //Number - Radius of each point dot in pixels
        pointDotRadius: 4,
        //Number - Pixel width of point dot stroke
        pointDotStrokeWidth: 1,
        //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
        pointHitDetectionRadius: 20,
        //Boolean - Whether to show a stroke for datasets
        datasetStroke: true,
        //Number - Pixel width of dataset stroke
        datasetStrokeWidth: 2,
        //Boolean - Whether to fill the dataset with a color
        datasetFill: true,
        //String - A legend template
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
        //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: true,
        //Boolean - whether to make the chart responsive to window resizing
        responsive: true
    };


    var ctx = document.getElementById("barChart").getContext("2d");

    var barChartData = barData;
    barChartData.datasets[1].fillColor = "#3F51B5";
    barChartData.datasets[1].strokeColor = "#bfbfbf";
    barChartData.datasets[1].pointColor = "#3F51B5";
    barChartData.datasets[0].backgroundColor="#bfbfbf";
    barChartData.datasets[1].backgroundColor="#3F51B5";
    barChartOptions.datasetFill = false;
    var barChart = new Chart(ctx, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
    });

    var polarData = {
        datasets: [{
            data: [300, 140, 200],
            backgroundColor: ['#3F51B5','#00A8D2','#EB9100']
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

    var pieChartData = {
        datasets: [{
            data: [700, 500, 400,600,300,100],
            backgroundColor: ["#3F51B5","#00a65a","#f39c12","#00c0ef", "#3c8dbc",  "#d2d6de"]
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
    };


    var ctx = document.getElementById("pieChart").getContext("2d");
    var pieChart = new Chart(ctx, {
        type: 'doughnut',
        data: pieChartData,
        options: pieChartOptions
    });



    var radarData = {
        labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
        datasets: [
            {
                label: "My First dataset",
                backgroundColor: "rgba(200,0,0,0.6)",
                fillColor: "#ADF7C9",
                strokeColor: "#93E399",
                pointColor: "#93E399",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [65, 59, 90, 81, 56, 55, 40]
            },
            {
                label: "My Second dataset",
                backgroundColor: "rgba(0,0,200,0.6)",
                fillColor: "rgba(26,179,148,0.2)",
                strokeColor: "rgba(26,179,148,1)",
                pointColor: "rgba(26,179,148,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: [28, 48, 40, 19, 96, 27, 100]
            }
        ]
    };

    var radarOptions = {
        scaleShowLine: true,
        angleShowLineOut: true,
        scaleShowLabels: false,
        scaleBeginAtZero: true,
        angleLineColor: "rgba(0,0,0,.1)",
        angleLineWidth: 1,
        pointLabelFontFamily: "'Arial'",
        pointLabelFontStyle: "normal",
        pointLabelFontSize: 10,
        pointLabelFontColor: "#666",
        pointDot: true,
        pointDotRadius: 3,
        pointDotStrokeWidth: 1,
        pointHitDetectionRadius: 20,
        datasetStroke: true,
        datasetStrokeWidth: 2,
        datasetFill: true,
        responsive: true,
    };

     var ctx = document.getElementById("radarChart").getContext("2d");
    var radarChart = new Chart(ctx, {
        type: 'radar',
        data: radarData,
        options: radarOptions
    });

})(jQuery);