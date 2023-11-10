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
											<div class="col-3 dashedshare mt-2 ml-2" onclick="javascript:kfiCompanyBranch(<?= $kfi['companyId'] ?>,<?= $kfiId ?>)" data-bs-toggle="modal" data-bs-target="#modalBranch">
												<i class="fa fa-share-alt share-alt-setting" aria-hidden="true"></i>
											</div>
										</div>
									</td>
									<td>
										<div class="row">

											<div class="col-5 badge rounded-pill bg-setting text-start">
												<?php
												if (isset($kfi["kfiEmployee"]) && count($kfi["kfiEmployee"]) > 0) {
													$e = 0;
													foreach ($kfi["kfiEmployee"] as $employeeId => $emPic) :
														if ($e < 2) { ?>
															<img class="Image-Description" src="<?= Yii::$app->homeUrl . $emPic ?>">
												<?php
														}
													endforeach;
												}
												?>
												<button id="hs-dropdown-avatar-more" class="number-rounded">
													<span class="font-medium leading-none"><?= count($kfi["kfiEmployee"]) ?></span>
												</button>
											</div>

											<div class="col-3 dashedshare mt-2 ml-5" data-bs-target="#exampleModalemployeeSearch" data-bs-toggle="modal">
												<i class="fa fa-user share-alt-setting" aria-hidden="true"></i>
												<i class="fa fa-plus-circle circle5"></i>
											</div>
											<div class="col-1">
												<!-- <i class="fa fa-plus-circle circle5"></i> -->
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
<?= $this->render('modal_branch') ?>

<?= $this->render('modal_employee') ?>