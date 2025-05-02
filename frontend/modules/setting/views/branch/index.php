<?php

use common\models\ModelMaster;

$this->title = 'Branch';
$page = "list"
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
            <?= $this->render('filter_list', ['countries' => $countries,'companies' => $company,'page' => $page,'countryIdOld' => $countryId]) ?>
        </div>
        <div class="col-1 pr-0 text-end">
            <div class="btn-group" role="group">
                <a href="<?= Yii::$app->homeUrl . 'setting/branch/branch-grid' ?>"
                    class="btn btn-outline-primary font-size-12 pim-change-modes">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/gridblack.svg" style="cursor: pointer;">
                </a>
                <a href="#" class="btn btn-primary font-size-12 pim-change-modes">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/listwhite.svg" style="cursor: pointer;">
                </a>
            </div>
        </div>
    </div>

    <div class="company-group-edit mt-30">
        <div class="col-12 mt-20 tb0">
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
                    if (isset($branches) && count($branches) > 0) {   
                        $countrow = 0;
                        $i = 1;
                        foreach ($branches as $branch) :
                            $countrow++;
                            $branchId = $branch['branchId'] + 543;
                    ?>

                    <tr class="tr-font list-table-body " id="branch-<?= $branch['branchId'] ?>">
                        <td>
                            <?php
                                    if ($branch["branchImage"] != null) { ?>
                            <img src="<?= Yii::$app->homeUrl ?><?= $branch['branchImage'] ?>" class="width-aa mr-10">
                            <?php
                                    } else { ?>
                            <img src="<?= Yii::$app->homeUrl . 'image/userProfile.png' ?>" class="width-aa mr-10">
                            <?php   
                                    }
                                    ?>
                            <?= $branch['companyName'] ?>
                        </td>
                        <td>
                            <img src="<?= Yii::$app->homeUrl ?><?= $branch['flag'] ?>" class="bangladresh-hrvc mr-10"">
                            <?= Yii::t('app', $branch['countryName']) ?>
                        </td>
                        <td>
                            <div class=" circle-container ml-15">
                            <div class="cycle-current-<?= $branch['totalDepartment'] >= 1 ? 'red' : 'gray' ?>">
                                <img src="<?= Yii::$app->homeUrl ?>image/departments<?= $branch['totalDepartment'] >= 1 ? '' : '-black' ?>.svg"
                                    alt="icon">
                            </div>
                            <div class="cycle-current-<?= $branch['totalDepartment'] >= 2 ? 'red' : 'gray' ?>">
                                <img src="<?= Yii::$app->homeUrl ?>image/departments<?= $branch['totalDepartment'] >= 2 ? '' : '-black' ?>.svg"
                                    alt="icon">
                            </div>
                            <div class="cycle-current-<?= $branch['totalDepartment'] >= 3 ? 'red' : 'gray' ?>">
                                <img src="<?= Yii::$app->homeUrl ?>image/departments<?= $branch['totalDepartment'] >= 3 ? '' : '-black' ?>.svg"
                                    alt="icon">
                            </div>
                            <div class="number-current-cycle ">
                                <?= $branch['totalDepartment'] ?>
                            </div>
        </div>
        </td>
        <td>
            <div class="circle-container ml-15">
                <div class="cycle-current-<?= $branch['totalTeam'] >= 1 ? 'green' : 'gray' ?>">
                    <img src="<?= Yii::$app->homeUrl ?>image/teams<?= $branch['totalTeam'] >= 1 ? '' : '-black' ?>.svg"
                        alt="icon">
                </div>
                <div class="cycle-current-<?= $branch['totalTeam'] >= 2 ? 'green' : 'gray' ?>">
                    <img src="<?= Yii::$app->homeUrl ?>image/teams<?= $branch['totalTeam'] >= 2 ? '' : '-black' ?>.svg"
                        alt="icon">
                </div>
                <div class="cycle-current-<?= $branch['totalTeam'] >= 3 ? 'green' : 'gray' ?>">
                    <img src="<?= Yii::$app->homeUrl ?>image/teams<?= $branch['totalTeam'] >= 3 ? '' : '-black' ?>.svg"
                        alt="icon">
                </div>
                <div class="number-current-cycle "><?= $branch['totalTeam'] ?>
                </div>
            </div>
        </td>
        <td>
            <div class="circle-container ml-15">
                <?php if($branch['totalEmployee'] >= 1 && isset($branch['employees'][0])) { ?>
                <div class="cycle-image mr-3">
                    <img src="<?= Yii::$app->homeUrl ?><?php echo $branch['employees'][0]['picture'] ?>" alt="icon">
                </div>
                <?php }else{ ?>
                <div class="cycle-current-gray"><img src="<?= Yii::$app->homeUrl ?>image/employees-black.svg"
                        alt="icon">
                </div>
                <?php } ?>
                <?php if($branch['totalEmployee'] >= 2 && isset($branch['employees'][1])) { ?>
                <div class="cycle-image mr-3">
                    <img src="<?= Yii::$app->homeUrl ?><?php echo $branch['employees'][1]['picture'] ?>" alt="icon">
                </div>
                <?php }else{ ?>
                <div class="cycle-current-gray"><img src="<?= Yii::$app->homeUrl ?>image/employees-black.svg"
                        alt="icon">
                </div>
                <?php } ?>
                <?php if($branch['totalEmployee'] >= 3 && isset($branch['employees'][2])) { ?>
                <div class="cycle-image mr-3">
                    <img src="<?= Yii::$app->homeUrl ?><?php echo $branch['employees'][2]['picture'] ?>" alt="icon">
                </div>
                <?php }else{ ?>
                <div class="cycle-current-gray"><img src="<?= Yii::$app->homeUrl ?>image/employees-black.svg"
                        alt="icon">
                </div>
                <?php } ?>
                <div class="number-current-cycle ">
                    <?= $branch['totalEmployee'] ?>
                </div>
            </div>
        </td>
        <td class="text-center">
            <a href="
                <?= Yii::$app->homeUrl ?>setting/branch/branch-view/<?= ModelMaster::encodeParams(['branchId' => $branch['branchId']]) ?>"
                class="mr-10" style="margin-top: 5px; ">
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" alt="History" class="pim-icon"
                    style="margin-top: -1px;">
            </a>
            <span class="dropdown" href="#" id="dropdownMenuLink-1" data-bs-toggle="dropdown"
                style="align-self: flex-start;">
                <img src="<?= Yii::$app->homeUrl ?>image/3-dot.svg" alt="icon" style="cursor: pointer;">

            </span>
            <div class="menu-dot ">
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink-1">
                    <li class="pl-4 pr-4">
                        <a href="<?= Yii::$app->homeUrl ?>setting/branch/update-branch/<?= ModelMaster::encodeParams(['branchId' => $branch['branchId']]) ?>"
                            class="dropdown-itemNEWS pl-4  pr-20 mb-5" style="margin-top: -1px; ">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/editblack.svg" alt="History"
                                class="pim-icon mr-10" style="margin-top: -2px;">
                            <?= Yii::t('app', 'edit') ?>
                        </a>
                    </li>
                    <?php if($branch['totalDepartment'] == 0) { ?>
                    <li class="pl-4 pr-4">
                        <a href="<?= Yii::$app->homeUrl ?>setting/department/create/<?= ModelMaster::encodeParams(['companyId' => $branch['companyId'], 'branchId' => $branch['branchId']]) ?>"
                            class="dropdown-itemNEWS pl-4  pr-20 mb-5" style="margin-top: -1px; ">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/editblack.svg" alt="History"
                                class="pim-icon mr-10" style="margin-top: -2px;">
                            <?= Yii::t('app', 'Create') ?>
                        </a>
                    </li>
                    <li class="pl-4 pr-4">
                        <a class="dropdown-itemNEW pl-4 pr-25"
                            href="javascript:deleteBranch(<?= $branch['branchId'] + 543 ?>)">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/delete.svg" alt="Delete"
                                class="pim-icon mr-10" style="margin-top: -2px;">
                            <?= Yii::t('app', 'Delete') ?>
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