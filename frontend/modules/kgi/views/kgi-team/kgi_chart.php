<div id="container" class="alert" style="width:100%; height:551px;"></div>

<?php
// แปลงข้อมูลจาก result และ target เป็นตัวเลข
$actualData = array_map('floatval', explode(',', $result));
$targetData = array_map('floatval', explode(',', $target));

// คำนวณค่า Difference และเพิ่มเข้าไปใน Actual
$actualWithDifference = array_map(function ($actual, $target) {
    $diff = $target - $actual; // คำนวณความต่าง
    return [
        'y' => $actual,  // Actual value
        'difference' => $diff // Difference value
    ];
}, $actualData, $targetData);

// คำนวณค่า Target
$targetWithDifference = array_map(function ($actual, $target) {
    return ['y' => $target];  // Target value
}, $actualData, $targetData);
?>

<script>
Highcharts.chart('container', {
    chart: {
        type: 'line' // กำหนดประเภทกราฟเป็น line
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
        categories: <?= json_encode(explode(',', $month)) ?> // แปลงข้อมูลเดือนเป็น JSON array
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
        symbolWidth: 0,
        useHTML: true,
        labelFormatter: function() {
            let icon = this.name === 'Actual' ? 'KGI-actual.svg' : 'KGI-target.svg';
            return `<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/${icon}" style="width: 35px; height: 35px; vertical-align: middle;"> ${this.name}`;
        },
        itemStyle: {
            fontWeight: 'bold',
            color: '#333'
        }
    },
    tooltip: {
        useHTML: true,
        formatter: function() {
            let formatter = new Intl.NumberFormat('en-US');

            // Get the actual value from the "Actual" series
            let target = this.series.chart.series[0].data[this.point.index]?.y || 0;
            // Get the target value from the "Target" series
            let actual = this.series.chart.series[1].data[this.point.index]?.y || 0;
            let difference = target !== 0 ? ((target - actual) / target) * 100 : 0;
            let diffColor = difference < 0 ? 'red' : 'black';

            return ` 
        <div style="position: relative; display: flex; justify-content: space-between; gap: 20px; text-align: center;">
            <div>
                <span style="font-size: 12px; color: #666;">Target</span><br>
                <span style="font-weight: bold; font-size: 14px;">${formatter.format(target)}</span><br>
                <span style="font-size: 12px; color: #666;">Result</span><br>
                <span style="font-weight: bold; font-size: 14px; color: ${actual < 0 ? 'red' : 'black'};">${formatter.format(actual)}</span>
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
            type: 'area',
            name: 'Target',
            data: <?= json_encode(array_map('floatval', explode(',', $target))) ?>, // ใช้ข้อมูล Target ที่แปลงแล้ว
            color: '#FFA800',
            fillOpacity: 0.3,
            lineWidth: 0,
            marker: {
                radius: 2
            }
        },
        {
            type: 'line',
            name: 'Actual',
            data: <?= json_encode($actualWithDifference) ?>, // ใช้ข้อมูล Actual พร้อมกับ Difference
            color: '#FFCA31',
            lineWidth: 3,
            marker: {
                radius: 2
            }
        }
    ]
});
</script>