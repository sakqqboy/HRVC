<?php

use common\models\ModelMaster;

$this->title = "Branch";
?>
<div class="col-12 mt-60 pt-10 bg-white">
    <div class="mid-center empty-information">
        <img src="<?= Yii::$app->homeUrl . 'image/no-group.svg' ?>">
        <span class="name-sub-tokyo">
            <?= Yii::t('app', 'Looks like we don’t have any branches created yet') ?></span>
        <span class="name-full-tokyo text-center">
            <?= Yii::t('app', 'Get started by creating your first branch, Branches help you manage different') ?><br>
            <?= Yii::t('app', 'locations or offices within your organization.') ?>
        </span>
        <a href="<?= Yii::$app->homeUrl ?>setting/branch/create/<?= ModelMaster::encodeParams(["companyId" => $companyId]) ?>"
            class="create-employee-btn" style="min-width: 180px;font-size:14px;">
            <?= Yii::t('app', 'Create a Branch') ?>
            <img src="<?= Yii::$app->homeUrl ?>image/create-plus.svg" class="ml-5" style="width: 18px; height: 18px;">
        </a>
    </div>
</div>
<style>
    .submain-content {
        width: 100%;
        max-width: 100%;
        padding-left: 30px;
        padding-right: 30px;
        min-height: 100vh;
        background-color: white;
    }
</style>