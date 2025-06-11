<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\EmployeeStatus;
use frontend\models\hrvc\Title;

$this->title = 'Employee';
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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
		<div class="pim-body bg-white-employee">

			<div class="row" style="--bs-gutter-x:19px;">
				<?php
				if (isset($employees) && count($employees) > 0) {
					foreach ($employees as $employeeId => $employee) :
						//throw new exception(print_r($employees, true));
				?>
						<div class="col-lg-4 col-md-6 col-12" id="employee-<?= $employeeId ?>">
							<div class="employee-box">
								<div class="row">
									<div class="col-3 text-center border pr-0 pl-0 d-flex justify-content-center align-items-center img-container" style="position:relative;height:80px;">
										<img src="<?= Yii::$app->homeUrl . $employee['picture'] ?>" class="img-fluid image-employee2">
										<div class="status-badge"><?= $employee["status"] ?></div>
									</div>
									<div class="col-8 pr-0 border">
										<div class="col-12 pr-0 pl-0 profile-employee-name " style="margin-top: -5px;"><?= $employee["employeeName"] ?></div>
										<div class="col-12 pr-0 pl-0 profile-employee-title mt-3">
											<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/star.svg" class="profile-icon" style="margin-top: -3px;">
											<?= $employee["titleName"] ?>
										</div>
										<div class="col-12 pr-0 pl-0 profile-employee-department ">
											<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/share.svg" class="profile-icon">
											<?= $employee["departmentName"] ?>
										</div>
										<div class="col-12 pr-0 pl-0 profile-employee-team">
											<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team.svg" class="profile-icon">
											<?= $employee["teamName"] ?>
										</div>

									</div>
									<div class="col-lg-1 text-end pr-0 pl-0 border" onclick="javascript:showAction(<?= $employeeId ?>)" style="cursor: pointer;">
										<a href="<?= Yii::$app->homeUrl ?>setting/employee/employee-profile/<?= ModelMaster::encodeParams(['employeeId' => $employeeId]) ?>" style="text-decoration: none;">
											<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" class="pim-icon">
										</a>
										<a href="javascript:deleteEmployee(<?= $employeeId ?>)">
											<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/threedot.svg" class="pim-icon">
										</a>
									</div>
									<div class="employee-action" id="employee-action-<?= $employeeId ?>">

										<a href="<?= Yii::$app->homeUrl ?>setting/employee/update/<?= ModelMaster::encodeParams(['employeeId' => $employeeId]) ?>">
											<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" class="pim-icon">
										</a>
										<a href="javascript:deleteEmployee(<?= $employeeId ?>)" class="btn btn-outline-danger btn-sm font-size-14 mt-5">
											<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/threedot.svg" class="pim-icon">
										</a>
									</div>
								</div>

								<div class="col-12 employee-contact-box mt-25">
									<div class="row">
										<div class="col-lg-6 col-md-6 col-6">
											<div class="col-12 lead-programmer">
												<?= $employee["titleName"] ?>
											</div>
											<div class="col-12 lead-it mt-3">
												<?= $employee["departmentName"] ?>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-6">
											<div class="col-12 lead-programmer">
												<i class="fa fa-calendar" aria-hidden="true"></i> Hiring Date
											</div>
											<div class="col-12 lead-it mt-3">
												<?= $employee['joinDate'] ?>
											</div>
										</div>
									</div>
									<div class="col-12 mt-25">
										<div class="row">
											<div class="col-lg-2 col-md-6 col-2">
												<div class="col-12" style="margin-top: -10px;">
													<i class="fa fa-envelope-o envelope-send" aria-hidden="true"></i>
												</div>
											</div>
											<div class="col-lg-10 col-md-6 col-10 pr-0 pl-0">
												<div class="col-12 employee-email mt-3 ">
													<?= $employee["email"] ?>
												</div>
											</div>
											<div class="col-lg-2 col-md-6 col-2">
												<div class="col-12" style="margin-top: -10px;">
													<i class="fa fa-phone envelope-send" aria-hidden="true"></i>
												</div>
											</div>
											<div class="col-lg-10 col-md-6 col-10  pr-0 pl-0">
												<div class="col-12 envelope-mail">
													<?= $employee["telephoneNumber"] ?>
												</div>
											</div>
											<div class="col-lg-2 col-md-6 col-2">
												<div class="col-12" style="margin-top: -10px;">
													<i class="fa fa-user envelope-send" aria-hidden="true"></i>
												</div>
											</div>
											<div class="col-lg-10 col-md-6 col-10  pr-0 pl-0">
												<div class="col-12 employee-email mt-3">
													<?= $employee["employeeNumber"] ?>
												</div>
											</div>
										</div>
									</div>
									<div class="col-12 employee-view">
										<a href="<?= Yii::$app->homeUrl ?>setting/employee/employee-profile/<?= ModelMaster::encodeParams(['employeeId' => $employeeId]) ?>" style="text-decoration: none;">
											View Profile
										</a>
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
	.employee-box {
		background-color: #FBFCFF;
		height: 368px;
		border-radius: 5px;
		padding: 20px 10px 20px 10px;
		border: #BBCDDE solid thin;
	}

	.employee-contact-box {
		background-color: #FFFFFF;
		border-radius: 5px;
		padding: 20px 16px 20px 16px;
		border: #BBCDDE solid thin;
	}

	.image-employee2 {
		max-width: 100%;
		max-height: 100%;
		width: auto;
		height: auto;
		object-fit: cover;
		/* หรือ 'cover' ตามที่ต้องการ */
		display: block;
		border-radius: 100%;
	}

	.profile-employee-name {
		font-size: 16px;
		font-weight: 600;
		color: #30313D;

	}

	.profile-employee-department {
		font-size: 13px;
		font-weight: 400;
		color: #30313D;
		line-height: 18px;

	}

	.profile-employee-team {
		font-size: 13px;
		font-weight: 400;
		color: #666666;
		line-height: 18px;
	}

	.profile-employee-title {
		font-size: 14px;
		font-weight: 500;
		color: #30313D;
		line-height: 18px;
	}

	.profile-icon {
		width: 14px;
		height: 14px;
	}

	.status-badge {
		width: 75px;
		height: 20px;
		background-color: #20598D;
		color: white;
		text-align: center;
		line-height: 20px;
		font-size: 12px;
		font-weight: 600;
		border-radius: 12px;
		position: absolute;
		left: 50%;
		transform: translate(-50%, -50%);
	}

	.bg-white-employee {
		background-color: white;
		border-radius: 10px;
		border: #BBCDDE solid thin;
	}

	.img-container {
		height: 80ยป;
		/* กำหนดความสูงของ div ตามต้องการ */

		overflow: hidden;
		/* ตัดส่วนเกินของรูปถ้ามี */
		position: relative;
	}
</style>