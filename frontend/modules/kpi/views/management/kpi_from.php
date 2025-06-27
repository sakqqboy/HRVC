<?php

use yii\bootstrap5\ActiveForm;

// $this->title = 'KPI';

if ($statusform == 'update') {
    $parturl = 'kpi/management/update-kpi';
    $title = 'Update KPI';
} else {
    $parturl = 'kpi/management/create-kpi';
    $title = 'Create KPI';
}
$form = ActiveForm::begin([
    'id' => 'create-kpi',
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data'
    ],
    'action' => Yii::$app->homeUrl . $parturl
]);
$unitId = 1;
if (isset($data['unitId']) && $data['unitId'] >= 1) {
    $unitId = $data['unitId'];
}
$quantRatio = $data['quantRatio'] ?? '';
$selectedCode = $data['code'] ?? '';
$selectedAmountType = $data['amountType'] ?? '';
$selectedPriority = isset($data['priority']) ? $data['priority'] : '';
$percentage = isset($data['ratio']) ? round((float)$data['ratio']) : 0;
$result = $data['result'] ?? 0;
$value = isset($data['result']) ? $data['result'] : 0;
$sumvalue = isset($data['sumresult']) ? $data['sumresult'] : 0;
$targetAmount = $data['targetAmount'] ?? 0;
$kpiHistoryId = $data['kpiHistoryId'] ?? 0;
$DueBehind = $targetAmount -  $result;
if ($DueBehind < 0) {
    $DueBehind = 0;
}
// echo $lastUrl;
// exit;
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

