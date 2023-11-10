<?php

use frontend\models\hrvc\Branch;
use frontend\models\hrvc\KgiDepartment;

if (isset($d) && count($d) > 0) {
	foreach ($d as $branchId => $department) : ?>
		<div class="col-12 multi-select-head pl-10 pt-10 pb-3">
			<?=
			Branch::branchName($branchId)
			?>
		</div>
		<?php
		if (count($department) > 1) { ?>
			<div class="col-12 multi-select pl-30 pt-5 pb-5">
				<input type="checkbox" id='multi-check-all-<?= $branchId ?>-update' name="allDepartment[]" class="checkbox-md mr-5 " value="all" onchange="javascript:allDepartmentUpdate(<?= $branchId ?>)">
				All
			</div>
		<?php
		}
		foreach ($department as $departmentId => $departmentName) :

			$check = '';
			$has = KgiDepartment::isInThisKgi($departmentId, $kgiId);
			if ($has == 1) {
				$check = 'checked';
			}
		?>
			<div class="col-12 multi-select pl-30 pt-5 pb-5">
				<input type="checkbox" <?= $check ?> id='multi-check-<?= $branchId ?>-update' name="department[]" required class="checkbox-md mr-5 multi-check-department-update multiDepartment-<?= $branchId ?>" value="<?= $departmentId ?>" onchange="javascript:departmentMultiTeamUpdate(<?= $branchId ?>)">
				<?= $departmentName ?>
			</div>
<?php
		endforeach;
	endforeach;
}
