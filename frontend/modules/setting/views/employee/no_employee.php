<?php

use common\models\ModelMaster;

$this->title = "Branch";
?>
<div class="container-body submain-background mid-center">
    <div class="mid-center max-background"
        style="height: 780px;
padding: 30px; gap: 7.721px; flex-shrink: 0;border-radius: 7.721px;border: 1.544px dashed var(--Stroke-Bluish-Gray, #BBCDDE);background: #F9F9F9;">
        <img src="<?= Yii::$app->homeUrl . 'image/no-employee.svg' ?>">
        <span class="name-sub-tokyo">
            <?= Yii::t('app', 'An email has been sent to the employee’s inbox') ?></span>
        <span class="name-full-tokyo text-center" style="width: 513px;">
            <?= Yii::t('app', 'Departments help you categorize and manage your team members effectively, Start organizing your team by adding a department.') ?><br>
        </span>
        <a href="<?= Yii::$app->homeUrl ?>setting/employee/create/<?= ModelMaster::encodeParams(["companyId" => '',"branchId" => '' ]) ?>"
            class="btn-create-branch" style="text-decoration: none;">
            <?= Yii::t('app', 'Create an Employee') ?>
            <img src="<?= Yii::$app->homeUrl ?>image/create-plus.svg" class="ml-3" style="width: 18px; height: 18px;">
        </a>
    </div>
</div>