<link rel="stylesheet" href="<?= Yii::$app->homeUrl ?>assets/bootstrap4/css/bootstrap.min.css">
<script src="<?= Yii::$app->homeUrl ?>assets/bootstrap4/js/jquery.min.js"></script>
<script src="<?= Yii::$app->homeUrl ?>assets/bootstrap4/js/bootstrap.bundle.min.js"></script>


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
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div class="col-8">
                    <a href="<?= Yii::$app->request->referrer ? Yii::$app->request->referrer : Yii::$app->homeUrl . 'kpi/management/grid' ?>"
                        class="mr-5 font-size-12" style="text-decoration: none;">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/back.svg">
                        <text class="pim-text-back">
                            <?= Yii::t('app', 'Back') ?>
                        </text>
                    </a>
                    <text class="pim-name-title">
                        <?php if ($statusform == 'update') { ?>
                        <?= Yii::t('app', 'Update Key Performance Indicator') ?>
                        <?php } else { ?>
                        <?= Yii::t('app', 'Create Key Performance Indicator') ?>
                        <?php } ?>
                    </text>
                </div>
                <div class="col-4" style="display: flex; justify-content: center; align-items: center; gap: 20px;">
                    <div style="display: flex; gap: 14px; flex-direction: column;">
                        <text class="current-ratio text-end">
                            <?= Yii::t('app', 'Current Achievement Ratio') ?>
                        </text>
                        <text class="current-ratio-data text-end">
                            <?php
                            if ($DueBehind) {
                                echo Yii::t('app', 'Due Behind by ') . ' ';
                            } else {
                                echo Yii::t('app', 'no Data');
                            }
                            ?>
                            <span class="DueBehind">
                                <?= number_format($DueBehind) ?>
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
                                stroke="#4db8ff" stroke-width="3" fill="none"
                                stroke-dasharray="<?= $percentage ?>, 100" />

                            <!-- Percentage text in the middle -->
                            <text x="18" y="20.35" text-anchor="middle" dominant-baseline="middle" class="percentage"
                                style="font-size: 8px; font-weight: bold; fill: #333;">
                                <?= $percentage ?>%
                            </text>
                        </svg>

                    </div>
                    <div style="width: 1px; background-color: #BBCDDE; height: 51px;"></div>
                    <div style="display: flex; align-items: center; gap: 22px;">
                        <img src="<?= Yii::$app->homeUrl ?><?= isset($data['result']) ? 'image/result-blue.svg' : 'images/icons/Settings/reward.svg' ?>"
                            style="width: 40px; height: 40px;">
                        <text class="pim-total-reward">
                            <?= isset($data['result']) ? number_format($data['result']) : '000' ?>
                        </text>
                    </div>
                </div>
            </div>

            <div class="contrainer-body-detail">
                <div style="flex: 1;">
                    <div class="form-group start-center" style="  gap: 14px;">
                        <label class="text-manage-create" for="name">
                            <span class="text-danger">* </span>
                            <?= Yii::t('app', 'Name') ?>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                data-placement="top"
                                title="<?= Yii::t('app', 'Enter the name of your key Performance indicator. This should be clear and specific, such as Number of customer Visits or Number of Cold calls to client') ?>">
                        </label>
                        <input type="text" class="form-control" id="kpiName" name="kpiName"
                            value="<?= isset($data['kpiName']) ? htmlspecialchars($data['kpiName']) : '' ?>"
                            placeholder="Please Write the Name of Component" required>

                    </div>

                    <div class="form-group mt-37 start-center" style="  gap: 14px;">
                        <label class="text-manage-create" for="name">
                            <span class="text-danger">* </span>
                            <?= Yii::t('app', 'Select Company') ?>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                data-placement="top"
                                title="<?= Yii::t('app', 'Choose the company for which this performance indicator will be tracked. Only one company can be selected at a time to ensure accurate and focused Performance monitoring') ?>"
                                alt="Help Icon">
                        </label>
                        <select class="form-select" name="companyId" id="companyId"
                            onchange="javascript:companyMultiBrachKpi()" required>
                            <option value=""><?= Yii::t('app', 'Select Company') ?></option>
                            <?php
                            if (isset($companies) && count($companies) > 0) {
                                foreach ($companies as $company) :
                                    $selected = (isset($data['companyId']) && $data['companyId'] == $company["companyId"]) ? 'selected' : '';
                            ?>
                            <option value="<?= $company["companyId"] ?>" <?= $selected ?>>
                                <?= $company["companyName"] ?>
                            </option>
                            <?php
                                endforeach;
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group start-center mt-37" style="  gap: 14px;">

                        <div class="form-group start-center" style="  gap: 14px;">

                            <label class="text-manage-create" for="my-input">
                                <span class="text-danger">* </span>
                                <?= Yii::t('app', 'Select Branch/s ') ?>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top"
                                    title="<?= Yii::t('app', 'Select the relevant branches where this indicator will be monitored. You can choose multiple branches to track Performance achievement across different locations') ?>"
                                    alt="Help Icon">
                            </label>
                            <div class="form-control" id="multi-branch" style="width: 496px;
                                display: flex;
                                align-items: center;
                                padding: 5px 15px;
                                border: 1px solid #d1d5db;
                                border-radius: 5px;
                                background-color: #fff;
                                font-size: 14px;
                                position: relative;">
                                <span id="multi-branch-text" style="flex-grow: 1;
                                                                color: #8a8a8a;
                                                                font-family: SF Pro Display
                                                                , sans-serif;
                                                            ">
                                    <?= Yii::t('app', 'Select Branch/s') ?></span>
                                <div class="circle-container pl-15" id="image-branches" data-type="branch" style="display: flex;
                                    align-items: center;
                                    gap: 5px;
                                    padding-left: 15px;">
                                    <div class="cycle-current-gray">
                                        <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg" alt="icon">
                                    </div>
                                    <div class="cycle-current-gray">
                                        <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg" alt="icon">
                                    </div>
                                    <div class="cycle-current-gray">
                                        <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg" alt="icon">
                                    </div>
                                    <div class="cycle-current-gray" style="color: #000; right: 15px;"
                                        id="branch-selected-count">
                                        00
                                    </div>
                                </div>
                                <i class="toggle-icon-branch fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>
                            </div>

                            <div class="col-12" <?php if ($statusform == 'update'): ?> id="show-multi-branch-update"
                                <?php else: ?> id="show-multi-branch" <?php endif; ?> style="position: absolute; top: <?= ($statusform == 'create') ? '80%' : '80%'; ?>; 
                                    left: 0; width: 100%; z-index: 999; background-color: white; 
                                    border: 1px solid #ced4da; padding: 10px; display: none;">
                                <?php if ($statusform == 'create'): ?>
                                <!-- สำหรับโหมด create ให้แสดงกล่องเปล่า -->
                                <?php else: ?>
                                <?= $kpiBranchText; ?>
                                <?php endif; ?>

                            </div>
                            <div>

                            </div>
                        </div>
                    </div>

                    <div class="form-group start-center mt-37" style="  gap: 14px;">
                        <label class="text-manage-create" for="name">
                            <span class="text-danger">* </span>
                            <?= Yii::t('app', 'Select Department/s') ?>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                data-placement="top"
                                title="<?= Yii::t('app', 'Choose the departments that will be responsible for this performance indicator. Multiple departments can be selected for cross-functional Performance tracking.') ?>"
                                alt="Help Icon">
                        </label>
                        <div class="form-control" id="multi-department" style="width: 496px;
                                display: flex;
                                align-items: center;
                                padding: 5px 15px;
                                border: 1px solid #d1d5db;
                                border-radius: 5px;
                                background-color: #fff;
                                font-size: 14px;
                                position: relative;">
                            <span id="multi-department-text" style="flex-grow: 1;
                                       color: #8a8a8a;
                                       font-family: SF Pro Display
                                       , sans-serif;">
                                <?= Yii::t('app', 'Select Department') ?>
                            </span>
                            <div class="circle-container pl-15" id="image-departments" data-type="department" style="display: flex;
                                    align-items: center;
                                    gap: 5px;
                                    padding-left: 15px;">
                                <div class="cycle-current-gray">
                                    <img src="<?= Yii::$app->homeUrl ?>image/departments-black.svg" alt="icon">
                                </div>
                                <div class="cycle-current-gray">
                                    <img src="<?= Yii::$app->homeUrl ?>image/departments-black.svg" alt="icon">
                                </div>
                                <div class="cycle-current-gray">
                                    <img src="<?= Yii::$app->homeUrl ?>image/departments-black.svg" alt="icon">
                                </div>
                                <div class="cycle-current-gray" style="color: #000; right: 15px;"
                                    id="department-selected-count">
                                    00
                                </div>
                            </div>
                            <i class="toggle-icon-department fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>
                        </div>

                        <div class="col-12" <?php if ($statusform == 'update'): ?> id="show-multi-department-update"
                            <?php else: ?> id="show-multi-department" <?php endif; ?> style="position: absolute; top: 80%; left: 0; width: 98%; z-index: 999; background-color: white; 
                            border: 1px solid #ced4da; padding: 10px; display: none;">
                            <?php if ($statusform == 'create'): ?>
                            <!-- สำหรับโหมด create ให้แสดงกล่องเปล่า -->
                            <?php else: ?>
                            <?= $kpiDepartmentText; ?>
                            <?php endif; ?>
                        </div>

                        <div>

                        </div>
                    </div>
                    <div class="form-group start-center mt-37" style="  gap: 14px;">
                        <label class="text-manage-create" for="name">
                            <span class="text-danger">* </span>
                            <?= Yii::t('app', 'Select Team/s') ?>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                data-placement="top"
                                title="<?= Yii::t('app', 'Choose the Team that will be responsible for achieving this performance indicator. Multiple Teams can be selected for collaborative performance achievement.') ?>"
                                alt="Help Icon">
                        </label>
                        <div class="form-control" id="multi-team" style="width: 496px;
                                display: flex;
                                align-items: center;
                                padding: 5px 15px;
                                border: 1px solid #d1d5db;
                                border-radius: 5px;
                                background-color: #fff;
                                font-size: 14px;
                                position: relative;">
                            <span id="multi-team-text" style="flex-grow: 1;
                                       color: #8a8a8a;
                                       font-family: SF Pro Display
                                       , sans-serif;">
                                <?= Yii::t('app', 'Select Team') ?>
                            </span>
                            <div class="circle-container pl-15" id="image-team" data-type="team" style="display: flex;
                                    align-items: center;
                                    gap: 5px;
                                    padding-left: 15px;">
                                <div class="cycle-current-gray">
                                    <img src="<?= Yii::$app->homeUrl ?>image/teams-black.svg" alt="icon">
                                </div>
                                <div class="cycle-current-gray">
                                    <img src="<?= Yii::$app->homeUrl ?>image/teams-black.svg" alt="icon">
                                </div>
                                <div class="cycle-current-gray">
                                    <img src="<?= Yii::$app->homeUrl ?>image/teams-black.svg" alt="icon">
                                </div>
                                <div class="cycle-current-gray" style="color: #000;  right: 15px;"
                                    id="team-selected-count">
                                    00
                                </div>
                            </div>
                            <i class="toggle-icon-team fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>
                        </div>

                        <div class="col-12" <?php if ($statusform == 'update'): ?> id="show-multi-team-update"
                            <?php else: ?> id="show-multi-team" <?php endif; ?> style="position: absolute; top: 80%; left: 0; width: 98%; z-index: 999; background-color: white; 
                            border: 1px solid #ced4da; padding: 10px; display: none;">
                            <?php if ($statusform == 'create'): ?>
                            <!-- สำหรับโหมด create ให้แสดงกล่องเปล่า -->
                            <?php else: ?>
                            <?= $kpiTeamText; ?>
                            <?php endif; ?>
                        </div>

                        <div>

                        </div>
                    </div>
                    <div class="form-group start-center mt-37" style="  gap: 14px;">
                        <label class="text-manage-create" for="name">
                            <span class="text-danger">* </span>
                            <?= Yii::t('app', 'Determine Priority') ?>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                data-placement="top"
                                title="<?= Yii::t('app', 'Select priority between A, B or C, (A is considered as highest priority and C is least) to align with organizational objectives.') ?>"
                                alt="Help Icon">
                        </label>
                        <select class="form-select font-size-13" aria-label="Default select example"
                            id="priority-update" name="priority">
                            <option value="" <?= ($selectedPriority == '') ? 'selected' : ''; ?>>A/B/C</option>
                            <option value="A" <?= ($selectedPriority == 'A') ? 'selected' : ''; ?>>A</option>
                            <option value="B" <?= ($selectedPriority == 'B') ? 'selected' : ''; ?>>B</option>
                            <option value="C" <?= ($selectedPriority == 'C') ? 'selected' : ''; ?>>C</option>
                        </select>
                    </div>
                </div>
                <div style="flex: 1;">
                    <div class="form-group start-center" style="  gap: 14px;">
                        <label class="text-manage-create" for="name">
                            <span class="text-danger">* </span>
                            <?= Yii::t('app', 'Update Interval') ?>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                data-placement="top"
                                title="<?= Yii::t('app', 'Select how frequently this indicator should be updated: Monthly, Quarterly, Half Yearly, or Yearly. This determines the performance review cycle.') ?>"
                                alt="Help Icon">
                        </label>
                        <div class="btn-group col-12" role="group" aria-label="Basic outlined example">
                            <?php
                            if (isset($units) && count($units) > 0) {
                                $i = 1;
                                foreach ($units as $unit) :
                                    $activeClass = ($unitId == $unit['unitId']) ? 'unit-active' : 'unit-inactive';
                            ?>
                            <button type="button" id="unit-<?= $unit['unitId'] ?>"
                                class="btn col-3 font-size-12 <?= $activeClass ?>"
                                onclick="selectUnit(<?= $unit['unitId'] ?>)">
                                <?= Yii::t('app', $unit["unitName"]) ?>
                            </button>
                            <?php
                                    $i++;
                                endforeach;
                            }

                            // echo  $unitId;
                            ?>
                            <input type="hidden" value="<?= $unitId ?>" id="currentUnit" name="unitId" required>
                            <input type="hidden" value="<?= $unitId ?>" id="previousUnit" required>
                        </div>
                    </div>

                    <div class="form-group start-center mt-37" style="  gap: 14px;">
                        <label class="text-manage-create" for="name">
                            <span class="text-danger">* </span>
                            <?= Yii::t('app', 'Month & Year') ?> <?= $statusform ?>
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
                                style="border-radius: 53px 53px 53px 53px; text-align: center; cursor: pointer; position: absolute; width: 100%;"
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
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
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

                    <div class="form-group start-center mt-37" style="  gap: 14px;">
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
                                style="border-radius: 53px; text-align: center; cursor: pointer; position: absolute; width: 100%;"
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

                    <div class="form-group start-center mt-37" style="  gap: 14px;">
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
                                style="border-radius: 53px 53px 53px 53px; text-align: center; cursor: pointer; position: absolute ; width: 100%; ">
                                Select the Last Update Date <i class="fa fa-angle-down pull-right mt-5"
                                    aria-hidden="true"></i>
                            </div>
                            <input type="hidden" id="nextDate" name="nextCheckDate"
                                value="<?= isset($data['nextCheck']) ? $data['nextCheck'] : '' ?>">
                            <!-- <input type="hidden" id="nextDate" name="nextCheck"> -->
                        </div>
                        <div id="calendar-due-update"
                            style="position: absolute; margin-top: 75px; padding: 10px; border: 1px solid rgb(221, 221, 221); border-radius: 10px; background: rgb(255, 255, 255); width: 100%; z-index: 1; display: none; justify-content: center; align-items: center;">
                            <div id="updateDatePicker" style="display: none;"></div>
                        </div>
                    </div>

                    <div class="form-group start-center mt-37" style="  gap: 14px;">
                        <label class="text-manage-create" for="name">
                            <span class="text-danger">* </span>
                            <?= Yii::t('app', 'Quant Ratio') ?>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                data-placement="top"
                                title="<?= Yii::t('app', 'Select the measurement unit for your indicator (e.g., score, count, percentage, or rating scale) to ensure consistent performance assessment.') ?>"
                                alt="Help Icon">
                        </label>
                        <select class="form-select" id="quantRatio-create" name="quantRatio" required>
                            <option value=""><?= Yii::t('app', 'Select the Measurement Unit') ?></option>
                            <option value="1" <?= ($quantRatio == 1) ? 'selected' : '' ?>>
                                <?= Yii::t('app', 'Quantity') ?>
                            </option>
                            <option value="2" <?= ($quantRatio == 2) ? 'selected' : '' ?>>
                                <?= Yii::t('app', 'Quality') ?>
                            </option>
                        </select>
                        <input type="hidden" name="kpiId" id="kpiId" value="<?= isset($kpiId) ? $kpiId : '' ?>">
                    </div>

                    <div class="form-group mt-37" style="display: flex; gap: 14px; flex-wrap: wrap;">
                        <!-- Left side (Data Type) -->
                        <div class="col-lg-6 col-md-6 col-6 mt-10" style="flex-basis: 48%; box-sizing: border-box;">
                            <label class="text-manage-create" for="name">
                                <span class="text-danger">* </span>
                                <?= Yii::t('app', 'Data Type') ?>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top"
                                    title="<?= Yii::t('app', 'Choose the type of data being tracked (e.g., numerical scores, percentages, ratings) to ensure proper performance measurement.') ?>"
                                    alt="Help Icon">
                            </label>
                            <select class="form-select" id="amountType-create" name="amountType" required>
                                <option value="">Select</option>
                                <option value="1" <?= ($selectedAmountType == '1') ? 'selected' : '' ?>>%</option>
                                <option value="2" <?= ($selectedAmountType == '2') ? 'selected' : '' ?>>
                                    <?= Yii::t('app', 'Number') ?></option>
                            </select>
                        </div>

                        <!-- Right side (Success Condition) -->
                        <div class="col-lg-6 col-md-6 col-6 mt-10" style="flex-basis: 48%; box-sizing: border-box;">
                            <label class="text-manage-create" for="name">
                                <span class="text-danger">* </span>
                                <?= Yii::t('app', 'Success Condition') ?>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top"
                                    title="<?= Yii::t('app', 'Define the criteria for success (e.g., Greater Than, Less Than, Equal To) to measure performance achievement against the target.') ?>"
                                    alt="Help Icon">
                            </label>
                            <select class="form-select" id="code-create" name="code" required>
                                <option value="">Select</option>
                                <option value="<" <?= ($selectedCode == '<') ? 'selected' : '' ?>>
                                    &nbsp;&nbsp;<?= '<' ?>&nbsp;&nbsp;<?= Yii::t('app', 'Result more than target') ?>
                                </option>
                                <option value="=" <?= ($selectedCode == '=') ? 'selected' : '' ?>>
                                    &nbsp;&nbsp;=&nbsp;&nbsp;<?= Yii::t('app', 'Result equal target') ?>
                                </option>
                                <option value=">" <?= ($selectedCode == '>') ? 'selected' : '' ?>>
                                    &nbsp;&nbsp;>&nbsp;&nbsp;<?= Yii::t('app', 'Result less than target') ?>
                                </option>
                            </select>
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
                                <img src="<?= Yii::$app->homeUrl ?>image/target-blue.svg" alt="LinkedIn"
                                    style="width: 30px; height: 30px;">
                            </span>
                            <input type="number" class="form-control text-end" name="amount" step="any"
                                placeholder="Enter Target Amount"
                                value="<?= isset($data['targetAmount']) ? $data['targetAmount'] : '' ?>"
                                style="border-left: none; font-size: 22px; font-style: normal; font-weight: 600;"
                                required>
                        </div>
                    </div>

                    <div class="form-group start-center mt-42" style="  gap: 14px;">
                        <label class="text-manage-create" for="name"
                            style="display: flex; justify-content: space-between; width: 100%; align-items: center;">
                            <div style="flex-grow: 1;">
                                <span class="text-danger">* </span>
                                <?= Yii::t('app', 'Result') ?>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top"
                                    title="<?= Yii::t('app', 'Historic update contains the update from the team and indivudials if you wish to use your own values, please toggle on Override to put custom numbers ') ?>"
                                    alt="Help Icon">
                            </div>
                            <div href="javascript:void(0);" class="updatehistory"
                                style="text-align: right; cursor: pointer; " data-bs-toggle="modal"
                                data-bs-target="#update-history-popup"
                                onclick="modalHistory(<?= isset($kpiId) ? $kpiId : '' ?>);">
                                <?php if ($statusform == 'update') { ?>
                                <img
                                    src="<?= Yii::$app->homeUrl ?>image/refes-blue.svg"><?= Yii::t('app', 'Update History') ?>
                                <?php } ?>
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
                                value="<?= isset($data['result']) ? $data['result'] : '0' ?>"
                                style="border-left: none; font-size: 22px; font-style: normal; font-weight: 600;"
                                required step="any" oninput="updateIcon(this),updateResultValue(this)">
                            <input type="hidden" name="result" id="result-cheng"
                                value="<?= isset($data['result']) ? $data['result'] : '0' ?>">
                        </div>


                        <div style="display: flex; justify-content: space-between; width: 100%; align-items: center;">
                            <?php if ($statusform == 'update') { ?>
                            <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                                <label class="switch">
                                    <input type="checkbox" id="historic-checkbox">
                                    <span class="slider round"></span>
                                </label>
                                <label class="sub-manage-create" id="historic-switch">
                                    <?= Yii::t('app', 'Historic Update') ?>
                                </label>
                            </div>
                            <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                                <label class="switch">
                                    <input type="checkbox" id="override-checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                                <label class="sub-manage-create" id="override-switch">
                                    <?= Yii::t('app', 'Override') ?>
                                </label>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="form-group start-center mt-42" style="  gap: 14px;">
                        <label class="text-manage-create" for="name"
                            style="display: flex; justify-content: space-between; width: 100%; align-items: center;">
                            <div style="flex-grow: 1;">
                                <span class="text-danger">* </span>
                                <?= Yii::t('app', 'Details') ?>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top" title="<?= Yii::t('app', '') ?>">
                            </div>
                        </label>
                        <textarea class="form-control" name="detail" style="height: 165px;"
                            rows="4"><?= isset($data['detail']) ? $data['detail'] : '' ?></textarea>
                    </div>

                    <div class="form-group mt-42"
                        style="display: flex; align-items: flex-end; justify-content: flex-end; gap: 12px; width: 100%;">
                        <?php

                        if ($statusform == 'update') {
                        ?>
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
                                <?= isset($data['lastUpdate']) ? $data['lastUpdate'] : '' ?>
                            </text>
                        </div>
                        <div>
                            <select
                                class="<?= $data['status'] == 1 ? 'select-create-status' : 'select-complete-status' ?>"
                                aria-label="Default select example" name="status" id="pim-status"
                                onchange="javascript:changeStatus('kpi')" required="">
                                <option value="1"
                                    <?= isset($data['status']) && $data['status'] == 1 ? 'selected' : '' ?>> In-Progress
                                </option>
                                <option value="2"
                                    <?= isset($data['status']) && $data['status'] == 2 ? 'selected' : '' ?>> Completed
                                </option>
                            </select>

                        </div>
                        <?php
                        } else {
                        ?>
                        <input type="hidden" name="status" value='1'>
                        <?php } ?>
                        <a href="<?= Yii::$app->homeUrl ?>kpi/management/grid" class="btn-create-cancle"
                            style="width: 100px;text-decoration: none;">
                            <?= Yii::t('app', 'Cancel') ?>
                        </a>
                        <?php
                        if ($statusform == 'update') {
                        ?>
                        <button type="submit" class="btn-create-update" style="width: 100px;">
                            <img src="<?= Yii::$app->homeUrl ?>image/updatebtn-white.svg" alt="LinkedIn"
                                style="width: 16px; height: 16px;">
                            <?= Yii::t('app', 'Update') ?>
                        </button>
                        <?php } else { ?>
                        <!-- ปรับให้ปุ่มนี้เป็น type="submit" -->
                        <button type="submit" class="btn-create-update" style="width: 100px;">
                            <?= Yii::t('app', 'Create') ?>
                            <img src="<?= Yii::$app->homeUrl ?>image/create-btn-white.svg" alt="LinkedIn"
                                style="width: 16px; height: 16px;">
                        </button>
                        <?php } ?>
                    </div>

                </div>
            </div>
            <!-- </form> -->
        </div>
    </div>
</div>
<?php if ($statusform == 'update') {
?>
<input type="hidden" value="update" id="acType">
<?php
} else {
?>
<input type="hidden" value="create" id="acType">
<?php } ?>
<input type="hidden" value="<?= $lastUrl ?>" name="lastUrl" id="lastUrl">

<?php ActiveForm::end(); ?>
<?= $this->render('modal_warning') ?>
<?= $this->render('modal_history') ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    var acType = document.getElementById('acType').value
    let isSubmitting = false; // ป้องกัน submit ซ้ำ
    $("#create-kpi").on("beforeSubmit", function(event) {
        if (isSubmitting) {
            return false; // ถ้ากำลัง submit อยู่ ไม่ให้ทำซ้ำ
        }
        isSubmitting = true;
        if (!validateFormKpi(acType)) {
            isSubmitting = false; // ถ้า validation ไม่ผ่าน ให้เปิด submit ใหม่
            return false;
        }
        return true; // ถ้า validation ผ่าน ให้ submit ฟอร์มต่อไป
    });
});

