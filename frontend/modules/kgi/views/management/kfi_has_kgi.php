<?php

use common\models\ModelMaster;
use frontend\models\hrvc\KfiBranch;
use frontend\models\hrvc\Unit;

?>
<table class="table table-responsive-lg">
	<thead>
		<th>KFI Name</th>
		<th>Target</th>
		<th>Month</th>
		<th>Unit</th>
		<th>Branch(es)</th>
	</thead>
	<tbody>
		<?php
		if (isset($kgiHasKfi) && count($kgiHasKfi) > 0) {
			$a = 1;
			foreach ($kgiHasKfi as $kfi) : ?>
				<tr>
					<td><?= $a ?>.
						<span class="font-b" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#kfi-view" onclick="javascript:kfiHistory(<?= $kfi['kfiId'] ?>)">
							<?= $kfi["kfiName"] ?>
						</span>
					</td>
					<td><?= number_format($kfi["targetAmount"], 2) ?></td>
					<td><?= ModelMaster::shotMonthText($kfi["month"]) ?></td>
					<td><?= Unit::unitName($kfi["unitId"]) ?></td>
					<td>
						<div class="col-12" style="line-height: 30px;">
							<?php
							$kfiBranch = KfiBranch::kfiBranch($kfi["kfiId"]);
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