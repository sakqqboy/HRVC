<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'KFI Grid View';
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
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 pt-2 key1">
                    <div class="row">
                        <div class="col-3">
                            <div class="row">
                                <div
                                    class="col-12 pim-type-tab-selected pr-0 pl-1 pt-4 pb-2 text-center font-size-12 rounded-top-left">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/company.svg"
                                        style="width: 12px; height: 12px; cursor: pointer;">
                                    Company KFI
                                </div>
                            </div>
                        </div>
                        <div class=" col-9">
                            <?php
									if ($role >= 3) {
									?>
                            <button type="button" class="btn-create font-size-12" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop1">
                                Create New KFI <i class="fa fa-magic ml-3" aria-hidden="true"></i>
                            </button>
                            <?php
									}
							?>
                        </div>

                    </div>
                </div>
                <div class="col-lg-7 col-md-12 col-12 pt-2 New-KFI">
                    <?= $this->render('filter_list', [
						"companies" => $companies,
						"months" => $months
					]) ?>
                    <input type="hidden" id="type" value="grid">
                </div>
                <div class="col-lg-1 col-md-6 col-12 pr-0 text-end">
                    <div class="btn-group" role="group">
                        <a href="#" class="btn btn-primary font-size-12 pim-change-modes">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/gridwhite.svg"
                                style="cursor: pointer;">
                        </a>
                        <a href="<?= Yii::$app->homeUrl . 'kfi/management/index' ?>"
                            class="btn btn-outline-primary font-size-12 pim-change-modes">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/listblack.svg"
                                style="cursor: pointer;">
                        </a>
                    </div>

                </div>
            </div>
            <div class="col-12 mt-5">
                <div class="row">
                    <?php
					if (isset($kfis) && count($kfis) > 0) {
						foreach ($kfis as $kfiId => $kfi) :
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
                    <div class="col-12 mt-10 mb-5 pim-big-box pim-<?= $colorFormat ?>" id="kfi-<?= $kfiId ?>">
                        <div class="row">
                            <div class="col-lg-4 col-md-5 col-12 pim-name">
                                <?= $kfi["kfiName"] ?>
                            </div>
                            <div class="col-lg-1 col-md-2 col-4 text-center">
                                <div class="<?= $colorFormat ?>-tag text-center">
                                    <?= $kfi['status'] == 1 ? 'In process' : 'Completed' ?>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-2 col-4 text-center">
                                <div class="text-center">
                                </div>
                            </div>
                            <div class=" col-lg-3 col-md-3 col-4 pl-30 text-center">
                                <div class="row">
                                    <div class="col-4 month-<?= $colorFormat ?>"><?= $kfi['month'] ?></div>
                                    <div class="col-8 term-<?= $colorFormat ?>">
                                        <?= $kfi['fromDate'] == "" ? 'Not set' : $kfi['fromDate'] ?> -
                                        <?= $kfi['toDate'] == "" ? 'Not set' : $kfi['toDate'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-2 col-4 text-end pr-20">
                                <!-- <a href="<?= Yii::$app->homeUrl ?>kfi/view/index/<?= ModelMaster::encodeParams(["kfiId" => $kfiId]) ?>"
                                    class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.png" alt="History"
                                        class="pim-icon" style="margin-top: -1px;">
                                </a> -->
                                <a href="<?= Yii::$app->homeUrl ?>kfi/view/kfi-history/<?= ModelMaster::encodeParams(["kfiId" => $kfiId, 'openTab' => 1]) ?>"
                                    class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/eye.png" alt="History"
                                        class="pim-icon" style="margin-top: -1px;">
                                </a>
                                <!-- <a href="<?= Yii::$app->homeUrl ?>kfi/view/kfi-history/<?= ModelMaster::encodeParams(['kfiId' => $kfiId]) ?>"
                                    class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/comment.png" alt="History"
                                        class="pim-icon">
                                </a> -->
                                <!-- <a class="btn btn-bg-white-xs mr-5" data-bs-toggle="modal" data-bs-target="#staticBackdrop3" onclick="javascript:kfiHistory(<?php // $kfiId 
																													?>)" style="margin-top: -3px;">
											<img src="<?php // Yii::$app->homeUrl 
													?>images/icons/Settings/comment.png" alt="History" class="pim-icon">
										</a> -->
                                <!-- <a href="<?= Yii::$app->homeUrl ?>kfi/chart/company-chart/<?= ModelMaster::encodeParams(['kfiId' => $kfiId]) ?>"
                                    class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.png" alt="History"
                                        class="pim-icon mr-3" style="margin-top: -2px;">Chart
                                </a> -->


                                <!-- <a href="<?= Yii::$app->homeUrl ?>kfi/view/kfi-history/<?= ModelMaster::encodeParams(['kfiId' => $kfiId]) ?>"
                                    class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/....png" alt="History"
                                        class="pim-icon mr-3" style="margin-top: -2px;">	
                                </a> -->
                                <a href="<?= Yii::$app->homeUrl ?>kfi/view/kfi-history/<?= ModelMaster::encodeParams(['kfiId' => $kfiId, 'openTab' => 2]) ?>"
                                    class="btn btn-bg-white-xs mr-5 " style="margin-top: -3px;">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/history.svg" alt="History"
                                        class="pim-icon mr-3" style="margin-top: -2px;">History
                                </a>
                                <!-- <a href="<?= Yii::$app->homeUrl ?>kfi/view/kfi-history/<?= ModelMaster::encodeParams(['kfiId' => $kfiId]) ?>"
                                    class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.png" alt="Chart"
                                        class="pim-icon mr-3" style="margin-top: -2px;">Chart
                                </a> -->
                                <a href="<?= Yii::$app->homeUrl ?>kfi/view/kfi-history/<?= ModelMaster::encodeParams(['kfiId' => $kfiId, 'openTab' => 4]) ?>"
                                    class="btn btn-bg-white-xs mr-5" style="margin-top: -3px;">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/chart.png" alt="Chart"
                                        class="pim-icon mr-3" style="margin-top: -2px;">
                                </a>
                                <?php
										if ($role >= 5) {
										?>
                                <a class="btn btn-bg-red-xs" data-bs-toggle="modal" data-bs-target="#staticBackdrop4"
                                    onclick="javascript:prepareDeleteKfi(<?= $kfiId ?>)" style="margin-top: -3px;">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/bin.png" alt="History"
                                        class="pim-icon" style="margin-top: -2px;">
                                </a>
                                <?php
										}
										?>
                            </div>
                            <div class="col-lg-3 pim-subheader-font border-right-<?= $colorFormat ?> mt-5">
                                <div class="row">
                                    <div class="col-12 text-start pl-22 font-size-12">
                                        Assign on
                                    </div>
                                    <!-- <div class="col-1 pr-10 pl-20">
                                    </div> -->
                                    <div class="col-10 pr-10 pl-30">
                                        <!-- <div class="col-12 <?= $colorFormat ?>-assign  mt-5 pt-2 pb-1"> -->
                                        <div class="col-12 mt-5 pt-2 pb-1">
                                            <div class="row">
                                                <!-- <div class="col-5 border-right-<?= $colorFormat ?>"> -->
                                                <div class="col-5">
                                                    <div class="row pim-picgroup">
                                                        <div class="col-2">
                                                            <?php
																	if (isset($kfi['kfiEmployee'][0])) {
																	?>
                                                            <img src="<?= Yii::$app->homeUrl . $kfi['kfiEmployee'][0] ?>"
                                                                class="pim-pic-gridKFI">
                                                            <?php
																	}
																	?>
                                                        </div>
                                                        <div class="col-2 pic-afterKFI pt-0">
                                                            <?php
																	if (isset($kfi['kfiEmployee'][1])) {
																	?>
                                                            <img src="<?= Yii::$app->homeUrl . $kfi['kfiEmployee'][1] ?>"
                                                                class="pim-pic-gridKFI">
                                                            <?php
																	}
																	?>
                                                        </div>
                                                        <!-- <div class="col-2 .pic-afterKFI pt-0">
                                                            <?php
																	if (isset($kfi['kfiEmployee'][2])) {
																	?>
                                                            <img src="<?= Yii::$app->homeUrl . $kfi['kfiEmployee'][2] ?>"
                                                                class="pim-pic-gridKFI">
                                                            <?php
																	}
																	?>
                                                        </div> -->
                                                        <div
                                                            class="col-6 number-tag load-<?= $colorFormat ?> pr-0 pl-0 pt-1 pim-pic-gridKFINum ">
                                                            <?= $kfi["countEmployee"] ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-7 pl-1 pt-10 pr-0 <?= $colorFormat ?>-assignKFI">
                                                    <span class="pull-left mt-1 pl-2  pr-4"
                                                        style="display:<?= $kfi['isOver'] == 2 ? 'none;' : '' ?>">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/assign-<?= $colorFormat ?>.svg"
                                                            class="home-icon" style="margin-top: -3px;">
                                                    </span>
                                                    <?php
															if ($role >= 5) {
															?>
                                                    <a href="<?= Yii::$app->homeUrl ?>kfi/assign/assign/<?= ModelMaster::encodeParams(['kfiId' => $kfiId, "companyId" => $kfi['companyId']]) ?>"
                                                        class="font-<?= $colorFormat ?>">
                                                        Change Assigned
                                                    </a>
                                                    <?php
															} else { ?>
                                                    <span class="font-<?= $colorFormat ?>">
                                                        Change Assigned
                                                    </span>
                                                    <?php
															}
															?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 pim-subheader-font border-right-<?= $colorFormat ?> mt-5 pl-10 pr-10">
                                <div class="col-12 mt-18">
                                    <!-- Additional spacing for row container -->
                                    <div class="row">
                                        <!-- Left Column: Quant Ratio -->
                                        <div class="col-6 border-right-<?= $colorFormat ?>">
                                            <div class="col-12  pr-6 pt-10 text-center">Quant Ratio</div>
                                            <div class="col-12 pim-duedate text-center mt-2">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/diamon.svg"
                                                    class="pim-iconKFI" style="margin-top: -3px;">
                                                <!-- <i class="fa fa-diamond" aria-hidden="true"></i> -->
                                                <?= $kfi["quantRatio"] == 1 ? 'Quantity' : 'Quality' ?>
                                            </div>
                                        </div>

                                        <!-- Right Column: Update Interval -->
                                        <div class="col-6">
                                            <div class="col-12 pr-0 pt-10 text-center">Update Interval
                                            </div>
                                            <div class="col-12 pim-duedate text-center mt-2">
                                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/monthly.svg"
                                                    class="pim-iconKFI" style="margin-top: -3px;">
                                                <?= $kfi["unit"] ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6 pim-subheader-font  mt-5 pr-15 pl-15">
                                <div class="row">
                                    <div class="col-5 text-start">
                                        <div class="col-12">Target</div>
                                        <div class="col-12 mt-3 number-pim">
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
                                            <?= $show ?><?= $kfi["amountType"] == 1 ? '%' : '' ?>
                                        </div>
                                    </div>
                                    <div class="col-2 symbol-pim text-center">
                                        <div class="col-12 pt-17"><?= $kfi["code"] ?></div>
                                    </div>
                                    <div class="col-5  text-end">
                                        <div class="col-12">Result</div>
                                        <div class="col-12 mt-3 number-pim">
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
                                            <?= $showResult ?><?= $kfi["amountType"] == 1 ? '%' : '' ?>
                                        </div>
                                    </div>
                                    <div class="col-12 pl-15 pr-10">
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
                                    <div class="col-5 pl-5 pr-5 mt-10 ">
                                        <div class="col-12 text-end ">Last Updated on</div>
                                        <div class="col-12 text-end pim-duedate">
                                            <?= $kfi['nextCheck'] == "" ? 'Not set' : $kfi['nextCheck'] ?></div>
                                    </div>
                                    <div class="col-2 text-center mt-10 pt-6">
                                        <?php
												//if ($role >= 5 && $kfi["status"] == 1) {
												if ($role >= 5) {
												?>
                                        <div onclick="javascript:updateKfi(<?= $kfiId ?>)"
                                            class="pim-btn-<?= $colorFormat ?>" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop2">
                                            <i class="fa fa-refresh" aria-hidden="true"></i> Update
                                        </div>
                                        <?php
												}
												?>
                                    </div>
                                    <div class="col-5 pl-0 pr-11 mt-10">
                                        <div class="col-12 text-start font-<?= $colorFormat ?>">Next Update Date
                                        </div>
                                        <div class="col-12 text-start pim-duedate">
                                            <?= $kfi['nextCheck'] == "" ? 'Not set' : $kfi['nextCheck'] ?></div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-lg-5 pim-subheader-font mt-5">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12 pr-3 pl-20">
                                        <div class="col-12 head-letter head-<?= $colorFormat ?>">Issue</div>
                                        <div class="col-12 body-letter body-letter-<?= $colorFormat ?>">
                                            Now use Lorem Ipsum as their default model text, and a search for 'lorem
                                            ipsum' will uncover many web sites still in their infancy. Various versions.
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 pl-5 pr-20">
                                        <div class="col-12 head-letter head-<?= $colorFormat ?>">Solution</div>
                                        <div class="col-12 body-letter body-letter-<?= $colorFormat ?>">Now use Lorem
                                            Ipsum as their default model text, and a search for 'lorem ipsum' will
                                            uncover many web sites still in their infancy. Various versions.

                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <!-- <div class="col-lg-4 col-md-6 col-sm-5 col-12 mt-20">
								<div class="col-12 border pl-20 pr-20 pt-10 pb-5 <?php // $kfi['isOver'] == 1 ? 'bg-over' : 'bg-white' 
															?>" style="border-radius:10px;box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;">
									<div class="row">
										<div class="col-12">
											<div class="row">
												<div class="col-12 text-end pr-0">
													<a class="btn btn-xs btn-outline-secondary pt-0" style="margin-left: 0px;" data-bs-toggle="modal" data-bs-target="#staticBackdrop3" onclick="javascript:kfiHistory(<?= $kfiId ?>)">
														<i class="fa fa-eye mt-6" aria-hidden="true" style="margin-left: -5px"></i>
													</a>
													<?php
													//if ($role >= 5) {
													?>
														<a class="btn-xs  ml-5 pt-0" data-bs-toggle="modal" data-bs-target="#staticBackdrop4" onclick="javascript:prepareDeleteKfi(<?php //  $kfiId 
																																?>)">
															<i class="fa fa-trash-o mt-6" aria-hidden="true" style="margin-left: -5px;"></i>
														</a>
													<?php
													//	}
													?>
												</div>
												<div class="col-9 linechart-increase" style="margin-top: -25px;">
													<i class="fa fa-line-chart mr-5" aria-hidden="true"></i> <?php //$kfi["kfiName"] 
																						?>
													<div class="col-12  ting-size mt-5">
														<?php // $kfi["companyName"] 
														?>
													</div>
													<div class="col-12 font-size-12 mt-5">
														<img src="<?php // Yii::$app->homeUrl 
																?><?php //  $kfi["flag"] 
																	?>" class="image-is mr-3"> <?php //  $kfi["branchName"] 
																					?>
													</div>

												</div>
											</div>
										</div>
										<div class="col-12 pl-0 text-end  pr-5 " style="margin-top:-35px;">
											<div class="offset-6 col-6 text-end pl-0 pr-0">
												<span class="badge rounded-pill bg-deadline0 ml-5" style="width:100%;">
													<span class="deadline-orange"> Term</span>
													<span class="font-size-10 text-dark" style="font-weight: 700;">: <?php //  $kfi['fromDate'] == "" ? 'Not set' : $kfi['fromDate'] 
																							?> - </span>
													<span class="font-size-10 text-dark" style="font-weight: 700;"><?php //  $kfi['toDate'] == "" ? 'Not set' : $kfi['toDate'] 
																						?></span>
												</span>
											</div>
										</div>
										<div class="col-12 text-end pr-0 " style="margin-top:-8px;">
											<span class="badge rounded-pill <?php //  $kfi['status'] == 1 ? 'bg-warning text-dark' : 'bg-success' 
																?>"> <?php //  $kfi['status'] == 1 ? 'In process' : 'Completed' 
																	?></span>
										</div>
										<div class="col-12 mt-15">
											<div class="row">
												<div class="col-lg-1 col-md-6 col-2 font-size-14 pt-30 pr-0 pl-0 text-center" style="font-weight: 500;">
													<?php //  strtoupper(substr($kfi['month'], 0, 3)) 
													?>
												</div>
												<div class="col-lg-4 col-md-6 col-3">
													<div class="col-12 Quant-ratio">
														Quant Ratio
													</div>
													<div class="col-12 font-size-10 mt-3">
														<i class="fa fa-diamond" aria-hidden="true"></i> <?php // $kfi["quantRatio"] == 1 ? 'Quantity' : 'Quality' 
																					?>
													</div>
												</div>

												<div class="col-lg-3 col-md-6 col-3">
													<div class="col-12 bullseye-con">
														<i class="fa fa-bullseye" aria-hidden="true"></i> Target
													</div>
													<div class="col-12 million-number" style="font-weight: 500;">
														<?php
														//$decimal = explode('.', $kfi["target"]);
														// if (isset($decimal[1])) {
														// 	if ($decimal[1] == '00') {
														// 		$show = number_format($decimal[0]);
														// 	} else {
														// 		$show = number_format($kfi["target"], 2);
														// 	}
														// } else {
														// 	$show = number_format($kfi["target"]);
														// }
														?>
														<?php //  $show 
														?><?php //  $kfi["amountType"] == 1 ? '%' : '' 
															?>
													</div>
												</div>
												<div class="col-lg-1 col-md-6 col-3 pt-10  text-center">

													<?php //  $kfi["code"] 
													?>
												</div>
												<div class="col-lg-3 cl-md-6 col-3">
													<div class="col-12 trophy-con">
														<i class="fa fa-trophy" aria-hidden="true"></i> Result
													</div>
													<div class="col-12 million-number" style="font-weight: 500;">
														<?php
														// if ($kfi["result"] != '') {
														// 	$decimalResult = explode('.', $kfi["result"]);
														// 	if (isset($decimalResult[1])) {
														// 		if ($decimalResult[1] == '00') {
														// 			$showResult = number_format($decimalResult[0]);
														// 		} else {
														// 			$showResult = number_format($kfi["result"], 2);
														// 		}
														// 	} else {
														// 		$showResult = number_format($kfi["result"]);
														// 	}
														// } else {
														// 	$showResult = 0;
														// }
														?>
														<?php //  $showResult 
														?><?php //  $kfi["amountType"] == 1 ? '%' : '' 
															?>
													</div>
												</div>

												<div class="col-lg-1 col-md-6 col-6"></div>
												<div class="col-lg-4 col-md-6 col-6">
													<div class="col-12 padding-update">
														Update Interval
													</div>
													<div class="col-12 update-mouth mt-5">
														<?php //  $kfi["unit"] 
														?>
													</div>
												</div>
												<div class="col-lg-7 col-md-6 col-6 pr-0">
													<div class="col-12 pr-0 pt-8">
														<?php
														// $percent = explode('.', $kfi['ratio']);
														// if (isset($percent[1])) {
														// 	if ($percent[1] != '00') {
														// 		$showPercent = $kfi['ratio'];
														// 	} else {
														// 		$showPercent = $percent[0];
														// 	}
														// } else {
														// 	$showPercent = $percent[0];
														// }
														?>
														<div class="progress">
															<div class="progress-bar" style="width:<?php //  $showPercent 
																					?>%; background:#2F80ED;"></div>
															<span class="badge rounded-pill  pro-load0"><?php //  $showPercent 
																						?>%</span>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-12" style="margin-top:-10px;">
											<div class="row">
												<div class="col-lg-12 text-end pr-0">
													<span data-bs-toggle="modal" data-bs-target="#kfi-issue" onclick="javascript:showKfiComment(<?php // $kfiId 
																											?>)">
														<img src="<?php //  Yii::$app->homeUrl 
																?>image/comment.png" class="comment-ima" style="margin-top: -5px;cursor:pointer;">
													</span>&nbsp;&nbsp;
													<?php
													//if ($role >= 5) {
													?>
														<span class="next-update-span" data-bs-toggle="modal" data-bs-target="#staticBackdrop2" onclick="javascript:updateKfi(<?= $kfiId ?>)">
															<i class="fa fa-pencil-square-o font-size-19" aria-hidden="true"></i>
														</span> &nbsp;
													<?php
													//}
													?>
													<span class="text-primary font-size-12">Next Update</span>
													<strong class="font-size-12 <?php // $kfi['nextCheck'] == "" || $kfi['isOver'] == 1 ? 'text-danger' : '' 
																	?>">
														<php //  $kfi['nextCheck'] == "" ? 'Not set' : $kfi['nextCheck'] ?>
													</strong>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div> -->
                    <?php
						endforeach;
					}
					?>
                </div>
                <!-- </div>
					</div>
				</div>
			</div> -->
            </div>
        </div>
        <input type="hidden" value="create" id="acType">
        <?php $form = ActiveForm::begin([
			'id' => 'create-kfi',
			'method' => 'post',
			'options' => [
				'enctype' => 'multipart/form-data',
			],
			'action' => Yii::$app->homeUrl . 'kfi/management/create-kfi'

		]); ?>
        <?= $this->render('create_modal', [
			"companies" => $companies,
			"units" => $units,
			"months" => $months
		]) ?>
        <?php ActiveForm::end(); ?>
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
        <?= $this->render('delete_modal') ?>
        <?= $this->render('history_modal', [
			"units" => $units,
		]) ?>
        <?= $this->render('issue_modal', [
			"units" => $units,
		]) ?>
        <?= $this->render('issue_modal') ?>
        <?= $this->render('modal_kgi') ?>
    </div>