<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<div class="col-12 ligth-gray-box">
	<div class="row pl-15 pr-20">
		<div class="col-9 sub-tab-active pl-5 pb-5">
			<a onclick="javascript:viewTabKgi(0,1)" class="view-back-btn" style="text-decoration: none;cursor:pointer;">
				<img src="<?= Yii::$app->homeUrl ?>images/icons/pim/double-back.svg">
				<?= Yii::t('app', 'Back') ?>
			</a>
			<img src="<?= Yii::$app->homeUrl ?>images/icons/pim/team.svg" class="ml-10 mr-8 title-team-icon">
			<span class="font-size-16 text-b" style="font-weight: 600;color:black;"><?= $team['teamName'] ?>,</span>
			<span style="font-size: 14px !important;font-weight: 400;color:#656565;">
				<?= $departmentName ?>
			</span>
		</div>
		<div class="col-3 sub-tab text-end pr-0">

		</div>
	</div>
	<div class="col-12 mt-15 alert pt-0" style="height:500px;overflow-y: auto;">
		<div class="row">
			<?php

			use common\models\ModelMaster;

			$month = [];
			$currentSelect = '';
			if (isset($kgiTeamHistory) && count($kgiTeamHistory) > 0) {
				$i = 0;
				foreach ($kgiTeamHistory as $kgh):
					if (!isset($month[$kgh["month"]][$kgh["year"]])) {
						$isOver = ModelMaster::isOverDuedate($kgh["nextCheckDate"]);
						$statusText = '';
						if ($isOver == 1 && $kgh["status"] != 2) {
							$colorFormat = 'over';
							$statusText = 'Due Passed';
						} else {
							if ($kgh["status"] == 1) {
								if ($isOver == 2) {
									$colorFormat = 'disable';
									$statusText = 'Not Set';
								} else {
									$colorFormat = 'inprogress';
									$statusText = 'In-Progress';
								}
							} else {
								$colorFormat = 'complete';
								$statusText = 'Completed';
							}
						}
						$ratio = 0;
						if ($kgh["target"] != '' && $kgh["target"] != 0) {
							if ($code == '<' || $code == '=') {
								$ratio = ($kgh["result"] / $kgh["target"]) * 100;
							} else {
								if ($kgh["result"] != '' && $kgh["result"] != 0) {
									$ratio = ($kgh["target"] / $kgh["result"]) * 100;
								} else {
									$ratio = 0;
								}
							}
						}
						$ratio = ModelMaster::pimNumberFormat($ratio);
						if ($i == 0) {
							$currentSelect = $kgh['kgiTeamHistoryId'];
						}
			?>
						<div class="col-12 mb-15">
							<div class="col-12 small-content-pim <?= $i == 0 ? 'selectedTeam' : 'bg-white' ?>" style="cursor: pointer;" onclick="javascript:showTeamEmployeeUpdate(<?= $team['teamId'] ?>,<?= $kgiId ?>,'<?= $kgh['month'] ?>','<?= $kgh['year'] ?>',<?= $kgh['kgiTeamHistoryId'] ?>)" id="historyMonthYear-<?= $kgh['kgiTeamHistoryId'] ?>">
								<div class="row">
									<div class="col-5">
										<div class="col-12 font-size-16 text-b" style="font-weight: 600;">
											<?= ModelMaster::monthEng($kgh['month'], 1) ?> <?= $kgh['year'] ?>
										</div>
										<div class="col-12" style="font-size: 14px !important;font-weight: 400;color:#656565;">
											<?= ModelMaster::engDate($kgh["fromDate"], 2) ?> - <?= ModelMaster::engDate($kgh["toDate"], 2) ?>
										</div>
									</div>
									<div class="col-2  pt-12">
										<div class="<?= $colorFormat ?>-tag text-center"><?= $statusText ?> </div>
									</div>

									<div class="col-4 text-center text-end  pr-0 pl-0">
										<div class="row">
											<div class="col-4 pt-5 pr-0">
												<svg viewBox="0 0 36 36" class="circular-chart-view dark-blue pull-right" style="margin-right: -15px;">
													<path class="circle-view-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
													<path class="circle-view" id="KFI-progress-<?= $kgh['year'] ?>-<?= $kgh['month'] ?>" stroke-dasharray="<?= $ratio ?>, 100"
														d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
													<text id="KFI-percentage" x="18" y="20.35" text-anchor="middle"
														dominant-baseline="middle" class="percentage-view">
														<?= $ratio ?>%
													</text>
												</svg>
											</div>
											<div class="col-8">
												<div class="col-12 font-size-18 text-b pr-0 text-end">
													<span style="font-size: 18px !important;font-weight: 500;"><?= ModelMaster::pimNumberFormat($kgh['result']) ?></span>
													<span style="font-size: 18px !important;font-weight: 700;color:#2580D3;"> / <?= ModelMaster::pimNumberFormat($kgh["target"]) ?></span>
												</div>
												<div class="col-12 text-end" style="font-size: 14px !important;font-weight: 400;color:#656565;letter-spacing:0.5px;">
													<?= ModelMaster::monthDateYearTime($kgh["updateDateTime"]) ?>
												</div>
											</div>
										</div>
									</div>
									<div class="col-1 text-end pr-10 pl-0 pt-10 " style="font-weight: 400;">
										<a class="<?= $i == 0 ? 'doubleplay-btn-blue' : 'doubleplay-btn' ?>" id="btn-<?= $kgh['kgiTeamHistoryId'] ?>">
											<img src="<?= Yii::$app->homeUrl ?>images/icons/pim/doubleplay-<?= $i == 0 ? 'white' : 'black' ?>.svg" class="" id="img-<?= $kgh['kgiTeamHistoryId'] ?>">
										</a>

									</div>
								</div>
							</div>
						</div>
						<?php
						$month[$kgh["month"]][$kgh["year"]] = 1;
						if ($i == 0) { ?>

							<script>
								showFirstTeamEmployeeUpdate(<?= $team['teamId'] ?>, <?= $kgiId ?>, '<?= $kgh['month'] ?>', '<?= $kgh['year'] ?>', <?= $kgh['kgiTeamHistoryId'] ?>);
							</script>
			<?php
						}
						$i++;
					}
				endforeach;
			}
			?>
		</div>
		<input type="hidden" id="currentSelect" value="<?= $currentSelect ?>">
	</div>
</div>