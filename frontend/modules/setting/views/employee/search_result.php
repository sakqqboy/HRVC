<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\EmployeeCondition;
use frontend\models\hrvc\Team;

$this->title = 'Employee';
?>

<div class="col-12 mt-90 all-employee0">
	<div class="row">
		<div class="col-2">
			<div class="col-12 employee-one">
				Employee
			</div>
		</div>
		<div class="col-10 text-end">
			<div class="col-12 mt-10">
				<a href="<?= Yii::$app->homeUrl ?>setting/employee/import" class="btn btn-secondary">
					<i class="fa fa-upload mr-5" aria-hidden="true"></i> Import File
				</a>
				<a href="<?= Yii::$app->homeUrl ?>setting/employee/create" class="btn btn-success">
					<i class="fa fa-user-plus mr-5" aria-hidden="true"></i> Create
				</a>

			</div>
		</div>

		<div class="col-lg-3 col-md-4 col-12 mt-10">
			<div class="input-group">
				<button class="btn btn-outline-secondary" type="button">Company</button>
				<select class="form-control font-size-14" id="company-team" onchange="javascript:branchCompany()">
					<?php
					if ($companyId != '') { ?>
						<option value="<?= $companyId ?>"><?= Company::companyName($companyId) ?></option>
					<?php
					}
					?>
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
		<div class="col-lg-3 col-md-4 col-12 mt-10">
			<div class="input-group">

				<button class="btn btn-outline-secondary" type="button">Branch</button>
				<select class="form-control font-size-14" id="branch-team" onchange="javascript:departmentBranch()" <?= $branchId == '' ? 'disabled' : '' ?>>
					<?php
					if ($branchId != '') { ?>
						<option value="<?= $branchId ?>"><?= Branch::branchName($branchId) ?></option>
					<?php
					} ?>
					<option value="">Select Branch</option>
					<?php
					if (count($branches) > 0) {
						foreach ($branches as $branch) : ?>
							<option value="<?= $branch['branchId'] ?>"><?= $branch["branchName"] ?></option>
					<?php
						endforeach;
					}
					?>
				</select>
			</div>
		</div>
		<div class="col-lg-3 col-md-4 col-12 mt-10">
			<div class="input-group">

				<button class="btn btn-outline-secondary" type="button">Department</button>
				<select class="form-control font-size-14" id="department-team" onchange="javascript:teamDepartment()" <?= $departmentId == '' ? 'disabled' : '' ?>>
					<?php
					if ($departmentId != '') { ?>
						<option value="<?= $departmentId ?>"><?= Department::departmentNAme($departmentId) ?></option>
					<?php
					}
					?>
					<option value="">Select Department</option>
					<?php
					if (count($departments) > 0) {
						foreach ($departments as $department) : ?>
							<option value="<?= $department['departmentId'] ?>"><?= $department["departmentName"] ?></option>
					<?php
						endforeach;
					}
					?>
				</select>

			</div>
		</div>
		<div class="col-lg-3 col-md-4 col-12 mt-10">
			<div class="input-group">

				<button class="btn btn-outline-secondary" type="button">Team</button>
				<select class="form-control font-size-14" id="team-department" <?= $teamId == '' ? 'disabled' : '' ?>>
					<?php
					if ($teamId != '') { ?>
						<option value="<?= $teamId ?>"><?= Team::teamName($teamId) ?></option>
					<?php
					}
					?>
					<option value="">Select Team</option>
					<?php
					if (count($teams) > 0) {
						foreach ($teams as $team) : ?>
							<option value="<?= $team['teamId'] ?>"><?= $team["teamName"] ?></option>
					<?php
						endforeach;
					}
					?>
				</select>
				<button type="button" class="btn btn-outline-dark" onclick="javascrip:filterEmployee()">
					<i class="fa fa-filter" aria-hidden="true"></i>
				</button>
			</div>
		</div>
		<div class="col-lg-12 col-md-6 col-12 mt-10 text-end">
			<div class="btn-group" role="group" aria-label="Basic example">
				<button type="button" class="btn btn-primary <?= $status == 0 ? '' : 'btn-curr' ?>" id="btn-0" onclick="javascript:employeeType(0)">All</button>
				<button type="button" class="btn btn-primary <?= $status == 1 ? '' : 'btn-curr' ?>" id="btn-1" onclick="javascript:employeeType(1)"><i class="fa fa-briefcase" aria-hidden="true"></i> Current</button>
				<button type="button" class="btn btn-primary <?= $status == 2 ? '' : 'btn-curr' ?>" id="btn-2" onclick="javascript:employeeType(2)">Resigned <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></button>
				<input type="hidden" id="status" value="<?= $status ?>">
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
							<div class="col-lg-2 col-md-6 col-8">
								<div class="alert alert-employee pr-10 pl-10" role="alert">
									<div class="row" style="margin-top: -13px;">
										<div class="col-lg-10 col-md-10 col-10 text-end">
											<?php
											if ($employee["status"] == 1) {
												$text = 'success0';
												$statusName = "Active";
											} else {
												$text = 'danger';
												$statusName = "Resign";
											}
											?>
											<span class="badge rounded-pill bg-<?= $text ?>" style="font-size: 7px;"><?= $statusName ?></span>
										</div>
										<div class="col-lg-2 col-md-2 col-2 text-end">
											<div class="col-12 employee-ellipsis">
												<strong><i class="fa fa-ellipsis-v" aria-hidden="true"></i></strong>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 col-md-6 col-6">
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
										<div class="col-lg-6 col-md-6 col-6">
											<div class="col-12 emplo-tadawoki">
												<?= $employee["employeeFirstname"] ?>
											</div>
											<div class="col-12 emplo-tadawoki">
												<?= $employee["employeeSurename"] ?>
											</div>
											<div class="col-12 emplo-permanent">
												<span class="badge bg-info text-dark"><?= EmployeeCondition::conditionName($employee["employeeConditionId"]) ?></span>
											</div>
										</div>
									</div>

									<div class="alert alert1-employee1 mt-10" role="alert">
										<div class="row">
											<div class="col-lg-6 col-md-6 col-6">
												<div class="col-12 lead-programmer">
													lead Programmer
												</div>
												<div class="col-12 lead-it mt-3">
													IT & Development
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
									</div>
									<div class="col-12 employee-view">
										<a href="<?= Yii::$app->homeUrl ?>setting/employee/employee-profile/<?= ModelMaster::encodeParams(['employeeId' => $employee['employeeId']]) ?>" style="text-decoration: none;">
											View Profile
										</a>
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
			</div>
		</div>
	</div>
</div>