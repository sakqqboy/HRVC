<?php

use Faker\Core\Number;

$this->title = 'Generate Report';
?>

<div class="col-12 mt-90 alert alert-Evaluator">
    <div class="alert aler-ALLDepartment">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-2 col-md-6 col-6">
                    <div class="col-12 nameCenter">
                        Reporting Center
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-6 text-end">
                    <div class="col-12">
                        <span class="badge filedownloadPDF">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/downloadPDF.png" class="imagesdownloadPDF"> Download PDF
                        </span>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-6">
                    <div class="col-12">
                        <span class="badge filedownloadPDF">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/downloadXL.png" class="imagesdownloadPDF"> Download PDF
                        </span>
                    </div>
                </div>
                <div class="col-lg-1 col-md-6 col-6">
                    <div class="col-12">
                        <span class="badge filedownloadPDF">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/printer.png" class="imagesdownloadPDF"> Print
                        </span>
                    </div>
                </div>
                <div class="col-lg-1 col-md-6 col-6">
                    <select class="form-select BTH-print" aria-label="Default select example">
                        <option selected="" value="">Select</option>
                        <option value="1">BTH (฿) </option>
                        <option value="2">BTH (฿) </option>
                        <option value="3">BTH (฿) </option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-6 col-6">
                    <select class="form-select til-print" aria-label="Default select example">
                        <option selected="" value="">Evaluation Term</option>
                        <option value="1">Team</option>
                        <option value="2">IT</option>
                        <option value="3">Management</option>
                    </select>
                </div>
                <div class="col-2 dashboard-filter text-end">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterPlus.png" class="picture-FilterPlus-bonus"> <strong class="font-size-13">More</strong> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/3Dot.png" class="bonus-point">
                </div>
            </div>
        </div>
        <div class="col-12 alert alert-secondarydashboard">
            <div class="row">
                <div class="col-lg-2 col-md-6 col-6 Employee-dashborad">
                    Title
                </div>
                <div class="col-lg-1 col-md-6 col-6 Employee-dashborad">
                    department
                </div>
                <div class="col-lg-1 col-md-6 col-6 Employee-dashborad">
                    minimum
                </div>
                <div class="col-lg-1 col-md-6 col-6 Employee-dashborad">
                    low
                </div>
                <div class="col-lg-1 col-md-6 col-6 Employee-dashborad">
                    Average
                </div>
                <div class="col-lg-1 col-md-6 col-6 Employee-dashborad">
                    High
                </div>
                <div class="col-lg-1 col-md-6 col-6 Employee-dashborad">
                    Max
                </div>
                <div class="col-lg-1 col-md-6 col-6 Employee-dashborad">
                    achievement(฿)
                </div>
                <div class="col-lg-1 col-md-6 col-6 Employee-dashborad">
                    Total Budget
                </div>
                <div class="col-lg-1 col-md-6 col-6 Employee-dashborad">
                    Total Adjustment (฿)
                </div>
                <div class="col-lg-1 col-md-6 col-6 Employee-dashborad">
                    New Salary (฿)
                </div>
            </div>
        </div>
        <div class="col-12 alert alert-lightdashboard">
            <div class="row">
                <div class="col-lg-2 col-md-6 col-6 title0dashboard">
                    Manager
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    Accounts
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(20000) ?>
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(20000) ?>
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(2000) ?>
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(20000) ?>
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(20000) ?>
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(2000) ?>
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(2000) ?>
                </div>
                <div class="col-lg-1 col-md-6 col-6 Adjustment0dashboard">
                    (202)
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(19798) ?>
                </div>
            </div>
        </div>
        <div class="col-12 alert alert-lightdashboard">
            <div class="row">
                <div class="col-lg-2 col-md-6 col-6 title0dashboard">
                    Assistant Manager
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    Marketing
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(10000) ?>
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(10000) ?>
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(1000) ?>
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(10000) ?>
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(10000) ?>
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(1450) ?>
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(1450) ?>
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    101
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(11551) ?>
                </div>
            </div>
        </div>
        <div class="col-12 alert alert-lightdashboard">
            <div class="row">
                <div class="col-lg-2 col-md-6 col-6 title0dashboard">
                    Junior Executive
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    Human Resource
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(5589) ?>
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(5589) ?>
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(5589) ?>
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(5589) ?>
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(5589) ?>
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(456) ?>
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(456) ?>
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    50
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(6095) ?>
                </div>
            </div>
        </div>
        <div class="col-12 alert alert-lightdashboard">
            <div class="row">
                <div class="col-lg-2 col-md-6 col-6 title0dashboard">
                    Senior Musician
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    Sound Department
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(34000) ?>
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(34000) ?>
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(34000) ?>
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(34000) ?>
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(34000) ?>
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(6589) ?>
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(6589) ?>
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    1504
                </div>
                <div class="col-lg-1 col-md-6 col-6 department0dashboard">
                    <?= number_format(42093) ?>
                </div>
            </div>
        </div>
    </div>
</div>