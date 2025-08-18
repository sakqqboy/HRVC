<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = Yii::t('app', 'KFI Grid View');
?>
<div class="col-12 mt-70 pt-20 pim-content1">
    <div class="d-flex justify-content-start pt-0 pb-0" style="line-height: 30px;">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Group23177.svg" class="pim-head-icon mr-11 mt-2">
        <span class="pim-head-text mr-10"> <?= Yii::t('app', 'Performance Indicator Matrices') ?> (PIM)</span>
        <?php
        if ($role >= 3) {
        ?>
            <a href="<?= Yii::$app->homeUrl ?>kfi/management/create-kfi"
                class="create-employee-btn mr-11">
                <?= Yii::t('app', 'Create New') ?>
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg" alt="History" class="create-btn-icon ml-3" style="margin-top: -3px;">
            </a>
        <?php
        }
        ?>
    </div>
    <?= $this->render('header_filter', [
        "role" => $role,
        "allCompany" => $allCompany,
        "companyPic" => $companyPic,
        "totalBranch" => $totalBranch
    ]) ?>
    <div class="col-12 mt-20" id="box-wrapper">
        <div class="bg-white-employee" id="pim-content">
            <div class="d-flex pl-10 pr-10 justify-content-left align-content-center mt-5">
                <div class="pim-type-tab-selected rounded-top-left justify-content-center align-items-center">
                    <img class="mr-10" src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/company.svg"
                        style="cursor: pointer;"><?= Yii::t('app', 'Company KFI') ?>
                </div>
                <div class="d-flex" style="width:267px;">

                </div>
                <div class="d-flex flex-grow-1 align-items-center justify-content-end  gap-1">
                    <?= $this->render('filter_list', [
                        "companies" => $companies,
                        "months" => $months,
                        "role" => $role,
                        "page" => "grid",
                        "companyId" => isset($companyId) ? $companyId : null,
                        "employeeCompanyId" => $employeeCompanyId,
                        "branchId" => isset($branchId) ? $branchId : null,
                        "month" => isset($month) ? $month : null,
                        "status" => isset($status) ? $status : null,
                        "branches" =>  isset($branches) ? $branches : null,
                        "yearSelected" => isset($branchId) ? $branchId : null,

                    ]) ?>
                </div>
            </div>
            <input type="hidden" id="type" value="grid">
            <input type="hidden" id="minPage" value="0">
            <div class="row" style="--bs-gutter-x:0px;">
                <div class="d-none img-loading text-center" id="img-loading">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Config/loading.gif" class="img-fluid " style="width: 750px;">
                </div>
            </div>
            <div class="row mt-20 pl-10 pr-10 pim-content mb-10" style="--bs-gutter-x:0px;" id="main-body">
                <?php
                if (isset($kfis) && count($kfis) > 0) {
                    foreach ($kfis as $kfiId => $kfi) :
                        if ($kfi["isOver"] == 1 && $kfi["status"] != 2) {
                            $colorFormat = 'over';
                            $statusText = 'Due Passed';
                        } else {
                            if ($kfi["status"] == 1) {
                                if ($kfi["isOver"] == 2) {
                                    $colorFormat = 'disable';
                                    $statusText = 'Not Set';
                                } else {
                                    $colorFormat = 'inprogress';
                                    $statusText = 'In-Progress';
                                }
                            } else {
                                $colorFormat = 'complete';
                                $statusText = 'Completed';
                            }
                        }
                ?>
                        <div class="col-12 mb-25 pim-big-box pim-<?= $colorFormat ?>" id="kfi-<?= $kfiId ?>">
                            <div class="d-flex justify-content-start align-content-start">
                                <div class="kfi-grid-1" style="min-height:120px;">
                                    <div class="text-truncate pim-name"><?= $kfi["kfiName"] ?></div>
                                    <div class="mt-25">
                                        <div class="assign-on">
                                            <?= Yii::t('app', 'Assign on') ?>
                                        </div>
                                        <div class="d-flex mt-10">
                                            <div class="pim-picgroup">
                                                <?php if ($kfi["countEmployee"] != 0) { ?>

                                                    <?php
                                                    if (isset($kfi['kfiEmployee'][0])) {
                                                    ?>
                                                        <img src="<?= Yii::$app->homeUrl . $kfi['kfiEmployee'][0] ?>"
                                                            class="pim-pic-gridKFI">
                                                    <?php
                                                    }
                                                    ?>

                                                    <?php
                                                    if (isset($kfi['kfiEmployee'][1])) {
                                                    ?>
                                                        <img src="<?= Yii::$app->homeUrl . $kfi['kfiEmployee'][1] ?>"
                                                            class="pim-pic-gridKFI pic-afterKFI">
                                                    <?php
                                                    }
                                                    ?>

                                                <?php } else { ?>

                                                    <div class="pim-pic-yenlowKFI">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg" alt="person icon">
                                                    </div>

                                                    <div class="pim-pic-yenlowKFI pic-afterKFI">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg" alt="person icon">
                                                    </div>
                                                <?php } ?>
                                                <div class="number-tag load-<?= $kfi["countEmployee"] == 0 ? 'yenlow head-yellow' : $colorFormat . ' head-' . $colorFormat ?> pim-pic-gridKFINum">
                                                    <?= $kfi["countEmployee"] ?>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-grow-1 justify-content-center">
                                                <div class="<?= $kfi["countEmployee"] == 0 ? 'yenlow' : $colorFormat ?>-assignKFI">
                                                    <?php
                                                    if ($role >= 5) {
                                                    ?>
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/assign-<?= $kfi["countEmployee"] == 0 ? 'yenlow' : $colorFormat ?>.svg" style="width:22px;height:22px;">
                                                        <a href="<?= Yii::$app->homeUrl ?>kfi/assign/assign/<?= ModelMaster::encodeParams(['kfiId' => $kfiId, "companyId" => $kfi['companyId']]) ?>"
                                                            class="font-<?= $kfi["countEmployee"] == 0 ? 'black' : $colorFormat ?> ml-8">
                                                            <?php echo $kfi["countEmployee"] == 0 ?  Yii::t('app', 'Assign Person') :  Yii::t('app', 'Change Assign'); ?>
                                                        </a>
                                                    <?php
                                                    } else { ?>

                                                        <div class="circle-eye bg-<?= $kfi["countEmployee"] == 0 ? 'yellow' : $colorFormat ?>-dark">
                                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $colorFormat != 'disable' && $kfi["countEmployee"] != 0 ? 'eyewhite.svg' : 'eye.svg' ?>"
                                                                class="home-icon" style="width:16px; height:16px;">
                                                        </div>
                                                        <a href="<?= Yii::$app->homeUrl ?>kfi/view/kfi-history/<?= ModelMaster::encodeParams(["kfiId" => $kfiId, 'openTab' => 1]) ?>"
                                                            class="font-<?= $kfi["countEmployee"] == 0 ? 'black' : $colorFormat ?> ml-8">
                                                            <?php echo $kfi["countEmployee"] == 0 ? Yii::t('app', 'View Assign') :  Yii::t('app', 'View Assign'); ?>
                                                        </a>

                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="pim-center-line-content-KFI pim-<?= $colorFormat ?>"></div>
                                <div class="d-flex flex-column" style="min-height:120px;">
                                    <div class="status-tag-kfi <?= $colorFormat ?>-tag">
                                        <?= $statusText ?>
                                    </div>
                                    <div class="d-flex position-relative mx-auto mt-auto mb-auto">
                                        <div class="text-center kfi-grid-2 ">
                                            <span class="pim-small-text-kfi"><?= Yii::t('app', 'Quant Ratio') ?></span>
                                            <div class="pim-unit-text-kfi text-center">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $kfi["quantRatio"] == 1 ? Yii::t('app', 'quantity') : Yii::t('app', 'diamon') ?>.svg"
                                                    class="pim-iconKFI" style="margin-top: -1px; margin-left: 3px;">
                                                <?= $kfi["quantRatio"] == 1 ? Yii::t('app', 'Quantity') : Yii::t('app', 'Quality') ?>
                                            </div>
                                        </div>
                                        <div class="pim-center-line-content-md pim-<?= $colorFormat ?>"></div>
                                        <div class="text-center kfi-grid-2">
                                            <span class="pim-small-text-kfi"><?= Yii::t('app', 'Update Interval') ?></span>
                                            <div class="pim-unit-text-kfi text-center">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/monthly.svg"
                                                    class="pim-iconKFI" style="margin-top: -3px;">
                                                <?= Yii::t('app', $kfi["unit"]) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pim-center-line-content-KFI pim-<?= $colorFormat ?>"></div>
                                <div class="flex-grow-1" style="min-height:120px">
                                    <div class="row" style="--bs-gutter-x:0px;">
                                        <div class="col-6">
                                            <div class="d-flex justify-content-start">
                                                <div class="month-<?= $colorFormat ?> month-period-KFI">
                                                    <?= $kfi['month'] == "" ? Yii::t('app', 'Month') : Yii::t('app', $kfi['month']) ?>
                                                </div>
                                                <div class="term-<?= $colorFormat ?> term-period-KFI">
                                                    <?= $kfi['fromDate'] == "" ? Yii::t('app', 'Not set') : $kfi['fromDate'] ?> -
                                                    <?= $kfi['toDate'] == "" ? Yii::t('app', 'Not set') : $kfi['toDate'] ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex justify-content-end">
                                                <a href="<?= Yii::$app->homeUrl ?>kfi/view/kfi-history/<?= ModelMaster::encodeParams(["kfiId" => $kfiId, 'openTab' => 1]) ?>"
                                                    class="<?= $colorFormat == 'disable' ? 'pim-btn-disable' : 'pim-btn' ?> mr-5"
                                                    style="<?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" alt="History" class="pim-action-icon">
                                                </a>
                                                <a href="<?= Yii::$app->homeUrl ?>kfi/view/index/<?= ModelMaster::encodeParams(['kfiId' => $kfiId, 'openTab' => 2]) ?>"
                                                    class="<?= $colorFormat == 'disable' ? 'pim-btn-disable' : 'pim-btn' ?>  mr-5"
                                                    style="<?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/history.svg" alt="History" class="pim-action-icon mr-3">
                                                    <?= Yii::t('app', 'History') ?>
                                                </a>
                                                <a href="<?= Yii::$app->homeUrl ?>kfi/view/kfi-history/<?= ModelMaster::encodeParams(['kfiId' => $kfiId, 'openTab' => 4]) ?>"
                                                    class="<?= $colorFormat == 'disable' ? 'pim-btn-disable' : 'pim-btn' ?>  mr-5"
                                                    style="<?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/chart.svg" alt="Chart" class="pim-action-icon mr-3">
                                                    <?= Yii::t('app', 'Chart') ?>
                                                </a>
                                                <?php
                                                if ($role >= 5) {
                                                ?>
                                                    <a class="pim-btn-delete" data-bs-toggle="modal" data-bs-target="#staticBackdrop4"
                                                        onclick="javascript:prepareDeleteKfi(<?= $kfiId ?>)"
                                                        onmouseover="this.querySelector('.pim-action-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binwhite.svg'"
                                                        onmouseout="this.querySelector('.pim-action-icon').src='<?= Yii::$app->homeUrl ?>images/icons/pim/binred.svg'">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/binred.svg" alt="History"
                                                            class="pim-action-icon">
                                                    </a>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-10" style="--bs-gutter-x:0px;">
                                        <div class="col-5 text-start">
                                            <div class="col-12 pim-small-text">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Target.svg"
                                                    class="pim-iconKFI" style="margin-top: 1px; margin-right: 3px;">
                                                <?= Yii::t('app', 'Target') ?>
                                            </div>
                                            <div class="col-12 number-pim-KFI mt-10">
                                                <?php
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
                                                ?>
                                                <?= $show ?><?= $kfi["amountType"] == 1 ? '%' : '' ?>
                                            </div>
                                        </div>
                                        <div class="col-2 symbol-pim-KFI text-center">
                                            <?= $kfi["code"] ?>
                                        </div>
                                        <div class="col-5  text-end">
                                            <div class="col-12 pim-small-text" style="justify-content: end !important;">
                                                <?= Yii::t('app', 'Result') ?>
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Result.svg"
                                                    class="pim-iconKFI" style="margin-left: 4px;">
                                            </div>
                                            <div class="col-12 number-pim-KFI mt-10">
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
                                                <?= $showResult ?><?= $kfi["amountType"] == 1 ? '%' : '' ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-15" style="--bs-gutter-x:0px;">
                                        <div class="col-12">
                                            <?php
                                            $showPercent = 0; // เริ่มต้นค่า $showPercent เป็น 0
                                            if (isset($kfi['ratio']) && !empty($kfi['ratio'])) {
                                                $percent = explode('.', $kfi['ratio']);
                                                if (isset($percent[0]) && $percent[0] == '0') {
                                                    if (isset($percent[1])) {
                                                        if ($percent[1] == '00') {
                                                            $showPercent = 0;
                                                        } else {
                                                            $showPercent = round(floatval($kfi['ratio']), 1); // ปัดเศษเป็นทศนิยม 1 ตำแหน่ง
                                                        }
                                                    }
                                                } else {
                                                    $showPercent = round(floatval($kfi['ratio']), 2); // ปัดเศษเป็นทศนิยม 2 ตำแหน่ง
                                                }
                                            }
                                            ?>
                                            <div class="progress -KFI">
                                                <div class="progress-bar-<?= $colorFormat ?>"
                                                    style="width: <?= $showPercent ?>%;"></div>
                                                <span
                                                    class="progress-load-KFI load-<?= $colorFormat ?>"><?= $showPercent ?>%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row  mt-20" style="--bs-gutter-x:0px;">
                                        <div class="col-5 pl-5 pr-5">
                                            <div class="col-12 pim-small-text" style="justify-content: end !important;"><?= Yii::t('app', 'Last Updated on') ?></div>
                                            <div class="col-12 text-end pim-duedate-KFI mt-5">
                                                <?= $kfi['lastestUpdate'] == "" ? Yii::t('app', 'Not set') : $kfi['lastestUpdate'] ?>
                                            </div>
                                        </div>
                                        <div class="col-2 text-center align-content-center ">
                                            <?php
                                            if ($colorFormat == 'disable' && $role >= 5) {
                                            ?>
                                                <a class="pim-btn-setup"
                                                    href="<?= Yii::$app->homeUrl ?>kfi/management/update-kfi/<?= ModelMaster::encodeParams(['kfiId' => $kfiId, 'kfiHistoryId' => 0]) ?>">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/setupwhite.svg" class="mr-3"
                                                        style="width: 10.42px; height: 10.53px;">
                                                    <?= Yii::t('app', 'Setup') ?>
                                                </a>
                                            <?php
                                            } else if ($colorFormat == "complete") {
                                                // echo Yii::t('app', "Update");
                                            } else if ($role >= 5) {
                                            ?>
                                                <a class="pim-btn-<?= $colorFormat ?>"
                                                    href="<?= Yii::$app->homeUrl ?>kfi/management/update-kfi/<?= ModelMaster::encodeParams(['kfiId' => $kfiId, 'kfiHistoryId' => 0]) ?>">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh.svg" class="mr-3" style="width: 10.42px; height: 10.53px;">
                                                    <span style="margin-top: 2px;">
                                                        <?php
                                                        if ($colorFormat == "over") {
                                                            echo Yii::t('app', 'Update');
                                                        } else {
                                                            echo Yii::t('app', 'Update');
                                                        }
                                                        ?>
                                                    </span>
                                                </a>
                                            <?php
                                            } else { ?>
                                                <div class="pim-btn-disable"
                                                    style="display: flex; justify-content: center; align-items: center; padding: 7px 9px; height: 30px; gap: 6px; flex-shrink: 0;">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/locked.svg"
                                                        style="width: 10.42px; height: 10.53px;"> <?= Yii::t('app', 'Locked') ?>
                                                </div>
                                            <?php

                                            }
                                            ?>
                                        </div>
                                        <div class=" col-5 pl-5 pr-5">
                                            <div class="col-12 text-start pim-small-text font-<?= $colorFormat ?>">
                                                <?= Yii::t('app', 'Next Update Date') ?>
                                            </div>
                                            <div class="col-12 text-start pim-duedate-KFI mt-5">
                                                <?= $kfi['nextCheck'] == "" ? Yii::t('app', 'Not set') : $kfi['nextCheck'] ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                <?php
                    endforeach;
                }
                ?>
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
        <?= $this->render('history_modal', [
            "units" => $units,
        ]) ?>
        <?= $this->render('issue_modal', [
            "units" => $units,
        ]) ?>
        <?= $this->render('issue_modal') ?>
        <?= $this->render('modal_kgi') ?>
    </div>
</div>
<?= $this->render('delete_modal') ?>