<?php
$this->title = "Dashboard"
?>
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