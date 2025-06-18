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
		<?= $this->render('header', [
			"totalEmployee" => $totalEmployee,
			"actualShow" => count($employees)
		]) ?>
	</div>
	<input type="hidden" id="action" value="0">
	<input type="hidden" id="page-type" value="list">
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
			<div class="row d-flex">
				<table class="employee-table">

					<tr class="employee-header-table">
						<th class="boder-table-radius-left"><span class="ms-2"><?= Yii::t('app', "Employee's Name") ?></span></th>
						<th><?= Yii::t('app', "Designature") ?></th>
						<th><?= Yii::t('app', "Company") ?></th>
						<th><?= Yii::t('app', "Branch") ?></th>
						<th><?= Yii::t('app', "Department") ?></th>
						<th><?= Yii::t('app', "Team") ?></th>
						<th class="boder-table-radius-right"></th>
					</tr>


					<?php
					if (isset($employees) && count($employees) > 0) {
						foreach ($employees as $employeeId => $employee) : ?>
							<tr class="tr-space"></tr>
							<tr class="employee-tr">
								<td style="font-weight: 600;position: relative; width:20%;">
									<div class="col-12 border-left-radius-table" style="height:48px;">
										<input type="checkbox" id="check-employee-list-<?= $employeeId ?>" value="" name="<?= $employeeId ?>" class="checkbox-employee me-2 d-none" style="margin-top: -2px;">
										<img src="<?= Yii::$app->homeUrl . $employee['picture'] ?>" class="img-table me-2">
										<?= $employee["employeeName"] ?>
									</div>
								</td>
								<td style="width: 10%;"><?= $employee["titleName"] ?></td>
								<td style="width: 20%;"><?= $employee["companyName"] ?></td>
								<td style="width: 15%;"><?= $employee["branchName"] ?></td>
								<td style="width: 15%;"><?= $employee["departmentName"] ?></td>
								<td style="width: 15%;"><?= $employee["teamName"] ?></td>
								<td style="font-weight: 600;position: relative;width: 5%;">
									<div class="col-12 border-right-radius-table" style="height:48px;">
										<a href="<?= Yii::$app->homeUrl ?>setting/employee/employee-profile/<?= ModelMaster::encodeParams(['employeeId' => $employeeId]) ?>" style="text-decoration: none;">
											<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" class="pim-icon">
										</a>
										<a href="javascript:deleteEmployee(<?= $employeeId ?>)" style="text-decoration: none;">
											<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/threedot.svg" class="pim-icon">
										</a>
									</div>
								</td>
							</tr>

						<?php
						endforeach;
					} else { ?>
						<div class="col-12 text-center font-b font-size-16"> Employee not found.</div>
					<?php
					}
					?>
				</table>
			</div>
			<input type="hidden" id="show-action" value="">
		</div>
	</div>
</div>
<?= $this->render('modal_warning_delete') ?>
<?= $this->render('modal_deleting') ?>
<style>
	.border-left-radius-table {
		border-left: 1px solid var(--Color-Tokens-Border-Primary, #E4E4E4);
		border-bottom-left-radius: 6px;
		border-top-left-radius: 6px;
		z-index: 10;
		padding-left: 8px;
		margin-left: -4px;
		position: absolute;
		top: -1px;
		display: flex;
		align-items: center;
	}

	.border-right-radius-table {
		border-right: 1px solid var(--Color-Tokens-Border-Primary, #E4E4E4);
		border-bottom-right-radius: 6px;
		border-top-right-radius: 6px;
		z-index: 10;
		margin-right: -8px;
		position: absolute;
		top: -1px;
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.employee-table {
		font-size: 14px;
		font-weight: 400;
	}

	.employee-table td {
		padding-top: 0px;
		padding-bottom: 0px;
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

	.employee-tr {
		height: 47px;
		background-color: #FFFFFF;
		border-top: 0.5px solid var(--Color-Tokens-Border-Primary, #E4E4E4);
		border-bottom: 0.5px solid var(--Color-Tokens-Border-Primary, #E4E4E4);
		padding-top: 0px;
		padding-bottom: 0px;
	}

	.tr-space {
		height: 12px;
	}

	.img-table {
		width: 26px;
		height: 26px;
		border-radius: 100%;

	}


	.boder-table-radius-left {
		border: 0.86px;
		border-bottom-left-radius: 4px;
		border-top-left-radius: 4px;
	}

	.boder-table-radius-right {
		border: 0.86px;
		border-bottom-right-radius: 4px;
		border-top-right-radius: 4px;
	}

	.employee-list-body {
		font-size: 14px;
		font-weight: 400;
	}

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
		cursor: pointer;
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

	.action-menu {
		font-size: 13px;
		font-weight: 600;
		background-color: white;
		min-width: 149px;
		padding-left: 15px;
		padding-top: 28px;
		padding-bottom: 8px;
		border-radius: 5px;
		margin-top: 10px;
		box-shadow: 0px 1px 3px 0px #1018281A;
		position: absolute;
		/* margin-left: 40.2%; */

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
			$("[id^=check-employee-]").removeClass("invisible");
			$("[id^=check-employee-list-]").removeClass("d-none");
		} else {
			$("#action").val(0);
			$("#normal-action").removeClass("d-none");
			$("#active-action").addClass("d-none");
			$("[id^=check-employee-]").addClass("invisible");
			$("[id^=check-employee-list-]").addClass("d-none");
		}
	}
		function showActionMenu() {
		var actionMenu = $("#action-menu").val();
		if (actionMenu == 0) {
			$("#action-menu").removeClass("d-none");
			$("#action-menu").val(1);

		} else {
			$("#action-menu").addClass("d-none");
			$("#action-menu").val(0);
		}
	}
	function warningDeleteMultiEmployee() {
		var i = 0;
		var pageType = $("#page-type").val();
		var selectedEmployees;
		if (pageType == "list") {
			selectedEmployees = $("[id^=check-employee-list-]:checked").map(function() {
				return $(this).val();
			}).get();
		} else {
			selectedEmployees = $("[id^=check-employee-]:checked").map(function() {
				return $(this).val();
			}).get();
		}
		if (selectedEmployees.length == 0) {
			return false;
		} else {
			$("#totalSelectEmployee").html(selectedEmployees.length);
			$("#warning-delete-employee").modal("show");
		}


	}
	function deleteMultiEmployee() {
		var pageType = $("#page-type").val();
		var selectedEmployees;
		if (pageType == "list") {
			selectedEmployees = $("[id^=check-employee-list-]:checked").map(function() {
				return $(this).val();
			}).get();
		} else {
			selectedEmployees = $("[id^=check-employee-list-]:checked").map(function() {
				return $(this).val();
			}).get();
		}
			$("#deleting").modal("show");
		var url = "http://localhost/HRVC/frontend/web/setting/employee/multi-delete-employee";
		$.ajax({
			type: "POST",
			dataType: "json",
			url: url,
			data: {
				selectedEmployees: selectedEmployees
			},
			success: function(data) {
				if (data.status) {
					location.reload();
				}
			}
		});
	}
	
		
		
', View::POS_END);
?>