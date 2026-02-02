<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = Yii::t('app', 'Assign KFI');
?>
<div class="col-12 mt-70 pt-20 pim-content1">
    <div class="d-flex justify-content-start pt-0 pb-0" style="line-height: 30px;">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Group23177.svg"
            class="pim-head-icon mr-11 mt-2">
        <span class="pim-head-text mr-10"> <?= Yii::t('app', 'Performance Indicator Matrices') ?> (PIM)</span>
    </div>
    <?= $this->render('header_filter', [
        "role" => $role,
        "allCompany" => $allCompany,
        "companyPic" => $companyPic,
        "totalBranch" => $totalBranch,
        "page" => 'grid'
    ]) ?>


    <?php
    $form = ActiveForm::begin([
        'id' => 'update-kfi-team-employee',
        'method' => 'post',
        'options' => [
            'enctype' => 'multipart/form-data',
        ],
        'action' => Yii::$app->homeUrl . 'kfi/management/update-team-kfi'

    ]); ?>
    <div class="col-12 mt-20" id="box-wrapper">
        <div class="bg-white-employee" id="pim-content">
            <div class="row" style="--bs-gutter-x:10px;">
                <div class="col-6 text-truncate pim-name-title" style="display: flex; align-items: center; gap: 14px;">
                    <!-- <a href="<?= $url ?>" class="font-size-12 mr-10" style="text-decoration: none;">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/back.svg" class="mr-3"
                            style="margin-top: -4px;">
                        <text class="pim-text-back">
                            <?= Yii::t('app', 'Back') ?>
                        </text>
                    </a> -->
                    <a href="<?= $url ?>" style="text-decoration: none; width:66px; height:26px;" class="btn-create-branch">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/back-white.svg" style="width:18px; height:18px; margin-top:-3px;">
                        <?= Yii::t('app', 'Back') ?>
                    </a>
                    <input type="hidden" id="url" name="url" value="<?= $url ?>">
                    <?= $kfiDetail["kfiName"] ?>
                </div>
                <div class="col-6 text-end">
                    <button class="btn-create font-size-12 ml-10" style="text-decoration: none;" type="submit">
                        <div class="ml-7 mr-7" style="gap: 5px;">
                            <img src="<?= Yii::$app->homeUrl ?>image/save-whiet.svg"
                                style="width:15px;margin-top:-3px;">
                            <?= Yii::t('app', 'Save') ?>
                        </div>
                    </button>
                </div>
            </div>
            <div class="col-12 ligth-gray-box mb-10 mt-10">
                <div class="col-12 bg-white pl-10 pr-10 pt-5 pb-5 mt-8 mb-10 font-size-12">
                    <b><?= Yii::t('app', 'Assign Individuals') ?></b>
                </div>
                <div class="col-12 pr-0 pl-0" id="team-employee-target">
                    <?= $this->render('employee_team', [
                        "kfiTeamEmployee" => $kfiTeamEmployee,
                    ])
                    ?>
                </div>

            </div>
        </div>
    </div>
    <input type="hidden" name="kfiId" value="<?= $kfiId ?>">
    <input type="hidden" name="companyId" value="<?= $companyId ?>">
    <input type="hidden" name="month" value="<?= $kfiDetail['month'] ?>">
    <input type="hidden" name="year" value="<?= $kfiDetail['year'] ?>">
    <?php ActiveForm::end(); ?>
</div>