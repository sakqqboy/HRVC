<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\User;

$this->title = 'Team kgi History';
?>
<div class="col-12 mt-90">
	<div class="row">
		<div class="col-8">
			<i class="fa fa-users font-size-20" aria-hidden="true"></i> <strong class="font-size-20">
				Request changing KGI Team target
			</strong>
		</div>
		<div class="col-4 text-end pr-15">
			<a href="<?= Yii::$app->homeUrl ?>kgi/management/wait-approve" class="btn btn-secondary font-size-12">
				<i class="fa fa-chevron-left mr-5" aria-hidden="true"></i>
				Back
			</a>
		</div>
	</div>
	<div class="col-12 mt-20 pt-10 pl-10 pb-20" style="border-radius: 10px;border-style:dotted;border-color:grey;">
		<strong>KGI : <?= $kgiDetail["kgiName"] ?></strong>
		<div class="row">
			<div class="col-lg-2 col-md-6 col-2 text-center">
				<div class="col-12 pt-25 pb-25 font-b font-size-20">
					<?= $kgiDetail["monthName"] ?>
				</div>
				<div class="col-12  text-center">
					<p class="font-size-10 mb-20">Priority</p>
					<div class="circle-Priority" style="margin-left: 70px !important;">
						<?= $kgiDetail["priority"] ?>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-3">
				<div class="col-12 Quant-ratio-Backdrop3">
					Quant Ratio
				</div>
				<div class="col-12 diamond-con-Backdrop3 mt-10">
					<i class="fa fa-diamond" aria-hidden="true"></i>
					<span id="quanRatioHistory"><?= $kgiDetail["quantRatio"] == 1 ? "Quantity" : "Quality" ?></span>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-3 text-center">
				<div class="col-12 bullseye-con-Backdrop3">
					<i class="fa fa-bullseye" aria-hidden="true"></i> Target
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
					<i class="fa fa-trophy" aria-hidden="true"></i> Result
				</div>
				<div class="col-12 million-number-Backdrop3 mt-10 " id="resultHistory">
					<?= $kgiDetail["amountType"] == 1 ? number_format($kgiDetail["result"], 2) : number_format($kgiDetail["result"]) ?>
				</div>
			</div>
			<div class="row" style="margin-top: -40px;">
				<div class="col-lg-2 col-md-6 col-5"></div>
				<div class="col-lg-4 col-md-6 col-6">
					<div class="col-12 padding-update-Backdrop3">
						Update Interval
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
	<div class="row mt-20">
		<div class="col-lg-6 col-md-6 col-12">
			<div class="row">
				<div class="col-7 font-b pb-5 border-bottom"><?= $teamName ?></div>
				<div class="col-5 text-end font-b pb-5 border-bottom font-size-12">
					<a href="javascript:approveTargetKgiTeam(<?= $kgiTeam['kgiTeamId'] ?>,0)" class="btn btn-sm btn-danger font-size-10 mr-3">Reject</a>
					<a href="javascript:approveTargetKgiTeam(<?= $kgiTeam['kgiTeamId'] ?>,1)" class="btn btn-sm btn-primary font-size-10">Approve</a>
				</div>
			</div>
			<?php
			if (isset($kgiTeamHistories) && count($kgiTeamHistories) > 0) { ?>
				<table class="table table-condensed mt-10">
					<thead>
						<tr style="background-color: #E6E6FA;">
							<th>#</th>
							<th class="text-center">Target</th>
							<th class=text-center>Reson</th>
							<th>By</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$a = 1;
						foreach ($kgiTeamHistories as $history) :
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
						?>
							<tr class="font-size-12">
								<td><?= $a ?></td>
								<td class="text-end font-b"><?= $decimalTarget[1] == '00' ? number_format($history["target"]) : number_format($history["target"], 2) ?></td>
								<td style="width: 10%;"><?= $history["detail"] ?></td>
								<td>&nbsp;<?= User::employeeNameByuserId($history["createrId"]) ?></td>
								<td class="<?= $class ?>"><?= $textStatus ?></td>
							</tr>
						<?php
							$a++;
						endforeach;
						?>
					</tbody>
				</table>
			<?php
			} else { ?>
				<div class="col-12 text-secondary font-b font-size-14 mt-10">Not fouund</div>
			<?php

			}
			?>
		</div>
		<div class="col-lg-6 col-md-6 col-12">
			<div class="col-12 font-b pb-5 border-bottom text-end">All teams</div>
			<?php
			if (isset($allTeams) && count($allTeams) > 0) {
			?>
				<table class="table table-condensed mt-10">
					<thead>
						<tr class="bg-body-secondary">
							<th>#</th>
							<th>Team</th>
							<th class="text-center">Target</th>
							<th class="text-center">Result</th>
							<th>Assigned By</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						foreach ($allTeams as $team) :
							if ($team["target"] != '') {
								$decimalTarget = explode('.', $team["target"]);
							} else {
								$decimalTarget[1] = '00';
							}
							if ($team["result"] != '') {
								$decimalResult = explode('.', $team["result"]);
							} else {
								$decimalResult[1] = '00';
							}
						?>
							<tr class="font-size-12">
								<td><?= $i ?></td>
								<td class="<?= $teamName == $team["teamName"] ? 'font-b' : '' ?>"><?= $team["teamName"] ?></td>
								<td class="text-end border-right <?= $teamName == $team["teamName"] ? 'font-b' : '' ?>"><?= $decimalTarget[1] == '00' ? number_format($team["target"]) : number_format($team["target"], 2) ?></td>
								<td class="text-end border-right"><?= $decimalResult[1] == '00' ? number_format($team["result"]) : number_format($team["result"], 2) ?></td>
								<td>&nbsp;<?= User::employeeNameByuserId($team["createrId"]) ?></td>
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
				<div class="col-12 text-secondary font-b font-size-14 mt-10">Not fouund</div>
			<?php
			}
			?>
		</div>
	</div>
</div>