<?php
if (isset($kgiEmloyee) && count($kgiEmloyee) > 0) { ?>
	<div class="col-12">
		<div class="row mt-20">
			<?php
			foreach ($kgiEmloyee as $employeeId => $employee) :
			?>
				<div class="col-lg-3 col-md-6 col-12" onclick="javascription:openEmployeeView(<?= $employeeId ?>,<?= $kgiId ?>)" style="cursor: pointer;">
					<div class="col-12">
						<img src="<?= Yii::$app->homeUrl . $employee['image'] ?>" class="image-AssignMembers">
					</div>
					<div class="col-12">
						<strong class="font-size-10"> <?= $employee["firstname"] ?> <?= $employee["surename"] ?></strong>
						<div class="font-size-10"><?= $employee["title"] ?></div>
					</div>
				</div>
			<?php
			endforeach;
			?>
		</div>
	</div>
<?php
}
?>