<?php

use common\models\ModelMaster;

$this->title = "Individual KGI Detail";
?>
<div class="col-12 mt-90 pd-Performance">
	<div class="row">
		<div class="col-8">
			<i class="fa fa-users font-size-20" aria-hidden="true"></i>
			<strong class="font-size-20">
				<?= Yii::t('app', 'Indivisual KGI Setting') ?> :: <?= $kgiEmployeeDetail["employeeName"] ?>
			</strong>
		</div>
		<div class="col-4 text-end pr-15">
			<a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/individual-kgi-grid" class="btn btn-secondary font-size-12">
				<i class="fa fa-chevron-left mr-5" aria-hidden="true"></i>
				<?= Yii::t('app', 'Back') ?>
			</a>
		</div>
	</div>
	<div class="col-12 mt-20 pt-10 pl-10 pb-20" style="border-radius: 10px;border-style:dotted;border-color:grey;">
		<strong>KGI : <?= $kgiEmployeeDetail["kgiName"] ?></strong>
		<div class="row">
			<div class="col-lg-2 col-md-6 col-2 text-center">
				<div class="col-12 pt-25 pb-25 font-b font-size-20">
					<?= $kgiEmployeeDetail["monthName"] ?>
				</div>
				<div class="col-12  text-center">
					<p class="font-size-10 mb-20"><?= Yii::t('app', 'Priority<') ?>/p>
					<div class="circle-Priority" style="margin-left: 70px !important;">
						<?= $kgiEmployeeDetail["priority"] ?>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-3">
				<div class="col-12 Quant-ratio-Backdrop3">
					<?= Yii::t('app', 'Quant Ratio') ?>
				</div>
				<div class="col-12 diamond-con-Backdrop3 mt-10">
					<i class="fa fa-diamond" aria-hidden="true"></i>
					<span id="quanRatioHistory"><?= $kgiEmployeeDetail["quantRatio"] == 1 ? Yii::t('app', 'Quantity') : Yii::t('app', 'Quality') ?></span>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-3 text-center">
				<div class="col-12 bullseye-con-Backdrop3">
					<i class="fa fa-bullseye" aria-hidden="true"></i> <?= Yii::t('app', 'Target') ?>
				</div>
				<div class="col-12 million-number-Backdrop3 mt-10" id="targetHistory">
					<?= $kgiEmployeeDetail["amountType"] == 1 ? number_format($kgiEmployeeDetail["target"], 2) : number_format($kgiEmployeeDetail["target"]) ?>
				</div>
			</div>
			<div class="col-lg-1 col-md-6 col-3 text-center">
				<div class="col-12 padding-mark-Backdrop3 mt-25 " id="codeHistory">
					<?= $kgiEmployeeDetail["code"] ?>
				</div>
			</div>
			<div class="col-lg-3 cl-md-6 col-3 text-center">
				<div class="col-12 trophy-con-Backdrop3">
					<i class="fa fa-trophy" aria-hidden="true"></i> <?= Yii::t('app', 'Result') ?>
				</div>
				<div class="col-12 million-number-Backdrop3 mt-10 " id="resultHistory">
					<?= $kgiEmployeeDetail["amountType"] == 1 ? number_format($kgiEmployeeDetail["result"], 2) : number_format($kgiEmployeeDetail["result"]) ?>
				</div>
			</div>
			<div class="row" style="margin-top: -40px;">
				<div class="col-lg-2 col-md-6 col-5"></div>
				<div class="col-lg-4 col-md-6 col-6">
					<div class="col-12 padding-update-Backdrop3">
						<?= Yii::t('app', 'Update Interval') ?>
					</div>
					<div class="col-12 update-mouth-Backdrop3 mt-10" id="unitHistory">
						<?= Yii::t('app', $kgiEmployeeDetail["unitText"]) ?>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-6" style="margin-top:-20px;">
					<div class="col-12 pt-20">
						<div class="progress">
							<div class="progress-bar" id="progressHistory" style="background: rgb(47, 128, 237); width:<?= (float)$kgiEmployeeDetail["ratio"] > 100 ? '100' : $kgiEmployeeDetail["ratio"] ?>%;"></div>
							<span class="badge rounded-pill  pro-load-Backdrop3" id="decimalHistory"><?= $kgiEmployeeDetail["ratio"] ?>%</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-12 mt-20 font-size-14 font-b">
		<?= Yii::t('app', 'Remark') ?>
	</div>
	<div class="col-12 mt-10">
		<?= $kgiEmployeeDetail["remark"] == '' ? '-' : $kgiEmployeeDetail["remark"] ?>
	</div>
	<div class="col-12 mt-20 font-size-14 font-b">
		<?= Yii::t('app', 'Update Description') ?>
	</div>
	<div class="col-12 mt-10">
		<div class="row border-buttom font-b mb-20 font-size-12">
			<div class="col-2 pb-10"><?= Yii::t('app', 'Progress') ?></div>
			<div class="col-2 pb-10 text-end"><?= Yii::t('app', 'Target') ?></div>
			<div class="col-2 pb-10 text-end"><?= Yii::t('app', 'Result') ?></div>
			<div class="col-2 pb-10 text-center"><?= Yii::t('app', 'Ratio') ?></div>
			<div class="col-1 pb-10 text-center"><?= Yii::t('app', 'Month') ?></div>
			<div class="col-1 pb-10 text-center"><?= Yii::t('app', 'Status') ?></div>
			<div class="col-2 pb-10"><?= Yii::t('app', 'Date') ?></div>
		</div>
		<?php
		if (isset($kgiEmployeeHistory) && count($kgiEmployeeHistory) > 0) {
			$i = 1;
			foreach ($kgiEmployeeHistory as $history) :
				if ($history["status"] == 1) {
					$alert = 'alert-secondary';
					$status = 'Active';
					$fontB = '';
				}
				if ($history["status"] == 2) {
					$alert = 'alert-success';
					$status = 'Finished';
					$fontB = 'font-b';
				}
				if ($history["status"] == 88) {
					$alert = 'alert-warning';
					$status = 'Wait for approve';
					$fontB = '';
				}
				if ($history["status"] == 89) {
					$alert = 'alert-danger';
					$status = 'Reject';
					$fontB = '';
				}
				$ratio = 0;
				if ($history["target"] != '' && $history["target"] != 0 && $history["target"] != null) {
					if ($history["code"] == '<' || $history["code"] == '=') {
						$ratio = ($history["result"] / $history["target"]) * 100;
					} else {
						if ($history["result"] != '' && $history["result"] != 0) {
							$ratio = ($kgiTeam["target"] / $history["result"]) * 100;
						} else {
							$ratio = 0;
						}
					}
				} else {
					$ratio = 0;
				}

				$decimal = explode('.', $ratio);
				if (isset($decimal[1])) {
					if ($decimal[1] == '00') {
						$number = number_format($decimal[0]) . '%';
					} else {
						$number = number_format($ratio, 2) . '%';
					}
				} else {
					$number = number_format($ratio) . '%';
				}
		?>
				<div class="row alert <?= $alert ?> <?= $fontB ?> font-size-10">
					<div class="col-2"><?= $i ?>&nbsp;&nbsp;&nbsp;<?= $history["detail"] ?></div>
					<div class="col-2 text-end"><?= number_format($history["target"], 2) ?></div>
					<div class="col-2 text-end"><?= number_format($history["result"], 2) ?></div>
					<div class="col-2 text-center"><?= $number ?></div>
					<div class="col-1 text-center"><?= Yii::t('app', ModelMaster::shotMonthText($history["month"])) ?></div>
					<div class="col-1 text-center"><?= Yii::t('app', $status) ?></div>
					<div class="col-2"><?= ModelMaster::engDate($history["createDateTime"], 2) ?></div>
				</div>
			<?php
				$i++;
			endforeach;
		} else { ?>
			<div class="col-12 mt-20 alert alert-secondary text-center"><?= Yii::t('app', 'No updates found') ?></div>
		<?php
		}
		?>
	</div>
</div>