<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Kgi;
use frontend\models\hrvc\KgiEmployee;
use frontend\models\hrvc\KgiTeam;
use yii\bootstrap5\ActiveForm;

$this->title = "INDIVIDUAL KGI";
?>
<div class="col-12">
    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.svg" class="home-icon mr-5"
            style="margin-top: -3px;">
        <strong class="pim-head-text">Individual Key Goal Indicators</strong>
    </div>
    <div class="col-12 mt-10">
        <div class="col-12 mt-10">
            <?= $this->render('header_filter', [
                "role" => $role
            ]) ?>
            <div class="alert mt-10 pim-body bg-white">
                <div class="row">
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
                                            Company KGI
                                        </a>
                                    </div>
                                    <div class="col-4 pr-0 pl-0 pim-type-tab">
                                        <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-team/team-kgi-grid"
                                            class="no-underline-black ">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team.svg"
                                                alt="Team" class="pim-icon"
                                                style="width: 13px;height: 13px;padding-bottom: 2px;">
                                            Team KGI
                                        </a>
                                    </div>
                                    <div class="col-4 pr-0 pl-0 pim-type-tab-selected rounded-top-right">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/self.svg" alt="Self"
                                            class="pim-icon" style="width: 13px;height: 13px;padding-bottom: 3px;">
                                        Self KGI
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
                                        Approvals
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/approvals.svg"
                                            class="first-layer-icon pull-right" style="margin-top:-2px;">
                                    </a>
                                    <?php
                                        } else { ?>
                                    <a style="text-decoration: none;color:#2D7F06;">
                                        <span class="noapprovals-num mr-2"><?= $waitForApprove["totalRequest"] ?></span>
                                        No Approvals
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
                <div class="col-12 mt-5">
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
                                        <?= $kgi['status'] == 1 ? 'In process' : 'Completed' ?>
                                    </div>
                                </div>
                                <div class=" col-lg-3 col-md-3 col-4 pl-30">
                                    <div class="row">
                                        <div class="col-4 month-<?= $colorFormat ?>"><?= $kgi['month'] ?></div>
                                        <div class="col-8 term-<?= $colorFormat ?>">
                                            <?= $kgi['fromDate'] == "" ? 'Not set' : $kgi['fromDate'] ?> -
                                            <?= $kgi['toDate'] == "" ? 'Not set' : $kgi['toDate'] ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-2 col-4 text-end pr-20">
                                    <img src="<?= Yii::$app->homeUrl . $kgi['picture'] ?>" class="pim-pic-grid">
                                    <span class="pim-normal-text mr-5">
                                        <?= $kgi["employeeName"] ?>
                                    </span>
                                    <a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-history/<?= ModelMaster::encodeParams(['kgiId' => $kgi['kgiId']]) ?>"
                                        class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?> mr-5"
                                        style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" alt="History"
                                            class="pim-icon" style="margin-top: -1px;">
                                    </a>
                                    <a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-individual-history/<?= ModelMaster::encodeParams(['kgiId' => $kgi['kgiId'], "kgiEmployeeId" => $kgiEmployeeId]) ?>"
                                        class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?>"
                                        style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/history.svg"
                                            alt="History" class="pim-icon mr-3" style="margin-top: -2px;">History
                                    </a>
                                    <a class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?> mr-5"
                                        style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>"
                                        data-bs-toggle="modal" data-bs-target="#kgi-issue"
                                        onclick="javascript:showKgiComment(<?= $kgi['kgiId'] ?>)"
                                        style="margin-top: -3px;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg"
                                            alt="History" class="pim-icon"> Chats
                                    </a>
                                    <a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-history/<?= ModelMaster::encodeParams(['kgiId' => $kgi['kgiId'], 'openTab' => 4]) ?>"
                                        class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?> mr-5"
                                        style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.svg" alt="Chart"
                                            class="pim-icon mr-3" style="margin-top: -2px;">Chart
                                    </a>
                                    <!-- <a class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?> mr-5"
                                        style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>"
                                        data-bs-toggle="modal" data-bs-target="#staticBackdrop3"
                                        onclick="javascript:kgiHistory(<?= $kgiEmployeeId ?>)"
                                        style="margin-top: -3px;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.svg"
                                            alt="History" class="pim-icon mr-3" style="margin-top: -2px;">Chart
                                    </a> -->

                                    <!-- <a class="btn btn-bg-white-xs mr-5"
                                        href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-individual-history/<?= ModelMaster::encodeParams(['kgiId' => $kgi['kgiId'], "kgiEmployeeId" => $kgiEmployeeId]) ?>"
                                        style="margin-top: -3px;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" alt="History"
                                            class="pim-icon" style="margin-top: -1px;">
                                    </a>
                                    <a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-individual-history/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId, 'kgiId' => $kgi['kgiId'], 'openTab' => 2]) ?>"
                                        class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/history.svg"
                                            alt="History" class="pim-icon mr-3" style="margin-top: -2px;">History
                                    </a>
                                    <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/view-personal-kgi/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId, 'kgiId' => $kgi['kgiId'], 'openTab' => 3]) ?>"
                                        class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg"
                                            alt="Chats" class="pim-icon mr-3" style="margin-top: -2px;">Chats
                                    </a>
                                    <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/view-personal-kgi/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId, 'kgiId' => $kgi['kgiId'], 'openTab' => 4]) ?>"
                                        class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.svg" alt="Chart"
                                            class="pim-icon mr-3" style="margin-top: -2px;">Chart
                                    </a> -->
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
                                <div class="col-lg-3 pim-subheader-font border-right-<?= $colorFormat ?> mt-5">
                                    <div class="row">
                                        <div class="col-12 text-start pl-22 fw-bold text-dark">
                                            Assign on
                                        </div>
                                        <!-- <div class="col-9 pl-10 pr-0">
                                            <div class="col-12 disable-assign  mt-5 pt-2 pb-2">
                                                <div class="row">
                                                    <div class="col-5 border-right pr-2 pl-13">
                                                        <div class="row">
                                                            <div class="col-2">
                                                                <?php
                                                                        if (isset($kgi['teamMate'][0])) {
                                                                        ?>
                                                                <img src="<?= Yii::$app->homeUrl . $kgi['teamMate'][0] ?>"
                                                                    class="pim-pic-grid">
                                                                <?php
                                                                        }
                                                                        ?>
                                                            </div>
                                                            <div class="col-2 pic-after pt-0">
                                                                <?php
                                                                        if (isset($kgi['teamMate'][1])) {
                                                                        ?>
                                                                <img src="<?= Yii::$app->homeUrl . $kgi['teamMate'][1] ?>"
                                                                    class="pim-pic-grid">
                                                                <?php
                                                                        }
                                                                        ?>
                                                            </div>
                                                            <div class="col-2 pic-after pt-0">
                                                                <?php
                                                                        if (isset($kgi['teamMate'][2])) {
                                                                        ?>
                                                                <img src="<?= Yii::$app->homeUrl . $kgi['teamMate'][2] ?>"
                                                                    class="pim-pic-grid">
                                                                <?php
                                                                        }
                                                                        ?>
                                                            </div>
                                                            <div class="col-5 number-tag load-disble pr-0 pl-0 pt-1"
                                                                style="margin-left: -3px;height:18px;width: 30px;margin-top: 1px;">
                                                                <?= $kgi["countTeamEmployee"]
                                                                        ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-7 pl-3 pr-13 pt-2">
                                                        Assign Teammate
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 disable-assign  mt-10 pt-5 pb-1">
                                                <div class="row">
                                                    <div class="col-5 border-right pr-2">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-black.svg"
                                                                    class="first-layer-icon ml-5"
                                                                    style="margin-top: -4px;">
                                                            </div>
                                                            <div class="col-4 number-tag load-disble pr-3 pl-3 ml-5"
                                                                style="height:17px;">
                                                                <?= $kgi["countTeam"] ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-7 pl-3 pr-13">
                                                        Teams
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="col-9 pl-20 pr-0">
                                            <div class="col-12 mt-5 pt-2 pb-1">
                                                <div class="row">
                                                    <div class="col-5 pr-2 pl-13">
                                                        <div class="row d-flex align-items-center"
                                                            style="min-height: 24px;">
                                                            <?php if ($kgi["countTeamEmployee"] != 0) {?>
                                                            <div class="col-2">
                                                                <?php
                                                                    if (isset($kgi['teamMate'][0])) {
                                                                    ?>
                                                                <img src="<?= Yii::$app->homeUrl . $kgi['teamMate'][0] ?>"
                                                                    class="pim-pic-gridNew">
                                                                <?php
                                                                    }
                                                                    ?>
                                                            </div>
                                                            <div class="col-2 pic-after pt-0">
                                                                <?php
                                                                    if (isset($kgi['teamMate'][1])) {
                                                                    ?>
                                                                <img src="<?= Yii::$app->homeUrl . $kgi['teamMate'][1] ?>"
                                                                    class="pim-pic-gridNew">
                                                                <?php
                                                                    }
                                                                    ?>
                                                            </div>
                                                            <div class="col-2 pic-after pt-0">
                                                                <?php
                                                                    if (isset($kgi['teamMate'][2])) {
                                                                    ?>
                                                                <img src="<?= Yii::$app->homeUrl . $kgi['teamMate'][2] ?>"
                                                                    class="pim-pic-gridNew">
                                                                <?php
                                                                    }
                                                                    ?>
                                                            </div>
                                                            <div
                                                                class="col-5 number-tagNew  <?= 'load-'  . $colorFormat ?> ">
                                                                <?= $kgi["countTeamEmployee"] ?>
                                                            </div>
                                                            <?php }else {?>
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
                                                            <?php }?>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 <?= $colorFormat . '-assignNew' ?>">
                                                        <span class="pull-left">
                                                            <img src="
                                                        <?= Yii::$app->homeUrl ?>images/icons/Settings/view-<?= $colorFormat ?>.svg"
                                                                class="home-icon mr-2">
                                                        </span>
                                                        <a class="font-<?= $colorFormat ?>" style="top: 2px;">
                                                            View mate
                                                        </a>
                                                    </div>
                                                    <div class="col-1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-10 pt-5 pb-1">
                                                <div class="row">
                                                    <div class="col-5 pr-2">
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
                                                    <div class="col-6 <?= $colorFormat ?>-assignNew ">
                                                        <span class="pull-left">
                                                            <img src="
                                                        <?= Yii::$app->homeUrl ?>images/icons/Settings/view-<?= $colorFormat ?>.svg"
                                                                class="home-icon mr-2">
                                                        </span>
                                                        <a class="font-<?= $colorFormat ?>" style="top: 2px;">
                                                            View Team
                                                        </a>
                                                    </div>
                                                    <div class="col-1">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3" style="margin-top:-5px;">
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
                                            <div class="col-12 text-center priority-box">
                                                <div class="col-12">Priority</div>
                                                <div class="col-12 text-priority"><?= $kgi["priority"] ?></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div
                                    class="col-lg-1 pim-subheader-font border-right-<?= $colorFormat ?> mt-5 pl-10 pr-10">
                                    <div class="col-12">Quant Ratio</div>
                                    <div class="col-12 border-bottom-<?= $colorFormat ?> pb-10 pim-normal-text">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $kgi["quantRatio"] == 1 ? 'quantity' : 'diamon' ?>.svg"
                                            class="pim-iconKFI" style="margin-top: -1px; margin-left: 3px;">
                                        <?= $kgi["quantRatio"] == 1 ? 'Quantity' : 'Quality' ?>
                                    </div>
                                    <div class="col-12 pr-0 pl-0 pt-10">update Interval</div>
                                    <div class="col-12  pim-normal-text">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/monthly.svg"
                                            class="pim-iconKFI" style="margin-top: -1px; margin-left: 3px;">
                                        <?= $kgi["unit"] ?>
                                    </div>
                                </div>
                                <div
                                    class="col-lg-3 pim-subheader-font border-right-<?= $colorFormat ?> mt-5 pr-15 pl-15">
                                    <div class="row">
                                        <div class="col-5 text-start">
                                            <div class="col-12">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Target.svg"
                                                    class="pim-iconKFI" style="margin-top: 1px; margin-right: 3px;">
                                                Target
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
                                                <?= $show ?><?= $kgi["targetAmount"] == 1 ? '%' : '' ?>
                                            </div>
                                        </div>
                                        <div class="col-2 symbol-pim text-center">
                                            <div class="col-12 pt-17"><?= $kgi["code"] ?></div>
                                        </div>
                                        <div class="col-5  text-end">
                                            <div class="col-12">
                                                Result
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
                                        <div class="col-4 pl-5 pr-5 mt-10">
                                            <div class="col-12 text-end">Last Updated on</div>
                                            <div class="col-12 text-end pim-duedate">
                                                <?= $kgi['nextCheck'] == "" ? 'Not set' : $kgi['nextCheck'] ?></div>
                                        </div>
                                        <div class="col-4 text-center pt-6 mt-10">
                                            <!-- <?php
                                                            //	if ($canEdit == 1 && $kgi["status"] != 2) {
                                                            if ($canEdit == 1) {
                                                            ?>
                                            <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/update-personal-kgi/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId]) ?>"
                                                class="no-underline">
                                                <div class="pim-btn-<?= $colorFormat ?>">
                                                    <i class="fa fa-refresh" aria-hidden="true"></i> Update
                                                </div>
                                            </a>
                                            <?php
                                                            }
                                            ?> -->

                                            <?php
                                                    if ($colorFormat == 'disable') {
                                                    ?>


                                            <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/update-personal-kgi/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId]) ?>"
                                                class="no-underline">
                                                <div class="pim-btn-setup">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/setupwhite.svg"
                                                        class="mb-2" style="width: 12px; height: 12px;"> Setup
                                                </div>
                                            </a>
                                            <?php
                                                    } else if ($colorFormat == 'complete') {
                                                    ?>

                                            <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/update-personal-kgi/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId]) ?>"
                                                class="no-underline">
                                                <div class="pim-btn-<?= $colorFormat ?>">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh.svg"
                                                        class="mb-2" style="width: 12px; height: 12px;"> Edit
                                                </div>
                                            </a>
                                            <?php
                                                    } else if ($role >= 5) {
                                                    ?>
                                            <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/update-personal-kgi/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId]) ?>"
                                                class="no-underline">
                                                <div class="pim-btn-<?= $colorFormat ?>">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh.svg"
                                                        class="mb-2" style="width: 12px; height: 12px;"> Update
                                                </div>
                                            </a>
                                            <?php
                                                    }
                                                    ?>
                                        </div>
                                        <div class="col-4 pl-0 pr-5 mt-10">
                                            <div class="col-12 text-start font-<?= $colorFormat ?>">Next Update Date
                                            </div>
                                            <div class="col-12 text-start pim-duedate">
                                                <?= $kgi['nextCheck'] == "" ? 'Not set' : $kgi['nextCheck'] ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 pim-subheader-font mt-5">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12 pr-3 pl-20">
                                            <div class="col-12 head-letter head-<?= $colorFormat ?>">Issue</div>
                                            <div class="col-12 body-letter body-letter-<?= $colorFormat ?>">
                                                <?= $kgi["issue"] ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 pl-5 pr-20">
                                            <div class="col-12 head-letter head-<?= $colorFormat ?>">Solution</div>
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