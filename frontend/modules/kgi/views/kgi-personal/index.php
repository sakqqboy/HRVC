<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Kgi;
use frontend\models\hrvc\KgiEmployee;
use yii\bootstrap5\ActiveForm;

$this->title = "Individual KGI";
?>
<div class="col-12 mt-70 pt-20 pim-content1">
    <div class="d-flex justify-content-start align-items-center  pt-0 pb-0" style="line-height: 30px;">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Group23177.svg"
            class="pim-head-icon mr-11 mt-2">
        <span class="pim-head-text mr-10"><?= Yii::t('app', 'Individual Key Goal Indicators') ?></strong></span>
        <?php
        if ($role >= 3) {

        ?>
            <div class="d-flex <?= $waitForApprove["totalRequest"] > 0 ? 'approval-box' : 'noapproval-box' ?> text-center">
                <?php
                if ($waitForApprove["totalRequest"] > 0) {
                ?>
                    <a href="<?= Yii::$app->homeUrl ?>kgi/management/wait-approve-kgi-personal"
                        class="d-flex align-items-center" style="text-decoration: none; color:#000000;">
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
                <a href="<?= Yii::$app->homeUrl ?>kgi/management/index"
                    class="pim-type-tab rounded-top-left justify-content-center align-items-center">
                    <img class="mr-10" src="<?= Yii::$app->homeUrl ?>images/icons/Settings/company.svg" alt="Company"
                        style="cursor: pointer;"><?= Yii::t('app', 'Company KGI') ?>
                </a>
                <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-team/team-kgi"
                    class="pim-type-tab justify-content-center align-items-center">
                    <img class="mr-10" src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team.svg" alt="Team"
                        style="cursor: pointer;"><?= Yii::t('app', 'Team KGI') ?>
                </a>
                <a class="pim-type-tab-selected justify-content-center align-items-center">
                    <img class="mr-10" src="<?= Yii::$app->homeUrl ?>images/icons/Settings/self.svg" alt="Self">
                    <?= Yii::t('app', 'Self KGI') ?>
                </a>
                <div class="d-flex flex-grow-1 align-items-center justify-content-end  gap-1">
                    <?= $this->render('filter_list', [
                        "companies" => $companies,
                        "months" => $months,
                        "month" => $month,
                        "status" => $status,
                        "year" => $year,
                        "role" => $role,
                        "companyId" => $companyId,
                        "branchId" => $branchId,
                        "teamId" => $teamId,
                        "role" => $role,
                        "teams" => $teams,
                        "teamId" => isset($teamId) ? $teamId : '',
                        "employeeId" => isset($employeeId) ? $employeeId : '',
                        "employees" => isset($employees) ? $employees : [],
                        "page" => 'list'


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
            <div class="col-12 mt-20 pl-10 pr-10 pim-content mb-10" id="main-body" style="z-index: 1;">
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
                            <td class="text-center"><?= Yii::t('app', 'Last') ?></td>
                            <td class="text-center"><?= Yii::t('app', 'Next') ?></td>
                            <td style="width:5%"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($kgis["data"]) && count($kgis["data"]) > 0) {
                            foreach ($kgis["data"] as $kgiEmployeeId => $kgi) :
                                $canEdit = KgiEmployee::canEdit($role, $kgiEmployeeId);
                                if ($kgi["isOver"] == 1 && $kgi["status"] != 2) {
                                    $colorFormat = 'over';
                                } else {
                                    if ($kgi["status"] == 1) {
                                        if ($kgi["isOver"] == 2) {
                                            $colorFormat = 'disable';
                                        } else {
                                            $colorFormat = 'inprogress';
                                        }
                                    } else {
                                        if ($kgi["status"] == 2) {
                                            $colorFormat = 'complete';
                                        } else {
                                            $colorFormat = 'inprogress';
                                        }
                                    }
                                }

                        ?>
                                <tr height="10">

                                </tr>
                                <tr id="kgi-<?= $kgiEmployeeId ?>" class="pim-bg-<?= $colorFormat ?> pim-table-text">
                                    <td>
                                        <div class="col-12 border-left-<?= $colorFormat ?> pim-div-border pb-5">
                                            <?= $kgi["kgiName"] ?>
                                        </div>
                                    </td>
                                    <td><?= $kgi["companyName"] ?></td>
                                    <td>
                                        <img src="<?= Yii::$app->homeUrl . $kgi['flag'] ?>" class="Flag-Turkey">
                                        <?= $kgi["branch"] ?>, <?= Yii::t('app', $kgi["countryName"]) ?>
                                    </td>
                                    <td>
                                        <div style="width: 24px; height: 24px; flex-shrink: 0; border-radius: 4px; background: #2580D3; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                                            <?= $kgi["priority"] ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-5 number-tagNew  <?= 'load-' . $colorFormat ?> ">
                                            <?= $kgi["countTeamEmployee"] ?>
                                        </div>
                                    </td>
                                    </td>
                                    <td>
                                        <div class="col-5 number-tagNew  <?= 'load-' . $colorFormat ?> ">
                                            <?= $kgi["countTeam"] ?>
                                        </div>
                                    </td>
                                    <td>
                                        <?= $kgi["quantRatio"] == 1 ? Yii::t('app', 'Quantity') : Yii::t('app', 'Quality') ?>
                                    </td>
                                    <td class="text-end">
                                        <?php
                                        $targetAmount = $kgi["targetAmount"] ?? ''; // Ensure targetAmount is not null

                                        if ($targetAmount === '') {
                                            $show = '0.00';
                                        } else {
                                            $decimal = explode('.', $targetAmount);
                                            if (isset($decimal[1])) {
                                                $show = ($decimal[1] == '00') ? $decimal[0] : $targetAmount;
                                            } else {
                                                $show = $targetAmount;
                                            }
                                        }
                                        ?>
                                        <?= $show ?>
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
                                        <?= $showResult ?>
                                    </td>
                                    <td>
                                        <div id="progress1">
                                                <?php
                                                 if($showResult != 0){
                                                ?>
                                                <div data-num="<?= $kgi["ratio"] == '' ? 0 : $kgi["ratio"] ?>"
                                                class="progress-pim-table progress-circle-<?= $colorFormat ?>">
                                                </div>
                                                <?php
                                                 } else {
                                                ?>
                                                <div data-num="<?= $showResult ?>"  data-value="<?= $showResult ?>%" 
                                                    class="progress-pim-table progress-circle-<?= $colorFormat ?>"><?= $showResult ?>%</div>
                                                <?php
                                                 }
                                                ?>
                                        </div>
                                    </td>
                                    <td><?= Yii::t('app', $kgi["month"]) ?></td>
                                    <td><?= Yii::t('app', $kgi["unit"]) ?></td>
                                    <td><?= $kgi["periodCheck"] ?></td>
                                    <td class="<?= $kgi['isOver'] == 1 ? 'text-danger' : '' ?>">
                                        <?= $kgi["status"] == 1 ? $kgi["nextCheck"] : '' ?>
                                    </td>
                                    <td>
                                        <div class="d-inline-flex">
                                            <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/kgi-employee-history/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId, 'kgiEmployeeHistoryId' => 0, 'kgiId' => $kgi['kgiId'], 'openTab' => 1]) ?>"
                                                class="<?= $colorFormat == 'disable' ? 'pim-btn-disable' : 'pim-btn' ?> pr-0 pl-0"
                                                style=" <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?> width: 25px;display: flex;justify-content: center;justify-self: center;">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" alt="History"
                                                    class="">
                                            </a>
                                            <span class="dropdown mt-2" href="#" id="dropdownMenuLink-<?= $kgiEmployeeId ?>" data-bs-toggle="dropdown">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/3Dot.svg"
                                                    class="icon-table on-cursor">
                                            </span>

                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink-<?= $kgiEmployeeId ?>" style="z-index:99;">
                                                <?php
                                                if ($colorFormat == "complete") {
                                                    // echo Yii::t('app', "Update");

                                                } else if ($canEdit == 1) {
                                                ?>
                                                    <li class="pl-4 pr-4">
                                                        <a class="dropdown-itemNEWS pl-4 pr-20 mb-5"
                                                            href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/update-personal-kgi/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId]) ?>">
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
                                                        href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-individual-history/<?= ModelMaster::encodeParams(['kgiId' => $kgi['kgiId'], "kgiEmployeeId" => $kgiEmployeeId]) ?>">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/history.svg"
                                                            alt="Chats" class="pim-action-icon mr-5">
                                                        <?= Yii::t('app', 'History') ?>
                                                    </a>
                                                </li>
                                                <li class="pl-4 pr-4">
                                                    <a class="dropdown-itemNEWS pl-4 pr-20 mb-5"
                                                        style="<?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>"
                                                        href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/kgi-employee-history/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId, 'kgiEmployeeHistoryId' => 0, 'kgiId' => $kgi['kgiId'], 'openTab' => 3]) ?>">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg"
                                                            alt="Chats" class="pim-action-icon mr-5">
                                                        <?= Yii::t('app', 'Chats') ?>
                                                    </a>
                                                </li>
                                                <li class="pl-4 pr-4">
                                                    <a class="dropdown-itemNEWS pl-4 pr-20"
                                                        style="<?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>"
                                                        href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/kgi-employee-history/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId, 'kgiEmployeeHistoryId' => 0, 'kgiId' => $kgi['kgiId'], 'openTab' => 4]) ?>">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/pim/chart.svg"
                                                            alt="Chats" class="pim-action-icon mr-5">
                                                        <?= Yii::t('app', 'Chart') ?>
                                                    </a>
                                                </li>
                                                <?php
                                                if ($role >= 5) {
                                                ?>
                                                    <li class="pl-4 pr-4 mt-5" data-bs-toggle="modal"
                                                        data-bs-target="#delete-kgi-employee"
                                                        onclick="javascript:prepareDeleteKgiEmployee(<?= $kgiEmployeeId ?>)"
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
            <?php
            echo $this->render('pagination_page', [
                'totalKgi' => $totalKgi,
                "currentPage" => $currentPage,
                'totalPage' => $totalPage,
                "pagination" => $pagination,
                "pageType" => "grid",
                "filter" => isset($filter) ? $filter : []
            ]);
            ?>
            <input type="hidden" id="totalPage" value="<?= $totalPage > 1 ? 1 : 0 ?>">
        </div>
    </div>
</div>

<?= $this->render('modal_delete') ?>
<?= $this->render('modal_issue') ?>
<style>
    .bg-white-employee {
        min-height: calc(100vh - 200px);
    }
</style>