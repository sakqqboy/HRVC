<?php

use common\models\ModelMaster;

$this->title = 'Branch';
?>

<div class="col-12 branch-one" style="margin-top: 90px;">
	<div class="row all-row">
		<div class="col-lg-8 col-md-3 col-3">
			<div class="col-12 branch-title">
				Branch
			</div>
		</div>
		<!-- <div class="col-lg-3 col-md-3 col-3 mt-10">
			<button type="button" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create</button>
		</div> -->
		<div class="col-lg-1 col-md-3 col-2 text-end pt-10">
			<button type="button" class="btn btn-outline-primary"> <i class="fa fa-filter" aria-hidden="true"></i></button>
		</div>
		<div class="col-lg-3 col-md-3 col-7 bt-togg pt-10">
			<div class="input-group">
				<!-- <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Company</button>
				<ul class="dropdown-menu">
					<li><a class="dropdown-item" href="#">Action</a></li>
					<li><a class="dropdown-item" href="#">Another action</a></li>
					<li><a class="dropdown-item" href="#">Something else here</a></li>
					<li><a class="dropdown-item" href="#">Separated link</a></li>
				</ul>
				<input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Tokyo Consulting"> -->
				<select id="filter-branch" class="form-control font-size-18 text-black-50" onchange="javascript:filterBranchCompany()">
					<?php
					if (isset($company['companyName']) && $company['companyName'] != '') {
					?>
						<option value="<?= $company['companyId'] ?>"><?= $company['companyName'] ?></option>
					<?php
					}
					?>
					<option value="">Filter by Company</option>
					<?php
					if (isset($companies) && count($companies) > 0) {
						foreach ($companies as $com) : ?>
							<option value="<?= $com['companyId'] ?>"><?= $com['companyName'] ?></option>
					<?php
						endforeach;
					}
					?>
				</select>
			</div>
		</div>
	</div>
	<div class="col-12 mt-30">
		<div class="alert alert-secondary" role="alert">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12">
					<div class="col-12">
						<label class="form-label font-size-12 font-b">Company </label>
						<div class="col-12 font-b">
							<?php
							if (isset($companyId) && $companyId != '') {
							?>
								<input type="hidden" id="company" value="<?= $company['companyId'] ?>">
								<?= $company['companyName'] ?>
							<?php
							} else { ?>
								<select class="form-select" id="company">
									<option value="">Select Company</option>
									<?php
									if (isset($companies) && count($companies) > 0) {
										foreach ($companies as $c) : ?>
											<option value="<?= $c['companyId'] ?>"><?= $c['companyName'] ?></option>
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
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<div class="col-12">
						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label font-size-12 font-b"> Branch Name</label>
							<input type="text" class="form-control" id="branchName">
						</div>
					</div>
				</div>

				<!-- <div class="col-lg-3 col-md-6 col-12">
					<div class="col-12">
						<label for="exampleFormControlInput1" class="form-label"> Country</label>
						<select class="form-select" aria-label="Default select example">
							<option selected>Select Country</option>
							<option value="1">Bangladresh</option>
							<option value="2">China</option>
							<option value="3">Columbia</option>
						</select>
					</div>
				</div> -->
				<div class="col-lg-4 col-md-6 col-12">
					<div class="col-12">
						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label font-size-12 font-b"> Concerned business</label>
							<input type="text" class="form-control" id="description" placeholder="">
						</div>
					</div>
				</div>
				<div class="col-lg-1 col-md-2 col-12 text-end">
					<input type="hidden" id="branchId" value="">
					<button class="btn btn-success font-size-13 mt-33" id="create-branch">
						<i class="fa fa-plus" aria-hidden="true"></i> Create
					</button>
					<a class="btn btn-sm btn-warning font-size-12 mr-5 mt-35" id="update-branch" style="display:none;">
						<i class="fa fa-check" aria-hidden="true"></i>
					</a>
					<a class="btn btn-sm btn-danger font-size-12 mt-35" id="reset-branch" style="display:none;">
						<i class="fa fa-times" aria-hidden="true"></i>
					</a>
				</div>
			</div>
		</div>
		<div class="col-12">
			<div class="alert alert-branch" role="alert">
				<div class="row" id="company-branch">
					<?php
					if (isset($branches) && count($branches) > 0) {
						foreach ($branches as $branch) :
					?>
							<div class="col-lg-4 col-md-5 col-sm-3 col-12" id="branch-<?= $branch['branchId'] + 543 ?>">
								<div class="card" style="border: none;">
									<div class="card-body">
										<div class="row">
											<div class="col-3">
												<?php
												if ($branch["picture"] != '') {
												?>
													<img src="<?= Yii::$app->homeUrl ?><?= $branch["picture"] ?>" class="card-tcf">
												<?php
												} else { ?>
													<img src="<?= Yii::$app->homeUrl . 'image/userProfile.png' ?>" class="card-tcf">
												<?php
												}
												?>
											</div>
											<div class="col-9">
												<div class="row">
													<div class="col-12 font-size-14 font-b pr-0 pl-4">
														<?= $branch["branchName"] ?>
													</div>
													<div class="col-1 mt-5 text-start  pr-0 pl-4">
														<img src="<?= Yii::$app->homeUrl ?><?= $branch["flag"] ?>" class="card-round">
													</div>
													<div class="col-11 font-size-12 mt-10">
														<?= $branch["city"] ?>, <?= $branch["countryName"] ?>
													</div>
												</div>
												<div class="row">
													<div class="col-1  pr-0 pl-4 text-start">
														<img src="<?= Yii::$app->homeUrl ?>image/zoom.png" class="image-zoom">
													</div>
													<div class="col-7 font-size-12 pt-3">
														<?= $branch["description"] ?>
													</div>
													<div class="col-4 pb-0 pr-0  text-end pt-10">
														<a href="javascript:updateBranch(<?= $branch['branchId'] + 543 ?>)" class="btn btn-sm btn-outline-secondary font-size-12 mr-5">
															<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
														</a>
														<a href="javascript:deleteBranch(<?= $branch['branchId'] + 543 ?>)" class="btn btn-sm btn-outline-danger font-size-12">
															<i class="fa fa-trash" aria-hidden="true"></i>
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
					} else {
						?>
						<div class="col-12 text-center font-size-16">Branch not found.</div>

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
							<a href="<?= Yii::$app->homeUrl ?>setting/team/create/<?= ModelMaster::encodeParams(['companyId' => '']) ?>" style="text-decoration: none;">
								<div class="col-12 text-primary">
									Team
								</div>
								<div class="col-2 number-bold text-black">
									<?= $totalTeam
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
									<?= $totalEmployees
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