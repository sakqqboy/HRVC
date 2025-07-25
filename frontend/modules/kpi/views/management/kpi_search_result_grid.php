<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'KPI Grid View';
?>
<div class="col-12 mt-70 pt-20 pim-content1">
    <div class="d-flex justify-content-start pt-0 pb-0" style="line-height: 30px;">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Group23177.svg"
            class="pim-head-icon mr-11 mt-2">
        <span class="pim-head-text mr-10"> <?= Yii::t('app', 'Performance Indicator Matrices') ?> (PIM)</span>
        <?php
        if ($role >= 3) {
        ?>
        <a href="<?= Yii::$app->homeUrl ?>kpi/management/create-kpi" class="create-employee-btn mr-11">
            <?= Yii::t('app', 'Create New') ?>
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg" alt="History"
                class="create-btn-icon ml-3" style="margin-top: -3px;">
        </a>
        <?php
        }
        ?>
    </div>
    <?= $this->render('header_filter', [
        "role" => $role,
        "allCompany" => $allCompany,
        "companyPic" => $companyPic,
        "totalBranch" => $totalBranch
    ]) ?>
    <div class="col-12 mt-20" id="box-wrapper">
        <div class="bg-white-employee" id="pim-content">
            <div class="d-flex pl-10 pr-10 justify-content-left align-content-center mt-5">
                <div class="pim-type-tab-selected rounded-top-left justify-content-center align-items-center">
                    <img class="mr-10" src="<?= Yii::$app->homeUrl ?>images/icons/Settings/company.svg" alt="Company"
                        style="cursor: pointer;"><?= Yii::t('app', 'Company KPI') ?>
                </div>
                <a class="pim-type-tab justify-content-center align-items-center">
                    <img class="mr-10" src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team.svg" alt="Team"
                        style="cursor: pointer;"><?= Yii::t('app', 'Team KPI') ?>
                </a>
                <a class="pim-type-tab justify-content-center align-items-center">
                    <img class="mr-10" src="<?= Yii::$app->homeUrl ?>images/icons/Settings/self.svg" alt="Self"
                        style="cursor: pointer;"><?= Yii::t('app', 'Self KPI') ?>
                </a>
                <div class="d-flex flex-grow-1 align-items-center justify-content-end  gap-1">
                    <?= $this->render('filter_list_search', [
                        "companies" => $companies,
                        "months" => $months,
                        "companyId" => isset($companyId) ? $companyId : null,
                        "employeeCompanyId" => $employeeCompanyId,
                        "branchId" => isset($branchId) ? $branchId : null,
                        "teamId" => isset($teamId) ? $teamId : null,
                        "month" => isset($month) ? $month : null,
                        "status" => isset($status) ? $status : null,
                        "branches" =>  isset($branches) ? $branches : null,
                        "teams" =>  isset($teams) ? $teams : null,
                        "yearSelected" => isset($branchId) ? $branchId : null,
                        "role" => $role,
                        "page" => "grid"
                    ]) ?>
                    <input type="hidden" id="type" value="grid">
                    <input type="hidden" id="minPage" value="0">
                </div>
            </div>
            <div class="row" style="--bs-gutter-x:0px;">
                <div class="d-none img-loading text-center" id="img-loading">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Config/loading.gif" class="img-fluid "
                        style="width: 750px;">
                </div>
            </div>
            <div class="row mt-20 pl-10 pr-10 pim-content mb-10" style="--bs-gutter-x:0px;" id="main-body">
                <?php
                    if (isset($kpis) && count($kpis) > 0) {
                        foreach ($kpis as $kpiId => $kpi) :
                            if ($kpi["isOver"] == 1 && $kpi["status"] != 2) {
                                $colorFormat = 'over';
                                $statusText = 'Due Passed';
                            } else {
                                if ($kpi["status"] == 1) {
                                    if ($kpi["isOver"] == 2) {
                                        $colorFormat = 'disable';
                                        $statusText = 'Not Set';
                                    } else {
                                        $colorFormat = 'inprogress';
                                        $statusText = 'In-Progress';
                                    }
                                } else {
                                    $colorFormat = 'complete';
                                    $statusText = 'Completed';
                                }
                            }
                    ?>
                <div class="col-12 mb-25 pim-big-box pim-<?= $colorFormat ?>" id="kpi-<?= $kpiId ?>">
                    <div class="d-flex justify-content-start align-content-start">
                        <div class="kfi-grid-1" style="min-height:120px;">
                            <div class="text-truncate pim-name"><?= $kpi["kpiName"] ?></div>
                            <div class="mt-20">
                                <div class="assign-on">
                                    <?= Yii::t('app', 'Assigned on') ?>
                                </div>
                                <div class="d-flex justify-content-start">
                                    <div class="mt-15" style="gap: 10px;display:inline-grid;">
                                        <div class="d-flex  justify-content-start" style="gap: 8px;">
                                            <div class="pim-picgroup">
                                                <?php if ($kpi["countEmployee"] != 0) { ?>
                                                <?php 
                                                        if (isset($kpi['kpiEmployee'][0])) {
                                                                        $userPicture1 = $kpi['kpiEmployee'][0];
                                                                    } else {
                                                                        $userPicture1 = 'image/user.svg';
                                                                    }
                                                        ?>
                                                <img src="<?= Yii::$app->homeUrl . $userPicture1 ?>"
                                                    class="pim-pic-gridNew">
                                                <?php 
                                                        if (isset($kpi['kpiEmployee'][1])) {
                                                                        $userPicture2 = $kpi['kpiEmployee'][1];
                                                                    } else {
                                                                        $userPicture2 = 'image/user.svg';
                                                                    }
                                                        ?>
                                                <img src="<?= Yii::$app->homeUrl . $userPicture2 ?>"
                                                    class="pim-pic-gridNew pic-after">
                                                <?php 
                                                        if (isset($kpi['kpiEmployee'][2])) {
                                                                        $userPicture3 = $kpi['kpiEmployee'][2];
                                                                    } else {
                                                                        $userPicture3 = 'image/user.svg';
                                                                    }
                                                        ?>
                                                <img src="<?= Yii::$app->homeUrl . $userPicture3 ?>"
                                                    class="pim-pic-gridNew pic-after">

                                                <?php } else { 
                                                    
                                                            for ($i = 1; $i <= 3; $i++):
                                                            ?>
                                                <div class="<?= $role >= 3 ? ($kpi["countEmployee"] == 0 && $colorFormat != "disable" ? 'pim-pic-yenlow'
                                                                                : 'pim-pic-'  . $colorFormat)
                                                                                : ($kpi["countEmployee"] == 0  && $colorFormat != "disable"
                                                                                    ? 'pim-pic-yenlow'
                                                                                    : 'pim-pic-'  . $colorFormat)
                                                                            ?> <?= $i > 1 ? 'pic-after' : '' ?>">
                                                    <img
                                                        src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg">
                                                </div>
                                                <?php
                                                            endfor;
                                                        } ?>
                                                <div
                                                    class="number-tagNew  <?= $kpi["countEmployee"] == 0 && $colorFormat != "disable"  ? 'load-yenlow' : 'load-'  . $colorFormat ?>  pic-after">
                                                    <?= $kpi["countEmployee"] ?>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-start">
                                                <div
                                                    class="assign-new <?= ($kpi["countEmployee"] == 0 && $colorFormat != 'disable') ? 'yenlow' : $colorFormat ?>-assignNew">
                                                    <?php
                                                            $yellow = 0;
                                                            if ($kpi["countEmployee"] == 0) {
                                                                if ($colorFormat != 'disable') {
                                                                    $yellow = 1;
                                                                }
                                                            }
                                                            if ($role <= 4) {
                                                                $textAssign = "View Assigned";
                                                                $url = Yii::$app->homeUrl . 'kpi/view/kpi-history/' . ModelMaster::encodeParams(['kpiId' => $kpiId]);
                                                                $assignImg = "view";
                                                                if ($kpi["countEmployee"] == 0) {
                                                                    $textAssign = "Not Assign";
                                                                    $url = '#';
                                                                }
                                                            } else {
                                                                $textAssign = "Edit Assigned";
                                                                $assignImg = "assign";
                                                                $url = Yii::$app->homeUrl . 'kpi/assign/assign/' . ModelMaster::encodeParams([
                                                                    'kpiId' => $kpiId,
                                                                    "companyId" => $kpi["companyId"],
                                                                    "month" => $kpi["monthNumber"],
                                                                    "year" => $kpi["year"]
                                                                ]);
                                                                if ($kpi["countEmployee"] == 0) {
                                                                    $textAssign = "Assign Persons";
                                                                }
                                                            }
                                                            ?>
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $assignImg ?>-<?= $yellow == 1 ? 'yenlow' : $colorFormat ?>.svg"
                                                        style="width:20px;height:20px;">
                                                    <a href="<?= $url ?>"
                                                        class="font-<?= $yellow == 1 ? 'black' : $colorFormat ?>"
                                                        style="<?= (($kpi["countEmployee"] == 0 || $colorFormat == 'disable') && $role <= 4) ? 'pointer-events: none; color: black; text-decoration: none;' : '' ?>">
                                                        <?= $textAssign ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex  justify-content-start" style="gap: 8px;">
                                            <div class="pim-picgroup">
                                                <?php
                                                        for ($i = 1; $i <= 3; $i++):
                                                        ?>
                                                <div
                                                    class="pim-pic-<?= $colorFormat ?>  <?= $i > 1 ? 'pic-after' : '' ?>">
                                                    <img
                                                        src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $colorFormat == 'disable' ? 'teamblack' : 'teamwhite' ?>.svg">
                                                </div>
                                                <?php
                                                        endfor;
                                                        ?>
                                                <div class="number-tagNew  load-<?= $colorFormat ?>  pic-after">
                                                    <?= $kpi["countTeam"] ?>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-start">
                                                <div
                                                    class="assign-new <?= ($kpi["countEmployee"] == 0 && $colorFormat != 'disable') ? 'yenlow' : $colorFormat ?>-assignNew">
                                                    <?php
                                                            $yellow = 0;
                                                            if ($kpi["countEmployee"] == 0) {
                                                                if ($colorFormat != 'disable') {
                                                                    $yellow = 1;
                                                                }
                                                            }
                                                            if ($role <= 4) {
                                                                $textAssign = "View Assigned";
                                                                $url = Yii::$app->homeUrl . 'kpi/view/kpi-history/' . ModelMaster::encodeParams(['kpiId' => $kpiId]);
                                                                $assignImg = "view";
                                                                if ($kpi["countEmployee"] == 0) {
                                                                    $textAssign = "Not Assign";
                                                                    $url = '#';
                                                                }
                                                            } else {
                                                                $textAssign = "Edit Assigned";
                                                                $assignImg = "assign";
                                                                $url = Yii::$app->homeUrl . 'kpi/assign/assign/' . ModelMaster::encodeParams([
                                                                    'kpiId' => $kpiId,
                                                                    "companyId" => $kpi["companyId"],
                                                                    "month" => $kpi["monthNumber"],
                                                                    "year" => $kpi["year"]
                                                                ]);
                                                                if ($kpi["countEmployee"] == 0) {
                                                                    $textAssign = "Assign Persons";
                                                                }
                                                            }
                                                            ?>
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $assignImg ?>-<?= $yellow == 1 ? 'yenlow' : $colorFormat ?>.svg"
                                                        style="width:20px;height:20px;">
                                                    <a href="<?= $url ?>"
                                                        class="font-<?= $yellow == 1 ? 'black' : $colorFormat ?>"
                                                        style="<?= (($kpi["countEmployee"] == 0 || $colorFormat == 'disable') && $role <= 4) ? 'pointer-events: none; color: black; text-decoration: none;' : '' ?>">
                                                        <?= $textAssign ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1  d-flex justify-content-end">
                                        <div
                                            style="width:45px;justify-items: center;align-content: start;display: inline-grid;gap:2px;">
                                            <div class="priority-star mt-5">
                                                <?php
                                                        if ($kpi["priority"] == "A" || $kpi["priority"] == "B") {
                                                        ?>
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/star.svg"
                                                    class="default-star">
                                                <?php
                                                        }
                                                        if ($kpi["priority"] == "A" || $kpi["priority"] == "C") {
                                                        ?>
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/star.svg"
                                                    class="big-star">
                                                <?php
                                                        }
                                                        if ($kpi["priority"] == "B") {
                                                        ?>
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/star.svg"
                                                    class="default-star">
                                                <?php
                                                        }
                                                        if ($kpi["priority"] == "A") {
                                                        ?>
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/star.svg"
                                                    class="default-star">
                                                <?php
                                                        }
                                                        ?>
                                            </div>
                                            <?php
                                                    if ($kpi["priority"] != '') {
                                                    ?>
                                            <div class="priority-box">
                                                <?= Yii::t('app', 'Priority') ?>
                                                <span class="text-priority"><?= $kpi["priority"] ?></span>
                                            </div>
                                            <?php
                                                    } else { ?>
                                            <div class="priority-box-null">
                                                <?= Yii::t('app', 'Priority') ?>
                                                <span class="text-priority">N/A</span>
                                            </div>
                                            <?php
                                                    }
                                                    ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pim-center-line-content pim-<?= $colorFormat ?>"></div>
                        <div class="d-flex flex-column kgi-grid-2">
                            <div class="status-tag <?= $colorFormat ?>-tag">
                                <?= $statusText ?>
                            </div>
                            <div class="d-grid  pl-10 pr-10 mt-23" style="gap: 7px;">
                                <div class="pim-small-text"><?= Yii::t('app', 'Quant Ratio') ?></div>
                                <div class="pim-unit-text">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $kpi["quantRatio"] == 1 ? Yii::t('app', 'quantity') : Yii::t('app', 'diamon') ?>.svg"
                                        style="width:10px;height:10px;">
                                    <?= $kpi["quantRatio"] == 1 ? Yii::t('app', 'Quantity') : Yii::t('app', 'Quality') ?>
                                </div>
                            </div>

                            <div class="pim-center-line-width pim-<?= $colorFormat ?> ml-10"></div>
                            <div class="d-grid  pl-10 pr-10" style="gap: 7px;">
                                <div class="pim-small-text"><?= Yii::t('app', 'Update Interval') ?></div>
                                <div class="pim-unit-text">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/monthly.svg"
                                        style="width:10px;height:10px;">
                                    <?= Yii::t('app', $kpi["unit"]) ?>
                                </div>
                            </div>
                        </div>
                        <div class="pim-center-line-content pim-<?= $colorFormat ?>"></div>
                        <div class="d-flex flex-column kgi-grid-3">
                            <div class="d-flex justify-content-start">

                                <div class="month-<?= $colorFormat ?> month-period">
                                    <?= $kpi['month'] == "" ? Yii::t('app', 'Month') : Yii::t('app', $kpi['month']) ?>
                                </div>
                                <div class="term-<?= $colorFormat ?> term-period">
                                    <?= $kpi['fromDate'] == "" ? Yii::t('app', 'Not set') : $kpi['fromDate'] ?> -
                                    <?= $kpi['toDate'] == "" ? Yii::t('app', 'Not set') : $kpi['toDate'] ?>
                                </div>
                            </div>
                            <div class="row mt-10" style="--bs-gutter-x:0px;">
                                <div class="col-5 text-start">
                                    <div class="col-12 pim-small-text">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Target.svg"
                                            class="pim-iconKFI" style="margin-top: 1px; margin-right: 3px;">
                                        <?= Yii::t('app', 'Target') ?>
                                    </div>
                                    <div class="col-12 number-pim mt-10">
                                        <?php
                                                $decimal = explode('.', $kpi["targetAmount"]);
                                                if (isset($decimal[1])) {
                                                    if ($decimal[1] == '00') {
                                                        $show = $decimal[0];
                                                    } else {
                                                        $show = $kpi["targetAmount"];
                                                    }
                                                } else {
                                                    $show = $kpi["targetAmount"];
                                                }
                                                ?>
                                        <?= $show ?><?= $kpi["amountType"] == 1 ? '%' : '' ?>
                                    </div>
                                </div>
                                <div class="col-2 symbol-pim text-center">
                                    <div class="col-12 pt-17"><?= $kpi["code"] ?></div>
                                </div>
                                <div class="col-5  text-end">
                                    <div class="col-12 pim-small-text" style="justify-content: end !important;">
                                        <?= Yii::t('app', 'Result') ?>
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Result.svg"
                                            class="pim-iconKFI" style="margin-top: 1px; margin-left: 3px;">
                                    </div>
                                    <div class="col-12 number-pim mt-10">
                                        <?php
                                                if ($kpi["result"] != '') {
                                                    $decimalResult = explode('.', $kpi["result"]);
                                                    if (isset($decimalResult[1])) {

                                                        if ($decimalResult[1] == '00') {
                                                            $showResult = number_format($decimalResult[0]);
                                                        } else {
                                                            $showResult = number_format($kpi["result"], 2);
                                                        }
                                                    } else {
                                                        $showResult = number_format($kpi["result"]);
                                                    }
                                                } else {
                                                    $showResult = 0;
                                                }
                                                ?>
                                        <?= $showResult ?><?= $kpi["amountType"] == 1 ? '%' : '' ?>
                                    </div>
                                </div>
                                <div class="row mt-15" style="--bs-gutter-x:0px;">
                                    <div class="col-12">
                                        <?php
                                                $percent = explode('.', $kpi['ratio']);
                                                if (isset($percent[0]) && $percent[0] == '0') {
                                                    if (isset($percent[1])) {
                                                        if ($percent[1] == '00') {
                                                            $showPercent = 0;
                                                        } else {
                                                            $showPercent = round($kpi['ratio'], 1);
                                                        }
                                                    }
                                                } else {
                                                    $showPercent = round($kpi['ratio']);
                                                }
                                                ?>
                                        <div class="progress">
                                            <div class="progress-bar-<?= $colorFormat ?>"
                                                style="width:<?= $showPercent ?>%;"></div>
                                            <span
                                                class="progress-load load-<?= $colorFormat ?>"><?= $showPercent ?>%</span>
                                        </div>
                                    </div>
                                    <div class="row  mt-15" style="--bs-gutter-x:0px;">
                                        <div class="col-4">
                                            <div class="col-12 pim-small-text" style="justify-content: end !important;">
                                                <?= Yii::t('app', 'Last Updated on') ?></div>
                                            <div class="col-12 text-end pim-duedate mt-5">
                                                <?= $kpi['lastestUpdate'] == "" ? 'Not set' : $kpi['lastestUpdate'] ?>
                                            </div>
                                        </div>
                                        <div class="col-4 text-center align-content-center">
                                            <?php
                                                    if ($colorFormat == 'disable' && $role >= 5) {
                                                    ?>
                                            <a href="<?= Yii::$app->homeUrl . 'kpi/management/prepare-update/' . ModelMaster::encodeParams(['kpiId' => $kpiId, 'kpiHistoryId' => 0]) ?>"
                                                class="pim-btn-setup">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/setupwhite.svg"
                                                    class="mr-3" style="width: 10.42px; height: 10.53px;">
                                                <?= Yii::t('app', 'Setup') ?>
                                            </a>
                                            <?php
                                                    } else if ($colorFormat == "complete") {
                                                        // echo Yii::t('app', "Update");

                                                    } else if ($role >= 5) {
                                                    ?>
                                            <a href="<?= Yii::$app->homeUrl . 'kpi/management/prepare-update/' . ModelMaster::encodeParams(['kpiId' => $kpiId, 'kpiHistoryId' => 0]) ?>"
                                                class="pim-btn-<?= $colorFormat ?>">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh.svg"
                                                    class="mr-3" style="width: 10.42px; height: 10.53px;">
                                                <?php
                                                            if ($colorFormat == "over") {
                                                                echo Yii::t('app', 'Update');
                                                            } else {
                                                                echo Yii::t('app', 'Update');
                                                            }
                                                            ?>
                                            </a>
                                            <?php
                                                    } else { ?>
                                            <div class="pim-btn-disable" data-bs-target="#update-kpi-modal">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/locked.svg"
                                                    style="width: 10.42px; height: 10.53px;">
                                                <?= Yii::t('app', 'Locked') ?>
                                            </div>
                                            <?php

                                                    }
                                                    ?>
                                        </div>
                                        <div class="col-4">
                                            <div class="col-12 text-start pim-small-text font-<?= $colorFormat ?>">
                                                <?= Yii::t('app', 'Next Update Date') ?></div>
                                            <div class="col-12 text-start pim-duedate mt-5">
                                                <?= $kpi['nextCheck'] == "" ? 'Not set' : $kpi['nextCheck'] ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pim-center-line-content-small pim-<?= $colorFormat ?> mt-20"></div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-end">
                                <a href="<?= Yii::$app->homeUrl ?>kpi/view/kpi-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId]) ?>"
                                    class="btn <?= $colorFormat == 'disable' ? 'pim-btn-disable' : 'pim-btn' ?> mr-5"
                                    style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" alt="History"
                                        class="pim-action-icon">
                                </a>
                                <a href="<?= Yii::$app->homeUrl ?>kpi/view/index/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'openTab' => 2]) ?>"
                                    class="btn <?= $colorFormat == 'disable' ? 'pim-btn-disable' : 'pim-btn' ?> mr-5"
                                    style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/history.svg" alt="History"
                                        class="pim-action-icon mr-3"><?= Yii::t('app', 'History') ?>
                                </a>
                                <a href="<?= Yii::$app->homeUrl ?>kpi/view/kpi-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'openTab' => 3]) ?>"
                                    class="btn <?= $colorFormat == 'disable' ? 'pim-btn-disable' : 'pim-btn' ?> mr-5"
                                    style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg" alt="Chats"
                                        class="pim-action-icon mr-3"><?= Yii::t('app', 'Chats') ?>
                                </a>
                                <a href="<?= Yii::$app->homeUrl ?>kpi/view/kpi-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'openTab' => 4]) ?>"
                                    class="btn <?= $colorFormat == 'disable' ? 'pim-btn-disable' : 'pim-btn' ?> mr-5"
                                    style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/chart.svg" alt="Chart"
                                        class="pim-action-icon mr-3"><?= Yii::t('app', 'Chart') ?>
                                </a>
                                <?php
                                        if ($role >= 5) {
                                        ?>
                                <a class="pim-btn-delete" data-bs-toggle="modal" data-bs-target="#delete-kpi"
                                    onclick="javascript:prepareDeleteKpi(<?= $kpiId ?>)"
                                    onmouseover="this.querySelector('.pim-action-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binwhite.svg'"
                                    onmouseout="this.querySelector('.pim-action-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg'">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/binred.svg"
                                        class="pim-action-icon">
                                </a>
                                <?php
                                        }
                                        ?>
                            </div>
                            <div class="d-flex justify-content-start  mt-10">
                                <div class="pr-5" style="width:50%;">
                                    <div class="head-letter head-<?= $colorFormat ?>">
                                        <?= Yii::t('app', 'Issue') ?>
                                    </div>
                                    <div class="body-letter body-letter-<?= $colorFormat ?>">
                                        <?= $kpi["issue"] ?>
                                    </div>
                                </div>
                                <div class="pl-5" style="width:50%;">
                                    <div class="head-letter head-<?= $colorFormat ?>">
                                        <?= Yii::t('app', 'Solution') ?>
                                    </div>
                                    <div class="body-letter body-letter-<?= $colorFormat ?>">
                                        <?= $kpi["solution"] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <?php
                        endforeach;
                    }
                    ?>
            </div>
            <?php
            echo $this->render('pagination_page', [
                'totalKpi' => $totalKpi,
                "currentPage" => $currentPage,
                'totalPage' => $totalPage,
                "pagination" => $pagination,
                "pageType" => "grid",
                "filter" => isset($filter) ? $filter : []
            ]);
            ?>
            <input type="hidden" id="totalPage" value="<?= $totalPage > 1 ? 1 : 0 ?>">
        </div>
    </div>

</div>
<?= $this->render('modal_view') ?>

<input type="hidden" value="create" id="acType">
<?php
$form = ActiveForm::begin([
    'id' => 'create-kpi',
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
    'action' => Yii::$app->homeUrl . 'kpi/management/create-kpi'

]); ?>
<?= $this->render('modal_create', [
    "units" => $units,
    "companies" => $companies,
    "months" => $months
]) ?>
<?php ActiveForm::end(); ?>

<?php
$form = ActiveForm::begin([
    'id' => 'update-kpi',
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
    'action' => Yii::$app->homeUrl . 'kpi/management/update-kpi'

]); ?>
<?= $this->render('modal_update', [
    "units" => $units,
    "companies" => $companies,
    "months" => $months,
    "isManager" => $isManager
]) ?>
<?php ActiveForm::end(); ?>
<?= $this->render('modal_delete') ?>
<?= $this->render('modal_issue') ?>
<?= $this->render('modal_team_history') ?>
<?= $this->render('modal_employee_history') ?>
<?= $this->render('modal_kgi') ?>