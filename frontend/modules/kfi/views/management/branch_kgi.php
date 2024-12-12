<?php

use common\models\ModelMaster;
use frontend\models\hrvc\KfiHasKgi;
use frontend\models\hrvc\Kgi;
use frontend\models\hrvc\Unit;

if (isset($kgiBranch) && count($kgiBranch) > 0) { ?>
	<table class="table">
		<thead>
			<th><?= Yii::t('app', 'No') ?></th>
			<th> </th>
			<th><?= Yii::t('app', 'Kgi Name') ?></th>
			<th><?= Yii::t('app', 'Target') ?></th>
			<th><?= Yii::t('app', 'Month') ?></th>
			<th><?= Yii::t('app', 'Unit') ?></th>
		</thead>
		<tbody class="font-size-12">
			<?php

			$i = 1;
			foreach ($kgiBranch as $kgi) :
				$check = KfiHasKgi::isInthisKfi($kgi['kgiId'], $kfiId);
			?>
				<tr>
					<td><?= $i ?></td>
					<td><input type="checkbox" name="kgi" class="form-check-input" id="kgi-branch-<?= $kgi['kgiId'] ?>" value="<?= $kgi['kgiId'] ?>" <?= $check == 1 ? 'checked' : '' ?>></td>
					<td><?= $kgi["kgiName"] ?></td>
					<td><?= $kgi["code"] ?> <?= number_format($kgi["targetAmount"], 2) ?></td>
					<td><?= ModelMaster::shotMonthText($kgi["month"]) ?></td>
					<td><?= Yii::t('app', Unit::unitName($kgi["unitId"])) ?></td>
				</tr>
			<?php
				$i++;
			endforeach;
			?>
		</tbody>
	</table>
	<div class="col-12 mt-20 text-end">
		<input type="hidden" id="branchId" value="<?= $branchId ?>">
		<a class="btn btn-primary font-size-12" href="javascript:saveSelectedKgi(<?= $kfiId ?>)"><?= Yii::t('app', 'Submit') ?></a>
	</div>
<?php
}
