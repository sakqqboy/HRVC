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
                                <img src="<?= Yii::$app->homeUrl ?><?= isset(Yii::$app->user->id) ? User::userHeaderImage() : 'image/user.png' ?>" class="width-ehsan-small" id="showMenu2">
                            </div>
                            <div class="col-5 profile-arrow-menu">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/down-blue.svg" style="width: 7.8px;height:11.7px;" id="showMenu">
                            </div>
                        </div>
                    </div>
                    <div class="profile-box-menu text-start profile-menu" id="profileMenu">
                        <?php
                        if (isset(Yii::$app->user->id)) {
                            $employeeId = User::employeeIdFromUserId(); ?>
                            <a href="<?= Yii::$app->homeUrl ?>setting/employee/employee-profile/<?= ModelMaster::encodeParams(["employeeId" => $employeeId]) ?>"
                                style="text-decoration:none;color:#30313D;">
                                <div class="col-12  head-list-menu">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/navbar/profile.svg" class="mr-12 profile-menu-icon">
                                    My Profile
                                </div>
                            </a>
                        <?php
                        }
                        ?>
                        <div class="col-12  head-list-menu">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/navbar/setting.svg" class="mr-12 profile-menu-icon">
                            Setting
                        </div>
                        <div class="col-12  head-list-menu">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/navbar/help.svg" class="mr-12 profile-menu-icon">
                            Help & Support
                        </div>
                        <div class="col-12 mt-22 pt-22 pl-22 pr-22">
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
                                <img src="<?= Yii::$app->homeUrl ?>images/flag/usa.svg" class="width-ehsan-small" id="showCountryMenu">
                            </div>
                            <div class="col-6 profile-arrow-menu pr-0 pl-0">
                                <span class="language-text" id="showCountryMenu3">EN</span>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/down-blue.svg" style="width: 7.8px;height:11.7px;margin-top:-5px;" id="showCountryMenu2">
                            </div>
                        </div>
                    </div>
                    <div class="country-box-menu text-start" id="countryMenu">

                        <a href="<?= Yii::$app->homeUrl ?>" style="text-decoration:none;color:#30313D;">
                            <div class="col-12  head-list-menu">
                                <img src="<?= Yii::$app->homeUrl ?>images/flag/japan.svg" class="mr-12 profile-menu-icon">
                                日本語
                            </div>
                        </a>
                        <a href="?language=en-US" style="text-decoration:none;color:#30313D;">
                            <div class="col-12 head-list-menu">
                                <img src="<?= Yii::$app->homeUrl ?>images/flag/usa.svg" class="mr-12 profile-menu-icon">
                                EN
                            </div>
                        </a>
                        <a href="?language=th" style="text-decoration:none;color:#30313D;">
                            <div class="col-12 head-list-menu">
                                <img src="<?= Yii::$app->homeUrl ?>images/flag/thailand.svg" class="mr-12 profile-menu-icon">
                                ไทย
                            </div>
                        </a>
                        <a href="?language=cn" style="text-decoration:none;color:#30313D;">
                            <div class="col-12 head-list-menu">
                                <img src="<?= Yii::$app->homeUrl ?>images/flag/china.svg" class="mr-12 profile-menu-icon">
                                中文
                            </div>
                        </a>
                        <a href="?language=vt" style="text-decoration:none;color:#30313D;">
                            <div class="col-12 head-list-menu">
                                <img src="<?= Yii::$app->homeUrl ?>images/flag/vietnam.svg" class="mr-12 profile-menu-icon">
                                Tiếng Việt
                            </div>
                        </a>
                        <a href="?language=es" style="text-decoration:none;color:#30313D;">
                            <div class="col-12 head-list-menu" style="border-bottom-left-radius: 10px;border-bottom-right-radius: 10px;">
                                <img src="<?= Yii::$app->homeUrl ?>images/flag/bahasa.svg" class="mr-12 profile-menu-icon">
                                Bahasa
                            </div>
                        </a>
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