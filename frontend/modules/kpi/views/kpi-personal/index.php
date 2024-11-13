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
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.png" class="home-icon mr-5"
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
                                        Company KPI
                                    </a>
                                </div>
                                <div class="col-4 pim-type-tab">
                                    <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-team/team-kpi"
                                        class="no-underline-black ">
                                        Team KPI
                                    </a>
                                </div>
                                <div class="col-4 pim-type-tab-selected rounded-top-right">
                                    Self KPI
                                </div>
                            </div>
                        </div>
                        <div class="col-4 pl-4">
                            <?php
                                    if ($role > 3) {
                                    ?>
                            <div class="col-12 approval-box text-center pr-3">
                                <?php
                                            if ($waitForApprove["totalRequest"] > 0) {
                                            ?>
                                <a href="<?= Yii::$app->homeUrl ?>kgi/management/wait-approve"
                                    style="text-decoration: none;color:#2580D3;">
                                    <span class="approve-num mr-2"><?= $waitForApprove["totalRequest"] ?></span>
                                    Approvals
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/approve.svg"
                                        class="first-layer-icon pull-right" style="margin-top:-2px;">
                                </a>
                                <?php
                                            } else { ?>
                                <a style="text-decoration: none;color:#2580D3;">
                                    <span class="approve-num mr-2"><?= $waitForApprove["totalRequest"] ?></span>
                                    Approvals
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/approve.svg"
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
                            class="btn btn-outline-primary font-size-12 pim-change-mode">
                            <i class="fa fa-th-large" aria-hidden="true"></i>
                        </a>
                        <a href="<?= Yii::$app->homeUrl ?>kpi/kpi-personal/individual-kpi"
                            class="btn btn-primary font-size-12 pim-change-mode">
                            <i class="fa fa-list-ul" aria-hidden="true"></i>
                        </a>

                    </div>
                </div>
            </div>

            <div class="col-12 mt-15">
                <div class="row">
                    <table class="">
                        <thead>
                            <tr class="pim-table-header">
                                <td class="pl-10">KPI Contents</td>
                                <td>Priority</td>
                                <td>Employees</td>
                                <td>Team</td>
                                <td>QR</td>
                                <td>target</td>
                                <td>Code</td>
                                <td>result</td>
                                <td>ratio</td>
                                <td>montd</td>
                                <td>Unit</td>
                                <td>Last</td>
                                <td>next</td>
                                <td></td>
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
											$colorFormat = 'inprogress';
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
                                <td class="text-center"><?= $kpi["priority"] ?></td>
                                <td>
                                    <div class="flex mb-5 -space-x-4">
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
                                    </div>
                                </td>
                                <td>
                                    <span class="badge rounded-pill bg-secondary-bsc"><i class="fa fa-users"
                                            aria-hidden="true"></i> <?= $kpi["countTeam"] ?></span>
                                </td>
                                <td><?= $kpi["quantRatio"] == 1 ? 'Quantity' : 'Quality' ?></td>
                                <td>
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
                                <td>
                                    <?= $kpi["code"] ?>
                                </td>
                                <td>
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
                                    <div id="progress1">
                                        <div data-num="<?= $kpi["ratio"] == '' ? 0 : $kpi["ratio"] ?>"
                                            class="progress-pim-table progress-circle-<?= $colorFormat ?>"></div>
                                    </div>
                                </td>
                                <td><?= $kpi["month"] ?></td>
                                <td><?= $kpi["unit"] ?></td>
                                <td><?= $kpi["periodCheck"] ?></td>
                                <td class="<?= $kpi['isOver'] == 1 ? 'text-danger' : '' ?>">
                                    <?= $kpi["status"] == 1 ? $kpi["nextCheck"] : '' ?>
                                </td>
                                <td colspan="row">
                                    <span data-bs-toggle="modal" data-bs-target="#kpi-issue"
                                        onclick="javascript:showKpiComment(<?= $kpi['kpiId'] ?>)">
                                        <img src="<?= Yii::$app->homeUrl ?>image/comment.png"
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