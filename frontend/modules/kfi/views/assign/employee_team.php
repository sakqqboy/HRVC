<?php
if (isset($kfiTeamEmployee) && count($kfiTeamEmployee) > 0) {
	foreach ($kfiTeamEmployee as $teamId => $kfiEmployee):
		if (isset($kfiEmployee["team"])) {
			//throw new Exception(print_r($kfiEmployee["team"], true));
?>
			<div class="col-12 bg-header-assign pb-0 pt-0 pr-8 mt-10" id="team-employee-<?= $teamId ?>">
				<div class="row">
					<div class="col-5 font-size-12 pt-5 pb-3">
						<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-black.png" style="width:15px;margin-top:-3px;" class="ml-5 mr-5">
						<b><?= $kfiEmployee["team"]["teamName"] ?>, </b><span class="col-12 font-size-10">
							<?= $kfiEmployee["team"]["departmentName"] ?></span>
					</div>
					<!-- <div class="col-2 font-size-12 pt-5 pb-3">
					</div>
					<div class="col-3 font-size-12 pt-5 pb-3 text-center"> -->
					<!-- <b><span id="total-team-target-<?php //$teamId 
											?>"><?php // number_format($kfiEmployee["team"]["totalTeamTarget"], 2) 
												?></span></b>
						<?php
						//if ($kfiEmployee["team"]["isMore"] == '1') {
						?>
							<img src="<?php // Yii::$app->homeUrl 
									?>images/icons/Settings/arrow-up.png" style="width:8px;margin-top:-3px;" class="ml-5">
						<?php
						//}
						//if ($kfiEmployee["team"]["isMore"] == '0') {
						?>
							<img src="<?php // Yii::$app->homeUrl 
									?>images/icons/Settings/arrow-down.png" style="width:8px;margin-top:-3px;" class="ml-5">
						<?php
						//}
						?>
						<span class="font-size-10"><?php // number_format($kfiEmployee["team"]["percentage"]) 
										?> %</span> -->
					<!-- </div> -->
					<div class="col-7 font-size-12 pt-5 pb-3 text-center">

						<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/blue-down.png" style="width:15px;margin-top:0px;float:right;cursor:pointer;" class="ml-5" onclick="javascript:showEmployeeTeamTarget(<?= $teamId ?>)" id="show-<?= $teamId ?>">
						<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/blue-up.png" style="width:15px;margin-top:0px;float:right;display:none;cursor:pointer;" class="ml-5" onclick="javascript:hideEmployeeTeamTarget(<?= $teamId ?>)" id="hide-<?= $teamId ?>">
					</div>
				</div>
			</div>
		<?php
		}
		?>
		<div class="col-12 pr-0 pl-0" id="employee-in-team-<?= $teamId ?>" style="display:none;">
			<?php
			if (isset($kfiEmployee["employee"]) && count($kfiEmployee["employee"]) > 0) {
				foreach ($kfiEmployee["employee"] as $employeeId => $employee):
			?>
					<div class="col-12 bg-white border-bottom">
						<div class="row">
							<div class="col-5 font-size-12 pt-5">
								<div class="row">
									<div class="col-2 text-center pr-0 pl-0 pt-10">
										<input type="checkbox" class="from-check ml-10" <?= $employee["checked"] ?> name="employee[<?= $employeeId ?>]">
									</div>
									<div class="col-2 pr-5 pl-0 text-center">
										<img src="<?= Yii::$app->homeUrl ?><?= $employee["picture"] ?>" class="employee-pic-circle">
									</div>
									<div class="col-8 pl-5 pt-5">
										<span class="font-size-12"><b><?= $employee["employeeFirstname"] ?> <?= $employee["employeeSurename"] ?></b></span>
									</div>
								</div>
							</div>
							<div class="col-5 font-size-12 text-start pt-5">
								<?= $employee["titleName"] ?>
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