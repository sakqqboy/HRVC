<?php

use common\models\ModelMaster;
use frontend\models\hrvc\KgiTeamHistory;

if (isset($kgiTeamHistory) && count($kgiTeamHistory) > 0) { ?>
	<div class="row border-bottom pb-10 mb-10 font-b">
		<div class="col-2">Target</div>
		<div class="col-2">Result</div>
		<div class="col-3">Updater</div>
		<div class="col-3 text-center">Update Date</div>
		<div class="col-2">Status</div>
	</div>
	<?php
	foreach ($kgiTeamHistory as $history) :
		$statusText = KgiTeamHistory::statusText($history["status"]);
	?>
		<div class="row pt-10 border-bottom pb-5 font-size-12">
			<div class="col-2"><?= $history["target"] == null ? '-' : $history["target"] ?></div>
			<div class="col-2"><?= $history["result"] == null ? '-' : $history["result"] ?></div>
			<div class="col-3"><?= $history["employeeFirstname"] ?> <?= $history["employeeSurename"] ?></div>
			<div class="col-3 text-center"><?= ModelMaster::engDate($history["createDateTime"], 2) ?></div>
			<div class="col-2"><?= $statusText ?></div>
		</div>

	<?php
	endforeach;
	?>
<?php
} else {
?>
	<div class="col-12 mt-20 font-size-16 text-center">Not update yet.</div>
<?php
}
