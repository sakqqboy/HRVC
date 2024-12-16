<?php

use frontend\models\hrvc\Department;
use frontend\models\hrvc\KpiTeam;

if (isset($t) && count($t) > 0) {
	foreach ($t as $departmentId => $teams) : ?>
		<div class="col-12 multi-select-head pl-10 pt-10 pb-3">
			<?=
			Department::departmentNAme($departmentId);
			?>
		</div>
		<?php
		if (count($teams) > 1) { ?>
			<div class="col-12 multi-select pl-30 pt-5 pb-5">
				<input type="checkbox" id='multi-check-all-team-<?= $departmentId ?>-update' name="allTeam[]" class="checkbox-md mr-5 " value="all" onchange="javascript:allTeamUpdate(<?= $departmentId ?>)">
				<?= Yii::t('app', 'All') ?>
			</div>
		<?php
		}
		foreach ($teams as $teamId => $team) :
			$check = '';
			$has = KpiTeam::isInThisKpi($teamId, $kpiId);
			if ($has == 1) {
				$check = 'checked';
			}
		?>
			<div class="col-12 multi-select pl-30 pt-5 pb-5">
				<input type="checkbox" id='multi-check-team-<?= $departmentId ?>-update' <?= $check ?> name="team[]" class="checkbox-md mr-5 multiTeam-department-update-<?= $teamId ?>" value="<?= $teamId ?>" onchange="javascript:multiTeamUpdate(<?= $departmentId ?>)">
				<?= $team ?>
			</div>
<?php
		endforeach;
	endforeach;
}
