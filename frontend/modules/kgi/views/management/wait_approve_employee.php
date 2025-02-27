<?php

use common\models\ModelMaster;

$this->title = 'Waiting for approve KGI';
?>
<div class="col-12">
    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.png" class="home-icon mr-5"
            style="margin-top: -3px;">
        <strong class="pim-head-text"> <?= Yii::t('app', 'Performance Indicator Matrices') ?> (PIM)</strong>
    </div>
    <div class="col-12 mt-10">
        <?= $this->render('header_filter', [
			"role" => $role
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