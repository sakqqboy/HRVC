<?php

use common\models\ModelMaster;
use frontend\models\hrvc\User;

if (isset($kpiEmployeeHistory) && count($kpiEmployeeHistory) > 0) { ?>
	<div class="row border-bottom pb-10 mb-10 font-size-13 font-b">
		<div class="col-2"><?= Yii::t('app', 'Target') ?></div>
		<div class="col-2"><?= Yii::t('app', 'Result') ?></div>
		<div class="col-2"><?= Yii::t('app', 'Detail') ?></div>
		<div class="col-2"><?= Yii::t('app', 'Dat') ?>e</div>
		<div class="col-2"><?= Yii::t('app', 'Next update') ?></div>
		<div class="col-2"><?= Yii::t('app', 'By') ?></div>

	</div>
	<?php

	foreach ($kpiEmployeeHistory as $history) :
		$updater = User::employeeNameByuserId($history["createrId"]);
	?>
		<div class="row font-size-12">
			<div class="col-2"><?= $history["target"] == null ? Yii::t('app', 'not set') : number_format($history["target"]) ?></div>
			<div class="col-2"><?= $history["result"] == null ? Yii::t('app', 'not set') : number_format($history["result"]) ?></div>
			<div class="col-2"><?= isset($history["detail"]) ? $history["detail"] : '' ?></div>
			<div class="col-2"><?= ModelMaster::engDate($history["createDateTime"], 2) ?></div>
			<div class="col-2"><?= isset($history["nextCheckDate"]) ? ModelMaster::engDate($history["nextCheckDate"], 2) : '' ?></div>
			<div class="col-2"><?= $updater ?></div>
		</div>

	<?php
	endforeach;
	?>
<?php
} else {
?>
	<div class="col-12 mt-20 font-size-16 text-center"><?= Yii::t('app', 'Not update yet') ?>.</div>
<?php
}
