
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    xAxis: {
        categories: [
            'Jan',
            'Feb',
            'Mar'

        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        color: 'green'
    },
    tooltip: {
        headerFormat: '<span style="font-size:15px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.3,
            borderWidth: 1
        }
    },
    series: [{
        name: 'Actual',
        data: [950000, 1000000, 1100000]

    }, {
        name: 'Target',
        data: [1500000, 1200000, 1100000],
    }]
});