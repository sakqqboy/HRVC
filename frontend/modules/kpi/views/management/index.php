<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Kpi;
use yii\bootstrap5\ActiveForm;

$this->title = 'KPI';
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
        <div class="alert pim-body bg-white mt-10">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12  pr-0 pt-1">
                    <div class="row">
                        <div class="col-8">
                            <div class="row">
                                <div class="col-4 pim-type-tab-selected pr-0 pl-0 rounded-top-left">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/company.svg" alt="Company"
                                        class="pim-icon" style="width: 14px;height: 14px;padding-bottom: 4px;">
                                    Company KPI
                                </div>
                                <div class="col-4 pr-0 pl-0 pim-type-tab">
                                    <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-team/team-kpi"
                                        class="no-underline-black ">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team.svg" alt="Team"
                                            class="pim-icon" style="width: 13px;height: 13px;padding-bottom: 2px;">
                                        Team KPI
                                    </a>
                                </div>
                                <div class="col-4 pim-type-tab pr-0 pl-0 rounded-top-right">
                                    <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/individual-kpi"
                                        class="no-underline-black ">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/self.svg" alt="Self"
                                            class="pim-icon" style="width: 13px;height: 13px;padding-bottom: 3px;">
                                        Self KPI
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 pl-4">
                            <?php
                            if ($role >= 3) {
                            ?>
                            <button type="button" class="btn-createnew font-size-11" data-bs-toggle="modal"
                                data-bs-target="#create-kpi-modal" style="position:absolute;">
                                Create New
                                <img src=" <?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg" alt="History"
                                    class="pim-icon ml-3" style="margin-top: -1px;">
                            </button>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12 col-12 pt-1">
                    <?= $this->render('filter_list', [
                        "companies" => $companies,
                        "months" => $months
                    ]) ?>
                    <input type="hidden" id="type" value="list">
                </div>
                <div class="col-lg-1 col-md-6 col-12 pr-0 text-end">
                    <div class="btn-group" role="group">
                        <a href="<?= Yii::$app->homeUrl . 'kpi/management/grid' ?>"
                            class="btn btn-outline-primary font-size-12 pim-change-modes">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/gridblack.svg"
                                style="cursor: pointer;">
                        </a>
                        <a href="#" class="btn btn-primary font-size-12 pim-change-modes">
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
                                <td class="pl-10" style="width:15%">KPI Contents</td>
                                <td style="width:10%">Company Name</td>
                                <td style="width:10%">Branch</td>
                                <td style="width:3%">Priority</td>
                                <td style="width:10%">Employees</td>
                                <td style="width:5%">Team</td>
                                <td style="width:5%">QR</td>
                                <td class="text-center" style="width:5%">Target</td>
                                <td class="text-center" style="width:2%">Code</td>
                                <td class="text-center" style="width:5%">Result</td>
                                <!-- <td class="text-center">Quant Ratio</td> -->
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
                                foreach ($kpis as $kpiId => $kpi) :
                                    /*$show = Kpi::checkPermission($role, $kpiId, $userId);
								if ($show == 1) {
									$display = '';
								} else {
									$display = 'none';
								}*/
                                    if ($kpi["isOver"] == 1 && $kpi["status"] != 2) {
                                        $colorFormat = 'over';
                                    } else {
                                        if ($kpi["status"] == 1) {
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
                            <tr id="kpi-<?= $kpiId ?>" class="pim-bg-<?= $colorFormat ?> pim-table-text">
                                <td>
                                    <div class="col-12 border-left-<?= $colorFormat ?> pim-div-border pb-5">
                                        <?= $kpi["kpiName"] ?>
                                    </div>
                                </td>
                                <td><?= $kpi["companyName"] ?></td>
                                <td><img src="<?= Yii::$app->homeUrl . $kpi['flag'] ?>" class="Flag-Turkey">
                                    <?= $kpi["branch"] ?>, <?= $kpi["countryName"] ?></td>
                                <!-- <td></td> -->
                                <td class="text-center"><?= $kpi["priority"] ?></td>
                                <td>
                                    <div class="flex mb-5 -space-x-4">
                                        <?php
                                                if (isset($kpi["kpiEmployee"]) && count($kpi["kpiEmployee"]) > 0) {
                                                    $e = 1;
                                                    foreach ($kpi["kpiEmployee"] as $emp) :
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
                                            href="#"><?= count($kpi["kpiEmployee"]) ?></a>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge rounded-pill bg-secondary-bsc"><i class="fa fa-users"
                                            aria-hidden="true"></i> <?= $kpi["countTeam"] ?></span>
                                </td>
                                <td><?= $kpi["quantRatio"] == 1 ? 'Quantity' : 'Quality' ?></td>
                                <td class="text-start">
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
                                <td class="text-end">
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
                                <td class="text-center">
                                    <!-- <span data-bs-toggle="modal" data-bs-target="#kpi-issue" onclick="javascript:showKpiComment(<?php // $kpiId 
                                                                                                                                                ?>)">
												<img src="<?php // Yii::$app->homeUrl 
                                                            ?>image/comment.png" class="comment-td-dropdown">
											</span>
											<span class="dropdown menulink" href="#" role="but ton" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
												<i class="fa fa-ellipsis-v on-cursor" aria-hidden="true"></i>
											</span> -->


                                    <!-- <span data-bs-toggle="modal" data-bs-target="#kpi-issue"
                                        onclick="javascript:showKpiComment(<?= $kpiId ?>)"
                                        class="btn btn-bg-white-xs pr-2 pl-2 pt-1 pb-1">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/View.png"
                                            class="icon-table on-cursor">
                                    </span> -->

                                    <a href="<?= Yii::$app->homeUrl ?>kpi/view/kpi-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId]) ?>"
                                        class="btn btn-bg-white-xs mr-5" style="margin-top: -1px;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/View.png"
                                            alt="History" class="pim-icon" style="margin-top: -1px;">
                                    </a>

                                    <span class="dropdown" href="#" id="dropdownMenuLink-<?= $kpiId ?>"
                                        data-bs-toggle="dropdown">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/3Dot.png"
                                            class="icon-table on-cursor">
                                    </span>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink-<?= $kpiId ?>">
                                        <!-- <li data-bs-toggle="modal" data-bs-target="#update-kpi-modal"
                                            onclick="javascript:updateKpi(<?= $kpiId ?>)"
                                            style="display: <?= $display ?>;">
                                            <a class="dropdown-item"><i class="fa fa-pencil-square-o"
                                                    aria-hidden="true"></i></a>
                                        </li> -->
                                        <!-- <li data-bs-toggle="modal" data-bs-target="#kpi-view"
                                            onclick="javascript:kpiHistory(<?= $kpiId ?>)">
                                            <a class="dropdown-item"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </li> -->
                                        <!-- <li onclick="javascript:copyKpi(<?= $kpiId ?>)" title="Copy"
                                            style="display: <?= $display ?>;">
                                            <a class="dropdown-item" href="#">
                                                <i class="fa fa-copy" aria-hidden="true"></i>
                                            </a>
                                        </li> -->
                                        <!-- <?php
                                                if ($role >= 3) {
                                                ?>
                                        <li>
                                            <a class="dropdown-item"
                                                href="<?= Yii::$app->homeUrl ?>kpi/assign/assign/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, "companyId" => $kpi["companyId"]]) ?>">
                                                <i class="fa fa-users" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                                href="<?= Yii::$app->homeUrl ?>kpi/assign/assign/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, "companyId" => $kpi["companyId"]]) ?>">
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <?php
                                                }
                                                ?>
                                        <li data-bs-toggle="modal" data-bs-target="#delete-kpi"
                                            onclick="javascript:prepareDeleteKpi(<?= $kpiId ?>)"
                                            style="display: <?= $display ?>;">
                                            <a class="dropdown-item"><i class="fa fa-trash-o text-danger"
                                                    aria-hidden="true"></i></a>
                                        </li> -->

                                        <li class="pl-4 pr-4" data-bs-toggle="modal" data-bs-target="#update-kpi-modal"
                                            onclick="javascript:updateKpi(<?= $kpiId ?>)"
                                            style="display: <?= $display ?>;">
                                            <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/editblack.svg"
                                                    alt="History" alt="Chart" class="pim-icon mr-10"
                                                    style="margin-top: -2px;">
                                                Edit
                                            </a>
                                        </li>

                                        <li class="pl-4 pr-4" data-bs-toggle="modal">
                                            <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                href="<?= Yii::$app->homeUrl ?>kpi/view/index/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'openTab' => 2]) ?>"
                                                class="btn btn-bg-white-xs mr-4" style="margin-top: -3px;">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/history.svg"
                                                    alt="History" alt="Chart" class="pim-icon mr-10"
                                                    style="margin-top: -2px;">
                                                History
                                            </a>
                                        </li>
                                        <li class="pl-4 pr-4" data-bs-toggle="modal">
                                            <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                href="<?= Yii::$app->homeUrl ?>kpi/view/kpi-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'openTab' => 3]) ?>"
                                                class="btn btn-bg-white-xs mr-4" style="margin-top: -3px;">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.png"
                                                    alt="Chart" class="pim-icon mr-10" style="margin-top: -2px;">
                                                Chats
                                            </a>
                                        </li>
                                        <li class="pl-4 pr-4" data-bs-toggle="modal">
                                            <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                href="<?= Yii::$app->homeUrl ?>kpi/view/kpi-history/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, 'openTab' => 4]) ?>"
                                                class="btn btn-bg-white-xs mr-4" style="margin-top: -3px;">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.png"
                                                    alt="Chart" class="pim-icon mr-10" style="margin-top: -2px;">
                                                Chart
                                            </a>
                                        </li>
                                        <?php
												if ($role >= 3) {
												?>

                                        <li class="pl-4 pr-4" data-bs-toggle="modal">
                                            <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                href="<?= Yii::$app->homeUrl ?>kpi/assign/assign/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, "companyId" => $kpi["companyId"]]) ?>"
                                                class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                                <i class="fa fa-users pim-icon mr-10" aria-hidden="true" alt="Chart"
                                                    style="margin-top: -2px;"></i>
                                                Team
                                            </a>
                                        </li>
                                        <li class="pl-4 pr-4" data-bs-toggle="modal">
                                            <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                href="<?= Yii::$app->homeUrl ?>kpi/assign/assign/<?= ModelMaster::encodeParams(['kpiId' => $kpiId, "companyId" => $kpi["companyId"]]) ?>"
                                                class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                                <i class="fa fa-user pim-icon mr-10" aria-hidden="true" alt="Chart"
                                                    style="margin-top: -2px;"></i>
                                                Person
                                            </a>
                                        </li>
                                        <?php
												}
												?>
                                        <li class="pl-4 pr-4" data-bs-toggle="modal" data-bs-target="#delete-kpi"
                                            onclick="javascript:prepareDeleteKpi(<?= $kpiId ?>)" title="Delete">
                                            <a class="dropdown-itemNEW pl-4 pr-25" href="#">
                                                <!-- <i class="fa fa-trash-o" aria-hidden="true"></i> -->
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/delete.svg"
                                                    alt="Delete" class="pim-icon mr-10" style="margin-top: -2px;">
                                                Delete
                                            </a>
                                        </li>

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
    <?= $this->render('modal_delete') ?>
    <?= $this->render('modal_view') ?>
    <?= $this->render('modal_issue') ?>
    <?= $this->render('modal_team_history') ?>
    <?= $this->render('modal_employee_history') ?>
    <?= $this->render('modal_kgi') ?>
</div>