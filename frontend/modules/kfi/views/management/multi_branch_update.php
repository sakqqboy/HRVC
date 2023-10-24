<?php

use frontend\models\hrvc\KfiBranch;

if (isset($branches) && count($branches) > 0) { ?>
	<div class="col-12 multi-select pl-30 pt-10 pb-5">
		<input type="checkbox" id="check-all-branch-update" name="allBranch[]" class="checkbox-md mr-5" value="all" onchange="javascript:checkAllBranchUpdate()">
		All
	</div>
	<?php
	foreach ($branches as $branch) :
		$check = '';
		$has = KfiBranch::isInThisKfi($branch['branchId'], $kfiId);
		if ($has == 1) {
			$check = 'checked';
		}
	?>
		<div class="col-12 multi-select pl-30 pt-5 pb-5">
			<input type="checkbox" id='multi-check-update' <?= $check ?> name="branch[]" id="" class="checkbox-md mr-5 multiCheck-<?= $branch['branchId'] ?>" value="<?= $branch['branchId'] ?>" onchange="javascript:branchMultiDepartmentUpdateKfi()">
			<?= $branch["branchName"] ?>
		</div>
<?php
	endforeach;
}
?>