<?php

use common\models\ModelMaster;

$this->title = 'Branch';
$page = "grid"
// echo $countries;
?>
<div class="contrainer-body mt-10">

    <div class="between-center mt-20" style="width: 100%;">
        <div class="col-9">
            <div class=" d-flex align-items-center gap-2">
                <img src="<?= Yii::$app->homeUrl ?>image/departments-black.svg" style="width: 24px; height: 24px;">
                <div class="pim-name-title ml-10">
                    <?= Yii::t('app', 'Departments') ?>
                </div>

            </div>
        </div>
        <div class="col-2" style="text-align: right;">
            <!-- filter -->
        </div>
        <!-- <div class="col-1 pr-0 text-end">
            <div class="btn-group" role="group">
                <a href="#" class="btn btn-primary font-size-12 pim-change-modes">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/gridwhite.svg" style="cursor: pointer;">
                </a>
                <a href="<?= Yii::$app->homeUrl . 'setting/branch/index' ?>"
                    class="btn btn-outline-primary font-size-12 pim-change-modes">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/listblack.svg" style="cursor: pointer;">
                </a>
            </div>
        </div> -->
    </div>

    <div class="pim-body company-group-edit bg-white mt-10">
        <div class="alert alert-branch-body" role="alert">
            <div class="row">
                <!-- วนหลูป -->
                <?php
				if (isset($companyDepartment) && count($companyDepartment) > 0) {
					$i = 1;
					foreach ($companyDepartment as $data) :
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
                                            <img src="<?= Yii::$app->homeUrl . $data['picture'] ?>" class="card-tcf">
                                        </div>
                                        <div class="header-crad-company">
                                            <div class="name-crad-company">
                                                <?= $data['companyName'] ?>
                                            </div>
                                            <div class="city-crad-company">
                                                <div class="cycle-current-yellow" style="width: 20px; height: 20px;">
                                                    <img src="/HRVC/frontend/web/image/branches-black.svg" alt="icon"
                                                        style="width: 10px; height: 10px;">
                                                </div>
                                                <?= Yii::t('app', $data['branchName']) ?>
                                            </div>
                                            <div class="city-crad-company">
                                                <img src="<?= Yii::$app->homeUrl ?><?= $data['flag'] ?>"
                                                    class="bangladresh-hrvc">
                                                <?= $data['city'] ?>, <?= Yii::t('app', $data['countryName']) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin-bottom: 30px;">
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

                                <!-- ส่วนล่าง -->
                                <div class="create-crad-company ">
                                    <span class="text-create-crad">
                                        <?= Yii::t('app', 'No associated department, team, or employee found!') ?>
                                    </span>

                                </div>
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
    </div>
</div>