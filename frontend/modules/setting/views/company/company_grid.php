<?php

use common\models\ModelMaster;

$this->title = 'company';
$page = "grid"
?>

<!-- <div class="contrainer-body mt-10"> -->
<!-- <div class="mt-60" style="padding: 30px;"> -->
<div class="mt-60" style="padding: 30px 0px;">

    <div class="between-center" style="width: 100%;">
        <div class="col-9">
            <div class="d-flex align-items-center gap-2">
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/company.svg"
                    style="width: 24px; height: 24px;">
                <div class="pim-name-title">
                    <?= Yii::t('app', 'Company') ?>
                </div>
                <?php if($role >= 5 ) { ?>
                <a href="<?= Yii::$app->homeUrl ?>setting/company/create/<?= ModelMaster::encodeParams(['groupId' => $groupId]) ?>"
                    style="text-decoration: none;">
                    <button type="button" class="btn-create"
                        style="padding: 0px; width: 93px; height:22.5px; font-size: 12px; font-weight: 600;"
                        action="<?= Yii::$app->homeUrl ?>setting/group/create-group"><?= Yii::t('app', 'Create New') ?>
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg"
                            style="width:14px; height:14px; margin-top:-3px;">
                    </button>
                </a>
                <?php }?>
            </div>
        </div>
        <div class="col-2" style="text-align: right;">
            <?= $this->render('filter_list', ['countries' => $countries,'page' => $page,'countryIdOld' => $countryId]) ?>
        </div>
        <div class="col-1 pr-0 text-end">
            <div class="btn-group" role="group">
                <!-- <a href="#" class="btn btn-primary font-size-12 pim-change-modes">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/gridwhite.svg" style="cursor: pointer;">
                </a>
                <a href="<?= Yii::$app->homeUrl . 'setting/company/index' ?>"
                    class="btn btn-outline-primary font-size-12 pim-change-modes">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/listblack.svg" style="cursor: pointer;">
                </a> -->
                <a href="#" class="btn btn-primary font-size-12 pim-change-modes">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/gridwhite.svg"
                        style="cursor: pointer; margin-top:2px;">
                </a>
                <a href="<?= Yii::$app->homeUrl . 'setting/company/index' ?>"
                    class="btn btn-outline-primary font-size-12 pim-change-modes"
                    style="border-color: #CBD5E1 !important;">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/listblack.svg"
                        style="cursor: pointer; margin-top:2px;">
                </a>
            </div>
        </div>
    </div>

    <div class="company-group-edit bg-white mt-20">
        <div class="alert alert-branch-body" role="alert" style="padding: 0px;">
            <div class="row" id="company-branch">
                <?php
				if (isset($companies) && count($companies) > 0) {
					$i = 1;
					foreach ($companies as $company) :
						$maxLength = 200;
						$about = substr(Yii::t('app', $company['about']), 0, $maxLength);
				?>
                <div class="col-lg-6 col-md-5 col-sm-3 col-12" id="company-<?php echo $company['companyId'] ?>">
                    <div class="card-comany">
                        <div class="card-body" style="background: #F9FBFF;  border-radius: 5px;">
                            <!-- <div style="display: flex;
                            height: 100%;
                            flex-direction: column;
                            justify-content: space-between;
                            align-items: center;
                            flex-shrink: 0;
                            align-self: stretch;"> -->
                            <div class="between-center"
                                style="flex-direction: column; height: 100%; gap: 20px;  align-self: stretch;">
                                <!-- ส่วนบน -->
                                <div class="between-center" style=" gap: 17px; width: 100%;">
                                    <div style="display: flex; align-items: center; gap: 17px;">
                                        <!-- <div class="mid-center"
                                            style="height: 60px; padding: 20.944px 4.189px; gap: 10.472px;"> -->
                                        <div class="mid-center" style=" gap: 10.472px;">
                                            <?php
                                                    if ($company["picture"] != null) { ?>
                                            <img src="<?= Yii::$app->homeUrl ?><?= $company['picture'] ?>"
                                                class="card-tcf">
                                            <?php
                                                    } else { ?>
                                            <img src="<?= Yii::$app->homeUrl . 'image/userProfile.png' ?>"
                                                class="card-tcf">
                                            <?php
                                                    }
                                                ?>
                                        </div>
                                        <div class="header-crad-company">
                                            <div class="name-crad-company text-truncate">
                                                <?= $company['companyName'] ?>
                                            </div>
                                            <div class="city-crad-company flex-grow-1">
                                                <img src="<?= Yii::$app->homeUrl ?><?= $company['flag'] ?>"
                                                    class="bangladresh-hrvc">
                                                <?= $company['city'] ?>, <?= Yii::t('app', $company['countryName']) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin-bottom: 30px;">
                                        <?php if($company['totalBranch'] > 0) { ?>
                                        <a href="
                                        <?= Yii::$app->homeUrl ?>setting/company/company-view/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                            class="btn btn-bg-white-xs mr-5" style="margin-top: 3px; ">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg"
                                                alt="History" class="pim-icon" style="margin-top: -1px;">
                                        </a>
                                        <?php }else { ?>
                                        <!-- <a class="btn btn-bg-red-xs mr-5"
                                            href="javascript:deleteCompany(<?= $company['companyId'] ?>)"
                                            style="margin-top: 3px;"
                                            onmouseover="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binwhite.svg'"
                                            onmouseout="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg'">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg"
                                                alt="History" class="pim-icon" style="margin-top: -3px;">
                                        </a> -->

                                        <a href="
                                        <?= Yii::$app->homeUrl ?>setting/company/company-view/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                            class="btn btn-bg-white-xs mr-5" style="margin-top: 3px; ">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg"
                                                alt="History" class="pim-icon" style="margin-top: -1px;">
                                        </a>
                                        <?php } ?>
                                        <span class="dropdown" href="#" id="dropdownMenuLink-1"
                                            data-bs-toggle="dropdown" style="align-self: flex-start;">
                                            <img src="<?= Yii::$app->homeUrl ?>image/3-dot.svg" alt="icon"
                                                style="cursor: pointer;">
                                        </span>
                                        <div class="menu-dot ">
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink-1">
                                                <?php if($company['totalBranch'] == 0) { ?>
                                                <li class="pl-9 pr-9 mb-9">
                                                    <!-- <a href="<?= Yii::$app->homeUrl ?>setting/company/company-view/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                                        class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                        style="margin-top: -3px;">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg"
                                                            alt="History" class="pim-icon mr-10"
                                                            style="margin-top: -2px;">
                                                    </a> -->
                                                    <!-- 
                                                    <a href="<?= Yii::$app->homeUrl ?>setting/company/company-view/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                                        class="btn btn-bg-white-xs">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg"
                                                            alt="History" class="pim-icon" style="margin-top: -1px;">
                                                    </a> -->


                                                    <a class="btn btn-bg-red-xs"
                                                        href="javascript:deleteCompany(<?= $company['companyId'] ?>)"
                                                        onmouseover="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binwhite.svg'"
                                                        onmouseout="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg'">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg"
                                                            alt="History" class="pim-icon" style="margin-top: -3px;">
                                                    </a>
                                                </li>
                                                <?php } ?>
                                                <li class="pl-9 pr-9 ">
                                                    <!-- <a href="<?= Yii::$app->homeUrl ?>setting/company/update-company/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                                        class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                        style="margin-top: -1px; ">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/editblack.svg"
                                                            alt="History" class="pim-icon mr-10"
                                                            style="margin-top: -2px;">
                                                    </a> -->
                                                    <a href="<?= Yii::$app->homeUrl ?>setting/company/update-company/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                                        class="btn btn-bg-white-xs">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/editblack.svg"
                                                            alt="History" class="pim-icon" style="margin-top: -1px;">
                                                    </a>


                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- ส่วนล่าง -->
                                <?php if($company['totalBranch'] > 0) { ?>
                                <div style="align-self: stretch; ">
                                    <span class="detailname-crad-company">
                                        <?= Yii::t('app', 'Quick Details') ?>
                                    </span>
                                    <div style=" margin-left: 20px; margin-top: 10px; ">

                                        <div
                                            style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 18px; width: 100%;">
                                            <div class="row align-items-center">
                                                <div class="col-12 text-left">
                                                    <div class="circle-container">
                                                        <div
                                                            class="cycle-current-<?= $company['totalBranch'] >= 1 ? 'yellow' : 'gray' ?>">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg"
                                                                alt="icon">
                                                        </div>
                                                        <div
                                                            class="cycle-current-<?= $company['totalBranch'] >= 2 ? 'yellow' : 'gray' ?>">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg"
                                                                alt="icon">
                                                        </div>
                                                        <div
                                                            class="cycle-current-<?= $company['totalBranch'] >= 3 ? 'yellow' : 'gray' ?>">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg"
                                                                alt="icon">
                                                        </div>
                                                        <div class="number-current-cycle ">
                                                            <?= $company['totalBranch'] ?></div>
                                                        <div class="bodyname-company">
                                                            <span class="bodyname-crad-company">
                                                                <?= Yii::t('app', 'Branch') ?>
                                                            </span>
                                                            <a class="text-see-all"
                                                                href="<?= Yii::$app->homeUrl ?>setting/branch/no-branch/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>">
                                                                <?= Yii::t('app', 'see all') ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row align-items-center">
                                                <div class="col-12 text-left">
                                                    <div class="circle-container">
                                                        <div
                                                            class="cycle-current-<?= $company['totalDepartment'] >= 1 ? 'red' : 'gray' ?>">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/departments<?= $company['totalDepartment'] >= 1 ? '' : '-black' ?>.svg"
                                                                alt="icon">
                                                        </div>
                                                        <div
                                                            class="cycle-current-<?= $company['totalDepartment'] >= 2 ? 'red' : 'gray' ?>">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/departments<?= $company['totalDepartment'] >= 2 ? '' : '-black' ?>.svg"
                                                                alt="icon">
                                                        </div>
                                                        <div
                                                            class="cycle-current-<?= $company['totalDepartment'] >= 3 ? 'red' : 'gray' ?>">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/departments<?= $company['totalDepartment'] >= 3 ? '' : '-black' ?>.svg"
                                                                alt="icon">
                                                        </div>
                                                        <div class="number-current-cycle ">
                                                            <?= $company['totalDepartment'] ?>
                                                        </div>
                                                        <div class="bodyname-company">
                                                            <span class="bodyname-crad-company">
                                                                <?= Yii::t('app', 'Departments') ?>
                                                            </span>
                                                            <?php if($company['totalBranch'] == 0) { ?>
                                                            <button type="button" class="btn-disble-small"
                                                                action="<?= Yii::$app->homeUrl ?>setting/group/create-group">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-black.svg"
                                                                    style="width: 12px; height: 12px;">
                                                                <?= Yii::t('app', 'Create') ?>
                                                            </button>
                                                            <?php } ?>
                                                            <?php if($company['totalBranch'] > 0 && $company['totalDepartment'] == 0) { ?>
                                                            <a href="<?= Yii::$app->homeUrl ?>setting/department/create/<?= ModelMaster::encodeParams(['companyId' => '']) ?>"
                                                                style="text-decoration: none;">
                                                                <button type="button" class="btn-create-small"
                                                                    action="<?= Yii::$app->homeUrl ?>setting/group/create-group">
                                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg"
                                                                        style="width: 12px; height: 12px;">
                                                                    <?= Yii::t('app', 'Create') ?>
                                                                </button>
                                                            </a>
                                                            <?php } ?>
                                                            <?php if($company['totalDepartment'] > 0) { ?>
                                                            <a class="text-see-all"
                                                                href="<?= Yii::$app->homeUrl ?>setting/department/no-department/<?= ModelMaster::encodeParams(['branchId' => '']) ?>">
                                                                <?= Yii::t('app', 'see all') ?>
                                                            </a>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row align-items-center">
                                                <div class="col-12 text-left">
                                                    <div class="circle-container">
                                                        <div
                                                            class="cycle-current-<?= $company['totalTeam'] >= 1 ? 'green' : 'gray' ?>">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/teams<?= $company['totalTeam'] >= 1 ? '' : '-black' ?>.svg"
                                                                alt="icon">
                                                        </div>
                                                        <div
                                                            class="cycle-current-<?= $company['totalTeam'] >= 2 ? 'green' : 'gray' ?>">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/teams<?= $company['totalTeam'] >= 2 ? '' : '-black' ?>.svg"
                                                                alt="icon">
                                                        </div>
                                                        <div
                                                            class="cycle-current-<?= $company['totalTeam'] >= 3 ? 'green' : 'gray' ?>">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/teams<?= $company['totalTeam'] >= 3 ? '' : '-black' ?>.svg"
                                                                alt="icon">
                                                        </div>
                                                        <div class="number-current-cycle "><?= $company['totalTeam'] ?>
                                                        </div>
                                                        <div class="bodyname-company">
                                                            <span class="bodyname-crad-company">
                                                                <?= Yii::t('app', 'Teams') ?>
                                                            </span>
                                                            <?php if($company['totalDepartment'] == 0) { ?>
                                                            <button type="button" class="btn-disble-small"
                                                                action="<?= Yii::$app->homeUrl ?>setting/group/create-group">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-black.svg"
                                                                    style="width: 12px; height: 12px;">
                                                                <?= Yii::t('app', 'Create') ?>
                                                            </button>
                                                            <?php } ?>
                                                            <?php if($company['totalDepartment'] > 0 && $company['totalTeam'] == 0) { ?>
                                                            <a href="<?= Yii::$app->homeUrl ?>setting/department/create/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                                                style="text-decoration: none;">
                                                                <button type="button" class="btn-create-small"
                                                                    action="<?= Yii::$app->homeUrl ?>setting/group/create-group">
                                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg"
                                                                        style="width: 12px; height: 12px;">
                                                                    <?= Yii::t('app', 'Create') ?>
                                                                </button>
                                                            </a>
                                                            <?php } ?>
                                                            <?php if($company['totalTeam'] > 0) { ?>
                                                            <a class="text-see-all"
                                                                href="<?= Yii::$app->homeUrl ?>setting/team/no-team/<?= ModelMaster::encodeParams(['departmentId' => '']) ?>">
                                                                <?= Yii::t('app', 'see all') ?>
                                                            </a>
                                                            <?php } ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row align-items-center">
                                                <div class="col-12 text-left">
                                                    <div class="circle-container">
                                                        <?php if(count($company['employees']) >= 1) { ?>
                                                        <div class="cycle-image mr-3">
                                                            <img src="<?= Yii::$app->homeUrl ?><?php echo $company['employees'][0]['picture'] ?>"
                                                                alt="icon">
                                                        </div>
                                                        <?php }else{ ?>
                                                        <div class="cycle-current-gray"><img
                                                                src="<?= Yii::$app->homeUrl ?>image/employees-black.svg"
                                                                alt="icon">
                                                        </div>
                                                        <?php } ?>
                                                        <?php if(count($company['employees']) >= 2) { ?>
                                                        <div class="cycle-image mr-3">
                                                            <img src="<?= Yii::$app->homeUrl ?><?php echo $company['employees'][1]['picture'] ?>"
                                                                alt="icon">
                                                        </div>
                                                        <?php }else{ ?>
                                                        <div class="cycle-current-gray"><img
                                                                src="<?= Yii::$app->homeUrl ?>image/employees-black.svg"
                                                                alt="icon">
                                                        </div>
                                                        <?php } ?>
                                                        <?php if(count($company['employees']) >= 3) { ?>
                                                        <div class="cycle-image mr-3">
                                                            <img src="<?= Yii::$app->homeUrl ?><?php echo $company['employees'][2]['picture'] ?>"
                                                                alt="icon">
                                                        </div>
                                                        <?php }else{ ?>
                                                        <div class="cycle-current-gray"><img
                                                                src="<?= Yii::$app->homeUrl ?>image/employees-black.svg"
                                                                alt="icon">
                                                        </div>
                                                        <?php } ?>
                                                        <div class="number-current-cycle ">
                                                            <?= $company['totalEmployee'] ?>
                                                        </div>
                                                        <div class="bodyname-company">
                                                            <span class="bodyname-crad-company">
                                                                <?= Yii::t('app', 'Employees') ?>
                                                            </span>
                                                            <?php if($company['totalTeam'] == 0) { ?>
                                                            <button type="button" class="btn-disble-small"
                                                                action="<?= Yii::$app->homeUrl ?>setting/group/create-group">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-black.svg"
                                                                    style="width: 12px; height: 12px;">
                                                                <?= Yii::t('app', 'Create') ?>
                                                            </button>
                                                            <?php } ?>
                                                            <?php if($company['totalTeam'] > 0 && $company['totalEmployee'] == 0) { ?>
                                                            <!-- <a href="<?= Yii::$app->homeUrl ?>setting/employee/index/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                                                style="text-decoration: none;"></a>
                                                            <button type="button" class="btn-create-small"
                                                                action="<?= Yii::$app->homeUrl ?>setting/group/create-group">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg"
                                                                    style="width: 12px; height: 12px;">
                                                                <?= Yii::t('app', 'Create') ?>
                                                            </button>
                                                            </a> -->
                                                            <a href="<?= Yii::$app->homeUrl ?>setting/employee/create"
                                                                style="text-decoration: none;">
                                                                <button type="button" class="btn-create-small">
                                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg"
                                                                        style="width: 12px; height: 12px;">
                                                                    <?= Yii::t('app', 'Create') ?>
                                                                </button>
                                                            </a>
                                                            <?php } ?>
                                                            <?php if($company['totalEmployee'] > 0) { ?>
                                                            <a class="text-see-all" style="font-size: 10.5px; "
                                                                href="<?= Yii::$app->homeUrl ?>setting/employee/index/<?= ModelMaster::encodeParams(['companyId' => '']) ?>">
                                                                <?= Yii::t('app', 'see all') ?>
                                                            </a>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } else{ ?>
                                <div class="create-crad-company ">
                                    <span class="text-create-crad">
                                        <?= Yii::t('app', 'No associated branch, department, team, or employee found!') ?>
                                    </span>
                                    <a href="<?= Yii::$app->homeUrl ?>setting/branch/create/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                        style="text-decoration: none;">
                                        <button type="button" class="btn-create" style="padding: 3px 9px;"
                                            action="<?= Yii::$app->homeUrl ?>setting/group/create-group"><?= Yii::t('app', 'Create Branch') ?>
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg"
                                                style="width:18px; height:18px; margin-top:-3px;">
                                        </button>
                                    </a>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
						$i++;
					endforeach;
				}
				?>
            </div>
        </div>

        <?= $this->render('pagination_page', ['countryId' => $countryId,'page' => $page,'numPage' => $numPage]) ?>

    </div>
</div>