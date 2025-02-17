<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'KPI';
?>
<div class="contrainer-body">
    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.svg" class="home-icon mr-5"
            style="margin-top: -3px;">
        <strong class="pim-head-text"> <?= Yii::t('app', 'Performance Indicator Matrices') ?> (PIM)</strong>
    </div>
    <div class="col-12 mt-10">
        <?= $this->render('header_filter', [
            "role" => $role
        ]) ?>
        <div class="alert pim-body bg-white mt-10">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12  pr-0 pt-1">
                    <div class="row">
                        <div class="col-8">
                            <div class="row">
                                <div class="col-4 pim-type-tab-selected pr-0 pl-0 rounded-top-left">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/company.svg" alt="Company"
                                        class="pim-icon" style="width: 14px;height: 14px;padding-bottom: 4px;">
                                    <?= Yii::t('app', 'Company KPI') ?>
                                </div>
                                <div class="col-4 pr-0 pl-0 pim-type-tab">
                                    <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-team/team-kpi"
                                        class="no-underline-black ">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team.svg" alt="Team"
                                            class="pim-icon" style="width: 13px;height: 13px;padding-bottom: 2px;">
                                        <?= Yii::t('app', 'Team KPI') ?>
                                    </a>
                                </div>
                                <div class="col-4 pim-type-tab pr-0 pl-0 rounded-top-right">
                                    <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/individual-kpi"
                                        class="no-underline-black ">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/self.svg" alt="Self"
                                            class="pim-icon" style="width: 13px;height: 13px;padding-bottom: 3px;">
                                        <?= Yii::t('app', 'Self KPI') ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 pl-4">
                            <?php
                            if ($role >= 3) {
                            ?>
                            <button type="button" class="btn-createnew font-size-11" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop5" style="position:absolute;">
                                <?= Yii::t('app', 'Create New') ?>
                                <img src=" <?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg" alt="History"
                                    class="pim-icon ml-3" style="margin-top: -1px;">
                            </button>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12 col-12 pt-1">
                    <?= $this->render('filter_list_search', [
                        "companies" => $companies,
                        "months" => $months,
                        "companyId" => $companyId,
                        "branchId" => $branchId,
                        "teamId" => $teamId,
                        "month" => $month,
                        "status" => $status,
                        "yearSelected" => $year,
                        "branches" => $branches,
                        "teams" => $teams,
                        "role" => $role,
                    ]) ?>
                    <input type="hidden" id="type" value="list">
                </div>
                <div class="col-lg-1 col-md-6 col-12 pr-0 text-end">
                    <div class="btn-group" role="group">
                        <a href="<?= Yii::$app->homeUrl . 'kpi/management/grid' ?>"
                            class="btn btn-outline-primary font-size-12 pim-change-modes">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/gridblack.svg"
                                style="cursor: pointer;">
                        </a>
                        <a href="#" class="btn btn-primary font-size-12 pim-change-modes">
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
                                <td class="text-start" style="width:5%"><?= Yii::t('app', 'Result') ?></td>
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
                                foreach ($kpis as $kpiId => $kpi) :
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

                                    if ($role >= 4) {
                                        $display = '';
                                    } else {
                                        $display = 'none';
                                    }
                            ?>
                            <tr height="10">

                            </tr>
                            <tr id="kpi-<?= $kpiId ?>" class="pim-bg-<?= $colorFormat ?> pim-table-text">
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
                                <td>

                                    <div class="col-5 number-tagNew  <?= 'load-' . $colorFormat ?> ">
                                        <?= count($kpi["kpiEmployee"]) ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-5 number-tagNew  <?= 'load-' . $colorFormat ?> ">
                                        <?= $kpi["countTeam"] ?>
                                    </div>
                                </td>
                                <td><?= $kpi["quantRatio"] == 1 ? 'Quantity' : 'Quality' ?></td>
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
                                    <?= $show ?><?= $kpi["amountType"] == 1 ? '%' : '' ?>
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
                                    <?= $showResult ?><?= $kpi["amountType"] == 1 ? '%' : '' ?>
                                </td>
                                <td>
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

                                    <a href="<?= Yii::$app->homeUrl ?>kpi/view/kpi-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId]) ?>"
                                        class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs' ?> mr-5"
                                        style="margin-top: -1px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/eye.svg" alt="History"
                                            class="pim-icon" style="margin-top: -1px;">
                                    </a>

                                    <span class="dropdown" href="#" id="dropdownMenuLink-<?= $kpiId ?>"
                                        data-bs-toggle="dropdown">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/3Dot.svg"
                                            class="icon-table on-cursor">
                                    </span>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink-<?= $kpiId ?>">

                                        <li class="pl-4 pr-4" style="display: <?= $display ?>;">
                                            <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                href="<?= Yii::$app->homeUrl ?>kpi/management/prepare-update/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'kpiHistoryId' => 0]) ?>"
                                                class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/editblack.svg"
                                                    alt="History" alt="Chart" class="pim-icon mr-10"
                                                    style="margin-top: -2px;">
                                                <?= Yii::t('app', 'Edit') ?>
                                            </a>
                                        </li>

                                        <li class="pl-4 pr-4" data-bs-toggle="modal">
                                            <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                href="<?= Yii::$app->homeUrl ?>kpi/view/index/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'openTab' => 2]) ?>"
                                                class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs' ?> mr-5"
                                                style="margin-top: -1px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/history.svg"
                                                    alt="History" alt="Chart" class="pim-icon mr-10"
                                                    style="margin-top: -2px;">
                                                <?= Yii::t('app', 'History') ?>
                                            </a>
                                        </li>
                                        <li class="pl-4 pr-4" data-bs-toggle="modal">
                                            <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                href="<?= Yii::$app->homeUrl ?>kpi/view/kpi-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'openTab' => 3]) ?>"
                                                class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs' ?> mr-5"
                                                style="margin-top: -1px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg"
                                                    alt="Chart" class="pim-icon mr-10" style="margin-top: -2px;">
                                                <?= Yii::t('app', 'Chats') ?>
                                            </a>
                                        </li>
                                        <li class="pl-4 pr-4" data-bs-toggle="modal">
                                            <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                href="<?= Yii::$app->homeUrl ?>kpi/view/kpi-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'openTab' => 4]) ?>"
                                                class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs' ?> mr-5"
                                                style="margin-top: -1px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.svg"
                                                    alt="Chart" class="pim-icon mr-10" style="margin-top: -2px;">
                                                <?= Yii::t('app', 'Chart') ?>
                                            </a>
                                        </li>
                                        <?php
                                                if ($role >= 5) {
                                                ?>

                                        <li class="pl-4 pr-4" data-bs-toggle="modal">
                                            <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                href="<?= Yii::$app->homeUrl ?>kpi/assign/assign/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, "companyId" => $kpi["companyId"]]) ?>"
                                                class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs' ?> mr-5"
                                                style="margin-top: -1px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                                <i class="fa fa-users pim-icon mr-10" aria-hidden="true" alt="Chart"
                                                    style="margin-top: -2px;"></i>
                                                <?= Yii::t('app', 'Team') ?>
                                            </a>
                                        </li>
                                        <li class="pl-4 pr-4" data-bs-toggle="modal">
                                            <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                href="<?= Yii::$app->homeUrl ?>kpi/assign/assign/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, "companyId" => $kpi["companyId"]]) ?>"
                                                class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs' ?> mr-5"
                                                style="margin-top: -1px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                                <i class="fa fa-user pim-icon mr-10" aria-hidden="true" alt="Chart"
                                                    style="margin-top: -2px;"></i>
                                                <?= Yii::t('app', 'Person') ?>
                                            </a>
                                        </li>
                                        <li class="pl-4 pr-4" data-bs-toggle="modal" data-bs-target="#delete-kpi"
                                            onclick="javascript:prepareDeleteKpi(<?= $kpiId ?>)" title="Delete">
                                            <a class="dropdown-itemNEW pl-4 pr-25" href="#">
                                                <!-- <i class="fa fa-trash-o" aria-hidden="true"></i> -->
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
    <?= $this->render('modal_view') ?>
    <?= $this->render('modal_issue') ?>