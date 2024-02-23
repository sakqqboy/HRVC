<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Kpi;
use frontend\models\hrvc\KpiEmployee;
use frontend\models\hrvc\KpiTeam;
use yii\bootstrap5\ActiveForm;

$this->title = "INDIVIDUAL KPI";
?>

<div class="col-12 mt-70">
	<div class="col-12">
		<i class="fa fa-tachometer font-size-18" aria-hidden="true"></i>
		<strong class="font-size-18"> Individual Key Performance Indicators </strong>
	</div>
	<div class="col-12 mt-10">
		<?= $this->render('header_filter', [
			"role" => $role
		]) ?>
		<div class="alert alert-white-4 mt-10">
			<div class="row">
				<div class="col-11 New-KFI">
					<?= $this->render('filter_list', [
						"companies" => $companies,
						"months" => $months,
						"month" => $month,
						"status" => $status,
						"year" => $year,
						"role" => $role,
						"companyId" => $companyId,
						"branchId" => $branchId,
						"teamId" => $teamId,
						"role" => $role,
						"teams" => $teams
					]) ?>
					<input type="hidden" id="type" value="grid">
				</div>
				<div class="col-lg-1 col-md-6 col-12 New-date">
					<div class="row">
						<div class="col-12 new-light-4">
							<div class="btn-group" role="group" aria-label="Basic example">
								<a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/individual-kpi" class="btn btn-outline-primary font-size-13"><i class="fa fa-list-ul" aria-hidden="true"></i></a>
								<a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/individual-kpi-grid" class="btn  btn-primary font-size-13"><i class="fa fa-th-large" aria-hidden="true"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-12 mt-10 mb-10">
					<?php
					if (isset($teamId) && $teamId != null) {
						$disabled = '';
					} else {
						$disabled = "disabled";
					}
					if ($role >= 3) {
					?>
						<select class="form-select font-size-13" id="employee-filter" <?= $disabled ?>>
							<?php
							if (isset($employeeId) && $employeeId != null) { ?>
								<option value="<?= $employeeId ?>"><?= Employee::employeeName($employeeId) ?></option>
							<?php
							}
							?>
							<option value="">Employee</option>
							<?php
							if (isset($employees) && count($employees) > 0) {
								foreach ($employees as $employee) : ?>
									<option value="<?= $employee['employeeId'] ?>"><?= $employee["employeeFirstname"] ?> <?= $employee["employeeSurename"] ?></option>
							<?php
								endforeach;
							}
							?>
						</select>
					<?php
					}
					?>
				</div>
				<div class="col-lg-6 col-md-6 col-12 mt-10 text-end">
					<a href="<?= Yii::$app->homeUrl ?>kpi/kpi-team/team-kpi-grid" class="font-size-14 no-underline-primary">
						<i class="fa fa-users mr-5" aria-hidden="true"></i>
						Team KPI
					</a>
					<a href="<?= Yii::$app->homeUrl ?>kpi/management/grid" class="font-size-14 no-underline-primary ml-10">
						<i class="fa fa-cog mr-5" aria-hidden="true"></i>
						KPI Setting
					</a>
				</div>
			</div>
		</div>
		<div class="card example-5 scrollbar-ripe-malinka">
			<?php
			if (count($kpis) > 0) {
				foreach ($kpis as $kpiEmployeeId => $kpi) :
					if ($kpi["isOver"] == 1) {
						$class = 'bg-over';
					} else {
						$class = 'bg-white';
					}
					if ($kpi["nextCheck"] == '') {
						$class = "bg-lightblue";
					}
					if ($kpi["status"] == '2') {
						$class = 'bg-finished';
					}
					$canEdit = KpiEmployee::canEdit($role, $kpiEmployeeId);
			?>
					<div class="col-12 kgi-grid-box <?= $class ?>" id="kpi-employee-<?= $kpiEmployeeId ?>">
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
											<i class="fa fa-users" aria-hidden="true"></i> <?= $kpi["employeeName"] ?>
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
										<a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/view-personal-kpi/<?= ModelMaster::encodeParams(['kpiEmployeeId' => $kpiEmployeeId]) ?>" class="btn btn-sm btn-outline-secondary font-size-10">
											<i class="fa fa-eye" aria-hidden="true"></i>
										</a>
										<?php
										if ($role >= 4) {
										?>
											<button class="btn btn-sm btn-outline-danger font-size-10" data-bs-toggle="modal" data-bs-target="#delete-kpi-employee" onclick="javascript:prepareDeleteKpiEmployee(<?= $kpiEmployeeId ?>)">
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
										This is a sample KPI content
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
									<div class="col-md-6 text-center pt-5">
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
											<?= $show ?><?= $kpi["amountType"] == 1 ? '%' : '' ?>
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
											<?= $showResult ?><?= $kpi["amountType"] == 1 ? '%' : '' ?>
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
										<span class="badge rounded-pill  pro-load2"><?= $number ?>%</span>
									</div>
								</div>
								<div class="row" style="margin-top: -20px;">
									<div class="col-md-6">
										<div class="col-12 refresh0">
											<i class="fa fa-refresh mr-5" aria-hidden="true"></i> Latest Update
										</div>
										<div class="col-12 font-size-10" style="font-weight: 700;">
											<?= $kpi['periodCheck'] ?>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
											<?php
											if ($canEdit == 1) {
												$col = 9;
											} else {
												$col = 12;
											} ?>
											<div class="col-12 font-size-10 font-b text-end">
												Next Update
												<?php
												if ($canEdit == 1) {
												?>
													<span class="pencil-nextupdate text-center ml-3">
														<a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/update-personal-kpi/<?= ModelMaster::encodeParams(['kpiEmployeeId' => $kpiEmployeeId]) ?>">
															<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
														</a>
													</span>
												<?php
												}
												?>
											</div>

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
											<p class="font-size-10 text-dark"><?= $kpi["issue"] ?></p>
										</div>
									</div>
									<div class="col-md-6">
										<div class="col-12 dashed1" style="word-wrap: break-word;">
											<span class="text-dark font-size-11"> Solution</span>
											<p class="font-size-10 text-dark"><?= $kpi["solution"] ?></p>
										</div>
									</div>
									<div class="col-12 text-end font-size-10 mt-3">
										<span data-bs-toggle="modal" data-bs-target="#kpi-issue" onclick="javascript:showKpiComment(<?= $kpi['kpiId'] ?>)" style="cursor: pointer;" class="text-primary">
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

<?= $this->render('modal_issue') ?>
<?= $this->render('modal_delete') ?>