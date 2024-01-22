<?php

use common\models\ModelMaster;
use frontend\models\hrvc\User;

if (isset($kpiEmployeeHistory) && count($kpiEmployeeHistory) > 0) { ?>
	<div class="row border-bottom pb-10 mb-10 font-size-13 font-b">
		<div class="col-2">Target</div>
		<div class="col-2">Result</div>
		<div class="col-2">Detail</div>
		<div class="col-2">Date</div>
		<div class="col-2">Next update</div>
		<div class="col-2">By</div>

	</div>
	<?php

	foreach ($kpiEmployeeHistory as $history) :
		$updater = User::employeeNameByuserId($history["createrId"]);
	?>
		<div class="row font-size-12">
			<div class="col-2"><?= $history["target"] == null ? 'not set' : number_format($history["target"]) ?></div>
			<div class="col-2"><?= $history["result"] == null ? 'not set' : number_format($history["result"]) ?></div>
			<div class="col-2"><?= isset($history["detail"]) ? $history["detail"] : '' ?></div>
			<div class="col-2"><?= ModelMaster::engDate($history["createDateTime"], 2) ?></div>
			<div class="col-2"><?= isset($history["nextCheckDate"]) ? ModelMaster::engDate($history["nextCheckDate"], 2) : '' ?></div>
			<div class="col-2"><?= $updater ?></div>
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
