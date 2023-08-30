<?php

use common\models\ModelMaster;

$this->title = 'Department';
?>

<div class="col-12 department-one" style="margin-top: 90px;">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-12">
			<div class="col-12 branch-title">
				Department
			</div>
		</div>
		<!-- <div class="col-lg-3 col-md-6 col-12 mt-10">
			<button type="button" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create</button>
		</div> -->
		<div class="col-lg-3 col-md-6 col-12 mt-10">
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
				<input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Tokyo Consulting Firm Pvt. Ltd">
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-12 mt-10">
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
				<input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Tokyo Consulting Firm Pvt. Ltd">
			</div>
		</div>
	</div>
	<div class="col-12 mt-30">
		<div class="alert alert-secondary" role="alert">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12">
					<div class="col-12">
						<label class="form-label font-size-12 font-b"> Select Associate Company </label>
						<?php
						if ($companyId == null) {
						?>
							<select class="form-select form-control" id="company" onchange="javascript:companyBranch()">
								<option value="">Select Company</option>
								<?php
								if (isset($companies) && count($companies) > 0) {
									foreach ($companies as $c) : ?>
										<option value="<?= $c['companyId'] ?>">
											<?= $c['companyName'] ?>
										</option>
								<?php
									endforeach;
								}
								?>
							</select>
						<?php
						} else {
						?>
							<div class="col-12 font-b">
								<?= $company["companyName"] ?>
								<input type="hidden" id="company" value="<?= $company['companyId'] ?>">
							</div>
						<?php
						}
						?>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<div class="col-12">
						<label class="form-label font-size-12 font-b"> Select Associate Branch</label>
						<select class="form-select" id="branch">
							<option value="">Select Branch</option>
							<?php
							if (isset($branches) && count($branches) > 0) {
							?>

								<?php
								foreach ($branches as $b) : ?>
									<option value="<?= $b['branchId'] ?>"><?= $b['branchName'] ?></option>
								<?php
								endforeach; ?>

							<?php
							}
							?>
						</select>
					</div>
				</div>
				<div class="col-lg-5 col-md-6 col-12">
					<div class="col-12">
						<div class="mb-3">
							<label class="form-label font-size-12 font-b"> Department Name</label>
							<input type="text" class="form-control" id="departmentName" placeholder="">
						</div>
					</div>
				</div>
				<div class="col-lg-1 col-md-2 col-12 pt-30 text-end  pr-1 pl-0">
					<a href="javascript:createDepartment()" class="btn btn-success" id="create-department">
						<i class="fa fa-plus" aria-hidden="true"></i> Create</a>
					<a class="btn btn-sm btn-warning font-size-12 mr-5 " id="update-department" style="display:none;">
						<i class="fa fa-check" aria-hidden="true"></i>
					</a>
					<a class="btn btn-sm btn-danger font-size-12 " id="reset-department" style="display:none;">
						<i class="fa fa-times" aria-hidden="true"></i>
					</a>
					<input type="hidden" value="" id="departmentId">
				</div>
			</div>
		</div>
		<div class="col-12">
			<div class="alert alert-branch" role="alert">
				<div class="row" id="all-department-list">
					<?php
					if (isset($departmentList) && count($departmentList) > 0) {
						foreach ($departmentList as $departmentId => $dpm) :
					?>
							<div class="col-lg-3 col-md-5 col-sm-3 col-12" id="department-<?= $departmentId + 543 ?>">
								<div class="card" style="border: none;border-radius:10px;">
									<div class="card-body">
										<div class="col-12 txt-bold">
											<?= $dpm['departmentName'] ?>
										</div>
										<div class="row">
											<div class="col-8 department-tokyo">
												<?= $dpm['companyName'] ?>
											</div>
											<div class="col-4 text-end pr-0">
												<a href="javascript:updateDepartment(<?= $departmentId + 543 ?>)" class="btn btn-sm btn-outline-dark mr-5 font-size-12"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
												<a href="javascript:deleteDepartment(<?= $departmentId + 543 ?>)" class="btn btn-sm btn-outline-danger font-size-12"><i class="fa fa-trash" aria-hidden="true"></i> </a>
											</div>
											<div class="col-12 bangladresh-hrvc2 mt-10">
												Branch : <img src="<?= Yii::$app->homeUrl ?><?= $dpm['flag'] ?>" class="bangladresh-hrvc1 ml-5 mr-5">
												<?= $dpm['branchName'] ?>
											</div>
										</div>
										<div class="row mt-10">
											<div class="col-5 show-height text-center font-b" style="padding-top:23%;">
												<a href="javascript:showTitleList(<?= $departmentId + 543 ?>)" class="no-underline-black">
													<i class="fa fa-plus-circle" aria-hidden="true"></i> Title
												</a>
												<div class="title-list text-start" id="title-list-<?= $departmentId + 543 ?>">

												</div>
											</div>
											<div class="col-7 department-sizesmall" id="title-department-<?= $departmentId + 543 ?>">
												<?php
												if (isset($dpm["titleDepartments"]) && count($dpm["titleDepartments"]) > 0) {
													foreach ($dpm["titleDepartments"] as $dpm2) : ?>
														<div class="col-12 mt-5">
															<?= $dpm2["titleName"] ?>
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
						<?php
						endforeach;
					} else { ?>
						<div class="col-12 text-center font-b font-size-16"> Department not found.</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>