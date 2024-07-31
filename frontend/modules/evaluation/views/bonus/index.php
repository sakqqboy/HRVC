<?php

use frontend\models\hrvc\Department;

$this->title = 'Bonus Term';
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
			<div class="bg-white pmi_bakgru pt-10">
				<div class="col-12">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-2">
							<div class="col-12 FrameSalaryAllowance">
								Bonus <a class="btn btn-primary bonussubmit ml-10" href="javascript:saveBonusTerm(<?= $termId ?>)">
									<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/save.png" class="images-bonuesave">&nbsp; SAVE</a>
							</div>
						</div>
						<div class="col-lg-2 col-md-6 col-2 text-end pr-5">
							<i class="fa fa-exclamation-triangle picturebonus" aria-hidden="true"></i> <span class="font-size-10">16 Issues Pending</span>
						</div>
						<div class="col-lg-1 col-md-6 col-2 border-left text-start pl-5">
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Currency.png" class="pictureCurrency3"><span class="font-size-10"> Currency</span>
						</div>
						<div class="col-lg-2 col-md-6 col-2 text-end pr-5">
							<select class="form-select bonus-select" aria-label="Default select example">
								<option selected value="">Select menu</option>
								<option value="1">BTH (฿) </option>
								<option value="2">BTH (฿) </option>
								<option value="3">BTH (฿) </option>
							</select>
						</div>
						<div class="col-lg-1 col-md-6 col-2 border-left text-end pr-0 pl-0">
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/FilterPlus.png" class="picture-FilterPlus-bonus"> <strong class="font-size-10"> More</strong> <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/3Dot.png" class="bonus-point">
						</div>
					</div>
				</div>
				<div class="col-12 BG-bonusgray mt-10 pr-10 pl-10 pt-10">
					<div class="row">
						<div class="col-lg-3  pl-5 pr-5">
							<div class="col-12 BB-E3 pt-10 border pr-0">
								<div class="row">
									<div class="col-2 font-size-10 text-center pl-10 pt-5">
										start
									</div>
									<?php
									$allTerms[0] = [
										"status" => 1,
										"termName" => "E1"
									];
									$allTerms[1] = [
										"status" => 1,
										"termName" => "E2"
									];
									$allTerms[2] = [
										"status" => 1,
										"termName" => "E3"
									];

									if (isset($allTerms) && count($allTerms) > 0) {
										$i = 0;
										$line = 1;
										$current = 0;
										$next = 0;
										$lineStyle = "step-line-term";
										if (count($allTerms) == 4) {
											$line = 1;
										}
										if (count($allTerms) == 3) {
											$line = 2;
										}
										if (count($allTerms) == 1) {
											$line = 3;
										}
										if (count($allTerms) == 2) {
											$line = 5;
										}
										foreach ($allTerms as $at) :
											if ($at["status"] == 4) {
												$circle = "term-circle-pass-bonus";
											}
											if ($current == 1) {
												$next = 1;
											}
											if ($at["status"] == 1) {
												$circle = "term-circle-running-bonus";
												$current = 1;
												$lineStyle = "step-line-term-next";
											}
											if (count($allTerms) == 1) {
									?>
												<div class="col-<?= $line ?> step-line-term"></div>
											<?php
											}
											?>
											<div class="col-1 pr-0 pl-0 pt-1 <?= $next == 1 ? 'term-circle-next-bonus' : $circle ?>">
												<?= $at["termName"] ?></span>
											</div>
											<?php
											if ($i < count($allTerms) - 1 || count($allTerms) == 1) {
											?>
												<div class="col-<?= $line ?> <?= $lineStyle ?>"></div>
											<?php
											}
											?>
									<?php
											$i++;
										endforeach;
									}
									?>
									<div class="col-2 font-size-10 pr-0 pl-0 text-center">
										Finish
									</div>
								</div>
							</div>
							<div class="BB-E3 pt-5 pb-5 mt-10">
								<div class="row">
									<div class="col-7">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Depaertment-blue.png" class="pictureDepartment1">
										<span class="Departments12">12 Departments</span>
									</div>
									<div class="col-5">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Rank-blue.png" class="accordion-rank1">
										<span class="Departments12"> 33 Title </span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-9 border-left pl-20 pr-20">
							<div class="row">
								<?php
								if (isset($ranks) && count($ranks) > 0) {
									foreach ($ranks as $rankId => $rank) :
										$exMin = explode('.', $rank["min"]);
										if (isset($exMin[1]) && (int)$exMin[1] == 0) {
											$decimalMin = 0;
										} else {
											$decimalMin = 1;
										}
										$exMax = explode('.', $rank["max"]);
										if (isset($exMax[1]) && (int)$exMax[1] == 0) {
											$decimalMax = 0;
										} else {
											$decimalMax = 1;
										}
								?>
										<div class="col-lg-1 pr-3 pl-3">
											<div class="card-header bg-headerbonus"><?= $rank["rankName"] ?></div>
											<div class="card-body bg-titleBudget pb-5">
												<div class="card-title">
													<div class="number-x"><?= number_format($rank["bonus"], 1) ?> X</div>
													<div class="col-12 pr-2 pl-2">
														<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/bonus-solid.png" class="images-solidbonus1" style="margin-top:-5px;">
													</div>
													<div class="col-12 ">
														<div class="row bonus-sm1">
															<div class="col-6 text-start pl-17">
																<?= number_format($rank["min"], $decimalMin) ?>
															</div>
															<div class="col-6 pr-15">
																<?= number_format($rank["max"], $decimalMax) ?>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
								<?php
									endforeach;
								}
								?>
							</div>
							<div class="row pt-10 pl-3 pr-3">
								<div class="col-lg-3 pl-0">
									<div class="card-header bg-headerbonus text-dark pt-3 pb-3 font-weight-500" style="border-top-left-radius: 3px;border-top-right-radius: 3px;">Total Budget <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/save-black.png" class="pictureEdit1"></div>
									<div class="card-body bg-titleBudget">
										<div class="card-title pt-10 pb-10 pl-10">
											<div class="row">
												<div class="col-2">
													฿
												</div>
												<div class="col-10 pr-20 pl-0">
													<input type="text" class="form-control font-size-10 pr-5 pl-5 pt-3 pb-3 text-end" id="totalBudget" value="<?= number_format($bonusDetail['budget'], 2) ?>">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-3 pl-5 pr-8 ">
									<div class="card-header bg-headerbonus text-dark pt-3 pb-3 font-weight-500" style="border-top-left-radius: 3px;border-top-right-radius: 3px;">Evaluated Bonus <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/save-black.png" class="pictureEdit1"></div>
									<div class="card-body bg-titleBudget">
										<div class="card-title pt-10 pb-10 pl-10">
											<div class="row">
												<div class="col-2">
													฿
												</div>
												<div class="col-10 pr-20 pl-0 font-size-10 text-center">
													<span id="total-bonus"><?= number_format($bonusDetail['totalBonus'], 2) ?></span>
													<input type="hidden" value="<?= $bonusDetail['totalBonus'] ?>" id="totalBonus">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-3 pl-8 pr-5">
									<div class="card-header bg-headerbonus text-dark  pt-3 pb-3 font-weight-500" style="border-top-left-radius: 3px;border-top-right-radius: 3px;">Ajustment <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/save-black.png" class="pictureEdit1"></div>
									<div class="card-body bg-titleBudget">
										<div class="card-title pt-10 pb-10 pl-10">
											<div class="row">
												<div class="col-2">
													฿
												</div>
												<div class="col-10 pr-20 pl-0 font-size-10 text-center">
													<span id="adjustment-bonus"><?= number_format($bonusDetail['totalAdjust'], 2) ?></span>
													<input type="hidden" id="payableBonus" vaule="<?= $bonusDetail['totalAdjust'] ?>">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-3 pr-0">
									<div class="card-header bg-headerbonus text-dark pt-3 pb-3 font-weight-500" style="border-top-left-radius: 3px;border-top-right-radius: 3px;">Payable Bonus <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/save-black.png" class="pictureEdit1"></div>
									<div class="card-body bg-titleBudget">
										<div class="card-title pt-10 pb-10 pl-10">
											<div class="row">
												<div class="col-2">
													฿
												</div>
												<div class="col-10 pr-20 pl-0 font-size-10 text-center">
													<span id="payableBonus-bonus"><?= number_format($bonusDetail['totalPayable'], 2) ?></span>
													<input type="hidden" id="payableBonus" vaule="<?= $bonusDetail['totalPayable'] ?>">
												</div>
											</div>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
				<div class="col-12 border mt-20 pt-5 pr-10 pl-10 pb-5" style="border-radius: 5px;">
					<div class="row">
						<div class="col-2 border-right">
							<div class="salary1 col-12 pr-0 pl-0 ">Salary</div>
							<div class="salary2 mt-3 col-12 pr-0 pl-0 text-center">฿ <?= number_format($bonusDetail['totalSalary']) ?> </div>
						</div>
						<div class="col-2 border-right">
							<div class="row">
								<div class="col-2 pr-0 pl-0 text-center">
									<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/imagelink-1.png" class="imagelink-1">
								</div>
								<div class="col-4 salary3 pl-0">
									Evaluation
									Bonus
								</div>
								<div class="col-6 salary4 pr-3 pl-3 pt-7 text-center">
									฿ <span class="text-dark"><?= number_format($bonusDetail['totalBonus']) ?></span>
								</div>
							</div>
						</div>
						<div class="col-2 border-right">
							<div class="row">
								<div class="col-2 pr-0 pl-0 text-center">
									<i class="fa fa-align-center font-size-14" aria-hidden="true"></i>
								</div>
								<div class="col-4 salary3 pl-0">
									Budget
									adjustment
								</div>
								<div class="col-6 salary4 pr-3 pl-3 pt-7 text-center">
									฿ <span class="text-danger">(<?= number_format($bonusDetail['totalAdjust']) ?>)</span>
								</div>
							</div>
						</div>
						<div class="col-2">
							<div class="row">
								<div class="col-2 pr-0 pl-0 text-center">
									<i class="fa fa-align-center font-size-14" aria-hidden="true"></i>
								</div>
								<div class="col-4 salary3 pl-0">
									Final
									adjustment
								</div>
								<div class="col-6 salary4 pr-3 pl-5 pt-7 text-center">
									฿ <span class="text-primary">(<?= number_format(0) ?>)</span>
								</div>
							</div>
						</div>
						<div class="col-2">
							<div class="row">
								<div class="col-2 pr-0 pl-0 text-center">
									<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/like-smile.png" class="like-smile">
								</div>
								<div class="col-3 salary3 pl-0">
									Final
									Bonus
								</div>
								<div class="col-7 salary4 pr-3 pl-5 pt-7">
									<div class="col-12 bottomsolid-salarybonus">
										<?= number_format($bonusDetail['totalBonus']) ?>
									</div>
								</div>
							</div>
						</div>
						<div class="col-2">
							<div class="row">
								<div class="col-3 pr-0 pl-0 text-center">
									<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/like-smile.png" class="like-smile">
								</div>
								<div class="col-4 salary3 pl-0" style="line-height: 10px;">
									Payable
									Bonus
									Ratio
								</div>
								<div class="col-5 pr-10 pl-10 pt-7 font-size-16 font-b">
									<div class="col-12 bottomsolid-salarybonus">
										<?= number_format($bonusDetail['bonusRatio'], 2) ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 cd-F4F6F9">
					<table class="table table-borderless">
						<tr class="text-center bonus-head">
							<td colspan="2" class="" style="width: 25%;"> EMPLOYEE </td>
							<td style="width: 10%;"> TITLE </td>
							<td style="width: 5%;"> RANK </td>
							<td style="width: 5%;"> BONUS </td>
							<td style="width: 10%;"> SALARY(SG)
								<span class="dropdown" href="#" role="but ton" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
									<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Selected-info.png" class="width3">
								</span>
								<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
									<li class="font-size-10"><a class="dropdown-item" href="#">1</a> </li>
									<li class="font-size-10"><a class="dropdown-item" href="#">2</a></li>
									<li class="font-size-10"><a class="dropdown-item" href="#">3</a></li>
								</ul>
							</td>
							<td style="width: 10%;"> EVAL.BONUS </td>
							<td> ADJUSTMENT </td>
							<td> FINAL ADJUSTMENT </td>
							<td> PAYABLE BONUS </td>
							<td style="width: 5%;"> PAYABLE BONUS </td>
						</tr>
						<tr class="" style="height: 5px !important;">
							<td colspan="11" style="background-color: white;"></td>
						</tr>
						<?php
						$i = 0;
						if (isset($employeeList) && count($employeeList) > 0) {
							foreach ($employeeList as $departmentId => $employees) :
								$i = 0;
								foreach ($employees as $employeeId => $em) :
									//throw new Exception(print_r($employee, true));
						?>
									<tr class="bonus-user">
										<?php
										if ($i == 0) {
										?>
											<td rowspan="<?= count($employees) ?>" style="width:12%;" class="pl-5">
												<!-- <span class="badge bg-primary ml-3">
													<img src="<?php // Yii::$app->homeUrl 
															?>images/icons/Light/Light/24px/Department.png" class="bonus-Department">
												</span> -->
												<div class="ml-3 font-b col-12 font-size-12"> <?= Department::departmentNAme($departmentId) ?></div>
											</td>
										<?php
										}
										?>
										<td class="pr-0 pl-0 pt-5 pb-0">
											<div class="col-12 border-right bg-white pt-4 pb-4">
												<img src="<?= Yii::$app->homeUrl ?><?= $em['picture'] ?>" class="ladyjpg mr-3"> <?= $em["firstname"] ?> <?= $em["surename"] ?>
											</div>
										</td>
										<td class="pr-0 pl-0 pt-5 pb-0">
											<div class="col-12 border-right bg-white pt-7 pb-7 text-center" style="min-height: 29px;">
												<?= $em["titleName"] ?>
											</div>
										</td>
										<td class="pr-0 pl-0 pt-5 pb-0">
											<div class="col-12 border-right bg-white  pt-7 pb-7 text-center" style="min-height: 29px;">
												<?= $em["rankName"] ?>
											</div>
										</td>
										<td class="pr-0 pl-0 pt-5 pb-0">
											<div class="col-12 border-right bg-white  pt-7 pb-7 text-center" style="min-height: 29px;">
												<?= $em["bonusRate"] == '-' ? '-' : number_format($em["bonusRate"], 1) . 'X' ?>
											</div>
										</td>
										<td class="pr-0 pl-0 pt-5 pb-0">
											<div class="col-12 border-right bg-white pt-7 pb-7 pr-5 text-end">
												<input type="hidden" id="employee-salary-<?= $employeeId ?>" value="<?= $em['currentSalary'] ?>">
												<?= is_numeric($em["currentSalary"]) ? number_format($em["currentSalary"], 2) : '-' ?>
											</div>
										</td>
										<td class="pr-0 pl-0 pt-5 pb-0">
											<div class="col-12 border-right bg-white  pt-7 pb-7 pr-5 text-end">

												<?= is_numeric($em["bonus"]) ? number_format($em["bonus"], 2) : '-' ?>
											</div>
										</td>
										<td class="pr-0 pl-0 pt-5 pb-0">
											<div class="col-12 border-right bg-white  pt-7 pb-7 pr-5 text-end">
												<i class="fa fa-caret-down text-danger font-size-12" aria-hidden="true"></i>
												<?php /*
												if (is_numeric($em["currentSalary"]) && isset($em["rank"]["bonusRate"]) && is_numeric($em["rank"]["bonusRate"])) {
													$evalBonus = $em["currentSalary"] * $em["rank"]["bonusRate"];
													if ($evalBonus > 0) {
														$adjustment = $evalBonus - $em["currentSalary"];
													} else {
														$adjustment = 0;
													}
												} else {
													$adjustment = 0;
												}*/
												?>
												<span class="text-danger"> ( <?= number_format($em["adjustment"], 2) ?> )</span>
											</div>
										</td>
										<td class="pr-0 pl-0 pt-5 pb-0">
											<div class="col-12 border-right bg-white  pt-7 pb-7 text-end pr-5">
												<?php
												//$finalAjustment = $evalBonus;

												//$finalAdjustment = 0;
												?>
												<span class="finaladjustment-ml">
													<input type="text" id="final-adjustment-<?= $employeeId ?>" value="<?= $em['finalAdjustment'] ?>" class="finalAdjust-input" style="display: none;">
													<span id="text-final-adjustment-<?= $employeeId ?>"><?= number_format($em["finalAdjustment"], 2) ?></span>
													<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/ture.png" class="width1" onclick="javascript:changeFinalAdjustment(<?= $employeeId ?>)" style="cursor: pointer;">
													<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/save-black.png" class="width2" onclick="javascript:saveFinancialAdjustment(<?= $employeeId ?>,<?= $termId ?>)">
												</span>
											</div>
										</td>
										<td class="pr-0 pl-0 pt-5 pb-3">
											<div class="col-12 border-right bg-white  pt-7 pb-7 text-end pr-5">
												<?php
												if (is_numeric($em["currentSalary"]) && isset($em["rank"]["bonusRate"]) && is_numeric($em["rank"]["bonusRate"])) {
													$salary = $em["currentSalary"];
												} else {
													$salary = 0;
												}
												?>
												<span id="payable-bonus-<?= $employeeId ?>"><?= number_format($salary + $em["finalAdjustment"], 2) ?></span>
											</div>
										</td>
										<td class="pr-5 pl-0 pt-5 pb-0 text-center">

											<div class="col-12 bg-white  pt-7 pb-7" id="true-bonus-rate-<?= $employeeId ?>"><?= number_format($em["trueRateBonus"], 1) ?> X</div>
										</td>
									</tr>
								<?php
									$i++;
								endforeach; ?>
								<tr class="" style="height: 5px !important;">
									<td colspan="11" style="background-color: white;"></td>
								</tr>
						<?php
							endforeach;
						}
						?>


					</table>
				</div>
			</div>
		</div>
	</div>
</div>