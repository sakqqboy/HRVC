<?php

use yii\bootstrap5\ActiveForm;

// if (empty($contentDetail['KFI']['KFIData'] ?? null) && empty($contentDetail['KGI']['KGIData']  ?? null) && empty($contentDetail['KPI']['KPIData']  ?? null)):
?>
<!-- <p>No data available.</p> -->
<?php

// else:

    $updateClickKFI = 'onclick="javascript:updateKfi(KFIData[currentKFIIndex].kfiId)"';
    // Default assignments
    $updateClickKGI = sprintf(
        'onclick="javascript:updateKgi(%s, %s)" data-bs-toggle="modal" data-bs-target="#update-kgi-modal"',
        'KGIData[currentKGIIndex].kgiId',
        'KGIData[currentKGIIndex].id'
    );

    $updateClickKPI = sprintf(
        'onclick="javascript:updateKpi(%s)" data-bs-toggle="modal" data-bs-target="#update-kpi-modal"',
        'KPIData[currentKPIIndex].kpiId'
    );

    // Adjust based on the $tab value
    if ($tab == 'team') {
        $kgiTeamId = 'KGIData[currentKGIIndex].id';
        $updateClickKGI = sprintf(
            'onclick="javascript:updateTeamKgi(%s)" data-bs-toggle="modal" data-bs-target="#update-kgi-modal-team"',
            $kgiTeamId
        );
        $kpiTeamId = 'KPIData[currentKPIIndex].id';
        $updateClickKPI = sprintf(
            'onclick="javascript:updateTeamKpi(%s)" data-bs-toggle="modal" data-bs-target="#update-kpi-modal-team"',
            $kpiTeamId
        );
    } elseif ($tab == 'self') {
    }

?>
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
    animation: progress-fill 1s linear forwards;
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

/* 
.progress-bar {
    transition: transform 0.5s ease-in-out;
}

.progress-value {
    transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
} */
</style>

