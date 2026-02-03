<div class="col-12 ligth-gray-box">
	<div class="row pl-15 pr-20">
		<div class="col-6  sub-tab-active pl-5">
			<?= Yii::t('app', 'Current Assigned Individuals') ?>
		</div>
		<div class="col-6 sub-tab">
		</div>
	</div>
	<div class="col-12 mt-10 pt-0" style="height:400px;overflow-y: auto;">
		<div class="row" style="--bs-gutter-x:0px;">
			<?php

			use common\models\ModelMaster;

			$allKgiEmployeeId = '';
			if (isset($kgiTeamEmployeeHistory) && count($kgiTeamEmployeeHistory) > 0) {
				$i = 0;
				foreach ($kgiTeamEmployeeHistory as $kgiEmployeeId => $kgh):
			?>
					<div class="col-12 mb-5" id="main-<?= $kgiEmployeeId ?>">
						<div class="small-content-pim bg-white" style="cursor: pointer;" onclick="ShowEmployeeUpdating(<?= $kgiEmployeeId ?>)">
							<div class="row" style="--bs-gutter-x:0px;width:100%;">
								<div class="col-1 pr-0 pl-0 text-center align-content-center">
									<img src="<?= Yii::$app->homeUrl ?><?= $kgh['picture'] ?>" class="pim-image-AssignMembers">
								</div>
								<div class="col-5 pl-5 align-content-center">
									<div class="col-12 font-size-16 text-b text-truncate" style="font-weight: 400;">
										<?= $kgh['employeeName'] ?>
									</div>
									<div class="col-12" style="font-size: 14px !important;font-weight: 600;color:#656565;">
										<?= $kgh["title"] == '' ? 'Not set' : $kgh["title"] ?>
									</div>
								</div>
								<div class="col-5 text-end align-content-center">
									<div class="col-12 font-size-18 text-b pr-0 text-end">
										<span style="font-size: 18px !important;font-weight: 500;"><?= $kgh['result'] ?></span>
										<span style="font-size: 18px !important;font-weight: 700;color:#2580D3;"> /<?= $kgh["target"] ?></span>
									</div>
									<div class="col-12 text-end" style="font-size: 14px !important;font-weight: 400;color:#656565;">
										<?= $kgh["updateDateTime"] ?>
									</div>
								</div>
								<div class="col-1 text-center pr-0 pl-0 align-content-center" style="font-weight: 400;justify-items: end;">
									<a href="javascript:void(0);" onclick="event.stopPropagation();ShowEmployeeUpdating(<?= $kgiEmployeeId ?>)" class="doubleplay-btn flex-all-center">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/pim/doubleplay-black.svg" style="width:18px;height:18px;">
									</a>

								</div>
							</div>

						</div>
					</div>
					<div style="display:none;" id="history-<?= $kgiEmployeeId ?>">
						<div class="small-content-pim ligth-gray-box">
							<div class="d-flex justify-content-start align-items-center w-100 border-bottom pl-15 pr-15">
								<div class="d-flex align-items-center">
									<a onclick="javascript:backUpdatingKgiEmployee(<?= $kgiEmployeeId ?>)" class="view-back-btn" style="text-decoration: none;cursor:pointer;">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/pim/double-back.svg" class="mr-3">
										<?= Yii::t('app', 'Back') ?>
									</a>
									<img src="<?= Yii::$app->homeUrl ?><?= $kgh['picture'] ?>" class="pim-image-AssignMembers ml-10 mr-10">

									<span class="font-size-16 text-b text-truncate" style="font-weight: 600;">
										<?= $kgh['employeeName'] ?>
									</span>
								</div>
								<div class="flex-grow-1 font-size-18 text-b text-end">
									<span style="font-size: 18px !important;font-weight: 500;"><?= $kgh['result'] ?></span>
									<span style="font-size: 18px !important;font-weight: 700;color:#2580D3;"> /<?= $kgh["target"] ?></span>
								</div>
							</div>
						</div>
						<div class="col-12 mt-5">
							<?php if (count($kgh['employeeHistory']) > 0) {
								foreach ($kgh['employeeHistory'] as $kgiEmployeeHistoryId => $history):
							?>

									<div class="col-12 bg-white mb-5" style="cursor: pointer;border-radius:4px;">
										<div class="row" style="--bs-gutter-x:0px;">
											<div class="col-1 pr-0 pl-5 text-center align-content-center">
												<img src="<?= Yii::$app->homeUrl ?>images/icons/pim/update.svg" class="pim-image-AssignMembers" style="width:30px;height:30px;">
											</div>
											<div class="col-7 pl-10">
												<div class="col-12 font-size-16 text-b" style="font-weight: 400;">
													<?= $history['detail'] == '' ? 'updated' : $history['detail'] ?>
												</div>
												<div class="col-12" style="font-size: 14px !important;font-weight: 600;color:#656565;">
													<?= $history["fromDate"] ?> - <?= $history["toDate"] ?>
												</div>
											</div>
											<div class="col-4 text-center text-end pr-5">
												<div class="col-12 font-size-18 text-b pr-0 text-end">
													<span style="font-size: 18px !important;font-weight: 700;color:#2580D3;"><?= $history["result"] ?></span>
												</div>
												<div class="col-12 text-end" style="font-size: 14px !important;font-weight: 400;color:#656565;">
													<?= Yii::t('app', 'Due Behind') ?> <?= $history["dueBehide"] ?>
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
				<?php
					$allKgiEmployeeId .= $kgiEmployeeId . ',';
					$i++;
				endforeach;
			} else {
				?>
				<div class="col-12 mb-15">
					<div class="col-12 small-content-pim bg-white font-size-16 text-center" style="font-weight: 600;color:#656565;">
						<?= Yii::t('app', 'There are no employee assigned in') ?> <?= ModelMaster::monthEng($month, 1) ?>, <?= $year ?>
					</div>
				</div>
		</div><?php
			}
			?>
	<input type="hidden" id="allKgiEmployeeId" value="<?= $allKgiEmployeeId ?>">
	</div>
</div>