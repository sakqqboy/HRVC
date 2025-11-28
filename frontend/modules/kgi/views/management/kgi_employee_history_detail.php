<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\User;

$this->title = 'Employee KGI History';
?>
<div class="col-12">
	<div class="row">
		<div class="col-8">
			<i class="fa fa-users font-size-20 mr-5" aria-hidden="true"></i>
			<span class="pim-head-text"> <?= Yii::t('app', 'Performance Indicator Matrices (PIM)') ?></span>
		</div>
		<div class="col-4 text-end pr-15">
			<a href="<?= Yii::$app->homeUrl ?>kgi/management/wait-approve" class="btn btn-secondary font-size-12">
				<i class="fa fa-chevron-left mr-5" aria-hidden="true"></i>
				<?= Yii::t('app', 'Back') ?>
			</a>
		</div>
	</div>
	<div class="col-12 mt-10 pt-10 pl-10 pb-20 pim-body bg-white" style="border-radius: 10px;border-style:dotted;border-color:grey;">
		<strong>KGI : <?= $kgiDetail["kgiName"] ?></strong>
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
						<?= Yii::t('app', $kgiDetail["unitText"]) ?>
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
	<div class="row mt-20 pl-15 pr-15">
		<div class="col-lg-6 col-md-6 col-12 pim-body bg-white" style="border-top-left-radius: 10px;border-bottom-left-radius: 10px;">
			<div class="row">
				<div class="col-12 font-b pb-5 border-bottom"><?= $employeeName ?></div>

			</div>
			<?php
			if (isset($kgiEmployees) && count($kgiEmployees) > 0) { ?>
				<table class="table table-condensed mt-10">
					<thead>
						<tr style="background-color: #E6E6FA;">
							<th>#</th>
							<th class="text-center"><?= Yii::t('app', 'Target') ?></th>
							<th class=text-center><?= Yii::t('app', 'Reson') ?></th>
							<th><?= Yii::t('app', 'By') ?></th>
							<th><?= Yii::t('app', 'Status') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$a = 1;
						foreach ($kgiEmployees as $history) :
							$decimalTarget = explode('.', $history["target"]);
							if ($history["status"] == 1) {
								$class = "";
								$textStatus = "Active";
							}
							if ($history["status"] == 2) {
								$class = "text-success";
								$textStatus = "Finished";
							}
							if ($history["status"] == 88) {
								$class = "text-warning";
								$textStatus = "Waiting for approve";
							}
							if ($history["status"] == 89) {
								$class = "text-danger";
								$textStatus = "Reject";
							}
							if ($history["status"] == 90) {
								$class = "";
								$textStatus = "Not active";
							}
						?>
							<tr class="font-size-12">
								<td><?= $a ?></td>
								<td class="text-end font-b"><?= isset($decimalTarget[1]) && $decimalTarget[1] == '00' ? number_format($history["target"]) : number_format($history["target"], 2) ?></td>
								<td style="width: 10%;"><?= $history["detail"] ?></td>
								<td>&nbsp;<?= User::employeeNameByuserId($history["createrId"]) ?></td>
								<td class="<?= $class ?>"><?= Yii::t('app', $textStatus) ?></td>
							</tr>
						<?php
							$a++;
						endforeach;
						?>
					</tbody>
				</table>
			<?php
			} else { ?>
				<div class="col-12 text-secondary font-b font-size-14 mt-10"><?= Yii::t('app', 'Not fouund') ?></div>
			<?php

			}
			?>
		</div>
		<div class="col-lg-6 col-md-6 col-12 pim-body bg-white" style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;">
			<div class="col-12 font-b pb-5 border-bottom text-end"><?= Yii::t('app', 'Employees') ?></div>
			<?php
			if (isset($allEmployee) && count($allEmployee) > 0) {
			?>
				<table class="table table-condensed mt-10">
					<thead>
						<tr class="bg-body-secondary">
							<th>#</th>
							<th>Name</th>
							<th class="text-center"><?= Yii::t('app', 'Target') ?></th>
							<th class="text-center"><?= Yii::t('app', 'Result') ?></th>
							<th><?= Yii::t('app', 'Assigned By') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						foreach ($allEmployee as $employee) :
							$decimalTarget = explode('.', $employee["target"]);
							$decimalResult = explode('.', $employee["result"]);
							$name = Employee::employeeName($employee["employeeId"]);
						?>
							<tr class="font-size-12">
								<td><?= $i ?></td>
								<td class="<?= $employeeName == $name ? 'font-b' : '' ?>"><?= $name ?></td>
								<td class="text-end border-right <?= $employeeName == $name ? 'font-b' : '' ?>"><?= isset($decimalTarget[1]) && $decimalTarget[1] == '00' ? number_format($employee["target"]) : number_format($employee["target"], 2) ?></td>
								<td class="text-end border-right"><?= $decimalResult[1] == '00' ? number_format($employee["result"]) : number_format($employee["result"], 2) ?></td>
								<td>&nbsp;<?= User::employeeNameByuserId($employee["createrId"]) ?></td>
							</tr>
						<?php
							$i++;
						endforeach;
						?>
					</tbody>
				</table>
			<?php
			} else {
			?>
				<div class="col-12 text-secondary font-b font-size-14 mt-10"><?= Yii::t('app', 'Not fouund') ?></div>
			<?php
			}
			?>
		</div>
	</div>
</div>