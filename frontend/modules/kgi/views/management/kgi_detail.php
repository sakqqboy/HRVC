<?php


$this->title = 'KGI Detail';
?>
<div class="col-12 mt-90">
	<div class="row">
		<div class="col-12">
			<i class="fa fa-flag mr-5" aria-hidden="true"></i>
			<strong class="font-size-20">KGI : : <?= $kgi["kgiName"] ?></strong>
		</div>
	</div>
	<div class="col-12 mt-20 border-bottom pb-15" id="kgi-<?= $kgiId ?>">
		<div class="row">
			<div class="col-lg-7 col-md-6 col-12">
				<div class="row">
					<div class="col-12 mt-10">
						<div class="row">
							<div class="col-lg-4 col-md-4 col-2 font-size-16" style="margin-top: -3px;">
								<span class="badge rounded-pill ml-5 <?= $kgi['status'] == 4 ? 'bg-success' : 'bg-warning text-dark' ?> "> <?= $kgi['status'] == 4 ? 'Completed' : 'On process' ?></span>
							</div>
							<div class="col-lg-3 col-md-3 col-4 font-b text-center">
								<?= $kgi["monthName"] ?>
							</div>
							<div class="col-lg-5 col-md-5 col-6 text-end font-size-13 font-b text-dark pt-3">
								Term : <?= $kgi["fromDateDetail"] ?> - <?= $kgi["toDateDetail"] ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-5 col-md-6 col-12">
				<div class="row">
					<div class="col-12 text-end">
						<?= $kgi["companyName"] ?>
					</div>
					<div class="col-12 text-end mt-5">
						<img src="<?= Yii::$app->homeUrl ?><?= $kgi["flag"] ?>" class="image-flex"> <?= $kgi["branch"] ?>, <?= $kgi["countryName"] ?>
					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="col-12 mt-20">
		<div class="row">
			<div class="col-lg-3 col-6">
				<div class="col-12 text-success">
					<i class="fa fa-refresh mr-5" aria-hidden="true"></i> Latest Update
				</div>
				<div class="col-12 pt-5 pl-15 font-size-13" style="font-weight: 700;">
					<?= $kgi['periodCheck'] != '' ? $kgi['periodCheck'] : '-' ?>
				</div>
			</div>
			<div class="col-lg-5 col-md-9 col-6">
				<div class="col-12">
					<i class="fa fa-chevron-right mr-5" aria-hidden="true"></i>Next Update
					<span class="col-12 pencil-nextupdate" data-bs-toggle="modal" data-bs-target="#update-kgi-modal" onclick="javascript:updateKgi(<?= $kgiId ?>)">
						<i class="fa fa-pencil-square-o ml-3" aria-hidden="true"></i>
					</span>
				</div>
				<div class="col-12 pt-5 pl-15 font-size-13 <?= $kgi['isOver'] == 1 ? 'text-danger' : '' ?>" style="font-weight: 700;">
					<?= $kgi['nextCheck'] != '' ? $kgi['nextCheck'] : '-' ?>
				</div>
			</div>
			<div class="col-2 text-end">
				<a class="no-underline-black ml-2 mt-3 font-size-14" href="#team">
					<span class="badge rounded-pill bg-bsc font-size-14">
						<i class="fa fa-users mr-5" aria-hidden="true"></i> <?= $kgi["countTeam"] ?> TEAMS
					</span>
				</a>
			</div>
			<div class="col-2 text-end">

				<span class="badge rounded-badge bg-white">
					<?php
					if (isset($kgi["kgiEmployee"]) && count($kgi["kgiEmployee"]) > 0) {
						$e = 1;
						foreach ($kgi["kgiEmployee"] as $emp) : ?>
							<img class="employee-image-detail" src="<?= Yii::$app->homeUrl . $emp ?>">
					<?php
							if ($e == 3) {
								break;
							}
							$e++;
						endforeach;
					}
					?>
					<a class="no-underline-black ml-2 mt-3 font-size-14" href="#employee"><?= count($kgi["kgiEmployee"]) ?> EMPLOYEE(S)</a>
				</span>
			</div>
		</div>
	</div>
	<div class="col-12 border-bottom pb-20">
		<div class="row pb-3 mt-30">
			<div class="col-lg-3 col-md-3 col-12">
				<div class="col-12 text-center">
					Priority
				</div>
				<div class="col-12 mt-10" style="padding-left: 37%;">
					<div class="priority-detail text-center"><?= $kgi["priority"] ?></div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-12 sample-bordersolid">
				<div class="row">
					<div class="row">
						<div class="col-6 pt-15">
							Quant Ratio
						</div>
						<div class="col-6 pt-20 font-b font-size-13">
							<i class="fa fa-diamond" aria-hidden="true"></i> <?= $kgi["quantRatio"] == 1 ? 'Quantity' : 'Quality' ?>
						</div>
					</div>
					<div class="row">
						<div class="col-6 pt-20">
							Update Interval
						</div>
						<div class="col-6 mt-5 pt-20 font-b font-size-13">
							<i class="fa fa-calendar mr-3" aria-hidden="true"></i> <?= $kgi["unitText"] ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-5 col-md-6 col-12 mt-10 border-left">
				<div class="col-12">
					<div class="row">
						<div class="col-5">
							<div class="col-12 text-center">
								<i class="fa fa-bullseye" aria-hidden="true"></i> Target
							</div>
							<div class="col-12 font-size-13 font-b text-center mt-5">
								<?php
								$decimal = explode('.', $kgi["targetAmount"]);
								if (isset($decimal[1])) {
									if ($decimal[1] == '00') {
										$show = number_format($decimal[0]);
									} else {
										$show = number_format($kgi["targetAmount"], 2);
									}
								} else {
									$show = number_format($kgi["targetAmount"]);
								}
								?>
								<?= $show ?><?= $kgi["amountType"] == 1 ? '%' : '' ?>
							</div>
						</div>
						<div class="col-2 text-center font-size-16 font-b">
							<div class="col-12 mt-25">
								<?= $kgi["code"] ?>
							</div>
						</div>
						<div class="col-5">
							<div class="col-12 text-center">
								<i class="fa fa-trophy" aria-hidden="true"></i> Result
							</div>
							<div class="col-12 font-size-13 font-b text-center mt-5">
								<?php
								if ($kgi["result"] != '') {
									$decimalResult = explode('.', $kgi["result"]);
									if (isset($decimalResult[1])) {
										if ($decimalResult[1] == '00') {
											$showResult = number_format($decimalResult[0]);
										} else {
											$showResult = number_format($kgi["result"], 2);
										}
									} else {
										$showResult = number_format($kgi["result"]);
									}
								} else {
									$showResult = 0;
								}
								?>
								<?= $showResult ?><?= $kgi["amountType"] == 1 ? '%' : '' ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 mt-15">
					<div class="progress">
						<div class="progress-bar" style="width:<?= $kgi['ratio'] ?>%;"></div>
						<?php
						$decimal = explode(".", $kgi['ratio']);
						if (isset($decimal[1]) && $decimal[1] == '00') {
							$number = $decimal[0];
						} else {
							$number = $kgi['ratio'];
						}
						?>
						<span class="badge rounded-pill progress-bar-percent-detail">
							<div class="mt-20 font-size-12" style="margin-left: -10px;"><?= $kgi['ratio'] ?> %</div>
						</span>
					</div>
				</div>
			</div>

		</div>
	</div>
	<div class="col-12 border-bottom pb-20">
		<div class="row mt-20">
			<div class="col-5" id="team">
				<div class="col-12 font-size-16 font-b">
					Teams (<?= $kgi["countTeam"] ?>)
				</div>
				<div class="col-12 mt-10 ml-10">
					<?= $res["teamText"] ?>
				</div>
			</div>
			<div class="col-7 border-left" id="employee">
				<div class="col-12 font-size-16 font-b">
					Employees (<?= count($kgi["kgiEmployee"]) ?>)
				</div>
				<div class="col-12 mt-10 text-center">
					<?= $res["employeeText"] ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-12 border-bottom pb-20">
		<div class="row mt-20">
			<div class="col-12">
				<div class="col-12 font-size-16 font-b">
					Update History
				</div>
				<div class="col-12 mt-10 text-center">
					<?= $res["historyText"] ?>
				</div>
			</div>

		</div>
	</div>
	<div class="col-12 pb-20">
		<div class="row mt-20">
			<div class="col-12">
				<div class="col-12 font-size-16 font-b">
					Issue & Solution
				</div>
				<div class="col-12 mt-10">
					<?= $res["issueText"] ?>
				</div>
			</div>

		</div>
	</div>
	<?= $this->render('modal_team_history') ?>
	<?= $this->render('modal_employee_history') ?>
</div>