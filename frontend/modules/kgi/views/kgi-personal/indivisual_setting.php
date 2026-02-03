<?php

use frontend\models\hrvc\KgiTeam;
use frontend\models\hrvc\Team;
use frontend\models\hrvc\User;
use yii\bootstrap5\ActiveForm;

$this->title = Yii::t('app', 'KGI Individual Setting');
?>
<div class="col-12 mt-90 pd-Performance">
	<div class="row">
		<div class="col-8">
			<i class="fa fa-users font-size-20" aria-hidden="true"></i>
			<strong class="font-size-20">
				<?= Yii::t('app', 'Indivisual KGI Setting') ?>
			</strong>
		</div>
		<div class="col-4 text-end pr-15">
			<a href="<?= Yii::$app->request->referrer ?>" class="btn btn-secondary font-size-12">
				<i class="fa fa-chevron-left mr-5" aria-hidden="true"></i>
				<?= Yii::t('app', 'Back') ?>
			</a>
		</div>
	</div>
	<div class="col-12 mt-20 pt-10 pl-10 pb-20" style="border-radius: 10px;border-style:dotted;border-color:grey;">
		<strong><?= Yii::t('app', 'KGI') ?> : <?= $kgiDetail["kgiName"] ?></strong>
		<div class="row">
			<div class="col-lg-2 col-md-6 col-2 text-center">
				<div class="col-12 pt-25 pb-25 font-b font-size-20">
					<?= $kgiDetail["monthName"] ?>
				</div>
				<div class="col-12  text-center">
					<p class="font-size-10 mb-20"><?= Yii::t('app', 'Priority') ?></p>
					<div class="circle-Priority" style="margin-left: 70px !important;">
						<?= $kgiDetail["priority"] ?>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-3">
				<div class="col-12 Quant-ratio-Backdrop3">
					<?= Yii::t('app', 'Quant Ratio') ?>
				</div>
				<div class="col-12 diamond-con-Backdrop3 mt-10">
					<i class="fa fa-diamond" aria-hidden="true"></i>
					<span id="quanRatioHistory"><?= $kgiDetail["quantRatio"] == 1 ? Yii::t('app', "Quantity") : Yii::t('app', "Quality") ?></span>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-3 text-center">
				<div class="col-12 bullseye-con-Backdrop3">
					<i class="fa fa-bullseye" aria-hidden="true"></i> <?= Yii::t('app', 'Target') ?>
				</div>
				<div class="col-12 million-number-Backdrop3 mt-10" id="targetHistory">
					<?= $kgiDetail["amountType"] == 1 ? number_format($kgiDetail["targetAmount"], 2) : number_format($kgiDetail["targetAmount"]) ?>
				</div>
			</div>
			<div class="col-lg-1 col-md-6 col-3 text-center">
				<div class="col-12 padding-mark-Backdrop3 mt-25 " id="codeHistory">
					<?= $kgiDetail["code"] ?>
				</div>
			</div>
			<div class="col-lg-3 cl-md-6 col-3 text-center">
				<div class="col-12 trophy-con-Backdrop3">
					<i class="fa fa-trophy" aria-hidden="true"></i> <?= Yii::t('app', 'Result') ?>
				</div>
				<div class="col-12 million-number-Backdrop3 mt-10 " id="resultHistory">
					<?= $kgiDetail["amountType"] == 1 ? number_format($kgiDetail["result"], 2) : number_format($kgiDetail["result"]) ?>
				</div>
			</div>
			<div class="row" style="margin-top: -40px;">
				<div class="col-lg-2 col-md-6 col-5"></div>
				<div class="col-lg-4 col-md-6 col-6">
					<div class="col-12 padding-update-Backdrop3">
						<?= Yii::t('app', 'Update Interval') ?>
					</div>
					<div class="col-12 update-mouth-Backdrop3 mt-10" id="unitHistory">
						<?= $kgiDetail["unitText"] ?>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-6" style="margin-top:-20px;">
					<div class="col-12 pt-20">
						<div class="progress">
							<div class="progress-bar" id="progressHistory" style="background: rgb(47, 128, 237); margin-left: -50px; width:<?= (float)$kgiDetail["ratio"] > 100 ? '100' : $kgiDetail["ratio"] ?>%;"></div>
							<span class="badge rounded-pill  pro-load-Backdrop3" id="decimalHistory"><?= $kgiDetail["ratio"] ?>%</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-12 mt-20">
		<?php
		$form = ActiveForm::begin([
			'id' => 'create-kgi-personal',
			'method' => 'post',
			'options' => [
				'enctype' => 'multipart/form-data',
			],
			'action' => Yii::$app->homeUrl . 'kgi/kgi-personal/set-personal-target'

		]);
		if (isset($kgiEmployees) && count($kgiEmployees) > 0) {
			$i = 1;
			$userTeamId = User::userTeamId();
			foreach ($kgiEmployees as $teamId => $employeeKgi) :
				if ($role == 3 && $teamId == $userTeamId) {
					$disabled = "";
				} else {
					if ($role > 3) {
						$disabled = "";
					} else {
						$disabled = "disabled";
					}
				}
		?>
				<div class="row mt-20">
					<div class="col-5 pl-10 font-size-16 font-b mt-10 mb-10 border-bottom pb-10">
						<?= $i ?>. <?= Team::teamName($teamId) ?>
					</div>
					<div class="col-5 text-end font-size-16 font-b mt-10 mb-10 border-bottom pb-10">
						<?= Yii::t('app', 'Target') ?> : : <?= number_format(KgiTeam::teamTarget($teamId, $kgiId), 2) ?>
					</div>
				</div>
				<?php
				if (count($employeeKgi) > 0) {
					$j = 1;
					foreach ($employeeKgi as $employee) :
				?>
						<div class="row">
							<div class="col-1 mt-10"></div>
							<div class="col-4 mt-10 border-bottom pb-10">
								<?= $i ?>.<?= $j ?> <?= $employee["employeeName"] ?>
							</div>
							<div class="col-3 mr-10 border-bottom pb-10 mt-10">
								<input class="form-control text-end" type="text" name="target[<?= $employee["employeeId"] ?>]" value="<?= number_format($employee['target'], 2) ?>" <?= $disabled ?>>
							</div>
							<div class="col-3 mr-10 border-bottom pb-10 mt-10">
								<textarea class="form-control font-size-14" name="remark[<?= $employee['employeeId'] ?>]"><?= $employee['remark'] ?></textarea>
							</div>
						</div>
			<?php
						$j++;
					endforeach;
				}
				$i++;
			endforeach; ?>
			<div class="col-11 text-end mt-20">
				<input type="hidden" name="kgiId" value="<?= $kgiId ?>">
				<button type="submit" class="btn btn-primary" style="letter-spacing: 1px;"><?= Yii::t('app', 'SAVE') ?></button>
			</div>

		<?php
		} else { ?>
			<div class="col-12 text-center font-size-14 mt-20">
				<?= Yii::t('app', "This Kgi haven't assiged to any employee") ?>.
			</div>
		<?php
		}
		ActiveForm::end(); ?>
	</div>
</div>