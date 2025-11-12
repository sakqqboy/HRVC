<?php

use common\models\ModelMaster;

$this->title = 'Department';
$page = "grid";
// echo $data;
?>
<div class="mt-60" style="padding: 30px 0px;">
    <div class="between-center" style="width: 100%;">
        <div class="col-lg-8">
            <div class=" d-flex align-items-center gap-2">
                <img src="<?= Yii::$app->homeUrl ?>image/departments-black.svg" class=""
                    style="width: 24px; height: 24px;">
                <div class="pim-name-title">
                    <?= Yii::t('app', 'Departments') ?>
                </div>
                <?php if ($role >= 5) { ?>
                    <a href="<?= Yii::$app->homeUrl ?>setting/department/create/<?= ModelMaster::encodeParams(['companyId' => '', 'branchId' => '']) ?>"
                        style="text-decoration: none;" class="d-flex align-items-center justify-content-center">
                        <!-- <button type="button" class="create-employee-btn" style="width:93px;height:23px;min-height: 23px;font-size:12px;border:0px;font-weight:600;"
                            action="<?= Yii::$app->homeUrl ?>setting/branch/create-branch"><?= Yii::t('app', 'Create New') ?>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg" class="ms-1"
                                style="width:14px; height:14px; margin-top:-1px;">
                        </button> -->
                        <button type="button" class="btn-create mr-5"
                            style="padding: 0px; width: 93px; height:22.5px; font-size: 12px; font-weight: 600;"
                            action="<?= Yii::$app->homeUrl ?>setting/branch/create-branch"><?= Yii::t('app', 'Create New') ?>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg"
                                style="width:14px; height:14px; margin-top:-3px;">
                        </button>
                    </a>
                <?php } ?>
            </div>
        </div>
        <div class="col-lg-4">
            <?= $this->render('filter_list', ['countries' => $countries, 'companies' => $companies, 'branches' => $branches, 'page' => $page, 'countryIdOld' => $countryId, 'companyIdOld' => $companyId, 'branchIdOld' => $branchId]) ?>
        </div>
    </div>

    <div class="company-group-edit bg-white mt-20">
        <div class="alert alert-branch-body" role="alert" style="padding: 0px;">
            <div class="row">
                <!-- วนหลูป -->
                <?php
                if (isset($data) && count($data) > 0) {
                    $i = 1;
                    foreach ($data as $branchesId => $branch):
                ?>
                        <div class="col-lg-6 col-md-5 col-sm-3 col-12" id="branch-<?= $branchesId ?>">
                            <div class="card-comany">
                                <div class="card-body" style="background: #F9FBFF;  border-radius: 5px;">
                                    <div class="between-center" style="width: 100%;">
                                        <div style="display: flex; align-items: center; gap: 17px;">
                                            <div class="mid-center" style=" gap: 10.472px;">
                                                <img src="<?= Yii::$app->homeUrl . $branch['picture'] ?>" class="card-tcf">
                                            </div>
                                            <div class="header-crad-company">
                                                <div class="name-crad-company text-truncate"
                                                    style="width:265px;max-width: 265px;">
                                                    <?= $branch['companyName'] ?>
                                                </div>
                                                <div class="city-crad-company mt-5  justify-content-start pt-0 pb-0 align-content-center d-inline-flex"
                                                    style="max-width: 265px;height:27px;">

                                                    <div class="cycle-current-yellow ms-0" style="width: 20px; height: 20px;">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg" alt="icon"
                                                            style="width: 10px; height: 10px;">
                                                    </div>
                                                    <span class="text-truncate" style="max-width: 265px;">
                                                        <?= Yii::t('app', $branch['branchName']) ?>
                                                    </span>
                                                </div>
                                                <div>
                                                    <div class="city-crad-company mt-5 justify-content-start pt-0 pb-0  align-content-center d-inline-flex "
                                                        style="max-width: 265px;height:27px;">
                                                        <img src=" <?= Yii::$app->homeUrl ?><?= $branch['flag'] ?>"
                                                            class="bangladresh-hrvc">
                                                        <?= $branch['city'] ?>, <?= Yii::t('app', $branch['countryName']) ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="align-self-start">
                                            <?php if (count($branch['departments']) > 0) { ?>
                                                <a class="icon-btn-white me-1" style="width:28px;height:28px;"
                                                    onclick="openPopupModalDepartment('<?= Yii::$app->homeUrl ?>setting/department/modal-department/<?= ModelMaster::encodeParams(['branchId' => $branch['branchId']]) ?>')">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-black.svg"
                                                        alt="History" class="pim-icon" style="width: 14px; height: 14px;">
                                                </a>

                                            <?php } ?>
                                            <a href="<?= Yii::$app->homeUrl ?>setting/department/departments-view/<?= ModelMaster::encodeParams(['branchId' => $branch['branchId']]) ?>"
                                                class="icon-btn-white" style="width:28px;height:28px;">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" alt="History"
                                                    class="pim-icon">
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                    if (count($branch['departments']) > 0) {
                                    ?>
                                        <div style="align-self: stretch;" class="mt-10">
                                            <span class="detailname-crad-company">
                                                <?= Yii::t('app', 'Registered Departments') ?>
                                            </span>
                                            <a class="see-all-company pull-right"
                                                href="<?= Yii::$app->homeUrl ?>setting/department/departments-view/<?= ModelMaster::encodeParams(['branchId' => $branch['branchId']]) ?>">
                                                <?= Yii::t('app', 'See All') ?>
                                                <img src="<?= Yii::$app->homeUrl ?>image/see-all.svg" alt="icon"
                                                    style="cursor: pointer;">
                                            </a>

                                            <?php if (!empty($branch['departments'])): ?>
                                                <div class="row" style="--bs-gutter-x:0px;">
                                                    <?php
                                                    $limitedDepartments = array_slice($branch['departments'], 0, 6);
                                                    foreach ($limitedDepartments as $index => $dept):
                                                    ?>
                                                        <div class="col-lg-6 col-md-6 col-12 pl-10 mt-10 pt-0 pb-0">
                                                            <span class="d-flex align-items-center font-size-13 font-weight-500"
                                                                style=" color: #333;">
                                                                <div class="cycle-current-red mr-8 text-truncate">
                                                                    <img src="<?= Yii::$app->homeUrl ?>image/departments.svg" alt="icon">
                                                                </div>
                                                                <?= $dept['departmentName'] ?>
                                                            </span>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                    <?php } else { ?>
                                        <!-- ส่วนล่าง -->
                                        <div class="create-crad-company ">
                                            <!-- <?= $branch['branchId'] ?> -->
                                            <span class="text-create-crad">
                                                <?= Yii::t('app', 'No associated department, team, or employee found!') ?>
                                            </span>
                                            <a style="text-decoration: none;"
                                                onclick="openPopupModalDepartment('<?= Yii::$app->homeUrl ?>setting/department/modal-department/<?= ModelMaster::encodeParams(['branchId' => $branch['branchId']]) ?>')">
                                                <button type="button" class="btn-create"
                                                    style="padding: 3px 9px;"><?= Yii::t('app', 'Create Department') ?>
                                                    <img src="<?= Yii::$app->homeUrl ?>image/arrow-top-r.svg"
                                                        style="width:18px; height:18px; margin-top:-3px;">
                                                </button>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                <?php
                        $i++;
                    endforeach;
                }
                ?>
            </div>
            <?= $this->render('pagination_page', ['countryId' => $countryId, 'companyId' => $companyId, 'branchId' => $branchId, 'page' => $page, 'numPage' => $numPage]) ?>
        </div>
    </div>
</div>

<div class="modal fade" id="departmentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="row" id="departmentModalBody" style="width: 100%; padding: 50px; gap: 30px;max-height: 800px;">
                <!-- AJAX content will be injected here -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="departmentDeleteModal" tabindex="-2" aria-labelledby="departmentDeleteModal"
    aria-hidden="true">
</div>