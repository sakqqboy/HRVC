<div id="container" style="width:100%; height:100%;"></div>

<?php
$actualData = array_map('floatval', explode(',', $result));
$targetData = array_map('floatval', explode(',', $target));

// คำนวณค่า Difference และเพิ่มเข้าไปใน Actual
$actualWithDifference = array_map(function($actual, $target) {
    return [
        'y' => $actual,  // ค่าของ Actual 
        'difference' => $target - $actual // ค่าความต่าง
    ];
}, $actualData, $targetData);
?>

<script>
Highcharts.chart('container', {
    chart: {
        type: 'line'
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
        categories: <?= json_encode(explode(',', $month)) ?>
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
    series: [{
            type: 'area',
            name: 'Target',
            data: <?= json_encode(array_map('floatval', explode(',', $target))) ?>,
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
            data: <?= json_encode($actualWithDifference) ?>,
            color: '#19338D',
            lineWidth: 3,
            marker: {
                radius: 2
            },
            tooltip: {
                pointFormatter: function() {
                    let diffColor = this.point.difference < 0 ? 'red' : 'black';
                    return `
                        <span style="color:${this.color}">\u25CF</span> ${this.series.name}: <b>${this.y}</b><br>
                        <span style="color:${diffColor}">\u25CF</span> Difference: <b style="color:${diffColor}">${this.point.difference}</b>
                    `;
                }
            }
        }
    ],
    tooltip: {
        shared: true,
        useHTML: true,
        headerFormat: '<b>{point.key}</b><br>',
        formatter: function() {
            let result = 0,
                target = 0,
                difference = 0;

            this.points.forEach(point => {
                if (point.series.name === 'Actual') {
                    result = parseFloat(point.y);
                } else if (point.series.name === 'Target') {
                    target = parseFloat(point.y);
                }
            });

            // คำนวณ Gap เป็น %
            if (target !== 0) {
                difference = ((target - result) / target) * 100;
            }

            // เช็คถ้าติดลบให้เป็นสีแดง
            let diffColor = difference < 0 ? 'red' : 'black';

            return `
            <div style="display: flex; justify-content: center; align-items: center; gap: 20px; text-align: center;">
                <div>
                    <span style="font-size: 12px; color: #666;">Target</span><br>
                    <span style="font-weight: bold; font-size: 14px;">
                        ${target.toFixed(2)}
                    </span>
                    <br><br>
                    <span style="font-size: 12px; color: #666;">Result</span><br>
                    <span style="font-weight: bold; font-size: 14px; color: ${result < 0 ? 'red' : 'black'};">
                        ${result.toFixed(2)}
                    </span>
                </div>
                <div>
                    <span style="font-size: 12px; color: #666;">Gap (%)</span><br>
                    <span style="font-weight: bold; font-size: 14px; color: ${diffColor};">
                        ${difference.toFixed(2)}%
                    </span>
                </div>
            </div>
            <div style="position: absolute; left: 50%; top: -20px; transform: translateX(-50%); width: 0; height: 0; 
                border-left: 20px solid transparent; 
                border-right: 20px solid transparent; 
                border-bottom: 30px solid #fff;">
            </div>
        `;
        }
    }

});
</script>