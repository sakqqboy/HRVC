<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'update-employee-history',
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
    'action' => Yii::$app->homeUrl . 'kgi/kgi-personal/save-update-employee-history'
]);

$this->title = Yii::t('app', 'Update Employee History');

// การคำนวณพื้นฐาน
$percentage = isset($data['ratio']) ? round((float)$data['ratio']) : 0;
$result = $data['result'] ?? 0;
$targetAmount = $data['target'] ?? 0;
$DueBehind = $targetAmount - $result;
$detail = !empty($data['kgiDetail']) ? $data['kgiDetail'] : 'No details listed';
$maxLength = 487;

// คำนวณ Days Left (แสดงผลอย่างเดียว)
$nextCheckDate = !empty($data['nextCheckText']) ? DateTime::createFromFormat('d M Y', $data['nextCheckText']) : null;
if (!$nextCheckDate) {
    $daysLeft = "Not set";
} else {
    $currentDate = new DateTime();
    $interval = $currentDate->diff($nextCheckDate);
    $daysCount = (int)$interval->format('%r%a');
    $daysLeft = ($daysCount < 0) ? "Due Pass" : "$daysCount " . Yii::t('app', 'days left');
}
?>

<style>
    /* ป้องกันการกดลูกศรขึ้นลงใน input number */
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
    }

    /* ตกแต่งส่วนที่แก้ไขไม่ได้ให้ดูเป็น Read-only */
    .readonly-field {
        background-color: #F8F9FA !important;
        border: 0.5px solid #D1D1D1 !important;
        cursor: not-allowed;
        color: #8A8A8A !important;
    }
</style>

