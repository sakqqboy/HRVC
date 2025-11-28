<style type="text/css" media="all">
	<?php

	use common\helpers\Path;
	use common\models\ModelMaster;

	include_once 'css/pdf/bootstrap.min.css';
	//include_once 'css/pdf/bootstrap-grid.css';
	//include_once 'css/pdf/bootstrap.css';
	include_once 'css/pdf/bootstrap-grid.min.css';
	include_once 'css/pdf/pdf.css';
	include_once 'css/pdf/layout.css';
	include_once 'css/pdf/font.css';
	?>
</style>
<div style="margin-top: -20px;">
	<img src="<?= Path::frontendUrl() . 'images/icons/Settings/Config/logo.svg' ?>" alt="Logo" style="width:57px;height:19px;" />
</div>
<hr style="margin-top:5px;">
<div class="personal-infomation">
	<table>
		<tr style="height: 135px;">
			<td rowspan="7">
				<?php

				if ($employee['picture'] == "") {
					$picture = 'images/employee/status/employee-nopic.svg';
				} else {
					$picture = $employee['picture'];
				}
				?>
				<img src="<?= Path::frontendUrl() . $picture ?>" alt="Logo" class="personal-image" style="margin-top:-20px;" />
			</td>

			<td colspan="4" class="name-header pl-10"><?= $employee["employeeFirstname"] ?> <?= $employee["employeeSurename"] ?></td>
		</tr>

		<tr>
			<td class="text-head pl-10">Employee ID</td>
			<td class="text-detail"><?= $employee["employeeNumber"] ?></td>
			<td class="text-head pl-10">Personal Email</td>
			<td class="text-detail"><?= $employee["email"] ?></td>
		</tr>
		<tr>
			<td class="text-head pl-10">Gender</td>
			<td class="text-detail"><?= $employee['gender'] == 1 ? 'Male' : $employee['gender'] == 2 ? 'Female' : 'Not set' ?></td>
			<td class="text-head pl-10">Contact Number</td>
			<td class="text-detail"><?= $employee["telephoneNumber"] ?></td>
		</tr>
		<tr>
			<td class="text-head pl-10">Nationality</td>
			<td class="text-detail"><?= $employee["nationalityName"] ?></td>
			<td class="text-head pl-10">Emergency Contact</td>
			<td class="text-detail"><?= $employee["emergencyTel"] ?></td>
		</tr>
		<tr>
			<td class="text-head pl-10">Date of Birth</td>
			<td class="text-detail"><?= $employee['birthDate'] != '' ? ModelMaster::engDate($employee['birthDate'], 2) : 'Not set' ?></td>
			<td class="text-head pl-10"></td>
			<td class="text-detail"></td>
		</tr>
		<tr>
			<td class="text-head pl-10">Marital Status</td>
			<td class="text-detail"><?= $employee['maritalStatus'] ?? 'Not set' ?></td>
			<td class="text-head pl-10">Present Address</td>
			<td class="text-detail"><?= $employee["address1"] ?? 'Not set' ?></td>
		</tr>


	</table>


	<hr style="margin-top:-5px;">
	<div class="col-12 pl-0 title-head">
		About Employee
	</div>
	<div class="mt-20 pl-0" style="min-height:20px;">
		<?= $employee["remark"] != '' ? $employee["remark"] : '' ?>
	</div>
	<hr style="margin-top:20px;">
	<div class="mt-10 pl-0  title-head">
		Work Details
	</div>

	<table class="mt-10">
		<tr>
			<td class="text-head2 ">Company</td>
			<td class="text-detail2"><?= $employee["companyName"] ?></td>
			<td class="text-head2 ">Joining Date</td>
			<td class="text-detail2"><?= $employee['joinDate'] != '' ? ModelMaster::engDate($employee['joinDate'], 2) : 'Not set' ?></td>
		</tr>
		<tr>
			<td class="text-head2 ">Branch</td>
			<td class="text-detail2"><?= $employee["branchName"] ?></td>
			<td class="text-head2 ">Status</td>
			<td class="text-detail2"><?= $employee['statusName'] ?></td>
		</tr>
		<tr>
			<td class="text-head2 ">Department</td>
			<td class="text-detail2"><?= $employee["departmentName"] ?></td>
			<td class="text-head2 ">Work Email</td>
			<td class="text-detail2"><?= $employee['companyEmail'] ?></td>
		</tr>

		<tr>
			<td class="text-head2 ">Team</td>
			<td class="text-detail2"><?= $employee["teamName"] ?></td>
			<td class="text-head2 ">LinkedIn</td>
			<td class="text-detail2"><?= $employee['contact'] != '' ? $employee['contact'] : 'Not Set' ?></td>
		</tr>
		<tr>
			<td class="text-head2 ">Title/ Position</td>
			<td class="text-detail2"><?= $employee["titleName"] ?></td>
			<td class="text-head2 ">Work Address</td>
			<td class="text-detail2"><?= $employee['location'] ?? 'Not set' ?></td>
		</tr>
	</table>

	<hr style="margin-top:20px;">
	<div class="mt-15 pl-0  title-head">
		Job Description

	</div>
	<div class="mt-10 pl-0 subTitle-head">
		Purpose of the Job
		<div class="mt-15 jobDescript-detail">
			<?= $employee['purpose'] != "" ? $employee['purpose'] : 'Not set' ?>
		</div>
	</div>
	<div class="pl-0 subTitle-head mt-20">
		Core Responsibility
		<div class="mt-15 jobDescript-detail">
			<?= $employee['jobDescription'] != "" ? $employee['jobDescription'] : 'Not set'   ?>
		</div>
	</div>
	<div class=" pl-0 subTitle-head mt-20">
		Key Responsibility
		<div class="mt-15 jobDescript-detail">
			<?= $employee['keyResponsibility'] != "" ? $employee['keyResponsibility'] : 'Not set'   ?>
		</div>
	</div>
	<div style="bottom: 0;position:absolute;width:100%;">
		<hr style="margin-top:20px;">
		<div class="print-detail" style="margin-top: -10px;">
			Printed on: <?= $printedDate ?>&nbsp;&nbsp;&nbsp; Printed By <?= $printName ?>
		</div>
	</div>
</div>