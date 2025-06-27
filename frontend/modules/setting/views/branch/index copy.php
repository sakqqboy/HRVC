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
            <?= $this->render('filter_list', ['countries' => $countries,'page' => $page,'countryIdOld' => $countryId]) ?>
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

    <div class="col-12 mt-30">
        <div class="alert alert-branch-body" role="alert">
            <div class="row" id="company-branch">
                <?php
				if (isset($branches) && count($branches) > 0) {
					foreach ($branches as $branch) :
				?>
                <div class="col-lg-4 col-md-5 col-sm-3 col-12" id="branch-<?= $branch['branchId'] + 543 ?>">
                    <div class="card" style="border: none;">
                        <div class="card-body" style="background: #F4F6F9;  border-radius: 5px;">
                            <div class="row">
                                <div class="col-12">
                                    <div style="display: flex;
												height: 60px;
												align-items: center;
												gap: 17px;
												align-self: stretch;">
                                        <div style="display: flex;
													height: 60px;
													padding: 20.944px 4.189px;
													flex-direction: column;
													justify-content: center;
													align-items: center;
													gap: 10.472px;">
                                            <?php
													if ($branch["branchImage"] != '') {
													?>
                                            <img src="<?= Yii::$app->homeUrl ?><?= $branch["branchImage"] ?>"
                                                class="card-tcf">
                                            <?php
													} else { ?>
                                            <img src="<?= Yii::$app->homeUrl . 'image/userProfile.png' ?>"
                                                class="card-tcf">
                                            <?php
													}
													?>
                                        </div>
                                        <div class="header-crad-branch">
                                            <div class="name-crad-branch">
                                                <?= $branch["branchName"] ?>
                                            </div>
                                            <div class="city-crad-branch">
                                                <img src="<?= Yii::$app->homeUrl ?><?= $branch["flag"] ?>"
                                                    class="card-round">
                                                <?= $branch["city"] ?>, <?= $branch["countryName"] ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div style="display: flex;
												justify-content: space-between;
												align-items: center;
												align-self: stretch;">
                                        <!-- <div class="col-1  pr-0 pl-4 text-start">
                                            <img src="<?= Yii::$app->homeUrl ?>image/zoom.png" class="image-zoom">
                                        </div>
                                        <div class="col-7 font-size-12 pt-3">
                                            <?= $branch["description"] ?>
                                        </div> -->
                                        <div style="display: flex;
													align-items: center;
													gap: 18px;">
                                            <img src="<?= Yii::$app->homeUrl ?>image/zoom.png" class="image-zoom">
                                            <img src="<?= Yii::$app->homeUrl ?>image/zoom.png" class="image-zoom">
                                            <img src="<?= Yii::$app->homeUrl ?>image/zoom.png" class="image-zoom">
                                            <div style="display: flex;
												flex-direction: column;
												align-items: flex-start;
												gap: 10px;">
                                                <?= $branch["description"] ?>
                                            </div>
                                        </div>
                                        <div class="col-4 pb-0 pr-0  text-end pt-10">
                                            <a href="javascript:updateBranch(<?= $branch['branchId'] + 543 ?>)"
                                                class="btn btn-sm btn-outline-secondary font-size-12 mr-5">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                            <a href="javascript:deleteBranch(<?= $branch['branchId'] + 543 ?>)"
                                                class="btn btn-sm btn-outline-danger font-size-12">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <?php
					endforeach;
				} else {
					?>
                <div class="col-12 text-center font-size-16">Branch not found.</div>

                <?php
				}
				?>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-lg-3 col-md-4 col-6">
                <div class="alert alert-secondary-background" role="alert">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa fa-users" aria-hidden="true" style="font-size: 25px;padding-top: 18px;"></i>
                        </div>
                        <div class="col-2">
                            <a href="<?= Yii::$app->homeUrl ?>setting/department/create/<?= ModelMaster::encodeParams(['companyId' => '']) ?>"
                                style="text-decoration: none;">
                                <div class="col-12 text-primary">
                                    Department
                                </div>
                                <div class="col-2 number-bold text-black">
                                    <?= $totalDepartment
						?>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-6">
                <div class="alert alert-secondary-background" role="alert">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa fa-users" aria-hidden="true" style="font-size: 25px;padding-top: 18px;"></i>
                        </div>
                        <div class="col-2">
                            <a href="<?= Yii::$app->homeUrl ?>setting/team/create/<?= ModelMaster::encodeParams(['companyId' => '']) ?>"
                                style="text-decoration: none;">
                                <div class="col-12 text-primary">
                                    Team
                                </div>
                                <div class="col-2 number-bold text-black">
                                    <?= $totalTeam
						?>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-6">
                <div class="alert alert-secondary-background" role="alert">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa fa-users" aria-hidden="true" style="font-size: 25px;padding-top: 18px;"></i>
                        </div>
                        <div class="col-2">
                            <a href="<?= Yii::$app->homeUrl ?>setting/employee/index/<?= ModelMaster::encodeParams(['companyId' => '']) ?>"
                                style="text-decoration: none;">
                                <div class="col-12 text-primary">
                                    Employee
                                </div>
                                <div class="col-2 number-bold text-black">
                                    <?= $totalEmployees
						?>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>