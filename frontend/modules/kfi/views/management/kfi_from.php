<?php
// ตรวจสอบว่าข้อมูล branchId มีอยู่จริงหรือไม่
$branchIds = [];

foreach ($data as $key => $value) {
    if (is_array($value) && isset($value['branchId'])) {
        $branchIds[] = $value['branchId'];
    }
}
?>

<style>
/* เปลี่ยนสีข้อความของ select เมื่อเลือกแล้ว */
select.form-select {
    color: var(--Helper-Text-Gray, #8A8A8A);
}

/* เมื่อเลือกแล้วให้ข้อความเป็นสี #30313D */
select.form-select:not([value=""]) {
    color: var(--HRVC---Text-Black, #8A8A8A);
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
                    <a href="<?= Yii::$app->request->referrer ? Yii::$app->request->referrer : Yii::$app->homeUrl . 'kfi/management/grid' ?>"
                        class="mr-5 font-size-12">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/back.svg">
                        <text class="pim-text-back">
                            <?= Yii::t('app', 'Back') ?>
                        </text>
                    </a>
                    <text class="pim-name-title">
                        Create Key Financial Indicator
                    </text>
                </div>
                <div class="col-4" style="display: flex; justify-content: center; align-items: center; gap: 20px;">
                    <div style="display: flex; gap: 14px; flex-direction: column;">
                        <text class="current-ratio text-end">
                            <?= Yii::t('app', 'Current Achievement Ratio') ?>
                        </text>
                        <text class="current-ratio-data text-end">
                            <?= Yii::t('app', 'no Data') ?>
                        </text>
                    </div>
                    <div style="width: 10%;">
                        <svg viewBox="0 0 36 36" class="circular-chart-create">
                            <path class="circle-bg" d="M18 2.0845
                                                a 15.9155 15.9155 0 0 1 0 31.831
                                                a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <path class="circle" stroke-dasharray="0, 100" d="M18 2.0845
                                                a 15.9155 15.9155 0 0 1 0 31.831
                                                a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <!-- <text> สำหรับการแสดงเปอร์เซ็นต์ -->
                            <text x="18" y="20.35" text-anchor="middle" dominant-baseline="middle" class="percentage">
                                0%
                            </text>
                        </svg>
                    </div>
                    <div style="width: 1px; background-color: #BBCDDE; height: 51px;"></div>
                    <div style="display: flex; align-items: center; gap: 22px;">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/reward.svg">
                        <text class="pim-total-reward">
                            000
                        </text>
                    </div>
                </div>
            </div>
            <form id="kfiForm" action="" method="POST">

                <div class="contrainer-body-detail">
                    <div style="flex: 1;">
                        <div class="form-group"
                            style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                            <label class="text-manage-create" for="name">
                                <span class="text-danger">* </span>
                                Name <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                    data-toggle="tooltip" data-placement="top"
                                    title="Enter the name of your key financial indicator. This should be clear and specific, such as 'Total Sales,or 'Profit Margin">
                            </label>
                            <input type="text" class="form-control" id="kfiName" name="kfiName"
                                value="<?= isset($data['kfiName']) ? htmlspecialchars($data['kfiName']) : '' ?>"
                                placeholder="Please Write the Name of Component" required>

                        </div>

                        <div class="form-group mt-39"
                            style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                            <label class="text-manage-create" for="name">
                                <span class="text-danger">* </span>
                                Select Company <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                    data-toggle="tooltip" data-placement="top"
                                    title="Choose the company for which this financial indicator will be tracked. Only one company can be selected at a time to ensure accurate and focused performance monitoring."
                                    alt="Help Icon">
                            </label>
                            <select class="form-select" name="company" id="companyId"
                                onchange="javascript:companyMultiBrachKfi()" required>
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

                        <div class="form-group mt-39"
                            style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">

                            <div class="form-group "
                                style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">

                                <label class="text-manage-create" for="my-input">
                                    <span class="text-danger">* </span>
                                    Select Branch/s <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                        data-toggle="tooltip" data-placement="top"
                                        title="Select the relevant branches where this indicator will be monitored. You can choose multiple branches to track performance across different locations."
                                        alt="Help Icon">
                                </label>
                                <?php if($statusfrom =='update'){
                                        echo $kfiBranchText ;
                                        }else { ?>
                                <div class="form-control" id="multi-branch" style="width: 426px;">
                                    <span id="multi-branch-text"><?= Yii::t('app', 'Select Branches') ?></span>

                                    <div class="col-12" <?php if($statusfrom == 'update'): ?>
                                        id="show-multi-branch-update" <?php else: ?> id="show-multi-branch"
                                        <?php endif; ?>
                                        style="position: absolute; top: 100%; left: 0; width: 100%; z-index: 999; background-color: white; border: 1px solid #ced4da; padding: 10px; display: none;">
                                    </div>
                                    <i class="fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>
                                </div>
                                <?php } ?>

                                <div>
                                    <div class="circle-container pl-15" id="kfi-branches" data-type="branch">
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
                                            No Branches are Selected Yet
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-71"
                            style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                            <label class="text-manage-create" for="name">
                                <span class="text-danger">* </span>
                                Select Department/s <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                    data-toggle="tooltip" data-placement="top"
                                    title="Choose the departments that will be responsible for this financial indicator. Multiple departments can be selected for cross-functional tracking."
                                    alt="Help Icon">
                            </label>
                            <div class="form-control" id="multi-department" style="width: 100%">
                                <span id="multi-department-text"><?= Yii::t('app', 'Select Department') ?></span>
                                <div class="col-12" id="show-multi-department"
                                    style="position: absolute; top: 100%; left: 0; width: 100%; z-index: 999; background-color: white; border: 1px solid #ced4da; padding: 10px; display: none;">
                                </div>
                                <i class="fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>
                            </div>
                            <div>
                                <div class="circle-container pl-15" id="kfi-departments" data-type="department">
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
                    <div style="flex: 1;">
                        <div class="form-group"
                            style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                            <label class="text-manage-create" for="name">
                                <span class="text-danger">* </span>
                                Update Interval <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                    data-toggle="tooltip" data-placement="top"
                                    title="Select how frequently this indicator should be updated: Monthly, Quarterly, Half Yearly, or Yearly. This determines the reporting cycle."
                                    alt="Help Icon">
                            </label>
                            <div class="btn-group  col-12" role="group" aria-label="Basic outlined example">
                                <?php
								if (isset($units) && count($units) > 0) {
									$i = 1;
									foreach ($units as $unit) :
										$style = "";
										$default = "";
										if ($i >= 2) {
											$style = "background-color: rgb(255, 255, 255);  color: #6E6E6E; border-bottom: 3px solid #94989C;";
										}
                                        if ($i >= 4) {
											$style = "background-color: rgb(255, 255, 255); border-radius:0 5px 5px 0; color: #6E6E6E; border-bottom: 3px solid #94989C;";
										}
										if ($i == 1) {
											$style = 'background-color: rgb(255, 255, 255);  color: #6E6E6E;  border-bottom: 3px solid #94989C;';
										}
								?>
                                <button type="button" id="unit-<?= $unit['unitId'] ?>" class="btn col-3  font-size-12 "
                                    onclick="javascript:selectUnit(<?= $unit['unitId'] ?>)" style="<?= $style ?>">
                                    <?= Yii::t('app', $unit["unitName"]) ?>
                                </button>
                                <?php
										$i++;
									endforeach;
								}
								?>
                                <input type="hidden" value="1" id="currentUnit" name="unit" required>
                                <input type="hidden" value="1" id="previousUnit" required>
                            </div>
                        </div>

                        <div class="form-group mt-37"
                            style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                            <label class="text-manage-create" for="name">
                                <span class="text-danger">* </span>
                                Month & Year <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                    data-toggle="tooltip" data-placement="top"
                                    title="Select the specific month and year for which you're entering or viewing data. This helps in maintaining chronological records."
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
                                <input type="hidden" id="hiddenMonth" name="month">
                                <input type="hidden" id="hiddenYear" name="year">
                            </div>

                            <!-- Popup for Month/Year Selection -->
                            <div id="monthYearPicker" class="mount-year">
                                <select id="monthSelect" class="form-select" onchange="closeDatePicker()">
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
                                    onchange="closeDatePicker()">
                                    <!-- ปีที่ถูกสร้างจะถูกเพิ่มที่นี่ -->
                                </select>
                            </div>
                        </div>

                        <div class="form-group mt-37"
                            style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                            <label class="text-manage-create" for="name">
                                <span class="text-danger">* </span>
                                Due Term <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                    data-toggle="tooltip" data-placement="top"
                                    title="Set the start and end dates for the measurement period. This defines the timeframe for achieving the target."
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
                            <input type="hidden" id="fromDate" name="fromDate">
                            <input type="hidden" id="toDate" name="toDate">

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
                                Target Due Update Date <img
                                    src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top"
                                    title="Specify the deadline by which the final data must be updated in the system. This ensures timely reporting."
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
                                <input type="hidden" id="nextDate" name="nextCheckDate">
                            </div>
                            <div id="calendar-due-update"
                                style="position: absolute; margin-top: 75px; padding: 10px; border: 1px solid rgb(221, 221, 221); border-radius: 10px; background: rgb(255, 255, 255); width: 100%; z-index: 1; display: none; justify-content: center; align-items: center;">
                                <div id="updateDatePicker" style="display: none;"></div>
                            </div>
                        </div>

                        <div class=" form-group mt-37"
                            style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                            <label class="text-manage-create" for="name">
                                <span class="text-danger">* </span>
                                Quant Ratio <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                    data-toggle="tooltip" data-placement="top"
                                    title="Select the measurement unit for your indicator (e.g., currency, percentage, or numerical value) to ensure consistent reporting."
                                    alt="Help Icon">
                            </label>
                            <select class="form-select" id="quantRatio-create" name="quanRatio" required>
                                <!-- <option value=""><?= Yii::t('app', 'Quantity') ?> <?= Yii::t('app', 'or') ?>
                                    <?= Yii::t('app', 'Quality') ?></option> -->
                                <option value=""><?= Yii::t('app', 'Select the Measurement Unit') ?></option>
                                <option value="1"><?= Yii::t('app', 'Quantity') ?></option>
                                <option value="2"><?= Yii::t('app', 'Quality') ?></option>
                            </select>
                            <input type="hidden" name="kfiId" id="kfiId" value="">
                        </div>

                        <div class="form-group mt-37" style="display: flex; gap: 14px; flex-wrap: wrap;">
                            <!-- Left side (Data Type) -->
                            <div class="col-lg-6 col-md-6 col-6 mt-10" style="flex-basis: 48%; box-sizing: border-box;">
                                <label class="text-manage-create" for="name">
                                    <span class="text-danger">* </span>
                                    Data Type <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                        data-toggle="tooltip" data-placement="top"
                                        title="Choose the type of data being tracked (e.g., numbers, percentages, currency) to ensure proper formatting and calculations."
                                        alt="Help Icon">
                                </label>
                                <select class="form-select" id="amountType-create" name="amountType" required>
                                    <!-- <option value="">% <?= Yii::t('app', 'or') ?> <?= Yii::t('app', 'Number') ?>
                                    </option> -->
                                    <option value="">Select</option>
                                    <option value="1">%</option>
                                    <option value="2"><?= Yii::t('app', 'Number') ?></option>
                                </select>
                            </div>

                            <!-- Right side (Success Condition) -->
                            <div class="col-lg-6 col-md-6 col-6 mt-10" style="flex-basis: 48%; box-sizing: border-box;">
                                <label class="text-manage-create" for="name">
                                    <span class="text-danger">* </span>
                                    Success Condition <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                        data-toggle="tooltip" data-placement="top"
                                        title="Define the criteria for success (e.g., Greater Than, Less Than, Equal To) to measure achievement against the target."
                                        alt="Help Icon">
                                </label>
                                <select class="form-select" id="code-create" name="code" required>
                                    <option value="">Select</option>
                                    <option value="<">
                                        &nbsp;&nbsp;<?= '<' ?>&nbsp;&nbsp;<?= Yii::t('app', 'Result more than target') ?>
                                    </option>
                                    <option value="=">
                                        &nbsp;&nbsp;=&nbsp;&nbsp;<?= Yii::t('app', 'Result equal target') ?>
                                    </option>
                                    <option value=">">
                                        &nbsp;&nbsp;>&nbsp;&nbsp;<?= Yii::t('app', 'Result less than target') ?>
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div style="flex: 1;">
                        <div class="form-group"
                            style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                            <label class="text-manage-create" for="name">
                                <span class="text-danger">* </span>
                                Master Target <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg"
                                    data-toggle="tooltip" data-placement="top"
                                    title="Enter the overall target value that needs to be achieved within the specified period."
                                    alt="Help Icon">
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"
                                    style="background-color:rgb(255, 255, 255); border-right: none; padding: 20px;">
                                    <img src="/HRVC/frontend/web/image/target-blue.svg" alt="LinkedIn"
                                        style="width: 30px; height: 30px;">
                                </span>
                                <input type="number" class="form-control" name="amount" step="any"
                                    placeholder="Enter Target Amount"
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
                                        data-toggle="tooltip" data-placement="top"
                                        title="View or enter the actual achieved value. This field compares performance against the master target."
                                        alt="Help Icon">
                                </div>
                                <div class="updatehistory" style="text-align: right;">
                                    <img src="<?= Yii::$app->homeUrl ?>image/refes-blue.svg">Update History
                                </div>
                            </label>

                            <div class="input-group">
                                <span class="input-group-text"
                                    style="background-color:rgb(255, 255, 255); border-right: none; padding: 20px;">
                                    <img id="result-icon" src="<?= Yii::$app->homeUrl ?>image/result-gray.svg"
                                        alt="LinkedIn" style="width: 30px; height: 30px;">
                                </span>
                                <input type="number" class="form-control" name="result" id="result-update"
                                    style="border-left: none; font-size: 22px; font-style: normal; font-weight: 600;"
                                    required oninput="updateIcon(this)">
                            </div>

                            <div
                                style="display: flex; justify-content: space-between; width: 100%; align-items: center;">
                                <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                                    <!-- <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
                                    <label class="sub-manage-create" id="branch-selected-message">
                                        Historic Update
                                    </label> -->
                                </div>
                                <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                                    <!-- <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
                                    <label class="sub-manage-create" id="branch-selected-message">
                                        Override
                                    </label> -->
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
                                        data-toggle="tooltip" data-placement="top"
                                        title="This is the  Details description for the icon" alt="Help Icon">
                                </div>
                            </label>
                            <textarea class="form-control" name="detail" style="height: 165px;" rows="4"></textarea>
                        </div>

                        <div class="form-group mt-42"
                            style="display: flex; align-items: flex-end; justify-content: flex-end; gap: 12px; width: 100%;">
                            <?php 
                                // $status = 'create';
                                // $statusfrom = 'update';

                                if($statusfrom == 'update'){
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
                                    18/12/2024
                                </text>
                            </div>
                            <div>
                                <select class="select-create-status" aria-label="Default select example" name="status"
                                    required="">
                                    <option value="1">Completed</option>
                                    <option value="2">In-Progress</option>
                                </select>
                            </div>
                            <?php
                            }
                            ?>
                            <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="btn-create-cancle"
                                style="width: 100px;">
                                Cancel
                            </a>
                            <?php 
                                if($statusfrom == 'update'){
                            ?>
                            <button type="submit" class="btn-create-update" style="width: 100px;">
                                <img src="<?= Yii::$app->homeUrl ?>image/updatebtn-white.svg" alt="LinkedIn"
                                    style="width: 16px; height: 16px;">
                                Update
                            </button>
                            <?php }else{ ?>
                            <button type="submit" class="btn-create-update" style="width: 100px;">
                                Create
                                <img src="<?= Yii::$app->homeUrl ?>image/create-btn-white.svg" alt="LinkedIn"
                                    style="width: 16px; height: 16px;">
                            </button>
                            <?php } ?>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php if($statusfrom == 'update'){
    ?>
<input type="hidden" value="update" id="acType">
<?
} else {
?>
<input type="hidden" value="create" id="acType">
<? } ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {

    var statusFrom = '<?= $statusfrom ?>';
    var branchIds = <?= json_encode($branchIds) ?>;

    // alert(branchIds);

    if (statusFrom == 'update') {
        // บันทึกค่า branchIds ลงใน LocalStorage
        localStorage.setItem("branchIds", JSON.stringify(branchIds));

        // เรียกใช้งานฟังก์ชันในไฟล์ .js
        // companyMultiBrachKfi();
    }
    // คำนวณปีปัจจุบัน
    const currentYear = new Date().getFullYear();

    // คำนวณช่วงปี
    const startYear = currentYear - 1; // ปีเริ่มต้น
    const endYear = startYear + 10; // ปีสิ้นสุด

    // เลือก <select> โดย id
    const yearSelect = document.getElementById('yearSelect');

    // สร้างตัวเลือกปี
    for (let year = startYear; year <= endYear; year++) {
        const option = document.createElement('option');
        option.value = year;
        option.textContent = year;
        yearSelect.appendChild(option);
    }

    // Toggle multi-branch dropdown visibility
    $("#multi-branch").on("click", function(e) {
        var targetDropdown = (statusFrom == 'update') ? "#show-multi-branch-update" :
            "#show-multi-branch";
        $(targetDropdown).toggle();
        $(".toggle-icon").toggleClass("fa-angle-down fa-angle-up"); // Change icon
        e.stopPropagation();
    });

    // Prevent hiding dropdown when clicking inside it
    $("#show-multi-branch, #show-multi-branch-update").on("click", function(e) {
        e.stopPropagation();
    });

    // Hide dropdown when clicking outside
    $(document).on("click", function() {
        var targetDropdown = (statusFrom == 'update') ? "#show-multi-branch-update" :
            "#show-multi-branch";
        $(targetDropdown).hide();
        $(".toggle-icon").addClass("fa-angle-down").removeClass("fa-angle-up");
    });



    // Toggle multi-department dropdown visibility
    $("#multi-department").on("click", function(e) {
        $("#show-multi-department").toggle();
        $(".toggle-icon").toggleClass("fa-angle-down fa-angle-up"); // Change icon
        e.stopPropagation();
    });

    // Prevent hiding dropdown when clicking inside it
    $("#show-multi-department").on("click", function(e) {
        e.stopPropagation();
    });

    // Hide dropdown when clicking outside
    $(document).on("click", function() {
        $("#show-multi-department").hide();
        $(".toggle-icon").addClass("fa-angle-down").removeClass("fa-angle-up");
    });


    // ฟังก์ชันสำหรับแสดง/ซ่อนปฏิทิน
    document.getElementById('multi-due-term').addEventListener('click', function() {
        const calendarPopup = document.getElementById('calendar-due-term');
        // Toggle แสดง/ซ่อน
        calendarPopup.style.display = (calendarPopup.style.display === 'none' || calendarPopup
            .style
            .display === '') ? 'flex' : 'none';
    });

    // ซ่อนปฏิทินเมื่อคลิกภายนอก
    document.addEventListener('click', function(event) {
        const calendarPopup = document.getElementById('calendar-due-term');
        const dueTerm = document.getElementById('multi-due-term');

        if (!calendarPopup.contains(event.target) && !dueTerm.contains(event.target)) {
            calendarPopup.style.display = 'none';
        }
    });

    // ฟังก์ชันแสดง/ซ่อนปฏิทิน
    document.getElementById('multi-due-update').addEventListener('click', function() {
        const calendarPopup = document.getElementById('calendar-due-update');
        calendarPopup.style.display = (calendarPopup.style.display === 'none' || calendarPopup
                .style
                .display === '') ?
            'flex' :
            'none';
    });

    // ซ่อนปฏิทินเมื่อคลิกภายนอก
    document.addEventListener('click', function(event) {
        const calendarPopup = document.getElementById('calendar-due-update');
        const dueUpdate = document.getElementById('multi-due-update');
        if (!calendarPopup.contains(event.target) && !dueUpdate.contains(event.target)) {
            calendarPopup.style.display = 'none';
        }
    });


    $('#companyId').on('change', function() {
        // ตรวจสอบว่ามีการเลือกค่าใดๆ ใน select หรือไม่
        if ($(this).val() !== "") {
            // เปลี่ยนสีของข้อความ placeholder ให้เป็น #30313D เมื่อมีการเลือก
            $(this).css('color', '#30313D');
        } else {
            // คืนค่าค่าปกติ (สีเทา) เมื่อไม่มีการเลือก
            $(this).css('color', 'var(--Helper-Text-Gray, #8A8A8A)');
        }
    });
    $('#quantRatio-create').on('change', function() {
        // ตรวจสอบว่ามีการเลือกค่าใดๆ ใน select หรือไม่
        if ($(this).val() !== "") {
            // เปลี่ยนสีของข้อความ placeholder ให้เป็น #30313D เมื่อมีการเลือก
            $(this).css('color', '#30313D');
        } else {
            // คืนค่าค่าปกติ (สีเทา) เมื่อไม่มีการเลือก
            $(this).css('color', 'var(--Helper-Text-Gray, #8A8A8A)');
        }
    });
    $('#amountType-create').on('change', function() {
        // ตรวจสอบว่ามีการเลือกค่าใดๆ ใน select หรือไม่
        if ($(this).val() !== "") {
            // เปลี่ยนสีของข้อความ placeholder ให้เป็น #30313D เมื่อมีการเลือก
            $(this).css('color', '#30313D');
        } else {
            // คืนค่าค่าปกติ (สีเทา) เมื่อไม่มีการเลือก
            $(this).css('color', 'var(--Helper-Text-Gray, #8A8A8A)');
        }
    });
    $('#code-create').on('change', function() {
        // ตรวจสอบว่ามีการเลือกค่าใดๆ ใน select หรือไม่
        if ($(this).val() !== "") {
            // เปลี่ยนสีของข้อความ placeholder ให้เป็น #30313D เมื่อมีการเลือก
            $(this).css('color', '#30313D');
        } else {
            // คืนค่าค่าปกติ (สีเทา) เมื่อไม่มีการเลือก
            $(this).css('color', 'var(--Helper-Text-Gray, #8A8A8A)');
        }
    });

    $('[data-toggle="tooltip"]').tooltip(); // เปิดใช้งาน Tooltip

});
</script>