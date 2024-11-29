<?php

?>
<div class="alert mt-10 pim-body bg-white">
    <!-- Dashboard Header -->
    <div class="d-flex align-items-center mb-4">
        <img src="/HRVC/frontend/web/images/icons/black-icons/FinancialSystem/Group23177.svg" class="me-3" alt="Icon"
            style="width: 40px;">
        <span class="dashboard-title">Performance Matrices Dashboard</span>
    </div>

    <div class="row">
        <!-- Chart & Tabs -->
        <div class="col-lg-8">
            <!-- Chart -->
            <div class="dashboard-chart mb-4 p-3">
                <!-- Chart Content -->
                <?= $this->render('dashboard_chart') ?>
            </div>

            <!-- Tabs -->
            <div class="mb-4 mt-15">
                <!-- Tab Content -->
                <?= $this->render('dashbord_tabs') ?>
            </div>
        </div>

        <!-- rofile & Schedule -->
        <div class="col-lg-4">
            <!-- Profile -->
            <div class="profile-card p-3 mb-4 mt-15">
                <!-- Profile Content-->
                <?= $this->render('dashbord_profile') ?>
            </div>

            <!-- navigation -->
            <div>
                <!-- navigation Content -->
                <?= $this->render('dashbord_navigation') ?>

            </div>
        </div>
    </div>
</div>