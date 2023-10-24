<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\Team;

$this->title = 'Team';
?>

<div class="col-12 team-one" style="margin-top: 90px;">
	<div class="row">
		<div class="col-lg-3 col-md-6 col-12">
			<div class="col-12 branch-title">
				Team
			</div>
		</div>
		<!-- <div class="col-lg-2 col-md-6 col-12 mt-10">
			<button type="button" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create</button>
		</div> -->
		<div class="col-lg-3 col-md-4 col-12 mt-10">
			<div class="input-group">
				<button class="btn btn-outline-secondary" type="button">Company</button>
				<select class="form-control font-size-14" id="company-team-filter" onchange="javascript:branchCompanyFilter()">
					<?php
					if ($companyIdSearch != '') { ?>
						<option value="<?= $companyIdSearch ?>"><?= Company::companyName($companyIdSearch) ?></option>
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
				<select class="form-control font-size-14" id="branch-team-filter" onchange="javascript:departmentBranchFilter()" <?= $branchId == '' ? 'disabled' : '' ?>>

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
				<select class="form-control font-size-14" id="department-team-filter" <?= $departmentId == '' ? 'disabled' : '' ?>>

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
				<button type="button" class="btn btn-outline-dark" onclick="javascrip:filterTeam()">
					<i class="fa fa-filter" aria-hidden="true"></i>
				</button>
			</div>
		</div>
	</div>
	<div class="col-12 mt-20">
		<div class="alert alert-secondary" role="alert">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12">
					<div class="col-12">
						<label class="form-label font-size-12 font-b"> Select Associate Company </label>
						<?php
						if (!isset($companyId) || $companyId == '') {
						?>
							<select class="form-select Company-select" aria-label="Default select example" id="company-team" onchange="javascript:branchCompany()">
								<option value="">Select Company</option>
								<?php
								if (isset($companies) && count($companies) > 0) {
									foreach ($companies as $company) :
								?>
										<option value="<?= $company['companyId'] ?>"><?= $company['companyName'] ?></option>
								<?php
									endforeach;
								}
								?>
							</select>
						<?php
						}
						?>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<div class="col-12">
						<label class="form-label font-size-12 font-b"> Select Associate Branch</label>
						<select class="form-select Company-select" aria-label="Default select example" id="branch-team" <?= isset($companyId) && $companyId != '' ? '' : 'disabled' ?> onchange="javascript:departmentBranch()">

							<option value="">Select Branch</option>
							<?php
							if (isset($companyId) && $companyId == '') {
								if (isset($branches) && count($branches) > 0) {
									foreach ($branches as $b) : ?>
										<option value="<?= $b['branchId'] ?>"><?= $b['branchName'] ?></option>
							<?php

									endforeach;
								}
							}
							?>
						</select>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<div class="col-12">
						<label class="form-label font-size-12 font-b"> Select Associate Department</label>
						<select class="form-select Company-select" aria-label="Default select example" id="department-team" disabled>
							<option value="">Select Department</option>
						</select>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-12">
					<div class="mb-3">
						<label class="form-label font-size-12 font-b"> Team Name</label>
						<input type="text" class="form-control Company-select" id="teamName" placeholder="">
					</div>
				</div>
				<div class="col-lg-1 col-md-2 col-12 team-create0 mt-10 pr-0 pl-0 text-end">
					<a href="javascript:saveCreateTeam()" class="btn btn-success" id="create-team"><i class="fa fa-plus" aria-hidden="true"></i> Create</a>
					<a class="btn btn-sm btn-warning font-size-12 mr-5 " id="update-team" style="display:none;">
						<i class="fa fa-check" aria-hidden="true"></i>
					</a>
					<a class="btn btn-sm btn-danger font-size-12 " id="reset-team" style="display:none;">
						<i class="fa fa-times" aria-hidden="true"></i>
					</a>
					<input type="hidden" value="" id="teamId">
				</div>
			</div>
		</div>
		<div class="col-12 mt-10">
			<div class="alert alert-branch" role="alert">
				<div class="row" id="show-team">
					<?php
					if (isset($allTeams) && count($allTeams) > 0) {
						foreach ($allTeams as $team) :
					?>
							<div class="col-lg-3 col-md-5 col-sm-3 col-12" id="team-<?= $team['teamId'] + 543 ?>">
								<div class="card" style="border: none;">
									<div class="card-body">
										<div class="row">
											<div class="col-8 font-size-14 font-b ">
												<?= $team['teamName'] ?>
											</div>
											<div class="col-4  pl-0 pr-0 text-end">
												<a href="javascript:updateTeam(<?= $team['teamId'] + 543 ?>)" class="btn btn-outline-dark mr-5 font-size-10">
													<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
												</a>
												<a href="javascript:deleteTeam(<?= $team['teamId'] + 543 ?>)" class="btn btn-outline-danger font-size-10">
													<i class="fa fa-trash" aria-hidden="true"></i>
												</a>
											</div>
										</div>
										<div class="col-12 mt-5 font-size-12">
											<?= $team["companyName"] ?>
										</div>
										<div class="col-12 mt-5 bangladresh-hrvc2">
											Branch: <img src="<?= Yii::$app->homeUrl ?><?= $team['flag'] ?>" class="bangladresh-hrvc1 mr-5"> <?= $team["branchName"] ?>, <?= $team["countryName"] ?>
										</div>
										<div class="col-12 mt-5 font-size-12">
											Department: <?= $team["departmentName"] ?>
										</div>
										<div class="row mt-20">

											<div class="col-3 show-height text-center">
												<i class="fa fa-users share-big mt-40" aria-hidden="true"></i>
											</div>
											<div class="col-9 ">
												<div class="col-12 font-size-12 font-b"> LEADER</div>
												<div class="font-size-11 mt-5 pl-15"> <?= Team::teamLeader($team['teamId'], 1) ?></div>
												<div class="font-size-12 mt-10 font-b"> SUB LEADER</div>
												<div class="font-size-11 mt-5 pl-15"><?= Team::teamLeader($team['teamId'], 2) ?></div>
												<div class="row mt-10">
													<div class="col-8 text-start font-size-12 font-b">
														Employees
													</div>
													<div class="col-4 text-end font-size-12 font-b">
														<!-- <a href="" class="no-underline-black"> -->
														<?= Team::employeeInTeam($team['teamId']) ?>

														<!-- </a> -->
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
						<div class="col-12 text-center font-b font-size-16"> Team not found.</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3 col-md-4 col-6">
				<div class="alert alert-secondary-background" role="alert">
					<div class="row">
						<div class="col-4">
							<i class="fa fa-users" aria-hidden="true" style="font-size: 25px;padding-top: 18px;"></i>
						</div>
						<div class="col-2">
							<a href="<?= Yii::$app->homeUrl ?>setting/team/create/<?= ModelMaster::encodeParams(['companyId' => '']) ?>" style="text-decoration: none;">
								<div class="col-12 text-primary">
									Branch
								</div>
								<div class="col-2 number-bold text-black">
									<?= $totalBranch
									?>
								</div>
							</a>
						</div>

					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-4 col-6">
				<div class="alert alert-secondary-background" role="alert">
					<div class="row">
						<div class="col-4">
							<i class="fa fa-users" aria-hidden="true" style="font-size: 25px;padding-top: 18px;"></i>
						</div>
						<div class="col-2">
							<a href="<?= Yii::$app->homeUrl ?>setting/department/create/<?= ModelMaster::encodeParams(['companyId' => '']) ?>" style="text-decoration: none;">
								<div class="col-12 text-primary">
									Department
								</div>
								<div class="col-2 number-bold text-black">
									<?= $totalDepartment
									?>
								</div>
							</a>
						</div>

					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-4 col-6">
				<div class="alert alert-secondary-background" role="alert">
					<div class="row">
						<div class="col-4">
							<i class="fa fa-users" aria-hidden="true" style="font-size: 25px;padding-top: 18px;"></i>
						</div>
						<div class="col-2">
							<a href="<?= Yii::$app->homeUrl ?>setting/employee/index/<?= ModelMaster::encodeParams(['companyId' => '']) ?>" style="text-decoration: none;">
								<div class="col-12 text-primary">
									Employee
								</div>
								<div class="col-2 number-bold text-black">
									<?= $totalEmployee
									?>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>