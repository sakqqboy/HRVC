<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;
// if ($statusform == 'update') {
//     $parturl = 'kpi/management/update-kpi';
// } else {
//     $parturl = 'kpi/management/create-kpi';
// }
    $parturl = 'kpi/kpi-team/update-kpi-team';
?>

<?php $form = ActiveForm::begin([
    'id' => 'create-kpi',
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data'
    ],
    'action' => Yii::$app->homeUrl . $parturl
]); 

$percentage = isset($data['ratio']) ? $data['ratio'] : 00;
$result = $data['result'] ?? 0;
$value = isset($data['result']) ? $data['result'] : 0;
$sumvalue = isset($kpi['sumresult']) ? $kpi['sumresult'] : 0;
$targetAmount = $data['targetAmount'] ?? 0;
$kpiHistoryId = $kpi['kpiHistoryId'] ?? 0;
$DueBehind = $targetAmount -  $result;


// แปลงวันที่จาก string ให้เป็น DateTime object
$nextCheckDate = DateTime::createFromFormat('d M Y', $kpi['nextCheckText']);
// หาวันที่ปัจจุบัน
$currentDate = new DateTime();
// คำนวณความแตกต่างระหว่างวันที่ปัจจุบันและวันที่ที่กำหนด
$interval = $currentDate->diff($nextCheckDate);
// แสดงจำนวนวันที่เหลือ
$daysLeft = $interval->format('%r%a'); // %r คือการแสดงเครื่องหมายบวกหรือลบ
if ($daysLeft < 0) {
    echo "Due Pass";
} else {
    echo "$daysLeft days left";
}
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
                <div style="flex: 1;">
                    <div class="form-group start-center" style="  gap: 14px;">
                        <label class="text-black" for="name" style="font-size: 22px; font-weight: 600;">
                            <?= isset($data['kpiName']) ? $data['kpiName'] : '' ?>
                        </label>
                    </div>

                    <div class="form-group start-center mt-25" style="gap: 14px;">
                        <label class="text-gray" for="name" style="font-size: 14px; font-weight: 400;">
                            <?= Yii::t('app', 'KPI Details') ?>
                        </label>
                        <text class="text-black" style="font-size: 14px; font-weight: 400; height: 147px;">
                            <?= !empty($data['kpiDetail']) ? $data['kpiDetail'] : 'No details listed' ?>
                        </text>
                    </div>

                    <div class="form-group start-center mt-42" style="  gap: 14px;">
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
                    <div class="form-group start-center mt-42" style="  gap: 14px;">
                        <label class="text-gray" for="name" style="font-size: 14px; font-weight: 400;">
                            <?= Yii::t('app', 'Assigned Branches') ?>
                        </label>
                        <div class="circle-container pl-15" style="display: flex;
                                    align-items: center;
                                    gap: 5px;
                                    padding-left: 15px;">
                            <?php  if(count($kpiBranch) >= 1 ){ ?>
                            <div class="cycle-current">
                                <img src="<?= Yii::$app->homeUrl ?>image/branches.svg" alt="icon">
                            </div>
                            <?php }
                            if(count($kpiBranch) >= 2 ){ ?>
                            <div class="cycle-current">
                                <img src="<?= Yii::$app->homeUrl ?>image/branches.svg" alt="icon">
                            </div>
                            <?php }
                            if(count($kpiBranch) >= 3 ){ ?>
                            <div class="cycle-current">
                                <img src="<?= Yii::$app->homeUrl ?>image/branches.svg" alt="icon">
                            </div>
                            <?php } ?>
                            <div class="cycle-current-white" style="color: #000; right: 15px;">
                                <?= count($kpiBranch) ?>
                            </div>
                            <text class="text-black" style="font-size: 18px; font-weight: 500;">
                                <?= Yii::t('app', 'Assigned on') ?>
                                <?= count($kpiBranch) ?>
                                <?= Yii::t('app', 'Branches') ?>
                            </text>
                        </div>
                    </div>
                    <div class="form-group start-center mt-42" style="  gap: 14px;">
                        <label class="text-gray" for="name" style="font-size: 14px; font-weight: 400;">
                            <?= Yii::t('app', 'Assigned Department/s') ?>
                        </label>
                        <div class="circle-container pl-15" style="display: flex;
                                    align-items: center;
                                    gap: 5px;
                                    padding-left: 15px;">
                            <?php  if(count($kpiDepartment) >= 1 ){ ?>
                            <div class="cycle-current">
                                <img src="<?= Yii::$app->homeUrl ?>image/departments.svg" alt="icon">
                            </div>
                            <?php }
                            if(count($kpiDepartment) >= 2 ){ ?>
                            <div class="cycle-current">
                                <img src="<?= Yii::$app->homeUrl ?>image/departments.svg" alt="icon">
                            </div>
                            <?php }
                            if(count($kpiDepartment) >= 3 ){ ?>
                            <div class="cycle-current">
                                <img src="<?= Yii::$app->homeUrl ?>image/departments.svg" alt="icon">
                            </div>
                            <?php } ?>
                            <div class="cycle-current-white" style="color: #000; right: 15px;">
                                <?= count($kpiDepartment) ?>
                            </div>
                            <text class="text-black" style="font-size: 18px; font-weight: 500;">
                                <?= Yii::t('app', 'Assigned on') ?>
                                <?= count($kpiDepartment) ?>
                                <?= Yii::t('app', 'Departments') ?>
                            </text>
                        </div>
                    </div>
                </div>
                <div style="flex: 1;">
                    <div class="form-group start-center mt-42" style="  gap: 14px;">
                        </br>
                        </br>
                    </div>
                    <div class="form-group mt-4 d-flex flex-column align-items-start gap-3">
                        </br>
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
                                    <label
                                        style="font-size: 20px; font-weight: 500;"><?= $daysLeft ?><?= Yii::t('app', 'days left') ?></label><br>
                                    <label
                                        style="font-size: 14px; font-weight: 500;"><?= $kpi["nextCheckText"] ?></label>
                                </div>
                            </div>
                        </div>
                        </br>
                    </div>

                    <div class="form-group mt-42 d-flex flex-column align-items-center gap-3">
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



                    <div class="form-group start-center mt-42" style="  gap: 14px;">
                        <label class="text-gray" for="name" style="font-size: 14px; font-weight: 400;">
                            <?= Yii::t('app', 'Assigned Team/s') ?>
                        </label>
                        <div class="circle-container pl-15" data-type="branch" style="display: flex;
                                    align-items: center;
                                    gap: 5px;
                                    padding-left: 15px;">
                            <?php  if(count($kpiTeam) >= 1 ){ ?>
                            <div class="cycle-current">
                                <img src="<?= Yii::$app->homeUrl ?>image/teams.svg" alt="icon">
                            </div>
                            <?php }
                            if(count($kpiTeam) >= 2 ){ ?>
                            <div class="cycle-current">
                                <img src="<?= Yii::$app->homeUrl ?>image/teams.svg" alt="icon">
                            </div>
                            <?php }
                            if(count($kpiTeam) >= 3 ){ ?>
                            <div class="cycle-current">
                                <img src="<?= Yii::$app->homeUrl ?>image/teams.svg" alt="icon">
                            </div>
                            <?php } ?>
                            <div class="cycle-current-white" style="color: #000; right: 15px;">
                                <?= count($kpiTeam) ?>
                            </div>
                            <text class="text-black" style="font-size: 18px; font-weight: 500;">
                                <?= Yii::t('app', 'Assigned on') ?>
                                <?= count($kpiTeam) ?>
                                <?= Yii::t('app', 'Teams') ?>
                            </text>
                        </div>
                    </div>
                    <div class="form-group start-center mt-42" style="  gap: 14px;">
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
                            <input type="number" class="form-control text-end" name="result" id="result-update"
                                value="<?= isset($data['result']) ? $data['result'] : '' ?>"
                                style="border-left: none; font-size: 22px; font-style: normal; font-weight: 600;"
                                required oninput="updateIcon(this),updateResultValue(this)">
                            <input type="hidden" name="resultValue" id="result-cheng"
                                value="<?= isset($data['result']) ? $data['result'] : '' ?>">
                        </div>


                        <div class="between-center" style="  width: 100%; ">
                            <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                                <label class="switch">
                                    <input type="checkbox" id="historic-checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                                <label class="sub-manage-create" id="historic-switch">
                                    <?= Yii::t('app', 'Historic Update') ?>
                                </label>
                            </div>
                            <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                                <label class="switch">
                                    <input type="checkbox" id="override-checkbox">
                                    <span class="slider round"></span>
                                </label>
                                <label class="sub-manage-create" id="override-switch">
                                    <?= Yii::t('app', 'Override') ?>
                                </label>
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
                            <div class="textbox-check-blue" style="display: flex; gap: 12px;">
                                <div class="mid-center" style="flex-basis: 5%;">
                                    <input type="checkbox" id="check1" name="status" value="1" class="status-checkbox"
                                        checked style="width: 22px; height: 22px;">
                                </div>
                                <div class="mid-center" style="flex-basis: 25%; margin-right: 20px;">
                                    <div class="border-cicle  bg-white text-blue-sea"
                                        style="border: 0.5px solid #2F42ED; font-size: 14px; font-weight: 600;">
                                        <?= Yii::t('app', 'In-Progress') ?>
                                    </div>
                                </div>
                                <div style="flex-basis: 70%;">
                                    <text class="text-blue-sea">
                                        <?= Yii::t('app', "The task is currently being addressed. Ensure it's marked completed before the due date to avoid it being automatically listed as overdue.") ?>
                                    </text>
                                </div>
                            </div>

                            <div class="textbox-check-green" style="display: flex; gap: 12px; margin-top: 10px;">
                                <div class="mid-center" style="flex-basis: 5%;">
                                    <input type="checkbox" id="check2" name="status" value="2" class="status-checkbox"
                                        style="width: 22px; height: 22px;">
                                </div>
                                <div class="mid-center" style="flex-basis: 25%; margin-right: 20px;">
                                    <div class="border-cicle  bg-white text-green"
                                        style="border: 0.5px solid #2D7F06; font-size: 14px; font-weight: 600;">
                                        <?= Yii::t('app', "Completed") ?>
                                    </div>
                                </div>
                                <div style="flex-basis: 70%;">
                                    <text class="text-green">
                                        <?= Yii::t('app', "The Component has not been completed") ?>
                                    </text>
                                </div>
                            </div>
                            <div class="textbox-check-orang">
                                <div class="mid-center" style="flex-basis: 5%;  ">
                                    <img src="<?= Yii::$app->homeUrl ?>image/warning-orang.svg" alt="LinkedIn"
                                        style="width: 20px; height: 20px;">
                                </div>
                                <div class="mid-center" style="flex-basis: 25%; margin-right: 20px;  ">
                                    <div class="border-cicle bg-white text-orang"
                                        style="border: 0.5px solid var(--Progress-Blue, #DD7A01); background: var(--100-white, #FFF); font-size: 14px; font-weight: 600;"
                                        for="check3">
                                        <?= Yii::t('app', "Due Passed") ?>
                                    </div>
                                </div>
                                <div style="flex-basis: 70%;">
                                    <text class="text-orang">
                                        <?= Yii::t('app', "This task component be automatically become due passed within 30 Days, if you
                                        don’t
                                        mark it as completed") ?>
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
                            <a href="<?= Yii::$app->homeUrl ?>kpi/management/grid" class="btn-create-cancle"
                                style="width: 100px;">
                                <img src="<?= Yii::$app->homeUrl ?>image/eye-login.svg" alt="LinkedIn"
                                    style="width: 16px; height: 16px;">
                                <?= Yii::t('app', 'View') ?>
                            </a>
                        </div>

                        <a href="<?= Yii::$app->homeUrl ?>kpi/management/grid" class="btn-create-cancle"
                            style="width: 100px;">
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
<input type="hidden" id="hiddenMonth" name="month" value="<?= htmlspecialchars($data['month'] ?? '') ?>" required>
<input type="hidden" id="hiddenYear" name="year" value="<?= htmlspecialchars($data['year'] ?? '') ?>" required>
<input type="hidden" id="fromDate" name="fromDate" value="<?= isset($data['fromDate']) ? $data['fromDate'] : '' ?>"
    required>
<input type="hidden" id="toDate" name="toDate" value="<?= isset($data['toDate']) ? $data['toDate'] : '' ?>" required>
<input type="hidden" id="kpiTeamId" name="kpiTeamId" value="<?= isset($kpiTeamId) ? $kpiTeamId : '' ?>" required>

<?php ActiveForm::end(); ?>
<?= $this->render('modal_history') ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
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
        overrideChecked(overrideCheckbox.checked, value);
    } else {
        overrideCheckbox.checked = true;
        // alert(1);
        overrideChecked(overrideCheckbox.checked, sumvalue);
    }
});

