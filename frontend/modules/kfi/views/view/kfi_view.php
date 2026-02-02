<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = Yii::t('app', 'Company KFI History');
?>

<div class="col-12 mt-70 pt-20 pim-content1">
    <div class="d-flex justify-content-start pt-0 pb-0" style="line-height: 30px;">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Group23177.svg"
            class="pim-head-icon mr-11 mt-2">
        <span class="pim-head-text mr-10"> <?= Yii::t('app', 'Performance Indicator Matrices') ?> (<?= Yii::t('app', 'PIM') ?>)</span>
    </div>

    <?= $this->render('header_filter', [
        "role" => $role,
        "allCompany" => $allCompany,
        "companyPic" => $companyPic,
        "totalBranch" => $totalBranch
    ]) ?>
    <div class="col-12 mt-20" id="box-wrapper">
        <div class="bg-white-employee">
            
            <div class="pim-name-title" style="display: flex; align-items: center; gap: 14px;">
                <!-- <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="mr-5 pim-text-back">
                    <i class="fa fa-caret-left mr-3" aria-hidden="true"></i>
                    <?= Yii::t('app', 'Back') ?>
                </a> -->
                <a href="<?= isset(Yii::$app->request->referrer) ? Yii::$app->request->referrer : Yii::$app->homeUrl . 'kfi/management/grid' ?>" style="text-decoration: none; width:66px; height:26px;" class="btn-create-branch">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/back-white.svg" style="width:18px; height:18px; margin-top:-3px;">
                            <?= Yii::t('app', 'Back') ?>        
                </a>
                <?= $kfiDetail["kfiName"] ?>
            </div>
            <div class="row mt-20" style="--bs-gutter-x:0px;">
                <?php
                if (isset($kfis) && count($kfis) > 0) {
                    $i = 0;
                    foreach ($kfis as $year => $kfiMonth) :
                        foreach ($kfiMonth as $month => $kfi):
                            if ($kfi["isOver"] == 1 && $kfi["status"] != 2) {
                                $colorFormat = 'over';
                                $statusText = "Due Passed";
                            } else {
                                if ($kfi["status"] == 1) {
                                    if ($kfi["isOver"] == 2) {
                                        $colorFormat = 'disable';
                                        $statusText = "Not Set";
                                    } else {
                                        $colorFormat = 'inprogress';
                                        $statusText = "In Progress";
                                    }
                                } else {
                                    $colorFormat = 'complete';
                                    $statusText = "Completed";
                                }
                            }
                ?>
                            <div class="col-lg-4 col-md-6 col-12 p-2">
                                <div class="pim-big-box-view pim-<?= $colorFormat ?>">
                                    <div class="d-inline-flex" style="width:100%;">
                                        <div class="d-flex pim-name-history" style="height: 32px;">
                                            <?= $kfi["month"] ?>
                                            <?= $kfi["year"] ?>
                                        </div>
                                        <div class="flex-grow-1 align-content-center" style="height:32px;">
                                            <div class="d-flex justify-content-end">
                                                <a href="<?= Yii::$app->homeUrl ?>kfi/view/kfi-history/<?= ModelMaster::encodeParams(["kfiId" => $kfiId, 'kfiHistoryId' => $kfi['kfiHistoryId'], 'openTab' => 1]) ?>"
                                                    class="<?= $colorFormat == 'disable' ? 'pim-btn-disable' : 'pim-btn' ?> mr-5"
                                                    style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" alt="View"
                                                        class="pim-action-icon">
                                                </a>
                                                <a href="<?= $colorFormat !== 'disable' ? Yii::$app->homeUrl . 'kfi/view/kfi-history/' . ModelMaster::encodeParams(['kfiId' => $kfiId, 'kfiHistoryId' => $kfi['kfiHistoryId'], 'openTab' => 2]) : '#' ?>"
                                                    class="<?= $colorFormat == 'disable' ? 'pim-btn-disable' : 'pim-btn' ?> mr-5"
                                                    style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg"
                                                        alt="Chats" class="pim-action-icon">
                                                </a>
                                                <a href="<?= Yii::$app->homeUrl ?>kfi/view/kfi-history/<?= ModelMaster::encodeParams(['kfiId' => $kfiId, 'kfiHistoryId' => $kfi['kfiHistoryId'], 'openTab' => 4]) ?>"
                                                    class="<?= $colorFormat == 'disable' ? 'pim-btn-disable' : 'pim-btn' ?>"
                                                    style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/chart.svg" alt="Chart"
                                                        class="pim-action-icon">
                                                </a>
                                                <?php
                                                if ($colorFormat == 'disable') {
                                                ?>
                                                    <a class="pim-btn-blue  ml-5" href="<?= Yii::$app->homeUrl ?>kfi/management/update-kfi/<?= ModelMaster::encodeParams(['kfiId' => $kfiId, 'kfiHistoryId' => $kfi['kfiHistoryId']]) ?>">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/setupwhite.svg"
                                                            alt="History" class="pim-action-icon">
                                                    </a>
                                                <?php
                                                }
                                                ?>

                                                <?php
                                                if ($i == 0 && $kfi["status"] == 2 && $role >= 5) {
                                                ?>
                                                    <a class="pim-btn ml-5"
                                                        onclick="javascript:prepareKfiNextTarget(<?= $kfi['kfiHistoryId'] ?>)" style="cursor: pointer;">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/coppy.svg"
                                                            alt="History" class="pim-action-icon">
                                                    </a>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-inline-flex mt-10" style="width:100%;">
                                        <div class="d-flex justify-content-start pim-name-history">
                                            <div class="month-period month-<?= $colorFormat ?>"><?= Yii::t('app', 'Term') ?></div>
                                            <div class="term-period term-<?= $colorFormat ?>">
                                                <?= $kfi['fromDate'] == "" ? Yii::t('app', 'Not set') : $kfi['fromDate'] ?> -
                                                <?= $kfi['toDate'] == "" ? Yii::t('app', 'Not set') : $kfi['toDate'] ?>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-end">
                                                <div class="status-tag <?= $colorFormat ?>-tag text-center">
                                                    <?= Yii::t('app', $statusText) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 text-start font-size-12 mt-10" style="font-weight: 500;">
                                        <?= Yii::t('app', 'Assign on') ?>
                                    </div>
                                    <div class="d-flex justify-content-start ">
                                        <div class="pim-picgroup">
                                            <?php if ($kfi["employee"] != 0) {
                                                $totalPic = $kfi["employee"] >= 3 ? 3 : $kfi["employee"];
                                                if (isset($kfi['kfiEmployee'][0])) {
                                                    $userPicture1 = $kfi['kfiEmployee'][0];
                                            ?>
                                                    <img src="<?= Yii::$app->homeUrl . $userPicture1 ?>" class="pim-pic-gridNew">
                                                <?php
                                                }
                                                if (isset($kfi['kfiEmployee'][1])) {
                                                    $userPicture2 = $kfi['kfiEmployee'][1];
                                                ?>
                                                    <img src="<?= Yii::$app->homeUrl . $userPicture2 ?>"
                                                        class="pim-pic-gridNew pic-after">
                                                <?php
                                                }
                                                if (isset($kfi['kfiEmployee'][2])) {
                                                    $userPicture3 = $kfi['kfiEmployee'][2];
                                                ?>
                                                    <img src="<?= Yii::$app->homeUrl . $userPicture3 ?>"
                                                        class="pim-pic-gridNew pic-after">
                                                <?php
                                                }
                                            } else {
                                                $totalPic = 0;
                                            }
                                            for ($i = 0; $i < (3 - $totalPic); $i++):
                                                ?>
                                                <div
                                                    class="pim-pic-disable <?= ($i > 0 || $totalPic > 0) ? 'pic-after' : '' ?>">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg">
                                                </div>
                                            <?php
                                            endfor;
                                            ?>
                                            <div class="number-tagNew  load-<?= $colorFormat ?>  pic-after">
                                                <?= $kfi["employee"] ?>
                                            </div>
                                        </div>
                                        <div class="assign-new <?= $colorFormat ?>-assignNew ml-5 align-self-center">
                                            <?php
                                            if ($role >= 5) {
                                            ?>
                                                <span class="pull-left">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/assign-<?= $colorFormat ?>.svg" style="width: 23px;height: 23px;">
                                                </span>
                                                <a href="<?= Yii::$app->homeUrl ?>kfi/assign/assign/<?= ModelMaster::encodeParams(['kfiId' => $kfiId, "companyId" => $kfi['companyId']]) ?>"
                                                    class="font-<?= $colorFormat ?>">
                                                    <?= Yii::t('app', 'Change Assigned') ?>
                                                </a>
                                            <?php
                                            } else { ?>
                                                <span class="pull-left">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $colorFormat === 'disable' ? 'eye.svg' : 'eyewhite.svg' ?>" style="width: 23px;height: 23px;">
                                                </span>
                                                <a href="<?= Yii::$app->homeUrl ?>kfi/view/kfi-history/<?= ModelMaster::encodeParams(["kfiId" => $kfiId, 'openTab' => 1]) ?>"
                                                    class="font-<?= $colorFormat ?>">
                                                    <?= Yii::t('app', 'View Assigned') ?>
                                                </a>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="flex-grow-1" style="justify-items: end;">
                                            <div class="pt-0" style="width: 80px;">
                                                <div class="col-12 text-start"
                                                    style="font-size: 12px; font-weight: 400;line-height:12px;color:#717171;">
                                                    <?= Yii::t('app', 'Quant Ratio') ?>
                                                </div>
                                                <div class="col-12 pim-duedate font-size-12 text-start mt-3">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $kfi["quantRatio"] == 1 ? 'quantity' : 'diamon' ?>.svg"
                                                        class="pim-iconKFI" style="margin-top: -1px;">
                                                    <b><?= $kfi["quantRatio"] == 1 ? Yii::t('app', 'Quantity') : Yii::t('app', 'Quality') ?></b>
                                                </div>
                                                <div class="mt-10 mb-7 border-bottom-<?= $colorFormat ?>" style="width:80px;"></div>
                                                <div class="col-12  pr-0  text-start"
                                                    style="font-size: 12px; font-weight: 400;line-height:12px;color:#717171;">
                                                    <?= Yii::t('app', 'Update Interval') ?>
                                                </div>
                                                <div class="col-12 pim-duedate font-size-12 text-start mt-3"><b>
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/monthly.svg"
                                                            class="pim-iconKFI" style="margin-top: -3px;">
                                                        <?= Yii::t('app', $kfi["unit"]) ?>
                                                    </b>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-20">
                                        <div class="row" style="--bs-gutter-x:0px;">
                                            <div class="col-5 text-start">
                                                <div class="col-12 font-size-13">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Target.svg"
                                                        class="pim-iconKFI" style="margin-top: 1px; margin-right: 3px;">
                                                    <?= Yii::t('app', 'Target') ?>
                                                </div>
                                                <div class="col-12 number-pim mt-5">
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
                                            <div class="col-5 text-end">
                                                <div class=" col-12 font-size-13"><?= Yii::t('app', 'Result') ?>
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Result.svg"
                                                        class="pim-iconKFI" style="margin-top: 1px; margin-left: 3px;">
                                                </div>
                                                <div class="col-12 number-pim mt-5">
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
                                            <div class="col-12 mt-10">
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
<style>
    .pim-btn {
        height: 25px;
        width: 25px;
        padding: 0px;
        justify-content: center;
        align-items: center;
        align-self: center;
    }

    .term-period {
        width: 140px;
        margin-left: -13px;
        border-radius: 20px;
        justify-content: end;
        padding-right: 7px;
    }

    .month-period {
        width: 40px;
        display: flex;
        justify-content: center;
        border-radius: 20px;
    }

    .status-tag {
        width: 90px;
    }

    .assign-new {
        height: 30px;
        width: 128px;
    }

    .bg-white-employee {
        min-height: calc(100vh - 200px);
        padding: 27px 20px 10px 20px;
    }
</style>