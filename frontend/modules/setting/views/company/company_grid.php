<?php

use common\models\ModelMaster;

$this->title = 'company';

// echo $countries;
?>

<div class="contrainer-body mt-10">

    <div class="between-center mt-20" style="width: 100%;">
        <div class="col-9">
            <div class=" d-flex align-items-center gap-2">
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/company.svg"
                    style="width: 24px; height: 24px;">
                <div class="pim-name-title ml-10">
                    Company
                </div>
                <a href="<?= Yii::$app->homeUrl ?>setting/company/create/<?= ModelMaster::encodeParams(['groupId' => $groupId]) ?>"
                    style="text-decoration: none;">
                    <button type="button" class="btn-create" style="padding: 3px 9px;"
                        action="<?= Yii::$app->homeUrl ?>setting/group/create-group"><?= Yii::t('app', 'Create New') ?>
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg"
                            style="width:18px; height:18px; margin-top:-3px;">
                    </button>
                </a>
            </div>
        </div>
        <div class="col-2" style="text-align: right;">
            <?= $this->render('filter_list', ['countries' => $countries]) ?>
        </div>
        <div class="col-1 pr-0 text-end">
            <div class="btn-group" role="group">
                <a href="#" class="btn btn-primary font-size-12 pim-change-modes">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/gridwhite.svg" style="cursor: pointer;">
                </a>
                <a href="<?= Yii::$app->homeUrl . 'setting/company/index' ?>"
                    class="btn btn-outline-primary font-size-12 pim-change-modes">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/listblack.svg" style="cursor: pointer;">
                </a>
            </div>
        </div>
    </div>

    <div class="pim-body company-group-edit bg-white mt-10">
        <div class="alert alert-branch-body" role="alert">
            <div class="row" id="company-branch">
                <?php
				if (isset($companies) && count($companies) > 0) {
					$i = 1;
					foreach ($companies as $company) :
						$maxLength = 200;
						$about = substr($company['about'], 0, $maxLength);
				?>
                <div class="col-lg-6 col-md-5 col-sm-3 col-12">
                    <div class="card-comany">
                        <div class="card-body" style="background: #F9FBFF;  border-radius: 5px;">
                            <div style="display: flex;
                            height: 100%;
                            flex-direction: column;
                            justify-content: space-between;
                            align-items: center;
                            flex-shrink: 0;
                            align-self: stretch;">
                                <!-- ส่วนบน -->
                                <div class="between-center" style="
                                        height: 60px;
                                        gap: 17px;
                                        width: 100%;">
                                    <div style="display: flex; align-items: center; gap: 17px;">
                                        <div class="mid-center"
                                            style="height: 60px; padding: 20.944px 4.189px; gap: 10.472px;">
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
                                            <div class="name-crad-company">
                                                <?= $company['companyName'] ?>
                                            </div>
                                            <div class="city-crad-company">
                                                <img src="<?= Yii::$app->homeUrl ?><?= $company['flag'] ?>"
                                                    class="bangladresh-hrvc">
                                                <?= $company['city'] ?>, <?= $company['countryName'] ?>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="dropdown" href="#" id="dropdownMenuLink-1" data-bs-toggle="dropdown"
                                        style="align-self: flex-start;">
                                        <?php if($company['totalBranch'] > 0) { ?>
                                        <a href="<?= Yii::$app->homeUrl ?>setting/company/company-view/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                            class="btn btn-bg-white-xs mr-5" style="margin-top: 3px; ">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg"
                                                alt="History" class="pim-icon" style="margin-top: -1px;">
                                        </a>
                                        <?php }else { ?>
                                        <a class="btn btn-bg-red-xs mr-5" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop4" onclick="javascript:prepareDeleteKfi(64)"
                                            style="margin-top: 3px;"
                                            onmouseover="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binwhite.svg'"
                                            onmouseout="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg'">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg"
                                                alt="History" class="pim-icon" style="margin-top: -3px;">
                                        </a>
                                        <? } ?>

                                        <img src="<?= Yii::$app->homeUrl ?>image/3-dot.svg" alt="icon"
                                            style="cursor: pointer;">
                                        <!-- <img src="<?= Yii::$app->homeUrl ?>image/menu.svg" alt="icon"
                                                style="cursor: pointer;"> -->
                                    </span>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink-1">
                                        <?php if($company['totalBranch'] == 0) { ?>
                                        <li class="pl-4 pr-4">
                                            <a href="<?= Yii::$app->homeUrl ?>setting/company/company-view/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                                class="dropdown-itemNEWS pl-4  pr-20 mb-5" style="margin-top: -3px;">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg"
                                                    alt="History" class="pim-icon mr-10" style="margin-top: -2px;">
                                                View </a>
                                        </li>
                                        <? } ?>
                                        <li class="pl-4 pr-4">
                                            <a href="<?= Yii::$app->homeUrl ?>setting/company/update-company/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                                class="dropdown-itemNEWS pl-4  pr-20 mb-5" style="margin-top: -1px; ">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/editblack.svg"
                                                    alt="History" class="pim-icon mr-10" style="margin-top: -2px;">
                                                edit </a>
                                        </li>
                                        <?php if($company['totalBranch'] > 0) { ?>
                                        <li class="pl-4 pr-4">
                                            <a class="dropdown-itemNEW pl-4 pr-25" data-bs-toggle="modal"
                                                data-bs-target="#delete-kpi-employee"
                                                href="javascript:deleteCompany(<?= $company['companyId'] ?>)">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/delete.svg"
                                                    alt="Delete" class="pim-icon mr-10" style="margin-top: -2px;">
                                                Delete </a>
                                        </li>
                                        <? } ?>

                                    </ul>
                                </div>

                                <!-- ส่วนล่าง -->
                                <?php if($company['totalBranch'] > 0) { ?>
                                <div style="align-self: stretch; ">
                                    <span class="detailname-crad-company">
                                        Quick Details
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
                                                                Branch
                                                            </span>
                                                            <a class="text-see-all"
                                                                href="<?= Yii::$app->homeUrl ?>setting/branch/create/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>">
                                                                see all
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
                                                                Departments
                                                            </span>
                                                            <?php if($company['totalBranch'] == 0) { ?>
                                                            <button type="button" class="btn-disble-small"
                                                                action="<?= Yii::$app->homeUrl ?>setting/group/create-group">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-black.svg"
                                                                    style="width: 12px; height: 12px;">
                                                                Create
                                                            </button>
                                                            <? } ?>
                                                            <?php if($company['totalBranch'] > 0 && $company['totalDepartment'] == 0) { ?>
                                                            <a
                                                                href="<?= Yii::$app->homeUrl ?>setting/department/create/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>">
                                                                style="text-decoration: none;">
                                                                <button type="button" class="btn-create-small"
                                                                    action="<?= Yii::$app->homeUrl ?>setting/group/create-group">
                                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg"
                                                                        style="width: 12px; height: 12px;">
                                                                    Create
                                                                </button>
                                                            </a>
                                                            <? } ?>
                                                            <?php if($company['totalDepartment'] > 0) { ?>
                                                            <a class="text-see-all"
                                                                href="<?= Yii::$app->homeUrl ?>setting/department/create/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>">
                                                                see all
                                                            </a>
                                                            <? } ?>
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
                                                                Teams
                                                            </span>
                                                            <?php if($company['totalDepartment'] == 0) { ?>
                                                            <button type="button" class="btn-disble-small"
                                                                action="<?= Yii::$app->homeUrl ?>setting/group/create-group">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-black.svg"
                                                                    style="width: 12px; height: 12px;">
                                                                Create
                                                            </button>
                                                            <? } ?>
                                                            <?php if($company['totalDepartment'] > 0 && $company['totalTeam'] == 0) { ?>
                                                            <a href="<?= Yii::$app->homeUrl ?>setting/department/create/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                                                style="text-decoration: none;">
                                                                <button type="button" class="btn-create-small"
                                                                    action="<?= Yii::$app->homeUrl ?>setting/group/create-group">
                                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg"
                                                                        style="width: 12px; height: 12px;">
                                                                    Create
                                                                </button>
                                                            </a>
                                                            <? } ?>
                                                            <?php if($company['totalTeam'] > 0) { ?>
                                                            <a class="text-see-all"
                                                                href="<?= Yii::$app->homeUrl ?>setting/team/create/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>">
                                                                see all
                                                            </a>
                                                            <? } ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row align-items-center">
                                                <div class="col-12 text-left">
                                                    <div class="circle-container">
                                                        <?php if($company['totalEmployee'] >= 1) { ?>
                                                        <div class="cycle-image mr-3">
                                                            <img src="<?= Yii::$app->homeUrl ?><?php echo $company['employees'][0]['picture'] ?>"
                                                                alt="icon">
                                                        </div>
                                                        <? }else{ ?>
                                                        <div class="cycle-current-gray"><img
                                                                src="<?= Yii::$app->homeUrl ?>image/employees-black.svg"
                                                                alt="icon">
                                                        </div>
                                                        <? } ?>
                                                        <?php if($company['totalEmployee'] >= 2) { ?>
                                                        <div class="cycle-image mr-3">
                                                            <img src="<?= Yii::$app->homeUrl ?><?php echo $company['employees'][1]['picture'] ?>"
                                                                alt="icon">
                                                        </div>
                                                        <? }else{ ?>
                                                        <div class="cycle-current-gray"><img
                                                                src="<?= Yii::$app->homeUrl ?>image/employees-black.svg"
                                                                alt="icon">
                                                        </div>
                                                        <? } ?>
                                                        <?php if($company['totalEmployee'] >= 3) { ?>
                                                        <div class="cycle-image mr-3">
                                                            <img src="<?= Yii::$app->homeUrl ?><?php echo $company['employees'][2]['picture'] ?>"
                                                                alt="icon">
                                                        </div>
                                                        <? }else{ ?>
                                                        <div class="cycle-current-gray"><img
                                                                src="<?= Yii::$app->homeUrl ?>image/employees-black.svg"
                                                                alt="icon">
                                                        </div>
                                                        <? } ?>
                                                        <div class="number-current-cycle ">
                                                            <?= $company['totalEmployee'] ?>
                                                        </div>
                                                        <div class="bodyname-company">
                                                            <span class="bodyname-crad-company">
                                                                Employees
                                                            </span>
                                                            <?php if($company['totalTeam'] == 0) { ?>
                                                            <button type="button" class="btn-disble-small"
                                                                action="<?= Yii::$app->homeUrl ?>setting/group/create-group">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-black.svg"
                                                                    style="width: 12px; height: 12px;">
                                                                Create
                                                            </button>
                                                            <? } ?>
                                                            <?php if($company['totalTeam'] > 0 && $company['totalEmployee'] == 0) { ?>
                                                            <a href="<?= Yii::$app->homeUrl ?>setting/employee/index/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                                                style="text-decoration: none;"></a>
                                                            <button type="button" class="btn-create-small"
                                                                action="<?= Yii::$app->homeUrl ?>setting/group/create-group">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg"
                                                                    style="width: 12px; height: 12px;">
                                                                Create
                                                            </button>
                                                            </a>
                                                            <? } ?>
                                                            <?php if($company['totalEmployee'] > 0) { ?>
                                                            <a class="text-see-all" style="font-size: 10.5px; "
                                                                href="<?= Yii::$app->homeUrl ?>setting/employee/index/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>">
                                                                see all
                                                            </a>
                                                            <? } ?>
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
                                        No associated branch, department, team, or employee found!
                                    </span>
                                    <a href="<?= Yii::$app->homeUrl ?>setting/company/create/<?= ModelMaster::encodeParams(['groupId' => $groupId]) ?>"
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

    </div>
</div>