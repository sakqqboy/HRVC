<?php

use frontend\models\hrvc\Kgi;
use frontend\models\hrvc\KgiTeam;
use yii\bootstrap5\ActiveForm;
use common\models\ModelMaster;

$this->title = "TEAM KGI";
?>
<div class="col-12">
    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.png" class="home-icon mr-5"
            style="margin-top: -3px;">
        <strong class="pim-head-text"> Team Key Goal Indicators </strong>
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
                                    <a href="<?= Yii::$app->homeUrl ?>kgi/management/index" class="no-underline-black ">
                                        Company KGI
                                    </a>
                                </div>
                                <div class="col-4 pim-type-tab-selected">
                                    Team KGI
                                </div>
                                <div class="col-4 pim-type-tab rounded-top-right">
                                    <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/individual-kgi"
                                        class="no-underline-black">
                                        Self KGI
                                    </a>
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
						"companyId" => $companyId,
						"branchId" => $branchId,
						"teamId" => $teamId,
						"month" => $month,
						"status" => $status,
						"year" => $year,
					]) ?>
                    <input type="hidden" id="type" value="list">
                </div>
                <div class="col-lg-1 col-md-6 col-12 pr-0 text-end">
                    <div class="btn-group" role="group">
                        <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-team/team-kgi-grid"
                            class="btn btn-outline-primary font-size-12 pim-change-modes">
                            <!-- <i class="fa fa-th-large" aria-hidden="true"></i> -->
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/gridblack.svg"
                                style="cursor: pointer;">
                        </a>
                        <a href="#" class="btn btn-primary font-size-12 pim-change-modes">
                            <!-- <i class="fa fa-list-ul" aria-hidden="true"></i> -->
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
                                <td class="pl-10" style="width:15%">KGI Contents</td>
                                <td style="width:10%">Company Name</td>
                                <td style="width:10%">Branch</td>
                                <td style="width:3%">Priority</td>
                                <td style="width:10%">Employees</td>
                                <td style="width:5%">Team</td>
                                <td style="width:5%">QR</td>
                                <td class="text-center" style="width:5%">Target</td>
                                <td class="text-center" style="width:2%">Code</td>
                                <td class="text-center" style="width:5%">Result</td>
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
							if (isset($teamKgis) && count($teamKgis) > 0) {
								foreach ($teamKgis as $kgiTeamId => $kgi) :
									$show = KgiTeam::checkPermission($role, $kgiTeamId, $userId);

									if ($show == 1) {
										$display = '';
									} else {
										$display = 'none';
									}

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
                            <tr id="kgi-<?= $kgiTeamId ?>" class="pim-bg-<?= $colorFormat ?> pim-table-text">
                                <td>
                                    <div class="col-12 border-left-<?= $colorFormat ?> pim-div-border pb-5">
                                        <?= $kgi["kgiName"] ?>
                                    </div>
                                </td>
                                <td><?= $kgi["companyName"] ?></td>
                                <td><img src="<?= Yii::$app->homeUrl . $kgi['flag'] ?>" class="Flag-Turkey">
                                    <?= $kgi["branch"] ?>, <?= $kgi["countryName"] ?></td>
                                <!-- <td></td> -->
                                <td class="text-center"><?= $kgi["priority"] ?></td>
                                <td>
                                    <div class="flex mb-5 -space-x-4">
                                        <?php
												if (isset($kgi["employee"]) && count($kgi["employee"]) > 0) {
													$e = 1;
													foreach ($kgi["employee"] as $emp) :
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
                                            href="#"><?= count($kgi["employee"]) ?></a>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge rounded-pill bg-secondary-bsc"><i class="fa fa-users"
                                            aria-hidden="true"></i> <?= $kgi["countTeam"] ?></span>
                                </td>
                                <td><?= $kgi["quantRatio"] == 1 ? 'Quantity' : 'Quality' ?></td>
                                <td class="text-start">
                                    <?php
											if( $kgi["target"] != ''){
											$decimal = explode('.', $kgi["target"]);
											if (isset($decimal[1])) {
												if ($decimal[1] == '00') {
													$show = $decimal[0];
												} else {
													$show = $kgi["target"];
												}
											} else {
												$show = $kgi["target"];
											}
										}else{
											$show = 0.00 ;
										}
											?>
                                    <?= $show ?><?= $kgi["amountType"] == 1 ? '%' : '' ?>
                                </td>
                                <td class="text-center">
                                    <?= $kgi["code"] ?>
                                </td>
                                <td class="text-end">
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
                                    <?= $kgi["status"] == 1 ? $kgi["nextCheckDate"] : '' ?>
                                </td>

                                <td>
                                    <a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-team-history/<?= ModelMaster::encodeParams(['kgiId' => $kgi['kgiId'], "kgiTeamId" => $kgiTeamId]) ?>"
                                        class="btn btn-bg-white-xs mr-5" style="margin-top: -1px;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/View.png"
                                            alt="History" class="pim-icon" style="margin-top: -1px;">
                                    </a>
                                    <span class="dropdown" href="#" id="dropdownMenuLink-<?= $kgi['isOver'] ?>"
                                        data-bs-toggle="dropdown">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/3Dot.png"
                                            class="icon-table on-cursor">
                                    </span>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink-<?= $kgi['isOver'] ?>">
                                        <?php
											if ($role >= 5) {
										?>
                                        <li class="pl-4 pr-4" data-bs-toggle="modal"
                                            data-bs-target="#update-kgi-modal-team"
                                            onclick="javascript:updateTeamKgi(<?= $kgiTeamId ?>)"
                                            style="display: <?= $display ?>;">
                                            <a class="dropdown-itemNEWS pl-4 pr-20 mb-5" href="#">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/editblack.svg"
                                                    alt="edit" class="pim-icon mr-10" style="margin-top: -2px;">
                                                Edit
                                            </a>
                                        </li>
                                        <?php
												}
										?>
                                        <li class="pl-4 pr-4" data-bs-toggle="modal">
                                            <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-team-history/<?= ModelMaster::encodeParams(['kgiTeamId' => $kgiTeamId,'kgiId' => $kgi['kgiId'], 'openTab' => 2]) ?>"
                                                class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/history.svg"
                                                    alt="History" class="pim-icon mr-3"
                                                    style="margin-top: -2px;">History
                                            </a>
                                        </li>
                                        <li class="pl-4 pr-4" data-bs-toggle="modal">
                                            <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-team-history/<?= ModelMaster::encodeParams(['kgiTeamId' => $kgiTeamId,'kgiId' => $kgi['kgiId'], 'openTab' => 2]) ?>"
                                                class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.png"
                                                    alt="Chats" class="pim-icon mr-3" style="margin-top: -2px;">Chats
                                            </a>
                                        </li>
                                        <li class="pl-4 pr-4" data-bs-toggle="modal">
                                            <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-team-history/<?= ModelMaster::encodeParams(['kgiTeamId' => $kgiTeamId,'kgiId' => $kgi['kgiId'], 'openTab' => 2]) ?>"
                                                class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.png"
                                                    alt="Chart" class="pim-icon mr-10" style="margin-top: -2px;">
                                                Chart
                                            </a>
                                        </li>
                                        <?php
											if ($role >= 5) {
										?>
                                        <li class="pl-4 pr-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop4"
                                            onclick="javascript:prepareDeleteKfi(<?= $kgi['isOver'] ?>)" title="Delete">
                                            <a class="dropdown-itemNEW pl-4 pr-25" href="#">
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
                                <!-- 
                                <td class="text-center">
                                    <span class="dropdown menulink" href="#" role="but ton" id="dropdownMenuLink"
                                        data-bs-toggle="dropdown" aria-expanded="false"> <i
                                            class="fa fa-ellipsis-v on-cursor" aria-hidden="true"></i> </span>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <?php
												if ($role > 3) {
												?>
                                        <li data-bs-toggle="modal" data-bs-target="#update-kgi-modal-team"
                                            onclick="javascript:updateTeamKgi(<?= $kgiTeamId ?>)"
                                            style="display: <?= $display ?>;">
                                            <a class="dropdown-item"><i class="fa fa-pencil-square-o"
                                                    aria-hidden="true"></i></a>
                                        </li>
                                        <?php
												} else {
													if ($role == 3 && ($kgi["teamId"] == $userTeamId)) { ?>
                                        <li data-bs-toggle="modal" data-bs-target="#update-kgi-modal-team"
                                            onclick="javascript:updateTeamKgi(<?= $kgiTeamId ?>)"
                                            style="display: <?= $display ?>;">
                                            <a class="dropdown-item"><i class="fa fa-pencil-square-o"
                                                    aria-hidden="true"></i></a>
                                        </li>
                                        <?php
													}
												}
												?>
                                        <li data-bs-toggle="modal" data-bs-target="#kgi-view-team"
                                            onclick="javascript:kgiTeamHistory(<?= $kgiTeamId ?>)">
                                            <a class="dropdown-item"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </td> -->
                            </tr>

                            <?php
								endforeach;
							}
							?>
                        </tbody>
                    </table>
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

    </div>
</div>
<?php
$form = ActiveForm::begin([
	'id' => 'update-kgi',
	'method' => 'post',
	'options' => [
		'enctype' => 'multipart/form-data',
	],
	'action' => Yii::$app->homeUrl . 'kgi/kgi-team/update-kgi-team'

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