const value = "<?= $value ?>";
const sumvalue = "<?= $sumvalue ?>";

// Get both checkboxes
const historicCheckbox = document.getElementById('historic-checkbox');
const overrideCheckbox = document.getElementById('override-checkbox');

// Add event listeners to handle toggling behavior
historicCheckbox.addEventListener('change', function() {
    if (this.checked) {
        overrideCheckbox.checked = false;
        // alert(0);
        overrideChecked(overrideCheckbox.checked, sumvalue);
    } else {
        overrideCheckbox.checked = true;
        // alert(1);
        overrideChecked(overrideCheckbox.checked, value);
    }
});

overrideCheckbox.addEventListener('change', function() {
    if (this.checked) {
        // alert(2);
        historicCheckbox.checked = false;
        overrideChecked(overrideCheckbox.checked, value);
    } else {
        // alert(3);
        historicCheckbox.checked = true;
        overrideChecked(overrideCheckbox.checked, sumvalue);
    }
});


$(document).ready(function() {
    var statusform = '<?= $statusform ?>';

    if (statusform == 'update') {
        branchMultiDepartmentUpdateKpi();

        // ดึงค่า branchId ที่ถูก checked แล้ว
        var checkedBranchIds = [];
        var checkedDepartmentIds = [];

        $('input[name="branch[]"]:checked').each(function() {
            checkedBranchIds.push($(this).val());
        });

        $('input[name="department[]"]:checked').each(function() {
            checkedDepartmentIds.push($(this).val());
        });

        checkedBranchIds.forEach(function(branchId) {
            departmentMultiTeamUpdateKpi(branchId);
        });

        // if (checkedDepartmentIds.length > 0) {

        //     var checkedTeamIds = [];
        //     $('input[name="team[]"]:checked').each(function() {
        //         checkedTeamIds.push($(this).val());
        //     });

        //     // เรียกใช้งานฟังก์ชันสำหรับ team ที่ถูก checked เท่านั้น
        //     checkedTeamIds.forEach(function(departmentId) {
        //         multiTeamUpdate(departmentId);
        //     });
        // } else {
        multiteamKpi();
        // }

        // เรียกใช้งานฟังก์ชันกับ select หลายตัวพร้อมกัน
    }
    updatePlaceholderColor('#companyId');
    updatePlaceholderColor('#quantRatio-create');
    updatePlaceholderColor('#amountType-create');
    updatePlaceholderColor('#code-create');

    $('[data-toggle="tooltip"]').tooltip(); // เปิดใช้งาน Tooltip

});

