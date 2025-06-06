<div class="col-12 ligth-gray-box">
	<div class="row pl-15 pr-20">
		<div class="col-6  sub-tab-active pl-5">
			<?= Yii::t('app', 'Current Assigned Individuals') ?>
		</div>
		<div class="col-6 sub-tab">
		</div>
	</div>
	<div class="col-12 alert  mt-15 pt-0" style="height:500px;overflow-y: auto;">

		<?php

		use frontend\models\hrvc\Team;

		if (isset($kpiDetail) && count($kpiDetail) > 0) {
			foreach ($kpiDetail as $teamId => $employee):
		?>
				<div class="col-12 border-bottom pb-10 pt-10 mb-10" id="team2-<?= $teamId ?>">
					<img src="<?= Yii::$app->homeUrl ?>images/icons/pim/team.svg" class="mr-8 title-team-icon">
					<span class="col-12 font-size-18 text-b " style="font-weight: 600;">
						<?= Team::teamName($teamId) ?>
					</span>
				</div>
				<div class="col-12" id="employee2-<?= $teamId ?>">
					<div class="row">
						<?php

						if (isset($employee) && count($employee) > 0) {
							foreach ($employee as $employeeId => $em):
						?>
								<div class="col-12 mb-15">
									<div class="col-12 small-content-pim bg-white" style="cursor: pointer;">
										<div class="row">
											<div class="col-1 pr-0 pl-0 text-center pt-5">
												<img src="<?= Yii::$app->homeUrl ?><?= $em['picture'] ?>" class="pim-image-AssignMembers">
											</div>
											<div class="col-6">
												<div class="col-12 font-size-16 text-b" style="font-weight: 600;">
													<?= $em['employeeName'] ?>
												</div>
												<div class="col-12" style="font-size: 14px !important;font-weight: 400;color:#656565;">
													<?= $em["title"] == '' ? 'Not set' : $em["title"] ?>
												</div>
											</div>
											<div class="col-5 text-center text-end">
												<div class="col-12 font-size-18 text-b pr-0 text-end">
													<span style="font-size: 18px !important;font-weight: 500;"><?= $em['result'] ?></span>
													<span style="font-size: 18px !important;font-weight: 700;color:#2580D3;"> / <?= $em["target"] ?></span>
												</div>
												<div class="col-12 text-end" style="font-size: 14px !important;font-weight: 400;color:#656565;">
													<?= $em["updateDateTime"] ?>
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
		<?php
			endforeach;
		}
		?>
	</div>
</div>