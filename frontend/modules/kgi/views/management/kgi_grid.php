<?php

use yii\bootstrap5\ActiveForm;

$this->title = 'KGI Grid View';
?>

<div class="col-12 mt-70">
	<div class="col-12">
		<i class="fa fa-tachometer font-size-18" aria-hidden="true"></i>
		<strong class="font-size-18"> Performance Indicator Matrices (PIM)</strong>
	</div>
	<div class="col-12 mt-10">
		<?= $this->render('header_filter', [
			"role" => $role
		]) ?>

		<div class="alert alert-white-4 mt-10">
			<div class="row">
				<div class="col-lg-4 col-md-6 col-12 key1">
					<div class="row">
						<div class="col-6 key1">
							Key Goal Indicators
						</div>
						<?php
						if ($role >= 3) {
						?>
							<div class="col-6 text-center">
								<button type="button" class="btn btn-primary font-size-12" data-bs-toggle="modal" data-bs-target="#staticBackdrop5"><i class="fa fa-magic" aria-hidden="true"></i> Create New KGI</button>
							</div>
						<?php
						}
						?>
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
						<div class="col-12 new-light-4">
							<div class="btn-group" role="group" aria-label="Basic example">
								<a href="<?= Yii::$app->homeUrl ?>kgi/management/index" class="btn btn-outline-primary font-size-13">
									<i class="fa fa-list-ul" aria-hidden="true"></i>
								</a>
								<a class="btn btn-primary  font-size-13">
									<i class="fa fa-th-large" aria-hidden="true"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
				<?php
				//if ($role >= 3) {
				?>
				<div class="col-12 mt-10 text-end">
					<a href="<?= Yii::$app->homeUrl ?>kgi/kgi-team/team-kgi" class="font-size-14 no-underline-primary mr-20">
						<i class="fa fa-users mr-5" aria-hidden="true"></i>
						Team KGI
					</a>
					<a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/individual-kgi" class="font-size-14 no-underline-primary">
						<i class="fa fa-user mr-5" aria-hidden="true"></i>
						Individual KGI
					</a>
				</div>
				<?php
				//}
				?>
			</div>
			<!-- <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist"> -->
			<!-- <div class="tab-content" id="pills-tabContent">
				<div id="pills-Group" role="tabpanel" aria-labelledby="pills-Group-tab"> -->
			<div class="card example-5 scrollbar-ripe-malinka">
				<?php
				if (count($kgis) > 0) {
					foreach ($kgis as $kgiId => $kgi) :
						//throw new exception(print_r($kgi, true));
				?>
						<div class="col-12 kgi-grid-box <?= $kgi['isOver'] == 1 ? 'bg-over' : 'bg-white' ?>" id="kgi-<?= $kgiId ?>">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-6 clients-employee">
									<i class="fa fa-flag" aria-hidden="true"></i> <?= $kgi["kgiName"] ?>
									<span class="badge rounded-pill ml-5 <?= $kgi['status'] == 4 ? 'bg-success' : 'bg-warning text-dark' ?> "> <?= $kgi['status'] == 4 ? 'Completed' : 'On process' ?></span>
									<span class="month-feb ml-10"><?= $kgi["month"] ?></span>
								</div>
								<div class="col-lg-6 col-md-6 col-6">
									<div class="row">
										<div class="col-5 text-end">
											<span class="badge rounded-badge bg-white pb-0">
												<div class="flex mb-5">
													<?php
													if (isset($kgi["employee"]) && count($kgi["employee"]) > 0) {
														$e = 1;
														foreach ($kgi["employee"] as $emp) : ?>
															<img class="image-grid" src="<?= Yii::$app->homeUrl . $emp ?>">
													<?php
															if ($e == 3) {
																break;
															}
															$e++;
														endforeach;
													}
													?>
													<a class="no-underline-black ml-2 mt-3 font-size-10" href="#"><?= count($kgi["employee"]) ?></a>
												</div>
											</span>
											<span class="badge rounded-pill bg-bsc font-size-10">
												<i class="fa fa-users" aria-hidden="true"></i> <?= $kgi["countTeam"] ?>
											</span>
										</div>
										<div class="col-5">
											<div class="row">
												<div class="col-12 flex-tokyo text-end">
													<?= $kgi["companyName"] ?>
												</div>
												<div class="col-12 tokyo-ima text-end">
													<img src="<?= Yii::$app->homeUrl ?><?= $kgi["flag"] ?>" class="image-flex"> <?= $kgi["branch"] ?>, <?= $kgi["countryName"] ?>
												</div>
											</div>
										</div>
										<div class="col-lg-2 col-md-6 col-12 text-end">
											<button class="btn btn-sm btn-outline-secondary font-size-10" data-bs-toggle="modal" data-bs-target="#kgi-view" onclick="javascript:kgiHistory(<?= $kgiId ?>)">
												<i class="fa fa-eye" aria-hidden="true"></i>
											</button>
											<?php
											if ($role >= 4) {
											?>
												<button class="btn btn-sm btn-outline-danger font-size-10" data-bs-toggle="modal" data-bs-target="#delete-kgi" onclick="javascript:prepareDeleteKgi(<?= $kgiId ?>)">
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
											Term <span class="text-dark font-size-10">: <?= $kgi["fromDate"] ?> - <?= $kgi["toDate"] ?></span>
										</span>
									</div>
									<!-- <div class="col-12 top-teamcontent">
										Team Content
									</div>
									<div class="col-12 font-size-12 pt-10">
										This is a sample KGI content
									</div> -->
								</div>
								<div class="col-lg-2 col-md-6 col-12 sample-bordersolid">
									<div class="row">
										<div class="col-md-6">
											<div class="col-12 font-size-12 pt-5">
												Quant Ratio
											</div>
											<div class="col-12 Quality-diamond">
												<i class="fa fa-diamond" aria-hidden="true"></i> <?= $kgi["quantRatio"] == 1 ? 'Quantity' : 'Quality' ?>
											</div>
											<div class="col-12 font-size-10 pt-20" style="width: 10rem;">
												Update Interval
											</div>
											<div class="col-12 Quality-monthly0">
												<?= $kgi["unit"] ?>
											</div>
										</div>
										<div class="col-md-6 text-center pt-5">
											<div class="col-12 font-size-12">
												Priority
											</div>
											<div class="col-12 mt-8 pl-17">
												<div class="circle-update text-center"><?= $kgi["priority"] ?></div>
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
												$decimal = explode('.', $kgi["targetAmount"]);
												if (isset($decimal[1])) {
													if ($decimal[1] == '00') {
														$show = $decimal[0];
													} else {
														$show = $kgi["targetAmount"];
													}
												} else {
													$show = $kgi["targetAmount"];
												}
												?>
												<?= $show ?><?= $kgi["amountType"] == 1 ? '%' : '' ?>
											</div>
										</div>
										<div class="col-md-2 text-center">
											<div class="col-12 target-plush mt-15">
												<?= $kgi["code"] ?>
											</div>
										</div>
										<div class="col-md-5">
											<div class="col-12 target-progress text-center">
												<i class="fa fa-trophy" aria-hidden="true"></i> Result
											</div>
											<div class="col-12 target-million text-center">
												<?php
												if ($kgi["result"] != '') {
													$decimalResult = explode('.', $kgi["result"]);
													if (isset($decimalResult[1])) {
														if ($decimalResult[1] == '00') {
															$showResult = $decimalResult[0];
														} else {
															$showResult = $kgi["result"];
														}
													} else {
														$showResult = $kgi["result"];
													}
												} else {
													$showResult = 0;
												}
												?>
												<?= $showResult ?><?= $kgi["amountType"] == 1 ? '%' : '' ?>
											</div>
										</div>
									</div>
									<div class="col-12 mt-5">
										<div class="progress">
											<div class="progress-bar" style="width:<?= $kgi['ratio'] ?>%;"></div>
											<?php
											$decimal = explode(".", $kgi['ratio']);
											if (isset($decimal[1]) && $decimal[1] == '00') {
												$number = $decimal[0];
											} else {
												$number = $kgi['ratio'];
											}
											?>
											<span class="badge rounded-pill  pro-load2"><?= $number ?>%</span>
										</div>
									</div>
									<div class="row" style="margin-top: -20px;">
										<div class="col-md-6">
											<div class="col-12 refresh0">
												<i class="fa fa-refresh mr-5" aria-hidden="true"></i> Latest Update
											</div>
											<div class="col-12 font-size-12 pt-5" style="font-weight: 700;">
												<?= $kgi['periodCheck'] ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="row">
												<?php
												if ($role >= 4) {
													$col = 9;
												} else {
													$col = 12;
												} ?>
												<div class="col-12 font-size-10 font-b text-end">
													Next Update
													<?php
													if ($role >= 4) {
													?>
														<span class="pencil-nextupdate text-center ml-3" data-bs-toggle="modal" data-bs-target="#update-kgi-modal" onclick="javascript:updateKgi(<?= $kgiId ?>)">
															<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
														</span>
													<?php
													}
													?>
												</div>

											</div>
											<div class="col-12 font-size-10 text-end <?= $kgi['isOver'] == 1 ? 'text-danger' : '' ?>" style="font-weight: 700;">
												<?= $kgi['nextCheck'] ?>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-5 col-md-6 col-12 card-bordersolid">
									<div class="row mt-15">
										<div class="col-md-6">
											<div class="col-12 dashed1" style="word-wrap: break-word;">
												<span class="text-dark font-size-11"> Issue</span>
												<p class="font-size-10 text-dark"><?= $kgi["issue"] ?></p>
											</div>
										</div>
										<div class="col-md-6">
											<div class="col-12 dashed1" style="word-wrap: break-word;">
												<span class="text-dark font-size-11"> Solution</span>
												<p class="font-size-10 text-dark"><?= $kgi["solution"] ?></p>
											</div>
										</div>
										<div class="col-12 text-end font-size-10 mt-3">
											<span data-bs-toggle="modal" data-bs-target="#kgi-issue" onclick="javascript:showKgiComment(<?= $kgiId ?>)" style="cursor: pointer;" class="text-primary">
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
			</div> -->
		</div>
	</div>

</div>
<?= $this->render('modal_view') ?>

<input type="hidden" value="create" id="acType">
<?php
$form = ActiveForm::begin([
	'id' => 'create-kgi',
	'method' => 'post',
	'options' => [
		'enctype' => 'multipart/form-data',
	],
	'action' => Yii::$app->homeUrl . 'kgi/management/create-kgi'

]); ?>
<?= $this->render('modal_create', [
	"units" => $units,
	"companies" => $companies,
	"months" => $months
]) ?>
<?php ActiveForm::end(); ?>

<?php
$form = ActiveForm::begin([
	'id' => 'update-kgi',
	'method' => 'post',
	'options' => [
		'enctype' => 'multipart/form-data',
	],
	'action' => Yii::$app->homeUrl . 'kgi/management/update-kgi'

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
<?= $this->render('modal_kfi') ?>
<?= $this->render('modal_kpi') ?>

<!-- end -->