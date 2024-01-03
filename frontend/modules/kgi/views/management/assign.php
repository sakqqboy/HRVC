<?php

use common\models\ModelMaster;

$this->title = 'Assign KGI';
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
						Key Goal Indicator
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<div class="col-12">
						<div class="input-group mb-3">
							<span class="input-group-text" id="basic-addon1" onclick="javascript:searchAssignKgi()">
								<i class="fa fa-filter" aria-hidden="true"></i>
							</span>
							<select class="form-select font-size-13" aria-label="Default select example" id="kgiMonthFilter">
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

						</div>
					</div>
				</div>
				<div class="col-col-12">
					<a href="<?= Yii::$app->homeUrl ?>kgi/management/wait-approve" class="no-underline text-primary">
						Wait for approve KGI
					</a>
				</div>
			</div>
			<div class="alert alert-light mt-10" role="alert">
				<table class="table table-striped">
					<thead class="table table-secondary">
						<tr class="secondary-setting">
							<th>KGI Contents</th>
							<th>Company</th>
							<th>Branch</th>
							<th>Employee</th>
							<!-- <th>Team</th> -->
							<th>Target</th>
							<th>Month</th>
							<th>KFI</th>
							<th>KPI</th>
							<th class="text-center font-size-14">
								<i class="fa fa-cog" aria-hidden="true"></i>
							</th>
						</tr>
					</thead>
					<tbody id="assign-search-result">
						<?php
						if (isset($kgis) && count($kgis) > 0) {
							foreach ($kgis as $kgiId => $kgi) :
						?>
								<tr style="border-bottom: 10px white !important;" id="kgi-<?= $kgiId ?>">
									<td>
										<?= $kgi["kgiName"] ?>
									</td>
									<td><?= $kgi["companyName"] ?></td>
									<td>

										<div class="row">
											<div class="col-6 badge rounded-pill bg-setting">
												<img class="Image-Description" src="<?= Yii::$app->homeUrl . $kgi["flag"] ?>">
												<button id="hs-dropdown-avatar-more" class="number-rounded">
													<span class="font-medium leading-none" id="total-branch-<?= $kgiId ?>"><?= count($kgi["kgiBranch"]) ?></span>
												</button>
											</div>
											<div class="col-3 dashedshare mt-2 ml-2" onclick="javascript:kgiCompanyBranch(<?= $kgi['companyId'] ?>,<?= $kgiId ?>)" data-bs-toggle="modal" data-bs-target="#modalBranch">
												<i class="fa fa-share-alt share-alt-setting" aria-hidden="true"></i>
											</div>
										</div>
									</td>
									<td>
										<div class="row">
											<div class="col-5 badge rounded-pill bg-setting text-start">
												<?php
												if (isset($kgi["kgiEmployee"]) && count($kgi["kgiEmployee"]) > 0) {
													$e = 0;
													foreach ($kgi["kgiEmployee"] as $employeeId => $emPic) :
														if ($e < 2) { ?>
															<img class="Image-Description" src="<?= Yii::$app->homeUrl . $emPic ?>">
												<?php
														}
														$e++;
													endforeach;
												}
												?>
												<button id="hs-dropdown-avatar-more" class="number-rounded">
													<span class="font-medium leading-none" id="totalEmployee-<?= $kgiId ?>"><?= count($kgi["kgiEmployee"]) ?></span>
												</button>
											</div>

											<div class="col-3 dashedshare mt-2 ml-5" data-bs-target="#kgi-employee-modal" data-bs-toggle="modal" onclick="javascript:kgiCompanyEmployee(<?= $kgiId ?>)">
												<i class="fa fa-user share-alt-setting" aria-hidden="true"></i>
												<i class="fa fa-plus-circle circle5"></i>
											</div>
											<div class="col-1">
												<!-- <i class="fa fa-plus-circle circle5"></i> -->
											</div>
										</div>
									</td>
									<td class="text-start"><?= $kgi["code"] ?> <?= $kgi["targetAmount"] ?></td>
									<td><?= $kgi["month"] ?></td>
									<td>
										<a href="<?= Yii::$app->homeUrl ?>kgi/management/kgi-kfi/<?= ModelMaster::encodeParams(['kgiId' => $kgiId]) ?>" class="no-underline-black">
											<b><?= $kgi["countKgiHasKfi"] ?></b>
										</a>
									</td>
									<td>
										<a href="<?= Yii::$app->homeUrl ?>kgi/management/kgi-kpi/<?= ModelMaster::encodeParams(['kgiId' => $kgiId]) ?>" class="no-underline-black">
											<b><?= $kgi["countKgiHasKpi"] ?></b>
										</a>
									</td>
									<td class="text-end">
										<a href="<?= Yii::$app->homeUrl ?>kgi/kgi-team/kgi-team-setting/<?= ModelMaster::encodeParams(['kgiId' => $kgiId]) ?>" class="btn btn-sm btn-primary mr-3" title="Team KGI setting">
											<i class="fa fa-users" aria-hidden="true"></i>
										</a>
										<a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/indivisual-setting/<?= ModelMaster::encodeParams(['kgiId' => $kgiId]) ?>" class="btn btn-sm btn-info text-light" title="Indivisual KGI setting">
											<i class="fa fa-user" aria-hidden="true"></i>
										</a>
									</td>
									<?php
									// if ($kfi["active"] == 1) { 
									?>
									<!-- <a href="javascript:changeKfiStatus(0,<?php // $kfiId 
																?>)" class="btn btn-primary btn-sm font-size-12">Active</a> -->
									<?php
									//} else { 
									?>
									<!-- <a href="javascript:changeKfiStatus(1,<?php // $kfiId 
																?>)" class="btn btn-danger btn-sm font-size-12">In Active</a> -->
									<?php
									// }
									?>
									<!-- </td> -->
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