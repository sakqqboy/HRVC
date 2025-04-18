<?php

use common\models\ModelMaster;

$this->title = 'company';
?>
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->

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
                <a href="<?= Yii::$app->homeUrl . 'setting/company/company-grid' ?>"
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
            <table class="table align-middle">
                <thead class="table-light">
                    <tr class="table-border-weight">
                        <th class="text-start">Company Name</th>
                        <th class="text-start">Country</th>
                        <th class="text-start">Branch</th>
                        <th class="text-start">Department</th>
                        <th class="text-start">Team</th>
                        <th class="text-start">Employee</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($companies) && count($companies) > 0) {   
                        $i = 1;
                        foreach ($companies as $company) :
                            $maxLength = 200;
                            $about = substr($company['about'], 0, $maxLength);
                    ?>
                    <tr class="tr-font" id="company-<?= $company['companyId'] ?>">

                        <td>
                            <?php
                                    if ($company["picture"] != null) { ?>
                            <img src="<?= Yii::$app->homeUrl ?><?= $company['picture'] ?>" class="width-aa">
                            <?php
                                    } else { ?>
                            <img src="<?= Yii::$app->homeUrl . 'image/userProfile.png' ?>" class="width-aa">
                            <?php
                                    }
                                    ?>
                            <?= $company['companyName'] ?>
                        </td>
                        <td>
                            <img src="<?= Yii::$app->homeUrl ?><?= $company['flag'] ?>" class="bangladresh-hrvc">
                            <?= $company['countryName'] ?>
                        </td>
                        <td>
                            <div class="circle-container ml-15 ml-15">
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
                                <?php if($company['totalEmployee'] >= 1) { ?>
                                <div class="cycle-image mr-3">
                                    <img src="<?= Yii::$app->homeUrl ?><?php echo $company['employees'][0]['picture'] ?>"
                                        alt="icon">
                                </div>
                                <?php }else{ ?>
                                <div class="cycle-current-gray"><img
                                        src="<?= Yii::$app->homeUrl ?>image/employees-black.svg" alt="icon">
                                </div>
                                <?php } ?>
                                <?php if($company['totalEmployee'] >= 2) { ?>
                                <div class="cycle-image mr-3">
                                    <img src="<?= Yii::$app->homeUrl ?><?php echo $company['employees'][1]['picture'] ?>"
                                        alt="icon">
                                </div>
                                <?php }else{ ?>
                                <div class="cycle-current-gray"><img
                                        src="<?= Yii::$app->homeUrl ?>image/employees-black.svg" alt="icon">
                                </div>
                                <?php } ?>
                                <?php if($company['totalEmployee'] >= 3) { ?>
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
                                class="mr-10" style="margin-top: 5px; ">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" alt="History"
                                    class="pim-icon" style="margin-top: -1px;">
                            </a>
                            <span class="dropdown" href="#" id="dropdownMenuLink-1" data-bs-toggle="dropdown"
                                style="align-self: flex-start;">
                                <img src="<?= Yii::$app->homeUrl ?>image/3-dot.svg" alt="icon" style="cursor: pointer;">

                            </span>
                            <div class="menu-dot ">
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink-1">
                                    <li class="pl-4 pr-4">
                                        <a href="<?= Yii::$app->homeUrl ?>setting/company/update-company/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                            class="dropdown-itemNEWS pl-4  pr-20 mb-5" style="margin-top: -1px; ">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/editblack.svg"
                                                alt="History" class="pim-icon mr-10" style="margin-top: -2px;">
                                            edit </a>
                                    </li>
                                    <?php if($company['totalBranch'] == 0) { ?>
                                    <li class="pl-4 pr-4">
                                        <a class="dropdown-itemNEW pl-4 pr-25"
                                            href="javascript:deleteCompany(<?= $company['companyId'] ?>)">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/delete.svg"
                                                alt="Delete" class="pim-icon mr-10" style="margin-top: -2px;">
                                            Delete </a>
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
    </div>
</div>