<div class="col-12 mt-70 pt-20">
    <div class="d-flex justify-content-start pt-0 pb-0" style="line-height: 30px;">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Group23177.svg" class="pim-head-icon mr-11 mt-2">
        <span class="pim-head-text mr-10"> <?= Yii::t('app', 'Performance Indicator Matrices (PIM)') ?></span>
    </div>

    <?= $this->render('header_filter', [
        "role" => $role,
        "allCompany" => $allCompany,
        "companyPic" => $companyPic,
        "totalBranch" => $totalBranch
    ]) ?>

    <div class="col-12 mt-20">
        <div class="bg-white-pim pr-30 pl-30">
            <div class="row" style="--bs-gutter-x:0px;">
                <div class="col-6 align-content-center" style="height:55px;">
                    <div class="pim-name-title" style="display: flex; align-items: center; gap: 14px;">
                        <a href="<?= Yii::$app->request->referrer ? Yii::$app->request->referrer : Yii::$app->homeUrl . 'kgi/kgi-personal/individual-kgi-grid' ?>" style="text-decoration: none; width:70px; height:26px;" class="btn-create-branch">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/back-white.svg" style="width:18px; height:18px; margin-top:-3px;">
                            <?= Yii::t('app', 'Back') ?>
                        </a>
                        <?= Yii::t('app', 'Update Key Individual Performance Indicator') ?>
                    </div>
                </div>
                <div class="col-6" style="height: 55px;">
                    <div class="d-flex justify-content-end align-items-center">
                        <div class="current-ratio text-end mr-10 align-self-center ">
                            <?= Yii::t('app', 'Current Achievement Ratio') ?>
                            <div class="current-ratio-data text-end mt-15">
                                <?= $DueBehind ? Yii::t('app', 'Due Behind by ') . ' ' . number_format($DueBehind) : Yii::t('app', 'no Data') ?>
                            </div>
                        </div>
                        <div style="width: 10%;" class="d-flex align-items-center align-self-start">
                            <svg viewBox="0 0 36 36" class="circular-chart-create" xmlns="http://www.w3.org/2000/svg">
                                <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" style="stroke: hsla(217, 100%, 91%, 1); stroke-width: 3;" fill="none" />
                                <path class="circle" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" stroke="#4db8ff" stroke-width="3" fill="none" stroke-dasharray="<?= $percentage ?>, 100" />
                                <text x="18" y="20.35" text-anchor="middle" dominant-baseline="middle" class="percentage" style="font-size: 8px; font-weight: bold; fill: #333;"><?= $percentage ?>%</text>
                            </svg>
                        </div>
                        <div style="width: 1px; background-color: #BBCDDE; height: 51px;" class="mr-10 ml-10 d-flex align-items-center border align-self-center"></div>
                        <div class="d-flex align-items-center align-self-center">
                            <img src="<?= Yii::$app->homeUrl ?><?= isset($data['result']) ? 'image/result-blue.svg' : 'images/icons/Settings/reward.svg' ?>" style="width: 40px; height: 40px;">
                            <text class="pim-total-reward"><?= isset($data['result']) ? number_format($data['result']) : '000' ?></text>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contrainer-body-detail mt-10">
                <div class="row" style="--bs-gutter-x:0px;">
                    <div class="col-lg-4 col-12 pr-20">
                        <div class=""
                            style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                            <label class="text-manage-create" for="name">
                                <span class="text-danger">* </span>
                                <?= Yii::t('app', 'Name') ?> <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                    data-toggle="tooltip" data-placement="top" class="tootip-icon"
                                    title="<?= Yii::t('app', 'Enter the name of your key Performance indicator. This should be clear and specific, such as Number of customer Visits or Number of Cold calls to client') ?>">
                            </label>
                            <label class="text-black" for="name"
                                style="font-size: 22px; font-weight: 600;line-height:26px;">
                                <?= isset($data['kgiName']) ? $data['kgiName'] : '' ?>
                            </label>
                            <label class="text-gray" for="name" style="font-size: 14px; font-weight: 400;">
                                <?= Yii::t('app', 'KGI Details') ?>
                            </label>
                            <p id="about-text"
                                style="font-size: 14px; font-weight: 400; max-height: 147px;margin-top:-10px;min-height:100px;">
                                <span id="short-text">
                                    <?= mb_strlen($detail) > $maxLength ? mb_substr($detail, 0, $maxLength) . '...' : $detail ?>
                                </span>
                                <span id="full-text" style="display: none;">
                                    <?= $detail ?>
                                </span>

                                <?php if (mb_strlen($detail) > $maxLength): ?>
                                    <button type="button" id="see-more" class="see-more"><?= Yii::t('app', 'See More') ?></button>
                                <?php endif; ?>
                            </p>
                            <div class="form-group start-center mt-40">
                                <label class="text-gray" for="name" style="font-size: 14px; font-weight: 400;">
                                    <?= Yii::t('app', 'Assigned Companies') ?>
                                </label>
                                <div class="circle-container mt-14" data-type="branch"
                                    style="display: flex;align-items: center;gap: 5px;">
                                    <img src="<?= Yii::$app->homeUrl ?><?= $company['companyImg'] ?>"
                                        class="pim-pic-gridNew" style="width: 43px; height: 43px;" alt="icon">
                                    <text class="text-black" style="font-size: 16px; font-weight: 500;">
                                        <?= Yii::t('app', 'Assigned on') ?>
                                        <?= is_array($company['companyId']) ? '' : 1 ?>
                                        <?= Yii::t('app', 'Company') ?>
                                    </text>
                                </div>
                            </div>
                            <div class="mt-40">
                                <label class="text-gray" for="name" style="font-size: 14px; font-weight: 400;">
                                    <?= Yii::t('app', 'Assigned Branches') ?>
                                </label>
                                <div class="circle-container pl-16 mt-14 " style="display: flex;align-items: center;">
                                    <?php if (count($kgiBranch) >= 1) { ?>
                                        <div class="cycle-current-branch" style="width: 35px; height: 35px;">
                                            <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg" alt="icon">
                                        </div>
                                    <?php }
                                    if (count($kgiBranch) >= 2) { ?>
                                        <div class="cycle-current-branch"
                                            style="width: 35px; height: 35px;margin-left:-25px;">
                                            <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg" alt="icon">
                                        </div>
                                    <?php }
                                    if (count($kgiBranch) >= 3) { ?>
                                        <div class="cycle-current-branch"
                                            style="width: 35px; height: 35px;margin-left:-25px;">
                                            <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg" alt="icon">
                                        </div>
                                    <?php } ?>
                                    <div class="cycle-current-white"
                                        style="width: 35px; height: 35px; color: #000; right: 5px;">
                                        <?= count($kgiBranch) ?>
                                    </div>
                                    <text class="text-black" style="font-size: 14px; font-weight: 500;">
                                        <?= Yii::t('app', 'Assigned on') ?>
                                        <?= count($kgiBranch) ?>
                                        <?= Yii::t('app', 'Branches') ?>
                                    </text>
                                </div>
                            </div>
                            <div class="mt-40">
                                <label class="text-gray" for="name" style="font-size: 14px; font-weight: 400;">
                                    <?= Yii::t('app', 'Assigned Department/s') ?>
                                </label>
                                <div class="circle-container mt-14 pl-16" style="display: flex;align-items: center;">
                                    <?php
                                    if (isset($kgiDepartment)) {
                                        $totalDepartment = 0;
                                        foreach ($kgiDepartment as $branchId => $department):
                                            if (count($department) > 0) {
                                                foreach ($department as $dId => $dName):
                                                    $totalDepartment++;
                                                endforeach;
                                            }
                                        endforeach;
                                    }
                                    ?>
                                    <?php if ($totalDepartment >= 1) { ?>
                                        <div class="cycle-current-department" style="width: 35px; height: 35px;">
                                            <img src="<?= Yii::$app->homeUrl ?>image/departments.svg" alt="icon">
                                        </div>
                                    <?php }
                                    if ($totalDepartment >= 2) { ?>
                                        <div class="cycle-current-department"
                                            style="width: 35px; height: 35px;margin-left:-25px;">
                                            <img src="<?= Yii::$app->homeUrl ?>image/departments.svg" alt="icon">
                                        </div>
                                    <?php }
                                    if ($totalDepartment >= 3) { ?>
                                        <div class="cycle-current-department"
                                            style="width: 35px; height: 35px;margin-left:-25px;">
                                            <img src="<?= Yii::$app->homeUrl ?>image/departments.svg" alt="icon">
                                        </div>
                                    <?php } ?>
                                    <div class="cycle-current-white"
                                        style="width: 35px; height: 35px; color: #000; right: 5px;">
                                        <?= $totalDepartment ?>
                                    </div>
                                    <text class="text-black"
                                        style="font-size: 14px; font-weight: 500;margin-left:-5px;">
                                        <?= Yii::t('app', 'Assigned on') ?>
                                        <?= $totalDepartment ?>
                                        <?= Yii::t('app', 'Departments') ?>
                                    </text>
                                </div>
                            </div>
                            <div class="mt-20 col-12">
                                <div class="row" style="--bs-gutter-x:0px;">
                                    <!-- Left Column: Quant Ratio -->
                                    <div class="col-6  text-start" style=" border-right: #9ABCE9 solid thin">
                                        <div class="text-gray pt-2" style="font-size: 14px; font-weight: 400;">
                                            <?= Yii::t('app', 'Quant Ratio') ?>
                                        </div>
                                        <div class="pim-duedate mt-5" style="font-size: 18px; font-weight: 600; ">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $kgi["quantRatio"] == 1 ? 'quantity' : 'diamon' ?>.svg"
                                                class="pim-iconKFI" style="width: 18px; height: 18px;">
                                            <?= $kgi["quantRatio"] == 1 ? Yii::t('app', 'Quantity') : Yii::t('app', 'Quality') ?>
                                        </div>
                                    </div>

                                    <!-- Right Column: Update Interval -->
                                    <div class="col-6 text-start pl-25">
                                        <div class="text-gray pt-2" style="font-size: 14px; font-weight: 400;">
                                            <?= Yii::t('app', 'Update Interval') ?>
                                        </div>
                                        <div class="pim-duedate mt-5" style="font-size: 18px; font-weight: 600;">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/monthly.svg"
                                                class="pim-iconKFI" style="width: 18px; height: 18px;">
                                            <?= Yii::t('app', is_array($unit) ? $unit['unitName'] : $unit) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 pr-10 col-12 pt-40">
                        <div class="d-flex">
                            <div class="pr-30" style=" border-right: #9ABCE9 solid thin;height:79px;">
                                <div class="priority-star">
                                    <?php
                                    if ($kgi["priority"] == "A" || $kgi["priority"] == "B") {
                                    ?>
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/star.svg" class="default-star">
                                    <?php
                                    }
                                    if ($kgi["priority"] == "A" || $kgi["priority"] == "C") {
                                    ?>
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/star.svg" class="big-star">
                                    <?php
                                    }
                                    if ($kgi["priority"] == "B") {
                                    ?>
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/star.svg" class="default-star">
                                    <?php
                                    }
                                    if ($kgi["priority"] == "A") {
                                    ?>
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/star.svg" class="default-star">
                                    <?php
                                    }
                                    ?>
                                </div>
                                <?php
                                if ($kgi["priority"] != '') {
                                ?>
                                    <div class="priority-box">
                                        <?= Yii::t('app', 'Priority') ?>
                                        <span class="text-priority mt-5"><?= $kgi["priority"] ?></span>
                                    </div>
                                <?php
                                } else { ?>
                                    <div class="priority-box-null">
                                        <?= Yii::t('app', 'Priority') ?>
                                        <span class="text-priority mt-5"><?= Yii::t('app', 'N/A') ?></span>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="flex-grow-1 pl-32">
                                <span class="text-gray" style="font-size: 14px; font-weight: 500;">
                                    <?= Yii::t('app', 'Target Due Update Date') ?>
                                </span>
                                <div class="text-black">
                                    <label style="font-size: 20px; font-weight: 500;"><?= Yii::t('app', $daysLeft) ?></label><br>
                                    <label
                                        style="font-size: 14px; font-weight: 500;"><?= $data['nextCheckText'] ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-30">
                            <label class="text-manage-create"><?= Yii::t('app', 'Month & Year') ?></label>
                            <div class="d-flex readonly-field mt-5" style="border-radius: 36px; padding: 5px 15px; align-items: center; gap: 10px;">
                                <img src="<?= Yii::$app->homeUrl ?>image/calendar-gray.svg" style="width: 16px;">
                                <span style="font-size: 14px; font-weight: 500;"><?= ($data['monthName'] ?? '') . ' ' . ($data['year'] ?? '') ?></span>
                            </div>
                        </div>

                        <div class="form-group mt-30">
                            <label class="text-manage-create"><?= Yii::t('app', 'Due Term') ?></label>
                            <div class="d-flex readonly-field mt-5" style="border-radius: 36px; padding: 5px 15px; align-items: center; gap: 10px;">
                                <img src="<?= Yii::$app->homeUrl ?>image/calendar-gray.svg" style="width: 16px;">
                                <span style="font-size: 14px; font-weight: 500;"><?= ($data['fromDate'] ?? '') . ' - ' . ($data['toDate'] ?? '') ?></span>
                            </div>
                        </div>

                        <div class="form-group mt-30">
                            <label class="text-manage-create"><?= Yii::t('app', 'Target Due Update Date') ?></label>
                            <div class="d-flex readonly-field mt-5" style="border-radius: 36px; padding: 5px 15px; align-items: center; gap: 10px;">
                                <img src="<?= Yii::$app->homeUrl ?>image/calendar-gray.svg" style="width: 16px;">
                                <span style="font-size: 14px; font-weight: 500;"><?= $data['nextCheckText'] ?? 'N/A' ?></span>
                            </div>
                        </div>
                        <div class="form-group start-center mt-45" style="gap: 14px;">
                            <label class="text-gray" for="name" style="font-size: 14px; font-weight: 400;">
                                <?= Yii::t('app', 'Assigned Team/s') ?>
                            </label>
                            <div class="circle-container pl-15" data-type="branch" style="display: flex;
                                    align-items: center;
                                    gap: 5px;">
                                <?php if (count($kgiTeam) >= 1) { ?>
                                    <div class="cycle-current-team" style="width: 35px; height: 35px;">
                                        <img src="<?= Yii::$app->homeUrl ?>image/teams.svg" alt="icon">
                                    </div>
                                <?php }
                                if (count($kgiTeam) >= 1) { ?>
                                    <div class="cycle-current-team" style="width: 35px; height: 35px;margin-left:-20px;">
                                        <img src="<?= Yii::$app->homeUrl ?>image/teams.svg" alt="icon">
                                    </div>
                                <?php }
                                if (count($kgiTeam) >= 1) { ?>
                                    <div class="cycle-current-team" style="width: 35px; height: 35px;margin-left:-20px;">
                                        <img src="<?= Yii::$app->homeUrl ?>image/teams.svg" alt="icon">
                                    </div>
                                <?php } ?>
                                <div class="cycle-current-white"
                                    style="width: 35px; height: 35px; color: #000; right: 3px;">
                                    <?= count($kgiTeam) ?>
                                </div>
                                <text class="text-black" style="font-size: 14px; font-weight: 500;">
                                    <?= Yii::t('app', 'Assigned on Our Team') ?>
                                    <?= count($kgiTeam) > 1 ? (count($kgiTeam) - 1) . ' & ' . Yii::t('app', 'Others') : '' ?>
                                </text>
                            </div>
                        </div>
                        <div class="form-group start-center mt-45" style="gap: 14px;z-index:0;">
                            <label class="text-gray" for="name" style="font-size: 14px; font-weight: 400;">
                                <?= Yii::t('app', 'Assigned Employees') ?>
                            </label>
                            <div class="d-flex">
                                <div class="pim-picgroup">
                                    <div class="pim-pic-yenlowKFI" style="width: 35px; height: 35px;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg"
                                            alt="person icon">
                                    </div>
                                    <div class="pim-pic-yenlowKFI pic-afterKFI"
                                        style="width: 35px; height: 35px;margin-left:-15px;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg"
                                            alt="person icon">
                                    </div>
                                    <div class="pim-pic-yenlowKFI pic-afterKFI"
                                        style="width: 35px; height: 35px;margin-left:-15px;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg"
                                            alt="person icon">
                                    </div>

                                    <div class="number-tag load-yenlow head-yellow pim-pic-gridKFINum"
                                        style="width: 35px; height: 35px;margin-left:-15px;">
                                        <?= count($data['kgiEmployee']) ?>
                                    </div>
                                    <text class="text-black ml-10" style="font-size: 14px; font-weight: 500;">
                                        <?= Yii::t('app', 'Assigned on Me') ?>
                                        <?php
                                        $countTeam =  count($data['kgiEmployee']);
                                        $countTeam = $countTeam - 1;
                                        if ($countTeam > 0) {
                                            echo Yii::t('app', '& ' . $countTeam . ' Others');
                                        }
                                        ?>
                                    </text>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-12 pl-30">
                        <div class="form-group start-center" style="  gap: 14px;">
                            <label class="text-manage-create"><span class="text-danger">* </span><?= Yii::t('app', 'Master Target') ?></label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0" style="padding: 20px;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/target-blue.svg" style="width: 30px;">
                                    <span style="font-size: 22px; font-weight: 600; padding-left: 20px;"><?= $data['code'] ?? '' ?></span>
                                </span>
                                <input type="number" class="form-control text-end border-start-0 border-end-0" name="amount" step="any"
                                    value="<?= $data['target'] ?? '' ?>" style="font-size: 22px; font-weight: 600;" readonly>
                                <span class="input-group-text bg-white border-start-0" style="padding-right: 20px;">
                                    <?= ($data['amountType'] == '%') ? '<span style="font-size: 22px; font-weight: 600;">%</span>' : '' ?>
                                </span>
                            </div>
                        </div>

                        <div class="form-group start-center mt-42" style="  gap: 14px;">
                            <label class="text-manage-create between-center w-100">
                                <div><span class="text-danger">* </span><?= Yii::t('app', 'Result') ?></div>

                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0" style="padding: 20px;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/result-blue.svg" style="width: 30px;">
                                </span>
                                <input type="number" class="form-control text-end border-start-0 border-end-0" name="result" id="result-update"
                                    value="<?= $data['result'] ?? '' ?>" style="font-size: 22px; font-weight: 600;" required step="any">
                                <span class="input-group-text bg-white border-start-0" style="padding-right: 20px;">
                                </span>
                            </div>
                        </div>


                        <div class="form-group start-center mt-42" style="  gap: 14px;">
                            <label class="text-manage-create between-center w-100">
                                <div><span class="text-danger">* </span><?= Yii::t('app', 'Reason') ?></div>
                            </label>
                            <div class="input-group">

                                <input type="text" class="form-control text-start" name="reason" id="reason"
                                    value="" style="font-size: 22px; font-weight: 600;" required step="any">

                            </div>
                        </div>
                        <div class="form-group start-center mt-55" style="gap: 20px;">
                            <label class="text-manage-create between-center" for="name" style="width: 100%;">
                                <div style="flex-grow: 1;">
                                    <?= Yii::t('app', 'Status') ?>
                                </div>
                            </label>

                            <div id="textbox-check-progress"
                                class="textbox-check-<?= (empty($data['status']) || empty($data['nextCheckText'])) ? 'hide' : 'blue' ?>"
                                style="pointer-events: none; opacity: 0.8;">
                                <div class="mid-center">
                                    <?php if ($data['status'] != '2') { ?>
                                        <input type="checkbox" id="check1" name="status" value="1" class="status-checkbox"
                                            <?= (isset($data['status']) && $data['status'] == '1' && !empty($data['nextCheckText'])) ? 'checked' : '' ?>
                                            style="width: 20px; height: 20px;" disabled> <?php } ?>
                                </div>
                                <div class="mid-center">
                                    <div id="border-cicle-progress"
                                        class="border-cicle bg-white text-<?= (empty($data['status']) || empty($data['nextCheckText'])) ? 'black' : 'blue-sea' ?>"
                                        style="<?= (empty($data['status']) || empty($data['nextCheckText'])) ? 'border: 0.5px solid #30313D;' : 'border: 0.5px solid #2F42ED;' ?>">
                                        <?= Yii::t('app', 'In-Progress') ?>
                                    </div>
                                </div>
                                <div class="font-size-11 align-content-center">
                                    <text id="text-blue"
                                        class="text-<?= (empty($data['status']) || empty($data['nextCheckText'])) ? 'black' : 'blue-sea' ?>">
                                        <?= Yii::t('app', "The task is currently being addressed...") ?>
                                    </text>
                                </div>
                            </div>

                            <div id="textbox-check-completed"
                                class="textbox-check-<?= (empty($data['status']) || $data['status'] != 2) ? 'hide' : 'green' ?>"
                                style="pointer-events: none; opacity: 0.8;">
                                <div class="mid-center" style="flex-basis: 5%;">
                                    <input type="checkbox" id="check2" name="status" value="2" class="status-checkbox"
                                        <?= (isset($data['status']) && $data['status'] == '2') ? 'checked' : '' ?>
                                        style="width: 20px; height: 20px;" disabled>
                                </div>
                                <div class="mid-center">
                                    <div id="border-cicle-completed"
                                        class="border-cicle bg-white text-<?= (empty($data['status']) || empty($data['nextCheckText']) || $data['status'] != 2) ? 'black' : 'green' ?>"
                                        style="<?= (empty($data['status']) || empty($data['nextCheckText']) || $data['status'] != 2) ? 'border: 0.5px solid #30313D;' : 'border: 0.5px solid #2D7F06;' ?>">
                                        <?= Yii::t('app', "Completed") ?>
                                    </div>
                                </div>
                                <div class="font-size-11 align-content-center">
                                    <text id="text-green"
                                        class="text-<?= (empty($data['status']) || empty($data['nextCheckText']) || $data['status'] != 2) ? 'black' : 'green' ?>">
                                        <?= Yii::t('app', "The Component has not been completed") ?>
                                    </text>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-55 d-flex justify-content-end gap-2">
                            <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/individual-kgi-grid" class="btn-create-cancle" style="width: 80px; text-decoration: none; height: 35px;"><?= Yii::t('app', 'Cancel') ?></a>
                            <button type="submit" class="btn-create-update" style="width: 100px; height: 35px;">
                                <img src="<?= Yii::$app->homeUrl ?>image/updatebtn-white.svg" style="width: 16px;">
                                <?= Yii::t('app', 'Edit') ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
// ดึง URL ปัจจุบันมาเก็บไว้ในตัวแปร
$referrer = Yii::$app->request->referrer;
?>
<input type="hidden" value="<?= $url ?>" name="url">
<input type="hidden" id="kgiEmployeeId" name="kgiEmployeeId" value="<?= $kgiEmployeeId ?? '' ?>">
<input type="hidden" id="kgiEmployeeHistoryId" name="kgiEmployeeHistoryId" value="<?= $kgiEmployeeHistoryId ?? '' ?>">

<?php ActiveForm::end(); ?>

<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();

        let isSubmitting = false;
        $("#update-personal-kgi").on("beforeSubmit", function() {
            if (isSubmitting) return false;
            isSubmitting = true;
            return true;
        });
    });

    function kgiUpdateHistory(kgiId) {
        // ฟังก์ชัน AJAX เรียกดูประวัติ (ถ้ามี modal รองรับ)
        console.log("Viewing history for KGI ID: " + kgiId);
        $('#update-history-popup').modal('show');
    }
</script>