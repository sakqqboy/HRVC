<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'Self KGI View';
?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
<div class="col-12">

    <div class="col-12">
        <img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.svg" class="home-icon mr-5"
            style="margin-top: -3px;">
        <strong class="pim-head-text"> Performance Indicator Matrices (PIM)</strong>
    </div>
    <div class="col-12 mt-10">
        <?= $this->render('kgi_header_filter', [
			"role" => $role
		]) ?>
        <?php
		if (isset($kgiEmployeeDetail) && !empty($kgiEmployeeDetail)) {
			if ($kgiEmployeeDetail["isOver"] == 1 && $kgiEmployeeDetail["status"] != 2) {
				$colorFormat = 'over';
			} else {
				if ($kgiEmployeeDetail["status"] == 1) {
					if ($kgiEmployeeDetail["isOver"] == 2) {
						$colorFormat = 'disable';
					} else {
						$colorFormat = 'inprogress';
					}
				} else {
					$colorFormat = 'complete';
				}
			}
		?>
        <div class="alert mt-10 pim-body bg-white">
            <div class="row">
                <div class="col-7 pim-name-detail pr-0 pl-5 text-start">
                    <a href="<?= isset(Yii::$app->request->referrer) ? Yii::$app->request->referrer : Yii::$app->homeUrl . 'kgi/kgi-personal/individual-kgi-grid' ?>"
                        class="mr-5 font-size-12">
                        <i class="fa fa-caret-left mr-3" aria-hidden="true"></i>
                        Back
                    </a>
                    <?= $kgiEmployeeDetail["kgiName"] ?>
                </div>
                <div class="col-5 text-end">
                    <?php
						if (!isset($kgiEmployeeDetail["picture"]) || $kgiEmployeeDetail["picture"] != "") {
							$kgiEmployeeDetail["picture"] = 'image/user.svg';
							$noPic = "pim-team-" . $colorFormat;
						} else {
							$noPic = '';
						}
						?>
                    <span class="team-wrapper <?= $colorFormat ?>-teamshow"
                        style="margin-right: 5px; padding-right: 5px;">
                        <span class="team-icon pim-team-<?= $colorFormat ?>">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/<?= $colorFormat == 'disable' ? 'teamblack' : 'teamwhite' ?>.svg"
                                alt="Team Icon">
                        </span>
                        <span class="team-name"><?= $kgiEmployeeDetail["teamName"] ?></span>
                    </span>
                    <span class="team-wrapper <?= $colorFormat ?>-teamshow"
                        style="margin-right: 5px; padding-right: 5px;">
                        <span class="team-icon <?= $noPic ?>">
                            <img src="<?= Yii::$app->homeUrl ?><?= $kgiEmployeeDetail['picture'] ?>" alt="Team Icon">
                        </span>
                        <span class="team-name"><?= $kgiEmployeeDetail["employeeName"] ?></span>
                    </span>
                    <a class="btn btn-bg-red-xs" data-bs-toggle="modal" data-bs-target="#delete-kgi"
                        onclick="javascript:prepareDeleteKgi(<?= $kgiId ?>)"
                        onmouseover="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binwhite.svg'"
                        onmouseout="this.querySelector('.pim-icon').src='<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg'">
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/binred.svg" alt="History"
                            class="pim-icon" style="margin-top: -3px; width: 12px; height: 14px;">
                        Delete

                    </a>
                </div>
            </div>
            <div class="row mt-10">
                <div class="col-lg-7 col-12">

                    <div class="row">
                        <div class="col-4 pim-name-detail ">Description</div>
                        <div class="col-2">
                            <div class="<?= $colorFormat ?>-tag text-center">
                                <?= $kgiEmployeeDetail['status'] == 1 ? 'In process' : 'Completed' ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-4 month-<?= $colorFormat ?> pt-2">Term</div>
                                <div class="col-8 term-<?= $colorFormat ?>  pt-2">
                                    <?= $kgiEmployeeDetail['fromDate'] == "" ? 'Not set' : $kgiEmployeeDetail['fromDate'] ?>
                                    &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;
                                    <?= $kgiEmployeeDetail['toDate'] == "" ? 'Not set' : $kgiEmployeeDetail['toDate'] ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 pim-description mt-10">
                            <?= $kgiEmployeeDetail["detail"] ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-12 pl-20">
                    <div class="col-12 pim-big-box pim-detail-<?= $colorFormat ?>">
                        <div class="row">
                            <div class="col-2 pim-subheader-font border-right-<?= $colorFormat ?>">
                                <div class="row">
                                    <div class="offset-1 col-8">
                                        <div class="text-center priority-star">
                                            <?php
												if ($kgiEmployeeDetail["priority"] == "A" || $kgiEmployeeDetail["priority"] == "B") {
												?>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <?php
												}
												if ($kgiEmployeeDetail["priority"] == "A" || $kgiEmployeeDetail["priority"] == "C") {
												?>
                                            <i class="fa fa-star big-star" aria-hidden="true"></i>
                                            <?php
												}
												if ($kgiEmployeeDetail["priority"] == "B") {
												?>
                                            <i class="fa fa-star ml-10" aria-hidden="true"></i>
                                            <?php
												}
												if ($kgiEmployeeDetail["priority"] == "A") {
												?>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <?php
												}
												?>
                                        </div>
                                        <div class="text-center priority-box">
                                            <div class="col-12">Priority</div>
                                            <div class="col-12 text-priority"><?= $kgiEmployeeDetail["priority"] ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-3 pim-subheader-font border-right-<?= $colorFormat ?> pl-18">
                                <div class="col-12">Quant Ratio</div>
                                <div class="col-12 border-bottom-<?= $colorFormat ?> pb-5 pim-duedate">
                                    <i class="fa fa-diamond" aria-hidden="true"></i>
                                    <?= $kgiEmployeeDetail["quantRatio"] == 1 ? 'Quantity' : 'Quality' ?>
                                </div>
                                <div class="col-12 pr-0 pt-5 pl-0">update Interval</div>
                                <div class="col-12  pim-duedate">
                                    <?= $kgiEmployeeDetail["unitText"] ?>
                                </div>
                            </div>
                            <div class="col-lg-7 pim-subheader-font pr-15 pl-15">
                                <div class="row">
                                    <div class="col-5 text-start">
                                        <div class="col-12">Target</div>
                                        <div class="col-12 mt-3 number-pim">
                                            <?php
												$decimal = explode('.', $kgiEmployeeDetail["target"]);
												if (isset($decimal[1])) {
													if ($decimal[1] == '00') {
														$show = $decimal[0];
													} else {
														$show = $kgiEmployeeDetail["target"];
													}
												} else {
													$show = $kgiEmployeeDetail["target"];
												}
												?>
                                            <?= $show ?><?= $kgiEmployeeDetail["amountType"] == 1 ? '%' : '' ?>
                                        </div>
                                    </div>
                                    <div class="col-2 symbol-pim text-center">
                                        <div class="col-12 pt-17"><?= $kgiEmployeeDetail["code"] ?></div>
                                    </div>
                                    <div class="col-5  text-end">
                                        <div class="col-12">Result</div>
                                        <div class="col-12 mt-3 number-pim">
                                            <?php
												if ($kgiEmployeeDetail["result"] != '') {
													$decimalResult = explode('.', $kgiEmployeeDetail["result"]);
													if (isset($decimalResult[1])) {
														if ($decimalResult[1] == '00') {
															$showResult = number_format($decimalResult[0]);
														} else {
															$showResult = number_format($kgiEmployeeDetail["result"], 2);
														}
													} else {
														$showResult = number_format($kgiEmployeeDetail["result"]);
													}
												} else {
													$showResult = 0;
												}
												?>
                                            <?= $showResult ?><?= $kgiEmployeeDetail["amountType"] == 1 ? '%' : '' ?>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <?php
											$percent = explode('.', $kgiEmployeeDetail['ratio']);
											if (isset($percent[1])) {
												if ($percent[1] != '00') {
													$showPercent = $percent[1];
												} else {
													$showPercent = $percent[0];
												}
											} else {
												$showPercent = $percent[0];
											}
											?>
                                        <div class="progress">
                                            <div class="progress-bar-<?= $colorFormat ?>"
                                                style="width:<?= $showPercent ?>%;"></div>
                                            <span
                                                class="progress-load load-<?= $colorFormat ?>"><?= $showPercent ?>%</span>
                                        </div>
                                    </div>
                                    <div class="col-4 mt-5 pl-0 pr-0 ">
                                        <div class="col-12 text-start" style="letter-spacing:0.3px;font-size:9px;">
                                            Last Updated on
                                        </div>
                                        <div class="col-12 text-start pim-duedate">
                                            <?= $kgiEmployeeDetail['nextCheckText'] == "" ? 'Not set' : $kgiEmployeeDetail['nextCheckText'] ?>
                                        </div>
                                    </div>
                                    <div class="col-4 text-center mt-5 pt-6 pl-3 pr-3">
                                        <?php
											if ($role > 3  && $kgiEmployeeDetail["status"] == 1) {
											?>
                                        <a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/update-personal-kgi/<?= ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId]) ?>"
                                            class="no-underline">
                                            <div class="pim-btn-setup">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/setupwhite.svg"
                                                    class="mb-2" style="width: 12px; height: 12px;"> Setup
                                            </div>
                                        </a>
                                        <?php
											}
											?>
                                    </div>
                                    <div class="col-4 pl-0 pr-5 mt-5 ">
                                        <div class="col-12 text-end font-<?= $colorFormat ?>"
                                            style="letter-spacing:0.3px;font-size:9px;">
                                            Next Update Date
                                        </div>
                                        <div class="col-12 text-end pim-duedate">
                                            <?= $kgiEmployeeDetail['nextCheckText'] == "" ? 'Not set' : $kgiEmployeeDetail['nextCheckText'] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-2  view-tab-active" id="tab-1"
                            onclick="javascript:viewTabEmployeeKgi(<?= $kgiEmployeeHistoryId ?>,1,<?= $kgiId ?>,<?= $kgiEmployeeId ?>)">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-blue.svg" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;" id="tab-1-blue">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-black.svg" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;display:none;" id="tab-1-black">
                            Assigned
                        </div>
                        <div class="col-3  view-tab" id="tab-2"
                            onclick="javascript:viewTabEmployeeKgi(<?= $kgiEmployeeHistoryId ?>,2,<?= $kgiId ?>,<?= $kgiEmployeeId ?>)">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh.svg" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;" id="tab-2-black">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/refresh-blue.svg" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;display:none;" id="tab-2-blue">
                            Update History
                        </div>
                        <div class="col-2  view-tab" id="tab-3"
                            onclick="javascript:viewTabEmployeeKgi(<?= $kgiEmployeeHistoryId ?>,3,<?= $kgiId ?>,<?= $kgiEmployeeId ?>)">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.svg" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;" id="tab-3-black">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment-blue.svg" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;display:none;" id="tab-3-blue">
                            Chats
                        </div>
                        <div class="col-2  view-tab" id="tab-4"
                            onclick="javascript:viewTabEmployeeKgi(<?= $kgiEmployeeHistoryId ?>,4,<?= $kgiId ?>,<?= $kgiEmployeeId ?>)">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.svg" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;" id="tab-4-black">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart-blue.svg" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;display:none;" id="tab-4-blue">
                            Chart
                        </div>
                        <div class="col-3  view-tab" id="tab-5"
                            onclick="javascript:viewTabEmployeeKgi(<?= $kgiEmployeeHistoryId ?>,5,<?= $kgiId ?>,<?= $kgiEmployeeId ?>)">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/relate.svg" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;" id="tab-5-black">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/relate-blue.svg" alt="History"
                                class="pim-icon mr-5" style="margin-top: -2px;display:none;" id="tab-5-blue">
                            Relate KPI
                        </div>
                        <input type="hidden" id="currentTab" value="1">
                    </div>
                </div>
                <div class="col-lg-5 view-tab">
                </div>
            </div>
            <div class="row mt-10" id="show-content">

            </div>
        </div>
        <?php
		}
		?>
    </div>
</div>
<input type="hidden" id="kgiId" value="<?= $kgiId ?>">
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
<?= $this->render('modal_delete') ?>
<?php // $this->render('modal_employee_history') 
?>


<script>
window.onload = function() {
    let openTab = <?= $openTab ?>; // PHP value passed to JavaScript
    if (openTab) {
        viewTabEmployeeKgi(<?= $kgiEmployeeHistoryId ?>, openTab, <?= $kgiId ?>,
        <?= $kgiEmployeeId ?>); // Set the tab based on the PHP value
    } else {
        viewTabEmployeeKgi(<?= $kgiEmployeeHistoryId ?>, 1, <?= $kgiId ?>,
        <?= $kgiEmployeeId ?>); // Default to tab 1 if no value is passed
    }
}
</script>