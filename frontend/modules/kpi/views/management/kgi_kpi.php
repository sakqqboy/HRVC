<?php

use common\models\ModelMaster;
use frontend\models\hrvc\KfiBranch;
use frontend\models\hrvc\KgiBranch;
use frontend\models\hrvc\Unit;

$this->title = 'KGI KPI';
?>
<div class="col-12 mt-90">
	<div class="row">
		<div class="col-9">
			<i class="fa fa-share-alt font-size-20 mr-3" aria-hidden="true"></i>
			<strong class="font-size-20">Related KGI for KPI</strong>
		</div>
		<div class="col-3 text-end">
			<a href="<?= Yii::$app->homeUrl ?>kpi/management/assign-kpi" class="font-size-14 btn btn-outline-secondary">
				<i class="fa fa-chevron-left mr-5" aria-hidden="true"></i>
				KPI Assign Management
			</a>
		</div>

	</div>
	<div class="col-12 mt-20 pt-10 pl-10 pb-10" style="border-radius: 10px;border-style:dotted;border-color:grey;">
		<strong>KPI : <?= $kpiDetail["kpiName"] ?></strong>
		<div class="row mt-20">
			<div class="col-lg-2 col-md-6 col-2 text-center">
				<div class="col-12 pt-25 pb-25 font-b font-size-20">
					<?= $kpiDetail["monthName"] ?>
				</div>
				<div class="col-12  text-center">
					<p class="font-size-10 mb-20">Priority</p>
					<div class="circle-Priority" style="margin-left: 70px !important;">
						<?= $kpiDetail["priority"] ?>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-3">
				<div class="col-12 Quant-ratio-Backdrop3">
					Quant Ratio
				</div>
				<div class="col-12 diamond-con-Backdrop3 mt-10">
					<i class="fa fa-diamond" aria-hidden="true"></i>
					<span id="quanRatioHistory"><?= $kpiDetail["quantRatio"] == 1 ? "Quantity" : "Quality" ?></span>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-3 text-center">
				<div class="col-12 bullseye-con-Backdrop3">
					<i class="fa fa-bullseye" aria-hidden="true"></i> Target
				</div>
				<div class="col-12 million-number-Backdrop3 mt-10" id="targetHistory">
					<?= $kpiDetail["targetAmount"] ?>
				</div>
			</div>
			<div class="col-lg-1 col-md-6 col-3 text-center">
				<div class="col-12 padding-mark-Backdrop3 mt-25 " id="codeHistory">
					<?= $kpiDetail["code"] ?>
				</div>
			</div>
			<div class="col-lg-3 cl-md-6 col-3 text-center">
				<div class="col-12 trophy-con-Backdrop3">
					<i class="fa fa-trophy" aria-hidden="true"></i> Result
				</div>
				<div class="col-12 million-number-Backdrop3 mt-10 " id="resultHistory">
					<?= $kpiDetail["result"] ?>
				</div>
			</div>
			<div class="row" style="margin-top: -40px;">
				<div class="col-lg-2 col-md-6 col-5"></div>
				<div class="col-lg-4 col-md-6 col-6">
					<div class="col-12 padding-update-Backdrop3">
						Update Interval
					</div>
					<div class="col-12 update-mouth-Backdrop3 mt-10" id="unitHistory">
						<?= $kpiDetail["unitText"] ?>
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
	<div class="col-12 mt-20">
		<u><b>Current related KGI (<?= count($kpiHasKgi) ?>)</b></u>
	</div>
	<div class="col-12 mt-20">

		<table class="table table-responsive-lg">
			<thead>
				<th>KPI Name</th>
				<th>Target</th>
				<th>Month</th>
				<th>Unit</th>
				<th>Branch(es)</th>
			</thead>
			<tbody>
				<?php
				if (isset($kpiHasKgi) && count($kpiHasKgi) > 0) {
					$a = 1;
					foreach ($kpiHasKgi as $kgi) : ?>
						<tr>
							<td><?= $a ?>.
								<span class="font-b" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#kgi-view" onclick="javascript:kgiHistory(<?= $kgi['kgiId'] ?>)">
									<?= $kgi["kgiName"] ?>
								</span>
							</td>
							<td><?= number_format($kgi["targetAmount"], 2) ?></td>
							<td><?= ModelMaster::shotMonthText($kgi["month"]) ?></td>
							<td><?= Unit::unitName($kgi["unitId"]) ?></td>
							<td>
								<div class="col-12" style="line-height: 30px;">
									<?php
									$kgiBranch = KgiBranch::kgiBranch($kgi["kgiId"]);
									if (isset($kgiBranch) && count($kgiBranch) > 0) {
										$i = 1;
										foreach ($kgiBranch as $branch) :
											echo $i . '. ' . $branch["branchName"];
											if ($i < (count($kgiBranch))) {
												echo '<br>';
											}
											$i++;
										endforeach;
									}
									?>
								</div>
							</td>
						</tr>

					<?php
						$a++;
					endforeach;
				} else { ?>
					<tr style="line-height: 60px;">
						<td class="text-center font-size-16" colspan="5">
							There are no related KGI for this KPI.
						</td>
					</tr>
				<?php
				}
				?>
			</tbody>
		</table>
	</div>
</div>
<?= $this->render('modal_view_kgi') ?>