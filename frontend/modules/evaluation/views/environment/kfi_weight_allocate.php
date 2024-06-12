<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = 'Weight Allocation';
?>
<div class="col-12 mt-70 environment pt-10 pr-10 pl-20">
	<?php
	$form = ActiveForm::begin([
		'id' => 'save-kfi-weight',
		'method' => 'post',
		'options' => [
			'enctype' => 'multipart/form-data',
		],
		'action' => Yii::$app->homeUrl . 'evaluation/environment/save-kfi-weight-allocate'
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
						<div class="col-3 FrameEvaluation">
							Key Finalcial Indicator
						</div>
						<div class="col-9 text-end">
							<div class="row">
								<div class="col-6 text-start">
									<a class="btn btn-primary font-size-12 pt-3 pb-3" style="letter-spacing: 0.5px;" href="javascript:checkKfiPercent()">
										<i class="fa fa-floppy-o mr-3" aria-hidden="true"></i>
										APPLY SAVE
									</a>
									<input type="hidden" id="termId" value="<?= $termId ?>" name="termId">
								</div>
								<div class="col-6 text-end">
									<a class="btn btn-info font-size-12 pt-3 pb-3" style="letter-spacing: 0.5px;color:white;">
										<i class="fa fa-th-large mr-3" aria-hidden="true"></i>
										KFI Dashboard
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row pt-30">
					<!-- <div class="col-4">
						<div class="col-12">
							<span class="text-danger">*</span><span class="font-size-11">Achievement Target Setup</span>
						</div>
						<div class="col-12 Want-Level">
							Do You Want Level 3 As Default Target ? &nbsp;<input type="radio" name="fruit"><span class="TYPEYES"> YES</span> <span class="pl-3"></span><input type="radio" name="fruit"><span class="TYPEYES"> NO</span>
						</div>
					</div> -->
					<div class="col-12 pt-5 pr-0">
						<div class="row">
							<div class="col-12">
								<div class="row">
									<div class="col-10">
										<div class="col-12 text-end font-size-10">
											Allocate percentage to all the selected
										</div>
										<div class="col-12 text-end font-size-10">
											KFI contents to continue
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
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 mt-10">
						<?php
						if (isset($kfiWeight) && count($kfiWeight) > 0) {
						?>
							<table class="table">
								<thead class="text-secondary">
									<tr class="font-size-10 text-center">
										<th></th>
										<th>Kfi</th>
										<th>Target</th>
										<th>Level 1</th>
										<th>Level 2</th>
										<th>Level 3</th>
										<th>Level 4</th>
										<th>Level 5</th>
										<th>Level 6</th>
										<th style="width:10%">Weight</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 0;
									foreach ($kfiWeight as $kfiId => $kfi) :
										if ($kfi["status"] == 1) {
											$checked = 1;
										} else {
											$checked = 0;
										}
									?>
										<input type="hidden" name="kfiIds[]" value="<?= $kfiId ?>">
										<tr style="height: 10px;"></tr>
										<tr>
											<td style="width:30px;" class="pr-10 pl-10">
												<label class="checkbox style-c">
													<input type="checkbox" <?= $checked == 1 ? 'checked' : '' ?> id="kfi-check-<?= $kfiId ?>" name="checkKfi[<?= $kfiId ?>]" onchange="javascript:calculateKfiPercent(<?= $kfiId ?>,2)" value="<?= $kfiId ?>">
													<div class="checkbox__checkmark"></div>
													<div class="checkbox__body"></div>
												</label>
											</td>
											<td style="background-color: #edeaea;" class="font-size-10 text-secondary">
												<?= $kfi['kfiName'] ?>
											</td>
											<td style="background-color: #edeaea;" class="border-right">
												<div class="col-12 pr-12">
													<div class="col-12 text-secondary font-size-10 text-center">
														Target
													</div>
													<div class="col-12 nm_berformat text-secondary mt-5">
														<?= number_format($kfi['target']) ?>
													</div>
												</div>
											</td>
											<td style="background-color: #edeaea;" class="border-right">
												<div class="row pl-7">
													<div class="col-5  pr-1 pl-2">
														<input type="text" class="Level-txtinput form-control text-end pr-1 pl-1" name="level1[<?= $kfiId ?>]" value="<?= $kfi['level1'] ?>">
													</div>
													<div class="col-1  pr-0 pl-0 text-center">-</div>
													<div class="col-5  pr-1 pl-2">
														<input type="text" class="Level-txtinput form-control  text-end pr-1 pl-1" name="level1End[<?= $kfiId ?>]" value="<?= $kfi['level1End'] ?>">
													</div>
												</div>
											</td>
											<td style="background-color: #edeaea;" class="border-right">
												<div class="row pl-7">
													<div class="col-5  pr-1 pl-2">
														<input type="text" class="Level-txtinput form-control text-end pr-1 pl-1" name="level2[<?= $kfiId ?>]" value="<?= $kfi['level2'] ?>">
													</div>
													<div class="col-1  pr-0 pl-0 text-center">-
													</div>
													<div class="col-5  pr-1 pl-2">
														<input type="text" class="Level-txtinput form-control  text-end pr-1 pl-1" name="level2End[<?= $kfiId ?>]" value="<?= $kfi['level2End'] ?>">
													</div>
											</td>
											<td style="background-color: #edeaea;" class="border-right">
												<div class="row pl-7">
													<div class="col-5  pr-1 pl-2">
														<input type="text" class="Level-txtinput form-control text-end pr-1 pl-1" name="level3[<?= $kfiId ?>]" value="<?= $kfi['level3'] ?>">
													</div>
													<div class="col-1  pr-0 pl-0 text-center">-</div>
													<div class="col-5  pr-1 pl-2">
														<input type="text" class="Level-txtinput form-control  text-end pr-1 pl-1" name="level3End[<?= $kfiId ?>]" value="<?= $kfi['level3End'] ?>">
													</div>
												</div>
											</td>
											<td style="background-color: #edeaea;" class="border-right">
												<div class="row pl-7">
													<div class="col-5  pr-1 pl-2">
														<input type="text" class="Level-txtinput form-control text-end pr-1 pl-1" name="level4[<?= $kfiId ?>]" value="<?= $kfi['level4'] ?>">
													</div>
													<div class="col-1  pr-0 pl-0 text-center">-</div>
													<div class="col-5  pr-1 pl-2">
														<input type="text" class="Level-txtinput form-control  text-end pr-1 pl-1" name="level4End[<?= $kfiId ?>]" value="<?= $kfi['level4End'] ?>">
													</div>
												</div>
											</td>
											<td style="background-color: #edeaea;" class="border-right">
												<div class="row pl-7">
													<div class="col-5  pr-1 pl-2">
														<input type="text" class="Level-txtinput form-control text-end pr-1 pl-1" name="level5[<?= $kfiId ?>]" value="<?= $kfi['level5'] ?>">
													</div>
													<div class="col-1  pr-0 pl-0 text-center">-</div>
													<div class="col-5  pr-1 pl-2">
														<input type="text" class="Level-txtinput form-control  text-end pr-1 pl-1" name="level5End[<?= $kfiId ?>]" value="<?= $kfi['level5End'] ?>">
													</div>
												</div>
											</td>
											<td style="background-color: #edeaea;" class="border-right">
												<div class="row pl-7">
													<div class="col-5  pr-1 pl-2">
														<input type="text" class="Level-txtinput form-control text-end pr-1 pl-1" name="level6[<?= $kfiId ?>]" value="<?= $kfi['level6'] ?>">
													</div>
													<div class="col-1  pr-0 pl-0 text-center">-</div>
													<div class="col-5  pr-1 pl-2">
														<input type="text" class="Level-txtinput form-control  text-end pr-1 pl-1" name="level6End[<?= $kfiId ?>]" value="<?= $kfi['level6End'] ?>">
													</div>
												</div>
											</td>

											<td style="background-color: #edeaea;">

												<input class="weight_round text-end pr-5 pl-5" type="text" value="<?= number_format($kfi['weight'], 1) ?>" id="weight-kfi-<?= $kfiId ?>" name="weight-kfi[<?= $kfiId ?>]" onkeyup="javascript:calculateKfiPercent(<?= $kfiId ?>,1)">
												<span class="font-size-10">%</span>

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