<?php

use frontend\models\hrvc\Department;

if (isset($kgiTeams) && count($kgiTeams) > 0) {
?>
	<div class="row mt-20">
		<?php
		foreach ($kgiTeams as $departmentId => $teams) :
			if (count($teams) > 0) {
				foreach ($teams as $teamId => $team) :

		?>
					<div class="col-lg-3 col-md-4 col-6" onclick="javascription:kgiTeamHistory2(<?= $teamId ?>,<?= $kgiId ?>)" style="cursor: pointer;">
						<div class="col-12">
							<div class="alert team-user"><i class="fa fa-users" aria-hidden="true"></i></div>
						</div>
						<div class="col-12" style="margin-top: -10px;">
							<strong class="font-size-10"> <?= $team ?></strong>
							<div class="font-size-10"> <?= Department::departmentNAme($departmentId) ?></div>
						</div>
					</div>
		<?php
				endforeach;
			}
		endforeach;
		?>
	</div>
<?php
}
?>