<?php

use frontend\models\hrvc\Kpi;
use frontend\models\hrvc\KpiTeam;
use yii\bootstrap5\ActiveForm;

$this->title = "KPI";
?>

<div class="col-12 mt-70">
	<div class="col-12">
		<i class="fa fa-tachometer font-size-18" aria-hidden="true"></i>
		<strong class="font-size-18"> TEAM KEY PERFORMAMCE INDICATORS </strong>
	</div>
	<div class="col-12 mt-10">
		<div class="col-12 New-KFI">
			<?= $this->render('filter_list', [
				"companies" => $companies,
				"months" => $months,
				"companyId" => $companyId,
				"branchId" => $branchId,
				"teamId" => $teamId,
				"month" => $month,
				"status" => $status,
				"year" => $year,
			]) ?>
			<input type="hidden" id="type" value="list">
		</div>
		<?php
		//if ($role >= 3) {
		?>
		<div class="col-12 mt-10 text-end">
			<a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/individual-kgi" class="font-size-14 no-underline-primary">
				<i class="fa fa-user mr-5" aria-hidden="true"></i>
				Individual
			</a>
		</div>
		<?php
		//}
		?>
		<div class="alert alert-white-4 mt-10">
			<div class="col-12">
				<table class="table table-striped">
					<thead class="table-secondary">
						<tr class="transform-none">
							<th>KPI Contents</th>
							<th>Company</th>
							<th>Branch</th>
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
							<th>next</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
						if (count($teamKpis) > 0) {
							foreach ($teamKpis as $kpiTeamId => $kpi) :
								$show = KpiTeam::checkPermission($role, $kpiTeamId, $userId);

								if ($show == 1) {
									$display = '';
								} else {
									$display = 'none';
								}
						?>
								<tr class="border-bottom-white2" id="kpi-<?= $kpiTeamId ?>">
									<td class="<?= $kpi["status"] == 1 ? 'over-blue' : 'over-yellow' ?>"><?= $kpi["kpiName"] ?></td>
									<td><?= $role . $kpi["companyName"] ?></td>
									<td><img src="<?= Yii::$app->homeUrl . $kpi['flag'] ?>" class="Flag-Turkey"> <?= $kpi["branch"] ?>, <?= $kpi["countryName"] ?></td>

									<td class="text-center"><?= $kpi["priority"] ?></td>
									<td>
										<div class="flex mb-5 -space-x-4">
											<?php
											if (isset($kpi["kpiEmployee"]) && count($kpi["kpiEmployee"]) > 0) {
												$e = 1;
												foreach ($kpi["kpiEmployee"] as $emp) :
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
											<a class="no-underline-black ml-2 mt-3" href="#"><?= count($kpi["kpiEmployee"]) ?></a>
										</div>
									</td>
									<td>
										<span class=""> <?= $kpi["teamName"] ?></span>
									</td>
									<td><?= $kpi["quantRatio"] == 1 ? 'Quantity' : 'Quality' ?></td>
									<td>
										<?php
										$decimal = explode('.', $kpi["target"]);
										if (isset($decimal[1])) {
											if ($decimal[1] == '00') {
												$show = $decimal[0];
											} else {
												$show = $kpi["target"];
											}
										} else {
											$show = $kpi["target"];
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
									<!-- <td><?php // $kpi["periodCheck"] 
											?></td> -->
									<td class="<?= $kpi['isOver'] == 1 ? 'text-danger' : '' ?>">
										<?= $kpi["status"] == 1 ? $kpi["nextCheckDate"] : '' ?>
									</td>
									<td colspan="row">

										<span class="dropdown menulink" href="#" role="but ton" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-ellipsis-v on-cursor" aria-hidden="true"></i> </span>
										<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											<?php
											if ($role > 3) {
											?>
												<li data-bs-toggle="modal" data-bs-target="#update-kgi-modal-team" onclick="javascript:updateTeamKpi(<?= $kpiTeamId ?>)" style="display: <?= $display ?>;">
													<a class="dropdown-item"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
												</li>
												<?php
											} else {
												if ($role == 3 && ($kpi["teamId"] == $userTeamId)) { ?>
													<li data-bs-toggle="modal" data-bs-target="#update-kgi-modal-team" onclick="javascript:updateTeamKpi(<?= $kpiTeamId ?>)" style="display: <?= $display ?>;">
														<a class="dropdown-item"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
													</li>
											<?php
												}
											}
											?>
											<li data-bs-toggle="modal" data-bs-target="#kpi-view-team" onclick="javascript:kpiTeamHistory(<?= $kpiTeamId ?>)">
												<a class="dropdown-item"><i class="fa fa-eye" aria-hidden="true"></i></a>
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

</div>
<?php
$form = ActiveForm::begin([
	'id' => 'update-kpi',
	'method' => 'post',
	'options' => [
		'enctype' => 'multipart/form-data',
	],
	'action' => Yii::$app->homeUrl . 'kpi/kpi-team/update-kpi-team'

]); ?>
<?= $this->render('modal_update', [
	"units" => $units,
	"isManager" => $isManager,
	"months" => $months,
]) ?>
<?php ActiveForm::end(); ?>
<?= $this->render('modal_view', [
	"isManager" => $isManager
]) ?>