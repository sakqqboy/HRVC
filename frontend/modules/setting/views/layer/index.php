<?php

use frontend\models\hrvc\SubLayer;

$this->title = 'Management Layer';
?>

<div class="col-12 manage-one" style="margin-top: 90px;">
	<div class="col-12">
		<div class="col-12 branch-title">
			Management Layer
		</div>
	</div>
	<div class="col-12 mt-30">
		<div class="col-lg-5 col-md-6 col-4">
			<div class="alert alert-secondary backtitle" role="alert">
				<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
					<li class="nav-item">
						<button class="nav-link title1-top" id="pills-title-tab" data-bs-toggle="pill" data-bs-target="#pills-title" type="button" role="tab" aria-controls="pills-title" aria-selected="true">Title</button>
					</li>
					<li class="nav-item">
						<button class="nav-link title1-top" id="pills-Management-tab" data-bs-toggle="pill" data-bs-target="#pills-Management-Layer" type="button" role="tab" aria-controls="pills-Management-Layer" aria-selected="false">Management Layer</button>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-12">
		<div class="row">
			<div class="col-lg-8 col-md-12 col-12">
				<div class="alert alert-layer" role="alert">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12 text-center mt-50">
							<?php
							$i = 1;
							if (isset($layers) && count($layers) <= 2) {
								$class1 = "basic-layer";
								$class2 = "basic-layer-text";
							} else {
								$class1 = "advance-layer";
								$class2 = "advance-layer-text";
							}
							if (isset($layers) && count($layers) > 0) {
								foreach ($layers as $layer) :
							?>
									<div class="col-12 text-center" onclick="javascript:showSubLayer(<?= $layer['layerId'] ?>)" style="cursor: pointer;">

										<img src="<?= Yii::$app->homeUrl ?>image/shape-<?= $i ?>.png" class="<?= $class1 ?>">
										<?php
										$arr = explode(" ", $layer['layerName']);
										?>
										<div class="<?= $class2 ?> col-12" id="layerName-<?= $layer['layerId'] ?>">

											<?= $arr[0] ?>

											<p>
												<?php
												if (isset($arr[1])) { ?>
													<?= $arr[1] ?>
												<?php
												}
												if (isset($arr[2])) { ?>
													<?= $arr[2] ?>
												<?php
												}
												if (isset($arr[3])) { ?>
													<?= $arr[3] ?>
												<?php
												}
												?>
											</p>
										</div>
									</div>
							<?php
									$i++;
								endforeach;
							}
							?>
							<div class="col-12 text-center create-new-layer" id="createNewLayer" onclick="javascript:addNewLayer(<?= $i ?>)">

								<img src="<?= Yii::$app->homeUrl ?>image/shape-<?= $i ?>.png" class="<?= $class1 ?> ">

								<div class="<?= $class2 ?> col-12">
									+ Create new
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 top-layer-all">
							<?php
							if (isset($layers) && count($layers) > 0) {
								foreach ($layers as $layer) : ?>
									<div class="alert alert-light pb-30" role="alert" style="border-radius: 10px;">
										<div class="col-12 Top-sub-Layer ">
											<span id="right-layer-<?= $layer['layerId'] ?>"><?= $layer['layerName'] ?></span> Sub Layer
										</div>
										<div class="row pl-30 pr-30">
											<div class="col-10 mt-10 ">
												<input class="form-control me-2" id="sublayer-<?= $layer['layerId'] ?>" type="text" placeholder="" aria-label="">
											</div>
											<div class="col-2 mt-10">
												<a href="javascript:addSubLayer(<?= $layer['layerId'] ?>)" class="btn btn-success">Add</a>
											</div>
										</div>
									</div>

							<?php
								endforeach;
							}
							?>
						</div>
					</div>
					<div class="col-12 mt-20">
						<div class="row">
							<?php
							if (isset($layers) && count($layers) > 0) {
								foreach ($layers as $layer) : ?>

									<div class="col-lg-4 col-md-6 col-12">
										<div class="alert alert-light" role="alert" style="border-radius: 10px;padding-bottom:30px;min-height:200px;">
											<div class="col-12 pr-0 text-end">
												<a href="javascript:deleteLayer(<?= $layer['layerId'] ?>)" class="btn btn-outline-danger btn-sm">
													<i class="fa fa-trash-o" aria-hidden="true"></i>
												</a>
											</div>
											<div class="col-12 big-management" id="bottom-layer-<?= $layer['layerId'] ?>">
												<a href="javascript:showSubLayer(<?= $layer['layerId'] ?>)" class="no-underline-black">
													<?= $layer['layerName'] ?>
												</a>
											</div>
											<div class="row mt-10">
												<div class="col-3 text-center" style="border-right: lightgray solid thin;">
													<img src="<?= Yii::$app->homeUrl ?>image/Vector.png" class="alert-vector">
												</div>

												<div class="col-5 sub-later0">
													SUB-LAYER
												</div>
												<div class="col-3 TM font-size-16" id="sub-layer-tag-<?= $layer['layerId'] ?>">
													<?= SubLayer::subLayerInLayer($layer['layerId']) ?>
												</div>
											</div>
										</div>
									</div>
							<?php
								endforeach;
							}
							?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-12 col-12">
				<?= $this->render('layer_title', [
					"layers" => $layers
				]) ?>
				<?= $this->render('sub_layer') ?>

			</div>

		</div>
	</div>
</div>