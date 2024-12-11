<?php

use frontend\models\hrvc\KfiEmployee;
?>
<div class="col-12 text-end font-size-16 pr-5" style="margin-bottom: -20px;margin-top:-10px;">
	<i class="fa fa-times" style="cursor: pointer;margin-top:-10px;" onclick="javascript:closeSearchBox()"></i>
	</i>
</div>
<div class="row mb-10 font-size-12 mt-10">
	<div class="col-5 font-b text-center"><?= Yii::t('app', 'Employee') ?></div>
	<div class="col-3 font-b"><?= Yii::t('app', 'Branch') ?></div>
	<div class="col-2 font-b"><?= Yii::t('app', 'Title') ?></div>
	<div class="col-2 font-b"><?= Yii::t('app', 'Team') ?></div>
</div>
<?php
if (isset($employees) && count($employees) > 0) {
	foreach ($employees as $em) :

		$isCheck = "";
		$kfiEmployee = KfiEmployee::isHasEmployee($em['id'], $kfiId);
		if ($kfiEmployee == 1) {
			$isCheck = "checked";
		}
?>
		<div class="row border-bottom mt-10">
			<div class="col-5">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" onchange="javascript:kfiEmployee(<?= $em['id'] ?>,<?= $kfiId ?>)" id="kfi-employee-<?= $em['id'] ?>-<?= $kfiId ?>" <?= $isCheck ?>>
					<label class="form-check-label" for="flexCheckDefault">
						&nbsp;&nbsp; <img src="<?= Yii::$app->homeUrl . $em['picture'] ?>" class="company-image3">
						<span class="font-size-12"><?= $em['name'] ?> </span>
					</label>
				</div>
			</div>
			<div class="col-3 font-size-10">
				<?= $em["branch"] ?>
			</div>
			<div class="col-2 font-size-10">
				<?= Yii::t('app', '$em["title"]') ?>
			</div>
			<div class="col-2 font-size-10 pb-10">
				<?= $em["team"] ?>
			</div>
		</div>
<?php
	endforeach;
}
