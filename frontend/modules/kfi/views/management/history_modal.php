<div class="modal fade" id="staticBackdrop3" tabindex="-1" aria-labelledby="staticBackdrop3" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="border-bottom:none;">
				<div class="modal-title Modalfirstone" id="staticBackdrop"><i class="fa fa-line-chart mr-5" aria-hidden="true"></i>
					<span id="kfiNameHistory"></span>
				</div>
				<div class="modal-title badge rounded-pill bg-warning text-dark font-size-14" id="statusHistory">Completed</div>
			</div>
			<div class="text-end mr-20">
				<span class="border border-1 text-dark pr-10 pl-5" style="border-radius: 15px;">
					<span class="deadline-Backdrop3">Deadline&nbsp;&nbsp;</span>
					<span class="font-size-11" id="deadlineHistory"></span>
				</span>
			</div>
			<div class="text-end mt-10 mr-20">
				<span class="border border-1 text-dark pr-10 pl-5" style="border-radius: 15px;">
					<span class="NextUpdate-Backdrop3">Next Update&nbsp;&nbsp;</span>
					<span class="font-size-11" id="NextCheckDateHistory"> </span>
				</span>
			</div>
			<!-- <div class="view-show-name" id="companyHistory">Tokyo Consulting Firm Limited </div> -->
			<div class="col-12">
				<div class="row mt-10">
					<div class="col-6 text-start country-show-name">
						<img src="<?= Yii::$app->homeUrl ?>image/is.jpg" class="is-bangladresh2"> <span id="branchHistory"></span>, <span id="countryHistory"></span>
					</div>
					<div class="col-6 text-end font-size-12 pr-30">
						<span class="" style="cursor: pointer;">
							<i class="fa fa-refresh mr-5" aria-hidden="true"></i>KGI
						</span>
					</div>
				</div>
			</div>

			<div class="modal-body mt-10">
				<div class="col-12 dashed-Backdrop3">
					<div class="row mt-20">
						<div class="col-lg-2 col-md-6 col-2">
							<div class="col-12 padding-FEB-Backdrop3" id="monthHistory">

							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-3">
							<div class="col-12 Quant-ratio-Backdrop3">
								Quant Ratio
							</div>
							<div class="col-12 diamond-con-Backdrop3 mt-10">
								<i class="fa fa-diamond" aria-hidden="true"></i>
								<span id="quanRatioHistory"></span>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-3">
							<div class="col-12 bullseye-con-Backdrop3">
								<i class="fa fa-bullseye" aria-hidden="true"></i> Target
							</div>
							<div class="col-12 million-number-Backdrop3" id="targetHistory">

							</div>
						</div>
						<div class="col-lg-1 col-md-6 col-3">
							<div class="col-12 padding-mark-Backdrop3" id="codeHistory">

							</div>
						</div>
						<div class="col-lg-3 cl-md-6 col-3">
							<div class="col-12 trophy-con-Backdrop3">
								<i class="fa fa-trophy" aria-hidden="true"></i> Result
							</div>
							<div class="col-12 million-number-Backdrop3" id="resultHistory">

							</div>
						</div>
						<div class="row">
							<div class="col-lg-2 col-md-6 col-6"></div>
							<div class="col-lg-4 col-md-6 col-6">
								<div class="col-12 padding-update-Backdrop3">
									Update Interval
								</div>
								<div class="col-12 update-mouth-Backdrop3" id="unitHistory">

								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-6 mt-10">
								<div class="col-12">
									<div class="progress">
										<div class="progress-bar" style="background:#2F80ED;margin-left:-50px;" id="progressHistory"></div>
										<span class="badge rounded-pill  pro-load-Backdrop3" id="decimalHistory"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 Description-Backdrop3">
					Description
				</div>
				<div class="col-10 detailsDescription-Backdrop3" id="detailHistory">

				</div>
				<div class="col-12 History-Backdrop3">
					Update Description
				</div>
				<div class="col-12 mt-15" id="showHistory"></div>
				<div class="col-12 mt-15" id="showIssue"></div>
				<hr>
				<div class="col-12 text-end">
					<input id="v-kfiId" value="" type="hidden">
					<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>