<div class="tab-pane fade show active" role="tabpanel" id="tab-content-container">
    <div class="row">
        <?php
            // print_r($units);
            if ($tab == 'company') {
            ?>
        <!-- Card 1 -->
        <div class="col-md-4 pr-0 mb-3">
            <div class="dashboard-kfi-top">
            </div>
            <div class="dashboard-kfi-card p-3 position-relative">
                <div class="card-tab1 bg-white p-3" style="border: none;">
                    <div class="row align-items-center">
                        <!-- Left Section -->
                        <div class="col-7 text-start">
                            <span class="key-title">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/KFI.svg"
                                    class="home-icon mr-5">
                                <?= Yii::t('app', 'Key Financial Indicator') ?>
                            </span>
                        </div>
                        <!-- Right Section -->
                        <div class="col-5 text-end">
                            <span class="completion-percentage">
                                <?= isset($contentDetail['KFI']['showPercent']) && $contentDetail['KFI']['showPercent'] !== '' ? $contentDetail['KFI']['showPercent'] : 0 ?>%
                            </span>
                            <span class="total-achievement"><?= Yii::t('app', 'Total Achievement') ?></span>
                        </div>
                        <div class="col-12 pt-3 d-flex justify-content-between">
                            <span class="total-progress"><?= Yii::t('app', 'Total Progress') ?></span>
                            <span class="total-k"><?= Yii::t('app', 'Total KFI') ?>
                                <strong class="bold-text">
                                    <?= isset($contentDetail['KFI']['kfiCount']) && $contentDetail['KFI']['kfiCount'] !== '' ? $contentDetail['KFI']['kfiCount'] : 0 ?>
                                </strong>
                            </span>
                        </div>
                    </div>

                    <!-- Divider -->
                    <hr class="custom-hr">
                    <!-- Progress Bar -->
                    <div class="progress-dashboard">
                        <div class="progress-bar bg-KFI"
                            style="width: 
                            <?= isset($contentDetail['KFI']['showPercent']) && $contentDetail['KFI']['showPercent'] !== '' ? min($contentDetail['KFI']['showPercent'], 100) : 0 ?>%;"
                            role="progressbar"
                            aria-valuenow="<?= isset($contentDetail['KFI']['showPercent']) && $contentDetail['KFI']['showPercent'] !== '' ? min($contentDetail['KFI']['showPercent'], 100) : 0 ?>"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <div class="card-tab2 bg-white" id="KFI" style="border: none;">
                    <!-- <div id="kfi-slide"> -->
                    <div class="key-title-container" id="content-0">
                        <div class="col-9 d-flex">
                            <span class="key-total" id="KFI-name-0"><?= Yii::t('app', '-') ?></span>
                        </div>
                        <div class="col-2 d-flex justify-content-between">
                            <span class="toggle-text">
                                <button class="show-more-btn" cursor="pointer" onclick="changeKFIData('left')">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/btn-KFI-left.svg"
                                        style="margin-top: 1px; margin-left: 3px;">
                                </button>
                            </span>
                            <span class="toggle-text">
                                <button class="show-more-btn" cursor="pointer" onclick="changeKFIData('right')">
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
                                        <div class="progress-value" id="">0%</div>
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
                            <strong class="bold-text" id="KFI-target-0">-</strong>
                        </div>
                        <div class="col-4 text-end">
                            <small class="small-text text-muted">
                                Result
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Result.svg" class="pim-iconKFI"
                                    style="margin-top: 1px; margin-left: 3px;">
                            </small>
                            <br>
                            <strong class="bold-text" id="KFI-result-0">-</strong>
                        </div>
                    </div>
                    <!-- </div> -->
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3" id="content-0-data">
                    <div class="col-4 text-start">
                        <p class="small-text text-muted mb-0"><?= Yii::t('app', 'Last Updated on') ?></p>
                        <strong class="small-text" id="KFI-last-0">-</strong>
                        <!-- แก้ไขจาก KFI-lasr-0 เป็น KFI-last-0 -->
                    </div>
                    <div class="col-4 text-center">
                        <?php if ($role >= 5 && $contentDetail['KFI']['showPercent'] !== '') { ?>

                        <button class="btn-update btn-KFI" <?= $updateClickKFI ?> data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop2">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh.svg" class="mb-2"
                                style="width: 12px; height: 12px;">
                            <?= Yii::t('app', 'Update') ?>
                        </button>
                        <?php } else { ?>
                        <button class="btn-update btn-Locked">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/locked.svg" class="mb-2"
                                style="width: 12px; height: 12px;">
                            <?= Yii::t('app', 'Locked') ?>
                        </button>
                        <?php } ?>
                    </div>
                    <div class="col-4 text-end">
                        <p class="small-textKFI mb-0"><?= Yii::t('app', 'Due Update Date') ?></p>
                        <strong class="small-text" id="KFI-due-0">-</strong>
                    </div>
                </div>

            </div>
        </div>
        <?php
            }
            ?>
        <!-- Card 2 -->
        <div class="col-md-4 pr-0 mb-3">
            <div class="dashboard-kgi-top"></div>
            <div class="dashboard-kgi-card p-3 position-relative">
                <div class="card bg-white p-3" style="border: none;">
                    <div class="row align-items-center">
                        <!-- Left Section -->
                        <div class="col-7 text-start">
                            <span class="key-title">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/KGI.svg"
                                    class="home-icon mr-5">
                                <?= Yii::t('app', 'Key Goal Indicator') ?>
                            </span>
                        </div>
                        <!-- Right Section -->
                        <div class="col-5 text-end">
                            <span class="completion-percentage">
                                <?= isset($contentDetail['KGI']['showPercent']) && $contentDetail['KGI']['showPercent'] !== '' ? $contentDetail['KGI']['showPercent'] : 0 ?>%
                            </span>
                            <span class="total-achievement"><?= Yii::t('app', 'Total Achievement') ?></span>
                        </div>
                        <div class="col-12 pt-3 d-flex justify-content-between">
                            <span class="total-progress"><?= Yii::t('app', 'Total Progress') ?></span>
                            <span class="total-k"><?= Yii::t('app', 'Total KGI') ?>
                                <strong class="bold-text">
                                    <?= isset($contentDetail['KGI']['kgiCount']) && $contentDetail['KGI']['kgiCount'] !== '' ? $contentDetail['KGI']['kgiCount'] : 0 ?></strong>
                            </span>
                        </div>
                    </div>

                    <!-- Divider -->
                    <hr class="custom-hr">
                    <!-- Progress Bar -->
                    <div class="progress-dashboard">
                        <div class="progress-bar bg-KGI"
                            style="width:
                            <?= isset($contentDetail['KGI']['showPercent']) && $contentDetail['KGI']['showPercent'] !== '' ?  min($contentDetail['KGI']['showPercent'], 100) : 0 ?>%;"
                            role="progressbar"
                            aria-valuenow="<?= isset($contentDetail['KGI']['showPercent']) && $contentDetail['KGI']['showPercent'] !== '' ?  min($contentDetail['KGI']['showPercent'], 100) : 0 ?>"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <div class="card bg-white" id="KGI" style="border: none;">
                    <div class="key-title-container" id="content-KGI">
                        <div class="col-9 d-flex">
                            <span class="key-total" id="KGI-name-0"><?= Yii::t('app', '-') ?></span>
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
                                        <div class="progress-value" id="">0%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 text-start">
                            <small class="small-text text-muted">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Target.svg" class="pim-iconKGI"
                                    style="margin-top: 1px; margin-right: 3px;">
                                <?= Yii::t('app', 'Target') ?>
                            </small>
                            <br>
                            <strong class="bold-text" id="KGI-target-0">-</strong>
                        </div>
                        <div class="col-4 text-end">
                            <small class="small-text text-muted">
                                <?= Yii::t('app', 'Result') ?>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Result.svg" class="pim-iconKGI"
                                    style="margin-top: 1px; margin-left: 3px;">
                            </small>
                            <br>
                            <strong class="bold-text" id="KGI-result-0">-</strong>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="col-4 text-start">
                        <p class="small-text text-muted mb-0"><?= Yii::t('app', 'Last Updated on') ?></p>
                        <strong class="small-text" id="KGI-last-0">07/19/2024</strong>
                    </div>
                    <div class="col-4 text-center">
                        <?php if ($role >= 5 && $contentDetail['KGI']['showPercent'] !== '') { ?>
                        <?php if ($tab == 'self' ) { ?>
                        <button class="btn-update btn-KGI" onclick="chengeButtonKGI(KGIData[currentKGIIndex].id)">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh-black.svg" class="mb-2"
                                style="width: 12px; height: 12px;">
                            <?= Yii::t('app', 'Updated') ?>
                        </button>

                        <?php } else { ?>
                        <button class="btn-update btn-KGI" <?= $updateClickKGI ?>>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh-black.svg" class="mb-2"
                                style="width: 12px; height: 12px;">
                            <?= Yii::t('app', 'Update')  ?>
                        </button>
                        <?php  } ?>
                        <?php } else { ?>
                        <button class="btn-update btn-Locked">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/locked.svg" class="mb-2"
                                style="width: 12px; height: 12px;">
                            <?= Yii::t('app', 'Locked') ?>
                        </button>
                        <?php } ?>
                        <!-- <strong class="bold-text" id="KGI-count-0">-</strong> -->
                    </div>
                    <div class="col-4 text-end">
                        <p class="small-textKGI mb-0"><?= Yii::t('app', 'Due Update Date') ?></p>
                        <strong class="small-text" id="KGI-due-0">-</strong>
                    </div>
                </div>

            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-4 pr-0 mb-3">
            <div class="dashboard-kpi-top"></div>
            <div class="dashboard-kpi-card p-3 position-relative">
                <div class="card bg-white p-3" style="border: none;">
                    <div class="row align-items-center">
                        <!-- Left Section -->
                        <div class="col-7 text-start">
                            <span class="key-title">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/KPI.svg"
                                    class="home-icon mr-5">
                                <?= Yii::t('app', 'Key Performance Indicator') ?>
                            </span>
                        </div>
                        <!-- Right Section -->
                        <div class="col-5 text-end">
                            <span class="completion-percentage" id="completion-percentage">
                                <?= isset($contentDetail['KPI']['showPercent']) && $contentDetail['KPI']['showPercent'] !== '' ? $contentDetail['KPI']['showPercent'] : 0 ?>%
                            </span>
                            <span class="total-achievement"><?= Yii::t('app', 'Completed') ?></span>
                        </div>
                        <div class="col-12 pt-3 d-flex justify-content-between">
                            <span class="total-progress"><?= Yii::t('app', 'Total Progress') ?></span>
                            <span class="total-k"><?= Yii::t('app', 'Total KPI') ?>
                                <?= isset($contentDetail['KPI']['kpiCount']) && $contentDetail['KPI']['kpiCount'] !== '' ? $contentDetail['KPI']['kpiCount'] : 0 ?>%
                            </span>
                        </div>
                    </div>

                    <!-- Divider -->
                    <hr class="custom-hr">
                    <!-- Progress Bar -->
                    <div class="progress-dashboard">
                        <div class="progress-bar bg-KPI"
                            style="width: 
                            <?= isset($contentDetail['KPI']['showPercent']) && $contentDetail['KPI']['showPercent'] !== '' ? min($contentDetail['KPI']['showPercent'], 100) : 0 ?>%;"
                            role="progressbar"
                            aria-valuenow="<?= isset($contentDetail['KPI']['showPercent']) && $contentDetail['KPI']['showPercent'] !== '' ? min($contentDetail['KPI']['showPercent'], 100) : 0 ?>"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>


                <div class="card bg-white" id="KPI" style="border: none;">
                    <div class="key-title-container" id="content-KPI">
                        <div class="col-9 d-flex">
                            <span class="key-total" id="KPI-name-0"><?= Yii::t('app', '-') ?></span>
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
                                        <div class="progress-value" id="">0%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 text-start">
                            <small class="small-text text-muted">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Target.svg" class="pim-iconKPI"
                                    style="margin-top: 1px; margin-right: 3px;">
                                <?= Yii::t('app', 'Target') ?>
                            </small>
                            <br>
                            <strong class="bold-text" id="KPI-target-0">-</strong>
                        </div>
                        <div class="col-4 text-end">
                            <small class="small-text text-muted">
                                <?= Yii::t('app', 'Result') ?>
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Result.svg" class="pim-iconKPI"
                                    style="margin-top: 1px; margin-left: 3px;">
                            </small>
                            <br>
                            <strong class="bold-text" id="KPI-result-0">-</strong>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="col-4 text-start">
                        <p class="small-text text-muted mb-0"><?= Yii::t('app', 'Last Updated on') ?></p>
                        <strong class="small-text" id="KPI-last-0">-</strong>
                    </div>
                    <div class="col-4 text-center">
                        <?php if ($role >= 5 && $contentDetail['KPI']['showPercent'] !== '') { ?>
                        <?php if ($tab == 'self' ) { ?>
                        <!-- 
                        <a class="btn-update btn-KPI-0" onclick="changeKPIData('left')">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh.svg" class="mb-2"
                                style="width: 12px; height: 12px;">
                            <?= Yii::t('app', 'Updated') ?>
                        </a> -->
                        <button class="btn-update btn-KPI" onclick="chengeButtonKPI(KPIData[currentKPIIndex].id)">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh.svg" class="mb-2"
                                style="width: 12px; height: 12px;">
                            <?= Yii::t('app', 'Updated') ?>
                        </button>
                        <?php } else { ?>
                        <button class="btn-update btn-KPI-0" <?= $updateClickKPI ?>>
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh.svg" class="mb-2"
                                style="width: 12px; height: 12px;">
                            <?= Yii::t('app', 'Update') ?>
                        </button>
                        <?php  } ?>
                        <?php } else { ?>
                        <button class="btn-update btn-Locked">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/locked.svg" class="mb-2"
                                style="width: 12px; height: 12px;">
                            <?= Yii::t('app', 'Locked') ?>
                        </button>
                        <?php } ?>
                        <!-- <strong class="bold-text" id="KPI-count-0">-</strong> -->
                    </div>
                    <div class="col-4 text-end">
                        <p class="small-textKPI mb-0"><?= Yii::t('app', 'Due Update Date') ?></p>
                        <strong class="small-text" id="KPI-due-0">-</strong>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php

    function renderForm($formId, $actionUrl, $modalView, $variables, $view)
    {
        $form = ActiveForm::begin([
            'id' => $formId,
            'method' => 'post',
            'options' => ['enctype' => 'multipart/form-data'],
            'action' => Yii::$app->homeUrl . $actionUrl,
        ]);

        echo $view->render($modalView, $variables);

        ActiveForm::end();
    }

    $commonVariables = [
        "units" => $units,
        "companies" => $companies,
        "months" => $months,
        "isManager" => $isManager ?? null,
    ];

    // Pass Yii::$app->view to renderForm
    renderForm('update-kfi', 'kfi/management/save-update-kfi', 'modal_update_kfi', $commonVariables, Yii::$app->view);
    renderForm('update-kgi', 'kgi/management/update-kgi', 'modal_update_kgi', $commonVariables, Yii::$app->view);
    renderForm('update-kpi', 'kpi/management/update-kpi', 'modal_update_kpi', $commonVariables, Yii::$app->view);

    renderForm('update-kgi', 'kgi/kgi-team/update-kgi-team', 'modal_update_kgiteam', $commonVariables, Yii::$app->view);
    renderForm('update-kpi', 'kpi/kpi-team/update-kpi-team', 'modal_update_kpiteam', $commonVariables, Yii::$app->view);

    ?>


