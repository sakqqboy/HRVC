<?php

use common\models\ModelMaster;
use frontend\models\hrvc\KgiTeamHistory;
use frontend\models\hrvc\KpiTeamHistory;

if (isset($kpiTeamHistory) && count($kpiTeamHistory) > 0) { ?>
	<div class="row border-bottom pb-10 mb-10 font-b">
		<div class="col-2 text-center"><?= Yii::t('app', 'Target') ?></div>
		<div class="col-2 text-center"><?= Yii::t('app', 'Result') ?></div>
		<div class="col-1"><?= Yii::t('app', 'Ratio') ?></div>
		<div class="col-1 text-center"><?= Yii::t('app', 'Month') ?></div>
		<div class="col-2 text-center"><?= Yii::t('app', 'Update') ?></div>
		<div class="col-2 "><?= Yii::t('app', 'Updater') ?></div>
		<div class="col-2"><?= Yii::t('app', 'Status') ?></div>
	</div>
	<?php
	foreach ($kpiTeamHistory as $history) :
		$statusText = KgiTeamHistory::statusText($history["status"]);
		if ($history["status"] == 2) {
			$class = '';
			$isFinish = KpiTeamHistory::checkFinished($history["kpiTeamHistoryId"], $history["kpiTeamId"]);
			if ($isFinish == 1) {
				$class = "text-success";
			} else {
				$class = '';
			}
		} else {
			$class = '';
		}

	?>
		<div class="row pt-10 border-bottom pb-5 font-size-12 <?= $class ?>">
			<div class="col-2 text-end">
				<?php
				if ($history["target"] != null) {
					$decimal = explode('.', $history["target"]);
					if (isset($decimal[1])) {
						if ($decimal[1] == '00') {
							$show = number_format($decimal[0]);
						} else {
							$show = number_format($history["target"], 2);
						}
					} else {
						$show = number_format($history["target"]);
					}
				} else {
					$show = '-';
				}
				?>
				<?= $show ?>
			</div>
			<div class="col-2 text-end">
				<?php
				if ($history["result"] != null) {
					$decimal = explode('.', $history["result"]);
					if (isset($decimal[1])) {
						if ($decimal[1] == '00') {
							$show = number_format($decimal[0]);
						} else {
							$show = number_format($history["result"], 2);
						}
					} else {
						$show = number_format($history["result"]);
					}
				} else {
					$show = '-';
				}
				?>
				<?= $show ?>
			</div>
			<div class="col-1 text-end">

				<?php
				$ratio = '-';
				if ($history["target"] != '' && $history["target"] != 0) {
					if ($history["code"] == '<' || $history["code"] == '=') {
						$ratio = ($history["result"] / $history["target"]) * 100;
					} else {
						if ($history["result"] != '' && $history["result"] != 0) {
							$ratio = ($history["target"] / $history["result"]) * 100;
						} else {
							$ratio = 0;
						}
					}
				} else {
					$ratio = '-';
				}
				if ((float)$ratio >= 0 && (is_numeric($ratio))) {
					$decimal = explode('.', $ratio);
					if (isset($decimal[1]) && $decimal[1] != '00') {
						$ratio = number_format($ratio, 2);
					} else {
						$ratio = number_format($ratio);
					}
				}
				?>
				<?= $ratio  ?><?= $ratio != '-' ? '%' : '' ?>
			</div>
			<div class="col-1 text-center"><?= Yii::t('app', ModelMaster::monthEng($history["month"], 2)) ?></div>
			<div class="col-2 text-center"><?= ModelMaster::dateNumberShort($history["createDateTime"]) ?></div>
			<div class="col-2"><?= $history["employeeFirstname"] ?> <?= $history["employeeSurename"] ?></div>
			<div class="col-2 <?= $class == '' ? '' : 'font-b' ?>"><?= Yii::t('app', $statusText) ?></div>
		</div>
	<?php
	endforeach;
	?>
<?php
} else {
?>
	<div class="col-12 mt-20 font-size-16 text-center"><?= Yii::t('app', 'Not update yet') ?>.</div>
<?php
}
