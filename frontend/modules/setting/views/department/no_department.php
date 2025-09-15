<?php

use common\models\ModelMaster;

$this->title = "Branch";
?>
<div class="background-main-whilte mid-center">
    <div class="mid-center max-background"
        style="
padding: 30px; gap: 7.721px; flex-shrink: 0;border-radius: 7.721px;border: 1.544px dashed var(--Stroke-Bluish-Gray, #BBCDDE);background: #F9F9F9; min-height: 800px;">
        <img src="<?= Yii::$app->homeUrl . 'image/no-group.svg' ?>">
        <span class="name-sub-tokyo">
            <?= Yii::t('app', 'No Department has been Created yet') ?></span>
        <span class="name-full-tokyo text-center" style="width: 513px;">
            <?= Yii::t('app', 'Departments help you categorize and manage your team members effectively, Start organizing your team by adding a department.') ?><br>
        </span>
        <a href="<?= Yii::$app->homeUrl ?>setting/department/create/<?= ModelMaster::encodeParams(["companyId" => '',"branchId" => $branchId ]) ?>"
            class="btn-create-branch" style="text-decoration: none;">
            <?= Yii::t('app', 'Create a Department') ?>
            <img src="<?= Yii::$app->homeUrl ?>image/no-employee.svg" class="ml-3" style="width: 18px; height: 18px;">
        </a>
    </div>
</div>