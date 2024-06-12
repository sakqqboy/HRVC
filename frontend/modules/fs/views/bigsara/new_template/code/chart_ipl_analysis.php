<html>

<title>Ipl analysis</title>

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
					<div class="row mt-15">
						<div class="col-lg-3 col-12 pl-0">
							<div class="col-12 alert-secondary secondary-CurrentYear font-b font-size-12 mb-15 pt-8 pr-10 pb-10 pl-15">
								PL Content
							</div>
							<div class="shadow-none rounded pt-4 pb-4 pl-4 mb-10" style="background-color: lightgray;">
								<div class="row">
									<div class="col-2  text-center pl-20">
										<input class="form-check-input" type="checkbox" value="" style="border-radius: 100%;">
									</div>
									<div class="col-10 pr-20">
										<input type="text" class="shadow rounded pl-input">
									</div>
								</div>
							</div>
							<?php
							for ($i; $i < 15; $i++) {
							?>
								<div class="shadow-none rounded pt-4 pb-4 pl-4 mb-10" style="background-color: lightgray;">
									<div class="row">
										<div class="col-10 pl-20">
											<input type="text" class="shadow rounded pl-input">
										</div>
										<div class="col-2 pr-20 text-center ">
											<input class="form-check-input" type="checkbox" value="" style="border-radius: 100%;">
										</div>
									</div>
								</div>
							<?php
							}
							?>
						</div>
						<div class="col-lg-9 col-12 pr-0 pl-0">
							<div class="col-12 pl-10 pr-0 alert-secondary secondary-CurrentYear">
								<div class="row">
									<div class="col-3 text-secondary pb-6">
										<div class="row">
											<div class="col-6 pt-8 pl-18 pr-0 font-size-12">
												<img src="../image/calendar.png" style="width: 13px;">
												Current Year
											</div>
											<div class="col-6 pt-5 pl-0">
												<select class="form-select text-primary font-size-10" aria-label="Default select example" style="height: 25px;">
													<option selected value="">Select</option>
													<option value="1">2020</option>
													<option value="2">2021</option>
													<option value="3">2022</option>
													<option value="4">2024</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-3 text-secondary">
										<div class="row">
											<div class="col-6 pt-8 pl-18 pr-10 font-size-12 text-end">
												<img src="../image/dollar.png" class="imagedollar"> Currency
											</div>
											<div class="col-6 pt-5 pl-0">
												<select class="form-select text-primary font-size-10" aria-label="Default select example" style="height: 25px;">
													<option selected value=""> BTH (฿)</option>
													<option value="1">2020</option>
													<option value="2">2021</option>
													<option value="3">2022</option>
													<option value="4">2024</option>>
												</select>
											</div>
										</div>
									</div>
									<div class="col-3 text-secondary">
										<div class="row">
											<div class="col-6 pt-8 pl-18 pr-10 font-size-12 text-end">
												<img src="../image/roundup.png"> Round Up
											</div>
											<div class="col-6 pt-5 pl-0">
												<select class="form-select text-primary font-size-10" aria-label="Default select example" style="height: 25px;">
													<option selected value=""> None</option>
													<option value="1">2020</option>
													<option value="2">2021</option>
													<option value="3">2022</option>
													<option value="4">2024</option>>
												</select>
											</div>
										</div>
									</div>
									<div class="col-3 text-secondary text-end pt-8 font-size-12 pr-20">
										<strong> F.Y. 2023 (Annual)</strong>
									</div>
								</div>
							</div>
							<div class="row mt-15">
								<div class="col-lg-9">
									<div class="col-12 text-primary">
										<a href="" class="no-underline-primary font-size-13"> <i class="fa fa-chevron-left" aria-hidden="true"></i> Data Table</a>
									</div>
								</div>
								<div class="col-lg-3 text-end">
									<a href="" class="button-link border-buttom pb-5 bg-light no-underline-black ">
										<img src="../image/ca-1.png" style="width: 30px;">
									</a>
									<a href="" class="button-link border-buttom pb-5 no-underline-black ml-5">
										<img src="../image/network.png">
									</a>
								</div>
							</div>
							<div class="row" style="margin-top: -25px;">
								<div class="col-12  font-size-16 text-center">
									<strong> Individual P&L Analysis</strong>
								</div>
								<div class="col-12 font-size-16" style="margin-top: -5px;">
									Variable Expense
								</div>

							</div>
							<div class="col-12 mt-30 ">
								<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
								<div class="col-12" style="height: 350px;">
									<canvas id="mixed-chart"></canvas>
									<script>
										new Chart(document.getElementById("mixed-chart"), {
											type: 'bar',
											data: {
												labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
												datasets: [{
													label: "Jan",
													type: "line",
													borderColor: "#008BF0", //ฟ้า//
													data: [400, 450, 600, 734, 660, 750, 673, 750, 483, 598, 750, 800],
													fill: true,
												}, {
													label: "Feb",
													type: "line",
													data: [430, 600, 850, 930, 900, 920, 900, 970, 960, 850, 850, 950],
													fill: true,
													backgroundColor: "transparent",
													borderColor: "red", ///แดง/
													borderDash: [4, 4],
												}, {
													label: "Mar",
													type: "bar",
													backgroundColor: "#A9EC9F", //เขียวอ่อน///
													data: [350, 547, 675, 905, 653, 899, 790, 950, 483, 598, 788, 940],
												}, {
													label: "Apr",
													type: "bar",
													backgroundColor: "#01724E", //เขียวเข้ม//
													backgroundColorHover: "#3e95cd",
													data: [360, 547, 783, 905, 653, 899, 690, 950, 483, 598, 788, 940],
												}]
											},
											options: {
												title: {
													display: true
												},
												legend: {
													display: false
												},
												responsive: true,
												maintainAspectRatio: false
											}
										});
									</script>
								</div>
							</div>
							<div class="col-12">
								<div class="alert light-shadow-2" role="alert">
									<div class="row">
										<div class="col-lg-3">
											<div class="card">
												<div class="card-header">
													Current Year-2022
												</div>
												<div class="card-body">
													<div class="row font-size-12">
														<div class="col-7 pl-20 pt-8">
															Actual
														</div>
														<div class="col-5">
															<div class="col-12 pt-8 text-center">
																<button type="button" class="example-iplAnalysis1"></button>
															</div>
														</div>
														<div class="col-7 pl-20 pt-10">
															Target
														</div>
														<div class="col-5 pt-10">
															<div class="col-12 text-center">
																<button type="button" class="example-iplAnalysis2"></button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="light-shadow-3 pt-3 pb-5 pl-10">
												<div class="row">
													<div class="col-12 pt-5 font-size-14 font-b">
														Previous Year
													</div>
												</div>
											</div>
											<div class="mt-5 bg-white pt-5 pl-5 pr-3 pb-10" style="border:none; min-height:73px;">
												<div class="row font-size-12">
													<div class="col-7 pl-20 pt-8">
														Actual
													</div>
													<div class="col-5">
														<a href=""> <img src="../image/graphlinechart.png" class="graph-linechart"></a>

													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="light-shadow-3 pt-3 pb-5 pl-10">
												<div class="row">
													<div class="col-12 pt-5 font-size-14 font-b">
														Forecasted Year
													</div>
												</div>
											</div>
											<div class="mt-5 bg-white pt-5 pl-5 pr-3 pb-10" style="border:none; min-height:73px;">
												<div class="row font-size-12">
													<div class="col-5 pl-20 pt-8">
														Target
													</div>
													<div class="col-7 pt-8">
														<button type="button" class="examplebox-red"></button>
														<button type="button" class="examplebox-red"></button>
														<button type="button" class="examplebox-red"></button>
														<button type="button" class="examplebox-red"></button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
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
</body>