<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Status;
use yii\web\View;

$this->title = 'Employee';
?>
<?php
$statusTexArr = Status::allStatusText();
?>
<div class="col-12 mt-70 pt-20">
	<div class="col-12 pr-15 pl-15">
		<div class="col-12">
			<div class="row mb-20">
				<div class="col-lg-6 col-12 text-start employee-profiles-header  pb-0">
					<div class="d-flex align-items-center justify-content-start gap-2">
						<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/all-employees.svg" class="mr-6" style="margin-top: -5px;">
						<?= Yii::t('app', 'All Employees') ?>
						<a href="<?= Yii::$app->homeUrl ?>setting/employee/create" class="d-flex align-items-center create-employee-btn justify-content-center">
							Create New
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-circle.svg" class="ms-1" style="width: 18px;height:18px;">
						</a>
						<a href="<?= Yii::$app->homeUrl ?>setting/employee/import" class="d-flex align-items-center export-employee-btn justify-content-center">
							Import Employees
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/export-employee.svg" class="ms-2" style="width: 18px;height:18px;">
						</a>
					</div>
				</div>
				<div class="col-lg-6 col-12 pb-0 pl-0">
					<div class="d-flex align-items-center justify-content-end gap-2">
						<a href="" class="d-flex align-items-center action-employee-btn justify-content-center">
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/draft.svg" class="me-2" style="width: 18px;height:18px;">
							Drafts

						</a>
						<a href="#" onclick="javascript:showAction()" class="d-flex align-items-center action-employee-btn justify-content-center me-0 d-none"
							id="close-action" style="z-index: 1; position:relative;">
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/close-circle.svg" class="me-4" style="width: 18px;height:18px;">

						</a>
						<a href="#" onclick="javascript:showAction()" class="d-flex align-items-center action-employee-btn-blue justify-content-center d-none"
							id="active-action" style="z-index: 2;margin-left:-37px;">
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/action-select.svg" class="me-2" style="width: 18px;height:18px;">
							Actions
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/down.svg" class="ms-2" style="width: 18px;height:18px;">

						</a>

						<a href="#" onclick="javascript:showAction()" class="d-flex align-items-center action-employee-btn justify-content-center" id="normal-action">
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/action.svg" class="me-2" style="width: 18px;height:18px;">
							Actions

						</a>

						<a href="" class="d-flex align-items-center action-employee-btn justify-content-center">
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/action.svg" class="me-2" style="width: 18px;height:18px;">
							Export All


						</a>

						<a href="" class="d-flex align-items-center view-employee-gray justify-content-center">
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" class="me-2" style="width: 18px;height:18px;">
							<span class="font-size-16 font-weight-600" style="color:#30313D;">40 /</span>
							<span class="font-size-16 font-weight-600" style="color:#8A8A8A;">123</span>

						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" id="action" value="0">
	<div class="col-12 mt-20 pr-15 pl-15">
		<div class="bg-white-employee">
			<div class="row mb-40">
				<div class="col-lg-5 col-12 text-start employee-profiles  pb-0">
					<div class="d-flex justify-content-start align-items-center  gap-2">
						<?= Yii::t('app', 'Employee Profiles') ?>
					</div>
				</div>
				<div class="col-lg-7 col-12 text-end pb-0 pl-0">
					<?= $this->render('filter', [
						"companies" => $companies,
						"statusTexArr" => $statusTexArr,
						"companies" => isset($companies) ? $companies : [],
						"companyId" =>  isset($companyId) ? $companyId : '',
						"branchId" =>  isset($branchId) ? $branchId : '',
						"teamId" =>  isset($teamId) ? $teamId : '',
						"departmentId" =>  isset($departmentId) ? $departmentId : '',
						"status" =>  isset($status) ? $status : '',
						"branches" =>  isset($branches) ? $branches : [],
						"departments" =>  isset($departments) ? $departments : [],
						"teams" =>  isset($teams) ? $teams : [],
						"teamId" => isset($teamId) ? $teamId : '',
						"page" => 'list'
					]) ?>
				</div>
			</div>
			<div class="row" style="--bs-gutter-x:19px;">
				<table class="">
					<thead class="employee-header-table">
						<th class="boder-table-radius-left"><span class="ms-2"><?= Yii::t('app', "Employee's Name") ?></span></th>
						<th><?= Yii::t('app', "Designature") ?></th>
						<th><?= Yii::t('app', "Company") ?></th>
						<th><?= Yii::t('app', "Branch") ?></th>
						<th><?= Yii::t('app', "Department") ?></th>
						<th><?= Yii::t('app', "Team") ?></th>
						<th class="boder-table-radius-right"></th>
					</thead>
					<tbody>
						<?php
						if (isset($employees) && count($employees) > 0) {
							foreach ($employees as $employeeId => $employee) : ?>
								<tr>
									<td><?= $employee["employeeName"] ?></td>
									<td><?= $employee["titleName"] ?></td>
									<td><?= $employee["companyName"] ?></td>
									<td><?= $employee["branchName"] ?></td>
									<td><?= $employee["departmentName"] ?></td>
									<td><?= $employee["teamName"] ?></td>
									<td></td>
								</tr>

							<?php
							endforeach;
						} else { ?>
							<div class="col-12 text-center font-b font-size-16"> Employee not found.</div>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
			<input type="hidden" id="show-action" value="">
		</div>
	</div>
</div>
<style>
	.profile-img {
		width: 73px;
		height: 73px;
		object-fit: cover;
	}

	.company-img {
		width: 30px;
		height: 30px;
		object-fit: cover;
	}


	.bg-white-employee {
		background-color: white;
		border-radius: 10px;
		border: 1px solid #BBCDDE;
		height: 100%;
		padding: 27px 20px 32px 20px;
	}

	.employee-box {
		box-sizing: border-box;
		background-color: #FBFCFF;
		border-radius: 5px;
		padding: 0px 10px 10px 10px;
		border: 1px solid #BBCDDE;
	}

	.profile-employee-name {
		font-size: 16px;
		font-weight: 600;
		color: #30313D;
		max-width: 200px;
		padding-right: 1.5rem;
	}

	.profile-employee-email {
		font-size: 14px;
		font-weight: 400;
		color: #30313D;
		padding-right: 1.5rem;
		max-width: 250px;
	}

	.profile-employee-tel {
		font-size: 14px;
		font-weight: 400;
		color: #30313D;
		padding-right: 1.5rem;
	}

	.profile-employee-number {
		font-size: 14px;
		font-weight: 400;
		color: #666666;
	}

	.profile-employee-title {
		font-size: 14px;
		font-weight: 500;
		color: #30313D;
		display: block;
	}

	.profile-company-name {
		font-size: 14px;
		font-weight: 600;
		/* display: block; */
		padding-right: 1.5rem;
		max-width: 253px;
	}

	.profile-city-name {
		font-size: 13px;
		font-weight: 400;
		color: #666666;
		display: block;
	}

	.profile-employee-department {
		font-size: 13px;
		font-weight: 400;
		color: #30313D;
		display: block;

	}

	.profile-employee-team {
		font-size: 13px;
		font-weight: 400;
		color: #666666;
		display: block;
	}

	.profile-icon {
		width: 14px;
		height: 14px;
		margin-right: 5px;
	}

	.status-badge-full-time {
		position: absolute;
		bottom: 3px;
		left: 0;
		width: 100%;
		height: 20px;
		transform: translateY(50%);
		text-align: center;
		border-radius: 12px;
		z-index: 1;
		background-color: #2580D3;
		color: white;
		line-height: 20px;
		font-size: 12px;
		font-weight: 600;
	}

	.status-badge-probationary {
		position: absolute;
		bottom: 3px;
		left: 0;
		width: 100%;
		height: 20px;
		transform: translateY(50%);
		text-align: center;
		border-radius: 12px;
		z-index: 1;
		background-color: #20598D;
		color: white;
		line-height: 20px;
		font-size: 12px;
		font-weight: 600;
	}

	.status-badge-part-time {
		position: absolute;
		bottom: 3px;
		left: 0;
		width: 100%;
		height: 20px;
		transform: translateY(50%);
		text-align: center;
		border-radius: 12px;
		z-index: 1;
		background-color: #20598D;
		color: white;
		line-height: 20px;
		font-size: 12px;
		font-weight: 600;
	}

	.status-badge-intern {
		position: absolute;
		bottom: 3px;
		left: 0;
		width: 100%;
		height: 20px;
		transform: translateY(50%);
		text-align: center;
		border-radius: 12px;
		z-index: 1;
		background-color: #FFE100;
		color: black;
		line-height: 20px;
		font-size: 12px;
		font-weight: 600;
	}

	.status-badge-temporary {
		position: absolute;
		bottom: 3px;
		left: 0;
		width: 100%;
		height: 20px;
		transform: translateY(50%);
		text-align: center;
		border-radius: 12px;
		z-index: 1;
		background-color: #FF9D00;
		color: black;
		line-height: 20px;
		font-size: 12px;
		font-weight: 600;
	}

	.status-badge-freelance {
		position: absolute;
		bottom: 3px;
		left: 0;
		width: 100%;
		height: 20px;
		transform: translateY(50%);
		text-align: center;
		border-radius: 12px;
		z-index: 1;
		background-color: #FF9D00;
		color: black;
		line-height: 20px;
		font-size: 12px;
		font-weight: 600;
	}

	.status-badge-suspened {
		position: absolute;
		bottom: 3px;
		left: 0;
		width: 100%;
		height: 20px;
		transform: translateY(50%);
		text-align: center;
		border-radius: 12px;
		z-index: 1;
		background-color: #E05757;
		color: white;
		line-height: 20px;
		font-size: 12px;
		font-weight: 600;
	}

	.status-badge-resigned {
		position: absolute;
		bottom: 3px;
		left: 0;
		width: 100%;
		height: 20px;
		transform: translateY(50%);
		text-align: center;
		border-radius: 12px;
		z-index: 1;
		background-color: #EC1D42;
		color: white;
		line-height: 20px;
		font-size: 12px;
		font-weight: 600;
	}

	.status-badge-layoff {
		position: absolute;
		bottom: 3px;
		left: 0;
		width: 100%;
		height: 20px;
		transform: translateY(50%);
		text-align: center;
		border-radius: 12px;
		z-index: 1;
		background-color: #FF9D00;
		color: white;
		line-height: 20px;
		font-size: 12px;
		font-weight: 600;
	}

	.status-badge-notset {
		position: absolute;
		bottom: 3px;
		left: 0;
		width: 100%;
		height: 20px;
		transform: translateY(50%);
		text-align: center;
		border-radius: 12px;
		z-index: 1;
		background-color: #C3C3C3;
		border: 1px black solid;
		color: black;
		line-height: 20px;
		font-size: 12px;
		font-weight: 600;
	}

	.employee-contact-box {
		background-color: #FFFFFF;
		border-radius: 5px;
		padding: 20px 16px 20px 16px;
		border: #BBCDDE solid thin;
		font-size: 14px;
		font-weight: 400;
		margin-top: 20px;
	}

	.new-employee {
		/* margin-top: -15px; */
		padding-right: 10px;
		padding-left: 0px;
	}

	.checkbox-employee {
		appearance: none;
		width: 24px;
		height: 24px;
		margin-top: 5px;
		border: 1px solid #BBCDDE;
		background-color: white;
		border-radius: 5px;
		background-repeat: no-repeat;
		background-position: center;
		background-size: 16px 16px;
		cursor: pointer;
		position: relative;
	}

	.checkbox-employee:checked {
		background-color: #2580D3;
		border: 1px solid #2580D3;
		background-image: url('<?= Yii::$app->homeUrl . "images/icons/Settings/check-white.svg" ?>');
	}

	.checked-employee {
		outline: 4px solid #81C3FF;
		border: 1px solid #81C3FF;
		box-shadow: 0 0 8px 3px rgba(0, 123, 255, 0.6);
	}

	.employee-profiles {
		font-size: 20px;
		font-weight: 600;
	}

	.employee-filter-btn {
		font-size: 13px;
		font-weight: 500;
		padding: 3px 10px 3px 10px;
		background-color: #2580D3;
		color: #FFFFFF;
		border-radius: 71px;
		height: 26px;

	}

	.employee-profiles-header {
		font-weight: 600;
		font-size: 24px;
		line-height: 21.43px;
		letter-spacing: 0%;
		vertical-align: middle;

	}

	.create-employee-btn {
		background-color: #2580D3;
		font-size: 14px;
		font-weight: 600;
		border-radius: 3px;
		color: white;
		text-decoration: none;
		height: 30px;
		text-align: center;
		min-width: 115px;
		min-height: 30px;
	}

	.export-employee-btn {
		font-size: 14px;
		font-weight: 600;
		border: 0.5px #2580D3 solid;
		border-radius: 3px;
		background-color: white;
		color: #2580D3;
		text-decoration: none;
		height: 30px;
		text-align: center;
		min-width: 157px;
		min-height: 30px;
	}

	.action-employee-btn {
		background-color: white;
		color: #2580D3;
		min-height: 30px;
		border-radius: 66px;
		padding-left: 9px;
		padding-right: 9px;
		font-size: 14px;
		font-weight: 600;
		border: 0.5px #2580D3 solid;
		text-decoration: none;

	}

	.action-employee-btn-blue {
		background-color: #2580D3;
		color: #FFFFFF;
		min-height: 30px;
		border-radius: 66px;
		padding-left: 9px;
		padding-right: 9px;
		font-size: 14px;
		font-weight: 600;
		text-decoration: none;
	}

	.view-employee-gray {
		background-color: #F8F8F8;
		min-height: 30px;
		border-radius: 66px;
		padding-left: 9px;
		padding-right: 9px;
		font-size: 14px;
		font-weight: 600;
		border: 0.5px #666666 solid;
		text-decoration: none;

	}

	.employee-header-table {
		height: 45px;
		border-radius: 4px;
		background-color: #E4E4E4;

		color: #727272;
	}

	.employee-header-table th {
		font-size: 14px;
		font-weight: 600;
	}

	.boder-table-radius-left {
		border-bottom-left-radius: 4px;
		border-top-left-radius: 4px;
	}

	.boder-table-radius-right {
		border-bottom-right-radius: 4px;
		border-top-right-radius: 4px;
	}



	@media (min-width: 768px) {
		.profile-employee-email {
			max-width: 400px;
		}

		.profile-employee-name {
			max-width: 400px;
		}

		.profile-company-name {
			max-width: 400px;
		}
	}

	@media (min-width: 1200px) {
		.profile-employee-email {
			max-width: 250px;
		}

		.profile-employee-name {
			max-width: 200px;
		}

		.profile-company-name {
			max-width: 253px;
		}
	}

	@media (min-width: 1900px) {
		.profile-employee-email {
			max-width: 500px;
		}

		.profile-employee-name {
			max-width: 500px;
		}

		.profile-company-name {
			max-width: 500px;
		}
	}
</style>
<script>
	function selectEmployee(employeeId) {
		if ($("#check-employee-" + employeeId).prop('checked') == true) {
			$("#employee-" + employeeId).addClass('checked-employee');
		} else {
			$("#employee-" + employeeId).removeClass('checked-employee');
		}
	}

	function showAction() {
		var action = $("#action").val();
		if (action == 0) {
			$("#action").val(1);
			$("#normal-action").addClass("d-none");
			$("#active-action").removeClass("d-none");
			$("#close-action").removeClass("d-none");
		} else {
			$("#action").val(0);
			$("#normal-action").removeClass("d-none");
			$("#active-action").addClass("d-none");
			$("#close-action").addClass("d-none");

		}
	}
</script>
<?php
$this->registerJs('
   function showAction() {
		var action = $("#action").val();
		if (action == 0) {
			$("#action").val(1);
			$("#normal-action").addClass("d-none");
			$("#active-action").removeClass("d-none");
			$("#close-action").removeClass("d-none");
			$("[id^=check-employee-]").removeClass("invisible");
		} else {
			$("#action").val(0);
			$("#normal-action").removeClass("d-none");
			$("#active-action").addClass("d-none");
			$("#close-action").addClass("d-none");
			$("[id^=check-employee-]").addClass("invisible");
		}
	}
', View::POS_END);
?>