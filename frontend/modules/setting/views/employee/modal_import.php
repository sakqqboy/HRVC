<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

?>
<div class="modal fade" id="import-employee-modal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<?php
		$form = ActiveForm::begin([
			'options' => [
				'class' => 'panel panel-default form-horizontal',
				'enctype' => 'multipart/form-data',
				'id' => 'import',
			],
			'action' => Yii::$app->homeUrl . "setting/employee/import"
		]);
		?>
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
								<span class="font-size-16 font-weight-600" style="display:block;"><?= Yii::t('app', 'Step') ?> 1</span>
								<span class="font-size-14 font-weight-400" style="display:block;color:#6B7280;"><?= Yii::t('app', 'Download the Import excel file') ?></span>
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
													<span class="font-size-14 font-weight-500">Register Employees.XLSX</span><br>
													<span class="font-size-12 font-weight-400" style="color:#6B7280;">1.5 KB</span>
												</div>
											</div>
										</div>
										<div class="col-5 font-size-14  text-end pr-10" style="align-content: center;">
											<a href="<?= Yii::$app->homeUrl ?>setting/employee/export" class="download-btn" style="text-decoration: none;">
												<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/download-white.svg" class="me-1" style="width: 18px;height:18px;">
												<?= Yii::t('app', 'Download Format') ?>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="d-flex justify-content-start">
							<div class="step-number justify-content-center me-3">2</div>
							<div style="margin-top: -5px;">
								<span class="font-size-16 font-weight-600" style="display:block;">Step 2</span>
								<span class="font-size-14 font-weight-400" style="display:block;color:#6B7280;"><?= Yii::t('app', 'Upload the excel file') ?></span>
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
								4.<span class="ms-2"><?= Yii::t('app', 'Save the file as a XLS or XLSX.') ?></span>
							</div>
							<div class="col-12">
								5.<span class="ms-2"><?= Yii::t('app', 'Upload the XLS or XLSX in the second box.') ?></span>
							</div>
						</div>

					</div>

				</div>
			</div>
			<div class="col-12 mt-20 upload-zone align-content-center" id="dropZone">
				<div class="row" style="--bs-gutter-x:0 !important;">
					<div class="col-5 align-content-center">
						<div class="d-flex justify-content-center ">
							<img src="<?= Yii::$app->homeUrl . 'images/icons/Settings/drop.svg' ?>" alt="" class="me-3">
							<div class="text-start align-content-center font-size-18 font-weight-500" style="line-height:22px;color:#000000;">
								<span> <?= Yii::t('app', 'Drop') ?></span><br>
								<span> <?= Yii::t('app', 'Your Files') ?></span><br>
								<span> <?= Yii::t('app', 'Here') ?></span>
							</div>
						</div>
					</div>
					<div class="col-1 text-end font-size-16 font-weight-600 align-content-center">Or</div>
					<div class="col-6 text-center align-content-center">
						<span class="select-file-btn font-size-16" onclick="javascript:openDialog()">
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/add-file-white.svg" class="me-1" style="width: 18px;height:18px;">
							<?= Yii::t('app', 'Select File') ?>
						</span>
						<input type="file" id="employee-file" name="employeeFile">
						<div class="upload-explain text-center mt-20">
							<?= Yii::t('app', 'Open the file you downloaded in Step 1 and enter your values in the
							specified rows and columns without changing the format.
							Save the file as an <b>XLS or XLSX.</b> Please upload the file you saved after
							inputting the data to the second box to continue') ?>.
						</div>
					</div>
					<div class="col-12 d-flex justify-content-center font-size-14 font-weight-400  mt-20" style="color:#1A1A24;">
						<span style="color:#666666;">Acceptable file types: </span>.XLS or XLSX (Formatted file only)
						<span class="dot-spinner" id="spinner-container" style="display:none;">
							<div class="dot"></div>
							<div class="dot"></div>
							<div class="dot"></div>
						</span>

						<span id="fileName" style="color:#2580D3;"></span>
					</div>
				</div>
			</div>

			<div class="col-12 mt-36 text-end">
				<a class="btn-outline-red me-2 align-content-center text-center" data-bs-dismiss="modal" aria-label="Close" style="text-decoration: none;cursor:pointer">
					<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/close-red.svg" class="me-1">
					<?= Yii::t('app', 'Cancel') ?>
				</a>
				<a class="btn-upload align-content-center text-center" onclick="javascript:($('#import').submit())" style="text-decoration: none;cursor:pointer">
					<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/upload.svg" class="me-1">
					<?= Yii::t('app', 'Upload') ?>
				</a>
			</div>
		</div>
		<?php ActiveForm::end(); ?>
	</div>
</div>
<style>
	#employee-file {
		display: none;
	}

	.btn-upload {
		min-width: 100px;
		height: 40px;
		border-width: 0.5px;
		background: #2580D3;
		color: #FFFFFF;
		font-size: 16px;
		font-weight: 500;
		display: inline-block;
		border-radius: 3px;
		padding-left: 10px;
		padding-right: 10px;
	}

	.btn-outline-red {
		min-width: 100px;
		height: 40px;
		border-width: 0.5px;
		border: 0.5px solid var(--Restriction-Red, #EC1D42);
		background: #FFFFFF;
		color: #EC1D42;
		font-size: 16px;
		font-weight: 500;
		display: inline-block;
		border-radius: 3px;
		padding-left: 10px;
		padding-right: 10px;
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

	.upload-zone.dragover {
		opacity: 0.5;
	}

	.upload-explain {
		max-width: 70%;
		font-weight: 400;
		font-size: 12px;
		color: #666666;
		line-height: 15px;
		justify-self: center;
	}

	.dot-spinner {
		display: flex;
		justify-content: center;
		align-items: center;
		gap: 8px;
	}

	.dot {
		width: 12px;
		height: 12px;
		background-color: #3498db;
		border-radius: 50%;
		animation: bounce 1.4s infinite ease-in-out both;
	}

	.dot:nth-child(1) {
		animation-delay: -0.32s;
	}

	.dot:nth-child(2) {
		animation-delay: -0.16s;
	}

	.dot:nth-child(3) {
		animation-delay: 0;
	}

	@keyframes bounce {

		0%,
		80%,
		100% {
			transform: scale(0);
		}

		40% {
			transform: scale(1);
		}

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
	const fileName = document.getElementById('fileName');
	const fileInput = document.getElementById('employee-file');
	const dropZone = document.getElementById('dropZone');
	fileInput.addEventListener('change', (e) => {
		const file = fileInput.files[0];
		if (!file) return;

		const allowedExtensions = ['xls', 'xlsx'];
		const fileExtension = file.name.split('.').pop().toLowerCase();
		if (!allowedExtensions.includes(fileExtension)) {
			alert(" ❌ Acceptable file types: .XLS and .XLSX ! ! !");
			fileInput.value = ""; // เคลียร์ไฟล์ออก
			fileName.textContent = "";
			return;
		}
		if (fileInput.files.length > 0) {
			$("#spinner-container").show();
			setTimeout(() => {
				document.getElementById("spinner-container").style.display = "none";
				fileName.innerHTML = "<img src='<?= Yii::$app->homeUrl . 'images/icons/Settings/excel.svg' ?>' class='ms-2' width='16' />" + fileInput.files[0].name +
					"<img src='<?= Yii::$app->homeUrl . 'images/icons/Settings/check-success.svg' ?>' class='ms-1' width='16' />";
			}, 1000);
		}
	});

	['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
		dropZone.addEventListener(eventName, e => e.preventDefault());
		dropZone.addEventListener(eventName, e => e.stopPropagation());
	});
	dropZone.addEventListener('dragover', () => {
		dropZone.classList.add('dragover');
	});
	dropZone.addEventListener('dragleave', () => {
		dropZone.classList.remove('dragover');
	});
	dropZone.addEventListener('drop', (e) => {
		dropZone.classList.remove('dragover');
		if (e.dataTransfer.files.length > 0) {
			const file = e.dataTransfer.files[0];
			if (!file) return;

			const allowedExtensions = ['xls', 'xlsx'];
			const fileExtension = file.name.split('.').pop().toLowerCase();
			if (!allowedExtensions.includes(fileExtension)) {
				alert(" ❌ Acceptable file types: .XLS and .XLSX ! ! !");
				fileInput.value = ""; // เคลียร์ไฟล์ออก
				fileName.textContent = "";
				return;
			}
			fileInput.files = e.dataTransfer.files; // ใส่ไฟล์ลง input
			$("#spinner-container").show();
			setTimeout(() => {
				document.getElementById("spinner-container").style.display = "none";
				fileName.innerHTML = "<img src='<?= Yii::$app->homeUrl . 'images/icons/Settings/excel.svg' ?>' class='ms-2' width='16' /> " + file.name +
					"<img src='<?= Yii::$app->homeUrl . 'images/icons/Settings/check-success.svg' ?>' class='ms-1' width='16' />";
			}, 1000);
			// setTimeout(() => {
			// 	document.getElementById("spinner-container").style.display = "none";
			// 	fileName.innerHTML = "<img src='<?= Yii::$app->homeUrl . 'images/icons/Settings/excel.svg' ?>' class='ms-2' width='16' />" + e.dataTransfer.files[0].name;
			// }, 2000);

			// สามารถส่งฟอร์มได้ที่นี่ถ้าต้องการ
		}
	});
</script>