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
						<div class="col-6 FrameEvaluation">
							PIM Weight Allocation
						</div>
						<div class="col-6 text-end">
							<a class="btn btn-primary font-size-12 pt-3 pb-3" style="letter-spacing: 0.5px;">
								<i class="fa fa-floppy-o mr-3" aria-hidden="true"></i>
								SAVE
							</a>
						</div>
					</div>
				</div>
				<div class="row mt-5">
					<div class="col-lg-3 col-md-6 col-12" style="margin-top: -16px;">
						<div class="col-12 Evalua_tor3 mt-25">
							<?php
							if (isset($employees) && count($employees) > 0) {
								foreach ($employees as $titleName => $employeeTitle) :
							?>
									<div class="col-12 pt-10 mb-5">
										<input type="checkbox" id="check-title-<?= $titleName ?>">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Rank-1.png" style="width:15px;">
										<span class="font-b font-size-13" style="margin-left: -5px;">
											<?= $titleName ?>
										</span>
									</div>
									<?php
									if (isset($employeeTitle) && count($employeeTitle) > 0) {
										foreach ($employeeTitle as $employeeId => $employee) :
									?>
											<div class="col-12 font-size-11 pl-15 pr-1 pb-3 mb-8 border-bottom" id="select-employee-<?= $employeeId ?>">
												<input type="checkbox" class="checkbox-sm mr-3" style="width: 12px;height:12px;">
												<img src="<?= Yii::$app->homeUrl ?><?= $employee['picture'] ?>" class="Log_name" style="margin-top:-5px;">
												<?= $employee["firstName"] ?> <?= $employee["sureName"] ?>
											</div>
							<?php
										endforeach;
									}
								endforeach;
							}
							?>
						</div>
					</div>
					<div class="col-lg-1 col-md-6 col-12 pr-0 pl-0">
						<div class="Evalua_tor1 pb-30 mt-10 pr-5 pl-5">
							<div class="col-12 text_PIM">
								PIM
							</div>
							<div class="col-12 mt-10">
								<div id="progress1">
									<div data-num="85" class="progress-item1 " data-value="85%" style="background: conic-gradient(rgb(41, 140, 233) calc(35%), rgb(219, 239, 247) 0deg);width: 40px;height:40px;">85%</div>
								</div>
							</div>
							<div class="white-kfi3  pt-20 pr-3 pl-3">
								<div class="col-12 text-center">
									<input class="form-check-input checkbox-md" type="checkbox" value="" id="check-kfi" onchange="javascript:showEvaluationDetail('kfi')" checked>
								</div>
								<div class="col-12">
									<div class="bg-chartpurple">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/Charts.png" class="icons-KGI">
										<div class="font-size-10 text-white font-b"> KFI</div>
										<div class="font-size-10 text-white font-b"><?= $pimTerm["kfi"] ?>%</div>
									</div>
								</div>
								<div class="col-12 mt-20 text-center">
									<input class="form-check-input checkbox-md" type="checkbox" value="" id="check-kgi" onchange="javascript:showEvaluationDetail('kgi')">
								</div>
								<div class="col-12">
									<div class="bg-chartwarn">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/KGI.png" class="icons-KGI">
										<div class="font-size-10 text-white font-b"> KGI</div>
										<div class="font-size-10 text-white font-b"><?= $pimTerm["kgi"] ?>%</div>
									</div>
								</div>
								<div class="col-12 mt-20 text-center">
									<input class="form-check-input checkbox-md" type="checkbox" value="" id="check-kpi" onchange="javascript:showEvaluationDetail('kpi')">
								</div>
								<div class="col-12">
									<div class="bg-cha">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/KPI.png" class="icons-KGI">
										<div class="font-size-10 text-white font-b"> KPI</div>
										<div class="font-size-10 text-white font-b"><?= $pimTerm["kpi"] ?>%</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-8 col-md-6 col-12">
						<div class="Evalua_tor2 silly_scrollbar pr-10 pl-10 pt-10 mt-10">
							<div class="silly_evaluator mb-20" id="kfi">
								<div class="row pl-15 pr-15 pt-10">
									<div class="col-7 flagkey">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/KPI.png" class="icons-KGI2"> Key Financial Indicator
										<span>
											<a href="<?= Yii::$app->homeUrl ?>evaluation/environment/kfi-weight-allocate/<?= ModelMaster::encodeParams(['termId' => $termId]) ?>" class="font-size-10 btn btn-primary mr-10 ml-10 pt-3 pb-3 pr-5 pl-5">
												<i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>
												ADD
											</a>
											<a class="font-size-10 btn btn-danger pt-3 pb-3 pr-5 pl-5">
												<i class="fa fa-pencil-square-o mr-3" aria-hidden="true"></i>
												EDIT
											</a>
										</span>
									</div>
									<div class="col-5 text-end">
										<span class="flagkey mr-10">
											Participants
										</span>
										<span class="badge rounded-pill bg-gray pt-2 pb-2">
											<ul class="try-cricle">
												<li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1"></li>
												<li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="image-avatar2"></li>
												<a href="" class="none">
													<li class="number_user"> 2 </li>
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
													<div class="fonTotal text-center  pt-3 pb-3"><?= $kfi["target"] ?></div>
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
											Please click "ADD" to set KFI
										</div>
									<?php
									}
									?>
								</div>
							</div>
							<div class="silly_evaluator mb-20" id="kgi" style="display:none;">
								<div class="row pl-15 pr-15 pt-10">
									<div class="col-7 flagkey">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/KGI.png" class="icons-KGI2"> Key Goal Indicator
										<span>
											<a href="<?= Yii::$app->homeUrl ?>evaluation/environmen/kgi-weight-allocate/<?= ModelMaster::encodeParams(['termId' => $termId]) ?>" class="font-size-10 btn btn-primary mr-10 ml-10 pt-3 pb-3 pr-5 pl-5">
												<i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>
												ADD
											</a>
											<a class="font-size-10 btn btn-danger pt-3 pb-3 pr-3 pl-3">
												<i class="fa fa-pencil-square-o mr-3" aria-hidden="true"></i>
												EDIT</a>
										</span>
									</div>
									<div class="col-5 text-end">
										<span class="flagkey mr-10 ">
											Participants
										</span>
										<span class="badge rounded-pill bg-gray pt-2 pb-2">
											<ul class="try-cricle">
												<li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1"></li>
												<li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="image-avatar2"></li>
												<a href="" class="">
													<li class="number_user"> 99 </li>
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
											Please click "ADD" to set KGI
										</div>
									<?php
									}
									?>
								</div>
							</div>
							<div class="silly_evaluator mb-20" id="kpi" style="display:none;">
								<div class="row pl-15 pr-15 pt-10">
									<div class="col-7 flagkey">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/KPI.png" class="icons-KGI2"> Key Performance Indicator
										<span>
											<a href="<?= Yii::$app->homeUrl ?>evaluation/environmen/kpi-weight-allocate/<?= ModelMaster::encodeParams(['termId' => $termId]) ?>" class="font-size-10 btn btn-primary mr-10 ml-10 pt-3 pb-3 pr-5 pl-5">
												<i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>
												ADD
											</a>
											<a class="font-size-10 btn btn-danger pt-3 pb-3 pr-5 pl-5">
												<i class="fa fa-pencil-square-o mr-3" aria-hidden="true"></i>
												EDIT</a>
										</span>
									</div>
									<div class="col-5 text-end">
										<span class="flagkey mr-10 ">
											Participants
										</span>
										<span class="badge rounded-pill bg-gray pt-2 pb-2">
											<ul class="try-cricle">
												<li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1"></li>
												<li class="tri-li"> <img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="image-avatar2"></li>
												<a href="" class="none">
													<li class="number_user"> 2 </li>
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
											Please click "ADD" to set KPI
										</div>
									<?php
									}
									?>
									<!-- <div class="col-12" style="position: static;">
										<div class="col-12 holder"></div>
									</div> -->
								</div>

							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>