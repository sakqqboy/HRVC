<?php

use common\models\ModelMaster;

$this->title = "Branch";
?>
<div class="container-body submain-background mid-center">
	<div class="mid-center max-background"
		style="height: 780px;
padding: 30px; gap: 7.721px; flex-shrink: 0;border-radius: 7.721px;border: 1.544px dashed var(--Stroke-Bluish-Gray, #BBCDDE);background: #F9F9F9;">
		<img src="<?= Yii::$app->homeUrl . 'image/no-group.svg' ?>">
		<span class="name-sub-tokyo">
			<?= Yii::t('app', 'Looks like we don’t have any branches created yet') ?></span>
		<span class="name-full-tokyo text-center">
			<?= Yii::t('app', 'Get started by creating your first branch, Branches help you manage different') ?><br>
			<?= Yii::t('app', 'locations or offices within your organization.') ?>
		</span>
		<a href="<?= Yii::$app->homeUrl ?>setting/branch/create/<?= ModelMaster::encodeParams(["companyId" => $companyId]) ?>"
			class="btn-create-branch" style="text-decoration: none;">
			<?= Yii::t('app', 'Create a Branch') ?>
			<img src="<?= Yii::$app->homeUrl ?>image/create-plus.svg" class="ml-3" style="width: 18px; height: 18px;">
		</a>
	</div>
</div>