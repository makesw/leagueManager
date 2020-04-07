(function ($) {
    "use strict";
    
    // pie chart
    $("span.pie").peity("pie", {
        fill: ['#FF0000', '#009c00', '#ffffff'],
        width:50
    });

    // line chart
    $(".line").peity("line",{
        fill: '#009c00',
        stroke:'#FF0000',
        width:50
    });

    // bar chart
    $(".bar").peity("bar", {
        fill: ["#009c00", "#d7d7d7"],
        width:50
    });

    // bar dashboard chart
    $(".bar-dashboard").peity("bar", {
        fill: ["#1ab394", "#d7d7d7"],
        width:100
    });

    // updating chart
    var updatingChart = $(".updating-chart").peity("line", {fill: '#009c00', stroke: '#FF0000', width: 64});

    setInterval(function() {
        var random = Math.round(Math.random() * 10);
        var values = updatingChart.text().split(",");
        values.shift();
        values.push(random);

        updatingChart
            .text(values.join(","))
            .change()
    }, 1000);
    
})(jQuery);