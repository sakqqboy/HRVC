<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Kpi;
use frontend\models\hrvc\KpiEmployee;
use yii\bootstrap5\ActiveForm;

$this->title = "Individual KPI";
?>
<div class="col-12">
    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.svg" class="home-icon mr-5"
            style="margin-top: -3px;">
        <strong class="pim-head-text"> Individual Key Performance Indicator</strong>
    </div>
    <div class="col-12 mt-10">
        <?= $this->render('header_filter', [
            "role" => $role
        ]) ?>
        <div class="alert mt-10 pim-body bg-white">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12  pr-0 pt-1">
                    <div class="row">
                        <div class="col-8">
                            <div class="row">
                                <div class="col-4 pim-type-tab pr-0 pl-0 rounded-top-left">
                                    <a href="<?= Yii::$app->homeUrl ?>kpi/management/index" class="no-underline-black ">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/company.svg"
                                            alt="Company" class="pim-icon"
                                            style="width: 14px;height: 14px;padding-bottom: 4px;">
                                        Company KPI
                                    </a>
                                </div>
                                <div class="col-4 pim-type-tab pr-0 pl-0">
                                    <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-team/team-kpi"
                                        class="no-underline-black ">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team.svg" alt="Team"
                                            class="pim-icon" style="width: 13px;height: 13px;padding-bottom: 2px;">
                                        Team KPI
                                    </a>
                                </div>
                                <div class="col-4 pim-type-tab-selected pr-0 pl-0 rounded-top-right">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/self.svg" alt="Self"
                                        class="pim-icon" style="width: 13px;height: 13px;padding-bottom: 3px;">
                                    Self KPI
                                </div>
                            </div>
                        </div>
                        <div class="col-4 pl-4">
                            <?php
                            if ($role > 3) {
                            ?>
                            <div
                                class="col-12 <?= $waitForApprove["totalRequest"] > 0 ? 'approval-box' : 'noapproval-box' ?> text-center pr-3">

                                <?php
                                    if ($waitForApprove["totalRequest"] > 0) {
                                    ?>
                                <a href="<?= Yii::$app->homeUrl ?>kgi/management/wait-approve"
                                    style="text-decoration: none;color:#000000;">
                                    <span class="approvals-num mr-2"><?= $waitForApprove["totalRequest"] ?></span>
                                    Approvals
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/approvals.svg"
                                        class="first-layer-icon pull-right" style="margin-top:-2px;">
                                </a>
                                <?php
                                    } else { ?>
                                <a style="text-decoration: none;color:#2D7F06;">
                                    <span class="noapprovals-num mr-2"><?= $waitForApprove["totalRequest"] ?></span>
                                    No Approvals
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/check.svg"
                                        class="first-layer-icon pull-right" style="margin-top:-2px;">
                                </a>
                                <?php
                                    }
                                    ?>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-7 pt-1">
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
                        "employees" => isset($employees) ? $employees : []
                    ]) ?>
                    <input type="hidden" id="type" value="list">
                </div>

                <div class="col-lg-1 col-md-6 col-12 pr-0 text-end">
                    <div class="btn-group" role="group">
                        <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/individual-kpi-grid"
                            class="btn btn-outline-primary font-size-12 pim-change-modes">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/gridblack.svg"
                                style="cursor: pointer;">
                        </a>
                        <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/individual-kpi"
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
                                <td class="pl-10" style="width:13%">KPI Contents</td>
                                <td style="width:10%">Company Name</td>
                                <td style="width:13%">Branch</td>
                                <td style="width:5%">Priority</td>
                                <td style="width:7%">Employees</td>
                                <td style="width:4%">Team</td>
                                <td style="width:5%">QR</td>
                                <td class="text-end" style="width:5%">Target</td>
                                <td class="text-center" style="width:6%">Code</td>
                                <td class="text-start" style="width:5%">Result</td>
                                <td class="text-center" style="width:5%">Ratio</td>
                                <td class="text-center" style="width:2%">Month</td>
                                <td class="text-center" style="width:5%">Unit</td>
                                <td class="text-center">Last</td>
                                <td class="text-center">Next</td>
                                <td style="width:5%"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($kpis) && count($kpis) > 0) {
                                foreach ($kpis as $kpiEmployeeId => $kpi) :
                                    // $show = Kpi::checkPermission($role, $kpi["kpiId"], $userId);
                                    // if ($show == 1) {
                                    // 	$display = '';
                                    // } else {
                                    // 	$display = 'none';
                                    // }
                                    $canEdit = KpiEmployee::canEdit($role, $kpiEmployeeId);
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

                            ?>
                            <tr height="10">

                            </tr>
                            <tr id="kpi-<?= $kpiEmployeeId ?>" class="pim-bg-<?= $colorFormat ?> pim-table-text">
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
                                <!-- <td class="text-center"><?= $kpi["priority"] ?></td> -->
                                <td>
                                    <!-- <div class="flex mb-5 -space-x-4">
                                        <?php
                                                if (isset($kpi["employee"]) && count($kpi["employee"]) > 0) {
                                                    $e = 1;
                                                    foreach ($kpi["employee"] as $emp) :

                                                ?>
                                        <img class="image-grid" src="<?= Yii::$app->homeUrl . $emp ?>">
                                        <?php
                                                        if ($e == 3) {
                                                            break;
                                                        }
                                                        $e++;
                                                    endforeach;
                                                }
                                                ?>
                                        <a class="no-underline-black ml-2 mt-3"
                                            href="#"><?= count($kpi["employee"]) ?></a>
                                    </div> -->
                                    <div class="col-5 number-tagNew  <?= 'load-' . $colorFormat ?> ">
                                        <?= count($kpi["employee"]) ?>
                                    </div>
                                </td>
                                <td>
                                    <!-- <span class="badge rounded-pill bg-secondary-bsc"><i class="fa fa-users"
                                            aria-hidden="true"></i> <?= $kpi["countTeam"] ?></span> -->
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
                                    <?= $show ?>
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
                                    <?= $showResult ?>
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
                                                $showPercent = round($kpi['ratio']);
                                            }
                                            ?>
                                    <div id="progress1">
                                        <div data-num="<?= $showPercent ?>"
                                            class="progress-pim-table progress-circle-<?= $colorFormat ?>"></div>
                                    </div>
                                </td>
                                <td><?= $kpi["month"] ?></td>
                                <td><?= $kpi["unit"] ?></td>
                                <td><?= $kpi["periodCheck"] ?></td>
                                <td class="<?= $kpi['isOver'] == 1 ? 'text-danger' : '' ?>">
                                    <?= $kpi["status"] == 1 ? $kpi["nextCheck"] : '' ?>
                                </td>
                                <!-- <td colspan="row">
                                            <span data-bs-toggle="modal" data-bs-target="#kpi-issue"
                                                onclick="javascript:showKpiComment(<?= $kpi['kpiId'] ?>)">
                                                <img src="<?= Yii::$app->homeUrl ?>image/comment.svg"
                                                    class="comment-td-dropdown">
                                            </span>
                                            <span class="dropdown menulink" href="#" role="but ton" id="dropdownMenuLink"
                                                data-bs-toggle="dropdown" aria-expanded="false"> <i
                                                    class="fa fa-ellipsis-v on-cursor" aria-hidden="true"></i> </span>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <?php
                                                if ($canEdit == 1) {
                                                ?>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/update-personal-kpi/<?= ModelMaster::encodeParams(['kpiEmployeeId' => $kpiEmployeeId]) ?>">
                                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                <?php
                                                }
                                                ?>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/view-personal-kpi/<?= ModelMaster::encodeParams(['kpiEmployeeId' => $kpiEmployeeId]) ?>">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td> -->
                                <td class="text-center">

                                    <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/kpi-individual-history/<?= ModelMaster::encodeParams(['kpiId' => $kpi['kpiId'],'kpiEmployeeHistoryId' => $kpi["kpiEmployeeHistoryId"], 'kpiEmployeeId' => $kpiEmployeeId]) ?>"
                                        class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs mr-5' ?> mr-5"
                                        style="margin-top: -3px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.svg" alt="History"
                                            class="pim-icon" style="margin-top: -1px;">
                                    </a>

                                    <span class="dropdown" href="#" id="dropdownMenuLink-<?= $kpiEmployeeId ?>"
                                        data-bs-toggle="dropdown">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/3Dot.svg"
                                            class="icon-table on-cursor">
                                    </span>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink-<?= $kpiEmployeeId ?>">
                                        <?php
                                            if ( $canEdit == 1) {
                                            ?>
                                        <li class="pl-4 pr-4">
                                            <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/update-personal-kpi/<?= ModelMaster::encodeParams(['kpiEmployeeId' => $kpiEmployeeId]) ?>"
                                                class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/editblack.svg"
                                                    alt="History" alt="Edit" class="pim-icon mr-10"
                                                    style="margin-top: -2px;">
                                                Edit
                                            </a>
                                        </li>
                                        <li class="pl-4 pr-4">
                                            <a href="<?= Yii::$app->homeUrl ?>kpi/view/kpi-individual-history/<?= ModelMaster::encodeParams(['kpiId' => $kpi['kpiId'], "kpiEmployeeId" => $kpiEmployeeId]) ?>"
                                                class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs' ?> mr-5"
                                                style="margin-top: -1px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/history.svg"
                                                    alt="History" class="pim-icon mr-10" style="margin-top: -2px;">
                                                History
                                            </a>
                                        </li>
                                        <li class="pl-4 pr-4">
                                            <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/kpi-individual-history/<?= ModelMaster::encodeParams(['kpiId' => $kpi['kpiId'],'kpiEmployeeHistoryId' => $kpi["kpiEmployeeHistoryId"], 'kpiEmployeeId' => $kpiEmployeeId, 'openTab' => 3]) ?>"
                                                class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs' ?> mr-5"
                                                style="margin-top: -1px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg"
                                                    alt="Chats" class="pim-icon mr-10" style="margin-top: -2px;">
                                                Chats
                                            </a>
                                        </li>
                                        <li class="pl-4 pr-4">
                                            <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/kpi-individual-history/<?= ModelMaster::encodeParams(['kpiId' => $kpi['kpiId'],'kpiEmployeeHistoryId' => $kpi["kpiEmployeeHistoryId"], 'kpiEmployeeId' => $kpiEmployeeId, 'openTab' => 4]) ?>"
                                                class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                class="btn <?= $colorFormat == 'disable' ? 'btn-bg-gray-xs' : 'btn-bg-white-xs' ?> mr-5"
                                                style="margin-top: -1px; <?= $colorFormat == 'disable' ? 'pointer-events: none; opacity: 0.5;' : '' ?>">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Chart.svg"
                                                    alt="Chart" class="pim-icon mr-10" style="margin-top: -2px;">
                                                Chart
                                            </a>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($role >= 5) {
                                        ?>
                                        <li class="pl-4 pr-4">
                                            <a class="dropdown-itemNEW pl-4 pr-25" data-bs-toggle="modal"
                                                data-bs-target="#delete-kpi-employee"
                                                onclick="javascript:prepareDeleteKpiEmployee(<?= $kpiEmployeeId ?>)">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/delete.svg"
                                                    alt="Delete" class="pim-icon mr-10" style="margin-top: -2px;">
                                                Delete
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

<?= $this->render('modal_issue') ?>
<?= $this->render('modal_delete') ?>