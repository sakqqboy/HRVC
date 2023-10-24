<?php

use frontend\models\hrvc\Team;
?>
<div class="card" style="border: none;">
	<div class="card-body">
		<div class="row">
			<div class="col-8 font-size-14 font-b ">
				<?= $team['teamName'] ?>
				<span class="font-size-14 text-success">
					<i class="fa fa-check" aria-hidden="true"></i>
				</span>
				<span class="font-size-12 text-primary">
					updated
				</span>
			</div>
			<div class="col-4  pl-0 pr-0 text-end">
				<a href="javascript:updateTeam(<?= $teamId + 543 ?>)" class="btn btn-outline-dark mr-5 font-size-10">
					<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
				</a>
				<a href="javascript:deleteTeam(<?= $teamId + 543 ?>)" class="btn btn-outline-danger font-size-10">
					<i class="fa fa-trash" aria-hidden="true"></i>
				</a>
			</div>
		</div>
		<div class="col-12 mt-5 font-size-12">
			<?= $team["companyName"] ?>
		</div>
		<div class="col-12 mt-5 bangladresh-hrvc2">
			Branch: <img src="<?= Yii::$app->homeUrl ?><?= $team['flag'] ?>" class="bangladresh-hrvc1 mr-5"> <?= $team["branchName"] ?>, <?= $team["countryName"] ?>
		</div>
		<div class="col-12 mt-5 font-size-12">
			Department: <?= $team["departmentName"] ?>
		</div>
		<div class="row mt-20">

			<div class="col-3 show-height text-center">
				<i class="fa fa-users share-big mt-40" aria-hidden="true"></i>
			</div>
			<div class="col-9 ">
				<div class="col-12 font-size-12 font-b"> LEADER</div>
				<div class="font-size-11 mt-5 pl-15"> Employee Name</div>
				<div class="font-size-12 mt-10 font-b"> SUB LEADER</div>
				<div class="font-size-11 mt-5 pl-15">Leighton Kramer > Staff</div>
				<div class="row mt-10">
					<div class="col-8 text-start font-size-12 font-b">
						Employees
					</div>
					<div class="col-4 text-end font-size-12 font-b">
						<a href="" class="no-underline-black">
							<?= Team::employeeInTeam($team['teamId']) ?>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>