<?php

use yii\bootstrap5\ActiveForm;

 if (empty($contentDetail['KFI'] ?? null) && empty($contentDetail['KGI'] ?? null) && empty($contentDetail['KPI'] ?? null)): 
 ?>
<p>No data available.</p>
<?php else: ?>
<style>
.progress {
    width: 40px;
    height: 40px;
    line-height: 50px;
    background: none;
    margin: 0 auto;
    position: relative;
}

.progress:after {
    content: "";
    width: 100%;
    height: 100%;
    border-radius: 50%;
    border: 12px solid var(--color-after, #CCD7FF);
    /* ใช้สีจาก custom property */
    position: absolute;
    top: 0;
    left: 0;
}

.progress>span {
    width: 50%;
    height: 100%;
    overflow: hidden;
    position: absolute;
    top: 0;
    z-index: 1;
}

.progress .progress-left {
    left: 0;
}

.progress .progress-bar {
    width: 100%;
    height: 100%;
    background: none;
    border-width: 12px;
    border-style: solid;
    position: absolute;
    top: 0;
}

.progress .progress-left .progress-bar {
    left: 100%;
    border-top-right-radius: 80px;
    border-bottom-right-radius: 80px;
    border-left: 0;
    transform-origin: center left;
}

.progress .progress-right {
    right: 0;
}

.progress .progress-right .progress-bar {
    left: -100%;
    border-top-left-radius: 80px;
    border-bottom-left-radius: 80px;
    border-right: 0;
    transform-origin: center right;
}

.progress .progress-value {
    width: 90%;
    height: 90%;
    border-radius: 50%;
    /* border: 18px solid; */
    background: #fff;
    font-size: 10px;
    color: #000;
    line-height: 35px;
    text-align: center;
    position: absolute;
    top: 5%;
    left: 5%;
}

.progress.blue .progress-bar {
    border-color: #CCD7FF;
    /* สีเริ่มต้น */
}
</style>

<div class="tab-pane fade show active" role="tabpanel" id="tab-content-container">
    <div class="row">
        <?php 
        // print_r($units);
            if($tab == 'company') {       
        ?>
        <!-- Card 1 -->
        <div class="col-md-4 mb-3">
            <div class="dashboard-kfi-top">
            </div>
            <div class="dashboard-kfi-card p-3 position-relative">
                <div class="card bg-white p-3" style="border: none;">
                    <div class="row align-items-center">
                        <!-- Left Section -->
                        <div class="col-7 text-start">
                            <span class="key-title">
                                <img src="<?=Yii::$app->homeUrl?>images/icons/black-icons/FinancialSystem/KFI.svg"
                                    class="home-icon mr-5">
                                Key Financial Indicator
                            </span>
                        </div>
                        <!-- Right Section -->
                        <div class="col-5 text-end">
                            <span class="completion-percentage"><?= $contentDetail['KFI']['showPercent'] ?>%</span>
                            <span class="total-achievement">Total Achievement</span>
                        </div>
                        <div class="col-12 pt-3 d-flex justify-content-between">
                            <span class="total-progress">Total Progress</span>
                            <span class="total-k">Total KFI
                                <strong class="bold-text"> <?= $contentDetail['KFI']['kfiCount'] ?> </strong>
                            </span>
                        </div>
                    </div>

                    <!-- Divider -->
                    <hr class="custom-hr">
                    <!-- Progress Bar -->
                    <div class="progress-dashboard">
                        <div class="progress-bar bg-KFI" style="width: <?= $contentDetail['KFI']['showPercent'] ?>%;"
                            role="progressbar" aria-valuenow="61" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <div class="card bg-white" id="KFI" style="border: none;">
                    <div class="key-title-container" id="content-0">
                        <div class="col-9 d-flex">
                            <span class="key-total" id="KFI-name-0">New Foreign Subscribe Clients</span>
                        </div>
                        <div class="col-2 d-flex justify-content-between">
                            <span class="toggle-text">
                                <button class="show-more-btn" onclick="changeKFIData('left')">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/btn-KFI-left.svg"
                                        style="margin-top: 1px; margin-left: 3px;">
                                </button>
                            </span>
                            <span class="toggle-text">
                                <button class="show-more-btn" onclick="changeKFIData('right')">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/btn-KFI-right.svg"
                                        style="margin-top: 1px; margin-left: 3px;">
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center" id="content-0-data">
                        <!-- ข้อมูลในแต่ละชุด -->
                        <div class="col-4 text-center" id="KFI-data-0">
                            <div class="row">
                                <div class="col-md-9 col-sm-6">
                                    <div class="progress blue" id="KFI-progress" data-color-left="#748EE9"
                                        data-color-right="#748EE9" data-color-after="#CCD7FF">
                                        <span class="progress-left">
                                            <span class="progress-bar"></span>
                                        </span>
                                        <span class="progress-right">
                                            <span class="progress-bar"></span>
                                        </span>
                                        <div class="progress-value" id="progress-value">0%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 text-start">
                            <small class="small-text text-muted">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Target.svg" class="pim-iconKFI"
                                    style="margin-top: 1px; margin-right: 3px;">
                                Target
                            </small>
                            <br>
                            <strong class="bold-text" id="KFI-target-0">ดาต้าจากอาเรย์</strong>
                        </div>
                        <div class="col-4 text-end">
                            <small class="small-text text-muted">
                                Result
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Result.svg" class="pim-iconKFI"
                                    style="margin-top: 1px; margin-left: 3px;">
                            </small>
                            <br>
                            <strong class="bold-text" id="KFI-result-0">ดาต้าจากอาเรย์</strong>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="col-4 text-start">
                        <p class="small-text text-muted mb-0">Last Updated on</p>
                        <strong class="small-text" id="KFI-last-0">ดาต้าจากอาเรย์</strong>
                        <!-- แก้ไขจาก KFI-lasr-0 เป็น KFI-last-0 -->
                    </div>
                    <div class="col-4 text-center">
                        <button class="btn-update btn-KFI"
                            onclick="javascript:updateKfi(KFIData[currentKFIIndex].kfiId)">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh.svg" class="mb-2"
                                style="width: 12px; height: 12px;">
                            Update
                        </button>
                    </div>
                    <div class="col-4 text-end">
                        <p class="small-textKFI mb-0">Due Update Date </p>
                        <strong class="small-text" id="KFI-due-0">ดาต้าจากอาเรย์</strong>
                    </div>
                </div>

            </div>
        </div>
        <? 
        }
        ?>
        <!-- Card 2 -->
        <div class="col-md-4 mb-3">
            <div class="dashboard-kgi-top"></div>
            <div class="dashboard-kgi-card p-3 position-relative">
                <div class="card bg-white p-3" style="border: none;">
                    <div class="row align-items-center">
                        <!-- Left Section -->
                        <div class="col-7 text-start">
                            <span class="key-title">
                                <img src="<?=Yii::$app->homeUrl?>images/icons/black-icons/FinancialSystem/KGI.svg"
                                    class="home-icon mr-5">
                                Key Goal Indicator
                            </span>
                        </div>
                        <!-- Right Section -->
                        <div class="col-5 text-end">
                            <span class="completion-percentage"><?= $contentDetail['KGI']['showPercent'] ?>%</span>
                            <span class="total-achievement">Total Achievement</span>
                        </div>
                        <div class="col-12 pt-3 d-flex justify-content-between">
                            <span class="total-progress">Total Progress</span>
                            <span class="total-k">Total KGI
                                <strong class="bold-text"> <?= $contentDetail['KGI']['kgiCount'] ?> </strong>
                            </span>
                        </div>
                    </div>

                    <!-- Divider -->
                    <hr class="custom-hr">
                    <!-- Progress Bar -->
                    <div class="progress-dashboard">
                        <div class="progress-bar bg-KGI" style="width: <?= $contentDetail['KGI']['showPercent'] ?>%;"
                            role="progressbar" aria-valuenow="49" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <div class="card bg-white" id="KGI" style="border: none;">
                    <div class="key-title-container" id="content-KGI">
                        <div class="col-9 d-flex">
                            <span class="key-total" id="KGI-name-0">Key Goal Indicator</span>
                        </div>
                        <div class="col-2 d-flex justify-content-between">
                            <span class="toggle-text">
                                <button class="show-more-btn" onclick="changeKGIData('left')">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/btn-KGI-left.svg"
                                        style="margin-top: 1px; margin-left: 3px;">
                                </button>
                            </span>
                            <span class="toggle-text">
                                <button class="show-more-btn" onclick="changeKGIData('right')">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/btn-KGI-right.svg"
                                        style="margin-top: 1px; margin-left: 3px;">
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center" id="content-KGI-data">
                        <div class="col-4 text-center" id="KGI-data">
                            <div class="row">
                                <div class="col-md-9 col-sm-6">
                                    <div class="progress blue" id="KGI-progress" data-color-left="#FDCA40"
                                        data-color-right="#FDCA40" data-color-after="#FFF2D6">
                                        <span class="progress-left"><span class="progress-bar"></span></span>
                                        <span class="progress-right"><span class="progress-bar"></span></span>
                                        <div class="progress-value" id="progress-value">0%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 text-start">
                            <small class="small-text text-muted">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Target.svg" class="pim-iconKGI"
                                    style="margin-top: 1px; margin-right: 3px;">
                                Target
                            </small>
                            <br>
                            <strong class="bold-text" id="KGI-target-0">ดาต้าจากอาเรย์</strong>
                        </div>
                        <div class="col-4 text-end">
                            <small class="small-text text-muted">
                                Result
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Result.svg" class="pim-iconKGI"
                                    style="margin-top: 1px; margin-left: 3px;">
                            </small>
                            <br>
                            <strong class="bold-text" id="KGI-result-0">ดาต้าจากอาเรย์</strong>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="col-4 text-start">
                        <p class="small-text text-muted mb-0">Last Updated on</p>
                        <strong class="small-text" id="KGI-last-0">07/19/2024</strong>
                    </div>
                    <div class="col-4 text-center">
                        <button class="btn-update btn-KGI"
                            onclick="javascript:updateKgi(KGIData[currentKGIIndex].kgiId,KGIData[currentKGIIndex].id)">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh-black.svg" class="mb-2"
                                style="width: 12px; height: 12px;">
                            Update
                        </button>
                    </div>
                    <div class="col-4 text-end">
                        <p class="small-textKGI mb-0">Due Update Date</p>
                        <strong class="small-text" id="KGI-due-0">ดาต้าจากอาเรย์</strong>
                    </div>
                </div>

            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-4 mb-3">
            <div class="dashboard-kpi-top"></div>
            <div class="dashboard-kpi-card p-3 position-relative">
                <div class="card bg-white p-3" style="border: none;">
                    <div class="row align-items-center">
                        <!-- Left Section -->
                        <div class="col-7 text-start">
                            <span class="key-title">
                                <img src="<?=Yii::$app->homeUrl?>images/icons/black-icons/FinancialSystem/KPI.svg"
                                    class="home-icon mr-5">
                                Key Performance Indicator
                            </span>
                        </div>
                        <!-- Right Section -->
                        <div class="col-5 text-end">
                            <span class="completion-percentage"><?= $contentDetail['KPI']['showPercent'] ?>%</span>
                            <span class="total-achievement">Completed</span>
                        </div>
                        <div class="col-12 pt-3 d-flex justify-content-between">
                            <span class="total-progress">Total Progress</span>
                            <span class="total-k">Total KPI
                                <strong class="bold-text"> <?= $contentDetail['KPI']['kpiCount'] ?> </strong>
                            </span>
                        </div>
                    </div>

                    <!-- Divider -->
                    <hr class="custom-hr">
                    <!-- Progress Bar -->
                    <div class="progress-dashboard">
                        <div class="progress-bar bg-KPI" style="width: <?= $contentDetail['KPI']['showPercent'] ?>%;"
                            role="progressbar" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>


                <div class="card bg-white" id="KPI" style="border: none;">
                    <div class="key-title-container" id="content-KPI">
                        <div class="col-9 d-flex">
                            <span class="key-total" id="KPI-name-0">Key Performance Indicator</span>
                        </div>
                        <div class="col-2 d-flex justify-content-between">
                            <span class="toggle-text">
                                <button class="show-more-btn" onclick="changeKPIData('left')">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/btn-KPI-left.svg"
                                        style="margin-top: 1px; margin-left: 3px;">
                                </button>
                            </span>
                            <span class="toggle-text">
                                <button class="show-more-btn" onclick="changeKPIData('right')">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/btn-KPI-right.svg"
                                        style="margin-top: 1px; margin-left: 3px;">
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center" id="content-KPI-data-0">
                        <div class="col-4 text-center" id="KPI-data-0">
                            <div class="row">
                                <div class="col-md-9 col-sm-6">
                                    <div class="progress blue" id="KPI-progress" data-color-left="#FF715B"
                                        data-color-right="#FF715B" data-color-after="#FFEAE6">
                                        <span class="progress-left"><span class="progress-bar"></span></span>
                                        <span class="progress-right"><span class="progress-bar"></span></span>
                                        <div class="progress-value" id="progress-value">0%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 text-start">
                            <small class="small-text text-muted">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Target.svg" class="pim-iconKPI"
                                    style="margin-top: 1px; margin-right: 3px;">
                                Target
                            </small>
                            <br>
                            <strong class="bold-text" id="KPI-target-0">ดาต้าจากอาเรย์</strong>
                        </div>
                        <div class="col-4 text-end">
                            <small class="small-text text-muted">
                                Result
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Result.svg" class="pim-iconKPI"
                                    style="margin-top: 1px; margin-left: 3px;">
                            </small>
                            <br>
                            <strong class="bold-text" id="KPI-result-0">ดาต้าจากอาเรย์</strong>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="col-4 text-start">
                        <p class="small-text text-muted mb-0">Last Updated on</p>
                        <strong class="small-text" id="KPI-last-0">ดาต้าจากอาเรย์</strong>
                    </div>
                    <div class="col-4 text-center">
                        <button class="btn-update btn-KPI-0"
                            onclick="javascript:updateKpi(KGIData[currentKGIIndex].id)">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh.svg" class="mb-2"
                                style="width: 12px; height: 12px;">
                            Update
                        </button>
                    </div>
                    <div class="col-4 text-end">
                        <p class="small-textKPI mb-0">Due Update Date</p>
                        <strong class="small-text" id="KPI-due-0">ดาต้าจากอาเรย์</strong>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<input type="hidden" value="create" id="acType">
<?php $form = ActiveForm::begin([
            'id' => 'create-kfi',
            'method' => 'post',
            'options' => [
                'enctype' => 'multipart/form-data',
            ],
            'action' => Yii::$app->homeUrl . 'kfi/management/create-kfi'

        ]); ?>
<?= $this->render('create_modal', [
            "companies" => $companies,
            "units" => $units,
            "months" => $months
        ]) ?>
<?php ActiveForm::end(); ?>
<?php $form = ActiveForm::begin([
            'id' => 'update-kfi',
            'method' => 'post',
            'options' => [
                'enctype' => 'multipart/form-data',
            ],
            'action' => Yii::$app->homeUrl . 'kfi/management/save-update-kfi'

        ]); ?>
<?= $this->render('update_modal', [
            "units" => $units,
            "companies" => $companies,
            "months" => $months,
            "isManager" => $isManager
        ]) ?>

<?php ActiveForm::end(); ?>

<input type="hidden" value="create" id="acType">
<?php
$form = ActiveForm::begin([
    'id' => 'create-kgi',
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
    'action' => Yii::$app->homeUrl . 'kgi/management/create-kgi'

]); ?>
<?= $this->render('modal_create', [
    "units" => $units,
    "companies" => $companies,
    "months" => $months
]) ?>
<?php ActiveForm::end(); ?>

<?php
$form = ActiveForm::begin([
    'id' => 'update-kgi',
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
    'action' => Yii::$app->homeUrl . 'kgi/management/update-kgi'

]); ?>
<?= $this->render('modal_update', [
    "units" => $units,
    "companies" => $companies,
    "months" => $months,
    "isManager" => $isManager
]) ?>
<?php ActiveForm::end(); ?>


<script>
<?php
function formatNumber($number) {
    if ($number >= 1000000) {
        return number_format($number / 1000000, 2). ' M'; // For millions
    } elseif($number >= 1000) {
        return number_format($number / 1000, 2). ' K'; // For thousands
    }
    return number_format($number, 2); // For smaller numbers
}

// แปลง PHP array เป็น JSON สำหรับ JavaScript
$kfiData = [];
$kgiData = [];
$kpiData = [];

// // เตรียม KFIData
foreach ($contentDetail['KFI']['KFIData'] as $item) {
    $kfiData[] = [
        'target' => formatNumber($item['target'], 2),
        'result' => formatNumber($item['result'], 2),
        'percentage' => floatval($item['percentage']),
        'name' => $item['name'],
        'last' => $item['last'] ?? '-',
        'due' => $item['due'] ?? '-',
        'id' => $item['id'],
        'kfiId' => $item['kfiId']
    ];
}

// เตรียม KGIData
foreach ($contentDetail['KGI']['KGIData'] as $item) {
    $kgiData[] = [
        'target' => formatNumber($item['target'], 2),
        'result' => formatNumber($item['result'], 2),
        'percentage' => floatval($item['percentage']),
        'name' => $item['name'],
        'last' => $item['last'] ?? '-',
        'due' => $item['due'] ?? '-',
        'id' => $item['id'],
        'kgiId' => $item['kgiId']
    ];
}

// // เตรียม KPIData
foreach ($contentDetail['KPI']['KPIData'] as $item) {
    $kpiData[] = [
        'target' => formatNumber($item['target'], 2),
        'result' => formatNumber($item['result'], 2),
        'percentage' => floatval($item['percentage']),
        'name' => $item['name'],
        'last' => $item['last'] ?? '-',
        'due' => $item['due'] ?? '-',
        'id' => $item['id'],
        'kpiId' => $item['kpiId']
    ];
}
// สร้าง JSON สำหรับฝั่ง JavaScript
echo "const KFIData = " . json_encode($kfiData, JSON_PRETTY_PRINT) . ";";
echo "const KGIData = " . json_encode($kgiData, JSON_PRETTY_PRINT) . ";";
echo "const KPIData = " . json_encode($kpiData, JSON_PRETTY_PRINT) . ";";
?>

$(document).ready(function() {

    updateKPIData(currentKPIIndex);
    updateKFIData(currentKFIIndex);
    updateKGIData(currentKGIIndex);

    // ค้นหา element ทุกตัวที่มี class `.progress`
    $('.progress').each(function() {
        const percentage = parseInt($(this).data('percentage'), 10);

        if (isNaN(percentage) || percentage < 0 || percentage > 100) {
            console.error(`Invalid percentage value: ${percentage}`);
            return;
        }

        setProgress(this, percentage);
    });
});
</script>
<?php endif; ?>