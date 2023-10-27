<?php

use yii\bootstrap5\ActiveForm;

$this->title = 'Create Title';
$form = ActiveForm::begin([
	'id' => 'create-title',
	'method' => 'post',
	'options' => [
		'enctype' => 'multipart/form-data',
	],
	'action' => Yii::$app->homeUrl . 'setting/title/save-create-title'
]); ?>
<div class="col-12 department-one  mb-20" style="margin-top: 90px;">
	<div class="col-lg-9 col-md-6 col-12">
		<div class="col-12 text-primary font-size-32 font-b">
			<i class="fa fa-magic ml-5" aria-hidden="true"></i>
			Title Registeration
		</div>
	</div>
	<div class="col-12 mt-40 pl-20 pr-20">
		<div class="row ">
			<div class="col-lg-6 col-md-6 col-12">
				<div class="col-12">
					<label class="form-label font-size-12 font-b">
						<span class="text-danger mr-5"><b>*</b></span>Title
					</label>
					<input type="text" name="titleName" id="titleName" class="form-control" required>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-12">
				<div class="col-12">
					<label class="form-label font-size-12 font-b"><span class="text-danger mr-5"><b>*</b></span>Select Associate Layer</label>
					<select class="form-select" id="layer" name="layer" required>
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
					<input type="text" name="shortTag" id="shortTag" class="form-control" required>
				</div>
			</div>
			<div class="col-lg-3 col-6 mt-10">
				<label class="form-label font-size-12 font-b"><span class="text-danger mr-5"><b>*</b></span>Company </label>
				<select class="form-select" id="company-team" onchange="javascript:branchCompany()" required>
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
					<option value="">Select Branch</option>

				</select>
			</div>
			<div class="col-lg-3 col-6 mt-10">
				<label class="form-label font-size-12 font-b"><span class="text-danger mr-5"><b>*</b></span>Department </label>
				<select class="form-select" name="departmentId" id="department-team" required onchange="javascript:addDepartmentId()">
					<option value="">Select Department</option>

				</select>
			</div>
			<div class="col-12 mt-50">
				<span class="text-danger mr-5"><b>*</b></span><b>Job Description Panel</b>
				<hr>
			</div>
			<div class="col-12 mt-10">
				<label class="form-label font-size-12 font-b">
					<span class="text-danger mr-5"><b>*</b></span>Job Description Name</label>
				<!-- <input type="text" name="jobDescription" id="jobDescription" class="form-control" required> -->
				<textarea name="jobDescription" id="jobDescription" class="form-control" style="white-space: pre-wrap;"></textarea>
			</div>
			<div class="col-12 mt-10">
				<label class="form-label font-size-12 font-b">Purpose of the Job</label>
				<textarea name="purpose" id="purpose" class="form-control" style="white-space: pre-wrap;height:150px;"></textarea>
			</div>
			<div class="col-12 mt-10">
				<label class="form-label font-size-12 font-b">Key Responsibility</label>
				<textarea name="keyResponsibility" id="keyResponsibility" class="form-control" style="white-space: pre-wrap;height:150px;"></textarea>
			</div>
			<div class="col-12 mt-10">
				<label class="form-label font-size-12 font-b">Required Skills</label>
				<div class="col-12">
					<div class="tags-input">
						<div id="tags" class="">
							<span id="show-text"></span>
							<input type="text" id="input-tag" class="border form-control mt-10" placeholder="Add required skill(s)">
						</div>
					</div>
				</div>
				<input type="hidden" id="currentId" value="1">
				<div style="display:none;" id="tag-value"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-2 col-12 pt-30 text-end pr-1 pl-0 text-end">
				<button type="reset" class="btn btn-secondary" id="create-title">Cancel
				</button>
				<a href="javascript:checkDupplicateTitle()" class="btn btn-primary" id="create-title">Create
				</a>

			</div>
		</div>
	</div>
</div>
<?php ActiveForm::end(); ?>