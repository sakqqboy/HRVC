<?php

use common\models\ModelMaster;
use frontend\models\hrvc\KgiBranch;
use frontend\models\hrvc\KgiTeam;
use frontend\models\hrvc\Unit;

?>
<table class="table table-responsive-lg">
	<thead>
		<tr class="font-size-12">
			<th><?= Yii::t('app', 'KGI Name') ?></th>
			<th><?= Yii::t('app', 'Month') ?></th>
			<th><?= Yii::t('app', 'Unit') ?></th>
			<th><?= Yii::t('app', 'Ratio') ?></th>
			<th><?= Yii::t('app', 'Teams') ?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		if (isset($kfiHasKgi) && count($kfiHasKgi) > 0) {
			$a = 1;
			//throw new exception(print_r($kfiHasKgi, true));
			foreach ($kfiHasKgi as $kgi) :
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
				<tr class="font-size-12">
					<td>
						<a class="no-underline-black" href="<?= Yii::$app->homeUrl . 'kgi/management/kgi-detail/' . ModelMaster::encodeParams(["kgiId" => $kgi['kgiId']]) ?>" style="cursor: pointer;">
							<?= $a ?>.
							<span style="font-weight: 500;">
								<?= $kgi["kgiName"] ?>
							</span>
						</a>
					</td>
					<!-- <td><?php // $kgi["code"] 
							?> <?php // number_format($kgi["targetAmount"], 2) 
								?></td> -->
					<td><?= ModelMaster::shotMonthText($kgi["month"]) ?></td>
					<td><?= Unit::unitName($kgi["unitId"]) ?></td>
					<td class="text-center">
						<span class="pro-load-table">
							<?= $number ?>
						</span>
					</td>
					<td>
						<div class="col-12" style="line-height: 20px;">
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
					<?= Yii::t('app', 'There are no related KGI for this KFI.') ?>
				</td>
			</tr>
		<?php
		}
		?>
	</tbody>
</table>