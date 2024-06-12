<?php

use common\models\ModelMaster;

$this->title = 'Weight Allocation';
?>
<div class="col-4 alert-box2 text-center mt-40">
	Saved
</div>
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
						<div class="col-4 FrameEvaluation">
							PIM Weight Allocation
						</div>
						<div class="col-8 FrameEvaluation pl-10 text-end" id="employee-name">
						</div>
						<!-- <div class="col-4 text-end">
							<a class="btn btn-primary font-size-12 pt-3 pb-3" style="letter-spacing: 0.5px;" href="javascript:saveEmployeePim(<?php // $termId 
																								?>)">
								<i class="fa fa-floppy-o mr-3" aria-hidden="true"></i>
								SAVE
							</a>
						</div> -->

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
										<!-- <input type="checkbox" id="check-title-<?php //str_replace(' ', '', $titleName) 
																	?>" name="title['<?php // $titleName 
																				?>']" onchange="javascript:checkAllEmployee('<?php // $titleName 
																											?>')"> -->
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Rank-1.png" style="width:15px;">
										<span class="font-b font-size-13" style="margin-left: -5px;">
											<?= $titleName ?>
										</span>
									</div>
									<?php
									if (isset($employeeTitle) && count($employeeTitle) > 0) {
										foreach ($employeeTitle as $employeeId => $employee) :
											$name = $employee["firstName"] . ' ' . $employee["sureName"];
											$checked = '';

											if ($employee["isInPim"] == 1) {
												$checked = "checked";
											}
									?>
											<div class="col-12 font-size-11 pl-15 pr-1 pb-3 pt-5 border-bottom" id="select-employee-<?= $employeeId ?>" style="cursor:pointer;" onclick="javascript:selectEmployeePim(<?= $employeeId ?>,<?= $termId ?>)">
												<!-- <input type="radio" class=" mr-3" style="width: 12px;height:12px;" id="employee-<?php // $employeeId 
																									?>" name="pimEmployee[]" value="<?php // $employeeId 
																														?>" <?php // $checked 
																															?>> -->
												<img src="<?= Yii::$app->homeUrl ?><?= $employee['picture'] ?>" class="Log_name" style="margin-top:-5px;">
												<?= $employee["firstName"] ?> <?= $employee["sureName"] ?>
												<input type="hidden" value="<?= $name ?>" id="e-name-<?= $employeeId ?>">
											</div>
							<?php
										endforeach;
									}
								endforeach;
							}
							?>
							<input type="hidden" id="current-select" value="">
						</div>
					</div>
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
									<div data-num="0" id="totalPercent" class="progress-item1 " data-value="0%" style="background: conic-gradient(rgb(41, 140, 233) calc(0%), rgb(219, 239, 247) 0deg);width: 40px;height:40px;">

									</div>
								</div>
							</div>
							<div class="white-kfi3  pt-20 pr-3 pl-3">
								<!-- <div class="col-12 text-center">
									<input class="form-check-input checkbox-md" type="checkbox" value="" id="check-kfi" onchange="javascript:showEvaluationDetail('kfi')" checked>
								</div> -->
								<div class="col-12">
									<div class="bg-chartpurple" onclick="javascript:showModalWeight('KFI')" style="cursor: pointer;">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/Charts.png" class="icons-KGI">
										<div class="font-size-10 text-white font-b"> KFI</div>
										<div class="font-size-10 text-white font-b" id="kfi-weight">-</div>
										<input type="hidden" value="" name="kfiWeight" id="kfiWeight">
									</div>
								</div>
								<!-- <div class="col-12 mt-20 text-center">
									<input class="form-check-input checkbox-md" type="checkbox" value="" id="check-kgi" onchange="javascript:showEvaluationDetail('kgi')">
								</div> -->
								<div class="col-12 mt-25">
									<div class="bg-chartwarn" onclick="javascript:showModalWeight('KGI')" style="cursor: pointer;">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/KGI.png" class="icons-KGI">
										<div class="font-size-10 text-white font-b"> KGI</div>
										<div class="font-size-10 text-white font-b" id="kgi-weight">-</div>
										<input type="hidden" value="" name="kgiWeight" id="kgiWeight">
									</div>
								</div>
								<!-- <div class="col-12 mt-20 text-center">
									<input class="form-check-input checkbox-md" type="checkbox" value="" id="check-kpi" onchange="javascript:showEvaluationDetail('kpi')">
								</div> -->
								<div class="col-12 mt-25">
									<div class="bg-cha" onclick="javascript:showModalWeight('KPI')" style="cursor: pointer;">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Light/Light/48px/KPI.png" class="icons-KGI">
										<div class="font-size-10 text-white font-b"> KPI</div>
										<div class="font-size-10 text-white font-b" id="kpi-weight">-</div>
										<input type="hidden" value="" name="kpiWeight" id="kpiWeight">
									</div>
								</div>
								<input type="hidden" value="" name="" id="employeePimWeightId">
								<input type="hidden" value="<?= $pimTerm["pimWeightId"] ?>" name="pimWeightId" id="pimWeightId">
							</div>
						</div>
					</div>
					<div class="col-lg-8 col-md-6 col-12">
						<div class="Evalua_tor2 silly_scrollbar pr-10 pl-10 pt-10 mt-10" id="all-employee-pim">
							<div class="col-12 text-center font-size-12">Select an employee</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->render('modal_set_pim_weight') ?>