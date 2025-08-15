<div class="col-12 ligth-gray-box">
	<div class="row pl-15 pr-20">
		<div class="col-3  sub-tab-active pl-5">
			<?= Yii::t('app', 'Assigned Individuals') ?>
		</div>
		<div class="col-9  sub-tab">
		</div>
	</div>
	<div class="col-12 alert bg-white mt-15 pt-10" style="height:500px;overflow-y: auto;">
		<div class="row">
			<?php
			if (isset($kfiDetail["kfiEmployeeDetail"]) && count($kfiDetail["kfiEmployeeDetail"]) > 0) {
				foreach ($kfiDetail["kfiEmployeeDetail"] as $employeeId => $employee): ?>
					<!-- <div class="col-lg-3 col-md-4 col-12 mt-10 pt-0" onclick="javascription:openEmployeeView(134,31)" style="cursor: pointer;"> -->
					<div class="col-3">
						<div class="d-flex">
							<div class=" mr-3">
								<img src="<?= Yii::$app->homeUrl . $employee['picture'] ?>" class="image-AssignMembers" style="width:40px;height:40px;">
							</div>
							<div class="flex-flex-grow-1 ">
								<div class="col-12 font-size-12 pr-0">
									<strong><?= $employee['name'] ?></strong>
								</div>
								<div class="col-12 " style="font-size: 10px !important;font-weight: 400;color:#656565;">
									<?= Yii::t('app', $employee['title']) ?>
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