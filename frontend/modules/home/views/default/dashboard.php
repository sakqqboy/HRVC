<?php
$this->title = "Dashboard";
?>
<style>
    @media (max-width: 1735px) and (max-height: 950px) {
        .dashboard-container {
            transform: scale(0.85);
            transform-origin: top left;
            width: calc(100vw / 0.85);
            height: calc(100vh / 0.85);
            /* overflow: hidden; */
            /* box-sizing: border-box; */
        }
    }

    @media (max-width: 1535px) and (max-height: 950px) {
        .dashboard-container {
            transform: scale(0.75);
            transform-origin: top left;
            width: calc(100% / 0.75);
            height: calc(100% / 0.75);
            /* overflow: hidden; */
        }
    }

    @media (max-width: 1335px) and (max-height: 750px) {
        .dashboard-container {
            transform: scale(0.65);
            transform-origin: top left;
            width: calc(100% / 0.65);
            height: calc(100% / 0.65);
            margin-left: -2px;

            /* overflow: hidden; */
        }
    }
</style>
<div class="dashboard-container mt-50">
    <div class="row pl-4">
        <div class="aler pim-body bg-white" style="margin-top: -10px;">
            <!-- <div id="screen-size" style="font-size: 16px; color: #333;">แสดงขนาดหน้าจอ</div> -->

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