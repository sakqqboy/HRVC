<?php
$this->title = "Group";
?>
<div class="col-12 mt-60 pt-10 bg-white">
    <div class="mid-center empty-information">
        <img src="<?= Yii::$app->homeUrl . 'image/no-group.svg' ?>">
        <span class="title-create-text">
            <?= Yii::t('app', 'Welcome! Set up your group information to get started.') ?></span>
        <span class="body-create-text">
            <?= Yii::t('app', 'Click "Group Configuration" to set up the system. All companies will be part of the group,
             and branches will be linked to their respective companies.') ?>
        </span>
        <a href="<?= Yii::$app->homeUrl ?>setting/group/create-group" class="create-employee-btn" style="min-width: 150px;font-size:14px;">
            <?= Yii::t('app', 'Create The Group') ?>
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