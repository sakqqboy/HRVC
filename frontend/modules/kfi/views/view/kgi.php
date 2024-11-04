<?php
if (isset($kgis) && count($kgis) > 0) { ?>

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
					<a class="btn-blue-sm font-size-12 text-center no-underline mr-5 pl-10 pr-10" id="saveRelateKgi" href="javascript:showEditRelateKgi(2,<?= $kfiId ?>)">
						<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/save.svg" alt="" class="pim-icon mr-3" style="margin-top: -1px;"> Save
					</a>
					<a class="btn-red-sm font-size-12 text-center no-underline pl-10 pr-10" id="cancelRelateKgi" href="javascript:showEditRelateKgi(0,<?= $kfiId ?>)">Cancel</a>
				</th>
			</tr>
		</thead>
		<tbody id="kgi">
			<?php
			$i = 1;
			$selected = [];
			if (isset($kfiHasKgi) && count($kfiHasKgi) > 0) {
				foreach ($kfiHasKgi as $kgiId => $kgi):
			?>
					<tr height="10">
					</tr>
					<tr id="kgi-<?= $kgiId ?>" class="text-center pim-table-text related-table-background">
						<td class="text-start font-b pt-10 text-primary" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;letter-spacing:0.5px;">
							<input type="checkbox" id="check-relate-kgi" class="checkbox-sm mr-5" value="<?= $kgiId ?>" name="kgi" checked>
							<?= $i ?>.
							<?= $kgi["kgiName"] ?>
						</td>
						<td><?= $kgi["month"] ?></td>
						<td><?= $kgi["unit"] ?></td>
						<td class="text-end"><?= $kgi["targetAmount"] ?></td>
						<td><?= $kgi["code"] ?></td>
						<td><?= $kgi["ratio"] ?></td>
						<td>
							<div class="col-12 info-assign  pt-5 pb-2" style="margin-top: -3px;">
								<div class="row">
									<div class="col-4 text-end">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-dark-blue.png" class="first-layer-icon ml-3" style="margin-top: -4px;">
									</div>
									<div class="col-3 number-tag load-info pr-3 pl-3 pt-1">
										<?= $kgi["countTeam"] ?>
									</div>

									<div class="col-3  text-center pl-0 pr-0">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/down-darkblue.png" style="width:10px;height:7px;margin-top:-4px;cursor:pointer;" onclick="javascript:showTeamKgi(<?= $kgiId ?>,1)" id="show-<?= $kgiId ?>">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/up-darkblue.png" style="display: none;width:10px;height:7px;margin-top:-4px;cursor:pointer;" onclick="javascript:showTeamKgi(<?= $kgiId ?>,0)" id="hide-<?= $kgiId ?>">
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
					<tr id="kgi-team-<?= $kgiId ?>" style="display:none;">

					</tr>
				<?php
					$selected[$kgiId] = 1;
					$i++;
				endforeach;
			}
			$i = count($kfiHasKgi) + 1;
			foreach ($kgis as $kgiId => $kgi):
				if (!isset($selected[$kgiId])) {
				?>
					<tr height="10">
					</tr>
					<tr id="kgi-<?= $kgiId ?>" class="text-center pim-table-text related-table-background">
						<td class="text-start font-b pt-10" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;letter-spacing:0.5px;">
							<input type="checkbox" id="check-relate-kgi" class="checkbox-sm mr-5" value="<?= $kgiId ?>" name="kgi">
							<?= $i ?>.
							<?= $kgi["kgiName"] ?>
						</td>
						<td><?= $kgi["month"] ?></td>
						<td><?= $kgi["unit"] ?></td>
						<td class="text-end"><?= $kgi["targetAmount"] ?></td>
						<td><?= $kgi["code"] ?></td>
						<td><?= $kgi["ratio"] ?></td>
						<td>
							<div class="col-12 info-assign  pt-5 pb-2" style="margin-top: -3px;">
								<div class="row">
									<div class="col-4 text-end">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-dark-blue.png" class="first-layer-icon ml-3" style="margin-top: -4px;">
									</div>
									<div class="col-3 number-tag load-info pr-3 pl-3 pt-1">
										<?= $kgi["countTeam"] ?>
									</div>

									<div class="col-3  text-center pl-0 pr-0">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/down-darkblue.png" style="width:10px;height:7px;margin-top:-4px;cursor:pointer;" onclick="javascript:showTeamKgi(<?= $kgiId ?>,1)" id="show-<?= $kgiId ?>">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/up-darkblue.png" style="display: none;width:10px;height:7px;margin-top:-4px;cursor:pointer;" onclick="javascript:showTeamKgi(<?= $kgiId ?>,0)" id="hide-<?= $kgiId ?>">
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
					<tr id="kgi-team-<?= $kgiId ?>" style="display:none;">

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
			Looks like there are no KGIs created.
		</div>
		<div class="col-12 mt-10 text-secondary">
			Click "Create KGI" to create KGI.
		</div>
		<div class="col-12 mt-10">

			<a href="<?= Yii::$app->homeUrl ?>kgi/management/grid" class="btn-blue font-size-14 no-underline">
				<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-circle.svg" class="pim-icon mr-3" style="margin-top: -1px;">
				Add KGI
			</a>
		</div>
	</div>
<?php
}
?>