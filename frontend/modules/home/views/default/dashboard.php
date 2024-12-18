<?php
$this->title = "Dashboard"
?>
<div class="row pl-4">

    <div class="aler pim-body bg-white" style="margin-top: -10px;">

        <div class="row">
            <!-- Chart & Tabs -->
            <div class="col-lg-9">
                <!-- Chart -->
                <div class="dashboard-chart mb-4 p-3">
                    <!-- Chart Content -->
                    <?= $this->render('dashboard_chart') ?>
                </div>

                <!-- Tabs -->
                <div class="mb-4 mt-15">
                    <!-- Tab Content -->
                    <?= $this->render('dashbord_tabs', ['companyId' => $employeeProfile['companyId'],'teamId' => $employeeProfile['teamId'],'employeeId' => $employeeProfile['employeeId']]) ?>
                </div>
            </div>

            <!-- rofile & Schedule -->
            <div class="col-lg-3">
                <!-- Profile -->
                <div class="profile-card p-3 mb-4 mt-15">
                    <!-- Profile Content-->
                    <?= $this->render('dashbord_profile', ['employeeProfile' => $employeeProfile]) ?>
                </div>

                <!-- navigation -->
                <div>
                    <!-- navigation Content -->
                    <?= $this->render('dashbord_navigation') ?>

                </div>
            </div>
        </div>
    </div>


</div>