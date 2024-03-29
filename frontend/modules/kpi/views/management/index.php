<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Kpi;
use yii\bootstrap5\ActiveForm;

$this->title = 'KPI';
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
	</div>
	<div class="alert alert-white-4 mt-10">
		<div class="row">
			<div class="col-lg-4 col-md-6 col-12 key1">
				<div class="row">
					<div class="col-6 key2">
						Key Performance Indicator
					</div>
					<div class="col-6 text-center">
						<?php
						if ($role >= 3) {
						?>
							<button type="button" class="btn btn-primary font-size-12" data-bs-toggle="modal" data-bs-target="#creat-kpi">
								<i class="fa fa-magic" aria-hidden="true"></i>
								Create New KPI
							</button>
						<?php
						}
						?>
					</div>
				</div>
			</div>
			<div class="col-lg-7 col-md-12 col-12 New-KFI">
				<?= $this->render('filter_list', [
					"companies" => $companies,
					"months" => $months
				]) ?>
				<input type="hidden" id="type" value="list">
			</div>
			<div class="col-lg-1 col-md-6 col-12 New-date">
				<div class="row">

					<div class="col-12 new-light-4">
						<div class="btn-group" role="group" aria-label="Basic example">
							<a href="<?= Yii::$app->homeUrl ?>kpi/management/index" class="btn btn-primary font-size-13">
								<i class="fa fa-list-ul" aria-hidden="true"></i>
							</a>
							<a href="<?= Yii::$app->homeUrl ?>kpi/management/grid" class="btn btn-outline-primary  font-size-13">
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
				<a href="<?= Yii::$app->homeUrl ?>kpi/kpi-team/team-kpi-grid" class="font-size-14 no-underline-primary mr-20">
					<i class="fa fa-users mr-5" aria-hidden="true"></i>
					Team KPI
				</a>
				<a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/individual-kpi-grid" class="font-size-14 no-underline-primary">
					<i class="fa fa-user mr-5" aria-hidden="true"></i>
					Individual KPI
				</a>
			</div>
			<?php
			//}
			?>
		</div>

		<table class="table table-striped">
			<thead class="table-secondary">
				<tr class="transform-none">
					<th>KPI Contents</th>
					<th>Company</th>
					<th>Branch</th>
					<th>Team KPI Contents</th>
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
					<th colspan="row"></th>
				</tr>
			</thead>
			<tbody>
				<?php
				if (count($kpis) > 0) {
					foreach ($kpis as $kpiId => $kpi) :
						$show = Kpi::checkPermission($role, $kpiId, $userId);
						/*if ($show == 1) {
							$display = '';
						} else {
							$display = 'none';
						}*/
						if ($role >= 4) {
							$display = '';
						} else {
							$display = 'none';
						}
				?>
						<tr class="border-bottom-white2" id="kpi-<?= $kpiId ?>">
							<td class="<?= $kpi["status"] == 1 ? 'over-blue' : 'over-yellow' ?>"><?= $kpi['kpiName'] ?></td>
							<td><?= $kpi['companyName'] ?></td>
							<td><img src="<?= Yii::$app->homeUrl ?><?= $kpi['flag'] ?>" class="Flag-Turkey"> <?= $kpi['branch'] ?>, <?= $kpi['countryName'] ?></td>
							<td></td>
							<td class="text-center"><?= $kpi['priority'] ?></td>
							<td>
								<span class="badge rounded-pill bg-gray">
									<ul class="try-cricle">
										<?php
										if (isset($kpi["kpiEmployee"]) && count($kpi["kpiEmployee"]) > 0) {
											$e = 1;
											foreach ($kpi["kpiEmployee"] as $emp) : ?>
												<img class="image-grid" src="<?= Yii::$app->homeUrl . $emp ?>">
										<?php
												if ($e == 3) {
													break;
												}
												$e++;
											endforeach;
										}
										?>
										<a class="no-underline-black ml-2 mt-3" href="#"><?= count($kpi["kpiEmployee"]) ?></a>
									</ul>
								</span>
							</td>
							<td>
								<span class="badge rounded-pill bg-secondary-bsc1"><i class="fa fa-users" aria-hidden="true"></i> <?= $kpi['countTeam'] ?></span>
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
								<?= $show ?><?= $kpi["amountType"] == 1 ? '%' : '' ?>
							<td>
								<?= $kpi["code"] ?>
							</td>
							<td><?php
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
							</td>
							<td>
								<div id="progress1">
									<div data-num="<?= (int)$kpi["ratio"] ?>" class="progress-item1"></div>
								</div>
							</td>
							<td><?= $kpi["month"] ?></td>
							<td><?= $kpi["unit"] ?></td>
							<td><?= $kpi["periodCheck"] ?></td>
							<td><?= $kpi["status"] == 1 ? $kpi["nextCheck"] : '' ?></td>
							<td colspan="row">
								<span data-bs-toggle="modal" data-bs-target="#kpi-issue" onclick="javascript:showKpiComment(<?= $kpiId ?>)">
									<img src="<?= Yii::$app->homeUrl ?>image/comment.png" class="comment-td-dropdown">
								</span>

								<span class="dropdown menulink" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-ellipsis-v on-cursor" aria-hidden="true"></i> </span>
								<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
									<li data-bs-toggle="modal" data-bs-target="#update-kpi-modal" onclick="javascript:updateKpi(<?= $kpiId ?>)" style="display: <?= $display ?>;">
										<a class="dropdown-item"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
									</li>
									<li data-bs-toggle="modal" data-bs-target="#kpi-view" onclick="javascript:kpiHistory(<?= $kpiId ?>)">
										<a class="dropdown-item"><i class="fa fa-eye" aria-hidden="true"></i></a>
									</li>
									<li onclick="javascript:copyKpi(<?= $kpiId ?>)" title="Copy" style="display: <?= $display ?>;">
										<a class="dropdown-item" href="#">
											<i class="fa fa-copy" aria-hidden="true"></i>
										</a>
									</li>
									<?php
									if ($role >= 3) {
									?>
										<li>
											<a class="dropdown-item" href="<?= Yii::$app->homeUrl ?>kpi/kpi-team/kpi-team-setting/<?= ModelMaster::encodeParams(['kpiId' => $kpiId]) ?>">
												<i class="fa fa-users" aria-hidden="true"></i>
											</a>
										</li>
										<li>
											<a class="dropdown-item" href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/indivisual-setting/<?= ModelMaster::encodeParams(['kpiId' => $kpiId]) ?>">
												<i class="fa fa-user" aria-hidden="true"></i>
											</a>
										</li>
									<?php
									}
									?>
									<li data-bs-toggle="modal" data-bs-target="#delete-kpi" onclick="javascript:prepareDeleteKpi(<?= $kpiId ?>)" style="display: <?= $display ?>;">
										<a class="dropdown-item">
											<i class="fa fa-trash-o text-danger" aria-hidden="true"></i>
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
<?= $this->render('modal_view') ?>
<?= $this->render('modal_issue') ?>
<?= $this->render('modal_team_history') ?>
<?= $this->render('modal_employee_history') ?>
<?= $this->render('modal_kgi') ?>