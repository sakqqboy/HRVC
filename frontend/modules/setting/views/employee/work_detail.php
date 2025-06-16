<?php
if (isset($employee['birthDate'])) {
    $birthDate = new DateTime($employee['birthDate']);
    $today = new DateTime();

    // ตั้งวันเกิดถัดไปในปีนี้
    $nextBirthday = new DateTime($today->format('Y') . '-' . $birthDate->format('m-d'));

    // ถ้าวันเกิดปีนี้ผ่านไปแล้ว ให้เพิ่มปี +1
    if ($nextBirthday < $today) {
        $nextBirthday->modify('+1 year');
    }
    // คำนวณจำนวนวัน
    $interval = $today->diff($nextBirthday)->days;
}

$dateSince = new DateTime($employee['joinDate']);
$datePeriod = new DateTime($employee['probationEnd']);
$interval = $dateSince->diff($today);
$probation  = $datePeriod->diff($today);

?>

<div class="d-flex row" style="gap: 32px;">
    <div class="w-100">
        <span class="font-size-16 font-weight-600">Work Details</span>
        <hr class="hr-group">
    </div>

    <div class="start-center" style="gap: 43px; display: flex; flex-wrap: wrap;">
        <div class="center-center" style="gap: 72px;  width: 100%;">
            <div class="start-center" style="gap: 35px;">
                <div>
                    <div style="display: flex; align-items: center; gap: 17px;">
                        <div class="mid-center" style="height: 60px; padding: 20.944px 4.189px; gap: 10.472px;">
                            <?php 
                            if($company['companyName']){
                            ?>
                            <img src="<?= Yii::$app->homeUrl . $company['picture']?>" class="card-tcf">
                            <?php
                            }else{
                              ?>
                            <img src="<?= Yii::$app->homeUrl ?>image/userProfile.png" class="card-tcf">
                            <?php  
                            }
                            ?>
                        </div>
                        <div class="header-crad-company">
                            <span class="font-size-22 font-weight-500">
                                <?= $company['companyName'] ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="start-center" style="gap: 22px;">
                    <span class="profile-employee-title">
                        <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg" class="profile-icon"
                            style="margin-top: -3px; width: 15px; height: 15px;">
                        <?= $branch['branchName'] ?> Branch
                    </span>
                    <span class="profile-employee-title">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/share.svg" class="profile-icon"
                            style="margin-top: -3px;">
                        <?= $department['departmentName'] ?> Department
                    </span>
                    <span class="profile-employee-title">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team.svg" class="profile-icon"
                            style="margin-top: -3px;">
                        <?= $team['teamName'] ?> Team
                    </span>
                    <span class="profile-employee-title">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/star.svg" class="profile-icon"
                            style="margin-top: -3px;">
                        <?= $title['titleName'] ?>
                    </span>
                </div>
            </div>
            <div class="start-center" style="gap: 28px; width: 100%;">
                <div style="display: flex; gap: 25px; width: 100%;">
                    <span class="text-gray font-size-16 font-weight-400" style="width: 171px;">
                        Employment Status
                    </span>
                    <span class="condition-name badge">
                        <?= $employee['employeeConditionName'] ?>
                    </span>
                </div>
                <div style="display: flex; gap: 25px; width: 100%;">
                    <span class="text-gray font-size-16 font-weight-400" style="width: 171px;">
                        <img src="<?= Yii::$app->homeUrl ?>image/e-since.svg" alt="Address"
                            style="width: 16px; height: 16px;">
                        Employee Since
                    </span>
                    <div class="row">
                        <span class="font-size-16 font-weight-500">
                            <?=  $dateSince->format('jS F Y');  // ตัวอย่างผลลัพธ์: 31st January 2024?>
                        </span>
                        <span class="text-gray font-size-16 font-weight-400">
                            <?=  $interval->y . ' Year ' . $interval->m . ' months';?>
                        </span>
                    </div>
                </div>
                <div style="display: flex; gap: 25px; width: 100%;">
                    <span class="text-gray font-size-16 font-weight-400" style="width: 171px;">
                        <img src="<?= Yii::$app->homeUrl ?>image/e-period.svg" alt="Address"
                            style="width: 16px; height: 16px;">
                        Probation Period
                    </span>
                    <div class="row">
                        <span class="font-size-16 font-weight-500">
                            Finished on <?=  $datePeriod->format('d/m/Y');  // ตัวอย่างผลลัพธ์: 31st January 2024?>
                        </span>
                        <span class="text-gray font-size-16 font-weight-400">
                            <?=  $probation->y . ' Year ' . $interval->m . ' months';?>
                        </span>
                    </div>
                </div>
                <div style="display: flex; gap: 25px; width: 100%;">
                    <div style="width: 171px;">
                        <span class="text-gray font-size-16 font-weight-400"
                            style="white-space: nowrap; display: flex; align-items: center; gap: 6px;">
                            <img src="<?= Yii::$app->homeUrl ?>image/e-address.svg" alt="Address"
                                style="width: 16px; height: 16px;">
                            Work Address
                        </span>
                    </div>
                    <div class="row d-flex">
                        <span class="font-size-16 font-weight-500">
                            <?= $company['location'] ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex row" style="gap: 16px; width: 100%;">
            <div class="w-100">
                <span class="font-size-16 font-weight-600">Job Description</span>
            </div>
            <div class="company-group-edit bg-white" style="gap: 43px; padding: 36px 26px;">
                <div class="center-center" style="gap: 63px; margin: 36px 29px;">
                    <div class="row" style="border-right:lightgray solid thin;">
                        <div class="row mb-36">
                            <span class="font-size-16 font-weight-500 mb-22">Purpose of the Job</span>
                            <span class="font-size-14 font-weight-400">
                                <?= $title['purpose'] ?>
                            </span>
                        </div>
                        <div class="row">
                            <span class="font-size-16 font-weight-500 mb-22">Core Responsibility</span>
                            <span class="font-size-14 font-weight-400">
                                <?= $title['jobDescription'] ?>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <span class="font-size-16 font-weight-500 mb-22">Key Responsibility</span>
                        <span class="font-size-14 font-weight-400">
                            <?= $title['keyResponsibility'] ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>