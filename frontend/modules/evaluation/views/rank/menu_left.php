<?php

use common\models\ModelMaster;
?>
<div class="border-bottom pb-20">
	<div class="row">
		<div class="col-5  text-center pr-5 pl-5">
			<img src="<?= Yii::$app->homeUrl ?><?= $environmentDetail['picture'] ?>" class="imagealertEvaluator">
		</div>
		<div class="col-7 font-size-14 font-b pr-5 pl-10 pt-0">
			<?= $environmentDetail['companyName'] ?>
		</div>
	</div>
</div>
<div class="col-12 Evaluator-country font-size-12 mt-10">
	&nbsp;&nbsp; <img src="<?= Yii::$app->homeUrl ?><?= $environmentDetail['flag'] ?>" class="imageEvaluatorcountry"> <?= $environmentDetail['city'] ?>, <?= $environmentDetail['countryName'] ?>
</div>
<div class="col-12 mt-20">
	<div class="mb-5 bg-body rounded-1 text-center font-size-12 pt-5 pr-5 pl-5 pb-5 font-weight-500 text-black-50">
		<?= $frameName ?>
		<div class="E3 mt-5"> <?= $terms["termName"] ?> </div>
	</div>
</div>
<div class="col-12 bg-white rounded-1 mt-20 pb-10">
	<div class="col-12 EvaluatorConfiguration pt-20 pl-10 border-bottom pb-20">
		<i class="fa fa-cog mr-5" aria-hidden="true"></i>Set Configuration
	</div>
	<div class="col-12 mt-20">
		<?php
		$selected = 'style="background-color:#D7EBFF;border-left: 5px #B2CCFA solid;"';
		?>
		<div class="rad-label pl-0 mt-10 pr-0" <?= Yii::$app->controller->action->id == 'term-detail' ? $selected : '' ?>>
			<a href="<?= Yii::$app->homeUrl . 'evaluation/environment/term-detail/' . ModelMaster::encodeParams(['termId' => $termId]) ?>" class="no-underline">
				<div class="col-12 pl-5 rad-text pr-3">
					<?php
					if (Yii::$app->controller->action->id == 'term-detail') { ?>
						<i class="fa fa-check-circle-o text-success mr-10 font-size-18" aria-hidden="true"></i>
					<?php
					} else { ?>
						<i class="fa fa-circle mr-10 font-size-18 text-secondary" aria-hidden="true"></i>
					<?php
					}
					?>
					<span class="text-dark font-weight-500 ">Evaluation Frame</span>
				</div>
			</a>
		</div>
		<div class="Evaluationdeshed"></div>
		<?php
		$action = ["weight-allocate", "weight-allocate-setting", "kfi-weight-allocate", "kgi-weight-allocate", "kpi-weight-allocate"];
		?>
		<div class="rad-label pl-0 pr-0 pt-0" <?= in_array(Yii::$app->controller->action->id, $action) ? $selected : '' ?>>
			<a href="<?= Yii::$app->homeUrl . 'evaluation/environment/weight-allocate-setting/' . ModelMaster::encodeParams(['termId' => $termId]) ?>" class="no-underline">
				<div class="col-12 pl-5 rad-text pr-3">
					<?php

					if (in_array(Yii::$app->controller->action->id, $action)) { ?>
						<i class="fa fa-check-circle-o text-success mr-10 font-size-18" aria-hidden="true"></i>
					<?php
					} else { ?>
						<i class="fa fa-circle mr-10 font-size-18 text-secondary" aria-hidden="true"></i>
					<?php
					}
					?>
					<span class="text-dark font-weight-500">Weight Allocation</span>
				</div>
			</a>
		</div>
		<div class="Evaluationdeshed"></div>
		<div class="rad-label pl-0 pr-0" <?= Yii::$app->controller->action->id == 'evaluator-setting' ? $selected : '' ?>>
			<a href="<?= Yii::$app->homeUrl . 'evaluation/environment/evaluator-setting/' . ModelMaster::encodeParams(['termId' => $termId]) ?>" class="no-underline">
				<div class="col-12 pl-5 rad-text pr-3">
					<?php
					if (Yii::$app->controller->action->id == 'evaluator-setting') { ?>
						<i class="fa fa-check-circle-o text-success mr-10 font-size-18" aria-hidden="true"></i>
					<?php
					} else { ?>
						<i class="fa fa-circle mr-10 font-size-18 text-secondary" aria-hidden="true"></i>
					<?php
					}
					?>
					<span class="text-dark font-weight-500">Evaluator Settings</span>
				</div>
			</a>
		</div>
		<div class="Evaluationdeshed"></div>
		<div class="rad-label pl-0 pr-0" <?= Yii::$app->controller->action->id == 'index' ? $selected : '' ?>>
			<a href="<?= Yii::$app->homeUrl . 'evaluation/rank/index/' . ModelMaster::encodeParams(['termId' => $termId]) ?>" class="no-underline">
				<div class="col-12 pl-5 rad-text pr-3">
					<?php
					if (Yii::$app->controller->action->id == 'index') { ?>
						<i class="fa fa-check-circle-o text-success mr-10 font-size-18" aria-hidden="true"></i>
					<?php
					} else { ?>
						<i class="fa fa-circle mr-10 font-size-18 text-secondary" aria-hidden="true"></i>
					<?php
					}
					?>
					<span class="text-dark font-weight-500">Rank & Increasement</span>
				</div>
			</a>
		</div>
		<div class="Evaluationdeshed"></div>
		<div class="rad-label pl-0 pr-0">
			<div class="col-12 pl-5 rad-text pr-3">
				<i class="fa fa-circle mr-10 font-size-18 text-secondary" aria-hidden="true"></i>
				<span class="text-dark font-weight-500">Salary & Allowance Range</span>
			</div>
		</div>
		<div class="Evaluationdeshed"></div>
		<div class="rad-label pl-0 pr-0">
			<div class="col-12 pl-5 rad-text pr-3">
				<i class="fa fa-circle mr-10 font-size-18 text-secondary" aria-hidden="true"></i>
				<span class="text-dark font-weight-500">Bonus calculation</span>
			</div>
		</div>
		<div class="Evaluationdeshed"></div>
		<div class="rad-label pl-0 pr-0">
			<div class="col-12 pl-5 rad-text pr-3">
				<i class="fa fa-circle mr-10 font-size-18 text-secondary" aria-hidden="true"></i>
				<span class="text-dark font-weight-500">Promotion</span>
			</div>
		</div>
	</div>

</div>