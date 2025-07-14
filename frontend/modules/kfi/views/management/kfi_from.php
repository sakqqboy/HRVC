<?php

use yii\bootstrap5\ActiveForm;

$this->title = 'KFI';


if ($statusform == 'update') {
    $parturl = 'kfi/management/save-update-kfi';
} else {
    $parturl = 'kfi/management/create-kfi';
}
?>

<?php $form = ActiveForm::begin([
    'id' => 'create-kfi',
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data'
    ],
    'action' => Yii::$app->homeUrl . $parturl
]);
$unitId = 1;
if (isset($data['unitId']) && $data['unitId'] >= 1) {
    $unitId = $data['unitId'];
    // ทำสิ่งที่ต้องการเมื่อ unitId มีค่าเป็น 2
}
$quantRatio = $data['quantRatio'] ?? '';
$selectedCode = $data['code'] ?? '';
$selectedAmountType = $data['amountType'] ?? '';


$result = $data['result'] ?? 0;
$targetAmount = $data['targetAmount'] ?? 0;
$DueBehind = $targetAmount -  $result;
if ($DueBehind < 0) {
    $DueBehind = 0;
}
// echo $DueBehind;
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


<div class="col-12 mt-70 pt-20">
    <div class="d-flex justify-content-start pt-0 pb-0" style="line-height: 30px;">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Group23177.svg" class="pim-head-icon mr-11 mt-2">
        <span class="pim-head-text mr-10"> <?= Yii::t('app', 'Performance Indicator Matrices') ?> (PIM)</span>

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
                    <a href="<?= Yii::$app->request->referrer ? Yii::$app->request->referrer : Yii::$app->homeUrl . 'kfi/management/grid' ?>"
                        class="mr-5 font-size-12" style="text-decoration: none;">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/back.svg">
                        <text class="pim-text-back">
                            <?= Yii::t('app', 'Back') ?>
                        </text>
                    </a>
                    <text class="pim-name-title">
                        <?php if ($statusform == 'update') { ?>
                            <?= Yii::t('app', 'Update Key Financial Indicator') ?>
                        <?php } else { ?>
                            <?= Yii::t('app', 'Create Key Financial Indicator') ?>
                        <?php } ?>
                    </text>
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
                                <!-- Background circle -->
                                <path class="circle-bg"
                                    d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                    style="stroke: hsla(217, 100%, 91%, 1); stroke-width: 3;" fill="none" />


                                <!-- Foreground circle (progress) -->
                                <?php
                                $percentage = isset($data['ratio']) ? $data['ratio'] : 00;
                                // $dashArray = ($percentage * 100) / 100; // this will control the progress visually
                                ?>
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
                        <div style="width: 1px; background-color: #BBCDDE; height: 51px;" class="mr-10 ml-10 d-flex align-items-center border align-self-center"></div>
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
            <!-- <form id="kfiForm" action="" method="POST"> -->

            <div class="contrainer-body-detail mt-10">
                <div class="row" style="--bs-gutter-x:0px;">
                    <div class="col-lg-4 col-12 pr-30">
                        <div class="" style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                            <label class="text-manage-create" for="name">
                                <span class="text-danger">* </span>
                                Name <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                    data-toggle="tooltip" data-placement="top" class="tootip-icon"
                                    title="Enter the name of your key financial indicator. This should be clear and specific, such as 'Total Sales,or 'Profit Margin">
                            </label>
                            <input type="text" class="form-control" id="kfiName" name="kfiName"
                                value="<?= isset($data['kfiName']) ? htmlspecialchars($data['kfiName']) : '' ?>"
                                placeholder="Please Write the Name of Component" required>
                        </div>
                        <div class="form-group mt-39" style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                            <label class="text-manage-create" for="name">
                                <span class="text-danger">* </span>
                                Select Company <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                    data-toggle="tooltip" data-placement="top" class="tootip-icon"
                                    title="Choose the company for which this financial indicator will be tracked. Only one company can be selected at a time to ensure accurate and focused performance monitoring."
                                    alt="Help Icon">
                            </label>
                            <select class="form-select" name="company" id="companyId" onchange="javascript:companyMultiBrachKfi()" required>
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
                            <label class="sub-manage-create ml-3" id="department-selected-message">
                                No companies are selected yet
                            </label>
                        </div>
                        <div class="form-group mt-86" style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                            <label class="text-manage-create" for="my-input">
                                <span class="text-danger">* </span>
                                Select Branch/es <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                    data-toggle="tooltip" data-placement="top" class="tootip-icon"
                                    title="Select the relevant branches where this indicator will be monitored. You can choose multiple branches to track performance across different locations."
                                    alt="Help Icon">
                            </label>
                            <div class="form-control" id="multi-branch" style="width: 100%">
                                <span id="multi-branch-text"><?= Yii::t('app', 'Select Branches') ?></span>
                                <i class="toggle-icon-branch fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>
                            </div>

                            <div class="col-12" <?php if ($statusform == 'update'): ?> id="show-multi-branch-update"
                                <?php else: ?> id="show-multi-branch" <?php endif; ?> style="position: absolute; top: <?= ($statusform == 'create') ? '60%' : '60%'; ?>; 
                                    left: 0; width: 100%; z-index: 999; background-color: white; 
                                    border: 1px solid #ced4da; padding: 10px; display: none;">
                                <?php if ($statusform == 'create'): ?>
                                    <!-- สำหรับโหมด create ให้แสดงกล่องเปล่า -->
                                <?php else: ?>
                                    <?= $kfiBranchText; ?>
                                <?php endif; ?>

                            </div>
                            <div class="">
                                <div class="circle-container pl-15" id="image-branches" data-type="branch">
                                    <div class="cycle-current-gray">
                                        <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg" alt="icon">
                                    </div>
                                    <div class="cycle-current-gray">
                                        <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg" alt="icon">
                                    </div>
                                    <div class="cycle-current-gray">
                                        <img src="<?= Yii::$app->homeUrl ?>image/branches-black.svg" alt="icon">
                                    </div>
                                    <div class="cycle-current-gray" style="color: #000;" id="branch-selected-count">
                                        00
                                    </div>
                                    <label class="sub-manage-create" id="branch-selected-message">
                                        No branches are selected yet
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-71" style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                            <label class="text-manage-create" for="name">
                                <span class="text-danger">* </span>
                                Select Department/s <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                    data-toggle="tooltip" data-placement="top" class="tootip-icon"
                                    title="Choose the departments that will be responsible for this financial indicator. Multiple departments can be selected for cross-functional tracking."
                                    alt="Help Icon">
                            </label>
                            <div class="form-control" id="multi-department" style="width: 100%">
                                <span id="multi-department-text"><?= Yii::t('app', 'Select Department') ?></span>
                                <i class="toggle-icon-department fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>
                            </div>

                            <div class="col-12" <?php if ($statusform == 'update'): ?> id="show-multi-department-update"
                                <?php else: ?> id="show-multi-department" <?php endif; ?> style="position: absolute; top: 60%; left: 0; width: 100%; z-index: 999; background-color: white; 
                            border: 1px solid #ced4da; padding: 10px; display: none;">
                                <?php if ($statusform == 'create'): ?>
                                    <!-- สำหรับโหมด create ให้แสดงกล่องเปล่า -->
                                <?php else: ?>
                                    <?= $kfiDepartmentText; ?>
                                <?php endif; ?>
                            </div>

                            <div>
                                <div class="circle-container pl-15" id="image-departments" data-type="department">
                                    <div class="cycle-current-gray">
                                        <img src="<?= Yii::$app->homeUrl ?>image/departments-black.svg" alt="icon">
                                    </div>
                                    <div class="cycle-current-gray">
                                        <img src="<?= Yii::$app->homeUrl ?>image/departments-black.svg" alt="icon">
                                    </div>
                                    <div class="cycle-current-gray">
                                        <img src="<?= Yii::$app->homeUrl ?>image/departments-black.svg" alt="icon">
                                    </div>
                                    <div class="cycle-current-gray" style="color: #000;" id="department-selected-count">
                                        00
                                    </div>
                                    <label class="sub-manage-create" id="department-selected-message">
                                        No Departments are Selected Yet
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4  col-12">
                        <div class="" style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                            <label class="text-manage-create" for="name">
                                <span class="text-danger">* </span>
                                Update Interval <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                    data-toggle="tooltip" data-placement="top" class="tootip-icon"
                                    title="Select how frequently this indicator should be updated: Monthly, Quarterly, Half Yearly, or Yearly. This determines the reporting cycle."
                                    alt="Help Icon">
                            </label>
                            <div class="col-12" role="group" aria-label="Basic outlined example">
                                <div class="row" style="--bs-gutter-x:0px;">
                                    <?php
                                    if (isset($units) && count($units) > 0) {
                                        $i = 1;
                                        foreach ($units as $unit) :
                                            $activeClass = ($unitId == $unit['unitId']) ? 'unit-active' : 'unit-inactive';
                                            if ($i == 1) {
                                                $radius = "border-left-radius";
                                            } else if ($i == count($units)) {
                                                $radius = "border-right-radius";
                                            } else {
                                                $radius = "";
                                            }

                                    ?>
                                            <div id="unit-<?= $unit['unitId'] ?>"
                                                class="col-3 font-size-12 <?= $activeClass ?> <?= $radius ?> align-content-center text-center"
                                                onclick="selectUnit(<?= $unit['unitId'] ?>)">
                                                <?= Yii::t('app', $unit["unitName"]) ?>
                                            </div>
                                    <?php
                                            $i++;
                                        endforeach;
                                    }

                                    // echo  $unitId;
                                    ?>
                                </div>
                                <input type="hidden" value="<?= $unitId ?>" id="currentUnit" name="unit" required>
                                <input type="hidden" value="<?= $unitId ?>" id="previousUnit" required>
                            </div>
                        </div>
                        <div class="form-group mt-37" style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                            <label class="text-manage-create" for="name">
                                <span class="text-danger">* </span>
                                Month & Year <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                    data-toggle="tooltip" data-placement="top" class="tootip-icon"
                                    title="Select the specific month and year for which you're entering or viewing data. This helps in maintaining chronological records."
                                    alt="Help Icon">
                            </label>
                            <div class="input-group" style="position: relative;">
                                <span class="input-group-text"
                                    style="background-color: #C3C3C3;  border:0.5px solid #818181; border-radius: 36px; gap: 4px; z-index: 1; height:38px;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/calendar-gray.svg" alt="LinkedIn"
                                        style="width: 16px; height: 16px;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/weld-gray.svg" alt="LinkedIn"
                                        style="width: 16px; height: 16px;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/calendar-gray.svg" alt="LinkedIn"
                                        style="width: 16px; height: 16px;">
                                </span>
                                <div class="form-control" id="multi-mount-year" name="fromMonthYear"
                                    style="border-radius: 53px 53px 53px 53px; text-align: center; cursor: pointer; position: absolute; width: 100%;height:38px;"
                                    <?php //if ($statusform == 'create') { 
                                    ?> onclick="openDatePicker()" <?php //} 
                                                                    ?>>
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
                                <select id="monthSelect" class="form-select" onchange="closeDatePicker()">
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
                                    onchange="closeDatePicker()">
                                    <!-- ปีที่ถูกสร้างจะถูกเพิ่มที่นี่ -->
                                </select>
                            </div>
                        </div>

                        <div class="form-group mt-37" style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                            <label class="text-manage-create" for="name">
                                <span class="text-danger">* </span>
                                Due Term <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                    data-toggle="tooltip" data-placement="top" class="tootip-icon"
                                    title="Set the start and end dates for the measurement period. This defines the timeframe for achieving the target."
                                    alt="Help Icon">
                            </label>
                            <div class="col-12" id="img-due-term">
                                <div class="select-form-pim" id="multi-due-term" onclick="toggleCalendar()">
                                    <span class="calendar-due mr-3" id="calendar-dueterm">
                                        <img src="<?= Yii::$app->homeUrl ?>image/calendar-gray.svg" alt="from" class="calendar-due-image">
                                        <img src="<?= Yii::$app->homeUrl ?>image/weld-gray.svg" alt="-" class="calendar-due-image">
                                        <img src="<?= Yii::$app->homeUrl ?>image/calendar-gray.svg" alt="to" class="calendar-due-image">
                                    </span>
                                    <span class="d-flex" id="due-term-default">
                                        Select the Due Term Start & End Date
                                    </span>
                                    <i class="fa fa-angle-down" aria-hidden="true" style="position: absolute;right:0;margin-right:5px;"></i>
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

                        <div class="form-group mt-37"
                            style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                            <label class="text-manage-create" for="name">
                                <span class="text-danger">* </span>
                                Target Due Update Date <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                    data-toggle="tooltip" data-placement="top" class="tootip-icon"
                                    title="Specify the deadline by which the final data must be updated in the system. This ensures timely reporting."
                                    alt="Help Icon">
                            </label>
                            <div class="col-12" id="img-due-update">
                                <div class="select-form-pim" id="multi-due-update" onclick="toggleCalendar()">
                                    <span class="calendar-due mr-3" id="calendar-dueterm-update">
                                        <img src="<?= Yii::$app->homeUrl ?>image/calendar-gray.svg" alt="from" class="calendar-due-image">
                                        <img src="<?= Yii::$app->homeUrl ?>image/weld-gray.svg" alt="-" class="calendar-due-image">
                                        <img src="<?= Yii::$app->homeUrl ?>image/calendar-gray.svg" alt="to" class="calendar-due-image">
                                    </span>
                                    <span class="d-flex" id="due-update-default">
                                        Select the Last Update Date
                                    </span>
                                    <i class="fa fa-angle-down" aria-hidden="true" style="position: absolute;right:0;margin-right:15px;"></i>

                                    <!-- <input type="hidden" id="nextDate" name="nextCheckDate"> -->
                                </div>
                                <input type="hidden" id="nextDate" name="nextCheckDate" value="<?= isset($data['nextCheckDate']) ? $data['nextCheckDate'] : '' ?>">
                            </div>
                            <div id="calendar-due-update"
                                style="position: absolute; margin-top: 75px; padding: 10px; border: 1px solid rgb(221, 221, 221); border-radius: 10px; background: rgb(255, 255, 255); width: 100%; z-index: 1; display: none; justify-content: center; align-items: center;">
                                <div id="updateDatePicker" style="display: none;"></div>
                            </div>
                        </div>

                        <div class="form-group mt-37"
                            style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                            <label class="text-manage-create" for="name">
                                <span class="text-danger">* </span>
                                Quant Ratio <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                    data-toggle="tooltip" data-placement="top" class="tootip-icon"
                                    title="Select the measurement unit for your indicator (e.g., currency, percentage, or numerical value) to ensure consistent reporting."
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
                            <input type="hidden" name="kfiId" id="kfiId" value="<?= isset($kfiId) ? $kfiId : '' ?>">
                        </div>

                        <div class="d-flex justify-content-between mt-37 gap-1 border" style="--bs-gutter-x:0px;">
                            <div class="mt-10;" style="width:50%;">
                                <label class="text-manage-create" for="name">
                                    <span class="text-danger">* </span>
                                    Data Type <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                        data-toggle="tooltip" data-placement="top" class="tootip-icon"
                                        title="Choose the type of data being tracked (e.g., numbers, percentages, currency) to ensure proper formatting and calculations."
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
                            <div class="mt-10" style="">
                                <label class="text-manage-create" for="name">
                                    <span class="text-danger">* </span>
                                    Success Condition <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                        data-toggle="tooltip" data-placement="top"
                                        title="Define the criteria for success (e.g., Greater Than, Less Than, Equal To) to measure achievement against the target."
                                        alt="Help Icon" class="tootip-icon">
                                </label>
                                <select class="" id="code-create" name="code" required>
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
                    <div class="col-lg-4 col-12 pl-30">
                        <div class="form-group"
                            style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                            <label class="text-manage-create" for="name">
                                <span class="text-danger">* </span>
                                Master Target <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                    data-toggle="tooltip" data-placement="top"
                                    title="Enter the overall target value that needs to be achieved within the specified period."
                                    alt="Help Icon" class="tootip-icon">
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

                        <div class="form-group mt-42"
                            style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                            <label class="text-manage-create" for="name"
                                style="display: flex; justify-content: space-between; width: 100%; align-items: center;">
                                <div style="flex-grow: 1;">
                                    <span class="text-danger">* </span>
                                    Result <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                        data-toggle="tooltip" data-placement="top" class="tootip-icon"
                                        title="View or enter the actual achieved value. This field compares performance against the master target."
                                        alt="Help Icon">
                                </div>
                                <div class="updatehistory" style="text-align: right;">
                                    <!-- <img src="<?= Yii::$app->homeUrl ?>image/refes-blue.svg">Update History -->
                                </div>
                            </label>

                            <div class="input-group">
                                <span class="input-group-text"
                                    style="background-color:rgb(255, 255, 255); border-right: none; padding: 20px;">
                                    <img id="result-icon"
                                        src="<?= Yii::$app->homeUrl ?>image/result-<?= isset($data['result']) ? 'blue' : 'gray' ?>.svg"
                                        alt="LinkedIn" style="width: 30px; height: 30px;">
                                </span>
                                <input type="number" class="form-control text-end" name="result" id="result-update"
                                    value="<?= isset($data['result']) ? $data['result'] : 0 ?>"
                                    style="border-left: none; font-size: 22px; font-style: normal; font-weight: 600;"
                                    required step="any" oninput="updateIcon(this);">
                            </div>


                            <div style="display: flex; justify-content: space-between; width: 100%; align-items: center;">
                                <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                                </div>
                                <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-42"
                            style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                            <label class="text-manage-create" for="name"
                                style="display: flex; justify-content: space-between; width: 100%; align-items: center;">
                                <div style="flex-grow: 1;">
                                    <span class="text-danger">* </span>
                                    Details <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                        data-toggle="tooltip" data-placement="top" class="tootip-icon"
                                        title="This is the  Details description for the icon" alt="Help Icon">
                                </div>
                            </label>
                            <textarea class="form-control" name="detail" style="height: 165px;"
                                rows="4"><?= isset($data['detail']) ? $data['detail'] : '' ?></textarea>
                        </div>

                        <div class="form-group mt-42"
                            style="display: flex; align-items: flex-end; justify-content: flex-end; gap: 12px; width: 100%;">
                            <?php
                            // $status = 'create';
                            // $statusform = 'update';

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
                                        onchange="javascript:changeStatus()">
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
                            <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="btn-create-cancle"
                                style="width: 100px;text-decoration: none;">
                                Cancel
                            </a>
                            <?php
                            if ($statusform == 'update') {
                            ?>
                                <button type="submit" class="btn-create-update" style="width: 100px;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/updatebtn-white.svg" alt="LinkedIn"
                                        style="width: 16px; height: 16px;">
                                    Update
                                </button>
                            <?php } else { ?>
                                <!-- ปรับให้ปุ่มนี้เป็น type="submit" -->
                                <button type="submit" class="btn-create-update" style="width: 100px;">
                                    Create
                                    <img src="<?= Yii::$app->homeUrl ?>image/create-btn-white.svg" alt="LinkedIn"
                                        style="width: 16px; height: 16px;">
                                </button>
                            <?php } ?>
                        </div>

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
<?php ActiveForm::end(); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var statusform = '<?= $statusform ?>';
        // alert(statusform);

        if (statusform === 'update') {
            branchMultiDepartmentUpdateKfi();

            // ดึงค่า branchId ที่ถูก checked แล้ว
            var checkedBranchIds = [];
            $('input[name="branch[]"]:checked').each(function() {
                checkedBranchIds.push($(this).val());
            });

            // เรียกใช้งานฟังก์ชันสำหรับ branch ที่ถูก checked เท่านั้น
            checkedBranchIds.forEach(function(branchId) {
                // alert(branchId);
                departmentMultiTeamUpdateKfi(branchId);
            });
            let isSubmittingUpdate = false; // ป้องกัน submit ซ้ำ
            $("#update-kfi").on("beforeSubmit", function(event) {
                if (isSubmittingUpdate) {
                    return false; // ถ้ากำลัง submit อยู่ ไม่ให้ทำซ้ำ
                }
                isSubmittingUpdate = true;
                if (!validateFormKfi(acType)) {
                    isSubmittingUpdate = false; // ถ้า validation ไม่ผ่าน ให้เปิด submit ใหม่
                    return false;
                }
                return true; // ถ้า validation ผ่าน ให้ submit ฟอร์มต่อไป
            });
        }


        // ฟังก์ชันเปลี่ยนสีของ placeholder เมื่อมีการเลือกค่า
        function updatePlaceholderColor(selector) {
            $(selector).on('change', function() {
                $(this).css('color', $(this).val() !== "" ? '#30313D' : 'var(--Helper-Text-Gray, #8A8A8A)');
            });
        }

        // เรียกใช้งานฟังก์ชันกับ select หลายตัวพร้อมกัน
        updatePlaceholderColor('#companyId');
        updatePlaceholderColor('#quantRatio-create');
        updatePlaceholderColor('#amountType-create');
        updatePlaceholderColor('#code-create');

        $('[data-toggle="tooltip"]').tooltip(); // เปิดใช้งาน Tooltip

        var acType = document.getElementById('acType').value
        let isSubmitting = false; // ป้องกัน submit ซ้ำ
        $("#create-kfi").on("beforeSubmit", function(event) {
            if (isSubmitting) {
                return false; // ถ้ากำลัง submit อยู่ ไม่ให้ทำซ้ำ
            }
            isSubmitting = true;
            if (!validateFormKfi(acType)) {
                isSubmitting = false; // ถ้า validation ไม่ผ่าน ให้เปิด submit ใหม่
                return false;
            }
            return true; // ถ้า validation ผ่าน ให้ submit ฟอร์มต่อไป
        });

    });
</script>