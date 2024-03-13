<div class="modal fade" id="set_term_date" tabindex="-1" aria-labelledby="examdipleModalemployeeSearch" aria-hidden="true">
	<div class="modal-dialog  modal-lg">
		<div class="modal-content">
			<div class="row">
				<div class="col-12 text-end font-size-20 pr-20">
					<i class="fa fa-times" aria-hidden="true" data-bs-dismiss="modal" style="cursor: pointer;"></i>
				</div>
			</div>
			<div class="col-12 pl-20 mb-20 pr-20">
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
					<input type="hidden" value="" id="termItemId">
				</div>
			</div>
		</div>
	</div>
</div>