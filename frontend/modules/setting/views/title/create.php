<?php

use yii\bootstrap5\ActiveForm;

$this->title = 'Create Title';
$form = ActiveForm::begin([
	'id' => 'create-title',
	'method' => 'post',
	'options' => [
		'enctype' => 'multipart/form-data',
	],
	'action' => Yii::$app->homeUrl . 'setting/title/save-create-title'
]); ?>
<div class="company-group-body">
    <div class="contrainer-body">
        <div class="col-12">
            <div class=" d-flex align-items-center gap-2">
                <a href="" style="text-decoration: none; width:66px; height:26px;" class="btn-create-branch">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/back-white.svg"
                        style="width:18px; height:18px; margin-top:-3px;">
                    Back </a>
                <div class="pim-name-title ml-10">
                    Create Title
                </div>
            </div>
        </div>

        <div class="row update-group-body mt-20">
            <div class="col-3">
                <span class="font-size-18 font-weight-600 ">Associated Group</span>
                <div class="d-flex mb-20 mt-19" style="align-items: center; gap: 29px; align-self: stretch;">
                    <div class="avatar-preview">
                        <img src="<?= Yii::$app->homeUrl ?>images/branch/profile/Tp-bPC6u8a.png"
                            class="cycle-big-image">
                    </div>
                    <div class="start-center">
                        <span class="font-size-20 font-weight-500">
                            Thailand consulting
                        </span>
                        <div class="col-12 font-size-14 tokyo-small">
                            <img src="<?= Yii::$app->homeUrl ?>image/hyphen.svg">
                            What we give is What we get.
                        </div>
                    </div>
                </div>
                <span class="font-gray font-size-14 font-weight-400 ">
                    All the titles created here will be associated with the Tokyo Consulting Group and it’s subsidiaries
                    based on departments of each branch
                </span>
            </div>
            <div class="col-9">

            </div>
            <div class="col-12 mt-54">
                <label class="form-label font-size-16 font-weight-600 font-b">
                    Title’s Job Description <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                        data-toggle="tooltip" data-placement="top" aria-label="Select to Company"
                        data-bs-original-title="Select to Company">
                </label>
                <hr class="hr-group">

                <div class="row" style="gap: 22px;">
                    <div class="row">
                        <label class="form-gro font-size-16 font-weight-600 font-b mb-12">
                            Purpose of The Job <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                data-toggle="tooltip" data-placement="top" aria-label="Select to Company"
                                data-bs-original-title="Select to Company">
                        </label>
                        <textarea class=" form-control " style="height: 115px;"
                            placeholder="Write the purpose of the job for this title"></textarea>
                    </div>
                    <div class="row">
                        <label class="form-label font-size-16 font-weight-600 font-b mb-12">
                            Purpose of The Job <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                data-toggle="tooltip" data-placement="top" aria-label="Select to Company"
                                data-bs-original-title="Select to Company">
                        </label>
                        <textarea class=" form-control " style="height: 115px;"
                            placeholder="Core Responsibility"></textarea>
                    </div>
                    <div class="row">
                        <label class="form-label font-size-16 font-weight-600 font-b mb-12">
                            Purpose of The Job <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                data-toggle="tooltip" data-placement="top" aria-label="Select to Company"
                                data-bs-original-title="Select to Company">
                        </label>
                        <textarea class=" form-control " style="height: 115px;"
                            placeholder="Key Responsibility"></textarea>
                    </div>
                </div>

                <div class="col-12 text-end mt-22">
                    <input type="hidden" id="branchId" value="">
                    <a href="<?= Yii::$app->homeUrl ?>setting/group/create-group" style="text-decoration: none;">
                        <button type="button" class="btn-cancel-group"
                            action="<?= Yii::$app->homeUrl ?>setting/group/create-group">
                            Cancel </button>
                    </a>

                    <button type="submit" class="btn-save-group">
                        Create <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg" alt="LinkedIn"
                            style="width: 20px; height: 20px;">
                    </button>
                </div>

            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>