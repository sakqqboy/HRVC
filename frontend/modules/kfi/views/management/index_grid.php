<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = Yii::t('app', 'KFI Grid View');
?>
<div class="contrainer-body">
    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.svg" class="home-icon mr-5"
            style="margin-top: -3px;">
        <strong class="pim-head-text"> <?= Yii::t('app', 'Performance Indicator Matrices (PIM)') ?></strong>
    </div>
    <div class="col-12 mt-10">
        <?= $this->render('header_filter', [
            "role" => $role
        ]) ?>
        <div class="alert  mt-10 pim-body bg-white">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 pt-2 key1">
                    <div class="row">
                        <div class="col-4">
                            <div class="row">
                                <div
                                    class="col-12 pim-type-tab-selected pl-7 pr-7 pt-4 pb-2  text-center font-size-12 rounded-top-left">
                                    <img class="mr-8" src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/company.svg"
                                        style="width: 12px; height: 12px; cursor: pointer;"><?= Yii::t('app', 'Company KFI') ?>
                                </div>
                            </div>
                        </div>
                        <div class=" col-8">
                            <?php
                            if ($role >= 3) {
                            ?>
                            <a type="button" class="btn-createnew pl-7 pr-7 pr-9 font-size-12"
                                href="<?= Yii::$app->homeUrl ?>kfi/management/create-kfi/"
                                style="text-decoration: none;">
                                <?= Yii::t('app', 'Create New') ?>
                                <img src=" <?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg" alt="History"
                                    class="pim-icon ml-3" style="margin-top: -1px;">
                            </a>
                            <?php
                            }
                            ?>
                        </div>

                    </div>
                </div>
                <div class="col-lg-7 col-md-12 col-12 pt-1">
                    <?= $this->render('filter_list', [
                        "companies" => $companies,
                        "months" => $months,
                        "role" => $role,
                        "companyId" => $companyId

                    ]) ?>
                    <input type="hidden" id="type" value="grid">
                </div>
                <div class="col-lg-1 col-md-6 col-12 pr-0 text-end">
                    <div class="btn-group" role="group">
                        <a href="#" class="btn btn-primary font-size-12 pim-change-modes">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/gridwhite.svg"
                                style="cursor: pointer;">
                        </a>
                        <a href="<?= Yii::$app->homeUrl . 'kfi/management/index' ?>"
                            class="btn btn-outline-primary font-size-12 pim-change-modes">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/listblack.svg"
                                style="cursor: pointer;">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-5">
                <div class="row">
                    <?php
                    if (isset($kfis) && count($kfis) > 0) {
                        foreach ($kfis as $kfiId => $kfi) :
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
                    <div class="col-12 mt-10 mb-5 pim-big-box pim-<?= $colorFormat ?>" id="kfi-<?= $kfiId ?>">
                        <div class="row">
                            <div class="col-12 text-start pl-22  col-lg-4 col-md-5  "
                                style="color: #3C3D48; font-family: 'SF Pro Display'; font-size: 20px; font-style: normal; font-weight: 600; line-height: 20px; text-transform: capitalize;">
                                <?= $kfi["kfiName"] ?>
                            </div>
                            <div class="col-lg-1 col-md-2 col-4 text-center">
                                <div class="<?= $colorFormat ?>-tag text-center">
                                    <?= $kfi['status'] == 1 ? Yii::t('app', 'In process') : Yii::t('app', 'Completed') ?>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-2 col-4 text-center">
                                <div class="text-center">
                                </div>
                            </div>
                            <div class=" col-lg-3 col-md-3 col-4 pl-30 text-center">
                                <div class="row">
                                    <div class="col-4 month-<?= $colorFormat ?>">
                                        <?= $kfi['month'] == "" ? Yii::t('app', 'Month') : Yii::t('app', $kfi['month']) ?>
                                    </div>
                                    <div class="col-8 term-<?= $colorFormat ?>">
                                        <?= $kfi['fromDate'] == "" ? Yii::t('app', 'Not set') : $kfi['fromDate'] ?> -
                                        <?= $kfi['toDate'] == "" ? Yii::t('app', 'Not set') : $kfi['toDate'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-2 col-4 text-end pr-20">
                                <a href="<?= Yii::$app->homeUrl ?>kfi/view/kfi-history/<?= ModelMaster::encodeParams(["kfiId" => $kfiId, 'openTab' => 1]) ?>"
                                    class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?>"
                                    style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" alt="History"
                                        class="pim-icon" style="margin-top: -1px;">
                                </a>
                                <a href="<?= Yii::$app->homeUrl ?>kfi/view/index/<?= ModelMaster::encodeParams(['kfiId' => $kfiId, 'openTab' => 2]) ?>"
                                    class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?>"
                                    style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/history.svg" alt="History"
                                        class="pim-icon mr-3" style="margin-top: -2px;"><?= Yii::t('app', 'History') ?>
                                </a>
                                <a href="<?= Yii::$app->homeUrl ?>kfi/view/kfi-history/<?= ModelMaster::encodeParams(['kfiId' => $kfiId, 'openTab' => 4]) ?>"
                                    class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?>"
                                    style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.svg" alt="Chart"
                                        class="pim-icon mr-3" style="margin-top: -2px;"> <?= Yii::t('app', 'Chart') ?>
                                </a>
                                <?php
                                        if ($role >= 5) {
                                        ?>
                                <a class="btn btn-bg-red-xs" data-bs-toggle="modal" data-bs-target="#staticBackdrop4"
                                    onclick="javascript:prepareDeleteKfi(<?= $kfiId ?>)" style="margin-top: -3px;"
                                    onmouseover="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binwhite.svg'"
                                    onmouseout="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg'">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg" alt="History"
                                        class="pim-icon" style="margin-top: -3px; width: 12px; height: 14px;">
                                </a>
                                <?php
                                        }
                                        ?>
                            </div>
                            <div class="col-lg-3 pim-subheader-font border-right-<?= $colorFormat ?> mt-5">
                                <div class="row">
                                    <div class="col-12 text-start pl-22 "
                                        style="color: #3C3D48;  font-family: 'SF Pro Display'; font-size: 14px; font-style: normal; font-weight: 500; line-height: 20px; align-self: stretch;">
                                        <?= Yii::t('app', 'Assign on') ?>
                                    </div>

                                    <div class="col-12 pr-10 pl-30">
                                        <div class="col-12 mt-5 pt-2 pb-1">
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="row pim-picgroup">
                                                        <?php if ($kfi["countEmployee"] != 0) { ?>
                                                        <div class="col-2">
                                                            <?php
                                                                        if (isset($kfi['kfiEmployee'][0])) {
                                                                        ?>
                                                            <img src="<?= Yii::$app->homeUrl . $kfi['kfiEmployee'][0] ?>"
                                                                class="pim-pic-gridKFI">
                                                            <?php
                                                                        }
                                                                        ?>
                                                        </div>
                                                        <div class="col-2 pic-afterKFI pt-0">
                                                            <?php
                                                                        if (isset($kfi['kfiEmployee'][1])) {
                                                                        ?>
                                                            <img src="<?= Yii::$app->homeUrl . $kfi['kfiEmployee'][1] ?>"
                                                                class="pim-pic-gridKFI">
                                                            <?php
                                                                        }
                                                                        ?>
                                                        </div>
                                                        <?php } else { ?>
                                                        <div class="col-2">
                                                            <div class="pim-pic-yenlowKFI">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg"
                                                                    alt="person icon">
                                                            </div>
                                                        </div>
                                                        <div class="col-2">
                                                            <div class="pim-pic-yenlowKFI">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/personblack.svg"
                                                                    alt="person icon">
                                                            </div>
                                                        </div>
                                                        <?php } ?>
                                                        <div class="col-6 number-tag load-<?= $kfi["countEmployee"] == 0 ? 'yenlow' : $colorFormat ?> pr-0 pl-0 pim-pic-gridKFINum "
                                                            style="font-size: 18px;">
                                                            <?= $kfi["countEmployee"] ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-7 <?= $kfi["countEmployee"] == 0 ? 'yenlow' : $colorFormat ?>-assignKFI">
                                                    <?php
                                                            if ($role >= 5) {
                                                            ?>
                                                    <img
                                                        src="<?= Yii::$app->homeUrl ?>images/icons/Settings/assign-<?= $kfi["countEmployee"] == 0 ? 'yenlow' : $colorFormat ?>.svg">
                                                    <a href="<?= Yii::$app->homeUrl ?>kfi/assign/assign/<?= ModelMaster::encodeParams(['kfiId' => $kfiId, "companyId" => $kfi['companyId']]) ?>"
                                                        class="font-<?= $kfi["countEmployee"] == 0 ? 'black' : $colorFormat ?>">
                                                        <?php echo $kfi["countEmployee"] == 0 ?  Yii::t('app', 'Assign Person') :  Yii::t('app', 'Change Assign'); ?>
                                                    </a>
                                                    <?php
                                                            } else { ?>
                                                    <div class="d-flex align-items-center" style="margin-left: 9px;">
                                                        <div class="circle-color-<?= $kfi["countEmployee"] == 0 ? 'yenlow' : $colorFormat ?>"
                                                            style=" margin-right: 5px;">
                                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $colorFormat != 'disable' && $kfi["countEmployee"] != 0 ? 'eyewhite.svg' : 'eye.svg' ?>"
                                                                class="home-icon"
                                                                style="width: 19px; height: 14px; margin-top: -1px;">
                                                        </div>
                                                        <a href="<?= Yii::$app->homeUrl ?>kfi/view/kfi-history/<?= ModelMaster::encodeParams(["kfiId" => $kfiId, 'openTab' => 1]) ?>"
                                                            class="font-<?= $kfi["countEmployee"] == 0 ? 'black' : $colorFormat ?>">
                                                            <?php echo $kfi["countEmployee"] == 0 ? Yii::t('app', 'View Assign') :  Yii::t('app', 'View Assign'); ?>
                                                        </a>
                                                    </div>
                                                    <?php
                                                            }
                                                            ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 pim-subheader-font border-right-<?= $colorFormat ?> mt-5 pl-10 pr-10">
                                <div class="col-12 mt-18">
                                    <div class="row">
                                        <div class="col-6 border-right-<?= $colorFormat ?>">
                                            <div class="col-12  pr-6 pt-10 text-center">
                                                <?= Yii::t('app', 'Quant Ratio') ?></div>
                                            <div class="col-12 pim-duedate text-center mt-2">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $kfi["quantRatio"] == 1 ? Yii::t('app', 'quantity') : Yii::t('app', 'diamon') ?>.svg"
                                                    class="pim-iconKFI" style="margin-top: -1px; margin-left: 3px;">
                                                <?= $kfi["quantRatio"] == 1 ? Yii::t('app', 'Quantity') : Yii::t('app', 'Quality') ?>
                                            </div>
                                        </div>

                                        <!-- Right Column: Update Interval -->
                                        <div class="col-6">
                                            <div class="col-12 pr-0 pt-10 text-center">
                                                <?= Yii::t('app', 'Update Interval') ?>
                                            </div>
                                            <div class="col-12 pim-duedate text-center mt-2">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/monthly.svg"
                                                    class="pim-iconKFI" style="margin-top: -3px;">
                                                <?= Yii::t('app', $kfi["unit"]) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6 pim-subheader-font  mt-5 pr-15 pl-15">
                                <div class="row">
                                    <div class="col-5 text-start">
                                        <div class="col-12">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Target.svg"
                                                class="pim-iconKFI" style="margin-top: 1px; margin-right: 3px;">
                                            <?= Yii::t('app', 'Target') ?>
                                        </div>
                                        <div class="col-12 mt-3 number-pim">
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
                                    <div class="col-2 symbol-pim text-center">
                                        <div class="col-12 pt-17"><?= $kfi["code"] ?></div>
                                    </div>
                                    <div class="col-5  text-end">
                                        <div class="col-12">
                                            <?= Yii::t('app', 'Result') ?>
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Result.svg"
                                                class="pim-iconKFI" style="margin-top: 1px; margin-left: 3px;">
                                        </div>
                                        <div class="col-12 mt-3 number-pim">
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
                                    <div class="col-12 pl-15 pr-10">
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

                                        <div class="progress">
                                            <div class="progress-bar-<?= $colorFormat ?>"
                                                style="width: <?= $showPercent ?>%;"></div>
                                            <span
                                                class="progress-load load-<?= $colorFormat ?>"><?= $showPercent ?>%</span>
                                        </div>

                                    </div>
                                    <div class="col-5 pl-5 pr-5 mt-10 ">
                                        <div class="col-12 text-end "><?= Yii::t('app', 'Last Updated on') ?></div>
                                        <div class="col-12 text-end pim-duedate">
                                            <?= $kfi['nextCheck'] == "" ? Yii::t('app', 'Not set') : $kfi['nextCheck'] ?>
                                        </div>
                                    </div>
                                    <div class="col-2 text-center mt-10">

                                        <?php
                                                if ($colorFormat == 'disable' && $role >= 5) {
                                                ?>
                                        <a type="button" class="pim-btn-setup"
                                            href="<?= Yii::$app->homeUrl ?>kfi/management/update-kfi/<?= ModelMaster::encodeParams(['kfiId' => $kfiId, 'kfiHistoryId' => 0]) ?>"
                                            style="display: flex; justify-content: center; align-items: center; padding: 7px 9px; height: 30px; gap: 6px; flex-shrink: 0;"
                                            class="pim-btn-setup">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/setupwhite.svg"
                                                style="width: 14px; height: 14px;">
                                            <?= Yii::t('app', 'Setup') ?>
                                        </a>
                                        <?php
                                                } else if ($role >= 5) {
                                                ?>

                                        <a class="pim-btn-<?= $colorFormat ?>"
                                            href="<?= Yii::$app->homeUrl ?>kfi/management/update-kfi/<?= ModelMaster::encodeParams(['kfiId' => $kfiId, 'kfiHistoryId' => 0]) ?>"
                                            style="display: flex; justify-content: center; align-items: center; padding: 7px 9px; height: 30px; gap: 6px; flex-shrink: 0;"
                                            class="pim-btn-setup">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh.svg"
                                                style="width: 14px; height: 14px;">
                                            <?php if ($colorFormat == "complete") {
                                                            echo Yii::t('app', "Update");
                                                        } else if ($colorFormat == "over") {
                                                            echo Yii::t('app', 'Update');
                                                        } else {
                                                            echo Yii::t('app', 'Update');
                                                        }
                                                        ?>
                                        </a>
                                        <?php
                                                } else { ?>
                                        <div class="pim-btn-disable"
                                            style="display: flex; justify-content: center; align-items: center; padding: 7px 9px; height: 30px; gap: 6px; flex-shrink: 0;">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/locked.svg"
                                                style="width: 14px; height: 14px;"> <?= Yii::t('app', 'Locked') ?>
                                        </div>
                                        <?php

                                                }
                                                ?>
                                    </div>
                                    <div class=" col-5 pl-0 pr-11 mt-10">
                                        <div class="col-12 text-start font-<?= $colorFormat ?>">
                                            <?= Yii::t('app', 'Next Update Date') ?>
                                        </div>
                                        <div class="col-12 text-start pim-duedate">
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