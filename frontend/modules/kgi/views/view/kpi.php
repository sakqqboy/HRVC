<?php

use common\models\ModelMaster;

if (isset($kpis) && count($kpis) > 0) { ?>

	<table class="table table-borderless">
		<thead>
			<tr class="pim-table-header text-center">
				<th class="text-start" style="border-top-left-radius: 4px;border-bottom-left-radius: 4px;"><?= Yii::t('app', 'RELATED KEY PERFORMANCE INDICATOR') ?></th>
				<th><?= Yii::t('app', 'MONTH') ?></th>
				<th><?= Yii::t('app', 'UNIT') ?></th>
				<th><?= Yii::t('app', 'TARGET') ?></th>
				<th><?= Yii::t('app', 'CODE') ?></th>
				<th><?= Yii::t('app', 'RATIO') ?></th>
				<th style="width: 10%;"><?= Yii::t('app', 'TEAM') ?></th>
				<th style="border-top-right-radius: 4px;border-bottom-right-radius: 4px;" class="text-end">
					<a class="btn-blue-sm font-size-12 text-center no-underline mr-5 pl-10 pr-10" id="saveRelateKpi" href="javascript:showEditRelateKpi(2,<?= $kgiId ?>)">
						<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/save.svg" alt="" class="mr-3" style="margin-top: -1px; width: 16px;"> Save
					</a>
					<a class="btn-red-sm font-size-12 text-center no-underline pl-10 pr-10" id="cancelRelateKpi" href="javascript:showEditRelateKpi(0,<?= $kgiId ?>)"><?= Yii::t('app', 'Cancel') ?></a>
				</th>
			</tr>
		</thead>
		<tbody id="kpi">
			<?php
			$i = 1;
			$selected = [];
			if (isset($kgiHasKpi) && count($kgiHasKpi) > 0) {
				foreach ($kgiHasKpi as $kpiId => $kpi):
			?>
					<tr height="10">
					</tr>
					<tr id="kpi-<?= $kpiId ?>" class="text-center pim-table-text related-table-background">
						<td class="text-start font-b pt-10 text-primary" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;letter-spacing:0.5px;">
							<div class="text-truncate" style="max-width:300px;" title="<?= $kpi["kpiName"] ?>">
								<input type="checkbox" id="check-relate-kpi" class="checkbox-sm mr-5" value="<?= $kpiId ?>" name="kpi" <?= isset($kgiHasKpi[$kpiId]) ? 'checked' : '' ?>>
								<?= $i ?>.
								<?= $kpi["kpiName"] ?>
							</div>
						</td>
						<td><?= $kpi["month"] ?></td>
						<td><?= Yii::t('app', $kpi["unit"]) ?></td>
						<td class="text-end"><?= $kpi["targetAmount"] ?></td>
						<td><?= $kpi["code"] ?></td>
						<td><?= $kpi["ratio"] ?></td>
						<td>
							<div class="col-12 info-assign" style="margin-top: -3px;">
								<div class="row" style="--bs-gutter-x:0px;">
									<div class="col-4 pr-0 pl-0" style="align-content:center;">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-dark-blue.png"
											class="first-layer-icon ml-3" style="margin-top: -4px;">
									</div>
									<div class="col-3 number-tag load-info pr-3 pl-3 pt-1">
										<?= $kpi["countTeam"] ?>
									</div>

									<div class="col-4  text-end pl-0 pr-5" style="align-content:center;">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/down-darkblue.png" style="width:10px;height:7px;cursor:pointer;" onclick="javascript:showTeamKpi(<?= $kpiId ?>,1)" id="show-<?= $kpiId ?>">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/up-darkblue.png" style="display: none;width:10px;height:7px;cursor:pointer;" onclick="javascript:showTeamKpi(<?= $kpiId ?>,0)" id="hide-<?= $kpiId ?>">
									</div>
								</div>
							</div>

						</td>
						<td style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;">
							<a href="<?= Yii::$app->homeUrl ?>kpi/view/kpi-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId]) ?>" target="_blank" class="no-underline ">
								<div class="col-12 pt-4 pb-4" style="background-color: #EDF5FF;color:#003276;cursor:pointer;">
									<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/detail.png" class="icon-table">
									<?= Yii::t('app', 'Detail') ?>
								</div>
							</a>
						</td>
					</tr>
					<tr id="kpi-team-<?= $kpiId ?>" style="display:none;">

					</tr>
				<?php
					$selected[$kpiId] = 1;
					$i++;
				endforeach;
			}
			$i = count($kgiHasKpi) + 1;
			foreach ($kpis["data"] as $kpiId => $kpi):
				if (!isset($selected[$kpiId])) {

				?>
					<tr height="10">
					</tr>
					<tr id="kpi-<?= $kpiId ?>" class="text-center pim-table-text related-table-background">
						<td class="text-start font-b pt-10 <?= isset($kgiHasKpi[$kpiId]) ? 'text-primary' : '' ?>" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;letter-spacing:0.5px;">
							<div class="text-truncate" style="max-width:300px;" title="<?= $kpi["kpiName"] ?>">
								<input type="checkbox" id="check-relate-kpi" class="checkbox-sm mr-5" value="<?= $kpiId ?>" name="kpi" <?= isset($kgiHasKpi[$kpiId]) ? 'checked' : '' ?>>
								<?= $i ?>.
								<?= $kpi["kpiName"] ?>
							</div>
						</td>
						<td><?= Yii::t('app', $kpi["month"]) ?></td>
						<td><?= Yii::t('app', $kpi["unit"]) ?></td>
						<td class="text-end"><?= $kpi["targetAmount"] ?></td>
						<td><?= $kpi["code"] ?></td>
						<td><?= $kpi["ratio"] ?></td>
						<td>
							<div class="col-12 info-assign" style="margin-top: -3px;">
								<div class="row" style="--bs-gutter-x:0px;">
									<div class="col-4 pr-0 pl-0" style="align-content:center;">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-dark-blue.png"
											class="first-layer-icon ml-3" style="margin-top: -4px;">
									</div>
									<div class="col-3 number-tag load-info pr-3 pl-3 pt-1">
										<?= $kpi["countTeam"] ?>
									</div>

									<div class="col-4  text-end pl-0 pr-5" style="align-content:center;">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/down-darkblue.png" style="width:10px;height:7px;cursor:pointer;" onclick="javascript:showTeamKpi(<?= $kpiId ?>,1)" id="show-<?= $kpiId ?>">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/up-darkblue.png" style="display: none;width:10px;height:7px;cursor:pointer;" onclick="javascript:showTeamKpi(<?= $kpiId ?>,0)" id="hide-<?= $kpiId ?>">
									</div>
								</div>
							</div>
						</td>
						<td style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;">
							<a href="<?= Yii::$app->homeUrl ?>kpi/view/kpi-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId]) ?>" target="_blank" class="no-underline ">
								<div class="col-12  pt-4 pb-4" style="background-color: #EDF5FF;color:#003276;cursor:pointer;">
									<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/detail.png" class="icon-table">
									<?= Yii::t('app', 'Detail') ?>
								</div>
							</a>
						</td>
					</tr>
					<tr id="kpi-team-<?= $kpiId ?>" style="display:none;">

					</tr>
			<?php
					$i++;
				}

			endforeach;
			?>
		</tbody>
	</table>
<?php
} else {
?>
	<div class="col-12 on-data-box mt-10 text-center">
		<div class="col-12">
			<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/no-data.svg" class="no-data-img">
		</div>
		<div class="col-12 font-size-16 font-b mt-5">
			<?= Yii::t('app', 'Looks like there are no KPIs created') ?>.
		</div>
		<div class="col-12 mt-10 text-secondary">
			<?= Yii::t('app', 'Click "Create KPI" to create KPI') ?>.
		</div>
		<div class="col-12 mt-10">

			<a href="<?= Yii::$app->homeUrl ?>kpi/management/grid" class="btn-blue font-size-14 no-underline">
				<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-circle.svg" class="pim-icon mr-3" style="margin-top: -1px;">
				<?= Yii::t('app', 'Add KPI') ?>
			</a>
		</div>
	</div>
<?php
}
?>