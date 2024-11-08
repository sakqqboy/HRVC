<?php

use common\models\ModelMaster;

$this->title = 'Waiting for approve KPI';
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
					<th style="width:20%;">KPI Contents</th>
					<th class="text-center">Priority</th>
					<th class="text-center">Previous</th>
					<th class="text-center">New</th>
					<th class="text-center">Change</th>
					<th class="text-center">Month</th>
					<th style="width:15%;">Reason</th>
					<th class="text-center"></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				//throw new Exception(print_r($employeeKpis, true));
				if (isset($employeeKpis) && count($employeeKpis) > 0) {
					foreach ($employeeKpis as $kpiEmployeeHistoryId => $employeeKpi) :
						if ($employeeKpi["isOver"] == 1 && $employeeKpi["status"] != 2) {
							$colorFormat = 'over';
						} else {
							if ($employeeKpi["status"] == 1) {
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
									<?= $employeeKpi["employeeName"] ?>
								</div>
							</td>
							<td><?= $employeeKpi["kpiName"] ?></td>
							<td class="text-center"><?= $employeeKpi["priority"] ?></td>
							<td class="font-b text-end"><?= number_format($employeeKpi["target"], 2) ?></td>
							<td class="font-b text-end"><?= number_format($employeeKpi["newTarget"], 2) ?></td>
							<td class="text-danger text-end"><?= number_format($employeeKpi["newTarget"] - $employeeKpi["target"], 2) ?></td>
							<td class="text-center"><?= $employeeKpi["month"] ?></td>
							<td><?= $employeeKpi["reson"] ?></td>
							<td class="text-center"> <a href="javascript:approveTargetKpiEmployee(<?= $kpiEmployeeHistoryId ?>,1)" class="approve-btn mr-5 no-underline mr-10">
									<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/circle-check-blue.svg" class="mr-5" style="margin-top: -2px;">Approve
								</a>
								<a href="javascript:approveTargetKpiEmployee(<?= $kpiEmployeeHistoryId ?>,0)" class="decline-btn  no-underline">
									<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/circle-cancel.svg" class="mr-5" style="margin-top: -2px;">Decline
								</a>
							</td>
							<td class="text-center">
								<a href="<?= Yii::$app->homeUrl ?>kpi/management/approve-kpi-employee/<?= ModelMaster::encodeParams(["kpiEmployeeHistoryId" => $kpiEmployeeHistoryId]) ?>" class="btn btn-bg-white-xs">
									<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" style="margin-top: -2px;">
								</a>
							</td>
						</tr>
					<?php
					endforeach;
				} else { ?>
					<tr>
						<td colspan="6" class="col-12 mt-20 font-size-14 text-secondary"> There are no waiting for approve KPI.</td>
					</tr>
				<?php
				}
				?>
			</tbody>
		</table>
	</div>

	<?= $this->render('modal_reson') ?>
</div>