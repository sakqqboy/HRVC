<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<div class="col-12 ligth-gray-box">
	<div class="row pl-15 pr-20">
		<div class="col-9 pl-0 sub-tab-active">
			<a onclick="javascript:viewTabKgi(0,1)" class="view-back-btn" style="text-decoration: none;cursor:pointer;">
				<img src="<?= Yii::$app->homeUrl ?>images/icons/pim/double-back.svg" style="width:16px;height16px;" class="mr-3">
				<?= Yii::t('app', 'Back') ?>
			</a>
			<img src="<?= Yii::$app->homeUrl ?>images/icons/pim/team.svg" class="ml-5 mr-3 title-team-icon">
			<span class="font-size-16 text-b" style="font-weight: 600;color:black;"><?= $team['teamName'] ?>,</span>
			<span style="font-size: 14px !important;font-weight: 400;color:#656565;">
				<?= $departmentName ?>
			</span>
		</div>
		<div class="col-3 sub-tab text-end pr-0">

		</div>
	</div>
	<div class="col-12 mt-15 pt-0" style="height:400px;overflow-y: auto;">
		<div class="row" style="--bs-gutter-x:0px;">
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

						<div class="col-12 mt-5 small-content-pim pr-0 <?= $i == 0 ? 'selectedTeam' : 'bg-white' ?>"
							style="cursor: pointer;"
							onclick="javascript:showTeamEmployeeUpdate(<?= $team['teamId'] ?>,<?= $kgiId ?>,'<?= $kgh['month'] ?>','<?= $kgh['year'] ?>',<?= $kgh['kgiTeamHistoryId'] ?>)"
							id="historyMonthYear-<?= $kgh['kgiTeamHistoryId'] ?>">
							<div class="row" style="--bs-gutter-x:0px;width:100%;">
								<div class="col-4 align-content-center ">
									<div class="col-12 font-size-14 text-b" style="font-weight: 600;">
										<?= ModelMaster::monthEng($kgh['month'], 1) ?> <?= $kgh['year'] ?>
									</div>
									<div class="col-12 mt-5" style="font-size: 12px !important;font-weight: 400;color:#656565;">
										<?= ModelMaster::engDate($kgh["fromDate"], 2) ?> - <?= ModelMaster::engDate($kgh["toDate"], 2) ?>
									</div>
								</div>
								<div class="col-3  align-content-center pr-20 ">
									<div class="status-tag <?= $colorFormat ?>-tag text-center"><?= Yii::t('app', $statusText) ?> </div>
								</div>
								<div class="col-4 text-center text-end   pr-0 pl-0 align-content-center">
									<div class="d-flex">
										<div class="align-content-center " style="position: absolute;">
											<svg viewBox="0 0 36 36" class="circular-chart-view dark-blue">
												<path class="circle-view-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
												<path class="circle-view" id="KFI-progress-<?= $kgh['year'] ?>-<?= $kgh['month'] ?>" stroke-dasharray="<?= $ratio ?>, 100"
													d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
												<text id="KFI-percentage" x="18" y="20.35" text-anchor="middle"
													dominant-baseline="middle" class="percentage-view">
													<?= $ratio ?>%
												</text>
											</svg>
										</div>
										<div class="flex-grow-1">
											<div class="text-b pr-0 text-end">
												<span style="font-size: 16px !important;font-weight: 500;"><?= ModelMaster::pimNumberFormat($kgh['result']) ?></span>
												<span style="font-size: 16px !important;font-weight: 700;color:#2580D3;"> / <?= ModelMaster::pimNumberFormat($kgh["target"]) ?></span>
											</div>
											<div class="text-end" style="font-size: 12px !important;font-weight: 400;color:#656565;">
												<?= ModelMaster::monthDateYearTime($kgh["updateDateTime"]) ?>
											</div>
										</div>
									</div>
								</div>
								<div class="col-1 align-content-center pr-5" style="font-weight: 400;justify-items: end;">
									<a class="<?= $i == 0 ? 'doubleplay-btn-blue' : 'doubleplay-btn' ?> flex-all-center" id="btn-<?= $kgh['kgiTeamHistoryId'] ?>">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/pim/doubleplay-<?= $i == 0 ? 'white' : 'black' ?>.svg" class="" id="img-<?= $kgh['kgiTeamHistoryId'] ?>" style="width:18px;height:18px;">
									</a>

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