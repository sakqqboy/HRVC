<?php

use common\models\ModelMaster;

$this->title = 'Waiting for approve KGI';
?>
<div class="col-12 mt-90">
    <div class="row">
        <div class="col-8">
            <i class="fa fa-clock-o font-size-20" aria-hidden="true"></i> <strong class="font-size-20"> Waiting for
                approve KGI</strong>
        </div>
        <div class="col-4 text-end pr-15">
            <a href="<?= Yii::$app->homeUrl ?>kpi/management/assign-kpi" class="btn btn-secondary font-size-12">
                <i class="fa fa-chevron-left mr-5" aria-hidden="true"></i>
                Back
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
                    <th>KGI Contents</th>
                    <th>Employee</th>
                    <th>Target</th>
                    <th>New Target</th>
                    <th>Reson</th>
                    <th class="text-center font-size-14">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
					if (isset($employeeKgis) && count($employeeKgis) > 0) {
						foreach ($employeeKgis as $kgiEmployeeHistoryId => $employeeKgi) :
					?>
                <tr class="font-size-12">
                    <td><?= $employeeKgi["kgiName"] ?></td>
                    <td><?= $employeeKgi["employeeName"] ?></td>
                    <td class="font-b"><?= number_format($employeeKgi["target"], 2) ?></td>
                    <td class="font-b"><?= number_format($employeeKgi["newTarget"], 2) ?></td>
                    <td style="width: 30%;"><?= $employeeKgi["reson"] ?></td>
                    <td class="text-center">
                        <a href="<?= Yii::$app->homeUrl ?>kgi/management/approve-kgi-employee/<?= ModelMaster::encodeParams(["kgiEmployeeHistoryId" => $kgiEmployeeHistoryId]) ?>"
                            class="btn btn-sm btn-primary font-size-10">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
                <?php
						endforeach;
					} else { ?>
                <tr>
                    <td colspan="6" class="col-12 mt-20 font-size-14 text-secondary"> There are no waiting for approve
                        KPI.</td>
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
                    <th> <?= Yii::t('app', 'KGI Contents') ?></th>
                    <th> <?= Yii::t('app', 'Company') ?></th>
                    <th> <?= Yii::t('app', 'Branch') ?></th>
                    <th> <?= Yii::t('app', 'Department') ?></th>
                    <th> <?= Yii::t('app', 'Team') ?></th>
                    <th> <?= Yii::t('app', 'Target') ?></th>
                    <th> <?= Yii::t('app', 'New Target') ?></th>
                    <th> <?= Yii::t('app', 'Reson') ?>
                    <th>
                    <th class="text-center font-size-14">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
					if (isset($teamKgis) && count($teamKgis) > 0) {
						foreach ($teamKgis as $kgiTeamHistoryId => $teamKgi) :
					?>
                <tr class="font-size-12">
                    <td><?= $teamKgi["kgiName"] ?></td>
                    <td><?= $teamKgi["company"] ?></td>
                    <td><?= $teamKgi["branch"] ?></td>
                    <td><?= $teamKgi["department"] ?></td>
                    <td><?= $teamKgi["teamName"] ?></td>
                    <td class="font-b"><?= number_format($teamKgi["target"], 2) ?></td>
                    <td class="font-b"><?= number_format($teamKgi["newTarget"], 2) ?></td>
                    <td style="width:15%;"><?= $teamKgi["reson"] ?></td>
                    <td class="text-center">
                        <a href="<?= Yii::$app->homeUrl ?>kgi/management/approve-kgi-team/<?= ModelMaster::encodeParams(["kgiTeamHistoryId" => $kgiTeamHistoryId]) ?>"
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