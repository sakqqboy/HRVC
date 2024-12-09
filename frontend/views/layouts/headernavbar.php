<?php

use common\models\ModelMaster;
use frontend\models\hrvc\User;
?>
div.
<div class="col-12 bg-white text-end header-top">
    <div class="row">
        <div class="col-6"> </div>
        <div class="col-6">
            <div class="row">
                <div class="col-6 header-name">
                    <?= isset(Yii::$app->user->id) ? User::userHeaderName() : 'Login' ?>
                    <div class="header-pepartment text-end">
                        <?= isset(Yii::$app->user->id) ? User::employeeTitleDepartment() : '' ?>
                    </div>
                </div>
                <div class="col-2 pl-10">
                    <div class="profile-dropdown">
                        <div class="row">
                            <div class="col-6 text-start">
                                <img src="<?= Yii::$app->homeUrl ?><?= isset(Yii::$app->user->id) ? User::userHeaderImage() : 'image/user.png' ?>" class="width-ehsan-small">
                            </div>
                            <div class="col-5 profile-arrow-menu" onclick="javascript:showMenu()">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/down-blue.svg" style="width: 7.8px;height:11.7px;">
                            </div>
                        </div>
                    </div>
                    <div class="profile-box-menu text-start" id="profileMenu">
                        <?php
                        if (isset(Yii::$app->user->id)) {
                            $employeeId = User::employeeIdFromUserId(); ?>
                            <a href="<?= Yii::$app->homeUrl ?>setting/employee/employee-profile/<?= ModelMaster::encodeParams(["employeeId" => $employeeId]) ?>"
                                style="text-decoration:none;color:#30313D;">
                                <div class="col-12 pl-0">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/navbar/profile.svg" class="mr-12 profile-menu-icon">
                                    My Profile
                                </div>
                            </a>
                        <?php
                        }
                        ?>
                        <div class="col-12 pl-0 mt-22">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/navbar/setting.svg" class="mr-12 profile-menu-icon">
                            Setting
                        </div>
                        <div class="col-12 pl-0 mt-22">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/navbar/help.svg" class="mr-12 profile-menu-icon">
                            Help & Support
                        </div>
                        <div class="col-12 pl-0 mt-22 border-top pt-22">
                            <a href="<?= Yii::$app->homeUrl ?>site/logout" class="" style="text-decoration:none;color:#FFFFFF;">
                                <div class="logout-button text-center">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/navbar/logout.svg" class="mr-13 profile-menu-icon">
                                    Logout
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-2 text-end pl-0">
                    <div class="language-dropdown">
                        <div class="row">
                            <div class="col-5 text-start">
                                <img src="<?= Yii::$app->homeUrl ?>images/flag/usa.svg" class="width-ehsan-small">
                            </div>
                            <div class="col-6 profile-arrow-menu pr-0 pl-0">
                                <span class="language-text">EN</span>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/down-blue.svg" style="width: 7.8px;height:11.7px;margin-top:-5px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-2 text-end">
                    <div class="profile-dropdown">
                        <div class="row">
                            <div class="col-5 text-start pt-4 pl-15">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/no-noti.svg" class="bell-noti">
                            </div>
                            <div class="col-6 profile-arrow-menu">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/down-blue.svg" style="width: 7.8px;height:11.7px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>