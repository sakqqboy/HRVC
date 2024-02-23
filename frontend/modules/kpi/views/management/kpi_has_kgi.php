<?php

use common\models\ModelMaster;
use frontend\models\hrvc\KgiBranch;
use frontend\models\hrvc\KgiTeam;
use frontend\models\hrvc\Unit;

?>
<table class="table table-responsive-lg">
	<thead>
		<tr class="font-size-12">
			<th>KPI Name</th>
			<th>Month</th>
			<th>Unit</th>
			<th>Raito</th>
			<th>Branch(es)</th>
		</tr>
	</thead>
	<tbody>
		<?php
		if (isset($kpiHasKgi) && count($kpiHasKgi) > 0) {
			$a = 1;
			foreach ($kpiHasKgi as $kgi) :
				if ($kgi["targetAmount"] != '' && $kgi["targetAmount"] != 0 && $kgi["targetAmount"] != null) {
					if ($kgi["code"] == '<' || $kgi["code"] == '=') {
						$ratio = ($kgi["result"] / $kgi["targetAmount"]) * 100;
					} else {
						if ($kgi["result"] != '' && $kgi["result"] != 0) {
							$ratio = ($kgi["targetAmount"] / $kgi["result"]) * 100;
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
				<tr>
					<td>
						<a class="no-underline-black" href="<?= Yii::$app->homeUrl . 'kgi/management/kgi-detail/' . ModelMaster::encodeParams(["kgiId" => $kgi['kgiId']]) ?>" style="cursor: pointer;">
							<?= $a ?>.
							<span class="font-b">
								<?= $kgi["kgiName"] ?>
							</span>
						</a>
					</td>

					<td><?= ModelMaster::shotMonthText($kgi["month"]) ?></td>
					<td><?= Unit::unitName($kgi["unitId"]) ?></td>
					<td class="text-center">
						<span class="pro-load-table">
							<?= $number ?>
						</span>
					</td>
					<td>
						<div class="col-12" style="line-height: 30px;">
							<?php
							//$kgiBranch = KgiBranch::kgiBranch($kgi["kgiId"]);
							$kgiTeam = KgiTeam::kgiTeam($kgi["kgiId"]);
							if (isset($kgiTeam) && count($kgiTeam) > 0) {
								$i = 1;
								foreach ($kgiTeam as $team) :
									echo $i . '. ' . $team["teamName"];
									if ($i < (count($kgiTeam))) {
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
					There are no related KGI for this KPI.
				</td>
			</tr>
		<?php
		}
		?>
	</tbody>
</table>