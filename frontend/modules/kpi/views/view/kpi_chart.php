<div id="container" style="width:100%; height:100%;"></div>
<?php
$actualData = array_map('floatval', explode(',', $result));
$targetData = array_map('floatval', explode(',', $target));

// คำนวณค่า Difference และเพิ่มเข้าไปใน Actual
$actualWithDifference = array_map(function($actual, $target) {
    $diff = $target - $actual; // คำนวณความต่าง
    return [$actual, $diff];   // ใส่เป็น [Actual, Difference]
}, $actualData, $targetData);
?>
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
    tooltip: {
        useHTML: true,
        formatter: function() {
            let actual = this.series.chart.series[0].data[this.point.index]?.y || 0;
            let target = this.series.chart.series[1].data[this.point.index]?.y || 0;
            let difference = target !== 0 ? ((target - actual) / target) * 100 : 0;
            let diffColor = difference < 0 ? 'red' : 'black';

            return `
            <div style="position: relative; display: flex; justify-content: space-between; gap: 20px; text-align: center;">
                <div>
                    <span style="font-size: 12px; color: #666;">Target</span><br>
                    <span style="font-weight: bold; font-size: 14px;">${target.toFixed(0)}</span><br>
                    <span style="font-size: 12px; color: #666;">Result</span><br>
                    <span style="font-weight: bold; font-size: 14px; color: ${actual < 0 ? 'red' : 'black'};">${actual.toFixed(0)}</span>
                </div>
                <div>
                    <br>
                    <span style="font-size: 12px; color: #666;">Gap</span><br>
                    <span style="font-weight: bold; font-size: 14px; color: ${diffColor};">${difference.toFixed(0)}%</span>
                </div>
            </div>
        `;
        }
    },
    series: [{
            type: 'line',
            name: 'Actual',
            data: <?= json_encode(array_map(function($actual, $target) {
                return [
                    'y' => $actual,  // ค่าของ Actual 
                    'difference' => $target - $actual // ค่าความต่าง
                ];
            }, $actualData, $targetData)) ?>, // ใช้ค่าที่มี Difference
            color: '#FF715B',
            lineWidth: 1,
            marker: {
                radius: 2
            },
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