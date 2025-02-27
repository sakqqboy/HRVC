<?php

use common\models\ModelMaster;

$this->title = 'Waiting for approve KPI';
?>
<div class="col-12 mt-90">
    <div class="row">
        <div class="col-8">
            <i class="fa fa-clock-o font-size-20" aria-hidden="true"></i> <strong class="font-size-20">
                <?= Yii::t('app', 'Waiting for approve KPI') ?></strong>
        </div>
        <div class="col-4 text-end pr-15">
            <a href="<?= Yii::$app->homeUrl ?>kpi/management/assign-kpi" class="btn btn-secondary font-size-12">
                <i class="fa fa-chevron-left mr-5" aria-hidden="true"></i>
                <?= Yii::t('app', 'Back') ?>
            </a>
        </div>
    </div>
    <?php
	if ($role == 3) { //TEAM LEADER
	?>
    <div class="alert alert-light mt-10" role="alert">
        <table class="table table-striped">
            <thead class="table table-secondary">
                <tr class="secondary-setting">
                    <th><?= Yii::t('app', 'KPI Contents') ?></th>
                    <th><?= Yii::t('app', 'Employee') ?></th>
                    <th><?= Yii::t('app', 'Target') ?></th>
                    <th><?= Yii::t('app', 'New Target') ?></th>
                    <th><?= Yii::t('app', 'Reson') ?></th>
                    <th class="text-center font-size-14">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                    </th>
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
                        <?= Yii::t('app', 'There are no waiting for approve KPI') ?>.</td>
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
    <div class="alert alert-light mt-10" role="alert">
        <table class="table table-striped">
            <thead class="table table-secondary">
                <tr class="secondary-setting">
                    <th><?= Yii::t('app', 'KPI Contents') ?></th>
                    <th><?= Yii::t('app', 'Company') ?></th>
                    <th><?= Yii::t('app', 'Branch') ?></th>
                    <th><?= Yii::t('app', 'Department') ?></th>
                    <th><?= Yii::t('app', 'Team') ?></th>
                    <th><?= Yii::t('app', 'Target') ?></th>
                    <th><?= Yii::t('app', 'New Target') ?></th>
                    <th><?= Yii::t('app', 'Reson') ?></th>
                    <th class="text-center font-size-14">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
					if (isset($teamKpis) && count($teamKpis) > 0) {
						foreach ($teamKpis as $kpiTeamHistoryId => $teamKpi) :
					?>
                <tr class="font-size-12">
                    <td><?= $teamKpi["kpiName"] ?></td>
                    <td><?= $teamKpi["company"] ?></td>
                    <td><?= $teamKpi["branch"] ?></td>
                    <td><?= $teamKpi["department"] ?></td>
                    <td><?= $teamKpi["teamName"] ?></td>
                    <td class="font-b"><?= number_format($teamKpi["target"], 2) ?></td>
                    <td class="font-b"><?= number_format($teamKpi["newTarget"], 2) ?></td>
                    <td style="width:15%;"><?= $teamKpi["reson"] ?></td>
                    <td class="text-center">
                        <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-team/kgi-team-history/<?= ModelMaster::encodeParams(['kpiTeamId' => $teamKpi['kpiTeamId'], 'kpiTeamHistoryId' => $kgi['kpiTeamHistoryId'], 'openTab' => 1]) ?>"
                            class="btn btn-sm btn-primary font-size-10">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
                <?php
						endforeach;
					} else { ?>
                <tr>
                    <td colspan="9" class="col-12 mt-20 font-size-14 text-secondary">
                        <?= Yii::t('app', 'There are no waiting for approve KPI') ?>.</td>
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
</div>