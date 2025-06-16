<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Status;
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
	<div class="col-12 mt-20 pr-15 pl-15">
		<div class="bg-white-employee">
			<div class="row mb-40">
				<div class="col-6 text-start employee-profiles  pb-0">
					<div class="d-flex justify-content-start align-items-center  gap-2">
						<?= Yii::t('app', 'Imported Data Confirmation') ?>
					</div>
					<span class="font-size-14 font-weight-400" style="color: #94989C;">Imported <?= count($dataLine) ?> new entries.</span>
				</div>
				<div class="col-6 text-start employee-profiles  pb-0">

				</div>

			</div>
			<div class="row d-flex">
				<table class="employee-table">

					<tr class="employee-header-table">
						<th class="boder-table-radius-left"><span class="ms-2"><?= Yii::t('app', "Employee's Name") ?></span></th>
						<th><?= Yii::t('app', "Email") ?></th>
						<th><?= Yii::t('app', "Designature") ?></th>
						<th><?= Yii::t('app', "Company") ?></th>
						<th><?= Yii::t('app', "Branch") ?></th>
						<th><?= Yii::t('app', "Department") ?></th>
						<th><?= Yii::t('app', "Team") ?></th>
						<th><?= Yii::t('app', "Gender") ?></th>
						<th class="boder-table-radius-right"></th>
					</tr>
					<?php
					if (isset($dataLine) && count($dataLine) > 0) {
						foreach ($dataLine as $line => $da) :

							if ($da["lineError"] == 1 || count($da["dupeFields"]) > 0) {
								$trClass = "employee-tr-red";
								$tdLeft = "border-left-radius-table-red";
								$tdRight = "border-right-radius-table-red";
							} else {
								$trClass = "employee-tr";
								$tdLeft = "border-left-radius-table";
								$tdRight = "border-right-radius-table";
							}
					?>
							<tr class="tr-space"></tr>
							<?php if ($da["lineError"] == 1 || count($da["dupeFields"]) > 0) { ?>
								<tr class="<?= $trClass ?>">
									<td colspan="9" class="pl-0 pr-0">
										<div class="justify-content-start <?= $tdLeft ?> <?= $tdRight ?>" style="height:48px;">
											<span class="line-error me-2">Error in row <?= $line + 1 ?></span>
											<?php
											if ($da["lineError"] == 1) {
											?>
												<span class="text-danger me-2">Please check the required informatioin !</span>
											<?php
											}
											if (count($da["dupeFields"]) > 0) { ?>
												<span class="text-danger">Your data contains duplicates in the fields: <?= implode(', ', $da["dupeFields"]) ?>. Please correct these issues to continue.</span>
											<?php
											}
											?>
										</div>
									</td>
								</tr>
							<?php
							} else { ?>
								<tr class="<?= $trClass ?>">
									<td style="font-weight: 600;position: relative; width:15%;">
										<div class="col-12 <?= $tdLeft ?>" style="height:48px;">
											<img src="<?= Yii::$app->homeUrl ?>images/employee/profile/employee-no-image.svg" class="img-table me-2">
											<?php if ($da["errorCol0"] == '' && $da["errorCol1"] == '') {
												echo $da["employeeName"];
											} else { ?>
												<span class="missing-input">Missing</span>
											<?php	} ?>
											<?= $da["employeeName"] ?>
										</div>
									</td>
									<td style="width: 10%;"><?= $da["errorCol3"] == '' ? $da["email"] : '<span class="missing-input">' . $da["errorCol3"] . '</span>' ?></td>
									<td style="width: 10%;"><?= $da["errorCol14"] == '' ? $da["titleName"] : '<span class="missing-input">' . $da["errorCol14"] . '</span>' ?></td>
									<td style="width: 15%;"><?= $da["errorCol9"] == '' ? $da["companyName"] : '<span class="missing-input">' . $da["errorCol9"] . '</span>' ?></td>
									<td style="width: 15%;"><?= $da["errorCol10"] == '' ? $da["branchName"] : '<span class="missing-input">' . $da["errorCol10"] . '</span>' ?></td>
									<td style="width: 15%;"><?= $da["errorCol11"] == '' ? $da["departmentName"] : '<span class="missing-input">' . $da["errorCol11"] . '</span>' ?></td>
									<td style="width: 15%;"><?= $da["errorCol12"] == '' ? $da["teamName"] : '<span class="missing-input">' . $da["errorCol12"] . '</span>' ?></td>
									<td style="width: 5%;"><?= $da["errorCol6"] == '' ? $da["gender"] : '<span class="missing-input">' . $da["errorCol6"] . '</span>' ?></td>
									<td style="font-weight: 600;position: relative;width: 5%;">
										<div class="col-12<?= $tdRight ?>" style="height:48px;">

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
		border-bottom-left-radius: 6px;
		border-top-left-radius: 6px;
		z-index: 10;
		padding-left: 8px;
		margin-left: -4px;
		position: absolute;
		top: -1px;
		display: flex;
		align-items: center;
	}

	.border-left-radius-table-red {
		border-left: 1px solid var(--Color-Tokens-Border-Primary, #DC3545);
		border-bottom-left-radius: 4px;
		border-top-left-radius: 4px;
		z-index: 10;
		padding-left: 8px;
		position: absolute;
		/* top: -1px; */
		display: flex;
		align-items: center;
		width: 100.3%;
		position: relative;
		margin-left: -2px;
	}

	.border-right-radius-table {
		border-right: 1px solid var(--Color-Tokens-Border-Primary, #E4E4E4);
		border-bottom-right-radius: 6px;
		border-top-right-radius: 6px;
		z-index: 10;
		margin-right: -8px;
		position: absolute;
		top: -1px;
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.border-right-radius-table-red {
		border-right: 1px solid var(--Color-Tokens-Border-Primary, #DC3545);
		border-bottom-right-radius: 6px;
		border-top-right-radius: 6px;
	}

	.employee-table {
		font-size: 14px;
		font-weight: 400;
	}

	.employee-table td {
		padding-top: 0px;
		padding-bottom: 0px;
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
		border-top: 0.5px solid var(--Color-Tokens-Border-Primary, #E4E4E4);
		border-bottom: 0.5px solid var(--Color-Tokens-Border-Primary, #E4E4E4);
		padding-top: 0px;
		padding-bottom: 0px;
	}

	.employee-tr-red {
		height: 47px;
		background-color: #FFF4F4;
		border-top: 0.5px solid var(--Color-Tokens-Border-Primary, #DC3545);
		border-bottom: 0.5px solid var(--Color-Tokens-Border-Primary, #DC3545);
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
</style>