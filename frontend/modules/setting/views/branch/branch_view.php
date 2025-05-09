<?php

use common\models\ModelMaster;

$this->title = 'Branch Profile';
$page = 'view';

?>

<div class="contrainer-body mt-33" style="padding-bottom: 31px; ">

    <div class="col-12">
        <div class=" d-flex align-items-center gap-2">
            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/company.svg" style="width: 24px; height: 24px;">
            <div class="pim-name-title ml-10">
                <?= Yii::t('app', 'Branch in Details') ?>
            </div>
        </div>
    </div>

    <div class="company-group-edit mt-30" style="height: 100vh">
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
                <a class="part-text mr-3"
                    href="<?= Yii::$app->homeUrl ?>setting/branch/no-branch/<?= ModelMaster::encodeParams(['companyId' => '']) ?>">Branch</a>
                <div class="mid-center" style="width: 20px; height: 20px;">
                    <text class="squeezer-text mr-3"> / </text>
                </div>
                <span class="pim-unit-text"><?= $branches['branchName'] ?></span>
            </div>
        </div>

        <div class="row group-details mt-40">
            <div style="display: flex;
                    align-items: center;
                    gap: 29px;
                    align-self: stretch;
                    ">
                <div class="avatar-preview">
                    <?php if ($branches["branchImage"] != null) { ?>
                    <img src="<?= Yii::$app->homeUrl . $branches['branchImage'] ?>" class="cycle-big-image">
                    <?php } else { ?>
                    <img src="<?= Yii::$app->homeUrl . 'image/userProfile.png' ?>" class="cycle-big-image">
                    <?php } ?>
                </div>
                <div class=" column">
                    <span class="font-size-20" style="font-weight: 600;">
                        <?= $branches['branchName'] ?>
                    </span>
                    <div class="column">
                        <span class="font-size-16 text-gray-back"
                            style="font-weight: 500; display: flex; align-items: center; gap: 12px;">
                            <?= Yii::t('app', 'Associated Company') ?>
                            <div class="city-crad-company">
                                <img src="<?= Yii::$app->homeUrl ?><?= $branches['picture'] ?>"
                                    class="bangladresh-hrvc">
                                <?= $branches['companyName'] ?>
                            </div>
                        </span>
                        <span class=" font-size-16 text-gray-back"
                            style="font-weight: 500; display: flex; align-items: center; gap: 12px;">
                            <?= Yii::t('app', 'Located in') ?>
                            <div class="city-crad-company">
                                <img src="<?= Yii::$app->homeUrl ?>" class="bangladresh-hrvc">
                                <?= $branches['city'] ?>,<?= $branches['countryName'] ?>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
            <div class="between-start mt-40">
                <div class="col-7">
                    <span class="font-size-16 text-gray-back" style="font-weight: 500;">
                        <?= Yii::t('app', 'Associated Entities') ?>
                        <hr class="hr-group">
                    </span>
                    <table id="myTable" class="table align-middle table-spacing">
                        <thead class="table-light">
                            <tr class="table-border-weight">
                                <th class="text-start" onclick="sortBranch('brachName')" style="width: 314px;">
                                    <?= Yii::t('app', 'Associated Department') ?>
                                    <img src="/HRVC/frontend/web/image/sorting.svg" style="cursor: pointer;">
                                </th>
                                <th class="text-start" onclick="sortBranch('team')" style="width: 230px;">
                                    <?= Yii::t('app', 'Associated Teams') ?>
                                    <img src="/HRVC/frontend/web/image/sorting.svg" style="cursor: pointer;">
                                </th>
                                <th class="text-start" onclick="sortBranch('employee')" style="width: 230px;">
                                    <?= Yii::t('app', 'Associated Employees') ?>
                                    <img src="/HRVC/frontend/web/image/sorting.svg" style="cursor: pointer;">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($departments) && count($departments) > 0) {
                                $countrow = 0;
                                $i = 1;
                                foreach ($departments as $department) :
                                    $countrow++;
                                    $departmentId = $department['branchId'] + 543;
                            ?>
                            <tr class="tr-font list-table-body" id="department-<?= $department['departmentId'] ?>">
                                <td>
                                    <div class="circle-container ml-15">
                                        <div class="cycle-current-red">
                                            <img src="<?= Yii::$app->homeUrl ?>image/departments.svg" alt="icon">
                                        </div>
                                        <?= $department['departmentName'] ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="circle-container ml-15">
                                        <div
                                            class="cycle-current-<?= $department['totalTeam'] >= 1 ? 'green' : 'gray' ?>">
                                            <img src="<?= Yii::$app->homeUrl ?>image/teams<?= $department['totalTeam'] >= 1 ? '' : '-black' ?>.svg"
                                                alt="icon">
                                        </div>
                                        <div
                                            class="cycle-current-<?= $department['totalTeam'] >= 2 ? 'green' : 'gray' ?>">
                                            <img src="<?= Yii::$app->homeUrl ?>image/teams<?= $department['totalTeam'] >= 2 ? '' : '-black' ?>.svg"
                                                alt="icon">
                                        </div>
                                        <div
                                            class="cycle-current-<?= $department['totalTeam'] >= 3 ? 'green' : 'gray' ?>">
                                            <img src="<?= Yii::$app->homeUrl ?>image/teams<?= $department['totalTeam'] >= 3 ? '' : '-black' ?>.svg"
                                                alt="icon">
                                        </div>
                                        <div class="number-current-cycle "><?= $department['totalTeam'] ?>
                                        </div>
                                        <div class="bodyname-company">
                                            <?php if($department['totalTeam'] > 0) { ?>
                                            <a class="see-all-company" style="font-size: 10.5px; "
                                                href="<?= Yii::$app->homeUrl ?>setting/team/create/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>">
                                                <?= Yii::t('app', 'Teams') ?>
                                                <img src="<?= Yii::$app->homeUrl ?>image/see-all.svg" alt="icon"
                                                    style="cursor: pointer;">
                                                </span>
                                            </a>
                                            <?php } ?>
                                            <?php if($department['totalTeam'] == 0) { ?>
                                            <span class="bodyname-crad-company">
                                                <?= Yii::t('app', 'No Teams Yet') ?>
                                            </span>
                                            <a href="<?= Yii::$app->homeUrl ?>setting/team/create/<?= ModelMaster::encodeParams(['companyId' => $company['companyId'] ]) ?>"
                                                style="text-decoration: none;">
                                                <button class="btn-create-small"
                                                    action="<?= Yii::$app->homeUrl ?>setting/group/create-group">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg"
                                                        style="width: 12px; height: 12px;">
                                                    <?= Yii::t('app', 'Create') ?>
                                                </button>
                                            </a>
                                            <?php } ?>

                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="circle-container ml-15">
                                        <?php if($department['totalEmployee'] >= 1 && isset($department['employees'][0])) { ?>
                                        <div class="cycle-image mr-3">
                                            <img src="<?= Yii::$app->homeUrl ?><?php echo $department['employees'][0]['picture'] ?>"
                                                alt="icon">
                                        </div>
                                        <?php }else{ ?>
                                        <div class="cycle-current-gray"><img
                                                src="<?= Yii::$app->homeUrl ?>image/employees-black.svg" alt="icon">
                                        </div>
                                        <?php } ?>
                                        <?php if($department['totalEmployee'] >= 2 && isset($department['employees'][1])) { ?>
                                        <div class="cycle-image mr-3">
                                            <img src="<?= Yii::$app->homeUrl ?><?php echo $department['employees'][1]['picture'] ?>"
                                                alt="icon">
                                        </div>
                                        <?php }else{ ?>
                                        <div class="cycle-current-gray"><img
                                                src="<?= Yii::$app->homeUrl ?>image/employees-black.svg" alt="icon">
                                        </div>
                                        <?php } ?>
                                        <?php if($department['totalEmployee'] >= 3 && isset($department['employees'][2])) { ?>
                                        <div class="cycle-image mr-3">
                                            <img src="<?= Yii::$app->homeUrl ?><?php echo $department['employees'][2]['picture'] ?>"
                                                alt="icon">
                                        </div>
                                        <?php }else{ ?>
                                        <div class="cycle-current-gray"><img
                                                src="<?= Yii::$app->homeUrl ?>image/employees-black.svg" alt="icon">
                                        </div>
                                        <?php } ?>
                                        <div class="number-current-cycle ">
                                            <?= $department['totalEmployee'] ?>
                                        </div>
                                        <div class="bodyname-company">
                                            <?php if($department['totalEmployee'] > 0) { ?>
                                            <a class="see-all-company" style="font-size: 10.5px; "
                                                href="<?= Yii::$app->homeUrl ?>setting/employee/index/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>">
                                                <?= Yii::t('app', 'Employees') ?>
                                                <img src="<?= Yii::$app->homeUrl ?>image/see-all.svg" alt="icon"
                                                    style="cursor: pointer;">
                                                </span>
                                            </a>
                                            <?php } ?>
                                            <?php if($department['totalEmployee'] == 0) { ?>
                                            <span class="bodyname-crad-company">
                                                <?= Yii::t('app', 'No Employees Yet') ?>
                                            </span>
                                            <a href="<?= Yii::$app->homeUrl ?>setting/employee/index/<?= ModelMaster::encodeParams(['companyId' => $company['companyId'] ]) ?>"
                                                style="text-decoration: none;">
                                                <button type="button" class="btn-create-small"
                                                    action="<?= Yii::$app->homeUrl ?>setting/group/create-group">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg"
                                                        style="width: 12px; height: 12px;">
                                                    <?= Yii::t('app', 'Create') ?>
                                                </button>
                                            </a>
                                            <?php } ?>

                                        </div>
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
                    <?= $this->render('pagination_department', ['countryId' => $branches['branchId'],'page' => $page,'numPage' => $numPage]) ?>
                </div>
                <div class="col-1"></div>
                <div class="col-4">
                    <span class="font-size-16 text-gray-back" style="font-weight: 500;">
                        <?= Yii::t('app', 'Branch Details') ?>
                        <hr class="hr-group">
                    </span>
                    <text>
                        <?= $branches['description'] ?>
                    </text>
                </div>
            </div>
        </div>
    </div>

</div>