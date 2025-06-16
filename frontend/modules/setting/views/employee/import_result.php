<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Status;
use yii\bootstrap5\ActiveForm;
use yii\web\View;

$this->title = 'Import Employee Result';
?>
<div class="col-12 mt-70 pt-20">
	<div class="col-12 pr-15 pl-15">
		<div class="col-12">
			<div class="row mb-20">
				<div class="col-12 text-start employee-profiles-header  pb-0">
					<div class="d-flex align-items-center justify-content-start gap-2">
						<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/all-employees.svg" class="mr-6" style="margin-top: -5px;">
						<?= Yii::t('app', 'Import Employees') ?>

					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="col-12 mt-25 pr-15 pl-15">
		<div class="bg-white-employee">
			<div class="row mb-15">
				<div class="col-6 text-start employee-profiles pt-0  pb-0">
					<div class="d-flex justify-content-start align-items-center  gap-2">
						<?= Yii::t('app', 'Imported Data Confirmation') ?>
					</div>
					<div class="font-size-14 font-weight-400" style="margin-top:-2px;color: #94989C;">Imported <?= count($dataLine) ?> new entries.</div>
				</div>
				<div class="col-6 text-end employee-profiles pt-0 pb-0 align-content-center">
					<a href="<?= Yii::$app->homeUrl ?>setting/employee/index/<?= ModelMaster::encodeParams(['import' => 1]) ?>"
						class="btn-outline-back me-2 align-content-center text-center" style="text-decoration: none;cursor:pointer">
						<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/close-circle.svg" class="me-1" style="width:14px;height:14px;margin-top:-2px;">
						<?= Yii::t('app', 'Cancel') ?>
					</a>
					<?php
					if ($isError == 0) {
					?>
						<a href="javascript:submitData()" class="btn-accept-import align-content-center text-center" style="text-decoration: none;cursor:pointer">
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/editwhite.svg" class="me-1" style="width:14px;height:14px;margin-top:-2px;">
							<?= Yii::t('app', 'Accept') ?>
						</a>
					<?php
					}
					?>
				</div>
			</div>
			<div class="row d-flex" style="--bs-gutter-x:0 !important;">
				<table class="employee-table">
					<tr class="employee-header-table">
						<th class="boder-table-radius-left text-center" style="width:25%;"><span class="ms-2"><?= Yii::t('app', "Employee's Name") ?></span></th>
						<th style="width: 15%;"><?= Yii::t('app', "Designature") ?></th>
						<th style="width: 20%;"><?= Yii::t('app', "Company") ?></th>
						<th style="width: 15%;"><?= Yii::t('app', "Branch") ?></th>
						<th style="width: 15%;"><?= Yii::t('app', "Department") ?></th>
						<th class="boder-table-radius-right" style="width: 10%;"><?= Yii::t('app', "Team") ?></th>
					</tr>
					<?php
					if (isset($dataLine) && count($dataLine) > 0) {
						foreach ($dataLine as $line => $da) :
					?>
							<tr class="tr-space"></tr>
							<?php if ($da["lineError"] == 1 || count($da["dupeFields"]) > 0 || $da["isExisting"] == 1) { ?>
								<tr class="employee-tr">
									<td colspan="6" class="pl-0 pr-0" style="border:0px !important;">
										<div class="col-12 justify-content-start div-red" style="height:48px;">
											<span class="line-error me-2">Error in row <?= $line + 1 ?></span>
											<?php
											if ($da["isExisting"] == 0) {
												if ($da["lineError"] == 1) {
											?>
													<span class="text-danger me-2">Please check the required informatioin !</span>
												<?php
												}
												if (count($da["dupeFields"]) > 0) { ?>
													<span class="text-danger">Your data contains duplicates in the fields: <?= implode(', ', $da["dupeFields"]) ?>. Please correct these issues to continue.</span>
												<?php
												}
											} else { ?>
												<span class="text-danger me-2"><?= $da["employeeName"] ?> This name already exists in the database.</span>
											<?php
											}
											?>
										</div>
									</td>
								</tr>
							<?php
							} else { ?>
								<tr class="employee-tr">
									<td style="font-weight: 600;border:0px !important;font-size:14px;" class="pl-0 pr-0">
										<div class="col-12 border-left-radius-table" style="height:48px;">
											<img src="<?= Yii::$app->homeUrl ?>images/employee/profile/employee-no-image.svg" class="img-table me-2">
											<?php if ($da["errorCol0"] == '' && $da["errorCol1"] == '') {
												echo $da["employeeName"];
											} else { ?>
												<span class="missing-input">Missing</span>
											<?php	} ?>
											<?= $da["employeeName"] ?>
										</div>
									</td>

									<td><?= $da["errorCol14"] == '' ? $da["titleName"] : '<span class="missing-input">' . $da["errorCol14"] . '</span>' ?></td>
									<td><?= $da["errorCol9"] == '' ? $da["companyName"] : '<span class="missing-input">' . $da["errorCol9"] . '</span>' ?></td>
									<td><?= $da["errorCol10"] == '' ? $da["branchName"] : '<span class="missing-input">' . $da["errorCol10"] . '</span>' ?></td>
									<td><?= $da["errorCol11"] == '' ? $da["departmentName"] : '<span class="missing-input">' . $da["errorCol11"] . '</span>' ?></td>
									<td style="border:0px !important;" class="pl-0 pr-0">
										<div class="col-12 border-right-radius-table" style="height:48px;">
											<?= $da["errorCol12"] == '' ? $da["teamName"] : '<span class="missing-input">' . $da["errorCol12"] . '</span>' ?>
										</div>
									</td>
								</tr>
							<?php } ?>


					<?php
						endforeach;
					}
					?>



				</table>
			</div>
		</div>
	</div>
