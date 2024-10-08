<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Kgi;
use frontend\models\hrvc\KgiEmployee;
use yii\bootstrap5\ActiveForm;

$this->title = "Individual KGI";
?>
<div class="col-12">
	<div class="col-12">
		<img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.png" class="home-icon mr-5" style="margin-top: -3px;">
		<strong class="pim-head-text"> Individual Key Goal Indicator</strong>
	</div>
	<div class="col-12 mt-10">
		<?= $this->render('header_filter', [
			"role" => $role
		]) ?>
		<div class="alert mt-10 pim-body bg-white">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12  pr-0">
					<div class="row">
						<div class="col-9">
							<div class="row">
								<div class="col-4 pim-type-tab pr-0 pl-0">
									<a href="<?= Yii::$app->homeUrl ?>kgi/management/index" class="no-underline-black ">
										Company KGI
									</a>
								</div>
								<div class="col-4 pim-type-tab">
									<a href="<?= Yii::$app->homeUrl ?>kgi/kgi-team/team-kgi" class="no-underline-black ">
										Team KGI
									</a>
								</div>
								<div class="col-4 pim-type-tab-selected">
									Self KGI
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-8 New-KFI pl-0">
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
						"teams" => $teams,
						"teamId" => isset($teamId) ? $teamId : '',
						"employeeId" => isset($employeeId) ? $employeeId : '',
						"employees" => isset($employees) ? $employees : []

					]) ?>
					<input type="hidden" id="type" value="list">
				</div>

				<div class="col-lg-1 col-md-6 col-12 pr-0 text-end">
					<div class="btn-group" role="group">
						<a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/individual-kgi-grid" class="btn btn-outline-primary font-size-12 pim-change-mode">
							<i class="fa fa-th-large" aria-hidden="true"></i>
						</a>
						<a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/individual-kgi" class="btn btn-primary font-size-12 pim-change-mode">
							<i class="fa fa-list-ul" aria-hidden="true"></i>
						</a>

					</div>
				</div>
			</div>
			<div class="col-12 mt-15">
				<div class="row">
					<table class="">
						<thead>
							<tr class="pim-table-header">
								<td class="pl-10">KGI Contents</td>
								<td>Priority</td>
								<td>Employees</td>
								<td>Team</td>
								<td>QR</td>
								<td>target</td>
								<td>Code</td>
								<td>result</td>
								<td>ratio</td>
								<td>montd</td>
								<td>Unit</td>
								<td>Last</td>
								<td>next</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
							<?php
							if (isset($kgis) && count($kgis) > 0) {
								foreach ($kgis as $kgiEmployeeId => $kgi) :
									$canEdit = KgiEmployee::canEdit($role, $kgiEmployeeId);
									if ($kgi["isOver"] == 1 && $kgi["status"] != 2) {
										$colorFormat = 'over';
									} else {
										if ($kgi["status"] == 1) {
											$colorFormat = 'inprogress';
										} else {
											$colorFormat = 'complete';
										}
									}

							?>
									<tr height="10">

									</tr>
									<tr id="kgi-<?= $kgiEmployeeId ?>" class="pim-bg-<?= $colorFormat ?> pim-table-text">
										<td>
											<div class="col-12 border-left-<?= $colorFormat ?> pim-div-border pb-5">
												<?= $kgi["kgiName"] ?>
											</div>
										</td>
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
												<div data-num="<?= $kgi["ratio"] == '' ? 0 : $kgi["ratio"] ?>" class="progress-pim-table progress-circle-<?= $colorFormat ?>"></div>
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
		</div>
	</div>
</div>
<?= $this->render('modal_delete') ?>
<?= $this->render('modal_issue') ?>