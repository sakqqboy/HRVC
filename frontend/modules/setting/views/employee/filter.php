<?php
		use common\models\ModelMaster;
		use frontend\models\hrvc\Branch;
		use frontend\models\hrvc\Company;
		use frontend\models\hrvc\Department;
		use frontend\models\hrvc\Status;
		use frontend\models\hrvc\Team;
		// echo $branchId;
?>
<div class="d-flex justify-content-end align-items-center  gap-2">
	<select class="select-pim form-select" id="company-team" onchange="branchCompany()"> 
		<?php if ($companyId != '') { ?>
			<option value="<?= $companyId ?>" selected>
				<?= Company::findOne($companyId)->companyName ?>
			</option>
		<?php } ?>

		<option value="" disabled <?= empty($companyId) ? 'selected' : '' ?> hidden
			style="color: var(--Helper-Text, #8A8A8A);">
			<?= Yii::t('app', 'Company') ?>
		</option>

		<option value="">
			<?= Yii::t('app', 'All') ?>
		</option>

		<?php if (isset($companies) && count($companies) > 0) {
			foreach ($companies as $company) : ?>
				<option value="<?= $company['companyId'] ?>"><?= $company['companyName'] ?></option>
		<?php endforeach;
		} ?>
	</select>

	<select class="select-pim form-select" id="branch-team" onchange="javascript:departmentBranch()" <?= $branchId == '' ? 'disabled' : '' ?>>
		<?php
		if ($branchId != '') { ?>
			<option value="<?= $branchId ?>"><?= Branch::findOne($branchId)->branchName ?></option>
		<?php
		} ?>
		<option value="" disabled <?= empty($branchId) ? 'selected' : '' ?> hidden
			style="color: var(--Helper-Text, #8A8A8A);">
			<?= Yii::t('app', 'Branch') ?>
		</option>

		<option value="">
			<?= Yii::t('app', 'All') ?>
		</option>
		<?php
		if (count($branches) > 0) {
			foreach ($branches as $branch) : ?>
				<option value="<?= $branch['branchId'] ?>"><?= $branch["branchName"] ?></option>
		<?php
			endforeach;
		}
		?>
	</select>
	<select class="select-pim form-select" id="department-team" onchange="javascript:teamDepartment()" <?= $departmentId == '' ? 'disabled' : '' ?>>
		<?php
		if ($departmentId != '') { ?>
			<option value="<?= $departmentId ?>"><?= Department::findOne($departmentId)->departmentName ?></option>
		<?php
		}
		?>
		<option value="" disabled <?= empty($departmentId) ? 'selected' : '' ?> hidden
			style="color: var(--Helper-Text, #8A8A8A);">
			<?= Yii::t('app', 'Department') ?>
		</option>

		<option value="">
			<?= Yii::t('app', 'All') ?>
		</option>
		<?php
		if (count($departments) > 0) {
			foreach ($departments as $department) : ?>
				<option value="<?= $department['departmentId'] ?>"><?= $department["departmentName"] ?></option>
		<?php
			endforeach;
		}
		?>
	</select>
	<select class="select-pim form-select" id="team-department" <?= $teamId == '' ? 'disabled' : '' ?>>
		<?php
		if ($teamId != '') { ?>
			<option value="<?= $teamId ?>"><?= Team::findOne($teamId)->teamName ?></option>
		<?php
		}
		?>
		<option value="" disabled <?= empty($teamId) ? 'selected' : '' ?> hidden
			style="color: var(--Helper-Text, #8A8A8A);">
			<?= Yii::t('app', 'Team') ?>
		</option>

		<option value="" >
			<?= Yii::t('app', 'All') ?>
		</option>
		<?php
		if (count($teams) > 0) {
			foreach ($teams as $team) : ?>

				<option value="<?= $team['teamId'] ?>"><?= $team["teamName"] ?></option>
		<?php
			endforeach;
		}
		?>
	</select>
	<?php
	if (Yii::$app->controller->action->id == "draft" || Yii::$app->controller->action->id == "draft-result") {
		$url = 'filter-draft';
		$showStatus = 'd-none';
	} else {
		$url = 'filter-employee';
		$showStatus = '';
	}
	?>
	<select class="select-pim form-select  <?= $showStatus ?>" id="status">
		<?php
		if ($status != '') { ?>
			<option value="<?= $status ?>"><?= (isset($status) && $status != null) ? Status::findOne($status)->statusName : 'Not Set' ?></option>
		<?php
		}
		?>
		<option value=""><?= Yii::t('app', 'Status') ?>
			<?php
			if (count($statusTexArr) > 0) {
				foreach ($statusTexArr as $statusId => $status): ?>
		<option value="<?= $statusId ?>"><?= Yii::t('app', $status["statusName"]) ?>
	<?php
				endforeach;
			}
	?>

	</select>
	<input type="hidden" value="<?= $url ?>" id="url-redirect">
	<span class="justify-content-center d-flex align-items-center employee-filter-btn" style="cursor: pointer;" onclick="javascrip:filterEmployee()">
		<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterWhite.svg" class="pim-search-icons me-1">
		Filter
	</span>

	<div class="btn-group <?= (Yii::$app->controller->action->id == 'draft' || Yii::$app->controller->action->id == 'draft-result') ? 'd-none' : '' ?>" role="group">
		<?php
		if ($page == 'grid') { ?>
			<a href="#" class="btn btn-primary font-size-12 pim-change-modes">
				<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/gridwhite.svg" style="cursor: pointer; margin-top:2px;">
			</a>
			<a href="<?= Yii::$app->homeUrl ?>setting/employee/employee-list/<?= ModelMaster::encodeParams(['companyId' => '']) ?>"
				class="btn btn-outline-primary font-size-12 pim-change-modes" style="border-color: #CBD5E1 !important;">
				<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/listblack.svg" style="cursor: pointer; margin-top:2px;">
			</a>
		<?php
		} else { ?>
			<a href="<?= Yii::$app->homeUrl ?>setting/employee/index/<?= ModelMaster::encodeParams(['companyId' => '']) ?>"
				class="btn btn-outline-primary font-size-12 pim-change-modes" style="border-color: #CBD5E1 !important;">
				<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/gridblack.svg" style="cursor: pointer; margin-top:2px;">
			</a>
			<a href="#" class="btn btn-primary font-size-12 pim-change-modes">
				<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/listwhite.svg" style="cursor: pointer; margin-top:2px;">
			</a>
		<?php
		}
		?>
	</div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // เช็คค่า PHP $companyId
    let companyId = "<?= $companyId ?>"; // แปลง PHP เป็น string
 	let branchId = "<?= $branchId ?>"; // แปลง PHP เป็น string
 	let departmentId = "<?= $departmentId ?>"; // แปลง PHP เป็น string

	// alert(companyId);
    if (companyId !== "" && companyId !== null) {
		$("#branch-team").removeAttr("disabled", "true");
		// alert(companyId);
        // branchCompany();
    }
	if (branchId !== "" && branchId !== null) {
		$("#department-team").removeAttr("disabled", "true");
		// alert(branchId);
        // departmentBranch();
    }
	if (departmentId !== "" && departmentId !== null) {
		$("#team-department").removeAttr("disabled", "true");
		// alert(departmentId);
        // teamDepartment();
    }
});
</script>