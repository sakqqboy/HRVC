<?php

use common\models\ModelMaster;

$this->title = 'Branch';
$page = "grid";
// echo $data;
?>
<div class="contrainer-body mt-10">

    <div class="between-center mt-20" style="width: 100%;">
        <div class="col-8">
            <div class=" d-flex align-items-center gap-2">
                <img src="<?= Yii::$app->homeUrl ?>image/departments-black.svg" style="width: 24px; height: 24px;">
                <div class="pim-name-title ml-10">
                    <?= Yii::t('app', 'Departments') ?>
                </div>
                <?php if($role >= 5 ) { ?>
                <a href="<?= Yii::$app->homeUrl ?>setting/department/create/<?= ModelMaster::encodeParams(['companyId' => '', 'branchId' => '']) ?>"
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
        <div class="col-4" style="text-align: right;">
            <!-- filter -->
            <?= $this->render('filter_list', ['countries' => $countries,'companies' => $companies, 'branches' => $branches, 'page' => $page,'countryIdOld' => $countryId]) ?>
        </div>
    </div>

    <div class="pim-body company-group-edit bg-white mt-10">
        <div class="alert alert-branch-body" role="alert">
            <div class="row">
                <!-- วนหลูป -->
                <?php
				if (isset($data) && count($data) > 0) {
					$i = 1;
                    foreach ($data as $branchId => $branch):
                        ?>
                <div class="col-lg-6 col-md-5 col-sm-3 col-12" id="department">
                    <div class="card-comany" style="height: auto;">
                        <div class="card-body" style=" background: #F9FBFF;  border-radius: 5px;">
                            <div class="between-center"
                                style="flex-direction: column;  gap: 20px;  align-self: stretch;">
                                <!-- ส่วนบน -->
                                <div class="between-center" style=" gap: 17px; width: 100%;">
                                    <div style="display: flex; align-items: center; gap: 17px;">
                                        <div class="mid-center"
                                            style="height: 60px; padding: 20.944px 4.189px; gap: 10px;">
                                            <img src="<?= Yii::$app->homeUrl . $branch['picture'] ?>" class="card-tcf">
                                        </div>
                                        <div class="header-crad-company">
                                            <div class="name-crad-company">
                                                <?= $branch['companyName'] ?>
                                            </div>
                                            <div class="city-crad-company">
                                                <div class="cycle-current-yellow" style="width: 20px; height: 20px;">
                                                    <img src="/HRVC/frontend/web/image/branches-black.svg" alt="icon"
                                                        style="width: 10px; height: 10px;">
                                                </div>
                                                <?= Yii::t('app', $branch['branchName']) ?>
                                            </div>
                                            <div class="city-crad-company">
                                                <img src="<?= Yii::$app->homeUrl ?><?= $branch['flag'] ?>"
                                                    class="bangladresh-hrvc">
                                                <?= $branch['city'] ?>, <?= Yii::t('app', $branch['countryName']) ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div style="margin-bottom: 30px;">
                                        <?php if(count($branch['departments']) > 0) { ?>
                                        <a href="<?= Yii::$app->homeUrl ?>setting/department/create/<?= ModelMaster::encodeParams(['companyId' => $branch['companyId'], 'branchId' => $branch['branchId']]) ?>"
                                            class="btn btn-bg-white-xs mr-5" style="margin-top: 3px; ">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus-black.svg"
                                                alt="History" class="pim-icon"
                                                style="margin-top: -1px; width: 14px; height: 14px;">
                                        </a>
                                        <?php }?>
                                        <a href="
                                        <?= Yii::$app->homeUrl ?>setting/department/departments-view/<?= ModelMaster::encodeParams(['branchId' => $branch['branchId']]) ?>"
                                            class="btn btn-bg-white-xs mr-5" style="margin-top: 3px; ">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg"
                                                alt="History" class="pim-icon" style="margin-top: -1px;">
                                        </a>
                                        <span class="dropdown" href="#" id="dropdownMenuLink-1"
                                            data-bs-toggle="dropdown" style="align-self: flex-start;">
                                            <img src="<?= Yii::$app->homeUrl ?>image/3-dot.svg" alt="icon"
                                                style="cursor: pointer;">
                                        </span>
                                        <div class="menu-dot ">
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink-1">
                                                <li class="pl-4 pr-4">

                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                // echo $branch['totalDepartment']; 
                                if(count($branch['departments']) > 0) { 
                                ?>
                                <div style="align-self: stretch; height: 147px">
                                    <div class="between-start">
                                        <span class="detailname-crad-company">
                                            Registered Departments
                                        </span>
                                        <a class="see-all-company"
                                            href="
                                        <?= Yii::$app->homeUrl ?>setting/department/departments-view/<?= ModelMaster::encodeParams(['branchId' => $branch['branchId']]) ?>">
                                            See All
                                            <img src="/HRVC/frontend/web/image/see-all.svg" alt="icon"
                                                style="cursor: pointer;">
                                        </a>
                                    </div>

                                    <?php if (!empty($branch['departments'])): ?>
                                    <div class="row mt-2">
                                        <?php
                                        $limitedDepartments = array_slice($branch['departments'], 0, 6);
                                        foreach ($limitedDepartments as $index => $dept):
                                        ?>
                                        <div class="col-6 mb-1">
                                            <span class="d-flex align-items-center mb-12"
                                                style="font-size: 13px; color: #333;">
                                                <div class="cycle-current-red mr-5">
                                                    <img src="<?= Yii::$app->homeUrl ?>image/departments.svg"
                                                        alt="icon">
                                                </div>
                                                <?= $dept['departmentName'] ?>
                                                </spanแ>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>

                                <?php } else{ ?>
                                <!-- ส่วนล่าง -->
                                <div class="create-crad-company ">
                                    <!-- <?=  $branch['branchId'] ?> -->
                                    <span class="text-create-crad">
                                        <?= Yii::t('app', 'No associated department, team, or employee found!') ?>
                                    </span>
                                    <a href="<?= Yii::$app->homeUrl ?>setting/department/create/<?= ModelMaster::encodeParams(['companyId' => $branch['companyId'], 'branchId' => $branch['branchId']]) ?>"
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
                <!-- endforeach -->
            </div>
        </div>

        <!-- pagination_page -->
        <?= $this->render('pagination_page', ['countryId' => $countryId,'page' => $page,'numPage' => $numPage]) ?>

    </div>
</div>