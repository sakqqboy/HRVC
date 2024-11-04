<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'KPI Grid View';
?>
<div class="col-12">
	<?php if (Yii::$app->session->hasFlash('alert-kpi')) : ?>
		<script>
			window.onload = function() {
				$('.alert-box-info').slideDown(500);
				setTimeout(function() {
					$('.alert-box-info').fadeOut(300);
				}, 3000);
			}
		</script>
	<?php endif; ?>
	<div class="alert-box-info text-center">
		S A V E D ! ! !
	</div>
	<div class="col-12">
		<img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.png" class="home-icon mr-5" style="margin-top: -3px;">
		<strong class="pim-head-text"> Performance Indicator Matrices (PIM)</strong>
	</div>
	<div class="col-12 mt-10">
		<?= $this->render('header_filter', [
			"role" => $role
		]) ?>
	</div>
	<?php
	$form = ActiveForm::begin([
		'id' => 'update-kpi-team-employee',
		'method' => 'post',
		'options' => [
			'enctype' => 'multipart/form-data',
		],
		'action' => Yii::$app->homeUrl . 'kpi/assign/update-team-kpi'

	]); ?>

	<div class="alert mt-10 pim-body bg-white">
		<div class="row">
			<div class="col-5">
				<div class="row">
					<div class="col-10 font-size-12 pim-name pr-0 pl-5 text-start">
						<a href="<?= Yii::$app->homeUrl ?>kpi/management/grid" class="mr-5 font-size-12">
							<i class="fa fa-caret-left mr-3" aria-hidden="true"></i>
							Back
						</a>
						<span class="">
							<?= $kpiDetail["kpiName"] ?>
						</span>
					</div>
					<div class="col-2 text-end">
						<button class="btn-create font-size-12" style="text-decoration: none;" type="submit">
							Save
						</button>
					</div>
				</div>
				<div class="col-12  ligth-gray-box mt-10 mb-10">
					<div class="col-12 bg-white pl-8 pr-8 mt-8 mb-10">
						<div class="row">
							<div class="col-6 font-size-12 pt-5 pb-3"><b>Assign Team</b></div>
							<div class="col-6 text-end  font-size-12 pt-5 pb-3"><b>ALLOCATE TARGET</b></div>
						</div>
					</div>
					<?php
					$totalTeam = 0;
					$totalTarget = 0;
					if (isset($teams) && count($teams) > 0) {
						foreach ($teams as $team):
							$target = 0;
							$checked = "";
							if (isset($kpiTeams) && count($kpiTeams) > 0) {
								foreach ($kpiTeams as $kpiTeamId => $kpiTeam):
									if ($kpiTeam["teamId"] == $team['teamId']) {
										$target = $kpiTeam["target"];
										$checked = "checked";
										$totalTeam++;
										$totalTarget += $target;
									}
								endforeach;
							}
					?>
							<div class="col-12 bg-white mb-10 pb-0 pt-0 pr-8">
								<div class="row">
									<div class="col-1 text-end pr-0 pl-0 pt-12">
										<input type="checkbox" name="team[<?= $team['teamId'] ?>]" id="team-<?= $team['teamId'] ?>" <?= $checked ?> class="from-check" value="<?= $team['teamId'] ?>" onclick="javasript:assignKpiToEmployeeInTeam(<?= $team['teamId'] ?>,<?= $kpiId ?>)"><!--kpi_employee-->
									</div>
									<div class="col-2 pr-5 pl-0 text-end pt-3 pb-3">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team.png" style="width:40px;">
									</div>
									<div class="col-5 pl-0 pt-3 ">
										<span class="font-size-12"><b><?= $team["teamName"] ?></b></span>
										<div class="col-12 font-size-10" style="margin-top: -5px;"><?= $team["departmentName"] ?></div>
									</div>
									<div class="col-4 pt-9">
										<input type="text" placeholder="0.00" class="assign-target text-end font-size-12" value="<?= $target > 0 ? number_format($target, 2) : '' ?>" name="teamTarget[<?= $team['teamId'] ?>]">
									</div>
								</div>
							</div>
					<?php
						endforeach;
					}
					if ($totalTeam > 0) {
						$teamAverage = $totalTarget / $totalTeam;
					} else {
						$teamAverage = 0;
					}
					?>
				</div>
			</div>
			<?php
			if ($kpiTeamEmployee["base"]["totalTargetAll"] > $kpiDetail["targetAmount"]) {
				if ($kpiDetail["targetAmount"] > 0) {
					$percentage = (($kpiTeamEmployee["base"]["totalTargetAll"] / $kpiDetail["targetAmount"]) * 100);
				} else {
					$percentage = 0;
				}
				$isMoreSet = 1;
			} else {
				if ($kpiDetail["targetAmount"] > 0) {
					$percentage = (($kpiTeamEmployee["base"]["totalTargetAll"] / $kpiDetail["targetAmount"]) * 100);
				} else {
					$percentage = 0;
				}
				$isMoreSet = 0;
				if ($kpiTeamEmployee["base"]["totalTargetAll"] == $kpiDetail["targetAmount"]) {
					$percentage = 0;
					$isMoreSet = "-";
				}
			}
			?>
			<div class="col-7">
				<div class="row">
					<div class="col-3 font-size-12 border-right pt-5 pl-5 pr-0 text-center">
						Average/Team <span class="font-size-12 ml-5"><b><?= number_format($teamAverage) ?></b></span>
					</div>
					<div class="col-4 font-size-12 border-right  pt-5 pl-0 pr-0 text-center">
						Average/Individual <span class="font-size-12 ml-5"><b><?= number_format($kpiTeamEmployee["base"]["averageTarget"]) ?></b></span>
					</div>
					<div class="col-3 text-center font-size-12 border-right">
						<div class="row">
							<div class="col-8">
								<span class="font-size-12"><b><?= number_format($kpiTeamEmployee["base"]["totalTargetAll"]) ?></b></span>
								<div class="col-12 font-size-10" style="margin-top: -5px;">Assigned</div>
							</div>
							<div class="col-4  pr-0 pl-0 text-center mt-5 font-size-11">
								<?php
								if ($isMoreSet == "1") {
								?>
									<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/arrow-up.png" style="width:10px;margin-top:-3px;" class="mr-2">
								<?php
								}
								if ($isMoreSet == "0") {
								?>
									<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/arrow-down.png" style="width:10px;margin-top:-3px;" class="mr-2">
								<?php
								}
								?>
								<?= number_format($percentage) ?>%
							</div>
						</div>

					</div>
					<div class="col-2 text-center pt-0">
						<div class="row">
							<span class="font-size-12"><b><?= number_format($kpiDetail["targetAmount"]) ?></b></span>
							<div class="col-12 font-size-10" style="margin-top: -5px;">Master & Target</div>
						</div>
					</div>
				</div>
				<div class="col-12 ligth-gray-box mb-10 mt-7">
					<div class="col-12 bg-white pl-8 pr-8 mt-8 mb-10">
						<div class="row">
							<div class="col-5 font-size-12 pt-5 pb-3"><b>Assign Individuals</b></div>
							<div class="col-3 font-size-12 pt-5 pb-3 text-center">ALLOCATE TARGET</div>
							<div class="col-4 font-size-12 pt-5 pb-3 text-center">REMARKS</div>
						</div>
					</div>
					<div class="col-12 pr-0 pl-0" id="team-employee-target">
						<?= $this->render('employee_team', [
							"kpiTeamEmployee" => $kpiTeamEmployee,
						]) ?>
					</div>

				</div>
			</div>
		</div>
	</div>
	<input type="hidden" name="kpiId" value="<?= $kpiId ?>">
	<input type="hidden" name="companyId" value="<?= $companyId ?>">
	<?php ActiveForm::end(); ?>
</div>