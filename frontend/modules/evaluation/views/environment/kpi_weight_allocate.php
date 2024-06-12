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
					<div class="col-12 pt-5 pr-0">
						<div class="row">
							<div class="col-12">
								<div class="row">
									<div class="col-10">
										<div class="col-12 text-end font-size-10">
											Allocate percentage to all the selected
										</div>
										<div class="col-12 text-end font-size-10">
											KPI contents to continue
										</div>
									</div>
									<div class="col-1 pr-5">
										<div class="procresscircle_deg pr-0 pl-0 pt-8 text-center" style="float: right;">
											<span id="total-weight">
												<?= $totalPercent ?>
											</span>
											%
										</div>
									</div>
									<div class="col-1 pl-0 text-center">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Wornning-blue.png" class="wb-progress">
									</div>
								</div>
								<input type="hidden" id="sumPercent" value="<?= $totalPercent ?>">
								<input type="hidden" id="sumPercentTeam" value="<?= $totalPercentTeam ?>">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 mt-10">

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
								if (isset($kpiTeamWeight) && count($kpiTeamWeight) > 0) {
									$i = 0;
								?>
									<tr>
										<td colspan="8" class="font-size-12 font-weight-500">
											Team KPI
										</td>
									</tr>
									<?php
									foreach ($kpiTeamWeight as $kpiTeamId => $kpi) :
										if ($kpi["status"] == 1) {
											$checked = 1;
										} else {
											$checked = 0;
										}
									?>
										<input type="hidden" name="kpiIdsTeam[<?= $kpiTeamId ?>]" value="<?= $kpi['kpiId'] ?>">
										<input type="hidden" name="kpiTeamIds[]" value="<?= $kpiTeamId ?>">
										<tr style="height: 10px;"></tr>
										<tr>
											<td style="width:50px;" class="pr-10 pl-10">
												<label class="checkbox style-c">
													<input type="checkbox" <?= $checked == 1 ? 'checked' : '' ?> id="kpi-check-team-<?= $kpiTeamId ?>" name="checkKpiTeam[<?= $kpiTeamId ?>]" onchange="javascript:calculateKpiTeamPercent(<?= $kpiTeamId ?>,2)" value="<?= $kpiTeamId ?>">
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
											<td style="background-color: #edeaea;" class="border-right">
												<div class="row pl-7">
													<div class="col-5  pr-1 pl-2">
														<input type="text" class="Level-txtinput form-control text-end pr-1 pl-1" name="level1Team[<?= $kpiTeamId ?>]" value="<?= $kpi['level1'] ?>">
													</div>
													<div class="col-1  pr-0 pl-0 text-center">-</div>
													<div class="col-5  pr-1 pl-2">
														<input type="text" class="Level-txtinput form-control  text-end pr-1 pl-1" name="level1EndTeam[<?= $kpiTeamId ?>]" value="<?= $kpi['level1End'] ?>">
													</div>
												</div>
											</td>
											<td style="background-color: #edeaea;" class="border-right">
												<div class="row pl-7">
													<div class="col-5  pr-1 pl-2">
														<input type="text" class="Level-txtinput form-control text-end pr-1 pl-1" name="level2Team[<?= $kpiTeamId ?>]" value="<?= $kpi['level2'] ?>">
													</div>
													<div class="col-1  pr-0 pl-0 text-center">-
													</div>
													<div class="col-5  pr-1 pl-2">
														<input type="text" class="Level-txtinput form-control  text-end pr-1 pl-1" name="level2EndTeam[<?= $kpiTeamId ?>]" value="<?= $kpi['level2End'] ?>">
													</div>
											</td>
											<td style="background-color: #edeaea;" class="border-right">
												<div class="row pl-7">
													<div class="col-5  pr-1 pl-2">
														<input type="text" class="Level-txtinput form-control text-end pr-1 pl-1" name="level3Team[<?= $kpiTeamId ?>]" value="<?= $kpi['level3'] ?>">
													</div>
													<div class="col-1  pr-0 pl-0 text-center">-</div>
													<div class="col-5  pr-1 pl-2">
														<input type="text" class="Level-txtinput form-control  text-end pr-1 pl-1" name="level3EndTeam[<?= $kpiTeamId ?>]" value="<?= $kpi['level3End'] ?>">
													</div>
												</div>
											</td>
											<td style="background-color: #edeaea;" class="border-right">
												<div class="row pl-7">
													<div class="col-5  pr-1 pl-2">
														<input type="text" class="Level-txtinput form-control text-end pr-1 pl-1" name="level4Team[<?= $kpiTeamId ?>]" value="<?= $kpi['level4'] ?>">
													</div>
													<div class="col-1  pr-0 pl-0 text-center">-</div>
													<div class="col-5  pr-1 pl-2">
														<input type="text" class="Level-txtinput form-control  text-end pr-1 pl-1" name="level4EndTeam[<?= $kpiTeamId ?>]" value="<?= $kpi['level4End'] ?>">
													</div>
												</div>
											</td>
											<td style="background-color: #edeaea;">
												<div class="col-12 pt-5">
													<!-- <img src="<?php // Yii::$app->homeUrl 
																?>images/icons/Dark/48px/setting(Round).png" class="setting_png"> Weight -->
													<input class="weight_round text-end pr-5 pl-5" type="text" value="<?= $kpi['weight'] ?>" id="weight-kpi-team-<?= $kpiTeamId ?>" name="weight-kpi-team[<?= $kpiTeamId ?>]" onkeyup="javascript:calculateKpiTeamPercent(<?= $kpiTeamId ?>,1)">
													<span class="font-size-10">%</span>
												</div>
											</td>
										</tr>
									<?php
										$i++;
									endforeach;
								}
								if (isset($kpiWeight) && count($kpiWeight) > 0) {
									?>
									<tr>
										<td colspan="8" class="font-size-12 font-weight-500">
											Indevidual KPI
										</td>
									</tr>
									<?php
									$i = 0;
									foreach ($kpiWeight as $kpiEmployeeId => $kpi) :
										if ($kpi["status"] == 1) {
											$checked = 1;
										} else {
											$checked = 0;
										}
									?>
										<input type="hidden" name="kpiIds[<?= $kpiEmployeeId ?>]" value="<?= $kpi['kpiId'] ?>">
										<input type="hidden" name="kpiEmployeeIds[]" value="<?= $kpiEmployeeId ?>">
										<tr style="height: 10px;"></tr>
										<tr>
											<td style="width:50px;" class="pr-10 pl-10">
												<label class="checkbox style-c">
													<input type="checkbox" <?= $checked == 1 ? 'checked' : '' ?> id="kpi-check-<?= $kpiEmployeeId ?>" name="checkKpi[<?= $kpiEmployeeId ?>]" onchange="javascript:calculateKpiPercent(<?= $kpiEmployeeId ?>,2)" value="<?= $kpiEmployeeId ?>">
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
											<td style="background-color: #edeaea;" class="border-right">
												<div class="row pl-7">
													<div class="col-5  pr-1 pl-2">
														<input type="text" class="Level-txtinput form-control text-end pr-1 pl-1" name="level1[<?= $kpiEmployeeId ?>]" value="<?= $kpi['level1'] ?>">
													</div>
													<div class="col-1  pr-0 pl-0 text-center">-</div>
													<div class="col-5  pr-1 pl-2">
														<input type="text" class="Level-txtinput form-control  text-end pr-1 pl-1" name="level1End[<?= $kpiEmployeeId ?>]" value="<?= $kpi['level1End'] ?>">
													</div>
												</div>
											</td>
											<td style="background-color: #edeaea;" class="border-right">
												<div class="row pl-7">
													<div class="col-5  pr-1 pl-2">
														<input type="text" class="Level-txtinput form-control text-end pr-1 pl-1" name="level2[<?= $kpiEmployeeId ?>]" value="<?= $kpi['level2'] ?>">
													</div>
													<div class="col-1  pr-0 pl-0 text-center">-
													</div>
													<div class="col-5  pr-1 pl-2">
														<input type="text" class="Level-txtinput form-control  text-end pr-1 pl-1" name="level2End[<?= $kpiEmployeeId ?>]" value="<?= $kpi['level2End'] ?>">
													</div>
											</td>
											<td style="background-color: #edeaea;" class="border-right">
												<div class="row pl-7">
													<div class="col-5  pr-1 pl-2">
														<input type="text" class="Level-txtinput form-control text-end pr-1 pl-1" name="level3[<?= $kpiEmployeeId ?>]" value="<?= $kpi['level3'] ?>">
													</div>
													<div class="col-1  pr-0 pl-0 text-center">-</div>
													<div class="col-5  pr-1 pl-2">
														<input type="text" class="Level-txtinput form-control  text-end pr-1 pl-1" name="level3End[<?= $kpiEmployeeId ?>]" value="<?= $kpi['level3End'] ?>">
													</div>
												</div>
											</td>
											<td style="background-color: #edeaea;" class="border-right">
												<div class="row pl-7">
													<div class="col-5  pr-1 pl-2">
														<input type="text" class="Level-txtinput form-control text-end pr-1 pl-1" name="level4[<?= $kpiEmployeeId ?>]" value="<?= $kpi['level4'] ?>">
													</div>
													<div class="col-1  pr-0 pl-0 text-center">-</div>
													<div class="col-5  pr-1 pl-2">
														<input type="text" class="Level-txtinput form-control  text-end pr-1 pl-1" name="level4End[<?= $kpiEmployeeId ?>]" value="<?= $kpi['level4End'] ?>">
													</div>
												</div>
											</td>
											<td style="background-color: #edeaea;">
												<div class="col-12 pt-5">
													<!-- <img src="<?php // Yii::$app->homeUrl 
																?>images/icons/Dark/48px/setting(Round).png" class="setting_png"> Weight -->
													<input class="weight_round text-end pr-5 pl-5" type="text" value="<?= $kpi['weight'] ?>" id="weight-kpi-<?= $kpiEmployeeId ?>" name="weight-kpi[<?= $kpiEmployeeId ?>]" onkeyup="javascript:calculateKpiPercent(<?= $kpiEmployeeId ?>,1)">
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
	<input name="employeeId" value="<?= $employeeId ?>" type="hidden">
	<?php ActiveForm::end(); ?>
</div>