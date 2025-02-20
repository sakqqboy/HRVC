<?php
use yii\bootstrap5\ActiveForm;

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
                <div class="card-tab1">
                    <div class="row align-items-center">
                        <!-- Left Section -->
                        <div class="col-7 text-start">
                            <span class="key-title">
                                <div class="col-3">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/KFI.svg"
                                        style="width: 24px; height: 24px;">
                                </div>
                                <div class="col-9 card-title-text">
                                    <?= Yii::t('app', 'Key Financial Indicator') ?>
                                </div>
                            </span>
                        </div>
                        <!-- Right Section -->
                        <div class="col-5 text-end">
                            <span class="completion-percentage">
                                <?= isset($contentDetail['KFI']['showPercent']) && is_numeric($contentDetail['KFI']['showPercent']) ? $contentDetail['KFI']['showPercent'] : 0 ?>%
                            </span>
                            <span class="total-achievement"><?= Yii::t('app', 'Total Achievement') ?></span>
                        </div>
                        <div class="col-12 total-progress-box">
                            <span class="total-progress"><?= Yii::t('app', 'Total Progress') ?></span>
                            <span>
                                <strong class="total-k">
                                    <?= Yii::t('app', 'Total KFI') ?>
                                </strong>
                                <strong class="k-total">
                                    <?= isset($contentDetail['KFI']['kfiCount']) && $contentDetail['KFI']['kfiCount'] !== '' ? $contentDetail['KFI']['kfiCount'] : 0 ?>
                                </strong>
                            </span>

                        </div>
                    </div>

                    <!-- Divider -->
                    <hr class="custom-hr-card">
                    <!-- Progress Bar -->
                    <div class="progress-dashboard-KFI">
                        <div class="progress-bar bg-KFI"
                            style="width: 
                            <?= isset($contentDetail['KFI']['showPercent']) && $contentDetail['KFI']['showPercent'] !== '' ? min($contentDetail['KFI']['showPercent'], 100) : 0 ?>%;"
                            role="progressbar"
                            aria-valuenow="<?= isset($contentDetail['KFI']['showPercent']) && $contentDetail['KFI']['showPercent'] !== '' ? min($contentDetail['KFI']['showPercent'], 100) : 0 ?>"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <div class="card-tab2" id="KFI">
                    <div class="key-title-container" id="content-KFI">
                        <div class="col-9 d-flex">
                            <a class="key-total" id="KFI-name-0" href=""
                                onclick="viewButtonTab('KFI','',KFIData[currentKFIIndex].kfiId)"
                                style="text-decoration: none "><?= Yii::t('app', '-') ?></a>
                        </div>
                        <div class="col-2 pr-6" style="display: flex; justify-content: flex-end; align-items: center;">
                            <button class="show-more-btn" onclick="changeKFIData('left')">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/btn-KFI-left.svg"
                                    style="margin-top: 1px; margin-left: 3px;">
                            </button>
                        </div>
                        <div class="col-1" style="display: flex; justify-content: flex-end; align-items: center;">
                            <button class="show-more-btn" onclick="changeKFIData('right')">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/btn-KFI-right.svg"
                                    style="margin-top: 1px; margin-left: 3px;">
                            </button>
                        </div>
                    </div>
                    <div class="key-detail-container" id="content-0-data">
                        <!-- Data section -->
                        <div class="col-4 text-center" id="KFI-data-0">
                            <div class="row">
                                <div class="col-md-9 col-sm-6">

                                    <div class="single-chart">
                                        <svg viewBox="0 0 36 36" class="circular-chart blue">
                                            <path class="circle-bg" d="M18 2.0845
                                            a 15.9155 15.9155 0 0 1 0 31.831
                                            a 15.9155 15.9155 0 0 1 0 -31.831" />
                                            <path class="circle" id="KFI-progress" stroke-dasharray="0, 100" d="M18 2.0845
                                            a 15.9155 15.9155 0 0 1 0 31.831
                                            a 15.9155 15.9155 0 0 1 0 -31.831" />
                                            <text id="KFI-percentage" x="18" y="20.35" text-anchor="middle"
                                                dominant-baseline="middle" class="percentage">
                                                0%
                                            </text>
                                        </svg>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-4 text-start">
                            <small class="small-text-tr">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Target.svg" class="pim-iconKFI"
                                    style="margin-top: 1px; margin-right: 3px;">
                                Target
                            </small>
                            <br>
                            <strong class="bold-text" id="KFI-target-0">-</strong>
                        </div>
                        <div class="col-4 text-end">
                            <small class="small-text-tr">
                                Result
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Result.svg" class="pim-iconKFI"
                                    style="margin-top: 1px; margin-left: 3px;">
                            </small>
                            <br>
                            <strong class="bold-text" id="KFI-result-0">-</strong>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3" id="content-0-data">
                    <div class="col-4 text-end">
                        <p class="small-text-last mb-0"><?= Yii::t('app', 'Last Updated on') ?></p>
                        <strong class="small-text-value" id="KFI-last-0">-</strong>
                        <!-- แก้ไขจาก KFI-lasr-0 เป็น KFI-last-0 -->
                    </div>
                    <div class="col-4 text-center">
                        <?php if ($role >= 5 && $contentDetail['KFI']['showPercent'] !== '' && !empty($contentDetail['KFI']['KFIData'] ?? null)) { ?>

                        <button class="btn-update btn-KFI"
                            onclick="changeButtonTab('KFI','',KFIData[currentKFIIndex].kfiId)">
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
                    <div class="col-4 text-start">
                        <p class="small-textKFI mb-0"><?= Yii::t('app', 'Due Update Date') ?></p>
                        <strong class="small-text-value" id="KFI-due-0">-</strong>
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
                <div class="card-tab1">
                    <div class="row align-items-center">
                        <!-- Left Section -->
                        <div class="col-7 text-start">
                            <span class="key-title">
                                <div class="col-3">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/KGI.svg"
                                        style="width: 24px; height: 24px;">
                                </div>
                                <div class="col-9 card-title-text">
                                    <?= Yii::t('app', 'Key Goal Indicator') ?>
                                </div>
                            </span>
                        </div>
                        <!-- Right Section -->
                        <div class="col-5 text-end">
                            <span class="completion-percentage">
                                <?= isset($contentDetail['KGI']['showPercent']) && is_numeric($contentDetail['KGI']['showPercent']) ? $contentDetail['KGI']['showPercent'] : 0 ?>%
                            </span>
                            <span class="total-achievement"><?= Yii::t('app', 'Total Achievement') ?></span>
                        </div>
                        <div class="col-12 total-progress-box">
                            <span class="total-progress"><?= Yii::t('app', 'Total Progress') ?></span>
                            <span>
                                <strong class="total-k">
                                    <?= Yii::t('app', 'Total KGI') ?>
                                </strong>
                                <strong class="k-total">
                                    <?= isset($contentDetail['KGI']['kgiCount']) && $contentDetail['KGI']['kgiCount'] !== '' ? $contentDetail['KGI']['kgiCount'] : 0 ?>
                                </strong>
                            </span>
                        </div>
                    </div>

                    <!-- Divider -->
                    <hr class="custom-hr-card">
                    <!-- Progress Bar -->
                    <div class="progress-dashboard-KGI">
                        <div class="progress-bar bg-KGI"
                            style="width:
                            <?= isset($contentDetail['KGI']['showPercent']) && $contentDetail['KGI']['showPercent'] !== '' ?  min($contentDetail['KGI']['showPercent'], 100) : 0 ?>%;"
                            role="progressbar"
                            aria-valuenow="<?= isset($contentDetail['KGI']['showPercent']) && $contentDetail['KGI']['showPercent'] !== '' ?  min($contentDetail['KGI']['showPercent'], 100) : 0 ?>"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <div class="card-tab2" id="KGI">
                    <div class="key-title-container" id="content-KGI">
                        <div class="col-9 d-flex">
                            <?php if ($tab == 'self' ) { ?>
                            <a class="key-total" id="KGI-name-0" href=""
                                onclick="viewButtonTab('KGI','self',KGIData[currentKGIIndex].id)"
                                style="text-decoration: none "><?= Yii::t('app', '-') ?></a>
                            <?php } else if ($tab == 'team' ) { ?>
                            <a class="key-total" id="KGI-name-0" href=""
                                onclick="viewButtonTab('KGI','team',KGIData[currentKGIIndex].id)"
                                style="text-decoration: none "><?= Yii::t('app', '-') ?></a>
                            <?php } else { ?>
                            <a class="key-total" id="KGI-name-0" href=""
                                onclick="viewButtonTab('KGI','',KGIData[currentKGIIndex].kgiId)"
                                style="text-decoration: none "><?= Yii::t('app', '-') ?></a>
                            <?php  } ?>
                        </div>
                        <div class="col-2 pr-6" style="display: flex; justify-content: flex-end; align-items: center;">
                            <button class="show-more-btn" onclick="changeKGIData('left')">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/btn-KGI-left.svg"
                                    style="margin-top: 1px; margin-left: 3px;">
                            </button>
                        </div>
                        <div class="col-1" style="display: flex; justify-content: flex-end; align-items: center;">
                            <button class="show-more-btn" onclick="changeKGIData('right')">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/btn-KGI-right.svg"
                                    style="margin-top: 1px; margin-left: 3px;">
                            </button>
                        </div>
                    </div>
                    <div class="key-detail-container" id="content-KGI-data">
                        <div class="col-4 text-center" id="KGI-data">
                            <div class="row">
                                <div class="col-md-9 col-sm-6">
                                    <div class="single-chart">
                                        <svg viewBox="0 0 36 36" class="circular-chart yellow">
                                            <path class="circle-bg" d="M18 2.0845
                                                a 15.9155 15.9155 0 0 1 0 31.831
                                                a 15.9155 15.9155 0 0 1 0 -31.831" />
                                            <path class="circle" id="KGI-progress" stroke-dasharray="0, 100" d="M18 2.0845
                                                a 15.9155 15.9155 0 0 1 0 31.831
                                                a 15.9155 15.9155 0 0 1 0 -31.831" />
                                            <!-- <text> สำหรับการแสดงเปอร์เซ็นต์ -->
                                            <text id="KGI-percentage" x="18" y="20.35" text-anchor="middle"
                                                dominant-baseline="middle" class="percentage">
                                                0%
                                            </text>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 text-start">
                            <small class="small-text-tr">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Target.svg" class="pim-iconKGI"
                                    style="margin-top: 1px; margin-right: 3px;">
                                <?= Yii::t('app', 'Target') ?>
                            </small>
                            <br>
                            <strong class="bold-text" id="KGI-target-0">-</strong>
                        </div>
                        <div class="col-4 text-end">
                            <small class="small-text-tr">
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
                    <div class="col-4 text-end">
                        <p class="small-text-last mb-0"><?= Yii::t('app', 'Last Updated on') ?></p>
                        <strong class="small-text-value" id="KGI-last-0">-</strong>
                    </div>
                    <div class="col-4 text-center">
                        <?php if ($role >= 5 && $contentDetail['KGI']['showPercent'] !== '' && !empty($contentDetail['KGI']['KGIData']  ?? null)) { ?>
                        <?php if ($tab == 'self' ) { ?>
                        <button class="btn-update btn-KGI"
                            onclick="changeButtonTab('KGI','self',KGIData[currentKGIIndex].id)">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh-black.svg" class="mb-2"
                                style="width: 12px; height: 12px;">
                            <?= Yii::t('app', 'Updated') ?>
                        </button>
                        <?php } else if ($tab == 'team' ) { ?>
                        <button class="btn-update btn-KGI"
                            onclick="changeButtonTab('KGI','team',KGIData[currentKGIIndex].id)">
                            <img src=" <?= Yii::$app->homeUrl ?>images/icons/Settings/refresh-black.svg" class="mb-2"
                                style="width: 12px; height: 12px;">
                            <?= Yii::t('app', 'Update')  ?>
                        </button>
                        <?php } else { ?>
                        <button class="btn-update btn-KGI"
                            onclick="changeButtonTab('KGI','',KGIData[currentKGIIndex].kgiId)">
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
                    <div class="col-4 text-start">
                        <p class="small-textKGI mb-0"><?= Yii::t('app', 'Due Update Date') ?></p>
                        <strong class="small-text-value" id="KGI-due-0">-</strong>
                    </div>
                </div>

            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-4 pr-0 mb-3">
            <div class="dashboard-kpi-top"></div>
            <div class="dashboard-kpi-card p-3 position-relative">
                <div class="card-tab1">
                    <div class="row align-items-center">
                        <!-- Left Section -->
                        <div class="col-8 text-start">
                            <span class="key-title">
                                <div class="col-3">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/KPI.svg"
                                        style="width: 24px; height: 24px;">
                                </div>
                                <div class="col-9 card-title-text">
                                    <?= Yii::t('app', 'Key Performance Indicator') ?>
                                </div>

                            </span>
                        </div>
                        <!-- Right Section -->
                        <div class="col-4 text-end">
                            <span class="completion-percentage">
                                <?= isset($contentDetail['KPI']['showPercent']) && is_numeric($contentDetail['KPI']['showPercent']) ? $contentDetail['KPI']['showPercent'] : 0 ?>%
                            </span>
                            <span class="total-achievement"><?= Yii::t('app', 'Completed') ?></span>
                        </div>
                        <div class="col-12 total-progress-box">
                            <span class="total-progress"><?= Yii::t('app', 'Total Progress') ?></span>
                            <span>
                                <strong class="total-k">
                                    <?= Yii::t('app', 'Total KPI') ?>
                                </strong>
                                <strong class="k-total">
                                    <?= isset($contentDetail['KPI']['kpiCount']) && $contentDetail['KPI']['kpiCount'] !== '' ? $contentDetail['KPI']['kpiCount'] : 0 ?>
                                </strong>
                            </span>
                        </div>
                    </div>

                    <!-- Divider -->
                    <hr class="custom-hr-card">
                    <!-- Progress Bar -->
                    <div class="progress-dashboard-KPI">
                        <div class="progress-bar bg-KPI"
                            style="width: 
                            <?= isset($contentDetail['KPI']['showPercent']) && $contentDetail['KPI']['showPercent'] !== '' ? min($contentDetail['KPI']['showPercent'], 100) : 0 ?>%;"
                            role="progressbar"
                            aria-valuenow="<?= isset($contentDetail['KPI']['showPercent']) && $contentDetail['KPI']['showPercent'] !== '' ? min($contentDetail['KPI']['showPercent'], 100) : 0 ?>"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>


                <div class="card-tab2" id="KPI">
                    <div class="key-title-container" id="content-KPI">
                        <div class="col-9 d-flex">
                            <?php if ($tab == 'self' ) { ?>
                            <a class="key-total" id="KPI-name-0" href=""
                                onclick="viewButtonTab('KPI','self',KPIData[currentKPIIndex].id)"
                                style="text-decoration: none "><?= Yii::t('app', '-') ?></a>
                            <?php } else if ($tab == 'team' ) { ?>
                            <a class="key-total" id="KPI-name-0" href=""
                                onclick="viewButtonTab('KPI','team',KPIData[currentKPIIndex].id)"
                                style="text-decoration: none "><?= Yii::t('app', '-') ?></a>
                            <?php } else { ?>
                            <a class="key-total" id="KPI-name-0" href=""
                                onclick="viewButtonTab('KPI','',KPIData[currentKPIIndex].kpiId)"
                                style="text-decoration: none "><?= Yii::t('app', '-') ?></a>
                            <?php  } ?>
                        </div>
                        <div class="col-2 pr-6" style="display: flex; justify-content: flex-end; align-items: center;">

                            <button class="show-more-btn" onclick="changeKPIData('left')">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/btn-KPI-left.svg"
                                    style="margin-top: 1px; margin-left: 3px;">
                            </button>
                        </div>
                        <div class="col-1" style="display: flex; justify-content: flex-end; align-items: center;">
                            <button class="show-more-btn" onclick="changeKPIData('right')">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/btn-KPI-right.svg"
                                    style="margin-top: 1px; margin-left: 3px;">
                            </button>
                        </div>
                    </div>
                    <div class="key-detail-container" id="content-KPI-data-0">
                        <div class="col-4 text-center" id="KPI-data-0">
                            <div class="row">
                                <div class="col-md-9 col-sm-6">
                                    <div class="single-chart">
                                        <svg viewBox="0 0 36 36" class="circular-chart red">
                                            <path class="circle-bg" d="M18 2.0845
                                                a 15.9155 15.9155 0 0 1 0 31.831
                                                a 15.9155 15.9155 0 0 1 0 -31.831" />
                                            <path class="circle" id="KPI-progress" stroke-dasharray="0, 100" d="M18 2.0845
                                                a 15.9155 15.9155 0 0 1 0 31.831
                                                a 15.9155 15.9155 0 0 1 0 -31.831" />
                                            <!-- <text> สำหรับการแสดงเปอร์เซ็นต์ -->
                                            <text id="KPI-percentage" x="18" y="20.35" text-anchor="middle"
                                                dominant-baseline="middle" class="percentage">
                                                0%
                                            </text>
                                        </svg>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-4 text-start">
                            <small class="small-text-tr">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Target.svg" class="pim-iconKPI"
                                    style="margin-top: 1px; margin-right: 3px; ">
                                <?= Yii::t('app', 'Target') ?>
                            </small>
                            <br>
                            <strong class="bold-text" id="KPI-target-0">-</strong>
                        </div>
                        <div class="col-4 text-end">
                            <small class="small-text-tr">
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
                    <div class="col-4 text-end">
                        <p class="small-text-last mb-0"><?= Yii::t('app', 'Last Updated on') ?></p>
                        <strong class="small-text-value" id="KPI-last-0">-</strong>
                    </div>
                    <div class="col-4 text-center">
                        <?php if ($role >= 5 && $contentDetail['KPI']['showPercent'] !== '' && !empty($contentDetail['KPI']['KPIData']  ?? null)) { ?>
                        <?php if ($tab == 'self' ) { ?>
                        <button class="btn-update btn-KPI"
                            onclick="changeButtonTab('KPI','self',KPIData[currentKPIIndex].id)">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh.svg" class="mb-2"
                                style="width: 12px; height: 12px;">
                            <?= Yii::t('app', 'Updated') ?>
                        </button>
                        <?php } else if ($tab == 'team' ) { ?>
                        <button class="btn-update btn-KPI-0"
                            onclick="changeButtonTab('KPI','team',KPIData[currentKPIIndex].id)">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh.svg" class="mb-2"
                                style="width: 12px; height: 12px;">
                            <?= Yii::t('app', 'Update') ?>
                        </button>
                        <?php } else { ?>
                        <button class="btn-update btn-KPI-0"
                            onclick="changeButtonTab('KPI','',KPIData[currentKPIIndex].kpiId)">
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
                    <div class="col-4 text-start">
                        <p class="small-textKPI mb-0"><?= Yii::t('app', 'Due Update Date') ?></p>
                        <strong class="small-text-value" id="KPI-due-0">-</strong>
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
    // handleAjaxSuccess()
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

var $baseUrl = window.location.protocol + "/ / " + window.location.host;
if (window.location.host == 'localhost') {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/web/';
} else {
    $baseUrl = window.location.protocol + "//" + window.location.host + '/';
}
$url = $baseUrl;

document.addEventListener("DOMContentLoaded", () => {
    const progressBar = document.getElementById("progress-bar");

    // ตรวจสอบว่า element มีอยู่จริง
    if (!progressBar) {
        alert("Progress bar element not found");
        console.error("Progress bar element not found");
        return;
    }

    // ดึงค่าเป้าหมายจาก data-target
    const targetValue = parseInt(progressBar.getAttribute("data-target"), 10);

    if (isNaN(targetValue)) {
        alert("Invalid target value");
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