<?php

use common\models\ModelMaster;
use frontend\models\hrvc\KfiBranch;
use frontend\models\hrvc\KgiBranch;
use frontend\models\hrvc\Unit;

$this->title = 'KFI KGI';
?>
<div class="col-12 mt-90">
	<div class="row">
		<div class="col-9">
			<i class="fa fa-share-alt font-size-20 mr-3" aria-hidden="true"></i>
			<strong class="font-size-20"><?= Yii::t('app', 'Related KFI for KGI') ?></strong>
		</div>
		<div class="col-3 text-end">
			<a href="<?= Yii::$app->homeUrl ?>kgi/management/assign-kgi" class="font-size-14 btn btn-outline-secondary">
				<i class="fa fa-chevron-left mr-5" aria-hidden="true"></i>
				<?= Yii::t('app', 'KGI Assign Management') ?>
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
					<i class="fa fa-trophy" aria-hidden="true"></i> <?= Yii::t('app', 'Result') ?>
				</div>
				<div class="col-12 million-number-Backdrop3 mt-10 " id="resultHistory">
					<?= $kgiDetail["result"] ?>
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
		<u><b><?= Yii::t('app', 'Current related KFI') ?> (<?= count($kgiHasKfi) ?>)</b></u>
	</div>
	<div class="col-12 mt-20">

		<table class="table table-responsive-lg">
			<thead>
				<th><?= Yii::t('app', 'KFI Name') ?></th>
				<th><?= Yii::t('app', 'Target') ?></th>
				<th><?= Yii::t('app', 'Month') ?></th>
				<th><?= Yii::t('app', 'Unit') ?></th>
				<th><?= Yii::t('app', 'Branch') ?></th>
			</thead>
			<tbody>
				<?php
				if (isset($kgiHasKfi) && count($kgiHasKfi) > 0) {
					$a = 1;
					foreach ($kgiHasKfi as $kfi) : ?>
						<tr>
							<td><?= $a ?>.
								<span class="font-b" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#kfi-view" onclick="javascript:kfiHistory(<?= $kfi['kfiId'] ?>)">
									<?= $kfi["kfiName"] ?>
								</span>
							</td>
							<td><?= number_format($kfi["targetAmount"], 2) ?></td>
							<td><?= Yii::t('app', ModelMaster::shotMonthText($kfi["month"])) ?></td>
							<td><?= Unit::unitName($kfi["unitId"]) ?></td>
							<td>
								<div class="col-12" style="line-height: 30px;">
									<?php
									$kfiBranch = KfiBranch::kfiBranch($kfi["kfiId"]);
									if (isset($kfiBranch) && count($kfiBranch) > 0) {
										$i = 1;
										foreach ($kfiBranch as $branch) :
											echo $i . '. ' . $branch["branchName"];
											if ($i < (count($kfiBranch))) {
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
							<?= Yii::t('app', 'There are no related KGI for this KFI') ?>.
						</td>
					</tr>
				<?php
				}
				?>
			</tbody>
		</table>
	</div>
</div>
<?= $this->render('modal_view_kfi') ?>
<?= $this->render('modal_team_history') ?>
<?= $this->render('modal_employee_history') ?>