<script>
<?php
        function formatNumber($number)
        {
            if (!is_numeric($number) || $number == null) {
                return '0.00'; // Return a default value for invalid input
            }
            $number = (float) $number; // Ensure the value is treated as a float

            if ($number >= 1000000) {
                return number_format($number / 1000000, 2) . ' M'; // For millions
            } elseif ($number >= 1000) {
                return number_format($number / 1000, 2) . ' K'; // For thousands
            }
            return number_format($number, 2); // For smaller numbers
        }
        // เตรียมข้อมูลจาก PHP (เหมือนเดิม)
        $kfiData = [];
        $kgiData = [];
        $kpiData = [];

if (empty($contentDetail['KFI']['KFIData'] ?? null) && empty($contentDetail['KGI']['KGIData']  ?? null) && empty($contentDetail['KPI']['KPIData']  ?? null)):

    $kpiData[] = [
        'target' => '0.00',
        'result' => '0.00',
        'percentage' => '0.00',
        'name' => '-',
        'last' => '-',
        'due' =>  '-',
        'id' => 0,
        'kpiId' => 0,
        'count' => 0,
    ];
    $kgiData[] = [
        'target' => '0.00',
        'result' => '0.00',
        'percentage' => '0.00',
        'name' => '-',
        'last' => '-',
        'due' =>  '-',
        'id' => 0,
        'kgiId' => 0,
        'count' => 0,
    ];
    $kfiData[] = [
        'target' => '0.00',
        'result' => '0.00',
        'percentage' => '0.00',
        'name' => '-',
        'last' => '-',
        'due' =>  '-',
        'id' => 0,
        'kfiId' => 0,
        'count' => 0,
    ];
