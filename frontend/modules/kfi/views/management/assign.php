<?php
$this->title = 'Assign KFI';
?>
<div class="col-12 mt-90">
	<div class="col-12">
		<i class="fa fa-tachometer font-size-20" aria-hidden="true"></i> <strong class="font-size-20"> Assign Management</strong>
	</div>
	<div class="col-12 mt-20">
		<?= $this->render('header_assign') ?>
		<div class="alert alert-white-5">
			<div class="row">
				<div class="col-lg-9 col-md-6 col-12">
					<div class="col-12">
						Key Financial Indicator
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<div class="col-12">
						<div class="input-group mb-3">
							<span class="input-group-text" id="basic-addon1"><i class="fa fa-filter" aria-hidden="true"></i></span>
							<select class="form-select font-size-13" aria-label="Default select example">
								<option selected value="">Month</option>
								<?php
								if (isset($months) && count($months) > 0) {
									foreach ($months as $value => $month) :
								?>
										<option value="<?= $value ?>"><?= $month ?></option>
								<?php
									endforeach;
								}
								?>
							</select>
							<select class="form-select font-size-13" aria-label="Default select example">
								<option selected value="">Status</option>
								<option value="1">Active</option>
								<option value="2">In Active</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="alert alert-light mt-20" role="alert">
				<table class="table table-striped">
					<thead class="table table-secondary">
						<tr class="secondary-setting">
							<th>KFI Contents</th>
							<th>Company</th>
							<th>Branch</th>
							<th>Assign Employee</th>
							<th>Target</th>
							<th>Month</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if (isset($kfis) && count($kfis) > 0) {
							foreach ($kfis as $kfiId => $kfi) :
						?>
								<tr style="border-bottom: 10px white !important;" id="kfi-<?= $kfiId ?>">
									<td>
										<?= $kfi["kfiName"] ?>
									</td>
									<td><?= $kfi["companyName"] ?></td>
									<td>

										<div class="row">
											<div class="col-6 badge rounded-pill bg-setting">
												<img class="Image-Description" src="<?= Yii::$app->homeUrl . $kfi["flag"] ?>">
												<button id="hs-dropdown-avatar-more" class="number-rounded">
													<span class="font-medium leading-none"><?= count($kfi["kfiBranch"]) ?></span>
												</button>
											</div>
											<div class="col-3 dashedshare mt-2 ml-2" data-bs-toggle="modal" data-bs-target="#modallink">
												<i class="fa fa-share-alt share-alt-setting" aria-hidden="true"></i>
											</div>
										</div>
									</td>
									<td>
										<div class="row">

											<div class="col-5 badge rounded-pill bg-setting text-start">
												<img class="Image-Description" src="<?= Yii::$app->homeUrl ?>image/employee1.png">
												<img class="Image-Description" src="<?= Yii::$app->homeUrl ?>image/employee2.png">
												<button id="hs-dropdown-avatar-more" class="number-rounded">
													<span class="font-medium leading-none">5</span>
												</button>
											</div>

											<div class="col-3 dashedshare mt-2 ml-5">
												<i class="fa fa-user share-alt-setting" aria-hidden="true"></i>
											</div>
											<div class="col-3">
												<i class="fa fa-plus-circle circle5" data-bs-target="#exampleModalemployeeSearch" data-bs-toggle="modal"></i>
											</div>
										</div>
									</td>
									<td class="text-start"><?= $kfi["code"] ?> <?= number_format($kfi["target"], 2) ?></td>
									<td><?= $kfi["month"] ?></td>
									<td class="<?= $kfi["status"] == 1 ? "text-primary" : "text-danger" ?>">
										<?= $kfi["status"] == 1 ? "Active" : "In Active" ?>
									</td>

								</tr>
						<?php
							endforeach;
						}
						?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-12 navigation-next">
		<nav aria-label="Page navigation example">
			<ul class="pagination">
				<li class="page-item"><a class="page-link page-navigation" href="#"><i class="fa fa-chevron-left" aria-hidden="true"></i> Previous</a></li>
				<li class="page-item"><a class="page-link page-navigation" href="#">1</a></li>
				<li class="page-item"><a class="page-link page-navigation" href="#">2</a></li>
				<li class="page-item"><a class="page-link page-navigation" href="#">3</a></li>
				<li class="page-item"><a class="page-link page-navigation" href="#">Next <i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
			</ul>
		</nav>
	</div>
