<?php
if (isset($kpis) && count($kpis) > 0) {
	foreach ($kpis as $kpiId => $kpi) :
?>
		<tr style="border-bottom: 10px white !important;" id="kpi-<?= $kpiId ?>">
			<td>
				<?= $kpi["kpiName"] ?>
			</td>
			<td><?= $kpi["companyName"] ?></td>
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
						<!-- <i class="fa fa-plus-circle circle5"></i> -->
					</div>
				</div>
			</td>
			<td class="text-start"><?= $kpi["code"] ?> <?= $kpi["targetAmount"] ?></td>
			<td><?= $kpi["month"] ?></td>
		</tr>
<?php
	endforeach;
}
?>