<?php
if (isset($branches) && count($branches) > 0) { ?>
<div class="col-12 multi-select pl-30 pt-10 pb-5">
    <input type="checkbox" id="check-all-branch" name="allBranch[]" class="checkbox-md mr-5" value="all"
        onchange="javascript:checkAllBranch()">
    <?= Yii::t('app', 'All') ?>
</div>
<?php
	foreach ($branches as $branch) : ?>
<div class="col-12 multi-select pl-30 pt-5 pb-5">
    <input type="checkbox" id='multi-check' name="branch[]" id="" class="checkbox-md mr-5"
        value="<?= $branch['branchId'] ?>" onchange="javascript:branchMultiDepartment()">
    <?= $branch["branchName"] ?>
</div>
<?php
	endforeach;
}
?>