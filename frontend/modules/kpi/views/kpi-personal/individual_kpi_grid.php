<?php

use common\models\ModelMaster;
use frontend\models\hrvc\KpiEmployee;

$this->title = "INDIVIDUAL KPI";
?>
<div class="col-12 mt-70 pt-20 pim-content1">
    <div class="d-flex justify-content-start align-items-center  pt-0 pb-0" style="line-height: 30px;">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Group23177.svg"
            class="pim-head-icon mr-11 mt-2">
        <span class="pim-head-text mr-10"><?= Yii::t('app', 'Team Key Performance Indicators') ?></strong></span>
        <?php
        if ($role > 3) {

        ?>
        <div class="d-flex <?= $waitForApprove["totalRequest"] > 0 ? 'approval-box' : 'noapproval-box' ?> text-center">
            <?php
                if ($waitForApprove["totalRequest"] > 0) {
                ?>
            <a href="<?= Yii::$app->homeUrl ?>kpi/management/wait-approve" class="d-flex align-items-center"
                style="text-decoration: none; color:#000000;">
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
                <a href="<?= Yii::$app->homeUrl ?>kpi/management/grid"
                    class="pim-type-tab rounded-top-left justify-content-center align-items-center">
                    <img class="mr-10" src="<?= Yii::$app->homeUrl ?>images/icons/Settings/company.svg" alt="Company"
                        style="cursor: pointer;"><?= Yii::t('app', 'Company KPI') ?>
                </a>
                <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-team/team-kpi-grid"
                    class="pim-type-tab-selected justify-content-center align-items-center">
                    <img class="mr-10" src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team.svg" alt="Team"
                        style="cursor: pointer;"><?= Yii::t('app', 'Team KPI') ?>
                </a>
                <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/individual-kpi-grid"
                    class="pim-type-tab justify-content-center align-items-center">
                    <img class="mr-10" src="<?= Yii::$app->homeUrl ?>images/icons/Settings/self.svg" alt="Self"
                        style="cursor: pointer;"><?= Yii::t('app', 'Self KPI') ?>
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
                        "status" => isset($status) ? $status : null,
                        "branches" =>  isset($branches) ? $branches : null,
                        "teams" =>  isset($teams) ? $teams : null,
                        "yearSelected" => isset($yearSelected) ? $branchId : null,
                        "role" => $role,
                        "page" => "grid"

                    ]) ?>
                    <input type="hidden" id="type" value="grid">
                    <input type="hidden" id="minPage" value="0">
                </div>
            </div>
            <div class="row mt-20 pl-10 pr-10 pim-content mb-10" style="--bs-gutter-x:0px;" id="main-body">
                <?php
                        if (isset($kpis) && count($kpis) > 0) {
                            foreach ($kpis as $kpiEmployeeId => $kpi) :
                                $canEdit = KpiEmployee::canEdit($role, $kpiEmployeeId);
                                if ($kpi["isOver"] == 1) {
                                    $class = 'bg-over';
                                } else {
                                    $class = 'bg-white';
                                }
                                if ($kpi["nextCheck"] == '') {
                                    $class = "bg-lightblue";
                                }
                                if ($kpi["status"] == '2') {
                                    $class = 'bg-finished';
                                }
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
                <div class="col-12 mt-10 mb-5 pim-big-box pim-<?= $colorFormat ?>"
                    id="kpi-employee-<?= $kpiEmployeeId ?>">
                    <div class="row">
                        <div class="col-lg-3 col-md-5 col-12 pim-name">
                            <?= $kpi["kpiName"] ?>
                        </div>
                        <div class="col-lg-1 col-md-2 col-4 text-center">
                            <div class="<?= $colorFormat ?>-tag text-center">
                                <?php
                                                if ($kpi['nextCheck'] == "") { ?>
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
                                    <?= $kpi['month'] == "" ? 'Month' : $kpi['month'] ?></div>
                                <div class="col-8 term-<?= $colorFormat ?>">
                                    <?= $kpi['fromDate'] == "" ? 'Not set' : $kpi['fromDate'] ?> -
                                    <?= $kpi['toDate'] == "" ? 'Not set' : $kpi['toDate'] ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-2 col-4 text-end pr-20" style="margin-top: -7px;">
                            <?php
                                            if ($role >= 3) {
                                            ?>
                            <span class="team-wrapper <?= $colorFormat ?>-teamshow" style="margin-right: 5px;">
                                <span class="team-icon pim-team-<?= $colorFormat ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $colorFormat == 'disable' ? 'teamblack' : 'teamwhite' ?>.svg"
                                        alt="Team Icon">
                                </span>
                                <span class="team-name"><?= $kpi["teamName"] ?></span>
                            </span>
                            <?php } ?>
                            <span class="team-wrapper <?= $colorFormat ?>-teamshow text-start"
                                style="margin-right: 5px; ">
                                <span>
                                    <img src="<?= Yii::$app->homeUrl . $kpi['picture'] ?>" alt="Team Icon"
                                        class="pim-pic-icon">
                                </span>
                                <span class="team-name">
                                    <?php
                                                    $employeeName = mb_strimwidth($kpi["employeeName"], 0, 15, '...');

                                                    echo htmlspecialchars($employeeName) ?>
                                </span>
                            </span>
                            <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/kpi-individual-history/<?= ModelMaster::encodeParams(['kpiId' => $kpi['kpiId'], 'kpiEmployeeHistoryId' => $kpi["kpiEmployeeHistoryId"], 'kpiEmployeeId' => $kpiEmployeeId]) ?>"
                                class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs' ?> mr-5"
                                style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" alt="History"
                                    class="pim-icon" style="margin-top: 1px;">
                            </a>
                            <a href="<?= Yii::$app->homeUrl ?>kpi/view/kpi-individual-history/<?= ModelMaster::encodeParams(['kpiId' => $kpi['kpiId'], "kpiEmployeeId" => $kpiEmployeeId]) ?>"
                                class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs' ?> mr-5"
                                style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/history.svg" alt="History"
                                    class="pim-icon mr-3"><?= Yii::t('app', 'History') ?>
                            </a>
                            <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/kpi-individual-history/<?= ModelMaster::encodeParams(['kpiId' => $kpi['kpiId'], 'kpiEmployeeHistoryId' => $kpi["kpiEmployeeHistoryId"], 'kpiEmployeeId' => $kpiEmployeeId, 'openTab' => 3]) ?>"
                                class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs' ?> mr-5"
                                style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg" alt="History"
                                    class="pim-icon mr-3"><?= Yii::t('app', 'Chats') ?>
                            </a>
                            <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/kpi-individual-history/<?= ModelMaster::encodeParams(['kpiId' => $kpi['kpiId'], 'kpiEmployeeHistoryId' => $kpi["kpiEmployeeHistoryId"], 'kpiEmployeeId' => $kpiEmployeeId, 'openTab' => 4]) ?>"
                                class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs' ?> mr-5"
                                style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.svg" alt="Chart"
                                    class="pim-icon mr-3"><?= Yii::t('app', 'Chart') ?>
                            </a>
                            <?php
                                            if ($role >= 5) {
                                            ?>
                            <a class="btn btn-bg-red-xs" data-bs-toggle="modal" data-bs-target="#delete-kpi-employee"
                                onclick="javascript:prepareDeleteKpiEmployee(<?= $kpiEmployeeId ?>)"
                                onmouseover="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binwhite.svg'"
                                onmouseout="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg'">
                                <img src=" <?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg" alt="History"
                                    class="pim-icon">
                            </a>
                            <?php
                                            }
                                            ?>
                        </div>
                        <div class="col-lg-3 pim-subheader-font border-right-<?= $colorFormat ?> mt-10">
                            <div class="row">
                                <div class="col-12 text-start pl-22">
                                    <?= Yii::t('app', 'Assign on') ?>
                                </div>
                                <div class="col-10 pl-20 pr-0 mt-10">
                                    <div class="col-12 pb-1">
                                        <div class="row">
                                            <div class="col-4 pr-2 pl-13">
                                                <div class="row d-flex align-items-center" style="min-height: 24px;">
                                                    <?php if ($kpi["countTeamEmployee"] != 0) { ?>
                                                    <div class="col-2">
                                                        <?php if (isset($kpi['teamMate'][0])):
                                                                                $filePath = Yii::getAlias('@webroot') . '/' . $kpi['teamMate'][0];
                                                                                if (file_exists($filePath) == 0) {
                                                                                    $kpi['teamMate'][0] = 'image/user.svg';
                                                                                }
                                                                            ?>
                                                        <img src="<?= Yii::$app->homeUrl . $kpi['teamMate'][0] ?>"
                                                            class="pim-pic-gridNew">
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="col-2 pic-after pt-0">
                                                        <?php if (isset($kpi['teamMate'][1])):
                                                                                $filePath = Yii::getAlias('@webroot') . '/' . $kpi['teamMate'][1];
                                                                                if (file_exists($filePath) == 0) {
                                                                                    $kpi['teamMate'][1] = 'image/user.svg';
                                                                                } ?>
                                                        <img src="<?= Yii::$app->homeUrl . $kpi['teamMate'][1] ?>"
                                                            class="pim-pic-gridNew">
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="col-2 pic-after pt-0">
                                                        <?php if (isset($kpi['teamMate'][2])):
                                                                                $filePath = Yii::getAlias('@webroot') . '/' . $kpi['teamMate'][2];
                                                                                if (file_exists($filePath) == 0) {
                                                                                    $kpi['teamMate'][2] = 'image/user.svg';
                                                                                }
                                                                            ?>
                                                        <img src="<?= Yii::$app->homeUrl . $kpi['teamMate'][2] ?>"
                                                            class="pim-pic-gridNew">
                                                        <?php endif; ?>
                                                    </div>
                                                    <div
                                                        class="col-5 number-tagNew  <?= $kpi["countTeamEmployee"] == 0 && $colorFormat != "disable"  ? 'load-yenlow' : 'load-'  . $colorFormat ?> ">
                                                        <?= $kpi["countTeamEmployee"] ?>
                                                    </div>
                                                    <?php } else { ?>
                                                    <div class="col-2 ">
                                                        <div
                                                            class="<?= $kpi['countTeamEmployee'] == 0 && $colorFormat != 'disable' ? 'pim-pic-yenlow' : 'pim-pic-' . $colorFormat ?>">
                                                            <img
                                                                src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg">
                                                        </div>
                                                    </div>
                                                    <div class="col-2 pic-after pt-0">
                                                        <div
                                                            class="<?= $kpi['countTeamEmployee'] == 0 && $colorFormat != 'disable' ? 'pim-pic-yenlow' : 'pim-pic-' . $colorFormat ?>">
                                                            <img
                                                                src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg">
                                                        </div>
                                                    </div>
                                                    <div class="col-2 pic-after pt-0">
                                                        <div
                                                            class="<?= $kpi['countTeamEmployee'] == 0 && $colorFormat != 'disable' ? 'pim-pic-yenlow' : 'pim-pic-' . $colorFormat ?>">
                                                            <img
                                                                src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg">
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-5 number-tagNew  <?= $kpi["countTeamEmployee"] == 0 && $colorFormat != "disable"  ? 'load-yenlow' : 'load-'  . $colorFormat ?> ">
                                                        <?= $kpi["countTeamEmployee"] ?>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-5 <?= $colorFormat . '-assignNew' ?>">
                                                <span class="pull-left">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/view-<?= $colorFormat ?>.svg"
                                                        class="assing-icon mr-5 ml-3 mt-1">
                                                </span>
                                                <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/kpi-individual-history/<?= ModelMaster::encodeParams(['kpiId' => $kpi['kpiId'], 'kpiEmployeeHistoryId' => $kpi["kpiEmployeeHistoryId"], 'kpiEmployeeId' => $kpiEmployeeId]) ?>"
                                                    class="font-<?= $colorFormat ?>"
                                                    style="top: 2px;<?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                                    <?= Yii::t('app', 'View Mates') ?>
                                                </a>
                                            </div>
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
                                                        <?= $kpi["countTeam"] ?>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-5 <?= $colorFormat ?>-assignNew ">
                                                <span class="pull-left">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/view-<?= $colorFormat ?>.svg"
                                                        class="assing-icon mr-5 ml-3  mt-1">
                                                </span>
                                                <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/kpi-individual-history/<?= ModelMaster::encodeParams(['kpiId' => $kpi['kpiId'], 'kpiEmployeeHistoryId' => $kpi["kpiEmployeeHistoryId"], 'kpiEmployeeId' => $kpiEmployeeId]) ?>"
                                                    class="font-<?= $colorFormat ?>"
                                                    style="top: 2px;<?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                                    <?= Yii::t('app', 'View Teams') ?>
                                                </a>
                                            </div>
                                            <div class="col-1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 pr-0 pl-0" style="margin-top:5px;">
                                    <div class="col-12 text-center priority-star">
                                        <?php
                                                        if ($kpi["priority"] == "A" || $kpi["priority"] == "B") {
                                                        ?>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <?php
                                                        }
                                                        if ($kpi["priority"] == "A" || $kpi["priority"] == "C") {
                                                        ?>
                                        <i class="fa fa-star big-star" aria-hidden="true"></i>
                                        <?php
                                                        }
                                                        if ($kpi["priority"] == "B") {
                                                        ?>
                                        <i class="fa fa-star ml-10" aria-hidden="true"></i>
                                        <?php
                                                        }
                                                        if ($kpi["priority"] == "A") {
                                                        ?>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <?php
                                                        }
                                                        ?>
                                    </div>
                                    <?php
                                                    if ($kpi["priority"] != '') {
                                                    ?>
                                    <div class="col-12 text-center priority-box">
                                        <div class="col-12"><?= Yii::t('app', 'Priority') ?></div>
                                        <div class="col-12 text-priority"><?= $kpi["priority"] ?></div>
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
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $kpi["quantRatio"] == 1 ? 'quantity' : 'diamon' ?>.svg"
                                    class="pim-iconKFI" style="margin-top: -1px; margin-left: 3px;">
                                <?= $kpi["quantRatio"] == 1 ? Yii::t('app', 'Quantity') : Yii::t('app', 'Quality') ?>
                            </div>
                            <div class="col-12 pr-0 pl-0 pt-10"><?= Yii::t('app', 'Update Interval') ?></div>
                            <div class="col-12  pim-unit-text">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/monthly.svg"
                                    class="pim-iconKFI" style="margin-top: -1px; margin-left: 3px;">
                                <?= Yii::t('app', $kpi["unit"]) ?>
                            </div>
                        </div>
                        <div class="col-lg-3 pim-small-text border-right-<?= $colorFormat ?> mt-20 pr-15 pl-15">
                            <div class="row">
                                <div class="col-5 text-start">
                                    <div class="col-12">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Target.svg"
                                            class="pim-iconKFI" style="margin-top: 1px; margin-right: 3px;">
                                        <?= Yii::t('app', 'Target') ?>
                                    </div>
                                    <div class="col-12 mt-3 number-pim">
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
                                        <?= number_format($show) ?><?= $kpi["amountType"] == 1 ? '%' : '' ?>
                                    </div>
                                </div>
                                <div class="col-2 symbol-pim text-center">
                                    <div class="col-12 pt-17"><?= $kpi["code"] ?></div>
                                </div>
                                <div class="col-5  text-end">
                                    <div class="col-12">
                                        <?= Yii::t('app', 'Result') ?>
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Result.svg"
                                            class="pim-iconKFI" style="margin-top: 1px; margin-left: 3px;">
                                    </div>
                                    <div class="col-12 mt-3 number-pim">
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
                                <div class="col-12 pl-15 pr-10">
                                    <?php
                                                    $percent = explode('.', $kpi['ratio']);
                                                    $showPercent = 0;
                                                    if (isset($percent[0]) && $percent[0] == '0') {
                                                        if (isset($percent[1])) {
                                                            if ($percent[1] == '00') {
                                                                $showPercent = 0;
                                                            } else {
                                                                $showPercent = round($kpi['ratio'], 1);
                                                            }
                                                        }
                                                    } else {
                                                        if ($kpi['ratio'] != '') {
                                                            $showPercent = round(floatval($kpi['ratio']));
                                                        } else {
                                                            $showPercent = 0;
                                                        }
                                                    }
                                                    ?>
                                    <div class="progress">
                                        <div class="progress-bar-<?= $colorFormat ?>"
                                            style="width:<?= $showPercent ?>%;">
                                        </div>
                                        <span class="progress-load load-<?= $colorFormat ?>"><?= $showPercent ?>%</span>
                                    </div>
                                </div>
                                <div class="col-4 pl-5 pr-5 mt-16">
                                    <div class="col-12 text-end"><?= Yii::t('app', 'Last Updated on') ?></div>
                                    <div class="col-12 text-end pim-duedate">
                                        <?= $kpi['lastestUpdate'] == "" ? 'Not set' : $kpi['lastestUpdate'] ?>
                                    </div>
                                </div>
                                <div class="col-4 text-center mt-16 pt-5">
                                    <?php
                                                    if ($colorFormat == 'disable'  && $canEdit == 1) {
                                                    ?>
                                    <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/update-personal-kpi/<?= ModelMaster::encodeParams(['kpiEmployeeId' => $kpiEmployeeId, 'kpiHistoryId' => 0]) ?>"
                                        style="display: flex; justify-content: center; align-items: center; padding: 7px 9px;  height: 30px; gap: 6px; flex-shrink: 0;"
                                        class="pim-btn-setup">
                                        <div class="pim-btn-setup">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/setupwhite.svg"
                                                class="mb-2" style="width: 12px; height: 12px;">
                                            <?= Yii::t('app', 'Setup') ?>
                                        </div>
                                    </a>
                                    <?php
                                                    } else if ($colorFormat == "complete") {
                                                        // echo Yii::t('app', "Update");
                                                    } else if ($canEdit == 1) {
                                                    ?>
                                    <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/update-personal-kpi/<?= ModelMaster::encodeParams(['kpiEmployeeId' => $kpiEmployeeId, 'kpiHistoryId' => $kpi["kpiEmployeeHistoryId"]]) ?>"
                                        style="display: flex; justify-content: center; align-items: center; padding: 7px 9px;  height: 30px; gap: 6px; flex-shrink: 0;"
                                        class="pim-btn-<?= $colorFormat ?>">
                                        <div class="pim-btn-<?= $colorFormat ?>">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh.svg"
                                                class="mb-2" style="width: 12px; height: 12px;">
                                            <?php
                                                                if ($colorFormat == "over") {
                                                                    echo Yii::t('app', 'Update');
                                                                } else {
                                                                    echo Yii::t('app', 'Update');
                                                                }
                                                                ?>
                                        </div>
                                    </a>
                                    <?php
                                                    }
                                                    ?>
                                </div>
                                <div class="col-4 pl-0 pr-5 mt-16">
                                    <div class="col-12 text-start font-<?= $colorFormat ?>">
                                        <?= Yii::t('app', 'Next Update Date') ?>
                                    </div>
                                    <div class="col-12 text-start pim-duedate">
                                        <?= $kpi['nextCheck'] == "" ? 'Not set' : $kpi['nextCheck'] ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 pim-subheader-font mt-20">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12 pr-3 pl-20">
                                    <div class="col-12 head-letter head-<?= $colorFormat ?>">
                                        <?= Yii::t('app', 'Issue') ?></div>
                                    <div class="col-12 body-letter body-letter-<?= $colorFormat ?>">
                                        <?= $kpi["issue"] ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 pl-5 pr-20">
                                    <div class="col-12 head-letter head-<?= $colorFormat ?>">
                                        <?= Yii::t('app', 'Solution') ?></div>
                                    <div class="col-12 body-letter body-letter-<?= $colorFormat ?>">
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
        </div>
    </div>
</div>
<?= $this->render('modal_issue') ?>
<?= $this->render('modal_delete') ?>