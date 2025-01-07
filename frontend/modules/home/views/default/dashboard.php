<?php
$this->title = "Dashboard";
?>


<!-- เพิ่ม meta tag สำหรับการซูม -->
<!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<style>
/* ซูมเอ้าท์เฉพาะหน้าจอที่ต่ำกว่า 1240x578 */
@media (max-width: 1240px) and (max-height: 578px) {
    profile-card {
        transform: scale(0.67);
        /* ลดขนาด */
        transform-origin: top left;
        /* จุดเริ่มต้นการซูม */
        overflow: hidden;
        /* ซ่อนส่วนที่เกินขอบ */
    }
} -->
</style>

<div class="row pl-4">

    <div class="aler pim-body bg-white" style="margin-top: -10px;">

        <div class="row">
            <!-- Chart -->
            <div class="col-lg-9 p-3">
                <div class="dashboard-chart h-100">
                    <?= $this->render('dashboard_chart') ?>
                </div>
            </div>

            <!-- Profile -->
            <div class="col-lg-3 p-3">
                <div class="profile-card h-100">
                    <?= $this->render('dashbord_profile', ['employeeProfile' => $employeeProfile]) ?>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Tabs -->
            <div class="col-lg-9 p-3">
                <div class="dashboard-tabs">
                    <?= $this->render('dashbord_tabs', [
                        'companyId' => $employeeProfile['companyId'],
                        'teamId' => $employeeProfile['teamId'],
                        'employeeId' => $employeeProfile['employeeId']
                    ]) ?>
                </div>
            </div>

            <!-- Navigation -->
            <div class="col-lg-3 p-3">
                <div class="dashboard-navigation">
                    <?= $this->render('dashbord_navigation', [
                        'pendingApprove' => $pendingApprove
                    ]) ?>
                </div>
            </div>
        </div>

    </div>

</div>