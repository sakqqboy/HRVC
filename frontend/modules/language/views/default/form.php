<?php

use yii\widgets\ActiveForm;

$form = ActiveForm::begin(); ?>
<div class="col-12 alert mt-10 pim-body bg-white">
	<div class="col-12 text-center font-size-18 font-b">
		<?= Yii::$app->controller->action->id == 'create' ? 'Create' : 'Update' ?> Translation.
	</div>
	<div class="col-12">
		<span class="font-size-14">English</label>
			<textarea class="form-control" style="height: 80px;" name="english" required><?= isset($lang->english) ? $lang->english : '' ?></textarea>
	</div>
	<div class="col-12 mt-10">
		<span class="font-size-14">Japanese</label>
			<textarea class="form-control" style="height: 80px;" name="japanese"><?= isset($lang->japanese) ? $lang->japanese : '' ?></textarea>
	</div>
	<div class="col-12 mt-10">
		<span class="font-size-14">Thai</label>
			<textarea class="form-control" style="height: 80px;" name="thai"><?= isset($lang->thai) ? $lang->thai : '' ?></textarea>
	</div>
	<div class="col-12 mt-10">
		<span class="font-size-14">Chinese</label>
			<textarea class="form-control" style="height: 80px;" name="chinese"><?= isset($lang->chinese) ? $lang->chinese : '' ?></textarea>
	</div>
	<div class="col-12 mt-10">
		<span class="font-size-14">Vietnam</label>
			<textarea class="form-control" style="height: 80px;" name="vietnam"><?= isset($lang->vietnam) ? $lang->vietnam : '' ?></textarea>
	</div>
	<div class="col-12 mt-10">
		<span class="font-size-14">Spanish</label>
			<textarea class="form-control" style="height: 80px;" name="spanish"><?= isset($lang->spanish) ? $lang->spanish : '' ?></textarea>
	</div>
	<div class="col-12 mt-10">
		<span class="font-size-14">Indonesian</label>
			<textarea class="form-control" style="height: 80px;" name="indonesian"><?= isset($lang->indonesian) ? $lang->indonesian : '' ?></textarea>
	</div>
	<div class="col-12 text-end mt-10">
		<button type="submit" class="<?= Yii::$app->controller->action->id == 'create' ? 'btn btn-primary' : 'btn btn-warning' ?> font-size-14  pl-5 pr-5">
			<?= Yii::$app->controller->action->id == 'create' ? '+ Create New' : 'Update' ?>
		</button>
	</div>

</div>
<?php ActiveForm::end(); ?>