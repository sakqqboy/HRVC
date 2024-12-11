<?php

use common\models\ModelMaster;

if (isset($kgiTeamHistory) && count($kgiTeamHistory) > 0) { ?>
	<div class="row border-bottom pb-10 mb-10">
		<div class="col-3"><?= Yii::t('app', 'Target') ?></div>
		<div class="col-3"><?= Yii::t('app', 'Result') ?></div>
		<div class="col-3"><?= Yii::t('app', 'Updater') ?></div>
		<div class="col-3"><?= Yii::t('app', 'Date') ?></div>
	</div>
	<?php
	foreach ($kgiTeamHistory as $history) : ?>
		<div class="row">
			<div class="col-3"><?= $history["target"] ?></div>
			<div class="col-3"><?= $history["result"] ?></div>
			<div class="col-3"><?= $history["employeeFirstname"] ?> <?= $history["employeeSurename"] ?></div>
			<div class="col-3"><?= ModelMaster::engDate($history["createDateTime"], 2) ?></div>
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
