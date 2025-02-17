<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'KFI';
?>
<div class="col-12">
    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.svg" class="home-icon mr-5"
            style="margin-top: -3px;">
        <strong class="pim-head-text"> <?= Yii::t('app', 'Performance Indicator Matrices') ?> (PIM)</strong>
    </div>
    <div class="col-12 mt-10">
        <?= $this->render('header_filter', [
            "role" => $role
        ]) ?>
        <div class="alert mt-10 pim-body bg-white">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 pt-2 key1">
                    <div class="row">
                        <div class="col-4">
                            <div class="row">
                                <div
                                    class="col-12 pim-type-tab-selected pl-7 pr-7 pb-2  text-center font-size-12 rounded-top-left">
                                    <img class="mr-8" src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/company.svg"
                                        style="width: 12px; height: 12px; cursor: pointer;"><?= Yii::t('app', 'Company KFI') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-8 text-start">
                            <?php
                            if ($role >= 3) {
                            ?>
                                <button type="button" class="btn-createnew pl-7 pr-7 pr-9 font-size-12"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                    <?= Yii::t('app', 'Create New') ?>
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg" alt="History"
                                        class="pim-icon ml-3" style="margin-top: -1px;"> </button>
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
                        "role" => $role,
                        "branchId" => $branchId,
                        "month" => $month,
                        "status" => $status,
                        "branches" => $branches,
                        "yearSelected" => $year
                    ]) ?>
                    <input type="hidden" id="type" value="list">
                </div>
                <div class="col-lg-1 col-md-6 col-12 pr-0 text-end">
                    <div class="btn-group" role="group">

                        <a href="<?= Yii::$app->homeUrl . 'kfi/management/grid' ?>" class=" btn btn-outline-primary
                            font-size-12 pim-change-modes">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/gridblack.svg"
                                style="cursor: pointer;">
                        </a>
                        <a href="<?= Yii::$app->homeUrl . 'kfi/management/index' ?>"
                            class="btn btn-primary font-size-12 pim-change-modes">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/listwhite.svg"
                                style="cursor: pointer;">
                        </a>

                    </div>
                </div>
            </div>
            <div class="col-12 mt-15">
                <div class="row">
                    <table class="">
                        <thead>
                            <tr class="pim-table-header">
                                <td class="pl-10" style="width:20%"><?= Yii::t('app', 'KFI Contents') ?></td>
                                <td style="width:17%"><?= Yii::t('app', 'Company Name') ?></td>
                                <td><?= Yii::t('app', 'Branch') ?></td>
                                <td class="text-center"><?= Yii::t('app', 'Quant Ratio') ?></td>
                                <td class="text-center"><?= Yii::t('app', 'Target') ?></td>
                                <td class="text-center"><?= Yii::t('app', 'Code') ?></td>
                                <td class="text-center"><?= Yii::t('app', 'Result') ?></td>
                                <td class="text-center" style="width:5%"><?= Yii::t('app', 'Ratio') ?></td>
                                <td class="text-center"><?= Yii::t('app', 'Unit') ?></td>
                                <td class="text-center"><?= Yii::t('app', 'Month') ?></td>
                                <td class="text-center"><?= Yii::t('app', 'Next Check') ?></td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($kfis) && count($kfis) > 0) {
                                foreach ($kfis as $kfiId => $kfi) :
                                    if ($kfi["isOver"] == 1 && $kfi["status"] != 2) {
                                        $colorFormat = 'over';
                                    } else {
                                        if ($kfi["status"] == 1) {
                                            $colorFormat = 'inprogress';
                                        } else {
                                            $colorFormat = 'complete';
                                        }
                                    }
                            ?>
                                    <tr height="10">

                                    </tr>
                                    <tr id="kfi-<?= $kfiId ?>" class="pim-bg-<?= $colorFormat ?> pim-table-text">
                                        <td>
                                            <div class="col-12 border-left-<?= $colorFormat ?> pim-div-border pb-5">
                                                <?= $kfi["kfiName"] ?></div>

                                        </td>
                                        <td><?= $kfi["companyName"] ?></td>
                                        <td>
                                            <img src="<?= Yii::$app->homeUrl ?><?= $kfi["flag"] ?>" class="Flag-Turkey">
                                            <?= $kfi["branchName"] ?>, <?= $kfi['countryName'] ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $kfi["quantRatio"] == 1 ? Yii::t('app', 'Quantity') : Yii::t('app', 'Quality') ?>
                                        </td>
                                        <td class="text-start">
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
                                        </td>
                                        <td class="text-center"><?= $kfi["code"] ?></td>
                                        <td class="text-end">
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
                                            <?= $showResult ?><?= $kfi["amountType"] == 1 ? '%' : '' ?>
                                        </td>
                                        <td>
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
                                                $showPercent = round($kfi['ratio'], 1);
                                            }
                                            ?>
                                            <div id="progress1">
                                                <div data-num="<?= $showPercent ?>"
                                                    class="progress-pim-table progress-circle-<?= $colorFormat ?>"></div>
                                            </div>
                                        </td>
                                        <td class="text-center"><?= Yii::t('app', 'Month') ?></td>
                                        <td class="text-center"><?= Yii::t('app', $kfi["month"]) ?></td>
                                        <td class="<?= $kfi['isOver'] == 1 ? 'text-danger' : '' ?> text-center">

                                            <?= $kfi["status"] == 1 ? $kfi["nextCheck"] : '' ?>
                                        </td>
                                        <td>
                                            <a href="<?= Yii::$app->homeUrl ?>kfi/view/kfi-history/<?= ModelMaster::encodeParams(['kfiId' => $kfiId]) ?>"
                                                class="btn btn-bg-white-xs mr-5" style="margin-top: -1px;">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/eye.svg" alt="History"
                                                    class="pim-icon" style="margin-top: -1px;">
                                            </a>
                                            <span class="dropdown" href="#" id="dropdownMenuLink-<?= $kfiId ?>"
                                                data-bs-toggle="dropdown">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/3Dot.svg"
                                                    class="icon-table on-cursor">
                                            </span>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink-<?= $kfiId ?>">
                                                <?php
                                                if ($role >= 5) {
                                                ?>
                                                    <li class="pl-4 pr-4" title="Update">
                                                        <a class="dropdown-itemNEWS pl-4 pr-20 mb-5"
                                                            href="<?= Yii::$app->homeUrl ?>kfi/management/update-kfi/<?= ModelMaster::encodeParams(['kfiId' => $kfiId, 'kfiHistoryId' => 0]) ?>">
                                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/editblack.svg"
                                                                alt="edit" class="pim-icon mr-10" style="margin-top: -2px;">
                                                            <?= Yii::t('app', 'Edit') ?>
                                                        </a>
                                                    </li>
                                                <?php
                                                }
                                                ?>
                                                <li class="pl-4 pr-4" data-bs-toggle="modal">
                                                    <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                        href="<?= Yii::$app->homeUrl ?>kfi/view/kfi-history/<?= ModelMaster::encodeParams(['kfiId' => $kfiId, 'openTab' => 4]) ?>"
                                                        class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.svg"
                                                            alt="Chart" class="pim-icon mr-10" style="margin-top: -2px;">
                                                        <?= Yii::t('app', 'Chart') ?>
                                                    </a>
                                                </li>
                                                <?php
                                                if ($role >= 5) {
                                                ?>
                                                    <li class="pl-4 pr-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop4"
                                                        onclick="javascript:prepareDeleteKfi(<?= $kfiId ?>)" title="Delete">
                                                        <a class="dropdown-itemNEW pl-4 pr-25" href="#">
                                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/delete.svg"
                                                                alt="Delete" class="pim-icon mr-10" style="margin-top: -2px;">
                                                            <?= Yii::t('app', 'Delete') ?>
                                                        </a>
                                                    </li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </td>
                                    </tr>
                            <?php
                                endforeach;
                            }
                            ?>
                        </tbody>
                    </table>
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


    <?= $this->render('history_modal', [
        "units" => $units,
    ]) ?>
    <?= $this->render('issue_modal') ?>
    <?= $this->render('delete_modal') ?>

</div>