<?php

use common\models\ModelMaster;

?>
<div class="silly_evaluator mb-20" id="kfi">
	<div class="row pl-15 pr-15 pt-10">
		<div class="col-7 flagkey">
			<div class="row">
				<div class="col-7">
					<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/KPI.png" class="icons-KGI2"> Key Financial Indicator
				</div>
				<div class="col-5">
					<a href="<?= Yii::$app->homeUrl ?>evaluation/environment/kfi-weight-allocate/<?= ModelMaster::encodeParams(['termId' => $termId, "employeeId" => $employeeId]) ?>" class="font-size-10 btn btn-primary mr-10 ml-10 pt-3 pb-3 pr-5 pl-5">
						<i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>
						ADD
					</a>
				</div>
			</div>
		</div>
		<div class="col-5 text-end">
			<span class="flagkey mr-10">
				Participants
			</span>
			<span class="badge rounded-pill bg-gray pt-2 pb-2">
				<ul class="try-cricle">
					<?php
					if (isset($kfiEmployee) && count($kfiEmployee) > 0) {
						$i = 1;
						foreach ($kfiEmployee as  $em) :
							if ($i <= 3) {
					?>
								<li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?><?= $em['picture'] ?>" class="image-avatar<?= $i ?>"></li>
					<?php
							} else {
								break;
							}
							$i++;
						endforeach;
					}
					?>
					<a href="" class="none">
						<li class="number_user"> <?= count($kfiEmployee) ?> </li>
					</a>
				</ul>
			</span>
		</div>
		<hr class="mt-5 mb-0">
	</div>
	<div class="row pl-15 pr-15 pb-20 mt-5 pt-0" id="kfi-eva">
		<?php
		if (isset($masterKfi) && count($masterKfi) > 0) {
			foreach ($masterKfi as $kfi) :
		?>
				<div class="col-2">
					<div class="card font-size-12 mt-5 mb-5 pt-0 pr-0 pl-0" style="border-color:#E2E2E2;">
						<div class="fonTotal text-center  pt-3 pb-3"><?= number_format($kfi["target"]) ?></div>
						<div class="col-12 text-center ">
							<span class="badge bg-lighttotal">
								<?= number_format($kfi["target"] / 1000) ?>k
							</span>
						</div>
						<div class="col-12 text-center pt-5 pb-5 Blueformat">
							<?= number_format($kfi["weight"]) ?>%
						</div>
					</div>
				</div>
			<?php
			endforeach;
		} else { ?>
			<div class="col-12 text-center font-size-13 mt-10">
				Please click "ADD" to set KFI
			</div>
		<?php
		}
		?>
	</div>
</div>
<div class="silly_evaluator mb-20" id="kgi">
	<div class="row pl-15 pr-15 pt-10">
		<div class="col-7 flagkey">
			<div class="row">
				<div class="col-7">
					<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/KGI.png" class="icons-KGI2"> Key Goal Indicator
				</div>
				<div class="col-5">
					<a href="<?= Yii::$app->homeUrl ?>evaluation/environment/kgi-weight-allocate/<?= ModelMaster::encodeParams(['termId' => $termId, "employeeId" => $employeeId]) ?>" class="font-size-10 btn btn-primary mr-10 ml-10 pt-3 pb-3 pr-5 pl-5">
						<i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>
						ADD
					</a>
				</div>
			</div>
		</div>
		<div class="col-5 text-end">
			<span class="flagkey mr-10 ">
				Participants
			</span>
			<span class="badge rounded-pill bg-gray pt-2 pb-2">
				<ul class="try-cricle">
					<?php
					if (isset($kgiEmployee) && count($kgiEmployee) > 0) {
						$i = 1;
						foreach ($kgiEmployee as $em) :
							if ($i <= 3) {
					?>
								<li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?><?= $em['picture'] ?>" class="image-avatar<?= $i ?>"></li>
					<?php
							} else {
								break;
							}
							$i++;
						endforeach;
					}
					?>
					<a href="" class="">
						<li class="number_user"> <?= count($kgiEmployee) ?> </li>
					</a>
				</ul>
			</span>
		</div>
		<hr class="mt-5 mb-0">
	</div>
	<div class="row pl-15 pr-15 pb-20 mt-5 pt-0" id="kgi-eva">
		<?php
		if (isset($masterKgi) && count($masterKgi) > 0) {
		?>
			<div class="row">
				<div class="col-6 pb-5 text-start font-size-12 font-weight-500 mb-10 border-bottom">
					Team KGI
				</div>
			</div>
			<?php
			foreach ($masterKgi as $kgi) :
			?>
				<div class="col-2">
					<div class="card font-size-12 mt-5 mb-5 pt-0 pr-0 pl-0" style="border-color:#E2E2E2;">
						<div class="fonTotal text-center  pt-3 pb-3"><?= $kgi["kgiName"] ?></div>
						<div class="col-12 text-center ">
							<span class="badge bg-lighttotal">
								<?= number_format($kgi["target"] / 1000) ?>k
							</span>
						</div>
						<div class="col-12 text-center pt-5 pb-5 Blueformat">
							<?= number_format($kgi["weight"]) ?>%
						</div>
					</div>
				</div>
			<?php
			endforeach;
		}
		if (isset($masterKgiEmployee) && count($masterKgiEmployee) > 0) {
			?>
			<div class="row">
				<div class="col-6 pb-5 text-start font-size-12 font-weight-500 mb-10 border-bottom">
					Individual KGI
				</div>
			</div>
			<?php
			foreach ($masterKgiEmployee as $kgi) :
			?>
				<div class="col-2">
					<div class="card font-size-12 mt-5 mb-5 pt-0 pr-0 pl-0" style="border-color:#E2E2E2;">
						<div class="fonTotal text-center  pt-3 pb-3"><?= $kgi["kgiName"] ?></div>
						<div class="col-12 text-center ">
							<span class="badge bg-lighttotal">
								<?= number_format($kgi["target"] / 1000) ?>k
							</span>
						</div>
						<div class="col-12 text-center pt-5 pb-5 Blueformat">
							<?= number_format($kgi["weight"]) ?>%
						</div>
					</div>
				</div>
			<?php
			endforeach;
		}
		if (isset($masterKgi) && count($masterKgi) == 0 && isset($masterKgiEmployee) && count($masterKgiEmployee) == 0) { ?>
			<div class="col-12 text-center font-size-13 mt-10">
				Please click "ADD" to set KGI
			</div>
		<?php
		}
		?>
	</div>
