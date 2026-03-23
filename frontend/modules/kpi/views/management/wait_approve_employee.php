<?php

use common\models\ModelMaster;

$this->title = Yii::t('app', 'Waiting for approve KPI');
?>
<div class="col-12">
    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.svg" class="home-icon mr-5"
            style="margin-top: -3px;">
        <strong class="pim-head-text"> <?= Yii::t('app', 'Performance Indicator Matrices') ?> (<?= Yii::t('app', 'PIM') ?>)</strong>
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
                    <th style="width:20%;"><?= Yii::t('app', 'KPI Contents') ?></th>
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
                // เปลี่ยนเงื่อนไขจาก && เป็น || เพื่อให้แสดงผลแม้จะมีข้อมูลเพียงฝั่งเดียว
                if ((isset($employeeKpis) && count($employeeKpis) > 0) || (isset($employeeRequest) && count($employeeRequest) > 0)) {

                    // --- ส่วนที่ 1: แสดงรายการ KPI ปกติ (ถ้ามี) ---
                    if (isset($employeeKpis) && count($employeeKpis) > 0) {

                        foreach ($employeeKpis as $kpiEmployeeHistoryId => $employeeKpi) :
                            // กำหนดสี Format ตามสถานะ (Over, In-Progress, Complete)
                            if ($employeeKpi["isOver"] == 1 && $employeeKpi["status"] != 2) {
                                $colorFormat = 'over';
                            } else {
                                $colorFormat = ($employeeKpi["status"] == 1) ? 'inprogress' : 'complete';
                            }

                            // คำนวณส่วนต่างระหว่างค่าเดิมกับค่าใหม่
                            $oldTarget = (float)$employeeKpi["target"];
                            $newTarget = (float)$employeeKpi["newTarget"];
                            $targetDiff = $newTarget - $oldTarget;
                ?>
                            <tr height="10"></tr>
                            <tr class="pim-bg-<?= $colorFormat ?> pim-table-text">
                                <td>
                                    <div class="col-12 border-left-<?= $colorFormat ?> pim-div-border pb-5">
                                        <div class="font-b"><?= $employeeKpi["employeeName"] ?></div>
                                    </div>
                                </td>
                                <td><?= $employeeKpi["kpiName"] ?></td>
                                <td class="text-center">
                                    <span class="badge bg-secondary"><?= $employeeKpi["priority"] ?></span>
                                </td>

                                <td class="text-end">
                                    <div class="text-gray font-size-10"><?= Yii::t('app', 'Old Target') ?></div>
                                    <span class="font-b text-secondary"><?= number_format($oldTarget, 2) ?></span>
                                </td>

                                <td class="text-end">
                                    <div class="text-gray font-size-10"><?= Yii::t('app', 'New Target') ?></div>
                                    <span class="font-b text-primary"><?= number_format($newTarget, 2) ?></span>
                                </td>

                                <td class="text-end <?= $targetDiff > 0 ? 'text-success' : 'text-danger' ?>">
                                    <div class="text-gray font-size-10"><?= Yii::t('app', 'Diff') ?></div>
                                    <?= ($targetDiff > 0 ? '+' : '') . number_format($targetDiff, 2) ?>
                                </td>

                                <td class="text-center"><?= $employeeKpi["month"] ?></td>

                                <td>
                                    <div class="text-truncate" style="max-width: 150px;" title="<?= $employeeKpi["reson"] ?>">
                                        <?= $employeeKpi["reson"] ?: '<span class="text-gray">-</span>' ?>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="javascript:approveTargetKpiEmployee(<?= $kpiEmployeeHistoryId ?>, 1)" class="approve-btn no-underline">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/circle-check-blue.svg" class="mr-5" style="margin-top: -2px;">
                                            <?= Yii::t('app', 'Approve') ?>
                                        </a>
                                        <a href="javascript:approveTargetKpiEmployee(<?= $kpiEmployeeHistoryId ?>, 0)" class="decline-btn no-underline">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/circle-cancel.svg" class="mr-5" style="margin-top: -2px;">
                                            <?= Yii::t('app', 'Decline') ?>
                                        </a>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/kpi-individual-history/<?= ModelMaster::encodeParams(['kpiEmployeeHistoryId' => $kpiEmployeeHistoryId, 'kpiEmployeeId' => $employeeKpi["kpiId"]]) ?>" class="btn btn-bg-white-xs">
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
                                        <div class="font-b"><?= $employeeRequestInfo["kpiName"] ?? 'N/A' ?></div>
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
                        <td colspan="10" class="text-center py-5 text-secondary">
                            <?= Yii::t('app', 'There are no waiting for approve') ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?= $this->render('modal_reson') ?>
</div>