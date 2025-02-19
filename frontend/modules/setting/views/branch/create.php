<?php

use common\models\ModelMaster;

$this->title = 'Branch';
?>
<div class="col-12 branch-one mt-50">
    <div class="row all-row">
        <div class="d-flex align-items-center gap-2">
            <img src="<?= Yii::$app->homeUrl ?>image/branch-icon-black.svg" style="width: 24px; height: 24px;">
            <div class="col-12 branch-title pt-5">
                Branch
            </div>
        </div>

        <!-- <div class="col-lg-1 col-md-3 col-2 text-end pt-10">
            <button type="button" class="btn btn-outline-primary"> <i class="fa fa-filter"
                    aria-hidden="true"></i></button>
        </div>
        <div class="col-lg-3 col-md-3 col-7 bt-togg pt-10">
            <div class="input-group">
                <select id="filter-branch" class="form-control font-size-18 text-black-50"
                    onchange="javascript:filterBranchCompany()">
                    <?php
					if (isset($company['companyName']) && $company['companyName'] != '') {
					?>
                    <option value="<?= $company['companyId'] ?>"><?= $company['companyName'] ?></option>
                    <?php
					}
					?>
                    <option value="">Filter by Company</option>
                    <?php
					if (isset($companies) && count($companies) > 0) {
						foreach ($companies as $com) : ?>
                    <option value="<?= $com['companyId'] ?>"><?= $com['companyName'] ?></option>
                    <?php
						endforeach;
					}
					?>
                </select>
            </div>
        </div> -->
    </div>
    <div class="col-12 mt-30">
        <div class="alert alert-secondary-branch" role="alert">
            <div class="head-filter-branch">
                <div class="text-quick-register">
                    <img src="<?= Yii::$app->homeUrl ?>image/icon-quick-registe.svg" style="height: 28px;">
                    Quick Register
                </div>

                <input type="hidden" id="branchId" value="">
                <button class="btn-create-branch" id="create-branch">
                    Create <img src="<?= Yii::$app->homeUrl ?>image/create-plus.svg" style="width: 18px; height: 18px;">
                </button>
                <a class="btn btn-sm btn-warning" id="update-branch" style="display:none;">
                    <i class="fa fa-check" aria-hidden="true"></i>
                </a>
                <a class="btn btn-sm btn-danger" id="reset-branch" style="display:none;">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
            </div>
            <div class="body-filter-branch">
                <div class="col-lg-3 col-md-6">
                    <div style="display: flex;
							width: 399px;
							flex-direction: column;
							align-items: flex-start;
							gap: 14px;">
                        <label class="form-label font-size-12 font-b"> <span class="text-danger">* </span>Company
                        </label>
                        <div class="col-12 font-b">
                            <?php
							if (isset($companyId) && $companyId != '') {
							?>
                            <input type="hidden" id="company" value="<?= $company['companyId'] ?>">
                            <?= $company['companyName'] ?>
                            <?php
							} else { ?>
                            <select class="form-select" id="company">
                                <option value="">Select Company</option>
                                <?php
									if (isset($companies) && count($companies) > 0) {
										foreach ($companies as $c) : ?>
                                <option value="<?= $c['companyId'] ?>"><?= $c['companyName'] ?></option>
                                <?php
										endforeach;
									}
									?>

                            </select>
                            <?php
							}
							?>
                        </div>

                    </div>
                </div>
                <div style="display: flex;
							width: 309px;
							flex-direction: column;
							align-items: flex-start;
							gap: 14px;">
                    <label for="exampleFormControlInput1" class="form-label font-size-12 font-b">
                        <span class="text-danger">* </span>
                        Select Country</label>
                    <input type="text" class="form-control" id="branchName">
                </div>
                <div style="display: flex;
							width: 734px;
							flex-direction: column;
							align-items: flex-start;
							gap: 12px;">
                    <label for="exampleFormControlInput1" class="form-label font-size-12 font-b">
                        <span class="text-danger">* </span>
                        Branch Name</label>
                    <input type="text" class="form-control" id="description" placeholder="Write the name of the branch">
                </div>
            </div>
        </div>
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
												if ($branch["picture"] != '') {
												?>
                                            <img src="<?= Yii::$app->homeUrl ?><?= $branch["picture"] ?>"
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