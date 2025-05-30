<div id="container" class="alert" style="width:100%; height:551px;"></div>

<?php
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

$targetWithDifference = array_map(function ($actual, $target) {
    return ['y' => $target];  // Target value
}, $actualData, $targetData);
?>

<script>
Highcharts.chart('container', {
    chart: {
        type: 'line' // Both series will use line chart style
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
        categories: <?= json_encode(explode(',', $month)) ?> // Convert months into JSON array
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
            let icon = this.name === 'Actual' ? 'KFI-actual.svg' : 'KFI-target.svg';
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

            let targetValue = this.series.chart.series[0].data[this.point.index]?.y || 0;
            let actualValue = this.series.chart.series[1].data[this.point.index]?.y || 0;

            let difference = targetValue !== 0 ? ((targetValue - actualValue) / targetValue) * 100 : 0;
            let diffColor = difference < 0 ? 'red' : 'black';

            // Format numbers after they are rounded
            let target = formatter.format(targetValue.toFixed(0));
            let actual = formatter.format(actualValue.toFixed(0));
            let gap = formatter.format(difference.toFixed(0));

            return `
            <div style="position: relative; display: flex; justify-content: space-between; gap: 20px; text-align: center;">
                <div>
                    <span style="font-size: 12px; color: #666;">Target</span><br>
                    <span style="font-weight: bold; font-size: 14px;">${target}</span><br>
                    <span style="font-size: 12px; color: #666;">Result</span><br>
                    <span style="font-weight: bold; font-size: 14px; color: ${actualValue < 0 ? 'red' : 'black'};">${actual}</span>
                </div>
                <div>
                    <br>
                    <span style="font-size: 12px; color: #666;">Gap</span><br>
                    <span style="font-weight: bold; font-size: 14px; color: ${diffColor};">${gap}%</span>
                </div>
            </div>
        `;
        }
    },
    series: [{
            type: 'area',
            name: 'Target',
            data: <?= json_encode(array_map('floatval', explode(',', $target))) ?>, // Ensure numeric format
            color: '#7A92E7',
            fillOpacity: 0.3,
            lineWidth: 0,
            marker: {
                radius: 2
            }
        },
        {
            type: 'line',
            name: 'Actual',
            data: <?= json_encode($actualWithDifference) ?>, // Pass data with Difference
            color: '#19338D',
            lineWidth: 3,
            marker: {
                radius: 2
            }
        }
    ]
});
</script>