<?php

use common\models\ModelMaster;
use Faker\Core\Number;
use Faker\Extension\NumberExtension;

$this->title = 'Individual';
?>

<div class="col-12 mt-70 environment pt-10 pr-10 pl-10">
	<div class="row">
		<div class="col-lg-3 col-md-12 col-12">
			<div class="col-12 individual_step1">
				<div class="row mt-30">
					<div class="col-lg-3 col-md-4 col-3 pr-5 pl-15">
						<img src="<?= Yii::$app->homeUrl ?><?= $employee['picture'] ?>" class="individual_userlogin">
					</div>
					<div class="col-lg-9 col-md-8 col-9 pr-0 pl-0">
						<div class="Individual_step2_name">
							<?= $employee["employeeFirstname"] ?> <?= $employee["employeeSurename"] ?>
						</div>
						<div class="Individual_step3_company mt-3">
							<?= $employee["companyName"] ?>
						</div>
						<div class="Individual_step4_country">
							<img src="<?= Yii::$app->homeUrl ?>images/flag/thailand.png" class="imageEvaluatorcountry">
							<span class="mt-2 ml-5" style="position:absolute;">
								<?= $employee["city"] ?>, <?= $employee["countryName"] ?>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-7 col-md-12 col-12">
			<div class="individual_step2">
				<div class="row">
					<div class="col-lg-2 col-md-6 col-3">
						<div class="individual_stepkey col-6 text-center"><?= $terms["termName"] ?></div>
						<div class="individual_stepkey_number col-6 text-center">2024</div>
					</div>
					<div class="col-lg-8 col-md-6 col-6 performance_individual text-center">
						<?= $frameName ?>
					</div>
					<div class="col-lg-2 col-md-6 col-3 font-size-13 text-primary text-end pt-5">
						Inprocess
					</div>
				</div>
				<hr style="margin-top: 10px;">
				<div class="row" style="margin-top: -10px;">
					<div class="col-lg-3 col-md-6 col-6 individual_solidkey">
						<div class="col-12">
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Charts.png" class="imageindividual_Charts"> <span class="individual_Financial">Key Financial Indicator</span>
						</div>
						<?php
						if (isset($employeePim["kfiWeight"])) {
						?>
							<div class="col-12 mt-5">
								<div role="progressbar_step_Blue" aria-valuenow="<?= $employeePim["kfiWeight"] ?>" aria-valuemin="0" aria-valuemax="100" style="--value:<?= (int)$employeePim["kfiWeight"] ?>"></div>
							</div>
						<?php
						} else {
							echo '<span class="font-size-12 text-secondary">Not set yet</span>';
						}
						?>
					</div>
					<div class="col-lg-3 col-md-6 col-6 individual_solidkey">
						<div class="col-12">
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/KGI.png" class="imageindividual_Charts"> <span class="individual_Financial">Key Goal Indicator</span>
						</div>
						<?php
						if (isset($employeePim["kgiWeight"])) {
						?>
							<div class="col-12 mt-5">
								<div role="progressbar_step_warning" aria-valuenow="<?= $employeePim["kpiWeight"] ?>" aria-valuemin="0" aria-valuemax="100" style="--value:<?= (int)$employeePim["kgiWeight"] ?>"></div>
							</div>
						<?php
						} else {
							echo '<span class="font-size-12 text-secondary">Not set yet</span>';
						}
						?>
					</div>
					<div class="col-lg-3 col-md-6 col-6 individual_solidkey">
						<div class="col-12">
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/KPI.png" class="imageindividual_Charts"> <span class="individual_Financial">Key Performance Indicator</span>
						</div>
						<?php
						if (isset($employeePim["kpiWeight"])) {
						?>
							<div class="col-12 mt-5">
								<div role="progressbar_step_danger" aria-valuenow="<?= $employeePim["kpiWeight"] ?>" aria-valuemin="0" aria-valuemax="100" style="--value:<?= (int)$employeePim["kpiWeight"] ?>"></div>
							</div>
						<?php
						} else {
							echo '<span class="font-size-12 text-secondary">Not set yet</span>';
						}
						?>
					</div>
					<div class="col-lg-3 col-md-6 col-6">
						<div class="col-12">
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Achievementstar.png" class="imageindividual_Charts"> <span class="individual_Financial">Total Achievement</span>
						</div>
						<div class="col-12 mt-5">
							<div class="row">
								<div class="col-5">
									<div role="progressbar_step_Blue" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100" style="--value:12"></div>
								</div>
								<div class="col-7 mt-10">
									<div class="col-12">
										<span class="individual_weight"><?= number_format(59) ?></span>/<?= number_format(100) ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-2 col-md-12 col-12">
			<div class="col-12 individual_step3_hraf">
				<div class="col-12 individual_primary">
					Primary Evaluator
				</div>
				<div class="col-12 mt-5">
					<?php
					if ($evaluator["primaryName"] != "") {
					?>
						<img src="<?= Yii::$app->homeUrl ?><?= $evaluator['primaryPic'] ?>" class="imagesstep_userlog">
						<span class="trants_individual_firstname">
							<?= $evaluator["primaryName"] ?>
						</span>
					<?php
					} else { ?>
						<span class="trants_individual_firstname">Not set</span>

					<?php

					}
					?>


				</div>
				<div class="col-12 individual_primary">
					Final Evaluator
				</div>
				<div class="col-12 mt-5">
					<?php
					if ($evaluator["primaryName"] != "") {
					?>
						<img src="<?= Yii::$app->homeUrl ?><?= $evaluator['finalPic'] ?>" class="imagesstep_userlog">
						<span class="trants_individual_firstname">
							<?= $evaluator["finalName"] ?>
						</span>
					<?php
					} else { ?>
						<span class="trants_individual_firstname">Not set</span>

					<?php

					}
					?>

				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-md-12 col-sm-6 col-12">
			<div class="col-12 individual_Mypanel">
				<div class="row">
					<div class="col-lg-3 col-md-6 col-3 My_panel">
						My Panel
					</div>
					<div class="col-lg-9 col-md-6 col-9 Panel-radio">
						<div class="row">
							<div class="col-4">
								<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Ellipseorange.png" class="imagesEllipse">
								<span class="font-onorange"> ON GOING (Pending)</span>
							</div>
							<div class="col-5">
								<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Ellipseblue.png" class="imagesEllipse">
								<span class="font-onorange"> Waiting For Mid Approval </span>
							</div>
							<div class="col-3">
								<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Ellipsegreen.png" class="imagesEllipse">
								<span class="font-onorange"> Completed</span>&nbsp;
								<i class="fa fa-info text-primary"></i>
							</div>
						</div>
					</div>
				</div>
				<hr>


				<!-- <div class="tb_mypanel mt-20">
					<div class="row">
						<div class="col-1">
							<div class="tb_mypanel_e4">
								<div class="E41_weight">E4</div>
								<div class="E42_weight">2023</div>
							</div>
						</div>
						<div class="col-3">
							<div class="spring">Spring Evaluation Ban</div>
						</div>
						<div class="col-3">
							<div class="font-size-11">Mid</div>
							<img src="<?php // Yii::$app->homeUrl 
									?>images/icons/Dark/48px/Ellipseorange.png" class="imagesEllipse"><span class="font-size-10"> ON GOING</span>
						</div>
						<div class="col-3">
							<div class="font-size-11">Final Evaluation</div>
							<img src="<?php //Yii::$app->homeUrl 
									?>images/icons/Dark/48px/Ellipseblue.png" class="imagesEllipse"><span class="font-size-10"> Waiting</span>
						</div>
						<div class="col-1">
							<button type="submit" class="btn_My_panel_New">New</button>
						</div>
						<div class="col-1">
							<img src="<?php // Yii::$app->homeUrl 
									?>images/icons/Dark/48px/sendgry.png" class="sendcompleted1">
						</div>
					</div>
				</div> -->



				<?php
				if (isset($allCurrentTerm) && count($allCurrentTerm) > 0) {
					foreach ($allCurrentTerm as $termId => $term) :
				?>
						<div class="tb_mypanel_blue mt-10">
							<div class="row">
								<div class="col-1">
									<div class="tb_mypanel_e4">
										<div class="E41_weight"><?= $term["termName"] ?></div>
										<div class="E42_weight">2023</div>
									</div>
								</div>
								<div class="col-3">
									<div class="spring"><?= $term["frameName"] ?></div>
								</div>
								<div class="col-3">
									<div class="font-size-11">Mid</div>
									<span class="font-size-10"> ON GOING</span>
								</div>
								<div class="col-3">
									<div class="font-size-11">Final Evaluation</div>
									<span class="font-size-10"> Waiting</span>
								</div>
								<!-- <div class="col-1">
								<button type="submit" class="btn_My_panel_New">New</button>
							</div> -->
								<div class="col-2 text-end pr-15">
									<a href="<?= Yii::$app->homeUrl ?>evaluation/eva/evaluate/<?= ModelMaster::encodeParams([
																			'termId' => $termId,
																			'employeeId' => $term['employeeId']
																		]) ?>">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/sendgry.png" class="sendcompleted1">
									</a>
								</div>
							</div>
						</div>
				<?php
					endforeach;
				}
				?>

				<div class="row mt-10">
					<div class="col-7 text-end">
						<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/mouse.png" class="mouse1e">
					</div>
					<div class="col-5 text-end">
						<a href="" class="fontSeeAll"> See All</a>
					</div>
				</div>

			</div>
		</div>
		<div class="col-lg-6 col-md-12 col-12">
			<div class="col-12 individual_Mypanel">
				<div class="col-12 My_panel">
					Subordinate Panel
				</div>
				<hr>
				<?php
				if (isset($subordinateTerm) && count($subordinateTerm) > 0) {
					foreach ($subordinateTerm as $employeeId => $eva) :
				?>
						<div class="tb_mypanel_none mt-10">
							<div class="row">
								<div class="col-1">
									<div class="tb_mypanel_e4">
										<div class="E41_weight"><?= $eva["termName"] ?></div>
										<div class="E42_weight">2023</div>
									</div>
								</div>
								<div class="col-5 pl-15">
									<div class="row">
										<div class="col-3 text-end">
											<img src="<?= Yii::$app->homeUrl ?><?= $eva['picture'] ?>" class="IMG">
										</div>
										<div class="col-9 pt-5">
											<div class="name_social"><?= $eva["employeeName"] ?></div>
											<div class="position_name"><?= $eva["title"] ?>, <?= $eva["department"] ?></div>
										</div>
									</div>
								</div>
								<div class="col-4">
									<?php
									if ($eva["isPrimary"] == 1 && $eva["isFinal"] == 1) {
										$text = "Primary/Final Evaluation";
									}
									if ($eva["isPrimary"] == 1 && $eva["isFinal"] == 0) {
										$text = "Primary Evaluation";
									}
									if ($eva["isPrimary"] == 0 && $eva["isFinal"] == 1) {
										$text = "Final Evaluation";
									}
									?>
									<div class="font-size-11"><?= $text ?></div>
									<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Ellipsegreen.png"> <span class="completed_textgreen">Completed</span>
								</div>
								<div class="col-2 text-end pr-18">
									<a href="<?= Yii::$app->homeUrl ?>evaluation/eva/evaluate/<?= ModelMaster::encodeParams([
																			'termId' => $eva['termId'],
																			'employeeId' => $employeeId
																		]) ?>">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/sendgry.png" class="sendcompleted2">
									</a>
								</div>
							</div>
						</div>

				<?php
					endforeach;
				}
				?>
				<div class="row mt-10">
					<div class="col-7 text-end">
						<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/mouse.png" class="mouse1e">
					</div>
					<div class="col-5 text-end">
						<a href="" class="fontSeeAll"> See All</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>