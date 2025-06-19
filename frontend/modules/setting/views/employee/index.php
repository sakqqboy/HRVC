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
	<!-- <div class="row">
		<div class="col-lg-9 col-12 text-end">
			<a href="<?php // Yii::$app->homeUrl 
					?>setting/employee/import" class="btn btn-secondary font-size-12 mr-10">
				<i class="fa fa-upload mr-5" aria-hidden="true"></i> Import File
			</a>
			<a href="<?php // Yii::$app->homeUrl 
					?>setting/employee/create" class="btn btn-success font-size-12">
				<i class="fa fa-user-plus mr-5" aria-hidden="true"></i> Create
			</a>
			<div class="btn-group ml-10" role="group" aria-label="Basic example">
				<button type="button" class="btn btn-primary btn-curr font-size-12" id="btn-0" onclick="javascript:employeeType(0)">All</button>
				<button type="button" class="btn btn-primary font-size-12" id="btn-1" onclick="javascript:employeeType(1)"><i class="fa fa-briefcase" aria-hidden="true"></i> Current</button>
				<button type="button" class="btn btn-primary btn-curr font-size-12" id="btn-2" onclick="javascript:employeeType(2)">Resigned <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></button>
				<input type="hidden" id="status" value="1">
			</div>
		</div>

	</div> -->
	<div class="col-12 pr-15 pl-15">
		<?= $this->render('header', [
			"totalEmployee" => $totalEmployee,
			"actualShow" => count($employees)
		]) ?>

	</div>
	<input type="hidden" id="page-type" value="grid">
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
						"page" => 'grid'
					]) ?>
				</div>
			</div>
			<div class="row" style="--bs-gutter-x:19px;">
				<?php
				if (isset($employees) && count($employees) > 0) {
					foreach ($employees as $employeeId => $employee) :
						$statusClass = "status-badge-full-time";
						if ($employee["status"] == "Full-Time") {
							$statusClass = "status-badge-full-time";
						}
						if ($employee["status"] == "Probationary") {
							$statusClass = "status-badge-probationary";
						}
						if ($employee["status"] == "Part-Time") {
							$statusClass = "status-badge-part-Time";
						}
						if ($employee["status"] == "Intern") {
							$statusClass = "status-badge-intern";
						}
						if ($employee["status"] == "Temporary") {
							$statusClass = "status-badge-temporarye";
						}
						if ($employee["status"] == "Freelance") {
							$statusClass = "status-badge-freelance";
						}
						if ($employee["status"] == "Suspended") {
							$statusClass = "status-badge-sspended";
						}
						if ($employee["status"] == "Resigned") {
							$statusClass = "status-badge-resigned";
						}
						if ($employee["status"] == "Lay off") {
							$statusClass = "status-badge-layoff";
						}
						if ($employee["status"] == "not set") {
							$statusClass = "status-badge-notset";
						}
						//throw new exception(print_r($employees, true));
				?>
						<div class="col-lg-4 col-md-6 col-12">
							<div class="card employee-box" id="employee-<?= $employeeId ?>">
								<div class="position-relative new-employee">
									<input type="checkbox" id="check-employee-<?= $employeeId ?>" name="" class="checkbox-employee pull-left invisible" onchange="javascript:selectEmployee(<?= $employeeId ?>)" value="<?= $employeeId ?>">
									<img src="<?= Yii::$app->homeUrl ?>images/employee/status/new-employee.svg" class="pull-right <?= $employee['isNew'] == 1 ? '' : 'invisible' ?>" alt="New Employee" style="margin-top:-15px;">
								</div>
								<div class="d-flex align-items-start justify-content-between mt-3">
									<div class="position-relative me-2">
										<img src="<?= Yii::$app->homeUrl . $employee['picture'] ?>" class="rounded-circle profile-img" alt="Profile">
										<span class="<?= $statusClass ?>"><?= $employee["status"] ?></span>
									</div>
									<div class="flex-grow-1">
										<div class="d-flex justify-content-between align-items-start">
											<div>
												<div class="mb-0 profile-employee-name text-truncate">
													<?= $employee["employeeName"] ?>
												</div>
												<span class="profile-employee-title">
													<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/star.svg" class="profile-icon" style="margin-top: -3px;">
													<?= $employee["titleName"] ?>
												</span>
												<span class="profile-employee-department">
													<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/share.svg" class="profile-icon">
													<?= $employee["departmentName"] ?>
												</span>
												<span class="profile-employee-team">
													<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team.svg" class="profile-icon">
													<?= $employee["teamName"] ?>
												</span>
											</div>

										</div>
									</div>
									<div class="position-relative">
										<div class="position-absolute top-0 end-0 d-flex gap-0">
											<a href="<?= Yii::$app->homeUrl ?>setting/employee/employee-profile/<?= ModelMaster::encodeParams(['employeeId' => $employeeId]) ?>" style="text-decoration: none;">
												<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" class="pim-icon">
											</a>
											<a href="javascript:deleteEmployee(<?= $employeeId ?>)" style="text-decoration: none;">
												<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/threedot.svg" class="pim-icon">
											</a>
										</div>
									</div>
								</div>

								<!-- Divider -->



								<!-- Contact & Info -->
								<div class="employee-contact-box">
									<div class="d-flex align-items-start justify-content-start pb-10 mb-10" style="border-bottom:1px dashed  #94989C;">
										<div class="position-relative me-2">
											<img src="<?= Yii::$app->homeUrl . $employee['companyPicture'] ?>" class="rounded-circle company-img" alt="Profile">
										</div>
										<div class="flex-grow-1">
											<div class="d-flex justify-content-start align-items-start" style="margin-top: -5px;">
												<div>
													<div class="profile-company-name text-truncate flex-grow-1">
														<?= $employee["companyName"] ?>
													</div>
													<span class="profile-city-name">
														<?= $employee["city"] ?>, <?= $employee["countryName"] ?>
													</span>
												</div>
											</div>
										</div>
									</div>


									<div class="d-flex justify-content-between align-items-start">
										<div>
											<div class="d-flex align-items-start justify-content-start">
												<div class="position-relative mr-5">
													<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/mail-gray.svg" class="profile-icon">
												</div>
												<div class="profile-employee-email text-truncate flex-grow-1"
													title="<?= $employee['email'] ?>" style="position: relative;">
													<?= $employee["email"] ?>
													<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/coppy-gray.svg" class="profile-icon position-absolute view-cursor"
														onclick="javascript:copyToClipboard('<?= $employee['telephoneNumber'] ?>')" title="<?= $employee['email'] ?>"
														style="top: 50%; right: 0; transform: translateY(-50%);">
												</div>
											</div>
											<div class="d-flex align-items-start justify-content-start mt-12">
												<div class="position-relative mr-5">
													<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/tel.svg" class="profile-icon">
												</div>
												<div class="profile-employee-tel flex-grow-1"
													title="<?= $employee['telephoneNumber'] ?>" style="position: relative;">
													<?= $employee["telephoneNumber"] ?>
													<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/coppy-gray.svg" class="ml-5 profile-icon view-cursor"
														onclick="javascript:copyToClipboard('<?= $employee['telephoneNumber'] ?>')" title="<?= $employee['telephoneNumber'] ?>"
														style="margin-top: -3px;">
												</div>
											</div>
											<div class="d-flex align-items-start justify-content-start mt-12">
												<div class="position-relative mr-5">
													<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/employee-gray.svg" class="profile-icon" style="margin-top: -3px;">
												</div>
												<div class="profile-employee-number flex-grow-1"
													title="<?= $employee['telephoneNumber'] ?>" style="position: relative;">
													Employee ID
													<span style="font-weight: 600;color:#30313D;" class="ms-1"><?= $employee["employeeNumber"] ?></span>
												</div>
											</div>
											<div class="d-flex align-items-start justify-content-start mt-12">
												<div class="position-relative mr-5">
													<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/calendar-gray.svg" class="profile-icon" style="margin-top: -3px;">
												</div>
												<div class="profile-employee-number flex-grow-1"
													title="<?= $employee['telephoneNumber'] ?>" style="position: relative;">
													Employee Since
													<span style="font-weight: 600;color:#30313D;" class="ms-1"><?= $employee["joinDate"] ?></span>
												</div>
											</div>
										</div>
									</div>
								</div>

							</div>
						</div>

					<?php
					endforeach;
					if (Yii::$app->controller->action->id == 'employee-result') {
						echo $this->render('pagination_page_search', [
							'totalEmployee' => $totalEmployee,
							"currentPage" => $currentPage,
							'totalPage' => $totalPage,
							"pagination" => $pagination,
							"pageType" => "grid",
							"companyId" => $companyId,
							"branchId" => $branchId,
							"departmentId" => $departmentId,
							"teamId" => $teamId,
							"currentPage" => $currentPage,
							"status" => $status
						]);
					} else {
						echo $this->render('pagination_page', [
							'totalEmployee' => $totalEmployee,
							"currentPage" => $currentPage,
							'totalPage' => $totalPage,
							"pagination" => $pagination,
							"pageType" => "grid",
						]);
					}
					?>
				<?php
				} else { ?>
					<div class="col-12 text-center font-b font-size-16"> Employee not found.</div>
				<?php
				}
				?>
			</div>
			<input type="hidden" id="show-action" value="">
		</div>
	</div>
