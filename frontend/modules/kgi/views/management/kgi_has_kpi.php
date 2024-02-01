<?php

use common\models\ModelMaster;
use frontend\models\hrvc\KpiBranch;
use frontend\models\hrvc\Unit;

?>
<table class="table table-responsive-lg">
	<thead>
		<th>KPI Name</th>
		<th>Target</th>
		<th>Month</th>
		<th>Unit</th>
		<th>Branch(es)</th>
	</thead>
	<tbody>
		<?php
		if (isset($kgiHasKpi) && count($kgiHasKpi) > 0) {
			$a = 1;
			foreach ($kgiHasKpi as $kpi) : ?>
				<tr class="font-size-12">
					<td>
						<a class="no-underline-black" href="<?= Yii::$app->homeUrl . 'kpi/management/kpi-detail/' . ModelMaster::encodeParams(["kpiId" => $kpi['kpiId']]) ?>" style="cursor: pointer;">
							<?= $a ?>.
							<span class="font-b">
								<?= $kpi["kpiName"] ?>
							</span>
						</a>
					</td>
					<td><?= number_format($kpi["targetAmount"], 2) ?></td>
					<td><?= ModelMaster::shotMonthText($kpi["month"]) ?></td>
					<td><?= Unit::unitName($kpi["unitId"]) ?></td>
					<td>
						<div class="col-12" style="line-height: 30px;">
							<?php
							$kpiBranch = KpiBranch::kpiBranch($kpi["kpiId"]);
							if (isset($kpiBranch) && count($kpiBranch) > 0) {
								$i = 1;
								foreach ($kpiBranch as $branch) :
									echo $i . '. ' . $branch["branchName"];
									if ($i < (count($kpiBranch))) {
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
					There are no related KPI for this KGI.
				</td>
			</tr>
		<?php
		}
		?>
	</tbody>
</table>