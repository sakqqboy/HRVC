<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'Company KGI';
?>
<div class="col-12 mt-70 pt-20 pim-content1">
    <div class="d-flex justify-content-start pt-0 pb-0" style="line-height: 30px;">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Group23177.svg"
            class="pim-head-icon mr-11 mt-2">
        <span class="pim-head-text mr-10"> <?= Yii::t('app', 'Performance Indicator Matrices') ?> (PIM)</span>
        <?php
        if ($role >= 3) {
        ?>
            <a href="<?= Yii::$app->homeUrl ?>kgi/management/create-kgi" class="create-employee-btn mr-11">
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
        "totalBranch" => $totalBranch,
        "page" => 'grid'
    ]) ?>
    <div class="col-12 mt-20" id="box-wrapper">
        <div class="bg-white-employee" id="pim-content">
            <div class="d-flex pl-10 pr-10 justify-content-left align-content-center mt-5">
                <div class="pim-type-tab-selected rounded-top-left justify-content-center align-items-center">
                    <img class="mr-10" src="<?= Yii::$app->homeUrl ?>images/icons/Settings/company.svg" alt="Company"
                        style="cursor: pointer;"><?= Yii::t('app', 'Company KGI') ?>
                </div>
                <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-team/team-kgi-grid"
                    class="pim-type-tab justify-content-center align-items-center">
                    <img class="mr-10" src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team.svg" alt="Team"
                        style="cursor: pointer;"><?= Yii::t('app', 'Team KGI') ?>
                </a>
                <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/individual-kgi-grid" class="pim-type-tab justify-content-center align-items-center">
                    <img class="mr-10" src="<?= Yii::$app->homeUrl ?>images/icons/Settings/self.svg" alt="Self"
                        style="cursor: pointer;"><?= Yii::t('app', 'Self KGI') ?>
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
                        "yearSelected" => isset($year) ? $year : null,
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
                if (isset($kgis["data"]) && count($kgis["data"]) > 0) {
                    foreach ($kgis["data"] as $kgiId => $kgi) :
                        if ($kgi["isOver"] == 1 && $kgi["status"] != 2) {
                            $colorFormat = 'over';
                            $statusText = 'Due Passed';
                        } else {
                            if ($kgi["status"] == 1) {
                                if ($kgi["isOver"] == 2) {
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
                        <div class="col-12 mb-25 pim-big-box pim-<?= $colorFormat ?>" id="kgi-<?= $kgiId ?>">
                            <div class="d-flex justify-content-start align-content-start">
                                <div class="kfi-grid-1" style="min-height:120px;">
                                    <div class="text-truncate pim-name"><?= $kgi["kgiName"] ?></div>
                                    <div class="mt-20">
                                        <div class="assign-on">
                                            <?= Yii::t('app', 'Assigned on') ?>
                                        </div>
                                        <div class="d-flex justify-content-start">
                                            <div class="mt-15" style="gap: 10px;display:inline-grid;">
                                                <div class="d-flex  justify-content-start" style="gap: 8px;">
                                                    <div class="pim-picgroup">
                                                        <?php if ($kgi["countEmployee"] != 0) { ?>
                                                            <?php
                                                            if (isset($kgi['kgiEmployee'][0])) {
                                                                $userPicture1 = $kgi['kgiEmployee'][0];
                                                            } else {
                                                                $userPicture1 = 'image/user.svg';
                                                            }
                                                            ?>
                                                            <img src="<?= Yii::$app->homeUrl . $userPicture1 ?>"
                                                                class="pim-pic-gridNew">
                                                            <?php
                                                            if (isset($kgi['kgiEmployee'][1])) {
                                                                $userPicture2 = $kgi['kgiEmployee'][1];
                                                            } else {
                                                                $userPicture2 = 'image/user.svg';
                                                            }
                                                            ?>
                                                            <img src="<?= Yii::$app->homeUrl . $userPicture2 ?>"
                                                                class="pim-pic-gridNew pic-after">
                                                            <?php
                                                            if (isset($kgi['kgiEmployee'][2])) {
                                                                $userPicture3 = $kgi['kgiEmployee'][2];
                                                            } else {
                                                                $userPicture3 = 'image/user.svg';
                                                            }
                                                            ?>
                                                            <img src="<?= Yii::$app->homeUrl . $userPicture3 ?>"
                                                                class="pim-pic-gridNew pic-after">

                                                            <?php } else {

                                                            for ($i = 1; $i <= 3; $i++):
                                                            ?>
                                                                <div class="<?= $role >= 3 ? ($kgi["countEmployee"] == 0 && $colorFormat != "disable" ? 'pim-pic-yenlow'
                                                                                : 'pim-pic-'  . $colorFormat)
                                                                                : ($kgi["countEmployee"] == 0  && $colorFormat != "disable"
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
                                                            class="number-tagNew  <?= $kgi["countEmployee"] == 0 && $colorFormat != "disable"  ? 'load-yenlow' : 'load-'  . $colorFormat ?>  pic-after">
                                                            <?= $kgi["countEmployee"] ?>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-start">
                                                        <div class="assign-new <?= ($kgi["countEmployee"] == 0 && $colorFormat != 'disable') ? 'yenlow' : $colorFormat ?>-assignNew">
                                                            <?php
                                                            $yellow = 0;
                                                            if ($kgi["countEmployee"] == 0) {
                                                                if ($colorFormat != 'disable') {
                                                                    $yellow = 1;
                                                                }
                                                            }
                                                            if ($role <= 4) {
                                                                $textAssign = "View Assigned";
                                                                $url = Yii::$app->homeUrl . 'kgi/view/kgi-history/' . ModelMaster::encodeParams(['kgiId' => $kgiId]);
                                                                $assignImg = "view";
                                                                if ($kgi["countEmployee"] == 0) {
                                                                    $textAssign = "Not Assign";
                                                                    $url = '#';
                                                                }
                                                            } else {
                                                                $textAssign = "Edit Assigned";
                                                                $assignImg = "assign";
                                                                $url = Yii::$app->homeUrl . 'kgi/assign/assign/' . ModelMaster::encodeParams([
                                                                    'kgiId' => $kgiId,
                                                                    "companyId" => $kgi["companyId"],
                                                                    "month" => $kgi["monthNumber"],
                                                                    "year" => $kgi["year"]
                                                                ]);
                                                                if ($kgi["countEmployee"] == 0) {
                                                                    $textAssign = "Assign Persons";
                                                                }
                                                            }
                                                            ?>
                                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $assignImg ?>-<?= $yellow == 1 ? 'yenlow' : $colorFormat ?>.svg"
                                                                style="width:20px;height:20px;">
                                                            <a href="<?= $url ?>"
                                                                class="font-<?= $yellow == 1 ? 'black' : $colorFormat ?>"
                                                                style="<?= (($kgi["countEmployee"] == 0 || $colorFormat == 'disable') && $role <= 4) ? 'pointer-events: none; color: black; text-decoration: none;' : '' ?>">
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
                                                            <?= $kgi["countTeam"] ?>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-start">
                                                        <div
                                                            class="assign-new <?= ($kgi["countTeam"] == 0 && $colorFormat != 'disable') ? 'yenlow' : $colorFormat ?>-assignNew">
                                                            <?php
                                                            $yellow = 0;
                                                            if ($kgi["countTeam"] == 0) {
                                                                if ($colorFormat != 'disable') {
                                                                    $yellow = 1;
                                                                }
                                                            }
                                                            if ($role <= 4) {
                                                                $textAssign = "View Assigned";
                                                                $url = Yii::$app->homeUrl . 'kgi/view/kgi-history/' . ModelMaster::encodeParams(['kgiId' => $kgiId]);
                                                                $assignImg = "view";
                                                                if ($kgi["countTeam"] == 0 && $colorFormat == 'disable') {
                                                                    $textAssign = "Not Assign";
                                                                    $url = '#';
                                                                }
                                                            } else {
                                                                $textAssign = "Edit Assigned";
                                                                $assignImg = "assign";
                                                                $url = Yii::$app->homeUrl . 'kgi/assign/assign/' . ModelMaster::encodeParams([
                                                                    'kgiId' => $kgiId,
                                                                    "companyId" => $kgi["companyId"],
                                                                    "month" => $kgi["monthNumber"],
                                                                    "year" => $kgi["year"]
                                                                ]);
                                                                if ($kgi["countTeam"] == 0) {
                                                                    $textAssign = "Assign Teams";
                                                                }
                                                            }
                                                            ?>
                                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $assignImg ?>-<?= $yellow == 1 ? 'yenlow' : $colorFormat ?>.svg"
                                                                style="width:20px;height:20px;">
                                                            <a href="<?= $url ?>"
                                                                class="font-<?= $yellow == 1 ? 'black' : $colorFormat ?>"
                                                                style="<?= (($kgi["countTeam"] == 0 || $colorFormat == 'disable') && $role <= 4) ? 'pointer-events: none; color: black; text-decoration: none;' : '' ?>">
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
                                                        if ($kgi["priority"] == "A" || $kgi["priority"] == "B") {
                                                        ?>
                                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/star.svg"
                                                                class="default-star">
                                                        <?php
                                                        }
                                                        if ($kgi["priority"] == "A" || $kgi["priority"] == "C") {
                                                        ?>
                                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/star.svg"
                                                                class="big-star">
                                                        <?php
                                                        }
                                                        if ($kgi["priority"] == "B") {
                                                        ?>
                                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/star.svg"
                                                                class="default-star">
                                                        <?php
                                                        }
                                                        if ($kgi["priority"] == "A") {
                                                        ?>
                                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/star.svg"
                                                                class="default-star">
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <?php
                                                    if ($kgi["priority"] != '') {
                                                    ?>
                                                        <div class="priority-box">
                                                            <?= Yii::t('app', 'Priority') ?>
                                                            <span class="text-priority"><?= $kgi["priority"] ?></span>
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
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $kgi["quantRatio"] == 1 ? Yii::t('app', 'quantity') : Yii::t('app', 'diamon') ?>.svg"
                                                style="width:10px;height:10px;">
                                            <?= $kgi["quantRatio"] == 1 ? Yii::t('app', 'Quantity') : Yii::t('app', 'Quality') ?>
                                        </div>
                                    </div>

                                    <div class="pim-center-line-width pim-<?= $colorFormat ?> ml-10"></div>
                                    <div class="d-grid  pl-10 pr-10" style="gap: 7px;">
                                        <div class="pim-small-text"><?= Yii::t('app', 'Update Interval') ?></div>
                                        <div class="pim-unit-text">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/monthly.svg"
                                                style="width:10px;height:10px;">
                                            <?= Yii::t('app', $kgi["unit"]) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="pim-center-line-content pim-<?= $colorFormat ?>"></div>
                                <div class="d-flex flex-column kgi-grid-3">
                                    <div class="d-flex justify-content-start">

                                        <div class="month-<?= $colorFormat ?> month-period">
                                            <?= $kgi['month'] == "" ? Yii::t('app', 'Month') : Yii::t('app', $kgi['month']) ?>
                                        </div>
                                        <div class="term-<?= $colorFormat ?> term-period">
                                            <?= $kgi['fromDate'] == "" ? Yii::t('app', 'Not set') : $kgi['fromDate'] ?> -
                                            <?= $kgi['toDate'] == "" ? Yii::t('app', 'Not set') : $kgi['toDate'] ?>
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
                                                $decimal = explode('.', $kgi["targetAmount"]);
                                                if (isset($decimal[1])) {
                                                    if ($decimal[1] == '00') {
                                                        $show = $decimal[0];
                                                    } else {
                                                        $show = $kgi["targetAmount"];
                                                    }
                                                } else {
                                                    $show = $kgi["targetAmount"];
                                                }
                                                ?>
                                                <?= $show ?><?= $kgi["amountType"] == 1 ? '%' : '' ?>
                                            </div>
                                        </div>
                                        <div class="col-2 symbol-pim text-center">
                                            <div class="col-12 pt-17"><?= $kgi["code"] ?></div>
                                        </div>
                                        <div class="col-5  text-end">
                                            <div class="col-12 pim-small-text" style="justify-content: end !important;">
                                                <?= Yii::t('app', 'Result') ?>
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Result.svg"
                                                    class="pim-iconKFI" style="margin-top: 1px; margin-left: 3px;">
                                            </div>
                                            <div class="col-12 number-pim mt-10">
                                                <?php
                                                if ($kgi["result"] != '') {
                                                    $decimalResult = explode('.', $kgi["result"]);
                                                    if (isset($decimalResult[1])) {

                                                        if ($decimalResult[1] == '00') {
                                                            $showResult = number_format($decimalResult[0]);
                                                        } else {
                                                            $showResult = number_format($kgi["result"], 2);
                                                        }
                                                    } else {
                                                        $showResult = number_format($kgi["result"]);
                                                    }
                                                } else {
                                                    $showResult = 0;
                                                }
                                                ?>
                                                <?= $showResult ?><?= $kgi["amountType"] == 1 ? '%' : '' ?>
                                            </div>
                                        </div>
                                        <div class="row mt-15" style="--bs-gutter-x:0px;">
                                            <div class="col-12">
                                                <?php
                                                $percent = explode('.', $kgi['ratio']);
                                                if (isset($percent[0]) && $percent[0] == '0') {
                                                    if (isset($percent[1])) {
                                                        if ($percent[1] == '00') {
                                                            $showPercent = 0;
                                                        } else {
                                                            $showPercent = round((float)$kgi['ratio'], 1);
                                                        }
                                                    }
                                                } else {
                                                    $showPercent = round((float)$kgi['ratio']);
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
                                                        <?= $kgi['lastestUpdate'] == "" ? 'Not set' : $kgi['lastestUpdate'] ?>
                                                    </div>
                                                </div>
                                                <div class="col-4 text-center align-content-center">
                                                    <?php
                                                    if ($colorFormat == 'disable' && $role >= 5) {
                                                    ?>
                                                        <a href="<?= Yii::$app->homeUrl . 'kgi/management/prepare-update/' . ModelMaster::encodeParams(['kgiId' => $kgiId, 'kgiHistoryId' => 0]) ?>"
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
                                                        <a href="<?= Yii::$app->homeUrl . 'kgi/management/prepare-update/' . ModelMaster::encodeParams(['kgiId' => $kgiId, 'kgiHistoryId' => 0]) ?>"
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
                                                        <div class="pim-btn-lock" data-bs-target="#update-kgi-modal">
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
                                                        <?= $kgi['nextCheck'] == "" ? 'Not set' : $kgi['nextCheck'] ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pim-center-line-content-small pim-<?= $colorFormat ?> mt-20"></div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-end">
                                        <a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-history/<?= ModelMaster::encodeParams(['kgiId' => $kgiId]) ?>"
                                            class="<?= $colorFormat == 'disable' ? 'pim-btn-disable' : 'pim-btn' ?> mr-5"
                                            style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" alt="History"
                                                class="pim-action-icon">
                                        </a>
                                        <a href="<?= Yii::$app->homeUrl ?>kgi/view/index/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, 'openTab' => 2]) ?>"
                                            class="<?= $colorFormat == 'disable' ? 'pim-btn-disable' : 'pim-btn' ?> mr-5"
                                            style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/history.svg" alt="History"
                                                class="pim-action-icon mr-3"><?= Yii::t('app', 'History') ?>
                                        </a>
                                        <a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-history/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, 'openTab' => 3]) ?>"
                                            class="<?= $colorFormat == 'disable' ? 'pim-btn-disable' : 'pim-btn' ?> mr-5"
                                            style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg" alt="Chats"
                                                class="pim-action-icon mr-3"><?= Yii::t('app', 'Chats') ?>
                                        </a>
                                        <a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-history/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, 'openTab' => 4]) ?>"
                                            class="<?= $colorFormat == 'disable' ? 'pim-btn-disable' : 'pim-btn' ?> mr-5"
                                            style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/chart.svg" alt="Chart"
                                                class="pim-action-icon mr-3"><?= Yii::t('app', 'Chart') ?>
                                        </a>
                                        <?php
                                        if ($role >= 5) {
                                        ?>
                                            <a class="pim-btn-delete" data-bs-toggle="modal" data-bs-target="#delete-kgi"
                                                onclick="javascript:prepareDeleteKgi(<?= $kgiId ?>)"
                                                onmouseover="this.querySelector('.pim-action-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binwhite.svg'"
                                                onmouseout="this.querySelector('.pim-action-icon').src='<?= Yii::$app->homeUrl ?>images/icons/pim/binred.svg'">
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
                                                <?= $kgi["issue"] ?>
                                            </div>
                                        </div>
                                        <div class="pl-5" style="width:50%;">
                                            <div class="head-letter head-<?= $colorFormat ?>">
                                                <?= Yii::t('app', 'Solution') ?>
                                            </div>
                                            <div class="body-letter body-letter-<?= $colorFormat ?>">
                                                <?= $kgi["solution"] ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-10 mb-5 pim-big-box pim-<?= $colorFormat ?> d-none" id="kgi-<?= $kgiId ?>">
                            <div class="row">
                                <div class="col-lg-3 col-md-5 col-12 pim-name">
                                    <?= $kgi["kgiName"] ?>
                                </div>
                                <div class="col-lg-1 col-md-2 col-4 text-center">
                                    <div class="<?= $colorFormat ?>-tag text-center">
                                        <?php
                                        if ($kgi['nextCheck'] == "") { ?>
                                            <?= Yii::t('app', 'Not set') ?>
                                        <?php
                                        } else { ?>
                                            <?= $statusText ?>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class=" col-lg-3 col-md-3 col-4 pl-30">
                                    <div class="row">
                                        <div class="col-4 month-<?= $colorFormat ?>">
                                            <?= $kgi['month'] == "" ? Yii::t('app', 'Month') : Yii::t('app', $kgi['month']) ?>
                                        </div>
                                        <div class="col-8 term-<?= $colorFormat ?>">
                                            <?= $kgi['fromDate'] == "" ? Yii::t('app', 'Not set') : $kgi['fromDate'] ?> -
                                            <?= $kgi['toDate'] == "" ? Yii::t('app', 'Not set') : $kgi['toDate'] ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-2 col-4 text-end pr-20 pt-0" style="margin-top: -7px;">
                                    <a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-history/<?= ModelMaster::encodeParams(['kgiId' => $kgiId]) ?>"
                                        class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs' ?> mr-5"
                                        style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" alt="History"
                                            class="pim-icon" style="margin-top: 1px;">
                                    </a>
                                    <a href="<?= Yii::$app->homeUrl ?>kgi/view/index/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, 'openTab' => 2]) ?>"
                                        class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs' ?> mr-5"
                                        style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/history.svg" alt="History"
                                            class="pim-icon mr-3"><?= Yii::t('app', 'History') ?>
                                    </a>
                                    <a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-history/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, 'openTab' => 3]) ?>"
                                        class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs' ?> mr-5"
                                        style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg" alt="Chats"
                                            class="pim-icon mr-3"><?= Yii::t('app', 'Chats') ?>
                                    </a>
                                    <a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-history/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, 'openTab' => 4]) ?>"
                                        class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs' ?> mr-5"
                                        style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.svg" alt="Chart"
                                            class="pim-icon mr-3"><?= Yii::t('app', 'Chart') ?>
                                    </a>
                                    <?php
                                    if ($role >= 5) {
                                    ?>
                                        <a class="btn btn-bg-red-xs" data-bs-toggle="modal" data-bs-target="#delete-kgi"
                                            onclick="javascript:prepareDeleteKgi(<?= $kgiId ?>)"
                                            onmouseover="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binwhite.svg'"
                                            onmouseout="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg'">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg" class="pim-icon">
                                        </a>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-lg-3 pim-subheader-font border-right-<?= $colorFormat ?> mt-10">
                                    <div class="row">
                                        <div class="col-12 text-start pl-22 fw-bold text-dark">
                                            <?= Yii::t('app', 'Assign on') ?>
                                        </div>
                                        <div class="col-10 pl-20 pr-0 mt-10">
                                            <div class="col-12 pb-1">
                                                <div class="row">
                                                    <div class="col-4 pr-2 pl-13">
                                                        <div class="row d-flex align-items-center" style="min-height: 24px;">
                                                            <?php if ($kgi["countEmployee"] != 0) {
                                                            ?>
                                                                <div class="col-2">
                                                                    <?php if (isset($kgi['kgiEmployee'][0])): ?>
                                                                        <img src="<?= Yii::$app->homeUrl . $kgi['kgiEmployee'][0] ?>"
                                                                            class="pim-pic-gridNew">
                                                                    <? else : ?>
                                                                        <img src="<?= Yii::$app->homeUrl . 'image/user.svg' ?>"
                                                                            class="pim-pic-gridNew">
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="col-2 pic-after pt-0">
                                                                    <?php if (isset($kgi['kgiEmployee'][1])): ?>
                                                                        <img src="<?= Yii::$app->homeUrl . $kgi['kgiEmployee'][1] ?>"
                                                                            class="pim-pic-gridNew">
                                                                    <? else : ?>
                                                                        <img src="<?= Yii::$app->homeUrl . 'image/user.svg' ?>"
                                                                            class="pim-pic-gridNew">
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="col-2 pic-after pt-0">
                                                                    <?php if (isset($kgi['kgiEmployee'][2])): ?>
                                                                        <img src="<?= Yii::$app->homeUrl . $kgi['kgiEmployee'][2] ?>"
                                                                            class="pim-pic-gridNew">
                                                                    <? else : ?>
                                                                        <img src="<?= Yii::$app->homeUrl . 'image/user.svg' ?>"
                                                                            class="pim-pic-gridNew">
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div
                                                                    class="col-5 number-tagNew  <?= $kgi["countEmployee"] == 0 && $colorFormat != "disable"  ? 'load-yenlow' : 'load-'  . $colorFormat ?> ">
                                                                    <?= $kgi["countEmployee"] ?>
                                                                </div>
                                                            <?php } else { ?>
                                                                <div class="col-2 ">
                                                                    <div class="<?= $role >= 3 ? ($kgi["countEmployee"] == 0 && $colorFormat != "disable" ? 'pim-pic-yenlow'
                                                                                    : 'pim-pic-'  . $colorFormat)
                                                                                    : ($kgi["countEmployee"] == 0  && $colorFormat != "disable"
                                                                                        ? 'pim-pic-yenlow'
                                                                                        : 'pim-pic-'  . $colorFormat)
                                                                                ?>
                                                                ">
                                                                        <img
                                                                            src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg">

                                                                    </div>
                                                                </div>
                                                                <div class="col-2 pic-after pt-0">
                                                                    <div class="
                                                                <?= $role >= 3
                                                                    ? ($kgi["countEmployee"] == 0 && $colorFormat != "disable"
                                                                        ? 'pim-pic-yenlow'
                                                                        : 'pim-pic-'  . $colorFormat)
                                                                    : ($kgi["countEmployee"] == 0  && $colorFormat != "disable"
                                                                        ? 'pim-pic-yenlow'
                                                                        : 'pim-pic-'  . $colorFormat)
                                                                ?>
                                                                ">
                                                                        <img
                                                                            src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg">
                                                                    </div>
                                                                </div>
                                                                <div class="col-2 pic-after pt-0">
                                                                    <div class="
                                                                <?= $role >= 3
                                                                    ? ($kgi["countEmployee"] == 0 && $colorFormat != "disable"
                                                                        ? 'pim-pic-yenlow'
                                                                        : 'pim-pic-'  . $colorFormat)
                                                                    : ($kgi["countEmployee"] == 0  && $colorFormat != "disable"
                                                                        ? 'pim-pic-yenlow'
                                                                        : 'pim-pic-'  . $colorFormat)
                                                                ?>
                                                                ">
                                                                        <img
                                                                            src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg">
                                                                    </div>
                                                                </div>
                                                                <div class="col-5 number-tagNew
                                                            <?= $role >= 3
                                                                    ? ($kgi["countEmployee"] == 0 && $colorFormat != "disable"
                                                                        ? 'load-yenlow'
                                                                        : 'load-'  . $colorFormat)
                                                                    : ($kgi["countEmployee"] == 0  && $colorFormat != "disable"
                                                                        ? 'load-yenlow'
                                                                        : 'load-'  . $colorFormat)
                                                            ?>
                                                           ">
                                                                    <?= $kgi["countEmployee"] ?>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>

                                                    <?php if ($role <= 4) { ?>
                                                        <div
                                                            class="col-5 <?= $kgi["countEmployee"] == 0 ? ($colorFormat == 'disable' ? 'disable' : 'yenlow') : $colorFormat ?>-assignNew ">
                                                            <span class="pull-left">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/view-<?= $kgi["countEmployee"] == 0 ? ($colorFormat == 'disable' ? 'disable' : 'yenlow') : $colorFormat ?>.svg"
                                                                    class="assing-icon mr-2">
                                                            </span>
                                                            <a href="<?= ($kgi["countEmployee"] > 0 && $colorFormat != 'disable') ? Yii::$app->homeUrl . 'kgi/view/kgi-history/' . ModelMaster::encodeParams(['kgiId' => $kgiId]) : '#' ?>"
                                                                class="font-<?= $kgi["countEmployee"] == 0 ? ($colorFormat == 'disable' ? 'disable' : 'black') : $colorFormat ?>"
                                                                style="<?= ($kgi["countEmployee"] == 0 || $colorFormat == 'disable') ? 'pointer-events: none; color: black; text-decoration: none;top: 2px;' : 'top: 2px;' ?>">
                                                                <?php if ($kgi["countEmployee"] == 0 && $colorFormat == 'disable') { ?>
                                                                    <?= Yii::t('app', 'Not Assign') ?>
                                                                <?php } elseif ($kgi["countEmployee"] == 0) { ?>
                                                                    <?= Yii::t('app', 'Not Assign') ?>
                                                                <?php } else { ?>
                                                                    <?= Yii::t('app', 'View Assign') ?>
                                                                <?php } ?>
                                                            </a>
                                                        </div>
                                                    <?php  } else { ?>
                                                        <div
                                                            class="col-5 <?= $kgi["countEmployee"] == 0 ? ($colorFormat == 'disable' ? 'disable' : 'yenlow') : $colorFormat ?>-assignNew ">
                                                            <span class="pull-left">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/assign-<?= $kgi["countEmployee"] == 0 ? ($colorFormat == 'disable' ? 'disable' : 'yenlow') : $colorFormat ?>.svg"
                                                                    class="assing-icon mr-2">
                                                            </span>
                                                            <a href="<?= Yii::$app->homeUrl ?>kgi/assign/assign/<?= ModelMaster::encodeParams([
                                                                                                                    'kgiId' => $kgiId,
                                                                                                                    "companyId" => $kgi["companyId"],
                                                                                                                    "month" => $kgi["monthNumber"],
                                                                                                                    "year" => $kgi["year"]
                                                                                                                ]) ?>"
                                                                class="font-<?= $kgi["countEmployee"] == 0 ? ($colorFormat == 'disable' ? 'disable' : 'black') : $colorFormat ?>"
                                                                style="top: 2px;">
                                                                <?php if ($kgi["countEmployee"] == 0 && $colorFormat == 'disable') { ?>
                                                                    <?= Yii::t('app', 'Assign Person') ?>
                                                                <?php  } else if ($kgi["countEmployee"] == 0) { ?>
                                                                    <?= Yii::t('app', 'Assign Person') ?>
                                                                <?php } else {  ?>
                                                                    <?= Yii::t('app', 'Edit Assign') ?>
                                                                <?php } ?>

                                                            </a>
                                                        </div>
                                                    <?php }  ?>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-10 pt-5 pb-1">
                                                <div class="row">
                                                    <div class="col-4 pr-2">
                                                        <div class="row d-flex align-items-center" style="min-height: 24px;">
                                                            <div class="col-2">
                                                                <div class="pim-pic-<?= $colorFormat ?>">
                                                                    <img
                                                                        src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $colorFormat == 'disable' ? 'teamblack' : 'teamwhite' ?>.svg">
                                                                </div>
                                                            </div>
                                                            <div class="col-2 pic-after pt-0">
                                                                <div class="pim-pic-<?= $colorFormat ?>">
                                                                    <img
                                                                        src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $colorFormat == 'disable' ? 'teamblack' : 'teamwhite' ?>.svg">
                                                                </div>
                                                            </div>
                                                            <div class="col-2 pic-after pt-0">
                                                                <div class="pim-pic-<?= $colorFormat ?>">
                                                                    <img
                                                                        src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $colorFormat == 'disable' ? 'teamblack' : 'teamwhite' ?>.svg">
                                                                </div>
                                                            </div>
                                                            <div class="col-5 number-tagNew load-<?= $colorFormat ?>">
                                                                <?= $kgi["countTeam"] ?>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <?php if ($role <= 4) { ?>
                                                        <div
                                                            class="col-5 <?= $kgi["countTeam"] == 0 ? ($colorFormat == 'disable' ? 'disable' : 'yenlow') : $colorFormat ?>-assignNew ">

                                                            <span class="pull-left">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/view-<?= $kgi["countTeam"] == 0 ? ($colorFormat == 'disable' ? 'disable' : 'yenlow') : $colorFormat ?>.svg"
                                                                    class="assing-icon mr-2">
                                                            </span>

                                                            <a href="<?= ($kgi["countTeam"] > 0 || $colorFormat != 'disable') ? Yii::$app->homeUrl . 'kgi/view/kgi-history/' . ModelMaster::encodeParams(['kgiId' => $kgiId]) : '#' ?>"
                                                                class="font-<?= ($kgi["countTeam"] == 0 && $colorFormat == 'disable') ? 'black' : $colorFormat ?>"
                                                                <?= ($kgi["countTeam"] == 0 || $colorFormat == 'disable') ? 'pointer-events: none; color: black; text-decoration: none; top: 2px;'  : 'top: 2px;' ?>">
                                                                <?php if ($kgi["countTeam"] == 0 && $colorFormat == 'disable') { ?>
                                                                    <?= Yii::t('app', 'Not Assign') ?>
                                                                <?php } elseif ($kgi["countTeam"] == 0) { ?>
                                                                    <?= Yii::t('app', 'Not Team') ?>
                                                                <?php } else { ?>
                                                                    <?= Yii::t('app', 'View Assign') ?>
                                                                <?php } ?>
                                                            </a>

                                                        </div>
                                                    <?php  } else { ?>
                                                        <div
                                                            class="col-5 <?= $kgi["countTeam"] == 0 ? ($colorFormat == 'disable' ? 'disable' : 'yenlow') : $colorFormat ?>-assignNew ">
                                                            <span class="pull-left">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/assign-<?= $kgi["countTeam"] == 0 ? ($colorFormat == 'disable' ? 'disable' : 'yenlow') : $colorFormat ?>.svg"
                                                                    class="assing-icon mr-2">
                                                            </span>
                                                            <a href="<?= Yii::$app->homeUrl ?>kgi/assign/assign/<?= ModelMaster::encodeParams([
                                                                                                                    'kgiId' => $kgiId,
                                                                                                                    "companyId" => $kgi["companyId"],
                                                                                                                    "month" => $kgi["monthNumber"],
                                                                                                                    "year" => $kgi["year"]
                                                                                                                ]) ?>"
                                                                class="font-<?= ($kgi["countTeam"] == 0 && $colorFormat == 'disable') ? 'black' : $colorFormat ?>"
                                                                <?= ($kgi["countTeam"] == 0 && $colorFormat == 'disable') ?: '' ?>
                                                                style="top: 2px;">
                                                                <?php if ($kgi["countTeam"] == 0 && $colorFormat == 'disable') { ?>
                                                                    <?= Yii::t('app', 'Assign Team') ?>
                                                                <?php  } else if ($kgi["countTeam"] == 0) { ?>
                                                                    <?= Yii::t('app', 'Assign Team') ?>
                                                                <?php } else {  ?>
                                                                    <?= Yii::t('app', 'Edit Assign') ?>
                                                                <?php } ?>
                                                            </a>
                                                        </div>
                                                    <?php }  ?>
                                                    <div class="col-1">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 pr-0 pl-0" style="margin-top:5px;">
                                            <div class="col-12 text-center priority-star">
                                                <?php
                                                if ($kgi["priority"] == "A" || $kgi["priority"] == "B") {
                                                ?>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                <?php
                                                }
                                                if ($kgi["priority"] == "A" || $kgi["priority"] == "C") {
                                                ?>
                                                    <i class="fa fa-star big-star" aria-hidden="true"></i>
                                                <?php
                                                }
                                                if ($kgi["priority"] == "B") {
                                                ?>
                                                    <i class="fa fa-star ml-10" aria-hidden="true"></i>
                                                <?php
                                                }
                                                if ($kgi["priority"] == "A") {
                                                ?>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <?php
                                            if ($kgi["priority"] != '') {
                                            ?>
                                                <div class="col-12 text-center priority-box">
                                                    <div class="col-12"><?= Yii::t('app', 'Priority') ?></div>
                                                    <div class="col-12 text-priority"><?= $kgi["priority"] ?></div>
                                                </div>
                                            <?php
                                            } else { ?>
                                                <div class="col-12 text-center priority-box-null">
                                                    <div class="col-12"><?= Yii::t('app', 'Priority') ?></div>
                                                    <div class="col-12 text-priority">N/A</div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1 pim-small-text border-right-<?= $colorFormat ?> pl-16 pr-10 mt-20">
                                    <div class="col-12"><?= Yii::t('app', 'Quant Ratio') ?></div>
                                    <div class="col-12 border-bottom-<?= $colorFormat ?> pb-10 pim-unit-text">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $kgi["quantRatio"] == 1 ? 'quantity' : 'diamon' ?>.svg"
                                            class="pim-iconKFI" style="margin-top: -1px; margin-left: 3px;">
                                        <?= $kgi["quantRatio"] == 1 ? Yii::t('app', 'Quantity') : Yii::t('app', 'Quality') ?>
                                    </div>
                                    <div class="col-12 pr-0 pt-10 pl-0"><?= Yii::t('app', 'Update Interval') ?></div>
                                    <div class="col-12  pim-unit-text">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/monthly.svg"
                                            class="pim-iconKFI" style="margin-top: -1px; margin-left: 3px;">
                                        <?= Yii::t('app', $kgi["unit"]) ?>
                                    </div>
                                </div>
                                <div class="col-lg-3 pim-small-text border-right-<?= $colorFormat ?> mt-20 pr-15 pl-15">
                                    <div class="row">
                                        <div class="col-5 text-start">
                                            <div class="col-12 pim-small-text">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Target.svg"
                                                    class="pim-iconKFI" style="margin-top: 1px; margin-right: 3px;">
                                                <?= Yii::t('app', 'Target') ?>
                                            </div>
                                            <div class="col-12 mt-3 number-pim">
                                                <?php
                                                $decimal = explode('.', $kgi["targetAmount"]);
                                                if (isset($decimal[1])) {
                                                    if ($decimal[1] == '00') {
                                                        $show = $decimal[0];
                                                    } else {
                                                        $show = $kgi["targetAmount"];
                                                    }
                                                } else {
                                                    $show = $kgi["targetAmount"];
                                                }
                                                ?>
                                                <?= $show ?><?= $kgi["amountType"] == 1 ? '%' : '' ?>
                                            </div>
                                        </div>
                                        <div class="col-2 symbol-pim text-center">
                                            <div class="col-12 pt-17"><?= $kgi["code"] ?></div>
                                        </div>
                                        <div class="col-5  text-end">
                                            <div class="col-12 pim-small-text"><?= Yii::t('app', 'Result') ?>
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Result.svg"
                                                    class="pim-iconKFI" style="margin-top: 1px; margin-left: 3px;">
                                            </div>
                                            <div class="col-12 mt-3 number-pim">
                                                <?php
                                                if ($kgi["result"] != '') {
                                                    $decimalResult = explode('.', $kgi["result"]);
                                                    if (isset($decimalResult[1])) {

                                                        if ($decimalResult[1] == '00') {
                                                            $showResult = number_format($decimalResult[0]);
                                                        } else {
                                                            $showResult = number_format($kgi["result"], 2);
                                                        }
                                                    } else {
                                                        $showResult = number_format($kgi["result"]);
                                                    }
                                                } else {
                                                    $showResult = 0;
                                                }
                                                ?>
                                                <?= $showResult ?><?= $kgi["amountType"] == 1 ? '%' : '' ?>
                                            </div>
                                        </div>
                                        <div class="col-12 pl-15 pr-10">
                                            <?php
                                            $percent = explode('.', $kgi['ratio']);
                                            if (isset($percent[0]) && $percent[0] == '0') {
                                                if (isset($percent[1])) {
                                                    if ($percent[1] == '00') {
                                                        $showPercent = 0;
                                                    } else {
                                                        $showPercent = round($kgi['ratio'], 1);
                                                    }
                                                }
                                            } else {
                                                $showPercent = round($kgi['ratio']);
                                            }
                                            ?>
                                            <div class="progress">
                                                <div class="progress-bar-<?= $colorFormat ?>"
                                                    style="width:<?= $showPercent ?>%;"></div>
                                                <span class="progress-load load-<?= $colorFormat ?>"><?= $showPercent ?>%</span>
                                            </div>
                                        </div>
                                        <div class="col-4 pl-5 pr-5 mt-16">
                                            <div class="col-12 text-end pim-small-text">
                                                <?= Yii::t('app', 'Last Updated on') ?></div>
                                            <div class="col-12 text-end pim-duedate">
                                                <?= $kgi['lastestUpdate'] == "" ? 'Not set' : $kgi['lastestUpdate'] ?>
                                            </div>
                                        </div>
                                        <div class="col-4 text-center mt-16 pt-5">

                                            <?php
                                            if ($colorFormat == 'disable' && $role >= 5) {
                                            ?>
                                                <a href="<?= Yii::$app->homeUrl . 'kgi/management/prepare-update/' . ModelMaster::encodeParams(['kgiId' => $kgiId, 'kgiHistoryId' => 0]) ?>"
                                                    style="display: flex; justify-content: center; align-items: center; padding: 7px 9px; height: 30px; gap: 6px; flex-shrink: 0;"
                                                    class="pim-btn-setup">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/setupwhite.svg"
                                                        class="mb-2" style="width: 12px; height: 12px;">
                                                    <?= Yii::t('app', 'Setup') ?>
                                                </a>
                                            <?php
                                            } else if ($colorFormat == "complete") {
                                                // echo Yii::t('app', "Update");

                                            } else if ($role >= 5) {
                                            ?>
                                                <a href="<?= Yii::$app->homeUrl . 'kgi/management/prepare-update/' . ModelMaster::encodeParams(['kgiId' => $kgiId, 'kgiHistoryId' => 0]) ?>"
                                                    style="display: flex; justify-content: center; align-items: center; padding: 7px 9px; height: 30px; gap: 6px; flex-shrink: 0;"
                                                    class="pim-btn-<?= $colorFormat ?>">
                                                    <!-- data-bs-toggle="modal" data-bs-target="#update-kgi-modal"> -->
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh.svg"
                                                        class="mb-2" style="width: 12px; height: 12px;">
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
                                                <div class="pim-btn-lock" data-bs-target="#update-kgi-modal">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/locked.svg"
                                                        style="width: 12px; height: 12px;"> <?= Yii::t('app', 'Locked') ?>
                                                </div>
                                            <?php

                                            }
                                            ?>
                                        </div>
                                        <div class="col-4 pl-0 pr-5 mt-16">
                                            <div class="col-12 text-start font-<?= $colorFormat ?> font-b">
                                                <?= Yii::t('app', 'Next Update Date') ?></div>
                                            <div class="col-12 text-start pim-duedate">
                                                <?= $kgi['nextCheck'] == "" ? 'Not set' : $kgi['nextCheck'] ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 pim-subheader-font mt-20">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12 pr-3 pl-20">
                                            <div class="col-12 head-letter head-<?= $colorFormat ?>">
                                                <?= Yii::t('app', 'Issue') ?></div>
                                            <div class="col-12 body-letter body-letter-<?= $colorFormat ?>">
                                                <?= $kgi["issue"] ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 pl-5 pr-20">
                                            <div class="col-12 head-letter head-<?= $colorFormat ?>">
                                                <?= Yii::t('app', 'Solution') ?></div>
                                            <div class="col-12 body-letter body-letter-<?= $colorFormat ?>">
                                                <?= $kgi["solution"] ?>
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
                'totalKgi' => $totalKgi,
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
    'id' => 'create-kgi',
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
    'action' => Yii::$app->homeUrl . 'kgi/management/create-kgi'

]); ?>
<?= $this->render('modal_create', [
    "units" => $units,
    "companies" => $companies,
    "months" => $months
]) ?>
<?php ActiveForm::end(); ?>

<?php
$form = ActiveForm::begin([
    'id' => 'update-kgi',
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
    'action' => Yii::$app->homeUrl . 'kgi/management/update-kgi'

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
<?= $this->render('modal_kfi') ?>
<?= $this->render('modal_kpi') ?>

<!-- end -->