<?php
use yii\bootstrap5\ActiveForm;
// if ($statusform == 'update') {
//     $parturl = 'kpi/management/update-kpi';
// } else {
//     $parturl = 'kpi/management/create-kpi';
// }
    $parturl = 'kpi/management/update-kpi';
?>

<?php $form = ActiveForm::begin([
    'id' => 'create-kpi',
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data',
        'onsubmit' => 'return validateFormKpi(event)' // เรียกฟังก์ชันตรวจสอบก่อนส่งฟอร์ม
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
$selectedPriority = isset($data['priority']) ? $data['priority'] : '';

$percentage = isset($data['ratio']) ? $data['ratio'] : 00;
$result = $data['result'] ?? 0;
$value = isset($data['result']) ? $data['result'] : 0;
$sumvalue = isset($data['sumresult']) ? $data['sumresult'] : 0;
$targetAmount = $data['targetAmount'] ?? 0;
$kpiHistoryId = $data['kpiHistoryId'] ?? 0;
$DueBehind = $targetAmount -  $result;

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
                <div class="col-4" style="display: flex; justify-content: center; align-items: center; gap: 20px;">
                    <div style="display: flex; gap: 14px; flex-direction: column;">
                        <text class="current-ratio text-end">
                            <?= Yii::t('app', 'Current Achievement Ratio') ?>
                        </text>
                        <text class="current-ratio-data text-end">

                            <span class="DueBehind">
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
                                0%
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
                    <div class="form-group"
                        style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                        <label class="text-black" for="name" style="font-size: 22px; font-weight: 600;">
                            Increase The Number of Non-Japanese Clients
                            to Extend the Growth Trajectory further
                        </label>
                    </div>

                    <div class="form-group mt-25"
                        style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                        <label class="text-gray" for="name" style="font-size: 14px; font-weight: 400;">
                            KGI Details
                        </label>
                        <text class="text-black" style="font-size: 14px; font-weight: 400;">
                            The goal is to increase the number of Non-Japanese clients to diversify the client base and
                            drive sustained business growth. By targeting international markets and industries, the aim
                            is to capture a broader market share and reduce dependency on a single demographic. This
                            will involve identifying potential opportunities outside Japan, creating tailored marketing
                            strategies to appeal to Non-Japanese audiences, and leveraging existing networks to
                            establish meaningful connections ...
                        </text>
                    </div>

                    <div class="form-group mt-42"
                        style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                        <label class="text-gray" for="name" style="font-size: 14px; font-weight: 400;">
                            Assigned Companies
                        </label>
                        <div class="circle-container pl-15" data-type="branch" style="display: flex;
                                    align-items: center;
                                    gap: 5px;
                                    padding-left: 15px;">
                            <div class="cycle-current">
                                <img src="<?= Yii::$app->homeUrl ?>image/branches.svg" alt="icon">
                            </div>
                            <!-- <div class="cycle-current">
                                <img src="<?= Yii::$app->homeUrl ?>image/branches.svg" alt="icon">
                            </div>
                            <div class="cycle-current">
                                <img src="<?= Yii::$app->homeUrl ?>image/branches.svg" alt="icon">
                            </div> -->
                            <div class="cycle-current-white" style="color: #000; right: 15px;"
                                id="branch-selected-count">
                                00
                            </div>
                            <text class="text-black" style="font-size: 18px; font-weight: 500;">
                                Assigned on 1 Company
                            </text>
                        </div>
                    </div>
                    <div class="form-group mt-42"
                        style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                        <label class="text-gray" for="name" style="font-size: 14px; font-weight: 400;">
                            Assigned Branches
                        </label>
                        <div class="circle-container pl-15" data-type="branch" style="display: flex;
                                    align-items: center;
                                    gap: 5px;
                                    padding-left: 15px;">
                            <div class="cycle-current">
                                <img src="<?= Yii::$app->homeUrl ?>image/branches.svg" alt="icon">
                            </div>
                            <div class="cycle-current">
                                <img src="<?= Yii::$app->homeUrl ?>image/branches.svg" alt="icon">
                            </div>
                            <div class="cycle-current">
                                <img src="<?= Yii::$app->homeUrl ?>image/branches.svg" alt="icon">
                            </div>
                            <div class="cycle-current-white" style="color: #000; right: 15px;"
                                id="branch-selected-count">
                                00
                            </div>
                            <text class="text-black" style="font-size: 18px; font-weight: 500;">
                                Assigned on 2 Branches
                            </text>
                        </div>
                    </div>
                    <div class="form-group mt-42"
                        style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                        <label class="text-gray" for="name" style="font-size: 14px; font-weight: 400;">
                            Assigned Department/s
                        </label>
                        <div class="circle-container pl-15" data-type="branch" style="display: flex;
                                    align-items: center;
                                    gap: 5px;
                                    padding-left: 15px;">
                            <div class="cycle-current">
                                <img src="<?= Yii::$app->homeUrl ?>image/departments.svg" alt="icon">
                            </div>
                            <div class="cycle-current">
                                <img src="<?= Yii::$app->homeUrl ?>image/departments.svg" alt="icon">
                            </div>
                            <div class="cycle-current">
                                <img src="<?= Yii::$app->homeUrl ?>image/departments.svg" alt="icon">
                            </div>
                            <div class="cycle-current-white" style="color: #000; right: 15px;"
                                id="branch-selected-count">
                                00
                            </div>
                            <text class="text-black" style="font-size: 18px; font-weight: 500;">
                                Assigned on 87 Departments
                            </text>
                        </div>
                    </div>
                </div>
                <div style="flex: 1;">
                    <div class="form-group mt-42"
                        style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                        <div class="col-12 text-center priority-star">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star ml-10" aria-hidden="true"></i>
                        </div>
                        <div class="col-12 text-center priority-box">
                            <div class="col-12">Priority</div>
                            <div class="col-12 text-priority">B</div>
                        </div>
                    </div>
                    <div class="form-group mt-42"
                        style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                        <div class="row">
                            <div class="col-6 border-right-disable">
                                <div class="col-12  pr-6 pt-10 text-center">
                                    Quant Ratio</div>
                                <div class="col-12 pim-duedate text-center mt-2">
                                    <img src="/HRVC/frontend/web/images/icons/Settings/diamon.svg" class="pim-iconKFI"
                                        style="margin-top: -1px; margin-left: 3px;">
                                    Quality
                                </div>
                            </div>

                            <!-- Right Column: Update Interval -->
                            <div class="col-6">
                                <div class="col-12 pr-0 pt-10 text-center">
                                    Update Interval </div>
                                <div class="col-12 pim-duedate text-center mt-2">
                                    <img src="/HRVC/frontend/web/images/icons/Settings/monthly.svg" class="pim-iconKFI"
                                        style="margin-top: -3px;">
                                    Quarterly
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-42"
                        style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                        <label class="text-gray" for="name" style="font-size: 14px; font-weight: 400;">
                            Assigned Department/s
                        </label>
                        <div class="circle-container pl-15" data-type="branch" style="display: flex;
                                    align-items: center;
                                    gap: 5px;
                                    padding-left: 15px;">
                            <div class="cycle-current">
                                <img src="<?= Yii::$app->homeUrl ?>image/departments.svg" alt="icon">
                            </div>
                            <div class="cycle-current">
                                <img src="<?= Yii::$app->homeUrl ?>image/departments.svg" alt="icon">
                            </div>
                            <div class="cycle-current">
                                <img src="<?= Yii::$app->homeUrl ?>image/departments.svg" alt="icon">
                            </div>
                            <div class="cycle-current-white" style="color: #000; right: 15px;"
                                id="branch-selected-count">
                                00
                            </div>
                            <text class="text-black" style="font-size: 18px; font-weight: 500;">
                                Assigned on 87 Departments
                            </text>
                        </div>
                    </div>
                    <div class="form-group mt-42"
                        style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                        <label class="text-gray" for="name" style="font-size: 14px; font-weight: 400;">
                            Assigned Department/s
                        </label>
                        <div class="row">
                            <div class="col-5">
                                <div class="row pim-picgroup">
                                    <div class="col-2">
                                        <div class="pim-pic-yenlowKFI">
                                            <img src="/HRVC/frontend/web/images/icons/Settings/personblack.svg"
                                                alt="person icon">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="pim-pic-yenlowKFI">
                                            <img src="/HRVC/frontend/web/images/icons/Settings/personblack.svg"
                                                alt="person icon">
                                        </div>
                                    </div>
                                    <div class="col-6 number-tag load-yenlow pr-0 pl-0 pim-pic-gridKFINum ">
                                        0 </div>
                                </div>
                            </div>
                            <div class="col-7 yenlow-assignKFI">
                                <img src="/HRVC/frontend/web/images/icons/Settings/assign-yenlow.svg">
                                <a href="/HRVC/frontend/web/kfi/assign/assign/fA_rdloWzA96cHos1oY_UZAtuHtdy3v735MWj2arIxE%3D"
                                    class="font-black">
                                    Assign Person </a>
                            </div>
                        </div>
                    </div>

                </div>
                <div style="flex: 1;">
                    <div class="form-group"
                        style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
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
                                <?= Yii::t('app', 'Result') ?>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/help.svg" data-toggle="tooltip"
                                    data-placement="top"
                                    title="<?= Yii::t('app', 'Historic update contains the update from the team and indivudials if you wish to use your own values, please toggle on Override to put custom numbers ') ?>"
                                    alt="Help Icon">
                            </div>
                            <div href="javascript:void(0);" class="updatehistory" style="text-align: right;"
                                cursor="pointer" data-bs-toggle="modal" data-bs-target="#update-history-popup"
                                onclick="modalHistory(<?= isset($kpiId) ? $kpiId : '' ?>);">
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


                        <div style="display: flex; justify-content: space-between; width: 100%; align-items: center;">
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

                    <div class="form-group mt-42"
                        style="display: flex; flex-direction: column; align-items: flex-start; gap: 14px;">
                        <label class="text-manage-create" for="name"
                            style="display: flex; justify-content: space-between; width: 100%; align-items: center;">
                            <div style="flex-grow: 1;">
                                <?= Yii::t('app', 'Status') ?>
                            </div>
                        </label>
                        <div style="display: flex;
                                    flex-direction: column;
                                    align-items: flex-start;
                                    gap: 12px;
                                    align-self: stretch;">
                            <div class="textbox-check" style="display: flex; gap: 12px;">
                                <div style="flex-basis: 5%;">
                                    <input type="checkbox" id="check1" name="status[]" value="check1">
                                </div>
                                <div style="flex-basis: 25%; margin-right: 20px;">
                                    <div class="" for="check1">In-Progress</div>
                                </div>
                                <div style="flex-basis: 70%;">
                                    <text>
                                        The task is currently being addressed. Ensure it's marked completed before the
                                        due
                                        date to avoid it being automatically listed as overdue.
                                    </text>
                                </div>
                            </div>
                            <div class="textbox-check-hide">
                                <div style="flex-basis: 5%;">
                                    <input type="checkbox" id="check2" name="status[]" value="check2">
                                </div>
                                <div style="flex-basis: 25%; margin-right: 20px;">
                                    <div for="check2">Completed</div>
                                </div>
                                <div style="flex-basis: 70%;">
                                    <text>
                                        The Component has not been completed

                                    </text>
                                </div>
                            </div>
                            <div class="textbox-check-hide">
                                <div style="flex-basis: 5%;">
                                    <input type="checkbox" id="check3" name="status[]" value="check3">
                                </div>
                                <div style="flex-basis: 25%; margin-right: 20px;">
                                    <div for="check3">Due Passed</div>
                                </div>
                                <div style="flex-basis: 70%;">
                                    <text>
                                        This task component be automatically become due passed within 30 Days, if you
                                        don’t
                                        mark it as completed
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
                                18/12/2024
                                <?= isset($data['lastUpdate']) ? $data['lastUpdate'] : '' ?>
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
<?php if($statusform == 'update'){
    ?>
<input type="hidden" value="update" id="acType">
<?php
} else {
?>
<input type="hidden" value="create" id="acType">
<?php } ?>
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


$(document).ready(function() {
    var statusform = '<?= $statusform ?>';

    if (statusform == 'update') {
        branchMultiDepartmentUpdateKpi();
        // alert(statusform);

        // ดึงค่า branchId ที่ถูก checked แล้ว
        var checkedBranchIds = [];
        $('input[name="branch[]"]:checked').each(function() {
            checkedBranchIds.push($(this).val());
        });

        // เรียกใช้งานฟังก์ชันสำหรับ branch ที่ถูก checked เท่านั้น
        checkedBranchIds.forEach(function(branchId) {
            // alert(branchId);
            departmentMultiTeamUpdateKpi(branchId);
        });

        // ดึงค่า team ที่ถูก checked แล้ว
        var checkedTeamIds = [];
        $('input[name="team[]"]:checked').each(function() {
            checkedTeamIds.push($(this).val());
        });

        // เรียกใช้งานฟังก์ชันสำหรับ team ที่ถูก checked เท่านั้น
        checkedTeamIds.forEach(function(departmentId) {
            // alert(departmentId);
            multiTeamUpdate(departmentId);
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

});

function modalHistory(kpiId) {
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