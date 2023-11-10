<?php

use yii\bootstrap5\ActiveForm;

$this->title = 'Import title';

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
			Import Title
		</div>
		<div class="col-12 mt-10">
			<a href="<?= Yii::$app->homeUrl ?>setting/title/export" class="no-underline text-primary" target="_blank">
				&nbsp;> > > Title format file < < <&nbsp;</a>
		</div>
		<div class="col-4 mt-20 border-right border-bottom pt-10" style="min-height:150px;">
			<div class="mb-3">
				<label for="formFile" class="form-label">Default file input example</label>
				<input class="form-control mt-10" type="file" id="formFile" name="titleFile">
			</div>
			<div class="col-12 text-end mt-10">
				<a href="<?= Yii::$app->homeUrl ?>setting/title/index" class="btn btn-danger pull-left">
					<i class="fa fa-angle-left" aria-hidden="true"></i> Back </a>
				<button type="submit" class="btn btn-primary">
					<i class="fa fa-upload mr-5" aria-hidden="true"></i>Upload
				</button>
			</div>
		</div>
		<div class="col-8 mt-20 border-left border-bottom">
			<div class="col-12 text-center pt-10" style="min-height:150px;">
				<b>Result</b>

				<?php
				if (isset($errors) && count($errors) > 0) {
					//throw new exception(print_r($errors, true));
				?>

					<div class="row mt-10">
						<div class="col-12 text-danger font-b font-size-14 text-start mb-20">Error (<?= count($errors) ?>)</div>
						<div class="col-2 text-start font-size-14 font-b mb-10">Line</div>
						<div class="col-10 text-start font-size-14 font-b mb-10" style="word-wrap: break-word;">
							Error
						</div>
						<?php
						foreach ($errors as $line => $error) :
						?>
							<div class="col-2 text-start font-size-10 border-bottom mt-5">
								<?= $line ?>
							</div>
							<div class="col-10 text-start font-size-10 border-bottom mt-5 pb-5 text-danger" style="word-wrap: break-word;line-height:20px;">
								<?= $error ?>
							</div>
						<?php
						endforeach;
						?>
					</div>
				<?php
				}
				?>
				<?php
				if (isset($corrects) && count($corrects) > 0) {
					//throw new exception(print_r($errors, true));
					$status = count($errors) > 0 ? 'Ready to save' : 'Saved';
				?>
					<div class="row mt-40">
						<div class="col-12 text-success font-size-14 text-start font-b"><?= $status ?> (<?= $success ?>)</div>
						<table class="table table-responsive mt-10">
							<tr class="font-size-12">
								<th>No</th>
								<th>Title Name</th>
								<th>Department</th>
							</tr>
							<tbody>
								<?php
								$i = 1;
								foreach ($corrects as $line => $correct) :
								?>
									<tr class="font-size-12">
										<td><?= $i ?></td>
										<td><?= $correct["name"] ?></td>
										<td><?= $correct["department"] ?></td>
									</tr>
								<?php
								endforeach;
								?>
							</tbody>
						</table>
					</div>
				<?php
				}
				?>
			</div>
		</div>
	</div>
</div>
<?php ActiveForm::end(); ?>