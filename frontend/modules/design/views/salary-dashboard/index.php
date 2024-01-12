<?php
$this->title = 'Salary Dashboard';
?>

<div class="col-12 mt-90 alert alert-Evaluator">
    <div class="alert aler-ALLDepartment">
        <div class="row">
            <div class="col-lg-2 col-md-6 col-6 SalaryDashboard2">
                Salary Dashboard
            </div>
            <div class="col-lg-2 col-md-6 col-6">
                <div class="alert alert-printerline">
                    <span class="printer-line"> Generate Report &nbsp;&nbsp; <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/printer.png" class="imagespointer"></span>
                </div>
            </div>
            <div class="col-lg-8 col-md-6 col-6  text-end">
                <div class="row">
                    <div class="col-2 pt-20">
                        <img src="<?= Yii::$app->homeUrl ?>/images/icons/Dark/48px/Currency.png" class="pictureCurrency3"><span class="font-size-12">Currency</span>
                    </div>
                    <div class="col-2">
                        <select class="form-select BTH-example" aria-label="Default select example">
                            <option selected="" value="">Select</option>
                            <option value="1">BTH (฿) </option>
                            <option value="2">BTH (฿) </option>
                            <option value="3">BTH (฿) </option>
                        </select>
                    </div>
                    <div class="col-1">
                        <button class="form-control Rank-wornning-blue" type="button"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Wornning-blue.png" class="wornningblue1"> Rank</button>
                    </div>
                    <div class="col-3">
                        <select class="form-select select-accountteam" aria-label="Default select example">
                            <option selected="" value="">Select menu</option>
                            <option value="1">Accounts &amp; Taxation</option>
                            <option value="2">IT company</option>
                            <option value="3">Management</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <select class="form-select select-accountteam" aria-label="Default select example">
                            <option selected="" value="">Evaluation Term</option>
                            <option value="1">Team A</option>
                            <option value="2">IT</option>
                            <option value="3">Management</option>
                        </select>
                    </div>
                    <div class="col-2 Classform-filter">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterPlus.png" class="picture-FilterPlus-bonus"> <strong class="font-size-13">More</strong> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/3Dot.png" class="bonus-point">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 alert alert-Evaluator">
            <div class="row">
                <div class="col-lg-2 col-md-6 col-6 card classform-TokyoLimited">
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
                <div class="col-lg-2 col-md-6 col-6 card border-classemployeeSolid">
                    <div class="col-12 Achi">
                        Evaluation Achievement
                    </div>
                    <div class="row mt-20">
                        <div class="col-6">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Accumulated.png" class="Accumulated-1"> <span class="Totall2"> Total</span>
                        </div>
                        <div class="col-6 classTl">
                            <i class="fa fa-caret-up text-success font-size-12" aria-hidden="true"></i> <span class="bathformat">฿<?= number_format(157956) ?></span>
                            <div class="bathformat1">฿<?= number_format(110582) ?> (E2)</div>
                        </div>
                        <hr class="mt-2">
                    </div>
                    <div class="row mt-20">
                        <div class="col-6">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Monthly.png" class="Accumulated-1"> <span class="Totall2"> Monthly</span>
                        </div>
                        <div class="col-6 classTl">
                            <i class="fa fa-caret-up text-success font-size-13" aria-hidden="true"></i> <span class="bathformat">฿<?= number_format(39489) ?></span>
                            <div class="bathformat1">฿<?= number_format(36860) ?> (E2)</div>
                        </div>
                        <hr class="mt-2">
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-6 card border-classemployeeSolid">
                    <div class="col-12 Achi">
                        Evaluation Achievement
                    </div>
                    <div class="row mt-20">
                        <div class="col-6">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Accumulated.png" class="Accumulated-1"> <span class="Totall2"> Total</span>
                        </div>
                        <div class="col-6 classTl">
                            <i class="fa fa-caret-up text-success font-size-12" aria-hidden="true"></i> <span class="bathformat">฿<?= number_format(157956) ?></span>
                            <div class="bathformat1">฿<?= number_format(110582) ?> (E2)</div>
                        </div>
                        <hr class="mt-2">
                    </div>
                    <div class="row mt-20">
                        <div class="col-6">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Monthly.png" class="Accumulated-1"> <span class="Totall2"> Monthly</span>
                        </div>
                        <div class="col-6 classTl">
                            <i class="fa fa-caret-up text-success font-size-13" aria-hidden="true"></i> <span class="bathformat">฿<?= number_format(39489) ?></span>
                            <div class="bathformat1">฿<?= number_format(36860) ?> (E2)</div>
                        </div>
                        <hr class="mt-2">
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-6 card border-classemployeeSolid">
                    <div class="col-12 Achi">
                        Evaluation Achievement
                    </div>
                    <div class="row mt-20">
                        <div class="col-6">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Accumulated.png" class="Accumulated-1"> <span class="Totall2"> Total</span>
                        </div>
                        <div class="col-6 classTl">
                            <i class="fa fa-caret-up text-success font-size-12" aria-hidden="true"></i> <span class="bathformat">฿<?= number_format(157956) ?></span>
                            <div class="bathformat1">฿<?= number_format(110582) ?> (E2)</div>
                        </div>
                        <hr class="mt-2">
                    </div>
                    <div class="row mt-20">
                        <div class="col-6">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Monthly.png" class="Accumulated-1"> <span class="Totall2"> Monthly</span>
                        </div>
                        <div class="col-6 classTl">
                            <i class="fa fa-caret-up text-success font-size-13" aria-hidden="true"></i> <span class="bathformat">฿<?= number_format(39489) ?></span>
                            <div class="bathformat1">฿<?= number_format(36860) ?> (E2)</div>
                        </div>
                        <hr class="mt-2">
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-6"></div>
            </div>
        </div>
    </div>
</div>