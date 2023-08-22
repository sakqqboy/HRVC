google.load('visualization', '1.1', { packages: ['line'] });

google.setOnLoadCallback(drawChart);

function drawChart() {

    var data = new google.visualization.DataTable();
    data.addColumn('number', '');
    data.addColumn('number', 'Day');
    data.addColumn('number', 'Total Salary');
    data.addColumn('number', 'Increase Ratio');

    data.addRows([
        [1, 2, 4, 0],
        [2, 5, 5, 15],
        [3, 7, 5.3, 5],
        [4, 10, 5.1, 10.5],
        [5, 5, 5.5, 10.4],
        [6, 8.8, 5.3, 7.7],
        [7, 7.6, 5.2, 9.6],
        [8, 12.3, 5.3, 10.6],
        [9, 16.9, 5.9, 14.8],
        [10, 12.8, 10.3, 11.6],
        [11, 5.3, 10.6, 4.7],
        [12, 6.6, 10.8, 5.2],
        [13, 4.8, 15, 3.6],
        [14, 4.2, 15.6, 3.4]
    ]);

    var options = {
        chart: {
            title: '',
            subtitle: ''
        },
        'width': 400,
        'height': 300
    };
    var chart = new google.charts.Line(document.getElementById('chart'));

    chart.draw(data, options);
}

var chart = new Highcharts.Chart({
    chart: {
        renderTo: 'container',
        marginBottom: 80
    },
    xAxis: {
        categories: ['1Q', '2Q', '3Q', '4Q', '5Q', '6Q', '7Q', '8Q', '9Q', '10Q', '11Q', '12Q'],
        labels: {
            rotation: 90
        }
    },

    series: [{
        data: [29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
    }]

});

