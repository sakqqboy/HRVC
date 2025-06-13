<?php

use common\models\ModelMaster;
?>
<div class="modal fade" id="import-employee-modal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content" style="width:100%;padding: 40px 40px 35px 40px;">
			<div class="col-12">
				<div class="row">
					<div class="col-7">

						<span class=" font-blue font-size-24" style="font-weight: 500;">
							<?= Yii::t('app', 'Bulk Register Employee') ?>
						</span>
					</div>
					<div class="col-5 d-flex align-items-center justify-content-end">
						<a href="javascript:void(0);" data-bs-dismiss="modal" aria-label="Close">
							<img src="<?= Yii::$app->homeUrl . 'image/modal-exit.svg' ?>" style="width: 24px; height: 24px;">
						</a>
					</div>
				</div>
			</div>
			<div class="col-12 mt-40" style="height:300px;">
				<div class="row">
					<div class="col-lg-6 col-12">
						<div class="d-flex justify-content-start">
							<div class="step-number justify-content-center me-3">1</div>
							<div style="margin-top: -5px;">
								<span class="font-size-16 font-weight-600" style="display:block;">Step 1</span>
								<span class="font-size-14 font-weight-400" style="display:block;color:#6B7280;">Download the Import excel file</span>
							</div>
						</div>

						<div class="col-12 pl-17">
							<div class="file-format">
								<div class="col-12 download-file-box  pr-0 pl-0" style="align-content: center;">
									<div class="row" style="--bs-gutter-x:0 !important;">
										<div class="col-7 text-start pl-15 align-items-center">
											<div class="d-flex justify-content-start">
												<img src="<?= Yii::$app->homeUrl . 'images/icons/Settings/excel.svg' ?>" alt="" class="me-2">
												<div class="text-start align-content-center" style="line-height:19px;">
													<span class="font-size-14 font-weight-500">Register Employees.CSV</span><br>
													<span class="font-size-12 font-weight-400" style="color:#6B7280;">1.5 KB</span>
												</div>
											</div>
										</div>
										<div class="col-5 font-size-14  text-end pr-10" style="align-content: center;">
											<span class="download-btn">
												<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/download-white.svg" class="me-1" style="width: 18px;height:18px;">
												Download Format
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="d-flex justify-content-start">
							<div class="step-number justify-content-center me-3">2</div>
							<div style="margin-top: -5px;">
								<span class="font-size-16 font-weight-600" style="display:block;">Step 2</span>
								<span class="font-size-14 font-weight-400" style="display:block;color:#6B7280;">Upload the excel file</span>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-12 pl-0 d-flex align-items-center">
						<div class="col-12 border-left hint-box">
							<div class="col-12 pl-0">
								<img src="<?= Yii::$app->homeUrl . 'images/icons/Settings/hint.svg' ?>" class="me-1" style="margin-top: -2px;margin-left:-10px;">
								<span class="font-size-16 font-weight-500" style="color:#30313D"><?= Yii::t('app', 'Hints') ?></span>
							</div>

							<div class="col-12 mt-5">
								1.<span class="ms-2"><?= Yii::t('app', 'Download the Excel file.') ?></span>
							</div>
							<div class="col-12">
								2.<span class="ms-2"><?= Yii::t('app', 'Open it and enter your values in the specified rows and columns.') ?></span>
							</div>
							<div class="col-12">
								3.<span class="ms-2"><?= Yii::t('app', 'Do not change the format.') ?></span>
							</div>
							<div class="col-12">
								4.<span class="ms-2"><?= Yii::t('app', 'Save the file as a CSV.') ?></span>
							</div>
							<div class="col-12">
								5.<span class="ms-2"><?= Yii::t('app', 'Upload the CSV in the second box.') ?></span>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="col-12 mt-20 upload-zone align-content-center">
				<div class="row" style="--bs-gutter-x:0 !important;">
					<div class="col-5 align-content-center">
						<div class="d-flex justify-content-center ">
							<img src="<?= Yii::$app->homeUrl . 'images/icons/Settings/drop.svg' ?>" alt="" class="me-3">
							<div class="text-start align-content-center font-size-18 font-weight-500" style="line-height:22px;color:#000000;">
								<span>Drop</span><br>
								<span>Your Files</span><br>
								<span>Here</span>
							</div>
						</div>
					</div>
					<div class="col-1 text-center  font-size-16 font-weight-600 align-content-center">Or</div>
					<div class="col-6 text-center align-content-center ">
						<span class="select-file-btn font-size-16">
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/add-file-white.svg" class="me-1" style="width: 18px;height:18px;">
							Select File
						</span>
						<div class="upload-explain text-center mt-20">
							Open the file you downloaded in Step 1 and enter your values in the
							specified rows and columns without changing the format.
							Save the file as an <b>CSV.</b> Please upload the file you saved after
							inputting the data to the second box to continue.
						</div>
					</div>
					<div class="col-12 text-center font-size-14 font-weight-400  mt-20" style="color:#1A1A24;">
						<span style="color:#666666;">Acceptable file types: </span>.CSV (Formatted file only)
					</div>
				</div>
			</div>
			<div class="col-12 mt-36 text-end">
				<a class="btn-outline-red me-2 align-content-center text-center" data-bs-dismiss="modal" aria-label="Close" style="text-decoration: none;cursor:pointer">
					<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/close-red.svg" class="me-1">
					<?= Yii::t('app', 'Cancel') ?>
				</a>
				<a class="btn-upload align-content-center text-center" data-bs-dismiss="modal" aria-label="Close" style="text-decoration: none;cursor:pointer">
					<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/upload.svg" class="me-1">
					<?= Yii::t('app', 'Upload') ?>
				</a>

			</div>
		</div>
	</div>
