<div class="col-lg-12">
	<div class="col-12 ligth-gray-box">
		<div class="row pl-15 pr-20">
			<div class="col-3  sub-tab-active pl-5">
				<?= Yii::t('app', 'Assigned Individuals') ?>
			</div>
			<div class="col-9  sub-tab">
			</div>
		</div>
		<div class="col-12 alert bg-white mt-15 pt-0" style="height:500px;overflow-y: auto;">
			<div class="row">
				<?php
				if (isset($kfiDetail["kfiEmployeeDetail"]) && count($kfiDetail["kfiEmployeeDetail"]) > 0) {
					foreach ($kfiDetail["kfiEmployeeDetail"] as $employeeId => $employee): ?>
						<!-- <div class="col-lg-3 col-md-4 col-12 mt-10 pt-0" onclick="javascription:openEmployeeView(134,31)" style="cursor: pointer;"> -->
						<div class="col-lg-3 col-md-4 col-12 mt-10 pt-0">
							<div class="row">
								<div class="col-3 pr-0 pl-0">
									<img src="<?= Yii::$app->homeUrl . $employee['picture'] ?>" class="image-AssignMembers">
								</div>
								<div class="col-9 pl-10">
									<div class="col-12 pim-employee-Name pr-0">
										<strong><?= $employee['name'] ?></strong>
									</div>
									<div class="col-12 pim-employee-title">
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
</div>