<?php

use frontend\models\hrvc\Department;

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
				<input type="checkbox" id='multi-check-all-team-<?= $departmentId ?>' name="allTeam[]" class="checkbox-md mr-5 " value="all" onchange="javascript:allTeam(<?= $departmentId ?>)">
				<?= Yii::t('app', 'All') ?>
			</div>
		<?php
		}
		foreach ($teams as $teamId => $team) : ?>
			<div class="col-12 multi-select pl-30 pt-5 pb-5">
				<input type="checkbox" id='multi-check-team-<?= $departmentId ?>' name="team[]" class="checkbox-md mr-5 multi-check-team multiTeam-department-<?= $teamId ?>" value="<?= $teamId ?>" onchange="javascript:multiTeam(<?= $departmentId ?>)">
				<?= $team ?>
			</div>
<?php
		endforeach;
	endforeach;
}
