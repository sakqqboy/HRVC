<?php
$this->title = "Dashboard";
?>


<!-- เพิ่ม meta tag สำหรับการซูม -->
<!-- <meta name="view   port" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> -->

<style>
@media (max-width: 1240px) and (max-height: 578px) {
    .dashboard-container {
        transform: scale(0.64);
        /* ลดขนาดลงเป็น 67% */
        transform-origin: top left;
        /* จุดเริ่มต้นของการย่อ */
        width: calc(100% / 0.64);
        /* เพื่อรักษาพื้นที่ตามสัดส่วน */
        height: calc(100% / 0.64);
        /* ให้ครอบคลุมพื้นที่ทั้งหมด */
        overflow: hidden;
        /* ซ่อนส่วนที่เกิน */
    }

}
</style>

<div class="dashboard-container">
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
</div>