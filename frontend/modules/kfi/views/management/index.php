<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'KFI';
?>
<div class="col-12 mt-70 pt-20">
    <div class="d-flex justify-content-start pt-0 pb-0" style="line-height: 30px;">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Group23177.svg" class="pim-head-icon mr-11 mt-2">
        <span class="pim-head-text mr-10"> <?= Yii::t('app', 'Performance Indicator Matrices (PIM)') ?></span>
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
        "totalBranch" => $totalBranch,
        "page" => 'list'
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
                        "page" => "list",
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
            <div class="col-12 mt-20 pl-10 pr-10 pim-content mb-10" id="main-body">
                <div class="row" style="--bs-gutter-x:0px;">
                    <table class="">
                        <thead>
                            <tr class="pim-table-header">
                                <td class="pl-10" style="max-width:250px;"><?= Yii::t('app', 'KFI Contents') ?></td>
                                <td style="max-width:170px;"><?= Yii::t('app', 'Company Name') ?></td>
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
                            if (isset($kfis["data"]) && count($kfis["data"]) > 0) {
                                foreach ($kfis["data"] as $kfiId => $kfi) :
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
                                    <tr height="10">

                                    </tr>
                                    <tr id="kfi-<?= $kfiId ?>" class="pim-bg-<?= $colorFormat ?> pim-table-text">
                                        <td>
                                            <div class="col-12 border-left-<?= $colorFormat ?> pim-div-border pb-5 text-truncate" style="max-width:240px;" title='<?= $kfi["kfiName"] ?>'>
                                                <?= $kfi["kfiName"] ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-truncate" style="max-width:150px;" title='<?= $kfi["companyName"] ?>'>
                                                <?= $kfi["companyName"] ?>
                                            </div>
                                        </td>
                                        <td>
                                            <img src="<?= Yii::$app->homeUrl ?><?= $kfi["flag"] ?>" class="Flag-Turkey mr-3">
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
                                            ?>
                                            <?= $showResult ?><?= $kfi["amountType"] == 1 ? '%' : '' ?>
                                        </td>
                                        <td>
                                            <?php
                                            // ดึงค่า $kfi['ratio'] มาเก็บในตัวแปรชั่วคราวแล้วแปลงเป็น float ก่อน
                                            $ratioValue = floatval($kfi['ratio']);
                                            // หรือใช้ $ratioValue = (float)$kfi['ratio'];

                                            if (isset($percent[0]) && $percent[0] == '0') {
                                                if (isset($percent[1])) {
                                                    if ($percent[1] == '00') {
                                                        $showPercent = 0;
                                                    } else {
                                                        // ใช้ $ratioValue ที่ถูกแปลงแล้ว
                                                        $showPercent = round($ratioValue, 1);
                                                    }
                                                }
                                            } else {
                                                // ใช้ $ratioValue ที่ถูกแปลงแล้ว
                                                $showPercent = round($ratioValue);
                                            }
                                            ?>
                                            <div id="progress1">
                                                <div data-num="<?= $showPercent ?>"
                                                    class="progress-pim-table progress-circle-<?= $colorFormat ?>"></div>
                                            </div>
                                        </td>
                                        <td class="text-center"><?= $kfi["quantRatio"] == 1 ? Yii::t('app', 'Quantity') : Yii::t('app', 'Quality') ?></td>
                                        <td class="text-center"><?= $kfi["month"] ?></td>
                                        <td class="<?= $colorFormat == 'over' ? 'text-danger' : '' ?> text-center font-<?= $colorFormat ?>">

                                            <?= $kfi['nextCheck'] == "" ? Yii::t('app', 'Not set') : $kfi['nextCheck'] ?>
                                        </td>
                                        <td>
                                            <a href="<?= Yii::$app->homeUrl ?>kfi/view/kfi-history/<?= ModelMaster::encodeParams(['kfiId' => $kfiId]) ?>"
                                                class="icon-btn-white mr-5 align-content-center">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/eye.svg"
                                                    alt="History" class="pim-icon" style="width:16px;height:16px;">
                                            </a>

                                            <span class="dropdown" href="#" id="dropdownMenuLink-<?= $kfiId ?>"
                                                data-bs-toggle="dropdown">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/3Dot.svg"
                                                    class="icon-table on-cursor">
                                            </span>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink-<?= $kfiId ?>">
                                                <?php
                                                if ($colorFormat == "complete") {
                                                    // echo Yii::t('app', "Update");
                                                } else if ($role >= 5) {
                                                ?>
                                                    <li class="pl-4 pr-4" title="Update">
                                                        <a class="dropdown-itemNEWS pl-4 pr-20 mb-5"
                                                            href="<?= Yii::$app->homeUrl ?>kfi/management/update-kfi/<?= ModelMaster::encodeParams(['kfiId' => $kfiId, 'kfiHistoryId' => 0]) ?>">
                                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/editblack.svg"
                                                                alt="edit" class="pim-icon mr-5" style="width:16px;height:16px;">
                                                            <?= Yii::t('app', 'Edit') ?>
                                                        </a>
                                                    </li>
                                                <?php
                                                }
                                                ?>
                                                <li class="pl-4 pr-4" data-bs-toggle="modal">
                                                    <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                        href="<?= Yii::$app->homeUrl ?>kfi/view/kfi-history/<?= ModelMaster::encodeParams(['kfiId' => $kfiId, 'openTab' => 4]) ?>"
                                                        class="btn btn-bg-white-xs mr-3">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/chart.svg"
                                                            alt="Chart" class="pim-icon mr-5" style="width:16px;height:16px;">
                                                        <?= Yii::t('app', 'Chart') ?>
                                                    </a>
                                                </li>
                                                <?php
                                                if ($role >= 5) {
                                                ?>
                                                    <li class="pl-4 pr-4" data-bs-toggle="modal"
                                                        data-bs-target="#staticBackdrop4"
                                                        onclick="javascript:prepareDeleteKfi(<?= $kfiId ?>)" title="Delete">
                                                        <a class="dropdown-itemNEW pl-4 pr-25" href="#">
                                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/delete.svg"
                                                                alt="Delete" class="pim-icon mr-5" style="width:16px;height:16px;">
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
            <?php
            echo $this->render('pagination_page', [
                'totalKfi' => $totalKfi,
                "currentPage" => $currentPage,
                'totalPage' => $totalPage,
                "pagination" => $pagination,
                "pageType" => "list",
                "filter" => isset($filter) ? $filter : []
            ]);
            ?>
            <input type="hidden" id="totalPage" value="<?= $totalPage > 1 ? 1 : 0 ?>">
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
    "companies" => $companies,
    "units" => $units,
    "months" => $months,
    "isManager" => $isManager
]) ?>
<?php ActiveForm::end(); ?>
<?= $this->render('history_modal', [
    "units" => $units,
]) ?>
<?= $this->render('issue_modal') ?>
<?= $this->render('modal_kgi') ?>
<?= $this->render('delete_modal') ?>