<?php

use common\models\ModelMaster;
?>
<div class="container-body submain-background mid-center">
    <div class="mid-center max-background"
        style="height: 780px;
padding: 30px; gap: 7.721px; flex-shrink: 0;border-radius: 7.721px;border: 1.544px dashed var(--Stroke-Bluish-Gray, #BBCDDE);background: #F9F9F9;">
        <img src="<?= Yii::$app->homeUrl . 'image/no-group.svg' ?>">
        <span class="title-create-text">
            <?= Yii::t('app', 'Add a company to begin setting up your system!') ?></span>
        <span class="body-create-text">
            <?= Yii::t('app', 'All companies will be part of the group, and branches will be linked to their respective companies.') ?>
        </span>
        <a href="<?= Yii::$app->homeUrl ?>setting/company/create/<?= ModelMaster::encodeParams(['groupId' => $groupId]) ?>"
            class="btn-update-group" style="width: 10%;">
            <?= Yii::t('app', 'Create The Group') ?>
            <img src="<?= Yii::$app->homeUrl . 'images/icons/Settings/plus.svg' ?>">
        </a>
    </div>
</div>