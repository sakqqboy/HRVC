<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'KPI View';
?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<div class="contrainer-body">
    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.svg" class="home-icon mr-5"
            style="margin-top: -3px;">
        <strong class="pim-head-text"> <?= Yii::t('app', 'Performance Indicator Matrices') ?> (PIM)</strong>
    </div>
    <div class="col-12 mt-10">
        <?= $this->render('kpi_header_filter', [
            "role" => $role
        ]) ?>
        <?php
        if ($kpiEmployeeDetail["isOver"] == 1 && $kpiEmployeeDetail["status"] != 2) {
            $colorFormat = 'over';
        } else {
            if ($kpiEmployeeDetail["status"] == 1) {
                if ($kpiEmployeeDetail["isOver"] == 2) {
                    $colorFormat = 'disable';
                } else {
                    $colorFormat = 'inprogress';
                }
            } else {
                $colorFormat = 'complete';
            }
        }
        ?>
        <div class="alert mt-10 pim-body bg-white">
            <div class="row">
                <div class="col-7 pim-name-title pr-0 pl-5 text-start">
                    <a href="javascript:history.back()" class="mr-5 pim-text-back">
                        <i class="fa fa-caret-left mr-3" aria-hidden="true"></i>
                        <?= Yii::t('app', 'Back') ?>
                    </a>
                    <?= $kpiEmployeeDetail["kpiName"] ?>
                </div>
                <div class="col-5 d-flex justify-content-end align-items-center">
                    <span class="team-wrapper <?= $colorFormat ?>-teamshow"
                        style="margin-right: 5px; padding-right: 5px;">
                        <span class="team-icon pim-team-<?= $colorFormat ?>">
                            <img src="/HRVC/frontend/web/images/icons/Settings/teamwhite.svg" alt="Team Icon">
                        </span>
                        <?= $kpiEmployeeDetail["teamName"] ?>
                    </span>
                    <span class="team-wrapper <?= $colorFormat ?>-teamshow"
                        style="margin-right: 5px; padding-right: 5px;">
                        <span class="team-icon pim-team-<?= $colorFormat ?>">
                            <?php if (!empty($kpiEmployeeDetail['picture'])): ?>
                                <img src="<?= Yii::$app->homeUrl . $kpiEmployeeDetail['picture'] ?>" alt="Team Icon"
                                    style="border-radius: 100%;">
                            <?php else: ?>
                                <img src="/HRVC/frontend/web/image/user.svg" alt="Team Icon">
                            <?php endif; ?>
                        </span>
                        <span class="team-name"> <?= $kpiEmployeeDetail['employeeName']; ?></span>
                    </span>
                    <?php if ($role >= 5) {
                    ?>
                        <a class="btn btn-bg-red-xs" data-bs-toggle="modal" data-bs-target="#delete-kpi-employee"
                            onclick="javascript:prepareDeleteKpi(<?= $kpiId ?>)"
                            onmouseover="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binwhite.svg'"
                            onmouseout="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg'">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg" alt="History"
                                class="pim-icon" style="margin-top: -3px; width: 12px; height: 14px;">
                            <?= Yii::t('app', 'Delete') ?>

                        </a>
                    <?php } ?>
                </div>
            </div>
            <div class="row mt-10">
                <div class="col-lg-7 col-12">

                    <div class="row">
                        <div class="col-4 pim-name-detail "><?= Yii::t('app', 'Description') ?></div>
                        <div class="col-2">
                            <div class="<?= $colorFormat ?>-tag text-center">
                                <?= $kpiEmployeeDetail['status'] == 1 ? Yii::t('app', 'In process') : Yii::t('app', 'Completed') ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-4 month-<?= $colorFormat ?> pt-2">
                                    <?= $kpiEmployeeDetail['monthName'] ?? Yii::t('app', 'Term') ?>
                                </div>
                                <div class="col-8 term-<?= $colorFormat ?>  pt-2">
                                    <?= $kpiEmployeeDetail['fromDate'] == "" ?  Yii::t('app', 'Not set') : $kpiEmployeeDetail['monthName'] ?>
                                    &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;
                                    <?= $kpiEmployeeDetail['toDate'] == "" ?  Yii::t('app', 'Not set') : $kpiEmployeeDetail['toDate'] ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 pim-description mt-10">
                            <?= $kpiEmployeeDetail["detail"] ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-12 pl-20">
                    <div class="col-12 pim-big-box pim-detail-<?= $colorFormat ?>">
                        <div class="row">
                            <div class="col-2 pim-subheader-font border-right-<?= $colorFormat ?>"
                                style=" display: flex; flex-direction: column; justify-content: center;">
                                <!-- <div class="row">
                                    <div class="offset-1 col-8"> -->
                                <div class="ml-12 priority-star">
                                    <?php
                                    if ($kpiEmployeeDetail["priority"] == "A" || $kpiEmployeeDetail["priority"] == "B") {
                                    ?>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    <?php
                                    }
                                    if ($kpiEmployeeDetail["priority"] == "A" || $kpiEmployeeDetail["priority"] == "C") {
                                    ?>
                                        <i class="fa fa-star big-star" aria-hidden="true"></i>
                                    <?php
                                    }
                                    if ($kpiEmployeeDetail["priority"] == "B") {
                                    ?>
                                        <i class="fa fa-star ml-10" aria-hidden="true"></i>
                                    <?php
                                    }
                                    if ($kpiEmployeeDetail["priority"] == "A") {
                                    ?>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="text-center priority-box">
                                    <div class="col-12"><?= Yii::t('app', 'Priority') ?></div>
                                    <div class="col-12 text-priority"><?= $kpiEmployeeDetail["priority"] ?>
                                    </div>
                                </div>
                                <!-- </div>
                                </div> -->

                            </div>
                            <div class="col-lg-3 pim-subheader-font border-right-<?= $colorFormat ?> pl-18">
                                <div class="col-12"><?= Yii::t('app', 'Quant Ratio') ?></div>
                                <div class="col-12 border-bottom-<?= $colorFormat ?> pb-5 pim-duedate">
                                    <i class="fa fa-diamond" aria-hidden="true"></i>
                                    <?= $kpiEmployeeDetail["quantRatio"] == 1 ? Yii::t('app', 'Quantity') : Yii::t('app', 'Quality') ?>
                                </div>
                                <div class="col-12 pr-0 pt-5 pl-0"><?= Yii::t('app', 'Update Interval') ?></div>
                                <div class="col-12  pim-duedate">
                                    <?= $kpiEmployeeDetail["unitText"] ?>
                                </div>
                            </div>
                            <div class="col-lg-7 pim-subheader-font pr-15 pl-15">
                                <div class="row">
                                    <div class="col-5 text-start">
                                        <div class="col-12"><?= Yii::t('app', 'Target') ?></div>
                                        <div class="col-12 mt-3 number-pim">
                                            <?php
                                            $decimal = explode('.', $kpiEmployeeDetail["targetAmount"]);
                                            if (isset($decimal[1])) {
                                                if ($decimal[1] == '00') {
                                                    $show = $decimal[0];
                                                } else {
                                                    $show = $kpiEmployeeDetail["targetAmount"];
                                                }
                                            } else {
                                                $show = $kpiEmployeeDetail["targetAmount"];
                                            }
                                            ?>
                                            <?= number_format($show) ?><?= $kpiEmployeeDetail["amountType"] == 1 ? '%' : '' ?>
                                        </div>
                                    </div>
                                    <div class="col-2 symbol-pim text-center">
                                        <div class="col-12 pt-17"><?= $kpiEmployeeDetail["code"] ?></div>
                                    </div>
                                    <div class="col-5  text-end">
                                        <div class="col-12"><?= Yii::t('app', 'Result') ?></div>
                                        <div class="col-12 mt-3 number-pim">
                                            <?php
                                            if ($kpiEmployeeDetail["result"] != '') {
                                                $decimalResult = explode('.', $kpiEmployeeDetail["result"]);
                                                if (isset($decimalResult[1])) {
                                                    if ($decimalResult[1] == '00') {
                                                        $showResult = number_format($decimalResult[0]);
                                                    } else {
                                                        $showResult = number_format($kpiEmployeeDetail["result"], 2);
                                                    }
                                                } else {
                                                    $showResult = number_format($kpiEmployeeDetail["result"]);
                                                }
                                            } else {
                                                $showResult = 0;
                                            }
                                            ?>
                                            <?= $showResult ?><?= $kpiEmployeeDetail["amountType"] == 1 ? '%' : '' ?>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <?php
                                        $percent = explode('.', $kpiEmployeeDetail['ratio']);
                                        if (isset($percent[1])) {
                                            if ($percent[1] != '00') {
                                                $showPercent = $percent[1];
                                            } else {
                                                $showPercent = $percent[0];
                                            }
                                        } else {
                                            $showPercent = $percent[0];
                                        }
                                        ?>
                                        <div class="progress">
                                            <div class="progress-bar-<?= $colorFormat ?>"
                                                style="width:<?= $showPercent ?>%;  max-width: 100%;"></div>
                                            <span
                                                class="progress-load load-<?= $colorFormat ?>"><?= $showPercent ?>%</span>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-10 align-items-center">
                                        <div class="row">
                                            <div class="col-4 mt-5 pl-0 pr-0 ">
                                                <div class="col-12 text-end"
                                                    style="letter-spacing:0.3px;font-size:12px;">
                                                    <?= Yii::t('app', 'Last Updated on') ?>
                                                </div>
                                                <div class="col-12 text-end pim-duedate">
                                                    <?= $kpiEmployeeDetail['nextCheckText'] == "" ? Yii::t('app', 'Not set') : $kpiEmployeeDetail['nextCheckText'] ?>
                                                </div>
                                            </div>
                                            <div class="col-4 text-center mt-5 pt-6 pl-8 pr-8">
                                                <?php
                                                if ($role > 3  && $kpiEmployeeDetail["status"] == 1) {
                                                ?>
                                                    <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/update-personal-kpi/<?= ModelMaster::encodeParams(['kpiEmployeeId' => $kpiEmployeeId, 'kpiHistoryId' => 0]) ?>"
                                                        class="pim-btn-<?= $colorFormat ?>"
                                                        style="display: flex; justify-content: center; align-items: center; padding: 7px 9px;  height: 30px; gap: 6px; flex-shrink: 0;">
                                                        <i class="fa fa-refresh" aria-hidden="true"></i>
                                                        <?= Yii::t('app', 'Update') ?>
                                                    </a>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="col-4 pl-0 pr-5 mt-5 ">
                                                <div class="col-12 text-start font-<?= $colorFormat ?>"
                                                    style="letter-spacing:0.3px;font-size:12px;">
                                                    <?= Yii::t('app', 'Next Update Date') ?>
                                                </div>
                                                <div class="col-12 text-start pim-duedate">
                                                    <?= $kpiEmployeeDetail['nextCheckText'] == "" ? Yii::t('app', 'Not set') : $kpiEmployeeDetail['nextCheckText'] ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-2  view-tab-active" id="tab-1"
                            onclick="javascript:viewTabEmployeeKpi(<?= $kpiEmployeeHistoryId ?>,<?= $kpiEmployeeId ?>,1)">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-blue.svg" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;" id="tab-1-blue">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-black.svg" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;display:none;" id="tab-1-black">
                            <?= Yii::t('app', 'Assigned') ?>
                        </div>
                        <div class="col-3  view-tab" id="tab-2"
                            onclick="javascript:viewTabEmployeeKpi(<?= $kpiEmployeeHistoryId ?>,<?= $kpiEmployeeId ?>,2)">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh-black.svg" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;" id="tab-2-black">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh-blue.svg" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;display:none;" id="tab-2-blue">
                            <?= Yii::t('app', 'Update History') ?>
                        </div>
                        <div class="col-2  view-tab" id="tab-3"
                            onclick="javascript:viewTabEmployeeKpi(<?= $kpiEmployeeHistoryId ?>,<?= $kpiEmployeeId ?>,3)">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;" id="tab-3-black">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment-blue.svg" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;display:none;" id="tab-3-blue">
                            <?= Yii::t('app', 'Chats') ?>
                        </div>
                        <div class="col-2  view-tab" id="tab-4"
                            onclick="javascript:viewTabEmployeeKpi(<?= $kpiEmployeeHistoryId ?>,<?= $kpiEmployeeId ?>,4)">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.svg" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;" id="tab-4-black">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart-blue.svg" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;display:none;" id="tab-4-blue">
                            <?= Yii::t('app', 'Chart') ?>
                        </div>
                        <div class="col-3  view-tab" id="tab-5"
                            onclick="javascript:viewTabEmployeeKpi(<?= $kpiEmployeeHistoryId ?>,<?= $kpiEmployeeId ?>,5)">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/relate.svg" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;" id="tab-5-black">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/relate-blue.svg" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;display:none;" id="tab-5-blue">
                            <?= Yii::t('app', 'Relate KGI') ?>
                        </div>
                        <input type="hidden" id="currentTab" value="1">
                    </div>
                </div>
                <div class="col-lg-5 view-tab">
                </div>
            </div>
            <div class="row mt-10" id="show-content">

            </div>
        </div>
    </div>
</div>
<input type="hidden" id="kpiId" value="<?= $kpiId ?>">
<input type="hidden" id="kpiEmployeeId" value="<?= $kpiEmployeeId ?>">
<input type="hidden" id="month" value="<?= $kpiEmployeeDetail['month'] ?>">
<input type="hidden" id="year" value="<?= $kpiEmployeeDetail['year'] ?>">
<input type="hidden" id="viewType" value="grid">
<?php
$form = ActiveForm::begin([
    'id' => 'update-kpi',
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
    'action' => Yii::$app->homeUrl . 'kpi/management/update-kpi'

]); ?>
<?= $this->render('modal_update_kpi', [
    "units" => $units,
    "companies" => $companies,
    "months" => $months,
    "isManager" => $isManager
]) ?>
<?php ActiveForm::end(); ?>
<?= $this->render('modal_delete') ?>
<?= $this->render('modal_employee_history') ?>


<script>
    // Optionally set a default tab to be active on page load
    window.onload = function() {
        let openTab = <?php echo json_encode($openTab); ?>; // PHP value passed to JavaScript
        if (openTab) {
            viewTabEmployeeKpi(<?= $kpiEmployeeHistoryId ?>,
                <?= $kpiEmployeeId ?>, openTab); // Set the tab based on the PHP value
        } else {
            viewTabEmployeeKpi(<?= $kpiEmployeeHistoryId ?>,
                <?= $kpiEmployeeId ?>, 1); // Default to tab 1 if no value is passed
        }
    }
</script>