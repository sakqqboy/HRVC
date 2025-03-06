<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'Company KFI History';
?>

<div class=" contrainer-body col-12">
    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.svg" class="home-icon mr-5"
            style="margin-top: -3px;">
        <strong class="pim-head-text"> <?= Yii::t('app', 'Performance Indicator Matrices') ?> (PIM)</strong>
    </div>
    <div class="col-12 mt-10">
        <?= $this->render('header_filter', [
            "role" => $role
        ]) ?>
        <div class="alert  mt-10 pim-body bg-white">
            <div class="col-12">
                <div class="row">
                    <div class="col-6 font-size-12 pim-name pr-0 pl-5 text-start">
                        <a href="<?= Yii::$app->request->referrer ? Yii::$app->request->referrer : Yii::$app->homeUrl . 'kfi/management/grid' ?>"
                            class="mr-5 pim-text-back">
                            <i class="fa fa-caret-left mr-3" aria-hidden="true"></i>
                            <?= Yii::t('app', 'Back') ?>
                        </a>
                        <span class="">
                            <?= $kfiDetail["kfiName"] ?>
                        </span>
                    </div>
                    <div class="col-6 text-end">

                    </div>
                </div>

            </div>
            <div class="row">
                <?php
                if (isset($kfis) && count($kfis) > 0) {
                    $i = 0;
                    foreach ($kfis as $year => $kfiMonth) :
                        foreach ($kfiMonth as $month => $kfi):
                            if ($kfi["isOver"] == 1 && $kfi["status"] != 2) {
                                $colorFormat = 'over';
                            } else {
                                if ($kfi["status"] == 1) {
                                    if ($kfi["isOver"] == 2) {
                                        $colorFormat = 'disable';
                                    } else {
                                        $colorFormat = 'inprogress';
                                    }
                                } else {
                                    $colorFormat = 'complete';
                                }
                            }
                ?>
                <div class="col-lg-4 col-md-6 col-12 ">
                    <div class="col-12 mt-10 mb-5 pim-big-box pim-<?= $colorFormat ?>">
                        <div class="row">
                            <div class="col-5 pim-name-history"><?= $kfi["month"] ?> <?= $kfi["year"] ?></div>
                            <div class="col-7 text-end">
                                <a href="<?= Yii::$app->homeUrl ?>kfi/view/kfi-history/<?= ModelMaster::encodeParams(["kfiId" => $kfiId, 'kfiHistoryId' => $kfi['kfiHistoryId'], 'openTab' => 1]) ?>"
                                    class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?>"
                                    style="margin-top: -3px;"
                                    <?= $colorFormat == 'disable' ? 'style="pointer-events: none; opacity: 0.5;"' : '' ?>>
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" alt="Chats"
                                        class="pim-icon " style="margin-top: -2px;">
                                </a>
                                <a href="<?= $colorFormat !== 'disable' ? Yii::$app->homeUrl . 'kfi/view/kfi-history/' . ModelMaster::encodeParams(['kfiId' => $kfiId, 'kfiHistoryId' => $kfi['kfiHistoryId'], 'openTab' => 2]) : '#' ?>"
                                    class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?>"
                                    style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg" alt="Chats"
                                        class="pim-icon " style="margin-top: -2px;">
                                </a>

                                <a href="<?= Yii::$app->homeUrl ?>kfi/view/kfi-history/<?= ModelMaster::encodeParams(['kfiId' => $kfiId, 'kfiHistoryId' => $kfi['kfiHistoryId'], 'openTab' => 4]) ?>"
                                    class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?>"
                                    style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.svg" alt="Chart"
                                        class="pim-icon" style="margin-top: -2px;">
                                </a>

                                <?php
                                            if ($colorFormat == 'disable') {
                                            ?>
                                <a class="btn btn-bg-blue-xs mr-5" style="margin-top: -3px;"
                                    href="<?= Yii::$app->homeUrl ?>kfi/management/update-kfi/<?= ModelMaster::encodeParams(['kfiId' => $kfiId, 'kfiHistoryId' => $kfi['kfiHistoryId']]) ?>"
                                    style="margin-top: -3px;">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/setupwhite.svg"
                                        alt="History" class="pim-icon" style="margin-top: -2px;">
                                </a>
                                <?php
                                            }
                                            ?>

                                <?php
                                            if ($i == 0 && $kfi["status"] == 2 && $role >= 5) {
                                            ?>
                                <a class="btn btn-bg-white-xs mr-5"
                                    onclick="javascript:prepareKfiNextTarget(<?= $kfi['kfiHistoryId'] ?>)"
                                    style="margin-top: -3px;">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/coppy.svg" alt="History"
                                        style="margin-top: -2px;" class="pim-icon">
                                </a>
                                <?php
                                            }
                                            ?>
                            </div>
                            <div class="col-8 mt-25 pl-25 pr-0">
                                <div class="row">
                                    <div class="col-4 month-<?= $colorFormat ?> pt-2"><?= Yii::t('app', 'Term') ?></div>
                                    <div class="col-8 term-<?= $colorFormat ?>  pt-2">
                                        <?= $kfi['fromDate'] == "" ? 'Not set' : $kfi['fromDate'] ?> -
                                        <?= $kfi['toDate'] == "" ? 'Not set' : $kfi['toDate'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 mt-25">
                                <div class="<?= $colorFormat ?>-tag text-center">
                                    <?= $kfi['status'] == 1 ? Yii::t('app', 'In process') : Yii::t('app', 'Completed') ?>
                                </div>
                            </div>
                            <div class="col-8  pl-15 pr-20 pt-20">
                                <div class="col-12 text-start pl-5 font-size-14" style="font-weight: 500;">
                                    <?= Yii::t('app', 'Assign on') ?>
                                </div>
                                <div class="col-12 pt-22 pb-2">
                                    <div class="row row-box">
                                        <div class="col-5 pl-10">
                                            <div class="row">
                                                <div class="col-3">
                                                    <?php
                                                                if (isset($kfi['kfiEmployee'][0])) {
                                                                ?>
                                                    <img src="<?= Yii::$app->homeUrl . $kfi['kfiEmployee'][0] ?>"
                                                        class="pim-pic-gridKFI">
                                                    <?php
                                                                }
                                                                ?>
                                                </div>
                                                <div class="col-3 pic-afterKFI pt-0">
                                                    <?php
                                                                if (isset($kfi['kfiEmployee'][1])) {
                                                                ?>
                                                    <img src="<?= Yii::$app->homeUrl . $kfi['kfiEmployee'][1] ?>"
                                                        class="pim-pic-gridKFI">
                                                    <?php
                                                                }
                                                                ?>
                                                </div>
                                                <div class="col-6  number-tag load-<?= $colorFormat ?> ml-7 pim-pic-gridKFINum "
                                                    style="padding-top: 8px;">
                                                    <?= $kfi["employee"] ?>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-6 <?= $colorFormat ?>-assignKFI"
                                            style="padding: 7px 7px 7px 7px">
                                            <?php
                                                        if ($role >= 5) {
                                                        ?>
                                            <span class="pull-left">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/assign-<?= $colorFormat ?>.svg"
                                                    style="margin-top: -3px;">
                                            </span>
                                            <a href="<?= Yii::$app->homeUrl ?>kfi/assign/assign/<?= ModelMaster::encodeParams(['kfiId' => $kfiId, "companyId" => $kfi['companyId']]) ?>"
                                                class="font-<?= $colorFormat ?>">
                                                <?= Yii::t('app', 'Change Assigned') ?>
                                            </a>
                                            <?php
                                                        } else { ?>
                                            <div class="d-flex align-items-center" style="margin-left: 9px;">
                                                <div class="circle-color-<?= $colorFormat ?>"
                                                    style="margin-right: 5px;">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $colorFormat === 'disable' ? 'eye.svg' : 'eyewhite.svg' ?>"
                                                        class="home-icon"
                                                        style="width: 14px; height: 14px; margin-top: -1px;">
                                                </div>
                                                <a href="<?= Yii::$app->homeUrl ?>kfi/view/kfi-history/<?= ModelMaster::encodeParams(["kfiId" => $kfiId, 'openTab' => 1]) ?>"
                                                    class="font-<?= $colorFormat ?>">
                                                    <?= Yii::t('app', 'View Assigned') ?>
                                                </a>
                                            </div>

                                            <?php
                                                        }
                                                        ?>
                                        </div>
                                        <div class="col-1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1 ">

                            </div>
                            <div class="col-3 font-size-10 pt-15 text-end">
                                <div class="col-12 text-start" style="font-size: 12px; font-weight: 400;">
                                    <?= Yii::t('app', 'Quality') ?>
                                </div>
                                <div class="col-12 pim-duedate text-start mt-2 text-start">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/diamon.svg"
                                        class="pim-iconKFI" style="margin-top: -3px; margin-left: 3px;">
                                    <b><?= $kfi["quantRatio"] == 1 ? Yii::t('app', 'Quantity') : Yii::t('app', 'Quality') ?></b>
                                </div>
                                <div class="row mt-15 mb-15 text-end">
                                    <div class="col-5"></div>
                                    <div class="col-6 border-bottom-<?= $colorFormat ?>"> </div>
                                </div>
                                <div class="col-12 pr-0 mt-2 text-start" style="font-size: 12px; font-weight: 400;">
                                    <?= Yii::t('app', 'Update Interval') ?></div>
                                <div class="col-12 pim-duedate text-start mt-2 text-start">
                                    <b>
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/monthly.svg"
                                            class="pim-iconKFI mr-3" style="margin-top: -3px; margin-left: 3px;">
                                        <?= Yii::t('app', $kfi["unit"]) ?>
                                    </b>
                                </div>
                            </div>
                            <div class="col-12 mt-35">
                                <div class="row">
                                    <div class="col-5 text-start pl-20">
                                        <div class="col-12 font-size-14">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Target.svg"
                                                class="pim-iconKFI" style=" margin-right: 3px;">
                                            <?= Yii::t('app', 'Target') ?>
                                        </div>
                                        <div class="col-12 number-pim">
                                            <?php
                                                        if ($kfi["target"] != '') {
                                                            $decimal = explode('.', $kfi["target"]);
                                                            if (isset($decimal[1])) {
                                                                if ($decimal[1] == '00') {
                                                                    $show = number_format($decimal[0]);
                                                                } else {
                                                                    $show = number_format($kfi["target"], 2);
                                                                }
                                                            } else {
                                                                $show = number_format($kfi["target"]);
                                                            }
                                                        } else {
                                                            $show = 0;
                                                        }
                                                        ?>
                                            <b><?= $show ?><?= $kfi["amountType"] == 1 ? '%' : '' ?></b>
                                        </div>
                                    </div>
                                    <div class="col-2 symbol-pim text-center">
                                        <div class="col-12 pt-13 font-size-12"><?= $kfi["code"] ?></div>
                                    </div>
                                    <div class="col-5 text-end pr-20">
                                        <div class="col-12 font-size-14"><?= Yii::t('app', 'Result') ?>
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Result.svg"
                                                class="pim-iconKFI" style="margin-left: 3px;">
                                        </div>
                                        <div class="col-12 number-pim">
                                            <?php
                                                        if ($kfi["result"] != '') {
                                                            $decimalResult = explode('.', $kfi["result"]);
                                                            if (isset($decimalResult[1])) {
                                                                if ($decimalResult[1] == '00') {
                                                                    $showResult = number_format($decimalResult[0]);
                                                                } else {
                                                                    $showResult = number_format($kfi["result"], 2);
                                                                }
                                                            } else {
                                                                $showResult = number_format($kfi["result"]);
                                                            }
                                                        } else {
                                                            $showResult = 0;
                                                        }
                                                        ?>
                                            <b><?= $showResult ?><?= $kfi["amountType"] == 1 ? '%' : '' ?></b>

                                        </div>
                                    </div>
                                    <div class="col-12 pl-20 pr-20 pb-8">
                                        <?php
                                                    $percent = explode('.', $kfi['ratio']);
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

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                            $i++;
                        endforeach;
                    endforeach;
                }
                ?>
            </div>
        </div>
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
    </div>


</div>
<?= $this->render('modal_confirm_next') ?>