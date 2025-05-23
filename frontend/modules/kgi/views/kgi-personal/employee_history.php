<div class="col-12 ligth-gray-box">
	<div class="row pl-15 pr-20">
		<div class="col-6  sub-tab-active pl-5">
			<?= Yii::t('app', 'Current Assigned Individuals') ?>
		</div>
		<div class="col-6 sub-tab">
		</div>
	</div>
	<div class="col-12 mt-15 alert pt-0" style="height:500px;overflow-y: auto;">
		<div class="row">
			<?php

			use common\models\ModelMaster;

			$allKgiEmployeeId = '';
			if (isset($kgiTeamEmployeeHistory) && count($kgiTeamEmployeeHistory) > 0) {
				$i = 0;
				foreach ($kgiTeamEmployeeHistory as $kgiEmployeeId => $kgh):
			?>
					<div class="col-12 mb-15" id="main-<?= $kgiEmployeeId ?>">
						<div class="col-12 small-content-pim bg-white" style="cursor: pointer;" onclick="ShowEmployeeUpdating(<?= $kgiEmployeeId ?>)">
							<div class="row">
								<div class="col-1 pr-0 pl-0 text-center pt-5">
									<img src="<?= Yii::$app->homeUrl ?><?= $kgh['picture'] ?>" class="pim-image-AssignMembers">
								</div>
								<div class="col-5">
									<div class="col-12 font-size-16 text-b" style="font-weight: 400;">
										<?= $kgh['employeeName'] ?>
									</div>
									<div class="col-12" style="font-size: 14px !important;font-weight: 600;color:#656565;">
										<?= $kgh["title"] == '' ? 'Not set' : $kgh["title"] ?>
									</div>
								</div>
								<div class="col-5 text-center text-end">
									<div class="col-12 font-size-18 text-b pr-0 text-end">
										<span style="font-size: 18px !important;font-weight: 500;"><?= $kgh['result'] ?></span>
										<span style="font-size: 18px !important;font-weight: 700;color:#2580D3;"> /<?= $kgh["target"] ?></span>
									</div>
									<div class="col-12 text-end" style="font-size: 14px !important;font-weight: 400;color:#656565;">
										<?= $kgh["updateDateTime"] ?>
									</div>
								</div>
								<div class="col-1 text-center pr-0 pl-0 pt-10" style="font-weight: 400;">
									<a href="" class="doubleplay-btn">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/pim/doubleplay-black.svg">
									</a>

								</div>
							</div>

						</div>
					</div>
					<div class="col-12 small-content-pim ligth-gray-box" style="display:none;" id="history-<?= $kgiEmployeeId ?>">
						<div class="row mb-20">
							<div class="col-7 border-bottom pb-10 pt-10 pl-0 ">
								<a onclick="javascript:backUpdatingKgiEmployee(<?= $kgiEmployeeId ?>)" class="view-back-btn" style="text-decoration: none;cursor:pointer;">
									<img src="<?= Yii::$app->homeUrl ?>images/icons/pim/double-back.svg">
									<?= Yii::t('app', 'Back') ?>
								</a>
								<img src="<?= Yii::$app->homeUrl ?><?= $kgh['picture'] ?>" class="pim-image-AssignMembers ml-10 mr-10">

								<span class="col-12 font-size-16 text-b" style="font-weight: 600;">
									<?= $kgh['employeeName'] ?>
								</span>
							</div>
							<div class="col-5 font-size-18 text-b pr-0 text-end border-bottom pt-15 pr-5">
								<span style="font-size: 18px !important;font-weight: 500;"><?= $kgh['result'] ?></span>
								<span style="font-size: 18px !important;font-weight: 700;color:#2580D3;"> /<?= $kgh["target"] ?></span>
							</div>
						</div>
						<?php if (count($kgh['employeeHistory']) > 0) {
							foreach ($kgh['employeeHistory'] as $kgiEmployeeHistoryId => $history):
						?>
								<div class="row">
									<div class="col-12 small-content-pim bg-white" style="cursor: pointer;">
										<div class="row">
											<div class="col-1 pr-0 pl-0 text-center pt-5">
												<img src="<?= Yii::$app->homeUrl ?>images/icons/pim/update.svg" class="pim-image-AssignMembers">
											</div>
											<div class="col-7">
												<div class="col-12 font-size-16 text-b" style="font-weight: 400;">
													<?= $history['detail'] == '' ? 'updated' : $history['detail'] ?>
												</div>
												<div class="col-12" style="font-size: 14px !important;font-weight: 600;color:#656565;">
													<?= $history["fromDate"] ?> - <?= $history["toDate"] ?>
												</div>
											</div>
											<div class="col-4 text-center text-end">
												<div class="col-12 font-size-18 text-b pr-0 text-end">
													<span style="font-size: 18px !important;font-weight: 700;color:#2580D3;"><?= $history["result"] ?></span>
												</div>
												<div class="col-12 text-end" style="font-size: 14px !important;font-weight: 400;color:#656565;">
													Due Behind <?= $history["dueBehide"] ?>
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
				<?php
					$allKgiEmployeeId .= $kgiEmployeeId . ',';
					$i++;
				endforeach;
			} else {
				?>
				<div class="col-12 mb-15">
					<div class="col-12 small-content-pim bg-white font-size-16 text-center" style="font-weight: 600;color:#656565;">
						There are no employee assigned in <?= ModelMaster::monthEng($month, 1) ?>, <?= $year ?>
					</div>
				</div>
		</div><?php
			}
			?>
	<input type="hidden" id="allKgiEmployeeId" value="<?= $allKgiEmployeeId ?>">
	</div>
</div>