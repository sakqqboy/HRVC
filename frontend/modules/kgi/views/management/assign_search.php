<?php

use common\models\ModelMaster;

if (isset($kgis) && count($kgis) > 0) {
	foreach ($kgis as $kgiId => $kgi) :
?>
		<tr style="border-bottom: 10px white !important;" id="kgi-<?= $kgiId ?>">
			<td>
				<?= $kgi["kgiName"] ?>
			</td>
			<td><?= $kgi["companyName"] ?></td>
			<td>

				<div class="row">
					<div class="col-6 badge rounded-pill bg-setting">
						<img class="Image-Description" src="<?= Yii::$app->homeUrl . $kgi["flag"] ?>">
						<button id="hs-dropdown-avatar-more" class="number-rounded">
							<span class="font-medium leading-none" id="total-branch-<?= $kgiId ?>"><?= count($kgi["kgiBranch"]) ?></span>
						</button>
					</div>
					<div class="col-3 dashedshare mt-2 ml-2" onclick="javascript:kgiCompanyBranch(<?= $kgi['companyId'] ?>,<?= $kgiId ?>)" data-bs-toggle="modal" data-bs-target="#modalBranch">
						<i class="fa fa-share-alt share-alt-setting" aria-hidden="true"></i>
					</div>
				</div>
			</td>
			<td>
				<div class="row">
					<div class="col-5 badge rounded-pill bg-setting text-start">
						<?php
						if (isset($kgi["kgiEmployee"]) && count($kgi["kgiEmployee"]) > 0) {
							$e = 0;
							foreach ($kgi["kgiEmployee"] as $employeeId => $emPic) :
								if ($e < 2) { ?>
									<img class="Image-Description" src="<?= Yii::$app->homeUrl . $emPic ?>">
						<?php
								}
								$e++;
							endforeach;
						}
						?>
						<button id="hs-dropdown-avatar-more" class="number-rounded">
							<span class="font-medium leading-none" id="totalEmployee-<?= $kgiId ?>"><?= count($kgi["kgiEmployee"]) ?></span>
						</button>
					</div>

					<div class="col-3 dashedshare mt-2 ml-5" data-bs-target="#kgi-employee-modal" data-bs-toggle="modal" onclick="javascript:kgiCompanyEmployee(<?= $kgiId ?>)">
						<i class="fa fa-user share-alt-setting" aria-hidden="true"></i>
						<i class="fa fa-plus-circle circle5"></i>
					</div>
					<div class="col-1">
						<!-- <i class="fa fa-plus-circle circle5"></i> -->
					</div>
				</div>
			</td>
			<td class="text-start"><?= $kgi["code"] ?> <?= $kgi["targetAmount"] ?></td>
			<td><?= $kgi["month"] ?></td>
			<td>
				<a href="<?= Yii::$app->homeUrl ?>kgi/management/kgi-kfi/<?= ModelMaster::encodeParams(['kgiId' => $kgiId]) ?>" class="no-underline-black">
					<b><?= $kgi["countKgiHasKfi"] ?></b>
				</a>
			</td>
			<td>
				<a href="<?= Yii::$app->homeUrl ?>kgi/management/kgi-kpi/<?= ModelMaster::encodeParams(['kgiId' => $kgiId]) ?>" class="no-underline-black">
					<b><?= $kgi["countKgiHasKpi"] ?></b>
				</a>
			</td>
		</tr>
<?php
	endforeach;
}
?>