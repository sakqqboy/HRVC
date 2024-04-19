<?php

use Faker\Core\Number;

$this->title = 'Salary Dashboard';
?>

<div class="col-12 mt-70 environment pt-10 pr-10 pl-20">
    <div class="salary_dashwhite">
        <div class="row">
            <div class="col-lg-2 col-md-6 col-7 SalaryDashboard2">
                Salary Increment
            </div>
            <div class="col-lg-2 col-md-6 col-5">
                <div class="alert-printerline">
                    <span class="printer-line"> Generate Report <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/printer.png" class="imagespointer"></span>
                </div>
            </div>
            <div class="col-lg-8 col-md-6 col-12">
                <div class="row">
                    <div class="col-lg-2 col-md-6 col-3 pt-20">
                        <img src="<?= Yii::$app->homeUrl ?>/images/icons/Dark/48px/Currency.png" class="pictureCurrency_print"><span class="font-size-11">Currency</span>
                    </div>
                    <div class="col-lg-2 col-md-6 col-3">
                        <select class="form-select BTH-example" aria-label="Default select example">
                            <option selected="" value="">Select</option>
                            <option value="1">BTH (฿) </option>
                            <option value="2">BTH (฿) </option>
                            <option value="3">BTH (฿) </option>
                        </select>
                    </div>
                    <div class="col-lg-1 col-md-6 col-3">
                        <button class="form-control Rank-wornning-blue" type="button"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Wornning-blue.png" class="wornningblue1"> Rank</button>
                    </div>
                    <div class="col-lg-3 col-md-6 col-3">
                        <select class="form-select select-accountteam" aria-label="Default select example">
                            <option selected="" value="">Select menu</option>
                            <option value="1">Accounts &amp; Taxation</option>
                            <option value="2">IT company</option>
                            <option value="3">Management</option>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-6 col-3">
                        <select class="form-select select-accountteam1" aria-label="Default select example">
                            <option selected="" value="">Evaluation Term</option>
                            <option value="1">Team A</option>
                            <option value="2">IT</option>
                            <option value="3">Management</option>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-6 col-6 Classform-filter">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterPlus.png" class="FilterMore"> <span class="font-size-12">More</span> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/3Dot.png" class="More-point">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 BGdashboard-secondary">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12 classform-TokyoLimited">
                    <div class="col-12">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Group21102.png" class="imagesGroup21102"> Tokyo Consulting Firm Limited
                    </div>
                    <div class="row class1Employee">
                        <div class="col-7">
                            Employee Participation
                        </div>
                        <div class="col-5 classPartici">
                            25
                        </div>
                    </div>
                    <div class="row class1Employee">
                        <div class="col-7">
                            Employee Phase
                        </div>
                        <div class="col-5 classPartici">
                            3rd Evaluation
                        </div>
                    </div>
                    <div class="row class1Employee">
                        <div class="col-7">
                            Evaluation Timeline
                        </div>
                        <div class="col-5 classPartici">
                            01 Sep 23-31 Dec 23
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 col-">
                    <div class="row">
                        <?php
                        for ($i = 1; $i <= 3; $i++) {
                        ?>

                            <div class="col-4 classform-TokyoLimited1">
                                <div class="col-12 Achi">
                                    Evaluation Achievement
                                </div>
                                <div class="row mt-5">
                                    <div class="col-5 classTl">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Accumulated.png" class="Accumulated-1"> <span class="Totall2"> Total</span>
                                    </div>
                                    <div class="col-7">
                                        <i class="fa fa-caret-up text-success font-size-12" aria-hidden="true"></i> <span class="bathformat">฿<?= number_format(157956) ?></span>
                                        <div class="bathformat1">฿<?= number_format(110582) ?> (E2)</div>
                                    </div>
                                    <hr class="col-10 ml-5 mt-5">
                                </div>
                                <div class="row">
                                    <div class="col-5 classTl">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Monthly.png" class="Accumulated-1"> <span class="Totall2"> Monthly</span>
                                    </div>
                                    <div class="col-7">
                                        <i class="fa fa-caret-up text-success font-size-11" aria-hidden="true"></i> <span class="bathformat">฿<?= number_format(39489) ?></span>
                                        <div class="bathformat1">฿<?= number_format(36860) ?> (E2)</div>
                                    </div>
                                    <hr class="col-10 ml-5 mt-5">
                                </div>
                            </div>

                        <?php
                        }
                        ?>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6 classform-TokyoLimited2">
                    <div class="row">
                        <div class="col-5">
                            <div class="col-12  ft-salary">
                                Salary
                            </div>
                            <div class="row cr-rent">
                                <div class="col-5 cr-salary">
                                    current E2
                                </div>
                                <div class="col-7 cr-salary">
                                    ฿ <?= number_format(356956) ?>
                                </div>
                                <div class="col-5 pt-10">
                                    Basic
                                </div>
                                <div class="col-7 pt-10">
                                    ฿ <?= number_format(285564) ?>
                                </div>
                                <div class="col-5 pt-3">
                                    Allowance
                                </div>
                                <div class="col-7 pt-3">
                                    ฿ <?= number_format(71391) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-7 Ev-evaluated">
                            <div class="col-12 ft-Evaluated">
                                Evaluated (E3)
                            </div>
                            <div class="row">
                                <div class="col-6 cr-salary">
                                    <i class="fa fa-caret-up text-success font-size-12" aria-hidden="true"></i> <span class="salary-fontbath"> ฿<?= number_format(756123) ?></span>
                                    <div class="bathformat1">฿ <?= number_format(25384) ?></div>
                                </div>
                                <div class="col-6">
                                    <div id="progress1">
                                        <div data-num="95" class="progress-item1" data-value="95%" style="background: conic-gradient(rgb(41, 140, 233) calc(75%), rgb(219, 239, 247) 0deg);">95%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row pt-20">
                <div class="col-lg-6 col-md-6 col-8 text-start">
                    <div class="col-12 txt-Breakdown">
                        Individual Performance Breakdown
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-4 text-end">
                    <div class="col-12">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-outline-primary font-size-12"><i class="fa fa-list-ul" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-outline-primary font-size-12"><i class="fa fa-th-large" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <table class="table">
            <thead class="table-secondary">
                <tr>
                    <td>Employees</td>
                    <td>Title</td>
                    <td>Department</td>
                    <td>Rank</td>
                    <td>Salary(฿)</td>
                    <td>achievement (฿)</td>
                    <td>Adjustment (฿)</td>
                    <td>New Salary (฿)</td>
                </tr>
            </thead>
            <tbody>
                <tr>

                </tr>
            </tbody>
        </table>



















        <!-- <div class="col-12 alert-secondarydashboard">
            <div class="row">
                <div class="col-lg-2 col-md-6 col-2 Employee-dashborad">
                    Employee
                </div>
                <div class="col-lg-2 col-md-6 col-2 Employee-dashborad">
                    Title
                </div>
                <div class="col-lg-1 col-md-6 col-1 Employee-dashborad">
                    Department
                </div>
                <div class="col-lg-1 col-md-6 col-1 Employee-dashborad">
                    rank
                </div>
                <div class="col-lg-1 col-md-6 col-1 Employee-dashborad">
                    Salary(฿)
                </div>
                <div class="col-lg-1 col-md-6 col-1 Employee-dashborad">
                    achievement (฿)
                </div>
                <div class="col-lg-1 col-md-6 col-1 Employee-dashborad">
                    Adjustment (฿)
                </div>
                <div class="col-lg-1 col-md-6 col-1 Employee-dashborad">
                    New Salary (฿)
                </div>
                <div class="col-lg-1 col-md-6 col-1 Employee-dashborad">
                    Ratio
                </div>
                <div class="col-lg-1 col-md-6 col-1 Employee-dashborad">
                    Action
                </div>
            </div>
        </div> -->

        <!-- <?php
                for ($i = 1; $i <= 5; $i++) {
                ?>

            <div class="col-12 alert-lightdashboard">
                <div class="row">
                    <div class="col-lg-2 col-md-6 col-2">
                        <img src="<?= Yii::$app->homeUrl ?>image/employee3.png" class="user0dashboard"> <span class="name0dashboard"> Charles Bhattacharjya</span>
                    </div>
                    <div class="col-lg-2 col-md-6 col-2 title0dashboard">
                        Manager
                    </div>
                    <div class="col-lg-1 col-md-6 col-1 department0dashboard">
                        Accounts
                    </div>
                    <div class="col-lg-1 col-md-6 col-1 department0dashboard text-center">
                        A
                    </div>
                    <div class="col-lg-1 col-md-6 col-1 department0dashboard">
                        <?= number_format(20000) ?>
                    </div>
                    <div class="col-lg-1 col-md-6 col-1 department0dashboard">
                        <?= number_format(2000) ?>
                    </div>
                    <div class="col-lg-1 col-md-6 col-1 Adjustment0dashboard">
                        (202)
                    </div>
                    <div class="col-lg-1 col-md-6 col-1 department0dashboard">
                        <?= number_format(19798) ?>
                    </div>
                    <div class="col-lg-1 col-md-6 col-1">
                        <div id="progress1">
                            <div data-num="35" class="progress-item1" data-value="35%" style="background: conic-gradient(rgb(41, 140, 233) calc(35%), rgb(219, 239, 247) 0deg);">35%</div>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-6 col-1 text-center">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/userfix.png" class="images-userfix">
                    </div>
                </div>
            </div>

        <?php
                }
        ?> -->

    </div>
</div>