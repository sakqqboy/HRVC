<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'KFI Grid View';
?>

<div class="col-12">
    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.png" class="home-icon mr-5"
            style="margin-top: -3px;">
        <strong class="pim-head-text"> Performance Indicator Matrices (PIM)</strong>
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
                                    class="col-12 pim-type-tab-selected pl-7 pr-7 pb-2  text-center font-size-12 rounded-top-left">
                                    <img class="mr-8" src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/company.svg"
                                        style="width: 12px; height: 12px; cursor: pointer;">Company KFI
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <?php
                            if ($role >= 3) {
                            ?>
                            <button type="button" class="btn-createnew pl-7 pr-7 pr-9 font-size-12"
                                data-bs-target="#staticBackdrop1">
                                Create New
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg" alt="History"
                                    class="pim-icon ml-3" style="margin-top: -1px;">
                            </button>
                            <?php
                            }
                            ?>
                        </div>

                    </div>
                </div>
                <div class="col-lg-7 col-md-12 col-12 pt-2 New-KFI">
                    <?= $this->render('filter_list_search', [
                        "companies" => $companies,
                        "months" => $months,
                        "companyId" => $companyId,
                        "branchId" => $branchId,
                        "month" => $month,
                        "status" => $status,
                        "branches" => $branches,
                        "yearSelected" => $year
                    ]) ?>
                    <input type="hidden" id="type" value="grid">
                </div>
                <div class="col-lg-1 col-md-6 col-12 pr-0 text-end">
                    <!-- <div class="btn-group" role="group">
                        <a href="#" class="btn btn-primary font-size-12 pim-change-mode">
                            <i class="fa fa-th-large" aria-hidden="true"></i>
                        </a>
                        <a href="<?= Yii::$app->homeUrl . 'kfi/management/index' ?>"
                            class="btn btn-outline-primary font-size-12 pim-change-mode">
                            <i class="fa fa-list-ul" aria-hidden="true"></i>
                        </a>

                    </div> -->
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
                            <div class="col-lg-4 col-md-5 col-12 pim-name">
                                <?= $kfi["kfiName"] ?>
                            </div>
                            <div class="col-lg-1 col-md-2 col-4 text-center">
                                <div class="<?= $colorFormat ?>-tag text-center">
                                    <?= $kfi['status'] == 1 ? 'In process' : 'Completed' ?>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-2 col-4 text-center">
                                <div class="text-center">
                                </div>
                            </div>
                            <div class=" col-lg-3 col-md-3 col-4 pl-30">
                                <div class="row">
                                    <div class="col-4 month-<?= $colorFormat ?>">
                                        <?= $kfi['month'] == "" ? 'Month' : $kfi['month'] ?>
                                    </div>
                                    <div class="col-8 term-<?= $colorFormat ?>">
                                        <?= $kfi['fromDate'] == "" ? 'Not set' : $kfi['fromDate'] ?> -
                                        <?= $kfi['toDate'] == "" ? 'Not set' : $kfi['toDate'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-2 col-4 text-end pr-20">
                                <!-- <a href="<?= Yii::$app->homeUrl ?>kfi/view/index/<?= ModelMaster::encodeParams(["kfiId" => $kfiId]) ?>" class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
											<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.png" alt="History" class="pim-icon" style="margin-top: -1px;">
										</a>
										<a href="<?= Yii::$app->homeUrl ?>kfi/view/kfi-history/<?= ModelMaster::encodeParams(['kfiId' => $kfiId]) ?>" class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
											<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.png" alt="History" class="pim-icon">
										</a> -->
                                <!-- <a class="btn btn-bg-white-xs mr-5" data-bs-toggle="modal" data-bs-target="#staticBackdrop3" onclick="javascript:kfiHistory(<?php // $kfiId 
                                                                                                                                                                            ?>)" style="margin-top: -3px;">
											<img src="<?php // Yii::$app->homeUrl 
                                                        ?>images/icons/Settings/comment.png" alt="History" class="pim-icon">
										</a> -->
                                <!-- <a href="<?= Yii::$app->homeUrl ?>kfi/chart/company-chart/<?= ModelMaster::encodeParams(['kfiId' => $kfiId]) ?>" class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
											<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.png" alt="History" class="pim-icon mr-3" style="margin-top: -2px;">Chart
										</a> -->
                                <a href="<?= Yii::$app->homeUrl ?>kfi/view/kfi-history/<?= ModelMaster::encodeParams(["kfiId" => $kfiId, 'openTab' => 1]) ?>"
                                    class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?>"
                                    style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.png" alt="History"
                                        class="pim-icon" style="margin-top: -1px;">
                                </a>
                                <a href="<?= Yii::$app->homeUrl ?>kfi/view/index/<?= ModelMaster::encodeParams(['kfiId' => $kfiId, 'openTab' => 2]) ?>"
                                    class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?>"
                                    style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/history.svg" alt="History"
                                        class="pim-icon mr-3" style="margin-top: -2px;">History
                                </a>
                                <a href="<?= Yii::$app->homeUrl ?>kfi/view/kfi-history/<?= ModelMaster::encodeParams(['kfiId' => $kfiId, 'openTab' => 4]) ?>"
                                    class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?>"
                                    style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.png" alt="Chart"
                                        class="pim-icon mr-3" style="margin-top: -2px;"> Chart
                                </a>
                                <?php
                                        if ($role >= 5) {
                                        ?>
                                <a class="btn btn-bg-red-xs" data-bs-toggle="modal" data-bs-target="#staticBackdrop4"
                                    onclick="javascript:prepareDeleteKfi(<?= $kfiId ?>)" style="margin-top: -3px;"
                                    onmouseover="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binwhite.svg'"
                                    onmouseout="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg'">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg" alt="History"
                                        class="pim-icon" style="margin-top: -2px;">
                                </a>

                                <?php
                                        }
                                        ?>
                            </div>
                            <div class="col-lg-3 pim-subheader-font border-right-<?= $colorFormat ?> mt-5">
                                <div class="row">
                                    <div class="col-12 text-start pl-22 font-size-12 fw-bold text-dark">
                                        Assign on
                                    </div>
                                    <div class="col-10 pr-10 pl-30">
                                        <!-- <div class="col-12 <?= $colorFormat ?>-assign  mt-5 pt-2 pb-1"> -->
                                        <div class="col-12 mt-5 pt-2 pb-1">
                                            <div class="row">
                                                <!-- <div class="col-5 border-right-<?= $colorFormat ?>"> -->
                                                <div class="col-5">
                                                    <div class="row pim-picgroup">
                                                        <?php if ($kfi["countEmployee"] != 0) {?>
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
                                                        <?php }else {?>
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
                                                        <?php }?>
                                                        <div
                                                            class="col-6 number-tag load-<?= $kfi["countEmployee"] == 0 ? 'yenlow' : $colorFormat ?> pr-0 pl-0 pim-pic-gridKFINum ">
                                                            <?= $kfi["countEmployee"] ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-7 pl-1 pt-10 pr-0 <?=  $kfi["countEmployee"] == 0 ? 'yenlow' : $colorFormat ?>-assignKFI">
                                                    <span class="pull-left mt-1 pl-2  pr-4">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/assign-<?=  $kfi["countEmployee"] == 0 ? 'yenlow' : $colorFormat ?>.svg"
                                                            class="home-icon" style="margin-top: -3px;">
                                                    </span>
                                                    <?php
                                                            if ($role >= 5) {
                                                            ?>
                                                    <a href="<?= Yii::$app->homeUrl ?>kfi/assign/assign/<?= ModelMaster::encodeParams(['kfiId' => $kfiId, "companyId" => $kfi['companyId']]) ?>"
                                                        class="font-<?= $kfi["countEmployee"] == 0 ? 'black' : $colorFormat ?>">
                                                        <?php echo $kfi["countEmployee"] == 0 ?  "Assign Person" :  "Change Assigned"; ?>
                                                    </a>
                                                    <?php
                                                            } else { ?>
                                                    <span class="font-<?= $colorFormat ?>">
                                                        Assign Person
                                                    </span>
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
                                        <!-- <div class="col-6 "> -->
                                        <div class="col-6 border-right-<?= $colorFormat ?>">
                                            <div class="col-12  pr-6 pt-10 text-center">Quant Ratio</div>
                                            <div class="col-12 pim-duedate text-center mt-2">
                                                <!-- <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/diamon.svg"
                                                    class="pim-iconKFI" style="margin-top: -3px;"> -->
                                                <!-- <div
                                                class="col-12 border-right-<?= $colorFormat ?>  pl-12 pr-12 text-center"> -->
                                                <!-- <i class="fa fa-diamond" aria-hidden="true"></i> -->
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $kfi["quantRatio"] == 1 ? 'quantity' : 'diamon' ?>.svg"
                                                    class="pim-iconKFI" style="margin-top: -1px; margin-left: 3px;">
                                                <?= $kfi["quantRatio"] == 1 ? 'Quantity' : 'Quality' ?>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="col-12 pr-0 pt-10 text-center">Update Interval</div>
                                            <div class="col-12 pim-duedate text-center mt-2">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/monthly.svg"
                                                    class="pim-iconKFI" style="margin-top: -3px;"> <?= $kfi["unit"] ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6 pim-subheader-font mt-5 pr-15 pl-15">
                                <div class="row">
                                    <div class="col-5 text-start">
                                        <div class="col-12">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Target.svg"
                                                class="pim-iconKFI" style="margin-top: 1px; margin-right: 3px;">
                                            Target
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
                                            Result
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
                                                $percent = explode('.', $kfi['ratio']);
                                                if (isset($percent[0]) && $percent[0] == '0') {
                                                    if (isset($percent[1])) {
                                                        if ($percent[1] == '00') {
                                                            $showPercent = 0;
                                                        } else {
                                                            $showPercent = round($kfi['ratio'], 1);
                                                        }
                                                    }
                                                } else {
                                                    $showPercent = round($kfi['ratio']);
                                                }
                                                ?>
                                        <div class="progress">
                                            <div class="progress-bar-<?= $colorFormat ?>"
                                                style="width:<?= $showPercent ?>%;"></div>
                                            <span
                                                class="progress-load load-<?= $colorFormat ?>"><?= $showPercent ?>%</span>
                                        </div>
                                    </div>
                                    <div class="col-5 pl-5 pr-11 mt-10">
                                        <div class="col-12 text-end ">Last Updated on</div>
                                        <div class="col-12 text-end pim-duedate">
                                            <?= $kfi['nextCheck'] == "" ? 'Not set' : $kfi['nextCheck'] ?></div>
                                    </div>
                                    <div class="col-2 text-center mt-10 pt-6">
                                        <?php
                                        if ($colorFormat == 'disable' && $role >= 5 ) {
                                        ?>
                                        <div onclick="javascript:updateKfi(<?= $kfiId ?>)" class="pim-btn-setup"
                                            data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/setupwhite.svg"
                                                class="mb-2" style="width: 12px; height: 12px;"> Setup
                                        </div>
                                        <?php
                                            }else if ($role >= 5){
                                        ?>
                                        <div onclick=" javascript:updateKfi(<?= $kfiId ?>)"
                                            class="pim-btn-<?= $colorFormat ?>" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop2">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh.svg"
                                                class="mb-2" style="width: 12px; height: 12px;">
                                            <?php if($colorFormat == "complete") { 
                                                          echo  "Edit";
                                                         } else if($colorFormat == "over") 
                                                         { 
                                                            echo  "Update";

                                                         } else {
                                                            echo  "Update";
                                                         }
                                                         ?>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                    <div class="col-5 pl-0 pr-11 mt-10">
                                        <div class="col-12 text-start font-<?= $colorFormat ?>">Next Update Date</div>
                                        <div class="col-12 text-start pim-duedate">
                                            <?= $kfi['nextCheck'] == "" ? 'Not set' : $kfi['nextCheck'] ?></div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-lg-5 pim-subheader-font mt-5">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12 pr-3 pl-20">
                                        <div class="col-12 head-letter head-<?= $colorFormat ?>">Issue</div>
                                        <div class="col-12 body-letter body-letter-<?= $colorFormat ?>">
                                            Now use Lorem Ipsum as their default model text, and a search for 'lorem
                                            ipsum' will uncover many web sites still in their infancy. Various versions.
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 pl-5 pr-20">
                                        <div class="col-12 head-letter head-<?= $colorFormat ?>">Solution</div>
                                        <div class="col-12 body-letter body-letter-<?= $colorFormat ?>">Now use Lorem
                                            Ipsum as their default model text, and a search for 'lorem ipsum' will
                                            uncover many web sites still in their infancy. Various versions.

                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>

                    <?php
                        endforeach;
                    }
                    ?>
                </div>
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
        "isManager" => $isManager,
        "units" => $units,
        "months" => $months,
        "companies" => $companies,
    ]) ?>

    <?php ActiveForm::end(); ?>
    <?= $this->render('delete_modal') ?>
    <?= $this->render('history_modal', [
        "units" => $units,
    ]) ?>
    <?= $this->render('issue_modal', [
        "units" => $units,
    ]) ?>
    <?= $this->render('issue_modal') ?>
</div>