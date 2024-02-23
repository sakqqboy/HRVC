<?php

use common\models\ModelMaster;

$this->title = "Individual KPI Detail";
?>
<div class="col-12 mt-90 pd-Performance">
	<div class="row">
		<div class="col-8">
			<i class="fa fa-users font-size-20" aria-hidden="true"></i>
			<strong class="font-size-20">
				Indivisual KPI Setting :: <?= $kpiEmployeeDetail["employeeName"] ?>
			</strong>
		</div>
		<div class="col-4 text-end pr-15">
			<a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/individual-kpi" class="btn btn-secondary font-size-12">
				<i class="fa fa-chevron-left mr-5" aria-hidden="true"></i>
				Back
			</a>
		</div>
	</div>
	<div class="col-12 mt-20 pt-10 pl-10 pb-20" style="border-radius: 10px;border-style:dotted;border-color:grey;">
		<strong>KPI : <?= $kpiEmployeeDetail["kpiName"] ?></strong>
		<div class="row">
			<div class="col-lg-2 col-md-6 col-2 text-center">
				<div class="col-12 pt-25 pb-25 font-b font-size-20">
					<?= $kpiEmployeeDetail["monthName"] ?>
				</div>
				<div class="col-12  text-center">
					<p class="font-size-10 mb-20">Priority</p>
					<div class="circle-Priority" style="margin-left: 70px !important;">
						<?= $kpiEmployeeDetail["priority"] ?>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-3">
				<div class="col-12 Quant-ratio-Backdrop3">
					Quant Ratio
				</div>
				<div class="col-12 diamond-con-Backdrop3 mt-10">
					<i class="fa fa-diamond" aria-hidden="true"></i>
					<span id="quanRatioHistory"><?= $kpiEmployeeDetail["quantRatio"] == 1 ? "Quantity" : "Quality" ?></span>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-3 text-center">
				<div class="col-12 bullseye-con-Backdrop3">
					<i class="fa fa-bullseye" aria-hidden="true"></i> Target
				</div>
				<div class="col-12 million-number-Backdrop3 mt-10" id="targetHistory">
					<?= $kpiEmployeeDetail["amountType"] == 1 ? number_format($kpiEmployeeDetail["target"], 2) : number_format($kpiEmployeeDetail["target"]) ?>
				</div>
			</div>
			<div class="col-lg-1 col-md-6 col-3 text-center">
				<div class="col-12 padding-mark-Backdrop3 mt-25 " id="codeHistory">
					<?= $kpiEmployeeDetail["code"] ?>
				</div>
			</div>
			<div class="col-lg-3 cl-md-6 col-3 text-center">
				<div class="col-12 trophy-con-Backdrop3">
					<i class="fa fa-trophy" aria-hidden="true"></i> Result
				</div>
				<div class="col-12 million-number-Backdrop3 mt-10 " id="resultHistory">
					<?= $kpiEmployeeDetail["amountType"] == 1 ? number_format($kpiEmployeeDetail["result"], 2) : number_format($kpiEmployeeDetail["result"]) ?>
				</div>
			</div>
			<div class="row" style="margin-top: -40px;">
				<div class="col-lg-2 col-md-6 col-5"></div>
				<div class="col-lg-4 col-md-6 col-6">
					<div class="col-12 padding-update-Backdrop3">
						Update Interval
					</div>
					<div class="col-12 update-mouth-Backdrop3 mt-10" id="unitHistory">
						<?= $kpiEmployeeDetail["unitText"] ?>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-6" style="margin-top:-20px;">
					<div class="col-12 pt-20">
						<div class="progress">
							<div class="progress-bar" id="progressHistory" style="background: rgb(47, 128, 237);width:<?= (float)$kpiEmployeeDetail["ratio"] > 100 ? '100' : $kpiEmployeeDetail["ratio"] ?>%;"></div>
							<span class="badge rounded-pill  pro-load-Backdrop3" id="decimalHistory"><?= $kpiEmployeeDetail["ratio"] ?>%</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-12 mt-20 font-size-14 font-b">
		Remark
	</div>
	<div class="col-12 mt-10">
		<?= $kpiEmployeeDetail["remark"] == '' ? '-' : $kpiEmployeeDetail["remark"] ?>
	</div>
	<div class="col-12 mt-20 font-size-14 font-b">
		Update Description
	</div>
	<div class="col-12 mt-10">
		<div class="row border-buttom font-b mb-20">
			<div class="col-4 pb-10">Progress</div>
			<div class="col-2 pb-10 text-end">Target</div>
			<div class="col-2 pb-10 text-end">Result</div>
			<div class="col-2 pb-10 text-center">Status</div>
			<div class="col-2 pb-10">Date</div>
		</div>
		<?php
		if (isset($kpiEmployeeHistory) && count($kpiEmployeeHistory) > 0) {
			$i = 1;
			foreach ($kpiEmployeeHistory as $history) :
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
		?>
				<div class="row alert <?= $alert ?> <?= $fontB ?>">
					<div class="col-4"><?= $i ?>&nbsp;&nbsp;&nbsp;<?= $history["detail"] ?></div>
					<div class="col-2 text-end"><?= number_format($history["target"], 2) ?></div>
					<div class="col-2 text-end"><?= number_format($history["result"], 2) ?></div>
					<div class="col-2 text-center"><?= $status ?></div>
					<div class="col-2"><?= ModelMaster::engDate($history["createDateTime"], 2) ?></div>
				</div>
			<?php
				$i++;
			endforeach;
		} else { ?>
			<div class="col-12 mt-20 alert alert-secondary text-center">No updates found</div>
		<?php
		}
		?>
	</div>
</div>