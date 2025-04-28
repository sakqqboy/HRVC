<?php

use common\models\ModelMaster;

$this->title = 'company profile';
?>

<div class="contrainer-body mt-33" style="padding-bottom: 31px; ">

    <div class="col-12">
        <div class=" d-flex align-items-center gap-2">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/company.svg" style="width: 24px; height: 24px;">
            <div class="pim-name-title ml-10">
                Branch in Details
            </div>
        </div>
    </div>

    <div class="company-group-edit mt-30">
        <div style="display: flex; align-items: center; gap: 14px;">
            <a href="<?= Yii::$app->request->referrer ?: Yii::$app->homeUrl ?>"
                style="text-decoration: none; width:66px; height:26px;" class="btn-create-branch">
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/back-white.svg"
                    style="width:18px; height:18px; margin-top:-3px;">
                Back
            </a>

            <div style="display: flex; align-items: center;">
                <a class="part-text mr-3" href="<?= Yii::$app->homeUrl ?>setting/group/display-group">Group Config</a>
                <div class="mid-center" style="width: 20px; height: 20px;">
                    <text class="squeezer-text mr-3"> / </text>
                </div>
                <a class="part-text mr-3"
                    href="<?= Yii::$app->homeUrl ?>setting/branch/no-branch/<?= ModelMaster::encodeParams(['companyId' => '']) ?>">Branch</a>
                <div class="mid-center" style="width: 20px; height: 20px;">
                    <text class="squeezer-text mr-3"> / </text>
                </div>
                <span class="pim-unit-text"><?= $branches['branchName'] ?></span>
            </div>
        </div>

        <div class="row group-details mt-40">
            <div style="display: flex;
                    align-items: center;
                    gap: 29px;
                    align-self: stretch;
                    ">
                <div class="avatar-preview">
                    <?php if ($branches["branchImage"] != null) { ?>
                    <img src="<?= Yii::$app->homeUrl . $branches['branchImage'] ?>" class="cycle-big-image">
                    <?php } else { ?>
                    <img src="<?= Yii::$app->homeUrl . 'image/userProfile.png' ?>" class="cycle-big-image">
                    <?php } ?>
                </div>
                <div class="column">
                    <span class="font-size-20" style="font-weight: 600;">
                        <?= $branches['branchName'] ?>
                    </span>
                    <div class="column">
                        <span class="font-size-16 text-gray-back"
                            style="font-weight: 500; display: flex; align-items: center; gap: 12px;">
                            Associated Company
                            <div class="city-crad-company">
                                <?= $company['companyName'] ?>
                            </div>
                        </span>
                        <span class=" font-size-16 text-gray-back"
                            style="font-weight: 500; display: flex; align-items: center; gap: 12px;">
                            Located in
                            <div class="city-crad-company">
                                <?= $company['city'] ?>
                            </div>
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>