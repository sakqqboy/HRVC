<?php

use common\models\ModelMaster;

$this->title = 'Team Profile';
$page = 'view';

?>

<div class="contrainer-body mt-33" style="padding-bottom: 31px; ">

    <div class="col-12">
        <div class=" d-flex align-items-center gap-2">
            <img src="<?= Yii::$app->homeUrl ?>image/teams-black.svg" style="width: 24px; height: 24px;">
            <div class="pim-name-title ml-10">
                <?= Yii::t('app', 'Team in Details') ?>
            </div>
        </div>
    </div>

    <div class="company-group-edit mt-30" style="height: 110vh">
        <div style="display: flex; align-items: center; gap: 14px;">
            <a href="<?= Yii::$app->request->referrer ?: Yii::$app->homeUrl ?>"
                style="text-decoration: none; width:66px; height:26px;" class="btn-create-branch">
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/back-white.svg"
                    style="width:18px; height:18px; margin-top:-3px;">
                <?= Yii::t('app', 'Back') ?>
            </a>

            <div style="display: flex; align-items: center;">
                <a class="part-text mr-3"
                    href="<?= Yii::$app->homeUrl ?>setting/group/display-group"><?= Yii::t('app', 'Group Config') ?></a>
                <div class="mid-center" style="width: 20px; height: 20px;">
                    <text class="squeezer-text mr-3"> / </text>
                </div>
                <a class="part-text mr-3"
                    href="<?= Yii::$app->homeUrl ?>setting/team/no-team/<?= ModelMaster::encodeParams(['branchId' => '']) ?>"><?= Yii::t('app', 'Teams') ?></a>
                <div class="mid-center" style="width: 20px; height: 20px;">
                    <text class="squeezer-text mr-3"> / </text>
                </div>
                <span class="pim-unit-text"><?= $data['companyName'] ?></span>
            </div>
        </div>

        <div class="row group-details mt-40">
            <div style="display: flex;
                    align-items: center;
                    gap: 29px;
                    align-self: stretch;
                    ">
                <div class="avatar-preview">
                    <?php if ($data["picture"] != null) { ?>
                    <img src="<?= Yii::$app->homeUrl . $data['picture'] ?>" class="cycle-big-image"
                        style="max-width: 100px; max-height: 100px;">
                    <?php } else { ?>
                    <img src="<?= Yii::$app->homeUrl . 'image/no-company.svg' ?>" class="cycle-big-image"
                        style="max-width: 100px; max-height: 100px;">
                    <?php } ?>
                </div>
                <div class=" column">
                    <span class="font-size-20" style="font-weight: 600;">
                        <?= $data['companyName'] ?>
                    </span>
                    <div class="column">
                        <span class="font-size-16 text-gray-back"
                            style="font-weight: 500; display: flex; align-items: center; gap: 12px;">
                            <?= Yii::t('app', 'Branch') ?>
                            <div class="city-crad-company  text-truncate "  style="display: flex; gap: 5px;">
                                <div class="cycle-current-yellow" style="width: 20px; height: 20px;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg" alt="icon"
                                        style="width: 10px; height: 10px;">
                                </div>
                                <?= $data['branchName'] ?>
                            </div>
                        </span>
                        <span class="font-size-16 text-gray-back mt-10"
                            style="font-weight: 500; display: flex; align-items: center; gap: 12px;">
                            <?= Yii::t('app', 'Department') ?>
                            <div class="city-crad-company  text-truncate"  style="display: flex; gap: 5px;">
                                <div class="cycle-current-red" style="width: 20px; height: 20px;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/departments.svg" alt="icon"
                                        style="width: 10px; height: 10px;">
                                </div>
                                <?= $data['departmentName'] ?>
                            </div>
                        </span>
                        <span class=" font-size-16 text-gray-back  mt-10"
                            style="font-weight: 500; display: flex; align-items: center; gap: 12px;">
                            <?= Yii::t('app', 'Located in') ?>
                            <div class="city-crad-company  text-truncate "  style="display: flex; gap: 5px;">
                                <img src="<?= Yii::$app->homeUrl ?><?= $data['flag'] ?>" class="bangladresh-hrvc">
                                <?= $data['city'] ?>,<?= $data['countryName'] ?>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
            <div class="between-start mt-40">
                <div class="col-7">
                    <span class="font-size-16 text-gray-back" style="font-weight: 500;">
                        <?= Yii::t('app', 'Teams (' . $numPage['totalRows'] .')') ?>
                        <hr class="hr-group">
                    </span>
                    <table id="myTable" class="table align-middle table-spacing">
                        <thead class="table-light">
                            <tr class="table-border-weight">
                                <th class="text-start" onclick="sortTeam('teamName')" style="width: 314px;">
                                    <?= Yii::t('app', 'Associated Teams') ?>
                                    <img src="<?= Yii::$app->homeUrl ?>image/sorting.svg" style="cursor: pointer;">
                                </th>
                                <th class="text-start" onclick="sortTeam('employee')" style="width: 230px;">
                                    <?= Yii::t('app', 'Associated Employees') ?>
                                    <img src="<?= Yii::$app->homeUrl ?>image/sorting.svg" style="cursor: pointer;">
                                </th>
                                <th class="text-start" style="width: 30px;">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($teams) && $countTeam > 0) {
                                $countrow = 0;
                                $i = 1;
                                foreach ($teams as $team) :
                                    $countrow++;
                                    $departmentId = $data['departmentId'] + 543;
                            ?>
                            <tr class="tr-font list-table-body" id="department-<?= $team['teamId'] ?>">
                                <td>
                                    <div class="circle-container ml-15">
                                        <div class="cycle-current-red">
                                            <img src="<?= Yii::$app->homeUrl ?>image/departments.svg" alt="icon">
                                        </div>
                                        <?= $team['teamName'] ?>
                                    </div>
                                </td>

                                <td>
                                    <div class="circle-container ml-15">
                                        <?php if($team['totalEmployee'] >= 1 && isset($team['employees'][0])) { ?>
                                        <div class="cycle-image mr-3">
                                            <img src="<?= Yii::$app->homeUrl ?><?php echo $team['employees'][0]['picture'] ?>"
                                                alt="icon">
                                        </div>
                                        <?php }else{ ?>
                                        <div class="cycle-current-gray"><img
                                                src="<?= Yii::$app->homeUrl ?>image/employees-black.svg" alt="icon">
                                        </div>
                                        <?php } ?>
                                        <?php if($team['totalEmployee'] >= 2 && isset($team['employees'][1])) { ?>
                                        <div class="cycle-image mr-3">
                                            <img src="<?= Yii::$app->homeUrl ?><?php echo $team['employees'][1]['picture'] ?>"
                                                alt="icon">
                                        </div>
                                        <?php }else{ ?>
                                        <div class="cycle-current-gray"><img
                                                src="<?= Yii::$app->homeUrl ?>image/employees-black.svg" alt="icon">
                                        </div>
                                        <?php } ?>
                                        <?php if($team['totalEmployee'] >= 3 && isset($team['employees'][2])) { ?>
                                        <div class="cycle-image mr-3">
                                            <img src="<?= Yii::$app->homeUrl ?><?php echo $team['employees'][2]['picture'] ?>"
                                                alt="icon">
                                        </div>
                                        <?php }else{ ?>
                                        <div class="cycle-current-gray"><img
                                                src="<?= Yii::$app->homeUrl ?>image/employees-black.svg" alt="icon">
                                        </div>
                                        <?php } ?>
                                        <div class="number-current-cycle ">
                                            <?= $team['totalEmployee'] ?>
                                        </div>
                                        <div class="bodyname-company">
                                            <?php if($team['totalEmployee'] > 0) { ?>
                                            <a class="see-all-company" style="font-size: 10.5px; "
                                                href="<?= Yii::$app->homeUrl ?>setting/employee/no-employee/<?= ModelMaster::encodeParams(['companyId' => $data['companyId'],'branchId' =>  $data['branchId'],'departmentId' =>  $data['departmentId'],'teamId' => $team['teamId']]) ?>">
                                                <?= Yii::t('app', 'Employees') ?>
                                                <img src="<?= Yii::$app->homeUrl ?>image/see-all.svg" alt="icon"
                                                    style="cursor: pointer;">
                                                </span>
                                            </a>
                                            <?php } ?>
                                            <?php if($team['totalEmployee'] == 0) { ?>
                                            <span class="bodyname-crad-company">
                                                <?= Yii::t('app', 'No Employees Yet') ?>
                                            </span>
                                            <a href="<?= Yii::$app->homeUrl ?>setting/employee/create/<?= ModelMaster::encodeParams(['companyId' => $data['companyId'] ]) ?>"
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
                                <td>
                                    <a onclick="openPopupModalTeam('<?= Yii::$app->homeUrl ?>setting/team/modal-team/<?= ModelMaster::encodeParams(['departmentId' => $data['departmentId'],'teamId' => $team['teamId']]) ?>')"
                                        class="btn btn-bg-white-xs mr-5" style="margin-top: 3px;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/editblack.svg"
                                            alt="edit" class="pim-icon">
                                    </a>
                                </td>
                            </tr>
                            <?php
                                    $i++;
                                endforeach;
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- pagination_team -->
                    <?= $this->render('pagination_team', ['departmentId' => $data['departmentId'],'companyId' => $data['companyId'],'branchId' => $data['branchId'],'page' => $page,'numPage' => $numPage]) ?>
                </div>
                <div class="col-1"></div>
                <div class="col-4">
                    <span class="font-size-16 text-gray-back" style="font-weight: 500;">
                        <?= Yii::t('app', 'Branch Details') ?>
                        <hr class="hr-group">
                    </span>
                    <text>
                        <?= $data['description'] ?>
                    </text>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="modal fade" id="teamModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="row" id="teamModalBody" style="width: 100%; padding: 50px; gap: 30px;">
                <!-- AJAX content will be injected here -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="teamDeleteModal" tabindex="-2" aria-labelledby="teamDeleteModal" aria-hidden="true">
</div>