overrideCheckbox.addEventListener('change', function() {
    if (this.checked) {
        // alert(2);
        historicCheckbox.checked = false;
        overrideChecked(overrideCheckbox.checked, sumvalue);
    } else {
        // alert(3);
        historicCheckbox.checked = true;
        overrideChecked(overrideCheckbox.checked, value);
    }
});

// เช็คให้เลือกได้แค่ตัวเดียว
document.querySelectorAll('.status-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        document.querySelectorAll('.status-checkbox').forEach(cb => {
            if (cb !== this) {
                cb.checked = false; // เอาเช็คอันอื่นออก
            }
        });
    });
});

// ส่งเฉพาะค่าที่ถูกเช็ค
document.getElementById("statusForm").addEventListener("submit", function(event) {
    let selected = document.querySelector('.status-checkbox:checked');
    if (!selected) {
        alert("Please select a status before submitting!");
        event.preventDefault(); // หยุดการส่งฟอร์ม ถ้าไม่ได้เลือก
    }
});


function modalHistory(kpiId) {
    var url = $url + 'kpi/management/modal-history';
    // alert(0);
    var percentage = <?= json_encode($percentage) ?>;
    var result = <?= json_encode($result) ?>;
    var sumvalue = <?= json_encode($sumvalue) ?>;
    var targetAmount = <?= json_encode($targetAmount) ?>;
    var kpiHistoryId = <?= json_encode($kpiHistoryId) ?>;
    var month = document.getElementById("hiddenMonth").value;
    var year = document.getElementById("hiddenYear").value;
    var fromDateValue = document.getElementById("fromDate").value;
    var toDateValue = document.getElementById("toDate").value;
    var fromDate = new Date(fromDateValue);
    var toDate = new Date(toDateValue);
    var fromDay = fromDate.getDate();
    var toDay = toDate.getDate();
    var fromMonth = new Intl.DateTimeFormat('en-US', {
        month: 'long'
    }).format(fromDate);
    var toMonth = new Intl.DateTimeFormat('en-US', {
        month: 'long'
    }).format(toDate);
    var formattedRange = `${getOrdinalSuffix(fromDay)} ${fromMonth} - ${getOrdinalSuffix(toDay)} ${toMonth}`;
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
            formattedRange: formattedRange,
            kpiHistoryId: kpiHistoryId
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
            alert("เกิดข้อผิดพลาดในการโหลดข้อมูล");
        }
    });
}
</script>