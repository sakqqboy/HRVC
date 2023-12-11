<?php

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
			<div class="col-12 mt-10">
				<label for="" class="form-label font-size-12">Target</label>
				<input class="form-control text-end" name="target" type="text" value="<?= number_format($kgiGroup['target'], 2) ?>">
			</div>
			<div class="col-12 mt-10 text-end">
				<input id="kgiGroupId" value="<?= $kgiGroup['kgiGroupId'] ?>" name="kgiGroupId" type="hidden">
				<button type="submit" class="btn btn-warning" id="submit-kgi-group">Update</button>
			</div>

		</div>
	</div>
</div>
<?php ActiveForm::end(); ?>