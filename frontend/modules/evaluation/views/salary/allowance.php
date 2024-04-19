<?php

use yii\bootstrap5\ActiveForm;

$this->title = 'Salary Setting';
?>
<div class="col-12 mt-70 alert-updated pt-10 pr-10 pl-10">
	<div class="row">
		<div class="col-12 updated_registersalary">
			Allowances
		</div>
		<?php
		$form = ActiveForm::begin([
			'id' => 'create-allowance',
			'method' => 'post',
			'options' => [
				'enctype' => 'multipart/form-data',
			],

		]); ?>
		<div class="col-12 card pl-10 pr-10 pt-10 border-0 font-size-12 mt-10 mb-10">
			<!-- <label class="">Allowance Name</label> -->
			<div class="row mt-10">
				<div class="offset-4 col-3">
					<input type="text" class="form-control font-size-12" placeholder="Allowance Name" name="allowanceName" id="allowanceName">
				</div>
				<div class="col-2">
					<a href="javascript:checkDupplicateAllowance()" class="btn btn-primary font-size-12" id="create-allowance-btn"> Create </a>
					<a href="javascript:updateAllowance()" class="btn btn-warning font-size-12" id="update-allowance-btn" style="display: none;"> Update </a>
				</div>
				<input type="hidden" id="updateId" value="">
			</div>
		</div>
		<?php ActiveForm::end(); ?>
	</div>
	<div class="col-12 card pl-10 pr-10 pt-10 border-0 font-size-12 mt-10 mb-10">
		<div class="col-12 font-size-14 font-weight-500">
			Current active allowances
		</div>
		<div class="col-12 mt-5">
			<table class="table">
				<thead>
					<tr class="frame-table-header">
						<th style="border-top-left-radius:5px;border-bottom-left-radius:5px;">No</th>
						<th> Allowance Name</th>
						<th class="text-center" style="border-top-right-radius:5px;border-bottom-right-radius:5px;">
							ACTION <i class="fa fa-pencil-square-o font-size-14 ml-10" aria-hidden="true"></i>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (isset($allowances) && count($allowances) > 0) {
						$i = 1;
						foreach ($allowances as $allowance) :
					?>
							<tr id="allowance-<?= $allowance['structureId'] ?>">
								<td>
									<?= $i ?>.
								</td>
								<td id="allowanceName-<?= $allowance['structureId'] ?>">
									<?= $allowance["structureName"] ?>
								</td>
								<td class="text-center">
									<a href="javascript:prepareUpdateAllowance(<?= $allowance['structureId'] ?>)" class="btn btn-warning font-size-12 pr-8 pl-8 pt-4 pb-4 mr-10">
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									</a>
									<a href="javascript:deleteAllowance(<?= $allowance['structureId'] ?>)" class="btn btn-danger font-size-12 pr-8 pl-8 pt-4 pb-4">
										<i class="fa fa-trash-o" aria-hidden="true"></i>
									</a>
								</td>
							</tr>
					<?php
							$i++;
						endforeach;
					}
					?>
				</tbody>
			</table>
		</div>
	</div>