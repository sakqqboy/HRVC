<?php
if (isset($titleDepartments) && count($titleDepartments) > 0) {
	foreach ($titleDepartments as $dpm) : ?>
		<div class="col-12 mt-5">
			<?= $dpm["titleName"] ?>
		</div>
<?php
	endforeach;
}
?>