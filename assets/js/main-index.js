/**
 * Created by stevenbraham on 12-04-17.
 */
google.charts.load('current', {'packages': ['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    $.getJSON('_chart', function (data) {
        var chartData = new google.visualization.DataTable();
        chartData.addColumn('date', 'Datum');
        chartData.addColumn('number', 'Profits');
        $.each(data, function (index, element) {
            chartData.addRow(
                [new Date(index), parseFloat(element)]
            );
        });
        var options = {
            title: 'Company Performance',
            curveType: 'function',
            legend: {position: 'none'}
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(chartData, options);
    });


}