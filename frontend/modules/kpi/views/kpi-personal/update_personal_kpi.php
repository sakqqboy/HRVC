<?php

use common\models\ModelMaster;
use Faker\Core\Number;
use yii\bootstrap5\ActiveForm;

$this->title = "Update Individual KPI";
$form = ActiveForm::begin([
	'id' => 'update-personal-kpi',
	'method' => 'post',
	'options' => [
		'enctype' => 'multipart/form-data',
	],
	'action' => Yii::$app->homeUrl . 'kpi/kpi-personal/save-update-personal-kpi'

]);
?>
<div class="col-12 mt-90 pd-Performance">
	<div class="row">
		<div class="col-10">
			<i class="fa fa-list-alt font-size-20" aria-hidden="true"></i>
			<strong class="font-size-20">Update Individual KPI</strong>
		</div>
		<div class="col-2 text-end">
			<a href="<?= Yii::$app->request->referrer ?>" class="btn btn-secondary font-size-12">
				<i class="fa fa-chevron-left mr-5" aria-hidden="true"></i>
				Back
			</a>
		</div>
	</div>
	<div class="row mt-20">
		<div class="offset-3 col-6">
			<div class="col-12 mt-10 font-b border-bottom pb-10">
				KPI : : <?= $kpiEmployeeDetail["kpiName"] ?>

			</div>
			<div class="col-12 mt-10">
				<label for="" class="form-label font-size-12"></strong>Detail</label>
				<textarea class="form-control" name="detail" style="height: 100px;" required><?= $kpiEmployeeDetail["detail"] ?></textarea>
			</div>
			<div class="row">
				<div class="col-6 mt-10">
					<label for="exampleFormControl" class="form-label font-size-13">Target</label>
					<input class="form-control text-end" name="target" type="text" value="<?= number_format($kpiEmployeeDetail['target'], 2) ?>">
				</div>
				<div class="col-6 mt-10">
					<label for="exampleFormControl" class="form-label font-size-13">Result</label>
					<input class="form-control text-end" name="result" type="text" value="<?= number_format($kpiEmployeeDetail['result'], 2) ?>">
				</div>
				<div class="col-6 pt-10">
					<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Month</label>
					<select class="form-select font-size-13" required aria-label="Default select example" name="month" id="month-update">
						<?php
						if (isset($kpiEmployeeDetail["month"]) && $kpiEmployeeDetail["month"] != '') { ?>
							<option value="<?= $kpiEmployeeDetail["month"] ?>">
								<?= ModelMaster::monthFull()[$kpiEmployeeDetail["month"]] ?>
							</option>
						<?php

						}
						?>
						<option value="">Month</option>
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
				<div class="col-6 pt-10">
					<label class="form-label font-size-12"><strong class="red">*</strong> Year</label>
					<select class="form-select font-size-12" required name="year" id="year-update">
						<?php
						if (isset($kpiEmployeeDetail["year"]) && $kpiEmployeeDetail["year"] != '') { ?>
							<option value="<?= $kpiEmployeeDetail["year"] ?>"><?= $kpiEmployeeDetail["year"] ?></option>
						<?php

						}
						?>
						<option value="">Year</option>
						<?php
						$year = 2020;
						$thisYear = date('Y');
						while ($year < ($thisYear + 10)) { ?>
							<option value="<?= $year ?>"><?= $year ?></option>
						<?php
							$year++;
						}
						?>
					</select>
				</div>
				<div class="col-6 mt-10">
					<label for="exampleFormControl" class="form-label font-size-13">Next Check Date</label>
					<?php
					if ($kpiEmployeeDetail['nextCheckDate'] != null) {
						$nextCheckDateArr = explode(' ', $kpiEmployeeDetail["nextCheckDate"]);
						$nextCheckDate = $nextCheckDateArr[0];
					} else {
						$nextCheckDate = null;
					}
					?>
					<input class="form-control text-end" name="nextCheckDate" type="date" required value="<?= $nextCheckDate ?>">
				</div>
				<div class="col-lg-6 col-md-6 col-6 pt-10">
					<label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong> Status</label>
					<select class="form-select font-size-13" aria-label="Default select example" required name="status">
						<?php
						if ($kpiEmployeeDetail['status'] != null) {
							if ($kpiEmployeeDetail['status'] == 1) { ?>
								<option value="1">Active</option>
							<?php
							} else { ?>
								<option value="2">Finished</option>
						<?php
							}
						}
						?>
						<?php
						if ($kpiEmployeeDetail['status'] == null) {
						?>
							<option value="1">Active</option>
							<option value="2">Finished</option>
							<?php
						} else {
							if ($kpiEmployeeDetail['status'] == 1) { ?>
								<option value="2">Finished</option>
							<?php
							} else { ?>
								<option value="1">Active</option>
						<?php
							}
						}
						?>
					</select>
				</div>

			</div>
			<div class="col-12 mt-15 text-end">
				<input type="hidden" name="kpiEmployeeId" value="<?= $kpiEmployeeId ?>">
				<input type="hidden" name="url" value="<?= Yii::$app->request->referrer ?>">
				<button type="submit" class="btn btn-warning">Update</button>
			</div>

		</div>
	</div>
</div>
<?php ActiveForm::end(); ?>