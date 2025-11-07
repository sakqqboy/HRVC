<?php

use common\helpers\Path;
use common\models\ModelMaster;

$this->title = 'Group Profile';
?>

<div class="col-12 mt-60 pt-10 bg-white">
    <div class="d-flex" style="height: 159px;">
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

    <div class="d-flex justify-content-start" style="margin-top: -67.5px;">
        <div class="ml-35">
            <div class="avatar-upload-preview">
                <div class="avatar-preview">
                    <?php if ($group["picture"] != null) { ?>
                        <img src="<?= Yii::$app->homeUrl . $group['picture'] ?>" class="company-group-picture">
                    <?php } else { ?>
                        <img src="<?= Yii::$app->homeUrl . 'image/groupProfile.jpg' ?>" class="company-group-picture">
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="<?= $role < 5 ? 'flex-grow-1' : '' ?> align-content-end">
            <div class="d-flex pl-10" style="height: 26px;">
                <span class="name-sub-tokyo"><?= Yii::t('app', $group['displayName']) ?></span>
                <span class="name-full-tokyo">(<?= Yii::t('app', $group['groupName']) ?>)</span>
            </div>
            <div class="d-flex tokyo-small pl-10 mt-5">
                <img src="<?= Yii::$app->homeUrl . 'image/hyphen.svg' ?>" class="mr-5"> <?= $group['tagLine'] ?>
            </div>
        </div>

        <?php if ($role >= 5) { ?>
            <div class="flex-grow-1" style="display: flex;justify-content: end;align-items: end;">
                <a href="<?= Yii::$app->homeUrl ?>setting/group/update-group/<?= ModelMaster::encodeParams(['groupId' => $group['groupId']]) ?>"
                    class="create-employee-btn" style="min-width: 150px;font-size:12px;">
                    <img src="<?= Yii::$app->homeUrl . 'image/refresh-white.svg' ?>" class="mr-3">
                    <?= Yii::t('app', 'Update Information') ?>
                </a>
            </div>
        <?php } ?>
    </div>
    <div class="row  mt-45" style="--bs-gutter-x:0px;">
        <div class="col-lg-9 col-md-6 col-12">
            <div class="row" style="--bs-gutter-x:0px;">
                <div class="col-lg-5 col-md-6 col-12 all-information">
                    <div class="col-12 Group-Information">
                        <?= Yii::t('app', 'Group Details') ?>
                        <hr class="hr-group">
                    </div>
                    <div class="row mb-36" style="--bs-gutter-x:0px;">
                        <div class="col-lg-4 col-6 name-head">
                            <?= Yii::t('app', 'Group Director/ Chairman') ?>
                        </div>
                        <div class="col-lg-8 col-6 name-director text-truncate pl-20 pr-5 align-content-center">
                            <?php
                            if (isset($group["directorName"])) {
                                $directorName = $group["directorName"]; ?>
                                <img src="<?= Yii::$app->homeUrl ?><?= $group['directorPicture'] ?>" alt="Group Image" class="mr-5 director-pic">
                                <a href="<?= Yii::$app->homeUrl ?>setting/employee/employee-profile/<?= ModelMaster::encodeParams(['employeeId' => $group['director']]) ?>">
                                    <?= $directorName ?>
                                </a>
                            <?php
                            } else { ?>
                                Not set
                            <?php
                            }
                            ?>


                        </div>
                        <div class="col-lg-4 col-6 name-head mt-10">
                            <?= Yii::t('app', 'Headquarter Address') ?>
                        </div>
                        <div class="col-lg-8 col-6 name-head0 mt-10 pl-20">
                            <img src="<?= Yii::$app->homeUrl ?>image/location.svg" class="mr-5" style="width: 9.333px; height: 12px;">
                            <?= $group["location"] ?>
                        </div>
                        <div class="col-lg-4 col-6 name-head mt-10">
                            <?= Yii::t('app', 'Founded') ?>
                        </div>
                        <div class="col-lg-8 col-6 name-head0 mt-10 pl-20">
                            <?php
                            $yearOnly = substr($group["founded"], 0, 4);
                            echo $yearOnly; // แสดงผล: 1998
                            ?>
                        </div>
                        <div class="col-lg-4 col-6 name-head mt-10">
                            <?= Yii::t('app', 'Industry') ?>
                        </div>
                        <div class="col-lg-8 col-6 name-head0 mt-10 pl-20">
                            <?= Yii::t('app', $group["industries"]) ?>
                        </div>
                    </div>
                    <div class="col-12 Group-Information">
                        <?= Yii::t('app', 'Contact Information') ?>
                        <hr class="hr-group">
                    </div>
                    <div class="row mb-36" style="--bs-gutter-x:0px;">
                        <div class="col-lg-4 col-6 name-head">
                            <?= Yii::t('app', 'Email') ?>
                        </div>
                        <div class="col-lg-8 col-6 name-head0  pl-20">
                            <div style="max-width:90%;" class="text-truncate d-inline-block ">
                                <a href="<?= $group["email"] ?>" class="text-primary address-box0 " title="<?= $group["email"] ?>">
                                    <?= $group["email"] ?>
                                </a>
                            </div>

                            <img src="<?= Yii::$app->homeUrl ?>image/coppy.svg" onclick="javascript:copyToClipboard('<?= $group['email'] ?>')" class="ml-5"
                                style="width: 10.884px; height: 12px;cursor:pointer;margin-top:-5px;">
                        </div>
                        <div class="col-lg-4 col-6 name-head mt-10">
                            <?= Yii::t('app', 'Phone') ?>
                        </div>
                        <div class="col-lg-8 col-6 name-head0 mt-10 pl-20">
                            <span class="text-wrap pr-5"><?= $group["contact"] ?></span>
                            <img src="<?= Yii::$app->homeUrl ?>image/coppy.svg"
                                onclick="javascript:copyToClipboard('<?= $group['contact'] ?>')"
                                style="width: 10.884px; height: 12px;cursor:pointer;">
                        </div>
                        <div class="col-lg-4 col-6 name-head mt-10">
                            <?= Yii::t('app', 'Website') ?>
                        </div>
                        <div class="col-lg-8 col-6 name-head0 mt-10 pl-20">
                            <div style="max-width:90%;" class="text-truncate d-inline-block ">
                                <a href="<?= $group["website"] ?>" class="text-primary address-box0" target="_blank">
                                    <?= $group["website"] ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Right Column -->
                <div class="col-lg-7 col-md-6 col-12 box-about0">
                    <div class="row about-section" style="--bs-gutter-x:0px;">
                        <div class="col-12 Group-Information">
                            <?= Yii::t('app', 'About us') ?>
                            <hr class="hr-group">
                        </div>

                        <div class="col-12 detail-tokyo">
                            <span id="about-text">
                                <?= mb_strlen(Yii::t('app', $group["about"])) > 800
                                    ? mb_substr(Yii::t('app', $group["about"]), 0, 800) . '...'
                                    : Yii::t('app', $group["about"]) ?>
                                <?php if (mb_strlen(Yii::t('app', $group["about"])) > 800): ?>
                                    <button id="see-more"
                                        class="see-more"><span><?= Yii::t('app', 'See More') ?></span></button>
                                <?php endif; ?>
                            </span>
                        </div>
                    </div>

                    <div class="col-12 mt-20 text-end pr-15">
                        <?php
                        $socials = [
                            "socialX" => "icon-x",
                            "socialLinkin" => "icon-in",
                            "socialYoutube" => "icon-yt",
                            "socialFacebook" => "icon-face",
                            "socialInstargram" => "icon-ig"
                        ];

                        foreach ($socials as $key => $icon) {
                            $url = !empty($group[$key]) ? $group[$key] : "";
                            $offClass = empty($group[$key]) ? '-off' : '';
                            if ($url): ?>
                                <a class="d-inline-block mr-5" href="<?= $url ?>" target="_blank">
                                    <img src="<?= Yii::$app->homeUrl ?>image/<?= $icon ?><?= $offClass ?>.svg" style="width:24px;height:24.6px;">
                                </a>
                            <?php else: ?>
                                <img src="<?= Yii::$app->homeUrl ?>image/<?= $icon ?><?= $offClass ?>.svg" style="width:24px;height:24.6px;">
                        <?php endif;
                        }
                        ?>
                    </div>
                </div>

                <!-- Bottom Row -->
                <div class="col-12 mt-10 current-stats mb-10">
                    <div class="col-12 Group-Information">
                        <?= Yii::t('app', 'Affiliated Entities') ?>
                        <hr class="hr-group">
                    </div>
                    <div class="row" style="--bs-gutter-x:0px;">
                        <div class="col-lg-4 col-md-6 col-12 mb-20">
                            <a href="<?= Yii::$app->homeUrl ?>setting/branch/no-branch/<?= ModelMaster::encodeParams(['companyId' => '']) ?>" class="text-decoration-none">
                                <div class="row align-items-center" style="--bs-gutter-x:0px;">
                                    <div class="col-12 text-left pl-35 d-flex">
                                        <div class="circle-container ">
                                            <div class="cycle-current-<?= $totalBranches >= 1 ? 'yellow' : 'gray' ?>">
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
                                        <div class="text-name-current ml-15 align-content-center">
                                            <?= Yii::t('app', 'Branch') ?>
                                            <div class="text-see-all"><?= Yii::t('app', 'See All') ?></div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12  mb-20">
                            <a href="<?= Yii::$app->homeUrl ?>setting/department/no-department/<?= ModelMaster::encodeParams(['companyId' => '']) ?>" class="text-decoration-none">
                                <div class="row align-items-center" style="--bs-gutter-x:0px;">
                                    <div class="col-12 text-left pl-35 d-flex">
                                        <div class="circle-container ">
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
                                        <div class="text-name-current ml-15 align-content-center">
                                            <?= Yii::t('app', 'Department') ?>
                                            <div class="text-see-all"><?= Yii::t('app', 'See All') ?></div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12 mb-20">
                            <a href="<?= Yii::$app->homeUrl ?>setting/team/no-team/<?= ModelMaster::encodeParams(['companyId' => '']) ?>" class="text-decoration-none">
                                <div class="row align-items-center" style="--bs-gutter-x:0px;">
                                    <div class="col-12 text-left pl-35 d-flex">
                                        <div class="circle-container ">
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
                                        <div class="text-name-current ml-15 align-content-center">
                                            <?= Yii::t('app', 'Team') ?>
                                            <div class="text-see-all"><?= Yii::t('app', 'See All') ?></div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12 mb-20">
                            <a href="<?= Yii::$app->homeUrl ?>setting/employee/no-employee/<?= ModelMaster::encodeParams(['companyId' => '']) ?>"
                                class="text-decoration-none">
                                <div class="row align-items-center" style="--bs-gutter-x:0px;">
                                    <div class="col-12 text-left pl-35 d-flex">
                                        <div class="circle-container-img">
                                            <?php for ($i = 0; $i < 3; $i++): ?>
                                                <?php if (!empty($employees[$i])): ?>
                                                    <div class="cycle-image <?= $i == 2 ? 'mr-10' : 'mr-3' ?>">
                                                        <img src="<?= Yii::$app->homeUrl . $employees[$i] ?>"
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
                                        <div class="text-name-current ml-15 align-content-center">
                                            <?= Yii::t('app', 'Employee') ?>
                                            <div class="text-see-all"><?= Yii::t('app', 'See All') ?></div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <hr class="hr-group-vertical"> -->
        <div class="col-lg-3 col-md-6 col-12 pl-10">
            <div class="row" style="--bs-gutter-x:0px;">
                <!-- <div class="col-lg-2 col-md-2 col-12"
                    style="width: 15px; height: 15px; padding-right : 0px; padding-left: 0px; bottom: 5px; ">
                    <img src="<?= Yii::$app->homeUrl ?>image/companies.svg" style="width: 15px; height: 15px;">
                </div> -->
                <div class="col-10 Group-Information">
                    <img src="<?= Yii::$app->homeUrl ?>image/companies.svg" class="mr-10" style="width: 15px; height: 15px;">
                    <?= Yii::t('app', 'Affiliated Companies') ?>
                </div>
                <div class="col-2 text-end box-27">
                    <?= count($companyGroup) ?>
                </div>
                <hr class="hr-group">
            </div>
            <div class="col-12">
                <?php
                if (isset($companyGroup) && count($companyGroup) > 0) {
                    $i = 0;
                    foreach ($companyGroup as $company) :
                        if ($i >= 7)
                            break;
                ?>
                        <div class="col-12 mb-10">
                            <a href="<?= Yii::$app->homeUrl . 'setting/company/company-view/' . ModelMaster::encodeParams([
                                            'companyId' => $company['companyId']
                                        ]) ?>" class="no-underline" style="color:black;">
                                <div class="row  affiliated-list" style="--bs-gutter-x:0px;">
                                    <div class="col-lg-2 col-md-3 col-4 ">
                                        <?php
                                        if ($company['picture'] != "") {
                                            $file = Path::getHost() . $company["picture"];
                                            if (file_exists($file)) {
                                                $picture = $company["picture"];
                                            } else {
                                                $picture = 'image/no-company.svg';
                                            }
                                        ?>
                                            <img src="<?= Yii::$app->homeUrl . $picture ?>" class="width-TCF-BD"
                                                style="border-radius: 100%;">
                                        <?php
                                        } else {
                                        ?>
                                            <img src="<?= Yii::$app->homeUrl . 'image/no-company.svg' ?>" class="width-TCF-BD"
                                                style="border-radius: 100%;">
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-lg-8 col-md-7 col-7 align-content-center">
                                        <div class="tokyoconsultinggroup text-truncate">
                                            <?= $company['companyName'] ?>
                                            <?php
                                            if ($company['headQuaterId'] == null) {
                                            ?>
                                                <span style="font-size: 11px;font-weight:100;">(head Quater)</span>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="city-group mt-3">
                                            <img src="<?= Yii::$app->homeUrl ?><?= $company["flag"] != '' ? $company["flag"] : 'image/e-world.svg' ?>"
                                                class="mr-3 img-fluid" style="width: 16px; height: 16px;border-radius:100%; ">
                                            <?= $company["city"] != '' ? $company["city"] : 'Not set' ?>, <?= $company["countryName"] ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-1 col-1 align-content-center text-end">
                                        <img src="<?= Yii::$app->homeUrl ?>image/btn-view.svg" alt="View Button">
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php
                        $i++;
                    endforeach;
                }
                if (count($companyGroup) > 7) {
                    ?>
                    <div class="col-12 text-end font-size-14">
                        <a href="<?= Yii::$app->homeUrl ?>setting/company/company-grid"> <?= Yii::t('app', 'See All') ?>
                        </a>
                    </div>
                <?php
                }
                ?>

            </div>
        </div>
    </div>
</div>
<style>
    .submain-content {
        width: 100%;
        max-width: 100%;
        padding-left: 30px;
        padding-right: 30px;
        min-height: 100vh;
        /* flex: 1; */
        background-color: white;
    }
</style>
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