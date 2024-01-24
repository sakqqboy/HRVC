<?php

use yii\bootstrap5\ActiveForm;

$this->title = 'KPI Grid View';
?>

<div class="col-12 mt-70">
	<div class="col-12">
		<i class="fa fa-tachometer font-size-18" aria-hidden="true"></i> <strong class="font-size-18"> Performance Indicator Matrices (PIM)</strong>
	</div>
	<div class="col-12 mt-10">
		<?= $this->render('header_filter') ?>

		<div class="alert alert-white-4 mt-10">
			<div class="row">
				<div class="col-lg-4 col-md-6 col-12 key1">
					<div class="row">
						<div class="col-6 key2">
							Key Performance Indicators
						</div>
						<div class="col-6 text-center">
							<button type="button" class="btn btn-primary font-size-12" data-bs-toggle="modal" data-bs-target="#creat-kpi"><i class="fa fa-magic" aria-hidden="true"></i> Create New kpi</button>
						</div>
					</div>
				</div>
				<div class="col-lg-7 col-md-12 col-12 New-KFI">
					<?= $this->render('filter_list', [
						"companies" => $companies,
						"months" => $months
					]) ?>
					<input type="hidden" id="type" value="grid">
				</div>
				<div class="col-lg-1 col-md-6 col-12 New-date">
					<div class="row">
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
				<?php
				if ($role >= 3) {
				?>
					<div class="col-12 mt-10 text-end">

						<a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/individual-kpi" class="font-size-14 no-underline-primary">
							<i class="fa fa-user mr-5" aria-hidden="true"></i>
							Individual
						</a>
					</div>
				<?php
				}
				?>
			</div>
			<!-- <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
				<div class="tab-content" id="pills-tabContent">
					<div class="tab-pane fade show active" id="pills-Group" role="tabpanel" aria-labelledby="pills-Group-tab"> -->
			<div class="card example-5 scrollbar-ripe-malinka">
				<?php
				if (count($kpis) > 0) {
					foreach ($kpis as $kpiId => $kpi) :
				?>
						<div class="col-12 kgi-grid-box <?= $kpi['isOver'] == 1 ? 'bg-over' : 'bg-white' ?>" id="kpi-<?= $kpiId ?>">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-6 clients-employee">
									<i class="fa fa-flag" aria-hidden="true"></i> <?= $kpi["kpiName"] ?>
									<span class="badge rounded-pill ml-5 <?= $kpi['status'] == 4 ? 'bg-success' : 'bg-warning text-dark' ?> "> <?= $kpi['status'] == 4 ? 'Completed' : 'On process' ?></span>
									<span class="month-feb ml-10"><?= $kpi["month"] ?></span>
								</div>
								<div class="col-lg-6 col-md-6 col-6">
									<div class="row">
										<div class="col-5 text-end">
											<span class="badge rounded-badge bg-white pb-0">
												<div class="flex mb-5">
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
													<a class="no-underline-black ml-2 mt-3 font-size-10" href="#"><?= count($kpi["employee"]) ?></a>
												</div>
											</span>
											<span class="badge rounded-pill bg-bsc font-size-10">
												<i class="fa fa-users" aria-hidden="true"></i> <?= $kpi["countTeam"] ?>
											</span>
										</div>
										<div class="col-5">
											<div class="row">
												<div class="col-12 flex-tokyo text-end">
													<?= $kpi["companyName"] ?>
												</div>
												<div class="col-12 tokyo-ima text-end">
													<img src="<?= Yii::$app->homeUrl ?><?= $kpi["flag"] ?>" class="image-flex"> <?= $kpi["branch"] ?>, <?= $kpi["countryName"] ?>
												</div>
											</div>
										</div>
										<div class="col-lg-2 col-md-6 col-12 text-end">
											<button class="btn btn-sm btn-outline-secondary font-size-10" data-bs-toggle="modal" data-bs-target="#kpi-view" onclick="javascript:kpiHistory(<?= $kpiId ?>)">
												<i class="fa fa-eye" aria-hidden="true"></i>
											</button>
											<?php
											if ($role >= 3) {
											?>
												<button class="btn btn-sm btn-outline-danger font-size-10" data-bs-toggle="modal" data-bs-target="#delete-kpi" onclick="javascript:prepareDeleteKpi(<?= $kpiId ?>)">
													<i class="fa fa-trash-o" aria-hidden="true"></i>
												</button>
											<?php
											}
											?>
										</div>
									</div>
								</div>
							</div>
							<div class="row pb-3" style="margin-top: -5px;">
								<div class="col-lg-2 col-md-6 col-12">
									<div class="col-12">
										<span class="badge rounded-pill slds-badge">
											Term <span class="text-dark font-size-10">: <?= $kpi["fromDate"] ?> - <?= $kpi["toDate"] ?></span>
										</span>
									</div>
									<!-- <div class="col-12 top-teamcontent">
										Team Content
									</div>
									<div class="col-12 font-size-12 pt-10">
										This is a sample kpi content
									</div> -->
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
											<div class="col-12 font-size-10 pt-20" style="width: 10rem;">
												Update Interval
											</div>
											<div class="col-12 Quality-monthly0">
												<?= $kpi["unit"] ?>
											</div>
										</div>
										<div class="col-md-6 pt-5 text-center">
											<div class="col-12 font-size-12">
												Priority
											</div>
											<div class="col-12 mt-8 pl-17">
												<div class="circle-update text-center"><?= $kpi["priority"] ?></div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-md-6 col-12 progress-bordersolid">
									<div class="row">
										<div class="col-md-5">
											<div class="col-12 target-progress text-center">
												<i class="fa fa-bullseye" aria-hidden="true"></i> Target
											</div>
											<div class="col-12 target-million text-center">
												<?php
												$decimal = explode('.', $kpi["targetAmount"]);
												if (isset($decimal[1])) {
													if ($decimal[1] == '00') {
														$show = $decimal[0];
													} else {
														$show = $kpi["targetAmount"];
													}
												} else {
													$show = $kpi["targetAmount"];
												}
												?>
												<?= $show ?>

											</div>
										</div>
										<div class="col-md-2 text-center">
											<div class="col-12 target-plush mt-15">
												<?= $kpi["code"] ?>
											</div>
										</div>
										<div class="col-md-5">
											<div class="col-12 target-progress text-center">
												<i class="fa fa-trophy" aria-hidden="true"></i> Result
											</div>
											<div class="col-12 target-million text-center">
												<?php
												if ($kpi["result"] != '') {
													$decimalResult = explode('.', $kpi["result"]);
													if (isset($decimalResult[1])) {
														if ($decimalResult[1] == '00') {
															$showResult = $decimalResult[0];
														} else {
															$showResult = $kpi["result"];
														}
													} else {
														$showResult = $kpi["result"];
													}
												} else {
													$showResult = 0;
												}
												?>
												<?= $showResult ?>
											</div>
										</div>
									</div>
									<div class="col-12 mt-5">
										<div class="progress">
											<div class="progress-bar" style="width:<?= $kpi['ratio'] ?>%;"></div>
											<?php
											$decimal = explode(".", $kpi['ratio']);
											if (isset($decimal[1]) && $decimal[1] == '00') {
												$number = $decimal[0];
											} else {
												$number = $kpi['ratio'];
											}
											?>
											<span class="badge rounded-pill  pro-load2"><?= $kpi['ratio'] ?>%</span>
										</div>
									</div>
									<div class="row" style="margin-top: -20px;">
										<div class="col-md-6">
											<div class="col-12 refresh0">
												<i class="fa fa-refresh mr-5" aria-hidden="true"></i> Latest Update
											</div>
											<div class="col-12 font-size-12 pt-5" style="font-weight: 700;">
												<?= $kpi['periodCheck'] ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="col-12 font-size-10 font-b text-end">
												Next Update
												<span class="col-12 pencil-nextupdate" data-bs-toggle="modal" data-bs-target="#update-kpi-modal" onclick="javascript:updateKpi(<?= $kpiId ?>)">
													<i class="fa fa-pencil-square-o ml-3" aria-hidden="true"></i>
												</span>
											</div>
											<div class="col-12 font-size-10 text-end <?= $kpi['isOver'] == 1 ? 'text-danger' : '' ?>" style="font-weight: 700;">
												<?= $kpi['nextCheck'] ?>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-5 col-md-6 col-12 card-bordersolid">
									<div class="row mt-15">
										<div class="col-md-6">
											<div class="col-12 dashed1" style="word-wrap: break-word;">
												<span class="text-dark font-size-11"> Issue</span>
												<p class="font-size-11 text-dark"><?= $kpi["issue"] ?></p>
											</div>
										</div>
										<div class="col-md-6">
											<div class="col-12 dashed1" style="word-wrap: break-word;">
												<span class="text-dark font-size-11"> Solution</span>
												<p class="font-size-11 text-dark"><?= $kpi["solution"] ?></p>
											</div>
										</div>
										<div class="col-12 text-end font-size-10 mt-3">
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
			<!-- </div>
				</div>
			</ul> -->
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
	"months" => $months,
	"isManager" => $isManager
]) ?>
<?php ActiveForm::end(); ?>
<?= $this->render('modal_delete') ?>
<?= $this->render('modal_issue') ?>
<?= $this->render('modal_team_history') ?>
<?= $this->render('modal_employee_history') ?>
<?= $this->render('modal_kgi') ?>
<!-- end -->