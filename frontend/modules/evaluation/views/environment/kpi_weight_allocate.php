<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'Weight Allocation';
?>
<div class="col-12 mt-70 environment pt-10 pr-10 pl-20">
	<?php
	$form = ActiveForm::begin([
		'id' => 'save-kpi-weight',
		'method' => 'post',
		'options' => [
			'enctype' => 'multipart/form-data',
		],
		'action' => Yii::$app->homeUrl . 'evaluation/environment/save-kpi-weight-allocate'
	]); ?>
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
							Key Performance Indicator
						</div>
						<div class="col-8 text-end">
							<div class="row">
								<div class="col-6 text-start">
									<a class="btn btn-primary font-size-12 pt-3 pb-3" style="letter-spacing: 0.5px;" href="javascript:checkKpiPercent()">
										<i class="fa fa-floppy-o mr-3" aria-hidden="true"></i>
										APPLY SAVE
									</a>
									<input type="hidden" id="termId" value="<?= $termId ?>" name="termId">
								</div>
								<div class="col-6 text-end">
									<a class="btn btn-info font-size-12 pt-3 pb-3" style="letter-spacing: 0.5px;color:white;">
										<i class="fa fa-th-large mr-3" aria-hidden="true"></i>
										KPI Dashboard
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row pt-30">
					<div class="col-4">
						<div class="col-12">
							<span class="text-danger">*</span><span class="font-size-11">Achievement Target Setup</span>
						</div>
						<div class="col-12 Want-Level">
							Do You Want Level 3 As Default Target ? &nbsp;<input type="radio" name="fruit"><span class="TYPEYES"> YES</span> <span class="pl-3"></span><input type="radio" name="fruit"><span class="TYPEYES"> NO</span>
						</div>
					</div>
					<div class="col-8 pt-5">
						<div class="row">
							<div class="col-10 pr-2">
								<div class="col-12 text-end font-size-10 pr-2">
									Allocate percentage to all the selected
								</div>
								<div class="col-12 text-end font-size-10 pr-2">
									KPI contents to continue
								</div>
							</div>
							<div class="col-2">
								<div class="row">
									<div class="col-7 pr-0 pl-10 text-center">
										<div class="procresscircle_deg pr-0 pl-0 pt-8 text-center">
											<span id="total-weight">
												<?= $totalPercent ?>
											</span>
											%
										</div>
									</div>
									<div class="col-5 text-start pr-0 pl-0">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Wornning-blue.png" class="wb-progress">
									</div>
								</div>
								<input type="hidden" id="sumPercent" value="<?= $totalPercent ?>">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 mt-10">
						<?php
						if (isset($kpiWeight) && count($kpiWeight) > 0) {
						?>
							<table class="table">
								<thead class="text-secondary">
									<tr class="font-size-10 text-center">
										<th></th>
										<th>Kpi</th>
										<th>Target</th>
										<th>Level 1</th>
										<th>Level 2</th>
										<th>Level 3</th>
										<th>Level 4</th>
										<th>Weight</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 0;
									foreach ($kpiWeight as $kpiId => $kpi) :
										if ($kpi["status"] == 1) {
											$checked = 1;
										} else {
											$checked = 0;
										}
									?>
										<input type="hidden" name="kpiIds[]" value="<?= $kpiId ?>">
										<tr style="height: 10px;"></tr>
										<tr>
											<td style="width:50px;" class="pr-10 pl-10">
												<label class="checkbox style-c">
													<input type="checkbox" <?= $checked == 1 ? 'checked' : '' ?> id="kpi-check-<?= $kpiId ?>" name="checkKpi[<?= $kpiId ?>]" onchange="javascript:calculateKpiPercent(<?= $kpiId ?>,2)" value="<?= $kpiId ?>">
													<div class="checkbox__checkmark"></div>
													<div class="checkbox__body"></div>
												</label>
											</td>
											<td style="background-color: #edeaea;" class="font-size-10 text-secondary">
												<?= $kpi['kpiName'] ?>
											</td>
											<td style="background-color: #edeaea;">
												<div class="col-12 border-right pr-12">
													<div class="col-12 text-secondary font-size-10 text-center">
														Target
													</div>
													<div class="col-12 nm_berformat text-secondary mt-5">
														<?= number_format($kpi['target']) ?>
													</div>
												</div>
											</td>
											<td style="background-color: #edeaea;">
												<div class="pr-10">
													<label class="checkbox style-f">
														<input type="checkbox" />
														<div class="checkbox__checkmark"></div>
														<div class="checkbox__body"></div>
													</label>
													<div class="input-group" style="margin-top: -16px;margin-left:5px;">
														<!-- <span class=" input-group-text Level-txt" id="inputGroup-sizing-sm">Level 1</span> -->
														<input type="text" class="form-control Level-txtinput text-end" name="level1[<?= $kpiId ?>]" value="<?= $kpi['level1'] ?>">
													</div>
												</div>
											</td>
											<td style="background-color: #edeaea;">
												<div class="pr-15 pl-15">
													<label class="checkbox style-f">
														<input type="checkbox" />
														<div class="checkbox__checkmark"></div>
														<div class="checkbox__body"></div>
													</label>
													<div class="input-group" style="margin-top: -16px;margin-left:5px;">
														<!-- <span class="input-group-text Level-txt" id="inputGroup-sizing-sm">Level 2</span> -->
														<input type="text" class="form-control Level-txtinput text-end" name="level2[<?= $kpiId ?>]" value="<?= $kpi['level2'] ?>">
													</div>
												</div>
											</td>
											<td style="background-color: #edeaea;">
												<div class="pr-10">
													<label class="checkbox style-f">
														<input type="checkbox" />
														<div class="checkbox__checkmark"></div>
														<div class="checkbox__body"></div>
													</label>
													<div class="input-group" style="margin-top: -16px;margin-left:5px;">
														<!-- <span class="input-group-text Level-txt" id="inputGroup-sizing-sm">Level 3</span> -->
														<input type="text" class="form-control Level-txtinput text-end" name="level3[<?= $kpiId ?>]" value="<?= $kpi['level3'] ?>">
													</div>
												</div>
											</td>
											<td style="background-color: #edeaea;">
												<div class="col-12 pr-10 border-right">
													<label class="checkbox style-f">
														<input type="checkbox" />
														<div class="checkbox__checkmark"></div>
														<div class="checkbox__body"></div>
													</label>
													<div class="input-group" style="margin-top: -16px;margin-left:5px;">
														<!-- <span class="input-group-text Level-txt" id="inputGroup-sizing-sm">Level 4</span> -->
														<input type="text" class="form-control Level-txtinput text-end" name="level4[<?= $kpiId ?>]" value="<?= $kpi['level4'] ?>">
													</div>
												</div>
											</td>
											<td style="background-color: #edeaea;">
												<div class="col-12 pt-5">
													<!-- <img src="<?php // Yii::$app->homeUrl 
																?>images/icons/Dark/48px/setting(Round).png" class="setting_png"> Weight -->
													<input class="weight_round text-end pr-5 pl-5" type="text" value="<?= $kpi['weight'] ?>" id="weight-kpi-<?= $kpiId ?>" name="weight-kpi[<?= $kpiId ?>]" onkeyup="javascript:calculateKpiPercent(<?= $kpiId ?>,1)">
													<span class="font-size-10">%</span>
												</div>
											</td>
										</tr>
									<?php
										$i++;
									endforeach; ?>

								</tbody>
							</table>
						<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php ActiveForm::end(); ?>
</div>