else:
  // เตรียม KPIData
  foreach ($contentDetail['KPI']['KPIData'] as $item) {
    $kpiData[] = [
        'target' => !empty($item['target']) ? formatNumber($item['target'], 2) : '0.00',
        'result' => !empty($item['result']) ? formatNumber($item['result'], 2) : '0.00',
        'percentage' => number_format(floatval($item['percentage']),2,'.',''),
        'name' => $item['name'],
        'last' => $item['last'] ?? '-',
        'due' => $item['due'] ?? '-',
        'id' => $item['id'],
        'kpiId' => $item['kpiId'],
        'count' => $contentDetail['KPI']['kpiCount'],
    ];
}

// เตรียม KGIData
foreach ($contentDetail['KGI']['KGIData'] as $item) {
    $kgiData[] = [
        'target' => !empty($item['target']) ? formatNumber($item['target'], 2) : '0.00',
        'result' => !empty($item['result']) ? formatNumber($item['result'], 2) : '0.00',
        'percentage' => number_format(floatval($item['percentage']),2,'.',''),
        'name' => $item['name'],
        'last' => $item['last'] ?? '-',
        'due' => $item['due'] ?? '-',
        'id' => $item['id'],
        'kgiId' => $item['kgiId'],
        'count' => $contentDetail['KGI']['kgiCount'],
    ];
}

