<?php

use common\models\ModelMaster;

if (isset($kgis["data"]) && count($kgis["data"]) > 0) { ?>

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
					<div class="d-flex">
						<a class="btn-blue-sm font-size-10 text-center no-underline mr-3" style="padding:5px;"
							id="saveRelateKgi" href="javascript:showEditRelateKgi(2,<?= $kfiId ?>)">
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/save.svg" alt=""
								class="" style="margin-top: -1px; width:14px;height:14px;"> <?= Yii::t('app', 'Save') ?>
						</a>
						<a class="btn-red-sm font-size-10 text-center no-underline pr-5 pl-5" style="padding:5px;"
							id="cancelRelateKgi" href="javascript:showEditRelateKgi(0,<?= $kfiId ?>)"><?= Yii::t('app', 'Cancel') ?>
						</a>
					</div>
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
						<td><?= Yii::t('app', $kgi["month"]) ?></td>
						<td><?= Yii::t('app', $kgi["unit"]) ?></td>
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
							<a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-history/<?= ModelMaster::encodeParams(['kgiId' => $kgiId]) ?>" target="_blank" class="no-underline ">
								<div class="col-12 pt-3" style="background-color: #EDF5FF;color:#003276;cursor:pointer;">
									<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/detail.png" class="icon-table">
									<?= Yii::t('app', 'Detail') ?>
								</div>
							</a>
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
			foreach ($kgis["data"] as $kgiId => $kgi):
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
						<td><?= Yii::t('app', $kgi["month"]) ?></td>
						<td><?= Yii::t('app', $kgi["unit"]) ?></td>
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
							<a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-history/<?= ModelMaster::encodeParams(['kgiId' => $kgiId]) ?>" target="_blank" class="no-underline ">
								<div class="col-12 pt-3" style="background-color: #EDF5FF;color:#003276;cursor:pointer;">
									<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/detail.png" class="icon-table">
									<?= Yii::t('app', 'Detail') ?>
								</div>
							</a>
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
			<?= Yii::t('app', 'Looks like there are no KGIs created') ?>.
		</div>
		<div class="col-12 mt-10 text-secondary">
			<?= Yii::t('app', 'Click "Create KGI" to create KGI') ?>.
		</div>
		<div class="col-12 mt-10">

			<a href="<?= Yii::$app->homeUrl ?>kgi/management/grid" class="btn-blue font-size-14 no-underline">
				<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-circle.svg" class="pim-icon mr-3" style="margin-top: -1px;">
				<?= Yii::t('app', 'Add KGI') ?>
			</a>
		</div>
	</div>
<?php
}
?>