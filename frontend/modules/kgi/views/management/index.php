<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Kgi;
use yii\bootstrap5\ActiveForm;

$this->title = "KGI";
?>
<div class="col-12">
    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.svg" class="home-icon mr-5"
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
                                    Company KGI
                                </div>
                                <div class="col-4 pim-type-tab pr-0 pl-0">
                                    <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-team/team-kgi"
                                        class="no-underline-black ">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team.svg" alt="Team"
                                            class="pim-icon" style="width: 13px;height: 13px;padding-bottom: 2px;">
                                        Team KGI
                                    </a>
                                </div>
                                <div class="col-4 pim-type-tab pr-0 pl-0 rounded-top-right">
                                    <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/individual-kgi"
                                        class="no-underline-black">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/self.svg" alt="Self"
                                            class="pim-icon" style="width: 13px;height: 13px;padding-bottom: 3px;">
                                        Self KGI
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 pl-4">
                            <?php
							if ($role >= 3) {
							?>
                            <button type="button" class="btn-createnew font-size-11" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop5" style="position:absolute;" onclick="
                                javascript:changeType()">
                                Create New
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg" alt="History"
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
                        <a href="<?= Yii::$app->homeUrl . 'kgi/management/grid' ?>"
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
                                <td class="pl-10" style="width:13%">KGI Contents</td>
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
							if (isset($kgis) && count($kgis) > 0) {
								foreach ($kgis as $kgiId => $kgi) :
									/*$show = Kgi::checkPermission($role, $kgiId, $userId);
								if ($show == 1) {
									$display = '';
								} else {
									$display = 'none';
								}*/
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
                                    <!-- <div class="flex mb-5 -space-x-4">
                                        <?php
												if (isset($kgi["kgiEmployee"]) && count($kgi["kgiEmployee"]) > 0) {
													$e = 1;
													foreach ($kgi["kgiEmployee"] as $emp) :
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
                                            href="#"><?= count($kgi["kgiEmployee"]) ?></a>
                                    
                                    </div> -->
                                    <div class="col-5 number-tagNew  <?= 'load-' . $colorFormat ?> ">
                                        <?= count($kgi["kgiEmployee"]) ?>
                                    </div>
                                </td>
                                <td class="text-start">
                                    <!-- <span class="badge rounded-pill bg-secondary-bsc"><i class="fa fa-users"
                                            aria-hidden="true"></i> <?= $kgi["countTeam"] ?></span> -->
                                    <div class="col-5 number-tagNew  <?= 'load-' . $colorFormat ?> ">
                                        <?= $kgi["countTeam"] ?>
                                    </div>
                                </td>
                                <td><?= $kgi["quantRatio"] == 1 ? 'Quantity' : 'Quality' ?></td>
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
                                <td class="text-center">
                                    <a href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-history/<?= ModelMaster::encodeParams(['kgiId' => $kgiId]) ?>"
                                        class="btn btn-bg-white-xs mr-5" style="margin-top: -1px;">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/eye.svg" alt="History"
                                            class="pim-icon" style="margin-top: -1px;">
                                    </a>
                                    <span class="dropdown" href="#" id="dropdownMenuLink-<?= $kgiId ?>"
                                        data-bs-toggle="dropdown">
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/3Dot.svg"
                                            class="icon-table on-cursor">
                                    </span>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink-<?= $kgiId ?>">
                                        <?php
												if ($role >= 5) {
												?>
                                        <li class="pl-4 pr-4" data-bs-toggle="modal" data-bs-target="#update-kgi-modal"
                                            onclick="javascript:updateKgi(<?= $kgiId ?>)"
                                            style="display: <?= $display ?>;">
                                            <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/editblack.svg"
                                                    alt="History" alt="Chart" class="pim-icon mr-10"
                                                    style="margin-top: -2px;">
                                                Edit
                                            </a>
                                        </li>
                                        <?php
												}
												?>
                                        <li class="pl-4 pr-4" data-bs-toggle="modal">
                                            <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                href="<?= Yii::$app->homeUrl ?>kgi/view/index/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, 'openTab' => 2]) ?>"
                                                class="btn btn-bg-white-xs mr-4" style="margin-top: -3px;">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/history.svg"
                                                    alt="History" alt="Chart" class="pim-icon mr-10"
                                                    style="margin-top: -2px;">
                                                History
                                            </a>
                                        </li>
                                        <li class="pl-4 pr-4" data-bs-toggle="modal">
                                            <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-history/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, 'openTab' => 3]) ?>"
                                                class="btn btn-bg-white-xs mr-4" style="margin-top: -3px;">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg"
                                                    alt="Chart" class="pim-icon mr-10" style="margin-top: -2px;">
                                                Chats
                                            </a>
                                        </li>
                                        <li class="pl-4 pr-4" data-bs-toggle="modal">
                                            <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                href="<?= Yii::$app->homeUrl ?>kgi/view/kgi-history/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, 'openTab' => 4]) ?>"
                                                class="btn btn-bg-white-xs mr-4" style="margin-top: -3px;">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.svg"
                                                    alt="Chart" class="pim-icon mr-10" style="margin-top: -2px;">
                                                Chart
                                            </a>
                                        </li>
                                        <?php
												if ($role >= 4) {
												?>
                                        <li class="pl-4 pr-4" data-bs-toggle="modal">
                                            <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                href="<?= Yii::$app->homeUrl ?>kgi/assign/assign/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, "companyId" => $kgi["companyId"]]) ?>"
                                                class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                                <i class="fa fa-users pim-icon mr-10" aria-hidden="true" alt="Chart"
                                                    style="margin-top: -2px;"></i>
                                                Team
                                            </a>
                                        </li>
                                        <li class="pl-4 pr-4" data-bs-toggle="modal">
                                            <a class="dropdown-itemNEWS pl-4  pr-20 mb-5"
                                                href="<?= Yii::$app->homeUrl ?>kgi/assign/assign/<?= ModelMaster::encodeParams(['kgiId' => $kgiId, "companyId" => $kgi["companyId"], "save" => 0]) ?>"
                                                class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                                <i class="fa fa-user pim-icon mr-10" aria-hidden="true" alt="Chart"
                                                    style="margin-top: -2px;"></i>
                                                Person
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
                                                <!-- <i class="fa fa-trash-o" aria-hidden="true"></i> -->
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
<?= $this->render('modal_delete') ?>
<?= $this->render('modal_issue') ?>
<?= $this->render('modal_team_history') ?>
<?= $this->render('modal_employee_history') ?>
<?= $this->render('modal_kfi') ?>