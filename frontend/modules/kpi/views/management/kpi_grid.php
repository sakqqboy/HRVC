<?php

use yii\bootstrap5\ActiveForm;

$this->title = 'KPI Grid View';
?>

<div class="col-12 mt-90">
	<div class="col-12">
		<i class="fa fa-tachometer font-size-20" aria-hidden="true"></i> <strong class="font-size-20"> Performance Indicator Matrices (PIM)</strong>
	</div>
	<div class="col-12 mt-20">
		<?= $this->render('header_filter') ?>

		<div class="alert alert-white-4">
			<div class="row">
				<div class="col-lg-4 col-md-6 col-12 key1">
					<div class="row">
						<div class="col-6 key1">
							Key Performance Indicators
						</div>
						<div class="col-6">
							<button type="button" class="btn btn-primary font-size-14" data-bs-toggle="modal" data-bs-target="#creat-kpi"><i class="fa fa-magic" aria-hidden="true"></i> Create New kpi</button>
						</div>
					</div>
				</div>
				<div class="col-lg-5 col-md-12 col-12 New-KFI">
					<div class="col-12">
						<div class="input-group">
							<span class="input-group-text"><i class="fa fa-filter" aria-hidden="true"></i></span>
							<select class="form-select font-size-13" aria-label="Example select">
								<option selected value="">Company</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
							</select>
							<select class="form-select font-size-13" aria-label="Example select">
								<option selected value="">Branch</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
							</select>
							<select class="form-select font-size-13" aria-label="Example select">
								<option selected value="">Month</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
							</select>
							<select class="form-select font-size-13" aria-label="Example select">
								<option selected value="">Type</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
							</select>
							<select class="form-select font-size-13" aria-label="Example select">
								<option selected value="">Status</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-12 New-date">
					<div class="row">
						<div class="col-8">
							<div class="input-group">
								<label class="input-group-text font-size-13" for="">Date</label>
								<input type="date" class="form-control font-size-13" name="birthday" id="">
							</div>
						</div>
						<div class="col-4 new-light-4">
							<div class="btn-group" role="group" aria-label="Basic example">
								<a href="<?= Yii::$app->homeUrl ?>kpi/management/index" class="btn btn-outline-primary font-size-13">
									<i class="fa fa-list-ul" aria-hidden="true"></i>
								</a>
								<a href="<?= Yii::$app->homeUrl ?>kpi/management/grid" class="btn btn-primary  font-size-13">
									<i class="fa fa-th-large" aria-hidden="true"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
				<div class="tab-content" id="pills-tabContent">
					<div class="tab-pane fade show active" id="pills-Group" role="tabpanel" aria-labelledby="pills-Group-tab">
						<div class="card example-5 scrollbar-ripe-malinka">
							<?php
							if (count($kpis) > 0) {
								foreach ($kpis as $kpiId => $kpi) :
							?>
									<div class="col-12 card card-radius" id="kpi-<?= $kpiId ?>">
										<div class="row">
											<div class="col-lg-4 col-md-6 col-12 clients-employee">
												<i class="fa fa-flag" aria-hidden="true"></i> <?= $kpi["kpiName"] ?>
											</div>
											<div class="col-lg-1 col-md-6 col-12">
												<span class="badge rounded-pill <?= $kpi['status'] == 4 ? 'bg-success' : 'bg-warning text-dark' ?> "> <?= $kpi['status'] == 4 ? 'Completed' : 'On process' ?></span>
											</div>
											<div class="col-lg-1 col-md-6 col-12 month-feb">
												<?= $kpi["month"] ?>
											</div>
											<div class="col-lg-1 col-md-6 col-12">
												<span class="badge rounded-pill bg-white">
													<div class="flex mb-5 -space-x-4">
														<?php
														if (isset($kpi["employee"]) && count($kpi["employee"]) > 0) {
															$e = 1;
															foreach ($kpi["employee"] as $emp) : ?>
																<img class="image-grid" src="<?= Yii::$app->homeUrl . $emp ?>">
														<?php
																if ($e == 3) {
																	break;
																}
																$e++;
															endforeach;
														}
														?>
														<a class="no-underline-black ml-2 mt-3" href="#"><?= count($kpi["employee"]) ?></a>
													</div>
												</span>
											</div>
											<div class="col-lg-1 col-md-6 col-12 text-end">
												<span class="badge rounded-pill bg-bsc"><i class="fa fa-users" aria-hidden="true"></i> <?= $kpi["countTeam"] ?></span>
											</div>
											<div class="col-lg-2 col-md-6 col-12">
												<div class="flex-tokyo">
													<?= $kpi["companyName"] ?>
												</div>
												<p class="tokyo-ima"> <img src="<?= Yii::$app->homeUrl ?><?= $kpi["flag"] ?>" class="image-flex"> <?= $kpi["branch"] ?>, <?= $kpi["countryName"] ?></p>
											</div>
											<div class="col-lg-2 col-md-6 col-12 text-end">
												<button class="btn btn-outline-secondary font-size-10" data-bs-toggle="modal" data-bs-target="#kpi-view" onclick="javascript:kpiHistory(<?= $kpiId ?>)">
													<i class="fa fa-eye" aria-hidden="true"></i>
												</button>
												<button class="btn btn-outline-danger font-size-10" data-bs-toggle="modal" data-bs-target="#delete-kpi" onclick="javascript:prepareDeleteKpi(<?= $kpiId ?>)">
													<i class="fa fa-trash-o" aria-hidden="true"></i>
												</button>
											</div>
											<div class="col-lg-2 col-md-6 col-12">
												<div class="col-12">
													<span class="badge rounded-pill slds-badge">
														Deadline <span class="text-dark font-size-10">: <?= $kpi["periodCheck"] ?></span>
													</span>
												</div>
												<div class="col-12 top-teamcontent">
													Team Content
												</div>
												<div class="col-12 font-size-12 pt-10">
													This is a sample kpi content
												</div>
											</div>
											<div class="col-lg-2 col-md-6 col-12 sample-bordersolid">
												<div class="row">
													<div class="col-md-6">
														<div class="col-12 font-size-12 pt-5">
															Quant Ratio
														</div>
														<div class="col-12 Quality-diamond">
															<i class="fa fa-diamond" aria-hidden="true"></i> <?= $kpi["quantRatio"] == 1 ? 'Quantity' : 'Quality' ?>
														</div>
														<div class="col-12 font-size-10 pt-40" style="width: 10rem;">
															Update Interval
														</div>
														<div class="col-12 Quality-monthly0">
															<?= $kpi["unit"] ?>
														</div>
													</div>
													<div class="col-md-6 mt-25 text-center">
														<div class="col-12 font-size-12">
															Priority
														</div>
														<div class="col-12 mt-5 pl-13">
															<div class="circle-update text-center"><?= $kpi["priority"] ?></div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-3 col-md-6 col-12 progress-bordersolid">
												<div class="row">
													<div class="col-md-4">
														<div class="col-12 target-progress">
															<i class="fa fa-bullseye" aria-hidden="true"></i> Target
														</div>
														<div class="col-12 target-million">
															<?= $kpi["targetAmount"] ?>
														</div>
													</div>
													<div class="col-md-4">
														<div class="col-12 target-plush">
															<?= $kpi["code"] ?>
														</div>
													</div>
													<div class="col-md-4">
														<div class="col-12 target-progress">
															Result <i class="fa fa-trophy" aria-hidden="true"></i>
														</div>
														<div class="col-12 target-million">
															<?= $kpi["result"] ?>
														</div>
													</div>
												</div>
												<div class="col-12 mt-20">
													<div class="progress">
														<div class="progress-bar" style="width:<?= $kpi['ratio'] ?>%;"></div>
														<span class="badge rounded-pill  pro-load2"><?= $kpi['ratio'] ?>%</span>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="col-12 refresh0">
															<i class="fa fa-refresh mr-5" aria-hidden="true"></i> Latest Update
														</div>
														<div class="col-12 font-size-12 pt-5" style="font-weight: 700;">
															<?= $kpi['periodCheck'] ?>
														</div>
													</div>
													<div class="col-md-6">
														<div class="col-12 pencil-nextupdate" data-bs-toggle="modal" data-bs-target="#update-kpi-modal" onclick="javascript:updateKpi(<?= $kpiId ?>)">
															Next Update <i class="fa fa-pencil-square-o ml-5" aria-hidden="true"></i>
														</div>
														<div class="col-12 font-size-12 pt-5 text-end" style="font-weight: 700;">
															<?= $kpi['nextCheck'] ?>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-5 col-md-6 col-12 card-bordersolid">
												<div class="row mt-20">
													<div class="col-md-6">
														<div class="col-12 dashed1" style="word-wrap: break-word;">
															<strong class="text-dark font-size-13"> Issue</strong>
															<p class="font-size-11 text-dark"><?= $kpi["issue"] ?></p>
														</div>
													</div>
													<div class="col-md-6">
														<div class="col-12 dashed1" style="word-wrap: break-word;">
															<strong class="text-dark font-size-13"> Solution</strong>
															<p class="font-size-11 text-dark"><?= $kpi["solution"] ?></p>
														</div>
													</div>
													<div class="col-12 text-end font-size-12 mt-5">
														<span data-bs-toggle="modal" data-bs-target="#kpi-issue" onclick="javascript:showKpiComment(<?= $kpiId ?>)" style="cursor: pointer;" class="text-primary">
															<i class="fa fa-eye mr-5" aria-hidden="true"></i>
															See more Issue & solution
														</span>
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
			</ul>
		</div>
	</div>

</div>
<?= $this->render('modal_view') ?>

<input type="hidden" value="create" id="acType">
<?php
$form = ActiveForm::begin([
	'id' => 'create-kpi',
	'method' => 'post',
	'options' => [
		'enctype' => 'multipart/form-data',
	],
	'action' => Yii::$app->homeUrl . 'kpi/management/create-kpi'

]); ?>
<?= $this->render('modal_create', [
	"units" => $units,
	"companies" => $companies,
	"months" => $months
]) ?>
<?php ActiveForm::end(); ?>

<?php
$form = ActiveForm::begin([
	'id' => 'update-kpi',
	'method' => 'post',
	'options' => [
		'enctype' => 'multipart/form-data',
	],
	'action' => Yii::$app->homeUrl . 'kpi/management/update-kpi'

]); ?>
<?= $this->render('modal_update', [
	"units" => $units,
	"companies" => $companies,
	"months" => $months
]) ?>
<?php ActiveForm::end(); ?>
<?= $this->render('modal_delete') ?>
<?= $this->render('modal_issue') ?>
<!-- end -->