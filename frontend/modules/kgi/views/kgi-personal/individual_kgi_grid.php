<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Kgi;
use frontend\models\hrvc\KgiEmployee;
use frontend\models\hrvc\KgiTeam;
use yii\bootstrap5\ActiveForm;

$this->title = "INDIVIDUAL KGI";
?>
<div class="contrainer-body">
    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.svg" class="home-icon mr-5"
            style="margin-top: -3px;">
        <strong class="pim-head-text"><?= Yii::t('app', 'Individual Key Goal Indicators') ?></strong>
    </div>
    <div class="col-12 mt-10">
        <div class="col-12 mt-10">
            <?= $this->render('header_filter', [
                "role" => $role
            ]) ?>
            <div class="alert mt-10 pim-body bg-white">
                <div class="row sticky-section">
                    <div class="col-lg-4 col-md-6 col-12  pr-0 pt-1">
                        <div class="row">
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-4 pim-type-tab pr-0 pl-0 rounded-top-left">
                                        <a href="<?= Yii::$app->homeUrl ?>kgi/management/grid"
                                            class="no-underline-black ">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/company.svg"
                                                alt="Company" class="pim-icon"
                                                style="width: 14px;height: 14px;padding-bottom: 4px;">
                                            <?= Yii::t('app', 'Company KGI') ?>
                                        </a>
                                    </div>
                                    <div class="col-4 pr-0 pl-0 pim-type-tab">
                                        <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-team/team-kgi-grid"
                                            class="no-underline-black ">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team.svg"
                                                alt="Team" class="pim-icon"
                                                style="width: 13px;height: 13px;padding-bottom: 2px;">
                                            <?= Yii::t('app', 'Team KGI') ?>
                                        </a>
                                    </div>
                                    <div class="col-4 pr-0 pl-0 pim-type-tab-selected rounded-top-right">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/self.svg" alt="Self"
                                            class="pim-icon" style="width: 13px;height: 13px;padding-bottom: 3px;">
                                        <?= Yii::t('app', 'Self KGI') ?>
                                    </div>

                                </div>
                            </div>
                            <div class="col-4 pl-4">
                                <?php
                                if ($role >= 3) {
                                ?>
                                <div
                                    class="col-12 <?= $waitForApprove["totalRequest"] > 0 ? 'approval-box' : 'noapproval-box' ?> text-center pr-3">
                                    <?php
                                        if ($waitForApprove["totalRequest"] > 0) {
                                        ?>
                                    <a href=" <?= Yii::$app->homeUrl ?>kgi/management/wait-approve-kgi-personal"
                                        style="text-decoration: none;color:#000000;">
                                        <span class="approve-num mr-2"><?= $waitForApprove["totalRequest"] ?></span>
                                        <?= Yii::t('app', 'Approvals') ?>
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/approvals.svg"
                                            class="first-layer-icon pull-right" style="margin-top:-2px;">
                                    </a>
                                    <?php
                                        } else { ?>
                                    <a style="text-decoration: none;color:#2D7F06;">
                                        <span class="noapprovals-num mr-2"><?= $waitForApprove["totalRequest"] ?></span>
                                        <?= Yii::t('app', 'No Approvals') ?>
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/check.svg"
                                            class="first-layer-icon pull-right" style="margin-top:-2px;">
                                    </a>
                                    <?php
                                        }

                                        ?>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-7 pt-1">
                        <?= $this->render('filter_list', [
                            "companies" => $companies,
                            "companyId" => $companyId,
                            "branchId" => $branchId,
                            "teamId" => $teamId,
                            "months" => $months,
                            "month" => $month,
                            "status" => $status,
                            "year" => $year,
                            "role" => $role,
                            "teams" => $teams,
                            "teamId" => isset($teamId) ? $teamId : '',
                            "employeeId" => isset($employeeId) ? $employeeId : '',
                            "employees" => isset($employees) ? $employees : []
                        ]) ?>
                        <input type="hidden" id="type" value="grid">
                    </div>
                    <div class="col-lg-1 col-md-6 col-12 pr-0 text-end">
                        <div class="btn-group" role="group">
                            <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/individual-kgi-grid"
                                class="btn btn-primary font-size-12 pim-change-modes">
                                <!-- <i class="fa fa-th-large" aria-hidden="true"></i> -->
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/gridwhite.svg"
                                    style="cursor: pointer;">
                            </a>
                            <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/individual-kgi"
                                class="btn btn-outline-primary font-size-12 pim-change-modes">
                                <!-- <i class="fa fa-list-ul" aria-hidden="true"></i> -->
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/listblack.svg"
                                    style="cursor: pointer;">
                            </a>

                        </div>
                    </div>
                </div>
                <div class="col-12 mt-15">
                    <div class="row">
                        <?php
                        if (isset($kgis) && count($kgis) > 0) {
                            foreach ($kgis as $kgiEmployeeId => $kgi) :
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
                                } else {
                                    if ($kgi["status"] == 1) {
                                        if ($kgi["isOver"] == 2) {
                                            $colorFormat = 'disable';
                                        } else {
                                            $colorFormat = 'inprogress';
                                        }
                                    } else {
                                        $colorFormat = 'complete';
                                    }
                                }
                        ?>
                        <div class="col-12 mt-10 mb-5 pim-big-box pim-<?= $colorFormat ?>"
                            id="kgi-employee-<?= $kgiEmployeeId ?>">
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
                                        <?= $kgi['status'] == 1 ?  Yii::t('app', 'In process') :  Yii::t('app', 'Completed') ?>
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
                                            <?= $kgi['fromDate'] == "" ?  Yii::t('app', 'Not set') : $kgi['fromDate'] ?>
                                            -
                                            <?= $kgi['toDate'] == "" ? Yii::t('app', 'Not set') : $kgi['toDate'] ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-2 col-4 text-end pr-20" style="margin-top: -5px;">
                                    <?php
                                            if ($role >= 3) {
                                            ?>
                                    <span class="team-wrapper <?= $colorFormat ?>-teamshow"
                                        style="margin-right: 5px; padding: 5px; bottom: 1px;">
                                        <span class="team-icon pim-team-<?= $colorFormat ?>">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $colorFormat == 'disable' ? 'teamblack' : 'teamwhite' ?>.svg"
                                                alt="Team Icon">
                                        </span>
                                        <span class="team-name"><?= $kgi["teamName"] ?></span>
                                    </span>
                                    <?php } ?>
                                    <span class="team-wrapper <?= $colorFormat ?>-teamshow"
                                        style="margin-right: 5px; padding: 5px; ">

                                        <span class="pim-pic-icon">
                                            <img src="<?= Yii::$app->homeUrl . $kgi['picture'] ?>">
                                        </span>
                                        <span class="team-name"><?= $kgi["employeeName"] ?></span>
                                    </span>

                                    <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/kgi-employee-history/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId, 'kgiEmployeeHistoryId' => 0, 'kgiId' => $kgi['kgiId'], 'openTab' => 1]) ?>"
                                        class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?> mr-5"
                                        style="margin-top: -5px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" alt="History"
                                            class="pim-icon" style="margin-top: -1px;">
                                    </a>
                                    <a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-individual-history/<?= ModelMaster::encodeParams(['kgiId' => $kgi['kgiId'], "kgiEmployeeId" => $kgiEmployeeId]) ?>"
                                        class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?>"
                                        style="margin-top: -5px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/history.svg"
                                            alt="History" class="pim-icon mr-3"
                                            style="margin-top: -2px;"><?= Yii::t('app', 'History') ?>
                                    </a>
                                    <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/kgi-employee-history/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId, 'kgiEmployeeHistoryId' => 0, 'kgiId' => $kgi['kgiId'], 'openTab' => 3]) ?>"
                                        class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?> mr-5"
                                        style="margin-top: -5px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg"
                                            alt="Chats" class="pim-icon mr-3"
                                            style="margin-top: -2px;"><?= Yii::t('app', 'Chats') ?>
                                    </a>
                                    <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/kgi-employee-history/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId, 'kgiEmployeeHistoryId' => 0, 'kgiId' => $kgi['kgiId'], 'openTab' => 4]) ?>"
                                        class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?> mr-5"
                                        style="margin-top: -5px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.svg" alt="Chart"
                                            class="pim-icon mr-3"
                                            style="margin-top: -2px;"><?= Yii::t('app', 'Chart') ?>
                                    </a>
                                    <?php
                                            if ($role >= 5) {
                                            ?>
                                    <a class="btn btn-bg-red-xs" data-bs-toggle="modal"
                                        data-bs-target="#delete-kgi-employee"
                                        onclick="javascript:prepareDeleteKgiEmployee(<?= $kgiEmployeeId ?>)"
                                        style="margin-top: -3px;"
                                        onmouseover="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binwhite.svg'"
                                        onmouseout="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg'">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg"
                                            alt="History" class="pim-icon" style="margin-top: -2px;">
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
                                                        <div class="row d-flex align-items-center"
                                                            style="min-height: 24px;">
                                                            <?php if ($kgi["countTeamEmployee"] != 0) { ?>
                                                            <div class="col-2">
                                                                <?php
                                                                            if (isset($kgi['teamMate'][0])) {
                                                                            ?>
                                                                <img src="<?= Yii::$app->homeUrl . $kgi['teamMate'][0] ?>"
                                                                    class="pim-pic-gridNew">
                                                                <?php
                                                                            } else {
                                                                            ?>
                                                                <img src="<?= Yii::$app->homeUrl . 'image/user.svg' ?>"
                                                                    class="pim-pic-gridNew">
                                                                <?php   } ?>
                                                            </div>
                                                            <div class="col-2 pic-after pt-0">
                                                                <?php
                                                                            if (isset($kgi['teamMate'][1])) {
                                                                            ?>
                                                                <img src="<?= Yii::$app->homeUrl . $kgi['teamMate'][1] ?>"
                                                                    class="pim-pic-gridNew">
                                                                <?php
                                                                            } else {
                                                                            ?>
                                                                <img src="<?= Yii::$app->homeUrl . 'image/user.svg' ?>"
                                                                    class="pim-pic-gridNew">
                                                                <?php   } ?>
                                                            </div>
                                                            <div class="col-2 pic-after pt-0">
                                                                <?php
                                                                            if (isset($kgi['teamMate'][2])) {
                                                                            ?>
                                                                <img src="<?= Yii::$app->homeUrl . $kgi['teamMate'][2] ?>"
                                                                    class="pim-pic-gridNew">
                                                                <?php
                                                                            } else {
                                                                            ?>
                                                                <img src="<?= Yii::$app->homeUrl . 'image/user.svg' ?>"
                                                                    class="pim-pic-gridNew">
                                                                <?php   } ?>
                                                            </div>
                                                            <div
                                                                class="col-5 number-tagNew  <?= 'load-'  . $colorFormat ?> ">
                                                                <?= $kgi["countTeamEmployee"] ?>
                                                            </div>
                                                            <?php } else { ?>
                                                            <div class="col-2 ">
                                                                <div
                                                                    class="<?= $kgi['countTeamEmployee'] == 0 && $colorFormat != 'disable' ? 'pim-pic-yenlow' : 'pim-pic-' . $colorFormat ?>">
                                                                    <img
                                                                        src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg">
                                                                </div>
                                                            </div>
                                                            <div class="col-2 pic-after pt-0">
                                                                <div
                                                                    class="<?= $kgi['countTeamEmployee'] == 0 && $colorFormat != 'disable' ? 'pim-pic-yenlow' : 'pim-pic-' . $colorFormat ?>">
                                                                    <img
                                                                        src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg">
                                                                </div>
                                                            </div>
                                                            <div class="col-2 pic-after pt-0">
                                                                <div
                                                                    class="<?= $kgi['countTeamEmployee'] == 0 && $colorFormat != 'disable' ? 'pim-pic-yenlow' : 'pim-pic-' . $colorFormat ?>">
                                                                    <img
                                                                        src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg">
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="col-5 number-tagNew  <?= $kgi["countTeamEmployee"] == 0 && $colorFormat != "disable"  ? 'load-yenlow' : 'load-'  . $colorFormat ?> ">
                                                                <?= $kgi["countTeamEmployee"] ?>
                                                            </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-5 <?= $colorFormat . '-assignNew' ?>">
                                                        <span class="pull-left">
                                                            <img src="
                                                        <?= Yii::$app->homeUrl ?>images/icons/Settings/view-<?= $colorFormat ?>.svg"
                                                                class="home-icon mr-2">
                                                        </span>
                                                        <a class="font-<?= $colorFormat ?>"
                                                            href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/kgi-employee-history/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId, 'kgiEmployeeHistoryId' => 0, 'kgiId' => $kgi['kgiId'], 'openTab' => 1]) ?>"
                                                            style="top: 2px;">
                                                            <?= Yii::t('app', 'View Mates') ?>
                                                        </a>
                                                    </div>
                                                    <div class="col-1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-10 pt-5 pb-1">
                                                <div class="row">
                                                    <div class="col-4 pr-2">
                                                        <div class="row d-flex align-items-center"
                                                            style="min-height: 24px;">
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
                                                    <div class="col-5 <?= $colorFormat ?>-assignNew ">
                                                        <span class="pull-left">
                                                            <img src="
                                                        <?= Yii::$app->homeUrl ?>images/icons/Settings/view-<?= $colorFormat ?>.svg"
                                                                class="home-icon mr-2">
                                                        </span>
                                                        <a class="font-<?= $colorFormat ?>"
                                                            href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/kgi-employee-history/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId, 'kgiEmployeeHistoryId' => 0, 'kgiId' => $kgi['kgiId'], 'openTab' => 1]) ?>"
                                                            style="top: 2px;">
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
                                    <div class="col-12 pr-0 pl-0 pt-10"><?= Yii::t('app', 'Update Interval') ?></div>
                                    <div class="col-12  pim-unit-text">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/monthly.svg"
                                            class="pim-iconKFI" style="margin-top: -1px; margin-left: 3px;">
                                        <?= Yii::t('app', $kgi["unit"]) ?>
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
                                                        $targetAmount = $kgi["targetAmount"] ?? ''; // Ensure targetAmount is not null

                                                        if ($targetAmount === '') {
                                                            $show = '0.00';
                                                        } else {
                                                            $decimal = explode('.', $targetAmount);
                                                            if (isset($decimal[1])) {
                                                                $show = ($decimal[1] == '00') ? $decimal[0] : $targetAmount;
                                                            } else {
                                                                $show = $targetAmount;
                                                            }
                                                        }
                                                        ?>
                                                <?= $show ?><?= $kgi["amountType"] == 1 ? '%' : '' ?>
                                            </div>
                                        </div>
                                        <div class="col-2 symbol-pim text-center">
                                            <div class="col-12 pt-17"><?= $kgi["code"] ?></div>
                                        </div>
                                        <div class="col-5  text-end">
                                            <div class="col-12">
                                                <?= Yii::t('app', 'Result') ?>
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
                                                <span
                                                    class="progress-load load-<?= $colorFormat ?>"><?= $showPercent ?>%</span>
                                            </div>
                                        </div>
                                        <div class="col-4 pl-5 pr-5 mt-16">
                                            <div class="col-12 text-end"><?= Yii::t('app', 'Last Updated on') ?></div>
                                            <div class="col-12 text-end pim-duedate">
                                                <?= $kgi['lastestUpdate'] == "" ? 'Not set' : $kgi['lastestUpdate'] ?>
                                            </div>
                                        </div>
                                        <div class="col-4 text-center mt-16 pt-5">

                                            <?php
                                                    if ($colorFormat == 'disable'  &&  $canEdit == 1) {
                                                    ?>
                                            <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/update-personal-kgi/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId]) ?>"
                                                class="no-underline">
                                                <div class="pim-btn-setup"
                                                    style="display: flex; justify-content: center; align-items: center; padding: 7px 9px;  height: 30px; gap: 6px; flex-shrink: 0;">
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
                                            <a class="no-underline"
                                                href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/update-personal-kgi/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId]) ?>">
                                                <div class="pim-btn-<?= $colorFormat ?>"
                                                    style="display: flex; justify-content: center; align-items: center; padding: 7px 9px;  height: 30px; gap: 6px; flex-shrink: 0;">
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
                                                <?= $kgi['nextCheck'] == "" ? Yii::t('app', 'Not set') : $kgi['nextCheck'] ?>
                                            </div>
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
                                        <div class="col-lg-6 col-md-6 col-12 pr-20">
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
                </div>
            </div>
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