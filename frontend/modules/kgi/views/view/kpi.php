<?php
if (isset($kpis) && count($kpis) > 0) { ?>

	<table class="table table-borderless">
		<thead>
			<tr class="pim-table-header text-center">
				<th class="text-start" style="border-top-left-radius: 4px;border-bottom-left-radius: 4px;">RELATED KEY PERFORMANCE INDICATOR</th>
				<th>MONTH</th>
				<th>UNIT</th>
				<th>TARGET</th>
				<th>CODE</th>
				<th>RATIO</th>
				<th style="width: 10%;">TEAM</th>
				<th style="border-top-right-radius: 4px;border-bottom-right-radius: 4px;" class="text-end">
					<a class="btn-blue-sm font-size-12 text-center no-underline mr-5 pl-10 pr-10" id="saveRelateKpi" href="javascript:showEditRelateKpi(2,<?= $kgiId ?>)">
						<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/save.svg" alt="" class="pim-icon mr-3" style="margin-top: -1px;"> Save
					</a>
					<a class="btn-red-sm font-size-12 text-center no-underline pl-10 pr-10" id="cancelRelateKpi" href="javascript:showEditRelateKpi(0,<?= $kgiId ?>)">Cancel</a>
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
							<input type="checkbox" id="check-relate-kpi" class="checkbox-sm mr-5" value="<?= $kpiId ?>" name="kpi" <?= isset($kgiHasKpi[$kpiId]) ? 'checked' : '' ?>>
							<?= $i ?>.
							<?= $kpi["kpiName"] ?>
						</td>
						<td><?= $kpi["month"] ?></td>
						<td><?= $kpi["unit"] ?></td>
						<td class="text-end"><?= $kpi["targetAmount"] ?></td>
						<td><?= $kpi["code"] ?></td>
						<td><?= $kpi["ratio"] ?></td>
						<td>
							<div class="col-12 info-assign  pt-5 pb-2" style="margin-top: -3px;">
								<div class="row">
									<div class="col-4 text-end">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-dark-blue.png" class="first-layer-icon ml-3" style="margin-top: -4px;">
									</div>
									<div class="col-3 number-tag load-info pr-3 pl-3 pt-1">
										<?= $kpi["countTeam"] ?>
									</div>

									<div class="col-3  text-center pl-0 pr-0">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/down-darkblue.png" style="width:10px;height:7px;margin-top:-4px;cursor:pointer;" onclick="javascript:showTeamKpi(<?= $kpiId ?>,1)" id="show-<?= $kpiId ?>">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/up-darkblue.png" style="display: none;width:10px;height:7px;margin-top:-4px;cursor:pointer;" onclick="javascript:showTeamKpi(<?= $kpiId ?>,0)" id="hide-<?= $kpiId ?>">
									</div>
								</div>
							</div>
						</td>
						<td style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;">
							<div class="col-12 pt-3" style="background-color: #EDF5FF;color:#003276;cursor:pointer;">
								<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/detail.png" class="icon-table">
								Detail
							</div>
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
			foreach ($kpis as $kpiId => $kpi):
				if (!isset($selected[$kpiId])) {

				?>
					<tr height="10">
					</tr>
					<tr id="kpi-<?= $kpiId ?>" class="text-center pim-table-text related-table-background">
						<td class="text-start font-b pt-10 <?= isset($kgiHasKpi[$kpiId]) ? 'text-primary' : '' ?>" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;letter-spacing:0.5px;">
							<input type="checkbox" id="check-relate-kpi" class="checkbox-sm mr-5" value="<?= $kpiId ?>" name="kpi" <?= isset($kgiHasKpi[$kpiId]) ? 'checked' : '' ?>>
							<?= $i ?>.
							<?= $kpi["kpiName"] ?>
						</td>
						<td><?= $kpi["month"] ?></td>
						<td><?= $kpi["unit"] ?></td>
						<td class="text-end"><?= $kpi["targetAmount"] ?></td>
						<td><?= $kpi["code"] ?></td>
						<td><?= $kpi["ratio"] ?></td>
						<td>
							<div class="col-12 info-assign  pt-5 pb-2" style="margin-top: -3px;">
								<div class="row">
									<div class="col-4 text-end">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-dark-blue.png" class="first-layer-icon ml-3" style="margin-top: -4px;">
									</div>
									<div class="col-3 number-tag load-info pr-3 pl-3 pt-1">
										<?= $kpi["countTeam"] ?>
									</div>

									<div class="col-3  text-center pl-0 pr-0">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/down-darkblue.png" style="width:10px;height:7px;margin-top:-4px;cursor:pointer;" onclick="javascript:showTeamKpi(<?= $kpiId ?>,1)" id="show-<?= $kpiId ?>">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/up-darkblue.png" style="display: none;width:10px;height:7px;margin-top:-4px;cursor:pointer;" onclick="javascript:showTeamKpi(<?= $kpiId ?>,0)" id="hide-<?= $kpiId ?>">
									</div>
								</div>
							</div>
						</td>
						<td style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;">
							<div class="col-12 pt-3" style="background-color: #EDF5FF;color:#003276;cursor:pointer;">
								<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/detail.png" class="icon-table">
								Detail
							</div>
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
			Looks like there are no KPIs created.
		</div>
		<div class="col-12 mt-10 text-secondary">
			Click "Create KPI" to create KPI.
		</div>
		<div class="col-12 mt-10">

			<a href="<?= Yii::$app->homeUrl ?>kpi/management/grid" class="btn-blue font-size-14 no-underline">
				<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-circle.svg" class="pim-icon mr-3" style="margin-top: -1px;">
				Add KPI
			</a>
		</div>
	</div>
<?php
}
?>