</div>
<?php
$showModal = $isFromImport; // หรือ 0
?>
<?= $this->render('modal_warning_delete') ?>
<?= $this->render('modal_deleting') ?>
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
	window.onload = function() {
		var showModal = <?= json_encode($showModal) ?>;
		if (showModal === 1) {
			var modal = new bootstrap.Modal(document.getElementById('import-employee-modal'));
			modal.show();
		}
	};

	function deleteMultiEmployee() {
		$("#warning-delete-employee").show();
	}

	function deleteMultiEmployee() {
		var i = 0;
		var employeeId = "";
		const selectedEmployees = $("[id^=check-employee-]:checked").map(function() {
			return $(this).val();
		}).get();

		if (selectedEmployees.length == 0) {
			return false;
		} else {
			$("#totalSelectEmployee").html(selectedEmployees.length);
			$("#warning-delete-employee").modal("show");
		}


	}

	function deleteMultiEmployee() {
		const selectedEmployees = $("[id^=check-employee-]:checked").map(function() {
			return $(this).val();
		}).get();
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
					$.each(selectedEmployees, function(index, value) {
						$("#employee-" + value).css("display", "none");
					});
				}
			}
		});
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
	function modalImportEmployee(){
	$("#import-employee-modal").modal("show");
	}
	function openDialog(){
	$("#employee-file").click();
	}
		
		
', View::POS_END);
?>