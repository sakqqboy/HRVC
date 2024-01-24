<?php

use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Department;

if (isset($d) && count($d) > 0) {
	foreach ($d as $branchId => $department) :
?>
		<div class="col-12 multi-select-head pl-10 pt-10 pb-3">
			<?=
			Branch::branchName($branchId)
			?>
		</div>
		<?php
		if (count($department) > 1) { ?>
			<div class="col-12 multi-select pl-30 pt-5 pb-5">
				<input type="checkbox" id='multi-check-all-<?= $branchId ?>' name="allDepartment[]" class="checkbox-md mr-5 " value="all" onchange="javascript:allDepartment(<?= $branchId ?>)">
				All
			</div>
			<?php
		}
		foreach ($department as $departmentId => $departmentName) :
			$haveTeam = Department::haveTeam($departmentId);
			if ($haveTeam == 1) {
			?>
				<div class="col-12 multi-select pl-30 pt-5 pb-5">
					<input type="checkbox" id='multi-check-<?= $branchId ?>' name="department[]" required class="checkbox-md mr-5 multi-check-department multiDepartment-<?= $departmentId ?>" value="<?= $departmentId ?>" onchange="javascript:departmentMultiTeam(<?= $branchId ?>)">
					<?= $departmentName ?>
				</div>
<?php
			}
		endforeach;
	endforeach;
}
