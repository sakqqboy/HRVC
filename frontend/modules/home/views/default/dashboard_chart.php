<div class="chart-container">

    <div class="chart-prevnext-Button">
        <button id="prevButton" class="chart-nav-button">
            <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/left.svg" alt="Previous">
        </button>
        <div id="container" class="chart-graph"></div>
        <button id="nextButton" class="chart-nav-button">
            <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/right.svg" alt="Next">
        </button>
    </div>

    <div class="chart-company-info">
        <img id="companyImg" src="<?=Yii::$app->homeUrl?>images/icons/Dark/48px/company.svg" alt="Company Icon"
            class="chart-icon" style="display:none;">
        <img id="teamImg" src="<?=Yii::$app->homeUrl?>images/icons/Settings/team.svg" alt="Team Icon" class="chart-icon"
            style="display:none;">
        <img id="selfImg" src="<?=Yii::$app->homeUrl?>images/icons/Settings/self.svg" alt="Self Icon" class="chart-icon"
            style="display:none;">
        <span id="infoSpan">Company</span>
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


<?php
$currentYear = date("Y");  // ปีปัจจุบัน
$currentYear = substr($currentYear, -2);  // Extract the last two digits

$months = array(
    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
);

$categories = array();
foreach ($months as $month) {
    $categories[] = $month . ' ' . $currentYear;
}

