<?php

use common\models\ModelMaster;
use frontend\models\hrvc\KgiBranch;
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
		if (isset($kpiHasKgi) && count($kpiHasKgi) > 0) {
			$a = 1;
			foreach ($kpiHasKgi as $kgi) : ?>
				<tr>
					<td><?= $a ?>.
						<span class="font-b" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#kgi-view" onclick="javascript:kgiHistory(<?= $kgi['kgiId'] ?>)">
							<?= $kgi["kgiName"] ?>
						</span>
					</td>
					<td><?= number_format($kgi["targetAmount"], 2) ?></td>
					<td><?= ModelMaster::shotMonthText($kgi["month"]) ?></td>
					<td><?= Unit::unitName($kgi["unitId"]) ?></td>
					<td>
						<div class="col-12" style="line-height: 30px;">
							<?php
							$kgiBranch = KgiBranch::kgiBranch($kgi["kgiId"]);
							if (isset($kgiBranch) && count($kgiBranch) > 0) {
								$i = 1;
								foreach ($kgiBranch as $branch) :
									echo $i . '. ' . $branch["branchName"];
									if ($i < (count($kgiBranch))) {
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