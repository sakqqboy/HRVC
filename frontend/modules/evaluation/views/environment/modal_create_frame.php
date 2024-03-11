<div class="modal fade" id="create_frame" tabindex="-1" aria-labelledby="examdipleModalemployeeSearch" aria-hidden="true">
	<div class="modal-dialog  modal-lg">
		<div class="modal-content">
			<div class="row">
				<div class="col-8">
					<div class="row">
						<div class="col-4 font-b font-size-14 pl-30 pt-10 pr-0">Evaluation Time Frame</div>
						<div class="col-8  pt-10">
							<input type="text" class="form-control font-size-14" style="height: 30px;" id="frameName" name="frameNAme" required>
						</div>
					</div>
				</div>
				<div class="col-4 text-end font-size-20 pr-20">
					<i class="fa fa-times" aria-hidden="true" data-bs-dismiss="modal" style="cursor: pointer;"></i>
				</div>
			</div>
			<div class="col-12 pl-20 mb-20 pt-20">
				<div class="row">
					<div class="col-8">
						<div class="row">
							<div class="col-6">
								<div class="row">
									<div class="col-8" id="month-year1"><?= $thisMonth ?>&nbsp;&nbsp;&nbsp;<?= $thisYear ?></div>
									<div class="col-4 text-end pr-10">
										<a href="javascript:previousMonth(1)" class="no-underline-black">
											<i class="fa fa-angle-left mr-20" aria-hidden="true"></i>
										</a>
										<a href="javascript:nextMonth(1)" class="no-underline-black">
											<i class="fa fa-angle-right " aria-hidden="true"></i>
										</a>
									</div>
								</div>
								<input type="hidden" value="<?= (int)date('Y') ?>" id="year1">
								<input type="hidden" value="<?= (int)date('m') ?>" id="month1">
								<input type="hidden" value="" id="current-select-1">
								<div class="col-12" id="result-date1">
									<?= $this->render('calendar1', [
										"dateValue" => $dateValue,
									]) ?>
								</div>
							</div>
							<div class="col-6 pl-10 border-left">
								<div class="row">
									<div class="col-8" id="month-year2"><?= $thisMonth ?>&nbsp;&nbsp;&nbsp;<?= $thisYear ?></div>
									<div class="col-4 text-end pr-10">
										<a href="javascript:previousMonth(2)" class="no-underline-black">
											<i class="fa fa-angle-left mr-20" aria-hidden="true"></i>
										</a>
										<a href="javascript:nextMonth(2)" class="no-underline-black">
											<i class="fa fa-angle-right " aria-hidden="true"></i>
										</a>
									</div>
								</div>
								<input type="hidden" value="<?= (int)date('Y') ?>" id="year2">
								<input type="hidden" value="<?= (int)date('m') ?>" id="month2">
								<input type="hidden" value="" id="current-select-2">
								<div class="col-12" id="result-date2">
									<?= $this->render('calendar2', [
										"dateValue" => $dateValue,
									]) ?>
								</div>
							</div>
							<div class="col-12 pl-20 pr-30">
								<div class="col-12 pb-10 pt-10 pl-20 font-size-12" style="background-color: #F0F2F4;border-radius:10px;">
									<img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Calender.png" class="imagescan mr-5">
									From <span class="ml-10 mr-10" id="fromDate"> - </span>To<span class="ml-10" id="toDate">-</span>
									<input type="hidden" id="fromDateVal" value="" required>
									<input type="hidden" id="toDateVal" value="" required>

								</div>
							</div>
						</div>
					</div>
					<div class="col-4 border-left">
						<div class="col-12 font-b font-size-14" style="margin-top: -40px;">Attribute</div>
						<?php
						if (isset($attribute) && count($attribute) > 0) {
							foreach ($attribute as $atr) : ?>
								<div class="row mt-20">
									<div class="col-2 pr-0 text-end">
										<input type="radio" class="form-check-input" name="attribute" required>
									</div>
									<div class="col-3 mt-12 border-top"></div>
									<div class="col-6 border pt-3 pb-3 pr-0 pl-5 text-center font-size-11" style="margin-top: -1px;"><?= $atr["attributeName"] ?></div>
								</div>
						<?php
							endforeach;
						}
						?>
						<div class="col-12 mt-30 font-size-12">
							<span class="text-danger font-b">*</span> MidTerm Review
							<div class="col-12 mt-10">
								<input type="radio" class="form-check-input" name="isMid" required> Yes
								<input type="radio" class="form-check-input ml-20" name="isMid" required> No
							</div>
						</div>
						<div class="col-12 text-end pr-10 pt-10 pb-5">
							<input type="hidden" id="environmentId" value="">
							<button type="submit" class="btn btn-primary font-size-14">Create</button>
							<!-- <a href="javascript:checkFrameRequire()" class="btn btn-primary font-size-14">Create</a> -->
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>