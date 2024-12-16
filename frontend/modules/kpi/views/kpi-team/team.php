<?php

use frontend\models\hrvc\Department;
use frontend\models\hrvc\KpiTeam;

?>
<div class="row mb-10">
	<div class="col-6 font-b"><?= Yii::t('app', 'Team') ?></div>
	<div class="col-6 font-b"><?= Yii::t('app', 'Department') ?></div>
</div>
<?php


if (isset($teams) && count($teams) > 0) { ?>
	<div class="row">
		<div class="col-12 text-start">
			<input class="form-check-input" type="checkbox" onchange="javascript:checkAllKpiTeam(<?= $kpiId ?>)" id="all-kpi-team-<?= $kpiId ?>" <?= $checkAll ?>>
			<span class="font-size-12 ml-20"><?= Yii::t('app', 'All') ?> </span>
		</div>
	</div>
	<?php
	foreach ($teams as $team) :
		$isCheck = "";
		$kpiTeam = KpiTeam::isHasTeam($team['teamId'], $kpiId);
		if ($kpiTeam == 1) {
			$isCheck = "checked";
		}
	?>
		<div class="row">
			<div class="col-6 mt-10 border-bottom pb-10">
				<input class="form-check-input" type="checkbox" onchange="javascript:checkKpiTeam(<?= $team['teamId'] ?>,<?= $kpiId ?>)" id="kpi-team-<?= $team['teamId'] ?>-<?= $kpiId ?>" <?= $isCheck ?>>
				<label class="form-check-label" for="flexCheckDefault">
					<span class="font-size-14 ml-20"><?= $team['teamName'] ?> </span>
				</label>
			</div>
			<div class="col-6 mt-10 border-bottom pb-10">
				<?= Department::departmentNAme($team['departmentId']) ?>
			</div>
		</div>
<?php
	endforeach;
}
