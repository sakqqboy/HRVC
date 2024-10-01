<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'Company KPI History';
?>

<div class="col-12">
	<div class="col-12">
		<img src="<?= Yii::$app->homeUrl ?>images/icons/black-icons/FinancialSystem/Vector.png" class="home-icon mr-5" style="margin-top: -3px;">
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
						<a href="<?= Yii::$app->homeUrl ?>kpi/management/grid" class="mr-5 font-size-12">
							<i class="fa fa-caret-left mr-3" aria-hidden="true"></i>
							Back
						</a>
						<span class="">
							<?= $kpiDetail["kpiName"] ?>
						</span>
					</div>
					<div class="col-6 text-end">

					</div>
				</div>

			</div>
			<div class="row">
				<?php
				if (isset($kpis) && count($kpis) > 0) {
					$i = 0;
					foreach ($kpis as $year => $kpiMonth) :
						foreach ($kpiMonth as $month => $kpi):
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
							<div class="col-lg-4 col-md-6 col-12 ">
								<div class="col-12 mt-10 mb-5 pim-big-box pim-<?= $colorFormat ?> pt-3 pl-15">
									<div class="row">
										<div class="col-5 pim-name"><?= $kpi["month"] ?> <?= $kpi["year"] ?></div>
										<div class="col-7 text-end">
											<?php
											if ($i == 0 && $kpi["status"] == 2 && $role >= 5) {
											?>
												<a class="btn btn-bg-white-xs pr-2 pl-3" onclick="javascript:prepareKpiNextTarget(<?= $kpi['kpiHistoryId'] ?>)">
													<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/copy.png" alt="History" class="home-icon">
												</a>
											<?php
											}
											?>
											<a class="btn btn-bg-white-xs" data-bs-toggle="modal" data-bs-target="#staticBackdrop3" onclick="javascript:kpiHistory(<?= $kpi['kpiHistoryId'] ?>)">
												<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Comment.png" alt="History" class="home-icon">
											</a>
											<a class="btn btn-bg-white-xs" data-bs-toggle="modal" data-bs-target="#staticBackdrop3" onclick="javascript:kpiHistory(<?= $kpi['kpiHistoryId'] ?>)">
												<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Charts.png" alt="History" class="home-icon" style="margin-top: -3px;">
											</a>
											<a href="<?= Yii::$app->homeUrl ?>kpi/view/index/<?= ModelMaster::encodeParams(["kpiHistoryId" => $kpi['kpiHistoryId']]) ?>" class="btn btn-bg-white-xs">
												<i class="fa fa-eye" aria-hidden="true"></i>
											</a>
											<?php
											//if ($role >= 5) {
											?>
											<!-- <a class="btn btn-xs btn-outline-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop4" onclick="javascript:prepareDeleteKpi(<?php // $kpi['kpiHistoryId'] 
																															?>)">
													<i class="fa fa-trash-o" aria-hidden="true"></i>
												</a> -->
											<?php
											//}
											?>
										</div>
										<div class="col-9 mt-10 pl-28">
											<div class="row">
												<div class="col-4 month-<?= $colorFormat ?> pt-2">Term</div>
												<div class="col-8 term-<?= $colorFormat ?>  pt-2">
													<?= $kpi['fromDate'] == "" ? 'Not set' : $kpi['fromDate'] ?> -
													<?= $kpi['toDate'] == "" ? 'Not set' : $kpi['toDate'] ?>
												</div>
											</div>
										</div>
										<div class="col-3 mt-10">
											<div class="<?= $colorFormat ?>-tag text-center">
												<?= $kpi['status'] == 1 ? 'In process' : 'Completed' ?>
											</div>
										</div>
										<div class="col-9  pl-15 pr-20 mt-5">
											<div class="col-12 text-start pl-5 font-size-10">
												Assign on
											</div>
											<div class="col-12 <?= $colorFormat ?>-assign pt-2 pb-2">
												<div class="row">
													<div class="col-5 border-right-<?= $colorFormat ?> pl-10">
														<div class="row">
															<div class="col-2">
																<?php
																if (isset($kpi['kpiEmployee'][0])) {
																?>
																	<img src="<?= Yii::$app->homeUrl . $kpi['kpiEmployee'][0] ?>" class="pim-pic-grid">
																<?php
																}
																?>
															</div>
															<div class="col-2 pic-after pt-0">
																<?php
																if (isset($kpi['kpiEmployee'][1])) {
																?>
																	<img src="<?= Yii::$app->homeUrl . $kpi['kpiEmployee'][1] ?>" class="pim-pic-grid">
																<?php
																}
																?>
															</div>
															<div class="col-2 pic-after pt-0">
																<?php
																if (isset($kpi['kpiEmployee'][2])) {
																?>
																	<img src="<?= Yii::$app->homeUrl . $kpi['kpiEmployee'][2] ?>" class="pim-pic-grid">
																<?php
																}
																?>
															</div>
															<div class="col-7 number-tag load-<?= $colorFormat ?> pr-0 pl-0 pt-3" style="margin-left: -3px;height:22px;width: 30px;margin-top: 1px;">
																<?= $kpi["employee"] ?>
															</div>
														</div>
													</div>
													<div class="col-7 pl-5 pt-3">
														Assigned Person
													</div>
												</div>
											</div>
											<div class="col-12 <?= $colorFormat ?>-assign pt-5 pb-2 mt-10">
												<div class="row">
													<div class="col-5 border-right-<?= $colorFormat ?> pr-2">
														<div class="row">
															<div class="col-4">
																<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-<?= $colorFormat ?>.png" class="first-layer-icon" style="margin-top: -4px;">
															</div>
															<div class="col-5 number-tag load-<?= $colorFormat ?> pr-3 pl-3 pt-3" style="height:22px;">
																<?= $kpi["countTeam"] ?>
															</div>
														</div>
													</div>
													<div class="col-6 pl-5 font-<?= $colorFormat ?>">
														Assigned Team
													</div>
												</div>
											</div>
										</div>
										<div class="col-3 font-size-10 pt-15">
											<div class="col-12">Quant Ratio</div>
											<div class="col-12 font-size-9  border-bottom pb-3">
												<i class="fa fa-diamond" aria-hidden="true"></i><b><?= $kpi["quantRatio"] == 1 ? 'Quantity' : 'Quality' ?></b>
											</div>
											<div class="col-12 pr-0 mt-2">update Interval</div>
											<div class="col-12"><b>
													<?= $kpi["unit"] ?>
												</b>
											</div>
										</div>
										<div class="col-12 mt-10">
											<div class="row">
												<div class="col-5 text-start pl-20">
													<div class="col-12 font-size-10">
														<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Achievement.png" alt="History" class="home-icon" style="margin-top: -3px;margin-left:-5px;">
														Target
													</div>
													<div class="col-12 number-pim">
														<?php
														$decimal = explode('.', $kpi["target"]);
														if (isset($decimal[1])) {
															if ($decimal[1] == '00') {
																$show = number_format($decimal[0]);
															} else {
																$show = number_format($kpi["target"], 2);
															}
														} else {
															$show = number_format($kpi["target"]);
														}
														?>
														<b><?= $show ?><?= $kpi["amountType"] == 1 ? '%' : '' ?></b>
													</div>
												</div>
												<div class="col-2 symbol-pim text-center">
													<div class="col-12 pt-13 font-size-12"><?= $kpi["code"] ?></div>
												</div>
												<div class="col-5 text-end pr-20">
													<div class="col-12 font-size-10">Result
														<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Achievement.png" alt="History" class="home-icon" style="margin-top: -3px;margin-left:2px;">
													</div>
													<div class="col-12 number-pim">
														<?php
														if ($kpi["result"] != '') {
															$decimalResult = explode('.', $kpi["result"]);
															if (isset($decimalResult[1])) {
																if ($decimalResult[1] == '00') {
																	$showResult = number_format($decimalResult[0]);
																} else {
																	$showResult = number_format($kpi["result"], 2);
																}
															} else {
																$showResult = number_format($kpi["result"]);
															}
														} else {
															$showResult = 0;
														}
														?>
														<b><?= $showResult ?><?= $kpi["amountType"] == 1 ? '%' : '' ?></b>

													</div>
												</div>
												<div class="col-12 pl-20 pr-20 pb-8">
													<?php
													$percent = explode('.', $kpi['ratio']);
													if (isset($percent[1])) {
														if ($percent[1] != '00') {
															//$showPercent = $kpi['ratio'];
															$showPercent = $percent[1];
														} else {
															$showPercent = $percent[0];
														}
													} else {
														$showPercent = $percent[0];
													}
													?>
													<div class="progress">
														<div class="progress-bar-<?= $colorFormat ?>" style="width:<?= $showPercent ?>%;"></div>
														<span class="progress-load load-<?= $colorFormat ?>"><?= $showPercent ?>%</span>
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