<?php

use frontend\models\hrvc\KgiBranch;

if (isset($branches) && count($branches) > 0) { ?>
	<div class="col-12 multi-select pl-30 pt-10 pb-5">
		<input type="checkbox" id="check-all-branch-update" name="allBranch[]" class="checkbox-md mr-5 multiCheck-<?= $branch['branchId'] ?>" value="all" onchange="javascript:checkAllBranchUpdate()">
		All
	</div>
	<?php
	foreach ($branches as $branch) :
		$check = '';
		$has = KgiBranch::isInThisKgi($branch['branchId'], $kgiId);
		if ($has == 1) {
			$check = 'checked';
		}
	?>
		<div class="col-12 multi-select pl-30 pt-5 pb-5">
			<input type="checkbox" id='multi-check-update' <?= $check ?> name="branch[]" class="checkbox-md mr-5 multiCheck-<?= $branch['branchId'] ?>" value="<?= $branch['branchId'] ?>" onchange="javascript:branchMultiDepartmentUpdate()">
			<?= $branch["branchName"] ?>
		</div>
<?php
	endforeach;
}
?>