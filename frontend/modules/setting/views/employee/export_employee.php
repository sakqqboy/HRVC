<style type="text/css" media="all">
	<?php

	use common\helpers\Path;
	use common\models\ModelMaster;
	use frontend\models\hrvc\Employee;

	include_once 'css/pdf/bootstrap.min.css';
	//include_once 'css/pdf/bootstrap-grid.css';
	//include_once 'css/pdf/bootstrap.css';
	include_once 'css/pdf/bootstrap-grid.min.css';
	include_once 'css/pdf/pdf.css';
	include_once 'css/pdf/layout.css';
	include_once 'css/pdf/font.css';
	?>
</style>
<div class="col-12 container pt-40 pl-40">
	<table class="table-pdf" style="margin-top: -20px;">
		<tr>
			<td class="pt-13" rowspan="5" style="width:160px;vertical-align:top;">
				<?php

				if ($employee['picture'] == "") {
					if ($employee['gender'] == 1) {
						$picture = 'image/user.png';
					} else {
						$picture = 'image/lady.jpg';
					}
				} else {
					$picture = $employee['picture'];
				}
				?>
				<img src="<?= Path::frontendUrl() . $picture ?>" alt="Logo" class="image-picture" />
			</td>
			<td class="" colspan="2">
				<span class="name-header mr-50" style="margin-top: -20px;">
					<?= $employee["employeeFirstname"] ?>
				</span>
				<span class="name-header mr-50">
					<?= $employee["employeeSurename"] ?>
				</span>
			</td>
		</tr>
		<tr>
			<td style="width:170px;" class="font-size-16">Employee Number</td>
			<td style="width:400px;" class="font-size-14"><?= $employee["employeeNumber"] ?></td>
		</tr>
		<tr>
			<td class="font-size-16">Date of birth</td>
			<td class="font-size-14"><?= ModelMaster::engDate($employee["birthDate"], 2) ?></td>
		</tr>
		<tr>
			<td class="font-size-16">Age</td>
			<td class="font-size-14"><?= $employee["age"] ?></td>
		</tr>
		<tr>
			<td class="font-size-16">Gender</td>
			<td class="font-size-14">
				<?= $employee['gender'] == 1 ? 'Male' : 'Female' ?>
			</td>
		</tr>
	</table>
	<hr style="margin-top:10px;">
	<table>
		<tr>
			<td colspan="2" class="font-size-18" style="font-weight:500;"><u>Contact Information</u></td>
		</tr>
		<tr>
			<td style="width:260px;" class="font-size-16">Email</td>
			<td style="width:400px;" class="font-size-14"><?= $employee["email"] ?></td>
		</tr>
		<tr>
			<td class="font-size-16">Contact number</td>
			<td class="font-size-14"><?= $employee["telephoneNumber"] ?></td>
		</tr>
		<tr>
			<td class="font-size-16">Emergency Contact Number</td>
			<td class="font-size-14"><?= $employee["emergencyTel"] ?></td>
		</tr>
	</table>
	<hr style="margin-top: 10px;">
	<table>
		<tr>
			<th colspan="2" class="font-size-18" style="font-weight:500;"><u>Work Information</u></th>
		</tr>
		<tr>
			<td style="width:150px;" class="font-size-16">Company</td>
			<td style="width:300px;" class="font-size-14"><?= $employee["companyName"] ?></td>

		</tr>
		<tr>
			<td style="width:150px;" class="font-size-16">Branch</td>
			<td style="width:300px;" class="font-size-14"><?= $employee["branchName"] ?></td>
		</tr>
		<tr>
			<td class="font-size-16">Department</td>
			<td class="font-size-14"><?= $employee["departmentName"] ?></td>
		</tr>
		<tr>
			<td class="font-size-16">Team</td>
			<td class="font-size-14"><?= $employee["teamName"] ?></td>
		</tr>
		<tr>
			<td style="width:150px;" class="font-size-16">Title</td>
			<td style="width:300px;" class="font-size-14"><?= $employee["titleName"] ?></td>
		</tr>
		<tr>
			<td class="font-size-16">Condition</td>
			<td class="font-size-14"><?= $employee["conditionName"] ?></td>
		</tr>
		<tr>
			<td style="width:150px;" class="font-size-16">Join Date</td>
			<td style="width:300px;" class="font-size-14"><?= ModelMaster::dateNumberDash($employee["joinDate"]) ?></td>
		</tr>
		<tr>
			<td class="font-size-16">Service Years</td>
			<td class="font-size-14"><?= Employee::calculateDate($employee['joinDate']) ?></td>
		</tr>
		<tr>
			<td style="width:150px;" class="font-size-16">Status</td>
			<?php
			if ($employee["status"]["name"] == "Active") {
				$class = "text-success";
			} else {
				$class = "text-danger";
			}
			?>
			<td style="width:300px;" class="font-size-14 <?= $class ?>"><?= $employee["status"]["name"] ?></td>
		</tr>
	</table>
</div>