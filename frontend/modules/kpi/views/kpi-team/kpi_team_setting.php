<?php

use frontend\models\hrvc\User;
use yii\bootstrap5\ActiveForm;

$this->title = "KPI Team Setting";
?>
<div class="col-12 mt-90 pd-Performance">
	<div class="row">
		<div class="col-8">
			<i class="fa fa-users font-size-20" aria-hidden="true"></i> <strong class="font-size-20"> <?= Yii::t('app', 'Team KPI Setting') ?></strong>
		</div>
		<div class="col-4 text-end pr-15">
			<a href="<?= Yii::$app->request->referrer ?>" class="btn btn-secondary font-size-12">
				<i class="fa fa-chevron-left mr-5" aria-hidden="true"></i>
				<?= Yii::t('app', 'Back') ?>
			</a>
		</div>
	</div>
	<div class="col-12 mt-20 pt-10 pl-10 pb-20" style="border-radius: 10px;border-style:dotted;border-color:grey;">
		<strong>KPI : <?= $kpiDetail["kpiName"] ?></strong>
		<div class="row">
			<div class="col-lg-2 col-md-6 col-2 text-center">
				<div class="col-12 pt-25 pb-25 font-b font-size-20">
					<?= $kpiDetail["monthName"] ?>
				</div>
				<div class="col-12  text-center">
					<p class="font-size-10 mb-20"><?= Yii::t('app', 'Priority') ?></p>
					<div class="circle-Priority" style="margin-left: 70px !important;">
						<?= $kpiDetail["priority"] ?>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-3">
				<div class="col-12 Quant-ratio-Backdrop3">
					<?= Yii::t('app', 'Quant Ratio') ?>
				</div>
				<div class="col-12 diamond-con-Backdrop3 mt-10">
					<i class="fa fa-diamond" aria-hidden="true"></i>
					<span id="quanRatioHistory"><?= $kpiDetail["quantRatio"] == 1 ? "Quantity" : "Quality" ?></span>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-3 text-center">
				<div class="col-12 bullseye-con-Backdrop3">
					<i class="fa fa-bullseye" aria-hidden="true"></i> <?= Yii::t('app', 'Target') ?>
				</div>
				<div class="col-12 million-number-Backdrop3 mt-10" id="targetHistory">
					<?= $kpiDetail["amountType"] == 1 ? number_format($kpiDetail["targetAmount"], 2) : number_format($kpiDetail["targetAmount"]) ?>
				</div>
			</div>
			<div class="col-lg-1 col-md-6 col-3 text-center">
				<div class="col-12 padding-mark-Backdrop3 mt-25 " id="codeHistory">
					<?= $kpiDetail["code"] ?>
				</div>
			</div>
			<div class="col-lg-3 cl-md-6 col-3 text-center">
				<div class="col-12 trophy-con-Backdrop3">
					<i class="fa fa-trophy" aria-hidden="true"></i> <?= Yii::t('app', 'Result') ?>
				</div>
				<div class="col-12 million-number-Backdrop3 mt-10 " id="resultHistory">
					<?= $kpiDetail["amountType"] == 1 ? number_format($kpiDetail["result"], 2) : number_format($kpiDetail["result"]) ?>
				</div>
			</div>
			<div class="row" style="margin-top: -40px;">
				<div class="col-lg-2 col-md-6 col-5"></div>
				<div class="col-lg-4 col-md-6 col-6">
					<div class="col-12 padding-update-Backdrop3">
						<?= Yii::t('app', 'Update Interval') ?>
					</div>
					<div class="col-12 update-mouth-Backdrop3 mt-10" id="unitHistory">
						<?= Yii::t('app', $kpiDetail["unitText"]) ?>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-6" style="margin-top:-20px;">
					<div class="col-12 pt-20">
						<div class="progress">
							<div class="progress-bar" id="progressHistory" style="background: rgb(47, 128, 237); margin-left: -50px; width:<?= (float)$kpiDetail["ratio"] > 100 ? '100' : $kpiDetail["ratio"] ?>%;"></div>
							<span class="badge rounded-pill  pro-load-Backdrop3" id="decimalHistory"><?= $kpiDetail["ratio"] ?>%</span>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<div class="row">
		<div class="col-4 font-size-16 font-b mt-20 mb-10 text-center border-bottom pb-10">
			<?= Yii::t('app', 'TEAM') ?>
		</div>
		<div class="col-3 font-size-16 font-b mt-20 mb-10 text-center border-bottom pb-10">
			<?= Yii::t('app', 'Target') ?>
		</div>
		<div class="col-5 font-size-16 font-b mt-20 mb-10 text-center border-bottom pb-10">
			<?= Yii::t('app', 'Remark') ?>
		</div>
	</div>

	<?php
	$form = ActiveForm::begin([
		'id' => 'create-kpi-group',
		'method' => 'post',
		'options' => [
			'enctype' => 'multipart/form-data',
		],
		'action' => Yii::$app->homeUrl . 'kpi/kpi-team/set-team-target'

	]);
	if (isset($kpiTeams) && count($kpiTeams) > 0) {
		$userTeamId = User::userTeamId();
		foreach ($kpiTeams as $team) :
			if ($role == 3 && $team["teamId"] == $userTeamId) {
				$disabled = "";
			} else {
				if ($role <= 3) {
					$disabled = "disabled";
				} else {
					$disabled = "";
				}
			}
	?>
			<div class="row mt-15">
				<div class="col-4 border-bottom pb-10 ">
					<div class="col-12 border pt-5 pb-5 pl-10 font-b font-size-14" style="background-color: #C6E2FF;">
						<?= $team["teamName"] ?>
					</div>
				</div>
				<div class="col-3 border-bottom pb-10">
					<input type="text" class="form-control text-end font-size-14" <?= $disabled ?> placeholder="Set Target" name="teamTerget[<?= $team['teamId'] ?>]" value="<?= (int)$team['target'] == 0 ? '' : number_format($team['target'], 2) ?>">
				</div>
				<div class="col-4 border-bottom pb-10">
					<textarea class="form-control font-size-14" name="remark[<?= $team['teamId'] ?>]" id="remark-<?= $team['teamId'] ?>" <?= $disabled ?>></textarea>
				</div>
				<div class="col-1 border-bottom mt-15 pb-10 text-center">
					<a href="javascript:setSameKpiTeamRemark(<?= $team['teamId'] ?>,<?= $kpiId ?>)">
						<i class="fa fa-clipboard mr-5 text-secondary font-size-14" aria-hidden="true"></i>
					</a>
					<div class="col-12 text-center font-size-10"><?= Yii::t('app', 'Same Remark') ?></div>

				</div>
			</div>
		<?php
		endforeach;

		?>
		<div class="col-12 text-end mt-10 pr-10">
			<input type="hidden" name="kpiId" value="<?= $kpiId ?>">
			<input type="hidden" name="role" value="<?= $role ?>">
			<button type="submit" class="btn btn-primary" style="letter-spacing: 1px;"><?= Yii::t('app', 'SAVE') ?></button>
		</div>
	<?php
	} else { ?>
		<div class="col-7 text-center mt-20">
			<?= Yii::t('app', 'Not assign to any team') ?>.
		</div>
	<?php

	}
	ActiveForm::end(); ?>
</div>