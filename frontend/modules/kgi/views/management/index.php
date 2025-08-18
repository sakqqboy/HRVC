<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Kgi;
use yii\bootstrap5\ActiveForm;

$this->title = "KGI";
?>
<div class="col-12 mt-70 pt-20 pim-content1">
    <div class="d-flex justify-content-start pt-0 pb-0" style="line-height: 30px;">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Group23177.svg"
            class="pim-head-icon mr-11 mt-2">
        <span class="pim-head-text mr-10"> <?= Yii::t('app', 'Performance Indicator Matrices') ?> (PIM)</span>
        <?php
        if ($role >= 3) {
        ?>
            <a href="<?= Yii::$app->homeUrl ?>kgi/management/create-kgi" class="create-employee-btn mr-11">
                <?= Yii::t('app', 'Create New') ?>
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg" alt="History"
                    class="create-btn-icon ml-3" style="margin-top: -3px;">
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
                    <img class="mr-10" src="<?= Yii::$app->homeUrl ?>images/icons/Settings/company.svg" alt="Company"
                        style="cursor: pointer;"><?= Yii::t('app', 'Company KGI') ?>
                </div>
                <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-team/team-kgi"
                    class="pim-type-tab justify-content-center align-items-center">
                    <img class="mr-10" src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team.svg" alt="Team"
                        style="cursor: pointer;"><?= Yii::t('app', 'Team KGI') ?>
                </a>
                <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/individual-kgi" class="pim-type-tab justify-content-center align-items-center">
                    <img class="mr-10" src="<?= Yii::$app->homeUrl ?>images/icons/Settings/self.svg" alt="Self"
                        style="cursor: pointer;"><?= Yii::t('app', 'Self KGI') ?>
                </a>
                <div class="d-flex flex-grow-1 align-items-center justify-content-end  gap-1">

                    <?= $this->render('filter_list_search', [
                        "companies" => $companies,
                        "months" => $months,
                        "companyId" => isset($companyId) ? $companyId : null,
                        "employeeCompanyId" => $employeeCompanyId,
                        "branchId" => isset($branchId) ? $branchId : null,
                        "teamId" => isset($teamId) ? $teamId : null,
                        "month" => isset($month) ? $month : null,
                        "status" => isset($status) ? $status : null,
                        "branches" =>  isset($branches) ? $branches : null,
                        "teams" =>  isset($teams) ? $teams : null,
                        "yearSelected" => isset($year) ? $year : null,
                        "role" => $role,
                        "page" => "list"
                    ]) ?>
                    <input type="hidden" id="type" value="list">
                    <input type="hidden" id="minPage" value="0">
                </div>
            </div>
            <div class="row" style="--bs-gutter-x:0px;">
                <div class="d-none img-loading text-center" id="img-loading">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Config/loading.gif" class="img-fluid " style="width: 750px;">
                </div>
            </div>
            <div class="col-12 mt-20 pl-10 pr-10 pim-content mb-10" id="main-body">
                <div class="row" style="--bs-gutter-x:0px;">
                    <table class="">
                        <thead>
                            <tr class="pim-table-header">
                                <td class="pl-10" style="width:13%"><?= Yii::t('app', 'KGI Contents') ?></td>
                                <td style="width:10%"><?= Yii::t('app', 'Company Name') ?></td>
                                <td style="width:13%"><?= Yii::t('app', 'Branch') ?></td>
                                <td style="width:5%"><?= Yii::t('app', 'Priority') ?></td>
                                <td style="width:7%"><?= Yii::t('app', 'Employees') ?></td>
                                <td style="width:4%"><?= Yii::t('app', 'Team') ?></td>
                                <td style="width:5%"><?= Yii::t('app', 'QR') ?></td>
                                <td class="text-end" style="width:5%"><?= Yii::t('app', 'Target') ?></td>
                                <td class="text-center" style="width:6%"><?= Yii::t('app', 'Code') ?></td>
                                <td class="text-start" style="width:5%"><?= Yii::t('app', 'Result') ?></td>
                                <td class="text-center" style="width:5%"><?= Yii::t('app', 'Ratio') ?></td>
                                <td class="text-center" style="width:2%"><?= Yii::t('app', 'Month') ?></td>
                                <td class="text-center" style="width:5%"><?= Yii::t('app', 'Unit') ?></td>
                                <td class="text-center">Last</td>
                                <td class="text-center"><?= Yii::t('app', 'Next') ?></td>
                                <td style="width:5%"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($kgis["data"]) && count($kgis["data"]) > 0) {
                                foreach ($kgis["data"] as $kgiId => $kgi) :
                                    if ($kgi["isOver"] == 1 && $kgi["status"] != 2) {
                                        $colorFormat = 'over';
                                    } else {
                                        if ($kgi["status"] == 1) {
                                            $colorFormat = 'inprogress';
                                        } else {
                                            $colorFormat = 'complete';
                                        }
                                    }

                                    if ($role >= 4) {
                                        $display = '';
                                    } else {
                                        $display = 'none';
                                    }
                            ?>
                                    <tr height="10">

                                    </tr>
                                    <tr id="kgi-<?= $kgiId ?>" class="pim-bg-<?= $colorFormat ?> pim-table-text">
                                        <td>
                                            <div class="col-12 border-left-<?= $colorFormat ?> pim-div-border pb-5">
                                                <?= $kgi["kgiName"] ?>
                                            </div>
                                        </td>
                                        <td><?= $kgi["companyName"] ?></td>
                                        <td><img src="<?= Yii::$app->homeUrl . $kgi['flag'] ?>" class="Flag-Turkey">
                                            <?= $kgi["branch"] ?>, <?= $kgi["countryName"] ?></td>
                                        <td class="text-center">
                                            <div
                                                style="width: 24px; height: 24px; flex-shrink: 0; border-radius: 4px; background: #2580D3; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                                                <?= $kgi["priority"] ?>
                                            </div>
                                        </td>
                                        <td class="text-center">

                                            <div class="col-5 number-tagNew  <?= 'load-' . $colorFormat ?> ">
                                                <?= count($kgi["kgiEmployee"]) ?>
                                            </div>
                                        </td>
                                        <td class="text-start">
                                            <div class="col-5 number-tagNew  <?= 'load-' . $colorFormat ?> ">
                                                <?= $kgi["countTeam"] ?>
                                            </div>
                                        </td>
                                        <td><?= $kgi["quantRatio"] == 1 ? Yii::t('app', 'Quantity') : Yii::t('app', 'Quality') ?>
                                        </td>
                                        <td class="text-end">
                                            <?php
                                            $decimal = explode('.', $kgi["targetAmount"]);
                                            if (isset($decimal[1])) {
                                                if ($decimal[1] == '00') {
                                                    $show = $decimal[0];
                                                } else {
                                                    $show = $kgi["targetAmount"];
                                                }
                                            } else {
                                                $show = $kgi["targetAmount"];
                                            }
                                            ?>
                                            <?= $show ?><?= $kgi["amountType"] == 1 ? '%' : '' ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $kgi["code"] ?>
                                        </td>
                                        <td class="text-start">
                                            <?php
                                            if ($kgi["result"] != '') {
                                                $decimalResult = explode('.', $kgi["result"]);
                                                if (isset($decimalResult[1])) {
                                                    if ($decimalResult[1] == '00') {
                                                        $showResult = $decimalResult[0];
                                                    } else {
                                                        $showResult = $kgi["result"];
                                                    }
                                                } else {
                                                    $showResult = $kgi["result"];
                                                }
                                            } else {
                                                $showResult = 0;
                                            }
                                            ?>
                                            <?= $showResult ?><?= $kgi["amountType"] == 1 ? '%' : '' ?>
                                        </td>
                                        <td>
                                            <div id="progress1">
                                                <div data-num="<?= $kgi["ratio"] == '' ? 0 : $kgi["ratio"] ?>"
                                                    class="progress-pim-table progress-circle-<?= $colorFormat ?>"></div>
                                            </div>

                                        </td>
                                        <td><?= $kgi["month"] ?></td>
                                        <td><?= $kgi["unit"] ?></td>
                                        <td><?= $kgi["periodCheck"] ?></td>
                                        <td class="<?= $kgi['isOver'] == 1 ? 'text-danger' : '' ?>">
                                            <?= $kgi["status"] == 1 ? $kgi["nextCheck"] : '' ?>
                                        </td>
                                        <td>
                                            <div class="d-inline-flex">
                                                <a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-history/<?= ModelMaster::encodeParams(['kgiId' => $kgiId]) ?>"
                                                    class="<?= $colorFormat == 'disable' ? 'pim-btn-disable' : 'pim-btn' ?> pr-0 pl-0"
                                                    style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?> width: 25px;display: flex;justify-content: center;justify-self: center;">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" alt="History"
                                                        class="">
                                                </a>
                                                <span class="dropdown" href="#" id="dropdownMenuLink-<?= $kgiId ?>" data-bs-toggle="dropdown">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/3Dot.svg"
                                                        class="icon-table on-cursor">
                                                </span>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink-<?= $kgiId ?>">
                                                    <?php
                                                    if ($colorFormat == "complete") {
                                                        // echo Yii::t('app', "Update");

                                                    } else if ($role >= 5) {
                                                    ?>
                                                        <li class="pl-4 pr-4" style="display: <?= $display ?>;">
                                                            <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                                href="<?= Yii::$app->homeUrl . 'kgi/management/prepare-update/' . ModelMaster::encodeParams(['kgiId' => $kgiId, 'kgiHistoryId' => 0]) ?>"
                                                                class="btn btn-bg-white-xs mr-5">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/editblack.svg"
                                                                    alt="History" alt="Chart" class="pim-action-icon mr-5">
                                                                <?= Yii::t('app', 'Update') ?>
                                                            </a>
                                                        </li>
                                                    <?php
                                                    }
                                                    ?>
                                                    <li class="pl-4 pr-4" data-bs-toggle="modal">
                                                        <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                            href="<?= Yii::$app->homeUrl ?>kgi/view/index/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, 'openTab' => 2]) ?>"
                                                            style="<?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>"
                                                            class="btn btn-bg-white-xs">
                                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/history.svg"
                                                                alt="History" alt="Chart" class="pim-action-icon mr-5">
                                                            <?= Yii::t('app', 'History') ?>
                                                        </a>
                                                    </li>
                                                    <li class="pl-4 pr-4" data-bs-toggle="modal">
                                                        <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                            href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-history/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, 'openTab' => 3]) ?>"
                                                            style="<?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>"
                                                            class="btn btn-bg-white-xs">
                                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg"
                                                                alt="Chart" class="pim-action-icon mr-5">
                                                            <?= Yii::t('app', 'Chats') ?>
                                                        </a>
                                                    </li>
                                                    <li class="pl-4 pr-4" data-bs-toggle="modal">
                                                        <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                            href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-history/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, 'openTab' => 4]) ?>"
                                                            style="<?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>"
                                                            class="btn btn-bg-white-xs">
                                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/chart.svg"
                                                                alt="Chart" class="pim-action-icon mr-5">
                                                            <?= Yii::t('app', 'Chart') ?>
                                                        </a>
                                                    </li>
                                                    <?php
                                                    if ($role >= 5) {
                                                    ?>
                                                        <li class="pl-4 pr-4" data-bs-toggle="modal">
                                                            <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                                href="<?= Yii::$app->homeUrl ?>kgi/assign/assign/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, "companyId" => $kgi["companyId"]]) ?>"
                                                                style="<?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>"
                                                                class="btn btn-bg-white-xs">
                                                                <i class="fa fa-users ppim-action-icon mr-5" aria-hidden="true" alt="Chart"
                                                                    s></i>
                                                                <?= Yii::t('app', 'Team') ?>
                                                            </a>
                                                        </li>
                                                        <li class="pl-4 pr-4" data-bs-toggle="modal">
                                                            <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                                href="<?= Yii::$app->homeUrl ?>kgi/assign/assign/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, "companyId" => $kgi["companyId"], "save" => 0]) ?>"
                                                                style="<?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>"
                                                                class="btn btn-bg-white-xs">
                                                                <i class="fa fa-user pim-action-icon mr-5" aria-hidden="true" alt="Chart"></i>
                                                                <?= Yii::t('app', 'Person') ?>
                                                            </a>
                                                        </li>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($role >= 5) {
                                                    ?>
                                                        <li class="pl-4 pr-4" data-bs-toggle="modal" data-bs-target="#delete-kgi"
                                                            onclick="javascript:prepareDeleteKgi(<?= $kgiId ?>)" title="Delete">
                                                            <a class="dropdown-itemNEW pl-4 pr-25" href="#">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/delete.svg"
                                                                    alt="Delete" class="pim-action-icon mr-5">
                                                                <?= Yii::t('app', 'Delete') ?>
                                                            </a>
                                                        </li>
                                                    <?php
                                                    }
                                                    ?>

                                                </ul>
                                            </div>
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
                'totalKgi' => $totalKgi,
                "currentPage" => $currentPage,
                'totalPage' => $totalPage,
                "pagination" => $pagination,
                "pageType" => "list",
                "filter" => isset($filter) ? $filter : []
            ]);
            ?>
        </div>
        <input type="hidden" value="create" id="acType">
        <?php
        $form = ActiveForm::begin([
            'id' => 'create-kgi',
            'method' => 'post',
            'options' => [
                'enctype' => 'multipart/form-data',
            ],
            'action' => Yii::$app->homeUrl . 'kgi/management/create-kgi'

        ]); ?>
        <?= $this->render('modal_create', [
            "units" => $units,
            "companies" => $companies,
            "months" => $months
        ]) ?>
        <?php ActiveForm::end(); ?>

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
        <?= $this->render('modal_view') ?>

    </div>
</div>
<?= $this->render('modal_delete') ?>
<?= $this->render('modal_issue') ?>
<?= $this->render('modal_team_history') ?>
<?= $this->render('modal_employee_history') ?>
<?= $this->render('modal_kfi') ?>
<style>
    .bg-white-employee {
        min-height: calc(100vh - 200px);
    }
</style>