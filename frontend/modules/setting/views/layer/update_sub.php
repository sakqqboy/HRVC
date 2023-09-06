<div class="col-12 leyer-Editor">
	Sub Layer Title Editor
</div>
<div class="col-12 mt-20 font-size-16 font-b">
	:: <?= $layerName ?> ::
</div>
<div class="row pb-20">
	<?php
	if (isset($subLayers) && count($subLayers) > 0) {
		foreach ($subLayers as $subLayer) :
	?>
			<div class="col-lg-7 col-md-6 col-12 mt-20">
				<label for="exampleFormControlInput1" class="form-label editor1">SubLayer Name</label>
				<input type="text" class="form-control" id="subLayerName-<?= $subLayer['subLayerId'] ?>" value="<?= $subLayer['subLayerName'] ?>" onkeyup="javascript:updateSubLayerName(<?= $subLayer['subLayerId'] ?>)">
			</div>
			<div class="col-lg-5 col-md-6 col-12 mt-20">
				<label for="exampleFormControlInput1" class="form-label editor1"> Short Tag</label>
				<input type="text" class="form-control" id="subLayerTag-<?= $subLayer['subLayerId'] ?>" value="<?= $subLayer['shortTag'] ?>" onkeyup="javascript:updateSubLayerTag(<?= $subLayer['subLayerId'] ?>)">
			</div>
	<?php
		endforeach;
	}
	?>

</div>
<input type="hidden" id="layerId" value="<?= $layerId ?>">