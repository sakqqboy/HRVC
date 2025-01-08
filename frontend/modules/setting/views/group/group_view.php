<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Company;

$this->title = 'Group profile';
?>
<div class="company-group-body">

    <div class="col-12 company-group-content" style="margin-top: -10px; ">
        <div class="col-12" style="height: 180px;">
            <?php
		if ($group["banner"] != null) { ?>
            <img src="<?= Yii::$app->homeUrl . $group['banner'] ?>" class="sad-1">
            <?php
		} else { ?>
            <img src="<?= Yii::$app->homeUrl . 'image/group.jpg' ?>" class="sad-1">
            <?php
		}
		?>

        </div>
        <!-- <div class="col-12 edit-update text-end" style="padding-right: 30px;">
		<a href="" class="btn btn-light"> <i class="fa fa-pencil" aria-hidden="true"></i> Update</a>
	</div> -->
        <div class="row mt-20">
            <div class="col-lg-3 col-md-5 col-12" style="margin-top:-170px;">
                <div class="avatar-upload" style="margin-left:36px;">
                    <div class="avatar-preview">
                        <?php
					if ($group["picture"] != null) { ?>
                        <img src="<?= Yii::$app->homeUrl . $group['picture'] ?>" class="company-group-picture">
                        <?php
					} else { ?>


                        <img src="<?= Yii::$app->homeUrl . 'image/groupProfile.jpg' ?>" class="company-group-picture">
                        <?php
					}
					?>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-4 col-12">
                <div class="col-12 name-tokyo">
                    <span class="name-sub-tokyo"><?= $group['displayName'] ?></span>
                    <span class="name-full-tokyo">(<?= $group['groupName'] ?>)</span>
                </div>
                <div class="col-12 tokyo-small">
                    <img src="<?= Yii::$app->homeUrl . 'image/hyphen.svg' ?>"> <?= $group['tagLine'] ?>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-12 tcg-edit0">
                <a href="<?= Yii::$app->homeUrl ?>setting/group/update-group/<?= ModelMaster::encodeParams(['groupId' => $group['groupId']]) ?>"
                    class="btn-update-group">
                    <img src="<?= Yii::$app->homeUrl . 'image/refresh-white.svg' ?>">
                    Update Information
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-9 group-body">
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-lg-6 col-md-6 col-12 all-information">
                        <div class="col-12 Group-Information">
                            Group Details
                            <hr class="hr-group">
                        </div>
                        <div class="row mb-36">
                            <div class="col-lg-5 col-md-6 col-12 name-head">
                                Group Director/ Chairman
                            </div>
                            <div class="col-lg-7 col-md-6 col-12 name-head0">
                                <img src="<?= Yii::$app->homeUrl ?>image/Mask-group.png"> <?= $group["director"] ?>
                            </div>
                            <div class="col-lg-5 col-md-6 col-12 name-head mt-10">
                                Headquarter Address
                            </div>
                            <div class="col-lg-7 col-md-6 col-12 name-head0 mt-10 d-flex align-items-center">
                                <div class="col-1">
                                    <img src="<?= Yii::$app->homeUrl ?>image/location.svg"
                                        style="width: 9.333px; height: 12px;">
                                </div>
                                <div class="col-11 address-box">
                                    <?= $group["location"] ?>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-6 col-12 name-head mt-10">
                                Founded
                            </div>
                            <div class="col-lg-7 col-md-6 col-12 name-head0 mt-10">
                                <?= $group["founded"] ?>
                            </div>
                            <div class="col-lg-5 col-md-6 col-12 name-head mt-10">
                                Industry
                            </div>
                            <div class="col-lg-7 col-md-6 col-12 name-head0 mt-10">
                            </div>
                        </div>
                        <div class="col-12 Group-Information">
                            Contact Information
                            <hr class="hr-group">
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-12 name-head mt-10">
                                Email
                            </div>
                            <div class="col-lg-8 col-md-6 col-12 name-head0 mt-5">
                                <span class="text-primary address-box0"><?= $group["email"] ?></span>
                                <img src="<?= Yii::$app->homeUrl ?>image/coppy.svg"
                                    onclick="javascript:copyToClipboard('<?= $group['email'] ?>')"
                                    style="width: 10.884px; height: 12px;">
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 name-head mt-10">
                                Phone
                            </div>
                            <div class="col-lg-8 col-md-6 col-12 name-head0 mt-5">
                                <?= $group["contact"] ?>
                                <img src="<?= Yii::$app->homeUrl ?>image/coppy.svg"
                                    onclick="javascript:copyToClipboard('<?= $group['contact'] ?>')"
                                    style="width: 10.884px; height: 12px;">
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 name-head mt-10">
                                Website
                            </div>
                            <div class="col-lg-8 col-md-6 col-12 name-head0 mt-5">
                                <a href="<?= $group['website'] ?>" target="_blank"
                                    class="text-primary"><?= $group["website"] ?></a>
                                <img src="<?= Yii::$app->homeUrl ?>image/coppy.svg"
                                    onclick="javascript:copyToClipboard('<?= $group['website'] ?>')"
                                    style="width: 10.884px; height: 12px;">
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-lg-6 col-md-6 col-12 box-about0">
                        <div class="col-12 ABOUT-NAME">
                            About us
                            <hr class="hr-group">
                        </div>
                        <div class="col-12 detail-tokyo">
                            <?= $group["about"] ?>
                        </div>
                        <div class="col-12 mt-10 text-end">
                            <img src="<?= Yii::$app->homeUrl ?>image/icon-x<?= empty($group["socialTag"]) ? '-off' : '' ?>.svg"
                                style="width: 24px; height: 24.6px;">
                            <img src="<?= Yii::$app->homeUrl ?>image/icon-in<?= empty($group["socialTag"]) ? '-off' : '' ?>.svg"
                                style="width: 24px; height: 24.6px;">
                            <img src="<?= Yii::$app->homeUrl ?>image/icon-yt<?= empty($group["socialTag"]) ? '-off' : '' ?>.svg"
                                style="width: 24px; height: 24.6px;">
                            <img src="<?= Yii::$app->homeUrl ?>image/icon-face<?= empty($group["socialTag"]) ? '-off' : '' ?>.svg"
                                style="width: 24px; height: 24.6px;">
                            <img src="<?= Yii::$app->homeUrl ?>image/icon-ig<?= empty($group["socialTag"]) ? '-off' : '' ?>.svg"
                                style="width: 24px; height: 24.6px;">
                        </div>
                    </div>

                    <!-- Bottom Row -->
                    <div class="col-12 mt-10 current-stats">
                        <div class="col-12 Group-Information">
                            Current Stats
                            <hr class="hr-group">
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="alert alert-secondary-background">
                                    <a href="<?= Yii::$app->homeUrl ?>setting/branch/create/<?= ModelMaster::encodeParams(['companyId' => '']) ?>"
                                        class="text-decoration-none">
                                        <div class="row align-items-center">
                                            <div class="col-lg-8 col-md-8 col-8 text-left">
                                                <div class="circle-container">
                                                    <div class="cycle-current">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/branches.svg"
                                                            alt="icon">
                                                    </div>
                                                    <div class="cycle-current">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/branches.svg"
                                                            alt="icon">
                                                    </div>
                                                    <div class="cycle-current">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/branches.svg"
                                                            alt="icon">
                                                    </div>
                                                    <div class="number-current"><?= $totalBranches ?></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-4 text-right">
                                                <div class="row justify-content-between align-items-center">
                                                    <div class="text-name-current">Branch</div>
                                                    <div class="text-see-all">See All</div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="alert alert-secondary-background">
                                    <a href="<?= Yii::$app->homeUrl ?>setting/department/create/<?= ModelMaster::encodeParams(['companyId' => '']) ?>"
                                        class="text-decoration-none">
                                        <div class="row align-items-center">
                                            <div class="col-lg-6 col-md-8 col-8 text-left">
                                                <div class="number-current"><?= $totalDepartment ?></div>
                                            </div>
                                            <div class="col-lg-6 col-md-4 col-4 text-right">
                                                <div class="row justify-content-between align-items-center">
                                                    <div class="text-name-current">Department</div>
                                                    <div class="text-see-all">See All</div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="alert alert-secondary-background">
                                    <a href="<?= Yii::$app->homeUrl ?>setting/team/create/<?= ModelMaster::encodeParams(['companyId' => '']) ?>"
                                        class="text-decoration-none">
                                        <div class="row align-items-center">
                                            <div class="col-lg-6 col-md-8 col-8 text-left">
                                                <div class="number-current"><?= $totalTeam ?></div>
                                            </div>
                                            <div class="col-lg-6 col-md-4 col-4 text-right">
                                                <div class="row justify-content-between align-items-center">
                                                    <div class="text-name-current">Team</div>
                                                    <div class="text-see-all">See All</div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="alert alert-secondary-background">
                                    <a href="<?= Yii::$app->homeUrl ?>setting/employee/index/<?= ModelMaster::encodeParams(['companyId' => '']) ?>"
                                        class="text-decoration-none">
                                        <div class="row align-items-center">
                                            <div class="col-lg-6 col-md-8 col-8 text-left">
                                                <div class="number-current"><?= $totalEmployees ?></div>
                                            </div>
                                            <div class="col-lg-6 col-md-4 col-4 text-right">
                                                <div class="row justify-content-between align-items-center">
                                                    <div class="text-name-current">Employee</div>
                                                    <div class="text-see-all">See All</div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- <hr class="hr-group-vertical"> -->
            <div class="col-lg-3 col-md-4 col-12 home-tokyo">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-12"
                        style="width: 15px; height: 15px; padding-right : 0px; padding-left: 0px; bottom: 5px; ">
                        <img src="<?= Yii::$app->homeUrl ?>image/companies.svg" style="width: 15px; height: 15px;">
                    </div>
                    <div class="col-lg-9 col-md-7 col-12 Affiliated0">
                        Affiliated Companies
                    </div>
                    <div class="col-lg-1 col-md-3 col-12 box-27">
                        <?= count($companyGroup) ?>
                    </div>
                </div>
                <hr class="hr-group">
                <div class="col-12">

                    <?php
				if (isset($companyGroup) && count($companyGroup) > 0) {
					$i = 0;
					foreach ($companyGroup as $company) :
				?>
                    <a href="<?= Yii::$app->homeUrl . 'setting/company/company-view/' . ModelMaster::encodeParams([
									'companyId' => $company['companyId']
								]) ?>" class="no-underline" style="color:black;">
                        <div class="row <?= $i > 0 ? 'mt-10' : '' ?> affiliated-list">
                            <div class="col-lg-3 col-md-4 col-4">
                                <?php
									if ($company['picture'] != "") {
									?>
                                <img src="<?= Yii::$app->homeUrl . $company['picture'] ?>" class="width-TCF-BD">
                                <?php
									} else {
									?>
                                <img src="<?= Yii::$app->homeUrl . 'image/userProfile.png' ?>" class="width-TCF-BD">
                                <?php
									}
									?>
                            </div>
                            <div class="col-lg-9 col-md-8 col-8">
                                <div class="tokyoconsultinggroup">
                                    <?= $company['companyName'] ?>
                                    <?php
										if ($company['headQuaterId'] == null) {
										?>
                                    <span style="font-size: 11px;font-weight:100;">(head Quater)</span>
                                    <?php
										}
										?>
                                </div>
                                <i class="fa fa-map-marker FT mr-5" aria-hidden="true"></i><?= $company["city"] ?>,
                                <?= $company["countryName"] ?>
                                <div class="numberemployees"><?= Company::totalEmployeeCompany($company['companyId']) ?>
                                    Employees</div>
                            </div>
                        </div>
                    </a>
                    <?php
						$i++;
					endforeach;
				}
				if (count($companyGroup) > 5) {
					?>
                    <div class="col-12 text-end">
                        <a href="#"> See All </a>
                    </div>
                    <?php
				}
				?>

                </div>
            </div>
        </div>
    </div>
</div>