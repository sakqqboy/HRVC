<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'update-personal-kgi',
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
    'action' => Yii::$app->homeUrl . 'kgi/kgi-personal/save-update-personal-kgi'

]);
$this->title = "Update Individual KGI";
//throw new Exception(print_r($data, true));
$percentage = isset($data['ratio']) ? round((float)$data['ratio']) : 0;
$result = $data['result'] ?? 0;
$value = isset($data['result']) ? $data['result'] : 0;
$kgiEmployeeHistoryId = isset($data['kgiEmployeeHistoryId']) ? $data['kgiEmployeeHistoryId'] : 0;
$sumvalue = isset($kgi['sumresult']) ? $kgi['sumresult'] : 0;
$targetAmount = $data['target'] ?? 0;
$DueBehind = $targetAmount -  $result;
$detail = !empty($data['kgiDetail']) ? $data['kgiDetail'] : 'No details listed';
$maxLength = 487;
$nextCheckDate = !empty($data['nextCheckText'])
    ? DateTime::createFromFormat('d M Y', $data['nextCheckText'])
    : null;

if (!$nextCheckDate) {
    $daysLeft = Yii::t('app', 'Not set');
} else {
    // หาวันที่ปัจจุบัน
    $currentDate = new DateTime();

    // ตรวจสอบว่า $nextCheckDate เป็น DateTime หรือไม่ ถ้าไม่ใช่ให้พยายามแปลง
    if (!$nextCheckDate instanceof DateTime) {
        $nextCheckDate = DateTime::createFromFormat('Y-m-d', $nextCheckDate);
    }

    // ถ้าแปลงวันที่สำเร็จ ให้คำนวณความแตกต่าง
    if ($nextCheckDate) {
        $interval = $currentDate->diff($nextCheckDate);
        $daysLeft = $interval->format('%r%a'); // %r แสดงเครื่องหมาย (+/-)

        $daysLeft = ($daysLeft < 0) ? "Due Pass" : "$daysLeft " . Yii::t('app', 'days left');
    } else {
        $daysLeft = "Due Pass"; // กรณีแปลงวันที่ไม่สำเร็จ
    }
}
// echo $data['nextCheckText'];
?>

