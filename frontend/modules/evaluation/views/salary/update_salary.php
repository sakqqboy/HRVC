<?php

use yii\bootstrap5\ActiveForm;

$this->title = 'Update Salary';
?>
<?php
$form = ActiveForm::begin([
	'id' => 'update-salary',
	'method' => 'post',
	'options' => [
		'enctype' => 'multipart/form-data',
	],

]); ?>
<div class="col-12 mt-70 alert-updated pt-10 pr-10 pl-10 pb-10">
	<div class="col-12 updated_registersalary">
		Update Salary
	</div>
	<div class="row">
		<div class="col-8">
			<div class="col-12 card pl-10 pr-10 pt-10 border-0 font-size-12 mt-5">
				<div class="col-12">
					<span class="badge bg-primary font-size-12 pl-20 pr-20" style="letter-spacing: 0.5px;">For</span>
				</div>
				<div class="row mt-10">
					<div class="col-4">
						<select class="form-select  font-size-12" onchange="javascript:companyDepartment()" id="company" name="company" required>
							<?php
							if (isset($companyId) && $companyId != '') {
							?>
								<option value="<?= $companyId ?>"><?= $companyName ?></option>
							<?php
							}
							?>
							<option value="">Company</option>
							<?php

							if (isset($companies) && count($companies) > 0) {
								foreach ($companies as $company) : ?>
									<option value="<?= $company['companyId'] ?>">
										<?= $company['companyName'] ?>
									</option>
							<?php
								endforeach;
							}
							?>
						</select>
					</div>
					<div class=" col-4">
						<select class="form-select font-size-12" id="department" onchange="javascript:departmentTitle()" name="department" required>
							<?php
							if (isset($departmentId) && $departmentId != '') {
							?>
								<option value="<?= $departmentId ?>"><?= $departmentName ?></option>
							<?php
							}
							?>
							<option value="">Department</option>
							<?php
							if (isset($departments) && count($departments) > 0) {
								foreach ($departments as $department) : ?>
									<option value="<?= $department['departmentId'] ?>">
										<?= $department['departmentName'] ?>
									</option>
							<?php
								endforeach;
							}
							?>
						</select>
					</div>
					<div class="col-4">
						<select class="form-select font-size-12" id="title" name="title" required onchange="checkDupplicateSalary()">
							<?php
							if (isset($titleId) && $titleId != '') {
							?>
								<option value="<?= $titleId ?>"><?= $titleName ?></option>
							<?php
							}
							?>
							<!-- <option value="">Title</option> -->
							<?php
							if (isset($titles) && count($titles) > 0) {
								foreach ($titles as $title) : ?>
									<option value="<?= $title['titleId'] ?>">
										<?= $title['titleName'] ?>
									</option>
							<?php
								endforeach;
							}
							?>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="col-12 card pl-10 pr-10 pt-10 border-0 font-size-12 mt-5 pb-15">
				<div class="col-12">
					<span class="badge bg-primary font-size-12 pl-20 pr-20" style="letter-spacing: 0.5px;">Basic Salary</span>
				</div>
				<div class="row mt-10">
					<div class="col-6">
						<input type="text" name="defaultValue[1]" placeholder="Basic Salary" class="form-control font-size-12 text-end" required value="<?= $salary['salaryAllowances'][1]['defaultValue'] ?>">
					</div>
					<div class="col-6">
						<select class="form-select font-size-12" name="currency" required>
							<option value="<?= $salary['currencyId'] ?>"><?= $salary['currency']['symbol'] ?> <?= $salary['currency']['code'] ?></option>
							<!-- <option value="">Currency</option> -->
							<?php
							if (isset($currencies) && count($currencies) > 0) {
								foreach ($currencies as $currency) : ?>
									<option value="<?= $currency['currencyId'] ?>">
										<?= $currency['symbol'] ?>&nbsp;&nbsp;&nbsp;<?= $currency['code'] ?>
									</option>
							<?php
								endforeach;
							}
							?>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 mt-10">
			<div class="col-12 card pl-10 pr-10 pt-10 border-0 font-size-12 mt-5 pb-15">
				<div class="col-1">
					<span class="badge bg-warning text-dark font-size-12 pl-20 pr-20" style="letter-spacing: 0.5px;">Allowance</span>
				</div>
				<div class="row mt-15 font-size-14 font-weight-500 pl-10">
					<div class="col-1 border-bottom  pb-5">
						<input type="checkbox" class="mr-5" id="all-allowance" onchange="javascript:clickAllAllowance()">
						<label for="all-allowance">All</label>
					</div>
					<div class="col-4 border-bottom  pb-5 text-center">Name</div>
					<div class="col-3 border-bottom  pb-5 text-center">Default Value</div>
				</div>
				<?php

				if (isset($structures) && count($structures) > 0) {
					foreach ($structures as $structure) :
						$check = 0;
						if (isset($salary["salaryAllowances"][$structure['structureId']])) {
							$check = 1;
						}
				?>
						<div class="row mt-7 font-size-14 pl-10">
							<div class="col-1 pt-7">
								<input type="checkbox" class="mr-5 structure-<?= $structure['structureId'] ?>" id="structure" value="<?= $structure['structureId'] ?>" onchange="javascript:enableSettingValue(<?= $structure['structureId'] ?>)" name="allowance[]" <?= $check == 1 ? 'checked' : '' ?>>
							</div>
							<div class="col-4 text-start border-left pt-7">
								<label for="all-allowance1"><?= $structure['structureName'] ?></label>
							</div>
							<div class="col-3 border-left">
								<input type="text" name="defaultValue[<?= $structure['structureId'] ?>]" id="default-value-<?= $structure['structureId'] ?>" placeholder="Default Value" class="form-control font-size-12 text-end" <?= $check == 0 ? 'disabled' : '' ?> value="<?= $check == 1 ? $salary['salaryAllowances'][$structure['structureId']]['defaultValue'] : '' ?>">
							</div>
						</div>
				<?php
					endforeach;
				}
				?>
				<div class="col-8  text-end mt-10 pr-5">
					<input type="hidden" name="previousUrl" value="<?= Yii::$app->request->referrer ?>">
					<button type="submit" class="btn btn-warning font-size-12 pt-5 pb-5">UPDATE</button>
				</div>
			</div>
		</div>
	</div>
</div>
<?php ActiveForm::end(); ?>