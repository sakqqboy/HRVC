<?php

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
				<button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Company</button>
				<ul class="dropdown-menu">
					<li><a class="dropdown-item" href="#">Action</a></li>
					<li><a class="dropdown-item" href="#">Another action</a></li>
					<li><a class="dropdown-item" href="#">Something else here</a></li>
					<li>
						<hr class="dropdown-divider">
					</li>
					<li><a class="dropdown-item" href="#">Separated link</a></li>
				</ul>
				<input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="">
			</div>
		</div>
		<div class="col-lg-3 col-md-4 col-12 mt-10">
			<div class="input-group">
				<button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Branch</button>
				<ul class="dropdown-menu">
					<li><a class="dropdown-item" href="#">Action</a></li>
					<li><a class="dropdown-item" href="#">Another action</a></li>
					<li><a class="dropdown-item" href="#">Something else here</a></li>
					<li>
						<hr class="dropdown-divider">
					</li>
					<li><a class="dropdown-item" href="#">Separated link</a></li>
				</ul>
				<input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="">
			</div>
		</div>
		<div class="col-lg-3 col-md-4 col-12 mt-10">
			<div class="input-group">
				<button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Department</button>
				<ul class="dropdown-menu">
					<li><a class="dropdown-item" href="#">Action</a></li>
					<li><a class="dropdown-item" href="#">Another action</a></li>
					<li><a class="dropdown-item" href="#">Something else here</a></li>
					<li>
						<hr class="dropdown-divider">
					</li>
					<li><a class="dropdown-item" href="#">Separated link</a></li>
				</ul>
				<input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="">
			</div>
		</div>
	</div>
	<div class="col-12 mt-20">
		<div class="alert alert-secondary" role="alert">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12">
					<div class="col-12">
						<label class="form-label font-size-12 font-b"> Select Associate Company </label>
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
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<div class="col-12">
						<label class="form-label font-size-12 font-b"> Select Associate Branch</label>
						<select class="form-select Company-select" aria-label="Default select example" id="branch-team" disabled onchange="javascript:departmentBranch()">
							<option value="">Select Branch</option>
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

				<!-- <div class="col-lg-2 col-md-6 col-12">
					<div class="col-12">
						<label for="exampleFormControlInput1" class="form-label" style="font-size: 13px;font-weight:700;"> Assign Employee</label>
						<select class="form-select Company-select" aria-label="Default select example">
							<option selected>Select Employee</option>
							<option value="1">Hamish Marsh</option>
							<option value="2">IT</option>
							<option value="3">Accountting</option>
						</select>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-12">
					<div class="col-12">
						<label for="exampleFormControlInput1" class="form-label" style="font-size: 13px;font-weight:700;"> Team Title</label>
						<select class="form-select Company-select" aria-label="Default select example">
							<option selected>Select set titles</option>
							<option value="1">Leader</option>
							<option value="2">IT</option>
							<option value="3">Accountting</option>
						</select>
					</div>
				</div> -->
				<div class="col-lg-1 col-md-2 col-12 team-create0 mt-30 pr-0 pl-0 text-end">
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
										<div class="col-12 mt-10 font-size-12">
											<?= $team["companyName"] ?>
										</div>
										<div class="col-12 mt-10 bangladresh-hrvc2">
											Branch: <img src="<?= Yii::$app->homeUrl ?><?= $team['flag'] ?>" class="bangladresh-hrvc1 mr-5"> <?= $team["branchName"] ?>, <?= $team["countryName"] ?>
										</div>
										<div class="row mt-20">

											<div class="col-3 show-height text-center">
												<i class="fa fa-users share-big mt-40" aria-hidden="true"></i>
											</div>
											<div class="col-9 ">
												<div class="col-12 font-size-12 font-b"> LEADER</div>
												<div class="font-size-11 mt-5 pl-15"> Employee Name</div>
												<div class="font-size-12 mt-10 font-b"> SUB LEADER</div>
												<div class="font-size-11 mt-5 pl-15">Leighton Kramer > Staff</div>
												<div class="row mt-10">
													<div class="col-8 text-start font-size-12 font-b">
														Employees
													</div>
													<div class="col-4 text-end font-size-12 font-b">
														<a href="" class="no-underline-black">
															8
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
					<?php
						endforeach;
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>