<?php

use frontend\models\hrvc\Department;
use frontend\models\hrvc\KgiTeam;

?>
<div class="row mb-10">
	<div class="col-6 font-b">Team</div>
	<div class="col-6 font-b">Department</div>
</div>
<?php


if (isset($teams) && count($teams) > 0) { ?>
	<div class="row">
		<div class="col-12 text-start">
			<input class="form-check-input" type="checkbox" onchange="javascript:checkAllKgiTeam(<?= $kgiId ?>)" id="all-kgi-team-<?= $kgiId ?>" <?= $checkAll ?>>
			<span class="font-size-12 ml-20">All </span>
		</div>
	</div>
	<?php
	foreach ($teams as $team) :
		$isCheck = "";
		$kgiTeam = KgiTeam::isHasTeam($team['teamId'], $kgiId);
		if ($kgiTeam == 1) {
			$isCheck = "checked";
		}
	?>
		<div class="row">
			<div class="col-6 mt-10 border-bottom pb-10">
				<input class="form-check-input" type="checkbox" onchange="javascript:checkKgiTeam(<?= $team['teamId'] ?>,<?= $kgiId ?>)" id="kgi-team-<?= $team['teamId'] ?>-<?= $kgiId ?>" <?= $isCheck ?>>
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