if ($tab == 'company') {
    // เตรียม KFIData
    foreach ($contentDetail['KFI']['KFIData'] as $item) {
        $kfiData[] = [
            'target' => !empty($item['target']) ? formatNumber($item['target'], 2) : '0.00',
            'result' => !empty($item['result']) ? formatNumber($item['result'], 2) : '0.00',
            'percentage' => number_format(floatval($item['percentage']),2,'.',''),
            'name' => $item['name'],
            'last' => $item['last'] ?? '-',
            'due' => $item['due'] ?? '-',
            'id' => $item['id'],
            'kfiId' => $item['kfiId'],
            'count' => $contentDetail['KFI']['kfiCount'],
        ];
    }
}
endif; 

        ?>

$(document).ready(function() {
    // alert(`start`); // แสดงข้อมูลชุดที่เลือก
    chaengeData()
    handleAjaxSuccess()
});

function chaengeData() {
    // alert(`start`);
    // currentKFIIndex = 0;
    KFIData = <?php echo json_encode($kfiData); ?>;
    KGIData = <?php echo json_encode($kgiData); ?>;
    KPIData = <?php echo json_encode($kpiData); ?>;
    // alert(`start`);
    // Check and update data if available
    if (KFIData.length > 0) updateData(0, 'KFI');
    if (KGIData.length > 0) updateData(0, 'KGI');
    if (KPIData.length > 0) updateData(0, 'KPI');

}


