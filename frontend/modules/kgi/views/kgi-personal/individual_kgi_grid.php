<?php

use common\models\ModelMaster;
use frontend\models\hrvc\KgiEmployee;
use yii\bootstrap5\ActiveForm;

$this->title = "INDIVIDUAL KGI";
?>
<div class="col-12 mt-70 pt-20 pim-content1">
    <div class="d-flex justify-content-start align-items-center  pt-0 pb-0" style="line-height: 30px;">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Group23177.svg"
            class="pim-head-icon mr-11 mt-2">
        <span class="pim-head-text mr-10"><?= Yii::t('app', 'Individual Key Goal Indicators') ?></strong></span>
        <?php
        if ($role >= 3) {

        ?>
            <div class="d-flex <?= $waitForApprove["totalRequest"] > 0 ? 'approval-box' : 'noapproval-box' ?> text-center">
                <?php
                if ($waitForApprove["totalRequest"] > 0) {
                ?>
                    <a href="<?= Yii::$app->homeUrl ?>kgi/management/wait-approve-kgi-personal"
                        class="d-flex align-items-center" style="text-decoration: none; color:#000000;">
                        <span class="approvals-num mr-3"><?= $waitForApprove["totalRequest"] ?></span>
                        <?= Yii::t('app', 'Approvals') ?>
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/approvals.svg" style="width: 16px;height:16px;"
                            class="ml-3">
                    </a>
                <?php
                } else { ?>
                    <a style=" text-decoration: none;color:#2D7F06;" class="d-flex align-items-center">
                        <span class="noapprovals-num mr-3"><?= $waitForApprove["totalRequest"] ?></span>
                        <?= Yii::t('app', 'No Approvals') ?>
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/check.svg" style="width: 16px;height:16px;"
                            class="ml-3">
                    </a>
                <?php
                }

                ?>
            </div>
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
                <a href="<?= Yii::$app->homeUrl ?>kgi/management/grid"
                    class="pim-type-tab rounded-top-left justify-content-center align-items-center">
                    <img class="mr-10" src="<?= Yii::$app->homeUrl ?>images/icons/Settings/company.svg" alt="Company"
                        style="cursor: pointer;"><?= Yii::t('app', 'Company KGI') ?>
                </a>
                <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-team/team-kgi-grid"
                    class="pim-type-tab justify-content-center align-items-center">
                    <img class="mr-10" src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team.svg" alt="Team"
                        style="cursor: pointer;"><?= Yii::t('app', 'Team KGI') ?>
                </a>
                <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/individual-kgi-grid"
                    class="pim-type-tab-selected justify-content-center align-items-center">
                    <img class="mr-10" src="<?= Yii::$app->homeUrl ?>images/icons/Settings/self.svg" alt="Self"
                        style="cursor: pointer;"><?= Yii::t('app', 'Self KGI') ?>
                </a>
                <div class="d-flex flex-grow-1 align-items-center justify-content-end  gap-1">
                    <?= $this->render('filter_list', [
                        "companies" => $companies,
                        "months" => $months,
                        "companyId" => isset($companyId) ? $companyId : null,
                        "employeeCompanyId" => $employeeCompanyId,
                        "branchId" => isset($branchId) ? $branchId : null,
                        "teamId" => isset($teamId) ? $teamId : null,
                        "month" => isset($month) ? $month : null,
                        "year" => $year,
                        "status" => isset($status) ? $status : null,
                        "branches" =>  isset($branches) ? $branches : null,
                        "teams" =>  isset($teams) ? $teams : null,
                        "yearSelected" => isset($year) ? $year : null,
                        "role" => $role,
                        "page" => "grid",
                        "employeeId" => isset($employeeId) ? $employeeId : '',
                        "employees" => isset($employees) ? $employees : []

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
                    foreach ($kgis["data"] as $kgiEmployeeId => $kgi) :
                        $canEdit = KgiEmployee::canEdit($role, $kgiEmployeeId);
                        if ($kgi["isOver"] == 1) {
                            $class = 'bg-over';
                        } else {
                            $class = 'bg-white';
                        }
                        if ($kgi["nextCheck"] == '') {
                            $class = "bg-lightblue";
                        }
                        if ($kgi["status"] == '2') {
                            $class = 'bg-finished';
                        }
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
                        //throw new exception(print_r($kgi, true));
                ?>
                        <div class="col-12 mb-25 pim-big-box pim-<?= $colorFormat ?>" id="kgi-employee-<?= $kgiEmployeeId ?>">
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
                                                        <?php if ($kgi["countTeamEmployee"] != 0) { ?>
                                                            <?php
                                                            if (isset($kgi['teamMate'][0])) {
                                                                $userPicture1 = $kgi['teamMate'][0];
                                                            } else {
                                                                $userPicture1 = 'image/user.svg';
                                                            }
                                                            ?>
                                                            <img src="<?= Yii::$app->homeUrl . $userPicture1 ?>"
                                                                class="pim-pic-gridNew">
                                                            <?php
                                                            if (isset($kgi['teamMate'][1])) {
                                                                $userPicture2 = $kgi['teamMate'][1];
                                                            } else {
                                                                $userPicture2 = 'image/user.svg';
                                                            }
                                                            ?>
                                                            <img src="<?= Yii::$app->homeUrl . $userPicture2 ?>"
                                                                class="pim-pic-gridNew pic-after">
                                                            <?php
                                                            if (isset($kgi['teamMate'][2])) {
                                                                $userPicture3 = $kgi['teamMate'][2];
                                                            } else {
                                                                $userPicture3 = 'image/user.svg';
                                                            }
                                                            ?>
                                                            <img src="<?= Yii::$app->homeUrl . $userPicture3 ?>"
                                                                class="pim-pic-gridNew pic-after">

                                                            <?php } else {

                                                            for ($i = 1; $i <= 3; $i++):
                                                            ?>
                                                                <div class="<?= $role >= 3 ? ($kgi["countTeamEmployee"] == 0 && $colorFormat != "disable" ? 'pim-pic-yenlow'
                                                                                : 'pim-pic-'  . $colorFormat)
                                                                                : ($kgi["countTeamEmployee"] == 0  && $colorFormat != "disable"
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
                                                            class="number-tagNew  <?= $kgi["countTeamEmployee"] == 0 && $colorFormat != "disable"  ? 'load-yenlow' : 'load-'  . $colorFormat ?>  pic-after">
                                                            <?= $kgi["countTeamEmployee"] ?>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-start">
                                                        <div
                                                            class="assign-new <?= ($kgi["countTeamEmployee"] == 0 && $colorFormat != 'disable') ? 'yenlow' : $colorFormat ?>-assignNew">
                                                            <?php
                                                            $yellow = 0;
                                                            if ($kgi["countTeamEmployee"] == 0) {
                                                                if ($colorFormat != 'disable') {
                                                                    $yellow = 1;
                                                                }
                                                            }

                                                            ?>
                                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/view-<?= $yellow == 1 ? 'yenlow' : $colorFormat ?>.svg"
                                                                style="width:20px;height:20px;">
                                                            <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/kgi-employee-history/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId, 'kgiEmployeeHistoryId' => 0, 'kgiId' => $kgi['kgiId'], 'openTab' => 1]) ?>"
                                                                class="font-<?= $yellow == 1 ? 'black' : $colorFormat ?>"
                                                                style="<?= ($colorFormat == 'disable') ? 'pointer-events: none; color: black; text-decoration: none;' : '' ?>">
                                                                <?= Yii::t('app', 'View Mates') ?>
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
                                                            ?>
                                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/view-<?= $yellow == 1 ? 'yenlow' : $colorFormat ?>.svg"
                                                                style="width:20px;height:20px;">
                                                            <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/kgi-employee-history/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId, 'kgiEmployeeHistoryId' => 0, 'kgiId' => $kgi['kgiId'], 'openTab' => 1]) ?>"
                                                                class="font-<?= $yellow == 1 ? 'black' : $colorFormat ?>"
                                                                style="<?= ($kgi["countTeam"] == 0 || $colorFormat == 'disable') ? 'pointer-events: none; color: black; text-decoration: none;' : '' ?>">
                                                                <?= Yii::t('app', 'View Teams') ?>
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
                                                if (!empty($kgi["targetAmount"]) && is_string($kgi["targetAmount"])) {
                                                    $decimal = explode('.', $kgi["targetAmount"]);
                                                    if (isset($decimal[1])) {
                                                        if ($decimal[1] == '00') {
                                                            $show = number_format($decimal[0]);
                                                        } else {
                                                            $show = number_format($kgi["targetAmount"], 2);
                                                        }
                                                    } else {
                                                        $show = number_format($kgi["targetAmount"]);
                                                    }
                                                } else {
                                                    $show = "0"; // หรือค่าที่เหมาะสมกรณีไม่มี target
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
                                                    if ($colorFormat == 'disable'  && $canEdit == 1) {
                                                    ?>
                                                        <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/update-personal-kgi/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId]) ?>"
                                                            class="pim-btn-setup">
                                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/setupwhite.svg"
                                                                class="mr-3" style="width: 10.42px; height: 10.53px;">
                                                            <?= Yii::t('app', 'Setup') ?>
                                                        </a>
                                                    <?php
                                                    } else if ($colorFormat == "complete") {
                                                        // echo Yii::t('app', "Update");
                                                    } else if ($canEdit == 1) {
                                                    ?>
                                                        <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/update-personal-kgi/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId]) ?>"
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
                                        <?php
                                        if ($role >= 3) {
                                        ?>
                                            <span class="team-wrapper <?= $colorFormat ?>-teamshow mr-3">
                                                <span class="team-icon pim-team-<?= $colorFormat ?> mr-1">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $colorFormat == 'disable' ? 'teamblack' : 'teamwhite' ?>.svg"
                                                        alt="Team Icon">
                                                </span>
                                                <span style="line-height: 8px;"><?= $kgi["teamName"] ?></span>
                                            </span>
                                        <?php
                                        }
                                        ?>
                                        <span class="team-wrapper <?= $colorFormat ?>-teamshow mr-3">
                                            <span class="mr-1 ml-1 d-flex" style="margin-top: -1px;">
                                                <img src="<?= Yii::$app->homeUrl . $kgi['picture'] ?>" alt="Team Icon"
                                                    class="pim-pic-icon">
                                            </span>
                                            <span class="team-name">
                                                <?php
                                                $employeeName = mb_strimwidth($kgi["employeeName"], 0, 15, '...');

                                                echo htmlspecialchars($employeeName) ?>
                                            </span>
                                        </span>
                                        <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/kgi-employee-history/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId, 'kgiEmployeeHistoryId' => 0, 'kgiId' => $kgi['kgiId'], 'openTab' => 1]) ?>"
                                            class="<?= $colorFormat == 'disable' ? 'pim-btn-disable' : 'pim-btn' ?> mr-3"
                                            style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" alt="History"
                                                class="pim-action-icon">
                                        </a>
                                        <a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-individual-history/<?= ModelMaster::encodeParams(['kgiId' => $kgi['kgiId'], "kgiEmployeeId" => $kgiEmployeeId]) ?>"
                                            class="<?= $colorFormat == 'disable' ? 'pim-btn-disable' : 'pim-btn' ?> mr-3"
                                            style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/history.svg" alt="History"
                                                class="pim-action-icon mr-3"><?= Yii::t('app', 'History') ?>
                                        </a>
                                        <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/kgi-employee-history/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId, 'kgiEmployeeHistoryId' => 0, 'kgiId' => $kgi['kgiId'], 'openTab' => 3]) ?>"
                                            class="<?= $colorFormat == 'disable' ? 'pim-btn-disable' : 'pim-btn' ?> mr-3"
                                            style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg" alt="Chats"
                                                class="pim-action-icon mr-3"><?= Yii::t('app', 'Chats') ?>
                                        </a>
                                        <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/kgi-employee-history/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId, 'kgiEmployeeHistoryId' => 0, 'kgiId' => $kgi['kgiId'], 'openTab' => 4]) ?>"
                                            class="<?= $colorFormat == 'disable' ? 'pim-btn-disable' : 'pim-btn' ?> mr-3"
                                            style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/chart.svg" alt="Chart"
                                                class="pim-action-icon mr-3"><?= Yii::t('app', 'Chart') ?>
                                        </a>
                                        <?php
                                        if ($role >= 5) {
                                        ?>
                                            <a class="pim-btn-delete" data-bs-toggle="modal" data-bs-target="#delete-kgi-team"
                                                onclick="javascript:prepareDeleteKgiEmployee(<?= $kgiEmployeeId ?>)"
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
<?php
$form = ActiveForm::begin([
    'id' => 'update-kgi',
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
    'action' => Yii::$app->homeUrl . 'kgi/kgi-team/update-kgi-team'

]); ?>
<?= $this->render('modal_update', [
    "units" => $units,
    "isManager" => $isManager,
    "months" => $months,
]) ?>
<?php ActiveForm::end(); ?>
<?= $this->render('modal_view', [
    "isManager" => $isManager
]) ?>
<?= $this->render('modal_issue') ?>
<?= $this->render('modal_delete') ?>