<div class="d-flex justify-content-end align-items-center  gap-2">
	<select class="select-pim form-select font-size-12" id="company-team" onchange="javascript:branchCompany()">
		<option value="">Company</option>
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
	<select class="select-pim form-select font-size-12" id="branch-team" onchange="javascript:departmentBranch()" disabled>
		<option value=""><?= Yii::t('app', 'Branch') ?>
	</select>
	<select class="select-pim form-select font-size-12" id="department-team" onchange="javascript:teamDepartment()" disabled>
		<option value=""><?= Yii::t('app', 'Department') ?>
	</select>
	<select class="select-pim form-select font-size-12" id="team-department" disabled>
		<option value=""><?= Yii::t('app', 'Team') ?>
	</select>
	<select class="select-pim form-select font-size-12" id="employee-status">
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
		<img src="/HRVC/frontend/web/images/icons/Dark/48px/FilterWhite.svg" class="pim-search-icons me-1">
		Filter
	</span>

	<div class="btn-group" role="group">
		<a href="#" class="btn btn-primary font-size-12 pim-change-modes">
			<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/gridwhite.svg" style="cursor: pointer;">
		</a>
		<a href="<?= Yii::$app->homeUrl . 'setting/branch/index' ?>"
			class="btn btn-outline-primary font-size-12 pim-change-modes" style="border-color: #CBD5E1 !important;">
			<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/listblack.svg" style="cursor: pointer;">
		</a>
	</div>
</div>