</div>

<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
	<div class="modal-dialog modal-sm dialog-allshow">
		<div class="modal-content">
			<div class="mcontainer">
				<div id="exampleModalToggleLabel">
					<div class="row">
						<div class="col-lg-1 col-12 pl-50">
							<div class="col-12 ">
								<div class="Resolve-c"><i class="fa fa-building ml-8 font-size-11" aria-hidden="true"></i></div>
								<span class="company-c"> </span>
							</div>
						</div>
						<div class="col-lg-4 col-12 mt-20 pl-30">Company</div>
						<div class="col-lg-1 col-12">
							<div class="col-12">
								<div class="Resolve-c"><i class="fa fa-share-alt ml-8 font-size-11" aria-hidden="true"></i></i></div>
								<span class="company-c"> </span>
							</div>
						</div>
						<div class="col-lg-4 col-12 mt-20 pl-30">Branch</div>
					</div>
					<hr>
				</div>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-4 text-end">
						<div class="col-12">
							<img src="<?= Yii::$app->homeUrl ?>image/logo-tcg.png" class="company-image2">
						</div>
					</div>
					<div class="col-lg-8">
						<div class="col-12">
							<div class="font-size-16"> TCF</div>
						</div>
						<div class="col-12">
							<img src="<?= Yii::$app->homeUrl ?>image/Flag-Turkey.png" class="image-izmir">
							<span class="font-size-14">Izmir, Turkey</span>
						</div>
					</div>
					<div class="mt-20"></div>
					<div class="col-lg-4 text-end">
						<div class="col-12">
							<img src="<?= Yii::$app->homeUrl ?>image/Flag-Brazil.png" class="company-image2">
						</div>
					</div>
					<div class="col-lg-8">
						<div class="col-12">
							<div class="font-size-16"> TCFBD</div>
						</div>
						<div class="col-12">
							<img src="<?= Yii::$app->homeUrl ?>image/Flag-Turkey.png" class="image-izmir">
							<span class="font-size-14">Izmir, Turkey</span>
						</div>
					</div>
					<div class="mt-20"></div>
					<div class="col-lg-4 text-end">
						<div class="col-12">
							<img src="<?= Yii::$app->homeUrl ?>image/logo-hrvc.png" class="company-image2">
						</div>
					</div>
					<div class="col-lg-8">
						<div class="col-12">
							<div class="font-size-16"> TCH</div>
						</div>
						<div class="col-12">
							<img src="<?= Yii::$app->homeUrl ?>image/Flag-Turkey.png" class="image-izmir">
							<span class="font-size-14">Izmir, Turkey</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modallink" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modallink" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered dialog-allshow1">
		<div class="modal-content header-company">
			<div class="container">
				<div id="modallink">
					<div class="row">
						<div class="col-lg-1 col-12 pl-50">
							<div class="col-12 ">
								<div class="Resolve-c"><i class="fa fa-building ml-8 font-size-11" aria-hidden="true"></i></div>
								<span class="company-c"> </span>
							</div>
						</div>
						<div class="col-lg-4 col-12 mt-20 pl-30">Company</div>
						<div class="col-lg-1 col-12">
							<div class="col-12">
								<div class="Resolve-c"><i class="fa fa-share-alt ml-8 font-size-11" aria-hidden="true"></i></i></div>
								<span class="company-c"> </span>
							</div>
						</div>
						<div class="col-lg-4 col-12 mt-20">Branch</div>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="card card-company">
					<div class="row">
						<div class="col-lg-5 col-12">
							<div class="col-12">
								<div class="form-check mt-10">
									<input class="form-check-input" type="checkbox" value="" id="flex1">
									<label class="form-check-label" for="flexCheckDefault">
										&nbsp;&nbsp; <img src="<?= Yii::$app->homeUrl ?>image/logo-hrvc.png" class="company-image3">
										<span class="font-size-10">HRVC</span>
									</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-check mt-15">
									<input class="form-check-input" type="checkbox" value="" id="flex2">
									<label class="form-check-label" for="flexCheckDefault">
										&nbsp;&nbsp; <img src="<?= Yii::$app->homeUrl ?>image/logo-tcg.png" class="company-image3">
										<span class="font-size-10">TCG</span>
									</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-check mt-15">
									<input class="form-check-input" type="checkbox" value="" id="flex3">
									<label class="form-check-label" for="flexCheckDefault">
										&nbsp;&nbsp; <img src="<?= Yii::$app->homeUrl ?>image/Roof.png" class="company-image3">
										<span class="font-size-10">TCF</span>
									</label>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-12">
							<div class="col-12 mt-5">
								<select class="form-select font-size-13 selectpicker show-tick" aria-label="Default select example">
									<option selected value="">Select Branch</option>
									<option value="">All</option>
									<option value="">Two</option>
									<option value="">Three</option>
								</select>
							</div>
							<div class="col-12 mt-15">
								<select class="form-select font-size-13 selectpicker show-tick" aria-label="Default select example">
									<option selected value="">Select Branch</option>
									<option value="">One</option>
									<option value="">Two</option>
									<option value="">Three</option>
								</select>
							</div>
							<div class="col-12 mt-15">
								<select class="form-select font-size-13 selectpicker show-tick" aria-label="Default select example">
									<option selected value="">Select Branch</option>
									<option value="1">One</option>
									<option value="2">Two</option>
									<option value="3">Three</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-2">
						<div class="Resolve" data-bs-dismiss="modal">Resolve</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="exampleModalemployeeSearch" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalemployeeSearch" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered dialog-allshow2">
		<div class="modal-content">
			<div class="container">
				<div id="exampleModalemployeeSearch">
					<div class="row">
						<div class="col-lg-1 col-12 pl-30">
							<div class="col-12 ">
								<div class="Resolve-c"><i class="fa fa-user ml-8 font-size-11" aria-hidden="true"></i></div>
								<span class="company-c"> </span>
							</div>
						</div>
						<div class="col-lg-4 col-12 mt-20 pl-30 Employees-0"> Employees</div>
						<div class="col-lg-6 col-12 mt-20">
							<div class="col-12">
								<form class="d-flex">
									<input class="form-control me-2 shadow bg-body rounded pl-40" type="search" placeholder="Search" aria-label="Search">
									<span type="submit" class="submit-search"> <i class="fa fa-search" aria-hidden="true"></i></i></span>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="card card-company">
					<div class="row">
						<div class="col-lg-5 col-12">
							<div class="col-12">
								<div class="form-check mt-10">
									<input class="form-check-input" type="checkbox" value="" id="">
									<label class="form-check-label" for="flexCheckDefault">
										&nbsp;&nbsp; <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="company-image3">
										<span class="font-size-11">Ehsan </span>
									</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-check mt-15">
									<input class="form-check-input" type="checkbox" value="" id="">
									<label class="form-check-label" for="flexCheckDefault">
										&nbsp;&nbsp; <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="company-image3">
										<span class="font-size-11">Amir Vai</span>
									</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-check mt-15">
									<input class="form-check-input" type="checkbox" value="" id="">
									<label class="form-check-label" for="flexCheckDefault">
										&nbsp;&nbsp; <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="company-image3">
										<span class="font-size-11">Ehsan Vai</span>
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="col-2">
						<div class="Resolve" data-bs-dismiss="modal">Resolve</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>