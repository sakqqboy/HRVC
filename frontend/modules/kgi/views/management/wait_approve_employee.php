<?php

use common\models\ModelMaster;

$this->title = 'Waiting for approve KGI';
?>
<div class="col-12">
	<div class="col-12">
		<img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.png" class="home-icon mr-5" style="margin-top: -3px;">
		<strong class="pim-head-text"> Performance Indicator Matrices (PIM)</strong>
	</div>
	<div class="col-12 mt-10">
		<?= $this->render('header_filter', [
			"role" => $role
		]) ?>
	</div>
	<div class="alert pim-body bg-white mt-10">
		<table class="" style="width:100%;">
			<thead>
				<tr class="pim-table-header">
					<th class="pl-10">Employee</th>
					<th class="">KGI Contents</th>
					<th class="text-center">Priority</th>
					<th class="text-center">Previous</th>
					<th class="text-center">New</th>
					<th class="text-center">Change</th>
					<th class="text-center">Month</th>
					<th>Reason</th>
					<th class="text-center"></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				if (isset($employeeKgis) && count($employeeKgis) > 0) {
					foreach ($employeeKgis as $kgiEmployeeHistoryId => $employeeKgi) :
						if ($employeeKgi["isOver"] == 1 && $employeeKgi["status"] != 2) {
							$colorFormat = 'over';
						} else {
							if ($employeeKgi["status"] == 1) {
								$colorFormat = 'inprogress';
							} else {
								$colorFormat = 'complete';
							}
						}
				?>
						<tr height="10">
						</tr>
						<tr class="pim-bg-<?= $colorFormat ?> pim-table-text">
							<td>
								<div class="col-12 border-left-<?= $colorFormat ?> pim-div-border pb-5">
									<?= $employeeKgi["employeeName"] ?>
								</div>
							</td>
							<td><?= $employeeKgi["kgiName"] ?></td>
							<td class="text-center"><?= $employeeKgi["priority"] ?></td>
							<td class="font-b text-end"><?= number_format($employeeKgi["target"], 2) ?></td>
							<td class="font-b text-end"><?= number_format($employeeKgi["newTarget"], 2) ?></td>
							<td class="text-danger text-end"><?= number_format($employeeKgi["newTarget"] - $employeeKgi["target"], 2) ?></td>
							<td class="text-center"><?= $employeeKgi["month"] ?></td>
							<td style="width: 30%;"><?= $employeeKgi["reson"] ?></td>
							<td> <a href="javascript:approveTargetKgiTeam(<?= $kgiEmployeeHistoryId ?>,1)" class="approve-btn mr-5 no-underline mr-10">
									<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/circle-check-blue.svg" class="mr-5" style="margin-top: -2px;">Approve
								</a>
								<a href="javascript:approveTargetKgiTeam(<?= $kgiEmployeeHistoryId ?>,0)" class="decline-btn  no-underline">
									<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/circle-cancel.svg" class="mr-5" style="margin-top: -2px;">Decline
								</a>
							</td>
							<td class="text-center">
								<a href="<?= Yii::$app->homeUrl ?>kgi/management/approve-kgi-employee/<?= ModelMaster::encodeParams(["kgiEmployeeHistoryId" => $kgiEmployeeHistoryId]) ?>" class="btn btn-sm btn-primary font-size-10">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</a>
							</td>
						</tr>
					<?php
					endforeach;
				} else { ?>
					<tr>
						<td colspan="6" class="col-12 mt-20 font-size-14 text-secondary"> There are no waiting for approve KGI.</td>
					</tr>
				<?php
				}
				?>
			</tbody>
		</table>
	</div>

	<?= $this->render('modal_reson') ?>
</div>