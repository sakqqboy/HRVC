<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Company;

$this->title = 'Group profile';
?>
<div class="company-group-body mt-50">
    <div class="contrainer-body company-group-content" style="margin-top: -10px;">
        <div class="row">
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
        </div>

        <div class="row mt-50">
            <div class="col-10" style="margin-top:-170px; display: flex; gap: 20px;">
                <div class="avatar-upload-preview" style="margin-left:36px; margin-right: 0px;">
                    <div class="avatar-preview">
                        <?php if ($group["picture"] != null) { ?>
                        <img src="<?= Yii::$app->homeUrl . $group['picture'] ?>" class="company-group-picture">
                        <?php } else { ?>
                        <img src="<?= Yii::$app->homeUrl . 'image/groupProfile.jpg' ?>" class="company-group-picture">
                        <?php } ?>
                    </div>
                </div>
                <div style="margin-top: 150px;">
                    <div class="col-12 name-tokyo">
                        <span class="name-sub-tokyo"><?= Yii::t('app', $group['displayName']) ?></span>
                        <span class="name-full-tokyo">(<?= Yii::t('app', $group['groupName']) ?>)</span>
                    </div>
                    <div class="col-12 tokyo-small">
                        <img src="<?= Yii::$app->homeUrl . 'image/hyphen.svg' ?>"> <?= $group['tagLine'] ?>
                    </div>
                </div>
            </div>

            <?php if($role >= 5 ) { ?>
            <div class="col-2 tcg-edit0" style="display: flex; justify-content: flex-end;">
                <a href="<?= Yii::$app->homeUrl ?>setting/group/update-group/<?= ModelMaster::encodeParams(['groupId' => $group['groupId']]) ?>"
                    class="btn-update-group" style="width: 60%;">
                    <img src="<?= Yii::$app->homeUrl . 'image/refresh-white.svg' ?>">
                    <?= Yii::t('app', 'Update Information') ?>
                </a>
            </div>
            <?php }?>
        </div>
        <div class="row group-details mt-10">
            <div class="col-9 mx-auto group-body  group-body ">
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-lg-6 col-md-6 col-12 all-information">
                        <div class="col-12 Group-Information">
                            <?= Yii::t('app', 'Group Details') ?>
                            <hr class="hr-group">
                        </div>
                        <div class="row mb-36">
                            <div class="col-lg-5 col-md-6 col-12 name-head">
                                <?= Yii::t('app', 'Group Director/ Chairman') ?>
                            </div>
                            <a class="col-lg-7 col-md-6 col-12 name-director text-wrap"
                                href="<?= Yii::$app->homeUrl ?>setting/employee/employee-profile/<?= ModelMaster::encodeParams(['employeeId' => 23]) ?>">
                                <img src="<?= Yii::$app->homeUrl ?>image/Mask-group.png" alt="Group Image">
                                <span class="d-inline-block ml-10"><?= $group["director"] ?></span>
                            </a>
                            <div class="col-lg-5 col-md-6 col-12 name-head mt-10">
                                <?= Yii::t('app', 'Headquarter Address') ?>
                            </div>
                            <div
                                class="col-lg-7 col-md-6 col-12 name-head0 mt-10 d-flex justify-content-center align-items-center">
                                <div class="col-1">
                                    <img src="<?= Yii::$app->homeUrl ?>image/location.svg"
                                        style="width: 9.333px; height: 12px;">
                                </div>
                                <div class="col-11 address-box text-wrap">
                                    <?= $group["location"] ?>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-6 col-12 name-head mt-10">
                                <?= Yii::t('app', 'Founded') ?>
                            </div>
                            <div class="col-lg-7 col-md-6 col-12 name-head0 mt-10 text-wrap">
                                <?php
                                $yearOnly = substr($group["founded"], 0, 4);
                                echo $yearOnly; // แสดงผล: 1998
                                ?>
                            </div>
                            <div class="col-lg-5 col-md-6 col-12 name-head mt-10">
                                <?= Yii::t('app', 'Industry') ?>
                            </div>
                            <div class="col-lg-7 col-md-6 col-12 name-head0 mt-10 text-wrap">
                                <?= Yii::t('app', $group["industries"]) ?>
                            </div>
                        </div>
                        <div class="col-12 Group-Information">
                            <?= Yii::t('app', 'Contact Information') ?>
                            <hr class="hr-group">
                        </div>
                        <div class="row">
                            <div class="col-lg-5 col-md-6 col-12 name-head mt-10">
                                <?= Yii::t('app', 'Email') ?>
                            </div>
                            <div class="col-lg-7 col-md-5 col-12 name-head0 mt-5 d-flex align-items-center">
                                <a class="text-primary address-box0 text-wrap pr-5"><?= $group["email"] ?></a>
                                <img src="<?= Yii::$app->homeUrl ?>image/coppy.svg"
                                    onclick="javascript:copyToClipboard('<?= $group['email'] ?>')"
                                    style="width: 10.884px; height: 12px;">
                            </div>
                            <div class="col-lg-5 col-md-6 col-12 name-head mt-10">
                                <?= Yii::t('app', 'Phone') ?>
                            </div>
                            <div class="col-lg-7 col-md-5 col-12 name-head0 mt-5 d-flex align-items-center">
                                <span class="text-wrap pr-5"><?= $group["contact"] ?></span>
                                <img src="<?= Yii::$app->homeUrl ?>image/coppy.svg"
                                    onclick="javascript:copyToClipboard('<?= $group['contact'] ?>')"
                                    style="width: 10.884px; height: 12px;">
                            </div>
                            <div class="col-lg-5 col-md-6 col-12 name-head mt-10">
                                <?= Yii::t('app', 'Website') ?>
                            </div>
                            <div class="col-lg-7 col-md-5 col-12 name-head0 mt-5 d-flex align-items-center">
                                <a href="<?= $group['website'] ?>" target="_blank"
                                    class="text-primary text-wrap"><?= $group["website"] ?></a>
                            </div>
                        </div>
                    </div>


                    <!-- Right Column -->
                    <div class="col-lg-6 col-md-6 col-12 box-about0">
                        <div class="row about-section">
                            <div class="col-12 about-name">
                                <span><?= Yii::t('app', 'About us') ?></span>
                                <hr class="hr-group">
                            </div>
                            <div class="col-12 detail-tokyo">
                                <p id="about-text">
                                    <?= mb_strlen(Yii::t('app', $group["about"])) > 200 
                                        ? mb_substr(Yii::t('app', $group["about"]), 0, 200) . '...' 
                                        : Yii::t('app', $group["about"]) ?>
                                    <?php if (mb_strlen(Yii::t('app', $group["about"])) > 200): ?>
                                    <button id="see-more"
                                        class="see-more"><span><?= Yii::t('app', 'See More') ?></span></button>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>

                        <div class="col-12 mt-10 text-end">
                            <img src="<?= Yii::$app->homeUrl ?>image/icon-x<?= empty($group["socialX"]) ? '-off' : '' ?>.svg"
                                style="width: 24px; height: 24.6px;">
                            <img src="<?= Yii::$app->homeUrl ?>image/icon-in<?= empty($group["socialLinkin"]) ? '-off' : '' ?>.svg"
                                style="width: 24px; height: 24.6px;">
                            <img src="<?= Yii::$app->homeUrl ?>image/icon-yt<?= empty($group["socialYoutube"]) ? '-off' : '' ?>.svg"
                                style="width: 24px; height: 24.6px;">
                            <img src="<?= Yii::$app->homeUrl ?>image/icon-face<?= empty($group["socialFacebook"]) ? '-off' : '' ?>.svg"
                                style="width: 24px; height: 24.6px;">
                            <img src="<?= Yii::$app->homeUrl ?>image/icon-ig<?= empty($group["socialInstargram"]) ? '-off' : '' ?>.svg"
                                style="width: 24px; height: 24.6px;">
                        </div>
                    </div>

                    <!-- Bottom Row -->
                    <div class="col-12 mt-10 current-stats">
                        <div class="col-12 Group-Information">
                            <?= Yii::t('app', 'Affiliated Entities') ?>
                            <hr class="hr-group">
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="alert alert-secondary-background" style="width: 100%;">
                                    <a href="<?= Yii::$app->homeUrl ?>setting/branch/create/<?= ModelMaster::encodeParams(['companyId' => '']) ?>"
                                        class="text-decoration-none" style="width: 60%;">
                                        <div class="row align-items-center">
                                            <div class="col-lg-8 col-md-8 col-8 text-left">
                                                <div class="circle-container">
                                                    <!-- <div class="cycle-current-yellow">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg"
                                                            alt="icon">
                                                    </div>
                                                    <div class="cycle-current-yellow">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg"
                                                            alt="icon">
                                                    </div>
                                                    <div class="cycle-current-yellow">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg"
                                                            alt="icon">
                                                    </div> -->
                                                    <div
                                                        class="cycle-current-<?= $totalBranches >= 1 ? 'yellow' : 'gray' ?>">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg"
                                                            alt="icon">
                                                    </div>
                                                    <div
                                                        class="cycle-current-<?= $totalBranches >= 2 ? 'yellow' : 'gray' ?>">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg"
                                                            alt="icon">
                                                    </div>
                                                    <div
                                                        class="cycle-current-<?= $totalBranches >= 3 ? 'yellow' : 'gray' ?>">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg"
                                                            alt="icon">
                                                    </div>
                                                    <div class="number-current"><?= $totalBranches ?></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-4 text-right">
                                                <div class="text-name-current">
                                                    <?= Yii::t('app', 'Branch') ?>
                                                </div>
                                                <div class="text-see-all"><?= Yii::t('app', 'See All') ?></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="alert alert-secondary-background" style="width: 100%;">
                                    <a href="<?= Yii::$app->homeUrl ?>setting/department/create/<?= ModelMaster::encodeParams(['companyId' => '']) ?>"
                                        class="text-decoration-none" style="width: 60%;">
                                        <div class="row align-items-center">
                                            <div class="col-lg-8 col-md-8 col-8 text-left">
                                                <div class="circle-container">
                                                    <div
                                                        class="cycle-current-<?= $totalDepartment >= 1 ? 'red' : 'gray' ?>">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/departments<?= $totalDepartment >= 1 ? '' : '-black' ?>.svg"
                                                            alt="icon">
                                                    </div>
                                                    <div
                                                        class="cycle-current-<?= $totalDepartment >= 2 ? 'red' : 'gray' ?>">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/departments<?= $totalDepartment >= 2 ? '' : '-black' ?>.svg"
                                                            alt="icon">
                                                    </div>
                                                    <div
                                                        class="cycle-current-<?= $totalDepartment >= 3 ? 'red' : 'gray' ?>">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/departments<?= $totalDepartment >= 3 ? '' : '-black' ?>.svg"
                                                            alt="icon">
                                                    </div>
                                                    <div class="number-current"><?= $totalDepartment ?></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-4 text-right">
                                                <div class="text-name-current"><?= Yii::t('app', 'Department') ?></div>
                                                <div class="text-see-all"><?= Yii::t('app', 'See All') ?></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="alert alert-secondary-background" style="width: 100%;">
                                    <a href="<?= Yii::$app->homeUrl ?>setting/team/create/<?= ModelMaster::encodeParams(['companyId' => '']) ?>"
                                        class="text-decoration-none" style="width: 60%;">
                                        <div class="row align-items-center">
                                            <div class="col-lg-8 col-md-8 col-8 text-left">
                                                <div class="circle-container">
                                                    <div
                                                        class="cycle-current-<?= $totalTeam >= 1 ? 'green' : 'gray' ?>">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/teams<?= $totalTeam >= 1 ? '' : '-black' ?>.svg"
                                                            alt="icon">
                                                    </div>
                                                    <div
                                                        class="cycle-current-<?= $totalTeam >= 2 ? 'green' : 'gray' ?>">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/teams<?= $totalTeam >= 2 ? '' : '-black' ?>.svg"
                                                            alt="icon">
                                                    </div>
                                                    <div
                                                        class="cycle-current-<?= $totalTeam >= 3 ? 'green' : 'gray' ?>">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/teams<?= $totalTeam >= 3 ? '' : '-black' ?>.svg"
                                                            alt="icon">
                                                    </div>
                                                    <div class="number-current"><?= $totalTeam ?></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-4 text-right">
                                                <div class="text-name-current"><?= Yii::t('app', 'Team') ?></div>
                                                <div class="text-see-all"><?= Yii::t('app', 'See All') ?></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <div class="alert alert-secondary-background" style="width: 100%;">
                                    <a href="<?= Yii::$app->homeUrl ?>setting/employee/index/<?= ModelMaster::encodeParams(['companyId' => '']) ?>"
                                        class="text-decoration-none" style="width: 60%;">
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <div class="circle-container-img">
                                                    <?php for ($i = 0; $i < 3; $i++): ?>
                                                    <?php if (!empty($employees[$i]['picture'])): ?>
                                                    <div class="cycle-image <?= $i == 2 ? 'mr-10' : 'mr-3' ?>">
                                                        <img src="<?= Yii::$app->homeUrl . $employees[$i]['picture'] ?>"
                                                            alt="icon">
                                                    </div>
                                                    <?php else: ?>
                                                    <div class="cycle-current-gray <?= $i == 2 ? 'mr-10' : 'mr-3' ?>">
                                                        <img src="<?= Yii::$app->homeUrl ?>image/employees-black.svg"
                                                            alt="icon">
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php endfor; ?>
                                                    <div class="number-current"><?= $totalEmployees ?></div>
                                                </div>


                                            </div>
                                            <div class="col-lg-4 col-md-4 col-4 text-right">
                                                <div class="text-name-current"><?= Yii::t('app', 'Employee') ?>
                                                </div>
                                                <div class="text-see-all"><?= Yii::t('app', 'See All') ?></div>
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
            <div class="col-lg-3 col-md-4 col-12  home-tokyo">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-12"
                        style="width: 15px; height: 15px; padding-right : 0px; padding-left: 0px; bottom: 5px; ">
                        <img src="<?= Yii::$app->homeUrl ?>image/companies.svg" style="width: 15px; height: 15px;">
                    </div>
                    <div class="col-lg-9 col-md-7 col-12 Affiliated0">
                        <?= Yii::t('app', 'Affiliated Companies') ?>
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
                                <img src="<?= Yii::$app->homeUrl . $company['picture'] ?>" class="width-TCF-BD"
                                    style="border-radius: 100%;">
                                <?php
									} else {
									?>
                                <img src="<?= Yii::$app->homeUrl . 'image/userProfile.png' ?>" class="width-TCF-BD"
                                    style="border-radius: 100%;">
                                <?php
									}
									?>
                            </div>
                            <div class="col-lg-7 col-md-7 col-7">
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
                                <div class="city-group">
                                    <img src="<?= Yii::$app->homeUrl ?>image/plus-red.svg"
                                        style="width: 10.5px; height: 10.5px; ">
                                    <?= $company["city"] ?>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-1 col-1 d-flex justify-content-center align-items-center">
                                <img src="<?= Yii::$app->homeUrl ?>image/btn-view.svg" alt="View Button">
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
                        <a href="<?= Yii::$app->homeUrl ?>setting/company/index"> <?= Yii::t('app', 'See All') ?> </a>
                    </div>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const seeMoreBtn = document.getElementById("see-more");
    const aboutText = document.getElementById("about-text");

    <?php if (mb_strlen($group["about"]) > 200): ?>
    const fullText = `<?= addslashes($group["about"]) ?>`;
    const shortText = `<?= addslashes(mb_substr($group["about"], 0, 200)) ?>...`;

    seeMoreBtn.addEventListener("click", function() {
        if (aboutText.textContent.includes(shortText)) {
            aboutText.innerHTML = fullText +
                `<button id="see-more" class="see-more">See Less</button>`;
            document.getElementById("see-more").addEventListener("click", toggleText);
        } else {
            aboutText.innerHTML = shortText +
                `<button id="see-more" class="see-more">See More</button>`;
            document.getElementById("see-more").addEventListener("click", toggleText);
        }
    });

    function toggleText() {
        if (aboutText.innerHTML.includes(shortText)) {
            aboutText.innerHTML = fullText + `<button id="see-more" class="see-more">See Less</button>`;
        } else {
            aboutText.innerHTML = shortText + `<button id="see-more" class="see-more">See More</button>`;
        }
        document.getElementById("see-more").addEventListener("click", toggleText);
    }
    <?php endif; ?>
});
</script>