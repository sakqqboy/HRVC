<?php

use common\models\ModelMaster;

$this->title = 'Titles';
$page = "grid";

?>


<!-- <div class="contrainer-body mt-10"> -->
<div class="mt-60" style="padding: 30px 0px;">

    <div class="between-center" style="width: 100%;">
        <div class="col-8">
            <div class=" d-flex align-items-center gap-2">
                <img src=" <?= Yii::$app->homeUrl ?>image/star-black.svg" style="width: 24px; height: 24px;">
                <div class="pim-name-title ml-10">
                    <?= Yii::t('app', 'Titles') ?>
                </div>
                <a href="<?= Yii::$app->homeUrl ?>setting/title/create/<?= ModelMaster::encodeParams(["companyId" => '', "branchId" => '', "departmentId" => '']) ?>"
                    style="text-decoration: none;">
                    <button type="button" class="btn-create mr-5"
                        style="padding: 0px; width: 93px; height:22.5px; font-size: 12px; font-weight: 600;"
                        action="<?= Yii::$app->homeUrl ?>setting/branch/create-branch"><?= Yii::t('app', 'Create New') ?>
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg"
                            style="width:14px; height:14px; margin-top:-3px;">
                    </button>
                </a>
            </div>
        </div>
        <div class="col-4" style="text-align: right;">
            <?= $this->render('filter_list', ['companies' => $companies, 'branches' => $branches, 'departments' => $departments, 'page' => $page, 'companyIdOld' => $companyId, 'branchIdOld' => $branchId, 'departmentIdOld' => $departmentId]) ?>

        </div>
    </div>
    <div class="company-group-edit bg-white mt-20">
        <div class="row">
            <?php
            if (isset($data) && count($data) > 0) {
                $i = 1;
                foreach ($data as $departmentsId => $department):
            ?>
                    <div class="col-lg-6 col-12 mb-20" id="department">
                        <div class="col-12 title-box">
                            <div class="d-flex mb-20">
                                <div class="d-flex align-items-center">
                                    <div class="mid-center cycle-current-red" style="width: 70px; height: 70px;">
                                        <img src="<?= Yii::$app->homeUrl ?>image/departments.svg"
                                            style="width: 40px; height: 40px;">
                                    </div>
                                </div>
                                <div class="flex-grow-1 pl-10">
                                    <div class="row" style="--bs-gutter-x:0px;padding-right: 6px;">
                                        <div class="col-9 name-crad-company text-truncate pr-5">
                                            <?= $department['departmentName'] ?>
                                        </div>
                                        <div class="col-3 pr-0 pl-0 text-end">
                                            <?php if (count($department['titles']) > 0) { ?>

                                                <a class="btn btn-bg-white-xs mr-3"
                                                    onclick="openPopupModalTitle('<?= Yii::$app->homeUrl ?>setting/title/modal-title/<?= ModelMaster::encodeParams(['departmentId' => $department['departmentId']]) ?>')">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-black.svg"
                                                        alt="History" class="pim-icon"
                                                        style="width: 14px; height: 14px;">
                                                </a>

                                            <?php } ?>
                                            <a href="<?= Yii::$app->homeUrl ?>setting/title/titles-view/<?= ModelMaster::encodeParams(['departmentId' => $department['departmentId']]) ?>"
                                                class="btn btn-bg-white-xs mr-5">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg"
                                                    alt="History" class="pim-icon">
                                            </a>
                                            <span class="dropdown" href="#" id="dropdownMenuLink-1"
                                                data-bs-toggle="dropdown" style="align-self: flex-start;">
                                                <img src="<?= Yii::$app->homeUrl ?>image/3-dot.svg" alt="icon"
                                                    style="cursor: pointer;">
                                            </span>
                                            <div class="menu-dot ">
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink-1">
                                                    <li class="pl-4 pr-4" data-bs-toggle="modal"
                                                        data-bs-target="#staticBackdrop4"
                                                        onclick="javascript:prepareDeleteTitle('<?= $department['departmentId'] ?>')"
                                                        title="Delete">
                                                        <a class="dropdown-itemNEW pl-4 pr-25" href="#">
                                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/delete.svg"
                                                                alt="Delete" class="pim-icon mr-10"
                                                                style="margin-top: -2px;">
                                                            <?= Yii::t('app', 'Delete') ?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="city-crad-company">
                                            <div>
                                                <img src="<?= Yii::$app->homeUrl . $department['picture'] ?>" class="mr-5" style="width:25px;height:25px;border-radius:100%;">
                                            </div>
                                            <div class="pr-5 text-truncate" style="max-width: 360px;">
                                                <?= Yii::t('app', $department['companyName']) ?></div>

                                        </div>
                                    </div>
                                    <div class="col-12 mt-5">
                                        <div class="d-flex justify-content-start">
                                            <div style="max-width:250px;">
                                                <div class="d-flex city-crad-company gap-1">
                                                    <div style="display: flex; align-items: center; gap: 5px;">
                                                        <div class="branch-icon">
                                                            <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg"
                                                                alt="icon" style="width: 12px; height: 12px;">
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 text-truncate">
                                                        <?= $department['branchName'] ?>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="pl-5" style="max-width:200px;">
                                                <div class="d-flex city-crad-company gap-1">
                                                    <div style="display: flex; align-items: center; gap: 5px;">
                                                        <img src="<?= Yii::$app->homeUrl ?><?= $department['flag'] ?>"
                                                            class="bangladresh-hrvc">
                                                    </div>
                                                    <div class="flex-grow-1 text-truncate font-size-14">
                                                        <?= $department['city'] ?>,
                                                        <?= Yii::t('app', $department['countryName']) ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                            // echo $department['totalDepartment'];
                            if (count($department['titles']) > 0) {
                            ?>
                                <div class="" style="align-self: stretch; height: 147px">
                                    <div class="between-start">
                                        <span class="detailname-crad-company mb-14">
                                            <?= Yii::t('app', 'Registered Titles') ?>
                                        </span>
                                        <a class="see-all-company"
                                            href="
                                        <?= Yii::$app->homeUrl ?>setting/title/titles-view/<?= ModelMaster::encodeParams(['departmentId' => $department['departmentId']]) ?>">
                                            <?= Yii::t('app', 'See All') ?>
                                            <img src="<?= Yii::$app->homeUrl ?>image/see-all.svg" alt="icon"
                                                style="cursor: pointer;">
                                        </a>
                                    </div>

                                    <?php if (!empty($department['titles'])): ?>
                                        <div class="row pl-10">
                                            <?php
                                            $limitedDepartments = array_slice($department['titles'], 0, 6);
                                            foreach ($limitedDepartments as $index => $dept):
                                            ?>
                                                <div class="col-6 mb-10">
                                                    <span class="d-flex align-items-center"
                                                        style="font-size: 13px; color: #333;">
                                                        <div class="cycle-current-blue mr-5">
                                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/white-icons/MasterSetting/title.svg"
                                                                alt="icon">
                                                        </div>
                                                        <?= $dept['titleName'] ?>
                                                    </span>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                            <?php } else { ?>
                                <!-- ส่วนล่าง -->
                                <div class="create-crad-company ">
                                    <!-- <?= $department['branchId'] ?> -->
                                    <span class="text-create-crad">
                                        <?= Yii::t('app', 'No associated department, title, or employee found!') ?>
                                    </span>
                                    <a style="text-decoration: none;"
                                        onclick="openPopupModalTitle('<?= Yii::$app->homeUrl ?>setting/title/modal-title/<?= ModelMaster::encodeParams(['departmentId' => $department['departmentId']]) ?>')">
                                        <button type="button" class="btn-create"
                                            style="padding: 3px 9px;"><?= Yii::t('app', 'Create Titles') ?>
                                            <img src="<?= Yii::$app->homeUrl ?>image/arrow-top-r.svg"
                                                style="width:18px; height:18px; margin-top:-3px;">
                                        </button>
                                    </a>
                                </div>
                            <?php }  ?>
                        </div>
                    </div>
            <?php
                    $i++;
                endforeach;
            }
            ?>
        </div>
        <?= $this->render('pagination_page', ['companyId' => $companyId, 'branchId' => $branchId, 'departmentId' => $departmentId, 'page' => $page, 'numPage' => $numPage]) ?>

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

<!-- <div class="modal fade" id="titleDeleteModal" tabindex="-3" aria-labelledby="titleDeleteModal" aria-hidden="true"> -->
<div class="modal fade" id="titleDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdrop4Label" aria-hidden="true">
</div>
<style>
    .title-box {
        background-color: #F9FBFF;
        border-radius: 5px;
        border: 1px solid #BBCDDE;
    }

    .cycle-current-red:not(:last-child) {
        margin-left: 0px;
    }

    .city-crad-company {
        display: inline-flex;
        max-width: 100%;
    }

    .branch-icon {
        width: 20px;
        height: 20px;
        border-radius: 100%;
        background-color: #FED75A;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>