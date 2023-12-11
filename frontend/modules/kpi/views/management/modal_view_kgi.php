<div class="modal fade" id="kgi-view" tabindex="-1" aria-labelledby="exampleModalViewkgi3Label" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="border: none;">

				<div class="modal-title flag-Backdrop7" id="exampleModalViewkgi3Label">
					<i class="fa fa-flag-o" aria-hidden="true"></i>
					<span class="ml-10" id="kgi-name-view"></span>
				</div>
				<div class="modal-title border Completed-Backdrop7 badge rounded-pill bg-warning text-dark" id="status-view"></div>
				<span class="border border-1 border-deadline-Backdrop7">Deadline <span class="font-size-10 text-dark pr-10"> : <span id="period-date-view"></span></span></span>
			</div>
			<div class="text-end">
				<span class="border border-1 border-next-Backdrop7">Next Update <span class="font-size-10 text-dark pr-10"> : <span id="next-date-view"></span></span></span>
			</div>
			<div class="tk" id="company-name-view"></div>
			<div class="col-12 font-size-12 pl-10 pt-5">
				<img src="<?= Yii::$app->homeUrl ?>image/is.jpg" class="Round1"> <span id="branch-view"></span>, <span id="country-view"></span>
			</div>

			<div class="modal-body">
				<div class="col-12 dashed-Backdrop7">
					<div class="row mt-20">
						<div class="col-lg-3 col-md-6 col-12">
							<div class="col-12 content-KGI">
								Team KGI Contents
							</div>
							<div class="col-12 KGI-Clients">
								Ten Clients employee
							</div>
						</div>
						<div class="col-lg-2 col-md-6 col-3">
							<div class="col-12 Quant-ratio-Backdrop3">
								Quant Ratio
							</div>
							<div class="col-12 diamond-con-Backdrop3">
								<i class="fa fa-diamond" aria-hidden="true"></i> <span id="quantRatio-view"></span>
							</div>
						</div>
						<div class="col-lg-1 col-md-6 col-2">
							<div class="col-12 padding-FEB-Backdrop7">
								<span id="month-view"></span>
							</div>
						</div>
						<div class="col-lg-2 col-md-6 col-3">
							<div class="col-12 bullseye-con-Backdrop3">
								<i class="fa fa-bullseye" aria-hidden="true"></i> Target
							</div>
							<div class="col-12 million-number-Backdrop3">
								<span id="target-view"></span>
							</div>
						</div>
						<div class="col-lg-1 col-md-6 col-3">
							<div class="col-12 padding-mark-Backdrop3 mt-15">
								<span id="code-view"></span>
							</div>
							<div class="col-12">

							</div>
						</div>
						<div class="col-lg-2 cl-md-6 col-3">
							<div class="col-12 trophy-con-Backdrop3">
								<i class="fa fa-trophy" aria-hidden="true"></i> Result
							</div>
							<div class="col-12 million-number-Backdrop3">
								<span id="result-view"></span>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3 col-md-6 col-12">
								<div class="col-12">
									<p class="Priority1">Priority</p>
									<div class="circle-Priority" id="prirority-view"></div>
								</div>
							</div>
							<div class="col-lg-4 col-md-6 col-6">
								<div class="col-12 padding-update-Backdrop3">
									Update Interval
								</div>
								<div class="col-12 update-mouth-Backdrop3" id="unit-view">

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
				</div>
				<div class="col-12 Description-Backdrop7 pl-10">
					Description
				</div>
				<div class="col-12 detailsDescription-Backdrop3 pl-20" id="decription-view">

				</div>
				<div class="row mt-20">
					<div class="col-12">
						<div class="row">
							<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
								<li class="col-lg-6 col-md-6 col-6 pl-20">
									<a class="link-3" type="button" role="tab" aria-controls="v-pills-team1" aria-selected="true"> Team</a>
								</li>
								<li class="col-lg-6 col-md-6 col-6">
									<a class="link-3" type="button" role="tab" aria-controls="v-pills-Assign" aria-selected="true"> Assign Members</a>
								</li>
							</ul>
							<hr style="margin-top: -8px;">
						</div>

					</div>
					<div class="col-lg-6 col-md-6 col-12 pl-40" id="team-view">

					</div>
					<div class="col-lg-6 col-md-6 col-12 pl-40" id="employee-view">
					</div>
				</div>
				<div class="col-12 History-Backdrop3">
					Update Description
				</div>
				<hr>
				<div class="col-12" id="kgi-history"></div>
			</div>
		</div>
	</div>
</div>