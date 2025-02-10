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
        categories: <?= json_encode(explode(',', $month)) ?> // Ensure proper array formatting
    },
    yAxis: {
        title: {
            text: 'Amount'
        },
        min: 0
    },
    legend: {
        align: 'right',
        verticalAlign: 'top',
        layout: 'horizontal',
        symbolWidth: 0, // ซ่อนสัญลักษณ์มาตรฐาน
        useHTML: true,
        labelFormatter: function() {
            let icon = '';
            if (this.name == 'Actual') {
                icon = 'KFI-actual.svg'; // รูปของ Actual
            } else if (this.name == 'Target') {
                icon = 'KFI-target.svg'; // รูปของ Target
            }
            return '<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/' + icon + '"' +
                ' style="width: 35px; height: 35px; vertical-align: middle;"> ' +
                this.name;
        },
        itemStyle: {
            fontWeight: 'bold',
            color: '#333333'
        }
    },
    series: [{
            type: 'line',
            name: 'Actual',
            data: <?= json_encode(array_map('floatval', explode(',', $result))) ?>, // Ensure proper number format
            color: '#748EE9',
            lineWidth: 1,
            marker: {
                radius: 2
            }
        },
        {
            type: 'area',
            name: 'Target',
            data: <?= json_encode(array_map('floatval', explode(',', $target))) ?>, // Ensure proper number format
            color: '#BBCAFF',
            fillOpacity: 0.3,
            lineWidth: 0,
            marker: {
                radius: 2
            }
        }
    ]
});
</script>