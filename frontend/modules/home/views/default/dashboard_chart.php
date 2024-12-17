<style>
.chart-graph.hide-legend-images .highcharts-legend-item .highcharts-area,
.chart-graph.hide-legend-images .highcharts-legend-item .highcharts-point,
.chart-graph.hide-legend-images .highcharts-legend-item .highcharts-graph {
    display: none;
}
</style>
<div class="chart-container">
    <button id="prevButton" class="chart-nav-button">
        <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/left.svg" alt="Previous">
    </button>
    <div id="container" class="chart-graph"></div>
    <button id="nextButton" class="chart-nav-button">
        <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/right.svg" alt="Next">
    </button>

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
    <?php $baseUrl = Yii::$app->homeUrl;?>

    const renderChart = (currentCategory, type) => {
        document.querySelector('.chart-graph').classList.add('hide-legend-images');
        //ตรงนี้จะเเปลี่ยนเป็นajaxไปดึงค่า โดยส่ง  currentCategory  และ type ไปเพื่อแยก  Chart ว่าจะใช้ดาต้าไหน 

        const baseUrl = '<?= $baseUrl ?>'; // Base URL จาก PHP
        var url = `${baseUrl}home/dashboard/chart-dashbord`;

        alert(currentCategory);
        alert(type);
        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: url,
            data: {
                currentCategory: currentCategory,
                type: type
            },
            success: function(data) {
                console.log(data); // Check the structure of the data in the console
                const chartsData = data.data; // This replaces the static chartsData
                const chartData = chartsData[0];
                // alert(JSON.stringify(chartsData[0], null,
                //     2)); 

                // Update chart based on the selected index
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
                        categories: categories, // ใช้ categories ที่ได้จาก PHP
                        plotLines: [{
                            color: '#007BFF',
                            width: 1,
                            value: currentMonth, // ตำแหน่งของ plotLine คือตามเดือนปัจจุบัน
                            label: {
                                text: 'Today',
                                align: 'right',
                                y: -10, // เลื่อนขึ้น (- คือลดลง, + คือลงล่าง)
                                x: 20, // เลื่อนขึ้น (- คือลดลง, + คือลงล่าง)
                                style: {
                                    color: '#007BFF', // เปลี่ยนสีข้อความ
                                    fontWeight: 'bold', // ความหนาของฟอนต์
                                    fontSize: '12px', // ขนาดฟอนต์
                                    backgroundColor: '#007BFF', // สีพื้นหลัง
                                    fontFamily: 'Verdana, sans-serif', // ฟอนต์ที่ต้องการ
                                    textDecoration: 'underline' // ตกแต่งข้อความ เช่น เส้นใต้
                                },
                                rotation: 0
                            },
                            zIndex: 3
                        }]
                    },
                    yAxis: {
                        title: {
                            text: 'Amount'
                        },
                        min: 0,
                        max: 100, // กำหนดให้ค่ามากสุดเป็น 100%
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
                        useHTML: true,
                        labelFormatter: function() {
                            let iconPath = '';
                            if (this.name == 'Gap') {
                                if (currentIndex == 0) iconPath =
                                    'KFI-actual.svg'; // KFI
                                else if (currentIndex == 1) iconPath =
                                    'KGI-actual.svg'; // KGI
                                else if (currentIndex == 2) iconPath =
                                    'KPI-actual.svg'; // KPI

                            } else if (this.name == 'Performance') {
                                if (currentIndex == 0) iconPath =
                                    'KFI-target.svg'; // KFI
                                else if (currentIndex == 1) iconPath =
                                    'KGI-target.svg'; // KGI
                                else if (currentIndex == 2) iconPath =
                                    'KPI-target.svg'; // KPI

                            }

                            return '<img src="<?=Yii::$app->homeUrl?>images/icons/Settings/' +
                                iconPath +
                                '" style="width: 35px; height: 35px; vertical-align: middle;">' +
                                this
                                .name;
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
                        pointFormat: '<span style="color:{series.color}">\u25CF</span> {series.name}: <b>{point.y}</b><br>'
                    }
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