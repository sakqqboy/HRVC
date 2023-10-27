<div class="row mb-10 leyer-Editor">
	<div class="col-6 text-start">Layer Management</div>
	<div class="col-6 text-end "><?= isset($departmentName) ? $departmentName : "All" ?></div>
</div>
<?php

use frontend\models\hrvc\Layer;

if (isset($layers) && count($layers) > 0) {

	if (isset($departmentId)) {
		$filterDepartmentId = $departmentId;
	} else {
		$filterDepartmentId = '';
	}
	foreach ($layers as $layer) : ?>

		<div class="col-lg-12 col-md-6 col-12">
			<div class="alert alert-light pb-30" role="alert" style="border-radius: 10px;min-height:150px;">
				<div class="col-12 pr-0 text-end">
					<a href="javascript:deleteLayer(<?= $layer['layerId'] ?>)" class="btn btn-outline-danger btn-sm">
						<i class="fa fa-trash-o" aria-hidden="true"></i>
					</a>
				</div>
				<div class="col-12 big-management" id="bottom-layer-<?= $layer['layerId'] ?>">

				</div>
				<div class="row mt-10">
					<div class="col-4 text-center" style="border-right: lightgray solid thin;min-height:100px;">
						<div class="col-12  big-management" id="bottom-layer-<?= $layer['layerId'] ?>">
							<i class="fa fa-bars mr-2" aria-hidden="true"></i>
							Layer
						</div>
						<div class="col-12 font-size-14" style="line-height: 20px;margin-top:30%;">
							<?= $layer['layerName'] ?>
						</div>

					</div>

					<div class="col-8 TM font-size-14 pl-10" id="sub-layer-tag-<?= $layer['layerId'] ?>">
						<div class="col-12 text-left pl-20 big-management" id="bottom-layer-<?= $layer['layerId'] ?>">
							<img src="<?= Yii::$app->homeUrl ?>image/Vector.png" class="mr-2" style="width:18px;height:18px;">
							Title
						</div>
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