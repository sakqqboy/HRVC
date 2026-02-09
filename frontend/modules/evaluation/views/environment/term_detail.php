<?php
$this->title = 'Term Detail';
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
					<div class="FrameEvaluation"> Evaluation Frame</div>
				</div>
				<div class="row mt-10 pl-10 pr-10">
					<div class="col-lg-4 col-12 pl-0">
						<div class="col-12 environment pt-5 pl-10 pr-10">
							<div class="row">
								<div class="col-8 font-weight-500" id="month-year1"><?= $thisMonth ?>&nbsp;&nbsp;&nbsp;
									<?= $thisYear ?>
								</div>
								<div class="col-4 text-end pr-10">
									<a href="javascript:previousMonth(1)" class="no-underline-black">
										<i class="fa fa-angle-left mr-20" aria-hidden="true"></i>
									</a>
									<a href="javascript:nextMonth(1)" class="no-underline-black">
										<i class="fa fa-angle-right " aria-hidden="true"></i>
									</a>
								</div>
							</div>
							<div class="col-12">
								<input type="hidden" value="<?= (int)date('Y') ?>" id="year1">
								<input type="hidden" value="<?= (int)date('m') ?>" id="month1">
								<input type="hidden" value="" id="current-select-1">
								<div class="col-12" id="result-date1">
									<?= $this->render('calendar1', [
										"dateValue" => $dateValue,
									]) ?>
								</div>
							</div>
							<div class="col-12 font-size-12 font-weight-500 text-primary">
								TODAY 2/27/2023
							</div>
							<div class="col-12">
								<?php
								for ($i = 1; $i <= 5; $i++) {
								?>
									<div class="col-9 badge bg-Today">
										Intermediate Interview
									</div>
									<div class="col-9 mb-8">
										<div class="row">
											<div class="col-6 pl-15">
												<i class="fa fa-circle Note-Today1" aria-hidden="true"></i>
												<span class="text-secondary font-size-10">2/27/2023
													<div class="col-12 text-center">Start Date</div>
												</span>
											</div>
											<div class="col-6 pl-15">
												<i class="fa fa-circle Note-Today2" aria-hidden="true"></i>
												<span class="text-secondary font-size-10">2/27/2023
													<div class="col-12 text-center">Start Date</div>
												</span>
											</div>
										</div>
									</div>
								<?php
								}
								?>

							</div>
						</div>
					</div>
					<?php
					if ($terms["startDate"] !== '') {
						$startDateArr = explode(' ', $terms["startDate"] ?? '');
					}
					if ($terms["endDate"] !== '') {
						$endDate = explode(' ', $terms["endDate"] ?? '');
					}
					if ($terms["midDate"] !== '') {
						$midDateArr = explode(' ', $terms["midDate"] ?? '');
					}
					?>
					<div class="col-lg-8 col-12 pr-0 pl-0">
						<div class="col-12 environment pt-25 pb-10 pr-30 pl-30">
							<div class="row">
								<div class="" style="width:15%;height:20px;">
									<div class="row">
										<div class="col-5 pr-0 pl-0 text-center border bg-primary rounded-2 text-white font-b">
											<?= $terms["termName"] ?>
										</div>
										<div class="col-7 term-line-progress"></div>
									</div>
								</div>
								<div class="pr-0" style="width:23.3%;">
									<div class="row">
										<div class="col-5 font-size-10 pr-0 pl-0 text-primary pt-4 text-center">
											start Date
										</div>
										<div class="col-4  pr-0 pl-0" style="margin-top:-15px;">
											<div class="col-12 date-calendar-head"></div>
											<div class="col-12 date-calendar-body-term text-center pt-2">
												<span class="font-b font-size-11"><?= isset($startDateArr[0]) ? $startDateArr[0] : '' ?></span>
												<br>
												<?php
												if (isset($startDateArr[1]) && isset($startDateArr[2])) {
													echo $startDateArr[1] . '&nbsp;' . $startDateArr[2];
												}
												?>
											</div>
										</div>
										<div class="col-2 term-line-progress"></div>
									</div>
								</div>
								<div class="pr-0" style="width:23.3%;">
									<div class="row">
										<div class="col-5 font-size-10 pr-0 pl-0 text-primary pt-4 text-center">
											Mid Date
										</div>
										<div class="col-4  pr-0 pl-0" style="margin-top:-15px;">
											<div class="col-12 date-calendar-head"></div>
											<div class="col-12 date-calendar-body-term text-center pt-2">
												<span class="font-b font-size-11"><?= isset($midDateArr[0]) ? $midDateArr[0] : '' ?></span>
												<br>
												<?php
												if (isset($midDateArr[1]) && isset($midDateArr[2])) {
													echo $midDateArr[1] . '&nbsp;' . $midDateArr[2];
												}
												?>
											</div>
										</div>
										<div class="col-2 term-line-progress"></div>
									</div>
								</div>
								<div class="pr-0" style="width:23.3%;">
									<div class="row">
										<div class="col-5 font-size-10 pr-0 pl-0 text-primary pt-4 text-center">
											finish Date
										</div>
										<div class="col-4  pr-0 pl-0" style="margin-top:-15px;">
											<div class="col-12 date-calendar-head"></div>
											<div class="col-12 date-calendar-body-term text-center pt-2">
												<span class="font-b font-size-11"><?= isset($endDate[0]) ? $endDate[0] : '' ?></span>
												<br>
												<?php
												if (isset($endDate[1]) && isset($endDate[2])) {
													echo $endDate[1] . '&nbsp;' . $endDate[2];
												} else {
													echo 'not set';
												}
												?>
											</div>
										</div>
										<div class="col-2 term-line-progress"></div>
									</div>
								</div>
								<div class="" style="width:15%;">
									<div class="row">
										<div class="col-7 term-line-progress" style="margin-top: 12px;"></div>
										<div class="col-5 pr-0 pl-0 text-center border bg-primary rounded-2 text-white font-b">
											<?= $terms["termName"] ?>
										</div>

									</div>
								</div>
							</div>
						</div>
						<div class="col-12 environment pt-10 pb-10 pr-10 pl-10 mt-10">
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
									if (isset($terms["items"]) && count($terms["items"]) > 0) {
										foreach ($terms["items"] as $termItemId => $item) :
											$class = 'border-left-primary-frame';
									?><tr style="height: 10px;">
											</tr>
											<tr class="frame-table-tr bg-white">
												<td class="pb-0 pl-0">
													<div class="<?= $class ?> col-12 pl-10 pt-10"><?= $item["stepName"] ?></div>
												</td>
												<td class="border-left text-center td-frame">
													<span id="start-date-"><?= $item["startDate"] ?></span>

													<!-- <span class="badge bg-clder float-end" style="cursor:pointer;" data-bs-target="#set_term_date" data-bs-toggle="modal" onclick="javascript:setTermDate()"> -->
													<span class="badge bg-clder float-end">

														<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Calender.png" class="cenler-arrows">
														<img src="<?= Yii::$app->homeUrl ?>image/arrowss.png" class="iconsarrowss">
														<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Calender.png" class="cenler-arrows">
													</span>
												</td>
												<td class="text-start td-frame pl-20">
													<div class="col-12 pl-15" id="finish-date-">
														<?= $item["finishDate"] ?>
													</div>
												</td>
												<td class="border-left text-center td-frame">
													<span id="duration-date-"><?= $item["duration"] ?></span> Days
												</td>
											</tr>
									<?php
										endforeach;
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>