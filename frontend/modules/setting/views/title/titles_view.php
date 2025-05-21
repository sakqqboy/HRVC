<?php

use common\models\ModelMaster;

$this->title = 'Title Profile';
$page = 'view';

?>

<div class="contrainer-body mt-33" style="padding-bottom: 31px; ">

    <div class="col-12">
        <div class=" d-flex align-items-center gap-2">
            <img src="<?= Yii::$app->homeUrl ?>image/titles-black.svg" style="width: 24px; height: 24px;">
            <div class="pim-name-title ml-10">
                <?= Yii::t('app', 'Title in Details') ?>
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
                    href="<?= Yii::$app->homeUrl ?>setting/title/no-title/<?= ModelMaster::encodeParams(['branchId' => '']) ?>"><?= Yii::t('app', 'Titles') ?></a>
                <div class="mid-center" style="width: 20px; height: 20px;">
                    <text class="squeezer-text mr-3"> / </text>
                </div>
                <span class="pim-unit-text"><?= $data['departmentName'] ?></span>
            </div>
        </div>

        <div class="row group-details mt-40">
            <div style="display: flex;
                    align-items: center;
                    gap: 29px;
                    align-self: stretch;
                    ">
                <!-- <div class="avatar-preview">
                    <?php if ($data["picture"] != null) { ?>
                    <img src="" class="cycle-big-image">
                    <?php } else { ?>
                    <img src="<?= Yii::$app->homeUrl . 'image/userProfile.png' ?>" class="cycle-big-image">
                    <?php } ?>
                </div> -->
                <div class="mid-center cycle-current-red" style="width: 100px; height: 100px;">
                    <img src="<?= Yii::$app->homeUrl ?>image/departments.svg" style="width: 55px; height: 55px;">
                </div>
                <div class=" column">
                    <span class="font-size-20" style="font-weight: 600;">
                        <?= $data['departmentName'] ?>
                    </span>

                    <div class="column">
                        <span class="font-size-16 text-gray-back"
                            style="font-weight: 500; display: flex; align-items: center; gap: 12px;">
                            <?= Yii::t('app', 'Company') ?>
                            <div class="city-crad-company">
                                <div class="cycle-current-yellow" style="width: 20px; height: 20px;">
                                    <img src="<?= Yii::$app->homeUrl . $data['picture'] ?>" class="card-tcf">
                                </div>
                                <?= Yii::t('app', $data['companyName']) ?>
                            </div>
                        </span>

                        <span class="font-size-16 text-gray-back"
                            style="font-weight: 500; display: flex; align-items: center; gap: 12px;">
                            <?= Yii::t('app', 'Branch') ?>
                            <div class="city-crad-company">
                                <div class="cycle-current-yellow" style="width: 20px; height: 20px;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg" alt="icon"
                                        style="width: 10px; height: 10px;">
                                </div>
                                <?= $data['branchName'] ?>
                            </div>
                        </span>

                        <span class=" font-size-16 text-gray-back"
                            style="font-weight: 500; display: flex; align-items: center; gap: 12px;">
                            <?= Yii::t('app', 'Located in') ?>
                            <div class="city-crad-company">
                                <img src="<?= Yii::$app->homeUrl ?>" class="bangladresh-hrvc">
                                <?= $data['city'] ?>,<?= $data['countryName'] ?>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
            <div class="between-start mt-40">
                <div class="col-7">
                    <span class="font-size-16 text-gray-back" style="font-weight: 500;">
                        <?= Yii::t('app', 'Titles (' . $numPage['totalRows'] .')') ?>
                        <hr class="hr-group">
                    </span>
                    <table id="myTable" class="table align-middle table-spacing">
                        <thead class="table-light">
                            <tr class="table-border-weight">
                                <th class="text-start" onclick="sortTitle('titleName')" style="width: 314px;">
                                    <?= Yii::t('app', 'Associated Titles') ?>
                                    <img src="<?= Yii::$app->homeUrl ?>image/sorting.svg" style="cursor: pointer;">
                                </th>
                                <th class="text-start" onclick="sortTitle('employee')" style="width: 230px;">
                                    <?= Yii::t('app', 'Titles Employees') ?>
                                    <img src="<?= Yii::$app->homeUrl ?>image/sorting.svg" style="cursor: pointer;">
                                </th>
                                <th class="text-start" style="width: 30px;">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($titles) && $countTitle > 0) {
                                $countrow = 0;
                                $i = 1;
                                foreach ($titles as $title) :
                                    $countrow++;
                                    $departmentId = $data['departmentId'] + 543;
                            ?>
                            <tr class="tr-font list-table-body" id="department-<?= $title['titleId'] ?>">
                                <td>
                                    <div class="circle-container ml-15">
                                        <div class="cycle-current-blue">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/MasterSetting/title.svg"
                                                alt="icon">
                                        </div>
                                        <?= $title['titleName'] ?>
                                    </div>
                                </td>

                                <td>
                                    <div class="circle-container ml-15">
                                        <?php if($title['totalEmployee'] >= 1 && isset($title['employees'][0])) { ?>
                                        <div class="cycle-image mr-3">
                                            <img src="<?= Yii::$app->homeUrl ?><?php echo $title['employees'][0]['picture'] ?>"
                                                alt="icon">
                                        </div>
                                        <?php }else{ ?>
                                        <div class="cycle-current-gray"><img
                                                src="<?= Yii::$app->homeUrl ?>image/employees-black.svg" alt="icon">
                                        </div>
                                        <?php } ?>
                                        <?php if($title['totalEmployee'] >= 2 && isset($title['employees'][1])) { ?>
                                        <div class="cycle-image mr-3">
                                            <img src="<?= Yii::$app->homeUrl ?><?php echo $title['employees'][1]['picture'] ?>"
                                                alt="icon">
                                        </div>
                                        <?php }else{ ?>
                                        <div class="cycle-current-gray"><img
                                                src="<?= Yii::$app->homeUrl ?>image/employees-black.svg" alt="icon">
                                        </div>
                                        <?php } ?>
                                        <?php if($title['totalEmployee'] >= 3 && isset($title['employees'][2])) { ?>
                                        <div class="cycle-image mr-3">
                                            <img src="<?= Yii::$app->homeUrl ?><?php echo $title['employees'][2]['picture'] ?>"
                                                alt="icon">
                                        </div>
                                        <?php }else{ ?>
                                        <div class="cycle-current-gray"><img
                                                src="<?= Yii::$app->homeUrl ?>image/employees-black.svg" alt="icon">
                                        </div>
                                        <?php } ?>
                                        <div class="number-current-cycle ">
                                            <?= $title['totalEmployee'] ?>
                                        </div>
                                        <div class="bodyname-company">
                                            <?php if($title['totalEmployee'] > 0) { ?>
                                            <a class="see-all-company" style="font-size: 10.5px; "
                                                href="<?= Yii::$app->homeUrl ?>setting/employee/index/<?= ModelMaster::encodeParams(['companyId' => $data['companyId']]) ?>">
                                                <?= Yii::t('app', 'Employees') ?>
                                                <img src="<?= Yii::$app->homeUrl ?>image/see-all.svg" alt="icon"
                                                    style="cursor: pointer;">
                                                </span>
                                            </a>
                                            <?php } ?>
                                            <?php if($title['totalEmployee'] == 0) { ?>
                                            <span class="bodyname-crad-company">
                                                <?= Yii::t('app', 'No Employees Yet') ?>
                                            </span>
                                            <a href="<?= Yii::$app->homeUrl ?>setting/employee/index/<?= ModelMaster::encodeParams(['companyId' => $data['companyId'] ]) ?>"
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
                                    <a onclick="openPopupModalTitle('<?= Yii::$app->homeUrl ?>setting/title/modal-title/<?= ModelMaster::encodeParams(['departmentId' => $data['departmentId'],'titleId' => $title['titleId']]) ?>')"
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
                    <!-- pagination_title -->
                    <?= $this->render('pagination_title', ['departmentId' => $data['departmentId'],'companyId' => $data['companyId'],'branchId' => $data['branchId'],'page' => $page,'numPage' => $numPage]) ?>
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


<div class="modal fade" id="titleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="row" id="titleModalBody" style="width: 100%; padding: 50px; gap: 30px;">
                <!-- AJAX content will be injected here -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="titleDeleteModal" tabindex="-2" aria-labelledby="titleDeleteModal" aria-hidden="true">
</div>