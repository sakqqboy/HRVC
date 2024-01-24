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
			<a href="<?= Yii::$app->homeUrl ?>setting/employee/export" class="no-underline text-primary" target="_blank">
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
								<th>Name</th>
								<th>Email</th>
								<th>Company</th>
								<th>Branch</th>
								<th>Department</th>
								<th>Title</th>
							</tr>
							<tbody>
								<?php
								$i = 1;
								foreach ($corrects as $line => $correct) :
								?>
									<tr class="font-size-12">
										<td><?= $i ?></td>
										<td><?= $correct["name"] ?></td>
										<td><?= $correct["email"] ?></td>
										<td><?= $correct["company"] ?></td>
										<td><?= $correct["branch"] ?></td>
										<td><?= $correct["department"] ?></td>
										<td><?= $correct["title"] ?></td>
									</tr>
								<?php
									$i++;
								endforeach;
								?>
							</tbody>
						</table>
					</div>
				<?php
				}
				?>
				<?php
				if (isset($update) && count($update) > 0) {
					//throw new exception(print_r($errors, true));
					$status = count($errors) > 0 ? 'Ready to update' : 'Updated';
				?>
					<div class="row mt-40">
						<div class="col-12 text-warning font-size-14 text-start font-b"><?= $status ?> (<?= $countUpdate ?>)</div>
						<table class="table table-responsive mt-10">
							<tr class="font-size-12">
								<th>No</th>
								<th>Name</th>
								<th>Email</th>
								<th>Company</th>
								<th>Branch</th>
								<th>Department</th>
								<th>Title</th>
							</tr>
							<tbody>
								<?php
								$i = 1;
								foreach ($update as $line => $up) :
								?>
									<tr class="font-size-12">
										<td><?= $i ?></td>
										<td><?= $up["name"] ?></td>
										<td><?= $up["email"] ?></td>
										<td><?= $up["company"] ?></td>
										<td><?= $up["branch"] ?></td>
										<td><?= $up["department"] ?></td>
										<td><?= $up["title"] ?></td>
									</tr>
								<?php
									$i++;
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