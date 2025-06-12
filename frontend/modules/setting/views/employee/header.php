<div class="col-12">
	<div class="row mb-20">
		<div class="col-lg-6 col-12 text-start employee-profiles-header  pb-0">
			<div class="d-flex align-items-center justify-content-start gap-2">
				<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/all-employees.svg" class="mr-6" style="margin-top: -5px;">
				<?= Yii::t('app', 'All Employees') ?>
				<a href="<?= Yii::$app->homeUrl ?>setting/employee/create" class="d-flex align-items-center create-employee-btn justify-content-center">
					Create New
					<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-circle.svg" class="ms-1" style="width: 18px;height:18px;">
				</a>
				<a href="<?= Yii::$app->homeUrl ?>setting/employee/import" class="d-flex align-items-center export-employee-btn justify-content-center">
					Import Employees
					<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/export-employee.svg" class="ms-2" style="width: 18px;height:18px;">
				</a>
			</div>
		</div>
		<div class="col-lg-6 col-12 pb-0 pl-0">
			<div class="d-flex align-items-center justify-content-end gap-2">
				<a href="" class="d-flex align-items-center action-employee-btn justify-content-center">
					<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/draft.svg" class="me-2" style="width: 18px;height:18px;">
					Drafts

				</a>
				<span class="d-flex d-none" style="position:relative;" id="active-action">
					<a href="#" onclick="javascript:showAction()" class="d-flex align-items-center action-employee-btn justify-content-center me-0 "
						style="z-index: 2; position:relative;">
						<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/close-circle.svg" class="me-4" style="width: 18px;height:18px;">

					</a>
					<span onclick="javascript:showActionMenu()" class="d-flex align-items-center action-employee-btn-blue justify-content-center "
						style="z-index: 3;margin-left:-30px;">
						<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/action-select.svg" class="me-2" style="width: 18px;height:18px;">
						Actions
						<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/down.svg" class="ms-2" style="width: 18px;height:18px;">


					</span>
					<span class="action-menu d-none" style="z-index: 1;" id="action-menu">
						<div style="cursor: pointer;">
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/export-black.svg" class="me-1" style="margin-top:-2px;">
							Export
						</div>
						<div class="mt-5" style="color: #EC1D42;cursor: pointer;" onclick="javascript:warningDeleteMultiEmployee()">
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/bin-action.svg" class="me-1" style="margin-top:-2px;">
							Delete
						</div>
					</span>
				</span>

				<a href="#" onclick="javascript:showAction()" class="d-flex align-items-center action-employee-btn justify-content-center" id="normal-action">
					<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/action.svg" class="me-2" style="width: 18px;height:18px;">
					Actions

				</a>

				<a href="" class="d-flex align-items-center action-employee-btn justify-content-center">
					<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/action.svg" class="me-2" style="width: 18px;height:18px;">
					Export All


				</a>

				<a href="" class="d-flex align-items-center view-employee-gray justify-content-center">
					<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" class="me-2" style="width: 18px;height:18px;">
					<span class="font-size-16 font-weight-600" style="color:#30313D;">40 /</span>
					<span class="font-size-16 font-weight-600" style="color:#8A8A8A;">123</span>

				</a>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="action" value="0">
<input type="hidden" id="action-menu" value="0">