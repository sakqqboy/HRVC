<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\GroupHasKgi;

$this->title = "KPI GROUP";
?>
<div class="col-12 mt-90 pd-Performance">
	<div class="row">
		<div class="col-10">
			<i class="fa fa-users font-size-20 mr-10" aria-hidden="true"></i>
			<strong class="font-size-20"> KPI GROUP</strong>
		</div>
		<div class="col-2 text-end">
			<a href="<?= Yii::$app->homeUrl ?>kpi/kpi-group/create" class="btn btn-primary font-size-12">
				<i class="fa fa-plus-square mr-5" aria-hidden="true"></i>
				Create KPI Group
			</a>
		</div>
	</div>
	<div class="col-12">
		<table class="table table-striped">
			<thead class="table-secondary">
				<tr class="font-size-12">
					<th><?= Yii::t('app', 'No') ?>.</th>
					<th><?= Yii::t('app', 'Group Name') ?></th>
					<th><?= Yii::t('app', 'Company') ?></th>
					<th><?= Yii::t('app', 'Detail') ?></th>
					<th class="text-center"><?= Yii::t('app', 'Target') ?></th>
					<th><?= Yii::t('app', 'Month') ?></th>
					<th class="text-center"><?= Yii::t('app', 'Total KG') ?>I</th>
					<th><?= Yii::t('app', 'Status') ?></th>
					<th><?= Yii::t('app', 'Action') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php
				if (isset($kpiGroups) && count($kpiGroups) > 0) {
					$i = 1;
					foreach ($kgiGroups as $kgiGroup) :
				?>
						<tr class="border-bottom-white2" id="kgiGroup-<?= $kgiGroup['kgiGroupId'] ?>">
							<td><?= $i ?></td>
							<td><?= $kgiGroup["kgiGroupName"] ?></td>
							<td><?= Company::companyName($kgiGroup['companyId']) ?></td>
							<td><?= $kgiGroup["kgiGroupDetail"] ?></td>
							<td class="text-center font-b"><?= number_format($kgiGroup["target"]) ?></td>
							<td><?= ModelMaster::fullMonthText($kgiGroup["month"]) ?></td>
							<td class="text-center font-b"><?= GroupHasKgi::totalKgi($kgiGroup['kgiGroupId']) ?></td>
							<td><?= $kgiGroup["status"] == 1 ? 'Active' : 'Finished' ?></td>
							<td>
								<a href="<?= Yii::$app->homeUrl ?>kgi/kgi-group/update/<?= ModelMaster::encodeParams(['kgiGroupId' => $kgiGroup['kgiGroupId']]) ?>" class="btn btn-warning font-size-12 mr-5">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</a>
								<a href="javascript:deleteKgiGroup(<?= $kgiGroup['kgiGroupId'] ?>)" class="btn btn-danger font-size-12">
									<i class="fa fa-trash-o" aria-hidden="true"></i>
								</a>
							</td>
						</tr>
					<?php
						$i++;
					endforeach;
				} else { ?>
					<tr>
						<td colspan="9" class="text-center font-b font-size-12"><?= Yii::t('app', 'KGI Group not found') ?>.</td>
					</tr>
				<?php

				}
				?>
			</tbody>

		</table>
	</div>
</div>