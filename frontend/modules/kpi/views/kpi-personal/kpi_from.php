<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$form = ActiveForm::begin([
	'id' => 'update-personal-kpi',
	'method' => 'post',
	'options' => [
		'enctype' => 'multipart/form-data',
	],
	'action' => Yii::$app->homeUrl . 'kpi/kpi-personal/save-update-personal-kpi'

]);

$percentage = isset($data['ratio']) ? $data['ratio'] : 00;
$result = $data['result'] ?? 0;
$value = isset($data['result']) ? $data['result'] : 0;
$kpiEmployeeHistoryId = isset($data['kpiEmployeeHistoryId']) ? $data['kpiEmployeeHistoryId'] : 0;
$sumvalue = isset($kpi['sumresult']) ? $kpi['sumresult'] : 0;
$targetAmount = $data['targetAmount'] ?? 0;
// $kpiHistoryId = $kpi['kpiHistoryId'] ?? 0;
$DueBehind = $targetAmount -  $result;
$detail = !empty($data['kpiDetail']) ? $data['kpiDetail'] : 'No details listed';
// $detail ="The goal is to increase the number of Non-Japanese clients to diversify the client base and drive sustained business growth. By targeting international markets and industries, the aim is to capture a broader market share and reduce dependency on a The goal is to increase the number of Non-Japanese clients to diversify the client base and drive sustained business growth. By targeting international markets and industries, the aim is to capture a broader market share and reduce dependency on a ";
$maxLength = 487;


// ตรวจสอบว่า $data['nextCheckText'] มีค่าและสามารถแปลงเป็น DateTime ได้
$nextCheckDate = !empty($data['nextCheckText']) 
    ? DateTime::createFromFormat('d M Y', $data['nextCheckText']) 
    : null;

if ($nextCheckDate === false) {
    // ถ้าไม่สามารถแปลงได้ ให้กำหนดค่าเป็น "Due Pass"
    $nextCheckDate = 'Due Pass';
}

// ถ้าค่า $nextCheckDate เป็น "Due Pass" ให้ไม่คำนวณวันที่เหลือ
if ($nextCheckDate !== 'Due Pass') {
    // หาวันที่ปัจจุบัน
    $currentDate = new DateTime();

    // คำนวณความแตกต่างระหว่างวันที่ปัจจุบันและวันที่ที่กำหนด
    if ($nextCheckDate instanceof DateTime) {
        $interval = $currentDate->diff($nextCheckDate);

        // แสดงจำนวนวันที่เหลือ
        $daysLeft = $interval->format('%r%a'); // %r คือการแสดงเครื่องหมายบวกหรือลบ
        if ($daysLeft < 0) {
            $daysLeft = "Due Pass"; // ถ้าผลลัพธ์เป็นลบ แสดงว่าเกินกำหนด
        } else {
            $daysLeft = "$daysLeft " . Yii::t('app', 'days left');
        }
    } else {
        $daysLeft = "Due Pass"; // ถ้าไม่สามารถแปลงวันที่ได้
    }
} else {
    $daysLeft = "Due Pass"; // หากไม่สามารถแปลงวันที่ได้
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
    color: <?=($statusform=='update') ? '#30313D': 'var(--HRVC---Text-Black, #8A8A8A)';
    ?>;
}


