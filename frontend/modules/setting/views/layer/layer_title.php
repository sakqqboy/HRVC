<div class="alert alert-layer1" role="alert">
	<div class="col-12 leyer-Editor">
		Hierarchy Title Editor
	</div>
	<div class="row pb-20">
		<?php

		if (isset($layers) && count($layers)) {
			foreach ($layers as $layer) : ?>
				<div class="col-lg-7 col-md-6 col-12 mt-20">
					<label for="exampleFormControlInput1" class="form-label editor1"> <?= $layer["layerName"] ?></label>
					<input type="text" class="form-control font-size-12" id="layerName<?= $layer['layerId'] ?>" value="<?= $layer['layerName'] ?>" onkeyup="javascript:updateLayerName(<?= $layer['layerId'] ?>)">
				</div>
				<div class="col-lg-5 col-md-6 col-12 mt-20">
					<label for="exampleFormControlInput1" class="form-label editor1"> Short Tag</label>
					<input type="text" class="form-control font-size-12" id="shortTag<?= $layer['layerId'] ?>" value="<?= $layer['shortTag'] ?>" onkeyup="javascript:updateLayerTag(<?= $layer['layerId'] ?>)">
				</div>
		<?php
			endforeach;
		}
		?>


	</div>
</div>