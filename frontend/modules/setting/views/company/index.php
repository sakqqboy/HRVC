<?php

use common\models\ModelMaster;

$this->title = 'company';
$page = "list"
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
                    <button type="button" class="btn-create mr-5"
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
                <!-- <a href="<?= Yii::$app->homeUrl . 'setting/company/company-grid' ?>"
                    class="btn btn-outline-primary font-size-12 pim-change-modes">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/gridblack.svg" style="cursor: pointer;">
                </a>
                <a href="#" class="btn btn-primary font-size-12 pim-change-modes">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/listwhite.svg" style="cursor: pointer;">
                </a> -->
                <a href="<?= Yii::$app->homeUrl . 'setting/company/company-grid' ?>"
                    class="btn btn-outline-primary font-size-12 pim-change-modes"
                    style="border-color: #CBD5E1 !important;">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/gridblack.svg"
                        style="cursor: pointer; margin-top:2px;">
                </a>
                <a href="#" class="btn btn-primary font-size-12 pim-change-modes">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/listwhite.svg"
                        style="cursor: pointer; margin-top:2px;">
                </a>
            </div>
        </div>
    </div>

    <div class="company-group-edit mt-20">
        <div class="col-12 tb0">
            <table id="myTable" class="table align-middle table-spacing">
                <thead class="table-light">
                    <tr class="table-border-weight">
                        <th class="text-start" onclick="sortCompany('companyName')">
                            <?= Yii::t('app', 'Company Name') ?>
                            <img src="<?= Yii::$app->homeUrl ?>image/sorting.svg" style="cursor: pointer;">
                        </th>
                        <th class="text-start" onclick="sortCompany('country')">
                            <?= Yii::t('app', 'Country') ?>
                            <img src="<?= Yii::$app->homeUrl ?>image/sorting.svg" style="cursor: pointer;">
                        </th>
                        <th class="text-start" onclick="sortCompany('branch')">
                            <?= Yii::t('app', 'Branch') ?>
                            <img src="<?= Yii::$app->homeUrl ?>image/sorting.svg" style="cursor: pointer;">
                        </th>
                        <th class="text-start" onclick="sortCompany('department')">
                            <?= Yii::t('app', 'Department') ?>
                            <img src="<?= Yii::$app->homeUrl ?>image/sorting.svg" style="cursor: pointer;">
                        </th>
                        <th class="text-start" onclick="sortCompany('team')">
                            <?= Yii::t('app', 'Team') ?>
                            <img src="<?= Yii::$app->homeUrl ?>image/sorting.svg" style="cursor: pointer;">
                        </th>
                        <th class="text-start" onclick="sortCompany('employee')">
                            <?= Yii::t('app', 'Employee') ?>
                            <img src="<?= Yii::$app->homeUrl ?>image/sorting.svg" style="cursor: pointer;">
                        </th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    if (isset($companies) && count($companies) > 0) {   
                        $countrow = 0;
                        $i = 1;
                        foreach ($companies as $company) :
                            $maxLength = 200;
                            $about = substr(Yii::t('app', $company['about']), 0, $maxLength);
                            $countrow++;
                    ?>

                    <tr class="tr-font list-table-body " id="company-<?= $company['companyId'] ?>">
                        <td>
                            <?php
                                    if ($company["picture"] != null) { ?>
                            <img src="<?= Yii::$app->homeUrl ?><?= $company['picture'] ?>"
                                class="bangladresh-hrvc mr-10">
                            <?php
                                    } else { ?>
                            <img src="<?= Yii::$app->homeUrl . 'image/no-company.svg' ?>"
                                class="bangladresh-hrvc mr-10">
                            <?php
                                    }
                                    ?>
                            <?= $company['companyName'] ?>
                        </td>
                        <td>
                            <img src="<?= Yii::$app->homeUrl ?><?= $company['flag'] ?>" class="bangladresh-hrvc mr-10"">
                            <?= Yii::t('app', $company['countryName']) ?>
                        </td>
                        <td>
                            <div class=" circle-container ml-15 ml-15">
                            <div class="cycle-current-<?= $company['totalBranch'] >= 1 ? 'yellow' : 'gray' ?>">
                                <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg" alt="icon">
                            </div>
                            <div class="cycle-current-<?= $company['totalBranch'] >= 2 ? 'yellow' : 'gray' ?>">
                                <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg" alt="icon">
                            </div>
                            <div class="cycle-current-<?= $company['totalBranch'] >= 3 ? 'yellow' : 'gray' ?>">
                                <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg" alt="icon">
                            </div>
                            <div class="number-current-cycle ">
                                <?= $company['totalBranch'] ?>
                            </div>
                        </td>
                        <td>
                            <div class="circle-container ml-15">
                                <div class="cycle-current-<?= $company['totalDepartment'] >= 1 ? 'red' : 'gray' ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>image/departments<?= $company['totalDepartment'] >= 1 ? '' : '-black' ?>.svg"
                                        alt="icon">
                                </div>
                                <div class="cycle-current-<?= $company['totalDepartment'] >= 2 ? 'red' : 'gray' ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>image/departments<?= $company['totalDepartment'] >= 2 ? '' : '-black' ?>.svg"
                                        alt="icon">
                                </div>
                                <div class="cycle-current-<?= $company['totalDepartment'] >= 3 ? 'red' : 'gray' ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>image/departments<?= $company['totalDepartment'] >= 3 ? '' : '-black' ?>.svg"
                                        alt="icon">
                                </div>
                                <div class="number-current-cycle ">
                                    <?= $company['totalDepartment'] ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="circle-container ml-15">
                                <div class="cycle-current-<?= $company['totalTeam'] >= 1 ? 'green' : 'gray' ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>image/teams<?= $company['totalTeam'] >= 1 ? '' : '-black' ?>.svg"
                                        alt="icon">
                                </div>
                                <div class="cycle-current-<?= $company['totalTeam'] >= 2 ? 'green' : 'gray' ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>image/teams<?= $company['totalTeam'] >= 2 ? '' : '-black' ?>.svg"
                                        alt="icon">
                                </div>
                                <div class="cycle-current-<?= $company['totalTeam'] >= 3 ? 'green' : 'gray' ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>image/teams<?= $company['totalTeam'] >= 3 ? '' : '-black' ?>.svg"
                                        alt="icon">
                                </div>
                                <div class="number-current-cycle "><?= $company['totalTeam'] ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="circle-container ml-15">
                                <?php if($company['totalEmployee'] >= 1 && isset($company['employees'][0])) { ?>
                                <div class="cycle-image mr-3">
                                    <img src="<?= Yii::$app->homeUrl ?><?php echo $company['employees'][0]['picture'] ?>"
                                        alt="icon">
                                </div>
                                <?php }else{ ?>
                                <div class="cycle-current-gray"><img
                                        src="<?= Yii::$app->homeUrl ?>image/employees-black.svg" alt="icon">
                                </div>
                                <?php } ?>
                                <?php if($company['totalEmployee'] >= 2 && isset($company['employees'][1])) { ?>
                                <div class="cycle-image mr-3">
                                    <img src="<?= Yii::$app->homeUrl ?><?php echo $company['employees'][1]['picture'] ?>"
                                        alt="icon">
                                </div>
                                <?php }else{ ?>
                                <div class="cycle-current-gray"><img
                                        src="<?= Yii::$app->homeUrl ?>image/employees-black.svg" alt="icon">
                                </div>
                                <?php } ?>
                                <?php if($company['totalEmployee'] >= 3 && isset($company['employees'][2])) { ?>
                                <div class="cycle-image mr-3">
                                    <img src="<?= Yii::$app->homeUrl ?><?php echo $company['employees'][2]['picture'] ?>"
                                        alt="icon">
                                </div>
                                <?php }else{ ?>
                                <div class="cycle-current-gray"><img
                                        src="<?= Yii::$app->homeUrl ?>image/employees-black.svg" alt="icon">
                                </div>
                                <?php } ?>
                                <div class="number-current-cycle ">
                                    <?= $company['totalEmployee'] ?>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <a href="
                                        <?= Yii::$app->homeUrl ?>setting/company/company-view/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                class="mr-10" style="margin-top: 5px; text-decoration: none;">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" alt="History"
                                    class="pim-icon" style="margin-top: -1px;">
                            </a>
                            <span class="dropdown" href="#" id="dropdownMenuLink-1" data-bs-toggle="dropdown"
                                style="align-self: flex-start;">
                                <img src="<?= Yii::$app->homeUrl ?>image/3-dot.svg" alt="icon" style="cursor: pointer;">

                            </span>
                            <div class="menu-dot ">
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink-1">
                                    <li class="pl-9 pr-9">
                                        <!-- <a href="<?= Yii::$app->homeUrl ?>setting/company/update-company/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                            class="dropdown-itemNEWS pl-4  pr-20 mb-5" style="margin-top: -1px; ">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/editblack.svg"
                                                alt="History" class="pim-icon mr-10" style="margin-top: -2px;">
                                            <?= Yii::t('app', 'edit') ?>
                                        </a> -->
                                        <a href="<?= Yii::$app->homeUrl ?>setting/company/update-company/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                            class="btn btn-bg-white-xs">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/editblack.svg"
                                                alt="History" class="pim-icon" style="margin-top: -1px;">
                                        </a>
                                    </li>
                                    <?php if($company['totalBranch'] == 0) { ?>
                                    <li class="pl-9 pr-9 mt-9 mb-9">
                                        <!-- <a href="<?= Yii::$app->homeUrl ?>setting/branch/create/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                            class="dropdown-itemNEWS pl-4  pr-20 mb-5" style="margin-top: -1px; ">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/editblack.svg"
                                                alt="History" class="pim-icon mr-10" style="margin-top: -2px;">
                                            <?= Yii::t('app', 'Create') ?>
                                        </a> -->
                                        <a href="<?= Yii::$app->homeUrl ?>setting/branch/create/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                            class="btn btn-bg-white-xs">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-black.svg"
                                                alt="History" class="pim-icon" style="margin-top: -1px;">
                                        </a>
                                    </li>
                                    <li class="pl-9 pr-9">
                                        <!-- <a class="dropdown-itemNEW pl-4 pr-25"
                                            href="javascript:deleteCompany(<?= $company['companyId'] ?>)">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/delete.svg"
                                                alt="Delete" class="pim-icon mr-10" style="margin-top: -2px;">
                                            <?= Yii::t('app', 'Delete') ?>
                                        </a> -->
                                        <a class="btn btn-bg-red-xs"
                                            href="javascript:deleteCompany(<?= $company['companyId'] ?>)"
                                            style="margin-top: 3px;"
                                            onmouseover="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binwhite.svg'"
                                            onmouseout="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg'">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg"
                                                alt="History" class="pim-icon" style="margin-top: -3px;">
                                        </a>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </td>
                    </tr>

                    <?php
                            $i++;
                        endforeach;
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <?= $this->render('pagination_page', ['countryId' => $countryId,'page' => $page,'numPage' => $numPage]) ?>


    </div>
</div>