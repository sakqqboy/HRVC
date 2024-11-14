<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'Company KFI History';
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
        <div class="alert  mt-10 pim-body bg-white">
            <div class="col-12">
                <div class="row">
                    <div class="col-6 font-size-12 pim-name pr-0 pl-5 text-start">
                        <a href="<?= Yii::$app->homeUrl ?>kfi/management/grid" class="mr-5 font-size-12">
                            <i class="fa fa-caret-left mr-3" aria-hidden="true"></i>
                            Back
                        </a>
                        <span class="">
                            <?= $kfiDetail["kfiName"] ?>
                        </span>
                    </div>
                    <div class="col-6 text-end">

                    </div>
                </div>

            </div>
            <div class="row">
                <?php
				if (isset($kfis) && count($kfis) > 0) {
					$i = 0;
					foreach ($kfis as $year => $kfiMonth) :
						foreach ($kfiMonth as $month => $kfi):
							if ($kfi["isOver"] == 1 && $kfi["status"] != 2) {
								$colorFormat = 'over';
							} else {
								if ($kfi["status"] == 1) {
									if ($kfi["isOver"] == 2) {
										$colorFormat = 'disable';
									} else {
										$colorFormat = 'inprogress';
									}
								} else {
									$colorFormat = 'complete';
								}
							}
				?>
                <div class="col-lg-4 col-md-6 col-12 ">
                    <div class="col-12 mt-10 mb-5 pim-big-box pim-<?= $colorFormat ?> pt-3 pl-15">
                        <div class="row">
                            <div class="col-5 pim-name"><?= $kfi["month"] ?> <?= $kfi["year"] ?></div>
                            <div class="col-7 text-end">

                                <!-- <a class="btn btn-bg-white-xs mr-5" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop3"
                                    onclick="javascript:kfiHistory(<?= $kfi['kfiHistoryId'] ?>)">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Comment.png" alt="History"
                                        class="home-icon">
                                </a> -->

                                <!-- <a href="<?= Yii::$app->homeUrl ?>kfi/view/kfi-history/<?= ModelMaster::encodeParams(['kfiId' => $kfiId]) ?>"
                                    class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.png" alt="History"
                                        class="pim-icon">
                                </a> -->
                                <a href="<?= Yii::$app->homeUrl ?>kfi/view/index/<?= ModelMaster::encodeParams(["kfiId" => $kfiId]) ?>"
                                    class="btn btn-bg-white-xs">
                                    <!-- <i class="fa fa-eye" aria-hidden="true"></i> -->
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.png" alt="History"
                                        class="pim-icon" style="margin-top: -1px;">
                                </a>

                                <a href="<?= Yii::$app->homeUrl ?>kfi/view/kfi-history/<?= ModelMaster::encodeParams(['kfiId' => $kfiId , 'openTab' => 2]) ?>"
                                    class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.png" alt="History"
                                        class="pim-icon">
                                </a>

                                <a class="btn btn-bg-white-xs mr-5" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop3" onclick="javascript:kfiHistory(<?= $kfiId ?>)">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Charts.png" alt="History"
                                        class="home-icon" style="margin-top: -3px;">
                                </a>
                                <!-- <a href="<?= Yii::$app->homeUrl ?>kfi/chart/company-chart/<?= ModelMaster::encodeParams(['kfiId' => $kfi['kfiHistoryId']]) ?>"
                                    class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.png" alt="History"
                                        class="pim-icon mr-3" style="margin-top: -2px;">Chart
                                </a> -->
                                <?php
									if ($colorFormat == 'disable') {
								?>
                                <a class="btn btn-bg-blue-xs pr-2 pl-3 mr-5"
                                    onclick="javascript:updateKfi(<?= $kfi['kfiHistoryId'] ?>)">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/setupwhite.svg"
                                        alt="History" style="margin-top: -3px; width: 12px; height: 14px;"
                                        class="home-icon">
                                </a>
                                <?php
									}
								?>
                                <?php
											//if ($role >= 5) {
											?>
                                <!-- <a class="btn btn-xs btn-outline-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop4" onclick="javascript:prepareDeleteKfi(<?php // $kfi['kfiHistoryId'] 
																															?>)">
													<i class="fa fa-trash-o" aria-hidden="true"></i>
												</a> -->
                                <?php
											//}
											?>
                                <?php
									if ($i == 0 && $kfi["status"] == 2 && $role >= 5) {
								?>
                                <a class="btn btn-bg-white-xs pr-2 pl-3 mr-5"
                                    onclick="javascript:prepareKfiNextTarget(<?= $kfi['kfiHistoryId'] ?>)">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/coppy.svg" alt="History"
                                        style="margin-top: -3px; width: 12px; height: 14px;" class="home-icon">
                                </a>
                                <?php
									}
								?>
                            </div>
                            <div class="col-9 mt-10 pl-28">
                                <div class="row">
                                    <div class="col-4 month-<?= $colorFormat ?> pt-2">Term</div>
                                    <div class="col-8 term-<?= $colorFormat ?>  pt-2">
                                        <?= $kfi['fromDate'] == "" ? 'Not set' : $kfi['fromDate'] ?> -
                                        <?= $kfi['toDate'] == "" ? 'Not set' : $kfi['toDate'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 mt-10">
                                <div class="<?= $colorFormat ?>-tag text-center">
                                    <?= $kfi['status'] == 1 ? 'In process' : 'Completed' ?>
                                </div>
                            </div>
                            <div class="col-9  pl-15 pr-20 pt-18">
                                <div class="col-12 text-start pl-5 font-size-10">
                                    Assign on
                                </div>
                                <div class="col-12 pt-2 pb-2">
                                    <div class="row">
                                        <div class="col-5 pl-10">
                                            <div class="row">
                                                <div class="col-3">
                                                    <?php
																if (isset($kfi['kfiEmployee'][0])) {
																?>
                                                    <img src="<?= Yii::$app->homeUrl . $kfi['kfiEmployee'][0] ?>"
                                                        class="pim-pic-gridKFI">
                                                    <?php
																}
																?>
                                                </div>
                                                <div class="col-3 pic-afterKFI pt-0">
                                                    <?php
																if (isset($kfi['kfiEmployee'][1])) {
																?>
                                                    <img src="<?= Yii::$app->homeUrl . $kfi['kfiEmployee'][1] ?>"
                                                        class="pim-pic-gridKFI">
                                                    <?php
																}
																?>
                                                </div>
                                                <!-- <div class="col-2 pic-afterKFI  pt-0">
                                                    <?php
																if (isset($kfi['kfiEmployee'][2])) {
																?>
                                                    <img src="<?= Yii::$app->homeUrl . $kfi['kfiEmployee'][2] ?>"
                                                        class=" pim-pic-gridKFINum">
                                                    <?php
																}
																?>
                                                </div> -->
                                                <div
                                                    class="col-6  number-tag load-<?= $colorFormat ?> pr-0 pl-0 ml-7 pim-pic-gridKFINum ">
                                                    <?= $kfi["employee"] ?>
                                                </div>
                                                <!-- <div class="number-tag load-<?= $colorFormat ?> pr-0 pl-0 pt-3"
                                                    style="margin-left: -3px;height:22px;width: 30px;margin-top: 1px;">
                                                    <?= $kfi["employee"] ?>
                                                </div> -->
                                            </div>
                                        </div>
                                        <div class="col-6 pl-1 pt-9 pr-0 <?= $colorFormat ?>-assignKFI">
                                            <?php
                                                if ($role >= 5) {
                                             ?>
                                            <span class="pull-left mt-1 pl-2  pr-4"
                                                style="display:<?= $kfi['isOver'] == 2 ? 'none;' : '' ?>">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/assign-<?= $colorFormat ?>.svg"
                                                    class="home-icon" style="margin-top: -3px;">
                                            </span>
                                            <a href="<?= Yii::$app->homeUrl ?>kfi/assign/assign/<?= ModelMaster::encodeParams(['kfiId' => $kfiId, "companyId" => $kfi['companyId']]) ?>"
                                                class="font-<?= $colorFormat ?>">
                                                Change Assigned
                                            </a>
                                            <?php
                                                            } else { ?>
                                            <div class="d-flex align-items-center" style="margin-left: 9px;">
                                                <div class=" circle-color-<?= $colorFormat ?>"
                                                    style="display:<?= $kfi['isOver'] == 2 ? 'none;' : '' ?>; margin-right: 5px;">
                                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eyewhite.svg"
                                                        class="home-icon"
                                                        style="width: 14px; height: 14px; margin-top: -1px;">
                                                </div>
                                                <a href="<?= Yii::$app->homeUrl ?>kfi/view/kfi-history/<?= ModelMaster::encodeParams(["kfiId" => $kfiId, 'openTab' => 1]) ?>"
                                                    class="font-<?= $colorFormat ?>">
                                                    View Assigned
                                                </a>
                                            </div>

                                            <?php
                                                 }
                                            ?>
                                        </div>
                                        <div class="col-1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 font-size-10 pt-15 text-end">
                                <!-- Apply text-end here for overall alignment -->
                                <div class="col-12 text-end">Quant Ratio</div>
                                <div class="col-12 pim-duedate text-center mt-2 text-end">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/diamon.svg"
                                        class="pim-iconKFI" style="margin-top: -3px; margin-left: 3px;">
                                    <b><?= $kfi["quantRatio"] == 1 ? 'Quantity' : 'Quality' ?></b>
                                </div>

                                <!-- Horizontal line SVG -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="62" height="1" viewBox="0 0 65 1"
                                    fill="none" class="mt-2">
                                    <path d="M1 0.5L64 0.5" stroke="#9ABCE9" stroke-linecap="round" />
                                </svg>

                                <div class="col-12 pr-0 mt-2 text-end">Update Interval</div>
                                <div class="col-12 pim-duedate text-center mt-2 text-end">
                                    <b>
                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/monthly.svg"
                                            class="pim-iconKFI" style="margin-top: -3px; margin-left: 3px;">
                                        <?= $kfi["unit"] ?>
                                    </b>
                                </div>
                            </div>

                            <div class="col-12 mt-10">
                                <div class="row">
                                    <div class="col-5 text-start pl-20">
                                        <div class="col-12 font-size-10">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Target.svg"
                                                class="pim-iconKFI" style="margin-top: 1px; margin-right: 3px;">
                                            Target
                                        </div>
                                        <div class="col-12 number-pim">
                                            <?php
														$decimal = explode('.', $kfi["target"]);
														if (isset($decimal[1])) {
															if ($decimal[1] == '00') {
																$show = number_format($decimal[0]);
															} else {
																$show = number_format($kfi["target"], 2);
															}
														} else {
															$show = number_format($kfi["target"]);
														}
														?>
                                            <b><?= $show ?><?= $kfi["amountType"] == 1 ? '%' : '' ?></b>
                                        </div>
                                    </div>
                                    <div class="col-2 symbol-pim text-center">
                                        <div class="col-12 pt-13 font-size-12"><?= $kfi["code"] ?></div>
                                    </div>
                                    <div class="col-5 text-end pr-20">
                                        <div class="col-12 font-size-10">Result
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/Result.svg"
                                                class="pim-iconKFI" style="margin-top: 1px; margin-left: 3px;">
                                        </div>
                                        <div class="col-12 number-pim">
                                            <?php
														if ($kfi["result"] != '') {
															$decimalResult = explode('.', $kfi["result"]);
															if (isset($decimalResult[1])) {
																if ($decimalResult[1] == '00') {
																	$showResult = number_format($decimalResult[0]);
																} else {
																	$showResult = number_format($kfi["result"], 2);
																}
															} else {
																$showResult = number_format($kfi["result"]);
															}
														} else {
															$showResult = 0;
														}
														?>
                                            <b><?= $showResult ?><?= $kfi["amountType"] == 1 ? '%' : '' ?></b>

                                        </div>
                                    </div>
                                    <div class="col-12 pl-20 pr-20 pb-8">
                                        <?php
													$percent = explode('.', $kfi['ratio']);
													if (isset($percent[1])) {
														if ($percent[1] != '00') {
															//$showPercent = $kfi['ratio'];
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

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
							$i++;
						endforeach;
					endforeach;
				}
				?>
            </div>
        </div>
    </div>
</div>
<?= $this->render('modal_confirm_next') ?>

<?php $form = ActiveForm::begin([
            'id' => 'update-kfi',
            'method' => 'post',
            'options' => [
                'enctype' => 'multipart/form-data',
            ],
            'action' => Yii::$app->homeUrl . 'kfi/management/save-update-kfi'

        ]); ?>
<?= $this->render('update_modal', [
            "units" => $units,
            "companies" => $companies,
            "months" => $months,
            "isManager" => $isManager
        ]) ?>

<?php ActiveForm::end(); ?>