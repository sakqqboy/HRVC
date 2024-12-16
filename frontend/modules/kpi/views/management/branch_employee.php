<?php

use frontend\models\hrvc\KpiEmployee;
?>
<div class="row mb-10">
	<div class="col-4 font-b"><?= Yii::t('app', 'Employee') ?></div>
	<div class="col-3 font-b"><?= Yii::t('app', 'Branch') ?></div>
	<div class="col-3 font-b"><?= Yii::t('app', 'Title') ?></div>
	<div class="col-2 font-b"><?= Yii::t('app', 'Team') ?></div>
</div>
<?php
if (count($employees) > 0) {
	$totalkpiEmployee = KpiEmployee::totalEmployee($kpiId);
	if ($totalkpiEmployee == count($employees)) {
		$checkAll = 'checked';
	} else {
		$checkAll = '';
	}
?>
	<div class="row">
		<div class="col-12 text-start">
			<input class="form-check-input" type="checkbox" onchange="javascript:checkAllKpiEmployee(<?= $kpiId ?>)" id="all-kpi-employee-<?= $kpiId ?>" <?= $checkAll ?>>
			<span class="font-size-12 ml-25"><?= Yii::t('app', 'Al') ?>l </span>
		</div>
	</div>
	<?php
	foreach ($employees as $em) :

		$isCheck = "";
		$kpiEmployee = KpiEmployee::isHasEmployee($em['id'], $kpiId);
		if ($kpiEmployee == 1) {
			$isCheck = "checked";
		}
	?>
		<div class="row">
			<div class="col-4">
				<div class=" form-check mt-10">
					<input class="form-check-input" type="checkbox" onchange="javascript:kpiEmployee(<?= $em['id'] ?>,<?= $kpiId ?>)" id="kpi-employee-<?= $em['id'] ?>-<?= $kpiId ?>" <?= $isCheck ?>>
					<label class="form-check-label" for="flexCheckDefault">
						&nbsp;&nbsp; <img src="<?= Yii::$app->homeUrl . $em['picture'] ?>" class="company-image3">
						<span class="font-size-12"><?= $em['name'] ?> </span>
					</label>
				</div>
			</div>
			<div class="col-3 mt-10 font-size-12 pt-5">
				<?= $em['branch'] ?>
			</div>
			<div class="col-3 mt-10 font-size-12 pt-5">
				<?= Yii::t('app', $em['title']) ?>
			</div>
			<div class="col-2 mt-10 font-size-12 pt-5">
				<?= $em['team'] ?>
			</div>
		</div>

<?php
	endforeach;
}
?>