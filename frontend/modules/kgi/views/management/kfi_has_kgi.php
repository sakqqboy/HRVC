<?php

use common\models\ModelMaster;
use frontend\models\hrvc\KfiBranch;
use frontend\models\hrvc\Unit;

?>
<table class="table table-responsive-lg">
	<thead>
		<tr class="font-size-12">
			<th>KFI Name</th>
			<th>Month</th>
			<th>Unit</th>
			<th>Ratio</th>
			<th>Branch(es)</th>
		</tr>
	</thead>
	<tbody>
		<?php
		if (isset($kgiHasKfi) && count($kgiHasKfi) > 0) {
			$a = 1;
			foreach ($kgiHasKfi as $kfiId => $kfi) :
				$decimal = explode(".", $kfi["ratio"]);
				if (isset($decimal[1]) && $decimal[1] != '00') {
					$number = number_format($kfi["ratio"], 2);
				} else {
					$number = $kfi["ratio"];
				}
				if ($number > 0) {
					$number .= ' %';
				}
		?>
				<tr class="font-size-12">
					<td>
						<a class="no-underline-black" href="<?= Yii::$app->homeUrl . 'kfi/management/kfi-detail/' . ModelMaster::encodeParams(["kfiId" => $kfiId]) ?>" style="cursor: pointer;">
							<?= $a ?>.
							<span class="font-b">
								<?= $kfi["kfiName"] ?>
							</span>
						</a>
					</td>
					<td><?= $kfi["month"] ?></td>
					<td><?= $kfi["unit"] ?></td>
					<td class="text-center">
						<span class="pro-load-table">
							<?= $number ?>
						</span>
					</td>
					<td>
						<div class="col-12" style="line-height: 30px;">
							<?php
							$kfiBranch = KfiBranch::kfiBranch($kfiId);
							if (isset($kfiBranch) && count($kfiBranch) > 0) {
								$i = 1;
								foreach ($kfiBranch as $branch) :
									echo $i . '. ' . $branch["branchName"];
									if ($i < (count($kfiBranch))) {
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
					There are no related KGI for this KFI.
				</td>
			</tr>
		<?php
		}
		?>
	</tbody>
</table>