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
	<div class="col-12 mt-20 layer-link pl-40 pt-10 pb-10">
		<div class="row">
			<div class="col-lg-2 col-3 link-item-active">
				<i class="fa fa-bars mr-2" aria-hidden="true"></i>
				Hierarchy Layer
			</div>
			<div class="col-lg-2 col-3 link-item">

				<a href="<?= Yii::$app->homeUrl ?>setting/title/index" class="no-underline-black ">
					<i class="fa fa-list-ul mr-2" aria-hidden="true"></i>
					Title
				</a>
			</div>
		</div>
	</div>
	<div class="col-12 mt-10">
		<div class="row">
			<div class="offset-lg-4 col-lg-4 col-md-4 col-12 mt-10">
				<div class="input-group">
					<button class="btn btn-secondary" type="button">Branch</button>
					<select class="form-select font-size-14" id="branch-team" onchange="javascript:departmentBranch()">

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
			<div class="col-lg-4 col-md-4 col-12 mt-10">
				<div class="input-group">
					<button class="btn btn-secondary" type="button">Department</button>
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
	</div>
	<div class="col-12 mt-20">
		<div class="row">
			<div class="col-lg-5 col-md-12 col-12">
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
			<div class="col-lg-3 col-md-12 col-12">
				<?= $this->render('layer_title', [
					"layers" => $layers
				]) ?>


			</div>
			<div class="col-lg-4 col-md-12 col-12">
				<div class="alert alert-layer1" id="layer-result">
					<div class="row mb-10 leyer-Editor">
						<div class="col-6 text-start">Layer Management</div>
						<div class="col-6 text-end "><?= isset($departmentName) ? $departmentName : "All" ?></div>
					</div>
					<?php
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
				</div>
			</div>
		</div>
	</div>
</div>