<?php

use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\Layer;

$this->title = 'Management Layer';
?>

<div class="col-12 manage-one" style="margin-top: 90px;">
	<div class="col-12">
		<div class="col-12 branch-title">
			Management Layer
		</div>
	</div>
	<div class="col-12 mt-30">
		<div class="col-lg-2 col-3">
			<div class="alert alert-secondary text-center font-size-18 font-b">
				<a href="<?= Yii::$app->homeUrl ?>setting/title/index" class="nav-link">Title</a>
			</div>
		</div>
	</div>
	<div class="col-12">
		<div class="row">
			<div class="col-lg-8 col-md-12 col-12">
				<div class="alert alert-layer">
					<div class="row">
						<div class="col-12 text-center mt-20 mb-20">
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
									<div class="col-12 ">

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
					</div>

				</div>
			</div>
			<div class="col-lg-4 col-md-12 col-12">
				<?= $this->render('layer_title', [
					"layers" => $layers
				]) ?>


			</div>
			<div class="col-12 mt-10">
				<div class="row">
					<div class="offset-lg-6 col-lg-3 col-md-4 col-12 mt-10">
						<div class="input-group">

							<button class="btn btn-outline-secondary" type="button">Branch</button>
							<select class="form-select font-size-14" id="branch-team" onchange="javascript:departmentBranch()">
								<?php
								if (isset($branchId) && $branchId != '') {
								?>
									<option value="<?= $branchId ?>"><?= Branch::branchName($branchId) ?></option>
								<?php
								}
								?>
								<option value="">Select Branch</option>
								<?php
								if (isset($branches) && count($branches) > 0) {
									foreach ($branches as $branch) : ?>
										<option value="<?= $branch['branchId'] ?>"><?= $branch['branchName'] ?></option>
								<?php
									endforeach;
								}
								?>
							</select>
						</div>
					</div>
					<div class="col-lg-3 col-md-4 col-12 mt-10">
						<div class="input-group">

							<button class="btn btn-outline-secondary" type="button">Department</button>
							<select class="form-select font-size-14" id="department-team" <?= isset($departments) && count($departments) > 0 ? '' : 'disabled' ?>>
								<?php
								if (isset($departmentId) && $departmentId != '') {
								?>
									<option value="<?= $departmentId ?>"><?= Department::departmentNAme($departmentId) ?></option>
								<?php
								}
								?>
								<option value="">Select Department</option>
								<?php
								if (isset($departments) && count($departments) > 0) {
									foreach ($departments as $deparment) : ?>
										<option value="<?= $deparment['departmentId'] ?>"><?= $deparment['departmentName'] ?></option>
								<?php
									endforeach;
								}
								?>
							</select>
							<button type="button" class="btn btn-outline-dark" onclick="javascrip:filterLayerTitle()">
								<i class="fa fa-filter" aria-hidden="true"></i>
							</button>
						</div>
					</div>
				</div>
				<div class="row mt-10" id="layer-result">
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
				</div>
			</div>

		</div>
	</div>
</div>