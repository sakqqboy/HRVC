<?php

use frontend\models\hrvc\KpiBranch;

if (isset($branches) && count($branches) > 0) {
	foreach ($branches as $branch) :
		$isCheck = 0;
		$isCheck = KpiBranch::isInThisKpi($branch['branchId'], $kpiId);
?>
		<div class="row mt-10">
			<div class="col-2  text-end border-bottom pb-10">
				<input class="checkbox-lg" id="assign-branch-kpi-<?= $kpiId ?>-<?= $branch['branchId'] ?>" onchange="javascript:assignKpiBranch(<?= $kpiId ?>,<?= $branch['branchId'] ?>)" type="checkbox" value="<?= $branch['branchId'] ?>" <?= $isCheck == 1 ? 'checked' : '' ?>>
			</div>
			<div class="col-10 pl-0 text-start border-bottom pb-10">
				<?= $branch['branchName'] ?>
			</div>
		</div>

<?php
	endforeach;
}
?>