<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'KFI View';
?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
<div class="col-12">

    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.png" class="home-icon mr-5"
            style="margin-top: -3px;">
        <strong class="pim-head-text"> Performance Indicator Matrices (PIM)</strong>
    </div>
    <div class="col-12 mt-10">
        <?= $this->render('kfi_header_filter', [
            "role" => $role
        ]) ?>
        <div class="alert mt-10 pim-body bg-white">
            <div class="row">
                <div class="col-11 pim-name-detail pr-0 pl-5 pt-2  text-start">
                    <a href="<?= Yii::$app->request->referrer ? Yii::$app->request->referrer : Yii::$app->homeUrl . 'kfi/management/grid' ?>" class="mr-5 font-size-12">
                        <i class="fa fa-caret-left mr-3" aria-hidden="true"></i>
                        Back
                    </a>
                    <?= $kfiDetail["kfiName"] ?>
                </div>
                <div class="col-1">
                    <a class="btn btn-bg-red-xs" data-bs-toggle="modal" data-bs-target="#staticBackdrop4"
                        onclick="javascript:prepareDeleteKfi(<?= $kfiId ?>)"
                        onmouseover="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binwhite.svg'"
                        onmouseout="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg'">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg" alt="History"
                            class="pim-icon" style="margin-top: -3px; width: 12px; height: 14px;">
                        Delete
                    </a>
                </div>

            </div>
            <div class="row mt-10">
                <div class="col-lg-7 col-12">
                    <?php
                    if ($kfiDetail["isOver"] == 1 && $kfiDetail["status"] != 2) {
                        $colorFormat = 'over';
                    } else {
                        if ($kfiDetail["status"] == 1) {
                            if ($kfiDetail["isOver"] == 2) {
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
                        <div class="col-4 pim-name-detail ">Description</div>
                        <div class="col-2">
                            <div class="<?= $colorFormat ?>-tag text-center">
                                <?= $kfiDetail['status'] == 1 ? 'In process' : 'Completed' ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-4 month-<?= $colorFormat ?> pt-2">Term</div>
                                <div class="col-8 term-<?= $colorFormat ?>  pt-2">
                                    <?= $kfiDetail['fromDate'] == "" ? 'Not set' : $kfiDetail['fromDate'] ?>
                                    &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;
                                    <?= $kfiDetail['toDate'] == "" ? 'Not set' : $kfiDetail['toDate'] ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 pim-description mt-10">
                            <?= $kfiDetail["detail"] ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-12 pl-20">
                    <div class="col-12 pim-big-box pim-detail-<?= $colorFormat ?>">
                        <div class="row">
                            <div class="col-lg-4 pim-subheader-font border-right-<?= $colorFormat ?> pl-18">
                                <div class="col-12">Quant Ratio</div>
                                <div class="col-12 border-bottom-<?= $colorFormat ?> pb-5 pim-duedate">
                                    <i class="fa fa-diamond" aria-hidden="true"></i>
                                    <?= $kfiDetail["quantRatio"] == 1 ? 'Quantity' : 'Quality' ?>
                                </div>
                                <div class="col-12 pr-0 pt-5 pl-0">update Interval</div>
                                <div class="col-12  pim-duedate">
                                    <?= $kfiDetail["unit"] ?>
                                </div>
                            </div>
                            <div class="col-lg-8 pim-subheader-font pr-15 pl-15">
                                <div class="row">
                                    <div class="col-5 text-start">
                                        <div class="col-12">Target</div>
                                        <div class="col-12 mt-3 number-pim">
                                            <?php
                                            $decimal = explode('.', $kfiDetail["targetAmount"]);
                                            if (isset($decimal[1])) {
                                                if ($decimal[1] == '00') {
                                                    $show = $decimal[0];
                                                } else {
                                                    $show = $kfiDetail["targetAmount"];
                                                }
                                            } else {
                                                $show = $kfiDetail["targetAmount"];
                                            }
                                            ?>
                                            <?= $show ?><?= $kfiDetail["amountType"] == 1 ? '%' : '' ?>
                                        </div>
                                    </div>
                                    <div class="col-2 symbol-pim text-center">
                                        <div class="col-12 pt-17"><?= $kfiDetail["code"] ?></div>
                                    </div>
                                    <div class="col-5  text-end">
                                        <div class="col-12">Result</div>
                                        <div class="col-12 mt-3 number-pim">
                                            <?php
                                            if ($kfiDetail["result"] != '') {
                                                $decimalResult = explode('.', $kfiDetail["result"]);
                                                if (isset($decimalResult[1])) {
                                                    if ($decimalResult[1] == '00') {
                                                        $showResult = number_format($decimalResult[0]);
                                                    } else {
                                                        $showResult = number_format($kfiDetail["result"], 2);
                                                    }
                                                } else {
                                                    $showResult = number_format($kfiDetail["result"]);
                                                }
                                            } else {
                                                $showResult = 0;
                                            }
                                            ?>
                                            <?= $showResult ?><?= $kfiDetail["amountType"] == 1 ? '%' : '' ?>
                                        </div>
                                    </div>
                                    <div class="col-12">

                                        <?php
                                        $percent = explode('.', $kfiDetail['ratio']);
                                        if (isset($percent[0]) && $percent[0] == '0') {
                                            if (isset($percent[1])) {
                                                if ($percent[1] == '00') {
                                                    $showPercent = 0;
                                                } else {
                                                    $showPercent = round($kfiDetail['ratio'], 1);
                                                }
                                            }
                                        } else {
                                            $showPercent = round($kfiDetail['ratio']);
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
                                            Last Updated on
                                        </div>
                                        <div class="col-12 text-start pim-duedate">
                                            <?= $kfiDetail['nextCheck'] == "" ? 'Not set' : $kfiDetail['nextCheck'] ?>
                                        </div>
                                    </div>
                                    <div class="col-4 text-center mt-5 pt-6 pl-3 pr-3">
                                        <?php
                                        if ($role > 3  && $kfiDetail["status"] == 1) {
                                        ?>
                                            <div onclick="javascript:updateKfi(<?= $kfiId ?>)"
                                                class="pim-btn-<?= $colorFormat ?>" data-bs-toggle="modal"
                                                data-bs-target="#update-kfi-modal">
                                                <i class="fa fa-refresh" aria-hidden="true"></i> Update
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-4 pl-0 pr-5 mt-5 ">
                                        <div class="col-12 text-end font-<?= $colorFormat ?>"
                                            style="letter-spacing:0.3px;font-size:9px;">
                                            Next Update Date
                                        </div>
                                        <div class="col-12 text-end pim-duedate">
                                            <?= $kfiDetail['nextCheck'] == "" ? 'Not set' : $kfiDetail['nextCheck'] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-2  view-tab-active" id="tab-1" onclick="javascript:viewTabKfi(<?= $kfiHistoryId ?>,1)">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-blue.png" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;" id="tab-1-blue">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-black.png" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;display:none;" id="tab-1-black">
                            Assigned
                        </div>
                        <div class="col-3  view-tab" id="tab-2" onclick="javascript:viewTabKfi(<?= $kfiHistoryId ?>,2)">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh.png" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;" id="tab-2-black">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh-blue.png" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;display:none;" id="tab-2-blue">
                            Update History
                        </div>
                        <!-- <div class="col-2  view-tab" id="tab-3" onclick="javascript:viewTabKfi(3)">
							<img src="<?php //Yii::$app->homeUrl 
                                        ?>images/icons/Settings/comment.png" alt="History" class="pim-icon mr-5" style="margin-top: -2px;" id="tab-3-black">
							<img src="<?php //Yii::$app->homeUrl 
                                        ?>images/icons/Settings/comment-blue.png" alt="History" class="pim-icon mr-5" style="margin-top: -2px;display:none;" id="tab-3-blue">
							Chats
						</div> -->
                        <div class="col-3 view-tab" id="tab-4" onclick="viewTabKfi(<?= $kfiHistoryId ?>,4)">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.png" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;" id="tab-4-black">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart-blue.png" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px; display: none;" id="tab-4-blue">
                            Chart
                        </div>



                        <div class="col-4  view-tab" id="tab-5" onclick="javascript:viewTabKfi(<?= $kfiHistoryId ?>,5)">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/relate.png" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;" id="tab-5-black">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/relate-blue.png" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;display:none;" id="tab-5-blue">
                            Relate KGI
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
<input type="hidden" id="kfiId" value="<?= $kfiId ?>">
<?php
$form = ActiveForm::begin([
    'id' => 'update-kfi',
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
    'action' => Yii::$app->homeUrl . 'kfi/management/save-update-kfi'

]); ?>
<?= $this->render('modal_update_kfi', [
    "units" => $units,
    "companies" => $companies,
    "months" => $months,
    "isManager" => $isManager
]) ?>
<?php ActiveForm::end(); ?>
<?= $this->render('modal_delete') ?>
<?= $this->render('modal_employee_history') ?>

<script>
    window.onload = function() {
        let openTab = <?= $openTab ?>; // PHP value passed to JavaScript
        if (openTab) {
            viewTabKfi(<?= $kfiHistoryId ?>, openTab); // Set the tab based on the PHP value
        } else {
            viewTabKfi(<?= $kfiHistoryId ?>, 1); // Default to tab 1 if no value is passed
        }
    }
</script>