</div>
<?php
$form = ActiveForm::begin([
	'options' => [
		'class' => 'panel panel-default form-horizontal',
		'enctype' => 'multipart/form-data',
		'id' => 'import-employee',
	],
	'action' => Yii::$app->homeUrl . "setting/employee/save-import"
]);
?>
<?php ActiveForm::end(); ?>
<style>
	.employee-profiles-header {
		font-weight: 600;
		font-size: 24px;
		line-height: 21.43px;
		letter-spacing: 0%;
		vertical-align: middle;

	}

	.missing-input {
		background-color: #FFF4F4;
		color: #E05757;
		font-size: 12px;
		font-weight: 500;
		padding: 4px 6px 4px 6px;
		border-radius: 4px;

	}

	.line-error {
		background-color: #DC3545;
		color: #FFFFFF;
		font-size: 14px;
		font-weight: 500;
		padding: 4px 6px 4px 6px;
		border-radius: 4px;
	}

	.bg-white-employee {
		background-color: white;
		border-radius: 10px;
		border: 1px solid #BBCDDE;
		height: 100%;
		padding: 27px 20px 32px 20px;
	}

	.employee-profiles {
		font-size: 20px;
		font-weight: 600;
	}

	.border-left-radius-table {
		border-left: 1px solid var(--Color-Tokens-Border-Primary, #E4E4E4);
		border-top: 0.5px solid var(--Color-Tokens-Border-Primary, #E4E4E4);
		border-bottom: 0.5px solid var(--Color-Tokens-Border-Primary, #E4E4E4);
		border-bottom-left-radius: 6px;
		border-top-left-radius: 6px;
		z-index: 10;
		padding-left: 8px;
		position: absolute;
		top: -0.2px;
		display: flex;
		align-items: center;
	}

	.border-right-radius-table {
		border-right: 1px solid var(--Color-Tokens-Border-Primary, #E4E4E4);
		border-top: 0.5px solid var(--Color-Tokens-Border-Primary, #E4E4E4);
		border-bottom: 0.5px solid var(--Color-Tokens-Border-Primary, #E4E4E4);
		border-bottom-right-radius: 6px;
		border-top-right-radius: 6px;
		z-index: 10;
		position: absolute;
		top: -0.2px;
		display: flex;
		align-items: center;
	}

	.div-red {
		border: 1px solid var(--Color-Tokens-Border-Primary, #DC3545);
		border-radius: 6px;
		z-index: 10;
		position: absolute;
		display: flex;
		align-items: center;
		position: relative;
		background-color: #FFF4F4;
		padding-left: 8px;
	}




	.employee-table {
		font-size: 14px;
		font-weight: 400;
	}

	.employee-table td {
		padding-top: 0px;
		padding-bottom: 0px;
		border-top: 0.5px solid var(--Color-Tokens-Border-Primary, #E4E4E4);
		border-bottom: 0.5px solid var(--Color-Tokens-Border-Primary, #E4E4E4);
	}

	.employee-header-table {
		height: 45px;
		border-radius: 4px;
		background-color: #E4E4E4;
		color: #727272;
	}

	.employee-header-table th {
		font-size: 14px;
		font-weight: 600;
	}

	.employee-tr {
		height: 47px;
		background-color: #FFFFFF;
		padding-top: 0px;
		padding-bottom: 0px;
		padding-left: 0px;
		padding-right: 0px;
	}

	.tr-space {
		height: 12px;
	}

	.img-table {
		width: 26px;
		height: 26px;
		border-radius: 100%;

	}


	.boder-table-radius-left {
		border: 0.86px;
		border-bottom-left-radius: 4px;
		border-top-left-radius: 4px;
	}

	.boder-table-radius-right {
		border: 0.86px;
		border-bottom-right-radius: 4px;
		border-top-right-radius: 4px;
	}

	.btn-accept-import {
		width: 82px;
		height: 30px;
		border-width: 0.5px;
		background: #2580D3;
		color: #FFFFFF;
		font-size: 14px;
		font-weight: 500;
		display: inline-block;
		border-radius: 3px;
	}

	.btn-outline-back {
		width: 82px;
		height: 30px;
		border-width: 0.5px;
		border: 0.5px solid var(--Restriction-Red, #30313D);
		background: #FFFFFF;
		color: #30313D;
		font-size: 14px;
		font-weight: 500;
		display: inline-block;
		border-radius: 3px;
	}
</style>
<?php
$this->registerJs('
 
	function submitData(){
	$("#import-employee).submit();
	}
				
', View::POS_END);
?>