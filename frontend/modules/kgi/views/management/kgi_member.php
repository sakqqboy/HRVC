<?php

use frontend\models\hrvc\Department;

if (isset($kgiEmloyee) && count($kgiEmloyee) > 0) { ?>
	<div class="row mt-20">
		<?php
		foreach ($kgiEmloyee as $employeeName => $employee) :
		?>

			<div class="col-lg-3 col-md-6 col-6 mt-5">
				<div class="col-12">
					<img src="<?= Yii::$app->homeUrl ?><?= $employee["image"] ?>" class="image-AssignMembers">
				</div>
				<div class="col-12" style="line-height: 10px;">
					<strong class="font-size-10"> <?= $employee["firstname"] ?> <?= $employee["surename"] ?></strong>
					<div class="font-size-10 mt-5"><?= $employee["title"] ?></div>
				</div>
			</div>


		<?php
		endforeach; ?>
	</div>
<?php
}
?>