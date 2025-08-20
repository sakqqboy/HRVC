<div class="col-12 ligth-gray-box">
	<div class="row pl-15 pr-20">
		<div class="col-6  sub-tab-active pl-5">
			<?= Yii::t('app', 'Current Assigned Teams') ?>
		</div>
		<div class="col-6 sub-tab text-end pr-0">
			<div class="btn-group" role="group">
				<a id="manCheck">
					<img src="<?= Yii::$app->homeUrl ?>images/icons/pim/man-check.svg"
						style="cursor: pointer;width:28px;height:26px;">
				</a>
				<a id="sunAll">
					<img src="<?= Yii::$app->homeUrl ?>images/icons/pim/reward-blue.svg"
						style="cursor: pointer;width:28px;height:26px;">
				</a>
			</div>
		</div>
	</div>
	<div class="col-12 mt-15 pt-0" style="height:400px;overflow-y: auto;">
		<div class="row">
			<?php
			$allTeam2 = "";
			if (isset($kpiTeams) && count($kpiTeams) > 0) {
				foreach ($kpiTeams as $teamId => $team):
			?>
					<div class="col-12 mb-15">
						<div class="small-content-pim bg-white " style="cursor: pointer;" onclick="javascript:showTeamEmployee2(<?= $teamId ?>)" id="selectTeam2-<?= $teamId ?>">
							<div class="pr-0 pl-0 d-flex align-items-center" style="width: 10%;">
								<img src="<?= Yii::$app->homeUrl ?>images/icons/pim/team.svg" class="" style="width:40px;height:40px;">
								<div class="team-number-tag"><?= $team["totalEmployee"] ?></div>
							</div>
							<div class="pr-5 pl-5 align-content-center" style="width:50%;">
								<div class="font-size-16 text-b" style="font-weight: 600;">
									<?= $team['teamName'] ?>
								</div>
								<div class="pl-0 pr-0 mt-5" style="font-size: 14px !important;font-weight: 400;color:#656565;">
									<?= $team["departmentName"] ?>
								</div>
							</div>
							<div class="align-content-center text-end" style="width: 35%;">
								<div class="font-size-18 text-b pr-0 text-end">
									<span style="font-weight: 500;"><?= $team['result'] ?></span>
									<span style="font-weight: 700;color:#2580D3;"> / <?= $team["target"] ?></span>
								</div>
								<div class="text-end" style="font-size: 12px !important;font-weight: 400;color:#656565;">
									<img src="<?= Yii::$app->homeUrl ?>images/icons/pim/refresh-gray.svg" class="mr-2" style="width:10px;height:10px;"><?= $team["updateDateTime"] ?>
								</div>
							</div>
							<div class="align-content-center pr-0" style="font-weight: 400;width:9%;justify-items: end;">
								<a href="javascript:void(0);" onclick="event.stopPropagation(); kpiTeamHistoryView(<?= $kpiId ?>, <?= $teamId ?>)" class="doubleplay-btn flex-all-center">
									<img src="<?= Yii::$app->homeUrl ?>images/icons/pim/doubleplay-black.svg" style="width:18px;height:18px;">
								</a>

							</div>
						</div>
					</div>
		</div>
<?php
					$allTeam2 .= $teamId . ',';
				endforeach;
			}
?>
	</div>
</div>
</div>
<input type="hidden" id="currentTeam2" value="all">
<input type="hidden" id="allTeam2" value="<?= $allTeam2 ?>">
<script>
	$(document).ready(function() {
		$('#manCheck').on('click', function() {
			$('#man-check').show();
			$('#all').css("display", 'none');
			$('#kpi-employee').show();
			$('#employee-all').css("display", 'none');
			$("#viewType").val('grid');
		});
		$('#sumAll').on('click', function() {
			$('#man-check').css("display", 'none');
			$('#all').show();
			$('#employee-all').show();
			$('#kpi-employee').css("display", 'none');
			$("#viewType").val('list');
		});
	});
</script>