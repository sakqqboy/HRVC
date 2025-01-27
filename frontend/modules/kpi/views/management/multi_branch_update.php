<?php

use frontend\models\hrvc\KpiBranch;

if (isset($branches) && count($branches) > 0) { ?>
<div class="col-12 multi-select pl-30 pt-10 pb-5">
    <input type="checkbox" id="check-all-branch-update" name="allBranch[]" class="checkbox-md mr-5" value="all"
        onchange="javascript:checkAllBranchUpdate()">
    <?= Yii::t('app', 'All') ?>
</div>
<?php
	foreach ($branches as $branch) :
		$check = '';
		$has = KpiBranch::isInThisKpi($branch['branchId'], $kpiId);
		if ($has == 1) {
			$check = 'checked';
		}
	?>
<div class="col-12 multi-select pl-30 pt-5 pb-5">
    <input type="checkbox" id='multi-check-update' <?= $check ?> name="branch[]" class="checkbox-md mr-5"
        value="<?= $branch['branchId'] ?>" onchange="javascript:branchMultiDepartmentUpdateKpi()">
    <?= $branch["branchName"] ?>
</div>
<?php
	endforeach;
}
?>