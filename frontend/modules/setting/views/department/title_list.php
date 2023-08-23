<div class="col-12 text-end text-danger font-size-16 pr-10">
	<i class="fa fa-times-circle close-box" aria-hidden="true" onclick="javascript:closeTitleList(<?= $departmentId ?>)"></i>
</div>
<?php
if (isset($titleList) && count($titleList) > 0) {
	$i = 0;
	foreach ($titleList as $title) :
		$check = '';
		if (isset($dpList[$title['titleId']])) {
			$check = "checked";
		}
?>
		<div class="col-12  pl-25 <?= $i > 0 ? 'pt-10' : '' ?>">
			<input type="checkbox" id="title-<?= $title['titleId'] ?>-<?= $departmentId ?>" <?= $check ?> value="<?= $title['titleId'] ?>" class="mr-8 checkbox-md" onchange="javascript:savetitleList(<?= $departmentId ?>,<?= $title['titleId'] ?>)"><?= $title["titleName"] ?>
		</div>
	<?php
		$i++;
	endforeach;
} else { ?>
	<div class="col-12  pl-25 pt-20">
		Create Title
	</div>
<?php
}
?>