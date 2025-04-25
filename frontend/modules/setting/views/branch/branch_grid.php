<?php

use common\models\ModelMaster;

$this->title = 'Branch';
$page = "grid"
// echo $countries;
?>
<div class="contrainer-body mt-10">

    <div class="between-center mt-20" style="width: 100%;">
        <div class="col-9">
            <div class=" d-flex align-items-center gap-2">
                <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg" style="width: 24px; height: 24px;">
                <div class="pim-name-title ml-10">
                    <?= Yii::t('app', 'Branch') ?>
                </div>
                <?php if($role >= 5 ) { ?>
                <a href="<?= Yii::$app->homeUrl ?>setting/branch/create/<?= ModelMaster::encodeParams(['companyId' => '']) ?>"
                    style="text-decoration: none;">
                    <button type="button" class="btn-create" style="padding: 3px 9px;"
                        action="<?= Yii::$app->homeUrl ?>setting/branch/create-branch"><?= Yii::t('app', 'Create New') ?>
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg"
                            style="width:18px; height:18px; margin-top:-3px;">
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
                <a href="#" class="btn btn-primary font-size-12 pim-change-modes">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/gridwhite.svg" style="cursor: pointer;">
                </a>
                <a href="<?= Yii::$app->homeUrl . 'setting/branch/index' ?>"
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
				if (isset($branches) && count($branches) > 0) {
					$i = 1;
					foreach ($branches as $branch) :
						$maxLength = 200;
						// $about = substr(Yii::t('app', $branch['about']), 0, $maxLength);
				?>
                <div class="col-lg-6 col-md-5 col-sm-3 col-12" id="branch-<?php echo $branch['branchId'] ?>">
                    <div class="card-comany" style="height: auto;">
                        <div class="card-body" style=" background: #F9FBFF;  border-radius: 5px;">
                            <div class="between-center"
                                style="flex-direction: column;  gap: 20px;  align-self: stretch;">
                                <!-- ส่วนบน -->
                                <div class="between-center" style=" gap: 17px; width: 100%;">
                                    <div style="display: flex; align-items: center; gap: 17px;">
                                        <div class="mid-center"
                                            style="height: 60px; padding: 20.944px 4.189px; gap: 10px;">
                                            <?php
                                                    if ($branch["branchImage"] != null) { ?>
                                            <img src="<?= Yii::$app->homeUrl ?><?= $branch['branchImage'] ?>"
                                                class="card-tcf">
                                            <?php
                                                    } else { ?>
                                            <img src="<?= Yii::$app->homeUrl . $branch['picture'] ?>" class="card-tcf">
                                            <?php
                                                    }
                                                ?>
                                        </div>
                                        <div class="header-crad-company">
                                            <div class="name-crad-company">
                                                <?= $branch['branchName'] ?>
                                            </div>
                                            <div class="city-crad-company">
                                                <img src="<?= Yii::$app->homeUrl ?><?= $branch['picture'] ?>"
                                                    class="bangladresh-hrvc">
                                                <?= Yii::t('app', $branch['companyName']) ?>
                                            </div>
                                            <div class="city-crad-company">
                                                <img src="<?= Yii::$app->homeUrl ?><?= $branch['flag'] ?>"
                                                    class="bangladresh-hrvc">
                                                <?= $branch['city'] ?>, <?= Yii::t('app', $branch['countryName']) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin-bottom: 30px;">
                                        <?php if($branch['totalDepartment'] > 0) { ?>
                                        <a href="
                                        <?= Yii::$app->homeUrl ?>setting/branch/branch-view/<?= ModelMaster::encodeParams(['companyId' => $branch['companyId']]) ?>"
                                            class="btn btn-bg-white-xs mr-5" style="margin-top: 3px; ">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg"
                                                alt="History" class="pim-icon" style="margin-top: -1px;">
                                        </a>
                                        <?php }else { ?>
                                        <!-- <a href="javascript:deleteBranch(<?= $branch['branchId'] + 543 ?>)"
                                            class="btn btn-sm btn-outline-danger font-size-12">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a> -->
                                        <a class="btn btn-bg-red-xs mr-5"
                                            href="javascript:deleteBranch(<?= $branch['branchId'] + 543 ?>)"
                                            style="margin-top: 3px;"
                                            onmouseover="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binwhite.svg'"
                                            onmouseout="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg'">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg"
                                                alt="History" class="pim-icon" style="margin-top: -3px;">
                                        </a>
                                        <?php } ?>
                                        <span class="dropdown" href="#" id="dropdownMenuLink-1"
                                            data-bs-toggle="dropdown" style="align-self: flex-start;">
                                            <img src="<?= Yii::$app->homeUrl ?>image/3-dot.svg" alt="icon"
                                                style="cursor: pointer;">
                                        </span>
                                        <div class="menu-dot ">
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink-1">
                                                <?php if($branch['totalDepartment'] == 0) { ?>
                                                <li class="pl-4 pr-4">
                                                    <a href="<?= Yii::$app->homeUrl ?>setting/branch/branch-view/<?= ModelMaster::encodeParams(['companyId' => $branch['companyId']]) ?>"
                                                        class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                        style="margin-top: -3px;">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg"
                                                            alt="History" class="pim-icon mr-10"
                                                            style="margin-top: -2px;">
                                                        <?= Yii::t('app', 'View') ?>
                                                    </a>
                                                </li>
                                                <?php } ?>
                                                <li class="pl-4 pr-4">
                                                    <a href="<?= Yii::$app->homeUrl ?>setting/branch/update-branch/<?= ModelMaster::encodeParams(['branchId' => $branch['branchId'] + 543]) ?>"
                                                        class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                        style="margin-top: -1px; ">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/editblack.svg"
                                                            alt="History" class="pim-icon mr-10"
                                                            style="margin-top: -2px;">
                                                        <?= Yii::t('app', 'edit') ?>
                                                    </a>
                                                    <!-- <a href="javascript:updateBranch(<?= $branch['branchId'] + 543 ?>)"
                                                        class="btn btn-sm btn-outline-secondary font-size-12 mr-5">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </a> -->
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- ส่วนล่าง -->
                                <?php
                                // echo $branch['totalDepartment']; 
                                if($branch['totalDepartment'] > 0) { 
                                    ?>
                                <div style="align-self: stretch;  height: 147px ">
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
                                                            class="cycle-current-<?= $branch['totalDepartment'] >= 1 ? 'red' : 'gray' ?>">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/departments<?= $branch['totalDepartment'] >= 1 ? '' : '-black' ?>.svg"
                                                                alt="icon">
                                                        </div>
                                                        <div
                                                            class="cycle-current-<?= $branch['totalDepartment'] >= 2 ? 'red' : 'gray' ?>">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/departments<?= $branch['totalDepartment'] >= 2 ? '' : '-black' ?>.svg"
                                                                alt="icon">
                                                        </div>
                                                        <div
                                                            class="cycle-current-<?= $branch['totalDepartment'] >= 3 ? 'red' : 'gray' ?>">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/departments<?= $branch['totalDepartment'] >= 3 ? '' : '-black' ?>.svg"
                                                                alt="icon">
                                                        </div>
                                                        <div class="number-current-cycle ">
                                                            <?= $branch['totalDepartment'] ?>
                                                        </div>
                                                        <div class="bodyname-company">
                                                            <span class="bodyname-crad-company">
                                                                <?= Yii::t('app', 'Departments') ?>
                                                            </span>
                                                            <?php if($branch['totalDepartment'] == 0) { ?>
                                                            <button type="button" class="btn-disble-small"
                                                                action="<?= Yii::$app->homeUrl ?>setting/group/create-group">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-black.svg"
                                                                    style="width: 12px; height: 12px;">
                                                                <?= Yii::t('app', 'Create') ?>
                                                            </button>
                                                            <?php } ?>
                                                            <?php if($branch['totalDepartment'] > 0 && $branch['totalDepartment'] == 0) { ?>
                                                            <a
                                                                href="<?= Yii::$app->homeUrl ?>setting/department/create/<?= ModelMaster::encodeParams(['companyId' => $branch['companyId']]) ?>">
                                                                style="text-decoration: none;">
                                                                <button type="button" class="btn-create-small"
                                                                    action="<?= Yii::$app->homeUrl ?>setting/group/create-group">
                                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg"
                                                                        style="width: 12px; height: 12px;">
                                                                    <?= Yii::t('app', 'Create') ?>
                                                                </button>
                                                            </a>
                                                            <?php } ?>
                                                            <?php if($branch['totalDepartment'] > 0) { ?>
                                                            <a class="text-see-all"
                                                                href="<?= Yii::$app->homeUrl ?>setting/department/create/<?= ModelMaster::encodeParams(['companyId' => $branch['companyId']]) ?>">
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
                                                            class="cycle-current-<?= $branch['totalTeam'] >= 1 ? 'green' : 'gray' ?>">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/teams<?= $branch['totalTeam'] >= 1 ? '' : '-black' ?>.svg"
                                                                alt="icon">
                                                        </div>
                                                        <div
                                                            class="cycle-current-<?= $branch['totalTeam'] >= 2 ? 'green' : 'gray' ?>">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/teams<?= $branch['totalTeam'] >= 2 ? '' : '-black' ?>.svg"
                                                                alt="icon">
                                                        </div>
                                                        <div
                                                            class="cycle-current-<?= $branch['totalTeam'] >= 3 ? 'green' : 'gray' ?>">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/teams<?= $branch['totalTeam'] >= 3 ? '' : '-black' ?>.svg"
                                                                alt="icon">
                                                        </div>
                                                        <div class="number-current-cycle "><?= $branch['totalTeam'] ?>
                                                        </div>
                                                        <div class="bodyname-company">
                                                            <span class="bodyname-crad-company">
                                                                <?= Yii::t('app', 'Teams') ?>
                                                            </span>
                                                            <?php if($branch['totalDepartment'] == 0) { ?>
                                                            <button type="button" class="btn-disble-small"
                                                                action="<?= Yii::$app->homeUrl ?>setting/group/create-group">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-black.svg"
                                                                    style="width: 12px; height: 12px;">
                                                                <?= Yii::t('app', 'Create') ?>
                                                            </button>
                                                            <?php } ?>
                                                            <?php if($branch['totalDepartment'] > 0 && $branch['totalTeam'] == 0) { ?>
                                                            <a href="<?= Yii::$app->homeUrl ?>setting/department/create/<?= ModelMaster::encodeParams(['companyId' => $branch['companyId']]) ?>"
                                                                style="text-decoration: none;">
                                                                <button type="button" class="btn-create-small"
                                                                    action="<?= Yii::$app->homeUrl ?>setting/group/create-group">
                                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg"
                                                                        style="width: 12px; height: 12px;">
                                                                    <?= Yii::t('app', 'Create') ?>
                                                                </button>
                                                            </a>
                                                            <?php } ?>
                                                            <?php if($branch['totalTeam'] > 0) { ?>
                                                            <a class="text-see-all"
                                                                href="<?= Yii::$app->homeUrl ?>setting/team/create/<?= ModelMaster::encodeParams(['companyId' => $branch['companyId']]) ?>">
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
                                                        <?php if(count($branch['employees']) >= 1) { ?>
                                                        <div class="cycle-image mr-3">
                                                            <img src="<?= Yii::$app->homeUrl ?><?php echo $branch['employees'][0]['picture'] ?>"
                                                                alt="icon">
                                                        </div>
                                                        <?php }else{ ?>
                                                        <div class="cycle-current-gray"><img
                                                                src="<?= Yii::$app->homeUrl ?>image/employees-black.svg"
                                                                alt="icon">
                                                        </div>
                                                        <?php } ?>
                                                        <?php if(count($branch['employees']) >= 2) { ?>
                                                        <div class="cycle-image mr-3">
                                                            <img src="<?= Yii::$app->homeUrl ?><?php echo $branch['employees'][1]['picture'] ?>"
                                                                alt="icon">
                                                        </div>
                                                        <?php }else{ ?>
                                                        <div class="cycle-current-gray"><img
                                                                src="<?= Yii::$app->homeUrl ?>image/employees-black.svg"
                                                                alt="icon">
                                                        </div>
                                                        <?php } ?>
                                                        <?php if(count($branch['employees']) >= 3) { ?>
                                                        <div class="cycle-image mr-3">
                                                            <img src="<?= Yii::$app->homeUrl ?><?php echo $branch['employees'][2]['picture'] ?>"
                                                                alt="icon">
                                                        </div>
                                                        <?php }else{ ?>
                                                        <div class="cycle-current-gray"><img
                                                                src="<?= Yii::$app->homeUrl ?>image/employees-black.svg"
                                                                alt="icon">
                                                        </div>
                                                        <?php } ?>
                                                        <div class="number-current-cycle ">
                                                            <?= $branch['totalEmployee'] ?>
                                                        </div>
                                                        <div class="bodyname-company">
                                                            <span class="bodyname-crad-company">
                                                                <?= Yii::t('app', 'Employees') ?>
                                                            </span>
                                                            <?php if($branch['totalTeam'] == 0) { ?>
                                                            <button type="button" class="btn-disble-small"
                                                                action="<?= Yii::$app->homeUrl ?>setting/group/create-group">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-black.svg"
                                                                    style="width: 12px; height: 12px;">
                                                                <?= Yii::t('app', 'Create') ?>
                                                            </button>
                                                            <?php } ?>
                                                            <?php if($branch['totalTeam'] > 0 && $branch['totalEmployee'] == 0) { ?>
                                                            <a href="<?= Yii::$app->homeUrl ?>setting/employee/index/<?= ModelMaster::encodeParams(['companyId' => $branch['companyId']]) ?>"
                                                                style="text-decoration: none;"></a>
                                                            <button type="button" class="btn-create-small"
                                                                action="<?= Yii::$app->homeUrl ?>setting/group/create-group">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg"
                                                                    style="width: 12px; height: 12px;">
                                                                <?= Yii::t('app', 'Create') ?>
                                                            </button>
                                                            </a>
                                                            <?php } ?>
                                                            <?php if($branch['totalEmployee'] > 0) { ?>
                                                            <a class="text-see-all" style="font-size: 10.5px; "
                                                                href="<?= Yii::$app->homeUrl ?>setting/employee/index/<?= ModelMaster::encodeParams(['companyId' => $branch['companyId']]) ?>">
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
                                        <?= Yii::t('app', 'No associated department, team, or employee found!') ?>
                                    </span>
                                    <a href="<?= Yii::$app->homeUrl ?>setting/department/create/<?= ModelMaster::encodeParams(['branchId' => $branch['branchId'], 'companyId' => $branch['companyId']]) ?>"
                                        style="text-decoration: none;">
                                        <button type="button" class="btn-create" style="padding: 3px 9px;"
                                            action="<?= Yii::$app->homeUrl ?>setting/group/create-group"><?= Yii::t('app', 'Create Department') ?>
                                            <img src="<?= Yii::$app->homeUrl ?>image/arrow-top-r.svg"
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