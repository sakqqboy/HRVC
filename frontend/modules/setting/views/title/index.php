<?php

use common\helpers\Path;
use common\models\ModelMaster;
use dosamigos\ckeditor\CKEditor;
use dosamigos\ckeditor\CKEditorInline;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Department;
use kartik\editors\Summernote;
use yii\bootstrap5\Widget;

$this->title = 'Title';
?>
<div class="col-12 department-one" style="margin-top: 90px;">

	<div class="col-lg-9 col-md-6 col-12">
		<div class="col-12 branch-title">
			Title
		</div>
	</div>
	<div class="col-12 mt-20 layer-link pl-40 pt-10 pb-10">
		<div class="row">
			<div class="col-lg-2 col-3 link-item">
				<a href="<?= Yii::$app->homeUrl ?>setting/layer/index" class="no-underline-black ">
					<i class="fa fa-bars mr-2" aria-hidden="true"></i>
					Management Layer
				</a>
			</div>
			<div class="col-lg-2 col-3 link-item-active">
				<i class="fa fa-list-ul mr-2" aria-hidden="true"></i>
				Title
			</div>
		</div>
	</div>
	<div class="row  mt-20">
		<div class="col-3 pl-20">
			<b class="mr-10">Title</b>
			<span class="font-size-12">
				<a href="<?= Yii::$app->homeUrl ?>setting/title/create/" class="btn btn-primary btn-sm mr-5">
					<i class="fa fa-magic" aria-hidden="true"></i> Register
				</a>
				<a href="<?= Yii::$app->homeUrl ?>setting/title/import" class="btn btn-secondary btn-sm">
					<i class="fa fa-upload mr-5" aria-hidden="true"></i> Import
				</a>
			</span>
		</div>
		<div class="col-lg-3 col-md-4 col-12">
			<div class="input-group">
				<button class="btn btn-secondary" type="button">Company</button>
				<select class="form-control font-size-14" id="company-team" onchange="javascript:branchCompany()">
					<?php
					if (isset($companyId) && $companyId != "") { ?>
						<option value="<?= $companyId ?>"><?= Company::companyName($companyId) ?></option>
					<?php

					}
					?>
					<option value="">All Company</option>
					<?php
					if (isset($companies) && count($companies) > 0) {

						foreach ($companies as $company) : ?>
							<option value="<?= $company['companyId'] ?>"><?= $company['companyName'] ?></option>
					<?php
						endforeach;
					}
					?>
				</select>
			</div>
		</div>
		<div class="col-lg-3 col-md-4 col-12">
			<div class="input-group">
				<button class="btn btn-secondary" type="button">Branch</button>
				<select class="form-select font-size-14" id="branch-team" onchange="javascript:departmentBranch()">
					<?php
					if (isset($branchId) && $branchId != "") { ?>
						<option value="<?= $branchId ?>"><?= Branch::branchName($branchId) ?></option>
					<?php

					}
					?>
					<option value="">All Branch</option>
					<?php
					if (isset($branches) && count($branches) > 0) {
						foreach ($branches as $branch) : ?>
							<option value="<?= $branch['branchId'] ?>"><?= $branch['branchName'] ?></option>
					<?php
						endforeach;
					}
					?>
				</select>
			</div>
		</div>
		<div class="col-lg-3 col-md-4 col-12">
			<div class="input-group">
				<button class="btn btn-secondary" type="button">Department</button>
				<select class="form-select font-size-14" id="department-team">
					<?php
					if (isset($departmentId) && $departmentId != "") { ?>
						<option value="<?= $departmentId ?>"><?= Department::departmentNAme($departmentId) ?></option>
					<?php

					}
					?>
					<option value="">All Department</option>
					<?php
					if (isset($departments) && count($departments) > 0) {
						foreach ($departments as $department) : ?>
							<option value="<?= $department['departmentId'] ?>"><?= $department['departmentName'] ?></option>
					<?php
						endforeach;
					}
					?>
				</select>
				<button type="button" class="btn btn-outline-dark" onclick="javascrip:filterTitle()">
					<i class="fa fa-filter" aria-hidden="true"></i>
				</button>
			</div>
		</div>

	</div>
	<div class="col-12 mt-20">
		<div class="col-12">
			<div class="alert alert-layer" role="alert">
				<input type="hidden" id="preUrl" name="preUrl" value="">
				<div class="row" id="all-title-list">
					<?php
					if (isset($title) && count($title) > 0) {
						foreach ($title as $t) :
					?>
							<div class="col-lg-6 col-md-6 col-12 mt-10" id="title-<?= $t['titleId'] ?>">
								<div class="title-box" style="border: none;border-radius:10px;">
									<div class="col-12">
										<div class="col-12 text-end pr-0">
											<a href="<?= Yii::$app->homeUrl ?>setting/title/update-title/<?= ModelMaster::encodeParams(['titleId' => $t['titleId']]) ?>" class="btn btn-sm btn-outline-dark mr-5 font-size-12">
												<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
											</a>
											<a href="javascript:deleteTitle(<?= $t['titleId'] ?>)" class="btn btn-sm btn-outline-danger font-size-12">
												<i class="fa fa-trash" aria-hidden="true"></i>
											</a>
											<input type="hidden" id="redirect" value="0">
										</div>

									</div>
									<div class="row" style="margin-top: -25px;">
										<div class="col-5">

											<div class="col-12 font-size-14 font-b">
												<?= $t['titleName'] ?><?= $t['tShort'] != null ? '&nbsp;&nbsp;<span class="badge rounded-pill bg-primary">&nbsp;&nbsp;' . $t['tShort'] . '&nbsp;&nbsp;</span>'  : '' ?>
											</div>
											<div class="row mt-20">
												<div class="col-5 font-size-12">
													<b>Layer : </b>
												</div>
												<div class="col-7 font-size-10">
													<?= $t['layerName'] ?> <?= $t['lShort'] != null ? ' (' . $t['lShort'] . ')' : '' ?>
												</div>
												<div class="col-5 font-size-12 mt-7">
													<b>Branch : </b>
												</div>
												<div class="col-7 font-size-10 mt-7">
													<?php
													$flag = Branch::branchFlag($t["branchId"]);
													if ($flag != "") { ?>
														<img src="<?= Yii::$app->homeUrl . $flag ?>" class="card-round mr-5">
													<?php
													}
													?>
													<?= $t["branchName"] ?>
												</div>
												<div class="col-5 font-size-12 mt-7">
													<b>Department : </b>
												</div>
												<div class="col-7 font-size-10 mt-7">
													<?= $t["departmentName"] ?>
												</div>
											</div>
										</div>
										<div class="col-7">
											<div class="col-12 font-size-14 font-b pl-20">
												Job Description
											</div>
											<div class="col-12 mt-20 font-size-12 title-description-box pl-20">
												<?= substr($t["jobDescription"], 0, 190) ?><?= strlen($t["jobDescription"]) > 190 ? '...' : '' ?>
											</div>
										</div>
									</div>
									<div class="col-12 text-end font-size-12" style="font-weight: 500;">
										<a href="<?= Yii::$app->homeUrl ?>setting/title/title-detail/<?= ModelMaster::encodeParams(['titleId' => $t['titleId']]) ?>" class="no-underline text-primary">
											View More
										</a>
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