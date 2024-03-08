<div class="modal fade" id="create_frame" tabindex="-1" aria-labelledby="examdipleModalemployeeSearch" aria-hidden="true">
	<div class="modal-dialog  modal-lg">
		<div class="modal-content">
			<div class="row">
				<div class="col-8">
					<div class="row">
						<div class="col-4 font-b font-size-14 pl-30 pt-10 pr-0">Evaluation Time Frame</div>
						<div class="col-8  pt-10">
							<input type="text" class="form-control font-size-14" style="height: 30px;">
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
									<div class="col-8"><?= $thisMonth ?>&nbsp;&nbsp;&nbsp;<?= $thisYear ?></div>
									<div class="col-4"></div>
								</div>
								<?= $this->render('calendar1', [
									"dateValue" => $dateValue,
								]) ?>
							</div>
							<div class="col-6 pl-10 border-left">
								<div class="row">
									<div class="col-8"><?= $thisMonth ?>&nbsp;&nbsp;&nbsp;<?= $thisYear ?></div>
									<div class="col-4"></div>
								</div>
								<?= $this->render('calendar2', [
									"dateValue" => $dateValue,
								]) ?>
							</div>
						</div>
					</div>
					<div class="col-4 border-left">
						<div class="col-12 font-b font-size-14" style="margin-top: -40px;">Attribute</div>
						<div class="row mt-20">
							<div class="col-2 pr-0 text-end">
								<input type="radio" class="form-check-input">
							</div>
							<div class="col-3 mt-12 border-top"></div>
							<div class="col-6 border font-size-12 pt-3 pb-3 text-center" style="margin-top: -1px;">Annlual Assessment</div>
						</div>
						<div class="row mt-20">
							<div class="col-2 pr-0 text-end">
								<input type="radio" class="form-check-input">
							</div>
							<div class="col-3 mt-12 border-top"></div>
							<div class="col-6 border font-size-12 pt-3 pb-3 text-center" style="margin-top: -1px;">Annlual Assessment</div>
						</div>
						<div class="row mt-20">
							<div class="col-2 pr-0 text-end">
								<input type="radio" class="form-check-input">
							</div>
							<div class="col-3 mt-12 border-top"></div>
							<div class="col-6 border font-size-12 pt-3 pb-3 text-center" style="margin-top: -1px;">Annlual Assessment</div>
						</div>
						<div class="row mt-20">
							<div class="col-2 pr-0 text-end">
								<input type="radio" class="form-check-input">
							</div>
							<div class="col-3 mt-12 border-top"></div>
							<div class="col-6 border font-size-12 pt-3 pb-3 text-center" style="margin-top: -1px;">Annlual Assessment</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>