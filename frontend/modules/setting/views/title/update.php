<?php

use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\Layer;
use yii\bootstrap5\ActiveForm;

$this->title = 'Update Title';
$form = ActiveForm::begin([
	'id' => 'update-title-form',
	'method' => 'post',
	'options' => [
		'enctype' => 'multipart/form-data',
	],
	'action' => Yii::$app->homeUrl . 'setting/title/save-update-title'
]); ?>
<div class="col-12 department-one mb-20" style="margin-top: 90px;">
	<div class="col-lg-9 col-md-6 col-12">
		<div class="col-12 text-primary font-size-32 font-b">
			<i class="fa fa-magic ml-5" aria-hidden="true"></i>
			Modift Title
		</div>
	</div>
	<div class="col-12 mt-40 pl-20 pr-20">
		<div class="row ">
			<div class="col-lg-6 col-md-6 col-12">
				<div class="col-12">
					<label class="form-label font-size-12 font-b">
						<span class="text-danger mr-5"><b>*</b></span>Title
					</label>
					<input type="text" name="titleName" id="titleName" class="form-control" value="<?= $title['titleName'] ?>" required>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-12">
				<div class="col-12">
					<label class="form-label font-size-12 font-b"><span class="text-danger mr-5"><b>*</b></span>Select Associate Layer</label>
					<select class="form-select" id="layer" name="layer" required>
						<option value="<?= $title['layerId'] ?>"><?= Layer::layerName($title['layerId']) ?></option>
						<option value="">Select Layer</option>
						<?php
						if (isset($layer) && count($layer) > 0) {
						?>
							<?php
							foreach ($layer as $l) : ?>
								<option value="<?= $l['layerId'] ?>"><?= $l['layerName'] ?></option>
							<?php
							endforeach; ?>

						<?php
						}
						?>
					</select>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-12">
				<div class="col-12">
					<label class="form-label font-size-12 font-b"><span class="text-danger mr-5"><b>*</b></span>Shot Tag </label>
					<input type="text" name="shortTag" id="shortTag" class="form-control" required value="<?= $title['shortTag'] ?>">
				</div>
			</div>
			<div class="col-lg-3 col-6 mt-10">
				<label class="form-label font-size-12 font-b"><span class="text-danger mr-5"><b>*</b></span>Company </label>
				<select class="form-select" id="company-team" onchange="javascript:branchCompany()" required>
					<option value="<?= $companyId ?>"><?= Company::companyName($companyId) ?></option>
					<option value="">Select Company</option>
					<?php
					if (isset($companies) && count($companies) > 0) {
					?>
						<?php
						foreach ($companies as $company) : ?>
							<option value="<?= $company['companyId'] ?>"><?= $company['companyName'] ?></option>
						<?php
						endforeach; ?>

					<?php
					}
					?>
				</select>
			</div>
			<div class="col-lg-3 col-6 mt-10">
				<label class="form-label font-size-12 font-b"><span class="text-danger mr-5"><b>*</b></span>Branch </label>
				<select class="form-select" id="branch-team" onchange="javascript:departmentBranch()" required>
					<option value="<?= $branchId ?>"><?= Branch::branchName($branchId) ?></option>
					<option value="">Select Branch</option>
					<?php
					if (isset($branches) && count($branches) > 0) {
					?>
						<?php
						foreach ($branches as $branch) : ?>
							<option value="<?= $branch['branchId'] ?>"><?= $branch['branchName'] ?></option>
						<?php
						endforeach; ?>

					<?php
					}
					?>
				</select>
			</div>
			<div class="col-lg-3 col-6 mt-10">
				<label class="form-label font-size-12 font-b"><span class="text-danger mr-5"><b>*</b></span>Department </label>
				<select class="form-select" name="departmentId" id="department-team" required onchange="javascript:addDepartmentId()">
					<option value="<?= $departmentId ?>"><?= Department::departmentNAme($departmentId) ?></option>
					<option value="">Select Department</option>
					<?php
					if (isset($departments) && count($departments) > 0) {
					?>
						<?php
						foreach ($departments as $department) : ?>
							<option value="<?= $department['departmentId'] ?>"><?= $department['departmentName'] ?></option>
						<?php
						endforeach; ?>

					<?php
					}
					?>
				</select>
			</div>
			<div class="col-12 mt-50">
				<span class="text-danger mr-5"><b>*</b></span><b>Job Description Panel</b>
				<hr>
			</div>
			<div class="col-12 mt-10">
				<label class="form-label font-size-12 font-b"><span class="text-danger mr-5"><b>*</b></span>Job Description Name</label>
				<!-- <input type="text" name="jobDescription" id="jobDescription" class="form-control" required value=""> -->
				<textarea name="jobDescription" id="jobDescription" class="form-control" style="white-space: pre-wrap;"><?= $title['jobDescription'] ?></textarea>
			</div>
			<div class="col-12 mt-10">
				<label class="form-label font-size-12 font-b">Purpose of the Job</label>
				<textarea name="purpose" id="purpose" class="form-control" style="white-space: pre-wrap;height:150px;"><?= $title['purpose'] ?></textarea>
			</div>
			<div class="col-12 mt-10">
				<label class="form-label font-size-12 font-b">Key Responsibility</label>
				<textarea name="keyResponsibility" id="keyResponsibility" class="form-control" style="white-space: pre-wrap;height:150px;"><?= $title['keyResponsibility'] ?></textarea>
			</div>
			<div class="col-12 mt-10">
				<label class="form-label font-size-12 font-b">Required Skills</label>
				<div class="col-12">
					<div class="tags-input">
						<div id="tags" class="">
							<span id="show-text">
								<?php
								$i = 1;
								if (isset($skillArr) && count($skillArr) > 0) {
									foreach ($skillArr as $skill) : ?>
										<li>
											<?= $skill ?>
											<span class="delete-button" id="<?= $i ?>" onclick="javascript:deleteTags(<?= $i ?>)">X</span>
										</li>
								<?php
										$i++;
									endforeach;
								}
								?>
							</span>
							<input type="text" id="input-tag">
						</div>
					</div>
				</div>
				<input type="hidden" id="currentId" value="<?= $i ?>">
				<div style="display:none;" id="tag-value">
					<?php
					$a = 1;
					if (isset($skillArr) && count($skillArr) > 0) {
						foreach ($skillArr as $skill) : ?>
							<input type="hidden" name="tags[]" id="tag-<?= $a ?>" value="<?= $skill ?>">
					<?php
							$a++;
						endforeach;
					}
					?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-2 col-12 pt-30 text-end pr-1 pl-0 text-end">
				<input type="hidden" name="preUrl" value="<?= $preUrl ?>">
				<input type="hidden" name="titleId" id="titleId" value="<?= $title['titleId'] ?>">
				<a href="<?= $preUrl ?>" class="btn btn-secondary" id="create-title">Cancel</a>
				<a href="javascript:checkDupplicateTitleUpdate()" class="btn btn-primary" id="create-title">Update</a>

			</div>
		</div>
	</div>

</div>
<?php ActiveForm::end(); ?>