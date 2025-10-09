<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Kpi;
use yii\bootstrap5\ActiveForm;

$this->title = 'Company KPI';
?>
<div class="col-12 mt-70 pt-20 pim-content1">
    <div class="d-flex justify-content-start pt-0 pb-0" style="line-height: 30px;">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Group23177.svg"
            class="pim-head-icon mr-11 mt-2">
        <span class="pim-head-text mr-10"> <?= Yii::t('app', 'Performance Indicator Matrices') ?> (PIM)</span>
        <?php
        if ($role > 3) {
        ?>
            <a href="<?= Yii::$app->homeUrl ?>kpi/management/create-kpi" class="create-employee-btn mr-11">
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
        "totalBranch" => $totalBranch,
        "page" => 'list'
    ]) ?>
    <div class="col-12 mt-20" id="box-wrapper">
        <div class="bg-white-employee" id="pim-content">
            <div class="d-flex pl-10 pr-10 justify-content-left align-content-center mt-5">
                <div class="pim-type-tab-selected rounded-top-left justify-content-center align-items-center">
                    <img class="mr-10" src="<?= Yii::$app->homeUrl ?>images/icons/Settings/company.svg" alt="Company">
                    <?= Yii::t('app', 'Company KPI') ?>
                </div>
                <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-team/team-kpi"
                    class="pim-type-tab justify-content-center align-items-center">
                    <img class="mr-10" src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team.svg" alt="Team"
                        style="cursor: pointer;"><?= Yii::t('app', 'Team KPI') ?>
                </a>
                <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/individual-kpi"
                    class="pim-type-tab justify-content-center align-items-center">
                    <img class="mr-10" src="<?= Yii::$app->homeUrl ?>images/icons/Settings/self.svg" alt="Self"
                        style="cursor: pointer;"><?= Yii::t('app', 'Self KPI') ?>
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
                        "yearSelected" => isset($branchId) ? $branchId : null,
                        "role" => $role,
                        "page" => "index"
                    ]) ?>
                    <input type="hidden" id="type" value="list">
                    <input type="hidden" id="minPage" value="0">
                </div>
            </div>
            <div class="row" style="--bs-gutter-x:0px;">
                <div class="d-none img-loading text-center" id="img-loading">
                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Config/loading.gif" class="img-fluid "
                        style="width: 750px;">
                </div>
            </div>
            <div class="col-12 mt-20 pl-10 pr-10 pim-content mb-10" id="main-body">
                <div class="row" style="--bs-gutter-x:0px;">
                    <table class="">
                        <thead>
                            <tr class="pim-table-header">
                                <td class="pl-10" style="width:13%"><?= Yii::t('app', 'KPI Contents') ?></td>
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
                            if (isset($kpis["data"]) && count($kpis["data"]) > 0) {
                                foreach ($kpis["data"] as $kpiId => $kpi) :

                                    if ($kpi["isOver"] == 1 && $kpi["status"] != 2) {
                                        $colorFormat = 'over';
                                    } else {
                                        if ($kpi["status"] == 1) {
                                            if ($kpi["isOver"] == 2) {
                                                $colorFormat = 'disable';
                                            } else {
                                                $colorFormat = 'inprogress';
                                            }
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
                                    <tr id="kpi-<?= $kpiId ?>" class="pim-bg-<?= $colorFormat ?> pim-table-text">
                                        <td>
                                            <div class="col-12 border-left-<?= $colorFormat ?> pim-div-border pb-5">
                                                <?= $kpi["kpiName"] ?>
                                            </div>
                                        </td>
                                        <td><?= $kpi["companyName"] ?></td>
                                        <td><img src="<?= Yii::$app->homeUrl . $kpi['flag'] ?>" class="Flag-Turkey">
                                            <?= $kpi["branch"] ?>, <?= $kpi["countryName"] ?></td>
                                        <td class="text-center">
                                            <div
                                                style="width: 24px; height: 24px; flex-shrink: 0; border-radius: 4px; background: #2580D3; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                                                <?= $kpi["priority"] ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-5 number-tagNew  <?= 'load-' . $colorFormat ?> ">
                                                <?= count($kpi["kpiEmployee"]) ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-5 number-tagNew  <?= 'load-' . $colorFormat ?> ">
                                                <?= $kpi["countTeam"] ?>
                                            </div>
                                        </td>
                                        <td><?= $kpi["quantRatio"] == 1 ? 'Quantity' : 'Quality' ?></td>
                                        <td class="text-end">
                                            <?php
                                            $decimal = explode('.', $kpi["targetAmount"]);
                                            if (isset($decimal[1])) {
                                                if ($decimal[1] == '00') {
                                                    $show = $decimal[0];
                                                } else {
                                                    $show = $kpi["targetAmount"];
                                                }
                                            } else {
                                                $show = $kpi["targetAmount"];
                                            }
                                            ?>
                                            <?= $show ?><?= $kpi["amountType"] == 1 ? '%' : '' ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $kpi["code"] ?>
                                        </td>
                                        <td class="text-start">
                                            <?php
                                            if ($kpi["result"] != '') {
                                                $decimalResult = explode('.', $kpi["result"]);
                                                if (isset($decimalResult[1])) {
                                                    if ($decimalResult[1] == '00') {
                                                        $showResult = $decimalResult[0];
                                                    } else {
                                                        $showResult = $kpi["result"];
                                                    }
                                                } else {
                                                    $showResult = $kpi["result"];
                                                }
                                            } else {
                                                $showResult = 0;
                                            }
                                            ?>
                                            <?= $showResult ?><?= $kpi["amountType"] == 1 ? '%' : '' ?>
                                        </td>
                                        <td>
                                            <?php
                                            $percent = explode('.', $kpi['ratio']);
                                            if (isset($percent[0]) && $percent[0] == '0') {
                                                if (isset($percent[1])) {
                                                    if ($percent[1] == '00') {
                                                        $showPercent = 0;
                                                    } else {
                                                        $showPercent = round($kpi['ratio'], 1);
                                                    }
                                                }
                                            } else {
                                                $showPercent = round(floatval($kpi['ratio']));
                                            }
                                            ?>
                                            <div id="progress1">
                                                <div data-num="<?= $showPercent ?>"
                                                    class="progress-pim-table progress-circle-<?= $colorFormat ?>"></div>
                                            </div>

                                        </td>
                                        <td><?= Yii::t('app', $kpi["month"]) ?></td>
                                        <td><?= Yii::t('app', $kpi["unit"]) ?></td>
                                        <td><?= $kpi["periodCheck"] ?></td>
                                        <td class="<?= $kpi['isOver'] == 1 ? 'text-danger' : '' ?>">
                                            <?= $kpi["status"] == 1 ? $kpi["nextCheck"] : '' ?>
                                        </td>
                                        <td>
                                            <div class="d-inline-flex">
                                                <a href="<?= Yii::$app->homeUrl ?>kpi/view/kpi-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId]) ?>"
                                                    class="<?= $colorFormat == 'disable' ? 'pim-btn-disable' : 'pim-btn' ?> pr-0 pl-0"
                                                    style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?> width: 25px;display: flex;justify-content: center;justify-self: center;">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" alt="History">
                                                </a>

                                                <span class="dropdown mt-2" href="#" id="dropdownMenuLink-<?= $kpiId ?>"
                                                    data-bs-toggle="dropdown">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/3Dot.svg"
                                                        class="icon-table on-cursor">
                                                </span>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink-<?= $kpiId ?>">
                                                    <?php
                                                    if ($colorFormat == "complete") {
                                                        // echo Yii::t('app', "Update");
                                                    } else if ($role >= 5) {
                                                    ?>
                                                        <li class="pl-4 pr-4" style="display: <?= $display ?>;">
                                                            <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                                href="<?= Yii::$app->homeUrl ?>kpi/management/prepare-update/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'kpiHistoryId' => 0]) ?>"
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
                                                            href="<?= Yii::$app->homeUrl ?>kpi/view/index/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'openTab' => 2]) ?>"
                                                            style="<?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>"
                                                            class="btn btn-bg-white-xs">
                                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/history.svg"
                                                                alt="History" alt="Chart" class="pim-action-icon mr-5">
                                                            <?= Yii::t('app', 'History') ?>
                                                        </a>
                                                    </li>
                                                    <li class="pl-4 pr-4" data-bs-toggle="modal">
                                                        <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                            href="<?= Yii::$app->homeUrl ?>kpi/view/kpi-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'openTab' => 3]) ?>"
                                                            style="<?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>"
                                                            class="btn btn-bg-white-xs">
                                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg"
                                                                alt="Chart" class="pim-action-icon mr-5">
                                                            <?= Yii::t('app', 'Chats') ?>
                                                        </a>
                                                    </li>
                                                    <li class="pl-4 pr-4" data-bs-toggle="modal">
                                                        <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                            href="<?= Yii::$app->homeUrl ?>kpi/view/kpi-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'openTab' => 4]) ?>"
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
                                                                href="<?= Yii::$app->homeUrl ?>kpi/assign/assign/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, "companyId" => $kpi["companyId"]]) ?>"
                                                                style="<?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>"
                                                                class="btn btn-bg-white-xs">
                                                                <i class="fa fa-users ppim-action-icon mr-5" aria-hidden="true" alt="Chart"
                                                                    s></i>
                                                                <?= Yii::t('app', 'Team') ?>
                                                            </a>
                                                        </li>
                                                        <li class="pl-4 pr-4" data-bs-toggle="modal">
                                                            <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                                href="<?= Yii::$app->homeUrl ?>kpi/assign/assign/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, "companyId" => $kpi["companyId"]]) ?>"
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
                                                        <li class="pl-4 pr-4" data-bs-toggle="modal" data-bs-target="#delete-kpi"
                                                            onclick="javascript:prepareDeleteKpi(<?= $kpiId ?>)" title="Delete">
                                                            <a class="dropdown-itemNEW pl-4 pr-25" href="#">
                                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/delete.svg"
                                                                    alt="Delete" class="pim-action-icon mr-5" style="margin-top: -2px;">
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
        </div>
        <!-- <div class="col-12 navigation-next">
			<nav aria-label="Page navigation example">
				<ul class="pagination">
					<li class="page-item"><a class="page-link page-navigation" href="#"><i class="fa fa-chevron-left" aria-hidden="true"></i> Previous</a></li>
					<li class="page-item"><a class="page-link page-navigation" href="#">1</a></li>
					<li class="page-item"><a class="page-link page-navigation" href="#">2</a></li>
					<li class="page-item"><a class="page-link page-navigation" href="#">3</a></li>
					<li class="page-item"><a class="page-link page-navigation" href="#">Next <i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
				</ul>
			</nav>
		</div> -->
    </div>

    <input type="hidden" value="create" id="acType">
    <?php
    $form = ActiveForm::begin([
        'id' => 'create-kpi',
        'method' => 'post',
        'options' => [
            'enctype' => 'multipart/form-data',
        ],
        'action' => Yii::$app->homeUrl . 'kpi/management/create-kpi'

    ]); ?>
    <?= $this->render('modal_create', [
        "units" => $units,
        "companies" => $companies,
        "months" => $months
    ]) ?>
    <?php ActiveForm::end(); ?>
    <?php
    $form = ActiveForm::begin([
        'id' => 'update-kpi',
        'method' => 'post',
        'options' => [
            'enctype' => 'multipart/form-data',
        ],
        'action' => Yii::$app->homeUrl . 'kpi/management/update-kpi'

    ]); ?>
    <?= $this->render('modal_update', [
        "units" => $units,
        "companies" => $companies,
        "months" => $months,
        "isManager" => $isManager
    ]) ?>
    <?php ActiveForm::end(); ?>
    <?= $this->render('modal_view') ?>
    <?= $this->render('modal_issue') ?>
    <?= $this->render('modal_team_history') ?>
    <?= $this->render('modal_employee_history') ?>
    <?= $this->render('modal_kgi') ?>
</div>
<?= $this->render('modal_delete') ?>
<style>
    .bg-white-employee {
        min-height: calc(100vh - 200px);
    }
</style>