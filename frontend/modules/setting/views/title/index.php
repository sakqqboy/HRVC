<?php

use common\helpers\Path;
use common\models\ModelMaster;
use dosamigos\ckeditor\CKEditor;
use dosamigos\ckeditor\CKEditorInline;
use frontend\models\hrvc\Department;
use kartik\editors\Summernote;
use yii\bootstrap5\Widget;

$this->title = 'Title';
?>
<div class="col-12 department-one" style="margin-top: 90px;">
	<div class="row">
		<div class="col-lg-9 col-md-6 col-12">
			<div class="col-12 branch-title">
				Title
			</div>
		</div>

		<!-- <div class="col-lg-3 col-md-6 col-12 mt-10">
			<button type="button" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create</button>
		</div> -->
		<div class="col-lg-3 col-md-6 col-12 mt-10">
			<div class="input-group">

				<button class="btn btn-outline-secondary" type="button">Department</button>
				<select class="form-control font-size-14" id="department-filter" onchange="javascript:filterTitle()">
					<?php
					if (isset($departmentId) && $departmentId != '') { ?>
						<option value="<?= $departmentId ?>"><?= Department::departmentNAme($departmentId) ?></option>
					<?php

					} ?>
					<option value="">Search by Department</option>
					<?php
					if (isset($departments) && count($departments) > 0) {
						foreach ($departments as $department) : ?>
							<option value="<?= $department["departmentId"] ?>"><?= $department["departmentName"] ?></option>
					<?php
						endforeach;
					}
					?>
				</select>

			</div>
		</div>
	</div>
	<div class="col-12 mt-30">
		<div class="alert alert-secondary" role="alert">
			<div class="row">
				<div class="col-lg-4">
					<label class="form-label font-size-12 font-b"> Company </label>
					<select class="form-select" id="company-team" onchange="javascript:branchCompany()">
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
				<div class="col-lg-4">
					<label class="form-label font-size-12 font-b"> Branch </label>
					<select class="form-select" id="branch-team" onchange="javascript:departmentBranch()" disabled required>
						<option value="">Select Branch</option>

					</select>
				</div>
				<div class="col-lg-4">
					<label class="form-label font-size-12 font-b"> Department </label>
					<select class="form-select" id="department-team" disabled required onchange="javascript:addDepartmentId()">
						<option value="">Select Department</option>

					</select>
					<input type="hidden" id="departmentId" value="">
				</div>

			</div>
			<div class="row">
				<div class="col-12 mt-10">
					<label class="form-label font-size-12 font-b"> Job Description </label>
					<textarea name="jobDescription" id="jobDescription" class="form-control" style="white-space: pre-wrap;height:150px;"></textarea>
				</div>
				<div class="col-12 mt-10">
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12">
					<div class="col-12">
						<label class="form-label font-size-12 font-b"> Title </label>
						<input type="text" name="titleName" id="titleName" class="form-control">
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<div class="col-12">
						<label class="form-label font-size-12 font-b"> Shot Tag </label>
						<input type="text" name="shortTag" id="shortTag" class="form-control">
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<div class="col-12">
						<label class="form-label font-size-12 font-b"> Select Associate Layer</label>
						<select class="form-select" id="layer">
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

				<div class="col-lg-2 col-md-2 col-12 pt-30 text-end pr-1 pl-0 text-end">

					<a href="javascript:createTitle()" class="btn btn-success" id="create-title">
						<i class="fa fa-plus" aria-hidden="true"></i> Create
					</a>
					<a class="btn btn-sm btn-warning font-size-12 mr-5 p-2" id="update-title" style="display:none;">
						<i class="fa fa-check" aria-hidden="true"></i> Save
					</a>
					<a class="btn btn-sm btn-danger font-size-12 p-2" id="reset-title" style="display:none;">
						<i class="fa fa-times" aria-hidden="true"></i> Cancel
					</a>
					<input type="hidden" value="" id="titleId">
				</div>
			</div>
		</div>
		<div class="col-12">
			<div class="alert alert-branch" role="alert">
				<div class="row" id="all-title-list">
					<?php
					if (isset($title) && count($title) > 0) {
						foreach ($title as $t) :
					?>
							<div class="col-lg-3 col-md-5 col-sm-3 col-12" id="title-<?= $t['titleId'] ?>">
								<div class="card" style="border: none;border-radius:10px;">
									<div class="card-body">
										<div class="col-12 txt-bold ">
											<?= $t['titleName'] ?><?= $t['tShort'] != null ? '&nbsp;&nbsp;&nbsp;(' . $t['tShort'] . ')' : '' ?>
										</div>
										<div class="col-12  mt-10 font-size-13">
											<b>Layer</b> :<?= $t['layerName'] ?><?= $t['lShort'] != null ? '&nbsp;&nbsp;&nbsp;(' . $t['lShort'] . ')' : '' ?>
										</div>
										<div class="col-12  mt-10 font-size-13">
											<b>Branch</b> : <?= $t["branchName"] ?>
										</div>
										<div class="col-12  mt-10 font-size-13">
											<b>Department</b> : <?= $t["departmentName"] ?>
										</div>
										<div class="row">
											<div class="col-12 text-end pr-0 mt-15" style="margin-bottom: -10px;">

												<a href="javascript:updateTitle(<?= $t['titleId'] ?>)" class="btn btn-sm btn-outline-dark mr-5 font-size-12">
													<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
												</a>
												<a href="javascript:deleteTitle(<?= $t['titleId'] ?>)" class="btn btn-sm btn-outline-danger font-size-12">
													<i class="fa fa-trash" aria-hidden="true"></i>
												</a>
											</div>
										</div>

									</div>
								</div>
							</div>
						<?php
						endforeach;
					} else { ?>
						<div class="col-12 text-center font-b font-size-16"> Title not found.</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>