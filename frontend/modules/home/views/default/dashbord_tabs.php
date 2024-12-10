<?php
use common\helpers\Path;

$apiData = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['apiData'])) {
    // เก็บข้อมูลที่ส่งมาจาก JavaScript
    $apiData = json_decode($_POST['apiData'], true);
    // ตอนนี้ $apiData จะเก็บข้อมูลที่ได้รับจาก API
    // คุณสามารถทำการประมวลผลหรือแสดงข้อมูลนี้ได้ที่นี่
}

?>
<div class="nav nav-tabs d-flex justify-content-between align-items-center">
    <!-- คำทางซ้าย -->
    <div>
        <h5 class="mb-0">Team of December 2024</h5>
    </div>
    <!-- แท็บทางขวา -->
    <ul class="nav nav-tabs dashboard-tabs justify-content-end" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="company-kpi-tab" data-bs-toggle="tab" href="#company-kpi" role="tab"
                aria-controls="company-kpi" aria-selected="true" onclick="loadTabContent('company-kpi-tab')">
                <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/company.svg" alt="Company" class="pim-icon"
                    style="width: 14px; height: 14px; padding-bottom: 4px; margin-top: 5px">Company
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="team-kpi-tab" data-bs-toggle="tab" href="#team-kpi" role="tab"
                aria-controls="team-kpi" aria-selected="false" onclick="loadTabContent('team-kpi-tab')">
                <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/team.svg" alt="Team" class="pim-icon"
                    style="width: 13px; height: 13px; padding-bottom: 2px; margin-top: 2px"> Team
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="self-kpi-tab" data-bs-toggle="tab" href="#self-kpi" role="tab"
                aria-controls="self-kpi" aria-selected="false" onclick="loadTabContent('self-kpi-tab')">
                <img src="<?=Yii::$app->homeUrl?>images/icons/Settings/self.svg" alt="Self" class="pim-icon"
                    style="width: 13px; height: 13px; padding-bottom: 3px; margin-top: 2px"> Self
            </a>
        </li>
    </ul>
</div>




<!-- Tab Content -->
<div class="tab-content" id="dynamic-content">

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {

    let loadedTabs = {};

    function loadTabContent(tabId) {
        console.log('Loading data for tab: ' + tabId); // ตรวจสอบว่าแท็บที่ถูกคลิกคืออะไร

        if (loadedTabs[tabId]) {
            return; // ถ้าแท็บนี้เคยโหลดแล้ว ไม่โหลดซ้ำ
        }

        let apiUrl = "";
        const companyId = "<?= $companyId ?>"; // รับค่าจาก PHP
        const employeeId = "<?= $employeeId ?>"; // รับค่าจาก PHP
        const teamId = "<?= $teamId ?>"; // รับค่าจาก PHP

        // กำหนด URL ของ API ตามแท็บที่เลือก
        if (tabId === "company-kpi-tab") {
            apiUrl = `<?= Path::Api() ?>home/dashbord/dashbord-company?companyId=${companyId}`;
        } else if (tabId === "team-kpi-tab") {
            apiUrl = `<?= Path::Api() ?>home/dashbord/dashbord-team?companyId=${companyId}&teamId=${teamId}`;
        } else if (tabId === "self-kpi-tab") {
            apiUrl =
                `<?= Path::Api() ?>home/dashbord/dashbord-employee?companyId=${companyId}&teamId=${teamId}&employeeId=${employeeId}`;
        }

        if (apiUrl) {
            document.getElementById("dynamic-content").innerHTML = "Loading..."; // แสดงข้อความกำลังโหลด
            fetch(apiUrl)
                .then((response) => response.json())
                .then((data) => {
                    console.log('Data received for ' + tabId, data); // ตรวจสอบข้อมูลที่ได้รับ

                    // ส่งข้อมูลที่ได้รับไปยัง PHP
                    fetch('', { // ใช้ URL เดียวกัน (หน้าปัจจุบัน)
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: new URLSearchParams({
                                apiData: JSON.stringify(data),
                            }),
                        })
                        .then(response => response.text())
                        .then(responseData => {
                            console.log('Response from PHP:', responseData); // ตรวจสอบคำตอบจาก PHP
                        })
                        .catch(error => console.error('Error sending data to PHP:', error));

                    // ใช้ data ที่ได้รับจาก API โดยไม่ต้องสร้าง HTML เพิ่ม
                    document.getElementById("dynamic-content").innerHTML = `
                        <h4>${tabId.replace("-tab", "").toUpperCase()}</h4>
                        <pre>${JSON.stringify(data, null, 2)}</pre>
                    `;
                    loadedTabs[tabId] = true; // บันทึกว่าแท็บนี้โหลดแล้ว
                })
                .catch((error) => {
                    console.error("Error loading data for " + tabId, error);
                    document.getElementById("dynamic-content").innerHTML = `
                        <p class="text-danger">Error loading data. Please try again later.</p>
                    `;
                });
        }
    }



    // ตรวจจับการเปลี่ยนแท็บ
    document.querySelectorAll(".nav-link").forEach((tab) => {
        tab.addEventListener("shown.bs.tab", function(event) {
            loadTabContent(event.target.id);
        });
    });

    // โหลดเนื้อหาของแท็บที่ active ครั้งแรก
    const activeTab = document.querySelector(".nav-link.active");
    if (activeTab) {
        loadTabContent(activeTab.id);
    }

    // Function to create a pie chart
    function createPieChart(chartId, percentage, colors) {
        const ctx = document.getElementById(chartId).getContext('2d');

        const data = {
            datasets: [{
                data: [percentage * 100, 100 - percentage * 100], // คำนวณเปอร์เซ็นต์
                backgroundColor: colors,
                borderWidth: 0
            }]
        };

        const options = {
            responsive: true,
            cutoutPercentage: 70, // ลดขนาดของรูตรงกลาง
            plugins: {
                tooltip: {
                    enabled: false // ปิด tooltip
                }
            },
            // การวาดข้อความในส่วนกลาง
            animation: {
                onComplete: function() {
                    const width = this.chart.width;
                    const height = this.chart.height;
                    const ctx = this.chart.ctx;

                    ctx.restore();
                    ctx.font = "10px "; // กำหนดฟอนต์
                    ctx.fillStyle = "#000"; // กำหนดสีของข้อความ
                    ctx.textAlign = "center"; // กำหนดให้อยู่กลาง
                    ctx.textBaseline = "middle"; // กำหนดแนวตั้งให้อยู่กลาง

                    // คำนวณตำแหน่งกลางของกราฟ
                    const centerX = width / 1.85;
                    const centerY = height / 1.65;

                    // แสดงข้อความ (เปอร์เซ็นต์)
                    const percentageText = `${Math.round(percentage * 100)}%`; // เปอร์เซ็นต์
                    ctx.fillText(percentageText, centerX, centerY); // วาดข้อความ
                    ctx.save();
                }
            }
        };

        return new Chart(ctx, {
            type: 'pie',
            data: data,
            options: options
        });
    }

    // Set up pie charts with different color schemes and percentages
    const percentageKFI = 0.34; // เปอร์เซ็นต์ KFI
    const percentageKGI = 0.84; // เปอร์เซ็นต์ KGI
    const percentageKPI = 0.54; // เปอร์เซ็นต์ KPI

    // สร้างกราฟ pie
    createPieChart('pieChartKFI', percentageKFI, ['#748EE9', '#CCD7FF']);
    createPieChart('pieChartKGI', percentageKGI, ['#FDCA40', '#FFF2D6']);
    createPieChart('pieChartKPI', percentageKPI, ['#FF715B', '#FFEAE6']);
});
</script>