</div>
<div class="silly_evaluator mb-20" id="kpi">
	<div class="row pl-15 pr-15 pt-10">
		<div class="col-7 flagkey">
			<div class="row">
				<div class="col-7">
					<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/KPI.png" class="icons-KGI2"> Key Performance Indicator
				</div>
				<div class="col-5">
					<a href="<?= Yii::$app->homeUrl ?>evaluation/environment/kpi-weight-allocate/<?= ModelMaster::encodeParams(['termId' => $termId, "employeeId" => $employeeId]) ?>" class="font-size-10 btn btn-primary mr-10 ml-10 pt-3 pb-3 pr-5 pl-5">
						<i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>
						ADD
					</a>
				</div>
			</div>
		</div>
		<div class="col-5 text-end">
			<span class="flagkey mr-10 ">
				Participants
			</span>
			<span class="badge rounded-pill bg-gray pt-2 pb-2">
				<ul class="try-cricle">
					<?php
					if (isset($kpiEmployee) && count($kpiEmployee) > 0) {
						$i = 1;
						foreach ($kpiEmployee as  $em) :
							if ($i <= 3) {
					?>
								<li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?><?= $em['picture'] ?>" class="image-avatar<?= $i ?>"></li>
					<?php
							} else {
								break;
							}
							$i++;
						endforeach;
					}
					?>
					<a href="" class="none">
						<li class="number_user"> <?= count($kpiEmployee) ?> </li>
					</a>
				</ul>
			</span>
		</div>
		<hr class="mt-5 mb-0">
	</div>
	<div class="row pl-15 pr-15 pb-20 mt-5 pt-0" id="kpi-eva">
		<?php
		if (isset($masterKpiTeam) && count($masterKpiTeam) > 0) {
		?>
			<div class="row">
				<div class="col-6 pb-5 text-start font-size-12 font-weight-500 mb-10 border-bottom">
					Team KPI
				</div>
			</div>
			<?php
			foreach ($masterKpiTeam as $kpi) :
			?>
				<div class="col-2">
					<div class="card font-size-12 mt-5 mb-5 pt-0 pr-0 pl-0" style="border-color:#E2E2E2;">
						<div class="fonTotal text-center  pt-3 pb-3"><?= $kpi["kpiName"] ?></div>
						<div class="col-12 text-center ">
							<span class="badge bg-lighttotal">
								<?= number_format($kpi["target"] / 1000) ?>k
							</span>
						</div>
						<div class="col-12 text-center pt-5 pb-5 Blueformat">
							<?= number_format($kpi["weight"]) ?>%
						</div>
					</div>
				</div>
			<?php
			endforeach;
		}
		if (isset($masterKpi) && count($masterKpi) > 0) {
			?>
			<div class="row">
				<div class="col-6 pb-5 text-start font-size-12 font-weight-500 mb-10 border-bottom">
					Individual KPI
				</div>
			</div>
			<?php
			foreach ($masterKpi as $kpi) :
			?>
				<div class="col-2">
					<div class="card font-size-12 mt-5 mb-5 pt-0 pr-0 pl-0" style="border-color:#E2E2E2;">
						<div class="fonTotal text-center  pt-3 pb-3"><?= $kpi["kpiName"] ?></div>
						<div class="col-12 text-center ">
							<span class="badge bg-lighttotal">
								<?= number_format($kpi["target"] / 1000) ?>k
							</span>
						</div>
						<div class="col-12 text-center pt-5 pb-5 Blueformat">
							<?= number_format($kpi["weight"]) ?>%
						</div>
					</div>
				</div>
			<?php
			endforeach;
		}
		if (isset($masterKpi) && count($masterKpi) == 0 && isset($masterKpiTeam) && count($masterKpiTeam) == 00) { ?>
			<div class="col-12 text-center font-size-13 mt-10">
				Please click "ADD" to set KPI
			</div>
		<?php
		}
		?>
		<!-- <div class="col-12" style="position: static;">
										<div class="col-12 holder"></div>
									</div> -->
	</div>

</div>