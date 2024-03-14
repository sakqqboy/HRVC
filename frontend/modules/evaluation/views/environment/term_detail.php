<?php
$this->title = 'Term Detail';
?>
<div class="col-12 mt-70 environment pt-10 pr-10 pl-20">
	<div class="row">
		<div class="col-2 pr-0 pl-5">
			<?= $this->render('menu_left') ?>
		</div>
		<div class="col-lg-10 col-md-6 col-12 environment">
			<div class="col-12 bg-white pr-15 pl-15 pt-10 rounded-2">
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
								<?= $this->render('calendar1', [
									"dateValue" => $dateValue,
								]) ?>
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
					<div class="col-lg-8 col-12 pr-0 pl-0">
						<div class="col-12 environment pt-30 pb-10 pr-30 pl-30">
							<div class="row">

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

									for ($i = 1; $i <= 5; $i++) {
										$class = 'border-left-primary-frame';
									?><tr style="height: 10px;">
										</tr>
										<tr class="frame-table-tr bg-white">
											<td class="pb-0 pl-0">
												<div class="<?= $class ?> col-12 pl-10 pt-10">Step Name</div>
											</td>
											<td class="border-left text-center td-frame">
												<span id="start-date-"></span>

												<span class="badge bg-clder float-end" style="cursor:pointer;" data-bs-target="#set_term_date" data-bs-toggle="modal" onclick="javascript:setTermDate()">
													<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Calender.png" class="cenler-arrows">
													<img src="<?= Yii::$app->homeUrl ?>image/arrowss.png" class="iconsarrowss">
													<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Calender.png" class="cenler-arrows">
												</span>
											</td>
											<td class="text-start td-frame pl-20">
												<div class="col-12 pl-15" id="finish-date-"></div>
											</td>
											<td class="border-left text-center td-frame">
												<span id="duration-date-">0</span> Days
											</td>
										</tr>
									<?php
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