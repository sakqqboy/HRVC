<?php
if (isset($kpiTeamEmployee) && count($kpiTeamEmployee) > 0) {
	foreach ($kpiTeamEmployee as $teamId => $kpiEmployee):
		if (isset($kpiEmployee["team"])) {
			//throw new Exception(print_r($kpiEmployee["team"], true));
?>
			<div class="col-12 bg-header-assign pb-0 pt-0 pr-8 mt-10" id="team-employee-<?= $teamId ?>">
				<div class="row">
					<div class="col-5 font-size-12 pt-5 pb-3">
						<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-black.png" style="width:15px;margin-top:-3px;" class="ml-5 mr-5">
						<b><?= $kpiEmployee["team"]["teamName"] ?>, </b><span class="col-12 font-size-10"><?= $kpiEmployee["team"]["departmentName"] ?></span>
					</div>
					<div class="col-3 font-size-12 pt-5 pb-3 text-center">
						<b><span id="total-team-target-<?= $teamId ?>"><?= number_format($kpiEmployee["team"]["totalTeamTarget"], 2) ?></span></b>
						<?php
						if ($kpiEmployee["team"]["isMore"] == '1') {
						?>
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/arrow-up.png" style="width:8px;margin-top:-3px;" class="ml-5">
						<?php
						}
						if ($kpiEmployee["team"]["isMore"] == '0') {
						?>
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/arrow-down.png" style="width:8px;margin-top:-3px;" class="ml-5">
						<?php
						}
						?>
						<span class="font-size-10"><?= number_format($kpiEmployee["team"]["percentage"]) ?> %</span>
					</div>
					<div class="col-4 font-size-12 pt-5 pb-3 text-center">
						<div class="form-check form-switch">
							<input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" checked>
							<label class="label-switch" for="flexSwitchCheckDefault">Set Remark For All</label>
						</div>
						<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/blue-down.png" style="width:15px;margin-top:-22px;float:right;cursor:pointer;" class="ml-5" onclick="javascript:showEmployeeTeamTarget(<?= $teamId ?>)" id="show-<?= $teamId ?>">
						<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/blue-up.png" style="width:15px;margin-top:-22px;float:right;display:none;cursor:pointer;" class="ml-5" onclick="javascript:hideEmployeeTeamTarget(<?= $teamId ?>)" id="hide-<?= $teamId ?>">
					</div>
				</div>
			</div>
		<?php
		}
		?>
		<div class="col-12 pr-0 pl-0" id="employee-in-team-<?= $teamId ?>" style="display:none;">
			<?php
			if (isset($kpiEmployee["employee"]) && count($kpiEmployee["employee"]) > 0) {
				foreach ($kpiEmployee["employee"] as $employeeId => $employee):
			?>
					<div class="col-12 bg-white border-bottom">
						<div class="row">
							<div class="col-5 font-size-12 pt-5">
								<div class="row">
									<div class="col-2 text-center pr-0 pl-0 pt-10">
										<input type="checkbox" class="from-check ml-10" <?= $employee["checked"] ?>>
									</div>
									<div class="col-2 pr-5 pl-0 text-center">
										<img src="<?= Yii::$app->homeUrl ?><?= $employee["picture"] ?>" class="employee-pic-circle">
									</div>
									<div class="col-8 pl-5 pt-5">
										<span class="font-size-12"><b><?= $employee["employeeFirstname"] ?> <?= $employee["employeeSurename"] ?></b></span>
									</div>
								</div>
							</div>
							<div class="col-3 font-size-12 text-center pt-5">
								<input type="text" class="assign-target text-end" name="employeeTarget[<?= $employeeId ?>]" placeholder="0.00" style="height: 30px;" value="<?= $employee['target'] > 0 ? number_format($employee['target'], 2) : '' ?>" id="employee-target-<?= $teamId ?>" onkeyup="javascript:calculateEmployeeTargetValue(<?= $teamId ?>)">
							</div>
							<div class="col-4 font-size-12 text-center pt-5">
								<textarea type="text" class="assign-target" name="employeeRemark[<?= $employeeId ?>]" style="height: 30px;"></textarea>
							</div>
						</div>
					</div>
			<?php
				endforeach;
			}
			?>
		</div>
<?php
	endforeach;
}
?>