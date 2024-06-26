<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Kpi;
use frontend\models\hrvc\KpiEmployee;
use yii\bootstrap5\ActiveForm;

$this->title = "Individual KPI";
?>
<div class="col-12 mt-70 pd-Performance">
	<div class="col-12">
		<i class="fa fa-tachometer font-size-18" aria-hidden="true"></i>
		<strong class="font-size-18"> Individual Key Performance Indicator</strong>
	</div>
	<div class="col-12 mt-10">
		<?= $this->render('header_filter', [
			"role" => $role
		]) ?>
		<div class="alert alert-white-4 mt-10">
			<div class="row">
				<div class="col-lg-11 col-md-12 col-12 New-KFI">
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
					<input type="hidden" id="type" value="list">
				</div>
				<div class="col-lg-1 col-md-6 col-12 New-date">
					<div class="row">
						<div class="col-12 new-light-4">
							<div class="btn-group" role="group" aria-label="Basic example">
								<a class="btn btn-primary font-size-13"><i class="fa fa-list-ul" aria-hidden="true"></i></a>
								<a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/individual-kpi-grid" class="btn btn-outline-primary font-size-13"><i class="fa fa-th-large" aria-hidden="true"></i></a>
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
		<div class="col-12">
			<table class="table table-striped">
				<thead class="table-secondary">
					<tr class="transform-none">
						<th>KPI Contents</th>

						<th>Priority</th>
						<th>Employees</th>
						<th>Team</th>
						<th>QR</th>
						<th>target</th>
						<th>Code</th>
						<th>result</th>
						<th>ratio</th>
						<th>month</th>
						<th>Unit</th>
						<th>Last</th>
						<th>next</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (count($kpis) > 0) {
						foreach ($kpis as $kpiEmployeeId => $kpi) :
							// $show = Kpi::checkPermission($role, $kpi["kpiId"], $userId);
							// if ($show == 1) {
							// 	$display = '';
							// } else {
							// 	$display = 'none';
							// }
							$canEdit = KpiEmployee::canEdit($role, $kpiEmployeeId);
					?>
							<tr class="border-bottom-white2" id="kpi-<?= $kpiEmployeeId ?>">
								<td class="<?= $kpi["status"] == 1 ? 'over-blue' : 'over-yellow' ?>"><?= $kpi["kpiName"] ?></td>

								<td class="text-center"><?= $kpi["priority"] ?></td>
								<td>
									<div class="flex mb-5 -space-x-4">
										<?php
										if (isset($kpi["employee"]) && count($kpi["employee"]) > 0) {
											$e = 1;
											foreach ($kpi["employee"] as $emp) :

										?>
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
								</td>
								<td>
									<span class="badge rounded-pill bg-secondary-bsc"><i class="fa fa-users" aria-hidden="true"></i> <?= $kpi["countTeam"] ?></span>
								</td>
								<td><?= $kpi["quantRatio"] == 1 ? 'Quantity' : 'Quality' ?></td>
								<td>
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
								</td>
								<td>
									<?= $kpi["code"] ?>
								</td>
								<td>
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
								</td>
								<td>
									<div id="progress1">
										<div data-num="<?= $kpi["ratio"] ?>" class="progress-item1"></div>
									</div>
								</td>
								<td><?= $kpi["month"] ?></td>
								<td><?= $kpi["unit"] ?></td>
								<td><?= $kpi["periodCheck"] ?></td>
								<td class="<?= $kpi['isOver'] == 1 ? 'text-danger' : '' ?>">
									<?= $kpi["status"] == 1 ? $kpi["nextCheck"] : '' ?>
								</td>
								<td colspan="row">
									<span data-bs-toggle="modal" data-bs-target="#kpi-issue" onclick="javascript:showKpiComment(<?= $kpi['kpiId'] ?>)">
										<img src="<?= Yii::$app->homeUrl ?>image/comment.png" class="comment-td-dropdown">
									</span>
									<span class="dropdown menulink" href="#" role="but ton" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-ellipsis-v on-cursor" aria-hidden="true"></i> </span>
									<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
										<?php
										if ($canEdit == 1) {
										?>
											<li>
												<a class="dropdown-item" href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/update-personal-kpi/<?= ModelMaster::encodeParams(['kpiEmployeeId' => $kpiEmployeeId]) ?>">
													<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
												</a>
											</li>
										<?php
										}
										?>
										<li>
											<a class="dropdown-item" href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/view-personal-kpi/<?= ModelMaster::encodeParams(['kpiEmployeeId' => $kpiEmployeeId]) ?>">
												<i class="fa fa-eye" aria-hidden="true"></i>
											</a>
										</li>
									</ul>
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
<input type="hidden" value="create" id="acType">

<?= $this->render('modal_issue') ?>