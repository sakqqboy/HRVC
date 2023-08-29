<?php

use common\models\ModelMaster;
?>
<div class="col-12 mt-40 font-size-17 pl-10">
	<i class="fa fa-briefcase  mr-10" aria-hidden="true"></i> Work information
</div>
<hr>
<div class="row pl-20 font-size-14">
	<div class="col-lg-6 col-md-5 col-12">
		<div class="row">
			<div class="col-5 mt-10">
				Company
			</div>
			<div class="col-7 font-b  mt-10">
				<?= $employee["companyName"] ?>
			</div>
			<div class="col-5  mt-20">
				Branch
			</div>
			<div class="col-7  font-b  mt-20">
				<?= $employee["branchName"] ?>, <?= $employee["countryName"] ?>
			</div>
			<div class="col-5  mt-20">
				Department
			</div>
			<div class="col-7  font-b  mt-20">
				<?= $employee["departmentName"] ?>
			</div>
			<div class="col-5  mt-20">
				Title
			</div>
			<div class="col-7  font-b  mt-20">
				<?= $employee["titleName"] ?>
			</div>
			<div class="col-5  mt-20">
				Working Hours
			</div>
			<div class="col-7  font-b  mt-20">
				<?= $employee["workingTime"] ?> hrs.
			</div>
			<div class="col-5  mt-20">
				Status
			</div>
			<div class="col-7  mt-20 font-b">
				<?= $employee["status"]["name"] ?>
			</div>
			<div class="col-5  mt-20">
				Condition
			</div>
			<div class="col-7  mt-20 font-b">
				<?= $employee["conditionName"] ?>
			</div>

		</div>
	</div>

	<div class="col-lg-6 col-md-6 col-12 font-size-14">
		<div class="row">
			<div class="col-5 mt-10">
				Joining Date
			</div>
			<div class="col-7 font-b  mt-10">
				<?= ModelMaster::dateNumberDash($employee["joinDate"]) ?>
			</div>
			<div class="col-5  mt-20">
				Service Years
			</div>
			<div class="col-7 font-b  mt-20">
				10 Year 2 Months
			</div>
			<div class="col-5  mt-20">
				Employee Number
			</div>
			<div class="col-7 font-b  mt-20">
				<?= $employee["employeeNumber"] ?>
			</div>
		</div>
	</div>
</div>