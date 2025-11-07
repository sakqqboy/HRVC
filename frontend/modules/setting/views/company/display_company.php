<?php

use common\models\ModelMaster;

$this->title = "Company";

?>
<div class="col-12 mt-60 pt-10 bg-white">
    <div class="mid-center empty-information">
        <img src="<?= Yii::$app->homeUrl . 'image/no-group.svg' ?>">
        <span class="title-create-text">
            <?= Yii::t('app', 'Add a company to begin setting up your system!') ?></span>
        <span class="body-create-text">
            <?= Yii::t('app', 'All companies will be part of the group, and branches will be linked to their respective companies.') ?>
        </span>
        <a href="<?= Yii::$app->homeUrl ?>setting/company/create/<?= ModelMaster::encodeParams(['groupId' => $groupId]) ?>" class="create-employee-btn" style="min-width: 180px;font-size:14px;">
            <?= Yii::t('app', 'Create The Company') ?>
            <img src="<?= Yii::$app->homeUrl . 'images/icons/Settings/plus.svg' ?>" class="ml-5">
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