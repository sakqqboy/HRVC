<div class="d-flex justify-content-end align-items-center  gap-2">
	<select class="select-pim form-select font-size-12" id="company-team" onchange="javascript:branchCompany()">
		<?php

		use common\models\ModelMaster;
		use frontend\models\hrvc\Branch;
		use frontend\models\hrvc\Company;
		use frontend\models\hrvc\Department;
		use frontend\models\hrvc\Status;
		use frontend\models\hrvc\Team;

		if ($companyId != '') { ?>
			<option value="<?= $companyId ?>"><?= Company::findOne($companyId)->companyName ?></option>
		<?php
		}
		?>
		<option value=""><?= Yii::t('app', 'Company') ?></option>
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
	<select class="select-pim form-select font-size-12" id="branch-team" onchange="javascript:departmentBranch()" <?= $branchId == '' ? 'disabled' : '' ?>>
		<?php
		if ($branchId != '') { ?>
			<option value="<?= $branchId ?>"><?= Branch::findOne($branchId)->branchName ?></option>
		<?php
		} ?>
		<option value=""><?= Yii::t('app', 'Branch') ?></option>
		<?php
		if (count($branches) > 0) {
			foreach ($branches as $branch) : ?>
				<option value="<?= $branch['branchId'] ?>"><?= $branch["branchName"] ?></option>
		<?php
			endforeach;
		}
		?>
	</select>
	<select class="select-pim form-select font-size-12" id="department-team" onchange="javascript:teamDepartment()" <?= $departmentId == '' ? 'disabled' : '' ?>>
		<?php
		if ($departmentId != '') { ?>
			<option value="<?= $departmentId ?>"><?= Department::findOne($departmentId)->departmentName ?></option>
		<?php
		}
		?>
		<option value=""><?= Yii::t('app', 'Department') ?></option>
		<?php
		if (count($departments) > 0) {
			foreach ($departments as $department) : ?>
				<option value="<?= $department['departmentId'] ?>"><?= $department["departmentName"] ?></option>
		<?php
			endforeach;
		}
		?>
	</select>
	<select class="select-pim form-select font-size-12" id="team-department" <?= $teamId == '' ? 'disabled' : '' ?>>
		<?php
		if ($teamId != '') { ?>
			<option value="<?= $teamId ?>"><?= Team::findOne($teamId)->teamName ?></option>
		<?php
		}
		?>
		<option value=""><?= Yii::t('app', 'Team') ?></option>
		<?php
		if (count($teams) > 0) {
			foreach ($teams as $team) : ?>

				<option value="<?= $team['teamId'] ?>"><?= $team["teamName"] ?></option>
		<?php
			endforeach;
		}
		?>
	</select>
	<select class="select-pim form-select font-size-12" id="status">
		<?php
		if ($status != '') { ?>
			<option value="<?= $status ?>"><?= Status::findOne($status)->statusName ?></option>
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
	<span class="justify-content-center d-flex align-items-center employee-filter-btn" style="cursor: pointer;" onclick="javascrip:filterEmployee()">
		<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterWhite.svg" class="pim-search-icons me-1">
		Filter
	</span>

	<div class="btn-group <?= Yii::$app->controller->action->id == 'draft' ? 'd-none' : '' ?>" role="group">
		<?php if ($page == 'grid') { ?>
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