<?php

use common\models\ModelMaster;

$this->title =  Yii::t('app', 'Waiting for approve KGI');
?>
<div class="col-12">
    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.png" class="home-icon mr-5"
            style="margin-top: -3px;">
        <strong class="pim-head-text"> <?= Yii::t('app', 'Performance Indicator Matrices (PIM)') ?></strong>
    </div>
    <div class="col-12 mt-10">
        <?= $this->render('header_filter', [
            "role" => $role,
            "allCompany" => $allCompany,
            "companyPic" => $companyPic,
            "totalBranch" => $totalBranch,
            "page" => 'grid'
        ]) ?>
    </div>
    <div class="alert pim-body bg-white mt-10">
        <table class="" style="width:100%;">
            <thead>
                <tr class="pim-table-header">
                    <th class="pl-10"><?= Yii::t('app', 'Employee') ?></th>
                    <th style="width:20%;"><?= Yii::t('app', 'KGI Contents') ?></th>
                    <th class="text-center"><?= Yii::t('app', 'Priority') ?></th>
                    <th class="text-center"><?= Yii::t('app', 'Previous') ?></th>
                    <th class="text-center"><?= Yii::t('app', 'New') ?></th>
                    <th class="text-center"><?= Yii::t('app', 'Change') ?></th>
                    <th class="text-center"><?= Yii::t('app', 'Month') ?></th>
                    <th style="width:15%;"><?= Yii::t('app', 'Reason') ?></th>
                    <th class="text-center"></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ((isset($employeeKpis) && count($employeeKpis) > 0) || (isset($employeeRequest) && count($employeeRequest) > 0)) {

                    // --- ส่วนที่ 1: แสดงรายการ KGI ที่รอการอนุมัติ (ถ้ามี) ---
                    if (isset($employeeKgis) && count($employeeKgis) > 0) {

                        foreach ($employeeKgis as $kgiEmployeeHistoryId => $employeeKgi) :
                            if ($employeeKgi["isOver"] == 1 && $employeeKgi["status"] != 2) {
                                $colorFormat = 'over';
                            } else {
                                if ($employeeKgi["status"] == 1) {
                                    $colorFormat = 'inprogress';
                                } else {
                                    $colorFormat = 'complete';
                                }
                            }
                ?>
                            <tr height="10">
                            </tr>
                            <tr class="pim-bg-<?= $colorFormat ?> pim-table-text">
                                <td>
                                    <div class="col-12 border-left-<?= $colorFormat ?> pim-div-border pb-5">
                                        <?= $employeeKgi["employeeName"] ?>
                                    </div>
                                </td>
                                <td><?= $employeeKgi["kgiName"] ?></td>
                                <td class="text-center"><?= $employeeKgi["priority"] ?></td>
                                <td class="font-b text-end"><?= number_format($employeeKgi["target"], 2) ?></td>
                                <td class="font-b text-end"><?= number_format($employeeKgi["newTarget"], 2) ?></td>
                                <td class="text-danger text-end">
                                    <?= number_format($employeeKgi["newTarget"] - $employeeKgi["target"], 2) ?></td>
                                <td class="text-center"><?= Yii::t('app', $employeeKgi["month"]) ?></td>
                                <td><?= $employeeKgi["reson"] ?></td>
                                <td class="text-center"> <a
                                        href="javascript:approveTargetKgiEmployee(<?= $kgiEmployeeHistoryId ?>,1)"
                                        class="approve-btn mr-5 no-underline mr-10">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/circle-check-blue.svg" class="mr-5"
                                            style="margin-top: -2px;"><?= Yii::t('app', 'Approve') ?>
                                    </a>
                                    <a href="javascript:approveTargetKgiEmployee(<?= $kgiEmployeeHistoryId ?>,0)"
                                        class="decline-btn  no-underline">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/circle-cancel.svg" class="mr-5"
                                            style="margin-top: -2px;"><?= Yii::t('app', 'Decline') ?>
                                    </a>
                                </td>
                                <td class="text-center">

                                    <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/kgi-employee-history/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId, 'kgiEmployeeHistoryId' => $kgi['kgiEmployeeHistoryId'], 'openTab' => 1]) ?>"
                                        class="btn btn-bg-white-xs">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" style="margin-top: -2px;">
                                    </a>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                    }

                    // --- ส่วนที่ 2: แสดงรายการคำร้องขอแก้ไข (ถ้ามี) ---
                    if (isset($employeeRequest) && count($employeeRequest) > 0) {
                        foreach ($employeeRequest as $request_id => $employeeRequestInfo) :
                            $oldTarget = (float)($employeeRequestInfo["target"] ?? 0);
                            $newTarget = (float)($employeeRequestInfo["newTarget"] ?? 0);
                            $oldResult = (float)($employeeRequestInfo["result"] ?? 0);
                            $newResult = (float)($employeeRequestInfo["newResult"] ?? 0);
                            $targetDiff = $newTarget - $oldTarget;
                            $resultDiff = $newResult - $oldResult;
                        ?>
                            <tr height="10"></tr>
                            <tr class="pim-bg-complete pim-table-text">
                                <td>
                                    <div class="col-12 border-left-complete pim-div-border pb-5">
                                        <div class="font-b"><?= $employeeRequestInfo["kgiName"] ?? 'N/A' ?></div>
                                        <div class="font-size-12 text-gray"><?= $employeeRequestInfo["employeeName"] ?? 'N/A' ?></div>
                                    </div>
                                </td>
                                <td colspan="2" class="text-center text-primary font-b">
                                    <span class="badge bg-info text-dark"><?= Yii::t('app', 'Edit Request') ?></span>
                                </td>
                                <td class="text-end">
                                    <div class="text-gray font-size-10"><?= Yii::t('app', 'Old Target') ?></div>
                                    <?= number_format($oldTarget, 2) ?>
                                    <div class="text-gray font-size-10"><?= Yii::t('app', 'Old Result') ?></div>
                                    <?= number_format($oldResult, 2) ?>
                                </td>
                                <td class="text-end">
                                    <div class="text-gray font-size-10"><?= Yii::t('app', 'New Target') ?></div>
                                    <span class="text-primary font-b"><?= number_format($newTarget, 2) ?></span>
                                    <div class="text-gray font-size-10"><?= Yii::t('app', 'New Result') ?></div>
                                    <span class="text-primary font-b"><?= number_format($newResult, 2) ?></span>
                                </td>
                                <td class="text-end">
                                    <div class="<?= $targetDiff > 0 ? 'text-success' : ($targetDiff < 0 ? 'text-danger' : 'text-gray') ?>">
                                        <small class="text-gray"><?= Yii::t('app', 'Target') ?>:</small>
                                        <?= ($targetDiff > 0 ? '+' : '') . number_format($targetDiff, 2) ?>
                                    </div>

                                    <div class="<?= $resultDiff > 0 ? 'text-success' : ($resultDiff < 0 ? 'text-danger' : 'text-gray') ?>">
                                        <small class="text-gray"><?= Yii::t('app', 'Result') ?>:</small>
                                        <?= ($resultDiff > 0 ? '+' : '') . number_format($resultDiff, 2) ?>
                                    </div>
                                </td>
                                <td class="text-center"><?= $employeeRequestInfo["month"] ?? '-' ?></td>
                                <td>
                                    <div class="text-truncate" style="max-width: 150px;" title="<?= $employeeRequestInfo["reson"] ?>">
                                        <?= $employeeRequestInfo["reson"] ?: '-' ?>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="javascript:approveTargetKpiEmployee(<?= $request_id ?>, 1)" class="approve-btn no-underline">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/circle-check-blue.svg" class="mr-5" style="margin-top: -2px;">
                                            <?= Yii::t('app', 'Approve') ?>
                                        </a>
                                        <a href="javascript:approveTargetKpiEmployee(<?= $request_id ?>, 0)" class="decline-btn no-underline">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/circle-cancel.svg" class="mr-5" style="margin-top: -2px;">
                                            <?= Yii::t('app', 'Decline') ?>
                                        </a>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/kpi-individual-history/<?= ModelMaster::encodeParams(['kpiEmployeeHistoryId' => $employeeRequestInfo['kpiEmployeeHistoryId'] ?? 0, 'kpiEmployeeId' => $employeeRequestInfo["kpiEmployeeId"] ?? 0]) ?>" class="btn btn-bg-white-xs">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" style="margin-top: -2px;">
                                    </a>
                                </td>
                            </tr>
                    <?php
                        endforeach;
                    }
                } else { ?>
                    <tr>
                        <td colspan="6" class="col-12 mt-20 font-size-14 text-secondary">
                            <?= Yii::t('app', 'There are no waiting for approve KGI') ?>.</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <?= $this->render('modal_reson') ?>
</div>