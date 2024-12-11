<?php

use common\models\ModelMaster;

if (isset($kfis) && count($kfis) > 0) {
	foreach ($kfis as $kfiId => $kfi) :
?>
		<tr style="border-bottom: 10px white !important;" id="kfi-<?= $kfiId ?>">
			<td>
				<?= Yii::t('app', $kfi["kfiName"]) ?>
			</td>
			<td><?= $kfi["companyName"] ?></td>
			<td>

				<div class="row">
					<div class="col-6 badge rounded-pill bg-setting">
						<img class="Image-Description" src="<?= Yii::$app->homeUrl . $kfi["flag"] ?>">
						<button id="hs-dropdown-avatar-more" class="number-rounded">
							<span class="font-medium leading-none" id="total-branch-<?= $kfiId ?>"><?= count($kfi["kfiBranch"]) ?></span>
						</button>
					</div>
					<div class="col-3 dashedshare mt-2 ml-2" onclick="javascript:kfiCompanyBranch(<?= $kfi['companyId'] ?>,<?= $kfiId ?>)" data-bs-toggle="modal" data-bs-target="#modalBranch">
						<i class="fa fa-share-alt share-alt-setting" aria-hidden="true"></i>
					</div>
				</div>
			</td>
			<td>
				<div class="row">
					<div class="col-5 badge rounded-pill bg-setting text-start">
						<?php
						if (isset($kfi["kfiEmployee"]) && count($kfi["kfiEmployee"]) > 0) {
							$e = 0;
							foreach ($kfi["kfiEmployee"] as $employeeId => $emPic) :
								if ($e < 2) { ?>
									<img class="Image-Description" src="<?= Yii::$app->homeUrl . $emPic ?>">
						<?php
								}
								$e++;
							endforeach;
						}
						?>
						<button id="hs-dropdown-avatar-more" class="number-rounded">
							<span class="font-medium leading-none" id="totalEmployee-<?= $kfiId ?>"><?= count($kfi["kfiEmployee"]) ?></span>
						</button>
					</div>

					<div class="col-3 dashedshare mt-2 ml-5" data-bs-target="#kfi-employee-modal" data-bs-toggle="modal" onclick="javascript:kfiCompanyEmployee(<?= $kfiId ?>)">
						<i class="fa fa-user share-alt-setting" aria-hidden="true"></i>
						<i class="fa fa-plus-circle circle5"></i>
					</div>
					<div class="col-1">
						<!-- <i class="fa fa-plus-circle circle5"></i> -->
					</div>
				</div>
			</td>
			<td class="text-start"><?= $kfi["code"] ?> <?= number_format($kfi["target"], 2) ?></td>
			<td><?= $kfi["month"] ?></td>
			<td>
				<a href="<?= Yii::$app->homeUrl ?>kfi/management/kfi-kgi/<?= ModelMaster::encodeParams(['kfiId' => $kfiId]) ?>" class="no-underline-black">
					<b><?= $kfi["countKfiHasKgi"] ?></b>
				</a>
			</td>
		</tr>
<?php
	endforeach;
}
?>