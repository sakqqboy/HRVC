<?php

use common\models\ModelMaster;

$this->title = 'Waiting for approve KPI';
?>
<div class="contrainer-body">
    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.svg" class="home-icon mr-5"
            style="margin-top: -3px;">
        <strong class="pim-head-text"> Performance Indicator Matrices (PIM)</strong>
    </div>
    <div class="col-12 mt-10">
        <?= $this->render('header_filter', [
            "role" => $role
        ]) ?>
    </div>
    <?php
    if ($role == 3) { //TEAM LEADER
    ?>
        <div class="alert pim-body bg-white mt-10">
            <table class="">
                <thead>
                    <tr class="pim-table-header">
                        <th class="pl-10"><?= Yii::t('app', 'Employee') ?></th>
                        <th class="pl-10"><?= Yii::t('app', 'KPI Contents') ?></th>
                        <th class="text-center"><?= Yii::t('app', 'Priority') ?></th>
                        <th><?= Yii::t('app', 'Previous') ?></th>
                        <th class="text-center"><?= Yii::t('app', 'New') ?></th>
                        <th class="text-center"><?= Yii::t('app', 'Change') ?></th>
                        <th class="text-center"><?= Yii::t('app', 'Month') ?></th>
                        <th class="text-center"></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($employeeKpis) && count($employeeKpis) > 0) {
                        foreach ($employeeKpis as $kpiEmployeeHistoryId => $employeeKpi) :
                    ?>
                            <tr class="font-size-12">
                                <td><?= $employeeKpi["kpiName"] ?></td>
                                <td><?= $employeeKpi["employeeName"] ?></td>
                                <td class="font-b"><?= number_format($employeeKpi["target"], 2) ?></td>
                                <td class="font-b"><?= number_format($employeeKpi["newTarget"], 2) ?></td>
                                <td style="width: 30%;"><?= $employeeKpi["reson"] ?></td>
                                <td class="text-center">
                                    <a href="<?= Yii::$app->homeUrl ?>kpi/management/approve-kpi-employee/<?= ModelMaster::encodeParams(["kpiEmployeeHistoryId" => $kpiEmployeeHistoryId]) ?>"
                                        class="btn btn-sm btn-primary font-size-10">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                    } else { ?>
                        <tr>
                            <td colspan="6" class="col-12 mt-20 font-size-14 text-secondary">
                                <?= Yii::t('app', 'There are no waiting for approve') ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php
    } else { //MANAGER
    ?>
        <div class="alert pim-body bg-white mt-10">
            <table class="" style="width:100%;">
                <thead>
                    <tr class="pim-table-header">
                        <th class="pl-10"><?= Yii::t('app', 'Employee') ?></th>
                        <th class="pl-10"><?= Yii::t('app', 'KPI Contents') ?></th>
                        <th><?= Yii::t('app', 'Branch') ?></th>
                        <th class="text-center"><?= Yii::t('app', 'Priority') ?></th>
                        <th class="text-center"><?= Yii::t('app', 'Team') ?></th>
                        <th><?= Yii::t('app', 'Previous') ?></th>
                        <th class="text-center"><?= Yii::t('app', 'New') ?></th>
                        <th class="text-center"><?= Yii::t('app', 'Change') ?></th>
                        <th class="text-center"><?= Yii::t('app', 'Month') ?></th>
                        <th class="text-center"></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //throw new exception(print_r($teamKpis, true));
                    if (isset($teamKpis) && count($teamKpis) > 0) {

                        foreach ($teamKpis as $kpiTeamHistoryId => $teamKpi) :
                            if ($teamKpi["isOver"] == 1 && $teamKpi["status"] != 2) {
                                $colorFormat = 'over';
                            } else {
                                if ($teamKpi["status"] == 1) {
                                    $colorFormat = 'inprogress';
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
                            <tr class="pim-bg-<?= $colorFormat ?> pim-table-text">
                                <td>
                                    <div class="col-12 border-left-<?= $colorFormat ?> pim-div-border pb-5">
                                        <?= $teamKpi["creater"] ?>
                                    </div>
                                </td>
                                <td><?= $teamKpi["kpiName"] ?></td>
                                <td><?= $teamKpi["branch"] ?></td>
                                <td class="text-center"><?= $teamKpi["priority"] ?></td>
                                <td class="text-center"><?= $teamKpi["teamName"] ?></td>
                                <td class="text-end">
                                    <?php
                                    $decimal = explode('.', $teamKpi["target"]);
                                    if (isset($decimal[1])) {
                                        if ($decimal[1] == '00') {
                                            $show = number_format($decimal[0]);
                                        } else {
                                            $show = number_format($teamKpi["target"], 2);
                                        }
                                    } else {
                                        $show = number_format($teamKpi["target"]);
                                    }
                                    ?>
                                    <?= $show ?><?= $teamKpi["amountType"] == 1 ? '%' : '' ?>
                                </td>
                                <td class="text-end">
                                    <?php
                                    $decimal = explode('.', $teamKpi["newTarget"]);
                                    if (isset($decimal[1])) {
                                        if ($decimal[1] == '00') {
                                            $show = number_format($decimal[0]);
                                        } else {
                                            $show = number_format($teamKpi["newTarget"], 2);
                                        }
                                    } else {
                                        $show = number_format($teamKpi["newTarget"]);
                                    }
                                    ?>
                                    <?= $show ?><?= $teamKpi["amountType"] == 1 ? '%' : '' ?>

                                </td>
                                <td class="text-danger text-end"><?= number_format($teamKpi["newTarget"] - $teamKpi["target"], 2) ?>
                                </td>
                                <td class="text-center"><?= Yii::t('app', $teamKpi["month"]) ?></td>
                                <td class="text-center">
                                    <a href="javascript:approveTargetKpiTeam(<?= $teamKpi['kpiTeamId'] ?>,1)"
                                        class="approve-btn mr-5 no-underline mr-10">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/circle-check-blue.svg" class="mr-5"
                                            style="margin-top: -2px;"><?= Yii::t('app', 'Approve') ?>
                                    </a>
                                    <a href="javascript:approveTargetKpiTeam(<?= $teamKpi['kpiTeamId'] ?>,0)"
                                        class="decline-btn  no-underline">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/circle-cancel.svg" class="mr-5"
                                            style="margin-top: -2px;"><?= Yii::t('app', 'Decline') ?>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a onclick="javascript:changeTargetKpiTeamReason(<?= $kpiTeamHistoryId ?>)"
                                        class="btn btn-bg-white-xs mr-5" data-bs-toggle="modal" data-bs-target="#reason">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/question.svg"
                                            style="margin-top: -3px;">
                                    </a>
                                    <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-team/kpi-team-history/<?= ModelMaster::encodeParams(['kpiTeamHistoryId' => $kpiTeamHistoryId, 'kpiTeamId' => $teamKpi["kpiTeamId"]]) ?>"
                                        class="btn btn-bg-white-xs">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" style="margin-top: -2px;">
                                    </a>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                    } else { ?>
                        <tr>
                            <td colspan="9" class="col-12 mt-20 font-size-14 text-secondary">
                                <?= Yii::t('app', 'There are no waiting for approve') ?>
                                KPI</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php
    }
    ?>
    <?= $this->render('modal_reson') ?>
</div>