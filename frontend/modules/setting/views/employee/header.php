<?php

use common\models\ModelMaster;

if (Yii::$app->controller->action->id == 'draft' || Yii::$app->controller->action->id == 'draft-result') {
	$title = 'Employees';
} else {
	$title = 'All Employees';
}

?>
<div class="col-12">
	<div class="row mb-20">
		<div class="col-lg-6 col-12 text-start employee-profiles-header  pb-0">
			<div class="d-flex align-items-center justify-content-start gap-2">
				<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/all-employees.svg" class="mr-6" style="margin-top: -5px;">
				<?= Yii::t('app', $title) ?>
				<a href="<?= Yii::$app->homeUrl ?>setting/employee/create"
					class="<?= (Yii::$app->controller->action->id == 'draft' || Yii::$app->controller->action->id == 'draft-result') ? 'd-none' : 'd-flex' ?> align-items-center create-employee-btn justify-content-center">
					<?= Yii::t('app', 'Create New') ?>
					<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-circle.svg" class="ms-1" style="width: 18px;height:18px;margin-top:-3px;">
				</a>
				<a href="javascript:void(0);" onclick="javascript:modalImportEmployee()"
					class="<?= (Yii::$app->controller->action->id == 'draft' || Yii::$app->controller->action->id == 'draft-result') ? 'd-none' : 'd-flex' ?> align-items-center export-employee-btn justify-content-center">
					<?= Yii::t('app', 'Import Employees') ?>
					<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/export-employee.svg" class="ms-2" style="width: 18px;height:18px;margin-top:-3px;">
				</a>
			</div>
		</div>
		<div class="col-lg-6 col-12 pb-0 pl-0">
			<div class="d-flex align-items-center justify-content-end gap-2">
				<a href="<?= Yii::$app->homeUrl ?>setting/employee/draft/<?= ModelMaster::encodeParams(['companyId' => '']) ?>"
					class="<?= (Yii::$app->controller->action->id == 'draft' || Yii::$app->controller->action->id == 'draft-result') ? 'd-none' : 'd-flex' ?> align-items-center action-employee-btn justify-content-center">
					<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/draft.svg" class="me-2" style="width: 18px;height:18px;">
					<?= Yii::t('app', 'Drafts') ?> <?= $totalDraft > 0 ? '<span class="text-dark ms-1">(' . $totalDraft . ')</span>' : '' ?>

				</a>
				<span class="d-flex d-none" style="position:relative;" id="active-action">
					<a href="javascript:void(0);" onclick="javascript:showActionMultiSelect()" class="d-flex align-items-center action-employee-btn justify-content-center me-0 "
						style="z-index: 2; position:relative;">
						<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/close-circle.svg" class="me-4" style="width: 18px;height:18px;">

					</a>
					<span onclick="javascript:showActionMenu()" class="d-flex align-items-center action-employee-btn-blue justify-content-center "
						style="z-index: 3;margin-left:-30px;">
						<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/action-select.svg" class="me-2" style="width: 18px;height:18px;">
						<?= Yii::t('app', 'Actions') ?>
						<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/down.svg" class="ms-2" style="width: 18px;height:18px;">


					</span>
					<span class="action-menu d-none" style="z-index: 1;" id="action-menu">
						<div style="cursor: pointer;">
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/export-black.svg" class="me-1" style="margin-top:-2px;">
							<?= Yii::t('app', 'Export') ?>
						</div>
						<div class="mt-5" style="color: #EC1D42;cursor: pointer;" onclick="javascript:warningDeleteMultiEmployee()">
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/bin-action.svg" class="me-1" style="margin-top:-2px;">
							<?= Yii::t('app', 'Delete') ?>
						</div>
					</span>
				</span>

				<a href="javascript:void(0);" onclick="javascript:showActionMultiSelect()" class="d-flex align-items-center action-employee-btn justify-content-center" id="normal-action">
					<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/action.svg" class="me-2" style="width: 18px;height:18px;">
					<?= Yii::t('app', 'Actions') ?>

				</a>

				<a href="javascript:void(0);" class="d-flex align-items-center action-employee-btn justify-content-center">
					<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/action.svg" class="me-2" style="width: 18px;height:18px;">
					<?= Yii::t('app', 'Export All') ?>


				</a>

				<span class="d-flex align-items-center view-employee-gray justify-content-center">
					<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" class="me-2" style="width: 18px;height:18px;">
					<span class="font-size-16 font-weight-600 d-none" id="show-page-fill" style="color:#30313D;">
						<input type="number" id="per-page" value=''
							style="width:25px;height:25px;" class="no-spinner text-center mr-5" onkeyup="javascript:newSearchEmployee(event)">/
					</span>

					<span class="font-size-16 font-weight-600" id="actualShow"
						style="color:#30313D;cursor: pointer;z-index:100;" onclick="javascript:showFillPage()"><?= $actualShow ?> /
					</span>
					<span class="font-size-16 font-weight-600" style="color:#8A8A8A;"><?= $totalEmployee ?></span>

				</span>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="perPage" value="<?= $actualShow ?>">
<input type="hidden" id="action" value="0">
<input type="hidden" id="action-menu" value="0">
<?= $this->render('modal_import') ?>
<style>
	.no-spinner::-webkit-outer-spin-button,
	.no-spinner::-webkit-inner-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}

	/* Firefox */
	/* .no-spinner {
		-moz-appearance: textfield;
	} */
</style>