<style>
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
        /* สำหรับ Firefox */
    }

    /* เปลี่ยนสีข้อความของ select เมื่อเลือกแล้ว */
    select.form-select {
        color: var(--Helper-Text-Gray, #8A8A8A);
    }


    /* เมื่อเลือกแล้วให้ข้อความเป็นสี #30313D */
    select.form-select:not([value=""]) {
        color: <?= ($statusform == 'update') ? '#30313D' : 'var(--HRVC---Text-Black, #8A8A8A)';
                ?>;
    }


    /* สไตล์เมื่อไม่ได้เลือก (ข้อความ placeholder) */
    select.form-select {
        color: var(--Helper-Text-Gray, #8A8A8A);
        font-size: 14px;
        font-style: normal;
        font-weight: 500;
        line-height: 20px;
        text-transform: capitalize;
    }

    /* สไตล์เมื่อเลือกตัวเลือกแล้ว */
    select.form-select option:checked {
        color: var(--HRVC---Text-Black, #30313D);
        font-size: 14px;
        font-style: normal;
        font-weight: 500;
        line-height: 20px;
    }

    /* เพิ่มความสวยงามเมื่อตัวเลือกถูกโฟกัส */
    select.form-select:focus {
        color: var(--HRVC---Text-Black, #30313D);
        font-weight: 500;
    }

    /* เมื่อ option เป็น disabled (กรณีเลือกแล้วจะไม่สามารถเลือกได้) */
    select.form-select option:disabled {
        color: var(--Helper-Text-Gray, #8A8A8A);
        font-weight: 500;
    }

    .priority-box {
        width: 52px;
        height: 52px;
        font-size: 12px;
    }

    .priority-box-null {
        width: 52px;
        height: 52px;
        font-size: 12px;
    }

    .text-priority {
        font-size: 18px;
    }

    .priority-star {
        width: 52px;
    }

    .big-star {
        width: 18px;
        height: 17px;
    }

    .default-star {
        width: 16px;
        width: 15px;
    }
</style>

<!-- ลิงก์ไปยัง CSS ของ flatpickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- ลิงก์ไปยัง JS ของ flatpickr -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<div class="col-12 mt-70 pt-20">
    <div class="d-flex justify-content-start pt-0 pb-0" style="line-height: 30px;">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Group23177.svg"
            class="pim-head-icon mr-11 mt-2">
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
                <div class="col-6 align-content-center">
                    <!-- <a href="<?= Yii::$app->request->referrer ? Yii::$app->request->referrer : Yii::$app->homeUrl . 'kgi/management/grid' ?>"
                        class="mr-5 font-size-12" style="text-decoration: none;">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/back.svg">
                        <text class="pim-text-back">
                            <?= Yii::t('app', 'Back') ?>
                        </text>
                    </a> -->
                    <div class="pim-name-title" style="display: flex; align-items: center; gap: 14px;">
                        <a href="<?= isset(Yii::$app->request->referrer) ? Yii::$app->request->referrer : Yii::$app->homeUrl . 'kgi/kgi-personal/individual-kgi-grid' ?>" style="text-decoration: none; width:70px; height:26px;" class="btn-create-branch">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/back-white.svg" style="width:18px; height:18px; margin-top:-3px;">
                            <?= Yii::t('app', 'Back') ?>
                        </a>
                        <?= Yii::t('app', 'Update Individual Key Goal Indicator') ?>
                    </div>
                </div>
                <div class="col-6" style="height: 55px;">
                    <div class="d-flex justify-content-end align-items-center">
                        <div class="current-ratio text-end mr-10 align-self-center ">
                            <?= Yii::t('app', 'Current Achievement Ratio') ?>
                            <div class="current-ratio-data text-end mt-15">
                                <?php
                                if ($DueBehind) {
                                    echo Yii::t('app', 'Due Behind by ') . ' ';
                                } else {
                                    echo Yii::t('app', 'no Data');
                                }
                                ?>
                                <span class="DueBehind <?= $DueBehind == 0 ? 'd-none' : '' ?>">
                                    <?= number_format($DueBehind) ?>
                                </span>
                            </div>
                        </div>
                        <div style="width: 10%;" class="d-flex align-items-center align-self-start">
                            <svg viewBox="0 0 36 36" class="circular-chart-create" xmlns="http://www.w3.org/2000/svg">
                                <path class="circle-bg"
                                    d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                    style="stroke: hsla(217, 100%, 91%, 1); stroke-width: 3;" fill="none" />
                                <?php
                                $percentage = isset($data['ratio']) ? $data['ratio'] : 00;
                                ?>

                                <path class="circle"
                                    d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                    stroke="#4db8ff" stroke-width="3" fill="none"
                                    stroke-dasharray="<?= $percentage ?>, 100" />

                                <!-- Percentage text in the middle -->
                                <text x="18" y="20.35" text-anchor="middle" dominant-baseline="middle"
                                    class="percentage" style="font-size: 8px; font-weight: bold; fill: #333;">
                                    <?= $percentage ?>%
                                </text>
                            </svg>
                        </div>
                        <div style="width: 1px; background-color: #BBCDDE; height: 51px;"
                            class="mr-10 ml-10 d-flex align-items-center border align-self-center"></div>
                        <div class="d-flex align-items-center align-self-center">
                            <img src="<?= Yii::$app->homeUrl ?><?= isset($data['result']) ? 'image/result-blue.svg' : 'images/icons/Settings/reward.svg' ?>"
                                style="width: 40px; height: 40px;">
                            <text class="pim-total-reward">
                                <?= isset($data['result']) ? number_format($data['result'])  : '000' ?>
                            </text>
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
                                    <button type="button" id="see-more" class="see-more">See More</button>
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
                                        <span class="text-priority mt-5">N/A</span>
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
                                    <label style="font-size: 20px; font-weight: 500;"><?= $daysLeft ?></label><br>
                                    <label
                                        style="font-size: 14px; font-weight: 500;"><?= $data['nextCheckText'] ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group start-center mt-55" style="gap: 14px;">
                            <label class="text-manage-create" for="name">
                                <span class="text-danger">* </span>
                                <?= Yii::t('app', 'Month & Year') ?>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top"
                                    title="<?= Yii::t('app', 'Select the specific month and year for which youre entering or viewing data. This helps in maintaining chronological records.') ?>"
                                    alt="Help Icon">
                            </label>
                            <div class="d-flex" style="position: relative;width:100%;">
                                <div class="input-group-text" style="background-color: #C3C3C3;  border:0.5px solid #818181; border-radius: 36px; gap: 4px; z-index: 1; height:38px;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/calendar-gray.svg" alt="LinkedIn" style="width: 16px; height: 16px;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/weld-gray.svg" alt="LinkedIn" style="width: 16px; height: 16px;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/calendar-gray.svg" alt="LinkedIn" style="width: 16px; height: 16px;">
                                </div>
                                <div class="flex-grow-1 pr-5 pl-25 select-form-pim" id="multi-mount-year" name="fromMonthYear" onclick="openDatePicker()">
                                    <div id="multi-month-year-text" class="text-truncate text-center pr-5" style="width:190px;">
                                        <?= Yii::t('app', 'Select the Month & Year') ?>
                                    </div>
                                    <i class="fa fa-angle-down" aria-hidden="true" style="right:15px;position:absolute;"></i>
                                </div>
                                <input type="hidden" id="hiddenMonth" name="month"
                                    value="<?= htmlspecialchars($data['month'] ?? '') ?>" required>
                                <input type="hidden" id="hiddenYear" name="year"
                                    value="<?= htmlspecialchars($data['year'] ?? '') ?>" required>
                            </div>

                            <!-- Popup for Month/Year Selection -->
                            <div id="monthYearPicker" class="mount-year">
                                <select id="monthSelect" class="form-select" onchange="closeDatePicker()" required>
                                    <option value="01"><?= Yii::t('app', 'January') ?></option>
                                    <option value="02"><?= Yii::t('app', 'February') ?></option>
                                    <option value="03"><?= Yii::t('app', 'March') ?></option>
                                    <option value="04"><?= Yii::t('app', 'April') ?></option>
                                    <option value="05"><?= Yii::t('app', 'May') ?></option>
                                    <option value="06"><?= Yii::t('app', 'June') ?></option>
                                    <option value="07"><?= Yii::t('app', 'July') ?></option>
                                    <option value="08"><?= Yii::t('app', 'August') ?></option>
                                    <option value="09"><?= Yii::t('app', 'September') ?></option>
                                    <option value="10"><?= Yii::t('app', 'October') ?></option>
                                    <option value="11"><?= Yii::t('app', 'November') ?></option>
                                    <option value="12"><?= Yii::t('app', 'December') ?></option>
                                </select>
                                <select id="yearSelect" class="form-select" style="margin-top: 10px;"
                                    onchange="closeDatePicker()" required>
                                    <!-- ปีที่ถูกสร้างจะถูกเพิ่มที่นี่ -->
                                </select>
                            </div>
                        </div>
                        <div class="form-group start-center mt-45" style="  gap: 14px;">
                            <label class="text-manage-create" for="name">
                                <span class="text-danger">* </span>
                                <?= Yii::t('app', 'Due Term') ?>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top"
                                    title="<?= Yii::t('app', 'Set the start and end dates for the performance measurement period. This defines the timeframe for achieving the target.') ?>"
                                    alt="Help Icon">
                            </label>
                            <div class="d-flex" style="position: relative;width:100%;border-radius:53px;" id="multi-due-term" onclick="toggleCalendar()">
                                <div class="input-group-text calendar-due" id="calendar-dueterm" style="background-color: #C3C3C3;  border:0.5px solid #818181; border-radius: 36px; gap: 4px; z-index: 1; height:38px;">
                                    <!-- <div class="calendar-due mr-3" id="calendar-dueterm" style="z-index: 1;"> -->
                                    <img src="<?= Yii::$app->homeUrl ?>image/calendar-gray.svg" alt="from" class="calendar-due-image">
                                    <img src="<?= Yii::$app->homeUrl ?>image/weld-gray.svg" alt="-" class="calendar-due-image">
                                    <img src="<?= Yii::$app->homeUrl ?>image/calendar-gray.svg" alt="to" class="calendar-due-image">
                                </div>
                                <div class="flex-grow-1 pr-5 pl-35 select-form-pim" id="due-term-default">
                                    <div id="multi-due-term-text" class="text-truncate text-center pr-5" style="width:210px;" title="Select the Due Term Start & End Date">
                                        <?= Yii::t('app', 'Select the Due Term Start & End Date') ?>
                                    </div>
                                    <i class="fa fa-angle-down" aria-hidden="true" style="right:15px;position:absolute;"></i>
                                </div>
                            </div>
                            <input type="hidden" id="fromDate" name="fromDate"
                                value="<?= isset($data['fromDate']) ? $data['fromDate'] : '' ?>" required>
                            <input type="hidden" id="toDate" name="toDate"
                                value="<?= isset($data['toDate']) ? $data['toDate'] : '' ?>" required>
                            <input type="hidden" id="page" value="pim">
                            <!-- Calendar picker -->
                            <div class="calendar-container" id="calendar-due-term"
                                style="display: none; position: absolute; margin-top: 80px; padding: 10px; border: 1px solid #ddd; border-radius: 10px; background: #fff; width: 650px; gap: 3px; z-index: 2;">
                                <!-- ปฏิทินสำหรับวันที่เริ่มต้น -->
                                <div id="startDatePicker"></div>
                                <!-- ปฏิทินสำหรับวันที่สิ้นสุด -->
                                <div id="endDatePicker"></div>
                            </div>
                        </div>
                        <div class="sub-manage-create mt-5 text-danger invisible" id="due-term-message" style="position:absolute;right:20px;">
                            Select Due Term
                        </div>
                        <div class="form-group start-center mt-45" style="gap: 14px;">
                            <label class="text-manage-create" for="name">
                                <span class="text-danger">* </span>
                                <?= Yii::t('app', 'Target Due Update Date') ?>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top"
                                    title="<?= Yii::t('app', 'Specify the deadline by which the progress must be updated in the system. This ensures regular performance tracking and accountability.') ?>"
                                    alt="Help Icon">
                            </label>
                            <div class="d-flex" style="position: relative;width:100%; border-radius:53px;" id="multi-due-update" onclick="toggleCalendar()">
                                <div class="input-group-text calendar-due" id="calendar-dueterm-update" style="background-color: #C3C3C3;  border:0.5px solid #818181; border-radius: 36px; gap: 4px; z-index: 1; height:38px;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/calendar-gray.svg" alt="from" class="calendar-due-image">
                                    <img src="<?= Yii::$app->homeUrl ?>image/weld-gray.svg" alt="-" class="calendar-due-image">
                                    <img src="<?= Yii::$app->homeUrl ?>image/calendar-gray.svg" alt="to" class="calendar-due-image">
                                </div>
                                <div class="flex-grow-1 pr-5 pl-15 select-form-pim" id="due-update-default">
                                    <div id="multi-due-update-text" class="text-truncate text-center pr-5" style="width:230px;" title="Select The Last Update Update Date">
                                        <?= Yii::t('app', 'Select The Last Update Date') ?>
                                    </div>
                                    <i class="fa fa-angle-down" aria-hidden="true" style="right:15px;position:absolute;"></i>
                                </div>
                            </div>
                            <input type="hidden" id="nextDate" name="nextCheckDate"
                                value="<?= isset($data['nextCheckDate']) ? $data['nextCheckDate'] : '' ?>">
                            <div id="calendar-due-update"
                                style="position: absolute; margin-top: 75px; padding: 10px; border: 1px solid rgb(221, 221, 221); border-radius: 10px; background: rgb(255, 255, 255); width: 100%; z-index: 1; display: none; justify-content: center; align-items: center;">
                                <div id="updateDatePicker" style="display: none;"></div>
                            </div>
                        </div>
                        <span class="sub-manage-create mt-5 text-danger invisible" id="last-update-message" style="position:absolute;right:30px;">
                            <?= Yii::t('app', 'Select The Last Update Date') ?>
                        </span>
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
                            <label class="text-manage-create" for="name">
                                <span class="text-danger">* </span>
                                <?= Yii::t('app', 'Master Target') ?>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top"
                                    title="<?= Yii::t('app', 'Enter the overall target value that needs to be achieved within the specified period.') ?>"
                                    alt="Help Icon">
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"
                                    style="background-color:rgb(255, 255, 255); border-right: none; padding: 20px;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/target-blue.svg" alt="LinkedIn"
                                        style="width: 30px; height: 30px; ">
                                    <span style="font-size: 22px; font-weight: 600; padding-left: 20px; ">
                                        <?= isset($data['code']) ? $data['code'] : '' ?>
                                    </span>
                                </span>
                                <input type="number" class="form-control text-end" name="target" step="any"
                                    placeholder="<?= Yii::t('app', 'Enter Target Amount') ?>"
                                    value="<?= isset($data['target']) ? $data['target'] : '' ?>"
                                    style="border-left: none; border-right: none; font-size: 22px; font-style: normal; padding-right: 3px; font-weight: 600;"
                                    required>
                                <span class="input-group-text"
                                    style="background-color:rgb(255, 255, 255); border-left: none; padding-right: 20px; padding-left: 0px;">
                                    <?php if ($data['amountType'] == '%') { ?>
                                        <span style="font-size: 22px; font-weight: 600;">
                                            %
                                        </span>
                                    <?php } ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group start-center mt-42" style="  gap: 14px;">
                            <label class="text-manage-create between-center" for="name" style="  width: 100%; ">
                                <div style="flex-grow: 1;">
                                    <span class="text-danger">* </span>
                                    <?= Yii::t('app', 'Result') ?>
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                        data-toggle="tooltip" data-placement="top"
                                        title="<?= Yii::t('app', 'Historic update contains the update from the team and indivudials if you wish to use your own values, please toggle on Override to put custom numbers ') ?>"
                                        alt="Help Icon">
                                </div>
                                <div class="updatehistory" style="text-align: right; cursor: pointer;"
                                    data-bs-toggle="modal" data-bs-target="#update-history-popup"
                                    onclick="javascript:kgiUpdateHistory(<?= $data['kgiId'] ?>)">
                                    <img
                                        src="<?= Yii::$app->homeUrl ?>image/refes-blue.svg"> <?= Yii::t('app', 'Update History') ?>
                                </div>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text" id="result-inbox"
                                    style="background-color:rgb(255, 255, 255); border-right: none; padding: 20px;">
                                    <img id="result-icon"
                                        src="<?= Yii::$app->homeUrl ?>image/result-<?= isset($data['result']) ? 'blue' : 'gray' ?>.svg"
                                        alt="LinkedIn" style="width: 30px; height: 30px;">
                                </span>
                                <input type="number" class="form-control text-end" name="result" id="result-update"
                                    value="<?= isset($data['result']) ? $data['result'] : '' ?>"
                                    style="border-left: none; font-size: 22px; font-style: normal; font-weight: 600;"
                                    required step="any" oninput="updateIcon(this)">

                                <input type="hidden" id="auto-result" value="" name="autoUpdate">
                                <input type="hidden" id="previous-result"
                                    value="<?= isset($data['result']) ? $data['result'] : '' ?>">
                            </div>
                        </div>
                        <div class="form-group start-center mt-55" style="gap: 20px;">
                            <label class="text-manage-create between-center" for="name" style="  width: 100%; ">
                                <div style="flex-grow: 1;">
                                    <?= Yii::t('app', 'Status') ?>
                                </div>
                            </label>

                            <div id="textbox-check-progress"
                                class="textbox-check-<?= (empty($data['status']) || empty($data['nextCheckText'])) ? 'hide' : 'blue' ?>">
                                <div class="mid-center">
                                    <?php if ($data['status'] != '2') { ?>
                                        <input type="checkbox" id="check1" name="status" value="1" class="status-checkbox"
                                            <?= (isset($data['status']) && $data['status'] == '1' && !empty($data['nextCheckText'])) ? '    checked' : '' ?>
                                            style="width: 20px; height: 20px;">
                                    <?php } ?>
                                </div>
                                <div class="mid-center">
                                    <div id="border-cicle-progress"
                                        class="border-cicle  bg-white text-<?= (empty($data['status']) || empty($data['nextCheckText'])) ? 'black' : 'blue-sea' ?>"
                                        style="<?= (empty($data['status']) || empty($data['nextCheckText'])) ? 'border: 0.5px solid #30313D;' : 'border: 0.5px solid #2F42ED;' ?>">
                                        <?= Yii::t('app', 'In-Progress') ?>
                                    </div>
                                </div>
                                <div class="font-size-11 align-content-center">
                                    <text id="text-blue"
                                        class="text-<?= (empty($data['status']) || empty($data['nextCheckText'])) ? 'black' : 'blue-sea' ?>">
                                        <?= Yii::t('app', "The task is currently being addressed. Ensure it's marked completed before the due date to avoid it being automatically listed as overdue.") ?>
                                    </text>
                                </div>
                            </div>
                            <div id="textbox-check-completed"
                                class="textbox-check-<?= (empty($data['status']) || $data['status'] != 2) ? 'hide' : 'green' ?>">
                                <div class="mid-center" style="flex-basis: 5%;">
                                    <input type="checkbox" id="check2" name="status" value="2" class="status-checkbox"
                                        <?= (isset($data['status']) && $data['status'] == '2') ? 'checked' : '' ?>
                                        style="width: 20px; height: 20px;">
                                </div>
                                <div class="mid-center">
                                    <div id="border-cicle-completed"
                                        class="border-cicle  bg-white text-<?= (empty($data['status']) || empty($data['nextCheckText']) || $data['status'] != 2) ? 'black' : 'green' ?>"
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
                            <div id="textbox-check-warning"
                                style="<?= (isset($daysLeft) && $daysLeft == 'Due Pass' && empty($data['nextCheckText']))
                                            ? 'border: 0.5px solid var(--Progress-Blue, #30313D);'
                                            : ($daysLeft == 'Due Pass'
                                                ? 'border: 0.5px solid var(--Progress-Blue, #E05757);'
                                                : 'border: 0.5px solid var(--Progress-Blue, #DD7A01);') ?> font-size: 14px; font-weight: 600;"
                                class="textbox-check-<?= (isset($daysLeft) && $daysLeft == 'Due Pass' && empty($data['nextCheckText']))
                                                            ? 'hide'
                                                            : ($daysLeft == 'Due Pass'
                                                                ? 'red'
                                                                : 'orang') ?>">
                                <div class="mid-center" style="flex-basis: 5%;  ">
                                    <img src="<?= Yii::$app->homeUrl ?>image/warning-<?= (isset($daysLeft) && $daysLeft == 'Due Pass' && empty($data['nextCheckText']))
                                                                                            ? 'black'
                                                                                            : ($daysLeft == 'Due Pass'
                                                                                                ? 'red'
                                                                                                : 'orang') ?>.svg"
                                        alt="LinkedIn" style="width: 20px; height: 20px;">
                                </div>
                                <div class="mid-center" style="flex-basis: 25%;">
                                    <div class="border-cicle bg-white text-<?= (isset($daysLeft) && $daysLeft == 'Due Pass' && empty($data['nextCheckText']))
                                                                                ? 'black'
                                                                                : ($daysLeft == 'Due Pass'
                                                                                    ? 'red'
                                                                                    : 'orang') ?>" style="<?= (isset($daysLeft) && $daysLeft == 'Due Pass' && empty($data['nextCheckText']))
                                                                                                                ? 'border: 0.5px solid var(--Progress-Blue, #30313D);'
                                                                                                                : ($daysLeft == 'Due Pass'
                                                                                                                    ? 'border: 0.5px solid var(--Progress-Blue, #E05757);'
                                                                                                                    : 'border: 0.5px solid var(--Progress-Blue, #DD7A01);') ?>"
                                        for="check3">

                                        <?= Yii::t('app', "Due Passed") ?>
                                    </div>
                                </div>
                                <div class="font-size-11 align-content-center">
                                    <text class="text-<?= (isset($daysLeft) && $daysLeft == 'Due Pass' && empty($data['nextCheckText']))
                                                            ? 'black'
                                                            : ($daysLeft == 'Due Pass'
                                                                ? 'red'
                                                                : 'orang') ?>" <div class="border-cicle bg-white text-<?= (isset($daysLeft) && $daysLeft == 'Due Pass' && empty($data['nextCheckText']))
                                                                                                                            ? 'black'
                                                                                                                            : ($daysLeft == 'Due Pass'
                                                                                                                                ? 'red'
                                                                                                                                : 'orang') ?>">
                                        <?= (isset($daysLeft) && $daysLeft == 'Due Pass') ?
                                            Yii::t('app', "The component was overdue and revert back to completed") :
                                            Yii::t('app', "This task component be automatically become due passed within 30 Days, if you
                                        don’t mark it as completed") ?>
                                    </text>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-30"
                            style="display: flex; align-items: flex-end; justify-content: flex-end; gap: 7px; width: 100%;">
                            <div style="display: flex;
                                min-width: 90px;
                                height: 35px;
                                flex-direction: column;
                                align-items: flex-end;
                                justify-content: center;
                                ">
                                <label class="name-last-update">
                                    <?= Yii::t('app', 'Last Updated on') ?>
                                </label>
                                <text class="create-last-update">
                                    <?= isset($kgi['lastUpdate']) ? $kgi['lastUpdate'] : '' ?>
                                </text>
                            </div>
                            <div>
                                <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/kgi-employee-history/<?= ModelMaster::encodeParams(['kgiId' => $data['kgiId'], 'kgiEmployeeHistoryId' => $kgiEmployeeHistoryId, 'kgiEmployeeId' => $kgiEmployeeId]) ?>"
                                    class=" btn-create-cancle"
                                    style="width: 70px;text-decoration: none;height: 35px;font-size:14px !important;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/eye-login.svg" alt="LinkedIn"
                                        style="width: 16px; height: 16px;">
                                    <?= Yii::t('app', 'View') ?>
                                </a>
                            </div>

                            <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/individual-kgi-grid"
                                class="btn-create-cancle"
                                style="width: 70px;text-decoration: none;height: 35px;font-size:14px !important;">
                                <?= Yii::t('app', 'Cancel') ?>
                            </a>
                            <button type="submit" class="btn-create-update"
                                style="width: 80px;height: 35px;font-size:14px !important;">
                                <img src="<?= Yii::$app->homeUrl ?>image/updatebtn-white.svg" alt="LinkedIn"
                                    style="width: 16px; height: 16px;">
                                <?= Yii::t('app', 'Update') ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="<?= isset($url) ? $url : '' ?>" name="url">
<input type="hidden" value="update" id="acType">
<input type="hidden" value="kgi-employee" id="pimType">
<input type="hidden" id="kgiEmployeeId" name="kgiEmployeeId" value="<?= isset($kgiEmployeeId) ? $kgiEmployeeId : '' ?>"
    required>

<?php ActiveForm::end(); ?>
<?= $this->render('modal_history') ?>
<?= $this->render('modal_warning') ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var acType = document.getElementById('acType').value
        let isSubmitting = false; // ป้องกัน submit ซ้ำ
        $("#update-personal-kgi").on("beforeSubmit", function(event) {
            if (isSubmitting) {
                return false; // ถ้ากำลัง submit อยู่ ไม่ให้ทำซ้ำ
            }
            isSubmitting = true;
            // alert(acType);
            if (!validateFormKgiEmployee(acType)) {
                isSubmitting = false; // ถ้า validation ไม่ผ่าน ให้เปิด submit ใหม่
                return false;
            }
            return true; // ถ้า validation ผ่าน ให้ submit ฟอร์มต่อไป
        });
        $('[data-toggle="tooltip"]').tooltip(); // เปิดใช้งาน Tooltip
    });
    const seeMoreBtn = document.getElementById("see-more");
    const aboutText = document.getElementById("about-text");

    <?php if (mb_strlen($detail) > 487): ?>
        const fullText = `<?= addslashes($detail) ?>`;
        const shortText = `<?= addslashes(mb_substr($detail, 0, 487)) ?>...`;

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
</script>