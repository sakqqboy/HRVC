<?php

use yii\bootstrap5\ActiveForm;

$this->title = 'KPI View';
?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<div class="col-12">
    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.svg" class="home-icon mr-5"
            style="margin-top: -3px;">
        <strong class="pim-head-text"> <?= Yii::t('app', 'Performance Indicator Matrices') ?> (PIM)</strong>
    </div>
    <div class="col-12 mt-10">
        <?= $this->render('kpi_header_filter', [
            "role" => $role
        ]) ?>
        <div class="alert mt-10 pim-body bg-white">
            <div class="row">
                <div class="col-11 pim-name-detail pr-0 pl-5 text-start">
                    <a href="<?= Yii::$app->homeUrl ?>kpi/management/grid" class="mr-5 font-size-12">
                        <i class="fa fa-caret-left mr-3" aria-hidden="true"></i>
                        <?= Yii::t('app', 'Back') ?>
                    </a>
                    <?= $kpiDetail["kpiName"] ?>
                </div>
                <div class="col-1">
                    <?php if ($role >= 5) {
                    ?>
                        <a class="btn btn-bg-red-xs" data-bs-toggle="modal" data-bs-target="#delete-kpi"
                            onclick="javascript:prepareDeleteKpi(<?= $kpiId ?>)"
                            onmouseover="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binwhite.svg'"
                            onmouseout="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg'">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg" alt="History"
                                class="pim-icon" style="margin-top: -3px; width: 12px; height: 14px;"> <?= Yii::t('app', 'Delete') ?>

                        </a>
                    <?php   }
                    ?>
                </div>
            </div>
            <div class="row mt-10">
                <div class="col-lg-7 col-12">
                    <?php
                    if ($kpiDetail["isOver"] == 1 && $kpiDetail["status"] != 2) {
                        $colorFormat = 'over';
                    } else {
                        if ($kpiDetail["status"] == 1) {
                            if ($kpiDetail["isOver"] == 2) {
                                $colorFormat = 'disable';
                            } else {
                                $colorFormat = 'inprogress';
                            }
                        } else {
                            $colorFormat = 'complete';
                        }
                    }
                    ?>
                    <div class="row">
                        <div class="col-4 pim-name-detail "> <?= Yii::t('app', 'Description') ?></div>
                        <div class="col-2">
                            <div class="<?= $colorFormat ?>-tag text-center">
                                <?= $kpiDetail['status'] == 1 ?     Yii::t('app', 'In process') :     Yii::t('app', 'Completed') ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-4 month-<?= $colorFormat ?> pt-2"> <?= Yii::t('app', 'Term') ?></div>
                                <div class="col-8 term-<?= $colorFormat ?>  pt-2">
                                    <?= $kpiDetail['fromDate'] == "" ? 'Not set' : $kpiDetail['fromDate'] ?>
                                    &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;
                                    <?= $kpiDetail['toDate'] == "" ? 'Not set' : $kpiDetail['toDate'] ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 pim-description mt-10">
                            <?= $kpiDetail["detail"] ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-12 pl-20">
                    <div class="col-12 pim-big-box pim-detail-<?= $colorFormat ?>">
                        <div class="row">
                            <div class="col-2 pim-subheader-font border-right-<?= $colorFormat ?>">
                                <div class="row">
                                    <div class="offset-1 col-8">
                                        <div class="text-center priority-star">
                                            <?php
                                            if ($kpiDetail["priority"] == "A" || $kpiDetail["priority"] == "B") {
                                            ?>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            <?php
                                            }
                                            if ($kpiDetail["priority"] == "A" || $kpiDetail["priority"] == "C") {
                                            ?>
                                                <i class="fa fa-star big-star" aria-hidden="true"></i>
                                            <?php
                                            }
                                            if ($kpiDetail["priority"] == "B") {
                                            ?>
                                                <i class="fa fa-star ml-10" aria-hidden="true"></i>
                                            <?php
                                            }
                                            if ($kpiDetail["priority"] == "A") {
                                            ?>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="text-center priority-box">
                                            <div class="col-12"> <?= Yii::t('app', 'Priority') ?></div>
                                            <div class="col-12 text-priority"><?= $kpiDetail["priority"] ?></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-3 pim-subheader-font border-right-<?= $colorFormat ?> pl-18">
                                <div class="col-12"><?= Yii::t('app', 'Quant Ratio') ?></div>
                                <div class="col-12 border-bottom-<?= $colorFormat ?> pb-5 pim-duedate">
                                    <i class="fa fa-diamond" aria-hidden="true"></i>
                                    <?= $kpiDetail["quantRatio"] == 1 ? Yii::t('app', 'Quantity') : Yii::t('app', 'Quality') ?>
                                </div>
                                <div class="col-12 pr-0 pt-5 pl-0"><?= Yii::t('app', 'Update Interval') ?></div>
                                <div class="col-12  pim-duedate">
                                    <?= $kpiDetail["unitText"] ?>
                                </div>
                            </div>
                            <div class="col-lg-7 pim-subheader-font pr-15 pl-15">
                                <div class="row">
                                    <div class="col-5 text-start">
                                        <div class="col-12"><?= Yii::t('app', 'Target') ?></div>
                                        <div class="col-12 mt-3 number-pim">
                                            <?php
                                            $decimal = explode('.', $kpiDetail["targetAmount"]);
                                            if (isset($decimal[1])) {
                                                if ($decimal[1] == '00') {
                                                    $show = $decimal[0];
                                                } else {
                                                    $show = $kpiDetail["targetAmount"];
                                                }
                                            } else {
                                                $show = $kpiDetail["targetAmount"];
                                            }
                                            ?>
                                            <?= $show ?><?= $kpiDetail["amountType"] == 1 ? '%' : '' ?>
                                        </div>
                                    </div>
                                    <div class="col-2 symbol-pim text-center">
                                        <div class="col-12 pt-17"><?= $kpiDetail["code"] ?></div>
                                    </div>
                                    <div class="col-5  text-end">
                                        <div class="col-12"><?= Yii::t('app', 'Result') ?></div>
                                        <div class="col-12 mt-3 number-pim">
                                            <?php
                                            if ($kpiDetail["result"] != '') {
                                                $decimalResult = explode('.', $kpiDetail["result"]);
                                                if (isset($decimalResult[1])) {
                                                    if ($decimalResult[1] == '00') {
                                                        $showResult = number_format($decimalResult[0]);
                                                    } else {
                                                        $showResult = number_format($kpiDetail["result"], 2);
                                                    }
                                                } else {
                                                    $showResult = number_format($kpiDetail["result"]);
                                                }
                                            } else {
                                                $showResult = 0;
                                            }
                                            ?>
                                            <?= $showResult ?><?= $kpiDetail["amountType"] == 1 ? '%' : '' ?>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <?php
                                        $percent = explode('.', $kpiDetail['ratio']);
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
                                                style="width:<?= $showPercent ?>%;"></div>
                                            <span
                                                class="progress-load load-<?= $colorFormat ?>"><?= $showPercent ?>%</span>
                                        </div>
                                    </div>
                                    <div class="col-4 mt-5 pl-0 pr-0 ">
                                        <div class="col-12 text-start" style="letter-spacing:0.3px;font-size:9px;">
                                            <?= Yii::t('app', 'Last Updated on') ?>
                                        </div>
                                        <div class="col-12 text-start pim-duedate">
                                            <?= $kpiDetail['nextCheckText'] == "" ? Yii::t('app', 'Not set') : $kpiDetail['nextCheckText'] ?>
                                        </div>
                                    </div>
                                    <div class="col-4 text-center mt-5 pt-6 pl-3 pr-3">
                                        <?php
                                        if ($role > 3  && $kpiDetail["status"] == 1) {
                                        ?>
                                            <div onclick="javascript:updateKpi(<?= $kpiId ?>)"
                                                class="pim-btn-<?= $colorFormat ?>" data-bs-toggle="modal"
                                                data-bs-target="#update-kpi-modal">
                                                <i class="fa fa-refresh" aria-hidden="true"></i> <?= Yii::t('app', 'Update') ?>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-4 pl-0 pr-5 mt-5 ">
                                        <div class="col-12 text-end font-<?= $colorFormat ?>"
                                            style="letter-spacing:0.3px;font-size:9px;">
                                            <?= Yii::t('app', 'Next Update Date') ?>
                                        </div>
                                        <div class="col-12 text-end pim-duedate">
                                            <?= $kpiDetail['nextCheckText'] == "" ? 'Not set' : $kpiDetail['nextCheckText'] ?>
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
                            onclick="javascript:viewTabKpi(<?= $kpiHistoryId ?>,1)">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-blue.svg" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;" id="tab-1-blue">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-black.svg" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;display:none;" id="tab-1-black">
                            <?= Yii::t('app', 'Assigned') ?>
                        </div>
                        <div class="col-3  view-tab" id="tab-2" onclick="javascript:viewTabKpi(<?= $kpiHistoryId ?>,2)">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh-black.svg" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;" id="tab-2-black">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh-blue.svg" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;display:none;" id="tab-2-blue">
                            <?= Yii::t('app', 'Update History') ?>
                        </div>
                        <div class="col-2  view-tab" id="tab-3" onclick="javascript:viewTabKpi(<?= $kpiHistoryId ?>,3)">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;" id="tab-3-black">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment-blue.svg" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;display:none;" id="tab-3-blue">
                            <?= Yii::t('app', 'Chats') ?>
                        </div>
                        <div class="col-2  view-tab" id="tab-4" onclick="javascript:viewTabKpi(<?= $kpiHistoryId ?>,4)">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.svg" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;" id="tab-4-black">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart-blue.svg" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;display:none;" id="tab-4-blue">
                            <?= Yii::t('app', 'Chart') ?>
                        </div>
                        <div class="col-3  view-tab" id="tab-5" onclick="javascript:viewTabKpi(<?= $kpiHistoryId ?>,5)">
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
            //    viewTabKpi(<?= $kpiHistoryId ?>, openTab); // Set the tab based on the PHP value
        } else {
            //    viewTabKpi(<?= $kpiHistoryId ?>, 1); // Default to tab 1 if no value is passed
        }
    }
</script>