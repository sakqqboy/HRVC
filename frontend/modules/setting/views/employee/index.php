<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\EmployeeStatus;
use frontend\models\hrvc\Title;

$this->title = 'Employee';
?>
<div class="col-12 mt-70">
	<div class="row">
		<div class="col-3 font-size-20 font-b">
			Employee
		</div>
		<div class="col-lg-9 col-12 text-end">
			<a href="<?= Yii::$app->homeUrl ?>setting/employee/import" class="btn btn-secondary font-size-12 mr-10">
				<i class="fa fa-upload mr-5" aria-hidden="true"></i> Import File
			</a>
			<a href="<?= Yii::$app->homeUrl ?>setting/employee/create" class="btn btn-success font-size-12">
				<i class="fa fa-user-plus mr-5" aria-hidden="true"></i> Create
			</a>
			<div class="btn-group ml-10" role="group" aria-label="Basic example">
				<button type="button" class="btn btn-primary btn-curr font-size-12" id="btn-0" onclick="javascript:employeeType(0)">All</button>
				<button type="button" class="btn btn-primary font-size-12" id="btn-1" onclick="javascript:employeeType(1)"><i class="fa fa-briefcase" aria-hidden="true"></i> Current</button>
				<button type="button" class="btn btn-primary btn-curr font-size-12" id="btn-2" onclick="javascript:employeeType(2)">Resigned <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></button>
				<input type="hidden" id="status" value="1">
			</div>
		</div>
		<div class="col-lg-3 col-md-4 col-6 mt-10">
			<div class="input-group">
				<button class="btn btn-outline-secondary font-size-12" type="button">Company</button>
				<select class="form-control font-size-12" id="company-team" onchange="javascript:branchCompany()">
					<option value="">Select Company</option>
					<?php
					if (isset($companies) && count($companies) > 0) {
					?>
						<?php
						foreach ($companies as $company) : ?>
							<option value="<?= $company['companyId'] ?>"><?= $company['companyName'] ?></option>
						<?php
						endforeach; ?>

					<?php
					}
					?>
				</select>
			</div>
		</div>
		<div class="col-lg-3 col-md-4 col-6 mt-10">
			<div class="input-group">
				<button class="btn btn-outline-secondary font-size-12" type="button">Branch</button>
				<select class="form-control font-size-12" id="branch-team" onchange="javascript:departmentBranch()" disabled></select>
			</div>
		</div>
		<div class="col-lg-3 col-md-4 col-6 mt-10">
			<div class="input-group">
				<button class="btn btn-outline-secondary font-size-12" type="button">Department</button>
				<select class="form-control font-size-12" id="department-team" onchange="javascript:teamDepartment()" disabled></select>

			</div>
		</div>
		<div class="col-lg-3 col-md-4 col-6 mt-10">
			<div class="input-group">
				<button class="btn btn-outline-secondary font-size-12" type="button">Team</button>
				<select class="form-control font-size-12" id="team-department" disabled></select>
				<button type="button" class="btn btn-outline-dark font-size-12" onclick="javascrip:filterEmployee()">
					<i class="fa fa-filter" aria-hidden="true"></i>
				</button>
			</div>
		</div>
	</div>
	<div class="col-12 mt-20 pr-15 pl-15">
		<div class="bg-white-employee">
			<div class="row" style="--bs-gutter-x:19px;">
				<?php
				if (isset($employees) && count($employees) > 0) {
					foreach ($employees as $employeeId => $employee) :
						$statusClass = "status-badge-full-time";
						if ($employee["status"] == "Intren") {
							$statusClass = "status-badge-intern";
						}
						if ($employee["status"] == "Part-time") {
							$statusClass = "status-badge-part-time";
						}
						//throw new exception(print_r($employees, true));
				?>
						<div class="col-lg-4 col-md-6 col-12">
							<div class="card employee-box" id="employee-<?= $employeeId ?>">
								<div class="position-relative new-employee">
									<input type="checkbox" id="check-employee-<?= $employeeId ?>" name="" class="checkbox-employee pull-left" onchange="javascript:selectEmployee(<?= $employeeId ?>)">
									<img src="<?= Yii::$app->homeUrl ?>images/employee/status/new-employee.svg" class="pull-right <?= $employee['isNew'] == 1 ? '' : 'invisible' ?>" alt="New Employee" style="margin-top:-15px;">
								</div>
								<div class="d-flex align-items-start justify-content-between mt-3">
									<div class="position-relative me-2">
										<img src="<?= Yii::$app->homeUrl . $employee['picture'] ?>" class="rounded-circle profile-img" alt="Profile">
										<span class="status-badge-full-time"><?= $employee["status"] ?></span>
									</div>
									<div class="flex-grow-1">
										<div class="d-flex justify-content-between align-items-start">
											<div>
												<span class="mb-0 profile-employee-name text-truncate">
													<?= $employee["employeeName"] ?>
												</span>
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
													<span class="profile-company-name">
														<?= $employee["companyName"] ?>
													</span>
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
		padding: 32px 20px 32px 20px;
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
		display: block;
		max-width: 200px;

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
		display: block;
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



	@media (min-width: 768px) {
		.profile-employee-email {
			max-width: 400px;
		}
	}

	@media (min-width: 1200px) {
		.profile-employee-email {
			max-width: 250px;
		}
	}

	@media (min-width: 1900px) {
		.profile-employee-email {
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
</script>