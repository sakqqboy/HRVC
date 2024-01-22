<?php

use frontend\models\hrvc\Department;

if (isset($kpiEmloyee) && count($kpiEmloyee) > 0) { ?>
	<div class="row mt-20">
		<?php
		foreach ($kpiEmloyee as $employeeId => $employee) :
		?>

			<div class="col-lg-3 col-md-6 col-12" onclick="javascription:openKpiEmployeeView(<?= $employeeId ?>,<?= $kpiId ?>)" style="cursor: pointer;">
				<div class="col-12">
					<img src="<?= Yii::$app->homeUrl ?><?= $employee["image"] ?>" class="image-AssignMembers">
				</div>
				<div class="col-12">
					<strong class="font-size-10"> <?= $employee["firstname"] ?> <?= $employee["surename"] ?></strong>
					<div class="font-size-10"><?= 'Position Name' ?></div>
				</div>
			</div>


		<?php
		endforeach; ?>
	</div>
<?php
}
?>