<?php

use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\Layer;

?>

<div class="row mb-10">
	<div class="col-12 font-size-16 font-b">
		<?= Branch::branchName($branchId) ?>, <?= Department::departmentNAme($departmentId) ?>
	</div>
</div>
<?php
if (isset($layers) && count($layers) > 0) {

	if (isset($departmentId)) {
		$filterDepartmentId = $departmentId;
	} else {
		$filterDepartmentId = '';
	}
	foreach ($layers as $layer) : ?>

		<div class="col-lg-3 col-md-6 col-12">
			<div class="alert alert-light pb-30" role="alert" style="border-radius: 10px;min-height:300px;">
				<div class="col-12 pr-0 text-end">
					<a href="javascript:deleteLayer(<?= $layer['layerId'] ?>)" class="btn btn-outline-danger btn-sm">
						<i class="fa fa-trash-o" aria-hidden="true"></i>
					</a>
				</div>
				<div class="col-12 big-management" id="bottom-layer-<?= $layer['layerId'] ?>">
					<?= $layer['layerName'] ?>
				</div>
				<div class="row mt-10">
					<div class="col-3 font-b text-center" style="border-right: lightgray solid thin;padding-top:37%;min-height:200px;">
						Title
					</div>

					<div class="col-9 TM font-size-14 pl-10" id="sub-layer-tag-<?= $layer['layerId'] ?>">
						<div class="row">
							<?= Layer::titileInLayer($layer['layerId'], $filterDepartmentId) ?>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php
	endforeach;
}
?>