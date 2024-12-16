<?php

use common\models\ModelMaster;

if (isset($kpis) && count($kpis) > 0) {
	foreach ($kpis as $kpiId => $kpi) :
?>
		<tr style="border-bottom: 10px white !important;" id="kpi-<?= $kpiId ?>">
			<td>
				<?= $kpi["kpiName"] ?>
			</td>

			<td>

				<div class="row">
					<div class="col-6 badge rounded-pill bg-setting">
						<img class="Image-Description" src="<?= Yii::$app->homeUrl . $kpi["flag"] ?>">
						<button id="hs-dropdown-avatar-more" class="number-rounded">
							<span class="font-medium leading-none" id="total-branch-<?= $kpiId ?>"><?= count($kpi["kpiBranch"]) ?></span>
						</button>
					</div>
					<div class="col-3 dashedshare mt-2 ml-2" onclick="javascript:kpiCompanyBranch(<?= $kpi['companyId'] ?>,<?= $kpiId ?>)" data-bs-toggle="modal" data-bs-target="#modalBranch">
						<i class="fa fa-share-alt share-alt-setting" aria-hidden="true"></i>
					</div>
				</div>
			</td>
			<td class="text-center">
				<div class="row">
					<div class="col-1">
					</div>
					<div class="col-3  mt-2 text-center pr-25 font-size-11">
						<div class="text-center pt-3" id="totalTeam-<?= $kpiId ?>" style="width:25px;height:25px;border-radius:100%;border: 1px solid rgb(58, 158, 230);">
							<?= $kpi["countTeam"] ?>
						</div>
					</div>
					<!-- </div> -->
					<div class="col-3 dashedshare mt-2 ml-5" data-bs-target="#assign-kpi-team" data-bs-toggle="modal" onclick="javascript:assignKpiTeam(<?= $kpiId ?>)">
						<i class="fa fa-users share-alt-setting" aria-hidden="true"></i>
						<i class="fa fa-plus-circle circle5"></i>
					</div>
				</div>
			</td>
			<td>
				<div class="row">
					<div class="col-5 badge rounded-pill bg-setting text-start">
						<?php
						if (isset($kpi["kpiEmployee"]) && count($kpi["kpiEmployee"]) > 0) {
							$e = 0;
							foreach ($kpi["kpiEmployee"] as $employeeId => $emPic) :
								if ($e < 2) { ?>
									<img class="Image-Description" src="<?= Yii::$app->homeUrl . $emPic ?>">
						<?php
								}
								$e++;
							endforeach;
						}
						?>
						<button id="hs-dropdown-avatar-more" class="number-rounded">
							<span class="font-medium leading-none" id="totalEmployee-<?= $kpiId ?>"><?= count($kpi["kpiEmployee"]) ?></span>
						</button>
					</div>

					<div class="col-3 dashedshare mt-2 ml-5" data-bs-target="#kpi-employee-modal" data-bs-toggle="modal" onclick="javascript:kpiCompanyEmployee(<?= $kpiId ?>)">
						<i class="fa fa-user share-alt-setting" aria-hidden="true"></i>
						<i class="fa fa-plus-circle circle5"></i>
					</div>
					<div class="col-1">
					</div>
				</div>
			</td>
			<td class="text-end"><?= $kpi["code"] ?> <?= $kpi["targetAmount"] ?></td>
			<td><?= $kpi["month"] ?></td>
			<td>
				<a href="<?= Yii::$app->homeUrl ?>kpi/management/kpi-kgi/<?= ModelMaster::encodeParams(['kpiId' => $kpiId]) ?>" class="no-underline-black">
					<b><?= $kpi["countKgiInKpi"] ?></b>
				</a>
			</td>
			<td class="text-end">
				<a href="<?= Yii::$app->homeUrl
						?>kpi/kpi-team/kpi-team-setting/<?= ModelMaster::encodeParams(['kpiId' => $kpiId])
											?>" class="btn btn-sm btn-primary mr-3" title="Team KPI setting">
					<i class="fa fa-users" aria-hidden="true"></i>
				</a>
				<a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/indivisual-setting/<?= ModelMaster::encodeParams(['kpiId' => $kpiId]) ?>" class="btn btn-sm btn-info text-light" title="Indivisual KPI setting">
					<i class="fa fa-user" aria-hidden="true"></i>
				</a>
			</td>


		</tr>
<?php
	endforeach;
}
?>