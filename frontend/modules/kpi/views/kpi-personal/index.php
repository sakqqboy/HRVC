<?php

use common\models\ModelMaster;
use frontend\models\hrvc\KpiEmployee;

$this->title = "Individual KPI";
?>
<div class="contrainer-body">
    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.svg" class="home-icon mr-5"
            style="margin-top: -3px;">
        <strong class="pim-head-text"> <?= Yii::t('app', 'Individual Key Performance Indicator') ?></strong>
    </div>
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
                                    <a href="<?= Yii::$app->homeUrl ?>kpi/management/index" class="no-underline-black ">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/company.svg"
                                            alt="Company" class="pim-icon"
                                            style="width: 14px;height: 14px;padding-bottom: 4px;">
                                        <?= Yii::t('app', 'Company KPI') ?>
                                    </a>
                                </div>
                                <div class="col-4 pim-type-tab pr-0 pl-0">
                                    <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-team/team-kpi"
                                        class="no-underline-black ">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team.svg" alt="Team"
                                            class="pim-icon" style="width: 13px;height: 13px;padding-bottom: 2px;">
                                        <?= Yii::t('app', 'Team KPI') ?>
                                    </a>
                                </div>
                                <div class="col-4 pim-type-tab-selected pr-0 pl-0 rounded-top-right">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/self.svg" alt="Self"
                                        class="pim-icon" style="width: 13px;height: 13px;padding-bottom: 3px;">
                                    <?= Yii::t('app', 'Self KPI') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 pl-4">
                            <?php
                            if ($role > 3) {
                            ?>
                            <div
                                class="col-12 <?= $waitForApprove["totalRequest"] > 0 ? 'approval-box' : 'noapproval-box' ?> text-center pr-3">

                                <?php
                                    if ($waitForApprove["totalRequest"] > 0) {
                                    ?>
                                <a href="<?= Yii::$app->homeUrl ?>kgi/management/wait-approve"
                                    style="text-decoration: none;color:#000000;">
                                    <span class="approvals-num mr-2"><?= $waitForApprove["totalRequest"] ?></span>
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
                        "months" => $months,
                        "month" => $month,
                        "status" => $status,
                        "year" => $year,
                        "role" => $role,
                        "companyId" => $companyId,
                        "branchId" => $branchId,
                        "teamId" => $teamId,
                        "role" => $role,
                        "teams" => $teams,
                        "teamId" => isset($teamId) ? $teamId : '',
                        "employeeId" => isset($employeeId) ? $employeeId : '',
                        "employees" => isset($employees) ? $employees : []
                    ]) ?>
                    <input type="hidden" id="type" value="list">
                </div>

                <div class="col-lg-1 col-md-6 col-12 pr-0 text-end">
                    <div class="btn-group" role="group">
                        <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/individual-kpi-grid"
                            class="btn btn-outline-primary font-size-12 pim-change-modes">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/gridblack.svg"
                                style="cursor: pointer;">
                        </a>
                        <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/individual-kpi"
                            class="btn btn-primary font-size-12 pim-change-modes">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/listwhite.svg"
                                style="cursor: pointer;">
                        </a>

                    </div>
                </div>
            </div>

            <div class="col-12 mt-15">
                <div class="row">
                    <table class="">
                        <thead>
                            <tr class="pim-table-header">
                                <td class="pl-10" style="width:13%"><?= Yii::t('app', 'KPI Contents') ?></td>
                                <td style="width:10%"><?= Yii::t('app', 'Company Name') ?></td>
                                <td style="width:13%"><?= Yii::t('app', 'Branch') ?></td>
                                <td style="width:5%"><?= Yii::t('app', 'Priority') ?></td>
                                <td style="width:7%"><?= Yii::t('app', 'Employees') ?></td>
                                <td style="width:4%"><?= Yii::t('app', 'Team') ?></td>
                                <td style="width:5%"><?= Yii::t('app', 'QR') ?></td>
                                <td class="text-end" style="width:5%"><?= Yii::t('app', 'Target') ?></td>
                                <td class="text-center" style="width:6%"><?= Yii::t('app', 'Code') ?></td>
                                <td class="text-start" style="width:5%"><?= Yii::t('app', 'Resul') ?>t</td>
                                <td class="text-center" style="width:5%"><?= Yii::t('app', 'Ratio') ?></td>
                                <td class="text-center" style="width:2%"><?= Yii::t('app', 'Month') ?></td>
                                <td class="text-center" style="width:5%"><?= Yii::t('app', 'Unit') ?></td>
                                <td class="text-center">Last</td>
                                <td class="text-center"><?= Yii::t('app', 'Next') ?></td>
                                <td style="width:5%"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($kpis) && count($kpis) > 0) {
                                foreach ($kpis as $kpiEmployeeId => $kpi) :
                                    $canEdit = KpiEmployee::canEdit($role, $kpiEmployeeId);
                                    if ($kpi["isOver"] == 1 && $kpi["status"] != 2) {
                                        $colorFormat = 'over';
                                    } else {
                                        if ($kpi["status"] == 1) {
                                            if ($kpi["isOver"] == 2) {
                                                $colorFormat = 'disable';
                                            } else {
                                                $colorFormat = 'inprogress';
                                            }
                                        } else {
                                            $colorFormat = 'complete';
                                        }
                                    }

                            ?>
                            <tr height="10">

                            </tr>
                            <tr id="kpi-<?= $kpiEmployeeId ?>" class="pim-bg-<?= $colorFormat ?> pim-table-text">
                                <td>
                                    <div class="col-12 border-left-<?= $colorFormat ?> pim-div-border pb-5">
                                        <?= $kpi["kpiName"] ?>
                                    </div>
                                </td>
                                <td><?= $kpi["companyName"] ?></td>
                                <td><img src="<?= Yii::$app->homeUrl . $kpi['flag'] ?>" class="Flag-Turkey">
                                    <?= $kpi["branch"] ?>, <?= $kpi["countryName"] ?></td>
                                <td class="text-center">
                                    <div
                                        style="width: 24px; height: 24px; flex-shrink: 0; border-radius: 4px; background: #2580D3; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                                        <?= $kpi["priority"] ?>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="col-5 number-tagNew  <?= 'load-' . $colorFormat ?> ">
                                        <?= count($kpi["employee"]) ?>
                                    </div>
                                </td>
                                <td>

                                    <div class="col-5 number-tagNew  <?= 'load-' . $colorFormat ?> ">
                                        <?= $kpi["countTeam"] ?>
                                    </div>
                                </td>
                                <td><?= $kpi["quantRatio"] == 1 ? Yii::t('app', 'Quantity') : Yii::t('app', 'Quality') ?>
                                </td>
                                <td class="text-end">
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
                                    <?= $show ?>
                                </td>
                                <td class="text-center">
                                    <?= $kpi["code"] ?>
                                </td>
                                <td class="text-start">
                                    <?php
                                            if ($kpi["result"] != '') {
                                                $decimalResult = explode('.', $kpi["result"]);
                                                if (isset($decimalResult[1])) {
                                                    if ($decimalResult[1] == '00') {
                                                        $showResult = $decimalResult[0];
                                                    } else {
                                                        $showResult = $kpi["result"];
                                                    }
                                                } else {
                                                    $showResult = $kpi["result"];
                                                }
                                            } else {
                                                $showResult = 0;
                                            }
                                            ?>
                                    <?= $showResult ?>
                                </td>
                                <td>
                                    <?php
                                            $showPercent = 0;
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
                                                $showPercent = round(floatval($kpi['ratio']));
                                            }
                                            ?>
                                    <div id="progress1">
                                        <div data-num="<?= $showPercent ?>"
                                            class="progress-pim-table progress-circle-<?= $colorFormat ?>"></div>
                                    </div>
                                </td>
                                <td><?= Yii::t('app', $kpi["month"]) ?></td>
                                <td><?= Yii::t('app', $kpi["unit"]) ?></td>
                                <td><?= $kpi["periodCheck"] ?></td>
                                <td class="<?= $kpi['isOver'] == 1 ? 'text-danger' : '' ?>">
                                    <?= $kpi["status"] == 1 ? $kpi["nextCheck"] : '' ?>
                                </td>
                                <td class="text-center">

                                    <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/kpi-individual-history/<?= ModelMaster::encodeParams(['kpiId' => $kpi['kpiId'], 'kpiEmployeeHistoryId' => $kpi["kpiEmployeeHistoryId"], 'kpiEmployeeId' => $kpiEmployeeId]) ?>"
                                        class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?> mr-5"
                                        style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" alt="History"
                                            class="pim-icon" style="margin-top: -1px;">
                                    </a>

                                    <span class="dropdown" href="#" id="dropdownMenuLink-<?= $kpiEmployeeId ?>"
                                        data-bs-toggle="dropdown">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/3Dot.svg"
                                            class="icon-table on-cursor">
                                    </span>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink-<?= $kpiEmployeeId ?>">
                                        <?php
                                                 if ($colorFormat == "complete") {
                                                    // echo Yii::t('app', "Update");
                                                } else if ($canEdit == 1) {
                                                ?>
                                        <li class="pl-4 pr-4">
                                            <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/update-personal-kpi/<?= ModelMaster::encodeParams(['kpiEmployeeId' => $kpiEmployeeId,'kpiHistoryId' => 0]) ?>"
                                                class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/editblack.svg"
                                                    alt="History" alt="Edit" class="pim-icon mr-10"
                                                    style="margin-top: -2px;">
                                                <?= Yii::t('app', 'Edit') ?>
                                            </a>
                                        </li>
                                        <li class="pl-4 pr-4">
                                            <a href="<?= Yii::$app->homeUrl ?>kpi/view/kpi-individual-history/<?= ModelMaster::encodeParams(['kpiId' => $kpi['kpiId'], "kpiEmployeeId" => $kpiEmployeeId]) ?>"
                                                class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs' ?> mr-5"
                                                style="margin-top: -1px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/history.svg"
                                                    alt="History" class="pim-icon mr-10" style="margin-top: -2px;">
                                                <?= Yii::t('app', 'History') ?>
                                            </a>
                                        </li>
                                        <li class="pl-4 pr-4">
                                            <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/kpi-individual-history/<?= ModelMaster::encodeParams(['kpiId' => $kpi['kpiId'], 'kpiEmployeeHistoryId' => $kpi["kpiEmployeeHistoryId"], 'kpiEmployeeId' => $kpiEmployeeId, 'openTab' => 3]) ?>"
                                                class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs' ?> mr-5"
                                                style="margin-top: -1px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg"
                                                    alt="Chats" class="pim-icon mr-10" style="margin-top: -2px;">
                                                <?= Yii::t('app', 'Chats') ?>
                                            </a>
                                        </li>
                                        <li class="pl-4 pr-4">
                                            <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/kpi-individual-history/<?= ModelMaster::encodeParams(['kpiId' => $kpi['kpiId'], 'kpiEmployeeHistoryId' => $kpi["kpiEmployeeHistoryId"], 'kpiEmployeeId' => $kpiEmployeeId, 'openTab' => 4]) ?>"
                                                class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs' ?> mr-5"
                                                style="margin-top: -1px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Chart.svg"
                                                    alt="Chart" class="pim-icon mr-10" style="margin-top: -2px;">
                                                <?= Yii::t('app', 'Chart') ?>
                                            </a>
                                        </li>
                                        <?php
                                                }
                                                ?>
                                        <?php
                                                if ($role >= 5) {
                                                ?>
                                        <li class="pl-4 pr-4">
                                            <a class="dropdown-itemNEW pl-4 pr-25" data-bs-toggle="modal"
                                                data-bs-target="#delete-kpi-employee"
                                                onclick="javascript:prepareDeleteKpiEmployee(<?= $kpiEmployeeId ?>)">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/delete.svg"
                                                    alt="Delete" class="pim-icon mr-10" style="margin-top: -2px;">
                                                <?= Yii::t('app', 'Delete') ?>
                                            </a>
                                        </li>
                                        <?php
                                                }
                                                ?>
                                    </ul>
                                </td>
                            </tr>
                            <?php
                                endforeach;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="create" id="acType">

<?= $this->render('modal_issue') ?>
<?= $this->render('modal_delete') ?>