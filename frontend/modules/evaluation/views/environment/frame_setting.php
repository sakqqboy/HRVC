<?php

use common\models\ModelMaster;

$this->title = "Frame Setting";
?>
<div class="col-12 mt-70">
	<div class="row">
		<div class="col-lg-4 col-md-6 col-12">
			<div class="col-12 text-start font-b font-size-18 pt-5">
				Frame Dasdboard
			</div>
		</div>
		<div class="col-lg-8 col-md-6 col-12 text-end">
			<div class="row">
				<div class="col-10 text-end pr-0">
					<div class="col-12 pr-0">
						<div class="YourChoose">Choose Your Frame To Display &nbsp;
							<i class="fa fa-exclamation-circle text-warning font-size-16" aria-hidden="true"></i>
						</div>
					</div>
					<div class="row mt-5">
						<div class="col-4"></div>
						<?php
						if (isset($frame) && !empty($frame)) {
							if ($frame["startDate"] !== '') {
								$startDateArr = explode(' ', $frame["startDate"]);
							}
							if ($frame["startDate"] !== '') {
								$finishDateArr = explode(' ', $frame["finishDate"]);
							}
							if (isset($frame["allTerm"]) && count($frame["allTerm"]) > 0) {
								foreach ($frame["allTerm"] as $termId => $term) :

						?>
									<div class="col-2">
										<input class="mr-5 form-check-input radio-checked-black" type="radio" value="<?= $termId ?>" name="term" <?= $term["status"] == 1 ? 'checked' : '' ?>>
										<span class="font-size-12"><?= $term["termName"] ?></span>
									</div>
						<?php
								endforeach;
							}
						}
						?>

					</div>
				</div>
				<div class="col-2 text-end pl-0 pt-11 pb-0">
					<button class="btn btn-light Dashboardblue1"><i class="fa fa-th-large" aria-hidden="true"></i> Dashboard</button>
				</div>
			</div>
		</div>
	</div>
	<div class="col-12 mt-10 environment pl-10 pt-10 pb-10 pr-10">
		<div class="row">
			<div class="col-2 font-size-13 font-b  pr-5">
				<?= $frame["frameName"] ?>
			</div>
			<div class="col-10 border-left pr-15">
				<div class="row  pr-15 pl-20 pt-30">
					<?php
					if (isset($terms) && count($terms) > 0) {
						$i = 1;
						foreach ($terms as $termId => $term) :
							$width = 100 / (count($terms) + 1);
							if ($i == 1) {
					?>
								<div class="term-progress-line pl-0" style="width:<?= $width ?>%;">
									<div class="row pr-0 pl-0" style="margin-top:-15px;">
										<div class="col-4 date-calendar pr-0 pl-0">
											<div class="col-12 font-size-10 pr-0 pl-0 pt-0 text-center text-primary">Start Date</div>
											<div class="col-12 date-calendar-head"></div>
											<div class="col-12 date-calendar-body text-center pt-5">
												<span class="font-b font-size-11"><?= isset($startDateArr[0]) ? $startDateArr[0] : '' ?></span>
												<br>
												<?php
												if (isset($startDateArr[1]) && isset($startDateArr[2])) {
													echo $startDateArr[1] . '&nbsp;' . $startDateArr[2];
												}
												?>
											</div>
										</div>
										<div class="col-5 "></div>
										<div class="col-3  pt-5 text-center term-progress font-b " style="margin-top: -3px;">
											<?= $term["termName"] ?>
										</div>
									</div>
								</div>
							<?php
							} else {
							?>
								<div class="term-progress-line" style="width:<?= $width ?>%;">
									<div class="row" style="margin-top:-18px;">
										<div class="col-9"></div>
										<div class="col-3  pt-5 text-center term-progress font-b"><?= $term["termName"] ?></div>
									</div>
								</div>
							<?php
							}
							if ($i == count($terms)) {
							?>
								<div class="term-progress-line pl-0" style="width:<?= $width ?>%;">
									<div class="row pl-0 pr-0" style="margin-top:-15px;">
										<div class="col-8"></div>
										<div class="col-4 date-calendar pr-0 pl-0 ">
											<div class="col-12 font-size-10 pr-0 pl-0 pt-0 text-center text-primary">End Date</div>
											<div class="col-12 date-calendar-head"></div>
											<div class="col-12 date-calendar-body text-center pt-5">
												<span class="font-b font-size-11"><?= isset($finishDateArr[0]) ? $finishDateArr[0] : '' ?></span>
												<br>
												<?php
												if (isset($finishDateArr[1]) && isset($finishDateArr[2])) {
													echo $finishDateArr[1] . '&nbsp;' . $finishDateArr[2];
												}
												?>
											</div>
										</div>
									</div>
								</div>
					<?php
							}
							$i++;
						endforeach;
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-12 environment pt-10 pl-10 pr-10 mt-10 pb-10">
		<?php
		if (isset($terms) && count($terms) > 0) {
			foreach ($terms as $termId => $term) :
		?>
				<div class="col-12 mb-20 pt-0">
					<div class="col-12 bg-white pt-5 pb-5 pl-10 pr-15 rounded-2 term-head">
						<div class="row">
							<div class="col-1">
								<div class="col-12 pr-20 pl-5">
									<div class="tag-term text-center pt-4 pb-4 rounded-1 font-size-14"><?= $term["termName"] ?></div>
								</div>
							</div>
							<div class="col-7">
								<div class="row">
									<div class="col-4">
										<div class="row">
											<div class="col-2 pl-0 pr-0 font-size-12 font-weight-500 pt-5 text-end pr-0">Start</div>
											<div class="col-10 pl-5 pr-0">
												<div class="input-group">
													<input type="date" class="form-control formstart" value="<?= $term['startDateValue'] ?>">

												</div>
											</div>
										</div>
									</div>
									<div class="col-4">
										<div class="row">
											<div class="col-2 pl-0 pr-0 font-size-12 font-weight-500 pt-5 text-end pr-0">Mid</div>
											<div class="col-10 pl-5 pr-5">
												<div class="input-group">
													<input type="date" class="form-control formstart" value="<?= $term['midDateValue'] ?>">
												</div>
											</div>
										</div>
									</div>
									<div class="col-4">
										<div class="row">
											<div class="col-2 pl-0 pr-0 font-size-12 font-weight-500 pt-5 text-end">Finish</div>
											<div class="col-10 pl-5 pr-0">
												<div class="input-group">
													<input type="date" class="form-control formstart" value="<?= $term['finishDateValue'] ?>">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-4">
								<div class="row">
									<div class="col-8 text-end pr-10 font-size-12 pt-5">
										Configure Modules Ready
										<span class="rounded-5 border pt-2 pb-2 pr-8 pl-8 border-dark"><i class="fa fa-info" aria-hidden="true"></i></span>
									</div>
									<div class="col-4 text-start border-left">
										<div class="col-12 successredius font-size-12 pt-5 pb-5 text-center">
											<input class="form-check-input mr-5 rounded term-check" type="checkbox" value="" id="">
											<label class="form-check-label" for="flexCheckDefault"> All Set </label>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row mt-10 pl-12">
						<div class="col-lg-9 col-md-6 col-12 environment bg-white">
							<div class=" pl-10 pr-10 ">
								<div class="row">
									<div class="col-9 pt-5" style="margin-bottom: -5px;">
										<table class="table">
											<thead>
												<tr class="term-table-header">
													<th style="border-top-left-radius:5px;border-bottom-left-radius:5px;">TERMS</th>
													<th class="text-start">
														<div class="col-12 pl-65">START</div>
													</th>
													<th class="text-start">
														<div class="col-12 pl-50">FINISH</div>
													</th>
													<th style="border-top-right-radius:5px;border-bottom-right-radius:5px;" class="text-center">DURATION</th>
												</tr>
											</thead>
											<tbody>
												<?php
												if (isset($term["items"]) && count($term["items"]) > 0) {
													foreach ($term["items"] as $termItemId => $item) :
														$class = 'border-left-primary-frame';
												?><tr style="height: 10px;">
														</tr>
														<tr class="frame-table-tr">
															<td class="pb-0 pl-0">
																<div class="<?= $class ?> col-12 pl-10 pt-10"><?= $item["stepName"] ?></div>
															</td>
															<td class="border-left text-center td-frame">
																<span id="start-date-<?= $termItemId ?>"><?= $item["startDate"] ?></span>

																<span class="badge bg-clder float-end" style="cursor:pointer;" data-bs-target="#set_term_date" data-bs-toggle="modal" onclick="javascript:setTermDate(<?= $termItemId ?>)">
																	<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Calender.png" class="cenler-arrows">
																	<img src="<?= Yii::$app->homeUrl ?>image/arrowss.png" class="iconsarrowss">
																	<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Calender.png" class="cenler-arrows">
																</span>
															</td>
															<td class="text-start td-frame pl-20">
																<div class="col-12 pl-15" id="finish-date-<?= $termItemId ?>"><?= $item["finishDate"] ?></div>
															</td>
															<td class="border-left text-center td-frame">
																<span id="duration-date-<?= $termItemId ?>"><?= $item["duration"] ?></span> Days
															</td>
														</tr>
												<?php
													endforeach;
												}
												?>
											</tbody>
										</table>
									</div>
									<div class="col-3 border-left pt-10 pr-0 pl-0">
										<div class="col-12 pl-10 text-center font-size-14 font-weight-500">
											BONUS
										</div>
										<div class="col-12 text-center font-size-11 pr-5 pl-5 mt-20">
											Does the evaluation includes bonus ?
										</div>
										<div class="col-12 pr-13 pl-13 mt-20">
											<div class="col-12 rowcardBonus pr-10 pl-10 pt-20 pb-20">
												<div class="row">
													<div class="col-6 text-end">
														<input class="form-check-input" type="radio" id="isBonus<?= $termId ?>" name="flexRadioDefault-<?= $termId ?>" <?= $term["isBonus"] == 1 ? "checked" : '' ?> value="1">
														<label class="font-size-12 font-b">
															&nbsp;Yes
														</label>
													</div>
													<div class="col-6">
														<input class="form-check-input" type="radio" id="isBonus<?= $termId ?>" name="flexRadioDefault-<?= $termId ?>" <?= $term["isBonus"] == 0 ? "checked" : '' ?> value="0">
														<label class="font-size-12 font-b">
															&nbsp;No
														</label>
													</div>

												</div>
												<!-- <div class="col-12 text-center font-size-12" style="margin-top: -3px;">
													Select Bonus Month
												</div>
												<div class="col-12 mt-15 text-center mb-10">
													<select class="form-select font-size-13 font-weight-500">
														<option value="1">January</option>
														<option value="2">February</option>
														<option value="3">March</option>
														<option value="4">April</option>
														<option value="5">May</option>
														<option value="6">June</option>
														<option value="7">July</option>
														<option value="8">August</option>
														<option value="9">September</option>
														<option value="10">October</option>
														<option value="11">November</option>
														<option value="12">December</option>
													</select>
												</div> -->
											</div>
										</div>
										<a href="javascript:changeTermBonus(<?= $termId ?>)" class="no-underline">
											<div class="d-grid gap-2 col-12 mx-auto mt-85 pr-10 pl-10">
												<span class="ApllySubmit text-center pt-5 pb-5 pr-5">
													Apply
												</span>
											</div>
											<input type="hidden" id="bonus<?= $termId ?>" value="<?= $term['isBonus'] ?>">
										</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-12 pl-10 pr-10">
							<div class="environment bg-white pt-10 pb-15">
								<div class="col-12 pl-20 font-size-14">
									Available Evaluation Modules
								</div>
								<div class="col-12 mt-10">
									<div class="col-12 pl-10">
										<i class="fa fa-check checkgreenbox" aria-hidden="true"></i> &nbsp;&nbsp;
										<span class="liEvaluation">Evaluation Frame</span>
									</div>
									<div class="col-12 pl-10 mt-8">
										<i class="fa fa-check checkgreenbox" aria-hidden="true"></i> &nbsp;&nbsp;
										<span class="liEvaluation">Weight Allocation</span>
									</div>
									<div class="col-12 pl-10 mt-8">
										<i class="fa fa-check checkgreenbox" aria-hidden="true"></i> &nbsp;&nbsp;
										<span class="liEvaluation">Evaluator Settings</span>
									</div>
									<div class="col-12 pl-10 mt-8">
										<i class="fa fa-check checkgreenbox" aria-hidden="true"></i> &nbsp;&nbsp;
										<span class="liEvaluation">Salary & Allowance</span>
									</div>
									<div class="col-12 pl-10 mt-8">
										<i class="fa fa-check checkgreenbox" aria-hidden="true"></i> &nbsp;&nbsp;
										<?php
										if ($term['isBonus'] == 1) { ?>
											<span class="liEvaluation" id="hasBonus">Bonus Configuration</span>
										<?php
										} else { ?>
											<del><span class="liEvaluation" id="hasBonus">Bonus Configuration</span></del>
										<?php
										}
										?>
									</div>
									<div class="col-12 pl-10 mt-8">
										<i class="fa fa-check checkgreenbox" aria-hidden="true"></i> &nbsp;&nbsp;
										<span class="liEvaluation">Promotion</span>
									</div>
								</div>
								<div class="d-grid gap-2 col-12 mx-auto mt-13 pr-10 pl-10">

									<span class="ApllySubmit text-center pt-5 pb-5 pr-10">
										<a href="<?= Yii::$app->homeUrl ?>evaluation/environment/term-detail/<?= ModelMaster::encodeParams(['termId' => $termId]) ?>" class="no-underline" style="color:#1F5594;">
											<span class="ml-35">Configure Modules</span>
											<span class="rounded-5 border  pr-6 pl-6 border-primary float-end">
												<i class="fa fa-chevron-right" aria-hidden="true"></i></span>
										</a>
									</span>

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
</div>
<?= $this->render('modal_set_term_date', [
	"dateValue" => $dateValue,
	"thisMonth" => $thisMonth,
	"thisYear" => $thisYear,
]) ?>