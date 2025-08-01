<?php

use common\models\ModelMaster;

$this->title = 'Team';
$page = "grid";
// echo $data;
?>
<!-- <div class="contrainer-body mt-10"> -->
<div class="mt-60" style="padding: 30px 0px;">

    <div class="between-center" style="width: 100%;">
        <div class="col-8">
            <div class=" d-flex align-items-center gap-2">
                <img src="<?= Yii::$app->homeUrl ?>image/teams-black.svg" style="width: 24px; height: 24px;">
                <div class="pim-name-title">
                    <?= Yii::t('app', 'Teams') ?>
                </div>
                <a href="<?= Yii::$app->homeUrl ?>setting/team/create/<?= ModelMaster::encodeParams(["companyId" => '' , "branchId" => '', "departmentId" => '' ]) ?>"
                    style="text-decoration: none;">
                    <button type="button" class="btn-create"
                        style="padding: 0px; width: 93px; height:22.5px; font-size: 12px; font-weight: 600;"
                        action="<?= Yii::$app->homeUrl ?>setting/branch/create-branch"><?= Yii::t('app', 'Create New') ?>
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg"
                            style="width:14px; height:14px; margin-top:-3px;">
                    </button>
                </a>
            </div>
        </div>
        <div class="col-4" style="text-align: right;">
            <!-- filter -->
            <!-- <?= $companyId .'/'. $branchId  .'/'. $departmentId  ?> -->
            <?= $this->render('filter_list', ['companies' => $companies, 'branches' => $branches, 'departments' => $departments, 'page' => $page,'companyIdOld' => $companyId,'branchIdOld' => $branchId,'departmentIdOld' => $departmentId]) ?>
        </div>
    </div>

    <div class="company-group-edit bg-white mt-20">
        <div class="alert alert-branch-body" role="alert" style="padding: 0px;">
            <div class="row">
                <!-- วนหลูป -->
                <?php
				if (isset($data) && count($data) > 0) {
					$i = 1;
                    foreach ($data as $departmentsId => $department):
                        ?>
                <div class="col-lg-6 col-md-5 col-sm-3 col-12" id="department">
                    <div class="card-comany" style="height: auto;">
                        <div class="card-body" style=" background: #F9FBFF;  border-radius: 5px;">
                            <div class="between-center"
                                style="flex-direction: column;  gap: 20px;  align-self: stretch;">
                                <!-- ส่วนบน -->
                                <div class="between-center" style=" gap: 17px; width: 100%;">
                                    <div style="display: flex; align-items: center; gap: 17px;">
                                        <div class="mid-center" style="">
                                            <img src="<?= Yii::$app->homeUrl . $department['picture'] ?>"
                                                class="card-tcf">
                                        </div>
                                        <div class="header-crad-company">
                                            <div class="name-crad-company text-truncate">
                                                <?= $department['companyName'] ?>
                                            </div>
                                            <div class="city-crad-company  text-truncate">
                                                <div class="cycle-current-yellow" style="width: 20px; height: 20px;">
                                                    <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg"
                                                        alt="icon" style="width: 10px; height: 10px;">
                                                </div>
                                                <?= Yii::t('app', $department['branchName']) ?>
                                            </div>
                                            <div style="display: flex; gap: 20px; align-items: center;">
                                                <div class="city-crad-company  text-truncate"
                                                    style="display: flex; align-items: center; gap: 5px;">
                                                    <div class="cycle-current-red" style="width: 20px; height: 20px;">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/departments.svg"
                                                            alt="icon" style="width: 10px; height: 10px;">
                                                    </div>
                                                    <?= $department['departmentName'] ?>
                                                </div>

                                                <div class="city-crad-company  text-truncate"
                                                    style="display: flex; align-items: center; gap: 5px;">
                                                    <img src="<?= Yii::$app->homeUrl ?><?= $department['flag'] ?>"
                                                        class="bangladresh-hrvc">
                                                    <?= $department['city'] ?>,
                                                    <?= Yii::t('app', $department['countryName']) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div style="margin-bottom: 30px;">
                                        <?php if(count($department['teams']) > 0) { ?>

                                        <a class="btn btn-bg-white-xs mr-5" style="margin-top: 3px;"
                                            onclick="openPopupModalTeam('<?= Yii::$app->homeUrl ?>setting/team/modal-team/<?= ModelMaster::encodeParams(['departmentId' => $department['departmentId']]) ?>')">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-black.svg"
                                                alt="History" class="pim-icon"
                                                style="margin-top: -1px; width: 14px; height: 14px;">
                                        </a>

                                        <?php }?>
                                        <a href="
                                        <?= Yii::$app->homeUrl ?>setting/team/teams-view/<?= ModelMaster::encodeParams(['departmentId' => $department['departmentId']]) ?>"
                                            class="btn btn-bg-white-xs mr-5" style="margin-top: 3px; ">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg"
                                                alt="History" class="pim-icon" style="margin-top: -1px;">
                                        </a>
                                        <span class="dropdown" href="#" id="dropdownMenuLink-1"
                                            data-bs-toggle="dropdown" style="align-self: flex-start;">
                                            <!-- <img src="<?= Yii::$app->homeUrl ?>image/3-dot.svg" alt="icon"
                                                style="cursor: pointer;"> -->
                                        </span>
                                        <div class="menu-dot ">
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink-1">
                                                <li class="pl-4 pr-4" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop4"
                                                    onclick="javascript:prepareDeleteDepartment('<?=$department['departmentId']?>')"
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
                                <?php
                                // echo $department['totalDepartment']; 
                                if(count($department['teams']) > 0) { 
                                ?>
                                <div style="align-self: stretch; height: 147px">
                                    <div class="between-start">
                                        <span class="detailname-crad-company mb-14">
                                            <?= Yii::t('app', 'Registered Teams') ?>
                                        </span>
                                        <a class="see-all-company"
                                            href="
                                        <?= Yii::$app->homeUrl ?>setting/team/teams-view/<?= ModelMaster::encodeParams(['departmentId' => $department['departmentId']]) ?>">
                                            <?= Yii::t('app', 'See All') ?>
                                            <img src="<?= Yii::$app->homeUrl ?>image/see-all.svg" alt="icon"
                                                style="cursor: pointer;">
                                        </a>
                                    </div>

                                    <?php if (!empty($department['teams'])): ?>
                                    <div class="row mt-2">
                                        <?php
                                        $limitedDepartments = array_slice($department['teams'], 0, 6);
                                        foreach ($limitedDepartments as $index => $dept):
                                        ?>
                                        <div class="col-6 mb-1">
                                            <span class="d-flex align-items-center mb-12"
                                                style="font-size: 13px; color: #333;">
                                                <div class="cycle-current-green mr-5">
                                                    <img src="<?= Yii::$app->homeUrl ?>image/teams.svg" alt="icon">
                                                </div>
                                                <?= $dept['teamName'] ?>
                                            </span>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>

                                <?php } else{ ?>
                                <!-- ส่วนล่าง -->
                                <div class="create-crad-company ">
                                    <!-- <?=  $department['branchId'] ?> -->
                                    <span class="text-create-crad">
                                        <?= Yii::t('app', 'No associated department, team, or employee found!') ?>
                                    </span>
                                    <a style="text-decoration: none;"
                                        onclick="openPopupModalTeam('<?= Yii::$app->homeUrl ?>setting/team/modal-team/<?= ModelMaster::encodeParams(['departmentId' => $department['departmentId']]) ?>')">
                                        <button type="button" class="btn-create"
                                            style="padding: 3px 9px;"><?= Yii::t('app', 'Create Teams') ?>
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
                <!-- endforeach -->
            </div>
        </div>
        <!-- <?= $companyId .'/'. $branchId  .'/'. $departmentId  ?> -->

        <!-- pagination_page -->
        <?= $this->render('pagination_page', [ 'companyId' => $companyId, 'branchId' => $branchId, 'departmentId' => $departmentId,'page' => $page,'numPage' => $numPage]) ?>

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