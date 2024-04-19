<html>

<title>PL Ddfault 12 Months Dashboard</title>

<Head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link href="../css/layout/font.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/layout/layout.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/fs.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
				<div class="alert alert2-secondary3 pr-17">
					<div class="row">
						<div class="col-2">
							<div class="row">
								<div class="col-2 ">
									<span class="badge bg-primary-summary">PL</span>
								</div>
								<div class="col-10">
									Profit & Loss Forecast
								</div>
							</div>
						</div>
						<div class="col-lg-3 pl-0">
							<button type="button" class="btn btn-primary Register_financial text-center pt-3 pb-5">
								<i class="fa fa-magic" aria-hidden="true"></i>&nbsp;&nbsp; Register
							</button>
						</div>
						<div class="col-lg-4 col-12">
							<button type="button" class="btn btn-light Data" data-bs-toggle="modal" data-bs-target="#DataDistionary"> <i class="fa fa-exclamation-circle" aria-hidden="true"></i> Data Dictionary</button>
							<button type="button" class="btn btn-light Data"> <i class="fa fa-line-chart" aria-hidden="true"></i> Comparison Charts</button>
							<button type="button" class="btn btn-light Data"> <i class="fa fa-arrow-circle-down" aria-hidden="true"></i> Export</button>
						</div>
						<div class="col-lg-2 col-12 select_buttongroup">
							<select class="form-select example-tok" aria-label="Default select example">
								<option selected value="">Select</option>
								<option value="1">Tokyo Consulting Group</option>
								<option value="2">Tokyo Consulting firm</option>
							</select>
						</div>
						<div class="col-lg-1 col-12 text-end">
							<img src="../images/icons/Dark/48px/FilterPlus.png" class="picture-FilterPlus-bonus">
							<span class="financial_filter" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#Modalfitter">
								Filter
							</span>
							<img src="../images/icons/Dark/48px/3Dot.png" class="bonus-point">
						</div>
					</div>
					<div class="row mt-10 pr-0">
						<div class="col-lg-5 col-11">
							<div class="col-11">
								<div class="row " style="background-color: #dee2e6;border-radius:2px;">
									<div class="col-3 text-secondary pl-5 pr-2 pt-5">
										<img src="../image/calendar.png" style="width: 13px;"> &nbsp;
										<span class="font-size-12">Current Year</span>
									</div>
									<div class="col-4 pt-3 pb-3">
										<select class="form-select text-primary" style="height: 25px;font-size:10px;">
											<option value="2020">2020</option>
											<option value="2021">2021</option>
											<option value="2022">2022</option>
											<option value="2023">2024</option>
										</select>
									</div>
									<div class="col-5 text-end pt-10">
										<strong class="text-secondary font-size-12">F.Y.2023</strong>
									</div>
								</div>
								<div class="row pr-0 pl-0 mt-5">
									<div class="col-4 line mt-15"></div>
									<div class="col-4 font-size-10 mt-8 text-center" style="letter-spacing: 1px;">ANNUAL SUMMARY</div>
									<div class="col-4 line mt-15"></div>
								</div>
							</div>

							<div class="row">
								<div class="col-11">
									<div class="row mt-15 pb-5" style="background-color: #dee2e6;border-radius:2px;">
										<div class="col-3 item pt-5 border-right text-center">
											ITEMS
										</div>
										<div class="col-2">
											<div class="row pl-10">
												<div class="col-5 badge dge_AAR_blue font-size-8 mt-5 pt-5 pl-3">AAR</div>
												<div class="col-6 AA-2022 pl-3 pt-5">2022</div>
											</div>
										</div>
										<div class="col-2">
											<div class="row pl-10">
												<div class="col-5 badge dge_AAR_green font-size-8 mt-5 pt-5 pl-3">AAR</div>
												<div class="col-6 AA-2022 pl-3 pt-5">2023</div>
											</div>
										</div>
										<div class="col-3 pl-10">
											<div class="row">
												<div class="col-4 badge dge_AAR_warning font-size-8 mt-5 pt-5">AT</div>
												<div class="col-4 AA-2022 pt-5 pl-7">2023</div>
												<div class="col-4 badge dge_AAR_warning font-size-8 mt-5 pt-5">ATR</div>
											</div>
										</div>
										<div class="col-2">
											<div class="row pl-12">
												<div class="col-5 badge dge_AAR_light_blue font-size-8 mt-5 pt-5 pl-3 pr-3">ATR</div>
												<div class="col-6 AA-2022 pl-3 pt-5">2024</div>
											</div>
										</div>
									</div>
									<?php
									for ($i = 1; $i <= 15; $i++) {
									?>
										<div class="row mt-5 border-buttom pb-5">
											<div class="col-3 p-Gross border-right bg-light text-left pt-13">
												Sales
											</div>
											<div class="col-2 border-right bg-light pt-5 pb-5">
												<div role="progressbar1" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" style="--value:35"></div>
											</div>
											<div class="col-2 border-right bg-light pt-5 pb-5">
												<div role="progressbar2" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="--value:75"></div>
											</div>
											<div class="col-3 border-right bg-light pt-15 pb-5 pl-17">
												<span class="numberrformat"><?= number_format(24700) ?> </span>
												<div role="progressbar3" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="--value:100"></div>
											</div>
											<div class="col-2 bg-light pt-5 pb-5">
												<div role="progressbar1" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="--value:100"></div>
											</div>
										</div>
									<?php
									}
									?>
								</div>
								<div class="col-1 mt-15  pl-15 pr-15">
									<div class="row">
										<div class="col-12 text-center pt-8 pb-18" style="background-color:#dee2e6;">
											<img src="../images/icons/Dark/48px/Edit.png" class="icons_Edits">
										</div>
									</div>
									<?php
									for ($i = 1; $i <= 15; $i++) {
									?>
										<div class="row" style="height:<?= $i == 15 ? '38px;' : '51px;' ?>background-color:#dee2e6;">
											<div class="col-12 text-center">
												<img src="../images/icons/Dark/48px/Monthly.png" class="icons_Monthly">
												<div class="m-calendar mt-2"></div>
											</div>
											<div class="col-12 text-center" style="margin-top: <?= $i == 15 ? '-9px;' : '-18px;' ?>">
												<img src="../images/icons/Dark/48px/Accumulated.png" class="icons_Monthly">
											</div>
										</div>
									<?php
									}
									?>
								</div>
							</div>
						</div>
						<div class="col-lg-7">
							<div class="row " style="background-color: #dee2e6;border-radius:2px;">
								<div class="col-8">
									<div class="row">
										<div class="col-2 BTH1">
											BTH (฿)
										</div>
										<div class="col-2 text-secondary financial_all_Roundup pr-0 pt-5">
											<img src="../images/icons/Dark/48px/Round-Up.png" class="images_Round-Up" data-bs-toggle="modal" data-bs-target="#RoundUp"> <span class="text_Roundup1">Round Up</span>
										</div>
										<div class="col-3 pl-0 pt-3">
											<select class="form-select text-primary" style="height: 25px;font-size:10px;">
												<option selected value="">None</option>
												<option value="1">2020</option>
												<option value="2">2021</option>
												<option value="3">2022</option>
												<option value="4">2024</option>
											</select>
										</div>
										<div class="col-5  pt-4 pl-3">
											<div class="bg-light circledollar text-center pt-4" data-bs-toggle="modal" data-bs-target="#staticBackdropCurrency" style="font-size:10; cursor: pointer;">
												<i class="fa fa-usd pl-1 font-size-10" aria-hidden="true"></i>
												<span class="Curr">Currency</span>
											</div>
										</div>
									</div>

								</div>
								<div class="col-4 font-size-11 text-end pt-2 pb-3">
									<a class="btn btn-light font-size-10 no-border mr-5 font-b">All</a>
									<a class="btn btn-outline-secondary font-size-10 no-border mr-5 font-b">Q1</a>
									<a class="btn btn-outline-secondary font-size-10 no-border mr-5 font-b">Q2</a>
									<a class="btn btn-outline-secondary font-size-10 no-border font-b">Q3</a>
								</div>

							</div>
							<div class="row pr-0 pl-0 mt-5">
								<div class="col-5 line mt-15"></div>
								<div class="col-2 font-size-10 mt-8 text-center" style="letter-spacing: 1px;">QUARTERLY</div>
								<div class="col-5 line mt-15"></div>
							</div>
							<div class="col-12 mt-13">
								<div class="row">
									<?php
									$months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
									foreach ($months as $month) :
									?>
										<div class="col-1 months_lights_page">
											<div class="row">
												<div class="col-9 font-size-9 text-start pl-3 pt-3" style="letter-spacing: 0.3px;background-color: #ececec;">
													<?= $month ?>
												</div>
												<div class="col-3 pr-2 pl-0 pt-8 text-end" style="letter-spacing: 0.5px;background-color: #ececec;">
													<img src="../images/icons/Dark/48px/ExpandAside.png" class="images_CoolapseAside1">
												</div>
											</div>
											<div class="row">
												<div class="col-12 font-size-7 pr-3 pb-3 pl-0 text-end pr-0" style="letter-spacing: 0.5px;background-color: #ececec;">
													<div class="row">
														<div class="col-3"></div>
														<div class="col-3 mt-5 badge dge_AAR_green1" style="height:10px;">AC</div>
														<div class="col-5 pl-2 mt-5 font-size-9">2023</div>
													</div>
												</div>
											</div>
										</div>
									<?php
									endforeach;
									?>
								</div>
								<?php
								for ($i = 1; $i <= 15; $i++) {
								?>
									<div class="row">
										<?php
										foreach ($months as $month) :
										?>
											<div class="col-1 text-center mt-3 border-buttom pr-3 pl-3 mb-8">
												<div class="col-12  months_lights pr-5 pl-5">
													<div class="col-12 months12_number pt-0">
														<?= number_format(1000000) ?>
													</div>
													<div class="col-12 months12_number_notsolid pr-5 pl-5 pb-3">
														<?= number_format(1000) ?>
													</div>
												</div>
											</div>
										<?php
										endforeach;
										?>
									</div>
								<?php
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="modal fade" id="Modalfitter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content modal-fitter">
					<div class="modal-header" style="border: none;">
						<div id="ModalfitterLabel">
							<img src="../images/icons/Dark/48px/FilterPlus.png" class="picture-FilterPlus-bonus border-change"> <span class="Data_Filterfinancial1"> Data Filter</span>
						</div>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="card">
							<div class="col-12 mt-20">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="Previous">
									<label class="form-check-label" for="flexCheckDefault">
										<span class="AC-Primary"> AC </span> &nbsp;&nbsp; Previous Year Actual
									</label>
								</div>
							</div>
							<div class="col-12 mt-20">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="Previous">
									<label class="form-check-label" for="flexCheckDefault">
										<span class="AC-Success"> AC </span> &nbsp;&nbsp; Current Year Actual
									</label>
								</div>
							</div>
							<div class="col-12 mt-20">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="Previous">
									<label class="form-check-label" for="flexCheckDefault">
										<span class="T-Warning"> T </span> &nbsp;&nbsp; Current Year Target
									</label>
								</div>
							</div>
							<div class="col-12 mt-20">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="Previous">
									<label class="form-check-label" for="flexCheckDefault">
										<span class="T-bule"> T </span> &nbsp;&nbsp; Next year Target
									</label>
								</div>
							</div>
							<div class="text-Done" data-bs-dismiss="modal" aria-label="done">
								Done
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="DataDistionary" tabindex="-1" aria-labelledby="DataDistionaryLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content modal-DataDistionary">
					<div class="modal-header" style="border: none;">
						<div id="DataDistionaryLabel">
							Data Dictionary
						</div>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-6 Accumulate_text">
								<img src="../images/icons/Dark/48px/Accumulated.png" class="Dark_Monthly"> Accumulate
							</div>
							<div class="col-6 Accumulate_text">
								<img src="../images/icons/Dark/48px/Monthly.png" class="Dark_Monthly"> Monthly
							</div>
							<hr class="mt-5">
						</div>
						<div class="row">
							<div class="col-4 text-end">
								<span class="AC-Primary"> AAR </span>
							</div>
							<div class="col-8 AC-Accumulate">
								Accumulate Actual Ratio
							</div>
							<div class="col-4 text-end">
								<span class="AC-Success"> AAR </span>
							</div>
							<div class="col-8 AC-Accumulate">
								Accumulate Actual Ratio
							</div>
							<div class="col-4 text-end">
								<span class="T-Warning"> AT </span>
							</div>
							<div class="col-8 AC-Accumulate">
								Accumulate Target
							</div>
							<div class="col-4 text-end">
								<span class="T-Warning"> ATR </span>
							</div>
							<div class="col-8 AC-Accumulate">
								Accumulate Target ratio
							</div>
							<div class="col-4 text-end">
								<span class="T-bule"> ATR </span>
							</div>
							<div class="col-8 AC-Accumulate">
								Accumulate Target ratio
							</div>
							<hr>

							<div class="col-4 text-end">
								<span class="AC-Success"> AC </span>
							</div>
							<div class="col-8 AC-Accumulate">
								Actual
							</div>
							<div class="col-4 text-end">
								<span class="T-Warning"> T </span>
							</div>
							<div class="col-8 AC-Accumulate">
								Actual
							</div>
							<hr>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<div class="modal fade" id="staticBackdropCurrency" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelCurrency" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="container">
					<div class="modal-header">
						<div class="modal-title" id="staticBackdropLabel"> <span class="Currency_Conversion_Rate">Currency Conversion Rate</span> </div>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-5 col-md-6 col-6">
								<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/css/bootstrap-select.css" />
								<div class="select_picker">
									<div class="select_Fromplanning">
										<div class="set_fontFrom">From</div>
									</div>
									<div class="row">
										<select class="selectpicker" data-show-subtext="true" data-live-search="true">
											<option>John Smith</option>
											<option>Alex Johnson</option>
											<option>Kevin Warren</option>
											<option>Super Mario</option>
											<option>Allen Martinez</option>
											<option>Marvin Liberty</option>
										</select>
									</div>
								</div>
								<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
								<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
								<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
								<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/js/bootstrap-select.js"></script>
							</div>
							<div class="col-lg-2 col-md-6 col-6">
								<div class="col-12 random_country">
									<i class="fa fa-exchange To_selectweight" aria-hidden="true"></i>
								</div>
							</div>
							<div class="col-lg-5 col-md-6 col-6">
								<div class="select_picker">
									<div class="select_Fromplanning">
										<div class="set_fontFrom">To</div>
									</div>
									<div class="row">
										<select class="selectpicker" data-show-subtext="true" data-live-search="true">
											<option>John Smith</option>
											<option>Alex Johnson</option>
											<option>Kevin Warren</option>
											<option>Super Mario</option>
											<option>Allen Martinez</option>
											<option>Marvin Liberty</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row mt-30">
							<div class="col-lg-5 col-md-5 col-5">
								<div class="set_fontFrom">Mount</div>
								<input type="text" class="form-control select_Fromplanning" placeholder="1" disabled>
							</div>
							<div class="col-lg-2  col-md-5 col-5">
								<div class="col-12 random_country">
									<div class="To_selectweight">
										<img src="../image/rendom.png" class="images_random1">
									</div>
								</div>
							</div>
							<div class="col-lg-5 col-md-5 col-5">
								<div class="set_fontFrom">Set Amount</div>
								<input type="text" class="form-control select_Toplanning" placeholder="115">
							</div>
						</div>
						<div class="col-12 result_country">
							1 BTH (฿) = 115 BDT (৳)
						</div>
						<div class="col-12 text-end">
							<span class="bg btn-convert" type="submit"> Convert</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="RoundUp" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropRoundUp" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-6">
							<div class="col-12 pt-20">
								<img src="../images/icons/Dark/48px/Round-Up.png" class="images_Round-Up"> <span class="text_Roundup">Round Up</span>
							</div>
						</div>
						<div class="col-lg-6 pt-10">
							<form>
								<input class="chosen-value" type="text" value="" id="">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>

</html>