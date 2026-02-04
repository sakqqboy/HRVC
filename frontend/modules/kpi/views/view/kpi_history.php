<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = Yii::t('app', 'KPI View');
?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<div class="col-12 mt-70 pt-20 pim-content1">
    <div class="d-flex justify-content-start pt-0 pb-0" style="line-height: 30px;">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Group23177.svg"
            class="pim-head-icon mr-11 mt-2">
        <span class="pim-head-text mr-10"> <?= Yii::t('app', 'Performance Indicator Matrices') ?> (<?= Yii::t('app', 'PIM') ?>)</span>
    </div>
    <?= $this->render('kpi_header_filter', [
        "role" => $role,
        "allCompany" => $allCompany,
        "companyPic" => $companyPic,
        "totalBranch" => $totalBranch
    ]) ?>
    <div class="col-12 mt-10">
        <div class="alert mt-20 pim-body bg-white" style="border: 1px solid #BBCDDE;">
            <div class="row" style="--bs-gutter-x:0px;">
                <div class="col-11 pim-name-title" style="display: flex; align-items: center; gap: 14px;">
                    <!-- <a href="<?= Yii::$app->homeUrl ?>kpi/management/grid" class="mr-5 pim-text-back">
                        <i class="fa fa-caret-left mr-3" aria-hidden="true"></i>
                        <?= Yii::t('app', 'Back') ?>
                    </a> -->
                    <a href="<?= isset(Yii::$app->request->referrer) ? Yii::$app->request->referrer : Yii::$app->homeUrl . 'kpi/management/grid' ?>" 
                    style="text-decoration: none; width:66px; height:26px;" class="btn-create-branch">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/back-white.svg" style="width:18px; height:18px; margin-top:-3px;">
                                <?= Yii::t('app', 'Back') ?>        
                    </a>
                    <?= $kpiDetail["kpiName"] ?>
                </div>
                <div class="col-1" style="justify-items: end;">
                    <?php if ($role >= 5) {
                    ?>
                        <a class="btn btn-outline-danger d-flex justify-content-center align-items-center" data-bs-toggle="modal"
                            data-bs-target="#delete-kpi" onclick="javascript:prepareDeletekpi(<?= $kpiId ?>)"
                            style="height: 25px;font-size:13px;width:60px;"
                            onmouseover="this.querySelector('.pim-action-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binwhite.svg'"
                            onmouseout="this.querySelector('.pim-action-icon').src='<?= Yii::$app->homeUrl ?>images/icons/pim/binred.svg'">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/binred.svg" class="pim-action-icon mr-3" style="margin-top: -1px;">
                            <?= Yii::t('app', 'Delete') ?>

                        </a>
                    <?php } ?>
                </div>
            </div>
            <div class="row mt-20" style="--bs-gutter-x:0px;">
                <div class="col-lg-7 col-12 pr-10">
                    <?php
                    if ($kpiDetail["isOver"] == 1 && $kpiDetail["status"] != 2) {
                        $colorFormat = 'over';
                        $text = 'Due Passed';
                    } else {
                        if ($kpiDetail["status"] == 1) {
                            if ($kpiDetail["isOver"] == 2) {
                                $colorFormat = 'disable';
                                $text = 'Not Set';
                            } else {
                                $colorFormat = 'inprogress';
                                $text = 'In Progress';
                            }
                        } else {
                            $colorFormat = 'complete';
                            $text = 'Completed';
                        }
                    }
                    ?>
                    <div class="row">
                        <div class="col-4 pim-name-detail align-items-center "><?= Yii::t('app', 'Description') ?></div>
                        <div class="col-2">
                            <div class="status-tag <?= $colorFormat ?>-tag text-center">
                                <?= Yii::t('app', $text) ?>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-4 month-period month-<?= $colorFormat ?>">
                                    <?= $kpiDetail['monthFullName'] ?? Yii::t('app', 'Term') ?>
                                </div>
                                <div class="col-8 term-period term-<?= $colorFormat ?>">
                                    <?= $kpiDetail['fromDate'] == "" ? Yii::t('app', 'Not set') : $kpiDetail['fromDate'] ?>
                                    &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;
                                    <?= $kpiDetail['toDate'] == "" ? Yii::t('app', 'Not set') : $kpiDetail['toDate'] ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 pim-description mt-10">
                            <?= $kpiDetail["detail"] ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-12">
                    <div class="col-12 pim-big-box pim-detail-<?= $colorFormat ?>">
                        <div class="row">
                            <div class="col-2 pim-subheader-font border-right-<?= $colorFormat ?>"
                                style=" display: flex; flex-direction: column; align-items: center;justify-content:center;">
                                <div class="priority-star">
                                    <?php
                                    if ($kpiDetail["priority"] == "A" || $kpiDetail["priority"] == "B") {
                                    ?>
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/star.svg" class="default-star">
                                    <?php
                                    }
                                    if ($kpiDetail["priority"] == "A" || $kpiDetail["priority"] == "C") {
                                    ?>
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/star.svg" class="big-star">
                                    <?php
                                    }
                                    if ($kpiDetail["priority"] == "B") {
                                    ?>
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/star.svg" class="default-star">
                                    <?php
                                    }
                                    if ($kpiDetail["priority"] == "A") {
                                    ?>
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/star.svg" class="default-star">
                                    <?php
                                    }
                                    ?>
                                </div>
                                <?php
                                if ($kpiDetail["priority"] != '') {
                                ?>
                                    <div class="priority-box">
                                        <?= Yii::t('app', 'Priority') ?>
                                        <span class="text-priority mt-5"><?= $kpiDetail["priority"] ?></span>
                                    </div>
                                <?php
                                } else { ?>
                                    <div class="priority-box-null">
                                        <?= Yii::t('app', 'Priority') ?>
                                        <span class="text-priority mt-5"><?= Yii::t('app', 'N/A') ?></span>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-lg-3 pt-10 pim-subheader-font border-right-<?= $colorFormat ?>">
                                <div class="col-12 font-size-12"><?= Yii::t('app', 'Quant Ratio') ?></div>
                                <div class="col-12 border-bottom-<?= $colorFormat ?> pb-5 pim-duedate">
                                    <i class="fa fa-diamond" aria-hidden="true"></i>
                                    <?= $kpiDetail["quantRatio"] == 1 ?  Yii::t('app', 'Quantity') : Yii::t('app', 'Quality') ?>
                                </div>
                                <div class="col-12 pr-0 pt-5 pl-0 font-size-12"><?= Yii::t('app', 'update Interval') ?>
                                </div>
                                <div class="col-12  pim-duedate">
                                    <?= $kpiDetail["unitText"] ?>
                                </div>
                            </div>
                            <div class="col-lg-7 pim-subheader-font pr-15 pl-15">
                                <div class="row">
                                    <div class="col-5 text-start">
                                        <div class="col-12 font-size-12"><?= Yii::t('app', 'Target') ?></div>
                                        <div class="col-12 mt-3 number-pim">
                                            <?php
                                            $decimal = explode('.', $kpiDetail["targetAmount"]);
                                            if (isset($decimal[1])) {
                                                if ($decimal[1] == '00') {
                                                    $show = number_format($decimal[0]);
                                                } else {
                                                    $show = number_format($kpiDetail["targetAmount"]);
                                                }
                                            } else {
                                                $show = number_format($kpiDetail["targetAmount"]);
                                            }
                                            ?>
                                            <?= $show ?><?= $kpiDetail["amountType"] == 1 ? '%' : '' ?>
                                        </div>
                                    </div>
                                    <div class="col-2 symbol-pim text-center">
                                        <div class="col-12 pt-17"><?= $kpiDetail["code"] ?></div>
                                    </div>
                                    <div class="col-5  text-end">
                                        <div class="col-12 font-size-12"><?= Yii::t('app', 'Result') ?></div>
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
                                    <div class="col-12 mt-10">
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
                                    <div class="col-12 mt-10 align-items-center">
                                        <div class="row">
                                            <div class="col-4 mt-5 pl-0 pr-0 ">
                                                <div class="col-12 text-end" style="font-size:10px;">
                                                    <?= Yii::t('app', 'Last Updated on') ?>
                                                </div>
                                                <div class="col-12 text-end pim-duedate">
                                                    <?= $kpiDetail['nextCheckText'] == "" ? Yii::t('app', 'Not set') : $kpiDetail['nextCheckText'] ?>
                                                </div>
                                            </div>
                                            <div class="col-4 text-center mt-5 pt-6 pl-8 pr-8">
                                                <?php
                                                if ($role > 3  && $kpiDetail["status"] == 1) {
                                                ?>
                                                    <a class="pim-btn-<?= $colorFormat ?>"
                                                        href="<?= Yii::$app->homeUrl . 'kpi/management/prepare-update/' . ModelMaster::encodeParams(['kpiId' => $kpiId, 'kpiHistoryId' => 0]) ?>"
                                                        style="display: flex; justify-content: center; align-items: center;  height: 30px; gap: 3px; flex-shrink: 0;">
                                                        <i class="fa fa-refresh" aria-hidden="true"></i>
                                                        <?= Yii::t('app', 'Update') ?>
                                                    </a>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="col-4 pl-0 pr-0 mt-5 ">
                                                <div class="col-12 text-start font-<?= $colorFormat ?>"
                                                    style="font-size:10px;">
                                                    <?= Yii::t('app', 'Next Update Date') ?>
                                                </div>
                                                <div class="col-12 text-start pim-duedate">
                                                    <?= $kpiDetail['nextCheckText'] == "" ?  Yii::t('app', 'Not set') : $kpiDetail['nextCheckText'] ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-12 mt-20">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="d-flex justify-content-start">
                            <div class="view-tab-active" id="tab-1"
                                style="border-top-left-radius:5px;border-top-right-radius:5px;"
                                onclick="javascript:viewTabKpi(<?= $kpiHistoryId ?>,1)">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-blue.svg" alt="History"
                                    class="pim-icon " id="tab-1-blue">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-black.svg" alt="History"
                                    class="pim-icon " style="display:none;" id="tab-1-black">
                                <?= Yii::t('app', 'Assigned') ?>
                            </div>
                            <div class="view-tab" id="tab-2" onclick="javascript:viewTabKpi(<?= $kpiHistoryId ?>,2)">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh-black.svg"
                                    alt="History" class="pim-icon " id="tab-2-black">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh-blue.svg" alt="History"
                                    class="pim-icon " style="display:none;" id="tab-2-blue">
                                <?= Yii::t('app', 'Update History') ?>
                            </div>
                            <div class="view-tab" id="tab-3" onclick="javascript:viewTabKpi(<?= $kpiHistoryId ?>,3)">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg" alt="History"
                                    class="pim-icon " id="tab-3-black">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment-blue.svg" alt="History"
                                    class="pim-icon " style="display:none;" id="tab-3-blue">
                                <?= Yii::t('app', 'Chats') ?>
                            </div>
                            <div class=" view-tab" id="tab-4" onclick="javascript:viewTabKpi(<?= $kpiHistoryId ?>,4)">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/chart.svg" alt="History"
                                    class="pim-icon" id="tab-4-black">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart-blue.svg" alt="History"
                                    class="pim-icon" style="display:none;" id="tab-4-blue">
                                <?= Yii::t('app', 'Chart') ?>
                            </div>
                            <div class="view-tab" id="tab-5"
                                style="border-top-left-radius:5px;border-top-right-radius:5px;"
                                onclick="javascript:viewTabKpi(<?= $kpiHistoryId ?>,5)">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/relate.svg" alt="History"
                                    class="pim-icon " id="tab-5-black">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/relate-blue.svg" alt="History"
                                    class="pim-icon " style="display:none;" id="tab-5-blue">
                                <?= Yii::t('app', 'Relate KGI') ?>
                            </div>
                        </div>
                        <input type="hidden" id="currentTab" value="1">
                    </div>
                    <div class="col-lg-4">
                    </div>
                </div>
            </div>
            <div class="row mt-20" id="show-content">

            </div>
        </div>
    </div>
</div>
<input type="hidden" id="kpiId" value="<?= $kpiId ?>">
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

<?php ActiveForm::end(); ?>
<?= $this->render('modal_delete') ?>
<?= $this->render('modal_employee_history') ?>


<style>
    .priority-box {
        width: 52px;
        height: 52px;
        font-size: 12px;
    }

    .priority-box-null {
        width: 52px;
        height: 52px;
        font-size: 12px;
    }

    .text-priority {
        font-size: 18px;
    }

    .priority-star {
        width: 52px;
    }

    .big-star {
        width: 18px;
        height: 17px;
    }

    .default-star {
        width: 16px;
        width: 15px;
    }

    .pim-big-box {
        height: 110px;
        padding-top: 5px;
    }
</style>
<script>
    window.onload = function() {
        let openTab = <?= $openTab ?>; // PHP value passed to JavaScript
        if (openTab) {
            viewTabKpi(<?= $kpiHistoryId ?>, openTab); // Set the tab based on the PHP value
        } else {
            viewTabKpi(<?= $kpiHistoryId ?>, 1); // Default to tab 1 if no value is passed
        }
    }
</script>