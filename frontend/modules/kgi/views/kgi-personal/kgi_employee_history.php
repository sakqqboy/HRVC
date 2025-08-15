<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'Individual KGI View';
?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<div class="col-12 mt-70 pt-20 pim-content1">
    <div class="d-flex justify-content-start pt-0 pb-0" style="line-height: 30px;">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Group23177.svg"
            class="pim-head-icon mr-11 mt-2">
        <span class="pim-head-text mr-10"> <?= Yii::t('app', 'Performance Indicator Matrices') ?> (PIM)</span>
    </div>
    <?= $this->render('header_filter', [
        "role" => $role,
        "allCompany" => $allCompany,
        "companyPic" => $companyPic,
        "totalBranch" => $totalBranch
    ]) ?>
    <?php
    if (isset($kgiEmployeeDetail) && !empty($kgiEmployeeDetail)) {
        if ($kgiEmployeeDetail["isOver"] == 1 && $kgiEmployeeDetail["status"] != 2) {
            $colorFormat = 'over';
            $text = 'Due Passed';
        } else {
            if ($kgiEmployeeDetail["status"] == 1) {
                if ($kgiEmployeeDetail["isOver"] == 2) {
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
    ?> <div class="col-12 mt-10">
        <div class="alert mt-10 pim-body bg-white">
            <div class="row">
                <div class="col-6 pim-name-title pr-0 pl-5 text-start">
                    <a href="<?= isset(Yii::$app->request->referrer) ? Yii::$app->request->referrer : Yii::$app->homeUrl . 'kgi/kgi-personal/individual-kgi-grid' ?>"
                        class="mr-5 pim-text-back">
                        <i class="fa fa-caret-left mr-3" aria-hidden="true"></i>
                        <?= Yii::t('app', 'Back') ?>
                    </a>
                    <?= $kgiEmployeeDetail["kgiName"] ?>
                </div>
                <div class="col-6 text-end">
                    <div class="d-flex justify-content-end align-items-end">
                        <?php
                            if (!isset($kgiEmployeeDetail["picture"]) || $kgiEmployeeDetail["picture"] != "") {
                                $kgiEmployeeDetail["picture"] = 'image/user.svg';
                                $noPic = "pim-team-" . $colorFormat;
                            } else {
                                $noPic = '';
                            }
                            //    throw new exception(print_r($kgiEmployeeDetail, true));
                            ?>
                        <span class="team-wrapper <?= $colorFormat ?>-teamshow"
                            style="margin-right: 5px; padding-right: 5px;">
                            <span class="team-icon pim-team-<?= $colorFormat ?>">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $colorFormat == 'disable' ? 'teamblack' : 'teamwhite' ?>.svg"
                                    alt="Team Icon">
                            </span>
                            <span class="team-name"><?= $kgiEmployeeDetail["teamName"] ?></span>
                        </span>

                        <span class="team-wrapper <?= $colorFormat ?>-teamshow mr-3">
                            <span class="mr-1 ml-1 d-flex" style="margin-top: -1px;">
                                <img src="<?= Yii::$app->homeUrl . $kgiEmployeeDetail['picture'] ?>" alt="Team Icon"
                                    class="pim-pic-icon">
                            </span>
                            <span class="team-name">
                                <?php
                                    $employeeName = $kgiEmployeeDetail["employeeName"];

                                    echo htmlspecialchars($employeeName) ?>
                            </span>
                        </span>
                        <?php if ($role >= 5) {
                            ?>
                        <a class="btn btn-outline-danger d-flex justify-content-center align-items-center"
                            data-bs-toggle="modal" data-bs-target="#delete-kgi"
                            onclick="javascript:prepareDeleteKgi(<?= $kgiId ?>)"
                            style="height: 25px;font-size:13px;width:60px;"
                            onmouseover="this.querySelector('.pim-action-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binwhite.svg'"
                            onmouseout="this.querySelector('.pim-action-icon').src='<?= Yii::$app->homeUrl ?>images/icons/pim/binred.svg'">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/binred.svg"
                                class="pim-action-icon mr-3">
                            <?= Yii::t('app', 'Delete') ?>
                        </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="row mt-10">
                <div class="col-lg-7 col-12 pr-10">
                    <div class="row">
                        <div class="col-4 pim-name-detail align-items-center ">Description</div>
                        <div class="col-2">
                            <div class="status-tag <?= $colorFormat ?>-tag text-center">
                                <?= Yii::t('app', $text) ?>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-4 month-period month-<?= $colorFormat ?>">
                                    <?= $kgiEmployeeDetail['monthFullName'] ?? Yii::t('app', 'Term') ?>
                                </div>
                                <div class="col-8 term-period term-<?= $colorFormat ?>">
                                    <?= $kgiEmployeeDetail['fromDate'] == "" ? Yii::t('app', 'Not set') : $kgiEmployeeDetail['fromDate'] ?>
                                    &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;
                                    <?= $kgiEmployeeDetail['toDate'] == "" ? Yii::t('app', 'Not set') : $kgiEmployeeDetail['toDate'] ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 pim-description mt-10">
                            <?= $kgiEmployeeDetail["detail"] ?>
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
                                        if ($kgiEmployeeDetail["priority"] == "A" || $kgiEmployeeDetail["priority"] == "B") {
                                        ?>
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/star.svg" class="default-star">
                                    <?php
                                        }
                                        if ($kgiEmployeeDetail["priority"] == "A" || $kgiEmployeeDetail["priority"] == "C") {
                                        ?>
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/star.svg" class="big-star">
                                    <?php
                                        }
                                        if ($kgiEmployeeDetail["priority"] == "B") {
                                        ?>
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/star.svg" class="default-star">
                                    <?php
                                        }
                                        if ($kgiEmployeeDetail["priority"] == "A") {
                                        ?>
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/star.svg" class="default-star">
                                    <?php
                                        }
                                        ?>
                                </div>
                                <?php
                                    if ($kgiEmployeeDetail["priority"] != '') {
                                    ?>
                                <div class="priority-box">
                                    <?= Yii::t('app', 'Priority') ?>
                                    <span class="text-priority mt-5"><?= $kgiEmployeeDetail["priority"] ?></span>
                                </div>
                                <?php
                                    } else { ?>
                                <div class="priority-box-null">
                                    <?= Yii::t('app', 'Priority') ?>
                                    <span class="text-priority mt-5">N/A</span>
                                </div>
                                <?php
                                    }
                                    ?>
                            </div>
                            <div class="col-lg-3 pt-10 pim-subheader-font border-right-<?= $colorFormat ?>">
                                <div class="col-12 font-size-12">Quant Ratio</div>
                                <div class="col-12 border-bottom-<?= $colorFormat ?> pb-5 pim-duedate">
                                    <i class="fa fa-diamond" aria-hidden="true"></i>
                                    <?= $kgiEmployeeDetail["quantRatio"] == 1 ?  Yii::t('app', 'Quantity') : Yii::t('app', 'Quality') ?>
                                </div>
                                <div class="col-12 pr-0 pt-5 pl-0 font-size-12"><?= Yii::t('app', 'update Interval') ?>
                                </div>
                                <div class="col-12  pim-duedate">
                                    <?= $kgiEmployeeDetail["unitText"] ?>
                                </div>
                            </div>
                            <div class="col-lg-7 pim-subheader-font pr-15 pl-15">
                                <div class="row">
                                    <div class="col-5 text-start">
                                        <div class="col-12 font-size-12"><?= Yii::t('app', 'Target') ?></div>
                                        <div class="col-12 mt-3 number-pim">
                                            <?php
                                                $decimal = explode('.', $kgiEmployeeDetail["target"]);
                                                if (isset($decimal[1])) {
                                                    if ($decimal[1] == '00') {
                                                        $show = number_format($decimal[0]);
                                                    } else {
                                                        $show = number_format($kgiEmployeeDetail["target"]);
                                                    }
                                                } else {
                                                    $show = number_format($kgiEmployeeDetail["target"]);
                                                }
                                                ?>
                                            <?= $show ?><?= $kgiEmployeeDetail["amountType"] == 1 ? '%' : '' ?>
                                        </div>
                                    </div>
                                    <div class="col-2 symbol-pim text-center">
                                        <div class="col-12 pt-17"><?= $kgiEmployeeDetail["code"] ?></div>
                                    </div>
                                    <div class="col-5  text-end">
                                        <div class="col-12 font-size-12"><?= Yii::t('app', 'Result') ?></div>
                                        <div class="col-12 mt-3 number-pim">
                                            <?php
                                                if ($kgiEmployeeDetail["result"] != '') {
                                                    $decimalResult = explode('.', $kgiEmployeeDetail["result"]);
                                                    if (isset($decimalResult[1])) {
                                                        if ($decimalResult[1] == '00') {
                                                            $showResult = number_format($decimalResult[0]);
                                                        } else {
                                                            $showResult = number_format($kgiEmployeeDetail["result"], 2);
                                                        }
                                                    } else {
                                                        $showResult = number_format($kgiEmployeeDetail["result"]);
                                                    }
                                                } else {
                                                    $showResult = 0;
                                                }
                                                ?>
                                            <?= $showResult ?><?= $kgiEmployeeDetail["amountType"] == 1 ? '%' : '' ?>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-10">
                                        <?php
                                            $percent = explode('.', $kgiEmployeeDetail['ratio']);
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
                                                    <?= $kgiEmployeeDetail['nextCheckText'] == "" ? Yii::t('app', 'Not set') : $kgiEmployeeDetail['nextCheckText'] ?>
                                                </div>
                                            </div>
                                            <div class="col-4 text-center mt-5 pt-6 pl-8 pr-8">
                                                <?php
                                                    if ($role > 3  && $kgiEmployeeDetail["status"] == 1) {
                                                    ?>
                                                <a class="pim-btn-<?= $colorFormat ?>"
                                                    href="<?= Yii::$app->homeUrl . 'kgi/management/prepare-update/' . ModelMaster::encodeParams(['kgiId' => $kgiId, 'kgiHistoryId' => 0]) ?>"
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
                                                    <?= $kgiEmployeeDetail['nextCheckText'] == "" ?  Yii::t('app', 'Not set') : $kgiEmployeeDetail['nextCheckText'] ?>
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
                                onclick="javascript:viewTabEmployeeKgi(<?= $kgiEmployeeHistoryId ?>,1,<?= $kgiId ?>,<?= $kgiEmployeeId ?>)">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-blue.svg" alt="History"
                                    class="pim-icon" style="margin-top: -2px;" id="tab-1-blue">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-black.svg" alt="History"
                                    class="pim-icon" style="margin-top: -2px;display:none;" id="tab-1-black">
                                <?= Yii::t('app', 'Assigned') ?>
                            </div>
                            <div class="view-tab" id="tab-2"
                                onclick="javascript:viewTabEmployeeKgi(<?= $kgiEmployeeHistoryId ?>,2,<?= $kgiId ?>,<?= $kgiEmployeeId ?>)">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh-black.svg"
                                    alt="History" class="pim-icon" style="margin-top: -2px;" id="tab-2-black">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh-blue.svg" alt="History"
                                    class="pim-icon" style="margin-top: -2px;display:none;" id="tab-2-blue">
                                <?= Yii::t('app', 'Update History') ?>
                            </div>
                            <div class="view-tab" id="tab-3"
                                onclick="javascript:viewTabEmployeeKgi(<?= $kgiEmployeeHistoryId ?>,3,<?= $kgiId ?>,<?= $kgiEmployeeId ?>)">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg" alt="History"
                                    class="pim-icon" style="margin-top: -2px;" id="tab-3-black">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment-blue.svg" alt="History"
                                    class="pim-icon" style="margin-top: -2px;display:none;" id="tab-3-blue">
                                <?= Yii::t('app', 'Chats') ?>
                            </div>
                            <div class="view-tab" id="tab-4"
                                onclick="javascript:viewTabEmployeeKgi(<?= $kgiEmployeeHistoryId ?>,4,<?= $kgiId ?>,<?= $kgiEmployeeId ?>)">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/chart.svg" alt="History"
                                    class="pim-icon" style="margin-top: -2px;" id="tab-4-black">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart-blue.svg" alt="History"
                                    class="pim-icon" style="margin-top: -2px;display:none;" id="tab-4-blue">
                                <?= Yii::t('app', 'Chart') ?>
                            </div>
                            <div class="view-tab" id="tab-5"
                                onclick="javascript:viewTabEmployeeKgi(<?= $kgiEmployeeHistoryId ?>,5,<?= $kgiId ?>,<?= $kgiEmployeeId ?>)">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/relate.svg" alt="History"
                                    class="pim-icon" style="margin-top: -2px;" id="tab-5-black">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/relate-blue.svg" alt="History"
                                    class="pim-icon" style="margin-top: -2px;display:none;" id="tab-5-blue">
                                <?= Yii::t('app', 'Relate KPI') ?>
                            </div>
                            <input type="hidden" id="currentTab" value="1">
                        </div>
                    </div>
                    <div class="col-lg-4 view-tab">
                    </div>
                </div>
            </div>

            <div class="row mt-10" id="show-content">

            </div>
        </div>
    </div>
    <?php
    }
    ?>
</div>

<input type="hidden" id="kgiId" value="<?= $kgiId ?>">
<input type="hidden" id="viewType" value="grid">
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
<?= $this->render('modal_delete') ?>

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

.team-wrapper {
    height: 25px;
    max-width: 200px;
}
</style>
<script>
window.onload = function() {
    let openTab = <?= $openTab ?>; // PHP value passed to JavaScript
    if (openTab) {
        viewTabEmployeeKgi(<?= $kgiEmployeeHistoryId ?>, openTab, <?= $kgiId ?>,
            <?= $kgiEmployeeId ?>); // Set the tab based on the PHP value
    } else {
        viewTabEmployeeKgi(<?= $kgiEmployeeHistoryId ?>, 1, <?= $kgiId ?>,
            <?= $kgiEmployeeId ?>); // Default to tab 1 if no value is passed
    }
}
</script>