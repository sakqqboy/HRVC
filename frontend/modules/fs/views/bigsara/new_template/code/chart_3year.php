<html>

<title>3 years Chart</title>

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
						<div class="col-lg-2 col-12">
							<div class="row">
								<div class="col-2 ">
									<span class="badge bg-primary-summary">PL</span>
								</div>
								<div class="col-10">
									Profit & Loss Forecast
								</div>
							</div>
						</div>
						<div class="col-lg-10 col-12 text-end ">
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
					<div class="alert-secondary secondary-CurrentYear mt-10">
						<div class="row">
							<div class="col-6">
								<div class="row">
									<div class="col-4 text-secondary pb-6">
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
									<div class="col-4 text-secondary">
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
									<div class="col-4 text-secondary">
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
								</div>
							</div>
							<div class="col-6 text-secondary text-end pt-8 font-size-12 pr-20">
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
					<div class="col-12" style="margin-top: -20px;">
						<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
						<div class="col-12 text-center font-size-16">
							<strong> PLF 3-Years Performance Chart</strong>
						</div>
						<div class="col-12 " style="height: 320px;">
							<canvas id="mylineChart"></canvas>
							<script>
								const xValues = [950000, 1000000, 110000, 1200000, 1300000, 1400000, 1500000, 1600000, 1700000, 1800000, 1900000, 2000000];
								const yValues = ["Jan", "Feb", "Mar", "Apr", "Jun", "Jul", "Aug", "May", "Sep", "Oct", "Nov", "Dec",
									"Jan", "Feb", "Mar", "Apr", "Jun", "Jul", "Aug", "May", "Sep", "Oct", "Nov", "Dec",
									"Jan", "Feb", "Mar", "Apr", "Jun", "Jul", "Aug", "May", "Sep", "Oct", "Nov", "Dec"
								];
								const data1 = [700000, 750000, 800000, 750000, 740000, 750000, 800000, 850000, 1000000, 1200000, 1400000, 1500000, 700000,
									750000, 800000, 750000, 740000, 750000, 800000, 850000, 1000000, 1200000, 1400000, 1500000, 700000, 750000, 800000, 750000,
									740000, 750000, 800000, 850000, 1000000, 1200000, 1400000, 1500000
								];
								const data2 = [1100000, 1000000, 1200000, 1200000, 1310000, 1350000, 1250000, 1450000, 1490000, 1520000, 1550000, 1570000,
									1100000, 1000000, 1200000, 1200000, 1310000, 1350000, 1250000, 1450000, 1490000, 1520000, 1550000, 1570000,
									1100000, 1000000, 1200000, 1200000, 1310000, 1350000, 1250000, 1450000, 1490000, 1520000, 1550000, 1570000
								];
								const data3 = [500000, 550000, 540000, 530000, 600000, 540000, 520000, 520000, 540000, 690000, 800000, 1000000,
									500000, 550000, 540000, 530000, 600000, 540000, 520000, 520000, 540000, 690000, 800000, 1000000,
									500000, 550000, 540000, 530000, 600000, 540000, 520000, 520000, 540000, 690000, 800000, 1000000
								];
								const data4 = [100000, 150000, 240000, 240000, 300000, 240000, 290000, 290000, 290000, 280000, 270000, 260000, 250000,
									100000, 150000, 240000, 240000, 300000, 240000, 290000, 290000, 290000, 280000, 270000, 260000, 250000,
									100000, 150000, 240000, 240000, 300000, 240000, 290000, 290000, 290000, 280000, 270000, 260000, 250000
								];
								new Chart("mylineChart", {
									type: "line",
									data: {
										labels: xValues,
										labels: yValues,
										datasets: [{
											data: data1,
											borderColor: "rgb(227, 175, 3)",

											fill: false
										}, {
											data: data2,
											borderColor: "#3430FF",
											fill: false
										}, {
											data: data3,
											borderColor: "rgb(21, 121, 215)",
											fill: false
										}, {
											data: data4,
											borderColor: "green",
											fill: false
										}]
									},
									options: {
										legend: {
											display: false,
										},
										responsive: true,
										maintainAspectRatio: false
									}
								});
							</script>
						</div>
					</div>
					<div class="col-12 mt-10">
						<div class="light-shadow-2 pt-10 pl-5 pr-5 pb-5">
							<div class="row">
								<div class="col-lg-2">
									<div class="light-shadow-3 pt-3 pb-5 pl-10">
										<div class="row">
											<div class="col-9 font-size-12 pt-5">
												<div class="Variable_Ex"> Variable Expense</div>
											</div>
											<div class="col-3">
												<div>
													<input class="form-check-input" type="checkbox" checked>
												</div>
											</div>
										</div>
									</div>
									<div class="mt-5 bg-white pt-10 pl-5 pr-3 pb-10" style="border:none;">
										<div class="row font-size-12">
											<div class="col-7 pl-20">
												Actual
											</div>
											<div class="col-5 pt-5">
												<div class="slidecontainer">
													<input type="range" min="1" max="100" value="50" class="slider-warning" id="myRange">
												</div>
											</div>
											<div class="col-7 pl-20 pt-10">
												Forecasted
											</div>
											<div class="col-5 pt-10">
												<button type="button" class="examplebox-warning"></button>
												<button type="button" class="examplebox-warning"></button>
												<button type="button" class="examplebox-warning"></button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="light-shadow-3 pt-3 pb-5 pl-10">
										<div class="row">
											<div class="col-9 font-size-12 pt-5">
												<div class="Variable_Ex"> Gross Profit</div>
											</div>
											<div class="col-3">
												<div>
													<input class="form-check-input" type="checkbox" checked>
												</div>
											</div>
										</div>
									</div>
									<div class="mt-5 bg-white pt-10 pl-5 pr-3 pb-10" style="border:none;">
										<div class="row font-size-12">
											<div class="col-7 pl-20">
												Actual
											</div>
											<div class="col-5 pt-5">
												<div class="slidecontainer">
													<input type="range" min="1" max="100" value="50" class="slider-blue" id="myRange">
												</div>
											</div>
											<div class="col-7 pl-20 pt-10">
												Forecasted
											</div>
											<div class="col-5 pt-10">
												<button type="button" class="examplebox-blue"></button>
												<button type="button" class="examplebox-blue"></button>
												<button type="button" class="examplebox-blue"></button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="light-shadow-3 pt-3 pb-5 pl-10">
										<div class="row">
											<div class="col-9 font-size-12 pt-5">
												<div class="Variable_Ex"> Labor Cost</div>
											</div>
											<div class="col-3">
												<div>
													<input class="form-check-input" type="checkbox" checked>
												</div>
											</div>
										</div>
									</div>
									<div class="mt-5 bg-white pt-10 pl-5 pr-3 pb-10" style="border:none;">
										<div class="row font-size-12">
											<div class="col-7 pl-20">
												Actual
											</div>
											<div class="col-5 pt-5">
												<div class="slidecontainer">
													<input type="range" min="1" max="100" value="50" class="slider-green" id="myRange">
												</div>
											</div>
											<div class="col-7 pl-20 pt-10">
												Forecasted
											</div>
											<div class="col-5 pt-10">
												<button type="button" class="examplebox-green"></button>
												<button type="button" class="examplebox-green"></button>
												<button type="button" class="examplebox-green"></button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="light-shadow-3 pt-3 pb-5 pl-10">
										<div class="row">
											<div class="col-9 font-size-12 pt-5">
												<div class="Variable_Ex"> Fixed Expense</div>
											</div>
											<div class="col-3">
												<div>
													<input class="form-check-input" type="checkbox" checked>
												</div>
											</div>
										</div>
									</div>
									<div class="mt-5 bg-white pt-10 pl-5 pr-3 pb-10" style="border:none;">
										<div class="row font-size-12">
											<div class="col-7 pl-20">
												Actual
											</div>
											<div class="col-5 pt-5">
												<div class="slidecontainer">
													<input type="range" min="1" max="100" value="50" class="slider-purple" id="myRange">
												</div>
											</div>
											<div class="col-7 pl-20 pt-10">
												Forecasted
											</div>
											<div class="col-5 pt-10">
												<button type="button" class="examplebox-purple"></button>
												<button type="button" class="examplebox-purple"></button>
												<button type="button" class="examplebox-purple"></button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-2" style="opacity: 0.5;">
									<div class="light-shadow-3 pt-3 pb-5 pl-10">
										<div class="row">
											<div class="col-9 font-size-12 pt-5">
												<div class="Variable_Ex"> Non-Operating</div>
											</div>
											<div class="col-3">
												<div>
													<input class="form-check-input" type="checkbox">
												</div>
											</div>
										</div>
									</div>
									<div class="mt-5 bg-white pt-10 pl-5 pr-3 pb-10" style="border:none;">
										<div class="row font-size-12">
											<div class="col-7 pl-20">
												Actual
											</div>
											<div class="col-5 pt-5">
												<div class="slidecontainer">
													<input type="range" min="1" max="100" value="50" class="slider-blue" id="myRange">
												</div>
											</div>
											<div class="col-7 pl-20 pt-10">
												Forecasted
											</div>
											<div class="col-5 pt-10">
												<button type="button" class="examplebox-blue"></button>
												<button type="button" class="examplebox-blue"></button>
												<button type="button" class="examplebox-blue"></button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-2" style="opacity: 0.5;">
									<div class="light-shadow-3 pt-3 pb-5 pl-10">
										<div class="row">
											<div class="col-9 font-size-12 pt-5">
												<div class="Variable_Ex"> Operating Profit</div>
											</div>
											<div class="col-3">
												<div>
													<input class="form-check-input" type="checkbox">
												</div>
											</div>
										</div>
									</div>
									<div class="mt-5 bg-white pt-10 pl-5 pr-3 pb-10" style="border:none;">
										<div class="row font-size-12">
											<div class="col-7 pl-20">
												Actual
											</div>
											<div class="col-5 pt-5">
												<div class="slidecontainer">
													<input type="range" min="1" max="100" value="50" class="slider-blue" id="myRange">
												</div>
											</div>
											<div class="col-7 pl-20 pt-10">
												Forecasted
											</div>
											<div class="col-5 pt-10">
												<button type="button" class="examplebox-blue"></button>
												<button type="button" class="examplebox-blue"></button>
												<button type="button" class="examplebox-blue"></button>
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