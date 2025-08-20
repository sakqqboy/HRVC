<div class="col-12 ligth-gray-box">
	<div class="row pl-15 pr-20">
		<div class="col-6  sub-tab-active pl-5">
			<?= Yii::t('app', 'Current Assigned Individuals') ?>
		</div>
		<div class="col-6 sub-tab">
		</div>
	</div>
	<div class="col-12  mt-15 pt-0" style="min-height:400px;overflow-y: auto;">

		<?php

		use frontend\models\hrvc\Team;

		if (isset($kgiDetail) && count($kgiDetail) > 0) {
			foreach ($kgiDetail as $teamId => $employee):
		?>
				<div class="col-12 border-bottom mb-5 pb-5 d-flex align-items-center" id="team1-<?= $teamId ?>">
					<img src="<?= Yii::$app->homeUrl ?>images/icons/pim/team.svg" class="title-team-icon mr-5">
					<span class="col-12 font-size-16 text-b " style="font-weight: 600;">
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
									<div class="small-content-pim bg-white" style="cursor: pointer;">
										<div class="row" style="--bs-gutter-x:0px;width:100%;">
											<div class="col-1 pr-0 pl-0 text-center align-content-center">
												<img src="<?= Yii::$app->homeUrl ?><?= $em['picture'] ?>" class="pim-image-AssignMembers">
											</div>
											<div class="col-5 pl-5 align-content-center">
												<div class="col-12 font-size-16 text-b text-truncate" style="font-weight: 600;">
													<?= $em['employeeName'] ?>
												</div>
												<div class="col-12" style="font-size: 14px !important;font-weight: 400;color:#656565;">
													<?= $em["title"] == '' ? 'Not set' : $em["title"] ?>
												</div>
											</div>
											<div class="col-6 text-end align-content-center pr-10">
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