<?php
        // $baseUrl = Yii::$app->homeUrl;
        ?>

var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;

function chengeButtonKGI(id) {
    if (isNaN(id)) {
        alert("Invalid ID. Please provide a numeric value.");
        return;
    }

    var url = $url + `home/dashboard/kgi-employee-id`;
    // alert(url);
    $.ajax({
        type: "POST",
        dataType: 'JSON',
        url: url,
        data: {
            id: id
        },
        success: function(data) {
            // alert(data);
            kgiEmployeeId = data.kgiEmployeeId;
            const kgiUrl = $url + `kgi/kgi-personal/update-personal-kgi/` + kgiEmployeeId;
            // alert(kgiUrl);
            window.location.href = kgiUrl;
        },
    });

}

function chengeButtonKPI(id) {
    if (isNaN(id)) {
        alert("Invalid ID. Please provide a numeric value.");
        return;
    }

    var url = $url + `home/dashboard/kpi-employee-id`;
    // alert(url);
    $.ajax({
        type: "POST",
        dataType: 'JSON',
        url: url,
        data: {
            id: id
        },
        success: function(data) {
            // alert(data);
            kpiEmployeeId = data.kpiEmployeeId;
            const kpiUrl = $url + `kpi/kpi-personal/update-personal-kpi/` + kpiEmployeeId;
            // alert(kpiUrl);
            window.location.href = kpiUrl;
        },
    });

}
document.addEventListener("DOMContentLoaded", () => {
    const progressBar = document.getElementById("progress-bar");

    // ตรวจสอบว่า element มีอยู่จริง
    if (!progressBar) {
        console.error("Progress bar element not found");
        return;
    }

    // ดึงค่าเป้าหมายจาก data-target
    const targetValue = parseInt(progressBar.getAttribute("data-target"), 10);

    if (isNaN(targetValue)) {
        console.error("Invalid target value");
        return;
    }

    // อัปเดตความกว้างของ Progress Bar
    setTimeout(() => {
        progressBar.style.width = `${targetValue}%`;
        progressBar.setAttribute("aria-valuenow", targetValue);
    }, 200); // เริ่มหลังจาก 200ms เพื่อให้เห็นการเปลี่ยนแปลงชัดเจน
});
</script>

<?php 
// endif; 
?>