<?php

use common\models\ModelMaster;
use frontend\models\hrvc\KpiBranch;
use frontend\models\hrvc\KpiTeam;
use frontend\models\hrvc\Unit;

?>
<table class="table table-responsive-lg">
	<thead>
		<tr class="font-size-12">
			<th><?= Yii::t('app', 'KPI Name') ?></th>
			<th><?= Yii::t('app', 'Month') ?></th>
			<th><?= Yii::t('app', 'Unit') ?></th>
			<th><?= Yii::t('app', 'Ratio') ?></th>
			<th><?= Yii::t('app', 'Team') ?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		if (isset($kgiHasKpi) && count($kgiHasKpi) > 0) {
			$a = 1;
			foreach ($kgiHasKpi as $kpi) :
				if ($kpi["targetAmount"] != '' && $kpi["targetAmount"] != 0 && $kpi["targetAmount"] != null) {
					if ($kpi["code"] == '<' || $kpi["code"] == '=') {
						$ratio = ($kpi["result"] / $kpi["targetAmount"]) * 100;
					} else {
						if ($kpi["result"] != '' && $kpi["result"] != 0) {
							$ratio = ($kpi["targetAmount"] / $kgi["result"]) * 100;
						} else {
							$ratio = 0;
						}
					}
				} else {
					$ratio = 0;
				}
				$decimal = explode(".", $ratio);
				if (isset($decimal[1]) && $decimal[1] != '00') {
					$number = number_format($ratio, 2);
				} else {
					$number = $ratio;
				}
				if ($number > 0) {
					$number .= ' %';
				}
		?>
				<tr class="font-size-12">
					<td>
						<a class="no-underline-black" href="<?= Yii::$app->homeUrl . 'kpi/management/kpi-detail/' . ModelMaster::encodeParams(["kpiId" => $kpi['kpiId']]) ?>" style="cursor: pointer;">
							<?= $a ?>.
							<span class="font-b">
								<?= $kpi["kpiName"] ?>
							</span>
						</a>
					</td>

					<td><?= ModelMaster::shotMonthText($kpi["month"]) ?></td>
					<td><?= Unit::unitName($kpi["unitId"]) ?></td>
					<td class="text-center">
						<span class="pro-load-table">
							<?= $number ?>
						</span>
					</td>
					<td>
						<div class="col-12" style="line-height: 25px;">
							<?php
							$kpiTeam = KpiTeam::kpiTeam($kpi["kpiId"]);
							if (isset($kpiTeam) && count($kpiTeam) > 0) {
								$i = 1;
								foreach ($kpiTeam as $team) :
									echo $i . '. ' . $team["teamName"];
									if ($i < (count($kpiTeam))) {
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
					<?= Yii::t('app', 'There are no related KPI for this KGI') ?>.
				</td>
			</tr>
		<?php
		}
		?>
	</tbody>
</table>