<?php

use Faker\Core\Number;
use yii\bootstrap5\ActiveForm;

$this->title = "Create KPI GROUP";
$form = ActiveForm::begin([
	'id' => 'create-kpi-group',
	'method' => 'post',
	'options' => [
		'enctype' => 'multipart/form-data',
	],
	//'action' => Yii::$app->homeUrl . 'kgi/management/create-kgi'

]);
?>
<div class="col-12 mt-90 pd-Performance">
	<div class="row">
		<div class="col-10">
			<i class="fa fa-users font-size-20 mr-10" aria-hidden="true"></i>
			<strong class="font-size-20"><?= Yii::t('app', 'Create KPI Group') ?></strong>
		</div>
		<div class="col-2 text-end">
			<a href="<?= Yii::$app->homeUrl ?>kpi/kpi-group/index" class="btn btn-secondary font-size-12">
				<i class="fa fa-chevron-left mr-5" aria-hidden="true"></i>
				<?= Yii::t('app', 'Back') ?>
			</a>
		</div>
	</div>
	<div class="row mt-20">
		<div class="offset-3 col-6">
			<div class="col-12 ">
				<label for="" class="form-label font-size-12">
					<strong class="red">* </strong><?= Yii::t('app', 'KPI Group Name') ?>
				</label>
				<span class="text-danger ml-20 pull-right" style="display: none;" id="duplicateName"> * * * <?= Yii::t('app', 'Duplicate KPI Group Name') ?> ! ! ! * * *</span>
				<input type="text" class="form-control" placeholder="" required name="kgiGroupName" id="kgiGroupName" onkeyup="javascript:checkKgiName()">
			</div>
			<div class="col-12 mt-10">
				<label for="" class="form-label font-size-12">
					<strong class="red">* </strong><?= Yii::t('app', 'Company') ?>
				</label>
				<select class="form-select font-size-14" name="company" id="companyId" required onchange="javascript:checkKpiName()">
					<option value="">Select Company</option>
					<?php
					if (isset($companies) && count($companies) > 0) {
						foreach ($companies as $company) :
					?>
							<option value="<?= $company['companyId'] ?>"><?= $company['companyName'] ?></option>
					<?php
						endforeach;
					}
					?>
				</select>
			</div>
			<div class="col-12 mt-10">
				<label for="" class="form-label font-size-12"></strong><?= Yii::t('app', 'Detail') ?></label>
				<textarea class="form-control" name="detail" style="height: 100px;"></textarea>
			</div>
			<div class="row">
				<div class="col-lg-6 col-md-6 col-6 pt-10">
					<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> <?= Yii::t('app', 'Quant Ratio') ?></label>
					<select class="form-select font-size-13" aria-label="Default select example" required name="quantRatio">
						<option value=""><?= Yii::t('app', 'Quantity') ?> / <?= Yii::t('app', 'Quality') ?></option>
						<option value="1"><?= Yii::t('app', 'Quantity') ?></option>
						<option value="2"><?= Yii::t('app', 'Quality') ?></option>
					</select>
				</div>
				<div class="col-lg-6 col-md-6 col-6 pt-10">
					<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> <?= Yii::t('app', 'Priority') ?></label>
					<select class="form-select font-size-13" aria-label="Default select example" required name="priority">
						<option value="">A/B/C</option>
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="C">C</option>
					</select>
				</div>
				<div class="col-lg-6 col-md-6 col-6 pt-10">
					<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> <?= Yii::t('app', 'Amount Type') ?></label>
					<select class="form-select font-size-13" aria-label="Default select example" required name="amountType">
						<option value="">% <?= Yii::t('app', 'or') ?><?= Yii::t('app', ' Number') ?></option>
						<option value="1">%</option>
						<option value="2"><?= Yii::t('app', 'Number') ?></option>
					</select>
				</div>

				<div class="col-lg-6 col-md-6 col-6 pt-10">
					<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> <?= Yii::t('app', 'Status') ?></label>
					<select class="form-select font-size-13" aria-label="Default select example" required name="status">
						<option value=""><?= Yii::t('app', 'Active') ?> / <?= Yii::t('app', 'Finished') ?></option>
						<option value="1"><?= Yii::t('app', 'Active') ?></option>
						<option value="2"><?= Yii::t('app', 'Finished') ?></option>
					</select>
				</div>
				<div class="col-lg-6 col-md-6 col-6 pt-10">
					<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> <?= Yii::t('app', 'Month') ?></label>
					<select class="form-select font-size-13" aria-label="Default select example" required name="month">
						<option value=""><?= Yii::t('app', 'Select Month') ?></option>
						<?php
						if (isset($months) && count($months) > 0) {
							foreach ($months as $value => $month) : ?>
								<option value="<?= $value ?>"><?= Yii::t('app', $month) ?></option>
						<?php

							endforeach;
						}
						?>
					</select>
				</div>

				<div class="col-6 mt-10">
					<label for="exampleFormControl" class="form-label font-size-13"><?= Yii::t('app', 'Target') ?></label>
					<input class="form-control text-end" name="target" type="text">
				</div>
			</div>
			<div class="col-12 mt-10">
				<label for="exampleFormControl" class="form-label font-size-13"></strong><?= Yii::t('app', 'Remark') ?></label>
				<textarea class="form-control" name="remark" style="height: 70px;"></textarea>
			</div>
			<div class="col-12 mt-15 text-end">
				<button type="submit" class="btn btn-primary" disabled id="submit-kgi-group"><?= Yii::t('app', 'Create') ?></button>
			</div>

		</div>
	</div>
</div>
<?php ActiveForm::end(); ?>