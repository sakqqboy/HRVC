<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Kgi;
use frontend\models\hrvc\KgiEmployee;
use yii\bootstrap5\ActiveForm;

$this->title = "Individual KGI";
?>
<div class="contrainer-body">
    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.svg" class="home-icon mr-5"
            style="margin-top: -3px;">
        <strong class="pim-head-text"> <?= Yii::t('app', 'Individual Key Goal Indicator') ?></strong>
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
                                    <a href="<?= Yii::$app->homeUrl ?>kgi/management/index" class="no-underline-black ">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/company.svg"
                                            alt="Company" class="pim-icon"
                                            style="width: 14px;height: 14px;padding-bottom: 4px;">
                                        <?= Yii::t('app', 'Company KGI') ?>
                                    </a>
                                </div>
                                <div class="col-4 pim-type-tab pr-0 pl-0">
                                    <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-team/team-kgi"
                                        class="no-underline-black ">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team.svg" alt="Team"
                                            class="pim-icon" style="width: 13px;height: 13px;padding-bottom: 2px;">
                                        <?= Yii::t('app', 'Team KGI') ?>
                                    </a>
                                </div>
                                <div class="col-4 pim-type-tab-selected  pr-0 pl-0 rounded-top-right">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/self.svg" alt="Self"
                                        class="pim-icon" style="width: 13px;height: 13px;padding-bottom: 3px;">
                                    <?= Yii::t('app', 'Self KGI') ?>
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
                        <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/individual-kgi-grid"
                            class="btn btn-outline-primary font-size-12 pim-change-modes">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/gridblack.svg"
                                style="cursor: pointer;">
                        </a>
                        <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/individual-kgi"
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
                                <td class="pl-10" style="width:13%"><?= Yii::t('app', 'KGI Contents') ?></td>
                                <td style="width:10%"><?= Yii::t('app', 'Company Name') ?></td>
                                <td style="width:13%"><?= Yii::t('app', 'Branch') ?></td>
                                <td style="width:5%"><?= Yii::t('app', 'Priority') ?></td>
                                <td style="width:7%"><?= Yii::t('app', 'Employees') ?></td>
                                <td style="width:4%"><?= Yii::t('app', 'Team') ?></td>
                                <td style="width:5%"><?= Yii::t('app', 'QR') ?></td>
                                <td class="text-end" style="width:5%"><?= Yii::t('app', 'Target') ?></td>
                                <td class="text-center" style="width:6%"><?= Yii::t('app', 'Code') ?></td>
                                <td class="text-start" style="width:5%"><?= Yii::t('app', 'Result') ?></td>
                                <td class="text-center" style="width:5%"><?= Yii::t('app', 'Ratio') ?></td>
                                <td class="text-center" style="width:2%"><?= Yii::t('app', 'Month') ?></td>
                                <td class="text-center" style="width:5%"><?= Yii::t('app', 'Unit') ?></td>
                                <td class="text-center"><?= Yii::t('app', 'Last') ?></td>
                                <td class="text-center"><?= Yii::t('app', 'Next') ?></td>
                                <td style="width:5%"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($kgis) && count($kgis) > 0) {
                                foreach ($kgis as $kgiEmployeeId => $kgi) :
                                    $canEdit = KgiEmployee::canEdit($role, $kgiEmployeeId);
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
                                            if ($kgi["status"] == 2) {
                                                $colorFormat = 'complete';
                                            } else {
                                                $colorFormat = 'inprogress';
                                            }
                                        }
                                    }

                            ?>
                            <tr height="10">

                            </tr>
                            <tr id="kgi-<?= $kgiEmployeeId ?>" class="pim-bg-<?= $colorFormat ?> pim-table-text">
                                <td>
                                    <div class="col-12 border-left-<?= $colorFormat ?> pim-div-border pb-5">
                                        <?= $kgi["kgiName"] ?>
                                    </div>
                                </td>
                                <td><?= $kgi["companyName"] ?></td>
                                <td><img src="<?= Yii::$app->homeUrl . $kgi['flag'] ?>" class="Flag-Turkey">
                                    <?= $kgi["branch"] ?>, <?= Yii::t('app', $kgi["countryName"]) ?></td>
                                <td>
                                    <div
                                        style="width: 24px; height: 24px; flex-shrink: 0; border-radius: 4px; background: #2580D3; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                                        <?= $kgi["priority"] ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-5 number-tagNew  <?= 'load-' . $colorFormat ?> ">
                                        <?= count($kgi["employee"]) ?>
                                    </div>
                                </td>
                                </td>
                                <td>
                                    <div class="col-5 number-tagNew  <?= 'load-' . $colorFormat ?> ">
                                        <?= $kgi["countTeam"] ?>
                                    </div>
                                </td>
                                <td><?= $kgi["quantRatio"] == 1 ? Yii::t('app', 'Quantity') : Yii::t('app', 'Quality') ?>
                                </td>
                                <td class="text-end">
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
                                    <?= $show ?>
                                </td>
                                <td class="text-center">
                                    <?= $kgi["code"] ?>
                                </td>
                                <td class="text-start">
                                    <?php
                                            if ($kgi["result"] != '') {
                                                $decimalResult = explode('.', $kgi["result"]);
                                                if (isset($decimalResult[1])) {
                                                    if ($decimalResult[1] == '00') {
                                                        $showResult = $decimalResult[0];
                                                    } else {
                                                        $showResult = $kgi["result"];
                                                    }
                                                } else {
                                                    $showResult = $kgi["result"];
                                                }
                                            } else {
                                                $showResult = 0;
                                            }
                                            ?>
                                    <?= $showResult ?>
                                </td>
                                <td>
                                    <div id="progress1">
                                        <div data-num="<?= $kgi["ratio"] == '' ? 0 : $kgi["ratio"] ?>"
                                            class="progress-pim-table progress-circle-<?= $colorFormat ?>"></div>
                                    </div>
                                </td>
                                <td><?= Yii::t('app', $kgi["month"]) ?></td>
                                <td><?= Yii::t('app', $kgi["unit"]) ?></td>
                                <td><?= $kgi["periodCheck"] ?></td>
                                <td class="<?= $kgi['isOver'] == 1 ? 'text-danger' : '' ?>">
                                    <?= $kgi["status"] == 1 ? $kgi["nextCheck"] : '' ?>
                                </td>
                                <td style="width: 53px; height: 50px;">

                                    <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/kgi-employee-history/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId, 'kgiEmployeeHistoryId' => 0, 'kgiId' => $kgi['kgiId'], 'openTab' => 1]) ?>"
                                        class="btn btn-bg-white-xs"
                                        style="margin-top: -1px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/eye.svg" alt="History"
                                            class="pim-icon" style="margin-top: -1px;">
                                    </a>
                                    <span class="dropdown" href="#" id="dropdownMenuLink-<?= $kgi['isOver'] ?>"
                                        data-bs-toggle="dropdown">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/3Dot.svg"
                                            class="icon-table on-cursor">
                                    </span>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink-<?= $kgi['isOver'] ?>">
                                        <?php
                                                if ($canEdit == 1) {
                                                ?>
                                        <li class="pl-4 pr-4">
                                            <a class="dropdown-itemNEWS pl-4 pr-20 mb-5"
                                                href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/update-personal-kgi/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId]) ?>">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/editblack.svg"
                                                    alt="edit" class="pim-icon mr-10" style="margin-top: -2px;">
                                                <?= Yii::t('app', 'Edit') ?>
                                            </a>
                                        </li>
                                        <?php
                                                }
                                                ?>
                                        <li class="pl-4 pr-4">
                                            <a class="dropdown-itemNEWS pl-4 pr-20 mb-5"
                                                style="<?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>"
                                                href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-individual-history/<?= ModelMaster::encodeParams(['kgiId' => $kgi['kgiId'], "kgiEmployeeId" => $kgiEmployeeId]) ?>">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/history.svg"
                                                    alt="Chats" class="pim-icon mr-10">
                                                <?= Yii::t('app', 'History') ?>
                                            </a>
                                        </li>
                                        <li class="pl-4 pr-4">
                                            <a class="dropdown-itemNEWS pl-4 pr-20 mb-5"
                                                style="<?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>"
                                                href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/kgi-employee-history/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId, 'kgiEmployeeHistoryId' => 0, 'kgiId' => $kgi['kgiId'], 'openTab' => 3]) ?>">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg"
                                                    alt="Chats" class="pim-icon mr-10">
                                                <?= Yii::t('app', 'Chats') ?>
                                            </a>
                                        </li>
                                        <li class="pl-4 pr-4">
                                            <a class="dropdown-itemNEWS pl-4 pr-20"
                                                style="<?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>"
                                                href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/kgi-employee-history/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId, 'kgiEmployeeHistoryId' => 0, 'kgiId' => $kgi['kgiId'], 'openTab' => 4]) ?>">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.svg"
                                                    alt="Chats" class="pim-icon mr-10">
                                                <?= Yii::t('app', 'Chart') ?>
                                            </a>
                                        </li>
                                        <?php
                                                if ($role >= 5) {
                                                ?>
                                        <li class="pl-4 pr-4" data-bs-toggle="modal"
                                            data-bs-target="#delete-kgi-employee"
                                            onclick="javascript:prepareDeleteKgiEmployee(<?= $kgiEmployeeId ?>)"
                                            title="Delete">
                                            <a class="dropdown-itemNEW pl-4 pr-25" href="#">
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
<?= $this->render('modal_delete') ?>
<?= $this->render('modal_issue') ?>