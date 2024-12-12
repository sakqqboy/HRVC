<?php

use common\models\ModelMaster;

$this->title = Yii::t('app', 'Assign KFI');
?>
<div class="col-12 mt-90">
	<div class="col-12">
		<i class="fa fa-tachometer font-size-20" aria-hidden="true"></i> <strong class="font-size-20"> <?= Yii::t('app', 'Assign Management') ?></strong>
	</div>
	<div class="col-12 mt-20">
		<?= $this->render('header_assign') ?>
		<div class="alert alert-white-5">
			<div class="row">
				<div class="col-lg-9 col-md-6 col-12">
					<div class="col-12">
						<?= Yii::t('app', 'Key Financial Indicator') ?>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<div class="col-12">
						<div class="input-group mb-3">
							<span class="input-group-text" id="basic-addon1" onclick="javascript:searchAssignKfi()">
								<i class="fa fa-filter" aria-hidden="true"></i>
							</span>
							<select class="form-select font-size-13" aria-label="Default select example" id="kfiMonthFilter">
								<option selected value=""><?= Yii::t('app', 'Month') ?></option>
								<?php
								if (isset($months) && count($months) > 0) {
									foreach ($months as $value => $month) :
								?>
										<option value="<?= $value ?>"><?= Yii::t('app', $month) ?></option>
								<?php
									endforeach;
								}
								?>
							</select>
							<select class="form-select font-size-13" aria-label="Default select example" id="kfiStatusFilter">
								<option selected value=""><?= Yii::t('app', 'Status') ?></option>
								<option value="1"><?= Yii::t('app', 'Active') ?></option>
								<option value="2"><?= Yii::t('app', 'In Active') ?></option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="alert alert-light mt-20" role="alert">
				<table class="table table-striped">
					<thead class="table table-secondary">
						<tr class="secondary-setting">
							<th><?= Yii::t('app', 'KFI Contents') ?></th>
							<th><?= Yii::t('app', 'Company') ?></th>
							<th><?= Yii::t('app', 'Branch') ?></th>
							<th><?= Yii::t('app', 'Assign Employee') ?></th>
							<th><?= Yii::t('app', 'Target') ?></th>
							<th><?= Yii::t('app', 'Month') ?></th>
							<th><?= Yii::t('app', 'KGI') ?></th>
							<!-- <th>Status</th> -->
						</tr>
					</thead>
					<tbody id="assign-search-result">
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
													<span class="font-medium leading-none" id="total-branch-<?= $kfiId ?>"><?= count($kfi["kfiBranch"]) ?></span>
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
														$e++;
													endforeach;
												}
												?>
												<button id="hs-dropdown-avatar-more" class="number-rounded">
													<span class="font-medium leading-none" id="totalEmployee-<?= $kfiId ?>"><?= count($kfi["kfiEmployee"]) ?></span>
												</button>
											</div>

											<div class="col-3 dashedshare mt-2 ml-5" data-bs-target="#kfi-employee-modal" data-bs-toggle="modal" onclick="javascript:kfiCompanyEmployee(<?= $kfiId ?>)">
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
									<td>
										<a href="<?= Yii::$app->homeUrl ?>kfi/management/kfi-kgi/<?= ModelMaster::encodeParams(['kfiId' => $kfiId]) ?>" class="no-underline-black">
											<b><?= $kfi["countKfiHasKgi"] ?></b>
										</a>
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
				<li class="page-item"><a class="page-link page-navigation" href="#"><i class="fa fa-chevron-left" aria-hidden="true"></i> <?= Yii::t('app', 'Previous') ?></a></li>
				<li class="page-item"><a class="page-link page-navigation" href="#">1</a></li>
				<li class="page-item"><a class="page-link page-navigation" href="#">2</a></li>
				<li class="page-item"><a class="page-link page-navigation" href="#">3</a></li>
				<li class="page-item"><a class="page-link page-navigation" href="#"><?= Yii::t('app', 'Next') ?> <i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
			</ul>
		</nav>
	</div>
</div>
<?= $this->render('modal_branch') ?>

<?= $this->render('modal_employee') ?>