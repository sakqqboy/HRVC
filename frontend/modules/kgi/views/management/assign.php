<?php

use common\models\ModelMaster;

$this->title = 'Assign KGI';
?>
<div class="col-12 mt-90">
	<div class="col-12">
		<i class="fa fa-tachometer font-size-20" aria-hidden="true"></i> <strong class="font-size-20"> <?= Yii::t('app', 'Assign Management') ?></strong>
	</div>
	<div class="col-12 mt-20">
		<?= $this->render('header_assign') ?>
		<div class="alert alert-white-5">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-12">
					<div class="col-12">
						<?= Yii::t('app', 'Key Goal Indicator') ?>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-12">
					<div class="col-12">
						<div class="input-group mb-3">
							<span class="input-group-text" id="basic-addon1" onclick="javascript:searchAssignKgi()" style="cursor: pointer;">
								<i class="fa fa-filter" aria-hidden="true"></i>
							</span>
							<select class="form-select font-size-13" aria-label="Default select example" id="kgiMonthFilter">
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
							<select class="form-select font-size-13" aria-label="Default select example" id="kgiYearFilter">
								<option selected value=""><?= Yii::t('app', 'Year') ?></option>
								<option value=""><?= Yii::t('app', 'Year') ?></option>
								<?php
								$year = 2022;
								$i = 1;
								while ($i < 20) {
								?>
									<option value="<?= $year ?>"><?= $year ?></option>
								<?php
									$year += 1;
									$i++;
								}
								?>
							</select>
						</div>
					</div>
				</div>

				<div class="col-col-12">
					<a href="<?= Yii::$app->homeUrl ?>kgi/management/wait-approve" class="no-underline text-primary">
						<?= Yii::t('app', 'Wait for approve KGI') ?>
					</a>
				</div>
			</div>
			<div class="alert alert-light mt-10">
				<table class="table table-striped ">
					<thead class="table table-secondary">
						<tr class="secondary-setting">
							<th><?= Yii::t('app', 'KGI Contents') ?></th>
							<th class="text-center"><?= Yii::t('app', 'Branch') ?></th>
							<th class="text-center"><?= Yii::t('app', 'Team') ?></th>
							<th class="text-center"><?= Yii::t('app', 'Employee') ?></th>
							<th class="text-center"><?= Yii::t('app', 'Targe') ?>t</th>
							<th class="text-center"><?= Yii::t('app', 'Month') ?></th>
							<th class="text-center"><?= Yii::t('app', 'KFI') ?></th>
							<th class="text-center"><?= Yii::t('app', 'KPI') ?></th>
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
								<tr class="font-size-12 " id="kgi-<?= $kgiId ?>">
									<td>
										<?= $kgi["kgiName"] ?>
									</td>
									<td>
										<div class="col-12">
											<div class="row">
												<div class="col-1"></div>
												<div class="col-6 badge rounded-pill bg-setting">
													<img class="Image-Description" src="<?= Yii::$app->homeUrl . $kgi["flag"] ?>">
													<button id="hs-dropdown-avatar-more" class="number-rounded">
														<span class="font-medium leading-none" id="total-branch-<?= $kgiId ?>"><?= count($kgi["kgiBranch"]) ?></span>
													</button>
												</div>
												<div class="col-5 dashedshare mt-2 ml-7" onclick="javascript:kgiCompanyBranch(<?= $kgi['companyId'] ?>,<?= $kgiId ?>)" data-bs-toggle="modal" data-bs-target="#modalBranch">
													<i class="fa fa-share-alt share-alt-setting" aria-hidden="true"></i>
												</div>
											</div>
										</div>
									</td>
									<td class="text-center">
										<div class="row">
											<div class="col-1">
											</div>
											<div class="col-3  mt-2 text-center pr-25 font-size-11">
												<div class="text-center pt-3" id="totalTeam-<?= $kgiId ?>" style="width:25px;height:25px;border-radius:100%;border: 1px solid rgb(58, 158, 230);">
													<?= $kgi["countTeam"] ?>
												</div>
											</div>
											<div class="col-3 dashedshare mt-2 ml-5" data-bs-target="#assign-kgi-team" data-bs-toggle="modal" onclick="javascript:assignKgiTeam(<?= $kgiId ?>)">
												<i class="fa fa-users share-alt-setting" aria-hidden="true"></i>
												<i class="fa fa-plus-circle circle5"></i>
											</div>
										</div>
									</td>
									<td>
										<div class="row">
											<div class="col-1">
											</div>
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
											<div class="col-3 dashedshare mt-2 ml-10" data-bs-target="#kgi-employee-modal" data-bs-toggle="modal" onclick="javascript:kgiCompanyEmployee(<?= $kgiId ?>)">
												<i class="fa fa-user share-alt-setting" aria-hidden="true"></i>
												<i class="fa fa-plus-circle circle5"></i>
											</div>

										</div>
									</td>
									<td class="text-end"><?= $kgi["code"] ?> <?= $kgi["targetAmount"] ?></td>
									<td class="text-center"><?= $kgi["monthShort"] ?></td>
									<td class="text-center">
										<a href="<?= Yii::$app->homeUrl ?>kgi/management/kgi-kfi/<?= ModelMaster::encodeParams(['kgiId' => $kgiId]) ?>" class="no-underline-black">
											<b><?= $kgi["countKgiHasKfi"] ?></b>
										</a>
									</td>
									<td class="text-center">
										<a href="<?= Yii::$app->homeUrl ?>kgi/management/kgi-kpi/<?= ModelMaster::encodeParams(['kgiId' => $kgiId]) ?>" class="no-underline-black">
											<b><?= $kgi["countKgiHasKpi"] ?></b>
										</a>
									</td>
									<td class="text-end">
										<a href="<?= Yii::$app->homeUrl ?>kgi/kgi-team/kgi-team-setting/<?= ModelMaster::encodeParams(['kgiId' => $kgiId]) ?>" class="btn btn-sm btn-primary mr-3 font-size-10" title="Team KGI setting">
											<i class="fa fa-users" aria-hidden="true"></i>
										</a>
										<a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/indivisual-setting/<?= ModelMaster::encodeParams(['kgiId' => $kgiId]) ?>" class="btn btn-sm btn-info text-light font-size-10" title="Indivisual KGI setting">
											<i class="fa fa-user" aria-hidden="true"></i>
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

</div>
<?= $this->render('modal_branch') ?>
<?= $this->render('modal_employee') ?>
<?= $this->render('modal_assign_kgi_team') ?>