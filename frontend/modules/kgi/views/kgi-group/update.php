<?php

use common\models\ModelMaster;
use Faker\Core\Number;
use frontend\models\hrvc\Company;
use yii\bootstrap5\ActiveForm;

$this->title = "Update KGI GROUP";
$form = ActiveForm::begin([
	'id' => 'update-kgi-group',
	'method' => 'post',
	'options' => [
		'enctype' => 'multipart/form-data',
	],
	'action' => Yii::$app->homeUrl . 'kgi/kgi-group/save-update-kgi-group'

]);
?>
<div class="col-12 mt-90 pd-Performance">
	<div class="row">
		<div class="col-10">
			<i class="fa fa-list-alt font-size-20" aria-hidden="true"></i>
			<strong class="font-size-20">Update KGI Group : <?= $kgiGroup["kgiGroupName"] ?></strong>
		</div>
		<div class="col-2 text-end">
			<a href="<?= Yii::$app->homeUrl ?>kgi/kgi-group/index" class="btn btn-secondary font-size-12">
				<i class="fa fa-chevron-left mr-5" aria-hidden="true"></i>
				Back
			</a>
		</div>
	</div>
	<div class="row mt-20">
		<div class="offset-3 col-6">
			<div class="col-12 ">
				<label for="" class="form-label font-size-12">
					<strong class="red">* </strong>KGI Group Name
				</label>
				<span class="text-danger ml-20 pull-right" style="display: none;" id="duplicateName"> * * * Duplicate KGI Group Name ! ! ! * * *</span>
				<input type="text" class="form-control" value='<?= $kgiGroup["kgiGroupName"] ?>' placeholder="" required name="kgiGroupName" id="kgiGroupName" onkeyup="javascript:checkKgiNameUpdate()">
			</div>
			<div class="col-12 mt-10">
				<label for="" class="form-label font-size-12">
					<strong class="red">* </strong>Company
				</label>
				<select class="form-select font-size-14" name="company" id="companyId" required onchange="javascript:checkKgiNameUpdate()">

					<option value="<?= $kgiGroup['companyId'] ?>"><?= Company::companyName($kgiGroup['companyId']) ?></option>
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
				<label for="" class="form-label font-size-12"></strong>Detail</label>
				<textarea class="form-control" name="detail" style="height: 100px;"><?= $kgiGroup['kgiGroupDetail'] ?></textarea>
			</div>
			<div class="row">
				<div class="col-lg-6 col-md-6 col-6 pt-10">
					<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Quant Ratio</label>
					<select class="form-select font-size-13" aria-label="Default select example" required name="quantRatio">
						<?php
						if (isset($kgiGroup['quantRatio']) && $kgiGroup['quantRatio'] != '') {
						?>
							<option value="<?= $kgiGroup['quantRatio'] ?>"><?= $kgiGroup['quantRatio'] == 1 ? 'Quantity' : 'Quality' ?></option>
						<?php
						}
						?>
						<option value="">Quantity / Quality</option>
						<option value="1">Quantity</option>
						<option value="2">Quality</option>
					</select>
				</div>
				<div class="col-lg-6 col-md-6 col-6 pt-10">
					<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Priority</label>
					<select class="form-select font-size-13" aria-label="Default select example" required name="priority">
						<?php
						if (isset($kgiGroup['priority']) && $kgiGroup['priority'] != '') {
						?>
							<option value="<?= $kgiGroup['priority'] ?>"><?= $kgiGroup['priority'] ?></option>
						<?php
						}
						?>
						<option value="">A/B/C</option>
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="C">C</option>
					</select>
				</div>
				<div class="col-lg-6 col-md-6 col-6 pt-10">
					<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Amount Type</label>
					<select class="form-select font-size-13" aria-label="Default select example" required name="amountType">
						<?php
						if (isset($kgiGroup['amountType']) && $kgiGroup['amountType'] != '') {
						?>
							<option value="<?= $kgiGroup['amountType'] ?>"><?= $kgiGroup['amountType'] == 1 ? '%' : 'Number' ?></option>
						<?php
						}
						?>
						<option value="">% or Number</option>
						<option value="1">%</option>
						<option value="2">Number</option>
					</select>
				</div>

				<div class="col-lg-6 col-md-6 col-6 pt-10">
					<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Status</label>
					<select class="form-select font-size-13" aria-label="Default select example" required name="status">
						<?php
						if (isset($kgiGroup['status']) && $kgiGroup['status'] != '') {
						?>
							<option value="<?= $kgiGroup['status'] ?>"><?= $kgiGroup['status'] == 1 ? 'Active' : 'Finished' ?></option>
						<?php
						}
						?>
						<option value="">Active / Finished</option>
						<option value="1">Active</option>
						<option value="2">Finished</option>
					</select>
				</div>
				<div class="col-lg-6 col-md-6 col-6 pt-10">
					<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Month</label>
					<select class="form-select font-size-13" aria-label="Default select example" required name="month">
						<?php
						if (isset($kgiGroup['month']) && $kgiGroup['month'] != '') {
						?>
							<option value="<?= $kgiGroup['month'] ?>"><?= ModelMaster::fullMonthText($kgiGroup['month']) ?></option>
						<?php
						}
						?>
						<option value="">Select Month</option>
						<?php
						if (isset($months) && count($months) > 0) {
							foreach ($months as $value => $month) : ?>
								<option value="<?= $value ?>"><?= $month ?></option>
						<?php

							endforeach;
						}
						?>
					</select>
				</div>

				<div class="col-6 mt-10">
					<label for="exampleFormControl" class="form-label font-size-13">Target</label>
					<input class="form-control text-end" name="target" type="text" value="<?= number_format($kgiGroup['target'], 2) ?>">
				</div>
			</div>
			<div class="col-12 mt-10">
				<label for="exampleFormControl" class="form-label font-size-13"></strong>Remark</label>
				<textarea class="form-control" name="remark" style="height: 70px;"><?= $kgiGroup['remark'] ?></textarea>
			</div>
			<div class="col-12 mt-10 text-end">
				<input id="kgiGroupId" value="<?= $kgiGroup['kgiGroupId'] ?>" name="kgiGroupId" type="hidden">
				<button type="submit" class="btn btn-warning" id="submit-kgi-group">Update</button>
			</div>

		</div>
	</div>
</div>
<?php ActiveForm::end(); ?>