<html>

<title>Annual comparison</title>

<Head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="../css/layout/font.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/layout/layout.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/fs.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/chart.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">

</Head>

<body>
	<div class="col-12">
		<div class="col-12 alert background-Planning">
			<div class="col-12 planning">
				<img src="../images/icons/Dark/48px/FinanicalPlanning.png" class="images_Dark_FinanicalPlanning"> Financial Planning
			</div>
			<div class="col-12 mt-10">
				<div class="shadow pb-5 pt-5 mb-5 bg-body rounded alert2-secondary3">
					<ul class="nav nav-pills" id="pills-tab" role="tablist">
						<li class="nav-item" role="presentation">
							<a class="nav-link text-dark" id="pills-Forcast-tab" data-bs-toggle="pill" data-bs-target="#pills-Forcast" type="button" role="tab" aria-controls="pills-Forcast" aria-selected="true"><img src="../images/icons/Dark/48px/PL-Forecast.png" class="images_performance_PL"> PL Forcast</a>
						</li>
						<li class="nav-item" role="presentation">
							<a class="nav-link text-dark" id="pills-Golden-tab" data-bs-toggle="pill" data-bs-target="#pills-Golden" type="button" role="tab" aria-controls="pills-Golden" aria-selected="false"><img src="../images/icons/Dark/48px/Golden-Ratio.png" class="images_performance_PL"> Golden Ratio</a>
						</li>
						<li class="nav-item" role="presentation">
							<a class="nav-link text-dark" id="pills-Accounts-tab" data-bs-toggle="pill" data-bs-target="#pills-Accounts" type="button" role="tab" aria-controls="pills-Accounts" aria-selected="false"><img src="../images/icons/Dark/48px/Designation-1.png" class="images_performance_PL"> Forecast Accounts</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-12 mt-15">
				<div class="alert alert2-secondary3">
					<div class="row">
						<div class="col-lg-2 col-12 pl-0">
							<div class="row">
								<div class="col-2 ">
									<span class="badge bg-primary-summary">PL</span>
								</div>
								<div class="col-10">
									Profit & Loss Forecast
								</div>
							</div>
						</div>
						<div class="col-lg-10 col-12 text-end pr-0">
							<button type="button" class="btn btn-light text-primary font-size-12" data-bs-toggle="modal" data-bs-target="#DataDistionary">
								<i class="fa fa-info-circle" aria-hidden="true"></i> Data Dictionary
							</button>
							<div class="btn-group ml-15 " role="group">
								<button type="button" class="btn btn-outline-secondary font-size-12" style="border-color:lightgray;">
									<i class="fa fa-bar-chart" aria-hidden="true"></i>
								</button>
								<button type="button" class="btn btn-outline-secondary font-size-12" style="border-color:lightgray;">
									Performance Chart
								</button>
								<button type="button" class="btn btn-outline-secondary font-size-12" style="border-left: 0;border-right:0;border-color:lightgray;">IPL Analysis</button>
								<button type="button" class="btn btn-outline-secondary font-size-12" style="border-color:lightgray;">PLF Overview</button>
							</div>
						</div>

					</div>
					<div class="col-12 mt-15">
						<div class="row " style="background-color: #dee2e6;border-radius:2px;">
							<div class="col-1 font-b font-size-13 pt-5">
								PL Content
							</div>
							<div class="col-1 text-secondary pl-5 pr-2 pt-3">
								<img src="../image/calendar.png" style="width: 13px;"> &nbsp;
								<span class="font-size-12">Current Year</span>
							</div>
							<div class="col-2 pt-3 pb-3">
								<select class="form-select text-primary" style="height: 25px;font-size:10px;">
									<option value="2020">2020</option>
									<option value="2021">2021</option>
									<option value="2022">2022</option>
									<option value="2023">2024</option>
								</select>
							</div>
							<div class="col-8 text-end pt-10">
								<strong class="text-secondary font-size-12">F.Y.2023 (Annual)</strong>
							</div>
						</div>
					</div>
					<div class="row" style="margin-top: 10">
						<div class="col-12  font-size-16 text-center">
							<strong> Annual Comparison Chart</strong>
						</div>
						<div class="col-12 font-size-14 text-primary" style="margin-top: -10px;">
							< Data table </div>

						</div>
					</div>
					<?php
					for ($j = 1; $j <= 4; $j++) {
					?>
						<div class="row mt-10 pl-10">
							<div class="col-1 text-center" style="background-color: white;">
								<div class="col-12 text-center mt-15 mb-10">
									<img src="../images/icons/Dark/48px/Accumulated.png" class="icons_Monthly">
								</div>
								<div class="col-12 mt-5">
									<span class="badge bgAAR-1">AAR</span>
								</div>
								<div class="col-12 mt-5">
									<span class="badge bgAAR1_green">AAR</span>
								</div>
								<div class="col-12 mt-5">
									<span class="badge bgART1warning">ATR</span>
								</div>
								<div class="col-12 mt-5">
									<span class="badge bgATRworm">ATR</span>
								</div>
							</div>
							<div class="col-11">
								<div class="row">
									<?php
									for ($i = 1; $i <= 4; $i++) {
									?>
										<div class="mr-10 pr-0" style="width: 24.14%;">
											<div class="shadow p-2 bg-body rounded">
												<div class="col-12 badge bg light-shadow text-dark text-start">
													Sales
												</div>
												<div class="row mt-10">
													<div class="row">
														<div class="col-lg-3 text-secondary font-size-12">
															2022
														</div>
														<div class="col-lg-7 pt-5 mt-2 pr-0 pl-0">
															<div class="progress progress-thin" style="height: 8px;">
																<div class="progress-bar bg-bar-background-1" role="progressbar" style="width: 26%;" aria-valuenow="26" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
														<div class="col-lg-2 text-secondary font-size-12 text-end pr-0">
															26%
														</div>
													</div>
													<div class="row">
														<div class="col-lg-3 text-secondary font-size-12">
															2023
														</div>
														<div class="col-lg-7  mt-2 pr-0 pl-0">
															<div class="progress progress-thin" style="height: 8px;">
																<div class="progress-bar bg-bar-background-2" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
														<div class="col-lg-2 text-secondary font-size-12 text-end pr-0">
															100%
														</div>
													</div>
													<div class="row">
														<div class="col-lg-3 font-size-12">
															2023 <span class="badge bdg-2580D3">C</span>
														</div>
														<div class="col-lg-7  mt-2 pr-0 pl-0">
															<div class="progress progress-thin" style="height: 8px;">
																<div class="progress-bar bg-bar-background-3" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
														<div class="col-lg-2 font-size-12 text-end pr-0">
															82%
														</div>
													</div>
													<div class="row">
														<div class="col-lg-3 text-secondary font-size-12">
															2024
														</div>
														<div class="col-lg-7  mt-2 pr-0 pl-0">
															<div class="progress progress-thin" style="height: 8px;">
																<div class="progress-bar bg-bar-background-4" role="progressbar" style="width: 93%" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
														<div class="col-lg-2 text-secondary font-size-12 text-end pr-0">
															93%
														</div>
													</div>
												</div>
												<div class="border-bottom"></div>
											</div>
										</div>
									<?php
									}
									?>
								</div>
							</div>
						</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
</body>