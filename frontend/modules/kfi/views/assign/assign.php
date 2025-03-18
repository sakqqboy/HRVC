<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'Assign KFI';
?>
<div class="contrainer-body">
    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.png" class="home-icon mr-5"
            style="margin-top: -3px;">
        <strong class="pim-head-text"> <?= Yii::t('app', 'Performance Indicator Matrices (PIM)') ?></strong>
    </div>
    <div class="col-12 mt-10">
        <?= $this->render('header_filter', [
			"role" => $role
		]) ?>
    </div>
    <?php
	$form = ActiveForm::begin([
		'id' => 'update-kfi-team-employee',
		'method' => 'post',
		'options' => [
			'enctype' => 'multipart/form-data',
		],
		'action' => Yii::$app->homeUrl . 'kfi/management/update-team-kfi'

	]); ?>
    <div class="alert mt-10 pim-body bg-white">
        <div class="row">
            <div class="font-size-12 pim-name pr-0 pl-5 text-start">
                <a href="<?= $url ?>" class="mr-10 font-size-12" style="text-decoration: none;">
                    <!-- <i class="fa fa-caret-left mr-3" aria-hidden="true"></i> -->
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/back.svg">
                    <text class="pim-text-back">
                        <?= Yii::t('app', 'Back') ?>
                    </text>
                </a>
                <input type="hidden" id="url" name="url" value="<?= $url ?>">
                <span class="pim-name-title">
                    <?= $kfiDetail["kfiName"] ?>
                </span>
                <button class="btn-create font-size-12 ml-10" style="text-decoration: none;" type="submit">
                    <div class="ml-7 mr-7" style="gap: 5px;">
                        <img src="<?= Yii::$app->homeUrl ?>image/save-whiet.svg" style="width:15px;margin-top:-3px;">
                        <?= Yii::t('app', 'Save') ?>
                    </div>
                </button>
            </div>
        </div>
        <div class="col-12 ligth-gray-box mb-10 mt-7">
            <div class="col-12 bg-white pl-8 pr-8 mt-8 mb-10">
                <div class="row">
                    <div class="col-5 font-size-12 pt-5 pb-3"><b><?= Yii::t('app', 'Assign Individuals') ?></b></div>
                    <div class="col-4 font-size-12 pt-5 pb-3"><b>
                            <!-- <?= Yii::t('app', 'Title') ?> -->
                        </b></div>
                </div>
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
<?php ActiveForm::end(); ?>
</div>