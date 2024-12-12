<div class="modal fade" id="kgi-view-team" tabindex="-1" aria-labelledby="exampleModalViewkgi3Label" aria-hidden="true" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="border: none;">

				<div class="modal-title flag-Backdrop7" id="exampleModalViewkgi3Label">
					<i class="fa fa-flag-o" aria-hidden="true"></i>
					<span class="ml-10" id="kgi-name-view"></span>
				</div>
				<div class="modal-title border Completed-Backdrop7 badge rounded-pill bg-warning text-dark" id="status-view"></div>
				<span class="border border-1 border-deadline-Backdrop7"><?= Yii::t('app', 'Deadline') ?> <span class="font-size-10 text-dark pr-10"> : <span id="period-date-view"></span></span></span>
			</div>
			<div class="col-12 text-end">
				<span class="border border-1 border-next-Backdrop7"><?= Yii::t('app', 'Next Update') ?> <span class="font-size-10 text-dark pr-10"> : <span id="next-date-view"></span></span></span>
			</div>
			<div class="modal-body">
				<div class="col-12 dashed-Backdrop7">
					<div class="row mt-20">
						<div class="col-2">

						</div>
						<div class="col-lg-2 col-md-6 col-3">
							<div class="col-12 Quant-ratio-Backdrop3">
								Quant Ratio
							</div>
							<div class="col-12 diamond-con-Backdrop3">
								<i class="fa fa-diamond mr-5" aria-hidden="true"></i> <span id="quantRatio-view"></span>
							</div>
						</div>
						<div class="col-3 text-center">
							<div class="col-12 bullseye-con-Backdrop3">
								<i class="fa fa-bullseye" aria-hidden="true"></i> <?= Yii::t('app', 'Target') ?>
							</div>
							<div class="col-12 million-number-Backdrop3">
								<span id="target-view"></span>
							</div>
						</div>
						<div class="col-2">
							<div class="col-12 padding-mark-Backdrop3 mt-15 text-center">
								<span id="code-view" class="font-b"></span>
							</div>
						</div>
						<div class="col-3 text-center">
							<div class="col-12 trophy-con-Backdrop3">
								<i class="fa fa-trophy" aria-hidden="true"></i> <?= Yii::t('app', 'Result') ?>
							</div>
							<div class="col-12 million-number-Backdrop3">
								<span id="result-view"></span>
							</div>
						</div>

					</div>
					<div class="row">
						<div class="col-2">
							<div class="col-12" style="margin-left:-70px !important; margin-top:-40px;">
								<p class="Priority1">Priority</p>
								<div class="circle-Priority" id="prirority-view"></div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-6">
							<div class="col-12 padding-update-Backdrop3">
								Update Interval
							</div>
							<div class="col-12 update-mouth-Backdrop3">
								<i class="fa fa-calendar mr-7" aria-hidden="true"></i> <span id="unit-view"></span>
							</div>
						</div>
						<div class="col-lg-5 col-md-6 col-6 mt-10">
							<div class="col-12">
								<div class="progress">
									<div class="progress-bar" id="percentRatio" style="background:#2F80ED;margin-left:-50px;height:13px;"></div>
									<span class="badge rounded-pill pro-load-Backdrop7" id="ratio-view"></span>
								</div>
							</div>
						</div>
						<div class="mt-5"></div>
					</div>
				</div>
				<div class="col-12 Description-Backdrop7 pl-10">
					<?= Yii::t('app', 'Description') ?>
				</div>
				<div class="col-12 detailsDescription-Backdrop3 pl-20" id="decription-view">

				</div>

				<div class="col-12 Description-Backdrop7 pl-10">
					<?= Yii::t('app', 'Update Histories') ?>
				</div>
				<hr>
				<div class="col-12 history-box" id="kgi-history">

				</div>
			</div>
		</div>
	</div>
	<input type="hidden" id="v-kgiId" value="">
</div>