<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Kgi;
use frontend\models\hrvc\KgiEmployee;
use yii\bootstrap5\ActiveForm;

$this->title = "Individual KGI";
?>
<div class="col-12 mt-70 pd-Performance">
	<div class="col-12">
		<i class="fa fa-tachometer font-size-18" aria-hidden="true"></i>
		<strong class="font-size-18"> Individual Key Goal Indicator</strong>
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
					<input type="hidden" id="type" value="list">
				</div>
				<div class="col-lg-1 col-md-6 col-12 New-date">
					<div class="row">
						<div class="col-12 new-light-4">
							<div class="btn-group" role="group" aria-label="Basic example">
								<a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/individual-kgi" class="btn btn-primary font-size-13"><i class="fa fa-list-ul" aria-hidden="true"></i></a>
								<a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/individual-kgi-grid" class="btn btn-outline-primary  font-size-13"><i class="fa fa-th-large" aria-hidden="true"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
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
					<a href="<?= Yii::$app->homeUrl ?>kgi/kgi-team/team-kgi-grid" class="font-size-14 no-underline-primary">
						<i class="fa fa-users mr-5" aria-hidden="true"></i>
						Team KGI
					</a>
					<a href="<?= Yii::$app->homeUrl ?>kgi/management/grid" class="font-size-14 no-underline-primary">
						<i class="fa fa-cog ml-10 mr-5" aria-hidden="true"></i>
						KGI Setting
					</a>
				</div>
			</div>
		</div>
		<div class="col-12">
			<table class="table table-striped">
				<thead class="table-secondary">
					<tr class="transform-none">
						<th>KGI Contents</th>
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
					if (count($kgis) > 0) {
						foreach ($kgis as $kgiEmployeeId => $kgi) :
							// $show = Kgi::checkPermission($role, $kgi["kgiId"], $userId);
							// if ($show == 1) {
							// 	$display = '';
							// } else {
							// 	$display = 'none';
							// }
							$canEdit = KgiEmployee::canEdit($role, $kgiEmployeeId);
					?>
							<tr class="border-bottom-white2" id="kgi-<?= $kgiEmployeeId ?>">
								<td class="<?= $kgi["status"] == 1 ? 'over-blue' : 'over-yellow' ?>"><?= $kgi["kgiName"] ?></td>

								<td class="text-center"><?= $kgi["priority"] ?></td>
								<td>
									<div class="flex mb-5 -space-x-4">
										<?php
										if (isset($kgi["employee"]) && count($kgi["employee"]) > 0) {
											$e = 1;
											foreach ($kgi["employee"] as $emp) :

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
										<a class="no-underline-black ml-2 mt-3" href="#"><?= count($kgi["employee"]) ?></a>
									</div>
								</td>
								<td>
									<span class="badge rounded-pill bg-secondary-bsc"><i class="fa fa-users" aria-hidden="true"></i> <?= $kgi["countTeam"] ?></span>
								</td>
								<td><?= $kgi["quantRatio"] == 1 ? 'Quantity' : 'Quality' ?></td>
								<td>
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
									<?= $show ?>
								</td>
								<td>
									<?= $kgi["code"] ?>
								</td>
								<td>
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
									<?= $showResult ?>
								</td>
								<td>
									<div id="progress1">
										<div data-num="<?= $kgi["ratio"] ?>" class="progress-item1"></div>
									</div>
								</td>
								<td><?= $kgi["month"] ?></td>
								<td><?= $kgi["unit"] ?></td>
								<td><?= $kgi["periodCheck"] ?></td>
								<td class="<?= $kgi['isOver'] == 1 ? 'text-danger' : '' ?>">
									<?= $kgi["status"] == 1 ? $kgi["nextCheck"] : '' ?>
								</td>
								<td colspan="row">
									<span data-bs-toggle="modal" data-bs-target="#kgi-issue" onclick="javascript:showKgiComment(<?= $kgi['kgiId'] ?>)">
										<img src="<?= Yii::$app->homeUrl ?>image/comment.png" class="comment-td-dropdown">
									</span>
									<span class="dropdown menulink" href="#" role="but ton" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-ellipsis-v on-cursor" aria-hidden="true"></i> </span>
									<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
										<?php
										if ($canEdit == 1) {
										?>
											<li>
												<a class="dropdown-item" href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/update-personal-kgi/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId]) ?>">
													<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
												</a>
											</li>
										<?php
										}
										?>
										<li>
											<a class="dropdown-item" href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/view-personal-kgi/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId]) ?>">
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
	<!-- <div class="col-12 navigation-next">
		<nav aria-label="Page navigation example">
			<ul class="pagination">
				<li class="page-item"><a class="page-link page-navigation" href="#"><i class="fa fa-chevron-left" aria-hidden="true"></i> Previous</a></li>
				<li class="page-item"><a class="page-link page-navigation" href="#">1</a></li>
				<li class="page-item"><a class="page-link page-navigation" href="#">2</a></li>
				<li class="page-item"><a class="page-link page-navigation" href="#">3</a></li>
				<li class="page-item"><a class="page-link page-navigation" href="#">Next <i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
			</ul>
		</nav>
	</div> -->
</div>
<?= $this->render('modal_delete') ?>
<?= $this->render('modal_issue') ?>