<?php

use common\models\ModelMaster;

$this->title = 'Weight Allocation';
?>
<div class="col-12 mt-70 environment pt-10 pr-10 pl-20">
	<div class="row">
		<div class="col-2 pr-0 pl-5">
			<?= $this->render('menu_left', [
				"terms" => $terms,
				"environmentDetail" => $environmentDetail,
				"frameName" => $frameName,
				"termId" => $termId
			]) ?>
		</div>
		<div class="col-lg-10 col-md-6 col-12 environment">
			<div class="bg-white pmi_bakgru">
				<div class="col-12">
					<div class="row">
						<div class="col-3 FrameEvaluation">
							PIM Weight Allocation
						</div>
						<div class="col-2">
							<a href="<?= Yii::$app->homeUrl ?>evaluation/environment/weight-allocate-setting/<?= ModelMaster::encodeParams(["termId" => $termId]) ?>" class="btn btn-primary no-underline font-size-12 pt-3 pb-3"> Allocate Weight</a>
						</div>
						<div class="col-7 text-end">
							<div type="submit" class="btn btn-info Next-1 pt-4 pb-4"> Next <i class="fa fa-angle-double-right" aria-hidden="true"></i></div>
						</div>
					</div>
				</div>
				<div class="col-12 font-size-13 font-weight-500 mt-10">
					Accounts & Taxation
				</div>
				<div class="row">
					<div class="col-lg-1 col-md-6 col-12 pr-0 pl-0">
						<div class="Evalua_tor1 pb-30 mt-10 pr-5 pl-5">
							<?php
							$totalPercent = $pimTerm["kfi"] + $pimTerm["kgi"] + $pimTerm["kpi"];
							?>
							<div class="col-12 text_PIM">
								PIM
							</div>

							<div class="col-12 mt-10">
								<div id="progress1">
									<div data-num="<?= $totalPercent ?>" id="data-total-percent" class="progress-item1" data-value="85%" style="background: conic-gradient(rgb(41, 140, 233) calc(35%), rgb(219, 239, 247) 0deg);width: 40px;height:40px;">
										<span id="totalPercent"><?= $totalPercent ?>%</span>
									</div>
								</div>
							</div>
							<div class="white-kfi3  pt-20 pr-3 pl-3">
								<div class="col-12 text-center">
									<input class="form-check-input checkbox-md" type="checkbox" value="" id="check-kfi" onchange="javascript:showEvaluationDetail('kfi')" checked>
								</div>
								<div class="col-12">
									<div class="bg-chartpurple" style="cursor: pointer;" onclick="javascript:showModalWeight('KFI')">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/Charts.png" class="icons-KGI">
										<div class="font-size-10 text-white font-b"> KFI</div>
										<div class="font-size-10 text-white font-b"><span id="kfi-d-weight"><?= $pimTerm["kfi"] ?></span>%</div>
										<input type="hidden" value="<?= $pimTerm["kfi"] ?>" name="kfiWeight" id="kfiWeight">
									</div>
								</div>
								<div class="col-12 mt-20 text-center">
									<input class="form-check-input checkbox-md" type="checkbox" value="" id="check-kgi" onchange="javascript:showEvaluationDetail('kgi')">
								</div>
								<div class="col-12">
									<div class="bg-chartwarn" style="cursor: pointer;" onclick="javascript:showModalWeight('KGI')">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/KGI.png" class="icons-KGI">
										<div class="font-size-10 text-white font-b"> KGI</div>
										<div class="font-size-10 text-white font-b"><span id="kgi-d-weight"><?= $pimTerm["kgi"] ?></span>%</div>
										<input type="hidden" value="<?= $pimTerm["kgi"] ?>" name="kgiWeight" id="kgiWeight">
									</div>
								</div>
								<div class="col-12 mt-20 text-center">
									<input class="form-check-input checkbox-md" type="checkbox" value="" id="check-kpi" onchange="javascript:showEvaluationDetail('kpi')">
								</div>
								<div class="col-12">
									<div class="bg-cha" style="cursor: pointer;" onclick="javascript:showModalWeight('KPI')">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/KPI.png" class="icons-KGI">
										<div class="font-size-10 text-white font-b"> KPI</div>
										<div class="font-size-10 text-white font-b"><span id="kpi-d-weight"><?= $pimTerm["kpi"] ?></span>%</div>
										<input type="hidden" value="<?= $pimTerm["kpi"] ?>" name="kpiWeight" id="kpiWeight">
									</div>
								</div>
								<input type="hidden" value="<?= $pimTerm["pimWeightId"] ?>" name="pimWeightId" id="pimWeightId">
							</div>
						</div>
					</div>
					<div class="col-lg-9 col-md-6 col-12">
						<div class="Evalua_tor2 silly_scrollbar pr-10 pl-10 pt-10 mt-10">
							<div class="silly_evaluator mb-20" id="kfi">
								<div class="row pl-15 pr-15 pt-10">
									<div class="col-6 flagkey">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/KPI.png" class="icons-KGI2"> Key Financial Indicator
									</div>
									<div class="col-6 text-end">
										<span class="flagkey mr-10 ">
											Participants
										</span>
										<span class="badge rounded-pill bg-gray pt-2 pb-2">
											<ul class="try-cricle">
												<?php
												if (isset($pimEmployee) && count($pimEmployee) > 0) {
													$i = 1;
													foreach ($pimEmployee as $emId => $em) :
														if ($i <= 3) {
												?>
															<li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?><?= $em['picture'] ?>" class="image-avatar1"></li>
												<?php
														} else {
															break;
														}
														$i++;
													endforeach;
												}
												?>
												<a href="" class="none">
													<li class="number_user"> <?= count($pimEmployee) ?> </li>
												</a>
											</ul>
										</span>
									</div>
									<hr class="mt-5 mb-0">
								</div>
								<div class="row pl-15 pr-15 pb-20 mt-5 pt-0" id="kfi-eva">
									<?php
									if (isset($masterKfi) && count($masterKfi) > 0) {
										foreach ($masterKfi as $kfi) :
									?>
											<div class="col-2">
												<div class="card font-size-12 mt-5 mb-5 pt-0 pr-0 pl-0" style="border-color:#E2E2E2;">
													<div class="fonTotal text-center  pt-3 pb-3"><?= $kfi["kfiName"] ?></div>
													<div class="col-12 text-center ">
														<span class="badge bg-lighttotal">
															<?= number_format($kfi["target"] / 1000) ?>k
														</span>
													</div>
													<div class="col-12 text-center pt-5 pb-5 Blueformat">
														<?= number_format($kfi["weight"]) ?>%
													</div>
												</div>
											</div>
										<?php
										endforeach;
									} else { ?>
										<div class="col-12 text-center font-size-13 mt-10">
											Please click "Allocate Weight" to set Weight Allocation
										</div>
									<?php
									}
									?>
								</div>
							</div>
							<div class="silly_evaluator mb-20" id="kgi" style="display:none;">
								<div class="row pl-15 pr-15 pt-10">
									<div class="col-6 flagkey">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/KGI.png" class="icons-KGI2"> Key Goal Indicator
									</div>

									<div class="col-6 text-end pr-0">
										<span class="flagkey mr-10 ">
											Participants
										</span>
										<span class="badge rounded-pill bg-gray pt-2 pb-2">
											<ul class="try-cricle">
												<?php
												if (isset($pimEmployee) && count($pimEmployee) > 0) {
													$i = 1;
													foreach ($pimEmployee as $emId => $em) :
														if ($i <= 3) {
												?>
															<li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?><?= $em['picture'] ?>" class="image-avatar<?= $i ?>"></li>
												<?php
														} else {
															break;
														}
														$i++;
													endforeach;
												}
												?>
												<a href="" class="">
													<li class="number_user"> <?= count($pimEmployee) ?> </li>
												</a>
											</ul>
										</span>
									</div>
									<hr class="mt-5 mb-0">
								</div>
								<div class="row pl-15 pr-15 pb-20 mt-5 pt-0" id="kgi-eva">
									<?php
									if (isset($masterKgi) && count($masterKgi) > 0) {
										foreach ($masterKgi as $kgi) :
									?>
											<div class="col-2">
												<div class="card font-size-12 mt-5 mb-5 pt-0 pr-0 pl-0" style="border-color:#E2E2E2;">
													<div class="fonTotal text-center  pt-3 pb-3"><?= $kgi["kgiName"] ?></div>
													<div class="col-12 text-center ">
														<span class="badge bg-lighttotal">
															<?= number_format($kgi["target"] / 1000) ?>k
														</span>
													</div>
													<div class="col-12 text-center pt-5 pb-5 Blueformat">
														<?= number_format($kgi["weight"]) ?>%
													</div>
												</div>
											</div>
										<?php
										endforeach;
									} else { ?>
										<div class="col-12 text-center font-size-13 mt-10">
											Please click "Allocate Weight" to set Weight Allocation
										</div>
									<?php
									}
									?>
								</div>
							</div>
							<div class="silly_evaluator mb-20" id="kpi" style="display:none;">
								<div class="row pl-15 pr-15 pt-10">
									<div class="col-6 flagkey">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/KPI.png" class="icons-KGI2"> Key Performance Indicator
									</div>
									<div class="col-6 text-end">
										<span class="flagkey mr-10 ">
											Participants
										</span>
										<span class="badge rounded-pill bg-gray pt-2 pb-2">
											<ul class="try-cricle">
												<?php
												if (isset($pimEmployee) && count($pimEmployee) > 0) {
													$i = 1;
													foreach ($pimEmployee as $emId => $em) :
														if ($i <= 3) {
												?>
															<li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?><?= $em['picture'] ?>" class="image-avatar<?= $i ?>"></li>
												<?php
														} else {
															break;
														}
														$i++;
													endforeach;
												}
												?>
												<a href="" class="none">
													<li class="number_user"> <?= count($pimEmployee) ?> </li>
												</a>
											</ul>
										</span>
									</div>
									<hr class="mt-5 mb-0">
								</div>
								<div class="row pl-15 pr-15 pb-20 mt-5 pt-0" id="kpi-eva">
									<?php
									if (isset($masterKpi) && count($masterKpi) > 0) {
										foreach ($masterKpi as $kpi) :
									?>
											<div class="col-2">
												<div class="card font-size-12 mt-5 mb-5 pt-0 pr-0 pl-0" style="border-color:#E2E2E2;">
													<div class="fonTotal text-center  pt-3 pb-3"><?= $kpi["kpiName"] ?></div>
													<div class="col-12 text-center ">
														<span class="badge bg-lighttotal">
															<?= number_format($kpi["target"] / 1000) ?>k
														</span>
													</div>
													<div class="col-12 text-center pt-5 pb-5 Blueformat">
														<?= number_format($kpi["weight"]) ?>%
													</div>
												</div>
											</div>
										<?php
										endforeach;
									} else { ?>
										<div class="col-12 text-center font-size-13 mt-10">
											Please click "Allocate Weight" to set Weight Allocation
										</div>
									<?php
									}
									?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-2 col-md-6 col-12 pr-0 pl-0" style="margin-top: -16px;">
						<div class="col-12 txt-Weight">
							<img src="<?= Yii::$app->homeUrl ?>image/weight.png" class="image-weight"> Weight Configurations
						</div>
						<div class="col-12 Evalua_tor3 mt-11">
							<div class="col-12 background_E7F0FE pt-3 pl-10 pr-10 pb-20">
								<?php
								for ($i = 1; $i <= 13; $i++) {
								?>
									<div class="bg-white mt-10 pr-3 pl-3" style="border-radius: 2px;">
										<div class="row">
											<div class="col-7 border-edit">
												Internal
											</div>
											<div class="col-5">
												<i class="fa fa-pencil-square-o weight-pencil" aria-hidden="true"></i> <i class="fa fa-trash weight-trash" aria-hidden="true"></i>
											</div>
										</div>
									</div>
								<?php
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->render('modal_set_pim_weight') ?>