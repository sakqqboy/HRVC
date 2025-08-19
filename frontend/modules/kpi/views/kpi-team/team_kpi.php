<?php

use frontend\models\hrvc\KpiTeam;
use yii\bootstrap5\ActiveForm;
use common\models\ModelMaster;

$this->title = "Team KPI";
?>

<div class="col-12 mt-70 pt-20 pim-content1">
    <div class="d-flex justify-content-start pt-0 pb-0" style="line-height: 30px;">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Group23177.svg"
            class="pim-head-icon mr-11 mt-2">
        <span class="pim-head-text mr-10"> <?= Yii::t('app', 'Team Key Performance Indicators') ?> </span>
        <?php
        if ($role > 3) {

        ?>
        <div class="d-flex <?= $waitForApprove["totalRequest"] > 0 ? 'approval-box' : 'noapproval-box' ?> text-center">
            <?php
                if ($waitForApprove["totalRequest"] > 0) {
                ?>
            <a href="<?= Yii::$app->homeUrl ?>kpi/management/wait-approve" class="d-flex align-items-center"
                style="text-decoration: none; color:#000000;">
                <span class="approvals-num mr-3"><?= $waitForApprove["totalRequest"] ?></span>
                <?= Yii::t('app', 'Approvals') ?>
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/approvals.svg" style="width: 16px;height:16px;"
                    class="ml-3">
            </a>
            <?php
                } else { ?>
            <a style=" text-decoration: none;color:#2D7F06;" class="d-flex align-items-center">
                <span class="noapprovals-num mr-3"><?= $waitForApprove["totalRequest"] ?></span>
                <?= Yii::t('app', 'No Approvals') ?>
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/check.svg" style="width: 16px;height:16px;"
                    class="ml-3">
            </a>
            <?php
                }

                ?>
        </div>
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
                <a href="<?= Yii::$app->homeUrl ?>kpi/management/index"
                    class="pim-type-tab rounded-top-left justify-content-center align-items-center">
                    <img class="mr-10" src="<?= Yii::$app->homeUrl ?>images/icons/Settings/company.svg" alt="Company"
                        style="cursor: pointer;">
                    <?= Yii::t('app', 'Company KPI') ?>
                </a>
                <a class="pim-type-tab-selected justify-content-center align-items-center">
                    <img class="mr-10" src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team.svg"
                        alt="Team"><?= Yii::t('app', 'Team KPI') ?>
                </a>
                <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/individual-kpi"
                    class="pim-type-tab justify-content-center align-items-center">
                    <img class="mr-10" src="<?= Yii::$app->homeUrl ?>images/icons/Settings/self.svg" alt="Self"
                        style="cursor: pointer;">
                    <?= Yii::t('app', 'Self KPI') ?>
                </a>
                <div class="d-flex flex-grow-1 align-items-center justify-content-end  gap-1">
                    <?= $this->render('filter_list', [
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
                        "yearSelected" => isset($yearSelected) ? $branchId : null,
                        "role" => $role,
                        "page" => "list"

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
                                <td class="text-center"><?= Yii::t('app', 'Last') ?></td>
                                <td class="text-center"><?= Yii::t('app', 'Next') ?></td>
                                <td style="width:5%"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($teamKpis["data"]) && count($teamKpis["data"]) > 0) {
                                foreach ($teamKpis["data"] as $kpiTeamId => $kpi) :
                                    $show = KpiTeam::checkPermission($role, $kpiTeamId, $userId);

                                    if ($show == 1) {
                                        $display = '';
                                    } else {
                                        $display = 'none';
                                    }

                                    $canEdit = 0;
                                    if ($role > 3) {
                                        $canEdit = 1;
                                    } else {
                                        if ($role == 3 && ($kpi["teamId"] == $userTeamId)) {
                                            $canEdit = 1;
                                        }
                                    }

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
                            <tr id="kpi-<?= $kpiTeamId ?>" class="pim-bg-<?= $colorFormat ?> pim-table-text">
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
                                        <?= $kpi["countTeamEmployee"] ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-5 number-tagNew  <?= 'load-' . $colorFormat ?> ">
                                        <?= $kpi["countTeam"] ?>
                                    </div>
                                </td>
                                <td><?= $kpi["quantRatio"] == 1 ? Yii::t('app', 'Quantity') : Yii::t('app', 'Quality') ?>
                                </td>
                                <td class="text-end">
                                    <?php
                                            if ($kpi["result"] != '') {
                                                $decimal = explode('.', $kpi["target"]);
                                                if (isset($decimal[1])) {
                                                    if ($decimal[1] == '00') {
                                                        $show = $decimal[0];
                                                    } else {
                                                        $show = $kpi["target"];
                                                    }
                                                } else {
                                                    $show = $kpi["target"];
                                                }
                                            } else {
                                                $showResult = 0;
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
                                    <?= $kpi["status"] == 1 ? $kpi["nextCheckDate"] : '' ?>
                                </td>
                                <td>
                                    <div class="d-inline-flex">
                                        <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-team/kpi-team-history/<?= ModelMaster::encodeParams(['kpiTeamId' => $kpiTeamId, 'kpiTeamHistoryId' => 0, 'kpiId' => $kpi["kpiId"], 'openTab' => 1]) ?>"
                                            class="<?= $colorFormat == 'disable' ? 'pim-btn-disable' : 'pim-btn' ?> pr-0 pl-0 align-content-center"
                                            style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?> width: 25px;display: flex;justify-content: center;">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg"
                                                alt="History" class="">
                                        </a>
                                        <span class="dropdown mt-2" href="#" id="dropdownMenuLink-<?= $kpi['isOver'] ?>"
                                            data-bs-toggle="dropdown">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/3Dot.svg"
                                                class="icon-table on-cursor">
                                        </span>

                                        <ul class="dropdown-menu"
                                            aria-labelledby="dropdownMenuLink-<?= $kpi['isOver'] ?>">
                                            <?php
                                                    if ($colorFormat == "complete") {
                                                        // echo Yii::t('app', "Update");
                                                    } else if ($canEdit == 1) {
                                                    ?>
                                            <li class="pl-4 pr-4">
                                                <a class=" dropdown-itemNEWS pl-4 pr-20 mb-5"
                                                    href="<?= Yii::$app->homeUrl ?>kpi/kpi-team/prepare-update/<?= ModelMaster::encodeParams(['kpiTeamId' => $kpiTeamId, 'kpiHistoryId' => 0]) ?>">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/editblack.svg"
                                                        alt="edit" class="pim-action-icon mr-5">
                                                    <?= Yii::t('app', 'Edit') ?>
                                                </a>
                                            </li>
                                            <?php
                                                    }
                                                    ?>

                                            <li class="pl-4 pr-4">
                                                <a class="dropdown-itemNEWS pl-4 pr-20 mb-5"
                                                    style="<?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>"
                                                    href="<?= Yii::$app->homeUrl ?>kpi/view/kpi-team-history/<?= ModelMaster::encodeParams(['kpiId' => $kpi['kpiId'], "kpiTeamId" => $kpiTeamId, "teamId" => $kpi['teamId']]) ?>">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/history.svg"
                                                        alt="Chats" class="pim-action-icon mr-5">
                                                    <?= Yii::t('app', 'History') ?>
                                                </a>
                                            </li>
                                            <li class="pl-4 pr-4">
                                                <a class="dropdown-itemNEWS pl-4 pr-20 mb-5"
                                                    style="<?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>"
                                                    href="<?= Yii::$app->homeUrl ?>kpi/kpi-team/kpi-team-history/<?= ModelMaster::encodeParams(['kpiTeamId' => $kpiTeamId, 'kpiTeamHistoryId' => 0, 'kpiId' => $kpi["kpiId"], 'openTab' => 3]) ?>">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg"
                                                        alt="Chats" class="pim-action-icon mr-5">
                                                    <?= Yii::t('app', 'Chats') ?>
                                                </a>
                                            </li>
                                            <li class="pl-4 pr-4">
                                                <a class="dropdown-itemNEWS pl-4 pr-20"
                                                    style="<?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>"
                                                    href="<?= Yii::$app->homeUrl ?>kpi/kpi-team/kpi-team-history/<?= ModelMaster::encodeParams(['kpiTeamId' => $kpiTeamId, 'kpiTeamHistoryId' => 0, 'kpiId' => $kpi["kpiId"], 'openTab' => 4]) ?>">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/chart.svg"
                                                        alt="Chats" class="pim-action-icon mr-5">
                                                    <?= Yii::t('app', 'Chart') ?>
                                                </a>
                                            </li>

                                            <?php
                                                    if ($role >= 5) {
                                                    ?>
                                            <li class="pl-4 pr-4 mt-5" data-bs-toggle="modal"
                                                data-bs-target="#delete-kpi-team"
                                                onclick="javascript:prepareDeleteKpiTeam(<?= $kpiTeamId ?>)"
                                                title="Delete">
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
                'totalKpi' => $totalKpi,
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
<?php
$form = ActiveForm::begin([
    'id' => 'update-kpi',
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
    'action' => Yii::$app->homeUrl . 'kpi/kpi-team/update-kpi-team'

]); ?>
<?= $this->render('modal_update', [
    "units" => $units,
    "isManager" => $isManager,
    "months" => $months,
]) ?>
<?php ActiveForm::end(); ?>
<?= $this->render('modal_view', [
    "isManager" => $isManager
]) ?>
<?= $this->render('modal_issue') ?>

<?= $this->render('modal_delete') ?>
<style>
.bg-white-employee {
    min-height: calc(100vh - 200px);
}
</style>