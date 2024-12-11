<?php

use common\models\ModelMaster;
use frontend\models\hrvc\KgiBranch;
use frontend\models\hrvc\Unit;

$this->title = 'KGI KFI';
?>
<div class="col-12 mt-90">
	<div class="row">
		<div class="col-9">
			<i class="fa fa-share-alt font-size-20 mr-3" aria-hidden="true"></i>
			<strong class="font-size-20"><?= Yii::t('app', 'Related KGI for KFI') ?></strong>
		</div>
		<div class="col-3 text-end">
			<a href="<?= Yii::$app->homeUrl ?>kfi/management/assign-kfi" class="font-size-14 btn btn-outline-secondary">
				<i class="fa fa-chevron-left mr-5" aria-hidden="true"></i>
				<?= Yii::t('app', 'KFI Assign Management') ?>
			</a>
		</div>
		<div class="col-12 text-end mt-15">
			<a href="<?= Yii::$app->homeUrl ?>kfi/management/assign-kgi/<?= ModelMaster::encodeParams(['kfiId' => $kfiId]) ?>" class="no-underline-black">
				<i class="fa fa-cog font-size-26 font-b mr-5" aria-hidden="true"></i><?= Yii::t('app', 'Setting') ?>
			</a>
		</div>

	</div>
	<div class="col-12 mt-20 pt-10 pl-10 pb-10" style="border-radius: 10px;border-style:dotted;border-color:lightgrey;">
		<strong>KFI : <?= $kfiDetail["kfiName"] ?></strong>
		<div class="row mt-20">
			<div class="col-lg-2 col-md-6 col-2">
				<div class="col-12 padding-FEB-Backdrop3" id="monthHistory">
					<?= $kfiDetail["monthName"] ?>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-3">
				<div class="col-12 Quant-ratio-Backdrop3">
					<?= Yii::t('app', 'Quant Ratio') ?>
				</div>
				<div class="col-12 diamond-con-Backdrop3 mt-10">
					<i class="fa fa-diamond" aria-hidden="true"></i>
					<span id="quanRatioHistory"><?= $kfiDetail["quantRatio"] == 1 ? Yii::t('app', 'Quantity') : Yii::t('app', 'Quality') ?></span>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-3">
				<div class="col-12 bullseye-con-Backdrop3">
					<i class="fa fa-bullseye" aria-hidden="true"></i> <?= Yii::t('app', 'Target') ?>
				</div>
				<div class="col-12 million-number-Backdrop3 mt-10 " id="targetHistory">
					<?= $kfiDetail["targetAmount"] ?>
				</div>
			</div>
			<div class="col-lg-1 col-md-6 col-3">
				<div class="col-12 padding-mark-Backdrop3 mt-25 " id="codeHistory">
					<?= $kfiDetail["code"] ?>
				</div>
			</div>
			<div class="col-lg-3 cl-md-6 col-3">
				<div class="col-12 trophy-con-Backdrop3">
					<i class="fa fa-trophy" aria-hidden="true"></i> <?= Yii::t('app', 'Result') ?>
				</div>
				<div class="col-12 million-number-Backdrop3 mt-10 " id="resultHistory">
					<?= $kfiDetail["result"] ?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-2 col-md-6 col-5"></div>
				<div class="col-lg-3 col-md-6 col-6">
					<div class="col-12 padding-update-Backdrop3">
						<?= Yii::t('app', 'Update Interval') ?>
					</div>
					<div class="col-12 update-mouth-Backdrop3 mt-10" id="unitHistory">
						<?= Yii::t('app', $kfiDetail["unit"]) ?>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-6 mt-10 ">
					<div class="col-12 pt-20">
						<div class="progress">
							<div class="progress-bar" id="progressHistory" style="background: rgb(47, 128, 237); margin-left: -50px; width:<?= (float)$kfiDetail["ratio"] > 100 ? '100' : $kfiDetail["ratio"] ?>%;"></div>
							<span class="badge rounded-pill  pro-load-Backdrop3" id="decimalHistory"><?= $kfiDetail["ratio"] ?>%</span>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<div class="col-12 mt-20">
		<u><b><?= Yii::t('app', 'Current related KGI') ?> (<?= count($kfiHasKgi) ?>)</b></u>
	</div>
	<div class="col-12 mt-20">

		<table class="table table-responsive-lg">
			<thead>
				<th><?= Yii::t('app', 'KGI Name') ?></th>
				<th><?= Yii::t('app', 'Target') ?></th>
				<th><?= Yii::t('app', 'Month') ?></th>
				<th><?= Yii::t('app', 'Unit') ?></th>
				<th><?= Yii::t('app', 'Branch') ?></th>
			</thead>
			<tbody>
				<?php
				if (isset($kfiHasKgi) && count($kfiHasKgi) > 0) {
					$a = 1;
					foreach ($kfiHasKgi as $kgi) : ?>
						<tr>
							<td><?= $a ?>.
								<span class="font-b" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#kgi-view" onclick="javascript:kgiHistory(<?= $kgi['kgiId'] ?>)">
									<?= $kgi["kgiName"] ?>
								</span>
							</td>
							<td><?= $kgi["code"] ?> <?= number_format($kgi["targetAmount"], 2) ?></td>
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
<?= $this->render('modal_view') ?>