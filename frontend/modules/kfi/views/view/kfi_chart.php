<div id="container" style="width:100%; height:100%;"></div>
<script>
    Highcharts.chart('container', {
        chart: {
            type: 'line' // Base chart type
        },
        title: {
            text: 'Trend Chart',
            align: 'left',
            x: 20,
            style: {
                fontSize: '14px'
            }

        },
        xAxis: {
            categories: [<?= $month ?>]
        },
        yAxis: {
            title: {
                text: 'Amount'
            },
            min: 0
        },
        series: [{
                type: 'line', // Line chart for this series
                name: 'Actual',
                data: [<?= $result ?>],
                color: '#748EE9',
                lineWidth: 1,
                marker: {
                    radius: 2 // Minimize the marker size for area chart too
                }
            },
            {
                type: 'area', // Area chart for this series
                name: 'Target',
                data: [<?= $target ?>],
                color: '#BBCAFF',
                fillOpacity: 0.3,
                lineWidth: 0,
                marker: {
                    radius: 2 // Minimize the marker size for area chart too
                }
            },
        ]
    });
</script>