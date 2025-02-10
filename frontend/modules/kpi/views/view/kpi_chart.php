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
        categories: <?= json_encode(explode(',', $month)) ?> // แปลงข้อมูลให้เป็น JSON array
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
        symbolWidth: 0, // ซ่อนสัญลักษณ์เริ่มต้น
        useHTML: true,
        labelFormatter: function() {
            let icon = (this.name === 'Actual') ? 'KPI-actual.svg' : 'KPI-target.svg';
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
            data: <?= json_encode(array_map('floatval', explode(',', $result))) ?>, // แปลงข้อมูลให้เป็นตัวเลข
            color: '#FF715B',
            lineWidth: 1,
            marker: {
                radius: 2
            }
        },
        {
            type: 'area',
            name: 'Target',
            data: <?= json_encode(array_map('floatval', explode(',', $target))) ?>, // แปลงข้อมูลให้เป็นตัวเลข
            color: '#FAB8AE',
            fillOpacity: 0.3,
            lineWidth: 0,
            marker: {
                radius: 2
            }
        }
    ]
});
</script>