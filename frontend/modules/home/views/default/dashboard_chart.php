<div class="chart-container">
    <button id="prevButton" class="chart-nav-button">
        <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/left.svg" alt="Previous">
    </button>
    <div id="container" class="chart-graph"></div>
    <button id="nextButton" class="chart-nav-button">
        <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/right.svg" alt="Next">
    </button>

    <div class="chart-company-info">
        <img src="<?=Yii::$app->homeUrl?>images/icons/Dark/48px/company.svg" alt="Company Icon">
        <span>Company</span>
    </div>

    <div class="chart-button-group">
        <div class="chart-button-wrapper">
            <button id="KFI" class="chart-key-button kfi"></button>
            <span>KFI</span>
        </div>
        <div class="chart-button-wrapper">
            <button id="KGI" class="chart-key-button kgi"></button>
            <span>KGI</span>
        </div>
        <div class="chart-button-wrapper">
            <button id="KPI" class="chart-key-button kpi"></button>
            <span>KPI</span>
        </div>
    </div>
</div>



<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const chartsData = [{
            title: "KFI Performance",
            series: [{
                    type: 'line',
                    name: 'Actual',
                    data: [2.5, 3.2, 4.1, 4.8, 5.0, 5.2, 5.5],
                    color: '#748EE9',
                    lineWidth: 2,
                    marker: {
                        radius: 4,
                        fillColor: '#748EE9'
                    }
                },
                {
                    type: 'area',
                    name: 'Target',
                    data: [3.0, 3.5, 4.5, 5.0, 5.3, 5.7, 6.0],
                    color: '#B4C2F1',
                    fillOpacity: 0.4,
                    lineWidth: 0,
                    marker: {
                        radius: 3
                    }
                }
            ]
        },
        {
            title: "KGI Performance",
            series: [{
                    type: 'line',
                    name: 'Actual',
                    data: [1.8, 2.3, 3.0, 3.5, 4.0, 4.5, 5.0],
                    color: '#FFD000',
                    lineWidth: 2,
                    marker: {
                        radius: 4,
                        fillColor: '#FFD000'
                    }
                },
                {
                    type: 'area',
                    name: 'Target',
                    data: [2.0, 2.8, 3.5, 4.0, 4.5, 5.0, 5.7],
                    color: '#FFBA00',
                    fillOpacity: 0.4,
                    lineWidth: 0,
                    marker: {
                        radius: 3
                    }
                }
            ]
        },
        {
            title: "KPI Performance",
            series: [{
                    type: 'line',
                    name: 'Actual',
                    data: [3.0, 3.7, 4.4, 5.1, 5.8, 6.5, 7.0],
                    color: '#FF715B',
                    lineWidth: 2,
                    marker: {
                        radius: 4,
                        fillColor: '#FF715B'
                    }
                },
                {
                    type: 'area',
                    name: 'Target',
                    data: [3.5, 4.0, 4.8, 5.5, 6.0, 6.5, 7.2],
                    color: '#F20',
                    fillOpacity: 0.4,
                    lineWidth: 0,
                    marker: {
                        radius: 3
                    }
                }
            ]
        }
    ];

    let currentIndex = 0; // ค่าเริ่มต้นสำหรับ KFI

    const renderChart = () => {
        const chartData = chartsData[currentIndex];
        Highcharts.chart('container', {
            chart: {
                type: 'line',
                backgroundColor: '#FFFFFF',
                borderRadius: 10,
                style: {
                    fontFamily: 'Arial'
                }
            },
            title: {
                text: chartData.title,
                align: 'left',
                style: {
                    fontSize: '16px',
                    color: '#333333'
                },
                x: 70,
                y: 15
            },
            xAxis: {
                categories: ['Jan 24', 'Feb 24', 'Mar 24', 'Apr 24', 'May 24', 'Jun 24', 'Jul 24'],
                plotLines: [{
                    color: '#007BFF',
                    width: 1,
                    value: 5,
                    label: {
                        text: 'Today',
                        align: 'right',
                        style: {
                            color: '#007BFF',
                            fontWeight: 'bold'
                        }
                    },
                    zIndex: 3
                }]
            },
            yAxis: {
                title: {
                    text: 'Amount'
                },
                min: 0,
                max: 7.5,
                gridLineColor: '#E6E6E6'
            },
            legend: {
                align: 'right',
                verticalAlign: 'top',
                layout: 'horizontal',
                symbolRadius: 0,
                useHTML: true,
                labelFormatter: function() {
                    if (this.name == 'Actual') {
                        return '<img src="<?=Yii::$app->homeUrl?>images/icons/Settings/KFI-actual.svg" style="width: 35px; height: 35px; vertical-align: middle;">' +
                            this.name;

                    } else if (this.name == 'Target') {
                        return '<img src="<?=Yii::$app->homeUrl?>images/icons/Settings/KFI-target.svg" style="width: 35px; height: 35px; vertical-align: middle;">' +
                            this.name;
                    }
                },
                itemStyle: {
                    fontWeight: 'bold',
                    color: '#333333'
                }
            },
            series: chartData.series,
            tooltip: {
                shared: true,
                useHTML: true,
                headerFormat: '<b>{point.key}</b><br>',
                pointFormat: '<span style="color:{series.color}">\u25CF</span> {series.name}: <b>{point.y}M</b><br>'
            }
        });
    };

    // Event listeners สำหรับปุ่มเลือกกราฟ
    document.getElementById('KFI').addEventListener('click', () => {
        currentIndex = 0; // KFI
        renderChart();
    });

    document.getElementById('KGI').addEventListener('click', () => {
        currentIndex = 1; // KGI
        renderChart();
    });

    document.getElementById('KPI').addEventListener('click', () => {
        currentIndex = 2; // KPI
        renderChart();
    });


    // ปุ่ม prevButton และ nextButton
    document.getElementById('prevButton').addEventListener('click', () => {
        // เปลี่ยนไปกราฟก่อนหน้า
        currentIndex = (currentIndex === 0) ? chartsData.length - 1 : currentIndex - 1;
        renderChart();
    });

    document.getElementById('nextButton').addEventListener('click', () => {
        // เปลี่ยนไปกราฟถัดไป
        currentIndex = (currentIndex === chartsData.length - 1) ? 0 : currentIndex + 1;
        renderChart();
    });

    // เรียกใช้ฟังก์ชัน renderChart เพื่อแสดงกราฟเริ่มต้น
    renderChart();
});
</script>