<?php

use common\models\ModelMaster;
use frontend\models\hrvc\KpiBranch;
use frontend\models\hrvc\Unit;

$this->title = 'KGI KPI';
?>
<div class="col-12 mt-90">
	<div class="row">
		<div class="col-9">
			<i class="fa fa-share-alt font-size-20 mr-3" aria-hidden="true"></i>
			<strong class="font-size-20">Related KPI for KGI</strong>
		</div>
		<div class="col-3 text-end">
			<a href="<?= Yii::$app->homeUrl ?>kgi/management/assign-kgi" class="font-size-14 btn btn-outline-secondary">
				<i class="fa fa-chevron-left mr-5" aria-hidden="true"></i>
				KGI Assign Management
			</a>
		</div>
		<div class="col-12 text-end mt-15">
			<a href="<?= Yii::$app->homeUrl ?>kgi/management/assign-kpi/<?= ModelMaster::encodeParams(['kgiId' => $kgiId]) ?>" class="no-underline-black">
				<i class="fa fa-cog font-size-26 font-b mr-5" aria-hidden="true"></i>Setting
			</a>
		</div>
	</div>
	<div class="col-12 mt-20 pt-10 pl-10 pb-10" style="border-radius: 10px;border-style:dotted;border-color:grey;">
		<strong>KGI : <?= $kgiDetail["kgiName"] ?></strong>
		<div class="row mt-20">
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
					<?= $kgiDetail["targetAmount"] ?>
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
					<?= $kgiDetail["result"] ?>
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
	<div class="col-12 mt-20">
		<u><b>Current related KPI (<?= count($kgiHasKpi) ?>)</b></u>
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
				if (isset($kgiHasKpi) && count($kgiHasKpi) > 0) {
					$a = 1;
					foreach ($kgiHasKpi as $kpi) : ?>
						<tr>
							<td><?= $a ?>.
								<span class="font-b" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#kpi-view" onclick="javascript:kpiHistory(<?= $kpi['kpiId'] ?>)">
									<?= $kpi["kpiName"] ?>
								</span>
							</td>
							<td><?= number_format($kpi["targetAmount"], 2) ?></td>
							<td><?= ModelMaster::shotMonthText($kpi["month"]) ?></td>
							<td><?= Unit::unitName($kpi["unitId"]) ?></td>
							<td>
								<div class="col-12" style="line-height: 30px;">
									<?php
									$kpiBranch = KpiBranch::kpiBranch($kpi["kpiId"]);
									if (isset($kpiBranch) && count($kpiBranch) > 0) {
										$i = 1;
										foreach ($kpiBranch as $branch) :
											echo $i . '. ' . $branch["branchName"];
											if ($i < (count($kpiBranch))) {
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
							There are no related KPI for this KGI.
						</td>
					</tr>
				<?php
				}
				?>
			</tbody>
		</table>
	</div>
</div>
<?= $this->render('modal_kpi_view') ?>