</div>
<style>
	.btn-upload {
		width: 100px;
		height: 40px;
		border-width: 0.5px;
		background: #2580D3;
		color: #FFFFFF;
		font-size: 16px;
		font-weight: 500;
		display: inline-block;
		border-radius: 3px;
	}

	.btn-outline-red {
		width: 100px;
		height: 40px;
		border-width: 0.5px;
		border: 0.5px solid var(--Restriction-Red, #EC1D42);
		background: #FFFFFF;
		color: #EC1D42;
		font-size: 16px;
		font-weight: 500;
		display: inline-block;
		border-radius: 3px;
	}

	.hint-box {

		min-height: 190px;
		font-size: 16px;
		font-weight: 400px;
		color: #666666;
		padding-left: 40px;
		padding-top: 15px;
		padding-bottom: 15px;
		line-height: 27px;
	}

	.step-number {
		width: 36px;
		height: 36px;
		display: flex;
		align-items: center;
		text-align: center;
		border-radius: 100%;
		border-width: 2px;
		background-color: var(--100-white, #FFFFFF);
		border: 2px solid var(--Primary-Blue---HRVC, #2580D3);
		box-shadow: 0px 0px 0px 4px #C5E2FF;
		color: #2580D3;
		font-size: 16px;
		font-weight: 600;

	}

	.file-format {
		border-left: 2px #BBCDDE solid;
		height: 216px;
		padding-left: 15px;
		padding-right: 25px;
		display: flex;
		align-items: center;
	}

	.download-file-box {
		height: 60px;
		border-radius: 3px;
		background-color: #EFF7FF;

	}

	.download-btn {
		background-color: #2580D3;
		color: #FFFFFF;
		font-size: 14px;
		font-weight: 500;
		text-align: center;
		height: 30px;
		border-radius: 3px;
		display: inline-block;
		min-width: 150px;
		align-content: center;
		cursor: pointer;
	}

	.select-file-btn {
		background-color: #2580D3;
		color: #FFFFFF;
		font-size: 16px;
		font-weight: 500;
		text-align: center;
		height: 33px;
		border-radius: 3px;
		display: inline-block;
		min-width: 135px;
		align-content: center;
		cursor: pointer;
	}

	.upload-zone {
		min-height: 200px;
		border-radius: 6px;
		border-width: 2px;
		border: 2.12px dashed #A6CAFC;
		background: var(--Background-Blue, #F4F6F9);
	}

	.upload-explain {
		max-width: 70%;
		font-weight: 400;
		font-size: 12px;
		color: #666666;
		line-height: 15px;
		justify-self: center;
	}
</style>
<script>
	var $baseUrl = window.location.protocol + "//" + window.location.host;
	if (window.location.host == 'localhost') {
		$baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
	} else {
		$baseUrl = window.location.protocol + "//" + window.location.host + '/';
	}
	var url = $baseUrl;
</script>