<?php

use common\models\ModelMaster;

$this->title = 'Company profile';
?>

<div class="col-12 mt-60 pt-20">
    <div class="col-12">
        <div class=" d-flex align-items-center gap-2">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/company.svg" style="width: 24px; height: 24px;">
            <div class="pim-name-title ml-10">
                <?= Yii::t('app', 'Company in Details') ?>
            </div>
        </div>
    </div>
    <div class="company-group-edit mt-20 mb-3">
        <div style="display: flex; align-items: end; gap: 14px;">
            <a href="<?= Yii::$app->request->referrer ?: Yii::$app->homeUrl . 'setting/company/company-grid' ?>"
                style="text-decoration: none;" class="create-employee-btn">
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/back-white.svg" class="mr-3"
                    style="width:18px; height:18px;">
                <?= Yii::t('app', 'Back') ?>
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
                <span class="pim-unit-text" style="font-size:14px;"><?= $company['companyName'] ?></span>
            </div>
        </div>

        <div class="banner-uploade mt-20" style="border:none;">
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
        <div class="d-flex justify-content-start" style="margin-top: -91px;">
            <div class="ml-35">
                <div class="avatar-upload-preview">
                    <div class="avatar-preview">
                        <?php if ($company["picture"] != null && $company["picture"] != 'image/no-company.svg') { ?>
                            <img src="<?= Yii::$app->homeUrl . $company['picture'] ?>" class="company-group-picture">
                        <?php } else { ?>
                            <img src="<?= Yii::$app->homeUrl . 'image/no-company.svg' ?>" class="company-group-picture" style="min-width:154px;">
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="<?= $role < 5 ? 'flex-grow-1' : '' ?> align-content-end">
                <div class="d-flex pl-10" style="height: 26px;align-items: baseline;">
                    <span class="name-sub-tokyo" style="font-size:18px;"><?= Yii::t('app', $company['companyName']) ?></span>
                    <span class="name-full-tokyo" style="font-size:14px;">(<?= Yii::t('app', $company['displayName']) ?>)</span>
                </div>
            </div>

            <?php if ($role >= 5) { ?>
                <div class="flex-grow-1" style="display: flex;justify-content: end;align-items: end;">
                    <a href="<?= Yii::$app->homeUrl ?>setting/company/update-company/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                        class="create-employee-btn" style="min-width: 150px;font-size:12px;">
                        <img src="<?= Yii::$app->homeUrl . 'image/refresh-white.svg' ?>" class="mr-3">
                        <?= Yii::t('app', 'Update Information') ?>
                    </a>
                </div>
            <?php } ?>
        </div>
        <div class="row  mt-45" style="--bs-gutter-x:0px;">
            <div class="col-lg-9 col-md-6 col-12">
                <div class="row" style="--bs-gutter-x:0px;">
                    <div class="col-lg-5 col-md-6 col-12 all-information">
                        <div class="col-12 Group-Information">
                            <?= Yii::t('app', 'Company Details') ?>
                            <hr class="hr-group">
                        </div>
                        <div class="row mb-36" style="--bs-gutter-x:0px;">
                            <div class="col-lg-4 col-6 name-head">
                                <?= Yii::t('app', 'Head of Company') ?>
                            </div>
                            <div class="col-lg-8 col-6 name-director text-truncate pl-20 pr-5 align-content-center">
                                <?php
                                if (!empty($company["directorId"]) && !empty($director)) { ?>
                                    <img src="<?= Yii::$app->homeUrl ?><?= $director['directorPicture'] ?>" class="mr-5 director-pic">
                                    <a href="<?= Yii::$app->homeUrl ?>setting/employee/employee-profile/<?= ModelMaster::encodeParams(['employeeId' => $company['directorId']]) ?>" class="head-name-link">
                                        <?= $director["employeeFirstname"] . ' ' . $director["employeeSurename"] ?>
                                    </a>
                                <?php
                                } else { ?>
                                    Not set
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-lg-4 col-6 name-head mt-10">
                                <?= Yii::t('app', 'Headquarter Address') ?>
                            </div>
                            <div class="col-lg-8 col-6 name-head0 mt-10 pl-20">
                                <img src="<?= Yii::$app->homeUrl ?>image/location.svg" class="mr-5" style="width: 9.333px; height: 12px;">
                                <?= $company["location"] ?>
                            </div>

                            <div class="col-lg-4 col-6 name-head mt-10">
                                <?= Yii::t('app', 'Founded') ?>
                            </div>
                            <div class="col-lg-8 col-6 name-head0 mt-10 pl-20">
                                <?= !empty($company["founded"]) ? $company["founded"] : '-' ?>
                            </div>
                            <div class="col-lg-4 col-6 name-head mt-10">
                                <?= Yii::t('app', 'Industry') ?>
                            </div>
                            <div class="col-lg-8 col-6 name-head0 mt-10 pl-20">
                                <?= Yii::t('app', $company["industries"]) ?>
                            </div>
                        </div>
                        <div class="col-12 Group-Information">
                            <?= Yii::t('app', 'Contact Information') ?>
                            <hr class="hr-group">
                        </div>
                        <div class="row mb-36" style="--bs-gutter-x:0px;">
                            <div class="col-lg-4 col-6 name-head">
                                <?= Yii::t('app', 'Email') ?>
                            </div>
                            <div class="col-lg-8 col-6 name-head0  pl-20">
                                <div style="max-width:90%;" class="text-truncate d-inline-block ">
                                    <a href="<?= $company["email"] ?>" class="text-primary address-box0 " title="<?= $company["email"] ?>">
                                        <?= $company["email"] ?>
                                    </a>
                                </div>

                                <img src="<?= Yii::$app->homeUrl ?>image/coppy.svg" onclick="javascript:copyToClipboard('<?= $company['email'] ?>')" class="ml-5"
                                    style="width: 10.884px; height: 12px;cursor:pointer;margin-top:-5px;">
                            </div>
                            <div class="col-lg-4 col-6 name-head mt-10">
                                <?= Yii::t('app', 'Phone') ?>
                            </div>
                            <div class="col-lg-8 col-6 name-head0 mt-10 pl-20">
                                <span class="text-wrap pr-5"><?= $company["contact"] ?></span>
                                <img src="<?= Yii::$app->homeUrl ?>image/coppy.svg"
                                    onclick="javascript:copyToClipboard('<?= $company['contact'] ?>')"
                                    style="width: 10.884px; height: 12px;cursor:pointer;">
                            </div>
                            <div class="col-lg-4 col-6 name-head mt-10">
                                <?= Yii::t('app', 'Website') ?>
                            </div>
                            <div class="col-lg-8 col-6 name-head0 mt-10 pl-20">
                                <div style="max-width:90%;" class="text-truncate d-inline-block ">
                                    <a href="<?= $company["website"] ?>" class="text-primary address-box0" target="_blank">
                                        <?= $company["website"] ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6 col-12 box-about0">
                        <div class="row about-section" style="--bs-gutter-x:0px;">
                            <div class="col-12 Group-Information">
                                <?= Yii::t('app', 'Company Description') ?>
                                <hr class="hr-group">
                            </div>

                            <div class="col-12 detail-tokyo">
                                <span id="about-text">
                                    <?= mb_strlen(Yii::t('app', $company["about"])) > 800
                                        ? mb_substr(Yii::t('app', $company["about"]), 0, 800) . '...'
                                        : Yii::t('app', $company["about"]) ?>
                                    <?php if (mb_strlen(Yii::t('app', $company["about"])) > 800): ?>
                                        <button id="see-more" class="see-more"><span><?= Yii::t('app', 'See More') ?></span></button>
                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-10 current-stats mb-10">
                        <div class="col-12 Group-Information">
                            <?= Yii::t('app', 'Affiliated Entities') ?>
                            <hr class="hr-group">
                        </div>
                        <div class="row" style="--bs-gutter-x:0px;">
                            <div class="col-lg-4 col-md-6 col-12 mb-20">
                                <a href="<?= Yii::$app->homeUrl ?>setting/department/no-department/<?= ModelMaster::encodeParams(['branchId' => '']) ?>" class="text-decoration-none">
                                    <div class="row align-items-center" style="--bs-gutter-x:0px;">
                                        <div class="col-12 text-left pl-35 d-flex">
                                            <div class="circle-container ">
                                                <div class="cycle-current-<?= $totalDepartment >= 1 ? 'red' : 'gray' ?>">
                                                    <img src="<?= Yii::$app->homeUrl ?>image/departments<?= $totalDepartment >= 1 ? '' : '-black' ?>.svg"
                                                        alt="icon">
                                                </div>
                                                <div
                                                    class="cycle-current-<?= $totalDepartment >= 2 ? 'red' : 'gray' ?>">
                                                    <img src="<?= Yii::$app->homeUrl ?>image/departments<?= $totalDepartment >= 2 ? '' : '-black' ?>.svg"
                                                        alt="icon">
                                                </div>
                                                <div
                                                    class="cycle-current-<?= $totalDepartment >= 3 ? 'red' : 'gray' ?>">
                                                    <img src="<?= Yii::$app->homeUrl ?>image/departments<?= $totalDepartment >= 3 ? '' : '-black' ?>.svg"
                                                        alt="icon">
                                                </div>
                                                <div class="number-current"><?= $totalDepartment ?></div>
                                            </div>
                                            <div class="text-name-current ml-15 align-content-center">
                                                <div class="text-name-current"><?= Yii::t('app', 'Department') ?></div>
                                                <div class="text-see-all"><?= Yii::t('app', 'See All') ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12  mb-20">
                                <a href="<?= Yii::$app->homeUrl ?>setting/team/no-team/<?= ModelMaster::encodeParams(['departmentId' => '']) ?>" class="text-decoration-none">
                                    <div class="row align-items-center" style="--bs-gutter-x:0px;">
                                        <div class="col-12 text-left pl-35 d-flex">
                                            <div class="circle-container ">
                                                <div class="cycle-current-<?= $totalTeam >= 1 ? 'green' : 'gray' ?>">
                                                    <img src="<?= Yii::$app->homeUrl ?>image/teams<?= $totalTeam >= 1 ? '' : '-black' ?>.svg"
                                                        alt="icon">
                                                </div>
                                                <div
                                                    class="cycle-current-<?= $totalTeam >= 2 ? 'green' : 'gray' ?>">
                                                    <img src="<?= Yii::$app->homeUrl ?>image/teams<?= $totalTeam >= 2 ? '' : '-black' ?>.svg"
                                                        alt="icon">
                                                </div>
                                                <div
                                                    class="cycle-current-<?= $totalTeam >= 3 ? 'green' : 'gray' ?>">
                                                    <img src="<?= Yii::$app->homeUrl ?>image/teams<?= $totalTeam >= 3 ? '' : '-black' ?>.svg"
                                                        alt="icon">
                                                </div>
                                                <div class="number-current"><?= $totalTeam ?></div>
                                            </div>
                                            <div class="text-name-current ml-15 align-content-center">
                                                <div class="text-name-current"><?= Yii::t('app', 'Team') ?></div>
                                                <div class="text-see-all"><?= Yii::t('app', 'See All') ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-20">
                                <a href="<?= Yii::$app->homeUrl ?>setting/employee/index/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>" class="text-decoration-none">
                                    <div class="row align-items-center" style="--bs-gutter-x:0px;">
                                        <div class="col-12 text-left pl-35 d-flex">
                                            <div class="circle-container-img">
                                                <?php for ($i = 0; $i < 3; $i++): ?>
                                                    <?php if (!empty($employees[$i]['picture'])): ?>
                                                        <div class="cycle-image <?= $i == 2 ? 'mr-10' : 'mr-3' ?>">
                                                            <img src="<?= Yii::$app->homeUrl . $employees[$i]['picture'] ?>"
                                                                alt="icon">
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="cycle-current-gray <?= $i == 2 ? 'mr-10' : 'mr-3' ?>">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/employees-black.svg"
                                                                alt="icon">
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                                <div class="number-current"><?= $totalEmployee ?>
                                                </div>
                                            </div>
                                            <div class="text-name-current ml-15 align-content-center">
                                                <div class="text-name-current"><?= Yii::t('app', 'Employee') ?>
                                                </div>
                                                <div class="text-see-all"><?= Yii::t('app', 'See All') ?></div>
                                            </div>
                                        </div>

                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 pl-10">
                <div class="row" style="--bs-gutter-x:0px;">
                    <div class="col-12 Group-Information">
                        <img src="<?= Yii::$app->homeUrl ?>image/branch-icon-black.svg" class="mr-10" style="width: 15px; height: 15px;">
                        <?= Yii::t('app', 'Affiliated Branches') ?>
                    </div>
                    <hr class="hr-group">
                    <div class="col-12">
                        <?php
                        if (isset($companyBranch) && count($companyBranch) > 0) {
                            $i = 0;
                            foreach ($companyBranch as $branch) :
                                if ($i >= 6) {
                                    break;
                                }
                        ?>
                                <div class="col-12 mb-10">
                                    <div class="row" style="--bs-gutter-x:0px;">
                                        <div class="col-lg-2 col-md-3 col-4 ">
                                            <?php
                                            if ($branch['branchImage'] != "") {
                                            ?>
                                                <img src="<?= Yii::$app->homeUrl . $branch['branchImage'] ?>" class="width-TCF-BD"
                                                    style="border-radius: 100%;">
                                            <?php
                                            } else {
                                            ?>
                                                <img src="<?= Yii::$app->homeUrl ?>image/no-branch.svg" class="width-TCF-BD"
                                                    style="border-radius: 100%;">
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-7 align-content-center">
                                            <div class="tokyoconsultinggroup text-truncate">
                                                <?= $branch['branchName'] ?>
                                            </div>
                                            <div class="city-group mt-3">
                                                <img src="<?= Yii::$app->homeUrl ?><?= $branch["flag"] != '' ? $branch["flag"] : 'image/e-world.svg' ?>"
                                                    class="mr-3 img-fluid" style="width: 16px; height: 16px;border-radius:100%; ">
                                                <?= $branch["city"] != '' ? $branch["city"] : 'Not set' ?>, <?= $branch["city"] ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-1 col-1 align-content-center text-end">
                                            <a href="<?= Yii::$app->homeUrl . 'setting/branch/branch-view/' . ModelMaster::encodeParams([
                                                            'branchId' => $branch['branchId']
                                                        ]) ?>" class="no-underline" style="color:black;">
                                                <img src="<?= Yii::$app->homeUrl ?>image/btn-view.svg" alt="View Button">
                                            </a>
                                            <!-- <span class="dropdown" href="#" id="dropdownMenuLink-1" data-bs-toggle="dropdown"
                                                style="align-self: flex-start;">
                                                <img src="<?= Yii::$app->homeUrl ?>image/3-dot.svg" alt="icon"
                                                    style="cursor: pointer;">
                                            </span>
                                            <div class="menu-dot">
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink-1">
                                                    <li class="px-4">
                                                        <a href="" style="padding: 15px;"
                                                            class="dropdown-itemNEWS d-flex align-items-center justify-content-center text-center">
                                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg"
                                                                alt="History" class="pim-icon">
                                                            <?= Yii::t('app', 'View') ?>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            <?php
                                $i++;
                            endforeach;
                        }
                        if (count($companyBranch) > 5) {
                            ?>
                            <div class="col-12 text-end">
                                <a class="see-all-company"
                                    href="<?= Yii::$app->homeUrl ?>setting/branch/index/<?= ModelMaster::encodeParams(['companyId' => '']) ?>">
                                    <?= Yii::t('app', 'See All') ?>
                                    <img src="<?= Yii::$app->homeUrl ?>image/see-all.svg" alt="icon"
                                        style="cursor: pointer;">
                                    </span>
                                </a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .create-employee-btn {
        height: 0px;
        min-width: 66px;
        font-size: 16px;
        min-height: 26px;
        padding-top: 3px;
        padding-bottom: 3px;
    }

    .cycle-current-gray {
        width: 32.25px;
        height: 32.25px;
    }

    .tokyoconsultinggroup {
        padding-left: 12px;
    }

    .city-group {
        padding-left: 12px;
    }
</style>