$currentMonth = date("n") - 1;  // ลบ 1 เพราะค่าเดือนใน PHP เริ่มจาก 1-12 แต่ใน JavaScript เริ่มจาก 0-11
// $categories = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']; // สร้าง Array ของชื่อเดือน
?>
<script src="https://code.highcharts.com/highcharts.js"></script>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const categories = <?php echo json_encode($categories); ?>;
    const currentMonth = <?php echo $currentMonth; ?>; // ใช้ค่าเดือนปัจจุบันจาก PHP
    let currentIndex = 0; // Default to KFI
    let currentCategory = "Company"; // Default category is "Company"
    let type = "KFI";
    <?php 
    // $baseUrl = Yii::$app->homeUrl;
    ?>

    var $baseUrl = window.location.protocol + "/ / " + window.location.host;
    if (window.location.host == 'localhost') {
        $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
    } else {
        $baseUrl = window.location.protocol + "//" + window.location.host + '/';
    }
    $url = $baseUrl;

    const renderChart = (currentCategory, type) => {
        document.querySelector('.chart-graph').classList.add('hide-legend-images');
        //ตรงนี้จะเเปลี่ยนเป็นajaxไปดึงค่า โดยส่ง  currentCategory  และ type ไปเพื่อแยก  Chart ว่าจะใช้ดาต้าไหน 

        var url = $url + `home/dashboard/chart-dashbord`;

        // alert(currentCategory);
        // alert(type);
        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: url,
            data: {
                currentCategory: currentCategory,
                type: type
            },
            success: function(data) {
                // console.log(data); // Check the structure of the data in the console
                const chartsData = data.data;
                const chartData = chartsData[0];

                const maxData = chartData.series[0].data;
                const maxValue = Math.max(...maxData); // หาค่าที่มากที่สุด
                const max = maxValue > 100 ? maxValue : 100;
                // alert(JSON.stringify(maxValue, null,
                //     2));
                // alert("ค่าสูงสุดคือ: " + maxValue);

                // Update chart based on the selected index
                Highcharts.chart('container', {
                    chart: {
                        type: 'line',
                        spacingTop: -20, // เพิ่มช่องว่างด้านบน
                        spacingBottom: 10, // เพิ่มช่องว่างด้านล่าง
                        spacingLeft: 20, // เพิ่มช่องว่างด้านซ้าย
                        spacingRight: 20, // เพิ่มช่องว่างด้านขวา
                        // backgroundColor: '#FFFFFF',
                        borderRadius: 10,
                        style: {
                            fontFamily: 'Arial'
                        }
                    },
                    title: {
                        text: chartData.title,
                        align: 'left',
                        style: {
                            fontSize: '20px',
                            fontFamily: 'SF Pro Display',
                            fontStyle: 'normal',
                            fontWeight: '500',
                            color: '#3C3D48'
                        },
                        x: 65,
                        y: 65
                    },
                    xAxis: {
                        categories: categories, // ใช้ categories ที่ได้จาก PHP
                        plotLines: [{
                            color: '#2580D3',
                            width: 1,
                            value: currentMonth, // ตำแหน่งของ plotLine คือตามเดือนปัจจุบัน
                            label: {
                                text: 'Today',
                                align: 'right',
                                y: -10, // เลื่อนขึ้น (- คือลดลง, + คือลงล่าง)
                                x: 25, // เลื่อนขึ้น (- คือลดลง, + คือลงล่าง)
                                useHTML: true, // ใช้ HTML แทนข้อความธรรมดา
                                style: {
                                    color: '#FFFFFF', // สีข้อความ
                                    fontWeight: 'bold', // ตัวหนา
                                    fontSize: '10px', // ขนาดฟอนต์
                                    fontFamily: 'Verdana, sans-serif',
                                },
                                formatter: function() {
                                    return `<div style="
                                           display: flex;
                                            width: 49.579px;
                                            height: 16.526px;
                                            padding: 4.065px 4.743px;
                                            flex-direction: column;
                                            justify-content: center;
                                            align-items: center;
                                            gap: 6.776px;
                                            flex-shrink: 0;
                                            border-radius: 27.78px;
                                            background: var(--Primary-Blue---HRVC, #2580D3);
                                        ">Today</div>`;
                                },
                                rotation: 0
                            },
                            zIndex: 3
                        }]
                    },
                    yAxis: {
                        title: {
                            text: 'Amount',
                            style: {
                                color: '#000', // สีข้อความ
                                fontWeight: 'bold', // ตัวหนา
                                fontSize: '14px', // ขนาดฟอนต์
                                fontWeight: '400',
                                fontFamily: 'SF Pro Text',
                                letterSpacing: '0.5px'
                            },
                        },
                        min: 0,
                        max: max, // กำหนดให้ค่ามากสุดเป็น 100%
                        gridLineColor: '#E6E6E6',
                        labels: {
                            formatter: function() {
                                return this.value +
                                    '%'; // เพิ่มเครื่องหมาย % หลังค่าบนแกน y
                            }
                        }
                    },
                    legend: {
                        align: 'right',
                        verticalAlign: 'top',
                        layout: 'horizontal',
                        symbolRadius: 0,
                        symbolWidth: 0, // ซ่อนสัญลักษณ์มาตรฐาน
                        useHTML: true,
                        labelFormatter: function() {
                            let iconPath = '';
                            if (this.name == 'Performance') {
                                if (currentIndex == 0) iconPath =
                                    'KFI-target.svg'; // KFI
                                else if (currentIndex == 1) iconPath =
                                    'KGI-target.svg'; // KGI
                                else if (currentIndex == 2) iconPath =
                                    'KPI-target.svg'; // KPI
                            }
                            return '<img src="<?=Yii::$app->homeUrl?>images/icons/Settings/' +
                                iconPath +
                                '" style="width: 35px; height: 35px; vertical-align: middle;"> ' +
                                this.name;
                        },
                        itemStyle: {
                            fontWeight: 'bold',
                            color: '#333333'
                        }
                    },
                    tooltip: {
                        useHTML: true,
                        shared: false, // ตั้งค่าให้เป็น false เพื่อไม่ให้ข้อมูลจากหลาย series แสดงร่วมกัน
                        split: true, // แยกข้อมูลจากแต่ละ series
                        formatter: function() {
                            let result = '';
                            let gap = '';

                            // ตรวจสอบว่า this.points มีข้อมูลหรือไม่
                            if (this.points) {
                                this.points.forEach(function(point) {
                                    if (point.series.name == 'Result') {
                                        result = point.y.toFixed(2) +
                                            '%'; // แสดงค่า Result
                                    } else if (point.series.name == 'Gap') {
                                        gap = point.y.toFixed(2) +
                                            '%'; // แสดงค่า Gap
                                    }
                                });
                            }

                            // ตรวจสอบว่าค่ามีการแสดงผลหรือไม่
                            if (!result && !gap) {
                                return `<span style="color: red; font-weight: bold;">No data available</span>`; // กรณีไม่มีข้อมูล
                            }

                            return `
                                <span style="font-weight: bold; font-size: 14px;">${this.x}</span> <!-- แสดงชื่อหรือลักษณะของแกน X -->
                                <div style="position: relative; display: flex; justify-content: space-between; gap: 20px; text-align: center;">
                                    <div>
                                        <span style="font-size: 12px; color: #666;">Result</span><br>
                                        <span style="font-weight: bold; font-size: 14px;">${result}</span> <!-- แสดงค่า Result -->
                                    </div>
                                    <div>
                                        <span style="font-size: 12px; color: #666;">Gap</span><br>
                                        <span style="font-weight: bold; font-size: 14px;">${gap}</span> <!-- แสดงค่า Gap -->
                                    </div>
                                </div>
                             `;
                        }
                    },
                    series: chartData.series
                });
            }
        });

    };

    // Function to update the "Company", "Team", or "Self" information
    const infoSpan = document.getElementById('infoSpan');
    const companyImg = document.getElementById('companyImg');
    const teamImg = document.getElementById('teamImg');
    const selfImg = document.getElementById('selfImg');
    const infoList = ['Company', 'Team', 'Self'];

    const updateInfo = () => {
        infoSpan.textContent = infoList[currentCategory == 'Company' ? 0 : currentCategory == 'Team' ? 1 :
            2];
        companyImg.style.display = (currentCategory == 'Company') ? 'block' : 'none';
        teamImg.style.display = (currentCategory == 'Team') ? 'block' : 'none';
        selfImg.style.display = (currentCategory == 'Self') ? 'block' : 'none';

        // Enable/disable navigation buttons based on the current chart
        const prevButton = document.getElementById('prevButton');
        const nextButton = document.getElementById('nextButton');
        if (currentIndex === 0) { // KFI is active
            prevButton.style.display = 'none';
            nextButton.style.display = 'none';
        } else {
            prevButton.style.display = 'inline-block';
            nextButton.style.display = 'inline-block';
        }

        // Re-enable all key buttons
        document.getElementById('KFI').disabled = false;
        document.getElementById('KGI').disabled = false;
        document.getElementById('KPI').disabled = false;
    };



    // Event listeners for KFI, KGI, and KPI
    document.getElementById('KFI').addEventListener('click', () => {
        // alert('ddd');
        currentIndex = 0;
        currentCategory = "Company"; // Change to "Company" automatically when KFI is selected
        type = "KFI";
        updateInfo();
        renderChart(currentCategory, type);
    });

    document.getElementById('KGI').addEventListener('click', () => {
        type = "KGI";
        // alert('ddd');
        currentIndex = 1;
        updateInfo();
        renderChart(currentCategory, type);
    });

    document.getElementById('KPI').addEventListener('click', () => {
        type = "KPI";
        currentIndex = 2;
        updateInfo();
        renderChart(currentCategory, type);
    });

    // Function for "Previous" button
    document.getElementById('prevButton').addEventListener('click', () => {
        currentCategory = (currentCategory == 'Company') ? 'Self' : (currentCategory == 'Self') ?
            'Team' : 'Company';
        renderChart(currentCategory, type);
        updateInfo();
    });

    // Function for "Next" button
    document.getElementById('nextButton').addEventListener('click', () => {
        currentCategory = (currentCategory == 'Company') ? 'Team' : (currentCategory == 'Team') ?
            'Self' : 'Company';
        renderChart(currentCategory, type);
        updateInfo();
    });

    // Initial render
    updateInfo();
    renderChart(currentCategory, type);
});
</script>