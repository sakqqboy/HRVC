<?php

use yii\bootstrap5\ActiveForm;

$this->title = 'Import Employee';

$form = ActiveForm::begin([
	'options' => [
		'class' => 'panel panel-default form-horizontal',
		'enctype' => 'multipart/form-data',
		'id' => 'import',
	],
]);
?>
<div class="col-12 department-one" style="margin-top: 90px;">

	<div class="row ">
		<div class="col-12 branch-title">
			Import Employee
		</div>
		<div class="col-12 mt-10">
			<a href="<?= Yii::$app->homeUrl ?>file/format/employee.xlsx" class="no-underline text-primary">
				&nbsp;> > > Employee format file < < <&nbsp;</a>
		</div>
		<div class="col-4 mt-20 border-right border-bottom pt-10" style="min-height:150px;">
			<div class="mb-3">
				<label for="formFile" class="form-label">Default file input example</label>
				<input class="form-control mt-10" type="file" id="formFile" name="employeeFile">
			</div>
			<div class="col-12 text-end mt-10">
				<button type="submit" class="btn btn-primary">
					<i class="fa fa-upload mr-5" aria-hidden="true"></i>Upload
				</button>
			</div>
		</div>
		<div class="col-8 mt-20 border-left border-bottom">
			<div class="col-12 font-b text-center pt-10" style="min-height:150px;">
				Result
				<?php
				if (isset($result) && count($result) > 0) {
				}
				?>
			</div>
		</div>
	</div>
</div>
<?php ActiveForm::end(); ?>