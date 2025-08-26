<?php

use common\models\ModelMaster;

$this->title = "Title";
?>
<div class="background-main-whilte mid-center">
    <div class="mid-center max-background"
        style="
padding: 30px; gap: 7.721px; flex-shrink: 0;border-radius: 7.721px;border: 1.544px dashed var(--Stroke-Bluish-Gray, #BBCDDE);background: #F9F9F9;">
        <img src="<?= Yii::$app->homeUrl . 'image/no-group.svg' ?>">
        <span class="name-sub-tokyo">
            <?= Yii::t('app', 'Let’s create first title under departments') ?></span>
        <span class="name-full-tokyo text-center" style="width: 513px;">
            <?= Yii::t('app', 'Titles help you define roles and organize your team within departments. Start by adding a title to get your structure in place.') ?><br>
        </span>
        <a href="<?= Yii::$app->homeUrl ?>setting/title/create/<?= ModelMaster::encodeParams(["companyId" => '' , "branchId" => '', "departmentId" => $departmentId ]) ?>"
            class="btn-create-branch" style="text-decoration: none;">
            <?= Yii::t('app', 'Create a Title') ?>
            <img src="<?= Yii::$app->homeUrl ?>image/create-plus.svg" class="ml-3" style="width: 18px; height: 18px;">
        </a>
    </div>
</div>