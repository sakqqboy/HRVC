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
	<div class="col-12 mt-20">
		<div class="card example-1 scrollbar-ripe-malinka">
			<div class="card-body">
				<div class="row">
					<?php
					if (isset($employees) && count($employees) > 0) {
						foreach ($employees as $employee) :
					?>
							<div class="col-lg-3 col-md-4 col-6" id="employee-<?= $employee['employeeId'] ?>">
								<div class="alert alert-employee pr-5 pl-5">
									<div class="row" style="margin-top: -13px;">
										<div class="col-lg-10 col-md-10 col-10 text-end">
											<?php
											$employeeStatus = EmployeeStatus::employeeStatus($employee['employeeId']);
											if ($employeeStatus["name"] == "Active") {
												$text = 'success0';
											} else {
												$text = 'danger';
											}
											?>
											<span class="badge rounded-pill bg-<?= $text ?>" style="font-size: 7px;"><?= $employeeStatus["name"] ?></span>
										</div>
										<div class="col-lg-2 col-md-2 col-2 text-end" onclick="javascript:showAction(<?= $employee['employeeId'] ?>)" style="cursor: pointer;">
											<div class="col-12 employee-ellipsis">
												<strong><i class="fa fa-ellipsis-v" aria-hidden="true"></i></strong>
											</div>
										</div>
										<div class="employee-action" id="employee-action-<?= $employee['employeeId'] ?>">
											<a href="<?= Yii::$app->homeUrl ?>setting/employee/update/<?= ModelMaster::encodeParams(['employeeId' => $employee['employeeId']]) ?>" class="btn btn-outline-dark btn-sm font-size-12">
												<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
											</a>
											<a href="javascript:deleteEmployee(<?= $employee['employeeId'] ?>)" class="btn btn-outline-danger btn-sm font-size-14 mt-5">
												<i class="fa fa-trash" aria-hidden="true"></i>
											</a>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-5 col-md-6 col-6">
											<div class="col-12">
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
												<img src="<?= Yii::$app->homeUrl . $picture ?>" class="image-employee">
											</div>
										</div>
										<div class="col-lg-7 col-md-6 col-6">
											<div class="col-12 emplo-tadawoki">
												<?= $employee["employeeFirstname"] ?>
											</div>
											<div class="col-12 emplo-tadawoki mt-5">
												<?= $employee["employeeSurename"] ?>
											</div>
											<div class="col-12 emplo-permanent">
												<span class="badge bg-info text-dark"><?= $employee["employeeConditionName"] ?></span>
											</div>
										</div>
									</div>

									<div class="col-12 pt-5 pb-5 mt-10 pl-5 pr-5" style="background-color:#F0F8FF;border-radius:3px;">
										<div class="row">
											<div class="col-lg-6 col-md-6 col-6">
												<div class="col-12 lead-programmer">
													<?= Title::titleName($employee["titleId"]) ?>
												</div>
												<div class="col-12 lead-it mt-3">
													<?= Department::departmentNAme($employee["departmentId"]) ?>
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-6">
												<div class="col-12 lead-programmer">
													<i class="fa fa-calendar" aria-hidden="true"></i> Hiring Date
												</div>
												<div class="col-12 lead-it mt-3">
													<?= ModelMaster::dateNumberDash($employee['hireDate']) ?>
												</div>
											</div>
										</div>
										<div class="col-12 mt-5">
											<div class="row">
												<div class="col-lg-2 col-md-6 col-2">
													<div class="col-12" style="margin-top: -10px;">
														<i class="fa fa-envelope-o envelope-send" aria-hidden="true"></i>
													</div>
												</div>
												<div class="col-lg-10 col-md-6 col-10 pr-0 pl-0">
													<div class="col-12 employee-email mt-3 ">
														<?= $employee["companyEmail"] ?>
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
											<a href="<?= Yii::$app->homeUrl ?>setting/employee/employee-profile/<?= ModelMaster::encodeParams(['employeeId' => $employee['employeeId']]) ?>" style="text-decoration: none;">
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
</div>