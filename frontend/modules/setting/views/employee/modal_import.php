<?php

use common\models\ModelMaster;
?>
<div class="modal fade" id="import-employee-modal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content" style="width:100%;padding: 40px 40px 40px 40px;">
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
			<div class="col-12 mt-40" style="min-height:550px;">
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
								<div class="col-12 download-file-box" style="align-content: center;">
									<div class="row">
										<div class="col-7 text-start pl-20" style="align-content: center;">
											<div class=" d-flex justify-content-start">
												<img src="<?= Yii::$app->homeUrl . 'images/icons/Settings/excel.svg' ?>" alt="" class="me-2" style="margin-top: -2px;">
												<div class="text-start">
													<span class="font-size-14 font-weight-500" style="display:block;">Register Employees.CSV</span>
													<span class="font-size-12 font-weight-400" style="display:block;color:#6B7280;">1.5 KB</span>
												</div>
											</div>
										</div>
										<div class="col-5 font-size-14  text-end pr-20" style="align-content: center;">
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
					<div class=" col-lg-6 col-12 border-left hint-box">
						<div class="col-12">
							<img src="<?= Yii::$app->homeUrl . 'images/icons/Settings/hint.svg' ?>" class="me-1" style="margin-top: -2px;">
							<span class="font-size-16 font-weight-500" style="color:#30313D"><?= Yii::t('app', 'Hints') ?></span>
						</div>

						<div class="col-12 mt-15">
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
	</div>
</div>
<style>
	.hint-box {

		min-height: 190px;
		font-size: 16px;
		font-weight: 400px;
		color: #666666;
		padding-left: 30px;
		line-height: 30px;
		padding-top: 20px;
		padding-bottom: 20px;
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
		padding-left: 30px;
		padding-right: 40px;
		display: flex;
		align-items: center;
		text-align: center;

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