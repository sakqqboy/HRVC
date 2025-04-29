<?php

use common\models\ModelMaster;

$this->title = 'company profile';
?>

<div class="contrainer-body mt-33" style="padding-bottom: 31px; ">

    <div class="col-12">
        <div class=" d-flex align-items-center gap-2">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/company.svg" style="width: 24px; height: 24px;">
            <div class="pim-name-title ml-10">
                <?= Yii::t('app', 'Company in Details') ?>
            </div>
        </div>
    </div>

    <div class="company-group-edit mt-30">
        <div style="display: flex; align-items: center; gap: 14px;">
            <a href="<?= Yii::$app->request->referrer ?: Yii::$app->homeUrl ?>"
                style="text-decoration: none; width:66px; height:26px;" class="btn-create-branch">
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/back-white.svg"
                    style="width:18px; height:18px; margin-top:-3px;">
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
                    <?= Yii::t('app', 'Update Information') ?>
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
                            <?= Yii::t('app', 'Company Details') ?>
                            <hr class="hr-group">
                        </div>
                        <div class="row mt-20">
                            <div class="col-lg-2">
                            </div>
                            <div class="col-lg-2 col-md-6 col-12 name-head">
                                <?= Yii::t('app', 'Head of Company') ?>
                            </div>
                            <div class="col-lg-8 col-md-6 col-12 name-head0 mt-5">
                                <!-- <i class="fa fa-map-marker location" aria-hidden="true"></i> <span
                            class="text-primary address-box">Shinjuku-ku, Tokyo</span> -->
                                <?php if (!empty($company["directorId"]) && !empty($director)): ?>
                                <a class="col-lg-7 col-md-6 col-12 name-director text-wrap"
                                    href="<?= Yii::$app->homeUrl ?>setting/employee/employee-profile/<?= ModelMaster::encodeParams(['employeeId' => $company["directorId"]]) ?>">
                                    <img src="<?= Yii::$app->homeUrl ?><?= $director["picture"] ?>"
                                        style="width: 20px; height: 20px;">
                                    <span class="d-inline-block ml-10">
                                        <?= $director["employeeFirstname"] . ' ' . $director["employeeSurename"] ?>
                                    </span>
                                </a>
                                <?php endif; ?>

                            </div>
                            <div class="col-lg-2">
                            </div>
                            <div class="col-lg-2 col-md-6 col-12 name-head mt-10">
                                <?= Yii::t('app', 'Headquarter Address') ?>
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
                                <?= Yii::t('app', 'Founded') ?>
                            </div>
                            <div class="col-lg-8 col-md-6 col-12 name-head0 mt-7">
                                <?= $company["founded"] ?>
                            </div>
                            <div class="col-lg-2">
                            </div>
                            <div class="col-lg-2 col-md-6 col-12 name-head mt-10">
                                <?= Yii::t('app', 'Industry') ?>
                            </div>
                            <div class="col-lg-8 col-md-6 col-12 name-head0 mt-7">
                                <?= $company["industries"] ?>
                            </div>
                        </div>
                        <div class="col-12 Group-Information mt-36">
                            <?= Yii::t('app', 'Contact Information') ?>
                            <hr class="hr-group">
                        </div>
                        <div class="row mt-30">
                            <div class="col-lg-2">
                            </div>
                            <div class="col-lg-2 col-md-6 col-12 name-head mt-3">
                                <?= Yii::t('app', 'Email') ?>
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
                                <?= Yii::t('app', 'Phone') ?>
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
                                <?= Yii::t('app', 'Website') ?>
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
                            <?= Yii::t('app', 'Company Description') ?>
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
                                                    <div
                                                        class="cycle-current-<?= $totalDepartment >= 1 ? 'red' : 'gray' ?>">
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
                                                    <div class="number-current"><?= $totalDepartment?></div>
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
                                                    <div
                                                        class="cycle-current-<?= $totalTeam >= 1 ? 'green' : 'gray' ?>">
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
                                                    <div class="number-current"><?= $totalTeam?></div>
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

            <div class="col-lg-3 col-md-4 col-12  home-tokyo">
                <div class="row mt-40">
                    <!-- <div class="col-12 Group-Information">
                        <img src="<?= Yii::$app->homeUrl ?>image/branch-icon-black.svg"
                            style="width: 14px; height: 14px; margin-bottom: 3px; margin-right: 5px; ">
                        Affiliated Branches
                        <hr class="hr-group">
                    </div> -->
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-12"
                            style="width: 15px; height: 15px; padding-right : 0px; padding-left: 0px; bottom: 5px; ">
                            <img src="<?= Yii::$app->homeUrl ?>image/branch-icon-black.svg"
                                style="width: 15px; height: 15px;">
                        </div>
                        <div class="col-lg-10 col-md-7 col-12 Affiliated0">
                            <?= Yii::t('app', 'Affiliated Companies') ?>
                        </div>
                    </div>
                    <div class="col-12 detail-tokyo  mt-10">
                        <?php
                        if (isset($companyBranch) && count($companyBranch) > 0) {
                            $i = 0;
                            foreach ($companyBranch as $branch) :
                                if ($i >= 6) {
                                    break;
                                }
                        ?>

                        <div class="row <?= $i > 0 ? 'mt-10' : '' ?> ">
                            <div class="col-lg-3 col-md-4 col-4">
                                <?php
									if ($branch['branchImage'] != "") {
									?>
                                <img src="<?= Yii::$app->homeUrl . $branch['branchImage'] ?>" class="width-TCF-BD"
                                    style="border-radius: 100%;">
                                <?php
									} else {
									?>
                                <img src="<?= Yii::$app->homeUrl . $branch['picture'] ?>" class="width-TCF-BD"
                                    style="border-radius: 100%;">
                                <?php
									}
									?>
                            </div>
                            <div class="col-lg-7 col-md-7 col-7">
                                <div class="tokyoconsultinggroup">
                                    <?= $branch['branchName'] ?>
                                </div>
                                <div class="city-group">
                                    <img src="<?= Yii::$app->homeUrl ?>image/plus-red.svg"
                                        style="width: 10.5px; height: 10.5px; ">
                                    <?= $branch["city"] ?>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-1 col-1 d-flex justify-content-center ">
                                <a href="<?= Yii::$app->homeUrl . 'setting/branch/branch-view/' . ModelMaster::encodeParams([
									'branchId' => $branch['branchId']
								]) ?>" class="no-underline" style="color:black;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/btn-view.svg" alt="View Button">
                                </a>
                            </div>
                            <div class="col-lg-1 col-md-1 col-1 d-flex justify-content-center ">

                                <span class="dropdown" href="#" id="dropdownMenuLink-1" data-bs-toggle="dropdown"
                                    style="align-self: flex-start;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/3-dot.svg" alt="icon"
                                        style="cursor: pointer;">
                                </span>
                                <div class="menu-dot">
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink-1">
                                        <!-- <li class="px-4">
                                            <a href="" style="padding: 15px;"
                                                class="dropdown-itemNEWS d-flex align-items-center justify-content-center text-center">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg"
                                                    alt="History" class="pim-icon">
                                                <?= Yii::t('app', 'View') ?>
                                            </a>
                                        </li> -->
                                    </ul>
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
                <div class="col-12">
                </div>
            </div>

        </div>
    </div>

</div>