/* สไตล์เมื่อไม่ได้เลือก (ข้อความ placeholder) */
select.form-select {
    color: var(--Helper-Text-Gray, #8A8A8A);
    font-family: "SF Pro Display", sans-serif;
    font-size: 14px;
    font-style: normal;
    font-weight: 500;
    line-height: 20px;
    text-transform: capitalize;
}

/* สไตล์เมื่อเลือกตัวเลือกแล้ว */
select.form-select option:checked {
    color: var(--HRVC---Text-Black, #30313D);
    font-family: "SF Pro Display";
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
</style>

<!-- ลิงก์ไปยัง CSS ของ flatpickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- ลิงก์ไปยัง JS ของ flatpickr -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<div class="contrainer-body">
    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.svg" class="home-icon mr-5"
            style="margin-top: -3px;">
        <strong class="pim-head-text"> <?= Yii::t('app', 'Performance Indicator Matrices (PIM)') ?></strong>
    </div>
    <div class="col-12 mt-29">
        <?= $this->render('header_filter', [
            "role" => $role
        ]) ?>

        <div class="alert mt-28 pim-body bg-white">
            <div class="between-center" style=" ">
                <div class="col-8">
                    <a href="<?= Yii::$app->request->referrer ? Yii::$app->request->referrer : Yii::$app->homeUrl . 'kpi/management/grid' ?>"
                        class="mr-5 font-size-12">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/back.svg">
                        <text class="pim-text-back">
                            <?= Yii::t('app', 'Back') ?>
                        </text>
                    </a>
                    <text class="pim-name-title">
                        <?= Yii::t('app', 'Update Key Performance Indicator') ?>
                    </text>
                </div>
                <div class="col-4 " style="display: flex; justify-content: center; align-items: center; gap: 20px;">
                    <div style="display: flex; gap: 14px; flex-direction: column;">
                        <text class="current-ratio text-end">
                            <?= Yii::t('app', 'Current Achievement Ratio') ?>
                        </text>
                        <text class="current-ratio-data text-end">
                            <?= Yii::t('app', 'Due Behind by') ?>
                            <span class="DueBehind">
                                <?=$DueBehind?>
                            </span>
                        </text>
                    </div>
                    <div style="width: 10%;">
                        <svg viewBox="0 0 36 36" class="circular-chart-create" xmlns="http://www.w3.org/2000/svg">
                            <!-- Background circle -->
                            <path class="circle-bg"
                                d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                style="stroke: hsla(217, 100%, 91%, 1); stroke-width: 3;" fill="none" />

                            <path class="circle"
                                d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                stroke="#4db8ff" stroke-width="3" fill="none" stroke-dasharray="0, 100" />

                            <!-- Percentage text in the middle -->
                            <text x="18" y="20.35" text-anchor="middle" dominant-baseline="middle" class="percentage"
                                style="font-size: 8px; font-weight: bold; fill: #333;">
                                <?=$percentage?>%
                            </text>
                        </svg>

                    </div>
                    <div style="width: 1px; background-color: #BBCDDE; height: 51px;"></div>
                    <div style="display: flex; align-items: center; gap: 22px;">
                        <img src="<?= Yii::$app->homeUrl ?><?= isset($data['result']) ? 'image/result-blue.svg' : 'images/icons/Settings/reward.svg'?>"
                            style="width: 40px; height: 40px;">
                        <text class="pim-total-reward">
                            <?= isset($data['result']) ? $data['result'] : '000' ?>
                        </text>
                    </div>
                </div>
            </div>

            <div class="contrainer-body-detail">
                <div class="between-column" style="flex: 1;">
                    <div class="form-group start-center" style="  gap: 14px;">
                        <label class="text-black" for="name" style="font-size: 22px; font-weight: 600;">
                            <?= isset($data['kpiName']) ? $data['kpiName'] : '' ?>
                        </label>
                    </div>

                    <div class="form-group start-center mt-25" style="gap: 14px;">
                        <label class="text-gray" for="name" style="font-size: 14px; font-weight: 400;">
                            <?= Yii::t('app', 'KPI Details') ?>
                        </label>
                        <p id="about-text" style="font-size: 14px; font-weight: 400; height: 147px;">
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
                    </div>

                    <div class="form-group start-center mt-38" style="  gap: 14px;">
                        <label class="text-gray" for="name" style="font-size: 14px; font-weight: 400;">
                            <?= Yii::t('app', 'Assigned Companies') ?>
                        </label>
                        <div class="circle-container" data-type="branch" style="display: flex;
                                    align-items: center;
                                    gap: 5px;
                                    ">
                            <img src="<?= Yii::$app->homeUrl ?><?= $company['companyImg'] ?>" class="pim-pic-gridNew"
                                style="width: 43px; height: 43px;" alt="icon">
                            <!-- <div class="cycle-current-white" style="color: #000; right: 15px;"
                                id="branch-selected-count">
                                00
                            </div> -->
                            <text class="text-black" style="font-size: 18px; font-weight: 500;">
                                <?= Yii::t('app', 'Assigned on') ?>
                                <?= is_array($company['companyId']) ? '' : 1 ?>
                                <?= Yii::t('app', 'Company') ?>
                            </text>
                        </div>
                    </div>
                    <div class="form-group start-center mt-28" style="gap: 14px;">
                        <label class="text-gray" for="name" style="font-size: 14px; font-weight: 400;">
                            <?= Yii::t('app', 'Assigned Branches') ?>
                        </label>
                        <div class="circle-container pl-15" style="display: flex;
                                    align-items: center;
                                    gap: 5px;
                                    padding-left: 15px;">
                            <?php  if(count($kpiBranch) >= 1 ){ ?>
                            <div class="cycle-current" style="width: 43px; height: 43px;">
                                <img src="<?= Yii::$app->homeUrl ?>image/branches.svg" alt="icon">
                            </div>
                            <?php }
                            if(count($kpiBranch) >= 2 ){ ?>
                            <div class="cycle-current" style="width: 43px; height: 43px;">
                                <img src="<?= Yii::$app->homeUrl ?>image/branches.svg" alt="icon">
                            </div>
                            <?php }
                            if(count($kpiBranch) >= 3 ){ ?>
                            <div class="cycle-current" style="width: 43px; height: 43px;">
                                <img src="<?= Yii::$app->homeUrl ?>image/branches.svg" alt="icon">
                            </div>
                            <?php } ?>
                            <div class="cycle-current-white"
                                style="width: 43px; height: 43px; color: #000; right: 15px;">
                                <?= count($kpiBranch) ?>
                            </div>
                            <text class="text-black" style="font-size: 18px; font-weight: 500;">
                                <?= Yii::t('app', 'Assigned on') ?>
                                <?= count($kpiBranch) ?>
                                <?= Yii::t('app', 'Branches') ?>
                            </text>
                        </div>
                    </div>
                    <div class="form-group start-center mt-28" style="gap: 14px;">
                        <label class="text-gray" for="name" style="font-size: 14px; font-weight: 400;">
                            <?= Yii::t('app', 'Assigned Department/s') ?>
                        </label>
                        <div class="circle-container pl-15" style="display: flex;
                                    align-items: center;
                                    gap: 5px;
                                    padding-left: 15px;">
                            <?php  if(count($kpiDepartment) >= 1 ){ ?>
                            <div class="cycle-current" style="width: 43px; height: 43px;">
                                <img src="<?= Yii::$app->homeUrl ?>image/departments.svg" alt="icon">
                            </div>
                            <?php }
                            if(count($kpiDepartment) >= 2 ){ ?>
                            <div class="cycle-current" style="width: 43px; height: 43px;">
                                <img src="<?= Yii::$app->homeUrl ?>image/departments.svg" alt="icon">
                            </div>
                            <?php }
                            if(count($kpiDepartment) >= 3 ){ ?>
                            <div class="cycle-current" style="width: 43px; height: 43px;">
                                <img src="<?= Yii::$app->homeUrl ?>image/departments.svg" alt="icon">
                            </div>
                            <?php } ?>
                            <div class="cycle-current-white"
                                style="width: 43px; height: 43px; color: #000; right: 15px;">
                                <?= count($kpiDepartment) ?>
                            </div>
                            <text class="text-black" style="font-size: 18px; font-weight: 500;">
                                <?= Yii::t('app', 'Assigned on') ?>
                                <?= count($kpiDepartment) ?>
                                <?= Yii::t('app', 'Departments') ?>
                            </text>
                        </div>
                    </div>
                    <div class="form-group mt-41 d-flex flex-column align-items-center gap-3">
                        <div class="row w-100 align-items-center justify-content-start">
                            <!-- Left Column: Quant Ratio -->
                            <div class="col-3  text-start" style=" border-right: #9ABCE9 solid thin">
                                <div class="text-gray pt-2" style="font-size: 14px; font-weight: 400;">
                                    <?= Yii::t('app', 'Quant Ratio') ?>
                                </div>
                                <div class="pim-duedate mt-2" style="font-size: 18px; font-weight: 600; ">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $kpi["quantRatio"] == 1 ? 'quantity' : 'diamon' ?>.svg"
                                        class="pim-iconKFI"
                                        style="margin-top: -1px; margin-left: 3px; width: 18px; height: 18px;">
                                    <?= $kpi["quantRatio"] == 1 ? Yii::t('app', 'Quantity') : Yii::t('app', 'Quality') ?>
                                </div>
                            </div>

                            <!-- Right Column: Update Interval -->
                            <div class="col-9 text-start" style=" padding-left: 32px; ">
                                <div class="text-gray pt-2" style="font-size: 14px; font-weight: 400;">
                                    <?= Yii::t('app', 'Update Interval') ?>
                                </div>
                                <div class="pim-duedate mt-2" style="font-size: 18px; font-weight: 600;">
                                    <img src="/HRVC/frontend/web/images/icons/Settings/monthly.svg" class="pim-iconKFI"
                                        style="margin-top: -3px;  width: 18px; height: 18px;">
                                    <?= Yii::t('app', is_array($unit) ? $unit['unitName'] : $unit) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="between-column" style="flex: 1;">
                    <div class="form-group mt-66 d-flex flex-column align-items-start gap-3">
                        <!-- </br> -->
                        <div class="row w-100">
                            <div class="col-3 d-flex flex-column align-items-start justify-content-center "
                                style=" border-right: #9ABCE9 solid thin">
                                <!-- <div class="text-center priority-star">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star ms-3" aria-hidden="true"></i>
                                </div> -->
                                <div class="col-12 text-center priority-star">
                                    <?php
                                                    if ($kpi["priority"] == "A" || $kpi["priority"] == "B") {
                                                    ?>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <?php
                                                    }
                                                    if ($kpi["priority"] == "A" || $kpi["priority"] == "C") {
                                                    ?>
                                    <i class="fa fa-star big-star" aria-hidden="true"></i>
                                    <?php
                                                    }
                                                    if ($kpi["priority"] == "B") {
                                                    ?>
                                    <i class="fa fa-star ml-10" aria-hidden="true"></i>
                                    <?php
                                                    }
                                                    if ($kpi["priority"] == "A") {
                                                    ?>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <?php
                                                    }
                                                    ?>
                                </div>
                                <div class="text-center priority-box" style="width: 52.059px; height: 52.059px;">
                                    <div style="font-size: 14px; font-weight: 400;"><?= Yii::t('app', 'Priority') ?>
                                    </div>
                                    <div class="text-priority" style="font-size: 24px; font-weight: 600; bottom: 6px;">
                                        <?= $kpi["priority"] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-9 d-flex flex-column justify-content-center gap-3 pl-32">
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
                        <!-- </br> -->
                    </div>

                    <div class="form-group start-center mt-32" style="  gap: 14px;">
                        <label class="text-manage-create" for="name">
                            <span class="text-danger">* </span>
                            <?= Yii::t('app', 'Month & Year') ?>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                data-placement="top"
                                title="<?= Yii::t('app', 'Select the specific month and year for which youre entering or viewing data. This helps in maintaining chronological records.') ?>"
                                alt="Help Icon">
                        </label>
                        <div class="input-group" style="position: relative;">
                            <span class="input-group-text pb-10 pt-10"
                                style="background-color: #C3C3C3;  border:0.5px solid #818181; border-radius: 36px; gap: 4px; z-index: 1;">
                                <img src="<?= Yii::$app->homeUrl ?>image/calendar-gray.svg" alt="LinkedIn"
                                    style="width: 16px; height: 16px;">
                                <img src="<?= Yii::$app->homeUrl ?>image/weld-gray.svg" alt="LinkedIn"
                                    style="width: 16px; height: 16px;">
                                <img src="<?= Yii::$app->homeUrl ?>image/calendar-gray.svg" alt="LinkedIn"
                                    style="width: 16px; height: 16px;">
                            </span>
                            <div class="form-control" id="multi-mount-year" name="fromMonthYear"
                                style="border-radius: 53px 53px 53px 53px; text-align: center; cursor: pointer; position: absolute; width: 100% ; height: 100%;"
                                onclick="openDatePicker()">
                                Select the Month & Year <i class="fa fa-angle-down pull-right mt-5"
                                    aria-hidden="true"></i>
                            </div>
                            <!-- hidden inputs เพื่อเก็บค่า month และ year -->
                            <input type="hidden" id="hiddenMonth" name="month"
                                value="<?= htmlspecialchars($data['month'] ?? '') ?>" required>
                            <input type="hidden" id="hiddenYear" name="year"
                                value="<?= htmlspecialchars($data['year'] ?? '') ?>" required>
                        </div>

                        <!-- Popup for Month/Year Selection -->
                        <div id="monthYearPicker" class="mount-year">
                            <select id="monthSelect" class="form-select" onchange="closeDatePicker()" required>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                            <select id="yearSelect" class="form-select" style="margin-top: 10px;"
                                onchange="closeDatePicker()" required>
                                <!-- ปีที่ถูกสร้างจะถูกเพิ่มที่นี่ -->
                            </select>
                        </div>
                    </div>

                    <div class="form-group start-center mt-32" style="  gap: 14px;">
                        <label class="text-manage-create" for="name">
                            <span class="text-danger">* </span>
                            <?= Yii::t('app', 'Due Term') ?>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                data-placement="top"
                                title="<?= Yii::t('app', 'Set the start and end dates for the performance measurement period. This defines the timeframe for achieving the target.') ?>"
                                alt="Help Icon">
                        </label>
                        <div class="input-group" id="img-due-term" style="position: relative;">
                            <span class="input-group-text pb-10 pt-10"
                                style="background-color: #C3C3C3; border:0.5px solid #818181; border-radius: 36px; gap: 4px; z-index: 1;">
                                <img src="<?= Yii::$app->homeUrl ?>image/calendar-gray.svg" alt="Calendar"
                                    style="width: 16px; height: 16px;">
                                <img src="<?= Yii::$app->homeUrl ?>image/weld-gray.svg" alt="Weld"
                                    style="width: 16px; height: 16px;">
                                <img src="<?= Yii::$app->homeUrl ?>image/calendar-gray.svg" alt="Calendar"
                                    style="width: 16px; height: 16px;">
                            </span>
                            <div class="form-control" id="multi-due-term"
                                style="border-radius: 53px; text-align: center; cursor: pointer; position: absolute; width: 100%; height: 100%;"
                                onclick="toggleCalendar()">
                                Select the Due Term Start & End Date <i class="fa fa-angle-down pull-right mt-5"
                                    aria-hidden="true"></i>
                            </div>
                        </div>
                        <!-- hidden inputs เพื่อเก็บค่า month และ year -->
                        <input type="hidden" id="fromDate" name="fromDate"
                            value="<?= isset($data['fromDate']) ? $data['fromDate'] : '' ?>" required>
                        <input type="hidden" id="toDate" name="toDate"
                            value="<?= isset($data['toDate']) ? $data['toDate'] : '' ?>" required>

                        <!-- Calendar picker -->
                        <div class="calendar-container" id="calendar-due-term"
                            style="display: none; position: absolute; margin-top: 80px; padding: 10px; border: 1px solid #ddd; border-radius: 10px; background: #fff; width: 650px; gap: 3px; z-index: 1;">
                            <!-- ปฏิทินสำหรับวันที่เริ่มต้น -->
                            <div id="startDatePicker"></div>
                            <!-- ปฏิทินสำหรับวันที่สิ้นสุด -->
                            <div id="endDatePicker"></div>
                        </div>
                    </div>

                    <div class="form-group start-center mt-32" style="  gap: 14px;">
                        <label class="text-manage-create" for="name">
                            <span class="text-danger">* </span>
                            <?= Yii::t('app', 'Target Due Update Date') ?>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                data-placement="top"
                                title="<?= Yii::t('app', 'Specify the deadline by which the progress must be updated in the system. This ensures regular performance tracking and accountability.') ?>"
                                alt="Help Icon">
                        </label>
                        <div class="input-group" style="position: relative;" id="img-due-update">
                            <span class="input-group-text pb-10 pt-10"
                                style="background-color: #C3C3C3    ;  border:0.5px solid #818181; border-radius: 36px; gap: 4px; z-index: 1;">
                                <img src="<?= Yii::$app->homeUrl ?>image/calendar-gray.svg" alt="LinkedIn"
                                    style="width: 16px; height: 16px;">
                                <img src="<?= Yii::$app->homeUrl ?>image/weld-gray.svg" alt="LinkedIn"
                                    style="width: 16px; height: 16px;">
                                <img src="<?= Yii::$app->homeUrl ?>image/calendar-gray.svg" alt="LinkedIn"
                                    style="width: 16px; height: 16px;">
                            </span>
                            <div class="form-control" id="multi-due-update"
                                style="border-radius: 53px 53px 53px 53px; text-align: center; cursor: pointer; position: absolute ; width: 100%; height: 100%;">
                                Select the Last Update Date <i class="fa fa-angle-down pull-right mt-5"
                                    aria-hidden="true"></i>
                            </div>
                            <input type="hidden" id="nextDate" name="nextCheckDate"
                                value="<?= isset($data['nextCheckDate']) ? $data['nextCheckDate'] : '' ?>">
                        </div>
                        <div id="calendar-due-update"
                            style="position: absolute; margin-top: 75px; padding: 10px; border: 1px solid rgb(221, 221, 221); border-radius: 10px; background: rgb(255, 255, 255); width: 100%; z-index: 1; display: none; justify-content: center; align-items: center;">
                            <div id="updateDatePicker" style="display: none;"></div>
                        </div>
                    </div>

                    <div class="form-group start-center mt-32" style="  gap: 14px;">
                        <label class="text-gray" for="name" style="font-size: 14px; font-weight: 400;">
                            <?= Yii::t('app', 'Assigned Team/s') ?>
                        </label>
                        <div class="circle-container pl-15" data-type="branch" style="display: flex;
                                    align-items: center;
                                    gap: 5px;
                                    padding-left: 15px;">
                            <?php  if(count($kpiTeam) >= 1 ){ ?>
                            <div class="cycle-current" style="width: 43px; height: 43px;">
                                <img src="<?= Yii::$app->homeUrl ?>image/teams.svg" alt="icon">
                            </div>
                            <?php }
                            if(count($kpiTeam) >= 2 ){ ?>
                            <div class="cycle-current" style="width: 43px; height: 43px;">
                                <img src="<?= Yii::$app->homeUrl ?>image/teams.svg" alt="icon">
                            </div>
                            <?php }
                            if(count($kpiTeam) >= 3 ){ ?>
                            <div class="cycle-current" style="width: 43px; height: 43px;">
                                <img src="<?= Yii::$app->homeUrl ?>image/teams.svg" alt="icon">
                            </div>
                            <?php } ?>
                            <div class="cycle-current-white"
                                style="width: 43px; height: 43px; color: #000; right: 15px;">
                                <?= count($kpiTeam) ?>
                            </div>
                            <text class="text-black" style="font-size: 18px; font-weight: 500;">
                                <?= Yii::t('app', 'Assigned on Our Team &') ?>
                                <?= count($kpiTeam) ?>
                                <?= Yii::t('app', 'Others') ?>
                            </text>
                        </div>
                    </div>
                    <!-- <div class="form-group start-center mt-32" style="  gap: 14px;">
                        <label class="text-gray" for="name" style="font-size: 14px; font-weight: 400;">
                            <?= Yii::t('app', 'Assigned Employees') ?>
                        </label>
                        <div class="row">
                            <div class="col-4">
                                <div class="row pim-picgroup">
                                    <div class="col-2">
                                        <div class="pim-pic-yenlowKFI">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg"
                                                alt="person icon">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="pim-pic-yenlowKFI">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg"
                                                alt="person icon">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="pim-pic-yenlowKFI">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg"
                                                alt="person icon">
                                        </div>
                                    </div>
                                    <div class="col-4 number-tag load-yenlow pr-0 pl-0 pim-pic-gridKFINum ">
                                        <?= count($data['kpiEmployee']) ?> </div>
                                </div>
                            </div>
                            <div class="col-8 yenlow-assignKFI">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/assign-yenlow.svg">
                                <a href="<?= Yii::$app->homeUrl ?>kpi/assign/assign/<?= ModelMaster::encodeParams(['kpiId' => $data["kpiId"], "companyId" => $company["companyId"]]) ?>"
                                    class="font-black">
                                    Assign Person </a>
                            </div>
                        </div>
                    </div> -->
                    <div class="form-group start-center mt-32" style="  gap: 14px;">
                        <label class="text-gray" for="name" style="font-size: 14px; font-weight: 400;">
                            <?= Yii::t('app', 'Assigned Employee/s') ?>
                        </label>
                        <div class="circle-container pl-15" data-type="branch" style="display: flex;
                                    align-items: center;
                                    gap: 5px;
                                    padding-left: 15px;">
                            <?php  if(count($data['kpiEmployee']) >= 1 ){ ?>
                            <div class="cycle-current" style="width: 43px; height: 43px;">
                                <img src="<?= Yii::$app->homeUrl ?>image/employees.svg" alt="icon">
                            </div>
                            <?php }
                            if(count($data['kpiEmployee']) >= 2 ){ ?>
                            <div class="cycle-current" style="width: 43px; height: 43px;">
                                <img src="<?= Yii::$app->homeUrl ?>image/employees.svg" alt="icon">
                            </div>
                            <?php }
                            if(count($data['kpiEmployee']) >= 3 ){ ?>
                            <div class="cycle-current" style="width: 43px; height: 43px;">
                                <img src="<?= Yii::$app->homeUrl ?>image/employees.svg" alt="icon">
                            </div>
                            <?php } ?>
                            <div class="cycle-current-white"
                                style="width: 43px; height: 43px; color: #000; right: 15px;">
                                <?= count($data['kpiEmployee']) ?>
                            </div>
                            <text class="text-black" style="font-size: 18px; font-weight: 500;">
                                <?= Yii::t('app', 'Assigned on Our Me &') ?>
                                <?= count($data['kpiEmployee']) ?>
                                <?= Yii::t('app', 'Others') ?>
                            </text>
                        </div>
                    </div>

                </div>
                <div style="flex: 1;">
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
                                <img src="/HRVC/frontend/web/image/target-blue.svg" alt="LinkedIn"
                                    style="width: 30px; height: 30px; ">
                                <span style="font-size: 22px; font-weight: 600; padding-left: 20px; ">
                                    <?= isset($data['code']) ? $data['code'] : '' ?>
                                </span>
                            </span>
                            <input type="number" class="form-control text-end" name="amount" step="any"
                                placeholder="Enter Target Amount"
                                value="<?= isset($data['targetAmount']) ? $data['targetAmount'] : '' ?>"
                                style="border-left: none; border-right: none; font-size: 22px; font-style: normal; padding-right: 3px; font-weight: 600;"
                                required>
                            <span class="input-group-text"
                                style="background-color:rgb(255, 255, 255); border-left: none; padding-right: 20px; padding-left: 0px;">
                                <?php if($data['amountType'] == '%') {?>
                                <span style="font-size: 22px; font-weight: 600;">
                                    %
                                </span>
                                <?php }?>
                            </span>
                        </div>
                    </div>

                    <div class="form-group start-center mt-42" style="  gap: 14px;">
                        <label class="text-manage-create between-center" for="name" style="  width: 100%; ">
                            <div style="flex-grow: 1;">
                                <span class="text-danger">* </span>
                                <?= Yii::t('app', 'Result') ?>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top"
                                    title="<?= Yii::t('app', 'Historic update contains the update from the team and indivudials if you wish to use your own values, please toggle on Override to put custom numbers ') ?>"
                                    alt="Help Icon">
                            </div>
                            <div href="javascript:void(0);" class="updatehistory" style="text-align: right;"
                                cursor="pointer" data-bs-toggle="modal" data-bs-target="#update-history-popup"
                                onclick="modalHistory(<?= isset($data['kpiId']) ? $data['kpiId'] : '' ?>);">
                                <img
                                    src="<?= Yii::$app->homeUrl ?>image/refes-blue.svg"><?= Yii::t('app', 'Update History') ?>
                            </div>
                        </label>

                        <div class="input-group">
                            <span class="input-group-text" id="result-inbox"
                                style="background-color:rgb(255, 255, 255); border-right: none; padding: 20px;">
                                <img id="result-icon"
                                    src="<?= Yii::$app->homeUrl ?>image/result-<?= isset($data['result']) ? 'blue' : 'gray' ?>.svg"
                                    alt="LinkedIn" style="width: 30px; height: 30px;">
                            </span>
                            <input type="number" class="form-control text-end" name="resultValue" id="result-update"
                                value="<?= isset($data['result']) ? $data['result'] : '' ?>"
                                style="border-left: none; font-size: 22px; font-style: normal; font-weight: 600;"
                                required oninput="updateIcon(this),updateResultValue(this)">
                            <input type="hidden" name="result" id="result-cheng"
                                value="<?= isset($data['result']) ? $data['result'] : '' ?>">
                        </div>


                        <div class="between-center" style="  width: 100%; ">
                            <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                                <!-- <label class="switch">
                                    <input type="checkbox" id="historic-checkbox">
                                    <span class="slider round"></span>
                                </label>
                                <label class="sub-manage-create" id="historic-switch">
                                    <?= Yii::t('app', 'Historic Update') ?>
                                </label> -->
                            </div>
                            <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                                <!-- <label class="switch">
                                    <input type="checkbox" id="override-checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                                <label class="sub-manage-create" id="override-switch">
                                    <?= Yii::t('app', 'Override') ?>
                                </label> -->
                            </div>
                        </div>
                    </div>

                    <div class="form-group start-center mt-42" style="gap: 14px;">
                        <label class="text-manage-create between-center" for="name" style="  width: 100%; ">
                            <div style="flex-grow: 1;">
                                <?= Yii::t('app', 'Status') ?>
                            </div>
                        </label>
                        <div class="start-center" style="  gap: 12px; align-self: stretch;">
                            <div id="textbox-check-progress"
                                class="textbox-check-<?= (empty($data['status']) || empty($data['nextCheckText'])) ? 'hide' : 'blue' ?>"
                                style="display: flex; gap: 12px;">
                                <div class="mid-center" style="flex-basis: 5%;">
                                    <?php if($data['status'] != '2'){ ?>
                                    <input type="checkbox" id="check1" name="status" value="1" class="status-checkbox"
                                        <?= (isset($data['status']) && $data['status'] == '1' && !empty($data['nextCheckText']) ) ? 'checked' : '' ?>
                                        style="width: 22px; height: 22px;">
                                    <?php } ?>
                                </div>
                                <div class="mid-center" style="flex-basis: 25%; margin-right: 20px;">
                                    <div id="border-cicle-progress"
                                        class="border-cicle  bg-white text-<?= (empty($data['status']) || empty($data['nextCheckText'])) ? 'black' : 'blue-sea' ?>"
                                        style="<?= (empty($data['status']) || empty($data['nextCheckText'])) ? 'border: 0.5px solid #30313D;' : 'border: 0.5px solid #2F42ED;' ?> font-size: 14px; font-weight: 600;">
                                        <?= Yii::t('app', 'In-Progress') ?>
                                    </div>
                                </div>
                                <div style="flex-basis: 70%;">
                                    <!-- แก้ไข diviv เป็น div -->
                                    <text id="text-blue"
                                        class="text-<?= (empty($data['status']) || empty($data['nextCheckText'])) ? 'black' : 'blue-sea' ?>">
                                        <?= Yii::t('app', "The task is currently being addressed. Ensure it's marked completed before the due date to avoid it being automatically listed as overdue.") ?>
                                    </text>
                                </div>
                            </div>


                            <div id="textbox-check-completed"
                                class="textbox-check-<?= (empty($data['status']) || $data['status'] != 2 ) ? 'hide' : 'green' ?>"
                                style="display: flex; gap: 12px; margin-top: 10px;">
                                <div class="mid-center" style="flex-basis: 5%;">
                                    <input type="checkbox" id="check2" name="status" value="2" class="status-checkbox"
                                        <?= (isset($data['status']) && $data['status'] == '2') ? 'checked' : '' ?>
                                        style="width: 22px; height: 22px;">
                                </div>
                                <div class="mid-center" style="flex-basis: 25%; margin-right: 20px;">
                                    <div id="border-cicle-completed"
                                        class="border-cicle  bg-white text-<?= (empty($data['status']) || empty($data['nextCheckText']) || $data['status'] != 2) ? 'black' : 'green' ?>"
                                        style="<?= (empty($data['status']) || empty($data['nextCheckText']) || $data['status'] != 2) ? 'border: 0.5px solid #30313D;' : 'border: 0.5px solid #2D7F06;' ?> font-size: 14px; font-weight: 600;">
                                        <?= Yii::t('app', "Completed") ?>
                                    </div>
                                </div>
                                <div style="flex-basis: 70%;">
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
                                                                : 'orang') ?>.svg" alt="LinkedIn"
                                        style="width: 20px; height: 20px;">
                                </div>
                                <div class="mid-center" style="flex-basis: 25%; margin-right: 20px;">
                                    <div class="border-cicle bg-white text-<?= (isset($daysLeft) && $daysLeft == 'Due Pass' && empty($data['nextCheckText'])) 
                                                            ? 'black' 
                                                            : ($daysLeft == 'Due Pass' 
                                                                ? 'red' 
                                                                : 'orang') ?>"
                                        style="<?= (isset($daysLeft) && $daysLeft == 'Due Pass' && empty($data['nextCheckText'])) 
                                                            ? 'border: 0.5px solid var(--Progress-Blue, #30313D);' 
                                                            : ($daysLeft == 'Due Pass' 
                                                                ? 'border: 0.5px solid var(--Progress-Blue, #E05757);' 
                                                                : 'border: 0.5px solid var(--Progress-Blue, #DD7A01);') ?>  font-size: 14px; font-weight: 600;"
                                        for="check3">

                                        <?= Yii::t('app', "Due Passed") ?>
                                    </div>
                                </div>
                                <div style="flex-basis: 70%;">
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
                    </div>

                    <div class="form-group mt-42"
                        style="display: flex; align-items: flex-end; justify-content: flex-end; gap: 12px; width: 100%;">
                        <div style="display: flex;
                                width: 99px;
                                height: 40px;
                                flex-direction: column;
                                align-items: flex-end;
                                ">
                            <label class="name-last-update">
                                Last Updated on
                            </label>
                            <text class="create-last-update">
                                <!-- 18/12/2024 -->
                                <?= isset($kpi['lastUpdate']) ? $kpi['lastUpdate'] : '' ?>
                            </text>
                        </div>
                        <div>
                            <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/kpi-individual-history/<?= ModelMaster::encodeParams(['kpiId' => $data['kpiId'], 'kpiEmployeeHistoryId' => $kpiEmployeeHistoryId, 'kpiEmployeeId' => $kpiEmployeeId]) ?>"
                                class="btn-create-cancle" style="width: 100px;">
                                <img src="<?= Yii::$app->homeUrl ?>image/eye-login.svg" alt="LinkedIn"
                                    style="width: 16px; height: 16px;">
                                <?= Yii::t('app', 'View') ?>
                            </a>
                        </div>

                        <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/individual-kpi-grid"
                            class="btn-create-cancle" style="width: 100px;">
                            <?= Yii::t('app', 'Cancel') ?>
                        </a>
                        <button type="submit" class="btn-create-update" style="width: 100px;">
                            <img src="<?= Yii::$app->homeUrl ?>image/updatebtn-white.svg" alt="LinkedIn"
                                style="width: 16px; height: 16px;">
                            <?= Yii::t('app', 'Update') ?>
                        </button>

                    </div>

                </div>
            </div>
            <!-- </form> -->
        </div>
    </div>
</div>

<input type="hidden" value="update" id="acType">
<input type="hidden" id="kpiEmployeeId" name="kpiEmployeeId" value="<?= isset($kpiEmployeeId) ? $kpiEmployeeId : '' ?>"
    required>

<?php ActiveForm::end(); ?>
<?= $this->render('modal_history') ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    var acType = document.getElementById('acType').value
    let isSubmitting = false; // ป้องกัน submit ซ้ำ
    $("#update-personal-kpi").on("beforeSubmit", function(event) {
        if (isSubmitting) {
            return false; // ถ้ากำลัง submit อยู่ ไม่ให้ทำซ้ำ
        }
        isSubmitting = true;
        // alert(acType);
        if (!validateFormKpiEmployee(acType)) {
            isSubmitting = false; // ถ้า validation ไม่ผ่าน ให้เปิด submit ใหม่
            return false;
        }
        return true; // ถ้า validation ผ่าน ให้ submit ฟอร์มต่อไป
    });
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

// const value = "<?= $value ?>";
// const sumvalue = "<?= $sumvalue ?>";
// // const sumvalue = "500";

// // Get both checkboxes
// const historicCheckbox = document.getElementById('historic-checkbox');
// const overrideCheckbox = document.getElementById('override-checkbox');

// // Add event listeners to handle toggling behavior
// historicCheckbox.addEventListener('change', function() {
//     if (this.checked) {
//         overrideCheckbox.checked = false;
//         // alert(0);
//         overrideChecked(overrideCheckbox.checked, sumvalue);
//     } else {
//         overrideCheckbox.checked = true;
//         // alert(1);
//         overrideChecked(overrideCheckbox.checked, value);
//     }
// });

// overrideCheckbox.addEventListener('change', function() {
//     if (this.checked) {
//         // alert(2);
//         historicCheckbox.checked = false;
//         overrideChecked(overrideCheckbox.checked, value);
//     } else {
//         // alert(3);
//         historicCheckbox.checked = true;
//         overrideChecked(overrideCheckbox.checked, sumvalue);
//     }
// });


function modalHistory(kpiId) {
    var url = $url + 'kpi/kpi-personal/modal-history';
    // alert(kpiId);
    var percentage = <?= json_encode($percentage) ?>;
    var result = <?= json_encode($result) ?>;
    var sumvalue = <?= json_encode($sumvalue) ?>;
    var targetAmount = <?= json_encode($targetAmount) ?>;
    var kpiEmployeeId = <?= json_encode($kpiEmployeeId) ?>;
    var kpiEmployeeHistoryId = <?= json_encode($kpiEmployeeHistoryId) ?>;
    var month = document.getElementById("hiddenMonth").value;
    var year = document.getElementById("hiddenYear").value;
    var fromDateValue = document.getElementById("fromDate").value;
    var toDateValue = document.getElementById("toDate").value;
    var fromDate = new Date(fromDateValue);
    var toDate = toDateValue ? new Date(toDateValue) : null; // ตรวจสอบค่าก่อนแปลง
    // alert(kpiEmployeeId);
    // ถ้า fromDate ไม่ถูกต้อง
    if (isNaN(fromDate)) {
        // ถ้า fromDate ไม่ถูกต้อง ให้ส่งค่าว่าไม่มีวันที่
        fromDate = null;
        formattedRange = "No date"; // กำหนดค่าเป็น "ไม่มีวันที่"
    } else {
        var fromDay = fromDate.getDate();
        var fromMonth = new Intl.DateTimeFormat('en-US', {
            month: 'long'
        }).format(fromDate);

        // ถ้า toDate ไม่ได้มีค่า ให้แสดงเฉพาะจาก fromDate
        var formattedRange = `${getOrdinalSuffix(fromDay)} ${fromMonth}`;

        if (toDate && !isNaN(toDate)) {
            var toDay = toDate.getDate();
            var toMonth = new Intl.DateTimeFormat('en-US', {
                month: 'long'
            }).format(toDate);
            formattedRange = `${getOrdinalSuffix(fromDay)} ${fromMonth} - ${getOrdinalSuffix(toDay)} ${toMonth}`;
        }
    }
    var monthName = getMonthName(parseInt(month)); // แปลงเป็นชื่อเดือน

    $.ajax({
        type: "POST",
        dataType: "json", // ✅ รอรับ JSON
        url: url,
        data: {
            percentage: percentage,
            result: result,
            sumvalue: sumvalue,
            targetAmount: targetAmount,
            kpiId: kpiId,
            month: monthName,
            year: year,
            kpiEmployeeId: kpiEmployeeId,
            kpiEmployeeHistoryId: kpiEmployeeHistoryId,
            formattedRange: formattedRange
        },
        success: function(data) {
            var percentage = parseFloat(data.percentage);
            var dueBehind = 100 - percentage; // ✅ คำนวณส่วนต่าง
            $("#mont-hyear").text(data.month + " " + data.year);
            $("#formattedRange").text(data.formattedRange);
            $("#Target").text(data.targetAmount);
            $("#Result").text("/" + data.result);
            $(".percentage").text(percentage + "%");
            var dashArrayValue = (percentage / 100) * 100;
            $(".circle").attr("stroke-dasharray", dashArrayValue + ", 100");
            $("#DueBehind").text(dueBehind + "%");
            // console.log(data.historyTeam);
            var historyData = data.history; // ดึงข้อมูล history
            var historyList = $('#history-list-creater');
            historyList.empty(); // เคลียร์รายการเก่า
            var historyArray = Object.values(historyData);

            var historyTeamData = data.historyTeam; // ดึงข้อมูล history
            var historyTeamList = $('#history-list-team');
            historyTeamList.empty(); // เคลียร์รายการเก่า
            var historyTeamArray = Object.values(historyTeamData);

            historyArray.forEach(function(item) {
                var listItem = `
                <li class="schedule-item mt-5" role="button" tabindex="0">
                        <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                            <div style="display: flex; gap: 16px; align-items: center;">
                                <div style="display: flex; justify-content: center; align-items: center;">
                                    <div class="col-5">
                                        <img src="<?= Yii::$app->homeUrl ?>${item.picture}" class="width-ehsan-small" id="picture-history">
                                    </div>
                                </div>
                                <div style="display: flex; justify-content: center; align-items: center;">
                                    <span class="text-black" id="creater-history" style="font-size: 16px; font-weight: 500;">
                                        ${item.creater}
                                    </span>
                                </div>
                            </div>

                            <div style="display: flex; justify-content: center; align-items: center; background-color: rgb(215, 235, 255); border: 0.795px solid #2580D3; border-radius: 36px; padding: 3px 20px; z-index: 1;">
                                <div style="display: flex; justify-content: center; align-items: center; gap: 8px;">
                                    <div class="cycle-current">
                                        <img src="<?= Yii::$app->homeUrl ?>image/teams.svg" alt="icon">
                                    </div>
                                    <span class="text-black" id="teamName-history" style="font-size: 16px; font-weight: 500;">
                                        ${item.teamName}
                                    </span>
                                </div>
                            </div>

                            <div style="display: flex; flex-direction: column; text-align: right;">
                                <div>
                                    <span class="text-gray" id="target-history" style="font-size: 18px; font-weight: 400;">
                                        ${item.target}
                                    </span>
                                    <span class="text-blue" id="result-history" style="font-size: 18px; font-weight: 600;">
                                        /${item.result}
                                    </span>
                                </div>
                                <span class="text-gray" id="createDate-history" style="font-size: 14px; font-weight: 400;">
                                    ${item.createDateTime}
                                </span>
                            </div>
                        </div>
                    </li>
            `;
                historyList.append(listItem); // เพิ่มข้อมูลลงใน ul
            });

            historyTeamArray.forEach(function(item) {
                var listItem = `
                    <li class="schedule-item mt-5" role="button" tabindex="0">
                        <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                            <!-- กลุ่มที่ชิดซ้าย -->
                            <div style="display: flex; gap: 16px;">
                                <div style="display: flex; justify-content: center; align-items: center;">
                                    <div class="cycle-current">
                                        <img src="<?= Yii::$app->homeUrl ?>image/teams.svg" alt="icon">
                                    </div>
                                </div>
                                <div style="display: flex; gap: 6px; flex-direction: column;">
                                    <text class="text-black" style="font-size: 16px; font-weight: 600;">
                                        ${item.teamName} <!-- ใช้ชื่อทีมจาก item -->
                                    </text>
                                    <text class="text-gray" style="font-size: 14px; font-weight: 400;">
                                        Accounting & Outsourcing de... <!-- หรือใช้ข้อมูลอื่นจาก item -->
                                    </text>
                                </div>
                            </div>

                            <!-- กลุ่มที่ชิดขวา -->
                            <div style="display: flex;">
                                <div>
                                    <div style="display: flex; gap: 6px; flex-direction: column;">
                                        <text class="text-end">
                                            <span class="text-gray" style="font-size: 18px; font-weight: 400;">
                                                ${item.target} <!-- แสดง target -->
                                            </span>
                                            <span class="text-blue" style="font-size: 18px; font-weight: 600;">
                                                /${item.result} <!-- แสดง result -->
                                            </span>
                                        </text>
                                        <text class="text-gray text-end" style="font-size: 14px; font-weight: 400;">
                                            ${item.createDateTime} <!-- แสดงวันที่ที่สร้าง -->
                                        </text>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                `;
                historyTeamList.append(listItem); // เพิ่มข้อมูลลงใน ul
            });

        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText); // ดูข้อความผิดพลาดจากเซิร์ฟเวอร์
            // alert("เกิดข้อผิดพลาดไม่มีข้อมูลในการโหลดข้อมูล");
        }
    });
}
</script>