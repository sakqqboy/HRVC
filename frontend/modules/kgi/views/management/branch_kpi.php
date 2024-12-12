<?php

use common\models\ModelMaster;
use frontend\models\hrvc\KfiHasKgi;
use frontend\models\hrvc\Kgi;
use frontend\models\hrvc\KgiHasKpi;
use frontend\models\hrvc\Unit;

if (isset($kpiBranch) && count($kpiBranch) > 0) { ?>
	<table class="table">
		<thead>
			<th><?= Yii::t('app', 'No') ?></th>
			<th> </th>
			<th><?= Yii::t('app', 'Kpi Name') ?></th>
			<th><?= Yii::t('app', 'Target') ?></th>
			<th><?= Yii::t('app', 'Month') ?></th>
			<th><?= Yii::t('app', 'Unit') ?></th>
		</thead>
		<tbody class="font-size-12">
			<?php

			$i = 1;
			foreach ($kpiBranch as $kpi) :
				$check = KgiHasKpi::isInthisKgi($kpi['kpiId'], $kgiId);
			?>
				<tr>
					<td><?= $i ?></td>
					<td><input type="checkbox" name="kpi" class="form-check-input" id="kpi-branch-<?= $kpi['kpiId'] ?>" value="<?= $kpi['kpiId'] ?>" <?= $check == 1 ? 'checked' : '' ?>></td>
					<td><?= $kpi["kpiName"] ?></td>
					<td><?= $kpi["code"] ?> <?= number_format($kpi["targetAmount"], 2) ?></td>
					<td><?= Yii::t('app', ModelMaster::shotMonthText($kpi["month"])) ?></td>
					<td><?= Yii::t('app', Unit::unitName($kpi["unitId"])) ?></td>
				</tr>
			<?php
				$i++;
			endforeach;
			?>
		</tbody>
	</table>
	<div class="col-12 mt-20 text-end">
		<input type="hidden" id="branchId" value="<?= $branchId ?>">
		<a class="btn btn-primary font-size-12" href="javascript:saveSelectedKpi(<?= $kgiId ?>)"><?= Yii::t('app', 'Submit') ?></a>
	</div>
<?php
}