function modalHistory(kpiId) {
    // alert(kpiId);
    var url = $url + 'kpi/management/modal-history';

    var month = document.getElementById("hiddenMonth").value;
    var year = document.getElementById("hiddenYear").value;
    var fromDateValue = document.getElementById("fromDate").value;
    var toDateValue = document.getElementById("toDate").value;
    var percentage = <?= json_encode($percentage) ?>;
    var result = <?= json_encode($result) ?>;
    var sumvalue = <?= json_encode($sumvalue) ?>;
    var targetAmount = <?= json_encode($targetAmount) ?>;
    var kpiHistoryId = <?= json_encode($kpiHistoryId) ?>;
    var fromDate = new Date(fromDateValue);
    var toDate = new Date(toDateValue);
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
            monthName: monthName,
            month: month,
            year: year,
            formattedRange: formattedRange,
            kpiHistoryId: kpiHistoryId
        },
        success: function(data) {
            var percentage = parseFloat(data.percentage);
            var dueBehind = 100 - percentage;
            // dueBehind = dueBehind.toFixed(2); // จำกัดทศนิยมไม่เกิน 2 ตำแหน่ง
            $("#mont-hyear").text(data.month + " " + data.year);
            $("#formattedRange").text(data.formattedRange);
            $("#Target").text(data.targetAmount);
            $("#Result").text("/" + data.result);
            $(".percentage").text(percentage + "%");
            var dashArrayValue = (percentage / 100) * 100;
            $(".circle").attr("stroke-dasharray", dashArrayValue + ", 100");
            $("#DueBehind").text(dueBehind + "%");
            // console.log(data.history);
            var historyData = data.history; // ดึงข้อมูล history
            var historyList = $('#history-list-creater');
            historyList.empty(); // เคลียร์รายการเก่า
            var historyArray = Object.values(historyData);
            // console.log(data.historyTeam);
            var historyTeamData = data.historyTeam; // ดึงข้อมูล history
            var historyTeamList = $('#history-list-team');
            historyTeamList.empty(); // เคลียร์รายการเก่า
            var historyTeamArray = Object.values(historyTeamData);

            // alert(JSON.stringify(historyData));

            if (historyArray.length > 0) {
                historyArray.forEach(function(item) {
                    var listItem = `
                        <li class="schedule-item mt-5" role="button" tabindex="0">
                            <div class="row" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">

                                <div class="col-5" style="display: flex; gap: 16px; align-items: center;">
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

                                <div class="col-3">
                                    <div  style="display: flex; justify-content: center; align-items: center; background-color: rgb(215, 235, 255); border: 0.795px solid #2580D3; border-radius: 36px; padding: 3px 20px; z-index: 1;">
                                        <div style="display: flex; justify-content: center; align-items: center; gap: 8px;">
                                            <div class="cycle-current">
                                                <img src="<?= Yii::$app->homeUrl ?>image/teams.svg" alt="icon">
                                            </div>
                                            <span class="text-black" id="teamName-history" style="font-size: 16px; font-weight: 500;">
                                                ${item.teamName}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-4" style="display: flex; flex-direction: column; text-align: right;">
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
            } else {
                historyList.append(
                    `<li class="schedule-item mt-5" role="button" tabindex="0">
                        <div class="row pt-10 pb-10"
                            style="display: flex; justify-content: center; align-items: center; width: 100%; font-size: 18px; ">
                                No data
                        </div>
                    </li>`
                )
            }

            if (historyTeamArray.length > 0) {
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
                                        ${item.departmentName} <!-- หรือใช้ข้อมูลอื่นจาก item -->
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
            } else {
                historyTeamList.append(
                    `<li class="schedule-item mt-5" role="button" tabindex="0">
                            <div class="row pt-10 pb-10"
                                style="display: flex; justify-content: center; align-items: center; width: 100%; font-size: 18px; ">
                                    No data
                            </div>
                    </li>`
                )
            }

        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText); // ดูข้อความผิดพลาดจากเซิร์ฟเวอร์
            alert("เกิดข้อผิดพลาดในการโหลดข้อมูล");
        }
    });
}
</script>