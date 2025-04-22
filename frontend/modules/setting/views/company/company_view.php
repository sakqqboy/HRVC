<?php

use common\models\ModelMaster;

$this->title = 'company profile';
?>

<div class="contrainer-body mt-33" style="padding-bottom: 31px; ">

    <div class="col-12">
        <div class=" d-flex align-items-center gap-2">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/company.svg" style="width: 24px; height: 24px;">
            <div class="pim-name-title ml-10">
                Company in Details
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
                <a class="part-text mr-3" href="<?= Yii::$app->homeUrl ?>setting/company/display-company">Company</a>
                <div class="mid-center" style="width: 20px; height: 20px;">
                    <text class="squeezer-text mr-3"> / </text>
                </div>
                <span class="pim-unit-text"><?= $company['companyName'] ?></span>
            </div>
        </div>

        <div class="col-12 banner-uploade mt-21" style="border: none;">
            <?php
		if ($company["banner"] != null) { ?>
            <img src="<?= Yii::$app->homeUrl . $company['banner'] ?>" class="sad-1">
            <?php
		} else { ?>
            <img src="<?= Yii::$app->homeUrl . 'image/company.jpg' ?>" class="sad-1">
            <?php
		}
		?>
        </div>

        <div class="row mt-40">
            <div class="col-lg-2" style="margin-top:-80px;">
                <div class="avatar-upload" style="margin-left:80px;">
                    <div class="avatar-preview">
                        <?php
					if ($company["picture"] != null) { ?>
                        <img src="<?= Yii::$app->homeUrl . $company['picture'] ?>" class="company-group-picture">
                        <?php
					} else { ?>
                        <img src="<?= Yii::$app->homeUrl . 'image/userProfile.png' ?>" class="company-group-picture">
                        <?php
					}
					?>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="col-12 name-tokyo">
                    <span class="name-sub-tokyo"><?= $company['companyName'] ?></span>
                    <span class="name-full-tokyo">(<?= $company['displayName'] ?>)</span>
                </div>
            </div>
            <!-- <div class="col-lg-5 tcg-edit0 ">
                <a href="<?= Yii::$app->homeUrl ?>setting/company/update-company/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                    class="btn btn-primary  ml-10"><i class=" fa fa-pencil" aria-hidden="true"></i> Edit</a>
            </div> -->
            <div class="col-lg-2  tcg-edit0" style="display: flex; justify-content: flex-end;">
                <?php if($role >= 5){ ?>
                <a href="<?= Yii::$app->homeUrl ?>setting/company/update-company/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                    class="btn-update-group" style="width: 60%;">
                    <img src="<?= Yii::$app->homeUrl ?>image/refresh-white.svg">
                    Update Information
                </a>
                <?php } ?>
            </div>
        </div>

        <div class="row group-details mt-10">
            <div class="col-9">
                <div class="row mt-40">
                    <!-- Left Column -->
                    <div class="col-lg-6 col-md-6 col-12 in-for">
                        <div class="col-12 Group-Information">
                            Company Details
                            <hr class="hr-group">
                        </div>
                        <div class="row mt-20">
                            <div class="col-lg-2">
                            </div>
                            <div class="col-lg-2 col-md-6 col-12 name-head">
                                Head of Company
                            </div>
                            <div class="col-lg-8 col-md-6 col-12 name-head0 mt-5">
                                <!-- <i class="fa fa-map-marker location" aria-hidden="true"></i> <span
                            class="text-primary address-box">Shinjuku-ku, Tokyo</span> -->
                                <a class="col-lg-7 col-md-6 col-12 name-director text-wrap"
                                    href="<?= Yii::$app->homeUrl ?>setting/employee/employee-profile/<?= ModelMaster::encodeParams(['employeeId' => $company["directorId"]]) ?>">
                                    <img src="<?= Yii::$app->homeUrl ?><?= $director["picture"] ?>"
                                        style="width: 20px; height: 20px;">
                                    <span
                                        class="d-inline-block ml-10"><?= $director["employeeFirstname"] .' '. $director["employeeSurename"] ?></span>
                                </a>
                            </div>
                            <div class="col-lg-2">
                            </div>
                            <div class="col-lg-2 col-md-6 col-12 name-head mt-10">
                                Headquarter Address
                            </div>
                            <div
                                class="col-lg-8 col-md-6 col-12 name-head0 mt-5 d-flex justify-content-center align-items-center">
                                <!-- <div class="address-box"><?= $company["location"] ?>
                        </div> -->
                                <div class="col-1">
                                    <img src="<?= Yii::$app->homeUrl ?>image/location.svg"
                                        style="width: 9.333px; height: 12px;">
                                </div>
                                <div class="col-11 address-box text-wrap ">
                                    <?= $company["location"] ?>
                                </div>
                            </div>
                            <div class="col-lg-2">
                            </div>
                            <div class="col-lg-2 col-md-6 col-12 name-head mt-10">
                                Founded
                            </div>
                            <div class="col-lg-8 col-md-6 col-12 name-head0 mt-7">
                                <?= $company["founded"] ?>
                            </div>
                            <div class="col-lg-2">
                            </div>
                            <div class="col-lg-2 col-md-6 col-12 name-head mt-10">
                                Industry
                            </div>
                            <div class="col-lg-8 col-md-6 col-12 name-head0 mt-7">
                                <?= $company["industries"] ?>
                            </div>
                        </div>
                        <div class="col-12 Group-Information mt-36">
                            Contact Information
                            <hr class="hr-group">
                        </div>
                        <div class="row mt-30">
                            <div class="col-lg-2">
                            </div>
                            <div class="col-lg-2 col-md-6 col-12 name-head mt-3">
                                Email
                            </div>
                            <div class="col-lg-8 col-md-6 col-12 name-head0 d-flex align-items-center">
                                <span class="address-box0 pr-5"
                                    style="color: var(--Primary-Blue---HRVC, #2580D3); text-decoration-line: underline;">
                                    <?= $company["email"] ?>
                                </span>
                                <img src="<?= Yii::$app->homeUrl ?>image/coppy.svg"
                                    onclick="javascript:copyToClipboard('<?= $company['email'] ?>')"
                                    style="width: 10.884px; height: 12px;">
                            </div>
                            <div class="col-lg-2">
                            </div>
                            <div class="col-lg-2 col-md-6 col-12  name-head mt-10">
                                Phone
                            </div>
                            <div class="col-lg-8 col-md-6 col-12 name-head0 mt-7 d-flex align-items-center">
                                <span class="address-box0  pr-5">
                                    <?= $company["contact"] ?>
                                </span>
                                <img src="<?= Yii::$app->homeUrl ?>image/coppy.svg"
                                    onclick="javascript:copyToClipboard('<?= $company['contact'] ?>')"
                                    style="width: 10.884px; height: 12px;">
                            </div>
                            <div class="col-lg-2">
                            </div>
                            <div class="col-lg-2 col-md-6 col-12  name-head mt-10">
                                Website
                            </div>
                            <div class="col-lg-8 col-md-6 col-12 name-head0 mt-7">
                                <span class="address-box0 pr-5"
                                    style="color: var(--Primary-Blue---HRVC, #2580D3); text-decoration-line: underline;">
                                    <?= $company["website"] ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 in-for">
                        <div class="col-12 Group-Information">
                            Company Description
                            <hr class="hr-group">
                        </div>
                        <div class="col-12 detail-tokyo mt-10">
                            <?= $company["about"] ?>

                        </div>

                    </div>

                    <!-- Bottom Row -->
                    <div class="col-12 mt-10 current-stats">
                        <div class="col-12 Group-Information">
                            <?= Yii::t('app', 'Affiliated Entities') ?>
                            <hr class="hr-group">
                        </div>
                        <div class="row">

                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="alert alert-secondary-background" style="width: 100%;">
                                    <a href="<?= Yii::$app->homeUrl ?>setting/department/create/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                        class="text-decoration-none" style="width: 60%;">
                                        <div class="row align-items-center">
                                            <div class="col-lg-8 col-md-8 col-8 text-left">
                                                <div class="circle-container">
                                                    <div class="cycle-current-red">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/departments.svg"
                                                            alt="icon">
                                                    </div>
                                                    <div class="cycle-current-red">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/departments.svg"
                                                            alt="icon">
                                                    </div>
                                                    <div class="cycle-current-red">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/departments.svg"
                                                            alt="icon">
                                                    </div>
                                                    <div class="number-current"><?= $totalBranch?></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-4 text-right">
                                                <div class="text-name-current"><?= Yii::t('app', 'Department') ?></div>
                                                <div class="text-see-all"><?= Yii::t('app', 'See All') ?></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="alert alert-secondary-background" style="width: 100%;">
                                    <a href="<?= Yii::$app->homeUrl ?>setting/team/create/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                        class="text-decoration-none" style="width: 60%;">
                                        <div class="row align-items-center">
                                            <div class="col-lg-8 col-md-8 col-8 text-left">
                                                <div class="circle-container">
                                                    <div class="cycle-current-green">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/teams.svg" alt="icon"
                                                            style="margin-right: 1px;">
                                                    </div>
                                                    <div class="cycle-current-green">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/teams.svg" alt="icon"
                                                            style="margin-right: 1px;">
                                                    </div>
                                                    <div class="cycle-current-green">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/teams.svg" alt="icon"
                                                            style="margin-right: 1px;">
                                                    </div>
                                                    <div class="number-current"><?= $totalDepartment?></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-4 text-right">
                                                <div class="text-name-current"><?= Yii::t('app', 'Team') ?></div>
                                                <div class="text-see-all"><?= Yii::t('app', 'See All') ?></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="alert alert-secondary-background" style="width: 100%;">
                                    <a href="<?= Yii::$app->homeUrl ?>setting/employee/index/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                        class="text-decoration-none" style="width: 60%;">
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <div class="circle-container-img">
                                                    <div class="cycle-image mr-3">
                                                        <img src="<?= Yii::$app->homeUrl ?><?php echo $employees[0]['picture'] ?>"
                                                            alt="icon">
                                                    </div>
                                                    <div class="cycle-image mr-3">
                                                        <img src="<?= Yii::$app->homeUrl ?><?php echo $employees[1]['picture'] ?>"
                                                            alt="icon">
                                                    </div>
                                                    <div class="cycle-image mr-10">
                                                        <img src="<?= Yii::$app->homeUrl ?><?php echo $employees[2]['picture'] ?>"
                                                            alt="icon">
                                                    </div>
                                                    <div class="number-current"><?= $totalEmployee?>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="col-lg-4 col-md-4 col-4 text-right">
                                                <div class="text-name-current"><?= Yii::t('app', 'Employee') ?>
                                                </div>
                                                <div class="text-see-all"><?= Yii::t('app', 'See All') ?></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-3">
                <div class="row mt-40">
                    <!--  -->
                    <div class="col-12 Group-Information">
                        <img src="<?= Yii::$app->homeUrl ?>image/branch-icon-black.svg"
                            style="width: 14px; height: 14px; margin-bottom: 3px; margin-right: 5px; ">
                        Affiliated Branches
                        <hr class="hr-group">
                    </div>
                    <div class="col-12 detail-tokyo  mt-10">

                    </div>
                </div>
                <div class="col-12">
                </div>
            </div>

        </div>
    </div>

</div>